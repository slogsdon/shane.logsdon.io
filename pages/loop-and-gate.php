<?php
$this->layout('partials::layouts/main', [
    'title' => 'The Loop & Gate System',
    'description' => 'A Foundation layer plus three kits for building, marketing, and following through on your own projects with an AI agent. The loop does the work between the gates. You work the gates.',
    'url' => '/loop-and-gate/',
    'image' => 'loop-and-gate-og.png',
    'imageAlt' => 'The loop does the work. You work the gates. — set in Fraunces on a cream field.',
]);

$repos = [
    'foundation'     => 'https://github.com/slogsdon/second-brain-agent',
    'build'          => 'https://github.com/slogsdon/loop-and-gate-build-kit',
    'grow'           => 'https://github.com/slogsdon/loop-and-gate-grow-kit',
    'accountability' => 'https://github.com/slogsdon/loop-and-gate-accountability-kit',
];

$pieces = [
    [
        'name' => 'The Foundation',
        'slug' => 'second-brain-agent',
        'repo' => $repos['foundation'],
        'body' => 'An AI agent that remembers you and gets a little sharper every session. Its memory is plain, readable notes in an Obsidian vault — no vector database, no cloud service, nothing to sign up for. It captures what you tell it, files it, and writes down one lesson at the end of each session.',
        'gives' => 'Cross-session memory, so your projects and decisions survive the window closing. And your voice and taste profiles — a short interview turns "how you write" and "what good looks like to you" into notes the kits can read.',
        'needs' => 'Not a plugin. It is a folder you open and work inside. The skills live in the folder, and a memory-loader turns on automatically every time you open it.',
    ],
    [
        'name' => 'The Build Kit',
        'slug' => 'loop-and-gate-build-kit',
        'repo' => $repos['build'],
        'body' => 'Turns "an AI agent that writes code" into "an AI agent that ships good software." It is a map of the eleven points in a build where a human has to decide, and how to work each one — even the ones whose expertise you do not have yet.',
        'gives' => 'Should this exist at all? Who is it for, and what is a win? Is the plan right? Is the architecture sane? Is the agent off the rails? Does the test prove it, or is it a demo? And above all of them, the master gate: how much of this process does this change even deserve, because a typo fix and a billing change do not get the same treatment.',
        'needs' => 'The gates sit on top of an actual build loop, so you also install two free public plugins that provide the loop itself (superpowers and agent-skills). Works with or without the Foundation, better with it.',
    ],
    [
        'name' => 'The Grow Kit',
        'slug' => 'loop-and-gate-grow-kit',
        'repo' => $repos['grow'],
        'body' => 'The other half of the loop: taking finished software to the right people and reading whether it worked. Same method, pointed at go-to-market.',
        'gives' => 'Who the audience is, what the one claim is, whether the design carries it without looking like slop, whether the copy is true and in your voice, the right channel and timing, and finally whether it actually moved anything.',
        'needs' => 'Requires the Foundation, because two of its gates are your Foundation profiles: the design gate reads your taste, the copy gate reads your voice. It also uses two free public plugins for the design and writing work.',
    ],
    [
        'name' => 'The Accountability Kit',
        'slug' => 'loop-and-gate-accountability-kit',
        'repo' => $repos['accountability'],
        'body' => 'Points the loop at your own follow-through. A daily rhythm with eight gates: set the one thing that matters today, capture what you actually did, reckon honestly at night, and get caught when you keep quietly deferring the hard thing.',
        'gives' => 'The deferral engine is the part that makes it more than a journal. Every morning focus that does not show up in the day\'s log gets counted, and at three strikes it stops being polite and forces a decision: re-commit with a reason, or kill it.',
        'needs' => 'Nothing. It runs on Claude alone — no extra plugins, no account, no local model. It keeps plain-text state by default, and uses your Obsidian vault instead when one is present.',
    ],
];

$order = [
    ['label' => 'Foundation', 'body' => 'Set up memory and run the profile interview. Everything else is sharper once this exists.'],
    ['label' => 'Accountability Kit', 'body' => 'The lightest kit, and the one that makes the habit of using the system stick. Start running your days through it.'],
    ['label' => 'Build Kit', 'body' => 'The first time you have something real to build.'],
    ['label' => 'Grow Kit', 'body' => 'The first time you have something built and need to take it to people.'],
];
?>

