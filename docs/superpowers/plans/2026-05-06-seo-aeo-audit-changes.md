# SEO/AEO Audit Changes — shane.logsdon.io Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Implement six prioritized audit changes to improve AEO/SEO visibility, add a /services commercial page, and update site-wide meta + schema markup.

**Architecture:** Static PHP site built with `slogsdon/flat-file`, compiled to `dist/`. Pages live in `pages/*.php`. Layouts live in `resources/partials/layouts/`. Static assets (text files, etc.) go in `public/` and are served from site root. All JSON-LD lives inline in PHP templates via `<script type="application/ld+json">`. Meta descriptions are passed to the `master.php` layout via `$description` variable.

**Tech Stack:** PHP 8.3, Tailwind CSS v3, flat-file static site generator. Build: `npm run build:css && composer build`. Output: `dist/`. Deployed on Netlify.

---

## File Map

| File | Action | Change |
|------|--------|--------|
| `public/llms.txt` | Create | New LLM discovery file |
| `public/pricing.md` | Create | Pricing reference for AI/human readers |
| `pages/index.php` | Modify | Update meta description + above-fold CTA |
| `pages/about.php` | Modify | Update meta description + Person JSON-LD (jobTitle, worksFor, knowsAbout) |
| `pages/articles.php` | Modify | Update meta description |
| `pages/contact.php` | Modify | Update meta description |
| `resources/partials/layouts/writing-post.php` | Modify | Upgrade BlogPosting JSON-LD → Article schema with author/publisher/url fields |
| `pages/services.php` | Create | New /services commercial page with FAQPage JSON-LD |
| `resources/partials/components/site-menu.php` | Modify | Add "Services" nav link |

---

## Task 1: Add /llms.txt to site root

**Files:**
- Create: `public/llms.txt`

- [ ] **Step 1: Create the file**

  Create `public/llms.txt` with this exact content:

  ```
  # Shane Logsdon

  > Technical product leader and developer advocate at Global Payments. Also builds done-for-you web presence systems for local business owners — website build, conversion optimization, and ongoing AEO/SEO management.

  ## Content
  - /about — Background, focus areas, professional identity
  - /articles — Writing on developer tooling, fintech, product strategy, engineering leadership, AI/LLM infrastructure
  - /speaking — Conference talks and presentations
  - /work — Selected projects and work history
  - /contact — How to get in touch

  ## Who this site is for
  - Developers/technical practitioners reading about payments, developer experience, AI tooling
  - Local business owners researching web presence management services
  - Recruiters/collaborators evaluating Shane's background

  ## Key topics
  Developer advocacy, payment APIs, SDK design, LLM context files, AEO/SEO, agent experience (AX), web presence management, fintech, developer experience (DX)
  ```

- [ ] **Step 2: Verify the file is in the right location**

  Run: `ls public/llms.txt`
  Expected: `public/llms.txt`

- [ ] **Step 3: Commit**

  ```bash
  git add public/llms.txt
  git commit -m "feat: add llms.txt to site root for LLM/AI discoverability"
  ```

---

## Task 2: Add /pricing.md to site root

**Files:**
- Create: `public/pricing.md`

- [ ] **Step 1: Create the file**

  Create `public/pricing.md` with this exact content:

  ```markdown
  # Pricing — Shane Logsdon Web Presence

  Web presence systems for local business owners. Pricing is value-based and varies by scope.

  ## What's included

  ### Website Build
  One-time project. Includes: site design, development, conversion-optimized copy, mobile-first, fast load, basic schema markup, Google Business Profile setup/optimization, sitemap submission.

  ### Monthly Retainer
  Ongoing management. Includes: AEO/SEO content updates, GBP posts, citation management, schema maintenance, AI search visibility monitoring, monthly report.

  ## How pricing works
  Based on value delivered, not hours worked. Right question: what is one new client worth to you per month? That anchors the conversation. To get a quote: /contact
  ```

- [ ] **Step 2: Verify**

  Run: `ls public/pricing.md`
  Expected: `public/pricing.md`

- [ ] **Step 3: Commit**

  ```bash
  git add public/pricing.md
  git commit -m "feat: add pricing.md to site root"
  ```

---

## Task 3: Update meta descriptions on four pages

