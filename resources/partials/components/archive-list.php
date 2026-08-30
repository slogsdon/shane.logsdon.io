<?php
$articles = array_map(
    function ($post) { $post->type = 'articles'; return $post; },
    (array)json_decode(file_get_contents("resources/data/articles-list.json"))
);
$speaking = array_map(
    function ($post) { $post->type = 'speaking'; return $post; },
    (array)json_decode(file_get_contents("resources/data/speaking-list.json"))
);
$posts = array_filter(
    array_merge($articles, $speaking),
    function ($post) {
        return $post->archived;
    }
);
// DESIGN.md §Lists: date descending, always. 001 = newest.
uasort($posts, function ($a, $b) {
    return strcmp($b->date, $a->date);
});
$allCategories = json_decode(file_get_contents('resources/data/categories.json'), true);
$allTags = json_decode(file_get_contents('resources/data/tags.json'), true);
$years = array_reduce($posts, function ($result, $post) {
    $year = DateTime::createFromFormat('Y-m-d', $post->date)->format('Y');
    $result[$year] = $year;
    return $result;
}, []);
$total = count($posts);
$index = 0;
?>

<?php /* Index strip: count folio plus year filters. The year tabs FILTER one
         continuous descending list. They do not group it, and "all" is the
         default so the page is complete before any script runs. */ ?>
<div class="flex flex-wrap items-baseline justify-between gap-x-6 gap-y-3 border-y border-rule py-3" id="archive-filters">
    <p class="folio">
        <span class="pos"><?= str_pad($total, 3, '0', STR_PAD_LEFT) ?></span>
        <span>entries</span>
    </p>
    <div class="flex flex-wrap items-baseline gap-x-5 gap-y-2" role="tablist" aria-label="Filter by year">
        <button role="tab" aria-selected="true" data-year="all" class="archive-year-btn filter-tab">all</button>
        <?php foreach ($years as $year): ?>
        <button role="tab" aria-selected="false" data-year="<?= $year ?>" class="archive-year-btn filter-tab"><?= $year ?></button>
        <?php endforeach; ?>
    </div>
</div>

<?php if ($total === 0): ?>
    <p class="py-12 text-center text-muted-foreground text-sm">Nothing here yet.</p>
<?php endif; ?>

<?php foreach ($posts as $postSlug => $post):
    $index++;
    // The number is a permanent position in the full descending run, not a
    // position in the current view. Filter to one year and the numbers stay
    // where they were, which is what makes them citable.
    $num = str_pad($index, 3, '0', STR_PAD_LEFT);
    $year = DateTime::createFromFormat('Y-m-d', $post->date)->format('Y');
    $dateFormatted = DateTime::createFromFormat('Y-m-d', $post->date)->format('Y.m.d');
    $dateLong = DateTime::createFromFormat('Y-m-d', $post->date)->format('F j, Y');
    $categoryLabel = isset($post->category) && isset($allCategories[$post->category])
        ? $allCategories[$post->category]
        : ($post->category ?? '');
    $postUrl = sprintf('/archive/%s/%s/', $year, $postSlug);
?>
<article class="group relative grid grid-cols-12 gap-4 border-t border-rule py-8 sm:py-10 archive-card"
         data-year="<?= $year ?>">
    <div class="col-span-12 sm:col-span-2">
        <p class="folio">
            <span class="pos"><?= $num ?></span>
            <span><?= $dateFormatted ?></span>
        </p>
        <p class="sr-only"><?= $dateLong ?></p>
    </div>

    <div class="col-span-12 sm:col-span-7">
        <h3 class="font-display text-xl font-medium leading-snug text-foreground sm:text-2xl">
            <a href="<?= $postUrl ?>" class="row-title-link">
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
                <a href="/<?= $post->type ?>/tags/<?= $tag ?>/" class="hover:!text-foreground"><?= isset($allTags[$tag]) ? strtolower($allTags[$tag]) : strtolower($tag) ?></a>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
    </div>

    <div class="col-span-12 flex items-baseline justify-between gap-3 sm:col-span-3 sm:flex-col sm:items-end sm:justify-start sm:gap-2">
        <?php if ($categoryLabel): ?>
        <span class="smallcaps"><?= strtolower(htmlspecialchars($categoryLabel)) ?></span>
        <?php endif; ?>
        <span class="smallcaps"><?= strtolower($post->type) ?></span>
    </div>
</article>
<?php endforeach; ?>

<div class="hairline"></div>

<script>
(function () {
    var btns = document.querySelectorAll('.archive-year-btn');
    function showYear(targetYear) {
        document.querySelectorAll('.archive-card').forEach(function (card) {
            // Not the `hidden` attribute: these rows carry Tailwind's `grid`
            // class, whose display wins over [hidden] { display: none }.
            card.style.display = (targetYear === 'all' || card.dataset.year === targetYear) ? '' : 'none';
        });
    }
    btns.forEach(function (btn) {
        btn.addEventListener('click', function () {
            btns.forEach(function (b) {
                b.setAttribute('aria-selected', b === btn ? 'true' : 'false');
            });
            showYear(btn.dataset.year);
        });
    });
})();
</script>
