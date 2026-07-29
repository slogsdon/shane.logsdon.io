<?php
$this->layout('partials::layouts/main', [
    'title' => 'Louisville Web Presence for New Businesses',
    'description' => 'Most new Louisville businesses are invisible online for their first 60 days. I help newly registered LLCs get a real website and Google Business Profile set up fast.',
    'url' => '/local-businesses/',
]);

// A · Drawing First, by Q5: the page makes one claim and that claim is a split.
// 112 registrations divide at two counts, so the drawing carries the argument
// and the prose under it is the key, numbered to the callouts. The headline
// sits below the drawing, which is what this architecture asks for.
//
// The mapping table names a timeline drawing for this row. There is no timeline
// to draw. The page's time claim (the first 60 days) states no dated quantity,
// so a timeline would be an invented shape over real-sounding numbers. The
// split is what the page can defend, so a dimensioned diagram is what it gets,
// and the mapping row needs correcting the way the Work row did.
//
// Three big numbers used to sit under this drawing repeating the same counts.
// They were cut. The drawing states them once and the key reads them.
?>

<!-- Drawing first -->
<section class="mx-auto max-w-editorial px-6 pt-20 pb-20">
    <div class="running-head" aria-hidden="true">
        <span>shane logsdon &middot; local businesses</span>
        <span><?= date('Y.m.d') ?></span>
    </div>

    <figure class="mt-10">
        <div class="figure-plate">
        <svg width="960" height="176" viewBox="0 0 960 176" role="img"
             aria-label="Of 112 businesses registered in Oldham County, Kentucky in April 2026, 40 had no Google listing and 30 had a listing with no working website. Those two together are 70 of 112. The remaining 42 are not counted in either gap.">
            <defs>
                <pattern id="lb-hatch" width="7" height="7" patternUnits="userSpaceOnUse" patternTransform="rotate(45)">
                    <line x1="0" y1="0" x2="0" y2="7" class="hatch"/>
                </pattern>
            </defs>

            <text x="8" y="12" class="t-mono f-3">NEW BUSINESSES REGISTERED &middot; OLDHAM COUNTY KY &middot; APRIL 2026 &middot; 112 TOTAL</text>
            <line x1="8" y1="24" x2="952" y2="24" class="s-ink"/>

            <!-- The bar is 112 wide. It divides at the two counts the case study
                 states; the third region is what is left, not a third finding. -->
            <rect x="8"   y="44" width="337" height="76" class="s-edge" fill="url(#lb-hatch)"/>
            <rect x="345" y="44" width="253" height="76" class="s-edge" fill="url(#lb-hatch)"/>
            <rect x="598" y="44" width="354" height="76" class="s-ink"/>

            <text x="22"  y="82"  class="t-serif f-ink" font-size="30">40</text>
            <text x="22"  y="102" class="t-sans f-soft">no Google listing</text>
            <text x="359" y="82"  class="t-serif f-ink" font-size="30">30</text>
            <text x="359" y="102" class="t-sans f-soft">listing, no website</text>
            <text x="612" y="82"  class="t-serif f-soft" font-size="30">42</text>
            <text x="612" y="102" class="t-sans f-3">neither gap</text>

            <circle cx="327" cy="60" r="8" class="s-mark"/>
            <text x="327" y="63.5" text-anchor="middle" class="t-mono f-mark">1</text>
            <circle cx="580" cy="60" r="8" class="s-mark"/>
            <text x="580" y="63.5" text-anchor="middle" class="t-mono f-mark">2</text>

            <line x1="8"   y1="126" x2="8"   y2="150" class="s-mark"/>
            <line x1="598" y1="126" x2="598" y2="150" class="s-mark"/>
            <line x1="8"   y1="140" x2="598" y2="140" class="s-mark"/>
            <text x="303" y="166" text-anchor="middle" class="t-mono f-mark">70 OF 112 &middot; NEARLY TWO IN THREE</text>
        </svg>
        </div>
        <figcaption class="figcaption">
            <b>Fig. 01</b> Where the gap sits. Source: the Oldham County registration case study,
            April 2026, whose three counts are quoted in the key below. Callout
            <span class="callout">1</span> is the businesses with no listing at all and
            <span class="callout">2</span> is the ones listed with no working site. The 42 is
            arithmetic on the other two, not a fourth count: the case study says nothing about
            what those businesses do have.
        </figcaption>
    </figure>

    <h1 class="mt-12 max-w-[20ch] font-display font-normal text-foreground"
        style="font-size: clamp(2.5rem, 6.5vw, 5.5rem); line-height: 1.02; letter-spacing: -0.02em;">
        Your new business is <span class="t-accent">invisible</span> to the people already looking for you.
    </h1>

    <div class="mt-8 max-w-prose space-y-5">
        <p class="text-[1.0625rem] leading-relaxed text-muted-foreground">
            In April 2026, 40 newly registered Louisville-area businesses had no Google listing at all. <span class="callout">1</span> Another 30 had a listing but no working website. <span class="callout">2</span> That's nearly two out of three new businesses with a gap between where customers look and what they find, and the cost shows up before most owners realize it's happening.
        </p>
        <p class="text-[1.0625rem] leading-relaxed text-muted-foreground">
            April 2026 is not an anomaly. The same pattern repeats every month across Jefferson, Oldham, Bullitt, Spencer, and Shelby counties. Someone forms an LLC, signs a lease, puts up signage, opens the doors, and then disappears from Google Maps. Or worse, their listing shows yesterday's hours, a phone number that doesn't connect, or a placeholder page that still says "coming soon."
        </p>
        <p class="text-[1.0625rem] leading-relaxed text-muted-foreground">
            People search for local businesses before they call or walk in. That first impression is either &ldquo;this place exists and it's real&rdquo; or &ldquo;I'll find somewhere else.&rdquo; There isn't much middle ground.
        </p>
    </div>

    <div class="mt-10">
        <a href="#request-audit" class="btn-arrow btn-arrow--accent">Get your free GBP audit</a>
    </div>