**Files:**
- Modify: `pages/index.php:3-6`
- Modify: `pages/about.php:2-5`
- Modify: `pages/articles.php` (find the `$this->layout(` call with `description`)
- Modify: `pages/contact.php:2-6`

- [ ] **Step 1: Update homepage meta description**

  In `pages/index.php`, change the `description` value in the `$this->layout()` call from:
  ```php
  'description' => 'Technical product leader building developer-first experiences for payment systems. Writing, speaking, and notes from the field.',
  ```
  To:
  ```php
  'description' => 'Shane Logsdon — developer advocate at Global Payments and builder of web presence systems for local business owners. Writing on fintech, developer tooling, and AI.',
  ```

- [ ] **Step 2: Update about meta description**

  In `pages/about.php`, change the `description` value from:
  ```php
  'description' => 'Technical product leader with 15+ years building developer-first experiences for payment systems and fintech infrastructure.',
  ```
  To:
  ```php
  'description' => 'Technical product leader with 15+ years at the intersection of fintech and developer tooling. Leads developer advocacy at Global Payments. Also builds web presence systems for local businesses.',
  ```

- [ ] **Step 3: Update articles meta description**

  Open `pages/articles.php`. Find the `$this->layout(` call and update `description` to:
  ```php
  'description' => 'Writing on developer tooling, fintech, payment APIs, AI/LLM infrastructure, and engineering leadership by Shane Logsdon.',
  ```

- [ ] **Step 4: Update contact meta description**

  In `pages/contact.php`, change the `description` value from:
  ```php
  'description' => 'Get in touch to discuss fintech development, payment systems, or product strategy.',
  ```
  To:
  ```php
  'description' => 'Get in touch with Shane Logsdon — open to conversations about developer experience, payment systems, and web presence management for local businesses.',
  ```

- [ ] **Step 5: Commit**

  ```bash
  git add pages/index.php pages/about.php pages/articles.php pages/contact.php
  git commit -m "feat: update meta descriptions on homepage, about, articles, and contact pages"
  ```

---

## Task 4: Update JSON-LD schema on about page

The `pages/about.php` currently has a `ProfilePage` schema with a nested `Person` entity. The audit asks for a standalone `Person` schema with `jobTitle`, `worksFor`, and `knowsAbout`. Add it as a second JSON-LD block alongside the existing one.

**Files:**
- Modify: `pages/about.php` (append before closing `?>` or after existing JSON-LD block)

- [ ] **Step 1: Add Person JSON-LD block to about.php**

  In `pages/about.php`, after the existing `</script>` closing the ProfilePage block (line 135), add:

  ```php
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Person",
    "name": "Shane Logsdon",
    "url": "https://shane.logsdon.io",
    "jobTitle": "Senior Director, Developer Advocacy",
    "worksFor": { "@type": "Organization", "name": "Global Payments" },
    "sameAs": [
      "https://linkedin.com/in/shanelogsdon",
      "https://github.com/slogsdon",
      "https://x.com/shanelogsdon"
    ],
    "knowsAbout": ["Developer Advocacy", "Payment APIs", "SDK Design", "AEO", "Web Presence Management", "Fintech"]
  }
  </script>
  ```

- [ ] **Step 2: Add same Person JSON-LD block to homepage**

  In `pages/index.php`, before the closing `</script>` of the locale script at the bottom (or after it, as a new block), add the same Person JSON-LD:

  ```php
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Person",
    "name": "Shane Logsdon",
    "url": "https://shane.logsdon.io",
    "jobTitle": "Senior Director, Developer Advocacy",
    "worksFor": { "@type": "Organization", "name": "Global Payments" },
    "sameAs": [
      "https://linkedin.com/in/shanelogsdon",
      "https://github.com/slogsdon",
      "https://x.com/shanelogsdon"
    ],
    "knowsAbout": ["Developer Advocacy", "Payment APIs", "SDK Design", "AEO", "Web Presence Management", "Fintech"]
  }
  </script>
  ```

  Add this after the locale JS block, as a sibling `<script>` element (not nested inside the JS).

- [ ] **Step 3: Commit**

  ```bash
  git add pages/about.php pages/index.php
  git commit -m "feat: add Person JSON-LD schema to homepage and about page"
  ```

---

