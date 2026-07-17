---
title: 'The Build Field Guide'
layout: 'partials::layouts/loop-and-gate-guide'
date: 2026-07-11
slug: build-field-guide
image: build-field-guide-og.png
heroImage: build-field-guide-hero.png
description: >-
  The eleven human-judgment gates of an agentic build loop: what you decide at
  each, how to work the ones outside your lens, and how to tell when the pipeline
  is confidently wrong. One real product, gate by gate.
draft: false
---

## How to read this guide

The tools that run an agentic build loop are commodities and they churn every quarter. This guide is not about them. It is about the eleven points where the loop has to stop and wait for a human, what you are actually deciding at each, and how to tell when the pipeline is confidently wrong. Work these gates well and a mediocre tool stack ships good software. Work them badly and the best tools on the market ship you a fast, tested, well-reviewed mistake.

There's a reason the gates fall where they do. Each one marks a place where the agent is weak. It can't tell a real problem from a loud one, it can't feel when an architecture will hurt in six months, it can't tell a demo from evidence, and left alone it will confidently build more than you asked. The gates are a map of the agent's blind spots. Where the tool is strong you let it run, and where it's blind you stop and decide. That is the whole logic of which points made the list, and it's why the list is about judgment and not tools.

**You do not need to be an expert on both sides to use this.** Some gates are product calls and some are engineering calls, and almost nobody starts with both instincts. Maybe you can code but have never sat with a customer. Maybe you know the market cold but can't read a diff. Maybe you have an idea and neither skill yet, and a quiet worry that "vibe-coding" only gets you so far. The gates are built for exactly that. Each one tells you which lens it needs, what a good decision looks like even if that lens isn't yours yet, and how to put the agent to work filling the gap while you learn to fill it yourself. I do this on my own weak side. I've done some go-to-market, but I'm no expert, so I work my GTM gates by leaning on the structure and the agent, and I've gotten better by shipping through them.

The one thing the framework can't do is learn the gate for you. It gets you to a defensible decision you couldn't have reached alone, but only if you treat each gate as something to understand, not something to skip. Use the agent to work the gate and you level up. Use it to dodge the gate and you just fail faster, with nicer tooling.

None of this is new, exactly. It's the operational form of a few things I'd already written down: that agentic work leaves the human owning the decisions, not the execution, that AI reliably gets you about 75% of the way and the last 25% is where judgment lives, and that explicit approval gates are really anxiety-removal infrastructure that free your attention for the outcomes that matter. The gates below are those ideas turned into a checklist you can actually run.

A note on the examples. Every gate is illustrated with the same project, LeadSurface, a competitor-switch-intelligence product I'm building solo. That's on purpose. One real project carried the whole way through gives you the connected story of how something actually gets built, gate by gate, instead of a scatter of unrelated anecdotes that never add up to a whole. You watch one product move through a kill decision, an architecture redo, a test-rigor call, and a careful rollout, which is much closer to how the gates feel in sequence than a set of tidy one-off examples would be.

Each gate below uses the same template:

- **The gate** — the one question, in plain language.
- **Lens** — Business (product judgment), Engineering (developer judgment), or Both.
- **When you're at it** — how to recognize the loop has reached this point.
- **What the pipeline hands you** — what the agent produces or claims here.
- **The decision** — what you are actually on the hook for.
- **What good judgment looks like** — the heuristics.
- **If this isn't your lens** — how to work the gate anyway, and what to learn.
- **Failure modes** — what rubber-stamping this gate costs you later.
- **Example** — a real case from building LeadSurface.

## The model in one page

You keep two things and hand off everything else. You keep the judgment, which draws on two lenses: the product one that knows the market and the customer, and the engineering one that knows when code is sound. The pipeline keeps the disciplined execution and the cross-session memory, because that is exactly what a tired, interrupted, over-committed human loses first.

Between those two jobs sit the gates. Some are business calls, some are engineering calls. You bring whichever lenses you have and use the method to carry the rest. The list, in order:

0. Should this exist?
1. Who is it for, what's a win?
2. Which direction?
3. Right plan, right scope?
4. Is the architecture sane?
5. Off the rails?
6. Does the test prove it?
7. Is the cost right?
8. Risk acceptable to ship?
9. Ship now, to whom?
10. ∞. How much of this process does this change even deserve?

