<?php
$ctaEyebrow = isset($ctaEyebrow) ? $ctaEyebrow : 'Stay in touch';
$ctaTitle   = isset($ctaTitle)   ? $ctaTitle   : 'Networking, openly.';
$ctaBody    = isset($ctaBody)    ? $ctaBody     : 'I write and connect with operators building developer-first products and payment systems. Follow along on LinkedIn - that\'s where conversations happen.';
?>
<section class="relative mt-24 border-y border-rule" style="background-color: hsl(var(--accent) / 0.4);">
    <div class="mx-auto grid max-w-editorial grid-cols-12 gap-6 px-6 py-16 sm:py-20">
        <div class="col-span-12 sm:col-span-3">
            <p class="eyebrow"><?= htmlspecialchars($ctaEyebrow) ?></p>
        </div>
        <div class="col-span-12 sm:col-span-9">
            <h2 class="max-w-prose font-display text-3xl font-medium leading-tight text-foreground sm:text-4xl">
                <?= htmlspecialchars($ctaTitle) ?>
            </h2>
            <p class="mt-4 max-w-prose text-base leading-relaxed text-muted-foreground">
                <?= htmlspecialchars($ctaBody) ?>
            </p>
            <div class="mt-8 flex flex-wrap items-center gap-x-8 gap-y-3">
                <a href="https://www.linkedin.com/in/shanelogsdon"
                   target="_blank"
                   rel="noreferrer noopener"
                   class="group inline-flex items-center gap-3 border border-foreground bg-foreground px-5 py-3 text-sm font-medium text-background transition-colors hover:bg-background hover:text-foreground hover:no-underline">
                    <span>Follow on LinkedIn</span>
                    <span class="font-mono text-xs transition-transform group-hover:translate-x-1">→</span>
                </a>
                <span class="font-mono text-[0.7rem] uppercase tracking-[0.18em] text-muted-foreground">/in/shanelogsdon</span>
            </div>
        </div>
    </div>
</section>