## Task 5: Upgrade Article JSON-LD on writing-post layout

The `resources/partials/layouts/writing-post.php` already has a `BlogPosting` schema. The audit asks to align it with `Article` type and ensure `author.url`, `publisher`, and both date fields are present.

**Files:**
- Modify: `resources/partials/layouts/writing-post.php:182-214`

- [ ] **Step 1: Replace BlogPosting schema with Article schema**

  In `resources/partials/layouts/writing-post.php`, replace the entire existing `<script type="application/ld+json">` block (lines 182–214) with:

  ```php
  <script type="application/ld+json">
  {
      "@context": "https://schema.org",
      "@type": "Article",
      "headline": "<?= addslashes($title) ?>",
      "url": "https://shane.logsdon.io<?= $url ?>",
      "datePublished": "<?= DateTime::createFromFormat('U', $originalDate)->format('Y-m-d') ?>",
      "dateModified": "<?= DateTime::createFromFormat('U', isset($modified) ? $modified : $originalDate)->format('Y-m-d') ?>",
      "author": {
          "@type": "Person",
          "name": "Shane Logsdon",
          "url": "https://shane.logsdon.io"
      },
      "publisher": {
          "@type": "Person",
          "name": "Shane Logsdon"
      },
      "description": "<?= addslashes($meta->description) ?>",
      "isPartOf": {
          "@type": "Blog",
          "@id": "https://shane.logsdon.io/articles/",
          "name": "Shane Logsdon's Blog"
      }
  }
  </script>
  ```

  Note: `$url` is already set in the layout from the `$this->layout()` call in `writing-post.php` (line 29–38). The variable is available in this template scope.

- [ ] **Step 2: Commit**

  ```bash
  git add resources/partials/layouts/writing-post.php
  git commit -m "feat: upgrade article JSON-LD from BlogPosting to Article schema"
  ```

---

## Task 6: Update above-fold CTA on homepage

**Files:**
- Modify: `pages/index.php:50`

- [ ] **Step 1: Replace "Read about Shane" CTA**

  In `pages/index.php`, find the CTA block (around line 50):
  ```php
  <a href="/about/" class="btn-arrow">Read about Shane</a>
  <a href="/articles/" class="btn-arrow btn-arrow--muted">Browse writing</a>
  ```

  Replace with:
  ```php
  <a href="/services/" class="btn-arrow">Work with me</a>
  <a href="/articles/" class="btn-arrow btn-arrow--muted">Browse writing</a>
  ```

- [ ] **Step 2: Commit**

  ```bash
  git add pages/index.php
  git commit -m "feat: update homepage CTA from about to services"
  ```

---

## Task 7: Create /services page

This is the largest task. The page follows the same structural pattern as `pages/local-businesses.php` — `$this->layout()` call, hero section, content sections with the `grid grid-cols-12` pattern, JSON-LD at the bottom.

Copy must align with the voice profile: long build, short landing; consultative undercurrent; no em-dashes; specific and functional; opens from inside the problem.

**Files:**
- Create: `pages/services.php`