The last one is the master gate. You do not run all ten working gates every time. Gate ∞ is the one you always run, and it decides how many of the others you actually need. Deciding how much process a given change earns is itself a judgment call, and getting it wrong in either direction, ceremony on a typo or a shortcut on a migration, is its own failure.

---

## Gate 0 — Should this exist?

**The gate.** Before a line of code, is this worth building at all?

**Lens.** Business.

**When you're at it.** A request lands, an idea strikes, a competitor ships something. The pull is to open the editor. Stop here first.

**What the pipeline hands you.** Nothing yet, and that's the trap. The loop makes building so cheap that "just build it" feels free, so this gate has no artifact forcing you to pause. You have to impose the pause yourself.

**The decision.** Does this move the product toward the outcome you care about, and is it worth the one resource you can't buy back, your attention this month? "Would it be nice" is not a yes. "The customer we're trying to win needs it to switch" is.

**What good judgment looks like.** You weigh it against what you're not building instead. You ask whether the person requesting it speaks for a pattern or is a sample of one. You are willing to kill your own idea, which is the hardest skill on this list. The sharpest signal that a problem is real is that people already pay to avoid it: explicit pay-intent and existing workarounds separate a paying problem from a merely interesting one.

**If this isn't your lens.** No product instinct yet? Make the cost visible instead of trusting your gut. Write one sentence on who this is for and one on what changes for them if it exists. If you can't fill either, that's your answer. Ask the agent to steelman the case *against* building it, then see if the case for survives. Over time you'll feel the kill decision before you have to write it down.

**Failure modes.** Building because it's easy now. Treating one loud customer as the market. Never killing anything, so the roadmap is just an inbox.

**Example.** LeadSurface started as a tool for me, not a product. Years of PM work taught me customer validation is non-negotiable, and I kept hitting the same wall: where do you find the customers to interview? So I built community monitoring that watches keywords and competitors and sorts what it finds by intent, a way to surface people already discussing their pain points with their peers. It worked well enough to solve my own problem. Then I ran it through Gate 0 honestly and killed the framing, not the tech. As a product-discovery tool it was one-time use. You find your customers and you're done, which is a weak thing to charge for twice. A small shift pointed the same engine at a durable job, finding live leads for a product a team already sells, and that is the whole distance between an interesting tool and a paying one. That reframe is what became LeadSurface.

---

## Gate 1 — Who is it for, and what's a win?

**The gate.** Who exactly is this for, and how will you know it worked?

**Lens.** Business.

**When you're at it.** You've decided it should exist. Before any direction or plan, you set the target.

**What the pipeline hands you.** It will happily proceed on whatever framing you give it, including a vague one. Garbage in here is inherited by every gate downstream, confidently.

**The decision.** Name the specific user and the specific success signal. This is the context the whole pipeline builds against, so it's the highest-leverage sentence you'll write all project.

**What good judgment looks like.** The user is a person, not a segment. The win is observable, a behavior that changes or a number that moves, not "customers will love it." You'd bet a small amount of money on the success signal. Watch the gap between an activation metric and an outcome metric: accounts created is not opportunities validated. The win is the outcome, not the sign-up.

**If this isn't your lens.** Use the business-context step as a form you fill, not an essay you write. Persona, the problem in their words, what "fixed" looks like, how you'd measure it. If you're a developer who's never done this, the shortcut is to actually ask one real customer and write down their words rather than your paraphrase. The agent can turn a messy interview note into a clean brief, but it can't have the conversation for you.

**Failure modes.** Success defined as "it ships." A persona so broad it fits everyone and helps no one. Skipping this because you "already know" what's needed.

**Example.** LeadSurface's customer is a one-to-four-person startup, a founding team wearing every hat to get from zero to one. Their scarcest resource is attention, so sitting in Reddit and forum threads for hours a day to catch a buying signal is exactly the work they can't afford. The persona isn't "revenue teams." It's a specific founder who has to spend their few good hours on the conversations that move the needle: acquiring a customer, building rapport, solving a real problem. So the win isn't "they use the dashboard." Logins are an activation metric, not an outcome. The observable win is that founder reaching a potential customer within four hours of the original post, while the conversation is still live. If that happens, the tool did its job. If they're logging in daily but never connecting in time, it didn't, however good the numbers look.

