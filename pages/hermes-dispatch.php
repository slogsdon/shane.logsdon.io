<?php
$this->layout('partials::layouts/main', [
    'title' => 'Hermes Dispatch',
    'description' => 'An open source, local-first agent dispatch system. Type a request into a mobile chat, a dispatch layer routes it to the right specialized agent, and the agent runs on your own models via Ollama and LiteLLM.',
    'url' => '/hermes-dispatch/',
]);

$repo = 'https://github.com/slogsdon/hermes-dispatch';

$aliases = [
    ['name' => 'classify', 'use' => 'Fast triage and routing. Picks the agent.'],
    ['name' => 'chat', 'use' => 'Fast conversational back-and-forth.'],
    ['name' => 'review', 'use' => 'Code review.'],
    ['name' => 'code', 'use' => 'Code generation.'],
    ['name' => 'analyze', 'use' => 'Reasoning and analysis, including prompt expansion.'],
    ['name' => 'pipeline', 'use' => 'Fast structured tasks.'],
    ['name' => 'write', 'use' => 'Long-form prose.'],
    ['name' => 'quality', 'use' => 'Best quality, for accuracy-critical work.'],
];

$tiers = [
    [
        'label' => 'Do it Yourself',
        'body' => 'Documentation only. Clone the repo, read the setup guide, wire your own models and agents. Free, and you keep full control of every config file.',
    ],
    [
        'label' => 'Do it With Me',
        'body' => 'An interactive setup.sh walks you through model mapping, agent selection, and Tailscale config one prompt at a time. You answer questions, it writes the files.',
    ],
    [
        'label' => 'Do it For Me',
        'body' => 'A Docker Compose stack that brings up dispatch, the agents, and the mobile UI together. Map your model aliases, point it at a backend, and it runs.',
    ],
];
?>

<!-- Hero -->
<section class="mx-auto max-w-editorial px-6 pt-20 pb-20">
    <div class="running-head" aria-hidden="true">
        <span>shane logsdon &middot; hermes dispatch</span>
        <span><?= date('Y.m.d') ?></span>
    </div>
    <h1 class="mt-12 max-w-[20ch] font-display font-normal text-foreground"
        style="font-size: clamp(2.5rem, 6.5vw, 5.5rem); line-height: 1.02; letter-spacing: -0.02em;">
        Type a request. The right <span class="t-accent">agent</span> answers.
    </h1>
    <p class="mt-8 max-w-prose text-[1.1875rem] leading-[1.6] text-muted-foreground">
        An open source, local-first agent dispatch system. One chat box on your phone, a routing layer that knows which of two dozen specialized agents should take the job, and models that run on your own hardware.
    </p>
    <div class="mt-10 flex flex-wrap items-baseline gap-x-6 gap-y-3">
        <a href="<?= htmlspecialchars($repo) ?>" target="_blank" rel="noreferrer noopener" class="btn-arrow btn-arrow--accent">View on GitHub</a>
        <p class="text-sm text-muted-foreground">MIT licensed. Built on the Hermes AI harness.</p>
    </div>
</section>

<!-- What it is -->
<section class="mx-auto max-w-editorial px-6 pb-20">
    <div class="grid grid-cols-12 gap-6 border-t border-rule pt-12">
        <div class="col-span-12 sm:col-span-3">
            <p class="smallcaps-lg">what this is</p>
        </div>
        <div class="col-span-12 space-y-5 sm:col-span-9">
            <p class="max-w-prose text-[1.1875rem] leading-[1.6] text-foreground">
                Hermes Dispatch turns a fleet of local LLM agents into something you can use from your phone like a single assistant. You type a request in plain language. A dispatch layer figures out which agent is the right one, expands your prompt into a proper brief, and hands it off. The agent runs locally through Ollama and LiteLLM and streams the answer back.
            </p>
            <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                There are 24 or more agents out of the box, covering developer advocacy, content and go-to-market, finance, sales, client delivery, productivity, and legal. Each one is a Hermes profile: a system prompt in a SOUL.md file plus a set of pinned model aliases. You decide which model sits behind each alias.
            </p>
        </div>
    </div>
</section>

<!-- Why it exists -->
<section class="mx-auto max-w-editorial px-6 pb-20">
    <div class="grid grid-cols-12 gap-6 border-t border-rule pt-12">
        <div class="col-span-12 sm:col-span-3">
            <p class="smallcaps-lg">why it exists</p>
        </div>
        <div class="col-span-12 space-y-5 sm:col-span-9">
            <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                A pile of well-tuned agents is only useful if you can reach the right one without thinking about it. The usual options are a wall of dropdowns, a folder of prompt files, or a desktop app you have to be sitting at. None of that works when the thought hits you on a walk.
            </p>
            <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                Dispatch removes the routing decision. You describe what you want and the system picks the agent. Because everything runs on your own models, your prompts and the artifacts they produce stay on your machine. Nothing is exposed to the public internet.
            </p>
        </div>
    </div>
</section>

