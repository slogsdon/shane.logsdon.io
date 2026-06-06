<?php
$this->layout('partials::layouts/main', [
  'title' => 'Work',
    'url' => '/work/',
]);
$patentUrl =
    "http://appft.uspto.gov/netacgi/nph-Parser"
    . "?Sect1=PTO1&Sect2=HITOFF&d=PG01&p=1&u="
    . "%2Fnetahtml%2FPTO%2Fsrchnum.html&r=1&f="
    . "G&l=50&s1=%2220180060867%22.PGNR.&OS="
    . "DN/20180060867&RS=DN/20180060867";

$projects = [
    [
        'href' => '/hermes-dispatch/',
        'title' => 'Hermes Dispatch',
        'body' => 'Open source, local-first agent dispatch system. Type a request into a mobile chat, a routing layer sends it to the right one of two dozen specialized agents, and the agent runs on your own models via Ollama and LiteLLM.',
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
?>

<section class="mx-auto max-w-editorial px-6 pt-20 pb-12">
    <div class="running-head" aria-hidden="true">
        <span>shane logsdon &middot; work</span>
        <span><?= date('Y.m.d') ?></span>
    </div>
    <h1 id="title" class="mt-12 max-w-[18ch] font-display font-normal text-foreground"
        style="font-size: clamp(2.75rem, 7vw, 6rem); line-height: 1.0; letter-spacing: -0.02em;">
        Selected <span class="t-accent">work</span>.
    </h1>
</section>

<section class="mx-auto max-w-editorial px-6">
    <ol class="border-t border-rule">
        <?php foreach ($projects as $i => $p):
            $num = str_pad($i + 1, 3, '0', STR_PAD_LEFT);
            $external = str_starts_with($p['href'], 'http');
            $rel = $external ? ' target="_blank" rel="noreferrer noopener"' : '';
        ?>
        <li class="grid grid-cols-12 gap-6 border-b border-rule py-10">
            <div class="col-span-12 sm:col-span-2">
                <p class="folio"><span class="pos"><?= $num ?></span></p>
            </div>
            <div class="col-span-12 sm:col-span-10">
                <h2 class="font-display text-2xl font-medium text-foreground sm:text-3xl">
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
</section>

<section class="mx-auto max-w-editorial px-6 pt-12 pb-20">
    <div class="grid grid-cols-12 gap-6 border-t border-rule pt-12">
        <div class="col-span-12 sm:col-span-3">
            <p class="smallcaps-lg">other contributions</p>
        </div>
        <div class="col-span-12 sm:col-span-9">
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
</section>
