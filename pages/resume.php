<?php
$this->layout('partials::layouts/main', [
    'title'       => 'Resume',
    'description' => 'Shane Logsdon: 15+ years shipping payment platforms and developer experiences. Senior Director, Product Management – Developer Advocacy at Global Payments.',
    'url'         => '/resume/',
]);

// C · Sheet, by Q3 of the architecture test: staleness is the entire risk on a
// resume. A reader can act on an out-of-date version, so the sheet has to say
// which version it is. The title block carries revision and date, both read
// from git rather than typed, and it replaces the old "Rev. May 2026" margin
// note that had to be edited by hand.

// Roles drive both the list and the timeline, so the drawing cannot drift away
// from the entries below it. Reverse-chronological, newest first.
$roles = [
    [
        'num' => 'i', 'start' => '2023-07', 'end' => null,
        'title' => 'Senior Director, Product Management – Developer Advocacy',
        'company' => 'Global Payments Inc.', 'location' => 'Louisville, KY',
        'dates' => 'Jul 2023 &ndash; Present', 'rank' => 'Current role', 'dur' => '~2.8 yrs',
        'bullets' => [
            'Rebuilt the developer platform post-merger, consolidating two legacy GP+Worldpay API platforms into a single experience with multi-language sample projects, browser sandbox environments, and community infrastructure, growing developer engagement 55%+ from a standing start with no dedicated program budget.',
            'Overhauled developer support from ad-hoc escalation to structured triage, introducing diagnostic frameworks, standardized playbooks, and cross-language reference implementations that cut repeat issues and enterprise integration resolution times.',
            'Shipped GP\'s AI developer tooling ahead of most payment platforms (LLM context files for payment APIs, agentic workflow automations, and GP API Validator), building a support model that let a 3-person team handle enterprise-scale support.',
            'Built the team\'s KPI infrastructure from scratch, pulling support volume, product usage, and community signals into unified dashboards and monthly executive reporting, creating the first direct line from developer pain to product roadmap.',
            'Stood up the developer advocacy function from scratch (3-person team, FTE-only budget), establishing roadmaps, OKRs, and a career framework while driving product, engineering, and sales alignment through influence rather than spend.',
            'Took a purpose-built payment product from concept to market in the professional and home services vertical (tens of millions in annual processing volume), acquiring nearly 1,000 merchants and $300k+ ARR in the first year, with the product still growing.',
        ],
    ],
    [
        'num' => 'ii', 'start' => '2021-04', 'end' => '2023-07',
        'title' => 'Director of Product Management',
        'company' => 'Global Payments Inc.', 'location' => 'Louisville, KY',
        'dates' => 'Apr 2021 &ndash; Jul 2023', 'rank' => 'Director', 'dur' => '2.3 yrs',
        'bullets' => [
            'Expanded developer-experience initiatives across multiple business units, cutting integration time from weeks to days.',
            'Drove product strategy behind 20%+ year-over-year net revenue growth.',
            'Built strategic partnerships that opened new market segments.',
            'Managed technical resources across multiple product lines and improved integration success rates.',
        ],
    ],
    [
        'num' => 'iii', 'start' => '2020-03', 'end' => '2021-04',
        'title' => 'Senior Manager, Solutions Consulting',
        'company' => 'Global Payments Inc.', 'location' => 'Louisville, KY',
        'dates' => 'Mar 2020 &ndash; Apr 2021', 'rank' => 'Senior Manager', 'dur' => '1.1 yrs',
        'bullets' => [
            'Led a 20+ person developer team while transitioning into product leadership for US Online Payments solutions.',
            'Drove implementation strategy resulting in 10,000+ new merchant installations.',
            'Brought in multi-million dollar ARR through partner onboarding.',
            'Spoke at industry conferences and came back with hundreds of qualified leads.',
            'Shaped product strategy and roadmap while keeping integration teams coordinated.',
        ],
    ],
    [
        'num' => 'iv', 'start' => '2018-07', 'end' => '2020-03',
        'title' => 'Solutions Architect',
        'company' => 'Global Payments Inc.', 'location' => 'Louisville, KY',
        'dates' => 'Jul 2018 &ndash; Mar 2020', 'rank' => 'Architect', 'dur' => '1.7 yrs',
        'bullets' => [
            'Architected a multi-language SDK suite in C#/.NET, Java, PHP, Ruby, Python, and JavaScript.',
            'Enabled 1,000+ merchant integrations generating millions of dollars in annual recurring revenue.',
            'Led proof-of-concept projects securing 20+ strategic partner implementations.',
            'Defined the technical approach to integration patterns, shortening the path to first success for most partners.',
            'Handled final escalation on complex technical problems while mentoring the implementation teams.',
        ],
    ],
    [
        'num' => 'v', 'start' => '2017-03', 'end' => '2018-07',
        'title' => 'Senior Software Developer',
        'company' => 'Global Payments Inc.', 'location' => 'Louisville, KY',
        'dates' => 'Mar 2017 &ndash; Jul 2018', 'rank' => 'Tech lead', 'dur' => '1.4 yrs',
        'bullets' => [
            'Led SDK development for enterprise payment systems.',
            'Designed and implemented scalable integration patterns, reducing partner onboarding time by 40%.',
            'Established coding standards across multiple languages while mentoring junior developers.',
            'Built testing culture through consistent code-review standards.',
        ],
    ],
    [
        'num' => 'vi', 'start' => '2014-12', 'end' => '2017-03',
        'title' => 'Software Developer',
        'company' => 'Global Payments Inc.', 'location' => 'Louisville, KY',
        'dates' => 'Dec 2014 &ndash; Mar 2017', 'rank' => 'Individual contributor', 'dur' => '2.3 yrs',
        'bullets' => [
            'Implemented and maintained SDK libraries across multiple programming languages.',
            'Achieved a 30% reduction in integration-related support tickets.',
            'Worked with the support team to refine integration patterns and documentation.',
        ],
    ],
    [
        'num' => 'vii', 'start' => '2014-01', 'end' => '2014-10',
        'title' => 'Software Architect',
        'company' => 'StarkNine', 'location' => 'Louisville, KY',
        'dates' => 'Jan 2014 &ndash; Oct 2014', 'rank' => 'Architect', 'dur' => '10 mo',
        'bullets' => [
            'Designed and managed infrastructure for ChatBlend.com and DashSocial.com.',
            'Built fault-tolerant, scalable architecture with availability as a first-class concern.',
            'Ran the full product development cycle from concept to launch.',
            'Established monitoring and maintenance protocols for production systems.',
        ],
    ],
    [
        'num' => 'viii', 'start' => '2013-08', 'end' => '2014-02',
        'title' => 'Technical Lead',
        'company' => 'Blackstone Media Network', 'location' => 'Louisville, KY',
        'dates' => 'Aug 2013 &ndash; Feb 2014', 'rank' => 'Tech lead', 'dur' => '7 mo',
        'bullets' => [
            'Ran the development process end-to-end for client projects.',
            'Led systems design and specification writing for web applications.',
            'Managed deployments across Linux and Windows environments.',
            'Implemented .NET and PHP solutions across a range of client projects.',
        ],
    ],
    [
        'num' => 'ix', 'start' => '2012-02', 'end' => '2013-08',
        'title' => 'Web Developer',
        'company' => 'Blackstone Media Network', 'location' => 'Louisville, KY',
        'dates' => 'Feb 2012 &ndash; Aug 2013', 'rank' => 'Developer', 'dur' => '1.5 yrs',
        'bullets' => [
            'Developed web applications using .NET (Web Forms and MVC) and PHP.',
            'Implemented content-management solutions using WordPress and Magento.',
            'Performed DevOps tasks across Linux and Windows environments.',
            'Contributed to in-house product work alongside client projects.',
        ],
    ],
];

