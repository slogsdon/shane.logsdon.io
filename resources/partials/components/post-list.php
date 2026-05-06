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
            <a href="<?= $postUrl ?>" class="transition-[background-size] duration-300 hover:no-underline"
               style="background-image:linear-gradient(hsl(var(--foreground)),hsl(var(--foreground)));background-size:0% 1px;background-position:left bottom;background-repeat:no-repeat;"
               onmouseenter="this.style.backgroundSize='100% 1px'"
               onmouseleave="this.style.backgroundSize='0% 1px'">
                <?= htmlspecialchars($post->title) ?>
            </a>
        </h3>
        <?php if (!empty($post->description)): ?>
        <p class="mt-3 max-w-prose text-[0.95rem] leading-relaxed text-muted-foreground">
            <?= htmlspecialchars($post->description) ?>
        </p>
        <?php endif; ?>
        <?php if (!empty($post->tags) && is_array($post->tags)): ?>
        <ul class="mt-2 flex flex-wrap items-center gap-x-3 gap-y-0">
            <?php foreach ($post->tags as $tag): ?>
            <li class="smallcaps">
                <a href="/<?= $slug ?>/tags/<?= $tag ?>/" class="inline-flex items-center py-2 hover:!text-foreground"><?= isset($allTags[$tag]) ? strtolower($allTags[$tag]) : strtolower($tag) ?></a>
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
