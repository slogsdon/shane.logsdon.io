<?php
$this->layout('partials::layouts/main', [
    'title'       => 'Resume',
    'description' => 'Shane Logsdon: 15+ years shipping payment platforms and developer experiences. Senior Director, Product Management – Developer Advocacy at Global Payments.',
    'url'         => '/resume/',
]);
?>
<style>
/* ── Resume page tokens & layout ──────────────────────────────── */
.resume-page {
  /* Aliases to v2 design tokens — kept namespaced so the resume's CSS stays scoped. */
  --rp-paper:        var(--color-surface);
  --rp-paper-2:      var(--color-surface-muted);
  --rp-ink:          var(--color-ink);
  --rp-ink-2:        var(--color-ink-soft);
  --rp-ink-3:        var(--color-ink-3);
  --rp-ink-4:        #9a9287;
  --rp-accent:       var(--color-accent);
  --rp-accent-hover: var(--color-accent-hover);
  --rp-ok:           #3f6b3a;
  --rp-line:         var(--color-rule);
  --rp-line-faint:   #1a17140a;

  color: var(--rp-ink);
  background: var(--rp-paper);
}

/* Container */
.rp-frame { max-width: 1180px; margin: 0 auto; padding: 0 2rem; }

/* Hero */
.rp-hero {
  position: relative;
  padding: 4rem 0 6rem;
  border-bottom: 1px solid var(--rp-line);
  overflow: hidden;
}
.rp-hero::before {
  content: ''; position: absolute; inset: 0; pointer-events: none;
  background-image:
    linear-gradient(to right,  var(--rp-line-faint) 1px, transparent 1px),
    linear-gradient(to bottom, var(--rp-line-faint) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: linear-gradient(to bottom, #000 55%, transparent 100%);
  -webkit-mask-image: linear-gradient(to bottom, #000 55%, transparent 100%);
}
.rp-hero-inner { position: relative; }
.rp-hero-grid {
  display: grid;
  grid-template-columns: 180px 1fr 260px;
  gap: 2rem;
  align-items: start;
}
.rp-marg {
  font-family: 'Fraunces', 'Iowan Old Style', Georgia, serif;
  font-weight: 600;
  font-variant-caps: small-caps;
  font-feature-settings: 'smcp';
  text-transform: lowercase;
  font-size: 12px; letter-spacing: 0.1em;
  color: var(--rp-ink-3); line-height: 1.9;
}
.rp-marg .k { display: block; color: var(--rp-ink-2); }
.rp-marg .k + .k { margin-top: 1rem; color: var(--rp-ink-3); }
.rp-marg .dateline {
  font-family: 'JetBrains Mono', ui-monospace, monospace;
  font-variant-caps: normal; text-transform: none; font-weight: 400;
  letter-spacing: 0.06em; font-size: 11px;
}

.rp-hero-byline {
  font-family: 'Fraunces', 'Iowan Old Style', Georgia, serif;
  font-weight: 600;
  font-variant-caps: small-caps; font-feature-settings: 'smcp';
  text-transform: lowercase;
  font-size: 12px; letter-spacing: 0.1em;
  color: var(--rp-ink-3); margin-bottom: 1.5rem;
}
.rp-hero-byline .sep { color: var(--rp-ink-4); margin: 0 0.5rem; }

.rp-hero-title {
  font-family: 'Fraunces', 'Iowan Old Style', Georgia, serif;
  font-weight: 400;
  font-size: clamp(2.5rem, 5.2vw, 4.25rem);
  line-height: 1.04; letter-spacing: -0.02em;
  margin: 0 0 2rem; color: var(--rp-ink);
  font-variation-settings: 'opsz' 144, 'SOFT' 30;
}
/* Single amber type-accent on the subject phrase — replaces italics-emphasis */
.rp-hero-title em {
  font-style: normal;
  color: var(--rp-accent);
  font-variation-settings: 'opsz' 144;
}

.rp-hero-lead {
  font-family: 'IBM Plex Sans', ui-sans-serif, system-ui, sans-serif;
  font-size: 15px; line-height: 1.7; color: var(--rp-ink-2);
  margin: 0 0 2rem; max-width: 58ch;
}

.rp-hero-actions {
  display: flex; gap: 2rem; flex-wrap: wrap; margin-top: 1.5rem;
  font-family: 'Fraunces', 'Iowan Old Style', Georgia, serif;
  font-weight: 600;
  font-variant-caps: small-caps; font-feature-settings: 'smcp';
  text-transform: lowercase;
  font-size: 14px; letter-spacing: 0.08em;
}
.rp-hero-actions a {
  color: var(--rp-ink-2); text-decoration: none;
  border-bottom: 1px solid var(--rp-line); padding-bottom: 4px;
}
.rp-hero-actions a:hover { color: var(--rp-ink); border-bottom-color: var(--rp-ink); }
.rp-hero-actions a::after { content: ' →'; color: var(--rp-ink-3); }

.rp-hero-meta { display: grid; gap: 1rem; padding-top: 8px; }
.rp-hero-meta .row { display: grid; grid-template-columns: 80px 1fr; gap: 0.75rem; align-items: baseline; }
.rp-hero-meta .lbl {
  font-family: 'Fraunces', Georgia, serif; font-weight: 600;
  font-variant-caps: small-caps; font-feature-settings: 'smcp';
  text-transform: lowercase;
  font-size: 12px; letter-spacing: 0.1em; color: var(--rp-ink-3);
}
.rp-hero-meta .val { font-family: 'IBM Plex Sans', ui-sans-serif, system-ui, sans-serif; font-size: 14px; color: var(--rp-ink); }
.rp-hero-meta .val a { color: var(--rp-accent); text-decoration: underline; text-underline-offset: 3px; }
.rp-hero-meta .led { width: 7px; height: 7px; border-radius: 50%; background: #3F6B3A; display: inline-block; margin-right: 6px; vertical-align: middle; box-shadow: 0 0 0 3px rgba(63,107,58,.12); }

/* Section scaffold */
.rp-section { padding: 4rem 0; border-bottom: 1px solid var(--rp-line); }
.rp-section:last-of-type { border-bottom: 0; }

.rp-sec-kicker {
  display: grid; grid-template-columns: 1fr auto; align-items: baseline;
  padding-bottom: 0.75rem; border-bottom: 1px solid var(--rp-line);
  margin-bottom: 2rem;
  font-family: 'Fraunces', Georgia, serif; font-weight: 600;
  font-variant-caps: small-caps; font-feature-settings: 'smcp';
  text-transform: lowercase;
  font-size: 12px; letter-spacing: 0.1em; color: var(--rp-ink-3);
}

.rp-sec-title {
  font-family: 'Fraunces', Georgia, serif; font-weight: 400;
  font-size: clamp(1.75rem, 3.2vw, 2.5rem);
  line-height: 1.1; letter-spacing: -0.02em; margin: 0 0 2rem;
  color: var(--rp-ink);
}
/* Amber type-accent — one phrase per section, replacing italics emphasis */
.rp-sec-title em { font-style: normal; color: var(--rp-accent); }

.rp-sec-lead {
  font-family: 'IBM Plex Sans', ui-sans-serif, system-ui, sans-serif; font-size: 15px; line-height: 1.7;
  color: var(--rp-ink-2); margin: 0 0 2rem; max-width: 58ch;
}

/* Two-column marginalia layout */
.rp-two-col {
  display: grid;
  grid-template-columns: 180px 1fr;
  gap: 2rem;
  align-items: start;
}

/* Experience entries */
.rp-role {
  display: grid;
  grid-template-columns: 100px 1fr 180px;
  column-gap: 1.5rem;
  padding: 2rem 0;
  border-bottom: 1px solid var(--rp-line);
  align-items: baseline;
}
.rp-role:first-child { border-top: 1px solid var(--rp-line); }
.rp-role:last-child  { border-bottom: 0; }

.rp-role .n {
  font-family: 'Fraunces', Georgia, serif; font-weight: 400;
  font-size: 1.5rem; color: var(--rp-accent); line-height: 1; padding-top: 6px;
  font-variant-numeric: oldstyle-nums;
}

.rp-role .body h3 {
  font-family: 'Fraunces', Georgia, serif; font-weight: 400;
  font-size: 1.375rem; line-height: 1.25; letter-spacing: -0.01em;
  margin: 0 0 0.5rem; color: var(--rp-ink);
}
.rp-role .body .sub {
  font-family: 'IBM Plex Sans', ui-sans-serif, system-ui, sans-serif; font-size: 14px; color: var(--rp-ink-3);
  margin: 0 0 1rem;
}
.rp-role .body .sub .dot { color: var(--rp-ink-4); margin: 0 0.5rem; }
.rp-role .body .sub .co { color: var(--rp-ink-2); font-weight: 500; }

.rp-role .body ul { list-style: none; margin: 0; padding: 0; display: grid; gap: 0.75rem; }
.rp-role .body ul li {
  font-family: 'IBM Plex Sans', ui-sans-serif, system-ui, sans-serif; font-size: 14.5px; line-height: 1.65;
  color: var(--rp-ink-2); padding-left: 1.5rem; position: relative; max-width: 68ch;
}
.rp-role .body ul li::before {
  content: '→'; position: absolute; left: 0; top: 0;
  color: var(--rp-ink-4); font-family: 'Fraunces', Georgia, serif;
}

.rp-role .right {
  text-align: right;
  font-family: 'JetBrains Mono', monospace; font-size: 11px;
  letter-spacing: 0.06em;
  color: var(--rp-ink-3); line-height: 1.8; padding-top: 8px;
}
.rp-role .right b { display: block; color: var(--rp-ink-2); font-weight: 400; }
.rp-role .right small {
  display: block; color: var(--rp-ink-3);
  font-family: 'Fraunces', Georgia, serif; font-weight: 600;
  font-variant-caps: small-caps; font-feature-settings: 'smcp';
  text-transform: lowercase; font-size: 12px; letter-spacing: 0.1em;
}
.rp-role .right .dur { color: var(--rp-ink-4); margin-top: 4px; display: block; }

/* Stats row */
.rp-stats {
  display: grid; grid-template-columns: repeat(4, 1fr);
  border-top: 1px solid var(--rp-line);
  border-bottom: 1px solid var(--rp-line);
  margin-top: 2rem;
}
.rp-stat { padding: 1.5rem 1rem; border-right: 1px solid var(--rp-line); }
.rp-stat:last-child { border-right: 0; }
.rp-stat .lbl {
  font-family: 'Fraunces', Georgia, serif; font-weight: 600;
  font-variant-caps: small-caps; font-feature-settings: 'smcp';
  text-transform: lowercase;
  font-size: 12px; letter-spacing: 0.1em; color: var(--rp-ink-3); margin-bottom: 0.5rem;
}
.rp-stat .num { font-family: 'Fraunces', Georgia, serif; font-weight: 400; font-size: 2rem; line-height: 1; letter-spacing: -0.02em; color: var(--rp-ink); }
.rp-stat .num sup { font-size: 0.6em; color: var(--rp-ink-3); margin-left: 2px; font-style: normal; }
.rp-stat .note { font-family: 'IBM Plex Sans', ui-sans-serif, system-ui, sans-serif; font-size: 12px; color: var(--rp-ink-3); margin-top: 0.5rem; }

/* Skills grid */
.rp-skills { display: grid; grid-template-columns: repeat(2, 1fr); gap: 0; border-top: 1px solid var(--rp-line); }
.rp-skill {
  padding: 1.5rem 2rem 1.5rem 0;
  border-bottom: 1px solid var(--rp-line);
  display: grid; grid-template-columns: 28px 1fr; gap: 1rem;
  align-items: baseline;
}
.rp-skill:nth-child(odd)  { padding-right: 2rem; }
.rp-skill:nth-child(even) { padding-left: 2rem; border-left: 1px solid var(--rp-line); }
.rp-skill .idx { font-family: 'JetBrains Mono', monospace; font-size: 12px; letter-spacing: 0.06em; color: var(--rp-ink-4); }
.rp-skill h4 { font-family: 'Fraunces', Georgia, serif; font-weight: 500; font-size: 1.0625rem; line-height: 1.25; letter-spacing: -0.005em; margin: 0 0 0.5rem; color: var(--rp-ink); }
.rp-skill p  { font-family: 'IBM Plex Sans', ui-sans-serif, system-ui, sans-serif; font-size: 13.5px; line-height: 1.6; color: var(--rp-ink-2); margin: 0; }

/* Doc strip */
.rp-doc-strip {
  display: flex; justify-content: space-between; align-items: center;
  padding: 1rem 0;
  border-top: 1px solid var(--rp-line);
  border-bottom: 1px solid var(--rp-line);
  margin-top: 2rem;
  font-family: 'JetBrains Mono', monospace; font-size: 11px;
  letter-spacing: 0.06em; color: var(--rp-ink-3);
}
.rp-doc-strip a { color: var(--rp-ink-2); text-decoration: none; border-bottom: 1px solid var(--rp-line); padding-bottom: 3px; }
.rp-doc-strip a:hover { color: var(--rp-ink); border-bottom-color: var(--rp-ink); }

/* CTA band — dark inversion (the canonical v2 feature treatment), not a warm-on-warm clay block */
.rp-cta-band {
  background: var(--rp-ink);
  color: var(--rp-paper);
  padding: 4rem 0;
}
.rp-cta-band .rp-marg { color: rgba(251, 250, 249, 0.55); }
.rp-cta-band .rp-marg .k { color: rgba(251, 250, 249, 0.55); }
.rp-cta-band h2 { color: var(--rp-paper); }
.rp-cta-band p { color: rgba(251, 250, 249, 0.72); }
.rp-cta-grid { display: grid; grid-template-columns: 180px 1fr; gap: 2rem; align-items: start; }
.rp-cta-body { max-width: 560px; }
.rp-cta-body h2 {
  font-family: 'Fraunces', Georgia, serif; font-weight: 400;
  font-size: clamp(1.75rem, 3vw, 2.25rem); line-height: 1.1; letter-spacing: -0.02em;
  margin: 0 0 1rem; color: var(--rp-ink);
}
.rp-cta-body p { font-family: 'IBM Plex Sans', ui-sans-serif, system-ui, sans-serif; font-size: 15px; line-height: 1.65; color: var(--rp-ink-2); margin: 0 0 1.5rem; }

/* btn-arrow — the only button in v2 (filled .btn was removed) */
.rp-btn-dark {
  display: inline; font-family: 'IBM Plex Sans', ui-sans-serif, system-ui, sans-serif; font-size: 16px; font-weight: 400;
  color: var(--rp-paper); text-decoration: underline;
  text-decoration-color: rgba(251, 250, 249, 0.3); text-underline-offset: 5px;
  text-decoration-thickness: 1px;
  transition: text-decoration-color 200ms ease;
}
.rp-btn-dark:hover { text-decoration-color: var(--rp-paper); color: var(--rp-paper); }
.rp-btn-dark::after { content: ' →'; font-family: 'JetBrains Mono', monospace; font-size: 0.85em; }
.rp-handle {
  font-family: 'Fraunces', Georgia, serif; font-weight: 600;
  font-variant-caps: small-caps; font-feature-settings: 'smcp';
  text-transform: lowercase;
  font-size: 12px; letter-spacing: 0.1em; color: rgba(251, 250, 249, 0.55); margin-left: 1.5rem;
}

/* Responsive */
@media (max-width: 900px) {
  .rp-hero-grid { grid-template-columns: 1fr; }
  .rp-hero-meta { padding-top: 0; }
  .rp-two-col { grid-template-columns: 1fr; }
  .rp-role { grid-template-columns: 1fr; row-gap: 0.75rem; }
  .rp-role .right { text-align: left; }
  .rp-skills { grid-template-columns: 1fr; }
  .rp-skill:nth-child(even) { border-left: 0; padding-left: 0; }
  .rp-stats { grid-template-columns: repeat(2, 1fr); }
  .rp-stat { border-right: 0; border-bottom: 1px solid var(--rp-line); }
  .rp-cta-grid { grid-template-columns: 1fr; }
}
@media (max-width: 640px) {
  .rp-frame { padding: 0 1.25rem; }
  .rp-hero { padding: 2.5rem 0 4rem; }
}

/* Print */
@media print {
  /* Hide site chrome — header/footer come from the layout, not this page */
  #site-header, footer { display: none !important; }

  /* Reset the site's dark body background */
  html, body { background: #fff !important; color: #1A1714 !important; }

  /* Hide screen-only elements */
  .rp-hero::before, .rp-doc-strip, .rp-cta-band { display: none !important; }

  /* Container */
  .resume-page { background: #fff; }
  .rp-frame { padding: 0; }

  /* Hero */
  .rp-hero { padding: 1rem 0 1.5rem; border-bottom: 1px solid #ccc; }
  .rp-hero-grid { grid-template-columns: 140px 1fr 210px; gap: 1.25rem; }

  /* Sections */
  .rp-section { padding: 1.25rem 0; border-bottom-color: #ddd; break-inside: avoid; page-break-inside: avoid; }
  .rp-two-col { grid-template-columns: 140px 1fr; gap: 1.25rem; }

  /* Experience rows — tighter for print */
  .rp-role { grid-template-columns: 56px 1fr 145px; column-gap: 0.75rem; padding: 0.875rem 0; border-bottom-color: #ddd; }
  .rp-role:first-child { border-top-color: #ddd; }
  .rp-role .body ul li { font-size: 13px; }

  /* Stats */
  .rp-stats { border-color: #ddd; }
  .rp-stat { border-right-color: #ddd; padding: 0.875rem 0.75rem; }

  /* Skills */
  .rp-skills { border-top-color: #ddd; }
  .rp-skill { border-bottom-color: #ddd; padding: 0.875rem 1.25rem 0.875rem 0; }
  .rp-skill:nth-child(even) { border-left-color: #ddd; }

  /* Links */
  a { color: #1A1714 !important; text-decoration: none !important; }
}
</style>

<div class="resume-page">

  <!-- ── HERO ─────────────────────────────────────── -->
  <section class="rp-hero">
    <div class="rp-frame rp-hero-inner">
      <div class="rp-hero-grid">

        <aside class="rp-marg" aria-hidden="true">
          <span class="k">resume / 01</span>
          <span class="k dateline">Rev. May 2026</span>
        </aside>

        <div>
          <div class="rp-hero-byline">Shane Logsdon <span class="sep">·</span> Curriculum Vitae <span class="sep">·</span> Est. 2008</div>
          <h1 class="rp-hero-title">Over fifteen years of shipping <em>payment platforms</em> engineers want to build on.</h1>
          <p class="rp-hero-lead">My work runs from production code to platform strategy. For the last decade at Global Payments, I've been turning payment primitives into the SDKs, integrations, and developer experiences that engineers actually want to use.</p>
          <nav class="rp-hero-actions" aria-label="Quick links">
            <a href="#experience">Jump to experience</a>
            <a href="mailto:shane@logsdon.io">Get in touch</a>
          </nav>
        </div>

        <aside>
          <dl class="rp-hero-meta">
            <div class="row" data-locale-tz="America/Kentucky/Louisville"><dt class="lbl">Based</dt><dd class="val">Louisville, KY · <span data-locale-offset>GMT−5</span></dd></div>
            <div class="row"><dt class="lbl">Email</dt><dd class="val"><a href="mailto:shane@logsdon.io">shane@logsdon.io</a></dd></div>
            <div class="row"><dt class="lbl">LinkedIn</dt><dd class="val"><a href="https://www.linkedin.com/in/shanelogsdon">/in/shanelogsdon</a></dd></div>
            <div class="row"><dt class="lbl">GitHub</dt><dd class="val"><a href="https://github.com/slogsdon">/slogsdon</a></dd></div>
            <div class="row"><dt class="lbl">Status</dt><dd class="val"><span class="led" aria-hidden="true"></span>Open to conversations</dd></div>
          </dl>
        </aside>

      </div>
    </div>
  </section>

  <!-- ── AT A GLANCE ──────────────────────────────── -->
  <div class="rp-frame">
    <section class="rp-section" style="padding-top: 3rem;">
      <div class="rp-sec-kicker">
        <span>at a glance / 02</span>
        <span>figures as of may 2026</span>
      </div>

      <div class="rp-stats">
        <div class="rp-stat">
          <div class="lbl">Years in industry</div>
          <div class="num">15+<sup>yrs</sup></div>
          <div class="note">Since 2008: web dev through product leadership.</div>
        </div>
        <div class="rp-stat">
          <div class="lbl">At Global Payments</div>
          <div class="num">11<sup>yrs</sup></div>
          <div class="note">Five roles. Dec 2014 → present.</div>
        </div>
        <div class="rp-stat">
          <div class="lbl">Merchant installs</div>
          <div class="num">10k<sup>+</sup></div>
          <div class="note">Via SDKs, integrations, and partner programs.</div>
        </div>
        <div class="rp-stat">
          <div class="lbl">Languages shipped</div>
          <div class="num">6</div>
          <div class="note">C#, Java, PHP, Ruby, Python, JavaScript.</div>
        </div>
      </div>

      <div class="rp-doc-strip">
        <span>Resume · Shane Logsdon · 2026</span>
        <a href="#" onclick="window.print();return false;">Print / Save as PDF</a>
      </div>
    </section>
  </div>

  <!-- ── EXPERIENCE ──────────────────────────────── -->
  <div class="rp-frame">
    <section class="rp-section" id="experience">
      <div class="rp-two-col">

        <aside class="rp-marg" aria-label="Section context">
          <span class="k">experience / 03</span>
          <span class="k dateline">2012 &ndash; Present</span>
          <span class="k dateline">09 roles · 03 employers</span>
        </aside>

        <div>
          <h2 class="rp-sec-title">Experience, in <em>reverse-chronological</em> order.</h2>
          <p class="rp-sec-lead">Nine roles across three employers. Each entry is working notes on what the job was and what shipped, not a keyword sheet.</p>

          <!-- i — Senior Director, Product Management – Developer Advocacy -->
          <div class="rp-role">
            <div class="n" aria-hidden="true">i</div>
            <div class="body">
              <h3>Senior Director, Product Management – Developer Advocacy</h3>
              <p class="sub"><span class="co">Global Payments Inc.</span><span class="dot">·</span>Louisville, KY</p>
              <ul>
                <li>Rebuilt the developer platform post-merger, consolidating two legacy GP+Worldpay API platforms into a single experience with multi-language sample projects, browser sandbox environments, and community infrastructure, growing developer engagement 55%+ from a standing start with no dedicated program budget.</li>
                <li>Overhauled developer support from ad-hoc escalation to structured triage, introducing diagnostic frameworks, standardized playbooks, and cross-language reference implementations that cut repeat issues and enterprise integration resolution times.</li>
                <li>Shipped GP's AI developer tooling ahead of most payment platforms (LLM context files for payment APIs, agentic workflow automations, and GP API Validator), building a support model that let a 3-person team handle enterprise-scale support.</li>
                <li>Built the team's KPI infrastructure from scratch, pulling support volume, product usage, and community signals into unified dashboards and monthly executive reporting, creating the first direct line from developer pain to product roadmap.</li>
                <li>Stood up the developer advocacy function from scratch (3-person team, FTE-only budget), establishing roadmaps, OKRs, and a career framework while driving product, engineering, and sales alignment through influence rather than spend.</li>
                <li>Took a purpose-built payment product from concept to market in the professional and home services vertical (tens of millions in annual processing volume), acquiring nearly 1,000 merchants and $300k+ ARR in the first year, with the product still growing.</li>
              </ul>
            </div>
            <div class="right">
              <b>Jul 2023 &ndash; Present</b>
              <small>Current role</small>
              <span class="dur">~2.8 yrs</span>
            </div>
          </div>

          <!-- ii — Director of Product Management -->
          <div class="rp-role">
            <div class="n" aria-hidden="true">ii</div>
            <div class="body">
              <h3>Director of Product Management</h3>
              <p class="sub"><span class="co">Global Payments Inc.</span><span class="dot">·</span>Louisville, KY</p>
              <ul>
                <li>Expanded developer-experience initiatives across multiple business units, cutting integration time from weeks to days.</li>
                <li>Drove product strategy behind 20%+ year-over-year net revenue growth.</li>
                <li>Built strategic partnerships that opened new market segments.</li>
                <li>Managed technical resources across multiple product lines and improved integration success rates.</li>
              </ul>
            </div>
            <div class="right">
              <b>Apr 2021 &ndash; Jul 2023</b>
              <small>Director</small>
              <span class="dur">2.3 yrs</span>
            </div>
          </div>

          <!-- iii — Senior Manager, Solutions Consulting -->
          <div class="rp-role">
            <div class="n" aria-hidden="true">iii</div>
            <div class="body">
              <h3>Senior Manager, Solutions Consulting</h3>
              <p class="sub"><span class="co">Global Payments Inc.</span><span class="dot">·</span>Louisville, KY</p>
              <ul>
                <li>Led a 20+ person developer team while transitioning into product leadership for US Online Payments solutions.</li>
                <li>Drove implementation strategy resulting in 10,000+ new merchant installations.</li>
                <li>Brought in multi-million dollar ARR through partner onboarding.</li>
                <li>Spoke at industry conferences and came back with hundreds of qualified leads.</li>
                <li>Shaped product strategy and roadmap while keeping integration teams coordinated.</li>
              </ul>
            </div>
            <div class="right">
              <b>Mar 2020 &ndash; Apr 2021</b>
              <small>Senior Manager</small>
              <span class="dur">1.1 yrs</span>
            </div>
          </div>

          <!-- iv — Solutions Architect -->
          <div class="rp-role">
            <div class="n" aria-hidden="true">iv</div>
            <div class="body">
              <h3>Solutions Architect</h3>
              <p class="sub"><span class="co">Global Payments Inc.</span><span class="dot">·</span>Louisville, KY</p>
              <ul>
                <li>Architected a multi-language SDK suite in C#/.NET, Java, PHP, Ruby, Python, and JavaScript.</li>
                <li>Enabled 1,000+ merchant integrations generating millions of dollars in annual recurring revenue.</li>
                <li>Led proof-of-concept projects securing 20+ strategic partner implementations.</li>
                <li>Defined the technical approach to integration patterns, shortening the path to first success for most partners.</li>
                <li>Handled final escalation on complex technical problems while mentoring the implementation teams.</li>
              </ul>
            </div>
            <div class="right">
              <b>Jul 2018 &ndash; Mar 2020</b>
              <small>Architect</small>
              <span class="dur">1.7 yrs</span>
            </div>
          </div>

          <!-- v — Senior Software Developer -->
          <div class="rp-role">
            <div class="n" aria-hidden="true">v</div>
            <div class="body">
              <h3>Senior Software Developer</h3>
              <p class="sub"><span class="co">Global Payments Inc.</span><span class="dot">·</span>Louisville, KY</p>
              <ul>
                <li>Led SDK development for enterprise payment systems.</li>
                <li>Designed and implemented scalable integration patterns, reducing partner onboarding time by 40%.</li>
                <li>Established coding standards across multiple languages while mentoring junior developers.</li>
                <li>Built testing culture through consistent code-review standards.</li>
              </ul>
            </div>
            <div class="right">
              <b>Mar 2017 &ndash; Jul 2018</b>
              <small>Tech lead</small>
              <span class="dur">1.4 yrs</span>
            </div>
          </div>

          <!-- vi — Software Developer -->
          <div class="rp-role">
            <div class="n" aria-hidden="true">vi</div>
            <div class="body">
              <h3>Software Developer</h3>
              <p class="sub"><span class="co">Global Payments Inc.</span><span class="dot">·</span>Louisville, KY</p>
              <ul>
                <li>Implemented and maintained SDK libraries across multiple programming languages.</li>
                <li>Achieved a 30% reduction in integration-related support tickets.</li>
                <li>Worked with the support team to refine integration patterns and documentation.</li>
              </ul>
            </div>
            <div class="right">
              <b>Dec 2014 &ndash; Mar 2017</b>
              <small>Individual contributor</small>
              <span class="dur">2.3 yrs</span>
            </div>
          </div>

          <!-- vii — Software Architect, StarkNine -->
          <div class="rp-role">
            <div class="n" aria-hidden="true">vii</div>
            <div class="body">
              <h3>Software Architect</h3>
              <p class="sub"><span class="co">StarkNine</span><span class="dot">·</span>Louisville, KY</p>
              <ul>
                <li>Designed and managed infrastructure for ChatBlend.com and DashSocial.com.</li>
                <li>Built fault-tolerant, scalable architecture with availability as a first-class concern.</li>
                <li>Ran the full product development cycle from concept to launch.</li>
                <li>Established monitoring and maintenance protocols for production systems.</li>
              </ul>
            </div>
            <div class="right">
              <b>Jan 2014 &ndash; Oct 2014</b>
              <small>Architect</small>
              <span class="dur">10 mo</span>
            </div>
          </div>

          <!-- viii — Technical Lead, Blackstone -->
          <div class="rp-role">
            <div class="n" aria-hidden="true">viii</div>
            <div class="body">
              <h3>Technical Lead</h3>
              <p class="sub"><span class="co">Blackstone Media Network</span><span class="dot">·</span>Louisville, KY</p>
              <ul>
                <li>Ran the development process end-to-end for client projects.</li>
                <li>Led systems design and specification writing for web applications.</li>
                <li>Managed deployments across Linux and Windows environments.</li>
                <li>Implemented .NET and PHP solutions across a range of client projects.</li>
              </ul>
            </div>
            <div class="right">
              <b>Aug 2013 &ndash; Feb 2014</b>
              <small>Tech lead</small>
              <span class="dur">7 mo</span>
            </div>
          </div>

          <!-- ix — Web Developer, Blackstone -->
          <div class="rp-role">
            <div class="n" aria-hidden="true">ix</div>
            <div class="body">
              <h3>Web Developer</h3>
              <p class="sub"><span class="co">Blackstone Media Network</span><span class="dot">·</span>Louisville, KY</p>
              <ul>
                <li>Developed web applications using .NET (Web Forms and MVC) and PHP.</li>
                <li>Implemented content-management solutions using WordPress and Magento.</li>
                <li>Performed DevOps tasks across Linux and Windows environments.</li>
                <li>Contributed to in-house product work alongside client projects.</li>
              </ul>
            </div>
            <div class="right">
              <b>Feb 2012 &ndash; Aug 2013</b>
              <small>Developer</small>
              <span class="dur">1.5 yrs</span>
            </div>
          </div>

        </div>
      </div>
    </section>
  </div>

  <!-- ── CAPABILITIES ─────────────────────────────── -->
  <div class="rp-frame">
    <section class="rp-section">
      <div class="rp-two-col">

        <aside class="rp-marg" aria-hidden="true">
          <span class="k">capabilities / 04</span>
          <span class="k">grouped, not ranked</span>
        </aside>

        <div>
          <h2 class="rp-sec-title">Capabilities &amp; <em>areas of practice</em>.</h2>
          <p class="rp-sec-lead">Six working groups, the shapes I tend to recur to. Stacked by discipline rather than by hype. The tools in the first row are the ones I've shipped against, not ones I've only read about.</p>

          <div class="rp-skills">
            <div class="rp-skill">
              <div class="idx">01</div>
              <div>
                <h4>Development &amp; Tools</h4>
                <p>C#/.NET · Java · PHP · Ruby · Python · JavaScript. Version control, CI/CD pipelines, testing frameworks, and cloud platforms: the stack of a working SDK author.</p>
              </div>
            </div>
            <div class="rp-skill">
              <div class="idx">02</div>
              <div>
                <h4>Payment Technology</h4>
                <p>Gateway integration, multi-channel processing, PCI compliance, fraud prevention, payment authentication, alternative payment methods.</p>
              </div>
            </div>
            <div class="rp-skill">
              <div class="idx">03</div>
              <div>
                <h4>Technical Leadership</h4>
                <p>System and enterprise architecture, SDK development, integration-pattern design, developer-experience strategy, technical documentation and API design.</p>
              </div>
            </div>
            <div class="rp-skill">
              <div class="idx">04</div>
              <div>
                <h4>Product Management</h4>
                <p>Platform strategy, product lifecycle management, feature prioritization, roadmap development, market analysis, user research, metrics and analytics.</p>
              </div>
            </div>
            <div class="rp-skill">
              <div class="idx">05</div>
              <div>
                <h4>Domain Expertise</h4>
                <p>Developer relations and platform advocacy, platform economics, digital transformation, fintech innovation, partner-ecosystem development.</p>
              </div>
            </div>
            <div class="rp-skill">
              <div class="idx">06</div>
              <div>
                <h4>Leadership &amp; Communication</h4>
                <p>Team leadership, strategic planning, cross-functional collaboration, technical evangelism, developer-community building.</p>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>
  </div>

  <!-- ── CTA ──────────────────────────────────────── -->
  <section class="rp-cta-band">
    <div class="rp-frame">
      <div class="rp-cta-grid">
        <aside class="rp-marg" aria-hidden="true">
          <span class="k">correspondence / 05</span>
        </aside>
        <div class="rp-cta-body">
          <h2>Open to conversations about payments, platforms, and developer-facing work.</h2>
          <p>Currently at Global Payments and not actively looking, but always interested in talking to operators building developer-first products, whether that's about a role, an advisory conversation, or comparing notes.</p>
          <div style="display:flex;align-items:center;flex-wrap:wrap;gap:0.5rem 0;">
            <a href="mailto:shane@logsdon.io" class="rp-btn-dark">Send an email</a>
            <span class="rp-handle">shane@logsdon.io &nbsp;·&nbsp; /in/shanelogsdon</span>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>

<script>
(function () {
    var host = document.querySelector('[data-locale-tz]');
    var target = host && host.querySelector('[data-locale-offset]');
    if (!host || !target) return;
    try {
        var parts = new Intl.DateTimeFormat('en-US', {
            timeZone: host.dataset.localeTz,
            timeZoneName: 'shortOffset'
        }).formatToParts(new Date());
        var name = parts.find(function (p) { return p.type === 'timeZoneName'; });
        if (name && name.value) target.textContent = name.value;
    } catch (e) {}
})();
</script>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Person",
  "@id": "https://shane.logsdon.io/#Person",
  "email": "shane@logsdon.io"
}
</script>
