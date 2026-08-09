---
title: AEO Is DevRel Infrastructure (And Nobody Owns It)
date: 2026-07-29
modified: 2026-08-09
layout: partials::layouts/writing-post
slug: aeo-is-devrel-infrastructure
faqs:
- q: What is AEO, and how is it different for developer tools than for local businesses?
  a: 'The five structural signals I''ve written about for local businesses (FAQ schema,
    Quick Answer blocks, llms.txt, open crawler access, extractable content) apply
    unchanged. What''s different is the second surface: a coding agent working autonomously,
    not a human asking an AI, is often the one reading your docs.'
- q: What did the audit of Stripe, Clerk, and Neon find?
  a: 'As of the May 2026 audit: all three have shipped an llms.txt, and none has an
    explicit AI crawler policy in robots.txt. Neon''s is the most sophisticated of
    the three, naming AI builders as an audience and covering MCP integrations and
    agent tooling directly. Updated August 2026: a re-audit found all three now
    declare an AI crawler policy via Content-Signal, and Clerk additionally blocks
    extract-only crawlers such as CCBot and Bytespider by name. The finding about
    Neon still holds.'
- q: What is the six-layer AEO stack, and how far along are these companies?
  a: 'It''s Addy Osmani''s framework: crawler access, llms.txt, skill.md manifests,
    content formatting, token surfacing, and copy-for-AI buttons. Stripe, Clerk, and
    Neon, the best in the category, are two layers into six. Updated August 2026:
    they are now roughly five of six. All three shipped skill manifests, markdown
    twins, and copy-for-AI affordances between May and August. Token surfacing is
    the one layer still missing everywhere.'
- q: Why should DevRel own AEO instead of SEO, IT, or the docs team?
  a: Because nobody else does. DevRel already has every input this work needs, from
    what developers actually ask to what context an agent needs to use a tool correctly,
    and how trust spreads through a developer community. The barrier is framing, not
    capability.
- q: How do I check where my own product stands?
  a: Ask ChatGPT, Perplexity, Claude, and Gemini what someone should use for your
    product's core use case, without naming your product. Count how many mention you.
    I ran that test on my own site and got zero.
image: aeo-is-devrel-infrastructure-og.png
heroImage: aeo-is-devrel-infrastructure-hero.png
---

*Answer engine optimization (FAQ schema, llms.txt, structured content, agent-facing signals) is DevRel infrastructure, not a content chore, and at most developer-tool companies nobody owns it yet. DevRel is the function best positioned to claim it.*

> **Update — 9 August 2026.** I re-ran this audit against the same six-layer stack. The headline finding below is no longer true: Stripe, Clerk, and Neon have each closed three more layers since May. The original text is preserved throughout for the record, with inline update notes marking what changed.
>
> | Layer | May 2026 | August 2026 |
> |---|---|---|
> | 1. Crawler access | no explicit policy | all three declare `Content-Signal` |
> | 2. llms.txt | all three | all three, now with per-section indexes |
> | 3. Skill manifests | absent | all three ship one |
> | 4. Content formatting | absent | `.md` twin on every page |
> | 5. Token surfacing | absent | **still absent everywhere** |
> | 6. Copy-for-AI | absent | all three |
> | **Total** | **2 of 6** | **~5 of 6** |
>
> One caveat worth naming, since it cuts against me: this piece published on 29 July but reported a May audit, so it was already two months behind its subject on the day it shipped. That lag is itself part of the argument — this layer is moving faster than the writing about it.

In May I audited three developer-tool documentation sites (Stripe, Clerk, and Neon), looking for the structural signals that determine whether AI assistants can find, extract, and cite their content. I picked those three because they're the sites everyone in DevRel points at when they mean documentation done right.

All three have an llms.txt. None of them have an explicit AI crawler policy in robots.txt. The differences between the three turned out to be more instructive than the similarities.

