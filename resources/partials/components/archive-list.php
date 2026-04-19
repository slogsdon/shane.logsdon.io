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

<div class="flex items-center justify-between border-y border-rule py-4" id="archive-filters">
    <div class="flex items-center gap-1" role="tablist" aria-label="Filter by year">
        <?php $first = true; foreach ($years as $year): ?>
        <button role="tab" aria-selected="<?= $first ? 'true' : 'false' ?>" data-year="<?= $year ?>"
                class="archive-year-btn font-mono text-[0.68rem] uppercase tracking-[0.18em] px-2 py-1 border
                       <?= $first ? 'text-foreground border-foreground/20 bg-foreground/5' : 'text-muted-foreground border-transparent hover:text-foreground hover:border-foreground/20' ?>">
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
    $dateFormatted = DateTime::createFromFormat('Y-m-d', $post->date)->format('F j, Y');
    $categoryLabel = isset($post->category) && isset($allCategories[$post->category])
        ? $allCategories[$post->category]
        : ($post->category ?? '');
    $postUrl = sprintf('/%s/%s/%s/', $post->type, $post->category, $postSlug);
?>
<article class="group relative grid grid-cols-12 gap-4 border-t border-rule py-8 transition-colors sm:py-10 archive-card"
         data-year="<?= $year ?>"
         style="display:none;"
         onmouseenter="this.style.backgroundColor='hsl(var(--accent)/0.4)'"
         onmouseleave="this.style.backgroundColor=''">
    <div class="col-span-12 sm:col-span-2">
        <p class="font-mono text-[0.7rem] uppercase tracking-[0.18em] text-muted-foreground">
            <?= $dateFormatted ?>
        </p>
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
        <p class="mt-2 max-w-prose text-[0.95rem] leading-relaxed text-muted-foreground">
            <?= htmlspecialchars($post->description) ?>
        </p>
        <?php endif; ?>
        <?php if (!empty($post->tags) && is_array($post->tags)): ?>
        <ul class="mt-4 flex flex-wrap items-center gap-x-2 gap-y-1">
            <?php foreach ($post->tags as $tag): ?>
            <li class="font-mono text-[0.68rem] uppercase tracking-[0.14em] text-muted-foreground">
                <span style="color:hsl(var(--foreground)/0.3)">/</span> <a href="/<?= $post->type ?>/tags/<?= $tag ?>/"
                   style="color:inherit;"><?= isset($allTags[$tag]) ? $allTags[$tag] : $tag ?></a>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
    </div>

    <div class="col-span-12 flex items-start justify-end gap-3 sm:col-span-3 sm:text-right">
        <div class="flex flex-col items-end gap-2">
            <?php if ($categoryLabel): ?>
            <span class="font-mono text-[0.68rem] uppercase tracking-[0.18em] text-muted-foreground">
                <?= htmlspecialchars($categoryLabel) ?>
            </span>
            <?php endif; ?>
            <span class="font-mono text-[0.68rem] uppercase tracking-[0.18em] text-muted-foreground">
                <?= ucfirst($post->type) ?>
            </span>
        </div>
    </div>
</article>
<?php endforeach; ?>

<div class="border-t border-rule"></div>

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
                b.classList.toggle('text-foreground', active);
                b.classList.toggle('border-foreground\\/20', active);
                b.classList.toggle('bg-foreground\\/5', active);
                b.classList.toggle('text-muted-foreground', !active);
                b.classList.toggle('border-transparent', !active);
            });
            showYear(btn.dataset.year);
        });
    });
    // show first year by default
    var first = document.querySelector('.archive-year-btn');
    if (first) showYear(first.dataset.year);
})();
</script>
