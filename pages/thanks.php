<?php
$this->layout('partials::layouts/main', [
    'title' => 'You\'re all set',
    'description' => 'Your request came through. Shane will follow up within one business day.',
    'url' => '/thanks/',
    'noindex' => true,
]);
?>

<section class="mx-auto max-w-editorial px-6 pt-20 pb-24">
    <div class="running-head" aria-hidden="true">
        <span>shane logsdon &middot; thanks</span>
        <span><?= date('Y.m.d') ?></span>
    </div>
    <h1 class="mt-12 max-w-[18ch] font-display font-normal text-foreground"
        style="font-size: clamp(2.75rem, 7vw, 6rem); line-height: 1.0; letter-spacing: -0.02em;">
        You&rsquo;re all <span class="t-accent">set</span>.
    </h1>
    <p class="mt-8 max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
        I&rsquo;ll look at your site and follow up within one business day.
    </p>
    <div class="mt-10">
        <a href="/" class="btn-arrow">Back to the site</a>
    </div>
</section>
