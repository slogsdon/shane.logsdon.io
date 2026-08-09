---
title: 'The Framework Emergence Loop: How Durable AI Workflows Are Actually Found'
layout: 'partials::layouts/writing-post'
date: 2026-07-09
slug: framework-emergence-loop
image: framework-emergence-loop-og.png
heroImage: framework-emergence-loop-hero.png
draft: false
enriched: true
---

# The framework emergence loop: How durable AI workflows actually get found

I rebuilt it for the fifth time and thought, "Something is wrong with me."

It was an AI agent framework, a system for managing context, encoding agent behavior, and keeping useful state across sessions. Version one solved the problem it was built for. Version two fixed what version one broke. Version three introduced the structural idea that made everything click. Version four folded in six months of real-world use. Version five existed because version four had developed a failure I couldn't patch my way out of. I had to rebuild around the lesson.

Looking at version five, I figured maybe this was finally the one.

It wasn't. There's a sixth now.

Somewhere in the not-giving-up, my thinking about the rebuilding changed. It stopped feeling like proof the last version failed and started looking like the actual mechanism for getting better. The loop isn't the symptom. It's the process.

---

## Premature convergence in AI frameworks

This has a name in software: premature convergence, the urge to lock a design down before it's met real conditions. The classic case is API design. A team ships a clean v1 that solves the known problems, then finds in production that the known problems were never the real ones. Then they spend six months either bolting on compatibility shims or admitting v2 has to exist. Auth, state management, build tooling, the library world has done this over and over. Every version looks done until production reveals the failure modes that force the next one.

AI agent frameworks hit this harder and faster than most software. Session context collapse, agent drift, persistence gaps, rigidity under weird inputs, none of that shows up in design. It only appears when the framework is doing real work across real sessions. You can't see it all in advance. You have to run into it.

---

## Six iterations and what each taught

The six-version chain started with a project called `gsd-planner`. The core insight was multi-stage structure: Research, then Plan, then Implement. Good enough to validate. Version two, `gsd-planner-2`, learned that cross-session state has to be explicit, not implied. When the agent lost its thread between sessions, nothing could recover it, so the session restarted and everything established was gone. Version three, `gsd-planner-3`, introduced the `knowledge-graph.json` pattern as a deliberate approach to persistent memory: a structured JSON file the agent reads at session start and updates as it goes. That was the breakthrough. Not elegant, not complete, but the structure was right, a stable artifact that outlives context windows.

Version four, `product-work`, made the PRD the source of truth: the spec the agent works against instead of reconstructing from chat history. Version five, `product-work-2`, added skills as installable units and a plugin marketplace, a way to ship agent knowledge as discrete, reusable pieces instead of one monolithic config. Version six, `claude-code-config`, added role-aware agents and drift detection: noticing when an agent's behavior slipped from its defined role and pulling it back before the slip compounded.

Each version taught one lesson the previous one couldn't have seen coming. That's not a design failure. That's how you find the lesson. The artifacts that emerged, persistent context files, authoritative specs, installable skills, are the same ones Posts 2 and 3 present as first principles. The difference is this chain had to break first to understand why they were necessary.

---

## The myth of getting it right the first time

Here's the misconception about this kind of iteration: that a team with enough experience could design the right framework upfront and skip the cycle. That's the wrong takeaway from the right observation, that each version's failure looks obvious in hindsight. You need persistent state. Role drift needs detection. The spec should be authoritative. These are obvious after you've built a system without them and watched it break exactly where the absence said it would. They are not obvious before.

The failure mode isn't rebuilding. It's refusing to rebuild once the lesson is clear, instead polishing version four past the point where a new architecture would do better, because the sunk cost makes starting over feel like admitting defeat. That instinct is expensive. The framework that survives is built by people who can see when they've hit the structural ceiling of the current version and choose to build the next one.

---

## The knowledge-graph pattern

The most transferable idea from this chain is the `knowledge-graph.json` pattern: a structured file the agent reads at session start and updates as it works. It's the closest practical thing to persistent memory across context windows. Not a database or vector store, a human-readable JSON file with a defined schema, committed alongside the code, loaded by the agent as its first move each session.

What makes it durable is that it outlives the failure it was built to address. When a session ends mid-work, the knowledge graph keeps what got established: decisions, context, completed tasks. The next session starts there instead of from nothing. The sessions compound instead of restarting.

The pattern got refined across iterations. The schema changed, the update protocol changed, what's worth persisting changed, and the core idea survived all of it. That's usually the test of whether something is a real structural idea or the most convenient fix for last week's problem.

The production form isn't a JSON file anymore. It's an Obsidian vault: connected notes are the nodes, agents update them across sessions to capture decisions and concepts, and the graph persists not just across context windows but across tooling changes. The JSON file was the prototype that proved the structure. The vault is what it became when it had to survive real use.

Look at what the `knowledge-graph.json` pattern actually encodes and you see the loop doing something more specific than generic software refinement. The schema isn't for a human to read later. It's for an agent to load at session start and act on immediately. Every field exists because the agent's next decision depends on it, not because the info is nice to have written down. That's AX thinking in its most concrete form: the artifact is built for the agent's navigation, not the developer's convenience. What the loop teaches, version by version, is what an agent needs to move through your system without guessing. Harder than it sounds, and only answerable by watching the previous version fail.

---

## What this means in practice

For teams building AI-assisted workflows: your iteration budget is not a failure budget. When an internal framework for AI-assisted code review breaks on edge cases you didn't see coming, that's the system telling you what the next version needs. The discipline is writing down what broke and why, specifically, not vaguely, so the next build starts from that knowledge instead of rediscovering it.

For developers building these systems, instrument the failure modes. When the agent loses its thread, when drift happens, when context collapses, capture that as signal, not noise to filter out. The failure modes are the spec for the next version. A team that can say "our current system breaks this specific way under these specific conditions" is already most of the way to the next version.

---

The frameworks that work in production AI workflows weren't designed to work. They were found through a series of deliberate failures, each one surfacing the lesson that made the next version possible. The loop isn't a symptom of something going wrong. The loop is how something good gets built.

The answer has rarely been better prompts. It's been better decisions, made earlier, written down somewhere the agent can find them. If you're starting from zero, that's where the work begins.

---

*Part 6 of 6 in the [Agentic Product Development Workflows](/articles/agentic-workflows/) series.*

*← Previous: [How to Know If Your Agentic Workflow Is Actually Working](/articles/technical-deep-dives/evaluating-agentic-workflows/)*
