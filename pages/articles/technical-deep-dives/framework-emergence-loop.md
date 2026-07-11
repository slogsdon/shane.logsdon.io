---
title: 'The Framework Emergence Loop: How Durable AI Workflows Are Actually Found'
layout: 'partials::layouts/writing-post'
date: 2026-07-09
slug: framework-emergence-loop
image: framework-emergence-loop-og.png
heroImage: framework-emergence-loop-hero.png
description: >-
  You don't design a durable AI agent framework. You find one through a series
  of intentional failures. Here's what six iterations taught me.
draft: false
enriched: true
---

<!--
**CLASSIFICATION (pre-article):**
Article type: Retrospective. Technical depth: Moderate-Deep. Primary tension: Business readers want to understand why AI tooling investment compounds rather than accumulates; developers want a model for the kind of iteration that produces durable systems. Narrative architecture: Retrospective, looking back at a multi-year iteration chain and tracing the pattern that was invisible while it was happening. Hook strategy: Scene-setting vignette, the moment of rebuilding again, and the realization that this is the sixth time.
-->

# The framework emergence loop: how durable AI workflows are actually found

I rebuilt it for the fifth time and thought, "Something is wrong with me."

It was an AI agent framework, a system for managing context, encoding how the agent should behave, and keeping useful state alive across sessions. The first version solved the problem it was built for. The second fixed what the first had broken. The third brought in the structural idea that made it actually work. The fourth incorporated lessons from six months of real use. The fifth existed only because the fourth had a failure mode I couldn't patch by tweaking, I had to rebuild around the lesson.

I stared at that fifth version thinking that maybe this was finally the one.

It wasn't. There's a sixth now.

Not quitting changed how I saw rebuilding. It stopped feeling like proof that the previous version had failed, and became the mechanism that makes the thing better. The loop isn't a symptom. The loop is the process.

---

## Premature convergence in AI frameworks

This pattern has a name in software: premature convergence, the urge to lock a design down before it meets real conditions. You see the classic version in API design: a team ships a v1 that elegantly solves the problems they knew about, then discovers in production that those weren't the important ones. They spend the next six months either bolting on baroque compatibility shims or finally admitting v2 has to exist. The library world has done this with auth, state management, build tooling, repeatedly. Every version looks complete until the failure modes that only show up in production force the next one.

AI agent frameworks hit this pattern faster and harder than most software. The failures, session context collapse, agent drift, persistence gaps, rigidity under novel inputs, aren't visible in design. They appear only when the framework is running real work across real sessions. You can't fully anticipate them. You have to run into them.

---

## Six iterations and what each taught

The six-version chain I've been through started with a project called `gsd-planner`. The core insight was multi-stage structure: Research, then Plan, then Implement. It worked well enough to validate. The second version, `gsd-planner-2`, learned that cross-session state needs to be explicit, not implicit. When the agent lost its thread between sessions, there was no way to recover it, so the session started over and everything established was gone. Version three, `gsd-planner-3`, introduced the `knowledge-graph.json` pattern as a deliberate approach to persistent memory: a structured JSON file the agent reads at session start and updates as it works. That was the breakthrough. Not elegant or complete, but the structural idea was sound, a stable artifact that survives context windows.

The fourth iteration, `product-work`, made the PRD the source of truth: the spec the agent operates against rather than reconstructs from conversation history. The fifth, `product-work-2`, brought in skills as installable units and a plugin marketplace pattern, a way to package agent knowledge as discrete, reusable components instead of monolithic config. The sixth, `claude-code-config`, added role-aware agents and drift detection: the ability to notice when an agent's behavior has diverged from its defined role and pull it back before the divergence compounds.

Each version taught one lesson the previous couldn't have anticipated. That's not a design failure. That's how you find the lesson. The artifacts that emerged, persistent context files, authoritative specs, installable skills, are the same ones Posts 2 and 3 introduce as first principles. The difference is that this chain had to hit the failure modes first to understand why they were necessary.

---

