---
title: "The Spec Is the Work: PRD-First AI Development"
date: 2026-05-11
layout: 'partials::layouts/writing-post'
slug: the-spec-is-the-work
description: "The reason AI-assisted builds stall isn't the model: design decisions were never made. Here's why writing the spec first changes everything."
faqs:
  - q: "What does 'spec-first' AI development actually mean?"
    a: "Writing a design document — covering goals, non-goals, external interfaces, data schemas, error states, and module boundaries — before opening an AI tool. The spec is where design decisions happen; without it, the agent makes those decisions for you, using statistical probability rather than your specific intent."
  - q: "Why don't better prompts fix AI output quality?"
    a: "Prompts are interaction-level adjustments. Drift is artifact-level. When the spec hasn't been written, the agent fills in undefined territory with plausible guesses. Better prompts running against vague requirements will still produce drift — not because the model is failing, but because it's making design decisions you haven't made."
  - q: "What should a design spec include?"
    a: "Goals and non-goals; the external interface (CLI surface, API endpoints, or UI flows); data schemas with every field typed; error states and which failure modes are distinct; module boundaries; and a testing strategy. Each field is a design decision. Every omitted field is also one — the agent will fill it in."
---

I thought I was watching the model fail. The output was close, functionally close and in some cases working, but off in specific ways I kept having to patch. The error handling didn't distinguish between failures that should halt the program and ones that should retry. The schema had fields that made sense in isolation but didn't align across the three scripts consuming the output. The CLI surface was intuitive in a generic sense but wrong for the specific automation I was building it for.

I filed these as AI limitations. Models hallucinate. They generate plausible code rather than correct code. You have to review everything. I wrote better prompts. I ran more corrections. The problems kept appearing, slightly differently, reliably.

The actual diagnosis, once I could see it: I hadn't made the decisions. Every gap in the output traced back to a decision I hadn't made before writing the first prompt, about what a failed fetch meant versus an incomplete one, about which fields were required versus optional, and about who owned retry behavior in the module graph. The AI wasn't hallucinating. It was filling in blanks I had left open. It was making design decisions on my behalf, using the most statistically probable answer, and handing me code that was confidently wrong in ways I had inadvertently authorized.

<!--more-->

---

## Why prompting before deciding is the real failure mode

Software development has a documented failure mode called design-by-implementation: you write the code, then write the design doc as a description of what you built. The doc captures nothing useful because all the hard choices were already locked in. What got built is what got built, and the doc is archaeology.

The same failure mode appears in AI-assisted development, with worse consequences. When you start prompting before you've made the architectural decisions, the "spec" that emerges is shaped by whatever the agent started generating. You've lost the decision-forcing function entirely. You're not writing a spec. You're narrating the code that already exists.

The discipline is: spec before code, not spec alongside code, not spec derived from code. This sounds like documentation advice. It isn't. Writing a spec before you open an AI tool is a design act, and the spec is where the real work happens. The context file from Post 2 handles how the agent behaves across any project. The spec handles what it's building in this one. Both need to exist before the first prompt.

---

## What a spec does that prompting cannot

The spec does three things that prompting cannot replicate.

First, it forces architectural decisions before code exists. You cannot write a data schema without committing to a data model. You cannot specify exit codes without deciding which failure modes are distinct enough to distinguish. You cannot define module boundaries without making coupling decisions. Writing "the CLI will produce JSONL and JSON array output with the following fields: item_type ("issue" | "pull_request"), id (integer), node_id (string), created_at (ISO8601 string), html_url (string), api_url (string), title (string)" is not documentation. It is a design act. Every field is a choice, and every omitted field is also a choice. The spec is where those choices happen deliberately, before the pressure to ship makes them implicit.

Second, it functions as a communication protocol between your intent and the agent's execution. A vague spec leaves the agent with a large space of plausible interpretations, and the agent fills that space with probability rather than precision. Every field named and typed, every edge case annotated, every non-goal made explicit: these replace hundreds of tokens of back-and-forth clarification with a single authoritative document the agent can reference across sessions.

