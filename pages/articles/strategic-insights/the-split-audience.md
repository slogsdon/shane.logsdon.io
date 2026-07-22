---
title: 'The Split Audience: The First Reader of Your Docs Isn''t a Developer'
date: '2026-07-22'
layout: partials::layouts/writing-post
slug: the-split-audience
description: AI coding agents read your documentation before any developer does, and
  no analytics metric you're reporting captures it. Here's what changes when you write
  docs for the reader that shows up first.
faqs:
- q: Why does it matter that an AI coding agent reads your docs before a developer
    does?
  a: Because the agent isn't skimming, it's deciding. It picks the auth pattern, the
    endpoint, and whether your product is worth using at all, before a human developer
    ever opens a page. When your docs aren't structured clearly enough for the agent
    to follow, that's where the wrong choice gets made.
- q: What's the difference between the two surfaces DevRel needs to design for?
  a: 'The first is a human asking an AI what to use. That''s a discovery problem:
    if your docs aren''t extractable and citable, you might not show up in the answer
    at all, regardless of how good the product is. The second is an agent that already
    chose you and is now reading your reference material to build the integration.
    That''s a correctness problem, and bad structure there gets you a bad integration
    or an agent that quietly suggests a competitor it can parse instead.'
- q: What should I actually do about this?
  a: 'Structure your docs the way a tired human at 2am would want them: clear heading
    hierarchy, direct answers near the top, parameter tables instead of parameters
    buried in prose, and an llms.txt index at your site root. None of that makes the
    docs worse for people. It''s the same fix for both readers.'
- q: How do I know if my documentation is actually agent-legible?
  a: Run the test yourself before spending money on tooling. Open a coding agent,
    point it at your quickstart, and ask it to build the hello-world integration.
    Watch what it fetches and where it starts guessing. Every guess is a place where
    the docs were clear enough for a human but not for the machine reading them first.
- q: Why can't I trust my docs traffic numbers anymore?
  a: Because an AI agent can read your entire docs site in one or two requests instead
    of the multi-page session your analytics were built to track. A drop in docs traffic
    might mean your content is failing, or it might mean an AI cited you well enough
    that the developer skipped your site and went straight to building. Traffic alone
    can't tell you which one happened.
image: the-split-audience-og.png
heroImage: the-split-audience-hero.png
---

*AI coding agents read your documentation before any developer does, and no analytics metric you report captures it. Writing docs for the agent (clear structure, direct answers, an llms.txt index) is what keeps you in the answer, and it serves the human reader too.*

There's a sentence at the end of [a Sunil Pai essay](https://sunilpai.dev/posts/developer-relations/) from April that I keep coming back to. After several thousand words about what AI is doing to developer education, he drops this almost as an aside: "there's a whole other thread here about what happens when agents themselves become the primary consumers of your docs, APIs, and error messages, and when devrel has to be legible not just to humans but to the machines working alongside them."

He said he'd pull on that thread in a different post. I've been pulling on it for months, because it describes the thing my analytics couldn't show me.

Here's the shape of the problem. When a developer uses Cursor or Claude Code to build an integration with your API, the agent reads your documentation first. It fetches the README, the API reference, maybe an OpenAPI spec. It compresses what a human would experience as a twenty-minute reading session across a dozen pages into one or two HTTP requests. Then it makes decisions on the developer's behalf: which auth pattern to use, which endpoint to call, whether your product is the right choice for the task at all.

Your documentation got read, evaluated, and acted on, and no metric you report captured any of it.

---

## Two audiences, one set of artifacts

