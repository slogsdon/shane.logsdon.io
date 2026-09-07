---
title: Building on the Margins
layout: 'partials::layouts/writing-post'
date: 2026-07-13
slug: building-on-the-margins
image: building-on-the-margins-og.png
heroImage: building-on-the-margins-hero.png
draft: false
enriched: true
---

I have a full-time job. A family. And I'm building [LeadSurface](https://www.leadsurface.com), a real product with real customers who expect it to get a little better every week.

Something has to give. For a long time I figured it would be the product. You can't build software well in the forty-minute windows between a meeting and dinner. Context dies the moment you're interrupted. Come back to the code three days later and you burn twenty minutes remembering what you were doing and why.

It's not just the code that evaporates. The ideas go too. A fix for a nagging bug, a feature a customer would love, the right wording for an onboarding email, they show up at red lights, in the shower, halfway through a meeting you can't leave. Without a place to capture them, they're gone by the time you're back at the keyboard. On the margins, most of the work is catching the thought before it slips, so a spark at 2pm reaches the forty-minute window at 9.

What I've learned is that interruption kills the discipline, not the code. When I'm tired, or I've only got half an hour, or I'm holding four other things in my head, I skip the steps that matter later. I don't write down what I'm building before I build it. I tell myself I'll test it later. I make a call at 10pm and can't reconstruct why by the weekend. None of that is a skill problem. It's an attention problem.

So I stopped trying to fix my attention and started externalizing the discipline. That's my dev workflow. Not a stack of clever AI tools, but a delivery team that never forgets context, so my attention goes to the parts only I can do.

The same split works for a local business owner: keep the judgment about the business and hand the repeatable web-presence work to a system. That is the model behind my work with [local businesses](/local-businesses/).

## What I keep, what I hand off

This is the distinction that makes the whole thing work. There's work on LeadSurface that's genuinely mine and can't be delegated, and it comes from two careers I've already had. As a product manager I know the market, I know the customer, and I can tell a real problem from a loud one. As a developer I know when an architecture is sane, when a test actually proves something, and where a dollar of infra is worth spending. That judgment took years on both sides of the table, and no model has it. It's why the product is worth building, and why I can tell when the pipeline is quietly wrong.

Then there's the second category: the disciplined execution of turning a decision into shipped, tested, reviewed code. That work is real and necessary, but it doesn't need me specifically. It needs someone who won't cut corners and won't lose the thread between sessions. That's exactly what I'm bad at on the margins, and exactly what a skill pipeline is good at.

So I split it. I stay the strategist and the expert. The pipeline is the delivery team.

But the handoff is never total, and that's the part people miss. The pipeline runs the stretches between decisions. It doesn't make the decisions. There are fixed points where it stops and waits for me, and those points are the actual job. I call the whole approach Loop & Gate: an autonomous loop with a fixed set of human gates on it:

- Should this exist at all? Kill or build, before a line of code gets written.
- Who's it for, and what would make it a win? The context everything downstream inherits.
- Of the directions on the table, which fits the strategy?
- Is the plan right, and what did it miss?
- Is the architecture sane, or clever in a way that'll hurt in six months?
- Is the change going off the rails, or making a call the plan left open?
- Does the test actually prove it, or did the agent run it once and call it done?
- Is the cost right, or is it reaching for the biggest model on every call?
- Is the risk that's left acceptable to ship?
- Is now the moment to ship, and who should see it first?

Underneath all of those is the one that never automates: how much of this process does this particular change even deserve? A typo fix and a new data pipeline don't get the same treatment, and telling which is which is judgment, not process.

Some gates are business calls, some are engineering calls, and that split is why both careers earn their keep. When the pipeline says a change is tested, the product manager in me asks whether we tested what the customer actually cares about, and the developer in me asks whether the test proves anything at all. There's a real difference between the agent running a feature once in chat and announcing it works, and a deterministic browser test that fails the same way every time the feature regresses. One's a demo. The other's evidence. Cost is the same story, the agent will reach for the biggest model on every call if you let it, and it takes someone who's read the bill to route cheap work to cheap models and save the expensive ones for where they earn it.

