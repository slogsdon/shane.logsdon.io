<?php
$this->layout('partials::layouts/main', [
    'title' => 'About',
    'description' => 'Technical product leader with 15+ years building developer-first experiences for payment systems and fintech infrastructure.',
    'url' => '/about/',
]);
$settings = require('resources/settings.php');

$expertise = [
    ['num' => '01', 'title' => 'Payment systems',    'body' => 'Designing scalable payment processing infrastructure with reliability, security, and compliance as first-class concerns.'],
    ['num' => '02', 'title' => 'Developer platforms', 'body' => 'Building APIs and SDKs that prioritize developer experience — clear contracts, honest errors, and short paths to first success.'],
    ['num' => '03', 'title' => 'Product leadership',  'body' => 'Translating complex financial capabilities into developer platforms that drive adoption and durable revenue.'],
    ['num' => '04', 'title' => 'Technical leadership', 'body' => 'Leading engineering teams, setting architecture direction, and bridging business strategy with implementation.'],
];
?>

<!-- Page header -->
<section class="mx-auto max-w-editorial px-6 pb-12 pt-20">
    <p class="eyebrow">§ About</p>
    <h1 class="mt-4 max-w-4xl font-display text-4xl font-normal leading-[1.08] tracking-tight text-foreground sm:text-6xl">
        A technical product leader,<br>
        <span class="italic" style="color:hsl(var(--ink-soft))">writing developer-first software</span><br>
        for the payments stack.
    </h1>
</section>

<!-- Background -->
<section class="mx-auto max-w-editorial px-6">
    <div class="grid grid-cols-12 gap-6 border-t border-rule pt-12">
        <div class="col-span-12 sm:col-span-3">
            <p class="eyebrow">Background</p>
        </div>
        <div class="col-span-12 space-y-6 sm:col-span-9">
            <p class="max-w-prose text-lg leading-relaxed text-foreground">
                For more than a decade I&rsquo;ve worked at the intersection of financial technology and
                developer tooling &mdash; helping companies build and scale the payment infrastructure and
                platforms that quietly move billions of dollars.
            </p>
            <p class="max-w-prose text-base leading-relaxed text-muted-foreground">
                My focus is on systems that have to be both correct and humane: payment APIs that
                behave under load, developer experiences that respect the engineer&rsquo;s time, and
                product strategy that holds up to scrutiny from finance, security, and the people
                actually integrating the thing.
            </p>
            <p class="max-w-prose text-base leading-relaxed text-muted-foreground">
                I combine deep technical context with product judgment. Whether the work is shaping
                an API surface, untangling a payment flow, or aligning a roadmap with regulatory
                reality, I optimize for clarity, reliability, and adoption &mdash; in that order.
            </p>
        </div>
    </div>
</section>

<!-- Areas of expertise -->
<section class="mx-auto max-w-editorial px-6 pt-20">
    <div class="grid grid-cols-12 gap-6 border-t border-rule pt-12">
        <div class="col-span-12 sm:col-span-3">
            <p class="eyebrow">Areas of expertise</p>
        </div>
        <div class="col-span-12 sm:col-span-9">
            <ul class="grid grid-cols-1 gap-px overflow-hidden border border-rule sm:grid-cols-2" style="background:hsl(var(--rule));">
                <?php foreach ($expertise as $item): ?>
                <li class="bg-background p-6 sm:p-8">
                    <p class="font-mono text-[0.7rem] uppercase tracking-[0.18em] text-muted-foreground"><?= $item['num'] ?></p>
                    <h3 class="mt-3 font-display text-xl font-medium text-foreground"><?= htmlspecialchars($item['title']) ?></h3>
                    <p class="mt-2 max-w-prose text-[0.95rem] leading-relaxed text-muted-foreground"><?= htmlspecialchars($item['body']) ?></p>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</section>

<!-- Currently -->
<section class="mx-auto max-w-editorial px-6 pt-20">
    <div class="grid grid-cols-12 gap-6 border-t border-rule pt-12">
        <div class="col-span-12 sm:col-span-3">
            <p class="eyebrow">Currently</p>
        </div>
        <div class="col-span-12 space-y-4 sm:col-span-9">
            <p class="max-w-prose text-base leading-relaxed text-muted-foreground">
                Building, advising, and writing about developer-first payment products. Most days
                that means thinking about API ergonomics, integration journeys, and what it takes to
                make complex financial primitives feel inevitable to the engineers using them.
            </p>
            <p class="max-w-prose text-base leading-relaxed text-muted-foreground">
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
    'ctaTitle'   => 'Open to conversations on payments, platforms, and product.',
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
    "@id": "https://shane.logsdon.io/about/#Person",
    "name": "Shane Logsdon",
    "url": "https://shane.logsdon.io/about/",
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
        "https://www.linkedin.com/in/shanelogsdon",
        "https://github.com/slogsdon",
        "https://twitter.com/shanelogsdon"
    ]
  }
}
</script>
