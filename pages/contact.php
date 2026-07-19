<?php
$this->layout('partials::layouts/main', [
    'title' => 'Start here',
    'description' => 'Book a free 20-minute call or send your site for a free audit. Shane Logsdon reviews your web presence and follows up within one business day.',
    'url' => '/contact/',
    'image' => 'og-default.png',
    'imageAlt' => 'Shane Logsdon, start here',
]);
?>

<!-- Page header -->
<section class="mx-auto max-w-editorial px-6 pt-20 pb-12">
    <div class="running-head" aria-hidden="true">
        <span>shane logsdon &middot; contact</span>
        <span><?= date('Y.m.d') ?></span>
    </div>
    <h1 class="mt-12 max-w-[18ch] font-display font-normal text-foreground"
        style="font-size: clamp(2.75rem, 7vw, 6rem); line-height: 1.0; letter-spacing: -0.02em;">
        Start <span class="t-accent">here</span>.
    </h1>
    <p class="mt-8 max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
        The fastest way to start: book a 20-minute call. I&rsquo;ll look at your current web presence before we talk so we can spend the time on what actually matters.
    </p>
</section>

<!-- Primary: Calendar booking -->
<section class="mx-auto max-w-editorial px-6 pb-16">
    <div class="grid grid-cols-12 gap-6 border-t border-rule pt-12">
        <div class="col-span-12 sm:col-span-3">
            <p class="smallcaps-lg">book a call</p>
        </div>
        <div class="col-span-12 sm:col-span-9">
            <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                20 minutes. Free. I review your presence before we talk.
            </p>
            <div class="mt-8">
                <a href="https://calendar.app.google/34ac2uYtwsR1NiTV6" target="_blank" rel="noreferrer noopener" class="btn-arrow btn-arrow--accent">Book a 20-minute call</a>
            </div>
        </div>
    </div>
</section>

<!-- Divider -->
<div class="mx-auto max-w-editorial px-6 pb-12">
    <div class="flex items-center gap-6">
        <div class="hairline flex-1"></div>
        <p class="smallcaps">or</p>
        <div class="hairline flex-1"></div>
    </div>
</div>

<!-- Secondary: Async form -->
<section class="mx-auto max-w-editorial px-6 pb-24">
    <div class="grid grid-cols-12 gap-6 border-t border-rule pt-12">
        <div class="col-span-12 sm:col-span-3">
            <p class="smallcaps-lg">async audit request</p>
        </div>
        <div class="col-span-12 sm:col-span-9">
            <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                Prefer async? Send me your site and I&rsquo;ll reach out within one business day.
            </p>

            <form
                name="audit-request"
                method="POST"
                netlify
                netlify-honeypot="bot-field"
                action="/thanks/"
                class="mt-8 space-y-6 max-w-prose"
            >
                <input type="hidden" name="form-name" value="audit-request" />
                <p class="visually-hidden">
                    <label>Don&rsquo;t fill this out: <input name="bot-field" /></label>
                </p>

                <div class="space-y-2">
                    <label for="audit-name" class="smallcaps block">name</label>
                    <input type="text" id="audit-name" name="name" required autocomplete="name"
                           class="w-full border-0 border-b border-rule bg-transparent py-2 text-base text-foreground transition-colors focus:border-foreground focus:outline-none focus:ring-0">
                </div>

                <div class="space-y-2">
                    <label for="audit-email" class="smallcaps block">email</label>
                    <input type="email" id="audit-email" name="email" required autocomplete="email"
                           class="w-full border-0 border-b border-rule bg-transparent py-2 text-base text-foreground transition-colors focus:border-foreground focus:outline-none focus:ring-0">
                </div>

                <div class="space-y-2">
                    <label for="audit-website" class="smallcaps block">your website url</label>
                    <input type="url" id="audit-website" name="website" required placeholder="https://yourbusiness.com" autocomplete="url"
                           class="w-full border-0 border-b border-rule bg-transparent py-2 text-base text-foreground transition-colors focus:border-foreground focus:outline-none focus:ring-0">
                </div>

                <div class="space-y-2">
                    <label for="audit-message" class="smallcaps block">anything specific you&rsquo;d like me to look at? <span class="text-muted-foreground normal-case" style="font-variant-caps: normal;">(optional)</span></label>
                    <textarea id="audit-message" name="message" rows="3"
                              class="w-full border border-rule bg-transparent px-4 py-3 text-base text-foreground transition-colors focus:border-foreground focus:outline-none focus:ring-0"></textarea>
                </div>

                <div class="pt-2">
                    <button type="submit" class="btn-arrow btn-arrow--accent">Send</button>
                </div>
            </form>
        </div>
    </div>
</section>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ContactPage",
  "@id": "https://shane.logsdon.io/contact/#ContactPage",
  "url": "https://shane.logsdon.io/contact",
  "name": "Start here — Shane Logsdon",
  "description": "Request a free web presence audit or book a 20-minute call with Shane Logsdon.",
  "mainEntity": {
    "@id": "https://shane.logsdon.io/#Person"
  }
}
</script>
