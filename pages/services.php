<?php
$this->layout('partials::layouts/main', [
    'title' => 'Web Presence Systems for Local Business Owners',
    'description' => 'Done-for-you web presence: website build, conversion optimization, and ongoing AEO/SEO management. Built and managed by a practitioner who does this at enterprise scale.',
    'url' => '/services/',
    'image' => 'og-default.png',
    'imageAlt' => 'Shane Logsdon — web presence systems',
]);

$faqs = [
    [
        'q' => 'What\'s included in the monthly retainer?',
        'a' => 'AEO/SEO content updates, Google Business Profile posts, citation management, schema markup maintenance, AI search visibility monitoring, and a monthly report. The point is that your presence keeps improving after launch instead of decaying.',
    ],
    [
        'q' => 'How is this different from hiring a local web designer?',
        'a' => 'Most web designers build once and disappear. This is an actively managed system. The build is the starting point, not the deliverable. The ongoing retainer is where the work actually compounds.',
    ],
    [
        'q' => 'Why can\'t I just use Wix or Squarespace?',
        'a' => 'You can, and they\'re fine for a digital business card. The gap shows up in search visibility. DIY platforms underperform on page speed, schema markup, and AEO optimization. If you want to be found before your competitors, the technical foundation matters.',
    ],
    [
        'q' => 'How long until I see results in search?',
        'a' => 'Honest answer: three to six months for meaningful organic movement. Google Business Profile improvements can show up faster, sometimes within weeks. The compounding nature of this work means the question shifts over time from "when will I see results" to "why are my competitors still behind."',
    ],
    [
        'q' => 'Do I need to be involved on an ongoing basis?',
        'a' => 'Minimally. Monthly check-ins to review the report and flag anything changing in your business. The operational work (content updates, GBP posts, citations) is handled. You stay focused on running the business.',
    ],
    [
        'q' => 'What does AEO mean and why does it matter?',
        'a' => 'Answer Engine Optimization. As AI search tools (ChatGPT, Perplexity, Google AI Overviews) become the first stop for local search queries, the question is whether your business shows up in those answers. AEO is the practice of structuring your content so AI systems can find, interpret, and cite you accurately. Traditional SEO still matters. AEO is what comes next.',
    ],
];
?>

<!-- Hero -->
<section class="mx-auto max-w-editorial px-6 pt-20 pb-20">
    <div class="running-head" aria-hidden="true">
        <span>shane logsdon &middot; services</span>
        <span><?= date('Y.m.d') ?></span>
    </div>
    <h1 class="mt-12 max-w-[22ch] font-display font-normal text-foreground"
        style="font-size: clamp(2.5rem, 6.5vw, 5.5rem); line-height: 1.02; letter-spacing: -0.02em;">
        A web presence system that actively works to get you <span class="t-accent">found</span>.
    </h1>
    <div class="mt-10 flex flex-wrap items-baseline gap-x-6 gap-y-3">
        <a href="/contact/" class="btn-arrow btn-arrow--accent">Request a free audit</a>
        <p class="text-sm text-muted-foreground">Free. No obligation. Takes about 48 hours.</p>
    </div>
</section>

<!-- Quick answer -->
<section class="mx-auto max-w-editorial px-6 pb-20">
    <div class="grid grid-cols-12 gap-6 border-t border-rule pt-12">
        <div class="col-span-12 sm:col-span-3">
            <p class="smallcaps-lg">what this is</p>
        </div>
        <div class="col-span-12 space-y-5 sm:col-span-9">
            <p class="max-w-prose text-[1.1875rem] leading-[1.6] text-foreground">
                I build done-for-you web presence systems for local business owners: website design and build, conversion-optimized from the start, paired with ongoing AEO and SEO management so your presence improves over time.
            </p>
            <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                Most web services build once and disappear. The site goes live, the designer moves on, and the owner is left hoping search traffic materializes on its own. It usually doesn't. The gap between a site that exists and a site that actively brings in clients is active management, updated content, and the technical groundwork that search and AI systems look for.
            </p>
            <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                This is both of those things, together, from one person who does this at enterprise scale at a global payments company.
            </p>
        </div>
    </div>
</section>