Software has walked this road before. Each wave re-centered design on whoever actually consumes the thing. UX redesigned interfaces around users rather than the engineers who built them, and DX did the same for APIs and the developers consuming them. AX (Agent Experience), designing your product's surfaces so an autonomous agent can consume them, is the third turn of that wheel, the term [Netlify's Mathias Biilmann](https://biilmann.blog/articles/introducing-ax/) put a flag in. It asks the question again, now that the consumer is a machine: is this system designed for the thing actually using it?

I've [written about AX from the engineering side](https://shane.logsdon.io/articles/technical-deep-dives/the-ax-shift/), where specs and context files become the communication layer between you and your coding agent. This post is about the other side: what AX means when the thing that changed is your distribution channel, not your development workflow.

Because the audience for developer documentation has split in two, and the halves want opposite things.

A human developer reads selectively. They skim, build a mental model across pages, tolerate narrative, and recover from ambiguity by inferring intent or asking a colleague. An agent parses for structure, and it does so under a token budget. One documented example: Cisco's firewall REST API quick start guide weighs [193,217 tokens](https://arxiv.org/abs/2604.02544), past the context window of many coding agents, which means parts of documentation at that scale are effectively invisible to them. The agent can't infer what you meant from what you almost said, nor can it ask a colleague. It fills every ambiguity with the statistically most probable answer, which is how a plausible-but-wrong integration gets confidently assembled from docs that were clear enough for humans.

Joey de Villa frames the stakes bluntly: when the docs aren't optimized for machine ingestion, the AI hallucinates the implementation, and the developer blames your product. The failure is yours either way. The agent never files a support ticket.

---

## The two surfaces

The split shows up on two distinct surfaces, and most DevRel programs I've seen are building for neither.

The first surface is a human asking an AI what to use. "What's the best way to handle auth in a Next.js app?" The assistant synthesizes a recommendation from content it can extract and cite. If your docs are prose written for top-to-bottom human reading, you may not appear in the answer at all, regardless of product quality or community size.

The second surface is an agent consuming your docs autonomously. The developer already chose you, or their agent did, and now the agent is reading your reference material to build the integration. Structure quality here determines whether the integration comes out correct, and whether the agent quietly recommends switching to a competitor whose docs it can actually parse.

The first is a discovery problem and the second is a correctness problem. Both are documentation problems, and both land on DevRel's desk whether or not anyone assigned them there.

---

## What breaks first: your instruments

The subtle casualty is measurement. When agents compress multi-page navigation into single requests, bounce rate, session depth, and page views stop meaning anything. A decline in docs traffic is now ambiguous. It could mean your content is failing, or it could mean your AEO (answer engine optimization, being the source an AI cites) is succeeding, because developers got the answer through an AI citation and went straight to integration without ever loading your site.

If you're reporting docs traffic to leadership as a health metric, you're reading an instrument that no longer measures what it used to. What to measure instead is a big enough question that it gets its own post at the end of this series.

---

## What to do about it

The good news is that writing for the agent doesn't mean writing worse for the human. Agents need clear heading hierarchies, direct answers near the top of pages, parameter tables instead of parameters buried in prose, markdown versions of your docs, and an llms.txt index (a plain-text map of your docs for crawlers) at your site root. Tired humans at 2am appreciate every one of those too. There is no bifurcation crisis here. Structure serves both audiences. Only vagueness had to choose.

The test I'd run this week, before any tooling investment: open a coding agent, point it at your quickstart, and ask it to build the hello-world integration. Watch what it fetches and where it guesses. Every guess is a place where your documentation was legible to a human and illegible to the machine that now reads it first.

Then ask the more uncomfortable question: when a developer asks ChatGPT what to use for your product's core use case, are you in the answer? That one, the discovery surface and the infrastructure behind it, is the next post.

---

*Part 1 of 9 in the Developer Relations in the Age of AI series.*

*Next: AEO Is DevRel Infrastructure → · ← All articles*

*Related reading: [The AX Shift: You're Still Designing for Yourself](https://shane.logsdon.io/articles/technical-deep-dives/the-ax-shift/): the engineering-side treatment of the same consumer change.*

---

*Suggested title: "The Split Audience: The First Reader of Your Docs Isn't a Developer"*
*Meta description: AI agents now read your documentation before developers do. What the Agent Experience shift means for DevRel distribution, docs structure, and the metrics that just stopped working.*

*Sources: Sunil Pai, "developer relations after the cheat code machine" (sunilpai.dev, Apr 2026); Netlify, "Introducing AX: Why Agent Experience Matters"; Joey de Villa, "AEO (AI Engine Optimization): Writing Docs and Code for Machines" (Arc of AI, 2026); Oleksii Borysenko, "Developer Experience for AI Coding Agents: HTTP Behavioral Signatures in Documentation Portals" (arXiv:2604.02544), source of the navigation-compression finding and the 193,217-token guide example.*

## Distribution

### LinkedIn – Shane

Your documentation has a new first reader, and it isn't a developer.

When someone points an AI coding agent at your API, it reads the README, the API reference, maybe an OpenAPI spec, before a human ever does. It compresses what used to be a twenty-minute skim across a dozen pages into one or two requests, then decides which auth pattern to use, which endpoint to call, and whether your product is even the right choice for the job.

None of that showed up in analytics. Bounce rate, session depth, and page views all assume a visitor who loads your site. Increasingly, the first reader doesn't.

I wrote about the two surfaces this creates: a human asking an AI what to use, and an agent consuming your docs to actually build the integration. Here's the test I'd run this week. Point a coding agent at your own quickstart and watch exactly where it starts guessing.

Is your documentation still legible when the reader isn't a person?

Link's in the first comment.

[first comment]
The test I'd run this week. Point a coding agent at your own quickstart and watch where it starts guessing: {{URL}}

### Bluesky – Shane

AI coding agents read your docs before any developer does, and no analytics metric captures it. Bounce rate, session depth, and page views stop meaning what they used to when the reader never loads your site. {{URL}}
