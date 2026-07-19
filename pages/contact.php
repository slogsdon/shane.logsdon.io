<?php
$this->layout('partials::layouts/main', [
    'title' => 'Contact',
    'description' => 'Get in touch with Shane Logsdon about developer advocacy, product work, speaking, collaboration, or the writing. Book a 20-minute call or send a message.',
    'url' => '/contact/',
    'image' => 'og-default.png',
    'imageAlt' => 'Contact Shane Logsdon',
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
        Get in <span class="t-accent">touch</span>.
    </h1>
    <p class="mt-8 max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
        Reach out about developer advocacy and product work, speaking, collaboration on an open-source project, or anything you read here. I read every message and follow up within one business day.
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
                Prefer to talk? Grab 20 minutes on my calendar.
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

<!-- Secondary: Message form -->
<section class="mx-auto max-w-editorial px-6 pb-20">
    <div class="grid grid-cols-12 gap-6 border-t border-rule pt-12">
        <div class="col-span-12 sm:col-span-3">
            <p class="smallcaps-lg">send a message</p>
        </div>
        <div class="col-span-12 sm:col-span-9">
            <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                Send a note and I&rsquo;ll get back to you within one business day.
            </p>

            <form
                name="contact"
                method="POST"
                netlify
                netlify-honeypot="bot-field"
                action="/thanks/"
                class="mt-8 space-y-6 max-w-prose"
            >
                <input type="hidden" name="form-name" value="contact" />
                <p class="visually-hidden">
                    <label>Don&rsquo;t fill this out: <input name="bot-field" /></label>
                </p>

                <div class="space-y-2">
                    <label for="contact-name" class="smallcaps block">name</label>
                    <input type="text" id="contact-name" name="name" required autocomplete="name"
                           class="w-full border-0 border-b border-rule bg-transparent py-2 text-base text-foreground transition-colors focus:border-foreground focus:outline-none focus:ring-0">
                </div>

                <div class="space-y-2">
                    <label for="contact-email" class="smallcaps block">email</label>
                    <input type="email" id="contact-email" name="email" required autocomplete="email"
                           class="w-full border-0 border-b border-rule bg-transparent py-2 text-base text-foreground transition-colors focus:border-foreground focus:outline-none focus:ring-0">
                </div>

                <div class="space-y-2">
                    <label for="contact-message" class="smallcaps block">message</label>
                    <textarea id="contact-message" name="message" rows="4" required
                              class="w-full border border-rule bg-transparent px-4 py-3 text-base text-foreground transition-colors focus:border-foreground focus:outline-none focus:ring-0"></textarea>
                </div>

                <div class="pt-2">
                    <button type="submit" class="btn-arrow btn-arrow--accent">Send</button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Local business pointer -->
<section class="mx-auto max-w-editorial px-6 pb-24">
    <div class="grid grid-cols-12 gap-6 border-t border-rule pt-12">
        <div class="col-span-12 sm:col-span-3">
            <p class="smallcaps-lg">run a local business?</p>
        </div>
        <div class="col-span-12 sm:col-span-9">
            <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                I build and maintain web presence systems for local businesses, and I offer a free audit of your Google Business Profile and site. Start on the <a href="/services/" class="link-quiet">services</a> page, or read how it works for <a href="/local-businesses/" class="link-quiet">Louisville businesses</a>.
            </p>
        </div>
    </div>
</section>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ContactPage",
  "@id": "https://shane.logsdon.io/contact/#ContactPage",
  "url": "https://shane.logsdon.io/contact",
  "name": "Contact — Shane Logsdon",
  "description": "Get in touch with Shane Logsdon about developer advocacy, product work, speaking, or collaboration. Book a 20-minute call or send a message.",
  "mainEntity": {
    "@id": "https://shane.logsdon.io/#Person"
  }
}
</script>
