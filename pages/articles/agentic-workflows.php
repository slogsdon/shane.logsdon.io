<?php
$this->layout('partials::layouts/main', [
    'title' => 'Agentic Product Development Workflows',
    'description' => 'A six-part series on moving past prompt engineering toward reliable AI-assisted development by designing specs, context files, and documentation for the agent reading them, not just the humans.',
    'url' => '/articles/agentic-workflows/',
]);

$posts = [
    [
        'slug' => 'the-ax-shift',
        'title' => 'The AX Shift: You\'re Still Designing for Yourself',
        'date' => 'April 27, 2026',
        'body' => 'The move from UX to DX to AX (Agent Experience), and why the fundamental problem with AI-assisted development isn\'t prompt engineering. We\'re still creating artifacts designed for human readers who can read between the lines.',
    ],
    [
        'slug' => 'llm-context-files-are-deliverables-not-config',
        'title' => 'LLM Context Files Are Deliverables, Not Config',
        'date' => 'May 4, 2026',
        'body' => 'Why treating CLAUDE.md like a set-and-forget .editorconfig is a mistake. A context file that isn\'t maintained as decisions change isn\'t a context file. It\'s archaeology. Here\'s what a living, first-class context file looks like.',
    ],
    [
        'slug' => 'the-spec-is-the-work',
        'title' => 'The Spec Is the Work: PRD-First AI Development',
        'date' => 'May 11, 2026',
        'body' => 'The argument for writing the implementation plan before opening the AI tool. A precise design spec is a decision-forcing function. Without it, the agent fills your architectural gaps with statistical probability, and what you get back is plausible, and wrong.',
    ],
    [
        'slug' => 'the-specification-boundary',
        'title' => 'The Specification Boundary: Why AI-Assisted Builds Stall at 75%',
        'date' => 'May 18, 2026',
        'body' => 'AI gets you to scaffold incredibly fast. Then it leaves you at the edge of the specification boundary, where domain expertise and explicit constraints matter more than generative power. Here\'s how to prepare for that phase rather than discover it.',
    ],
    [
        'slug' => 'evaluating-agentic-workflows',
        'title' => 'How to Know If Your Agentic Workflow Is Actually Working',
        'date' => 'June 18, 2026',
        'body' => 'Moving beyond "it ran without errors." How to build evaluation infrastructure that catches not just broken workflows, but wrong ones, the kind that run cleanly and degrade quietly through semantic drift.',
    ],
    [
        'slug' => 'framework-emergence-loop',
        'title' => 'The Framework Emergence Loop: How Durable AI Workflows Are Actually Found',
        'date' => 'July 9, 2026',
        'body' => 'A retrospective on why you can\'t design a perfect agentic workflow in advance, at least not so far. Durable systems are found through a cycle of intentional failures, where each iteration reveals the structural lesson required for the next.',
    ],
];
?>

<!-- Hero -->
<section class="mx-auto max-w-editorial px-6 pt-20 pb-20">
    <div class="running-head" aria-hidden="true">
        <span>shane logsdon &middot; series</span>
        <span><?= date('Y.m.d') ?></span>
    </div>
    <h1 class="mt-12 max-w-[20ch] font-display font-normal text-foreground"
        style="font-size: clamp(2.5rem, 6.5vw, 5.5rem); line-height: 1.02; letter-spacing: -0.02em;">
        Agentic product development <span class="t-accent">workflows</span>.
    </h1>
    <p class="mt-8 max-w-prose text-[1.1875rem] leading-[1.6] text-muted-foreground">
        A six-part series on the shift from building for yourself to designing for the agent. It isn't a tool upgrade so much as a new discipline.
    </p>
    <div class="mt-10 flex flex-wrap items-baseline gap-x-6 gap-y-3">
        <a href="/articles/technical-deep-dives/<?= $posts[0]['slug'] ?>/" class="btn-arrow btn-arrow--accent">Start with the first post</a>
    </div>
