---
title: "How to Know If Your Agentic Workflow Is Actually Working"
date: 2026-06-18
layout: 'partials::layouts/writing-post'
image: evaluating-agentic-workflows-og.png
heroImage: evaluating-agentic-workflows-hero.png
slug: evaluating-agentic-workflows
---

You ship the workflow. It runs. The output lands in the right place, formatted correctly, and there are no errors in the log. You move on. Two weeks later, someone mentions that the summaries have been missing caveats, that the code review has been passing style issues, or that the documentation looks right but is citing an API that changed a month ago. The workflow never broke. It has been wrong the whole time, and you did not catch it because there was nothing to catch. Only clean runs and accumulating drift.

The wrong workflow is harder to find than the broken one. A broken workflow is loud: the JSON parse fails, the output file is empty, or the downstream step throws an exception. There is a notification, a log entry, or something else to chase. The wrong workflow runs cleanly and produces output that is approximately what you intended but not quite, and the gap accumulates. For example, a summarization workflow might consistently omit caveats because the prompt did not specify that they were required. A code review workflow might pass style issues because the style guide was written for human reviewers rather than model evaluators. Or a documentation generator might produce accurate-looking content with outdated API references because no session context told it what had changed.

These do not break; they degrade. This degradation is invisible until someone asks why the output quality has been slipping, at which point the answer is that it has been like this for a while.

The distinction matters because the evaluation strategy for a broken workflow (detect failure, escalate, and retry) is completely different from the strategy for a wrong workflow (define correctness, measure against it, and maintain the signal). In the wrong workflow, the agent did not fail. Instead, the artifacts it was navigating failed it.

---

## Broken vs. wrong: two different failure modes

There is one principle worth establishing: you can only evaluate output against something authoritative. This sounds obvious, but its implications are often skipped. A workflow without an explicit definition of what "correct" looks like cannot be evaluated. It can only be spot-checked, which is not evaluation. Spot-checking catches catastrophic failures, but it does not catch drift.

What "authoritative" means in practice depends on the workflow type. For schema-critical workflows, where downstream steps depend on a specific output format, authoritative means a JSON schema or a structural contract.

At Global Payments, the developer advocacy team runs a monthly Power Automate pipeline that reads inbound developer emails, categorizes them by theme and urgency, and delivers structured insights to the product teams responsible for APIs and SDKs. This process takes a month of developer feedback (questions, integration friction, feature requests, complaints) and turns it into something product teams can act on.

The flow started as one prompt handling the analysis and producing three artifact outputs. The results were inconsistent. Category labels drifted between runs, insights varied in structure depending on the volume and mix of that month's emails, and output could not be reliably parsed by downstream consumers. Splitting it into four single-responsibility prompts (one owning the categorization pass and one owning each artifact type) made the output stable enough to be useful. That is a schema-critical workflow where the gate is structural. Either the output matches the schema or it does not. Structural validation at the parse step catches failures before they propagate.

For quality-first workflows, where semantic accuracy matters more than rigid structure, authoritative means a rubric. This includes ensuring required sections are present, tone is within a specified range, and claims are checked against source material with acceptable variance defined explicitly in the prompt rather than inferred by the evaluator. A README generator that produces accurate-looking content in varied section orders is a quality-first workflow. The gate is semantic. A second LLM call (using a different model from the one that produced the output) compares the output against the rubric and returns a quality signal. Defining those criteria is itself an artifact design decision. Without a precise spec of what "correct" means, both gates reduce to spot-checking.

---

## Evaluation is downstream of speccing

Evaluation usually gets treated as a QA step bolted on after the workflow is built: a quality gate at the end, or human review before delivery. This framing treats evaluation as downstream of production, implying it catches problems after they occur.

A more useful frame is that evaluation is downstream of speccing. You can only build an automated gate if you have something to evaluate against. The schema that enables structural validation exists because a design document named the required fields and their types. The rubric that enables semantic evaluation exists because a prompt author defined what "correct" output looks like before building the prompt. The 60-day retrospective that measures time saved against a manual baseline works because someone documented the manual baseline before automating. Evaluation without a spec is spot-checking, which is what the AX thesis has been arguing against since Post 1. You can only measure against something authoritative, and that authoritative thing only exists if you designed for the agent rather than yourself.

