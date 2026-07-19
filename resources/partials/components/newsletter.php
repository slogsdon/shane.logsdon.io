<?php
// Newsletter signup via Kit (ConvertKit). Plain HTML form POST, no JavaScript.
// Dormant until configured: set the KIT_FORM_ID build env var to your Kit form
// ID (Kit → your form → Embed → HTML: the number in the action URL). Renders
// nothing until set, so no broken form ever ships. Kit's free tier handles up
// to 10k subscribers and double opt-in / confirmation on its own pages.
// NOTE: app.kit.com is already allowed in form-action in the netlify.toml CSP.
$kitFormId = getenv('KIT_FORM_ID') ?: '';
if ($kitFormId === '') {
    return;
}
$kitAction = 'https://app.kit.com/forms/' . rawurlencode($kitFormId) . '/subscriptions';
?>
<section class="border-t border-rule bg-background">
    <div class="mx-auto max-w-editorial px-6 py-10">
        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12 sm:col-span-4">
                <p class="smallcaps">the newsletter</p>
                <h2 class="mt-2 font-display text-2xl font-medium text-foreground">New posts by email</h2>
            </div>
            <div class="col-span-12 sm:col-span-8">
                <p class="max-w-prose text-[1rem] leading-relaxed text-muted-foreground">
                    Occasional writing on developer platforms, payments, and AI-assisted engineering. No spam, and you can unsubscribe anytime.
                </p>
                <form action="<?= htmlspecialchars($kitAction) ?>" method="post"
                      class="mt-5 flex flex-wrap items-baseline gap-3">
                    <label class="sr-only" for="newsletter-email">Email address</label>
                    <input id="newsletter-email" type="email" name="email_address" required autocomplete="email"
                           placeholder="you@example.com"
                           class="min-w-0 flex-1 border-b border-rule bg-transparent py-2 text-[1rem] text-foreground placeholder:text-muted-foreground focus:border-foreground focus:outline-none">
                    <button type="submit" class="btn-arrow btn-arrow--accent">Subscribe</button>
                </form>
            </div>
        </div>
    </div>
</section>