<!-- What's included -->
<section class="mx-auto max-w-editorial px-6 pb-20">
    <div class="grid grid-cols-12 gap-6 border-t border-rule pt-12">
        <div class="col-span-12 sm:col-span-3">
            <p class="smallcaps-lg">what's included</p>
        </div>
        <div class="col-span-12 sm:col-span-9">
            <ol class="grid grid-cols-1">
                <li class="grid grid-cols-12 gap-6 border-t border-rule py-8">
                    <p class="folio col-span-12 sm:col-span-2"><span class="pos">01</span></p>
                    <div class="col-span-12 sm:col-span-10">
                        <h3 class="font-display text-xl font-medium text-foreground">Website build</h3>
                        <p class="mt-2 max-w-prose text-[1rem] leading-relaxed text-muted-foreground">Design, development, and conversion-optimized copy. Mobile-first, fast load, basic schema markup, Google Business Profile setup and optimization, and sitemap submission. Built to rank, not just to exist.</p>
                    </div>
                </li>
                <li class="grid grid-cols-12 gap-6 border-t border-rule py-8">
                    <p class="folio col-span-12 sm:col-span-2"><span class="pos">02</span></p>
                    <div class="col-span-12 sm:col-span-10">
                        <h3 class="font-display text-xl font-medium text-foreground">Monthly retainer</h3>
                        <p class="mt-2 max-w-prose text-[1rem] leading-relaxed text-muted-foreground">AEO/SEO content updates, GBP posts, citation management, schema maintenance, AI search visibility monitoring, and a monthly report. The retainer is where the compounding happens. A presence that's actively maintained outperforms one that was built well but left alone.</p>
                    </div>
                </li>
            </ol>
        </div>
    </div>
</section>

<!-- Who it's for -->
<section class="mx-auto max-w-editorial px-6 pb-20">
    <div class="grid grid-cols-12 gap-6 border-t border-rule pt-12">
        <div class="col-span-12 sm:col-span-3">
            <p class="smallcaps-lg">who this is for</p>
        </div>
        <div class="col-span-12 space-y-5 sm:col-span-9">
            <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                Professional services solo operators and owner-operated service businesses. The kind of owner who's good at their trade and has no interest in becoming a part-time digital marketer to keep the phone ringing.
            </p>
            <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                This isn't the right fit for e-commerce, franchise operations, or businesses that want to build and manage their own presence. It's for owners who want to hand it off and get back to work.
            </p>
            <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                Based in Louisville? See how this works for
                <a class="link-quiet" href="/local-businesses/">local businesses in the Louisville metro</a>.
            </p>
        </div>
    </div>
</section>

<!-- Why it's different -->
<section class="mx-auto max-w-editorial px-6 pb-20">
    <div class="grid grid-cols-12 gap-6 border-t border-rule pt-12">
        <div class="col-span-12 sm:col-span-3">
            <p class="smallcaps-lg">why it's different</p>
        </div>
        <div class="col-span-12 space-y-5 sm:col-span-9">
            <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                The work is informed by developer relations and AEO practice at enterprise scale. When I build schema markup or optimize for AI search visibility, I'm drawing on the same techniques used to make payment API documentation rank and get cited accurately in developer tooling searches.
            </p>
            <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                Most local web designers don't think about answer engines. Most SEO agencies don't have a technical background deep enough to execute at the infrastructure level. This sits at that intersection.
            </p>
            <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                And it's actively managed, not handed off. That's the one thing that separates a presence that improves from one that slowly decays.
            </p>
        </div>
    </div>
</section>

