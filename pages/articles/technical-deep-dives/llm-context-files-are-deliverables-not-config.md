---
title: "LLM Context Files Are Deliverables, Not Config"
date: 2026-05-04
layout: 'partials::layouts/writing-post'
image: llm-context-files-are-deliverables-not-config-og.png
heroImage: llm-context-files-are-deliverables-not-config-hero.png
slug: llm-context-files-are-deliverables-not-config
---

I wrote my first CLAUDE.md in about fifteen minutes. It covered the tech stack, a few notes about TypeScript over JavaScript, a reminder about commit message format. It felt thorough. I didn't touch it for three months.

Every session, I kept adding the same clarifications. The same note about the error handling pattern we'd settled on. The same reminder that the API client was the single integration point, not a thing to be bypassed in one-off routes. The same correction about console.log statements before committing. I was rebuilding context with the agent from scratch every session, by hand, in the chat, because the file that was supposed to prevent that was frozen in week one.

The misdiagnosis I was making: I thought CLAUDE.md was configuration. Something you set up properly once, like an `.editorconfig` or a linter ruleset, and then let run. That framing was why it wasn't working. Configuration files describe how tools should behave. A CLAUDE.md describes what the project is, what decisions have been made, and what the agent needs to navigate it without guessing. Those are fundamentally different things, and the second one doesn't stay accurate on its own. That distinction is the first practical consequence of the AX shift: the file that shapes agent behavior every session is a first-class engineering artifact, not a config toggle.

<!--more-->

---

## Global versus project context files

Before getting into structure, there's a distinction worth making explicit. A global CLAUDE.md, typically at `~/.claude/CLAUDE.md`, is the behavioral layer. It shapes how the agent works regardless of project: answer first, flag speculation, ask before diving into large changes, don't fabricate. This is personality and work style, and it persists across projects because the underlying preferences do. A project CLAUDE.md, at the repo root, is the contextual layer. It shapes what the agent knows about this codebase: stack, folder structure, conventions, and explicit boundaries. Both matter, and they do different jobs.

Most people think about only one of them. The teams who treat AI-assisted development as a serious workflow maintain both and keep both current.

## What a useful context file actually contains

Within the project layer, what separates useful context files from vague ones comes down to two categories before you get to the boundary tier. The first is invocation details. The second is process conventions.

Invocation details means commands with full flags, not tool names. "Run the tests" is a description. `npm test -- --coverage --watch=false` is an instruction. The agent needs the exact invocation, and the same applies to build, lint, type-check, and any CI-relevant commands. If the command requires environment setup, note that too. It also means explicit file paths: not "the API layer" but `src/lib/api/`, with a note that all external calls go through `src/lib/api/client.ts`. Not "the components folder" but `src/components/` with whatever structural rules apply. Agents pattern-match from concrete anchors. One canonical code snippet beats three paragraphs describing a pattern: if your error handling follows a specific shape, paste a real example. If your components use a particular structure, paste the shell. Description and demonstration both work at first, but demonstration is what the agent will actually match against.

Process conventions covers testing and git. For testing: not "we use Jest" but where tests live (`__tests__/`, or `*.test.ts` colocated, or `tests/integration/` for integration tests), what coverage threshold is enforced, and whether there's a separate command for watch mode versus CI. "We use Jest" leaves the agent guessing at all of this. For git, note the branch naming prefixes, commit message format, PR requirements, and any review expectations. Without this, the agent will invent a convention. It will be internally consistent and wrong — and that wrongness compounds, because each session starts from the invented baseline rather than the actual one.

The area most consistently absent from real-world context files is the third category.

## The boundary tier most teams skip

The boundary tier is where most context files fall short. Telling the agent what the project does isn't enough. It needs to know what it can do autonomously, what requires a check-in, and what's off the table regardless of context.

The always tier is the baseline: run tests before committing, include a link to the related issue in PR descriptions.

Ask-first is what requires a pause before proceeding: adding new dependencies, deleting files (even empty ones), modifying database migrations.

Never is the hard stop: no secrets or credentials even as placeholders, no direct pushes to main, no modifications to the generated files in `src/generated/`.

That third tier is the one most teams forget. "Never commit secrets" is the most consistently repeated constraint across every context file I've reviewed in production use, which means it's also the constraint most teams don't write until they've had a close call. The fact that it needs to be explicit is itself telling about the failure mode.

## Decisions versus state descriptions

Here's the misconception that makes most context files decay: teams write them as a reflection of what the project is right now, rather than as a record of decisions that have been made. The distinction sounds subtle, but it determines whether the file compounds or decays.

A project description captures state. A decision record captures commitments. "We use React 18" is a state description. It'll stay true until you upgrade. "We use function components only; no class components" is a commitment. It was a decision made at a specific point for a specific reason, and it tells the agent something that reading the code might not. State can be inferred. Decisions need to be explicit.

Every vague line in a context file is a decision you haven't recorded, and the agent will make that decision for you. It will do so predictably, defaulting toward whatever pattern appears most often in its training, not necessarily the one your codebase has established. Those defaults are where drift originates.

## The self-improving pattern

The self-improving pattern is what makes the difference between a context file that compounds and one that decays. When the agent uses a stale API path or wrong pattern, the correction should be: "No, use `v2/users`. Update CLAUDE.md to reflect this, then continue." The agent updates the file in-session. Future sessions inherit the correction. The file grows more accurate through use rather than despite it.

This requires treating the context file as something you actively maintain rather than something you set and revisit when things break. The practical cadence: when you catch yourself re-explaining the same thing to the agent a second time, stop and add it to the file. That correction is information about what's missing. Don't let it live only in the session history where no future session can reach it.

The opposite failure mode is context bloat. A 400-line CLAUDE.md with outdated migration notes, deprecated API paths, and decisions from a tech stack you replaced six months ago is worse than a 100-line one that's current. The agent reads the whole file on every session. Every stale line is a small injection of noise into every interaction. Prune regularly. Archive rather than accumulate.

## The diagnostic the file actually runs on you

The genuinely non-obvious part, the part that isn't visible until you've maintained one of these files through a real project, is that writing a useful context file requires having made the decisions it's supposed to record. You can't write "all external calls go through `src/lib/api/client.ts`" unless you've established and enforced that as a real convention. CLAUDE.md surfaces where project conventions are implicit rather than explicit. Every vague line is a decision still open. The file is, in a strange way, a diagnostic: if it's hard to write precisely, the project architecture may be harder to describe precisely than you thought.

For teams evaluating AI-assisted development at scale, this is the discipline worth investing in ahead of model selection or prompt engineering. The context file shapes every session, and its quality determines the quality of the work that comes out of it. The model you're running, the prompt you've written, the workflow you've built around it — all secondary. Treat the context file with the same rigor as a spec. Review it the way you'd review a significant PR. It sets behavioral constraints: how the agent works. The spec that Post 3 introduces sets scope and decisions: what it builds. Both need to exist before the first prompt.

A CLAUDE.md that hasn't been updated since you wrote it isn't config that's working quietly. It's a gap between how you think the project is and how the agent is navigating it. That gap compounds. The sessions that feel inexplicably off, where the agent makes choices that don't quite fit and where you correct the same thing again, are often the file speaking.
