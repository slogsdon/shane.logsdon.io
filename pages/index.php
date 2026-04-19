<?php
$settings = require('resources/settings.php');
$this->layout('partials::layouts/main', [
    'title' => null,
    'description' => 'Technical product leader building developer-first experiences for payment systems. Writing, speaking, and notes from the field.',
    'url' => '/',
]);
$articles = (array)json_decode(file_get_contents('resources/data/articles-list.json'));
$activeArticles = array_filter($articles, fn($p) => !$p->archived);
$articleCount = count($activeArticles);
?>

<!-- HERO -->
<section class="relative overflow-hidden border-b border-rule">
    <div class="grid-paper absolute inset-0" style="opacity:0.6;" aria-hidden="true"></div>
    <div class="pointer-events-none absolute inset-x-0 top-0 h-px" style="background:hsl(var(--rule-strong));" aria-hidden="true"></div>

    <div class="relative mx-auto max-w-editorial px-6 pb-24 pt-20 sm:pb-32 sm:pt-28">
        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12 sm:col-span-3">
                <p class="eyebrow">
                    <span style="color:hsl(var(--foreground)/0.4)">§</span> 01 / Profile
                </p>
                <p class="mt-3 font-mono text-[0.72rem] uppercase tracking-[0.18em] text-muted-foreground">
                    Louisville, KY
                </p>
            </div>

            <div class="col-span-12 sm:col-span-9">
                <p class="eyebrow mb-6">Shane Logsdon · est. 2008</p>
                <h1 class="font-display text-4xl font-normal leading-[1.05] tracking-tight text-foreground sm:text-6xl md:text-7xl">
                    Technical product leader,<br>
                    <span class="italic" style="color:hsl(var(--ink-soft))">building developer-first experiences</span><br>
                    for payment systems.
                </h1>

                <div class="mt-10 grid grid-cols-1 gap-8 sm:grid-cols-12 sm:gap-6">
                    <p class="col-span-1 max-w-prose text-base leading-relaxed text-muted-foreground sm:col-span-7 sm:text-[1.05rem]">
                        Fifteen-plus years at the intersection of fintech and developer tooling: designing payment APIs, scaling platform infrastructure, and turning complex financial primitives into products engineers actually want to build on.
                    </p>
                    <div class="col-span-1 sm:col-span-5">
                        <ul class="space-y-3 border-l border-rule pl-5">
                            <li class="flex items-baseline justify-between gap-4">
                                <span class="font-mono text-[0.68rem] uppercase tracking-[0.18em] text-muted-foreground">Focus</span>
                                <span class="text-sm text-foreground">Payments · DevEx · Platforms</span>
                            </li>
                            <li class="flex items-baseline justify-between gap-4">
                                <span class="font-mono text-[0.68rem] uppercase tracking-[0.18em] text-muted-foreground">Writing</span>
                                <a href="/articles/" class="link-quiet text-sm"><?= $articleCount ?> articles</a>
                            </li>
                            <li class="flex items-baseline justify-between gap-4">
                                <span class="font-mono text-[0.68rem] uppercase tracking-[0.18em] text-muted-foreground">Status</span>
                                <span class="inline-flex items-center gap-2 text-sm text-foreground">
                                    <span class="inline-block h-1.5 w-1.5 rounded-full bg-foreground" aria-hidden="true"></span>
                                    Open to conversations
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="mt-12 flex flex-wrap items-center gap-x-8 gap-y-3">
                    <a href="/about/" class="link-arrow">Read about Shane <span class="arrow">→</span></a>
                    <a href="/articles/" class="link-arrow text-muted-foreground hover:text-foreground">Browse writing <span class="arrow">→</span></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FEATURED ARTICLES -->
<section class="mx-auto max-w-editorial px-6 pt-20">
    <header class="mb-10 flex items-end justify-between gap-6 border-b border-rule pb-6">
        <div>
            <p class="eyebrow">02 / Selected writing</p>
            <h2 class="mt-2 font-display text-3xl font-medium tracking-tight text-foreground sm:text-4xl">
                Featured articles
            </h2>
        </div>
        <a href="/articles/" class="link-arrow hidden sm:inline-flex">All articles <span class="arrow">→</span></a>
    </header>

    <?php $this->insert('partials::components/post-list', [
        'slug' => 'articles',
        'limit' => 3,
    ]); ?>
    <div class="border-t border-rule"></div>

    <div class="mt-8 sm:hidden">
        <a href="/articles/" class="link-arrow">All articles <span class="arrow">→</span></a>
    </div>
</section>

<?php $this->insert('partials::components/contact-cta'); ?>
