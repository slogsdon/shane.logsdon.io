<?php
$this->layout('partials::layouts/main', [
    'title' => 'Contact',
    'description' => 'Get in touch to discuss fintech development, payment systems, or product strategy.',
    'url' => '/contact/',
]);
?>

<!-- Page header -->
<section class="mx-auto max-w-editorial px-6 pt-20 pb-12">
    <div class="running-head" aria-hidden="true">
        <span>shane logsdon &mdash; contact</span>
        <span><?= date('Y.m.d') ?></span>
    </div>
    <h1 class="mt-12 max-w-[18ch] font-display font-normal text-foreground"
        style="font-size: clamp(2.75rem, 7vw, 6rem); line-height: 1.0; letter-spacing: -0.02em;">
        Get in <span class="t-accent">touch</span>.
    </h1>
    <p class="mt-8 max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
        Looking for expertise in fintech development, payment systems, or product strategy? Let&rsquo;s discuss how I can help with your technical product challenges.
    </p>
</section>

<!-- Contact form -->
<section class="mx-auto max-w-editorial px-6 pb-24">
    <div class="grid grid-cols-12 gap-6 border-t border-rule pt-12">
        <div class="col-span-12 sm:col-span-3">
            <p class="smallcaps-lg">send a message</p>
        </div>
        <div class="col-span-12 sm:col-span-9">
            <form method="POST" netlify class="space-y-6 max-w-prose">
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div class="space-y-2">
                        <label for="name" class="smallcaps block">name</label>
                        <input type="text" id="name" name="name" required
                               class="w-full border-0 border-b border-rule bg-transparent py-2 text-base text-foreground transition-colors focus:border-foreground focus:outline-none focus:ring-0">
                    </div>
                    <div class="space-y-2">
                        <label for="email" class="smallcaps block">email</label>
                        <input type="email" id="email" name="email" required
                               class="w-full border-0 border-b border-rule bg-transparent py-2 text-base text-foreground transition-colors focus:border-foreground focus:outline-none focus:ring-0">
                    </div>
                </div>

                <div class="space-y-2">
                    <label for="company" class="smallcaps block">company</label>
                    <input type="text" id="company" name="company"
                           class="w-full border-0 border-b border-rule bg-transparent py-2 text-base text-foreground transition-colors focus:border-foreground focus:outline-none focus:ring-0">
                </div>

                <div class="space-y-2">
                    <label for="interest" class="smallcaps block">area of interest</label>
                    <select id="interest" name="interest" required
                            class="w-full border-0 border-b border-rule bg-transparent py-2 text-base text-foreground transition-colors focus:border-foreground focus:outline-none focus:ring-0">
                        <option value="">Select an option</option>
                        <option value="local-business-web-presence">Local Business Web Presence</option>
                        <option value="gbp-audit">Free GBP Audit</option>
                        <option value="payment-systems">Payment Systems</option>
                        <option value="developer-platforms">Developer Platforms</option>
                        <option value="product-strategy">Product Strategy</option>
                        <option value="consulting">Technical Consulting</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div class="space-y-2">
                    <label for="message" class="smallcaps block">message</label>
                    <textarea id="message" name="message" required rows="6"
                              class="w-full border border-rule bg-transparent px-4 py-3 text-base text-foreground transition-colors focus:border-foreground focus:outline-none focus:ring-0"></textarea>
                </div>

                <div class="pt-4">
                    <button type="submit" class="btn-arrow btn-arrow--accent">Send message</button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Other ways to connect -->
<section class="mx-auto max-w-editorial px-6 pb-24">
    <div class="grid grid-cols-12 gap-6 border-t border-rule pt-12">
        <div class="col-span-12 sm:col-span-3">
            <p class="smallcaps-lg">other ways to connect</p>
        </div>
        <div class="col-span-12 grid grid-cols-1 gap-8 sm:col-span-9 sm:grid-cols-3">
            <div class="space-y-2">
                <p class="smallcaps">email</p>
                <p class="text-sm text-foreground">
                    <a href="mailto:shane@logsdon.io" class="link-quiet">shane@logsdon.io</a>
                </p>
            </div>
            <div class="space-y-2">
                <p class="smallcaps">location</p>
                <p class="text-sm text-muted-foreground">Louisville, KY, USA Area</p>
            </div>
            <div class="space-y-2">
                <p class="smallcaps">profiles</p>
                <ul class="space-y-1 text-sm">
                    <li><a href="https://www.linkedin.com/in/shanelogsdon" target="_blank" rel="noreferrer noopener" class="link-quiet">LinkedIn</a></li>
                    <li><a href="https://github.com/slogsdon" target="_blank" rel="noreferrer noopener" class="link-quiet">GitHub</a></li>
                    <li><a href="https://twitter.com/shanelogsdon" target="_blank" rel="noreferrer noopener" class="link-quiet">Twitter</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