</section>

<!-- The first 60 days -->
<section class="mx-auto max-w-editorial px-6 pb-20">
    <div class="grid grid-cols-12 gap-6 border-t border-rule pt-12">
        <div class="col-span-12 sm:col-span-3">
            <p class="smallcaps-lg">the first 60 days</p>
        </div>
        <div class="col-span-12 space-y-5 sm:col-span-9">
            <p class="max-w-prose text-[1.1875rem] leading-[1.6] text-foreground">
                New business owners spend months getting the license, the lease, the signage right. Then they open the doors and assume people will find them. That assumption is where the cost shows up.
            </p>
            <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                The algorithm rewards early consistency. A listing that gets claimed, verified, and kept current in the first 60 days compounds into more visibility and more reviews, and it builds the kind of trust that makes someone choose you over the listing below theirs. Listings that sit incomplete get buried by competitors who took ten minutes to sort theirs out, some of whom opened after you did.
            </p>
            <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                Most owners don't realize they're losing customers during those first two months because nobody can find them. By the time they notice and try to fix it, the competitive gap is already there. Fixing a buried listing after six or twelve months takes significantly more effort than getting it right from day one.
            </p>
            <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                This is one of those things that sounds simple until you actually have to do it, and by then the early momentum is gone.
            </p>
        </div>
    </div>
</section>

<!-- What you get -->
<section class="mx-auto max-w-editorial px-6 pb-20">
    <div class="grid grid-cols-12 gap-6 border-t border-rule pt-12">
        <div class="col-span-12 sm:col-span-3">
            <p class="smallcaps-lg">what you get</p>
        </div>
        <div class="col-span-12 sm:col-span-9">
            <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                I handle the pieces most new business owners don't have time for, or don't know where to start.
            </p>
            <ol class="mt-10 grid grid-cols-1">
                <li class="grid grid-cols-12 gap-6 border-t border-rule py-8">
                    <p class="folio col-span-12 sm:col-span-2"><span class="pos">01</span></p>
                    <div class="col-span-12 sm:col-span-10">
                        <h3 class="font-display text-xl font-medium text-foreground">Website build</h3>
                        <p class="mt-2 max-w-prose text-[1rem] leading-relaxed text-muted-foreground">A clean, fast site built for local customers finding you through search, not a template slapped together and left to rot. It's designed so visitors can figure out what you do, how to reach you, and whether to call, all within the first few seconds.</p>
                    </div>
                </li>
                <li class="grid grid-cols-12 gap-6 border-t border-rule py-8">
                    <p class="folio col-span-12 sm:col-span-2"><span class="pos">02</span></p>
                    <div class="col-span-12 sm:col-span-10">
                        <h3 class="font-display text-xl font-medium text-foreground">Google Business Profile setup</h3>
                        <p class="mt-2 max-w-prose text-[1rem] leading-relaxed text-muted-foreground">Claiming your listing, verifying it, and populating hours, services, and photos is what makes a profile actually useful instead of just existing as a placeholder. This is where most new businesses fail, and it's also the lowest-hanging fruit for showing up in local search.</p>
                    </div>
                </li>
                <li class="grid grid-cols-12 gap-6 border-t border-rule py-8">
                    <p class="folio col-span-12 sm:col-span-2"><span class="pos">03</span></p>
                    <div class="col-span-12 sm:col-span-10">
                        <h3 class="font-display text-xl font-medium text-foreground">Ongoing retainer</h3>
                        <p class="mt-2 max-w-prose text-[1rem] leading-relaxed text-muted-foreground">Hosting, updates, GBP posts, review management, monthly content refreshes, all of which keep your presence from going stale after launch. A listing that hasn't been touched in three months performs worse than one that doesn't exist at all.</p>
                        <p class="mt-3 max-w-prose text-[1rem] leading-relaxed text-muted-foreground">You get the build done right upfront and I keep it current after that. The tradeoff is straightforward: you pay for the ongoing work, but you never have to worry about your online presence decaying quietly in the background.</p>
                    </div>
                </li>
            </ol>
        </div>
    </div>
