<?php
$this->layout('partials::layouts/main', [
    'title' => $title,
    'slug' => $slug,
    'url' => sprintf('/%s/', $slug),
    'description' => $description ?? null,
]);

$allPosts = (array)json_decode(file_get_contents(sprintf('resources/data/%s-list.json', $slug)));
$activePosts = array_filter($allPosts, fn($p) => !$p->archived);
$postCount = count($activePosts);
$countLabel = str_pad($postCount, 3, '0', STR_PAD_LEFT);

$isArticles = $slug === 'articles';
$isSpeaking = $slug === 'speaking';
?>

<!-- Page header -->
<section class="mx-auto max-w-editorial px-6 pt-20 pb-12">
    <div class="running-head" aria-hidden="true">
        <span>shane logsdon &mdash; <?= $isSpeaking ? 'speaking' : 'writing' ?></span>
        <span><?= date('Y.m.d') ?></span>
    </div>
    <?php if ($isArticles): ?>
        <h1 class="mt-12 max-w-[18ch] font-display font-normal text-foreground"
            style="font-size: clamp(2.75rem, 7vw, 6rem); line-height: 1.0; letter-spacing: -0.02em;">
            Articles &amp; <span class="t-accent">field notes</span>.
        </h1>
        <p class="mt-8 max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
            Working notes on payment systems, developer platforms, and the unglamorous
            architecture choices that decide whether a product feels good to build on.
        </p>
    <?php elseif ($isSpeaking): ?>
        <h1 class="mt-12 max-w-[18ch] font-display font-normal text-foreground"
            style="font-size: clamp(2.75rem, 7vw, 6rem); line-height: 1.0; letter-spacing: -0.02em;">
            Talks &amp; <span class="t-accent">conversations</span>.
        </h1>
        <p class="mt-8 max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
            A small archive of public talks on payments, partnerships, and the realities of
            shipping developer-facing products.
        </p>
    <?php else: ?>
        <h1 class="mt-12 font-display text-4xl font-normal tracking-tight text-foreground sm:text-6xl">
            <?= htmlspecialchars($title) ?>
        </h1>
    <?php endif; ?>
</section>

<section class="mx-auto max-w-editorial px-6">
    <div class="flex items-baseline justify-between border-y border-rule py-4">
        <p class="folio">
            <span class="pos"><?= $countLabel ?></span>
            <span><?= $isArticles ? ($postCount === 1 ? 'entry' : 'entries') : ($postCount === 1 ? 'talk' : 'talks') ?></span>
        </p>
        <?php if ($isArticles):
            $allCategories = json_decode(file_get_contents('resources/data/categories.json'), true);
            $articles = (array)json_decode(file_get_contents('resources/data/articles-list.json'));
            $usedCategories = array_unique(array_map(
                fn($a) => $a->category,
                array_filter($articles, fn($a) => !$a->archived && !empty($a->category))
            ));
            sort($usedCategories);
        ?>
        <div class="flex items-baseline gap-4 sm:gap-5" id="article-filters" role="tablist" aria-label="Filter articles by category">
            <button role="tab" aria-selected="true" data-filter="all"
                    class="article-filter-btn smallcaps !text-foreground">
                all
            </button>
            <?php foreach ($usedCategories as $catSlug):
                $catLabel = $allCategories[$catSlug] ?? $catSlug;
            ?>
            <button role="tab" aria-selected="false" data-filter="<?= htmlspecialchars($catSlug) ?>"
                    class="article-filter-btn smallcaps hover:!text-foreground">
                <?= strtolower(htmlspecialchars($catLabel)) ?>
            </button>
            <?php endforeach; ?>
        </div>
        <script>
        (function () {
            var btns = document.querySelectorAll('#article-filters .article-filter-btn');
            btns.forEach(function (btn) {
                btn.addEventListener('click', function () {
                    var filter = btn.dataset.filter;
                    btns.forEach(function (b) {
                        var active = b === btn;
                        b.setAttribute('aria-selected', active ? 'true' : 'false');
                        b.classList.toggle('!text-foreground', active);
                    });
                    document.querySelectorAll('[data-category]').forEach(function (article) {
                        var show = filter === 'all' || article.dataset.category === filter;
                        article.style.display = show ? '' : 'none';
                    });
                });
            });
        })();
        </script>
        <?php elseif ($isSpeaking): ?>
        <p class="smallcaps">archive</p>
        <?php endif; ?>
    </div>

    <?php $this->insert('partials::components/post-list', [
        'slug' => $slug,
    ]); ?>
    <div class="hairline"></div>
</section>

<?php
$speakingCta = $isSpeaking
    ? ['ctaEyebrow' => 'Invite', 'ctaTitle' => 'Available for select talks and panels.', 'ctaBody' => 'If you\'re organizing something thoughtful around payments, developer experience, or platform strategy, I\'d love to hear from you on LinkedIn.']
    : [];
$this->insert('partials::components/contact-cta', $speakingCta);
?>
