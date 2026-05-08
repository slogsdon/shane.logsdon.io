---
title: "The AX Shift: You're Still Designing for Yourself"
date: 2026-04-27
layout: 'partials::layouts/writing-post'
image: the-ax-shift-og.png
heroImage: the-ax-shift-hero.png
slug: the-ax-shift
description: "The AX Shift is the move from designing software interfaces, documentation, and project context for humans to designing them for the agents now reading them. UX redesigned interfaces around users; DX redesigned APIs around the engineers consuming them; AX redesigns docs, context files, and specs around the autonomous agent that's now the primary reader."
faqs:
  - q: "What is AX (Agent Experience)?"
    a: "Agent Experience is the practice of designing artifacts — specs, context files, documentation, API responses — for AI agents operating autonomously between sessions, not just for human readers. It's the next iteration after UX (designed around users) and DX (designed around developer-consumers)."
  - q: "Why doesn't writing better prompts fix AI coding drift?"
    a: "Prompts are interaction-level adjustments, but drift is artifact-level. Excellent prompts running against an underdeveloped CLAUDE.md and a vague spec will still produce drift, because the agent is making design decisions you haven't recorded. Every ambiguous line in your spec or context file is a decision the agent will make for you, in the direction of statistical probability."
  - q: "Where should teams invest for reliable AI-assisted development?"
    a: "Not in model selection or prompt engineering. Invest in the artifacts that give agents reliable context across sessions: a CLAUDE.md that's updated after every session, design specs authoritative enough that gap analyses can be written against them, and implementation tasks derived from the spec rather than improvised from the conversation."
---

I kept improving my prompts.

In every session that drifted, the agent generated code in a style we'd already moved away from, missed a pattern we'd established in the previous session, or made the same class of mistake I'd corrected twice before. I diagnosed this as a prompt quality problem. The fix was to write better prompts, include more specifics, add more examples, and bundle more context into each message. Even after I got quite good at prompting, the drift kept happening.

After six months, I grew not only a library of refined prompts but also a post-code-generation corrections list that looked nearly identical to the one from month two. The thing I kept adjusting wasn't the problem. The problem was somewhere I hadn't looked yet.

I was still designing everything for myself. The human in the loop. This is what I kept missing. The prompts, the context files, the project notes, the spec: all of it was written for a human reading it later, not for an agent trying to infer intent from it right now. Inference at the edges of the AI session is exactly what was causing the drift.

<!--more-->

---

## From UX to DX to AX

Software interfaces have followed a consistent pattern. UX redesigned those interfaces around their users rather than the people who built them. DX redesigned APIs around their developer-consumers rather than their designers. AX (Agent Experience) is the next iteration. The primary consumer of your documentation, API responses, project context files, and specifications is increasingly an AI agent operating autonomously between sessions. Almost everything we've built so far was designed for humans who can read between the lines, ask colleagues, and remember what we talked about last week.

Agents cannot reliably read between the lines, nor do they phone a friend. They fill ambiguity with the most statistically probable answer. They're never 100% correct, and those near misses compound.

---

## The gh-monthly case study

The clearest moment I have of seeing this is a Rust CLI I built called [`gh-monthly`](https://github.com/globalpayments-samples/gh-monthly). It's a tool that collects activity across one or more GitHub organizations via the unauthenticated search API, normalizes it to JSON, JSONL, and CSV, and produces local terminal reports. It's not a complicated project, but the implementation session started before the real problem decisions were made.

The exit codes came out arbitrarily, whatever the model thought was reasonable. The JSON and JSONL schemas had fields that made sense in isolation but weren't composable across the four scripts consuming the output. The retry behavior was guessed. The metadata contract was incomplete. None of these were the agent's failures. The agent was doing exactly what you'd expect a capable text generator to do with vague requirements. It filled in the gaps as best as it could.

Afterward, I restarted, writing a design spec first, and I realized halfway through that the spec process was forcing me to make decisions I'd been deferring. The exit codes needed to be named and scoped for shell automation rather than numbered and intuited. The metadata needed `run_started_at`, `run_completed_at`, `completed`, and `request_count` included to evaluate the results later rather than whatever felt sufficient in the moment. The output had to be streamed immediately to disk during fetch rather than live in memory until completion, because the whole point was to handle potentially large result sets.

Every one was a design decision I'd delegated to the model. It had made choices, but they were wrong.

After writing the spec, I ran an alignment pass against the first implementation, generating a document listing the gaps between what the spec said and what the code did. Four significant deviations came up. All of them traceable to places where the spec hadn't been written yet when the code was generated.

The alignment pass is the honest part of the story. Finding gaps here isn't a failure. That's the mechanism you need, but the mechanism only works if you wrote the spec first, before implementation pressure fills in the blanks.

---

## Why prompts don't fix structural drift

Here's the misconception about AX that most descriptions get backward. It's usually framed as "make your system work well for agents," and that's true in practice. This names the effect rather than the discipline, though. The more productive shift is making the important planning decisions before you build, rather than during or after.

When you design for a human reader, ambiguity is recoverable. A developer reading unclear documentation can infer intent, check the GitHub issues, or ask a colleague. An agent operating across sessions cannot do any of those things with any certainty. Every ambiguous line in your spec or context file is a decision you haven't made. The agent will make it for you, in the direction of statistical probability.

The spec is not primarily about guiding the agent. It's about forcing you to make design decisions before the pressure of a running system makes them implicit. The agent's reliable behavior is a byproduct. What you actually get first is clarity about what you're building, which turns out to be the same thing that makes the agent reliable.

This is why improving prompts doesn't fix structural drift. Prompts are interaction-level adjustments. Drift is artifact-level. You can have excellent prompts running against an underdeveloped CLAUDE.md and a vague spec, and the agent will still be making design decisions on your behalf, albeit with slightly better manners.

---

In practice, this is harder to shift than it sounds. The instinct, especially with a capable AI tool available, is to start building and let the shape emerge. Scaffolding is fast. It's tempting to interpret that speed as permission to defer thinking, but there's one thing you lose when you defer: your ability to audit the work. Without a spec, there's no standard to close a task against. You review the output, decide it feels approximately right, and move on. When you hit a wall three sessions later, you can't tell whether the spec changed, the implementation drifted, or you never decided what needed to happen. Developers working this way inevitably realize the codebase is approximately correct, but not definitively right.

For teams evaluating whether to focus and invest more in AI-assisted development, this is where they should put their effort. Not into model selection or prompt engineering, but the artifacts that give their agents reliable context across sessions. A CLAUDE.md that's updated after every session. Design specs that are authoritative enough that gap analyses can be written against them. Implementation tasks derived from the spec rather than improvised from the conversation. The next two posts dig into both: what makes a context file actually work, and what a spec needs to do that prompting cannot.

The shift from DX to AX isn't a new tool or a new model. It's a new relationship to the artifacts you already produce, treating them as the primary communication layer with the agent rather than the documentation you write afterward. The answer to "why does the agent keep getting this wrong?" has rarely been "better prompts." It's been "better decisions, made earlier, written down somewhere the agent can find them."

---

*Part 1 of 6 in the Agentic Product Development Workflows series.*

*Next: [LLM Context Files Are Deliverables, Not Config](/articles/technical-deep-dives/llm-context-files-are-deliverables-not-config/) →*