I'll say the quiet part though: I don't have every lens either. My weak side is go-to-market. I've done some of it, but I'm no expert, so I work those gates like someone with no engineering background works the technical ones. I make the agent lay out the options in plain terms, I decide against the structure instead of a gut I haven't built yet, and I get a little better every time I ship through it. That's what I'd tell anyone holding one hat, or none. The gates don't ask you to already know both sides. They tell you which side each decision needs, so you know when you're on home ground and when to slow down and let the structure carry you. The one thing that never works is using the agent to skip the gate instead of to work it. That just gets you to the wrong answer faster.

## The pipeline, in one breath

I compose the workflow out of skills, small, focused procedures I can invoke by name inside Claude Code. A feature moves through roughly six stages:

1. **Business context.** Before anything else, I capture who this is for, what the opportunity is, and how I'd know it worked. This is the one step that's pure me, the market and customer knowledge going in on the record so everything downstream inherits it.
2. **Brainstorm.** Explore the problem and pick a direction, with that business context as the frame.
3. **Plan.** Turn the direction into an actual implementation plan, file paths, steps, how each piece gets tested.
4. **Build.** Isolated branch, one small change at a time, a test before each. When something breaks, a systematic debugging pass instead of guessing.
5. **Validate.** Every "it's done" claim has to be backed by evidence, not vibes. Then a focused code review, a security pass, and live testing in a browser.
6. **Ship.** A launch checklist, then merge and clean up.

Written out it looks heavy. In practice it isn't, because I don't run all six every time. More on that at the end. The point of the structure isn't ceremony. It's that each stage holds the context so I don't have to. I can walk away after the plan and come back cold two days later, and the plan's still there, still exact. The workflow remembers. I don't have to.

## What it looks like on a real feature

Say a LeadSurface customer tells me the lead export is missing a field they need. Old me would open the code, add the field, ship it between two other things, and half the time introduce a bug I wouldn't notice for a week.

Now the request goes in as business context first: who's asking, why it matters, what "fixed" means to them. That framing is mine. Then I brainstorm the actual shape of the change and write a plan. And here's the part that matters for a fragmented life: I can stop there. The plan is a durable artifact. When I next get a window, I don't reconstruct anything. I pick up the plan, spin an isolated branch, and build it one tested slice at a time. Before I call it done, the verification step makes me actually prove it works, with a browser test that'll catch the regression next time, not a one-off I eyeballed once. Then review, then ship.

The customer feedback loop tightens because the mechanical cost of acting on feedback drops. I'm close to the customer, which is the whole advantage of a solo operator, and the pipeline means being close turns into shipped changes fast instead of a backlog of good intentions.

## Why it's three toolkits, not one

No single plugin covers idea-to-ship, so I compose three, and where the seams fall is deliberate.

The core loop of brainstorm, plan, build, test, and review comes from one plugin. It's the spine. But it leaves gaps: no dedicated security pass, no live browser driving, no launch prep. So a second toolkit fills exactly those three holes and nothing more. A third layer, my own custom skills, provides the parts no general toolkit could: the business-context step up front, and domain-specific build skills for the stacks I work in.

I didn't design that split top-down. I reached for whatever filled the next hole, and this is where it settled. The lesson isn't the specific tools, those will churn. It's that the workflow is composed from what's missing, not adopted wholesale from one vendor.

## Where it's still rough

I want to be honest about the limits, because the tidy version of this is a lie.

I don't run all six stages every time. It's a menu, not a mandate. A one-line copy fix doesn't get a spec and a security pass. The judgment about how much process a change deserves is itself unautomated, it's still me, reading the stakes.

And the pipeline is only as good as the context I feed it. The business-context step is load-bearing. When I rush it, everything downstream confidently builds the wrong thing, fast. The tooling doesn't save me from being wrong about the customer. It just makes me wrong more efficiently, which is another reason the strategy and market work stays mine, and stays first.

That's the trade I've settled into. The pipeline carries the discipline and the memory across the gaps in a full life. I carry the judgment, from both the product side and the engineering side. LeadSurface gets built in the margins, and the margins are enough.

---

*[LeadSurface](https://www.leadsurface.com) is competitor-switch intelligence for revenue teams. It reads developer and SaaS communities and surfaces high-intent switching signals while the conversation is still live.*

*This piece sits alongside my [series on agentic product development workflows](https://shane.logsdon.io/articles/agentic-workflows/), which goes deeper on the specifics: specs, evaluation, and the workflow itself.*
