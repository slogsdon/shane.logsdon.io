<?php
$this->layout('partials::layouts/main', [
    'title' => 'How I work',
    'description' => 'How Shane Logsdon makes product and engineering decisions: six principles, the practices behind them, and what to expect working together, each linked to the work that backs it.',
    'url' => '/how-i-work/',
]);

// C · Sheet, by Q3: these are current working principles, and a reader
// deciding whether to work with me could act on an out-of-date version, so the
// sheet has to say which revision it is. F, Q1 and Q2 are no: not the entry
// point, not a catalog, and the principles reorder without losing meaning.
// The 01–06 numbers are addresses ("principle 05"), not a sequence, the same
// device About uses for its expertise rows. The folio sits above the heading
// rather than in a side column so the body keeps its measure at phone width. No figure: nothing here is a
// proportion, a cycle or a dataset, so the field carries none. See DESIGN.md.
//
// Every principle carries an "on file" line pointing at public work that backs
// it. That is the page's credibility device: a claim a reader can check.

$guide = '/loop-and-gate/build-field-guide/';

$principles = [
    [
        'num'   => '01',
        'title' => 'Prove the problem before solving it',
        'body'  => 'A loud request and a real problem look the same from a distance. What separates them is a person who would pay to make it go away and the workaround they already live with. When a framing fails that test I&rsquo;d rather kill it than polish it, including when it&rsquo;s mine. LeadSurface began as a customer-discovery tool I built for myself, and it only became a product after I admitted a discovery tool gets used once, which is a weak thing to charge for twice.',
        'file'  => [['Build Field Guide, gate 0', $guide]],
    ],
    [
        'num'   => '02',
        'title' => 'The interface someone builds against is the product',
        'body'  => 'For a developer platform, the API, the SDK, the error message, the sample project, and the support thread are one experience, and the developer doesn&rsquo;t care which team owns which piece. I spent my first years at Global Payments maintaining SDK libraries and working with support to refine the integration patterns and documentation around them. Integration-related tickets dropped 30% over that stretch.',
        'file'  => [['Resume, software developer, 2014&ndash;2017', '/resume/']],
    ],
    [
        'num'   => '03',
        'title' => 'Measure the outcome, not the activity',
        'body'  => 'Logins, stars, and accounts created are easy to count and rarely what anyone is paying for. I set the success signal as an observable change in behavior before the work starts. For LeadSurface that&rsquo;s a founder reaching a potential customer within four hours of the original post, while the thread is still live. At Global Payments it meant building KPI reporting that put support volume, product usage, and community signals side by side, which gave us our first direct line from developer pain to the roadmap.',
        'file'  => [
            ['Build Field Guide, gate 1', $guide],
            ['What Do We Measure When AI Answers the Questions?', '/articles/strategic-insights/what-do-we-measure/'],
        ],
    ],
    [
        'num'   => '04',
        'title' => 'Ship the least thing that&rsquo;s real',
        'body'  => 'Scope and finish are negotiable. Soundness isn&rsquo;t. I&rsquo;ll ship something rough on purpose when the roughness teaches me something, but data integrity, honest errors, and a path that works end to end are never the parts I cut. LeadSurface&rsquo;s onboarding is clumsy by choice. I onboard each early customer by hand because it keeps me in the room learning who they&rsquo;re targeting, and a polished flow would automate away the conversation that matters most right now.',
        'file'  => [['Build Field Guide, gate 2', $guide]],
    ],
    [
        'num'   => '05',
        'title' => 'Let the blast radius set the process',
        'body'  => 'A copy fix and a billing change don&rsquo;t deserve the same ceremony, and treating them alike wastes effort on one or invites harm on the other. I size who gets hurt if it&rsquo;s wrong and whether it can be taken back, then decide how much planning, review, and testing the change earns. In the same week I fixed a dead-end signup link in minutes and kept LeadSurface&rsquo;s billing work in careful progress behind written specs, because charging someone incorrectly isn&rsquo;t something a user can undo with a click.',
        'file'  => [['Build Field Guide, gates 8 and &infin;', $guide]],
    ],
    [
        'num'   => '06',
        'title' => 'Evidence over demos, especially with agents',
        'body'  => 'I build with AI agents every day, and the code still carries my name, so the bar goes up rather than down. A change isn&rsquo;t done because the agent says it ran. I want to know what fails and turns red if it breaks next month. The agent handles execution. Direction, architecture, and what ships stay my decisions.',
        'file'  => [
            ['Build Field Guide, gate 6', $guide],
            ['Building on the Margins', '/articles/strategic-insights/building-on-the-margins/'],
        ],
    ],
];

