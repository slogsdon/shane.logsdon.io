<?php
if ($topicType === 'tag') {
    $url = sprintf('/%s/tags/%s/', $slug, $topic);
} else {
    $url = sprintf('/%s/%s/', $slug, $topic);
}
$this->layout('partials::layouts/main', [
    'title' => $title,
    'slug' => $slug,
    'url' => !empty($url) ? $url : null,
]);
$backLabel = $slug === 'articles' ? 'All articles' : 'All speaking';
$backHref  = sprintf('/%s/', $slug);
?>

<!-- Page header -->
<section class="mx-auto max-w-editorial px-6 pt-20 pb-12">
    <div class="running-head" aria-hidden="true">
        <span>shane logsdon &mdash; <?= $slug === 'articles' ? 'writing' : 'speaking' ?></span>
        <span><?= date('Y.m.d') ?></span>
    </div>
    <h1 class="mt-12 max-w-[20ch] font-display font-normal text-foreground"
        style="font-size: clamp(2.5rem, 6vw, 5rem); line-height: 1.05; letter-spacing: -0.02em;">
        <?= htmlspecialchars($title) ?>
    </h1>
</section>

<section class="mx-auto max-w-editorial px-6">
    <div class="flex items-baseline justify-between border-y border-rule py-4">
        <a href="<?= htmlspecialchars($backHref) ?>" class="btn-arrow btn-arrow--muted" style="text-decoration: none;">
            &larr; <?= htmlspecialchars($backLabel) ?>
        </a>
    </div>

    <?php $this->insert('partials::components/post-list', [
        'slug' => $slug,
        'filterByTopic' => $topic,
        'filterType' => $topicType,
    ]); ?>
    <div class="hairline"></div>
</section>

<?php $this->insert('partials::components/contact-cta'); ?>