> **Update, August 2026:** the second sentence no longer holds. All three now carry `Content-Signal: ai-train=yes, search=yes, ai-input=yes` in robots.txt. Clerk goes furthest, blocking CCBot, Bytespider, YouBot, and Cohere-ai by name under a comment that distinguishes extract-only crawlers from the ones that cite and refer. Worth noting how it closed: Cloudflare shipping `Content-Signal` as a managed default did more in one quarter than the advocacy did.

Stripe's llms.txt reads like a product catalog. It's comprehensive and organized by product line, with use cases relegated to a secondary Solutions section, so a developer asking an AI "how do I handle subscriptions?" mostly needs the model to infer the mapping from catalog to use case. Clerk's is indexed by use case and framed educationally, with framework-specific content that lets an AI answer "how do I add auth to my Next.js app?" with Clerk specifically. Neon's is the most sophisticated of the three. It explicitly names AI builders as an audience and covers MCP integrations, pgvector, and agent tooling. It's written for the machine that reads it.

> **Update, August 2026:** the Neon assessment holds and has widened — its llms.txt now leads with a "Common Queries" section ahead of the product tree, and tells agents outright to append `.md` to any doc URL or send `Accept: text/markdown`. The Stripe characterisation is now incomplete rather than wrong: `stripe.com/llms.txt` is still a product catalog, but there is a second, larger file at `docs.stripe.com/llms.txt` that opens with a section headed "Instructions for Large Language Model Agents."

Here's the context that reframes the whole audit. Across nearly 300,000 domains SE Ranking analyzed, only about one in ten has *any* llms.txt. Set a stricter bar and the number drops further: among the top 10,000 sites, [barely 6% have a *valid, well-formed* one](https://caseyrb.com/blog/state-of-llms-txt-adoption/) as of mid-2026 (a different study, counting a different thing). Almost nobody has started. But the companies you actually benchmark against have: all three sites I audited shipped one. If you've been waiting to see whether this matters, they've already answered.

---

## If you've read my local business AEO work, I won't repeat it

I've [written elsewhere about answer engine optimization (AEO) for local businesses](https://shane.logsdon.io/articles/strategic-insights/what-aeo-actually-means-for-a-local-business/): the five structural signals (FAQ schema, Quick Answer blocks, llms.txt, open crawler access, extractable content) that determine whether an AI recommends you. Those signals apply to developer tools unchanged, so I won't re-teach them here.

What changes for developer tools is everything else. The query is "what should I use for serverless Postgres?" instead of "best plumber near me." The stakes are a competitor getting embedded in agent defaults. The part with no local-business equivalent at all is the second surface, where the consumer of your content isn't a human asking an AI but a coding agent working autonomously. That second surface is where the infrastructure framing earns its name.

---

## The stack, and how much of it is missing

