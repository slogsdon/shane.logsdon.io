<?php
$settings = require('resources/settings.php');
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
?>

<div class="flex items-baseline justify-between border-y border-rule py-4" id="archive-filters">
    <div class="flex items-baseline gap-4" role="tablist" aria-label="Filter by year">
        <?php $first = true; foreach ($years as $year): ?>
        <button role="tab" aria-selected="<?= $first ? 'true' : 'false' ?>" data-year="<?= $year ?>"
                class="archive-year-btn folio
                       <?= $first ? '!text-foreground' : 'hover:!text-foreground' ?>">
            <?= $year ?>
        </button>
        <?php $first = false; endforeach; ?>
    </div>
</div>

<?php if (count($posts) === 0): ?>
    <p class="py-12 text-center text-muted-foreground text-sm">Nothing here yet.</p>
<?php endif; ?>

<?php foreach ($posts as $postSlug => $post):
    $year = DateTime::createFromFormat('Y-m-d', $post->date)->format('Y');
    $dateFormatted = DateTime::createFromFormat('Y-m-d', $post->date)->format('Y.m.d');
    $dateLong = DateTime::createFromFormat('Y-m-d', $post->date)->format('F j, Y');
    $categoryLabel = isset($post->category) && isset($allCategories[$post->category])
        ? $allCategories[$post->category]
        : ($post->category ?? '');
    $postUrl = sprintf('/%s/%s/%s/', $post->type, $post->category, $postSlug);
?>
<article class="group relative grid grid-cols-12 gap-4 border-t border-rule py-8 sm:py-10 archive-card"
         data-year="<?= $year ?>"
         style="display:none;">
    <div class="col-span-12 sm:col-span-2">
        <p class="folio"><?= $dateFormatted ?></p>
        <p class="sr-only"><?= $dateLong ?></p>
    </div>

    <div class="col-span-12 sm:col-span-7">
        <h3 class="font-display text-xl font-medium leading-snug text-foreground sm:text-2xl">
            <a href="<?= $postUrl ?>" class="hover:no-underline transition-[background-size] duration-300"
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
                <a href="/<?= $post->type ?>/tags/<?= $tag ?>/" class="inline-flex items-center py-2 hover:!text-foreground"><?= isset($allTags[$tag]) ? strtolower($allTags[$tag]) : strtolower($tag) ?></a>
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
            card.style.display = card.dataset.year === targetYear ? '' : 'none';
        });
    }
    btns.forEach(function (btn) {
        btn.addEventListener('click', function () {
            btns.forEach(function (b) {
                var active = b === btn;
                b.setAttribute('aria-selected', active ? 'true' : 'false');
                b.classList.toggle('!text-foreground', active);
            });
            showYear(btn.dataset.year);
        });
    });
    var first = document.querySelector('.archive-year-btn');
    if (first) showYear(first.dataset.year);
})();
</script>