</section>

<!-- Why this series -->
<section class="mx-auto max-w-editorial px-6 pb-20">
    <div class="grid grid-cols-12 gap-6 border-t border-rule pt-12">
        <div class="col-span-12 sm:col-span-3">
            <p class="smallcaps-lg">why this series</p>
        </div>
        <div class="col-span-12 space-y-5 sm:col-span-9">
            <p class="max-w-prose text-[1.1875rem] leading-[1.6] text-foreground">
                I kept improving my prompts. Every time a session drifted, I diagnosed it as a prompt quality problem. The agent would generate code in a style we'd already moved away from, miss a pattern we'd established, or make the same mistake I'd corrected twice before. The fix, obviously, was better prompts, more specific ones with more examples and more context. I got quite good at prompting. The drift kept happening.
            </p>
            <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                Six months in, I had a growing library of refined prompts and a corrections list that looked nearly identical to the one from month two. The thing I kept adjusting wasn't the problem. The problem was somewhere I hadn't looked yet.
            </p>
            <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                What I was missing was this: I was still designing everything for myself. The prompts, the context files, the project notes, the spec: all of it was written for a human reading it later, not for an agent trying to infer intent from it right now. Inference at the edges of an AI session is exactly where drift lives.
            </p>
            <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                This series is about the shift from building for yourself to designing for the agent, one that treats your artifacts (your documentation, your specs, your configuration) as the primary communication layer with the agent, not the secondary layer behind prompting.
            </p>
            <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                If you're a developer or technical PM who's already shipped something with AI assistance, you've likely hit the 75% wall or watched a session slowly lose its thread. This series is for anyone who wants to move past prompting toward something reliable.
            </p>
        </div>
    </div>
</section>

<!-- The posts -->
<section class="mx-auto max-w-editorial px-6 pb-20">
    <div class="grid grid-cols-12 gap-6 border-t border-rule pt-12">
        <div class="col-span-12 sm:col-span-3">
            <p class="smallcaps-lg">the posts</p>
        </div>
        <div class="col-span-12 sm:col-span-9">
            <ol class="grid grid-cols-1">
                <?php foreach ($posts as $i => $p):
                    $num = str_pad($i + 1, 2, '0', STR_PAD_LEFT);
                ?>
                <li class="grid grid-cols-12 gap-6 border-t border-rule py-8">
                    <p class="folio col-span-12 sm:col-span-2"><span class="pos"><?= $num ?></span></p>
                    <div class="col-span-12 sm:col-span-10">
                        <h3 class="font-display text-xl font-medium text-foreground">
                            <a href="/articles/technical-deep-dives/<?= $p['slug'] ?>/"><?= htmlspecialchars($p['title']) ?></a>
                        </h3>
                        <p class="mt-1 text-sm text-muted-foreground"><?= htmlspecialchars($p['date']) ?></p>
                        <p class="mt-2 max-w-prose text-[1rem] leading-relaxed text-muted-foreground"><?= htmlspecialchars($p['body']) ?></p>
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
            <p class="smallcaps-lg">start here</p>
        </div>
        <div class="col-span-12 sm:col-span-9">
            <h2 class="max-w-prose font-display text-3xl font-medium leading-tight text-foreground sm:text-4xl">
                Better decisions, made earlier, written down where the agent can find them.
            </h2>
            <p class="mt-5 max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
                The answer to "why does the agent keep getting this wrong?" has rarely been better prompts. It's been better decisions, made earlier, written down somewhere the agent can find them.
            </p>
            <div class="mt-8 flex flex-wrap items-baseline gap-x-6 gap-y-3">
                <a href="/articles/technical-deep-dives/<?= $posts[0]['slug'] ?>/" class="btn-arrow btn-arrow--accent">Start with the first post</a>
                <a href="/articles/" class="btn-arrow">All articles</a>
            </div>
        </div>
    </div>
</section>
