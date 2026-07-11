---
title: 'The Framework Emergence Loop: How Durable AI Workflows Are Actually Found'
layout: 'partials::layouts/writing-post'
date: '2026-07-09'
slug: framework-emergence-loop
image: framework-emergence-loop-og.png
heroImage: framework-emergence-loop-hero.png
description: >-
  You don't design a durable AI agent framework. You find one through a series
  of intentional failures. Here's what six iterations taught me.
draft: false
enriched: true
---

# The Framework Emergence Loop: How Durable AI Workflows Are Found

I rebuilt it for the fifth time and thought something was wrong with me.

It was an AI agent framework: a system for managing context, encoding agent behavior, and keeping useful state alive across sessions. The first solved the problem it was built for. The second fixed what the first broke. The third introduced the structural idea that made it work. The fourth folded in six months of real-world lessons. The fifth existed because the fourth developed a failure I couldn't patch, I had to rebuild around what it taught me.

The fifth looked like the one. It wasn't. There's a sixth now.

Refusing to quit changed my relationship with rebuilding. It stopped feeling like proof the last version failed and became the mechanism that makes the thing better. The loop isn't a symptom. It's the process.

---

## Premature convergence in AI frameworks

Software has a name for this: premature convergence, locking a design down before it meets real conditions. You see it in API design. A team ships a clean v1 solving known problems, then finds in production those weren't the ones that mattered. For six months they bolt on compatibility shims or admit v2 has to exist. Libraries have done this with auth, state management, build tooling, over and over. Every version looks finished until production exposes the failure modes that force the next.

AI agent frameworks hit this harder and faster than most software. Failure modes, context collapse mid-session, agent drift, persistence gaps, rigidity under weird input, aren't visible on the whiteboard. They show up only when the framework does real work across sessions. You can't see them coming. You run into them.

---

## Six iterations and what each taught

The chain started with `gsd-planner`. Its core insight was a multi-stage structure: Research, then Plan, then Implement. Simple enough to validate. The second, `gsd-planner-2`, learned that cross-session state must be explicit, not something the agent remembers. When it lost the thread between sessions, nothing recovered it, the session restarted and everything established was gone. Version three, `gsd-planner-3`, introduced the `knowledge-graph.json` pattern: a structured JSON file the agent reads at session start and updates as it goes. The breakthrough. Not elegant or complete, but structurally right, a stable artifact that outlives the context window.

The fourth, `product-work`, made the PRD the source of truth: the spec the agent works against instead of reconstructing from chat history. The fifth, `product-work-2`, added skills as installable units and a plugin marketplace, packaging agent knowledge as reusable pieces instead of one giant config. The sixth, `claude-code-config`, added role-aware agents and drift detection: noticing when behavior wanders from its role and pulling it back before drift snowballs.

Each version taught one lesson the previous couldn't see. Not a design failure. That's how you find the lesson. The artifacts that emerged, persistent context files, authoritative specs, installable skills, are the same ones Posts 2 and 3 present as first principles. The difference: this chain had to break to understand why they were necessary.

---

## The misconception about getting it right the first time

The misconception: a team with enough experience and foresight could design the right framework up front and skip the cycle. Wrong takeaway from the right observation, each failure looks obvious in hindsight. Of course you need persistent state. Of course role drift needs detection. Of course the spec should be the authority. These are obvious after you've built without them and watched it break where the absence said it would. Not before.

The failure isn't rebuilding. It's refusing to rebuild once the lesson is clear, optimizing the current version past where a fresh architecture would do better, because sunk cost makes starting over feel like admitting you were wrong. That instinct is expensive. Frameworks that survive are built by people who recognize the structural ceiling and choose to build the next version.

---

## The knowledge-graph pattern

The most useful idea from this chain is the `knowledge-graph.json` pattern: a structured file the agent reads at session start and updates as it works. It's the closest practical thing to memory that survives a context window. Not a database or vector store, a human-readable JSON file with a defined schema, committed alongside the code, loaded by the agent as the first act of each session.

It's durable because it outlasts the failure it was built to fix. When a session ends unfinished, the graph still holds what was established: decisions, loaded context, completed tasks. The next session picks up from that record instead of a blank slate. Sessions compound instead of restarting.

The pattern refined across versions. Schema changed. Update protocol changed. What's worth saving changed. The core idea survived. That's the test, a good structural idea lasts the refactors; a convenient fix for last week's problem doesn't.

In production it's no longer a JSON file. It's an Obsidian vault: connected notes as nodes, agents update them across sessions to capture decisions and concepts, and the graph persists across context windows and tooling changes. The JSON file proved the structure. The vault is what it became under real use.

Look at what the `knowledge-graph.json` pattern is for, and you see the loop doing something more specific than refactoring. The schema isn't for a human to read later. It's for an agent to load at session start and act on. Every field exists because the agent's next decision depends on it, not because the note is nice to have. That's AX thinking in concrete form: the artifact is built for the agent's navigation, not the developer's convenience. The loop teaches, version by version, what an agent needs to move through your system without guessing. Harder than it looks, and only answered by watching the last version fail.

---

## What this means in practice

If your team builds AI-assisted workflows: your iteration budget isn't your failure budget. When an internal framework for AI-assisted code review chokes on unseen edge cases, the system is telling you what the next version needs. The discipline is writing down what broke and why, specifically, not vaguely, so the next build starts from that knowledge instead of rediscovering it.

For builders: instrument the failure modes. When the agent loses its thread, drift appears, context collapses, capture it as signal, not noise. Failure modes are the spec for the next version. A team that can say "our system breaks this specific way under these specific conditions" is already most of the way to the fix.

---

Frameworks that hold up in production weren't designed to work. They were found through intentional failures, each surfacing the lesson that made the next version possible. The loop isn't a symptom of something wrong. It's how something good gets built.

The answer is rarely better prompts. It's better decisions, made earlier, written where the agent can find them. If you're starting from zero, that's where the work begins.

---

*Part 6 of 6 in the [[Projects/Blog Series, Agentic Product Development Workflows|Agentic Product Development Workflows]] series.*

*← [How to Know If Your Agentic Workflow Is Actually Working](Post 5 - Evaluating Agentic Workflows (G).md)*

---

## Related
- [[Concepts/Framework Emergence Loop]]
- [[Concepts/Agentic Workflows]]
- [[Projects/Blog Series, Agentic Product Development Workflows]]

*Suggested title: "The Framework Emergence Loop: How Durable AI Workflows Are Found"*
*Meta description: You don't design a durable AI agent framework. You find one through a series of intentional failures. Here's what six iterations taught me.*
