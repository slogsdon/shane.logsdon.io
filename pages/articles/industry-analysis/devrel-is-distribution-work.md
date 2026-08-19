---
title: DevRel Is Distribution Work. Neon Just Proved What It's Worth.
date: 2026-08-19
layout: partials::layouts/writing-post
slug: devrel-is-distribution-work
description: Neon hit 80% AI-agent-provisioned databases, and Databricks paid about
  a billion dollars for it. Here's what that acquisition proves about DevRel, the
  new AI-citation node in the old flywheel, and why agent skills are becoming the
  new SDK.
faqs:
- q: What did Neon's 80% AI-agent-provisioned number actually prove?
  a: That being the default database an AI coding agent reaches for is now valuable
    enough to build an acquisition premium on. Databricks said so directly in its
    own announcement.
- q: Did AI break the old Code → Content → Community flywheel?
  a: No. It added a node. Content now often reaches an AI citation before it reaches
    a human, and that citation is starting to drive adoption on its own.
- q: What's an agent skill, and why does it matter for DevRel?
  a: A small, installable context package that teaches a coding agent how your product
    works. Every PR an agent instruments correctly turns into revenue you didn't have
    to sell for, and every install becomes a stealth distribution channel.
- q: How much time is left before this advantage closes?
  a: Less than it took in other markets. Local-business AI search took 12 to 18 months
    to consolidate. Developer tools are moving faster, because the elite tier of Stripe,
    Clerk, and Neon already built the base layer, and one of them just got acquired
    for it. Supabase already responded by bringing in BKND.
image: devrel-is-distribution-work-og.png
heroImage: devrel-is-distribution-work-hero.png
---

*Neon reached 80% AI-agent-provisioned databases and Databricks paid about $1B for it: proof that DevRel is distribution work. The old Code → Content → Community flywheel gained an AI-citation node, and agent skills are the new SDK.*

When Neon hit general availability, about 30% of the databases on the platform were being created by AI agents rather than humans. By the time Databricks acquired them, the number was 80%. Databricks paid roughly a billion dollars, and [their stated rationale](https://www.databricks.com/blog/databricks-neon) leaned directly on that statistic as evidence of "explosively growing agentic workloads."

Sit with the mechanism for a second. Neon invested early in agent-native distribution: AI rules files, Claude Code plugins, Cursor integrations, and a public agent skills library. That work made Neon the default answer when a coding agent needed a Postgres database. Being the agent's default became the majority of their growth, and the growth became the acquisition premium.

That's a DevRel story. It's arguably the most financially consequential DevRel story ever told, and it happened without a conference talk, a blog series, or a community program anywhere in the causal chain.

---

## The flywheel didn't break. It got a new node.

The flywheel I've run my own advocacy work on for years is Code → Content → Community. Working code becomes content. Content attracts community. Community feeds back signal about what to build next. When advocacy feels hollow, I diagnose which link is broken.

What AI changed isn't the flywheel's logic. It's the path between nodes. There's a new node between Content and Community now: AI citation. When an assistant recommends your product in response to a developer's question, that citation is word-of-mouth at scale: it earns the same trust a community referral used to, and that trust is what drives adoption, without the developer ever finding your content through search or social. So the main road is now Content → AI Citation → Adoption, where Adoption is the outcome Community was always a proxy for. Content that isn't structured for citation doesn't fire that new node, which is why teams see their content producing less community than it used to, with nothing in their metrics explaining why.

The channel is measurably real. AI platforms sent about [1.13 billion referrals to the top 1,000 websites in June 2025, up 357% year over year](https://techcrunch.com/2025/07/25/ai-referrals-to-top-websites-were-up-357-year-over-year-in-june-reaching-1-13b/), and AI-referred visitors [convert at roughly 4.4 times the rate](https://www.semrush.com/blog/ai-search-seo-traffic-study/) of standard organic search. Higher intent and faster growth, and most of it invisible in the dashboards DevRel teams report from.

Neon's number says something stronger than "there's a new referral channel," though. For most tools today the new node augments the old flywheel; at the leading edge it starts to replace the human path outright. At 80% agent-provisioned, Neon's flywheel isn't amplified. It's bypassed. The agent doesn't read your blog or join your Discord, and it has never attended a talk. It reads your integration surface and provisions the database. That's adoption without a single human touchpoint in the loop, the far end of the same dial, arriving early.

---

## Agent skills are the new SDK

The deepest version of this is the agent skill: a small, installable context package that teaches a coding agent how your tool works, what patterns to follow, and what mistakes to avoid. One install, and every agent-assisted PR in that codebase carries opinionated knowledge of your product. [One essay on the topic](https://www.battery.com/blog/agent-skills-are-the-new-sdk-and-you-should-be-building-one/) called it "a 10x solutions engineer for every single customer account, one that works on every PR, never goes on vacation, and never forgets the naming convention."

Product-led growth optimized the first five minutes, and Stripe's seven-line integration and Twilio's copy-paste quickstart won that era. Skills solve the second distribution problem: getting your tool instrumented correctly across an entire organization, forever. For usage-priced infrastructure that's revenue mechanics rather than marketing. As a first approximation, an account at 20% instrumentation coverage is leaving most of its potential billing on the table, and every PR the agent instruments correctly is incremental ARR without a new logo or a sales motion.

Skills are also a viral discovery channel that didn't exist before. A developer joins a team, opens their coding agent, and the agent surfaces the tools the organization already uses. Not through Slack or a wiki. Through context. Your installed base recruits for you.

---

## DevRel has always been distribution. Now it's legible.

DevRel has fought a losing battle for years over proving its pipeline contribution. [Mary Thengvall](https://www.marythengvall.com/devrelbook) built the "DevRel Qualified Leads" framework largely because the function's real influence on adoption was structurally invisible to attribution systems. Awareness compounded through talks and community into adoption nobody could trace.

Agent-mediated distribution flips that. Citation rates can be tested. Skill installs can be counted. Agent-provisioned signups can be instrumented, and Neon literally reported the percentage. The distribution work DevRel always did on faith is becoming distribution work you can put on a dashboard. That's an enormous political gift to every DevRel leader who's ever defended a headcount, and it comes with an obligation: if the impact is now measurable, you have to actually build the things that get measured.

That means the DevRel roadmap grows some unfamiliar line items: an agent skills library maintained with the same seriousness as an SDK, LLM context files treated as first-class deliverables, and citation monitoring as a standing program. I've made LLM context files an explicit OKR deliverable in my own advocacy work this year, not because it's fashionable but because that's the artifact the actual distribution channel consumes.

One warning about the window. From tracking the same first-mover dynamic in [local-business AEO](https://shane.logsdon.io/articles/strategic-insights/what-aeo-actually-means-for-a-local-business/), I estimate a 12 to 18 month gap there. For developer tools the window is shorter, because the elite tier of Stripe, Clerk, and Neon has already built the base layer, and one of them already got acquired for it. The advantage compounds with time spent in the agent's defaults. Supabase responded within months by [bringing in BKND](https://supabase.com/blog/bknd-joins-supabase) to build a lite backend offering for agentic workloads. The market is telling you what it thinks embedding in agent workflows is worth.

---

*Part 5 of 9 in the Developer Relations in the Age of AI series.*

*← Previous: Witnessed Practice Is the New Tutorial · Next: What Do We Measure? → · ← All articles*