- [ ] **Step 1: Create the services page**

  Create `pages/services.php` with this content:

  ```php
  <?php
  $this->layout('partials::layouts/main', [
      'title' => 'Web Presence Systems for Local Business Owners',
      'description' => 'Done-for-you web presence: website build, conversion optimization, and ongoing AEO/SEO management. Built and managed by a practitioner who does this at enterprise scale.',
      'url' => '/services/',
  ]);

  $faqs = [
      [
          'q' => 'What\'s included in the monthly retainer?',
          'a' => 'AEO/SEO content updates, Google Business Profile posts, citation management, schema markup maintenance, AI search visibility monitoring, and a monthly report. The point is that your presence keeps improving after launch instead of decaying.',
      ],
      [
          'q' => 'How is this different from hiring a local web designer?',
          'a' => 'Most web designers build once and disappear. This is an actively managed system — the build is the starting point, not the deliverable. The ongoing retainer is where the work actually compounds.',
      ],
      [
          'q' => 'Why can\'t I just use Wix or Squarespace?',
          'a' => 'You can, and they\'re fine for a digital business card. The gap shows up in search visibility. DIY platforms underperform on page speed, schema markup, and AEO optimization. If you want to be found before your competitors, the technical foundation matters.',
      ],
      [
          'q' => 'How long until I see results in search?',
          'a' => 'Honest answer: three to six months for meaningful organic movement. Google Business Profile improvements can show up faster, sometimes within weeks. The compounding nature of this work means the question shifts over time from "when will I see results" to "why are my competitors still behind."',
      ],
      [
          'q' => 'Do I need to be involved on an ongoing basis?',
          'a' => 'Minimally. Monthly check-ins to review the report and flag anything changing in your business. The operational work — content updates, GBP posts, citations — is handled. You stay focused on running the business.',
      ],
      [
          'q' => 'What does AEO mean and why does it matter?',
          'a' => 'Answer Engine Optimization. As AI search tools (ChatGPT, Perplexity, Google AI Overviews) become the first stop for local search queries, the question is whether your business shows up in those answers. AEO is the practice of structuring your content so AI systems can find, interpret, and cite you accurately. Traditional SEO still matters. AEO is what comes next.',
      ],
  ];
  ?>

  <!-- Hero -->
  <section class="mx-auto max-w-editorial px-6 pt-20 pb-20">
      <div class="running-head" aria-hidden="true">
          <span>shane logsdon &mdash; services</span>
          <span><?= date('Y.m.d') ?></span>
      </div>
      <h1 class="mt-12 max-w-[22ch] font-display font-normal text-foreground"
          style="font-size: clamp(2.5rem, 6.5vw, 5.5rem); line-height: 1.02; letter-spacing: -0.02em;">
          A web presence system that actively works to get you <span class="t-accent">found</span>.
      </h1>
  </section>

  <!-- Quick answer -->
  <section class="mx-auto max-w-editorial px-6 pb-20">
      <div class="grid grid-cols-12 gap-6 border-t border-rule pt-12">
          <div class="col-span-12 sm:col-span-3">
              <p class="smallcaps-lg">what this is</p>
          </div>
          <div class="col-span-12 space-y-5 sm:col-span-9">
              <p class="max-w-prose text-[1.1875rem] leading-[1.6] text-foreground">
                  I build done-for-you web presence systems for local business owners — website design and build, conversion-optimized from the start, paired with ongoing AEO and SEO management so your presence improves over time.
              </p>
              <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                  Most web services build once and disappear. The site goes live, the designer moves on, and the owner is left hoping search traffic materializes on its own. It usually doesn't. The gap between a site that exists and a site that actively brings in clients is active management, updated content, and the technical groundwork that search and AI systems look for.
              </p>
              <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                  This is both of those things, together, from one person who does this at enterprise scale at a global payments company.
              </p>
          </div>
      </div>
  </section>

  <!-- What's included -->
  <section class="mx-auto max-w-editorial px-6 pb-20">
      <div class="grid grid-cols-12 gap-6 border-t border-rule pt-12">
          <div class="col-span-12 sm:col-span-3">
              <p class="smallcaps-lg">what's included</p>
          </div>
          <div class="col-span-12 sm:col-span-9">
              <ol class="grid grid-cols-1">
                  <li class="grid grid-cols-12 gap-6 border-t border-rule py-8">
                      <p class="folio col-span-12 sm:col-span-2"><span class="pos">01</span></p>
                      <div class="col-span-12 sm:col-span-10">
                          <h3 class="font-display text-xl font-medium text-foreground">Website build</h3>
                          <p class="mt-2 max-w-prose text-[1rem] leading-relaxed text-muted-foreground">Design, development, and conversion-optimized copy. Mobile-first, fast load, basic schema markup, Google Business Profile setup and optimization, and sitemap submission. Built to rank, not just to exist.</p>
                      </div>
                  </li>
                  <li class="grid grid-cols-12 gap-6 border-t border-rule py-8">
                      <p class="folio col-span-12 sm:col-span-2"><span class="pos">02</span></p>
                      <div class="col-span-12 sm:col-span-10">
                          <h3 class="font-display text-xl font-medium text-foreground">Monthly retainer</h3>
                          <p class="mt-2 max-w-prose text-[1rem] leading-relaxed text-muted-foreground">AEO/SEO content updates, GBP posts, citation management, schema maintenance, AI search visibility monitoring, and a monthly report. The retainer is where the compounding happens. A presence that's actively maintained outperforms one that was built well but left alone.</p>
                      </div>
                  </li>
              </ol>
          </div>
      </div>
  </section>

  <!-- Who it's for -->
  <section class="mx-auto max-w-editorial px-6 pb-20">
      <div class="grid grid-cols-12 gap-6 border-t border-rule pt-12">
          <div class="col-span-12 sm:col-span-3">
              <p class="smallcaps-lg">who this is for</p>
          </div>
          <div class="col-span-12 space-y-5 sm:col-span-9">
              <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                  Professional services solo operators and owner-operated service businesses. The kind of owner who's good at their trade and has no interest in becoming a part-time digital marketer to keep the phone ringing.
              </p>
              <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                  This isn't the right fit for e-commerce, franchise operations, or businesses that want to build and manage their own presence. It's for owners who want to hand it off and get back to work.
              </p>
          </div>
      </div>
  </section>

  <!-- Why it's different -->
  <section class="mx-auto max-w-editorial px-6 pb-20">
      <div class="grid grid-cols-12 gap-6 border-t border-rule pt-12">
          <div class="col-span-12 sm:col-span-3">
              <p class="smallcaps-lg">why it's different</p>
          </div>
          <div class="col-span-12 space-y-5 sm:col-span-9">
              <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                  The work is informed by developer relations and AEO practice at enterprise scale. When I build schema markup or optimize for AI search visibility, I'm drawing on the same techniques used to make payment API documentation rank and get cited accurately in developer tooling searches.
              </p>
              <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                  Most local web designers don't think about answer engines. Most SEO agencies don't have a technical background deep enough to execute at the infrastructure level. This sits at that intersection.
              </p>
              <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                  And it's actively managed, not handed off. That's the one thing that separates a presence that improves from one that slowly decays.
              </p>
          </div>
      </div>
  </section>

  <!-- FAQ -->
  <section class="mx-auto max-w-editorial px-6 pb-20">
      <div class="grid grid-cols-12 gap-6 border-t border-rule pt-12">
          <div class="col-span-12 sm:col-span-3">
              <p class="smallcaps-lg">questions</p>
          </div>
          <div class="col-span-12 sm:col-span-9">
              <ol class="grid grid-cols-1">
                  <?php foreach ($faqs as $i => $faq): ?>
                  <li class="border-t border-rule py-8">
                      <h3 class="font-display text-lg font-medium text-foreground"><?= htmlspecialchars($faq['q']) ?></h3>
                      <p class="mt-3 max-w-prose text-[1rem] leading-relaxed text-muted-foreground"><?= htmlspecialchars($faq['a']) ?></p>
                  </li>
                  <?php endforeach; ?>
              </ol>
          </div>
      </div>
  </section>

  <!-- CTA -->
  <section class="relative mx-auto max-w-editorial px-6 pb-24">
      <div class="grid grid-cols-12 gap-6 border-t border-rule pt-12">
          <div class="col-span-12 sm:col-span-3">
              <p class="smallcaps-lg">get started</p>
          </div>
          <div class="col-span-12 sm:col-span-9">
              <h2 class="max-w-prose font-display text-3xl font-medium leading-tight text-foreground sm:text-4xl">
                  Let's look at your current presence.
              </h2>
              <p class="mt-5 max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                  Send a message and I'll pull together a free audit of your Google Business Profile and web presence — what's working, what's missing, and what closing the gaps would take.
              </p>
              <div class="mt-8">
                  <a href="/contact/" class="btn-arrow btn-arrow--accent">Get in touch</a>
              </div>
          </div>
      </div>
  </section>

  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [
      <?php foreach ($faqs as $i => $faq): ?>
      {
        "@type": "Question",
        "name": "<?= addslashes($faq['q']) ?>",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "<?= addslashes($faq['a']) ?>"
        }
      }<?= $i < count($faqs) - 1 ? ',' : '' ?>
      <?php endforeach; ?>
    ]
  }
  </script>
  ```