Third, and most underappreciated: the spec makes deviation detectable. When the implementation doesn't match the spec, one of two things is true: the implementation is wrong, or the spec needs updating. Either way, you're making an explicit decision with a clear record. Without the spec, you're looking at code and deciding whether it feels right, which is an implicit decision with no record, no accountability, and no way to reconstruct later what you intended.

---

## The misconception about who the spec is for

Here's the misconception that's common in descriptions of AI-assisted development: the spec is primarily about guiding the agent. It isn't. The agent guidance is a side effect. The spec is primarily about forcing you to make design decisions before the pressure of a running system makes them for you. By the time the code exists, all the trade-offs are already embedded, whether in the module structure, the schema, or what got elided for simplicity. Writing after the fact doesn't change those decisions. It only documents them. The spec written before the code is where the decisions actually happen, which is why it produces better code, not because the agent follows directions well, but because the directions forced the author to think.

---

## A concrete case: gh-monthly

`gh-monthly` is a Rust CLI I built to collect GitHub organization activity through the unauthenticated search API. Before writing a single line of application code, three planning documents existed.

The first was a design spec. It committed to CLI subcommands and all their flags, named exit codes for each failure category rather than arbitrary numbers guessed at by the model, a canonical record schema for JSONL and JSON array output with every field typed and annotated, a fetch strategy (sequential rather than concurrent, streaming to disk rather than buffering, and unauthenticated rate-limit budget calculated in advance), preflight behavior (probe total_count before fetching, refuse with exit code 3 if the budget is insufficient), an error handling policy distinguishing fatal from retryable failures, and explicit module boundaries.

The second was an implementation plan of 18 tasks derived directly from that spec. Each task had a file target, a failing-test-first step, a verification command, and a commit message.

The third was the implementation itself.

After the first implementation pass, I ran an alignment review: a gap analysis comparing the spec to the code. It found four significant deviations: `node_id` and `api_url` missing from the canonical schema, the full metadata contract incomplete, JSONL buffered in memory rather than streaming to disk, and the retry-aware HTTP client behavior absent. Every one of those was specified in the design doc. The gap wasn't between the spec and reality. It was between the spec and the first implementation pass.

The alignment review's existence, the ability to write one at all, was only possible because the spec was precise enough to be falsifiable. The first implementation wasn't a failure. The alignment pass is the mechanism by which the spec stays authoritative. It worked because there was something authoritative to align against.

---

## How to apply this: developers and teams

For developers, the sequence is four steps. Write the design doc first, covering goals, non-goals, the external interface (CLI surface, API endpoints, or UI flows), data schemas, error states, module boundaries, and testing strategy. Derive a numbered implementation plan from the doc, where each task has a file target and a verification step so it's mechanically checkable. Work through the tasks in order. When the agent diverges from the spec, that's a signal that either the spec needs updating or the implementation needs correcting. After the first pass, run an alignment review: compare the output to the spec, write up the gaps, and close them in a second pass. The alignment pass is not a failure. It's the mechanism.

For teams evaluating whether to invest in this practice: the spec is not additional overhead on top of the AI-assisted workflow. It's what determines whether the workflow produces trustworthy output or approximately correct output that slowly diverges from intent. The investment is front-loaded. The payoff is that the last 30% of an AI-assisted build, covering integration, edge cases, and behavior at the boundaries, stops being the place where everything slows down. Post 4 shows exactly where that wall appears and why teams without specs consistently hit it.

---

## The difference that actually matters

The spec is not documentation of what you built. It is the record of what you decided before implementation pressure made the decisions for you. The difference between those two things is the difference between a codebase you can audit and one you can only approximately trust.

---

*Part 3 of 6 in the [Agentic Product Development Workflows](/articles/technical-deep-dives) series.*
