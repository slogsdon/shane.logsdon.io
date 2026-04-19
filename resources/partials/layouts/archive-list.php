<?php
$this->layout('partials::layouts/main', [
    'title' => $title,
    'slug' => $slug,
    'url' => '/archive/',
]);
?>

<!-- Page header -->
<section class="mx-auto max-w-editorial px-6 pb-10 pt-20">
    <p class="eyebrow">§ Archive</p>
    <h1 class="mt-4 max-w-4xl font-display text-4xl font-normal leading-[1.08] tracking-tight text-foreground sm:text-6xl">
        <?= htmlspecialchars($title) ?>
    </h1>
    <p class="mt-6 max-w-prose text-base leading-relaxed text-muted-foreground">
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