<!-- Proof -->
<?php
// Real client quotes go here as they come in; the block below renders only when populated.
// Shape: ['quote' => '...', 'attribution' => 'Name, Business, Louisville'].
$proofQuotes = [];
?>
<section class="mx-auto max-w-editorial px-6 pb-20">
    <div class="grid grid-cols-12 gap-6 border-t border-rule pt-12">
        <div class="col-span-12 sm:col-span-3">
            <p class="smallcaps-lg">proof</p>
        </div>
        <div class="col-span-12 space-y-8 sm:col-span-9">
            <div>
                <h3 class="font-display text-xl font-medium text-foreground">The practitioner's own site</h3>
                <p class="mt-3 max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                    This site runs the same playbook I sell. A July 2026 rebuild and full AEO/SEO audit put the fixes into production and set up monthly tracking of index coverage and AI-answer visibility.
                </p>
                <dl class="mt-6 grid grid-cols-2 gap-x-6 gap-y-6 sm:grid-cols-3">
                    <div>
                        <dt class="folio">duplicate meta descriptions</dt>
                        <dd class="mt-1 font-display text-3xl font-medium text-foreground">40 &rarr; 0</dd>
                    </div>
                    <div>
                        <dt class="folio">pages with a resolving author identity</dt>
                        <dd class="mt-1 font-display text-3xl font-medium text-foreground">2 &rarr; every page</dd>
                    </div>
                    <div>
                        <dt class="folio">custom security headers</dt>
                        <dd class="mt-1 font-display text-3xl font-medium text-foreground">0 &rarr; full set</dd>
                    </div>
                </dl>
                <p class="mt-4 text-sm text-muted-foreground">I track search-index and AI-citation results monthly and publish them as they land.</p>
            </div>
            <?php if (!empty($proofQuotes)): ?>
            <ul class="space-y-6">
                <?php foreach ($proofQuotes as $q): ?>
                <li class="border-l-2 border-rule pl-5">
                    <p class="max-w-prose text-[1.0625rem] italic leading-relaxed text-foreground">&ldquo;<?= htmlspecialchars($q['quote']) ?>&rdquo;</p>
                    <p class="mt-2 folio"><?= htmlspecialchars($q['attribution']) ?></p>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="mx-auto max-w-editorial px-6 pb-20">
    <div class="grid grid-cols-12 gap-6 border-t border-rule pt-12">
        <div class="col-span-12 sm:col-span-3">
            <p class="smallcaps-lg">questions</p>
        </div>
        <div class="col-span-12 sm:col-span-9">
            <ol class="grid grid-cols-1">
                <?php foreach ($faqs as $i => $faq): ?>
                <li class="border-t border-rule py-8">
                    <h3 class="font-display text-lg font-medium text-foreground"><?= htmlspecialchars($faq['q']) ?></h3>
                    <p class="mt-3 max-w-prose text-[1rem] leading-relaxed text-muted-foreground"><?= htmlspecialchars($faq['a']) ?></p>
                </li>
                <?php endforeach; ?>
            </ol>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="relative mx-auto max-w-editorial px-6 pb-24">
    <div class="grid grid-cols-12 gap-6 border-t border-rule pt-12">
        <div class="col-span-12 sm:col-span-3">
            <p class="smallcaps-lg">get started</p>
        </div>
        <div class="col-span-12 sm:col-span-9">
            <h2 class="max-w-prose font-display text-3xl font-medium leading-tight text-foreground sm:text-4xl">
                Let's look at your current presence.
            </h2>
            <p class="mt-5 max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                I'll review your Google Business Profile and web presence and show you exactly what's working, what's missing, and what it's likely costing you in lost search traffic.
            </p>
            <div class="mt-8 flex flex-wrap items-baseline gap-x-6 gap-y-3">
                <a href="/contact/" class="btn-arrow btn-arrow--accent">Request a free audit</a>
                <p class="text-sm text-muted-foreground">Free. No obligation. Takes about 48 hours.</p>
            </div>
        </div>
    </div>
</section>

<script type="application/ld+json">
<?= json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'ProfessionalService',
    '@id' => 'https://shane.logsdon.io/services/#ProfessionalService',
    'name' => 'Web Presence Systems for Local Business Owners',
    'url' => 'https://shane.logsdon.io/services/',
    'description' => 'Done-for-you web presence: website build, conversion optimization, and ongoing AEO/SEO management for local business owners, built and managed by a practitioner who does this at enterprise scale.',
    'provider' => ['@id' => 'https://shane.logsdon.io/#Person'],
    'areaServed' => [
        ['@type' => 'City', 'name' => 'Louisville', 'sameAs' => 'https://en.wikipedia.org/wiki/Louisville,_Kentucky'],
        ['@type' => 'AdministrativeArea', 'name' => 'Louisville metropolitan area'],
    ],
    'address' => [
        '@type' => 'PostalAddress',
        'addressLocality' => 'Louisville',
        'addressRegion' => 'KY',
        'addressCountry' => 'US',
    ],
    'priceRange' => '$$',
    'serviceType' => ['Web design and development', 'Answer Engine Optimization', 'Search Engine Optimization', 'Web presence management'],
], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) ?>
</script>

<script type="application/ld+json">
<?= json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'FAQPage',
    'mainEntity' => array_map(fn($faq) => [
        '@type' => 'Question',
        'name' => $faq['q'],
        'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq['a']],
    ], $faqs),
], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) ?>
</script>
