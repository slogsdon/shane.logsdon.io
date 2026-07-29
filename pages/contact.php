<?php
$this->layout('partials::layouts/main', [
    'title' => 'Contact',
    'description' => 'Get in touch with Shane Logsdon about developer advocacy, product work, speaking, collaboration, or the writing. Book a 20-minute call or send a message.',
    'url' => '/contact/',
    'image' => 'og-default.png',
    'imageAlt' => 'Contact Shane Logsdon',
]);

// C · Sheet, by Q3: the ways to reach me are a current state that can go stale,
// so the page has to say when it last changed. Everything above the title block
// is two ways in (a call, a message), and the block itself carries the rest of
// what a reader needs to know. No figure here, so no annotation red either.
?>

<div class="mx-auto max-w-editorial px-6 pt-10 pb-16">
<div class="sheet">
  <div class="sheet__field">

    <h1 class="max-w-[18ch] font-display font-normal text-foreground"
        style="font-size: clamp(2.5rem, 6vw, 5rem); line-height: 1.0; letter-spacing: -0.02em;">
        Get in <span class="t-accent">touch</span>.
    </h1>

    <p class="mt-8 max-w-prose text-[1.0625rem] leading-[1.6] text-ink-soft">
        Reach out about developer advocacy and product work, speaking, collaboration on an
        open-source project, or anything you read here. I read every message and follow up
        within one business day.
    </p>

    <!-- Book a call. Two-track grid, never twelve: eleven gaps at 40px overflows
         a phone before the content gets a chance to. -->
    <div class="mt-12 grid grid-cols-1 gap-x-10 gap-y-6 border-t border-rule pt-10 sm:grid-cols-[3fr_9fr]">
        <div>
            <p class="smallcaps-lg">book a call</p>
        </div>
        <div>
            <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                Prefer to talk? Grab 20 minutes on my calendar.
            </p>
            <div class="mt-8">
                <a href="https://calendar.app.google/34ac2uYtwsR1NiTV6" target="_blank" rel="noreferrer noopener" class="btn-arrow btn-arrow--accent">Book a 20-minute call</a>
            </div>
        </div>
    </div>

    <div class="mt-12 flex items-center gap-6">
        <div class="hairline flex-1"></div>
        <p class="smallcaps">or</p>
        <div class="hairline flex-1"></div>
    </div>

    <!-- Send a message -->
    <div class="mt-12 grid grid-cols-1 gap-x-10 gap-y-6 border-t border-rule pt-10 pb-12 sm:grid-cols-[3fr_9fr]">
        <div>
            <p class="smallcaps-lg">send a message</p>
        </div>
        <div>
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

  </div>

  <?php $this->insert('partials::components/title-block', [
      'sheetNo'    => 'A-04',
      'sheetFile'  => 'pages/contact.php',
      'sheetTitle' => 'shane logsdon &middot; contact',
      'sheetMeta'  => 'Louisville, Kentucky &middot; replies within one business day &middot; <a class="link-quiet" href="https://www.linkedin.com/in/shanelogsdon" target="_blank" rel="noreferrer noopener">linkedin</a> &middot; <a class="link-quiet" href="/about/">what I work on</a>',
      'sheetRevFallback'  => '17',
      'sheetDateFallback' => '2026-07-19',
  ]); ?>
</div>
</div>

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
