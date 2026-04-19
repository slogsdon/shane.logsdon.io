<?php
$this->layout('partials::layouts/main', [
    'title' => $title,
    'slug' => $slug,
    'url' => sprintf('/%s/', $slug),
]);

$allPosts = (array)json_decode(file_get_contents(sprintf('resources/data/%s-list.json', $slug)));
$activePosts = array_filter($allPosts, fn($p) => !$p->archived);
$postCount = count($activePosts);
$countLabel = str_pad($postCount, 2, '0', STR_PAD_LEFT);

$isArticles = $slug === 'articles';
$isSpeaking = $slug === 'speaking';
?>

<!-- Page header -->
<section class="mx-auto max-w-editorial px-6 pb-10 pt-20">
    <?php if ($isArticles): ?>
        <p class="eyebrow">§ Writing</p>
        <h1 class="mt-4 max-w-4xl font-display text-4xl font-normal leading-[1.08] tracking-tight text-foreground sm:text-6xl">
            Articles &amp; <span class="italic" style="color:hsl(var(--ink-soft))">field notes</span>.
        </h1>
        <p class="mt-6 max-w-prose text-base leading-relaxed text-muted-foreground">
            Working notes on payment systems, developer platforms, and the unglamorous
            architecture choices that decide whether a product feels good to build on.
        </p>
    <?php elseif ($isSpeaking): ?>
        <p class="eyebrow">§ Speaking</p>
        <h1 class="mt-4 max-w-4xl font-display text-4xl font-normal leading-[1.08] tracking-tight text-foreground sm:text-6xl">
            Talks &amp; <span class="italic" style="color:hsl(var(--ink-soft))">conversations</span>.
        </h1>
        <p class="mt-6 max-w-prose text-base leading-relaxed text-muted-foreground">
            A small archive of public talks on payments, partnerships, and the realities of
            shipping developer-facing products.
        </p>
    <?php else: ?>
        <h1 class="mt-4 font-display text-4xl font-normal tracking-tight text-foreground sm:text-6xl">
            <?= htmlspecialchars($title) ?>
        </h1>
    <?php endif; ?>
</section>

<section class="mx-auto max-w-editorial px-6">
    <div class="flex items-center justify-between border-y border-rule py-4">
        <p class="font-mono text-[0.7rem] uppercase tracking-[0.18em] text-muted-foreground">
            <?= $countLabel ?> <?= $isArticles ? ($postCount === 1 ? 'entry' : 'entries') : ($postCount === 1 ? 'talk' : 'talks') ?>
        </p>
        <?php if ($isArticles): ?>
        <p class="font-mono text-[0.7rem] uppercase tracking-[0.18em] text-muted-foreground">Archive</p>
        <?php elseif ($isSpeaking): ?>
        <p class="font-mono text-[0.7rem] uppercase tracking-[0.18em] text-muted-foreground">Archive</p>
        <?php endif; ?>
    </div>

    <?php $this->insert('partials::components/post-list', [
        'slug' => $slug,
    ]); ?>
    <div class="border-t border-rule"></div>
</section>

<?php
$speakingCta = $isSpeaking
    ? ['ctaEyebrow' => 'Invite', 'ctaTitle' => 'Available for select talks and panels.', 'ctaBody' => 'If you\'re organizing something thoughtful around payments, developer experience, or platform strategy, I\'d love to hear from you on LinkedIn.']
    : [];
$this->insert('partials::components/contact-cta', $speakingCta);
?>
