<?php
// Layout for Loop & Gate field guides. Decoupled from the articles system:
// title/description/date/image come from the page's own frontmatter, and the
// URL is /loop-and-gate/<slug>/ — not the /articles/ path writing-post derives.
$settings = require('resources/settings.php');
$ts = isset($date) ? (is_numeric($date) ? (int)$date : strtotime((string)$date)) : 0;
$modTs = isset($modified) ? (is_numeric($modified) ? (int)$modified : strtotime((string)$modified)) : $ts;
$url = sprintf('/loop-and-gate/%s/', $slug);
$desc = isset($description) ? $description : '';
$body = $content ?: $this->section('content');
$this->layout('partials::layouts/main', [
    'title' => !empty($title) ? $title : null,
    'description' => $desc,
    'url' => $url,
    'image' => !empty($image) ? $image : null,
    'imageAlt' => !empty($title) ? $title : null,
    'ogType' => 'article',
    'publishedTime' => date('c', $ts),
    'modifiedTime' => date('c', $modTs),
]);
$formattedDate = date('F j, Y', $ts);
$folioDate = date('Y.m.d', $ts);
$readTime = ceil(str_word_count(strip_tags($body)) / $settings->avgWordsPerMinute);
?>

<article class="mx-auto max-w-editorial px-6 pt-20 pb-16">

    <div class="running-head" aria-hidden="true">
        <span>shane logsdon &middot; loop &amp; gate</span>
        <span><?= $folioDate ?></span>
    </div>

    <header class="mt-12 border-b border-rule pb-12">
        <p class="smallcaps-lg">field guide</p>
        <h1 class="mt-4 max-w-4xl font-display text-4xl font-normal leading-[1.05] tracking-tight text-foreground sm:text-5xl md:text-6xl">
            <?= $this->e($title) ?>
        </h1>

        <?php if (!empty($desc)): ?>
        <p class="mt-6 max-w-prose text-[1.1875rem] leading-[1.6] text-ink-soft">
            <?= $this->e($desc) ?>
        </p>
        <?php endif; ?>

        <div class="mt-10 flex flex-wrap items-baseline gap-x-6 gap-y-2 folio">
            <span><?= $folioDate ?></span>
            <span class="sr-only"><?= $formattedDate ?></span>
            <span class="pos">/</span>
            <span><?= $readTime ?> min read</span>
        </div>
    </header>

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
        <?= $body ?>
    </div>

    <?php $this->insert('partials::components/author-bio'); ?>

    <footer class="mt-12 flex items-baseline justify-between gap-6 border-t border-rule pt-8">
        <a href="/loop-and-gate/" class="btn-arrow btn-arrow--muted" style="text-decoration: none;">
            &larr; Loop &amp; Gate
        </a>
        <span class="folio">
            <span><?= $folioDate ?></span>
            <span class="pos">/ field guide</span>
        </span>
    </footer>

</article>

<?php $this->insert('partials::components/contact-cta'); ?>

<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Article",
    "@id": <?= json_encode('https://shane.logsdon.io' . $url . '#Article') ?>,
    "headline": <?= json_encode($title) ?>,
    "url": <?= json_encode('https://shane.logsdon.io' . $url) ?>,
    "datePublished": "<?= date('Y-m-d', $ts) ?>",
    "dateModified": "<?= date('Y-m-d', $modTs) ?>",
    "author": {
        "@type": "Person",
        "@id": "https://shane.logsdon.io/about/#Person",
        "name": "Shane Logsdon",
        "url": "https://shane.logsdon.io/about/"
    },
    "publisher": { "@type": "Organization", "name": "Shane Logsdon" },
    "description": <?= json_encode($desc) ?>
}
</script>
