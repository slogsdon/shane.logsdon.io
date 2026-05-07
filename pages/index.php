<?php
$settings = require('resources/settings.php');
$this->layout('partials::layouts/main', [
    'title' => null,
    'description' => 'Shane Logsdon, developer advocate at Global Payments and builder of web presence systems for local business owners. Writing on fintech, developer tooling, and AI.',
    'url' => '/',
]);
$articles = (array)json_decode(file_get_contents('resources/data/articles-list.json'));
$activeArticles = array_filter($articles, fn($p) => !$p->archived);
$articleCount = count($activeArticles);
?>

<!-- HERO -->
<section class="relative overflow-hidden">
    <div class="grid-paper absolute inset-0" style="opacity:0.55;" aria-hidden="true"></div>

    <div class="relative mx-auto max-w-editorial px-6 pb-32 pt-20 sm:pt-28">
        <div class="running-head" aria-hidden="true">
            <span>shane logsdon &middot; field notes</span>
            <span data-locale-tz="America/Kentucky/Louisville">louisville &middot; <span data-locale-offset>gmt&minus;5</span></span>
        </div>

        <h1 class="mt-12 max-w-[18ch] font-display font-normal text-foreground"
            style="font-size: clamp(3rem, 9vw, 7.5rem); line-height: 0.98; letter-spacing: -0.022em;">
            Systems that get <span class="t-accent">found</span>.
        </h1>

        <div class="mt-16 grid grid-cols-1 gap-12 sm:grid-cols-12 sm:gap-8">
            <p class="col-span-1 max-w-prose text-[1.1875rem] leading-[1.6] text-ink-soft sm:col-span-7">
                I lead developer advocacy at Global Payments, building developer experience infrastructure at enterprise scale. I apply the same approach to local business web presence: done-for-you builds and ongoing management for owners who don&rsquo;t have time to figure it out themselves.
            </p>
        </div>

        <div class="mt-16 flex flex-wrap items-baseline gap-x-10 gap-y-4">
            <a href="/contact/" class="btn-arrow btn-arrow--accent">Request a free audit</a>
            <a href="/articles/" class="btn-arrow btn-arrow--muted">Read the writing</a>
        </div>
    </div>
</section>

<!-- FEATURED ARTICLES -->
<section class="mx-auto max-w-editorial px-6 pt-24">
    <header class="mb-10 flex items-baseline justify-between gap-6 border-t border-rule pt-6">
        <div>
            <p class="smallcaps">selected writing</p>
            <h2 class="mt-3 font-display text-3xl font-medium tracking-tight text-foreground sm:text-4xl">
                Featured articles
            </h2>
        </div>
        <a href="/articles/" class="btn-arrow hidden sm:inline">All articles</a>
    </header>

    <?php $this->insert('partials::components/post-list', [
        'slug' => 'articles',
        'limit' => 3,
    ]); ?>
    <div class="hairline"></div>

    <div class="mt-8 sm:hidden">
        <a href="/articles/" class="btn-arrow">All articles</a>
    </div>

    <div class="mt-24 mb-12 flex items-baseline justify-end">
        <span class="folio">
            <span><?= date('Y.m.d') ?></span>
            <span class="pos">/ 001</span>
        </span>
    </div>
</section>

<?php $this->insert('partials::components/contact-cta'); ?>

<script>
(function () {
    var host = document.querySelector('[data-locale-tz]');
    var target = host && host.querySelector('[data-locale-offset]');
    if (!host || !target) return;
    try {
        var parts = new Intl.DateTimeFormat('en-US', {
            timeZone: host.dataset.localeTz,
            timeZoneName: 'shortOffset'
        }).formatToParts(new Date());
        var name = parts.find(function (p) { return p.type === 'timeZoneName'; });
        if (name && name.value) target.textContent = name.value.toLowerCase();
    } catch (e) {}
})();
</script>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Person",
  "@id": "https://shane.logsdon.io/#Person",
  "name": "Shane Logsdon",
  "url": "https://shane.logsdon.io",
  "jobTitle": "Senior Director, Developer Advocacy",
  "worksFor": { "@type": "Organization", "name": "Global Payments" },
  "sameAs": [
    "https://www.linkedin.com/in/shanelogsdon",
    "https://github.com/slogsdon",
    "https://x.com/shanelogsdon"
  ],
  "knowsAbout": ["Developer Advocacy", "Payment APIs", "SDK Design", "AEO", "Web Presence Management", "Fintech"]
}
</script>