<!-- Hero -->
<section class="mx-auto max-w-editorial px-6 pt-20 pb-20">
    <div class="running-head" aria-hidden="true">
        <span>shane logsdon &middot; loop &amp; gate</span>
        <span><?= date('Y.m.d') ?></span>
    </div>
    <h1 class="mt-12 max-w-[20ch] font-display font-normal text-foreground"
        style="font-size: clamp(2.5rem, 6.5vw, 5.5rem); line-height: 1.02; letter-spacing: -0.02em;">
        The loop does the work. You work the <span class="t-accent">gates</span>.
    </h1>
    <p class="mt-8 max-w-prose text-[1.1875rem] leading-[1.6] text-muted-foreground">
        A small stack of tools for building, marketing, and following through on your own projects with an AI agent. One Foundation layer, three kits that sit on top of it. All of it runs inside Claude Code, and all of it is free and open source.
    </p>
    <div class="mt-10 flex flex-wrap items-baseline gap-x-6 gap-y-3">
        <a href="<?= htmlspecialchars($repos['foundation']) ?>" target="_blank" rel="noreferrer noopener" class="btn-arrow btn-arrow--accent">Start with the Foundation</a>
        <p class="text-sm text-muted-foreground">MIT licensed. Needs a paid Claude plan (Pro or Max).</p>
    </div>
</section>

<!-- The mental model -->
<section class="mx-auto max-w-editorial px-6 pb-20">
    <div class="grid grid-cols-12 gap-6 border-t border-rule pt-12">
        <div class="col-span-12 sm:col-span-3">
            <p class="smallcaps-lg">the mental model</p>
        </div>
        <div class="col-span-12 space-y-5 sm:col-span-9">
            <p class="max-w-prose text-[1.1875rem] leading-[1.6] text-foreground">
                Most people meet an AI agent as a blank chat box. It is brilliant and it forgets you the moment the window closes. It will build whatever you ask, including the wrong thing, confidently. And it has no opinion about whether you actually shipped the work you meant to.
            </p>
            <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                This stack fixes those three gaps. The Foundation gives the agent a memory and a sense of who you are that persists across every session. The Build Kit puts human decision points into an agentic build loop, so a fast agent ships good software instead of a fast mistake. The Grow Kit does the same for taking that software to market. The Accountability Kit points the same idea at you.
            </p>
            <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                The kits share a single idea, which is where the name comes from. An agentic <span class="smallcaps">loop</span> can run on its own most of the time. But it has to stop at a fixed set of <span class="smallcaps">gates</span> where a human has to decide. The loop does the work between the gates. You work the gates. That is it.
            </p>
        </div>
    </div>
</section>

<!-- A gate at work -->
<section class="mx-auto max-w-editorial px-6 pb-20">
    <div class="grid grid-cols-12 gap-6 border-t border-rule pt-12">
        <div class="col-span-12 sm:col-span-3">
            <p class="smallcaps-lg">the gate that earns its keep</p>
        </div>
        <div class="col-span-12 space-y-5 sm:col-span-9">
            <p class="max-w-prose text-[1.1875rem] leading-[1.6] text-foreground">
                Here is the whole idea in one moment. Mid-session the agent hits a test that fails once, digs in, and decides it has learned something worth keeping: the payments suite is flaky, so wrap the assertions in a retry before checking. A blank chat box forgets that by tomorrow. A naive memory writes it down forever.
            </p>
            <pre class="overflow-x-auto border border-rule p-4 text-xs leading-relaxed text-muted-foreground"><code># MEMORY.md
+ Payments tests are flaky. Wrap assertions in retry() before asserting.</code></pre>
            <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                That line would load into every future session. It is also wrong. The test failed once because a fixture had not finished seeding, not because the suite is flaky, and now the agent hides real failures behind a retry it never needed.
            </p>
            <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                So the loop proposes the lesson and a gate stops the write. One observation is a coincidence with a good story, not a rule. The candidate waits in a holding file for a second, independent time the same thing happens. It never does, so nothing enters your memory. The diff above is the one that did not happen. That is loop and gate turned on the memory itself: the loop decides what to remember, the gate decides what is true enough to keep.
            </p>
        </div>
    </div>
</section>

