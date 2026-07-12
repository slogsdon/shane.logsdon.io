---
title: "The 75% Problem: Why AI-Assisted Builds Stall at the Finish Line"
date: 2026-05-18
layout: 'partials::layouts/writing-post'
slug: the-75-percent-problem
image: the-75-percent-problem-og.png
heroImage: the-75-percent-problem-hero.png
draft: false
description: "AI gets you to 75% fast. That's the trap: the 75% mark looks finished, and the last 25% takes as long as the first 75%. Here's how to plan for it."
faqs:
  - q: "What is the 75% problem in AI-assisted development?"
    a: "The pattern where AI-assisted builds stall at the 75% mark — the scaffold is done, the demo works, the tests pass — but the domain-specific finishing work (edge cases, integration nuance, operational constraints) takes as long as the first 75% and requires expertise the model doesn't have access to."
  - q: "Is the 75% problem a model capability limitation?"
    a: "No. The model can generate code for edge cases, error handling, and integration nuance. The issue is that plausible and correct diverge as you approach the specification boundary — the territory the spec left undefined. That's not a capability ceiling. It's a spec gap."
  - q: "How does spec quality change the shape of the last 25%?"
    a: "A complete spec that names failure modes, edge cases, and integration constraints extends the specified territory into the finishing work. When the spec covers that territory explicitly, the model can operate in it reliably. When the spec leaves it open, you're debugging guesses rather than implementations."
---

The demo worked. I had run it three times, walked through the flow twice, and it did exactly what I'd described. The scaffold was clean, with components wired up, API calls returning data, and the basic interaction pattern intact. By any reasonable interpretation of "working," it was working.

Then I tried to ship it.

The authentication edge case that only appeared with expired tokens turned out to be one thing. The schema field that was optional in the prototype turned out to be required by the consuming service. The error state that the UI handled gracefully on the happy path handled catastrophically in the one case that actually matters in production. The performance characteristic that was invisible at demo scale became obvious at real scale. None of these were complicated problems. They were the 25% of the problem that the first 75% hadn't touched yet.

The uncomfortable part is that the 75% felt like 95%. The demo looked complete, the code compiled, and the tests I'd written passed. The AI had been fast and capable and had produced something that genuinely worked. The 75% mark doesn't announce itself. It looks, from the inside, a lot like being nearly done.

<!--more-->

---

## Why the 75% mark feels like the finish line

This pattern has a name now, the 75% Problem, and it's the convergence point for the discipline Posts 2 and 3 described. The spec-first work from those posts exists partly for this reason: without an authoritative spec, the 75% mark looks like completion, because there's nothing to tell you what's still missing.

The scaffolding phase is fast. AI tools generate boilerplate, translate requirements into code structure, and handle the high-frequency patterns, including CRUD operations, standard API integrations, and component wiring, with impressive accuracy. The speed creates a real benefit: you can validate an approach in hours rather than days.

What it also creates is a particular calibration error. When the first 75% takes two hours, the temptation is to assume the remaining work is proportional. It almost never is.

---

## Where domain judgment lives

The last 25% of most software problems is where the domain-specific judgment lives. Which failure modes are distinct enough to handle separately, and which can be collapsed into a single error state? What does "incomplete" look like versus "failed," and do those mean the same thing to the downstream consumer? What's the correct retry policy for this specific rate limit on this specific API, not in general but here?

These are not questions a language model answers well from general training data. They're questions about your system, your constraints, your users, and your operational context. The AI has no access to those things except through what you tell it explicitly.

---

## The actual problem isn't capability

There's a common misconception embedded in how teams talk about the 75% Problem: that the issue is the AI stopping, as if the model runs out of capability at some threshold and the human has to take over. That's not what's happening. The model can generate code for authentication edge cases, error handling, performance optimization, and integration nuance. What it generates will be plausible, it will compile, and it will address the obvious version of each problem.

The actual issue is that plausible and correct diverge as you approach the boundary of what's specified. In the scaffold phase, the specified territory is large: "build a component that fetches user data and renders a list" has enough signal for a capable model to produce something useful. In the finishing phase, the territory is narrow and domain-specific: handle the case where the API returns a 206 Partial Content for this endpoint in particular, because the consuming client has a race condition in its retry logic that our retry policy needs to account for. That's not a prompt the model can answer from training data. It's a prompt that requires information the model doesn't have.

The 75% problem is not a capability ceiling. It's a specification boundary. The model works reliably within the specified territory and infers, plausibly but not correctly, outside it.

---

## How spec quality changes the shape of the last 25%

This is where the connection to spec quality becomes concrete. A complete design spec that names failure modes, edge cases, integration constraints, and operational requirements doesn't only improve the first 75%. It also extends the specified territory into the last 25%. Exit codes named for their specific shell automation context rather than numbered generically. Retry policy bounded to a specific number of attempts with specific backoff behavior rather than "handle transient failures." Authentication behavior described for both the token-valid and token-expired path rather than assuming the happy path.

When the spec covers that territory explicitly, the AI can operate in it reliably. When the spec leaves it open, the AI fills it with probability, and the 25% that was already hard becomes harder, because you're now debugging guesses rather than implementations.

Teams that front-load this work consistently find that the last 25% takes about the same amount of time, but looks different: it's integration, verification, and alignment work rather than discovery and correction. The total time shifts, but the distribution of effort shifts more, away from unexpected rework late and toward planned specification early.

---

## The part that's harder than it looks

The specification work that would close the 25% gap is often the work you don't know to do until you've seen the 75%. The authentication edge case isn't obvious until the prototype is running against a real auth service. The schema misalignment isn't visible until the consuming script tries to parse the output. The performance characteristic isn't measurable until you have real data volume.

This is a genuine constraint, not a failure of planning discipline. The practical response is the alignment pass: after the first implementation, compare the output against the spec, identify where the spec was silent on things that turned out to matter, update the spec, and close the gaps with a second pass. It's not a failure to find gaps here. That's the mechanism you need. The spec is authoritative enough to audit against, and the audit is where the 25% gets addressed deliberately rather than discovered accidentally in production.

---

## Planning and evaluation heuristics

As a planning heuristic: when estimating AI-assisted work, don't discount the last 25%. If anything, add time there rather than removing it, because that's where domain expertise matters most and AI assistance is least reliable. The speed you gain in the scaffold phase is real. Treat it as time freed for the finishing work, not as a reason to shrink the overall estimate.

For developers evaluating AI tools: the question to ask is not "how much code does this generate?" but "how far into the specified territory can this operate reliably?" A tool that generates excellent scaffold code quickly is valuable. A workflow that ensures the specified territory extends into the domain-specific finishing work is what turns that value into shipped software.

The 75% mark is not a failure. The scaffold is real, the speed was real, and the AI did exactly what it was specified to do. What it couldn't do is fill in what the spec left out, and in the last 25%, what the spec left out is everything that requires knowing your system, your constraints, and your users. That's not a gap the model can close. That's the work.

---

*Part 4 of 6 in the [Agentic Product Development Workflows](/articles/agentic-workflows/) series.*

*Next: [How to Know If Your Agentic Workflow Is Actually Working](/articles/technical-deep-dives/evaluating-agentic-workflows/) →*
