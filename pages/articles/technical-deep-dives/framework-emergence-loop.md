---
title: 'The Framework Emergence Loop: How Durable AI Workflows Are Actually Found'
layout: 'partials::layouts/writing-post'
date: '2026-07-09'
slug: framework-emergence-loop
image: framework-emergence-loop-og.png
heroImage: framework-emergence-loop-hero.png
description: >-
  Durable AI workflows aren't designed upfront, they're found through repeated
  rebuilding. Six iterations reveal why the framework emergence loop works.
draft: false
enriched: true
---

# The framework emergence loop: how durable AI workflows are actually found

I rebuilt it for the fifth time and thought, "Something is wrong with me."

It was an AI agent framework, a system for managing context, encoding agent behavior, and keeping useful state across sessions. Version one solved the problem it was built for. Version two fixed what version one broke. Version three introduced the structural idea that made it work. Version four folded in six months of real-world use. Version five existed because version four developed a failure I couldn't patch, I had to rebuild around the lesson.

Looking at version five, I thought it was finally the one.

It wasn't. There's a sixth now.

As I kept going, my relationship to the rebuilding changed. It stopped feeling like proof the last version failed and started looking like the mechanism that makes the thing better. The loop isn't the symptom. It's the process.

## Premature convergence in AI frameworks

Software has a name for this: premature convergence, locking a design down before it meets real conditions. You see it in API design constantly. A team ships a clean v1 that solves known problems, then finds in production that the known problems were never the important ones. The next six months go to either bolting on compatibility shims or admitting v2 has to exist. The library world has done this with auth, state management, and build tooling, over and over. Every version looks finished until production reveals the failure modes that force the next one.

AI agent frameworks hit this harder and faster than most software. Context collapse, agent drift, persistence gaps, rigidity under weird inputs, none of that shows up in design. It shows up when the framework does real work across real sessions. You can't see it coming. You have to run into it.

## Six iterations and what each taught

The chain goes back to a project called `gsd-planner`. Its core insight was a multi-stage structure: Research, then Plan, then Implement. Good enough to validate.

Version two, `gsd-planner-2`, learned that cross-session state has to be explicit. When the agent lost its thread between sessions, nothing could recover it, the session restarted and everything established was gone.

Version three, `gsd-planner-3`, introduced the `knowledge-graph.json` pattern: a structured JSON file the agent reads at session start and updates as it works. This was the breakthrough. Not elegant, not complete, but the idea was right, a stable artifact that outlives a context window.

Version four, `product-work`, made the PRD the source of truth: the agent works against the spec instead of reconstructing it from chat history. Version five, `product-work-2`, turned skills into installable units with a plugin marketplace, agent knowledge as discrete, reusable components instead of one big config. Version six, `claude-code-config`, added role-aware agents and drift detection: noticing when an agent's behavior strays from its role and pulling it back before the divergence snowballs.

Each version taught one lesson the previous couldn't have anticipated. That's not a design failure. That's how you find the lesson. The artifacts that emerged, persistent context files, authoritative specs, installable skills, are the same ones the earlier posts present as first principles. The difference is this chain had to break first to understand why they were necessary.

## The myth of getting it right the first time

The misconception is that a team with enough experience could design the right framework upfront and skip the cycle. That's the wrong lesson from the right observation, that each version's failure looks obvious in hindsight. Of course you need persistent state. Of course drift needs detection. Of course the spec should be authoritative. All obvious after you've built the thing without them and watched it break exactly where the absence said it would. None of it obvious before.

The failure mode isn't rebuilding. It's refusing to rebuild once the lesson is clear, polishing version four past the point where a new architecture would help, because sunk cost makes starting over feel like defeat. That instinct is expensive. The frameworks that survive are built by people who see when they've hit the structural ceiling of the current version and choose to build the next.

## The knowledge-graph pattern

The most portable idea from this chain is the `knowledge-graph.json` pattern: a structured file the agent loads at session start and updates as it works. It's the closest thing to persistent memory across context windows we've found. Not a database or vector store, a human-readable JSON file with a defined schema, committed alongside the code, loaded as the agent's first move each session.

What makes it durable is that it survives the failure it was built to fix. When a session ends mid-work, the graph holds what was established: decisions, context, completed tasks. The next session starts there instead of from nothing. The sessions compound instead of resetting.

The pattern got refined across iterations. Schema changed, update protocol changed, what's worth keeping changed, the core idea survived all of it. That's usually the test: is this a good structural idea, or just the most convenient fix for last week's problem?

The production form isn't a JSON file anymore. It's an Obsidian vault, connected notes as nodes, agents updating them across sessions to capture decisions and concepts, the graph persisting not just across context windows but across tooling changes. The JSON file was the prototype that proved the structure. The vault is what it became when it had to survive real use.

Look at what the pattern encodes and you see the loop doing something narrower than generic refinement. The schema isn't for a human to read later. It's for the agent to load at session start and act on immediately. Every field exists because the agent's next decision depends on it, not because the note is nice to have. That's agent-experience thinking at its most concrete: the artifact is built for the agent's navigation, not the developer's convenience. What the loop teaches, version by version, is what an agent needs to move through your system without guessing. Harder than it sounds, and only answerable by watching the last version fail.

## What this means in practice

For teams building AI-assisted workflows: your iteration budget isn't a failure budget. When an internal framework for AI code review falls apart on edge cases you didn't see, that's the system telling you what the next version needs. The discipline is writing down what broke and why, specifically, not vaguely, so the next build starts from that knowledge instead of rediscovering it.

For the developers building these systems: instrument the failure modes. When the agent loses its thread, when drift happens, when context collapses, capture it as signal, not noise to filter out. The failure modes are the spec for the next version. If you can say "our current system breaks this specific way under these specific conditions," you're already most of the way there.

The frameworks that work in production AI workflows weren't designed to work. They were found through a series of intentional failures, each one surfacing the lesson that made the next version possible. The loop isn't a symptom of something going wrong. It's how something good gets built.

The answer has rarely been better prompts. It's been better decisions, made earlier, written where the agent can find them. If you're starting from zero, that's where the work begins.

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