<!-- The pieces -->
<section class="mx-auto max-w-editorial px-6 pb-20">
    <div class="grid grid-cols-12 gap-6 border-t border-rule pt-12">
        <div class="col-span-12 sm:col-span-3">
            <p class="smallcaps-lg">the pieces</p>
        </div>
        <div class="col-span-12 sm:col-span-9">
            <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                The Foundation sits underneath all three kits. The kits work better when it is there, because they can read your voice and taste and write what they learn back into your memory. One of them needs it. The other two can start without it.
            </p>
            <ol class="mt-8 grid grid-cols-1">
                <?php foreach ($pieces as $i => $p):
                    $num = str_pad($i + 1, 2, '0', STR_PAD_LEFT);
                ?>
                <li class="grid grid-cols-12 gap-6 border-t border-rule py-8">
                    <p class="folio col-span-12 sm:col-span-2"><span class="pos"><?= $num ?></span></p>
                    <div class="col-span-12 sm:col-span-10">
                        <h3 class="font-display text-xl font-medium text-foreground"><?= htmlspecialchars($p['name']) ?></h3>
                        <p class="smallcaps mt-1"><?= htmlspecialchars($p['slug']) ?></p>
                        <p class="mt-3 max-w-prose text-[1rem] leading-relaxed text-muted-foreground"><?= htmlspecialchars($p['body']) ?></p>
                        <p class="mt-3 max-w-prose text-[1rem] leading-relaxed text-muted-foreground"><?= htmlspecialchars($p['gives']) ?></p>
                        <p class="mt-3 max-w-prose text-[1rem] leading-relaxed text-muted-foreground"><?= htmlspecialchars($p['needs']) ?></p>
                        <p class="mt-4">
                            <a href="<?= htmlspecialchars($p['repo']) ?>" target="_blank" rel="noreferrer noopener" class="btn-arrow">View on GitHub</a>
                        </p>
                    </div>
                </li>
                <?php endforeach; ?>
            </ol>
        </div>
    </div>
</section>

<!-- How they fit together -->
<section class="mx-auto max-w-editorial px-6 pb-20">
    <div class="grid grid-cols-12 gap-6 border-t border-rule pt-12">
        <div class="col-span-12 sm:col-span-3">
            <p class="smallcaps-lg">how they fit together</p>
        </div>
        <div class="col-span-12 space-y-5 sm:col-span-9">
            <h2 class="max-w-prose font-display text-2xl font-medium leading-tight text-foreground sm:text-3xl">
                Build &rarr; Grow &rarr; Accountability &rarr; Build.
            </h2>
            <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                You build something with the Build Kit. You take it to market with the Grow Kit, whose final gate reads whether it actually landed and writes those customer signals back into the Foundation vault. The Build Kit's first gate reads those same signals to decide what is worth building next. And the Accountability Kit runs underneath the whole thing, so when a build stalls or a launch never goes out, the nightly reckoning is where it gets caught instead of quietly slipping.
            </p>
            <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                The Foundation is the shared bus in the middle. It is how the halves talk to each other, and it is why the profiles and memory are worth setting up first. You do not need all four to get value — each kit stands on its own, with the one exception that Grow needs the Foundation. Start with what maps to your actual problem and add the rest when you feel the seam.
            </p>
        </div>
    </div>
</section>

