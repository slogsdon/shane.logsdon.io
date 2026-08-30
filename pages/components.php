<?php
$this->layout('partials::layouts/main', [
    'title' => 'Component Gallery',
    'description' => 'Live component gallery for the Shane Logsdon design system.',
    'url' => '/components/',
    'noindex' => true,
]);

$articles = (array) json_decode(file_get_contents('resources/data/articles-list.json'));
$activeArticles = array_filter($articles, fn($post) => !$post->archived);
$articleCount = count($activeArticles);
?>

<div class="mx-auto max-w-editorial px-6 pt-10 pb-16">
    <div class="running-head">
        <span>shane logsdon · component gallery</span>
        <span>v3 · <?= date('Y.m.d') ?></span>
    </div>

    <h1 class="mt-12 max-w-[18ch] font-display font-normal text-foreground"
        style="font-size: clamp(2.75rem, 7vw, 6rem); line-height: 1.0; letter-spacing: -0.02em;">
        Components, <span class="t-accent">distilled</span>.
    </h1>
    <p class="mt-8 max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
        The live site primitives and shared partials, rendered through the production stylesheet.
        Each specimen names the class or partial it exercises.
    </p>

    <div class="mt-16 space-y-24">
        <section aria-labelledby="labels-heading">
            <div class="border-t border-rule pt-6">
                <p class="smallcaps">primitives · .eyebrow · .smallcaps · .smallcaps-lg</p>
                <h2 id="labels-heading" class="mt-3 font-display text-3xl font-medium text-foreground">Editorial labels.</h2>
            </div>
            <div class="mt-8 grid gap-5 border-b border-rule pb-8">
                <p class="eyebrow">.eyebrow · 12px small caps</p>
                <p class="smallcaps">.smallcaps · 12px small caps</p>
                <p class="smallcaps-lg">.smallcaps-lg · 14px small caps</p>
            </div>
        </section>

        <section aria-labelledby="publication-heading">
            <div class="border-t border-rule pt-6">
                <p class="smallcaps">primitives · .wordmark · .folio · .running-head</p>
                <h2 id="publication-heading" class="mt-3 font-display text-3xl font-medium text-foreground">Publication conventions.</h2>
            </div>
            <div class="mt-8 space-y-8 border-b border-rule pb-8">
                <div class="flex flex-wrap items-baseline justify-between gap-6">
                    <span class="wordmark">.wordmark · Shane Logsdon</span>
                    <span class="wordmark wordmark--sm">.wordmark--sm · Shane Logsdon</span>
                </div>
                <div class="running-head">
                    <span>.running-head · working notes</span>
                    <span>2026.08.30</span>
                </div>
                <div class="flex flex-wrap items-baseline justify-between gap-6">
                    <span class="folio"><span>.folio · 2026.08.30</span><span class="pos">/ 001</span></span>
                    <span class="folio"><span>field notes</span><span class="pos">/ site</span></span>
                </div>
            </div>
        </section>

        <section aria-labelledby="actions-heading">
            <div class="border-t border-rule pt-6">
                <p class="smallcaps">primitive · .btn-arrow</p>
                <h2 id="actions-heading" class="mt-3 font-display text-3xl font-medium text-foreground">Arrow links only.</h2>
            </div>
            <div class="mt-8 flex flex-wrap items-baseline gap-x-10 gap-y-5 border-b border-rule pb-8">
                <a href="#gallery-end" class="btn-arrow">default · read the writing</a>
                <a href="#gallery-end" class="btn-arrow btn-arrow--accent">accent · request an audit</a>
                <a href="#gallery-end" class="btn-arrow btn-arrow--muted">muted · back to articles</a>
            </div>
            <div class="inversion mt-8 px-6 py-8">
                <p class="smallcaps">.inversion · links stay cream</p>
                <a href="#gallery-end" class="btn-arrow mt-4">on an inversion surface</a>
            </div>
        </section>

        <section aria-labelledby="list-heading">
            <div class="border-t border-rule pt-6">
                <p class="smallcaps">partials · index-strip · post-list</p>
                <h2 id="list-heading" class="mt-3 font-display text-3xl font-medium text-foreground">Ordered list components.</h2>
            </div>
            <div class="mt-8">
                <p class="smallcaps mb-3">partials::components::index-strip · articles</p>
                <?php $this->insert('partials::components/index-strip', [
                    'stripSlug' => 'articles',
                    'stripCount' => $articleCount,
                    'stripCurrent' => 'all',
                ]); ?>
                <p class="smallcaps mt-8 mb-3">partials::components::post-list · limit 1</p>
                <?php $this->insert('partials::components/post-list', [
                    'slug' => 'articles',
                    'limit' => 1,
                ]); ?>
                <p class="smallcaps mt-8 mb-3">partials::components::archive-list</p>
                <?php $this->insert('partials::components/archive-list'); ?>
            </div>
        </section>

        <section aria-labelledby="content-heading">
            <div class="border-t border-rule pt-6">
                <p class="smallcaps">partials · audit-form · author-bio · contact-cta</p>
                <h2 id="content-heading" class="mt-3 font-display text-3xl font-medium text-foreground">Site-wide shared blocks.</h2>
            </div>
            <div class="mt-8 space-y-16">
                <div>
                    <p class="smallcaps mb-3">partials::components::audit-form</p>
                    <?php $this->insert('partials::components/audit-form'); ?>
                </div>
                <div>
                    <p class="smallcaps mb-3">partials::components::author-bio</p>
                    <?php $this->insert('partials::components/author-bio'); ?>
                </div>
            </div>
        </section>

        <section aria-labelledby="sheet-heading">
            <div class="border-t border-rule pt-6">
                <p class="smallcaps">primitives · .sheet · .title-block · .callout</p>
                <h2 id="sheet-heading" class="mt-3 font-display text-3xl font-medium text-foreground">Sheet apparatus.</h2>
            </div>
            <div class="sheet mt-8">
                <div class="sheet__field">
                    <p class="smallcaps-lg">.sheet__field · specimen sheet</p>
                    <p class="mt-4 max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                        A field carries one page state and its title block admits when that state was last true.
                        A <span class="callout">1</span> callout stays round because it points back to a drawing.
                    </p>
                    <div class="mt-8">
                        <p class="smallcaps mb-3">partials::components::title-block</p>
                        <?php $this->insert('partials::components/title-block', [
                            'sheetNo' => 'C-01',
                            'sheetFile' => 'pages/components.php',
                            'sheetTitle' => 'live component gallery',
                            'sheetMeta' => 'Rendered through the live site stylesheet.',
                        ]); ?>
                    </div>
                </div>
            </div>
        </section>

        <section aria-labelledby="drawing-heading">
            <div class="border-t border-rule pt-6">
                <p class="smallcaps">primitives · .figure-plate · .figcaption · drawing classes</p>
                <h2 id="drawing-heading" class="mt-3 font-display text-3xl font-medium text-foreground">A figure earns its plate.</h2>
            </div>
            <figure class="mt-8">
                <div class="figure-plate">
                    <svg width="640" height="180" viewBox="0 0 640 180" role="img" aria-label="A one-pixel line drawing with an annotation callout.">
                        <line x1="12" y1="36" x2="628" y2="36" class="s-ink" />
                        <rect x="80" y="70" width="220" height="60" class="s-edge" fill="var(--color-surface-muted)" />
                        <line x1="300" y1="100" x2="520" y2="100" class="s-rule" />
                        <circle cx="540" cy="100" r="12" class="s-mark" />
                        <text x="540" y="104" text-anchor="middle" class="t-mono f-mark">1</text>
                        <text x="12" y="162" class="t-mono f-3">.figure-plate · .s-ink · .s-edge · .s-mark · .f-mark</text>
                    </svg>
                </div>
                <figcaption class="figcaption"><b>.figcaption</b> Source: component specimen, read 2026.08.30.</figcaption>
            </figure>
        </section>

        <section aria-labelledby="assembly-heading">
            <div class="border-t border-rule pt-6">
                <p class="smallcaps">primitive · .assembly · .assembly__step</p>
                <h2 id="assembly-heading" class="mt-3 font-display text-3xl font-medium text-foreground">Assembly order.</h2>
            </div>
            <ol class="assembly mt-8">
                <li class="assembly__step">
                    <span class="assembly__num" aria-hidden="true">01</span>
                    <h3 class="font-display text-xl font-medium text-foreground">Name the request.</h3>
                    <p class="mt-2 max-w-prose text-[1rem] leading-relaxed text-muted-foreground">The first step states what the reader is looking at.</p>
                </li>
                <li class="assembly__step">
                    <span class="assembly__num" aria-hidden="true">02</span>
                    <h3 class="font-display text-xl font-medium text-foreground">Show the apparatus.</h3>
                    <p class="mt-2 max-w-prose text-[1rem] leading-relaxed text-muted-foreground">The next step adds only the detail that makes the work legible.</p>
                </li>
            </ol>
        </section>

        <section id="gallery-end" aria-labelledby="prose-heading">
            <div class="border-t border-rule pt-6">
                <p class="smallcaps">primitive · .prose</p>
                <h2 id="prose-heading" class="mt-3 font-display text-3xl font-medium text-foreground">Prose in register.</h2>
            </div>
            <div class="prose mt-8 max-w-prose border-b border-rule pb-8">
                <p>This is the body measure. It keeps the reader in a 64ch column and gives every sentence enough air to be read at publication scale.</p>
                <h3>A subsection stays quiet.</h3>
                <p>Links remain underlined, <a href="#gallery-end">code names stay technical</a>, and lists preserve their own rhythm.</p>
                <ul>
                    <li>Body text uses IBM Plex Sans.</li>
                    <li>Display text uses Fraunces.</li>
                </ul>
                <blockquote>Flat hierarchy comes from type, accent, and whitespace.</blockquote>
            </div>
        </section>
    </div>
</div>

<?php $this->insert('partials::components/contact-cta', [
    'ctaEyebrow' => 'Gallery',
    'ctaTitle' => 'The system stays legible in use.',
    'ctaBody' => 'Shared primitives carry the same rules across pages, artifacts, and responsive states.',
]); ?>

<?php $this->insert('partials::components/newsletter', [
    'kitFormId' => 'components-gallery',
]); ?>