$capabilities = [
    ['idx' => '01', 'title' => 'Development &amp; Tools',          'body' => 'C#/.NET · Java · PHP · Ruby · Python · JavaScript. Version control, CI/CD pipelines, testing frameworks, and cloud platforms: the stack of a working SDK author.'],
    ['idx' => '02', 'title' => 'Payment Technology',               'body' => 'Gateway integration, multi-channel processing, PCI compliance, fraud prevention, payment authentication, alternative payment methods.'],
    ['idx' => '03', 'title' => 'Technical Leadership',             'body' => 'System and enterprise architecture, SDK development, integration-pattern design, developer-experience strategy, technical documentation and API design.'],
    ['idx' => '04', 'title' => 'Product Management',               'body' => 'Platform strategy, product lifecycle management, feature prioritization, roadmap development, market analysis, user research, metrics and analytics.'],
    ['idx' => '05', 'title' => 'Domain Expertise',                 'body' => 'Developer relations and platform advocacy, platform economics, digital transformation, fintech innovation, partner-ecosystem development.'],
    ['idx' => '06', 'title' => 'Leadership &amp; Communication',   'body' => 'Team leadership, strategic planning, cross-functional collaboration, technical evangelism, developer-community building.'],
];

// ── Figure data. Record chart, and the file it reconciles to is this one: every
// segment is drawn from a start and end date stated in the role list below, so
// a date edited above moves the drawing with it.
$monthIndex = function (string $ym): int {
    [$year, $month] = array_map('intval', explode('-', $ym));
    return ($year - 2012) * 12 + ($month - 1);
};
$presentYm = date('Y-m');
$axisSpan  = max(1, $monthIndex($presentYm));
// Bars run the full width and the employer name sits on its own line above
// each one. A left-hand label gutter wide enough for "blackstone media
// network" ate a third of the drawing, and the narrower viewBox that left
// behind rendered the mono type at about 4px once a phone scaled it down.
$plotX0    = 14;
$plotX1    = 506;
$plotX     = function (string $ym) use ($monthIndex, $axisSpan, $plotX0, $plotX1): float {
    return round($plotX0 + ($monthIndex($ym) / $axisSpan) * ($plotX1 - $plotX0), 1);
};

