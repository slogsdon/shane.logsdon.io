<?php
$this->layout('partials::layouts/main', [
    'title' => $title,
    'slug' => $slug,
    'url' => sprintf('/%s/', $slug),
    'description' => $description ?? null,
    'image' => $image ?? null,
    'imageAlt' => $imageAlt ?? null,
]);

$allPosts = (array)json_decode(file_get_contents(sprintf('resources/data/%s-list.json', $slug)));
$activePosts = array_filter($allPosts, fn($p) => !$p->archived);
$postCount = count($activePosts);

$isArticles = $slug === 'articles';
$isSpeaking = $slug === 'speaking';
?>

<!-- Page header -->
<section class="mx-auto max-w-editorial px-6 pt-20 pb-12">
    <div class="running-head" aria-hidden="true">
        <span>shane logsdon &middot; <?= $isSpeaking ? 'speaking' : 'writing' ?></span>
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
    <?php $this->insert('partials::components/index-strip', [
        'stripSlug'    => $slug,
        'stripCount'   => $postCount,
        'stripCurrent' => 'all',
    ]); ?>

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
