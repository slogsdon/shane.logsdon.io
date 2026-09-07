---
title: Evaluate Your DevRel Program Like an Agentic Workflow
date: 2026-09-02
layout: partials::layouts/writing-post
slug: evaluate-devrel-like-an-agentic-workflow
description: AI recommendation is a distribution channel that never reports back.
  I evaluate my DevRel program the same way I evaluate an agentic workflow, checking
  presence first, then accuracy, and auditing both on a cadence.
faqs:
- q: What's the presence gate in this framework?
  a: Whether an AI cites you at all when someone asks what to use for your category.
    It's binary. You show up or you don't, and there's no partial credit for being
    close.
- q: Why isn't showing up in an AI's answer enough on its own?
  a: Because a citation can be wrong, and wrong is worse than absent. If an AI recommends
    your deprecated auth flow, or hallucinates a pricing tier you killed two years
    ago, that's a support ticket generator wearing a distribution win's clothes.
- q: How do you baseline your citation rate before optimizing anything?
  a: Run roughly 20 category and branded queries across ChatGPT, Perplexity, Claude,
    and Gemini, and write down what comes back before you touch anything else. Otherwise
    you can't tell whether a later improvement came from your work or from a model
    update.
- q: Should citation monitoring get automated the moment a tool for it exists?
  a: No. Run it manually first, long enough to learn what normal looks like for your
    category and which queries matter. Automate the detection once you have
    that instinct, and keep the decision about what to do next a human one.
- q: What did the self-audit turn up?
  a: 0% citation on service queries, 100% on branded ones. Every assistant knew who
    I was, but none of them recommended me for what I actually do.
image: evaluate-devrel-like-an-agentic-workflow-og.png
heroImage: evaluate-devrel-like-an-agentic-workflow-hero.png
---

*AI recommendation is a distribution channel that emits no telemetry. Evaluate your DevRel program the way you'd evaluate an agentic workflow: a presence gate (are you cited?), then a quality gate (is the citation accurate?), baselined and audited on a cadence.*

My team maintains an internal guide for evaluating agentic workflows: the automated pipelines where an LLM analyzes developer feedback, generates READMEs, or produces artifacts downstream systems depend on. We wrote it to answer a boring operational question, which is how you know an automated workflow is working when no human watches every run.

Somewhere in the third or fourth revision I noticed the framework was answering a second question I'd been circling for months: how do you evaluate a DevRel program when your primary distribution channel is an AI that doesn't report back?

That's the actual situation now. When ChatGPT recommends your competitor, no analytics event fires. When a coding agent reads your docs and quietly picks a different tool, nothing shows up anywhere. The channel that increasingly decides developer adoption emits no telemetry to you by default. Which is exactly the problem the workflow evaluation framework was built for: output you can't watch continuously, produced by a system you don't fully control, where failures are silent until they compound.

The mapping turned out to be almost embarrassingly direct.

---

## The two gates

The workflow guide splits evaluation into two patterns, and the split carries over cleanly.

**Schema-critical evaluation** is binary. In a workflow, either the JSON parses or it doesn't; downstream steps break on failure, so validation is a hard gate. The DevRel equivalent is citation presence: when a developer asks an AI "what should I use for [your category]?", either your product appears in the answer or it doesn't. There's no partial credit. This is testable today with nothing but the four major assistants and a spreadsheet.

**Quality-first evaluation** is semantic. In a workflow, the artifact can vary in structure as long as the substance is right, so the gate is a second LLM call evaluating output against a rubric. The DevRel equivalent is citation quality: when your product *is* cited, is the guidance accurate? Is the framing favorable? Is the AI recommending your deprecated auth flow, or hallucinating a pricing tier you killed in 2024? An inaccurate citation is worse than absence, and it's invisible unless you evaluate for it, which, conveniently, is also a job you can give an LLM with a rubric.

Two gates, run in that order. Presence first, because quality of a citation that doesn't exist is undefined. Then accuracy, because presence with wrong guidance is a support ticket generator wearing a distribution win's clothes.

---

## The rest of the framework carries over too

| Workflow evaluation | DevRel program evaluation |
|---------------------|---------------------------|
| Schema validation as hard gate | Citation presence: cited or not, per query |
| Second-LLM quality rubric | Citation accuracy and favorability review |
| Human review loop, heaviest early | Monthly citation test cadence, heaviest at program start |
| Self-audit before humans see output | You run the citation test before a developer hits the gap |
| Retry then escalate | Fix the content gap, re-test, escalate to infrastructure work (llms.txt, structured content, docs restructuring; see post 2) if citation doesn't move |
| Pre-automation baseline (3+ manual runs) | Pre-AEO citation baseline before any optimization |
| 60-day written evaluation | Quarterly citation audit and retrospective |
| Graduation by deliberate sign-off | Deciding when monitoring moves from manual to automated |

Three of these deserve expansion, because they're where DevRel programs fail.

**The self-audit.** In our workflows, the system checks its own output before a human ever sees it. The DevRel version is running the citation test on yourself before a developer encounters the gap in the wild. When I ran mine, I got 0% citation on service queries and 100% on branded ones. Every assistant knew who I was; none recommended me for what I do. That's a self-audit result. It stung, and it was worth ten dashboards, because it was the output of the actual channel rather than a proxy for it.

**The baseline.** The workflow guide is strict about this: no credible time-saved claim without at least three documented manual runs before automating. The DevRel version: no credible AEO claim without a documented citation baseline before you optimize anything. Run the 20-query test: roughly twenty category and use-case queries ("what should I use for [your category]?"), a mix of service, category, and branded phrasings, across ChatGPT, Perplexity, Claude, and Gemini. Write down the numbers, then start work. Otherwise you'll ship llms.txt and structured content, citations will improve for reasons that may include model updates and competitor mistakes, and you'll have no way to claim any of it.

**Graduation.** This is the one I'd push hardest, because it cuts against the tooling instinct. In our framework, a workflow moves from active human review to automated-gate-only through deliberate sign-off, never on a timer or a metric threshold alone. The DevRel equivalent: don't hand citation monitoring to an automated service the moment one exists. The manual test phase is where you develop intuition for how the channel behaves, which queries matter, how answers drift after model releases. Automate detection once you know what normal looks like. Keep correction human indefinitely, because deciding *what to do* about a citation gap is a judgment call about your product's positioning, and that's the roughly 25% of DevRel that stays irreducibly human judgment (post 3).

---

## Why frameworks transfer

The reason this mapping works isn't a coincidence of vocabulary. Both problems have the same shape: a system that acts on your behalf, at a volume you can't inspect manually, where sentiment about it tells you nothing and only behavior counts. [Jono Bacon's line](https://blog.stateshift.com/beyond-github-stars/) about community metrics, that sentiment is noise and behavior is signal, is the same principle both evaluation designs land on independently. You don't ask whether the workflow feels reliable. You gate its output. Same with the DevRel program: don't ask whether it feels visible to AI, test the citations.

The instinct DevRel needs to borrow from platform engineering is treating the program itself as a production system: baselined, gated, audited on a cadence, with escalation paths and written retrospectives. Not because the spreadsheet is the point, but because the channel that now mediates your first developer touchpoint will never send you an error report. You have to go ask it.

*See also: [How to Know If Your Agentic Workflow Is Actually Working](https://shane.logsdon.io/articles/technical-deep-dives/evaluating-agentic-workflows/), the public write-up of the evaluation framework this post adapts.*

---

*Part 7 of 9 in the Developer Relations in the Age of AI series.*

*← Previous: What Do We Measure? · Next: Community When AI Answers the Questions → · ← All articles*