<!-- How dispatch works -->
<section class="mx-auto max-w-editorial px-6 pb-20">
    <div class="grid grid-cols-12 gap-6 border-t border-rule pt-12">
        <div class="col-span-12 sm:col-span-3">
            <p class="smallcaps-lg">how dispatch works</p>
        </div>
        <div class="col-span-12 sm:col-span-9">
            <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                Every request makes two quick LLM calls before it reaches an agent. The first is a fast router on the <span class="smallcaps">classify</span> alias that reads your message and chooses the target agent. The second is a prompt enhancer on the <span class="smallcaps">analyze</span> alias that turns your one-line request into a fuller brief the agent can act on. Then the chosen agent runs.
            </p>
            <ol class="mt-8 grid grid-cols-1">
                <li class="grid grid-cols-12 gap-6 border-t border-rule py-8">
                    <p class="folio col-span-12 sm:col-span-2"><span class="pos">01</span></p>
                    <div class="col-span-12 sm:col-span-10">
                        <h3 class="font-display text-xl font-medium text-foreground">Route</h3>
                        <p class="mt-2 max-w-prose text-[1rem] leading-relaxed text-muted-foreground">A fast classifier reads the request and names the agent that should handle it.</p>
                    </div>
                </li>
                <li class="grid grid-cols-12 gap-6 border-t border-rule py-8">
                    <p class="folio col-span-12 sm:col-span-2"><span class="pos">02</span></p>
                    <div class="col-span-12 sm:col-span-10">
                        <h3 class="font-display text-xl font-medium text-foreground">Expand</h3>
                        <p class="mt-2 max-w-prose text-[1rem] leading-relaxed text-muted-foreground">A prompt enhancer rewrites your short request into a complete brief, so the agent starts with context instead of a fragment.</p>
                    </div>
                </li>
                <li class="grid grid-cols-12 gap-6 border-t border-rule py-8">
                    <p class="folio col-span-12 sm:col-span-2"><span class="pos">03</span></p>
                    <div class="col-span-12 sm:col-span-10">
                        <h3 class="font-display text-xl font-medium text-foreground">Run</h3>
                        <p class="mt-2 max-w-prose text-[1rem] leading-relaxed text-muted-foreground">The chosen agent runs on its pinned models and streams the answer back to your chat.</p>
                    </div>
                </li>
            </ol>
        </div>
    </div>
</section>

<!-- Model aliases -->
<section class="mx-auto max-w-editorial px-6 pb-20">
    <div class="grid grid-cols-12 gap-6 border-t border-rule pt-12">
        <div class="col-span-12 sm:col-span-3">
            <p class="smallcaps-lg">model aliases</p>
        </div>
        <div class="col-span-12 sm:col-span-9">
            <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                Agents never name a model directly. They reference one of eight aliases, and you map each alias to whatever you actually have. Put a small fast model behind <span class="smallcaps">classify</span> and a heavier one behind <span class="smallcaps">quality</span>, or run everything on one model to start. Swap models later without touching a single agent.
            </p>
            <dl class="mt-8 grid grid-cols-1">
                <?php foreach ($aliases as $a): ?>
                <div class="grid grid-cols-12 gap-6 border-t border-rule py-5">
                    <dt class="col-span-12 sm:col-span-3"><span class="smallcaps"><?= htmlspecialchars($a['name']) ?></span></dt>
                    <dd class="col-span-12 max-w-prose text-[1rem] leading-relaxed text-muted-foreground sm:col-span-9"><?= htmlspecialchars($a['use']) ?></dd>
                </div>
                <?php endforeach; ?>
            </dl>
        </div>
    </div>
</section>

<!-- Capabilities -->
<section class="mx-auto max-w-editorial px-6 pb-20">
    <div class="grid grid-cols-12 gap-6 border-t border-rule pt-12">
        <div class="col-span-12 sm:col-span-3">
            <p class="smallcaps-lg">what you get</p>
        </div>
        <div class="col-span-12 space-y-5 sm:col-span-9">
            <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                The mobile UI keeps persistent chat sessions with streaming output. Artifacts the agents produce are saved to disk, with an optional Obsidian integration if you keep a vault. Access from your phone runs over Tailscale, so the whole thing stays on your private network with nothing public-facing.
            </p>
            <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                It works with any OpenAI-compatible backend. Ollama and LiteLLM are the default local pair, but you can point an alias at Groq, OpenAI, or anything else that speaks the same API. Local-first is the default, not the only option.
            </p>
        </div>
    </div>
</section>

<!-- Setup tiers -->
<section class="mx-auto max-w-editorial px-6 pb-20">
    <div class="grid grid-cols-12 gap-6 border-t border-rule pt-12">
        <div class="col-span-12 sm:col-span-3">
            <p class="smallcaps-lg">three ways to set it up</p>
        </div>
        <div class="col-span-12 sm:col-span-9">
            <ol class="grid grid-cols-1">
                <?php foreach ($tiers as $i => $t):
                    $num = str_pad($i + 1, 2, '0', STR_PAD_LEFT);
                ?>
                <li class="grid grid-cols-12 gap-6 border-t border-rule py-8">
                    <p class="folio col-span-12 sm:col-span-2"><span class="pos"><?= $num ?></span></p>
                    <div class="col-span-12 sm:col-span-10">
                        <h3 class="font-display text-xl font-medium text-foreground"><?= htmlspecialchars($t['label']) ?></h3>
                        <p class="mt-2 max-w-prose text-[1rem] leading-relaxed text-muted-foreground"><?= htmlspecialchars($t['body']) ?></p>
                    </div>
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
            <p class="smallcaps-lg">get it</p>
        </div>
        <div class="col-span-12 sm:col-span-9">
            <h2 class="max-w-prose font-display text-3xl font-medium leading-tight text-foreground sm:text-4xl">
                Clone it and point it at your own models.
            </h2>
            <p class="mt-5 max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                The repo has the agents, the dispatch layer, the mobile UI, and the setup paths. MIT licensed, so fork it and make it yours.
            </p>
            <div class="mt-8 flex flex-wrap items-baseline gap-x-6 gap-y-3">
                <a href="<?= htmlspecialchars($repo) ?>" target="_blank" rel="noreferrer noopener" class="btn-arrow btn-arrow--accent">View on GitHub</a>
                <a href="/work/" class="btn-arrow">Back to work</a>
            </div>
        </div>
    </div>
</section>
