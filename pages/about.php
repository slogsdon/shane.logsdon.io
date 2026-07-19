<?php
$this->layout('partials::layouts/main', [
    'title' => 'About',
    'description' => 'Technical product leader with 15+ years at the intersection of fintech and developer tooling. Leads developer advocacy at Global Payments. Also builds web presence systems for local businesses.',
    'url' => '/about/',
]);
$settings = require('resources/settings.php');

$expertise = [
    ['num' => '01', 'title' => 'Payment systems',     'body' => 'Designing scalable payment processing infrastructure with reliability, security, and compliance as first-class concerns.'],
    ['num' => '02', 'title' => 'Developer platforms', 'body' => 'Building APIs and SDKs that prioritize developer experience: clear contracts, honest errors, and short paths to first success.'],
    ['num' => '03', 'title' => 'Product leadership',  'body' => 'Translating complex financial capabilities into developer platforms that drive adoption and durable revenue.'],
    ['num' => '04', 'title' => 'Technical leadership','body' => 'Leading engineering teams, setting architecture direction, and bridging business strategy with implementation.'],
];
?>

<!-- Page header -->
<section class="mx-auto max-w-editorial px-6 pt-20 pb-16">
    <div class="running-head" aria-hidden="true">
        <span>shane logsdon &middot; about</span>
        <span><?= date('Y.m.d') ?></span>
    </div>
    <h1 class="mt-12 max-w-[20ch] font-display font-normal text-foreground"
        style="font-size: clamp(2.75rem, 7vw, 6rem); line-height: 1.0; letter-spacing: -0.02em;">
        A technical product leader writing <span class="t-accent">developer-first</span> software for the payments stack.
    </h1>
</section>

<!-- Background -->
<section class="mx-auto max-w-editorial px-6 pt-12">
    <div class="grid grid-cols-12 gap-6 border-t border-rule pt-12">
        <div class="col-span-12 sm:col-span-3">
            <p class="smallcaps-lg">background</p>
        </div>
        <div class="col-span-12 space-y-6 sm:col-span-9">
            <p class="max-w-prose text-[1.1875rem] leading-[1.6] text-foreground">
                For more than a decade I&rsquo;ve worked at the intersection of financial technology and
                developer tooling, helping companies build and scale the payment infrastructure and
                platforms that quietly move billions of dollars.
            </p>
            <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                My focus is on systems that have to be both correct and humane: payment APIs that
                behave under load, developer experiences that respect the engineer&rsquo;s time, and
                product strategy that holds up to scrutiny from finance, security, and the people
                actually integrating the thing.
            </p>
            <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                I combine deep technical context with product judgment. Whether the work is shaping
                an API surface, untangling a payment flow, or aligning a roadmap with regulatory
                reality, I optimize for clarity, reliability, and adoption, in that order.
            </p>
        </div>
    </div>
</section>

<!-- Areas of expertise -->
<section class="mx-auto max-w-editorial px-6 pt-24">
    <div class="grid grid-cols-12 gap-6 border-t border-rule pt-12">
        <div class="col-span-12 sm:col-span-3">
            <p class="smallcaps-lg">areas of expertise</p>
        </div>
        <div class="col-span-12 sm:col-span-9">
            <ul class="grid grid-cols-1 sm:grid-cols-2">
                <?php foreach ($expertise as $i => $item):
                    $border = '';
                    if ($i >= 2) { $border .= ' sm:border-t sm:border-rule sm:pt-8'; }
                    if ($i === 1 || $i === 3) { $border .= ' sm:border-l sm:border-rule sm:pl-8'; }
                ?>
                <li class="py-6 sm:py-8<?= $border ?>">
                    <p class="folio"><span class="pos"><?= $item['num'] ?></span></p>
                    <h3 class="mt-3 font-display text-xl font-medium text-foreground"><?= htmlspecialchars($item['title']) ?></h3>
                    <p class="mt-2 max-w-prose text-[0.95rem] leading-relaxed text-muted-foreground"><?= htmlspecialchars($item['body']) ?></p>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</section>

<!-- Currently -->
<section class="mx-auto max-w-editorial px-6 pt-24 pb-12">
    <div class="grid grid-cols-12 gap-6 border-t border-rule pt-12">
        <div class="col-span-12 sm:col-span-3">
            <p class="smallcaps-lg">currently</p>
        </div>
        <div class="col-span-12 space-y-4 sm:col-span-9">
            <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                Building, advising, and writing about developer-first payment products. Most days
                that means thinking about API ergonomics, integration journeys, and what it takes to
                make complex financial primitives feel inevitable to the engineers using them.
            </p>
            <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                I also run a small practice building and managing web presence systems for local
                business owners: website build, AEO/SEO, and ongoing management. The technical
                foundation is the same as enterprise work. The audience is different.
            </p>
            <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                I keep a small but steady stream of writing in
                <a class="link-quiet" href="/articles/">Articles</a>
                and notes from talks in
                <a class="link-quiet" href="/speaking/">Speaking</a>.
            </p>
        </div>
    </div>
</section>

<?php $this->insert('partials::components/contact-cta', [
    'ctaEyebrow' => 'Let\'s talk',
    'ctaTitle'   => 'Open to conversations on payments, platforms, product, and local web presence.',
    'ctaBody'    => 'I enjoy comparing notes with operators building serious developer products. The best place to start a conversation is LinkedIn.',
]); ?>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ProfilePage",
  "dateCreated": "2024-12-19",
  "dateModified": "<?= date('Y-m-d') ?>",
  "mainEntity": {
    "@type": "Person",
    "@id": "https://shane.logsdon.io/#Person",
    "name": "Shane Logsdon",
    "url": "https://shane.logsdon.io/about/",
    "jobTitle": "Senior Director, Product Management – Developer Advocacy",
    "worksFor": { "@type": "Organization", "name": "Global Payments" },
    "image": {
        "@type": "ImageObject",
        "@id": "https://shane.logsdon.io/images/headshot.jpeg",
        "url": "https://shane.logsdon.io/images/headshot.jpeg",
        "height": "2827",
        "width": "1887"
    },
    "alternateName": "slogsdon",
    "description": "<?= htmlspecialchars($settings->author->shane->description) ?>",
    "sameAs": [
        "https://github.com/slogsdon",
        "https://www.linkedin.com/in/shanelogsdon",
        "https://x.com/shanelogsdon",
        "https://bsky.app/profile/shane.logsdon.io",
        "https://gitlab.com/slogsdon",
        "https://speakerdeck.com/slogsdon"
    ],
    "knowsAbout": ["Developer Advocacy", "Payment APIs", "SDK Design", "AEO", "Web Presence Management", "Fintech"]
  }
}
</script>
