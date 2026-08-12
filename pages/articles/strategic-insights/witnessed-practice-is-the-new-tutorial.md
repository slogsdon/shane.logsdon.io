---
title: Witnessed Practice Is the New Tutorial
date: 2026-08-12
layout: partials::layouts/writing-post
slug: witnessed-practice-is-the-new-tutorial
description: AI can write a flawless tutorial, but it can't fake a dead end. That's
  why witnessed practice (watching a competent person work through real uncertainty)
  is the DevRel format AI can't replicate, and corporate DevRel is barely making any
  of it.
faqs:
- q: What is witnessed practice?
  a: Watching a competent developer work through real uncertainty, including the dead
    ends and how they recover from them, not a polished tutorial that only shows what
    worked.
- q: Why are course sales and engagement down for technical educators right now?
  a: Because most of what people were paying for wasn't API knowledge. It was judgment,
    and AI can now produce plausible code at the layer people thought they needed
    to learn.
- q: Can AI produce witnessed practice content?
  a: No. AI can write convincingly about a process, but it can't have genuine uncertainty
    or a real recovery, and that's exactly what witnessed practice requires.
- q: Is any company doing witnessed practice content well?
  a: Not that I found. The people doing it right now (ThePrimeagen, Theo, Simon Willison,
    and Julia Evans) are all independents, not corporate DevRel teams.
- q: What separates witnessed practice from just streaming yourself coding?
  a: 'It''s narrating the decision layer instead of the action layer: why you''re
    reaching for one tool over another, which dead ends you hit, and where you caught
    the agent going wrong.'
image: witnessed-practice-is-the-new-tutorial-og.png
heroImage: witnessed-practice-is-the-new-tutorial-hero.png
---

*Witnessed practice (showing a competent developer work through real uncertainty, dead ends and recoveries included) is the DevRel format AI can't replicate. Demand for it is strong, and corporate DevRel produces almost none of it.*

Technical educators keep reporting the same thing: engagement is softer, course sales are softer, and people are less willing to pay for educational material than they were a year ago. Which is strange, because more code is being produced than ever. If developers are building more, why is the market for learning how to build shrinking?

[Sunil Pai's answer](https://sunilpai.dev/posts/developer-relations/), in an essay ("developer relations after the cheat code machine") I've reread more than anything else written about DevRel this year, is that people were never really buying courses to learn APIs. They were buying a way of working: how to structure things, debug, choose between options, ship, and notice when something is wrong even when it technically works. AI crashed into the layer below that. Every time you pull the lever on what he calls the cheat code machine, plausible code comes out. The API-knowledge layer collapsed in value, and the learning demand moved up to the layer AI can't produce: judgment in motion.

He gave the format that serves this demand a name. Witnessed practice means watching someone competent actually work: what they delegate, what they check by hand, where they trust the model and where they absolutely don't, and how they recover when the agent has confidently wandered off in the wrong direction.

I think this is the DevRel content format most likely to survive AI saturation, and I think corporate DevRel is producing approximately none of it.

---

## Tutorial vs. witnessed practice

| Tutorial | Witnessed practice |
|----------|-------------------|
| Polished path to a known destination | Messy navigation through genuine uncertainty |
| Explains what works | Shows what gets checked, skipped, inspected, questioned |
| Optimizes for task completion | Optimizes for pattern absorption |
| Writer already knows the answer | Writer is figuring it out |
| AI can generate it at volume | AI can generate text *about* it, but can't demonstrate it |

The distinction that matters is the last row. AI-generated content is optimized for plausibility and completeness. Witnessed practice is optimized for authenticity of process, and authentic process requires genuine uncertainty and genuine recovery, which is precisely what a text generator can't have about your product.

---

## The apprenticeship root

The format works because it restores something two separate shifts eroded. Pai tells a story about starting out in Hyderabad, sitting next to a senior engineer and copying everything. Not the code so much as how she debugged, how she moved around a codebase, and how she asked for help. Nobody makes a course out of "watch how this person narrows down a problem." You observe it, try it, and absorb it.

Remote work reduced that ambient apprenticeship. AI tools added a second layer of separation: many earlier-career engineers may be touching less of the raw material of the work, because the machine now generates so much of it. That leaves less osmosis at exactly the moment osmosis matters more. "Watch me work" content partially restores what's missing. [swyx's "learn in public"](https://www.swyx.io/learn-in-public) ethos was an early version of the same insight: showing your working process compounds trust in a way polished output doesn't.

---

## The supply gap

The demand side is visible. Look at what's still healthy while course sales sag. ThePrimeagen's streams work because ten years of performance-critical engineering is visible in the process rather than asserted in the bio. [Theo's](https://t3.gg/) judgment-first content ("why I chose X over Y," "I was wrong about Z") shows decision-making instead of conclusions. [Simon Willison's](https://simonwillison.net/) posts reconstruct entire debugging sessions, down to what he tried, what failed, and the prompt that finally worked. [Julia Evans](https://jvns.ca/) explicitly shows the confusion-to-clarity arc instead of the clarity alone.

Notice what that list has in common: they're all independents. I went looking for a company DevRel team that has systematized witnessed practice and found none. The closest things are individual advocates doing it personally, or "build in public" programs optimized for marketing rather than judgment transmission. The demand signal is strong, the supply from corporate DevRel is near zero so far, and the format is sitting there unclaimed.

---

## What it looks like in practice

The mechanics that separate witnessed practice from a sloppy stream:

**Narrate the decision layer, not the action layer.** "I'm going to try X" is narration. "I'm reaching for X rather than Y because the schema isn't stable yet" is judgment made visible. The judgment narration is the entire product.

**Include the dead ends.** A workflow showing only successful moves is a tutorial with a camera running. The backtracks and the "actually, no" moments are what make it witnessed.

**Make the recovery visible.** The moment the agent went wrong and you caught it, or didn't catch it immediately, is the highest-value moment in the format. It's more informative than any best-practices section you will ever write.

My own sample-project workflow is a small version of this. I write the first language implementation by hand, use an LLM to translate to the other languages, then validate with code spot-checks, compile-and-run tests, browser testing of the user flow, and a cross-language consistency pass. LLM passes for comments and README come last. Written down as a numbered list, it's a process doc. Narrated while it happens, with why the first implementation is by hand, what the spot-checks are actually looking for, and which language the translation mangles and how I notice, it's witnessed practice. It's the same workflow. The judgment narration is the difference.

"Here is how a thoughtful person uses this SDK in a real workflow, including the dead ends" is closer to apprenticeship than marketing. Which, as Pai points out, is maybe what good DevRel was always closer to anyway.

---

*Part 4 of 9 in the Developer Relations in the Age of AI series.*

*← Previous: The 25% That AI Can't Do · Next: DevRel Is Distribution Work → · ← All articles*
