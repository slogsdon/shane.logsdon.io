<?php
$ctaEyebrow = isset($ctaEyebrow) ? $ctaEyebrow : 'Stay in touch';
$ctaTitle   = isset($ctaTitle)   ? $ctaTitle   : 'Networking, openly.';
$ctaBody    = isset($ctaBody)    ? $ctaBody     : 'I write and connect with operators building developer-first products and payment systems. Follow along on LinkedIn — that\'s where conversations happen.';
?>
<section class="inversion mt-24 px-6 py-20 sm:py-24">
    <div class="mx-auto grid max-w-editorial grid-cols-12 gap-6">
        <div class="col-span-12 sm:col-span-3">
            <p class="smallcaps"><?= strtolower(htmlspecialchars($ctaEyebrow)) ?></p>
        </div>
        <div class="col-span-12 sm:col-span-9">
            <h2 class="max-w-prose font-display text-3xl font-medium leading-tight sm:text-4xl">
                <?= htmlspecialchars($ctaTitle) ?>
            </h2>
            <p class="mt-5 max-w-prose text-[1.0625rem] leading-relaxed" style="color: rgba(251, 250, 249, 0.72);">
                <?= htmlspecialchars($ctaBody) ?>
            </p>
            <div class="mt-8 flex flex-wrap items-baseline gap-x-10 gap-y-4">
                <a href="https://www.linkedin.com/in/shanelogsdon"
                   target="_blank"
                   rel="noreferrer noopener"
                   class="btn-arrow">Follow on LinkedIn</a>
                <span class="smallcaps">/in/shanelogsdon</span>
            </div>
        </div>
    </div>
</section>