// Practices are things I do, not things I believe. Each carries the lens it
// needs (product, engineering, or both), the same metadata the field guide
// gives its gates. Unordered, so unnumbered.
$practices = [
    [
        'lens'  => 'product',
        'title' => 'A written brief before any plan',
        'body'  => 'The specific person, the problem in their words, what &ldquo;fixed&rdquo; looks like, and how we&rsquo;d measure it. Everything after is built against that page, so it&rsquo;s where I want the disagreement first, while it&rsquo;s cheap.',
    ],
    [
        'lens'  => 'product',
        'title' => 'Support as product research',
        'body'  => 'Recurring tickets are the cheapest research a platform gets. At Global Payments I moved developer support from ad-hoc escalation to structured triage with diagnostic frameworks and standardized playbooks, then fed that volume into the same reporting as product usage.',
    ],
    [
        'lens'  => 'engineering',
        'title' => 'One contract across every language',
        'body'  => 'When I architected the SDK suite in C#, Java, PHP, Ruby, Python, and JavaScript, the job was keeping names, defaults, and errors consistent enough that a developer moving between languages kept the same mental model. A name that needs a comment to explain what it does is a name that&rsquo;s wrong.',
    ],
    [
        'lens'  => 'engineering',
        'title' => 'Feel the friction before a customer does',
        'body'  => 'When my own product fights me on something users will do all day, the architecture is asking to be redone while it&rsquo;s cheap. LeadSurface stored signals as markdown files until reviewing a few days of them got painful, and moved to Postgres before a customer hit the same wall.',
    ],
    [
        'lens'  => 'engineering',
        'title' => 'Ask for the test, not the transcript',
        'body'  => 'I read the assertion against the acceptance criterion and ask what input would make it fail, because a test that can&rsquo;t fail isn&rsquo;t testing anything. For anything a user touches, that means a deterministic browser test over an agent&rsquo;s one-off click-through.',
    ],
    [
        'lens'  => 'both',
        'title' => 'Ship imperfect output behind a control',
        'body'  => 'When I ship something I know will sometimes be wrong, the user gets a way to correct it. Every LeadSurface signal card carries a thumbs up and a thumbs down, so a misfire costs one click and becomes feedback that sharpens the system.',
    ],
];

$sectionClass = 'mt-16 scroll-mt-24 grid grid-cols-1 gap-x-10 gap-y-6 border-t border-rule pt-10 sm:grid-cols-[3fr_9fr]';
$bodyClass    = 'max-w-prose text-base leading-relaxed text-ink-soft';
?>