## The misconception about getting it right the first time

Here's the myth about this kind of iteration: that a team with enough experience and foresight could design the right framework upfront and skip the cycle. That's the wrong conclusion from the right observation, each version's failure mode looks obvious in retrospect. Of course you need persistent state. Of course role drift needs detection. Of course the spec should be the authoritative document. These are obvious after you've built a system lacking them and watched it break exactly as the absence predicts. They aren't obvious before.

The failure mode isn't rebuilding. It's refusing to rebuild when the lesson is clear, instead optimizing the fourth version past the point where a new architecture would serve better, because the sunk cost makes rebuilding feel like admitting failure. That instinct is expensive. The framework that survives is the one whose builders can recognize when they've hit the current version's structural ceiling and decide to build the next.

---

## The knowledge-graph pattern

The most transferable idea from this chain is the `knowledge-graph.json` pattern: a structured file the agent reads at session start and updates as it works. It's the closest practical stand-in for persistent memory across context windows. Not a database or vector store, just a human-readable JSON file with a defined schema, committed to version control alongside the code, loaded by the agent as its first action each session.

What makes it durable is that it outlives the failure it was built to address. When a session ends without finishing, the knowledge graph holds what was established: decisions made, context loaded, tasks done. The next session starts from that record instead of a blank slate. The sessions compound rather than restart.

This pattern got refined across iterations. The schema changed, the update protocol changed, what counts as worth persisting changed, and the core idea survived all of it. That's usually the test of whether something is a good structural idea or just the most convenient fix for last week's problem.

The production form isn't a JSON file anymore. It's an Obsidian vault: connected notes are the nodes, agents update them across sessions to capture decisions and concepts, and the graph persists not just across context windows but across tooling changes. The JSON was the prototype that proved the structure was right. The vault is what the structure became when it had to survive real use.

Look at what the `knowledge-graph.json` pattern encodes and you see the loop doing something more specific than generic software refinement. The schema isn't designed for a human to read later. It's designed for an agent to load at session start and act from immediately. Every field is there because the agent's next decision depends on it, not because the info is generally nice to have. This is AX thinking in its most concrete form: the artifact is built for the agent's navigation, not the developer's convenience. What the loop teaches, iteration by iteration, is what an agent needs to navigate your system without guessing. That's a harder question than it looks, and you can only answer it by watching the previous version fail.

---

## What this means in practice

For teams building AI-assisted workflows: your iteration budget isn't a failure budget. When an internal framework for AI-assisted code review breaks down on edge cases you didn't anticipate, that's the system telling you what the next version needs to address. The discipline is documenting what broke and why, specifically, not generally, so the next build starts from that knowledge instead of rediscovering it.

For developers building these systems, instrument the failure modes. When the agent loses its thread, when drift occurs, when context collapses, capture that as signal, not noise to filter out. The failure modes are the spec for the next version. A team that can say "our current system breaks this specific way under these specific conditions" is already most of the way to the next version.

---

The frameworks that work in production AI workflows weren't designed to work. They were found through a series of intentional failures, each revealing the lesson that made the next version possible. The loop isn't a symptom of something going wrong. The loop is how something good gets built.

The answer has rarely been better prompts. It's been better decisions, made earlier, written down somewhere the agent can find them. If you're starting from zero, that's where the work starts.

---

*Part 6 of 6 in the [[Projects/Blog Series, Agentic Product Development Workflows|Agentic Product Development Workflows]] series.*

*← [How to Know If Your Agentic Workflow Is Actually Working](Post 5 - Evaluating Agentic Workflows (G).md)*

---

## Related
- [[Concepts/Framework Emergence Loop]]
- [[Concepts/Agentic Workflows]]
- [[Projects/Blog Series, Agentic Product Development Workflows]]

*Suggested title: "The Framework Emergence Loop: How Durable AI Workflows Are Actually Found"*
*Meta description: You don't design a durable AI agent framework. You find one through a series of intentional failures. Here's what six iterations taught me.*
