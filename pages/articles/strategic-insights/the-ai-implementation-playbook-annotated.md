---
title: The AI Implementation Playbook, Annotated
date: 2026-09-23
layout: partials::layouts/writing-post
slug: the-ai-implementation-playbook-annotated
description: 'Luke Pierce''s ''perfect AI implementation'' process gets the order
  of operations right: data, then workflows, then intelligence. The parts that decide
  whether the system survives month eight are the parts the playbook waves at.'
faqs:
- q: What order should AI tooling be deployed in an existing business?
  a: Data first, then workflows, then intelligence. Agents reading a well-structured
    database with defined workflows behave reliably. The same agent placed on top
    of a disorganized operation produces fluent output built on incomplete information,
    and the fluency hides how much it is missing.
- q: Does verifying agents against a test set make them production-ready?
  a: No. A test set is a sample of cases. A rubric is the standard those cases are
    measured against, and the rubric has to exist before the prompt does. Spot-checking
    catches catastrophic failures. It does not catch drift, where output stays approximately
    right while slowly degrading, with no log entry and no exception to announce it.
- q: If an AI system logs everything, is it being monitored?
  a: No. Logging is storage. Monitoring is an alert that fires, a human who sees it,
    and a fix that lands before the client notices. Without that loop, a degraded
    workflow can run cleanly for two weeks before anyone notices, and by then the
    team has often already decided the system cannot be trusted.
- q: Which work should go to an agent, and which should stay with a person?
  a: Deterministic work gets an automation with no AI in it. Judgment work gets an
    agent. Decision work stays with a human while the system assembles the case. Approving
    a quote, accepting a client, and pricing an exception are decisions, and the human
    keeps the call. The pipeline runs the stretches between decisions. It does not
    make them.
- q: Can an implementation process itself become a product?
  a: It can, and the article argues it well. A two-week assessment can stand alone
    as a paid diagnostic, and a method that survives contact with real clients can
    be taught. The engineering underneath the process is what decides whether the
    system still works in month eight, and that part never gets a screenshot.
image: files-images-the-ai-implementation-playbook-annotated-og.png
heroImage: files-images-the-ai-implementation-playbook-annotated-hero.png
---

A long post made the rounds in my feed this week. It's called "How to Run the Perfect AI Implementation," and it's written by a founder who says he's done ninety or more of them. I read it twice. The first time I was looking for the disagreement. The second time I was looking for what it leaves out.

## The knowing-what-to-build problem

The article's headline claim is this: companies don't have a building problem, they have a knowing-what-to-build problem, and the reason is structural. A company running between fifteen and twenty-five software tools holds its operational truth in a spreadsheet one person maintains, a CRM that's about sixty percent accurate, and the memories of two or three employees who can never take vacation at the same time. Ask what they want to build, and the honest answer is that they don't know.

That lands on me in a specific way. It's the same sentence I use about builds with no spec. I've spent the past year building a framework for shipping software as a solo operator, and the rule at the top is: refuse to build until the spec exists. Without a spec there is no delivery team. There's a generator producing plausible output you can't evaluate. A company full of data silos is living in the pre-spec condition at company scale.

The four cost patterns the article names are the four I'd name. The same fact typed into four systems. Two systems disagreeing about a client's status every week. A leadership question that takes two days because it needs four sources reconciled. The operational truth that lives in the heads of a few employees who can never be out at the same time. And AI makes all of it worse. An agent operating on partial context doesn't tell you it only has a third of the picture. It produces a fluent, confident answer built on that third, so fragmented data fed into AI produces polished mistakes at scale. The manual chaos at least announced itself.

## Data, then workflows, then intelligence

The part I agree with most is the ordering rule, and the article states it as a sequence: data, then workflows, then intelligence. Agents go last, deployed on top of clean workflows and clean data, because an agent reading a well-structured database with defined workflows behaves reliably, and the same agent placed on top of a disorganized operation produces fluent output built on incomplete information. This is the same principle I build with, and it's the hardest one to hold. Agents are the part clients want in week one. The schema is the part nobody screenshots.

The triage rule is the second thing I'd steal. Deterministic work gets an automation with no AI in it. Judgment work gets an agent. Decision work stays with a human while the system assembles the case. Approving a quote stays human. Accepting a client stays human. Pricing an exception stays human. The system turns a forty-minute research exercise into a one-minute review, and the human keeps the call.

That is the gate map I've written about before, scaled from a solo build loop to a whole company. The pipeline runs the stretches between decisions. It doesn't make the decisions.

## A test set is not a definition of correct

The article says agents get verified against a test set before real work depends on them. That sentence is correct, and it's where implementations are won and lost. But a test set is a sample of cases. A rubric is the standard those cases are measured against, and the rubric has to exist before the prompt does, because you can't evaluate a workflow that never defined what correct means. It can only be spot-checked. Spot-checking catches catastrophic failures. It does not catch drift, and drift is the silent killer. The wrong workflow runs cleanly, produces output that is approximately right and slowly degrading, and there's no log entry and no exception and no one chasing it. Two weeks later someone notices, and the team has quietly decided the system can't be trusted.

That decision is almost impossible to walk back, which is why "everything is logged" reads to me like storage and not monitoring. Logging is storage. Monitoring is an alert that fires, a human who sees it, and a fix that lands before the client notices. The article treats its QA categories as the end of the engineering story. They're the beginning. Schema gates with bounded retries and an escalation path. A judge model that isn't the same model that produced the output. Error analysis that categorizes the failures that occur instead of the ones you imagined. That machinery is the difference between a system that lasts three years and one that quietly rots in a few months. It's the exact distinction the playbook promises and leaves to a sentence.

## The process is a product, and products have distribution

The last thing the article can't see is itself. It calls the two-week assessment non-negotiable, and for a bespoke engagement it is, because a two-week assessment is priced into the contract. But the article's closing claim is that the process is the product, and products have distribution options that a bespoke engagement doesn't consider. The assessment phase is a deliverable that can stand alone as a paid diagnostic. The method is a thing you can teach. "Don't sell maintenance on day one" reads like principle and is positioning, a good one for a founder-led firm that wants trust to carry the sales motion, and not the only revenue structure this work can take. The article argues convincingly that the process is the product. It quietly assumes the product only ever gets sold one way.

None of this is a knockdown of the process. The process is the right container for this work, and I'd rather see a team run it naively than go back to a forty-five-minute audit that's really a sales call or a hero migration nobody asked for. The point is narrower. The article is a process document, and the process is the part that can be screenshotted. The engineering underneath it is the part that decides whether you're still using the system in month eight, and the business model is the part that decides whether you can keep doing the work at all. Neither of those gets a screenshot.

The playbook is right about the order of operations. The parts that decide whether it works are the parts nobody screenshots.