// Group by employer, preserving the reverse-chronological order of the list.
$byEmployer = [];
foreach ($roles as $role) {
    $byEmployer[$role['company']][] = $role;
}
$monthName = function (string $ym): string {
    return date('M Y', strtotime($ym . '-01'));
};
$timelineAria = [];
foreach ($byEmployer as $company => $group) {
    $first = end($group);
    $last  = reset($group);
    $timelineAria[] = $company . ', ' . $monthName($first['start']) . ' to '
        . ($last['end'] === null ? 'present' : $monthName($last['end'])) . '.';
}
?>
<style>
/* Scoped to the resume sheet. Everything else on this page is design-system
   classes from public/_/input.css. */
.rp-bullets li { position: relative; padding-left: 1.5rem; }
.rp-bullets li::before {
  content: '\2192'; position: absolute; left: 0; top: 0;
  font-family: 'JetBrains Mono', ui-monospace, monospace; font-size: 0.85em;
  color: var(--color-ink-3);
}

/* Bordered cell grids. Two up on a phone, four (stats) or two (capabilities)
   on a wide sheet. Two tracks, never twelve, so the gaps cannot outgrow the
   viewport. */
.rp-cells { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); border-top: 1px solid var(--color-rule); }
.rp-cells > div { padding: 1.25rem 1rem 1.25rem 0; border-bottom: 1px solid var(--color-rule); }
.rp-cells > div:nth-child(even) { padding-left: 1.5rem; padding-right: 0; border-left: 1px solid var(--color-rule); }
@media (min-width: 1024px) {
  .rp-cells--four { grid-template-columns: repeat(4, minmax(0, 1fr)); }
  .rp-cells--four > div { padding-left: 1.5rem; padding-right: 1rem; border-left: 1px solid var(--color-rule); }
  .rp-cells--four > div:first-child { padding-left: 0; border-left: 0; }
}
@media (max-width: 640px) {
  .rp-cells { grid-template-columns: minmax(0, 1fr); }
  .rp-cells > div,
  .rp-cells > div:nth-child(even) { padding: 1.25rem 0; border-left: 0; }
}

