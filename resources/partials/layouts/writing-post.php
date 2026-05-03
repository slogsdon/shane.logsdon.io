<?php
$settings = require('resources/settings.php');
$allCategories = json_decode(file_get_contents('resources/data/categories.json'), true);
$allTags = json_decode(file_get_contents('resources/data/tags.json'), true);
$articles = array_map(
    function ($post) { $post['type'] = 'articles'; return $post; },
    json_decode(file_get_contents("resources/data/articles-list.json"), true)
);
$speaking = array_map(
    function ($post) { $post['type'] = 'speaking'; return $post; },
    json_decode(file_get_contents("resources/data/speaking-list.json"), true)
);
$allPosts = array_merge($articles, $speaking);
$defaultMeta = [
    'type'=>'articles',
    'category'=>'technical-deep-dives',
    'description'=>'',
    'archived'=>false,
    'tags'=>[],
];
$meta = (object)(isset($allPosts[$slug]) ? $allPosts[$slug] : $defaultMeta);
$originalDate = isset($date) ? $date : '0';
if ($meta->archived) {
    $year = DateTime::createFromFormat('U', $originalDate)->format('Y');
    $url = sprintf('/archive/%s/%s/', $year, $slug);
} else {
    $url = sprintf('/%s/%s/%s/', $meta->type, $meta->category, $slug);
}
$this->layout('partials::layouts/main', [
    'title' => !empty($title) ? $title : null,
    'description' => $meta->description,
    'url' => !empty($url) ? $url : null,
    'image' => !empty($image) ? $image : null,
    'imageAlt' => !empty($title) ? $title : null,
    'ogType' => 'article',
    'publishedTime' => DateTime::createFromFormat('U', $originalDate)->format('c'),
    'modifiedTime' => DateTime::createFromFormat('U', isset($modified) ? $modified : $originalDate)->format('c'),
]);
$formattedDate = DateTime::createFromFormat('U', $originalDate)->format('F j, Y');
$folioDate = DateTime::createFromFormat('U', $originalDate)->format('Y.m.d');
$readTime = ceil(str_word_count(strip_tags($content)) / $settings->avgWordsPerMinute);
$typeLabel = $meta->type === 'speaking' ? 'speaking' : 'articles';
$categoryLabel = isset($meta->category) && isset($allCategories[$meta->category])
    ? $allCategories[$meta->category]
    : null;
$venue = isset($meta->presentationMetadata) && is_array($meta->presentationMetadata) && !empty($meta->presentationMetadata['venue'])
    ? $meta->presentationMetadata['venue']
    : null;
?>