<!-- Getting started -->
<section class="mx-auto max-w-editorial px-6 pb-20">
    <div class="grid grid-cols-12 gap-6 border-t border-rule pt-12">
        <div class="col-span-12 sm:col-span-3">
            <p class="smallcaps-lg">from scratch</p>
        </div>
        <div class="col-span-12 sm:col-span-9">
            <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                If you have never used Claude Code, this is the whole path from nothing to a working setup. Budget about 20 minutes, most of it one-time.
            </p>
            <ol class="mt-8 grid grid-cols-1">
                <li class="grid grid-cols-12 gap-6 border-t border-rule py-8">
                    <p class="folio col-span-12 sm:col-span-2"><span class="pos">01</span></p>
                    <div class="col-span-12 sm:col-span-10">
                        <h3 class="font-display text-xl font-medium text-foreground">Get a paid Claude plan</h3>
                        <p class="mt-2 max-w-prose text-[1rem] leading-relaxed text-muted-foreground">
                            Go to <a class="link-quiet" href="https://claude.ai" target="_blank" rel="noreferrer noopener">claude.ai</a> and make sure you are on Pro or Max, not the free plan. This is the step people miss, and nothing here works without it.
                        </p>
                    </div>
                </li>
                <li class="grid grid-cols-12 gap-6 border-t border-rule py-8">
                    <p class="folio col-span-12 sm:col-span-2"><span class="pos">02</span></p>
                    <div class="col-span-12 sm:col-span-10">
                        <h3 class="font-display text-xl font-medium text-foreground">Install the Claude Code desktop app</h3>
                        <p class="mt-2 max-w-prose text-[1rem] leading-relaxed text-muted-foreground">
                            A normal app you double-click, no terminal required. Installers are on <a class="link-quiet" href="https://code.claude.com/docs" target="_blank" rel="noreferrer noopener">Anthropic's download page</a>. On Windows, if it asks you to install Git first, say yes and reopen the app. Sign in, then click the Code tab.
                        </p>
                    </div>
                </li>
                <li class="grid grid-cols-12 gap-6 border-t border-rule py-8">
                    <p class="folio col-span-12 sm:col-span-2"><span class="pos">03</span></p>
                    <div class="col-span-12 sm:col-span-10">
                        <h3 class="font-display text-xl font-medium text-foreground">Set up the Foundation first</h3>
                        <p class="mt-2 max-w-prose text-[1rem] leading-relaxed text-muted-foreground">
                            On the <a class="link-quiet" href="<?= htmlspecialchars($repos['foundation']) ?>" target="_blank" rel="noreferrer noopener">Foundation repo</a>, click the green Code button, then Download ZIP. Unzip it, put the folder somewhere you will find it, and open it in the app with File &rarr; Open folder. That is the whole install — the skills are already inside, and the memory-loader turns on automatically.
                        </p>
                        <p class="mt-3 max-w-prose text-[1rem] leading-relaxed text-muted-foreground">
                            Then run your first session by typing a plain-language goal:
                        </p>
                        <p class="mt-3 max-w-prose border-l border-rule pl-4 text-[1rem] italic leading-relaxed text-muted-foreground">
                            Get to know me: ask about my current project and my preferences, then save what you learn.
                        </p>
                        <p class="mt-3 max-w-prose text-[1rem] leading-relaxed text-muted-foreground">
                            While you are here, seed your voice and taste — the Grow Kit will need them:
                        </p>
                        <p class="mt-3 max-w-prose border-l border-rule pl-4 text-[1rem] italic leading-relaxed text-muted-foreground">
                            Run the profile interview so you know how I write and what good looks like to me.
                        </p>
                    </div>
                </li>
                <li class="grid grid-cols-12 gap-6 border-t border-rule py-8">
                    <p class="folio col-span-12 sm:col-span-2"><span class="pos">04</span></p>
                    <div class="col-span-12 sm:col-span-10">
                        <h3 class="font-display text-xl font-medium text-foreground">Add your first kit</h3>
                        <p class="mt-2 max-w-prose text-[1rem] leading-relaxed text-muted-foreground">
                            Kits install differently from the Foundation — they are plugins, added with one command in the chat, no download. The simplest to start with is the Accountability Kit, because it needs nothing else.
                        </p>
                        <pre class="mt-4 overflow-x-auto border border-rule p-4 text-xs leading-relaxed text-muted-foreground"><code>/plugin marketplace add slogsdon/loop-and-gate-accountability-kit</code></pre>
                        <p class="mt-3 max-w-prose text-[1rem] leading-relaxed text-muted-foreground">
                            Click Install on the menu that appears, then start the daily loop with <span class="smallcaps">/morning</span>. That is a complete, working setup: a Foundation that remembers you, and a kit that keeps you honest about your days.
                        </p>
                    </div>
                </li>
            </ol>
        </div>
    </div>
</section>

<!-- Layering in the kits -->
<section class="mx-auto max-w-editorial px-6 pb-20">
    <div class="grid grid-cols-12 gap-6 border-t border-rule pt-12">
        <div class="col-span-12 sm:col-span-3">
            <p class="smallcaps-lg">layering in the kits</p>
        </div>
        <div class="col-span-12 sm:col-span-9">
            <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                With the Foundation set up, each kit is a one-time plugin install plus, in two cases, a couple of free public plugins that provide the underlying loop.
            </p>

            <p class="mt-10 smallcaps">accountability kit — needs nothing else</p>
            <pre class="mt-3 overflow-x-auto border border-rule p-4 text-xs leading-relaxed text-muted-foreground"><code>/plugin marketplace add slogsdon/loop-and-gate-accountability-kit</code></pre>
            <p class="mt-3 max-w-prose text-[1rem] leading-relaxed text-muted-foreground">
                Then use the five daily commands: <span class="smallcaps">/morning</span> sets the one thing today, <span class="smallcaps">/log</span> captures what you did as you go, <span class="smallcaps">/eod</span> reckons honestly at night, <span class="smallcaps">/plan-tomorrow</span> sets you up to start cold, and <span class="smallcaps">/weekly-signals</span> reads your patterns once a week.
            </p>

            <p class="mt-10 smallcaps">build kit — needs the build-loop plugins</p>
            <pre class="mt-3 overflow-x-auto border border-rule p-4 text-xs leading-relaxed text-muted-foreground"><code>/plugin marketplace add slogsdon/loop-and-gate-build-kit