---

## Gate 2 — Which direction?

**The gate.** Of the ways to solve this, which one fits the strategy?

**Lens.** Business.

**When you're at it.** The problem is framed and the pipeline offers options, or you're weighing approaches before planning.

**What the pipeline hands you.** Divergent options, often several reasonable ones. The agent is good at generating directions and indifferent to which serves your strategy.

**The decision.** Pick the direction that fits where the product is going, not just the one that solves today's ticket. Taste and fit, not feasibility. Feasibility is a later gate.

**What good judgment looks like.** You reject a technically fine option because it pulls the product off-strategy. You choose the smallest direction that actually addresses the real problem from Gate 1, not the most impressive one. When the direction is really a positioning call, map it with the four switching forces of push, pull, habit, and anxiety. The option that wins is the one that overcomes what actually holds the customer in place, not the one with the most pull.

**If this isn't your lens.** Ask the agent to lay out three directions with the tradeoffs stated in customer terms, not technical ones. Then map each against the success signal from Gate 1 and pick the closest fit. If two are close, pick the one that's cheaper to reverse. Product taste grows fastest by making these calls and watching how they land.

**Failure modes.** Choosing the shiny direction over the fitting one. Letting the agent's first suggestion become the decision by default. Solving a bigger problem than you have.

**Example.** LeadSurface's onboarding is genuinely clumsy right now. A new user submits email, password, and company name, then three competitors, five keywords, and optionally the subreddits to watch. The obviously better version is nearly frictionless: take an email, infer the company, and hand back recommended competitors and keywords automatically, since not having time to do that research is the whole reason they showed up. Building that was the elegant, tempting direction, and I passed on it. The on-strategy call was to validate the solution first, and the solution isn't the onboarding flow. Volumes are low enough that I can onboard each customer as a concierge by hand, which does something the polished flow can't: it puts me in the room with every early customer, learning their pain points and who they're actually targeting, and that feeds straight back into the product. Slick onboarding can wait until there's a validated solution worth smoothing the path to.

---

## Gate 3 — Right plan, right scope?

**The gate.** Does the plan match the intent, and what did it miss?

**Lens.** Both. Product owns the scope, engineering owns the feasibility.

**When you're at it.** The pipeline has produced an implementation plan (files, steps, tests) and is ready to build against it.

**What the pipeline hands you.** A plan that is usually internally coherent and occasionally solving a slightly different problem than the one you framed, or missing a piece that isn't obvious until production.

**The decision.** Approve, adjust, or send back. You're checking two things: does the scope match Gate 1, and is the approach sound enough to build on.

**What good judgment looks like.** You catch the missing case before it's built: the backfill for existing rows, the empty state, the thing that breaks at scale. You cut scope that crept in. You'd rather fix the plan than the code. Run the plan against the common-gap checklist: undefined unit of action, unspecified data contracts, no backfill plan, absent outcome metrics. Those are the omissions that read fine in a plan and hurt in production.

**If this isn't your lens.** Product person reading a technical plan? Don't try to vet the code approach. Vet the scope and the edges. Ask "what happens to data that already exists," "what's the empty or error case," "what did you decide not to handle." Developer without product sense? Re-read the plan against the one-sentence win from Gate 1 and cut anything that doesn't serve it. The agent will expand the plan's assumptions on request. Make it list what it's *not* doing, which is where the gaps hide.

**Failure modes.** Approving a coherent plan for the wrong problem. Letting scope quietly grow because each addition seems small. Reviewing the code later instead of the plan now, which is the expensive order.

