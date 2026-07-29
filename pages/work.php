<?php
$this->layout('partials::layouts/main', [
  'title' => 'Work',
    'description' => 'Selected projects and work by Shane Logsdon, including LeadSurface, the Loop & Gate system, Hermes Dispatch, developer platforms at Global Payments, and a payments patent.',
    'url' => '/work/',
]);

// C · Sheet, by Q3: each project carries its own revision, so the page has a
// current state that can go stale and has to say when it last changed. Every
// value in the title block is read from git rather than typed.
//
// Zero figures. DESIGN.md maps a "project schematic" to this page, but the
// project data here is titles, prose, and links. There is no measured split,
// no series, and no file the drawing would reconcile to, so any schematic
// would be inventing quantities to have something to draw. Figures are
// additive or they do not ship. No figure also means no annotation red.

$patentUrl =
    "http://appft.uspto.gov/netacgi/nph-Parser"
    . "?Sect1=PTO1&Sect2=HITOFF&d=PG01&p=1&u="
    . "%2Fnetahtml%2FPTO%2Fsrchnum.html&r=1&f="
    . "G&l=50&s1=%2220180060867%22.PGNR.&OS="
    . "DN/20180060867&RS=DN/20180060867";

$projects = [
    [
        'href' => 'https://www.leadsurface.com',
        'title' => 'LeadSurface',
        'body' => 'Competitor-switch intelligence for revenue teams. It reads developer and SaaS communities and surfaces high-intent switching signals while the conversation is still live. A real product with real customers, built and shipped weekly through a Loop & Gate workflow.',
        'meta' => [['label' => 'read the story', 'href' => '/articles/strategic-insights/building-on-the-margins/']],
    ],
    [
        'href' => '/loop-and-gate/',
        'title' => 'The Loop & Gate System',
        'body' => 'A Foundation layer plus three kits for building, marketing, and following through on your own projects with an AI agent. An agentic loop runs on its own most of the time, but stops at a fixed set of gates where a human has to decide.',
        'meta' => [['label' => 'open source', 'href' => 'https://github.com/slogsdon/loop-and-gate-foundation']],
    ],
    [
        'href' => '/hermes-dispatch/',
        'title' => 'Hermes Dispatch',
        'body' => 'Open source, local-first dispatch layer for the Hermes agent by Nous Research. Type a request into a mobile chat, a router sends it to the right one of more than two dozen specialized agents, and it runs on your own models via Ollama and LiteLLM.',
        'meta' => [['label' => 'open source', 'href' => 'https://github.com/slogsdon/hermes-dispatch']],
    ],
    [
        'href' => 'https://github.com/hps/heartland-tokenization',
        'title' => 'Secure Submit',
        'body' => 'Heartland Payment Systems\' JavaScript library for single-use tokenization across card-present and card-not-present merchants.',
        'meta' => [['label' => 'patent pending', 'href' => $patentUrl]],
    ],
    [
        'href' => 'https://github.com/slogsdon/sap',
        'title' => 'Sap',
        'body' => 'Toolkit for Elixir web applications to accept and respond to HTTP requests using a decision tree built with combinators.',
        'meta' => [],
    ],
];
$projectTotal = count($projects);
?>

<div class="mx-auto max-w-editorial px-6 pt-10 pb-16">
<div class="sheet">
  <div class="sheet__field">

    <h1 class="max-w-[18ch] font-display font-normal text-foreground"
        style="font-size: clamp(2rem, 4.4vw, 3.5rem); line-height: 1.05; letter-spacing: -0.018em;">
        Selected <span class="t-accent">work</span>.
    </h1>

    <p class="mt-6 max-w-prose text-[1.0625rem] leading-[1.6] text-ink-soft">
        Each row links out to the thing itself, to its source, or to the piece I wrote about
        building it. <?= $projectTotal ?> on file.
    </p>

    <!-- The field is the list. Two-track rows: folio, then the project. -->
    <ol class="mt-12 border-t border-rule">
        <?php foreach ($projects as $i => $p):
            $num = str_pad($i + 1, 3, '0', STR_PAD_LEFT);
            $external = str_starts_with($p['href'], 'http');
            $rel = $external ? ' target="_blank" rel="noreferrer noopener"' : '';
        ?>
        <li class="grid grid-cols-[3.5rem_1fr] gap-4 border-b border-rule py-8">
            <span class="folio"><span class="pos"><?= $num ?></span></span>
            <div>
                <h2 class="font-display text-2xl font-medium leading-snug text-foreground sm:text-3xl">
                    <a href="<?= htmlspecialchars($p['href']) ?>"<?= $rel ?> class="link-quiet"><?= htmlspecialchars($p['title']) ?></a>
                </h2>
                <p class="mt-3 max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                    <?= htmlspecialchars($p['body']) ?>
                </p>
                <?php if (!empty($p['meta'])): ?>
                <ul class="mt-4 flex flex-wrap items-baseline gap-x-4">
                    <?php foreach ($p['meta'] as $m): ?>
                    <li><a class="smallcaps hover:!text-foreground" href="<?= htmlspecialchars($m['href']) ?>" target="_blank" rel="noreferrer noopener"><?= htmlspecialchars($m['label']) ?></a></li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </div>
        </li>
        <?php endforeach; ?>
    </ol>

    <!-- Other contributions -->
    <div class="mt-16 grid grid-cols-1 gap-x-10 gap-y-6 border-t border-rule pt-10 pb-12 sm:grid-cols-[3fr_9fr]">
        <div>
            <p class="smallcaps-lg">other contributions</p>
        </div>
        <div>
            <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                See work under these organizations on GitHub:
            </p>
            <ul class="mt-4 flex flex-wrap items-baseline gap-x-6 gap-y-2">
                <li><a class="btn-arrow" href="https://github.com/slogsdon" target="_blank" rel="noreferrer noopener">@slogsdon</a></li>
                <li><a class="btn-arrow" href="https://github.com/hps" target="_blank" rel="noreferrer noopener">@hps</a></li>
                <li><a class="btn-arrow" href="https://github.com/globalpayments" target="_blank" rel="noreferrer noopener">@globalpayments</a></li>
            </ul>
        </div>
    </div>

  </div>

  <?php $this->insert('partials::components/title-block', [
      'sheetNo'    => 'A-02',
      'sheetFile'  => 'pages/work.php',
      'sheetTitle' => 'shane logsdon &middot; selected work',
      'sheetMeta'  => $projectTotal . ' projects on file &middot; <a class="link-quiet" href="/about/">how I got here</a> &middot; <a class="link-quiet" href="/contact/">start a conversation</a>',
      'sheetRevFallback'  => '15',
      'sheetDateFallback' => '2026-07-28',
  ]); ?>
</div>
</div>
