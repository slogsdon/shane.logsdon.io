<?php
$this->layout('partials::layouts/main', [
    'title' => $title,
    'slug' => $slug,
    'url' => '/archive/',
]);
?>

<!-- Page header -->
<section class="mx-auto max-w-editorial px-6 pt-20 pb-12">
    <div class="running-head" aria-hidden="true">
        <span>shane logsdon &middot; archive</span>
        <span><?= date('Y.m.d') ?></span>
    </div>
    <h1 class="mt-12 max-w-[20ch] font-display font-normal text-foreground"
        style="font-size: clamp(2.5rem, 6vw, 5rem); line-height: 1.05; letter-spacing: -0.02em;">
        <?= htmlspecialchars($title) ?>
    </h1>
    <p class="mt-8 max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
        Historical writing maintained for reference. Core concepts may still apply,
        but specific details may be outdated.
    </p>
</section>

<section class="mx-auto max-w-editorial px-6">
    <?php $this->insert('partials::components/archive-list', [
        'slug' => $slug,
    ]); ?>
</section>

<?php $this->insert('partials::components/contact-cta'); ?>
