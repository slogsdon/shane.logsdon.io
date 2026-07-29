<?php
if ($topicType === 'tag') {
    $url = sprintf('/%s/tags/%s/', $slug, $topic);
} else {
    $url = sprintf('/%s/%s/', $slug, $topic);
}

// Unique, honest meta description per topic page (count + readable label).
$topicPosts = (array) json_decode(file_get_contents(sprintf('resources/data/%s-list.json', $slug)));
$topicCount = 0;
foreach ($topicPosts as $topicPost) {
    if (!empty($topicPost->archived)) {
        continue;
    }
    if ($topicType === 'tag') {
        if (isset($topicPost->tags) && is_array($topicPost->tags) && in_array($topic, $topicPost->tags)) {
            $topicCount++;
        }
    } elseif (($topicPost->category ?? null) === $topic) {
        $topicCount++;
    }
}
$topicNoun = $slug === 'articles' ? 'article' : 'talk';
$topicNounPlural = $topicCount === 1 ? $topicNoun : $topicNoun . 's';
$topicLabel = strtolower(trim(preg_replace('/\b(Articles?|Talks?|Engagements?)\b/i', '', $title)));
$topicDescription = $topicCount > 0
    ? sprintf('%d %s on %s by Shane Logsdon, covering developer platforms, payments, and AI tooling.', $topicCount, $topicNounPlural, $topicLabel)
    : sprintf('%s on %s by Shane Logsdon, covering developer platforms, payments, and AI tooling.', ucfirst($topicNounPlural), $topicLabel);

$this->layout('partials::layouts/main', [
    'title' => $title,
    'slug' => $slug,
    'description' => $topicDescription,
    'url' => !empty($url) ? $url : null,
]);
?>

<!-- Page header -->
<section class="mx-auto max-w-editorial px-6 pt-20 pb-12">
    <div class="running-head" aria-hidden="true">
        <span>shane logsdon &middot; <?= $slug === 'articles' ? 'writing' : 'speaking' ?></span>
        <span><?= date('Y.m.d') ?></span>
    </div>
    <h1 class="mt-12 max-w-[20ch] font-display font-normal text-foreground"
        style="font-size: clamp(2.5rem, 6vw, 5rem); line-height: 1.05; letter-spacing: -0.02em;">
        <?= htmlspecialchars($title) ?>
    </h1>
</section>

<section class="mx-auto max-w-editorial px-6">
    <?php // The strip's own "all" tab is the way back, so the old back-link bar
          // would be a second control doing the same job. On a tag page no tab
          // matches, which is honest: a tag is not one of the categories.
    $this->insert('partials::components/index-strip', [
        'stripSlug'    => $slug,
        'stripCount'   => $topicCount,
        'stripCurrent' => $topicType === 'category' ? $topic : null,
    ]); ?>

    <?php $this->insert('partials::components/post-list', [
        'slug' => $slug,
        'filterByTopic' => $topic,
        'filterType' => $topicType,
    ]); ?>
    <div class="hairline"></div>
</section>

<?php $this->insert('partials::components/contact-cta'); ?>