The most complete framework I've found so far for the agent-facing layer is [Addy Osmani's six-layer stack](https://addyosmani.com/blog/agentic-engine-optimization/) for what he calls Agentic Engine Optimization (the agent-facing sibling of the answer-facing AEO above, confusingly abbreviated the same way):

1. robots.txt access control
2. llms.txt discovery
3. skill.md capability signaling (a machine-readable manifest telling an agent what your tool can do and how to call it)
4. Content formatting: markdown, heading hierarchies, parameter tables
5. Token surfacing: publishing page token counts as metadata
6. "Copy for AI" buttons: clean markdown for context inclusion

Here's what my audit found: layers 3 through 6 were absent from all three sites. Stripe, Clerk, and Neon, the top of the market, are two layers into a six-layer stack. The field is that early. Your gap to the leaders is measured in months, not years.

> **Update, August 2026:** this is the paragraph the re-audit overturned. Layers 3, 4, and 6 are now present on all three sites. Stripe ships a `.well-known/skills/index.json` declaring seven agent skills, plus first-party plugins for Claude Code, Codex, and Cursor. Clerk ships a `SKILL.md` with a full CLI runbook. Neon ships a hierarchical `skill.md` that loads a parent skill, alongside a 6.2 MB `llms-full.txt`. Every one of the three now serves a `.md` twin for every docs page, and all three have a copy or ask-AI affordance in the docs chrome.
>
> Layer 5 is the exception, and it has not moved at all: not one of the five sites I re-audited publishes a token count, and Stripe and Neon publish no dates whatsoever — no `article:modified_time`, no sitemap `lastmod` across thousands of URLs. A model cannot tell whether any of it is current.
>
> "Two layers into six" became roughly five of six in about three months. That is a shorter window than "months, not years" implied, and if you were using this piece as a gap estimate, revise it down.

---

## Why this lands on DevRel

I went looking for DevRel teams writing about this work and found something strange: nobody is. Stripe, Clerk, and Neon built their llms.txt files silently, with no posts about who owns the work or why. Trade press has started discussing "AI DevRel manager" roles, but I couldn't find a single published example of a DevRel team claiming AEO as theirs.

> **Update, August 2026:** the silence broke, partly. Clerk has since published *Clerk for the AI era*, *Introducing Clerk CLI*, and a Series C announcement centred on agent identity; Stripe ships a public skills install page documenting how to add its skills to three different agent harnesses. These companies are talking about agent-facing work openly now. What I still could not find is a DevRel team framing it as their mandate — the narrower claim stands.

The organizational reality explains the silence. Look at who owns each signal in a typical dev-tool company:

| Signal | Typical owner | What actually happens |
|--------|---------------|----------------------|
| FAQ schema / JSON-LD | SEO team, if one exists | Not in DevRel purview; doesn't get done |
| llms.txt | Nobody | New artifact, no owner |
| robots.txt AI crawler access | IT / Infra | Treated as a security setting, not distribution |
| Agent skills library | Nobody | No standard owner; someone has to invent the mandate |
| Citation monitoring | Nobody | No tooling in the standard DevRel stack |
| Structured API reference | Docs team | LLM-readability isn't on their criteria list |

The work falls between teams, so it mostly doesn't happen. DevRel is better positioned to own it than any other function, because every input to the work is something DevRel already knows. What developers actually ask becomes the FAQ schema. What context an agent needs to use the tool correctly becomes the skills library. How products actually spread through developer communities becomes the trust signals AI assistants weight.

> **Update, August 2026:** the table still describes the gaps correctly, but the re-audit changed my view of the mechanism, and this is the part I'd write differently now. The layers that closed did not close because DevRel claimed them. Layer 1 closed because Cloudflare made `Content-Signal` a managed default. Layers 2, 4, and 6 closed because docs platforms shipped them as platform features — no docs team decided this. Layer 3 closed because all three companies ship a CLI or an MCP server, so the skill manifest attached itself to a product team that already had a mandate.
>
> The layers still open are exactly the ones with no vendor default and no adjacent owner: token metadata, JSON-LD at dev-tool companies (Stripe's docs pages emit none at all, while a one-person site out-schemas all three), and citation monitoring. "Nobody owns it" was right, but the useful version is sharper. The question is not who *should* own the work. It is whether the work can attach to an owner who already exists, or has to wait for a vendor to default it. DevRel's real opening is the second category, and it is smaller and more urgent than this piece originally implied.

The barrier isn't capability. It's framing. Most DevRel teams still think of themselves as producing content, meaning posts, talks, and sample projects. AEO is infrastructure work that happens to produce content artifacts. Until a DevRel team makes that mental shift, the work has no home.

---

## The baseline test

I ran a citation baseline on my own site earlier this year and got 0% on service queries and 100% on branded queries. Every AI assistant knew who I was when asked by name. None of them recommended me when asked what I do. That gap exists because the site was written for humans reading top to bottom.

The same test applies to your product, and it costs nothing. Ask ChatGPT, Perplexity, Claude, and Gemini: "what should I use for [your product's core use case]?" Not your product name, the use case. Count how many answers include you. That number is your baseline, and my bet is that nobody at your company has ever measured it.

Run the test. If you're in the answers, find out which content is earning the citations and protect it. If you're not, you have a rare thing in DevRel: a gap that's measurable, fixable with known techniques, and invisible so far to your competitors, nine in ten of whom haven't started.

---

*Part 2 of 9 in the Developer Relations in the Age of AI series.*

*← Previous: The Split Audience · Next: The 25% That AI Can't Do → · ← All articles*
