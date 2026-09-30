---
title: I Mined My Session History for the Prompts I Actually Reuse
date: 2026-09-30
layout: partials::layouts/writing-post
slug: prompts-i-actually-reuse
description: My vault had a 55-note prompt library. An audit of my own session transcripts
  found 5 prompts I'd re-typed enough to prove, 4 patterns worth promoting to skills,
  2 skills worth demoting back to prompts, and about 40 imported templates I had never
  used once.
faqs:
- q: How do you audit a prompt library against actual usage?
  a: Don't reread the library. Read your session history, and search your transcripts
    for prompts you re-typed more than once. A prompt you reconstructed from memory
    three times is proven. A prompt you saved and never pasted is a bookmark.
- q: What's the difference between a prompt and a skill?
  a: A prompt is a framing you paste (a role, a constraint paragraph, a question).
    A skill is a capability with tooling, resources, and a trigger. The test is usage
    shape. Something that fires constantly and needs machinery becomes a skill, and
    something that recurs occasionally as pure text stays a prompt. Both directions
    of the sort matter.
- q: Why not publish the whole prompt library as a free tool?
  a: Because most of it turned out to be imported templates with zero usage evidence,
    and a prompt without its usage story is a listicle entry. The five that survived
    are worth publishing precisely because the session history proves they earn their
    keep.
image: prompts-i-actually-reuse-og.png
heroImage: prompts-i-actually-reuse-hero.png
---

*I audited my prompt library against my own session transcripts instead of my own taste. Out of 55 notes, 5 prompts survived, 4 patterns got promoted to skills, 2 skills got demoted back to prompts, and roughly 40 imported templates turned out to have never been used at all.*

My Obsidian vault has a prompt library: 55 notes, organized in a tidy map of content with categories like Writing & Communication, Strategy & Business, AI & Agents. It looks like an asset. I almost published it as a free tool on this site.

Then I asked a different question: which of these have I ever used?

Not "which are good." Every prompt in a library looks good. That's why it got saved. The question that cuts is whether a prompt has ever left the library and entered a session. So instead of rereading the notes, I audited my session history. I went through months of agent transcripts looking for prompt text I had typed, re-typed, or reconstructed from memory.

The results were not close.

## What the transcripts said

Five prompts had real recurrence. Each one had been re-typed from scratch multiple times before it ever got written down, which is the tell. A prompt you rebuild from memory under deadline is a prompt that works. One adversarial design-review framing had run four times across a product design pass. A read-only survey brief for fanning agents out over a codebase ran five times during this site's design-system rebuild. A hardened version of the dispatch brief my agent loop sends to subagents appeared seven or eight times, each time manually re-typed with the same additions.

Four recurring patterns were bigger than prompts. They kept showing up with tooling attached (file access rules, verification steps, bundled context), so they became skills instead of notes: a research sweep, a fresh-context verification pass, an adversarial diff check, and vault retrieval. The rule that fell out of this: a prompt with a live skill is a duplicate, and a duplicate gets re-resolved every session it might apply to.

Two skills went the other direction. I had a set of seven analytical lens skills over my vault for things like question-space mapping, contradiction finding, and drift analysis. It sounds sophisticated. The usage data said each one fired zero or one time in four months, while the plain retrieval skill they all sat on top of was the most-used skill in the corpus. They weren't capabilities. They were prompts wearing skill triggers, seven near-identical descriptions competing for the same match, and they got collapsed into a single note of paste-able framings. Same fate for a text-compression skill that fired exactly once in four months.

And roughly 40 templates had never been used at all. Email Writing, Persuasive Copywriting, CEO Strategy Whisperer, Summarize: all imported from around the web over time, and all with zero appearances in any transcript. Not one had ever made the trip from library to session.

## The sort, stated as a rule

What the audit produced wasn't a cleaner library. It was a placement rule with usage evidence as the only input:

- A pattern that fires constantly and needs machinery becomes a skill. It gets a trigger, tooling, and bundled context.
- A framing that recurs as pure text stays a prompt note, with a record of where it ran and why it works.
- A template that never ran was never an asset. It was a bookmark with ambitions.

Promotion and demotion both happen, and that's the part I'd have gotten wrong by taste alone. The seven lens skills *felt* like the sophisticated tier of the system. The transcripts said they were shelf-ware, and the boring retrieval skill underneath them was the workhorse. Taste ranks by cleverness. Usage ranks by recurrence. They disagree more than you'd expect.

## One of the survivors, as a receipt

Here's the adversarial review prompt, the one that ran four times. The generic version of it ("act as a harsh critic") is in every prompt list on the internet and produces generic startup advice. What makes this one work is that the constraint paragraph is real:

~~~
You are a hostile senior reviewer. Your job is to find what is wrong with this
design before it costs the operator weeks. Do not be encouraging. Do not
summarize it back.

CONTEXT:

<the design, in full: product shape, positioning, constraints>

The operator is a SOLO founder with zero marketing budget, running on a ~1GB
shared droplet that cannot compile code. Their engineering philosophy is
ruthlessly minimal: nothing gets written that something existing already does,
no structure gets built for a future that has not arrived, and the smallest
change that ships is the right one. Any design that ignores that constraint is
wrong regardless of elegance.

You may read files in <repo> to check whether claims about the codebase are
actually true. Verify at least the specific files the design depends on.
~~~

Two things carry it. The operator paragraph forces every objection to survive contact with the real constraints. Rewrite it for yourself, because it is the opposite of boilerplate. And the read-the-repo instruction is the line between review and reaction. A reviewer that can't check claims argues with the pitch. One that can argues with the code.

That commentary (where it ran, what makes it work, what the generic version gets wrong) is the part no imported template has, and it is what made these five worth keeping. A prompt without its usage story is a listicle entry.

## Run it on yours

If you've been collecting prompts, and if you use AI seriously you have, the audit is cheap. Don't evaluate the library. Search your own history for what you've typed more than once. Whatever you find there has already passed the only test that matters, and whatever you don't find was never really yours.

The four patterns that graduated to skills live in [Loop & Gate](https://shane.logsdon.io/loop-and-gate/), the open version of the workflow system this all sits inside. The 40 templates are still in my vault. They're very well organized.