<article class="mx-auto max-w-editorial px-6 pt-20 pb-16">

    <div class="running-head" aria-hidden="true">
        <span>shane logsdon &mdash; <?= $typeLabel ?><?= $categoryLabel ? ' / ' . strtolower($categoryLabel) : '' ?></span>
        <span><?= $folioDate ?></span>
    </div>

    <header class="mt-12 border-b border-rule pb-12">
        <h1 class="max-w-4xl font-display text-4xl font-normal leading-[1.05] tracking-tight text-foreground sm:text-5xl md:text-6xl">
            <?= $title ?>
        </h1>

        <?php if (!empty($meta->description)): ?>
        <p class="mt-6 max-w-prose text-[1.1875rem] leading-[1.6] text-ink-soft">
            <?= htmlspecialchars($meta->description) ?>
        </p>
        <?php endif; ?>

        <div class="mt-10 flex flex-wrap items-baseline gap-x-6 gap-y-2 folio">
            <span><?= $folioDate ?></span>
            <span class="sr-only"><?= $formattedDate ?></span>
            <?php if ($meta->type === 'articles'): ?>
                <span class="pos">/</span>
                <span><?= $readTime ?> min read</span>
            <?php endif; ?>
            <?php if ($venue): ?>
                <span class="pos">/</span>
                <span><?= htmlspecialchars($venue) ?></span>
            <?php endif; ?>
        </div>

        <?php if (!empty($meta->tags) && is_array($meta->tags)): ?>
        <ul class="mt-4 flex flex-wrap items-baseline gap-x-3 gap-y-1">
            <?php foreach ($meta->tags as $tag): ?>
            <li class="smallcaps">
                <a href="/<?= $meta->type ?>/tags/<?= $tag ?>/" class="hover:!text-foreground"><?= isset($allTags[$tag]) ? strtolower($allTags[$tag]) : strtolower($tag) ?></a>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
    </header>

    <?php if (isset($meta->archived) && $meta->archived === true): ?>
    <aside class="inversion mt-10 px-6 py-6">
        <p class="smallcaps-lg">historical content</p>
        <p class="mt-3 max-w-prose text-[0.95rem] leading-relaxed" style="color: rgba(251, 250, 249, 0.72);">
            Published on <strong class="font-medium" style="color: var(--color-surface);"><?= $formattedDate ?></strong> and maintained for historical reference. The core ideas may still apply, but specific technical details may be outdated.
        </p>
    </aside>
    <?php endif; ?>

    <?php
    $speakerDeckId = isset($meta->presentationMetadata) && is_array($meta->presentationMetadata) && !empty($meta->presentationMetadata['speakerDeckId'])
        ? $meta->presentationMetadata['speakerDeckId']
        : null;
    $speakerDeckRatio = isset($meta->presentationMetadata) && is_array($meta->presentationMetadata) && !empty($meta->presentationMetadata['speakerDeckRatio'])
        ? $meta->presentationMetadata['speakerDeckRatio']
        : '1.7777777777777777';
    $vimeoId = isset($meta->presentationMetadata) && is_array($meta->presentationMetadata) && !empty($meta->presentationMetadata['vimeoId'])
        ? $meta->presentationMetadata['vimeoId']
        : null;
    ?>
    <?php if ($speakerDeckId): ?>
    <div class="mt-12">
        <script async class="speakerdeck-embed" data-id="<?= htmlspecialchars($speakerDeckId) ?>" data-ratio="<?= htmlspecialchars($speakerDeckRatio) ?>" src="//speakerdeck.com/assets/embed.js"></script>
    </div>
    <?php endif; ?>
    <?php if ($vimeoId): ?>
    <div class="mt-12 border-t border-rule pt-10">
        <div style="padding:56.25% 0 0 0;position:relative;">
            <iframe
                src="https://player.vimeo.com/video/<?= htmlspecialchars($vimeoId) ?>"
                style="position:absolute;top:0;left:0;width:100%;height:100%;"
                frameborder="0"
                allow="autoplay; fullscreen; picture-in-picture; clipboard-write; encrypted-media"
                allowfullscreen
                title="<?= htmlspecialchars($title) ?>">
            </iframe>
        </div>
        <script src="https://player.vimeo.com/api/player.js"></script>
    </div>
    <?php endif; ?>

    <?php if (!empty($heroImage)): ?>
    <div class="mt-12">
        <img src="/images/<?= $this->e($heroImage) ?>"
             alt="<?= $this->e($title) ?>"
             width="1440" height="600"
             class="w-full"
             style="display:block;">
    </div>
    <?php endif; ?>

    <div class="prose mt-12 max-w-prose text-[1.0625rem] leading-[1.65] text-foreground">
        <?= $content ?: $this->section('content'); ?>
    </div>

    <?php $this->insert('partials::components/author-bio'); ?>

    <section class="mt-16 border-t border-rule pt-10">
        <script src="https://giscus.app/client.js"
                data-repo="slogsdon/shane.logsdon.io"
                data-repo-id="MDEwOlJlcG9zaXRvcnkxNTI0NTU2Mw=="
                data-category="General"
                data-category-id="DIC_kwDOAOig-84C8KQg"
                data-mapping="pathname"
                data-strict="0"
                data-reactions-enabled="1"
                data-emit-metadata="0"
                data-input-position="bottom"
                data-theme="light"
                data-lang="en"
                crossorigin="anonymous"
                async>
        </script>
    </section>

    <footer class="mt-12 flex items-baseline justify-between gap-6 border-t border-rule pt-8">
        <a href="/<?= $meta->type ?>/" class="btn-arrow btn-arrow--muted" style="text-decoration: none;">
            &larr; All <?= $typeLabel ?>
        </a>
        <span class="folio">
            <span><?= $folioDate ?></span>
            <span class="pos">/ <?= $typeLabel ?></span>
        </span>
    </footer>

</article>

<?php $this->insert('partials::components/contact-cta'); ?>

<script type="application/ld+json">
{
    "@context": "https://schema.org/",
    "@type": "BlogPosting",
    "@id": "https://shane.logsdon.io/<?= $meta->type ?>/<?= $meta->category ?>/<?= $slug ?>/#BlogPosting",
    "mainEntityOfPage": "https://shane.logsdon.io/<?= $meta->type ?>/<?= $meta->category ?>/<?= $slug ?>/",
    "headline": "<?= addslashes($title) ?>",
    "name": "<?= addslashes($title) ?>",
    "description": "<?= addslashes($meta->description) ?>",
    "datePublished": "<?= DateTime::createFromFormat('U', $originalDate)->format('Y-m-d') ?>",
    "dateModified": "<?= DateTime::createFromFormat('U', isset($modified) ? $modified : $originalDate)->format('Y-m-d') ?>",
    "author": {
        "@type": "Person",
        "@id": "https://shane.logsdon.io/about/#Person",
        "name": "Shane Logsdon",
        "url": "https://shane.logsdon.io/about/",
        "image": {
            "@type": "ImageObject",
            "@id": "https://shane.logsdon.io/images/headshot.jpeg",
            "url": "https://shane.logsdon.io/images/headshot.jpeg",
            "height": "2827",
            "width": "1887"
        }
    },
    "url": "https://shane.logsdon.io/<?= $meta->type ?>/<?= $meta->category ?>/<?= $slug ?>/",
    "isPartOf": {
        "@type": "Blog",
        "@id": "https://shane.logsdon.io/articles/",
        "name": "Shane Logsdon's Blog"
    },
    "wordCount": "<?= str_word_count(strip_tags($content)) ?>"
}
</script>
