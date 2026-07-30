<?php
$settings = require('resources/settings.php');
$posts = (array)json_decode(file_get_contents(sprintf('resources/data/%s-list.json', $slug)));
$shouldLimitPosts = isset($limit) && $limit > 0;
if ($shouldLimitPosts === true) {
    $count = 0;
}
if (isset($filterByTopic)) {
    $posts = array_filter($posts, function ($post) use ($filterType, $filterByTopic) {
        if ($filterType === 'tag') {
            return is_array($post->tags) && in_array($filterByTopic, $post->tags);
        } else {
            return $filterByTopic === $post->category;
        }
    });
}
$posts = array_filter($posts, function ($post) {
    return !$post->archived;
});
// DESIGN.md §Lists: ordered by date descending, always, with 001 = newest.
// Until now this partial rendered whatever order the JSON file happened to be
// in, which put 2026-05-12 ahead of 2026-05-18 on the live /articles/ index and
// made the folio number a lie. Sorting here rather than in the data file means
// the next hand-edited entry cannot reintroduce it. uasort preserves the slug
// keys the loop below relies on.
uasort($posts, function ($a, $b) {
    return strcmp($b->date ?? '', $a->date ?? '');
});
$allCategories = json_decode(file_get_contents('resources/data/categories.json'), true);
$allTags = json_decode(file_get_contents('resources/data/tags.json'), true);
$index = 0;
?>

<?php if (count($posts) === 0): ?>
    <p class="py-12 text-center text-muted-foreground text-sm">Nothing here yet.</p>
<?php endif; ?>

<?php foreach ($posts as $postSlug => $post):
    $num = str_pad($index + 1, 3, '0', STR_PAD_LEFT);
    $dateFormatted = isset($post->date)
        ? DateTime::createFromFormat('Y-m-d', $post->date)->format('Y.m.d')
        : '';
    $dateLong = isset($post->date)
        ? DateTime::createFromFormat('Y-m-d', $post->date)->format('F j, Y')
        : '';
    $readTime = '';
    if ('articles' === $slug) {
        $mdPath = sprintf('pages/articles/%s/%s.md', $post->category, $postSlug);
        if (file_exists($mdPath)) {
            $readTime = ceil(str_word_count(strip_tags(file_get_contents($mdPath))) / $settings->avgWordsPerMinute) . ' min';
        }
    }
    $categoryLabel = isset($post->category) && isset($allCategories[$post->category])
        ? $allCategories[$post->category]
        : ($post->category ?? '');
    $postUrl = sprintf('/%s/%s/%s/', $slug, $post->category, $postSlug);
?>
<article class="group relative grid grid-cols-12 gap-4 border-t border-rule py-8 sm:py-10" data-category="<?= htmlspecialchars($post->category ?? '') ?>">
    <div class="col-span-12 sm:col-span-2">
        <p class="folio">
            <span class="pos"><?= $num ?></span>
            <span><?= $dateFormatted ?></span>
        </p>
        <p class="sr-only"><?= $dateLong ?></p>
    </div>

    <div class="col-span-12 sm:col-span-7">
        <h3 class="font-display text-xl font-medium leading-snug text-foreground sm:text-2xl">
            <a href="<?= $postUrl ?>" class="row-title-link hover:no-underline">
                <?= htmlspecialchars($post->title) ?>
            </a>
        </h3>
        <?php if (!empty($post->description)): ?>
        <p class="mt-3 max-w-prose text-[0.95rem] leading-relaxed text-muted-foreground">
            <?= htmlspecialchars($post->description) ?>
        </p>
        <?php endif; ?>
        <?php if (!empty($post->tags) && is_array($post->tags)): ?>
        <ul class="mt-4 flex flex-wrap items-baseline gap-x-3 gap-y-1">
            <?php foreach ($post->tags as $tag): ?>
            <li class="smallcaps">
                <a href="/<?= $slug ?>/tags/<?= $tag ?>/" class="hover:!text-foreground"><?= isset($allTags[$tag]) ? strtolower($allTags[$tag]) : strtolower($tag) ?></a>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
    </div>

    <div class="col-span-12 flex items-baseline justify-between gap-3 sm:col-span-3 sm:flex-col sm:items-end sm:justify-start sm:gap-2">
        <?php if ($categoryLabel): ?>
        <a href="/<?= $slug ?>/<?= $post->category ?>/" class="smallcaps hover:!text-foreground">
            <?= strtolower(htmlspecialchars($categoryLabel)) ?>
        </a>
        <?php endif; ?>
        <?php if ($readTime): ?>
        <span class="folio"><?= $readTime ?></span>
        <?php endif; ?>
    </div>
</article>
<?php
    $index++;
    if ($shouldLimitPosts && $limit === $index) { break; }
endforeach; ?>
