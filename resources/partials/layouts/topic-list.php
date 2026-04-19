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
$backLabel = $slug === 'articles' ? 'All Articles' : 'All Speaking';
$backHref  = sprintf('/%s/', $slug);
?>

<!-- Page header -->
<section class="mx-auto max-w-editorial px-6 pb-10 pt-20">
    <p class="eyebrow">§ <?= $slug === 'articles' ? 'Writing' : 'Speaking' ?></p>
    <h1 class="mt-4 max-w-4xl font-display text-4xl font-normal leading-[1.08] tracking-tight text-foreground sm:text-6xl">
        <?= htmlspecialchars($title) ?>
    </h1>
</section>

<section class="mx-auto max-w-editorial px-6">
    <div class="flex items-center justify-between border-y border-rule py-4">
        <a href="<?= htmlspecialchars($backHref) ?>"
           class="font-mono text-[0.7rem] uppercase tracking-[0.18em] text-muted-foreground hover:text-foreground">
            &larr; <?= htmlspecialchars($backLabel) ?>
        </a>
    </div>

    <?php $this->insert('partials::components/post-list', [
        'slug' => $slug,
        'filterByTopic' => $topic,
        'filterType' => $topicType,
    ]); ?>
    <div class="border-t border-rule"></div>
</section>

<?php $this->insert('partials::components/contact-cta'); ?>