**Example.** In gh-monthly the plan was precise, and the first implementation still missed pieces the spec had named: schema fields, the full run-metadata contract, streaming to disk. Closing those was an alignment pass against the spec, not a rewrite, which is the whole point: the plan was authoritative enough to be checked against. On LeadSurface I've met the other side of this the hard way, in production. The classify queue quietly grew past 1,500 items because the connection to my local inference had dropped and nothing told me. The plan had a happy path and no failure path. It never said what happens when the model connection fails, or how I'd find out, and both are Gate 3 omissions of exactly the kind that read fine in a plan and only surface when the queue backs up and customers stop getting timely signals. I fixed it in two passes: a more resilient queue and connection first, then a notification to me when it stalls. The lesson wasn't "write better code." It was that a plan without its failure and observability states isn't finished, it only looks finished. Both fixes are now tests: the queue-depth check asserts a warning fires the moment depth crosses the threshold, so the failure that once slipped past silently would trip a red build if it ever came back.

---

## Gate 4 — Is the architecture sane?

**The gate.** Is this sound, or clever in a way that hurts in six months?

**Lens.** Engineering.

**When you're at it.** The plan or the early build commits to a structure (a data model, a boundary, a dependency), before it becomes load-bearing.

**What the pipeline hands you.** Code that works and is shaped by whatever pattern the agent reached for, which is not always the pattern that survives contact with your next three features.

**The decision.** Is this shape one you can build on, or one you'll be ripping out? You're trading present convenience against future cost.

**What good judgment looks like.** You spot the abstraction that will fight the next feature. You resist cleverness that saves ten lines now and costs a day later. You let boring, obvious structure win.

**If this isn't your lens.** No architecture instinct yet is the riskiest gap, because bad structure is invisible until it's expensive. Lean on the agent as a critic, not just a builder: ask it to name the tradeoffs of the chosen design, what it would do differently at 10x the data or users, and what would be hard to change later. Then apply one rule you *can* judge without deep expertise. If a small future change would touch many files, the shape is probably wrong. This is the lens that grows slowest, so treat every "we had to rewrite this" as a lesson filed.

**Failure modes.** Accepting the first structure because it runs. Clever over boring. Discovering the design was wrong only when a feature becomes weirdly hard.