</section>

<!-- Pricing -->
<section class="mx-auto max-w-editorial px-6 pb-20">
    <div class="grid grid-cols-12 gap-6 border-t border-rule pt-12">
        <div class="col-span-12 sm:col-span-3">
            <p class="smallcaps-lg">pricing</p>
        </div>
        <div class="col-span-12 sm:col-span-9">
            <div class="grid grid-cols-1 sm:grid-cols-2">
                <div class="border-t border-rule py-8 sm:border-r sm:pr-8">
                    <p class="smallcaps">build</p>
                    <p class="mt-3 font-display text-4xl font-medium text-foreground">$499&ndash;$999</p>
                    <p class="folio mt-2"><span>one time</span></p>
                    <p class="mt-5 max-w-prose text-[0.95rem] leading-relaxed text-muted-foreground">Depends on complexity. A straightforward single-location site with standard pages lands at the lower end. Anything requiring more structure (multiple service areas, booking integration, custom content) moves toward the higher end. One price, no surprises.</p>
                </div>
                <div class="border-t border-rule py-8 sm:pl-8">
                    <p class="smallcaps">retainer</p>
                    <p class="mt-3 font-display text-4xl font-medium text-foreground">$99&ndash;$199</p>
                    <p class="folio mt-2"><span>per month</span></p>
                    <p class="mt-5 max-w-prose text-[0.95rem] leading-relaxed text-muted-foreground">Covers hosting, ongoing updates, GBP posts, review management, and monthly content refreshes. The range reflects how much maintenance your setup actually needs. A simple site with minimal changes stays at the lower tier. A more active presence sits higher.</p>
                </div>
            </div>
            <p class="mt-8 max-w-prose text-[0.95rem] leading-relaxed text-muted-foreground">
                Think of it as one payment to get it right and a monthly fee to keep it that way.
            </p>
        </div>
    </div>
</section>

<!-- Free audit CTA -->
<section id="request-audit" class="relative mx-auto max-w-editorial px-6 pb-24">
    <div class="grid grid-cols-12 gap-6 border-t border-rule pt-12">
        <div class="col-span-12 sm:col-span-3">
            <p class="smallcaps-lg">free audit</p>
        </div>
        <div class="col-span-12 sm:col-span-9">
            <h2 class="max-w-prose font-display text-3xl font-medium leading-tight text-foreground sm:text-4xl">
                Not sure where your business stands online?
            </h2>
            <p class="mt-5 max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                I'll pull together a free audit of your Google Business Profile and web presence. It covers what's working, what's missing, and roughly what closing the gaps would cost.
            </p>
            <p class="mt-3 max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                No pitch attached. You get the report and decide whether to do anything with it.
            </p>
            <?php $this->insert('partials::components/audit-form'); ?>
        </div>
    </div>
</section>

<script type="application/ld+json">
<?= json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'ProfessionalService',
    '@id' => 'https://shane.logsdon.io/services/#ProfessionalService',
    'name' => 'Web Presence Systems for Local Business Owners',
    'url' => 'https://shane.logsdon.io/services/',
    'provider' => ['@id' => 'https://shane.logsdon.io/#Person'],
    'areaServed' => [
        ['@type' => 'City', 'name' => 'Louisville', 'sameAs' => 'https://en.wikipedia.org/wiki/Louisville,_Kentucky'],
        ['@type' => 'AdministrativeArea', 'name' => 'Louisville metropolitan area'],
    ],
    'address' => [
        '@type' => 'PostalAddress',
        'addressLocality' => 'Louisville',
        'addressRegion' => 'KY',
        'addressCountry' => 'US',
    ],
    'priceRange' => '$$',
], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) ?>
</script>
