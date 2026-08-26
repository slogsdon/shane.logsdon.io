---
title: What Do We Measure When AI Answers the Questions?
date: 2026-08-26
layout: partials::layouts/writing-post
slug: what-do-we-measure
description: Docs views, GitHub stars, and event attendance are measuring a channel
  that's shrinking. The dashboard that actually answers whether developers are finding
  you tracks AI citation rate and agent-mediated activation, and asks whether your
  community still trusts what it's being told.
faqs:
- q: Why are docs views and GitHub stars broken metrics now?
  a: 'Because a falling number can mean opposite things: your content failed, or your
    AEO worked and developers skipped straight from an AI citation to installing the
    thing. The old dashboard can''t tell you which.'
- q: What four things should replace the old DevRel metrics?
  a: AI citation rate, agent-mediated activation, behavior over sentiment, and trust
    quality. Together they ask whether you show up in AI answers, how much adoption
    starts inside an agent, and whether the community still trusts what it's being
    told.
- q: What is agent-mediated activation, and why does it matter?
  a: It's adoption that starts inside a developer's coding agent instead of your docs,
    like Neon's report that 80% of its databases now get provisioned by AI agents.
    Traditional DevRel metrics don't see any of it happening.
- q: How do you measure AI citation rate if the tooling doesn't exist yet?
  a: 'Run a monthly test: 20 category and use-case queries across ChatGPT, Perplexity,
    Claude, and Gemini, tracking how often you''re cited and whether the citation
    is even accurate. Between tests, AI referrer traffic in GA4 is a rough but always-on
    proxy.'
- q: Should DevRel teams stop reporting GitHub stars and the old metrics entirely?
  a: No. Keep reporting stars if leadership wants them, and keep the metrics that
    are still genuinely behavior, like time to first API call and production deployment
    rate. The mistake is measuring only the old survivors while ignoring where developer
    experience actually starts now.
image: what-do-we-measure-og.png
heroImage: what-do-we-measure-hero.png
---

*Docs views, GitHub stars, and event attendance now measure a shrinking channel. The DevRel dashboard that works in 2026 tracks four things instead: AI citation rate, agent-mediated activation, behavior over sentiment, and trust quality.*

A metric that goes up when you're less necessary is a broken metric.

That's the trap most DevRel dashboards are sitting in right now. If AI handles the first 75% of developer education, then tutorial views and docs engagement are increasingly measuring AI's effectiveness at replacing your content, not your program's impact. The decline is ambiguous in the worst way, too. Falling docs traffic could mean your content is failing, or it could mean your AEO is succeeding and developers went from AI citation straight to integration. It's the same chart with opposite conclusions, and nothing on the chart tells you which.

The old metrics were already weak before AI. [Jono Bacon's line](https://blog.stateshift.com/beyond-github-stars/) about the most-reported one is blunt: "GitHub stars are the participation trophies of the developer world." Stars are bookmarks with delusions of grandeur. You can't accidentally download a package the way you can accidentally star a repo. His prescription, that sentiment is noise and behavior is signal, was right then. AI raised the price of ignoring it, because AI broke the sentiment metrics' channel and created a new adoption path the old dashboard can't see, both at the same time.

Walk the board. Docs views measure a shrinking channel. Community Q&A volume drops as AI answers questions faster, which looks like community decline and may actually be community function shifting from Q&A to identity and trust. Event attendance measures a consumption mode that AI summarization is eroding. Social impressions were always distribution rather than impact. Every one of these can decline while your actual adoption accelerates through channels the dashboard doesn't instrument.

---

## The four categories that replace them

### 1. AI citation metrics

The leading question is no longer "how many developers saw this content?" It's "when a developer asks an AI what to use for this problem, do we appear?"

Run a monthly citation test: 20 category and use-case queries across ChatGPT, Perplexity, Claude, and Gemini, with citation frequency tracked over time. Track accuracy too. A wrong AI recommendation about your product is worse than absence, and you won't know it's happening unless you look. Between tests, AI referrer traffic is the always-on proxy, though a lossy one, since plenty of AI answers never produce a click at all. GA4 already segments sessions from chat.openai.com, perplexity.ai, claude.ai, and gemini.google.com.

### 2. Agent-mediated activation

[Neon tracked 80% of databases provisioned by AI agents](https://www.databricks.com/blog/databricks-neon), which is a category of activation traditional DevRel metrics don't capture at all. The versions of it worth tracking: agent skill installs (how many developers' coding agents now carry your context), the percentage of integrations that are agent-initiated (readable from coding-agent user-agent strings like Cursor or Claude Code, or API-key-first sessions with no docs referrer), and skill usage rather than install counts. Install count is stars again, one abstraction layer up. That's the trap to watch across this whole category. Every new channel grows its own vanity metric, and the test is always whether the number represents behavior or sentiment.

### 3. Behavior over sentiment

This is Bacon's framework, weighted heavier: package downloads over stars, integration completion rate over integration starts, and production deployment rate over quickstart runs. The gap between "ran the quickstart" and "reached production" is where DevRel programs lose developers silently, and it's also where the human 25% that AI can't do (post 3) either exists or doesn't. Weight PR contributions and detailed bug reports over community post counts. Someone filing a reproducible issue has skin in the game. Someone asking a question AI could have answered is low signal now.

### 4. Trust quality

The hardest to measure, the most important, and the least developed. Start with developer NPS scoped specifically to AI accuracy: "how accurate is the AI-generated guidance you've received about our product?" The AI mediation layer is now part of your developer experience whether you built it or not. Then time to first successful API call, decomposed by path: working alone, using general AI tools, or using your agent skills. The delta between those paths is the ROI measurement for your entire agent-experience (AX) investment. Finally, community self-sufficiency rate: what percentage of questions get answered by other community members (tag answerer role in your forum or Discord and track accepted answers from non-staff)? Trending up means the community is retaining expertise, and that's the metric that tells you whether you have a community or an audience.

---

## You'll have to build the instruments

Here's the honest catch: almost none of the citation and agent-activation metrics exist in standard DevRel tooling. Citation rate is a manual test. Answer accuracy is manual review. Agent-initiated integration tracking requires your own instrumentation, and skill install telemetry barely exists.

This is the same position SEO was in before analytics tooling matured, and the lesson transfers. The teams that built their own tracking first had the data advantage for years. A spreadsheet and a monthly hour of citation testing beats a polished dashboard of metrics that stopped meaning anything.

A workable cadence: weekly for AI referrer sessions, package downloads, and skill installs; monthly for the 20-query citation test, integration completion rate, and developer NPS; quarterly for production deployment rate, agent-initiated percentage, community self-sufficiency, and an AI answer accuracy audit.

Not everything changed. Time to first API call, integration completion, and production deployment are still valid and still behavior, so keep them. The mistake isn't measuring the old survivors. It's measuring only them while the first touchpoint of your developer experience moved somewhere your dashboard has never looked.

Your leadership will still ask about stars. Put them in the deck. But next to them, put the citation rate, because when the board asks "are developers finding us?", one of those numbers answers the question as it's actually being asked in 2026. The other is macaroni art.

---

*Part 6 of 9 in the Developer Relations in the Age of AI series.*

*← Previous: DevRel Is Distribution Work · Next: Evaluate Your DevRel Program Like an Agentic Workflow → · ← All articles*