/plugin marketplace add obra/superpowers-marketplace
/plugin install superpowers@superpowers-marketplace
/plugin marketplace add addyosmani/agent-skills
/plugin install agent-skills@addy-agent-skills</code></pre>
            <p class="mt-3 max-w-prose text-[1rem] leading-relaxed text-muted-foreground">
                The first line is the gates. The rest are the free public plugins that run the loop underneath them. Then, at any build decision, run <span class="smallcaps">/loop-and-gate</span> and tell it what you want to build. It sizes the change first, then walks you only through the gates that change actually earns.
            </p>

            <p class="mt-10 smallcaps">grow kit — needs the foundation plus the design and writing plugins</p>
            <pre class="mt-3 overflow-x-auto border border-rule p-4 text-xs leading-relaxed text-muted-foreground"><code>/plugin marketplace add slogsdon/loop-and-gate-grow-kit
/plugin marketplace add slogsdon/claude-code-config
/plugin install skills-design@slogsdon-claude-code-config
/plugin install skills-writing@slogsdon-claude-code-config</code></pre>
            <p class="mt-3 max-w-prose text-[1rem] leading-relaxed text-muted-foreground">
                The Foundation is a hard requirement here. Then, per piece or per campaign, run <span class="smallcaps">/grow-and-gate</span>. It runs the gates for whatever cadence you are in, and at the end writes what it learned back to your vault, where the Build Kit's first gate can read it.
            </p>
        </div>
    </div>
</section>

<!-- Suggested order -->
<section class="mx-auto max-w-editorial px-6 pb-20">
    <div class="grid grid-cols-12 gap-6 border-t border-rule pt-12">
        <div class="col-span-12 sm:col-span-3">
            <p class="smallcaps-lg">a suggested order</p>
        </div>
        <div class="col-span-12 sm:col-span-9">
            <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                You do not have to follow this, but if you want a path:
            </p>
            <ol class="mt-8 grid grid-cols-1">
                <?php foreach ($order as $i => $o):
                    $num = str_pad($i + 1, 2, '0', STR_PAD_LEFT);
                ?>
                <li class="grid grid-cols-12 gap-6 border-t border-rule py-6">
                    <p class="folio col-span-12 sm:col-span-2"><span class="pos"><?= $num ?></span></p>
                    <div class="col-span-12 sm:col-span-10">
                        <h3 class="font-display text-xl font-medium text-foreground"><?= htmlspecialchars($o['label']) ?></h3>
                        <p class="mt-2 max-w-prose text-[1rem] leading-relaxed text-muted-foreground"><?= htmlspecialchars($o['body']) ?></p>
                    </div>
                </li>
                <?php endforeach; ?>
            </ol>
            <p class="mt-8 max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                By the time all four are in place, you have the full flywheel: a system that remembers you, helps you build the right thing well, take it to market in your own voice, and stay honest about whether you actually did it.
            </p>
        </div>
    </div>
</section>

<!-- CTA / Reference -->
<section class="relative mx-auto max-w-editorial px-6 pb-24">
    <div class="grid grid-cols-12 gap-6 border-t border-rule pt-12">
        <div class="col-span-12 sm:col-span-3">
            <p class="smallcaps-lg">get it</p>
        </div>
        <div class="col-span-12 sm:col-span-9">
            <h2 class="max-w-prose font-display text-3xl font-medium leading-tight text-foreground sm:text-4xl">
                Start with the Foundation. Add the kit that matches your problem.
            </h2>
            <p class="mt-5 max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                Every repo has its own <span class="smallcaps">getting-started.md</span> — a no-terminal walkthrough — and a <span class="smallcaps">reference/</span> folder with the gates in plain language. This page is the map; those are the detail.
            </p>
            <ul class="mt-8 flex flex-wrap items-baseline gap-x-6 gap-y-3">
                <li><a href="<?= htmlspecialchars($repos['foundation']) ?>" target="_blank" rel="noreferrer noopener" class="btn-arrow btn-arrow--accent">Foundation</a></li>
                <li><a href="<?= htmlspecialchars($repos['build']) ?>" target="_blank" rel="noreferrer noopener" class="btn-arrow">Build Kit</a></li>
                <li><a href="<?= htmlspecialchars($repos['grow']) ?>" target="_blank" rel="noreferrer noopener" class="btn-arrow">Grow Kit</a></li>
                <li><a href="<?= htmlspecialchars($repos['accountability']) ?>" target="_blank" rel="noreferrer noopener" class="btn-arrow">Accountability Kit</a></li>
            </ul>
            <p class="mt-8 max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                The story behind it is in <a class="link-quiet" href="/articles/strategic-insights/building-on-the-margins/">Building on the Margins</a>, the essay this whole system came out of.
            </p>
        </div>
    </div>
</section>
