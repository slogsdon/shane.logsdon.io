<?php
// Local web-presence audit request. Netlify form; posts to /thanks/.
// Embedded in /services/ and /local-businesses/. Netlify dedups by form-name,
// so including it on both pages registers a single "audit-request" form.
?>
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
        <button type="submit" class="btn-arrow btn-arrow--accent">Request the audit</button>
    </div>
</form>
