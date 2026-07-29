<?php
/**
 * Index strip — the bar above every list (DESIGN.md §Components).
 *
 * Count folio on the left, category navigation on the right.
 *
 * §Lists says category is a filter, never a grouping. The version this replaces
 * honored that in spirit and broke it in practice: the tabs were buttons that
 * hid rows with JavaScript, so the filtered view existed only in the browser and
 * the indexed category routes sat alongside it as a second, unlinked mechanism.
 * Every tab now points at the route it names. One mechanism, no JavaScript, and
 * the route renders through the same list partial, so the filtered view and the
 * full view cannot disagree about order.
 *
 * Params:
 *   $stripSlug    string  'articles' or 'speaking'
 *   $stripCount   int     entries shown below the strip
 *   $stripCurrent string  'all', a category slug, or null on a tag page
 */
$stripCurrent = $stripCurrent ?? null;
$countLabel = str_pad((string) $stripCount, 3, '0', STR_PAD_LEFT);
$noun = $stripSlug === 'speaking'
    ? ($stripCount === 1 ? 'talk' : 'talks')
    : ($stripCount === 1 ? 'entry' : 'entries');

// Tabs are built from the categories actually in use, so a category that loses
// its last post loses its tab rather than linking to an empty route.
$tabs = [];
if ($stripSlug === 'articles') {
    $categoryLabels = json_decode(file_get_contents('resources/data/categories.json'), true);
    $stripPosts = (array) json_decode(file_get_contents('resources/data/articles-list.json'));
    $usedCategories = array_unique(array_map(
        fn($post) => $post->category,
        array_filter($stripPosts, fn($post) => !$post->archived && !empty($post->category))
    ));
    sort($usedCategories);

    $tabs[] = ['slug' => 'all', 'label' => 'all', 'href' => '/articles/'];
    foreach ($usedCategories as $categorySlug) {
        $tabs[] = [
            'slug'  => $categorySlug,
            'label' => strtolower($categoryLabels[$categorySlug] ?? $categorySlug),
            'href'  => sprintf('/articles/%s/', $categorySlug),
        ];
    }
}
?>
<div class="flex flex-wrap items-baseline justify-between gap-x-6 gap-y-3 border-y border-rule py-4">
    <p class="folio">
        <span class="pos"><?= $countLabel ?></span>
        <span><?= $noun ?></span>
    </p>

    <?php if ($tabs): ?>
    <nav class="flex flex-wrap items-baseline gap-x-4 gap-y-2 sm:gap-x-5" aria-label="Browse articles by category">
        <?php foreach ($tabs as $tab): ?>
        <a class="filter-tab" href="<?= $tab['href'] ?>"<?= $stripCurrent === $tab['slug'] ? ' aria-current="page"' : '' ?>><?= htmlspecialchars($tab['label']) ?></a>
        <?php endforeach; ?>
    </nav>
    <?php elseif ($stripCurrent === 'all'): ?>
    <p class="smallcaps">archive</p>
    <?php else: ?>
    <a class="filter-tab" href="/<?= htmlspecialchars($stripSlug) ?>/">&larr; all <?= $stripSlug === 'speaking' ? 'talks' : 'entries' ?></a>
    <?php endif; ?>
</div>