**Example.** LeadSurface's first version stored intent signals as plain markdown files, written by a scheduled Rust script that still runs on my machine. For a single-user prototype that was the right lazy choice, right up until it wasn't. Reviewing and managing several days of results across a pile of files got painful fast, and the operations the product actually needed (search, filtering, updating a signal's state) are exactly the ones markdown is worst at. So in the production version I ripped it out for Postgres. The tell was that I hit the friction myself before a single customer did. When the shape of your storage fights the basic things users will do all day, that isn't a feature request for later, it's the architecture asking to be redone now, while it's cheap. Files were right for the script and the wrong shape for the product.

---

## Gate 5 — Off the rails?

**The gate.** Is the agent stuck, or making a call the plan left open?

**Lens.** Engineering.

**When you're at it.** Mid-build. The agent is looping, thrashing on the same error, or has quietly made a decision the plan didn't specify.

**What the pipeline hands you.** Motion that may or may not be progress. Agents are good at looking busy while going nowhere, and good at making an undocumented choice sound settled.

**The decision.** Intervene or let it run. You're deciding whether the loop is converging or spinning, and whether an on-the-fly choice needs your input.

**What good judgment looks like.** You recognize thrash early, the same fix reattempted with cosmetic changes, and stop it before it burns the session. You catch the silent decision and pull it up to a real gate.

**If this isn't your lens.** Even without deep skill you can spot a loop: if the last three attempts look like variations of the same thing, it's stuck, and continuing rarely helps. Interrupt, ask the agent to explain what it's actually trying and why the last attempts failed, and force it to change approach rather than retry. For silent decisions, ask "what did you decide here that I didn't tell you to," periodically. The agent will surface its own assumptions if you make it.

**Failure modes.** Letting a stuck loop run because it "might get there." Missing the buried decision until it's baked in. Intervening so early the agent never gets to work.

**Example.** The way this bites me on LeadSurface, and the way it bites most vibe coders and non-technical PMs, isn't the agent getting stuck. It's the agent quietly doing too much. It takes an assumption from the spec and runs past what I actually asked for: the same logic copied in three places instead of shared, dead code scaffolded for a future that may never arrive, an abstraction built for a problem I don't have yet. None of it is in the plan. The agent decided it on its own, and it looks like diligence. Off the rails doesn't always mean spinning in circles. Sometimes it means confidently building the wrong amount. I caught it by hand at first. Now a review agent runs the check every time (I use the ponytail plugin), which matters most when you can't reliably spot over-engineering yourself: it holds the line on DRY and YAGNI instead of trusting the builder to hold it alone.

---

## Gate 6 — Does the test prove it?

**The gate.** The pipeline says the change is tested. Is that deterministic evidence, or a one-off demo the agent ran once and narrated as success?

**Lens.** Engineering. This is the gate where a non-developer running an agentic loop gets quietly burned the most.

**When you're at it.** The build reports green. The agent has written a test, or run the feature, and is telling you it works. Everything reads like success, which is exactly when to slow down.

**What the pipeline hands you.** One of two things that look nearly identical in a chat log:

- A *demo*: the agent exercised the feature once, saw the right output, reported success. Nothing about it is repeatable. Nobody will ever run it again.
- *Evidence*: a test that asserts the behavior and fails, the same way, every time the behavior regresses. A deterministic browser test that drives the real UI and checks the real result, on every change, forever, without you.

The agent calls both "tested." The difference only shows up later, when the demo silently rots and the evidence catches the regression.

**The decision.** Is "done" backed by something that will still be true next month? Is there an actual assertion or just an observation? Is it deterministic? Does it test the behavior the customer cares about, or the one that was easy to assert?

**What good judgment looks like.** You ask for the test, not the transcript, and read the assertion against the acceptance criterion from Gate 1. For anything user-facing you insist on a deterministic browser test over the agent's one-off click-through, because the agent testing its own work in the same session proves the code ran once, not that it works. You spend rigor in proportion to blast radius. A test only proves something against a standard, which is why a precise spec is what makes deviation detectable: vague acceptance criteria can't be failed, and enumerated ones can.

**If this isn't your lens.** You don't have to write the test to judge it. Ask the agent, in plain terms: "if this breaks next month, what fails and turns red?" If the answer is "nothing automatic," it's a demo. Make it show you the assertion and explain what input would make the test fail, because a test that can't fail isn't testing anything. Over a few rounds you'll start to feel the difference between "I saw it work" and "this is proven," which is most of what this gate teaches.

**Failure modes.** Rubber-stamping the transcript. Confusing coverage with proof, as in five tests that all assert the happy path the agent also wrote. Accepting a non-deterministic test that flakes until you learn to ignore it. Testing the convenient thing instead of the important one.

**Example.** On LeadSurface this is a habit. In a session the agent verifies what it built, which is the demo, and then I have it codify those steps into tests that actually assert the behavior. The classifier's tests feed fixed inputs, a garbage body, a 429, an empty 200, and assert it retries or degrades to a noise verdict instead of trusting one happy run. A Playwright smoke test drives the real flow from signup through to the feed rendering scored cards. Both run on every change: the unit suite gates CI through `npm test`, the browser suite through Playwright. That is the line between the agent saying it works and the work being provably repeatable. I get there fast because of a software background. If that isn't you, the whole gate collapses into one question you ask the agent every single time: how will you test this again the next time we change the code or deploy? A demo has no answer. Evidence names the test that runs.

---

## Gate 7 — Is the cost right?

**The gate.** Is this using the right model and infrastructure for current needs, or the biggest hammer on every nail?

**Lens.** Engineering.

**When you're at it.** Anywhere the build introduces a model call, a job, or infrastructure, and again periodically as usage grows.

**What the pipeline hands you.** Defaults that optimize for "works," not "works at a price you'd choose." The agent will reach for the largest model and the simplest-to-write approach unless told otherwise.

**The decision.** Match the spend to the current stage. Cheap work goes to cheap models. The expensive ones are saved for where they actually earn it. Right-size infrastructure for the load you have, not the load you imagine.

**What good judgment looks like.** You route by need. A classification or a cleanup doesn't need a frontier model. You've read the bill and know what your loop actually costs. You avoid both premature scaling and the lazy default of maximum everything.

**If this isn't your lens.** You don't need to be an infra expert to ask "what does this cost per run, and is there a cheaper model that's good enough here?" Make the agent propose a cheaper tier and justify when the expensive one is actually required. Set a budget ceiling so a runaway loop stops instead of surprising you. The heuristic that carries you far: most work is routine and belongs on the cheap tier, and you reserve the expensive tier for the genuinely hard step.

**Failure modes.** Frontier model on every trivial call. Building for scale you don't have. Never looking at the bill until it's a problem.

**Example.** On LeadSurface the cost call is staged to the moment. Right now, with few customers, classification runs on models I host myself on a Mac mini: free, slow, and imperfect, and that is the correct choice while volume is low and the bill matters more than the milliseconds. The trap would be reaching for a fast hosted model today because it's better in the abstract. It isn't better for this stage. The plan is to move that exact same set of models onto a hosted inference service once paying customers fund it, buying speed and, more than that, stability I rent instead of own, so I stop babysitting hardware and get back to the core product. Same models, different tier, and the tier is a function of the stage, not of what's newest or fastest.

---

## Gate 8 — Risk acceptable to ship?

**The gate.** Do you believe it works, and is the risk that's left acceptable?

**Lens.** Both. Product weighs customer impact, engineering weighs blast radius.

**When you're at it.** Tests are green, review is done, and the change is ready. The last checkpoint before it's live.

**What the pipeline hands you.** A change that passed its gates. Passing gates is necessary, not sufficient, and residual risk is a judgment the pipeline can't make for you.

**The decision.** Ship, hold, or ship narrowly. You're weighing what breaks if you're wrong against what you gain by shipping now.

**What good judgment looks like.** You size the blast radius: who's affected if this is broken, and how badly. You ship reversible things readily and irreversible things carefully. You know the difference between a bug you can fix Monday and one that corrupts data you can't get back.

**If this isn't your lens.** Product person: ask "what's the worst thing that happens to a customer if this is wrong, and can we undo it?" Developer without product feel: ask "who is actually affected and how much do they care?" Either way, have the agent enumerate the failure modes and which are reversible. Reversible-and-low-impact ships. Irreversible-or-high-impact gets more proof first. That single sort handles most of this gate.

**Failure modes.** Treating green tests as permission to stop thinking. Shipping an irreversible change with a reversible change's caution. Blocking forever on a low-stakes change because something might break.

**Example.** LeadSurface ships its core intelligence on deliberately limited models. Classification and summarization of everything we mine run locally on a 32GB M4 Mac mini: no reasoning, modest parameter counts, not the sharpest tools available. Shipping that is a real risk call, because the model will sometimes score a signal wrong. What makes it acceptable is the blast radius, not the accuracy. A misfired signal isn't a corrupted record or an email to the wrong person. It's one card in a feed, and every card carries a thumbs up and a thumbs down. Worst case, a user dismisses a bad lead in one click, and that click is also the feedback that sharpens the system. That's the trade: I'll ship imperfect output all day when the failure is cheap, reversible, and the user holds a control. What I hold for more proof is the opposite kind of change, where being wrong isn't a thumbs-down but something I can't take back.

---

## Gate 9 — Ship now, to whom?

**The gate.** Is now the moment, and who should see it first?

**Lens.** Business.

**When you're at it.** The change is cleared to ship. The remaining question is timing and audience.

**What the pipeline hands you.** A deployable change. It has no view on whether Tuesday is better than Friday or whether this goes to everyone or to the one customer who asked.

**The decision.** When it goes live and who gets it first. Timing, communication, and staged exposure.

**What good judgment looks like.** You ship the requested fix to the requester first and close the loop with them personally. You avoid shipping risky changes into a window you can't watch. You use a limited rollout when the downside is real.

**If this isn't your lens.** This is mostly customer instinct, and the cheap substitute is a rule: ship to the person who asked first, tell them, then widen. Ask the agent to draft the "here's the thing you asked for" note, then edit it into your voice and send. Timing is largely "don't deploy something you can't babysit right before you step away." Simple, and it prevents most timing disasters.

**Failure modes.** Big-bang shipping something that should have gone out narrowly. Never telling the customer who asked. Deploying into the weekend and hoping.

**Example.** LeadSurface's rollout has been narrow on purpose. I started the data sources where I have real expertise, developer and payments communities, because those are the signals I can validate myself. When I was ready for feedback I didn't open the doors. The platform blocks anonymous signups, and I kept it that way, then handed a keyed signup link to specific people I know in the payments space, so nobody gets in without my knowing who they are and why. From there it spreads the way I want it to: those first contacts introduce me to their contacts who see immediate value, often in verticals I haven't covered yet, and I take those on knowing I'll collaborate with each to make the product actually work for their space. Ship-to-whom, in order: the people whose signals I can vouch for, then the warm introductions, one vertical at a time. Never the whole internet at once.

---

## Gate ∞ — How much of this process does this change deserve?

**The gate.** Which of the ten gates does *this* change actually need?

**Lens.** Both, and above the others. This is the master gate, and it decides how much of the rest to run.

**When you're at it.** Every single time, before you start. It's the first decision and the one people skip because it doesn't feel like a decision.

**What the pipeline hands you.** Nothing. There's no artifact and no prompt. The pipeline will run exactly as much process as you invoke, from a one-line fix to all ten working gates, and it won't tell you which was appropriate.

**The decision.** Right-size the process to the stakes. A typo fix does not get a spec and a security pass. A billing change or a data migration gets all of it. Getting this wrong is expensive in both directions: ceremony on a triviality wastes the attention you don't have, and a shortcut on something load-bearing is how the quiet disasters happen.

**What good judgment looks like.** You read the blast radius first and let it set the process. You're comfortable running two gates for a copy tweak and all ten for anything touching money or data. You never confuse "I did all the steps" with "I did the right steps."

**If this isn't your lens.** This is the one gate you can't outsource to the agent, because it's the decision about how much to trust the agent. The starter heuristic: if the change touches money, customer data, auth, or anything you can't cleanly undo, run the full set. If it's cosmetic and reversible, run the minimum and ship. When unsure, treat it as higher-stakes than it looks, because the cost of over-processing a small thing is minutes, and the cost of under-processing a big one is your weekend.

**Failure modes.** Full ceremony on everything until the process feels pointless and you abandon it. Minimum process on everything until something irreversible breaks. Deciding by mood instead of by stakes.

**Example.** Two real LeadSurface changes at opposite ends of the dial. The small one: the marketing site's "see live signal feed" button sent people to a signup URL that, without a magic key, dead-ended on "access denied." I redirected that case to my contact form instead, so a blocked visitor becomes a lead I can reach out to by hand. That earned about two gates: is this the right small fix, and ship it. No spec, no architecture review, done in minutes, fully reversible.

The big one: billing and the 14-day trial. There's no payment system yet, while the site already advertises three priced tiers and a no-card trial. That change is Stripe checkout and webhooks, a trial clock, a lock-out at expiry, and authoritative billing state kept on the server and never trusted from the client, split across two paired specs. It earns every gate, because being wrong means charging someone incorrectly or handing out paid access for free, and neither is a thumbs-down you can take back. So it isn't shipped. The specs are written and the first changes are in, and it stays in careful progress precisely because it's the kind of change that earns the full treatment. Same week, same builder. One got a sentence of thought and shipped in minutes. The other gets a spec of its own and hasn't shipped yet, on purpose. Knowing which of the two you're holding, before you start, is the gate.

---

## Appendix — the tool stack (disposable)

What I actually use today, offered as a snapshot and nothing more. This layer reprices and renames every quarter, and it is not the method.

No single plugin covers idea-to-ship, so the workflow is composed from three:

- A **core loop** plugin owns brainstorm, plan, build, test, and review. That's the spine.
- A **gap-filler** plugin adds exactly the three things the spine lacks: a dedicated security pass, live browser testing, and launch prep.
- A **custom** layer adds what no general toolkit could: the business-context step up front, and domain-specific build skills for the stacks in use.

The lesson isn't the specific tools. It's that the stack is composed from what's missing, not adopted wholesale from one vendor, and that when these names change next quarter, the gates above don't.

## Related

- [Loop &amp; Gate](/loop-and-gate/) — the framework and the whole stack this guide belongs to.
- [Building on the Margins](/articles/strategic-insights/building-on-the-margins/) — the manifesto behind the method.
- The Grow Field Guide covers the other half of the loop, taking shipped software to market. (Publishing alongside this one.)