- [ ] **Step 2: Verify file was created**

  Run: `ls pages/services.php`
  Expected: `pages/services.php`

- [ ] **Step 3: Commit**

  ```bash
  git add pages/services.php
  git commit -m "feat: add /services page with FAQPage JSON-LD"
  ```

---

## Task 8: Add Services to site navigation

**Files:**
- Modify: `resources/partials/components/site-menu.php:3-7`

- [ ] **Step 1: Add Services to nav items**

  In `resources/partials/components/site-menu.php`, update the `$navItems` array from:
  ```php
  $navItems = [
      ['href' => '/about/', 'label' => 'About'],
      ['href' => '/articles/', 'label' => 'Articles'],
      ['href' => '/speaking/', 'label' => 'Speaking'],
      ['href' => '/resume/', 'label' => 'Resume'],
  ];
  ```
  To:
  ```php
  $navItems = [
      ['href' => '/about/', 'label' => 'About'],
      ['href' => '/articles/', 'label' => 'Articles'],
      ['href' => '/speaking/', 'label' => 'Speaking'],
      ['href' => '/services/', 'label' => 'Services'],
      ['href' => '/resume/', 'label' => 'Resume'],
  ];
  ```

- [ ] **Step 2: Commit**

  ```bash
  git add resources/partials/components/site-menu.php
  git commit -m "feat: add Services to site navigation"
  ```

