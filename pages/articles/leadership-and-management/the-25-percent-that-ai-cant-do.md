---
title: The 25% That AI Can't Do Is the Whole Job Now
date: 2026-08-05
layout: partials::layouts/writing-post
slug: the-25-percent-that-ai-cant-do
description: AI already handles the first 75% of developer education. What's left
  for DevRel is judgment, the architecture calls, tradeoffs, and product edges a model
  can't reliably infer from the docs.
faqs:
- q: If AI already handles most developer education, what's actually left for DevRel
    to do?
  a: What's left is the judgment work, and it shows up as architecture reasoning,
    tradeoff decisions, spec quality, and the edges only you know about your own product.
- q: Does this mean quickstarts and tutorials are worthless now?
  a: No. That content still needs to exist, but it's table stakes now, not differentiation,
    since AI already explains the standard patterns as clearly as most docs do.
- q: What is Addy Osmani's '70% problem,' and why does it matter here?
  a: Osmani watched non-engineers get AI most of the way to working software, then
    hit a wall the tools couldn't carry them past. The exact number isn't the point.
    The point is that teams treat the fast part as the finish line, then act surprised
    when the last stretch turns out to be the hard part.
- q: What should a DevRel team actually change because of this?
  a: Sort a quarter of your output into two piles. One restates the docs. The other
    transmits real judgment, the tradeoff calls and the why-answers you only have
    because you got bitten first. Put your best advocate hours on the second pile.
- q: Why does spec quality matter more for DevRel now than it used to?
  a: Because AI output is only as good as the spec that starts it. Teaching developers
    how to write a solid integration spec before they prompt is leverage that didn't
    really exist when humans wrote every line themselves.
image: the-25-percent-that-ai-cant-do-og.png
heroImage: the-25-percent-that-ai-cant-do-hero.png
---

*AI already handles the first 75% of developer education: syntax, boilerplate, quickstarts. What's left is DevRel's whole job now, the 25% of judgment AI can't do: architecture reasoning, tradeoffs, spec quality, and your product's sharp edges.*

When I estimate AI-assisted work, I've learned to do something that looks backwards: I over-invest time in the last quarter of the task. AI tools get you to roughly 75% of a working solution fast. Scaffolding, boilerplate, and the standard integration patterns generate in minutes. The remaining 25% is edge cases, domain judgment, and understanding why something breaks and what the right fix actually is. That part takes longer than the first 75% did, and it's where the actual value lives.

Addy Osmani called a version of this [the 70% problem](https://addyo.substack.com/p/the-70-problem-hard-truths-about), after watching non-engineers get almost all the way to working software and then hit a wall the tools couldn't carry them past. The exact percentages don't matter. What matters is the failure mode: treating the 75% as the finish line, then being surprised that the last stretch is the hard part.

I've used this as a planning heuristic for a couple of years. It took me longer to notice what it means for DevRel. If AI handles the first 75% of developer education, then most of what DevRel teams produce is competing with a machine that does it instantly, for free, inside the developer's editor.

---

## What the 75% covers

Be honest about the inventory: syntax questions, boilerplate, "how do I call this API?", getting-started guides, the standard auth flow, and the common gotchas that appear in every project. That's the bulk of most DevRel content calendars, and AI already handles it well. Not perfectly, but well enough that developers reach for the assistant before they reach for your tutorial.

That content isn't worthless now. It's table stakes. It needs to exist, structured so AI can consume and cite it, which is the AEO work from the last post. But it stopped being differentiation. Nobody builds preference for your product because your quickstart explained pagination clearly. The machine explains pagination clearly.

[Sunil Pai's framing](https://sunilpai.dev/posts/developer-relations/) is that the object of learning moved up a layer. People were never really paying to learn APIs. They were paying to learn how to work, and AI crashed into exactly the layer below that. What's left above is what he calls judgment and taste, and he's careful to insist taste isn't ornamental. It's operational. When an agent generates ten plausible solutions, the scarce skill isn't producing a solution. It's telling which one is brittle, which one hides complexity instead of removing it, and which one will be miserable to maintain.

---

## The 25%, translated to DevRel

Here's what the judgment layer looks like as a content strategy. These are the questions AI answers badly and developers still pay attention for.

**Architecture guidance.** Not "how do I structure my integration" but why to structure it a certain way. The reasoning behind API design decisions, the tradeoffs, the opinionated patterns an LLM can't reliably infer from documentation, because the documentation records the decision and not the deliberation.

**Answering "why?"** When I build sample projects, the scaffolding generates in minutes. The time goes into payment auth flows, error handling edge cases, and the places where the domain bites. A developer hitting those places doesn't need a tutorial. They need the reasoning of someone who's been bitten.

**Spec quality.** This one is newer, and I think underrated. The quality of AI-generated output is determined by the quality of the starting spec. Helping developers write better integration specs before they start building is leverage in a way it never was when humans wrote every line. DevRel used to optimize time to first API call. Time to good spec might matter more now, and a guide on how to write the integration spec before you prompt is a category of DevRel content that had no reason to exist two years ago.

**The edges.** Domain-specific judgment, integration nuance, the stuff that falls outside standard patterns. The machine is trained on the standard patterns. Your product's sharp edges are underrepresented in the training data almost by definition.

---

## The uncomfortable audit

Take your last quarter of DevRel output and sort it into two piles. One pile explains what the docs already say. The other transmits judgment: why-answers, tradeoff reasoning, edge-case navigation, spec guidance. For most teams the first pile is embarrassingly tall, and every month it becomes more redundant with what the developer's assistant already told them.

This isn't an argument for producing less. It's an argument about where differentiation moved. The first pile becomes structured, extractable, machine-legible reference that you build once and maintain well. The scarce, expensive advocate-hours go to the second pile, because that's the content AI can generate text about but can't actually produce. Producing it requires having made the judgment calls yourself.

There's a format question hiding here. If judgment is the product, what does judgment-transmission look like as content? The honest answer isn't a listicle of best practices, which is the 75% wearing a costume. It involves showing the judgment operating in real time, dead ends included. That format has a name, and it's the next post.

---

*Part 3 of 9 in the Developer Relations in the Age of AI series.*

*← Previous: AEO Is DevRel Infrastructure · Next: Witnessed Practice Is the New Tutorial → · ← All articles*