<div class="mx-auto max-w-editorial px-6 pt-10 pb-16">
  <div class="sheet">
    <div class="sheet__field">

      <p class="smallcaps-lg">how I work</p>
      <h1 class="mt-6 max-w-[22ch] font-display font-normal text-foreground"
          style="font-size: clamp(2rem, 4.4vw, 3.5rem); line-height: 1.05; letter-spacing: -0.018em;">
        Ship the least thing that&rsquo;s <span class="t-accent">real</span>, and let what&rsquo;s at stake decide how much rigor it gets.
      </h1>

      <div class="mt-6 max-w-prose space-y-4">
        <p class="text-[1.0625rem] leading-[1.6] text-ink-soft">
          I started at Global Payments writing SDK libraries and spent more than a decade moving
          through solutions architecture into product leadership, ending as the person running
          developer advocacy for the merged GP and Worldpay platform. Each move put me on the
          other side of a decision I used to receive. Building LeadSurface solo puts me on every
          side at once.
        </p>
        <p class="text-[1.0625rem] leading-[1.6] text-ink-soft">
          This is what I&rsquo;ve kept from that: six principles I make decisions from, the
          practices that put them to work, and what to expect if we work together. Each principle
          points at the work behind it, so you can check it rather than take my word for it.
        </p>
      </div>

      <nav class="mt-8 flex flex-wrap gap-x-6 gap-y-3 text-sm" aria-label="On this page">
        <a class="link-quiet" href="#principles">Principles</a>
        <a class="link-quiet" href="#practices">Practices</a>
        <a class="link-quiet" href="#working-with-me">Working with me</a>
        <a class="link-quiet" href="#still-learning">Still learning</a>
      </nav>

      <section id="principles" aria-labelledby="principles-heading" class="<?= $sectionClass ?>">
        <h2 id="principles-heading" class="smallcaps-lg leading-relaxed">principles</h2>
        <ol>
          <?php foreach ($principles as $i => $p): ?>
          <li id="principle-<?= $p['num'] ?>" class="scroll-mt-24 py-6 <?= $i < count($principles) - 1 ? 'border-b border-rule' : '' ?>"<?= $i === 0 ? ' style="padding-top:0"' : '' ?>>
            <span class="folio"><span class="pos"><?= $p['num'] ?></span></span>
            <div class="mt-2">
              <h3 class="font-display text-xl font-medium leading-snug text-foreground"><?= $p['title'] ?></h3>
              <p class="mt-3 <?= $bodyClass ?>"><?= $p['body'] ?></p>
              <p class="mt-3 text-sm leading-relaxed text-muted-foreground">
                <span class="smallcaps">on file</span>
                <?php foreach ($p['file'] as $j => [$label, $href]): ?><?= $j ? ' &middot; ' : ' ' ?><a class="link-quiet" href="<?= $href ?>"><?= $label ?></a><?php endforeach; ?>
              </p>
            </div>
          </li>
          <?php endforeach; ?>
        </ol>
      </section>

      <section id="practices" aria-labelledby="practices-heading" class="<?= $sectionClass ?>">
        <div>
          <h2 id="practices-heading" class="smallcaps-lg leading-relaxed">practices</h2>
          <p class="mt-3 max-w-[24ch] text-sm leading-relaxed text-muted-foreground">
            What the principles look like on a working day. The tag is the lens each one needs.
          </p>
        </div>
        <ul>
          <?php foreach ($practices as $i => $p): ?>
          <li class="py-6 <?= $i < count($practices) - 1 ? 'border-b border-rule' : '' ?>"<?= $i === 0 ? ' style="padding-top:0"' : '' ?>>
            <p class="smallcaps"><?= $p['lens'] ?></p>
            <h3 class="mt-2 font-display text-lg font-medium leading-snug text-foreground"><?= $p['title'] ?></h3>
            <p class="mt-2 <?= $bodyClass ?>"><?= $p['body'] ?></p>
          </li>
          <?php endforeach; ?>
        </ul>
      </section>

      <section id="working-with-me" aria-labelledby="working-with-me-heading" class="<?= $sectionClass ?>">
        <h2 id="working-with-me-heading" class="smallcaps-lg leading-relaxed">working with me</h2>
        <div class="max-w-prose space-y-8">
          <div>
            <h3 class="font-display text-lg font-medium leading-snug text-foreground">I write first</h3>
            <p class="mt-2 <?= $bodyClass ?>">
              I default to async. I&rsquo;d rather send one complete message than trade five partial
              ones, and a meeting should have a decision to make, not a status update I could have
              read. When we decide something in a meeting, expect me to write it down and share it,
              reasoning included, so the next conversation starts from there.
            </p>
          </div>
          <div>
            <h3 class="font-display text-lg font-medium leading-snug text-foreground">Give me the why, then the room</h3>
            <p class="mt-2 <?= $bodyClass ?>">
              Tell me the outcome you need and the business reason behind it, and I&rsquo;ll often
              find a better path than the one you sketched. Once the goal is set, I work best with
              autonomy over the approach. If something is blocked or an assumption changed, I&rsquo;ll
              say so early, and I need that to be safe to do.
            </p>
          </div>
          <div>
            <h3 class="font-display text-lg font-medium leading-snug text-foreground">Push back with something I can act on</h3>
            <p class="mt-2 <?= $bodyClass ?>">
              Direct and specific beats gentle and vague. &ldquo;I think this approach misses X&rdquo;
              is feedback. &ldquo;I don&rsquo;t know if this is right&rdquo; isn&rsquo;t. I&rsquo;ll
              change my position for a better argument, including on my own ideas, but not for
              politics or comfort.
            </p>
          </div>
          <div>
            <h3 class="font-display text-lg font-medium leading-snug text-foreground">How to read me</h3>
            <p class="mt-2 <?= $bodyClass ?>">
              When the core assumptions feel unconfirmed, I&rsquo;ll often propose a much smaller
              scope or a different approach entirely. That&rsquo;s how I avoid wasted effort, so
              engage with the reasoning rather than the &ldquo;no.&rdquo; I&rsquo;ll also reframe
              activities as outcomes: &ldquo;post more content&rdquo; becomes &ldquo;which signal are
              we trying to move?&rdquo; Pushback from me is engagement. Silence on a plan, or a shift
              into delivering exactly what was asked and nothing more, is the thing to ask me about.
            </p>
          </div>
        </div>
      </section>

      <section id="still-learning" aria-labelledby="still-learning-heading" class="<?= $sectionClass ?> pb-12">
        <h2 id="still-learning-heading" class="smallcaps-lg leading-relaxed">still learning</h2>
        <div class="max-w-prose space-y-4">
          <p class="<?= $bodyClass ?>">
            I&rsquo;m good at building things well. The risk is building the wrong things well, so
            I&rsquo;m working on staying in validation longer before I switch into build mode, and on
            saying &ldquo;we shouldn&rsquo;t do this&rdquo; clearly and early instead of
            over-engineering my way around a constraint.
          </p>
          <p class="<?= $bodyClass ?>">
            The other is delegation. When I can finish something faster myself, the pull is to do it,
            and that trade costs the team the capability. I&rsquo;m learning to take the slower path
            on purpose.
          </p>
          <p class="pt-6 text-sm leading-relaxed text-muted-foreground">
            The long version of most of this, gate by gate with every decision above in full, is the
            <a class="link-quiet" href="<?= $guide ?>">Build Field Guide</a>. The roles and results
            behind it are on the <a class="link-quiet" href="/resume/">resume</a>.
          </p>
        </div>
      </section>

    </div>
    <?php $this->insert('partials::components/title-block', [
        'sheetNo' => 'A-05',
        'sheetFile' => 'pages/how-i-work.php',
        'sheetTitle' => 'shane logsdon &middot; principles and practices',
        'sheetMeta' => '<a class="link-quiet" href="/about/">about</a> &middot; <a class="link-quiet" href="/resume/">experience</a> &middot; <a class="link-quiet" href="' . $guide . '">build field guide</a>',
        'sheetRevFallback' => '2',
        'sheetDateFallback' => '2026-11-27',
    ]); ?>
  </div>
</div>

<?php $this->insert('partials::components/contact-cta', [
    'ctaEyebrow' => 'Compare notes',
    'ctaTitle'   => 'If this is how you want product and engineering to work, let’s talk.',
    'ctaBody'    => 'I enjoy comparing notes with people building serious developer products and platform teams. The best place to start is LinkedIn.',
]); ?>