---

## Task 9: Build and verify

- [ ] **Step 1: Run the full build**

  From the repo root:
  ```bash
  npm run build:css && composer build
  ```
  Expected: no errors; `dist/` directory updated.

- [ ] **Step 2: Verify static files are in dist**

  ```bash
  ls dist/llms.txt dist/pricing.md dist/services/index.html
  ```
  Expected: all three files present.

- [ ] **Step 3: Spot-check meta description on homepage**

  ```bash
  grep -o 'name="description" content="[^"]*"' dist/index.html
  ```
  Expected output contains: `Shane Logsdon — developer advocate at Global Payments`

- [ ] **Step 4: Spot-check Person schema on homepage**

  ```bash
  grep -o '"jobTitle"[^,]*' dist/index.html
  ```
  Expected: `"jobTitle": "Senior Director, Developer Advocacy"`

- [ ] **Step 5: Spot-check Article schema on an article page**

  ```bash
  grep -o '"@type": "Article"' dist/articles/technical-deep-dives/the-ax-shift/index.html
  ```
  Expected: `"@type": "Article"`

- [ ] **Step 6: Spot-check FAQPage schema on services**

  ```bash
  grep -o '"@type": "FAQPage"' dist/services/index.html
  ```
  Expected: `"@type": "FAQPage"`

- [ ] **Step 7: Spot-check services CTA on homepage**

  ```bash
  grep 'Work with me' dist/index.html
  ```
  Expected: one match linking to `/services/`

- [ ] **Step 8: Final commit if any build artifacts changed**

  If the build generated anything unexpected, investigate before committing. Otherwise the `dist/` directory is gitignored (verify with `cat .gitignore | grep dist`) and no commit is needed for build output.

  Check gitignore:
  ```bash
  cat .gitignore 2>/dev/null | grep dist || echo "dist not in gitignore — check before committing"
  ```

---

## Self-Review

### Spec coverage check

| Requirement | Task |
|-------------|------|
| /llms.txt | Task 1 |
| /pricing.md | Task 2 |
| Meta: homepage | Task 3, Step 1 |
| Meta: about | Task 3, Step 2 |
| Meta: articles | Task 3, Step 3 |
| Meta: contact | Task 3, Step 4 |
| Person JSON-LD on homepage | Task 4, Step 2 |
| Person JSON-LD on about | Task 4, Step 1 |
| Article JSON-LD on every article | Task 5 |
| /services page | Task 7 |
| FAQPage JSON-LD on /services | Task 7, Step 1 (in-template) |
| Homepage CTA update | Task 6 |
| Services in nav | Task 8 |

All requirements covered.

### Notes for implementer

- `pages/articles.php` was not read during planning — open the file and locate the `$this->layout()` call before editing (the description variable pattern is consistent across all pages).
- The `writing-post.php` layout uses `$url` which is set from the layout call at the top of that same file (line 29–38). The variable is in scope for the JSON-LD block at the bottom.
- `dist/` is the build output directory — check whether it's gitignored before staging any files from it.
- The services page copy intentionally does not include pricing numbers. The spec's `/pricing.md` handles pricing in a discoverable-but-not-prominently-placed format; the services page drives to `/contact` for a quote.
