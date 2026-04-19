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
    $num = str_pad($index + 1, 2, '0', STR_PAD_LEFT);
    $dateFormatted = isset($post->date)
        ? DateTime::createFromFormat('Y-m-d', $post->date)->format('F j, Y')
        : '';
    $readTime = '';
    if ('articles' === $slug) {
        $mdPath = sprintf('pages/articles/%s/%s.md', $post->category, $postSlug);
        if (file_exists($mdPath)) {
            $readTime = ceil(str_word_count(strip_tags(file_get_contents($mdPath))) / $settings->avgWordsPerMinute) . ' min read';
        }
    }
    $categoryLabel = isset($post->category) && isset($allCategories[$post->category])
        ? $allCategories[$post->category]
        : ($post->category ?? '');
    $postUrl = sprintf('/%s/%s/%s/', $slug, $post->category, $postSlug);
?>
<article class="group relative grid grid-cols-12 gap-4 border-t border-rule py-8 transition-colors sm:py-10" data-category="<?= htmlspecialchars($post->category ?? '') ?>" style="--tw-bg-opacity:1;" onmouseenter="this.style.backgroundColor='hsl(var(--accent)/0.4)'" onmouseleave="this.style.backgroundColor=''">
    <div class="col-span-12 sm:col-span-2">
        <p class="font-mono text-[0.7rem] uppercase tracking-[0.18em] text-muted-foreground">
            <span class="mr-3" style="color:hsl(var(--foreground)/0.4)"><?= $num ?></span>
            <?= $dateFormatted ?>
        </p>
    </div>

    <div class="col-span-12 sm:col-span-7">
        <h3 class="font-display text-xl font-medium leading-snug text-foreground sm:text-2xl">
            <a href="<?= $postUrl ?>" class="transition-[background-size] duration-300"
               style="background-image:linear-gradient(hsl(var(--foreground)),hsl(var(--foreground)));background-size:0% 1px;background-position:left bottom;background-repeat:no-repeat;"
               onmouseenter="this.style.backgroundSize='100% 1px'"
               onmouseleave="this.style.backgroundSize='0% 1px'">
                <?= htmlspecialchars($post->title) ?>
            </a>
        </h3>
        <?php if (!empty($post->description)): ?>
        <p class="mt-2 max-w-prose text-[0.95rem] leading-relaxed text-muted-foreground">
            <?= htmlspecialchars($post->description) ?>
        </p>
        <?php endif; ?>
        <?php if (!empty($post->tags) && is_array($post->tags)): ?>
        <ul class="mt-4 flex flex-wrap items-center gap-x-2 gap-y-1">
            <?php foreach ($post->tags as $tag): ?>
            <li class="font-mono text-[0.68rem] uppercase tracking-[0.14em] text-muted-foreground">
                <a href="/<?= $slug ?>/tags/<?= $tag ?>/"
                   style="color:inherit;">
                    <span style="color:hsl(var(--foreground)/0.3)">/</span> <?= isset($allTags[$tag]) ? $allTags[$tag] : $tag ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
    </div>

    <div class="col-span-12 flex items-start justify-between gap-3 sm:col-span-3 sm:justify-end sm:text-right">
        <div class="flex flex-col items-start gap-2 sm:items-end">
            <?php if ($categoryLabel): ?>
            <a href="/<?= $slug ?>/<?= $post->category ?>/"
               class="font-mono text-[0.68rem] uppercase tracking-[0.18em] text-muted-foreground hover:text-foreground">
                <?= htmlspecialchars($categoryLabel) ?>
            </a>
            <?php endif; ?>
            <?php if ($readTime): ?>
            <span class="font-mono text-[0.68rem] uppercase tracking-[0.18em] text-muted-foreground"><?= $readTime ?></span>
            <?php endif; ?>
        </div>
    </div>
</article>
<?php
    $index++;
    if ($shouldLimitPosts && $limit === $index) { break; }
endforeach; ?>