.rp-status-led {
  width: 7px; height: 7px; border-radius: var(--r-full); background: #3f6b3a;
  display: inline-block; margin-right: 6px; vertical-align: middle;
  box-shadow: 0 0 0 3px rgba(63, 107, 58, 0.12);
}

@media print {
  #site-header, footer, .inversion, .rp-noprint { display: none !important; }
  html, body { background: #fff !important; color: #0e1116 !important; }
  .sheet { border-width: 1px; }
  .sheet__field { padding: 0; }
  .rp-role { break-inside: avoid; page-break-inside: avoid; }
  a { color: #0e1116 !important; text-decoration: none !important; }
}
</style>

<div class="mx-auto max-w-editorial px-6 pt-10 pb-16">
<div class="sheet">
  <div class="sheet__field">

    <p class="smallcaps-lg">shane logsdon &middot; curriculum vitae &middot; est. 2008</p>

    <h1 class="mt-6 max-w-[22ch] font-display font-normal text-foreground"
        style="font-size: clamp(2rem, 4.4vw, 3.5rem); line-height: 1.05; letter-spacing: -0.018em;">
        Over fifteen years of shipping <span class="t-accent">payment platforms</span> engineers want to build on.
    </h1>

    <p class="mt-6 max-w-prose text-[1.0625rem] leading-[1.6] text-ink-soft">
        My work runs from production code to platform strategy. For the last decade at Global
        Payments, I&rsquo;ve been turning payment primitives into the SDKs, integrations, and
        developer experiences that engineers actually want to use.
    </p>

    <nav class="mt-8 flex flex-wrap items-baseline gap-x-10 gap-y-4" aria-label="Quick links">
        <a class="btn-arrow" href="#experience">Read the nine roles</a>
        <a class="btn-arrow" href="mailto:shane@logsdon.io">Email shane@logsdon.io</a>
        <a class="btn-arrow rp-noprint" href="#" onclick="window.print();return false;">Print or save this sheet as PDF</a>
    </nav>

    <!-- Contact panel -->
    <div class="mt-12 grid grid-cols-1 gap-x-10 gap-y-6 border-t border-rule pt-10 sm:grid-cols-[3fr_9fr]">
      <div>
        <p class="smallcaps-lg">contact</p>
      </div>
      <dl class="grid grid-cols-1 gap-x-10 gap-y-3 sm:grid-cols-2">
        <div class="grid grid-cols-[5rem_1fr] items-baseline gap-3" data-locale-tz="America/Kentucky/Louisville">
          <dt class="smallcaps">based</dt>
          <dd class="m-0 text-[0.9375rem] text-foreground">Louisville, KY &middot; <span data-locale-offset>GMT−5</span></dd>
        </div>
        <div class="grid grid-cols-[5rem_1fr] items-baseline gap-3">
          <dt class="smallcaps">email</dt>
          <dd class="m-0 text-[0.9375rem]"><a class="link-quiet" href="mailto:shane@logsdon.io">shane@logsdon.io</a></dd>
        </div>
        <div class="grid grid-cols-[5rem_1fr] items-baseline gap-3">
          <dt class="smallcaps">linkedin</dt>
          <dd class="m-0 text-[0.9375rem]"><a class="link-quiet" href="https://www.linkedin.com/in/shanelogsdon">/in/shanelogsdon</a></dd>
        </div>
        <div class="grid grid-cols-[5rem_1fr] items-baseline gap-3">
          <dt class="smallcaps">github</dt>
          <dd class="m-0 text-[0.9375rem]"><a class="link-quiet" href="https://github.com/slogsdon">/slogsdon</a></dd>
        </div>
        <div class="grid grid-cols-[5rem_1fr] items-baseline gap-3">
          <dt class="smallcaps">status</dt>
          <dd class="m-0 text-[0.9375rem] text-foreground"><span class="rp-status-led" aria-hidden="true"></span>Open to conversations</dd>
        </div>
      </dl>
    </div>

    <!-- At a glance. Stats first, then the sheet's one figure. C · Sheet allows
         at most one figure in the field. -->
    <div class="mt-16 grid grid-cols-1 gap-x-10 gap-y-6 border-t border-rule pt-10 sm:grid-cols-[3fr_9fr]">
      <div>
        <p class="smallcaps-lg">at a glance</p>
        <p class="mt-2 text-[0.8125rem] text-muted-foreground">Figures as of May 2026.</p>
      </div>
      <div>
        <div class="rp-cells rp-cells--four">
          <div>
            <p class="smallcaps">years in industry</p>
            <p class="mt-2 font-display text-[2rem] font-normal leading-none tracking-tight text-foreground">15+<sup class="text-[0.6em] text-muted-foreground">yrs</sup></p>
            <p class="mt-2 text-[0.8125rem] leading-relaxed text-muted-foreground">Since 2008: web dev through product leadership.</p>
          </div>
          <div>
            <p class="smallcaps">at global payments</p>
            <p class="mt-2 font-display text-[2rem] font-normal leading-none tracking-tight text-foreground">11<sup class="text-[0.6em] text-muted-foreground">yrs</sup></p>
            <p class="mt-2 text-[0.8125rem] leading-relaxed text-muted-foreground">Six roles. Dec 2014 &rarr; present.</p>
          </div>
          <div>
            <p class="smallcaps">merchant installs</p>
            <p class="mt-2 font-display text-[2rem] font-normal leading-none tracking-tight text-foreground">10k<sup class="text-[0.6em] text-muted-foreground">+</sup></p>
            <p class="mt-2 text-[0.8125rem] leading-relaxed text-muted-foreground">Via SDKs, integrations, and partner programs.</p>
          </div>
          <div>
            <p class="smallcaps">languages shipped</p>
            <p class="mt-2 font-display text-[2rem] font-normal leading-none tracking-tight text-foreground">6</p>
            <p class="mt-2 text-[0.8125rem] leading-relaxed text-muted-foreground">C#, Java, PHP, Ruby, Python, JavaScript.</p>
          </div>
        </div>

        <figure class="mt-10">
          <div class="figure-plate">
          <svg width="520" height="212" viewBox="0 0 520 212" role="img"
               aria-label="Career timeline, February 2012 to present. <?= htmlspecialchars(implode(' ', $timelineAria)) ?>">
            <text x="0" y="12" class="t-mono f-3">NINE ROLES, THREE EMPLOYERS</text>
            <line x1="0" y1="26" x2="520" y2="26" class="s-ink"/>

            <?php
            // Row 0 leaves room underneath for the dimension line; the rest sit
            // on a 40px pitch.
            $rowLabelY = [48, 110, 150];
            $rowIndex  = 0;
            $gpDim     = null;
            foreach ($byEmployer as $company => $group):
                $labelY = $rowLabelY[$rowIndex];
                $barY   = $labelY + 8;
                $first  = end($group);
                $last   = reset($group);
                if ($rowIndex === 0) {
                    $gpDim = [
                        'x0' => $plotX($first['start']),
                        'x1' => $plotX($last['end'] ?? $presentYm),
                        'y'      => $barY + 26,
                        'barBot' => $barY + 14,
                    ];
                }
            ?>
            <text x="0" y="<?= $labelY ?>" class="t-sans f-soft"><?= htmlspecialchars(strtolower($company)) ?></text>
            <text x="520" y="<?= $labelY ?>" text-anchor="end" class="t-mono f-3"><?= str_replace('-', '.', $first['start']) ?> &ndash; <?= $last['end'] === null ? 'present' : str_replace('-', '.', $last['end']) ?></text>
            <?php foreach (array_reverse($group) as $role):
                $x0 = $plotX($role['start']);
                $x1 = $plotX($role['end'] ?? $presentYm);
            ?>
            <rect x="<?= $x0 ?>" y="<?= $barY ?>" width="<?= max(2, round($x1 - $x0 - 1.5, 1)) ?>" height="14" class="f-ink" opacity="<?= $rowIndex === 0 ? '0.85' : '0.45' ?>"/>
            <?php endforeach; ?>
            <?php $rowIndex++; endforeach; ?>

            <?php if ($gpDim !== null): ?>
            <!-- The one annotation in the drawing: a dimension line under the
                 Global Payments band, carrying the 11-year figure the stats
                 state above it. -->
            <line x1="<?= $gpDim['x0'] ?>" y1="<?= $gpDim['barBot'] ?>" x2="<?= $gpDim['x0'] ?>" y2="<?= $gpDim['y'] + 4 ?>" class="s-mark"/>
            <line x1="<?= $gpDim['x1'] ?>" y1="<?= $gpDim['barBot'] ?>" x2="<?= $gpDim['x1'] ?>" y2="<?= $gpDim['y'] + 4 ?>" class="s-mark"/>
            <line x1="<?= $gpDim['x0'] ?>" y1="<?= $gpDim['y'] ?>" x2="<?= $gpDim['x1'] ?>" y2="<?= $gpDim['y'] ?>" class="s-mark"/>
            <text x="<?= round(($gpDim['x0'] + $gpDim['x1']) / 2, 1) ?>" y="<?= $gpDim['y'] - 5 ?>" text-anchor="middle" class="t-mono f-mark">11 yrs</text>
            <?php endif; ?>

            <line x1="0" y1="188" x2="520" y2="188" class="s-rule"/>
            <?php for ($year = 2012; $year <= (int) date('Y'); $year += 2):
                $tickX = $plotX(sprintf('%d-01', $year));
            ?>
            <line x1="<?= $tickX ?>" y1="188" x2="<?= $tickX ?>" y2="193" class="s-rule"/>
            <text x="<?= $tickX ?>" y="205" text-anchor="middle" class="t-mono f-3"><?= $year ?></text>
            <?php endfor; ?>
          </svg>
          </div>
          <figcaption class="figcaption">
            <b>Fig. 01</b> Employment span by employer. Source <b>pages/resume.php</b>, the nine dated
            roles listed below, read <?= date('Y.m.d') ?>. Bar length is time in role, divided at each
            role change. The dimension marks the Global Payments span. The axis starts at the earliest
            role this page carries a date for, 2012, so it covers less ground than the 15+ years the
            summary above states.
          </figcaption>
        </figure>
      </div>
    </div>

    <!-- Experience -->
    <div id="experience" class="mt-16 grid grid-cols-1 gap-x-10 gap-y-6 border-t border-rule pt-10 sm:grid-cols-[3fr_9fr]">
      <div>
        <p class="smallcaps-lg">experience</p>
        <!-- .folio is inline-flex, so each one needs a block wrapper or the
             two lines sit side by side. -->
        <p class="mt-3"><span class="folio">2012 &ndash; Present</span></p>
        <p class="mt-1"><span class="folio">09 roles &middot; 03 employers</span></p>
      </div>
      <div>
        <h2 class="max-w-[24ch] font-display text-[1.75rem] font-normal leading-tight tracking-tight text-foreground sm:text-[2.25rem]">
            Experience, in reverse-chronological order.
        </h2>
        <p class="mt-5 max-w-prose text-[0.9375rem] leading-relaxed text-muted-foreground">
            Nine roles across three employers. Each entry is working notes on what the job was and
            what shipped, not a keyword sheet.
        </p>

        <div class="mt-10 border-t border-rule">
          <?php foreach ($roles as $role): ?>
          <div class="rp-role grid grid-cols-1 gap-x-6 gap-y-3 border-b border-rule py-8 sm:grid-cols-[2.5rem_1fr] lg:grid-cols-[2.5rem_1fr_9rem]">
            <div class="t-accent pt-1 font-display text-xl leading-none" aria-hidden="true"><?= $role['num'] ?></div>
            <div>
              <h3 class="font-display text-[1.25rem] font-normal leading-snug tracking-tight text-foreground"><?= htmlspecialchars($role['title']) ?></h3>
              <p class="mt-2 text-[0.875rem] text-muted-foreground">
                <span class="font-medium text-ink-soft"><?= htmlspecialchars($role['company']) ?></span>
                <span class="mx-2 text-rule-strong">&middot;</span><?= htmlspecialchars($role['location']) ?>
              </p>
              <ul class="rp-bullets mt-4 grid gap-3">
                <?php foreach ($role['bullets'] as $bullet): ?>
                <li class="max-w-[68ch] text-[0.90625rem] leading-relaxed text-ink-soft"><?= htmlspecialchars($bullet) ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
            <div class="lg:text-right">
              <p><span class="folio"><?= $role['dates'] ?></span></p>
              <p class="smallcaps mt-2"><?= htmlspecialchars($role['rank']) ?></p>
              <p class="mt-1"><span class="folio"><?= htmlspecialchars($role['dur']) ?></span></p>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

    <!-- Capabilities -->
    <div class="mt-16 grid grid-cols-1 gap-x-10 gap-y-6 border-t border-rule pt-10 pb-12 sm:grid-cols-[3fr_9fr]">
      <div>
        <p class="smallcaps-lg">capabilities</p>
        <p class="mt-2 text-[0.8125rem] text-muted-foreground">Grouped, not ranked.</p>
      </div>
      <div>
        <h2 class="max-w-[24ch] font-display text-[1.75rem] font-normal leading-tight tracking-tight text-foreground sm:text-[2.25rem]">
            Capabilities and areas of practice.
        </h2>
        <p class="mt-5 max-w-prose text-[0.9375rem] leading-relaxed text-muted-foreground">
            Six working groups, the shapes I tend to recur to. Stacked by discipline rather than by
            hype. The tools in the first row are the ones I&rsquo;ve shipped against, not ones
            I&rsquo;ve only read about.
        </p>

        <div class="rp-cells mt-8">
          <?php foreach ($capabilities as $capability): ?>
          <div>
            <div class="grid grid-cols-[1.75rem_1fr] items-baseline gap-4">
              <span class="folio"><span class="pos"><?= $capability['idx'] ?></span></span>
              <div>
                <h4 class="font-display text-[1.0625rem] font-medium leading-snug text-foreground"><?= $capability['title'] ?></h4>
                <p class="mt-2 text-[0.84375rem] leading-relaxed text-ink-soft"><?= $capability['body'] ?></p>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

  </div>

  <?php $this->insert('partials::components/title-block', [
      'sheetNo'    => 'A-03',
      'sheetFile'  => 'pages/resume.php',
      'sheetTitle' => 'shane logsdon &middot; curriculum vitae',
      'sheetMeta'  => 'Louisville, Kentucky &middot; <a class="link-quiet" href="mailto:shane@logsdon.io">shane@logsdon.io</a> &middot; <a class="link-quiet" href="https://www.linkedin.com/in/shanelogsdon">/in/shanelogsdon</a>',
      'sheetRevFallback'  => '11',
      'sheetDateFallback' => '2026-07-29',
  ]); ?>
</div>
</div>

<?php $this->insert('partials::components/contact-cta', [
    'ctaEyebrow' => 'Correspondence',
    'ctaTitle'   => 'Open to conversations about payments, platforms, and developer-facing work.',
    'ctaBody'    => 'Currently at Global Payments and not actively looking, but always interested in talking to operators building developer-first products, whether that\'s about a role, an advisory conversation, or comparing notes.',
]); ?>

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
