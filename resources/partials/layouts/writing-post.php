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
]);
$formattedDate = DateTime::createFromFormat('U', $originalDate)->format('F j, Y');
$readTime = ceil(str_word_count(strip_tags($content)) / $settings->avgWordsPerMinute);
$typeLabel = $meta->type === 'speaking' ? 'Speaking' : 'Articles';
$venue = isset($meta->presentationMetadata) && is_array($meta->presentationMetadata) && !empty($meta->presentationMetadata['venue'])
    ? $meta->presentationMetadata['venue']
    : null;
?>

<article class="mx-auto max-w-editorial px-6 pb-16 pt-20">

    <a href="/<?= $meta->type ?>/"
       class="inline-flex items-center gap-2 font-mono text-[0.7rem] uppercase tracking-[0.18em] text-muted-foreground transition-colors hover:text-foreground hover:no-underline">
        ← <?= $typeLabel ?>
    </a>

    <header class="mt-8 border-b border-rule pb-10">
        <?php if (isset($meta->category) && isset($allCategories[$meta->category])): ?>
        <p class="eyebrow">§ <?= htmlspecialchars($allCategories[$meta->category]) ?></p>
        <?php endif; ?>

        <h1 class="mt-4 max-w-4xl font-display text-4xl font-normal leading-[1.08] tracking-tight text-foreground sm:text-5xl">
            <?= $title ?>
        </h1>

        <?php if (!empty($meta->description)): ?>
        <p class="mt-6 max-w-prose text-base leading-relaxed text-muted-foreground">
            <?= htmlspecialchars($meta->description) ?>
        </p>
        <?php endif; ?>

        <div class="mt-8 flex flex-wrap items-center gap-x-6 gap-y-2 font-mono text-[0.7rem] uppercase tracking-[0.18em] text-muted-foreground">
            <span><?= $formattedDate ?></span>
            <?php if ($meta->type === 'articles'): ?>
                <span class="text-foreground/30">·</span>
                <span><?= $readTime ?> min read</span>
            <?php endif; ?>
            <?php if ($venue): ?>
                <span class="text-foreground/30">·</span>
                <span><?= htmlspecialchars($venue) ?></span>
            <?php endif; ?>
            <?php if (!empty($meta->tags)): ?>
                <span class="text-foreground/30">·</span>
                <ul class="flex flex-wrap items-center gap-x-3 gap-y-1 list-none p-0">
                    <?php foreach ($meta->tags as $tag): ?>
                        <li><span class="text-foreground/30">/</span> <a href="/<?= $meta->type ?>/tags/<?= $tag ?>/" class="transition-colors hover:text-foreground hover:no-underline"><?= htmlspecialchars($allTags[$tag]) ?></a></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </header>

    <?php if (isset($meta->archived) && $meta->archived === true): ?>
    <div class="mt-10 border border-rule px-6 py-5" style="background-color: hsl(var(--accent) / 0.4);">
        <p class="font-mono text-[0.7rem] uppercase tracking-[0.18em] text-foreground">Historical Content</p>
        <p class="mt-2 text-sm leading-relaxed text-muted-foreground">
            This was published on <strong class="font-medium text-foreground"><?= $formattedDate ?></strong> and is maintained for historical reference. While the core concepts may still be relevant, specific technical details may be outdated.
        </p>
    </div>
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

    <div class="prose mt-12 max-w-prose text-base leading-[1.75] text-foreground">
        <?= $content ?: $this->section('content'); ?>
    </div>

    <?php $this->insert('partials::components/author-bio'); ?>

    <section class="mt-16 border-t border-rule pt-10">
        <script src="https://utteranc.es/client.js"
                repo="slogsdon/shane.logsdon.io"
                issue-term="pathname"
                theme="github-light"
                crossorigin="anonymous"
                async>
        </script>
    </section>

    <footer class="mt-12 border-t border-rule pt-8">
        <a href="/<?= $meta->type ?>/"
           class="inline-flex items-center gap-2 font-mono text-[0.7rem] uppercase tracking-[0.18em] text-muted-foreground transition-colors hover:text-foreground hover:no-underline">
            ← All <?= strtolower($typeLabel) ?>
        </a>
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
