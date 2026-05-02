<?php
$this->layout('partials::layouts/main', [
    'title' => 'Contact',
    'description' => 'Get in touch to discuss fintech development, payment systems, or product strategy.',
    'url' => '/contact/',
]);
?>

<!-- Page header -->
<section class="mx-auto max-w-editorial px-6 pb-12 pt-20">
    <p class="eyebrow">§ Contact</p>
    <h1 class="mt-4 max-w-4xl font-display text-4xl font-normal leading-[1.08] tracking-tight text-foreground sm:text-6xl">
        Get in touch.
    </h1>
    <p class="mt-6 max-w-prose text-base leading-relaxed text-muted-foreground">
        Looking for expertise in fintech development, payment systems, or product strategy? Let&rsquo;s discuss how I can help with your technical product challenges.
    </p>
</section>

<!-- Contact form -->
<section class="mx-auto max-w-editorial px-6 pb-24">
    <div class="grid grid-cols-12 gap-6 border-t border-rule pt-12">
        <div class="col-span-12 sm:col-span-3">
            <p class="eyebrow">Send a message</p>
        </div>
        <div class="col-span-12 sm:col-span-9">
            <form method="POST" netlify class="space-y-6">
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div class="space-y-1">
                        <label for="name" class="font-mono text-[0.7rem] uppercase tracking-[0.18em] text-muted-foreground">Name</label>
                        <input type="text" id="name" name="name" required
                               class="w-full border border-rule bg-background px-4 py-3 text-sm text-foreground transition-colors focus:border-foreground focus:outline-none">
                    </div>
                    <div class="space-y-1">
                        <label for="email" class="font-mono text-[0.7rem] uppercase tracking-[0.18em] text-muted-foreground">Email</label>
                        <input type="email" id="email" name="email" required
                               class="w-full border border-rule bg-background px-4 py-3 text-sm text-foreground transition-colors focus:border-foreground focus:outline-none">
                    </div>
                </div>

                <div class="space-y-1">
                    <label for="company" class="font-mono text-[0.7rem] uppercase tracking-[0.18em] text-muted-foreground">Company</label>
                    <input type="text" id="company" name="company"
                           class="w-full border border-rule bg-background px-4 py-3 text-sm text-foreground transition-colors focus:border-foreground focus:outline-none">
                </div>

                <div class="space-y-1">
                    <label for="interest" class="font-mono text-[0.7rem] uppercase tracking-[0.18em] text-muted-foreground">Area of Interest</label>
                    <select id="interest" name="interest" required
                            class="w-full border border-rule bg-background px-4 py-3 text-sm text-foreground transition-colors focus:border-foreground focus:outline-none">
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

                <div class="space-y-1">
                    <label for="message" class="font-mono text-[0.7rem] uppercase tracking-[0.18em] text-muted-foreground">Message</label>
                    <textarea id="message" name="message" required rows="6"
                              class="w-full border border-rule bg-background px-4 py-3 text-sm text-foreground transition-colors focus:border-foreground focus:outline-none"></textarea>
                </div>

                <div>
                    <button type="submit"
                            class="group inline-flex items-center gap-3 border border-foreground bg-foreground px-5 py-3 text-sm font-medium text-background transition-colors hover:bg-background hover:text-foreground">
                        <span>Send Message</span>
                        <span class="font-mono text-xs transition-transform group-hover:translate-x-1">→</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Other ways to connect -->
<section class="mx-auto max-w-editorial px-6 pb-24">
    <div class="grid grid-cols-12 gap-6 border-t border-rule pt-12">
        <div class="col-span-12 sm:col-span-3">
            <p class="eyebrow">Other ways to connect</p>
        </div>
        <div class="col-span-12 grid grid-cols-1 gap-8 sm:col-span-9 sm:grid-cols-3">
            <div class="space-y-2">
                <p class="font-mono text-[0.7rem] uppercase tracking-[0.18em] text-muted-foreground">Email</p>
                <p class="text-sm text-foreground">
                    <a href="mailto:shane@shanelogsdon.com" class="link-quiet">shane@shanelogsdon.com</a>
                </p>
            </div>
            <div class="space-y-2">
                <p class="font-mono text-[0.7rem] uppercase tracking-[0.18em] text-muted-foreground">Location</p>
                <p class="text-sm text-muted-foreground">Louisville, KY, USA Area</p>
            </div>
            <div class="space-y-2">
                <p class="font-mono text-[0.7rem] uppercase tracking-[0.18em] text-muted-foreground">Profiles</p>
                <ul class="space-y-1 text-sm">
                    <li><a href="https://www.linkedin.com/in/shanelogsdon" target="_blank" rel="noreferrer noopener" class="link-quiet">LinkedIn</a></li>
                    <li><a href="https://github.com/slogsdon" target="_blank" rel="noreferrer noopener" class="link-quiet">GitHub</a></li>
                    <li><a href="https://twitter.com/shanelogsdon" target="_blank" rel="noreferrer noopener" class="link-quiet">Twitter</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