This explains why evaluation collapses for workflows built without a spec. There is nothing authoritative to compare against, only output that feels approximately right. This leads to spot-checking that misses drift until the drift is significant enough to be noticed. Drift does not mean the model is degrading; it means the artifacts the model navigates are drifting from the intent they were meant to encode.

---

## The self-audit layer

The self-audit layer is where this becomes concrete. It has two components, both of which run before a human sees the output.

The first is structural validation. This checks if the output matches the expected schema or structure. For schema-critical workflows, this is a hard gate that determines if the output is valid or invalid. For quality-first workflows, it checks for the presence of required sections. This runs without an LLM, is deterministic, and is the cheapest signal available.

The second is plan-versus-output comparison. This checks if the output matches the intent of the prompt. A second LLM call, using a different model from the one that produced the output, compares the original prompt intent against the actual result on two dimensions: whether the agent followed the intended approach (rather than improvising in ways that deviate from the specified process) and whether the artifact meets the quality bar for its type. Both components run before escalation. Escalation happens when one or both fail after the retry limit.

The retry limit for most workflows is three to five attempts. After you exhaust retries, escalate. Do not fail silently. For automated flows, this means notifying the right people through the right channel. For interactive flows where a human is already in the loop, the error surfaces in real time.

---

## How to define "correct" before you ship

Building useful evaluation is harder than it looks. It requires defining what "good" looks like before the workflow exists, not after it has been running for two weeks. The prompt that produces high-quality output on the first 10 runs without an explicit quality definition will produce inconsistent output on runs 11 through 40 because there is no stable reference. The evaluator, whether it is a schema validator or a second LLM call, needs to know what it is comparing against. That definition must be written before the workflow ships.

In practice, this often surfaces gaps in the original design. "The output should accurately summarize the customer feedback" is not a rubric. However, "The output must include: the top three feature requests by frequency, any safety or compliance concerns flagged by customers, and the overall sentiment distribution; the summary must not introduce claims not present in the source material" is a rubric. The difference is evaluability. The first version can only be spot-checked, while the second version can be evaluated at scale and automatically on every run.

---

## The 60-day evaluation

After 60 days of production use, run a minimal retrospective covering these areas: what the workflow does, how much time it saves against the documented manual baseline, the error rate at the automated gate, the escalation rate, what held up that was not expected to, what failed in ways the design did not anticipate, and a recommendation. You can then choose to continue as-is, adjust the prompt, adjust the gate, retire the workflow, or expand scope.

The manual baseline matters more than teams usually invest in it. To measure time saved credibly, you need the baseline before automating. Take three manual runs, measure the wall-clock time from trigger to delivered artifact, and average them. Without that, the time-saved metric is an estimate that feels more authoritative than it is. While that is fine for an internal conversation, it is unreliable as a signal for deciding whether to expand the workflow.

Graduation from active human review to automated-gate-only requires a deliberate sign-off rather than a timer. Time-based and error-rate signals can inform the decision, but they do not make it. The stakes differ enough across workflows that a policy threshold would either be too conservative for simple ones or too permissive for high-consequence ones. The sign-off is the mechanism.

---

## Where to start

The practical starting point for a workflow you are building now is to write the definition of correct output before you write the prompt. Do not write a vague description; instead, write a specific rubric that a second evaluator could apply without your explanation. Build the structural validator first. Build the semantic evaluator after you have 10 outputs to test it against. Document your manual baseline before automating. The evaluation infrastructure takes longer than the prompt. That is expected, and it is not optional if the goal is something you can trust rather than something you can demonstrate.

---

Running without errors is not a success criterion. The true criterion is output that matches a defined standard consistently across the conditions your workflow encounters. The gap between those two things is where the wrong workflows live, running cleanly and degrading quietly until someone asks why.

---

*Part 5 of 6 in the [Agentic Product Development Workflows](/articles/agentic-workflows/) series.*

*Next: [The Framework Emergence Loop: How Durable AI Workflows Are Actually Found](/articles/technical-deep-dives/framework-emergence-loop/) →*
