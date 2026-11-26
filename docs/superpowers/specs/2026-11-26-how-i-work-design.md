# How I work — proposed section

Status: copy and design approved by Shane on 2026-11-26; implemented and locally verified.
Audience: hiring managers and engineering leaders, confirmed by Shane on 2026-11-26.

## Intent and scope

Help someone evaluating Shane for a product or engineering leadership role understand
how he makes decisions, translates them into working software, and works with people.
Use concrete operating choices and experience rather than a generic leadership manifesto.

Assumption: “section” means one substantial `/how-i-work/` page, discoverable from
About and the footer. If a larger library is intended, this page becomes its overview;
individual practice pages need their own substantive material before being added.

### Approaches considered

| Approach | Tradeoff | Recommendation |
| --- | --- | --- |
| Expand About with the full material | Easy to discover, but buries biography and makes both jobs harder to scan | Keep a short introduction and link there |
| One dedicated reference page | Gives readers a coherent account of product, engineering, and collaboration, with direct section links | Proposed |
| A practice library like the reference site | Supports depth, but would require substantial additional writing and creates pressure to invent standardized processes | Defer until real material warrants it |

### Architecture and navigation

**C · Sheet**, selected by Q3: “Will the page be revised over time, so that which
version you're reading matters?” These are current working principles, and a hiring
decision could rely on an outdated version. The earlier questions are no: this is
neither the site's entry point, a catalog, nor a sequence of dependent steps.

Use the existing `main` layout, Sheet field, typographic tokens, and title-block
partial. Give the four sections ordinary headings and anchor links, without numbered
steps or nested architectures. No figure is required by this content. Primary
navigation remains About · Articles · Speaking · Work · Resume.

Proposed reading order:

```text
How I work
Product judgment. Engineering discipline.
Short experience-led introduction
Principles · Product practice · Engineering practice · Working together

Principles             Six beliefs with practical consequences
Product practice       Framing, adoption, feedback, commercial context
Engineering practice   Contracts, scope, verification, operations, automation
Working together       Context, autonomy, written decisions, direct feedback

Selected writing and experience
Existing revision/date title block
Existing site footer
```

## Proposed website copy

The text below is proposed first-person copy, synthesized from the sources at the
end. It is not a claim that Shane has approved this wording. Past accomplishments
come from existing site content; metrics are deliberately omitted rather than
reverified from private employment records. Private working notes inform phrasing
and preferences, not public claims about current employers, customers, or revenue.

---

# How I work

## Product judgment. Engineering discipline.

I've been the developer writing the SDK, the architect helping a partner integrate,
and the product leader deciding what the platform should make possible. Moving
between those jobs taught me to follow a decision all the way through: from the
problem someone has to the software they use and the result it produces.

My experience spans payment platforms, developer tools, and building LeadSurface.
These are the principles I bring to that work, the practices behind them, and what
you can expect when we work together. They evolve as I learn.

## Principles

### Start with the problem worth solving

Before choosing an approach, I want to know who's struggling, what they're trying
to accomplish, and how they're getting around the problem today. A request is useful
evidence, but it still needs interpretation. Sometimes the right response is a
smaller change. Sometimes it's a different problem. Being able to build something
well is a reason to be more careful about whether it deserves to exist.

### The interface someone builds against is the product

For a developer platform, the API, SDK, documentation, examples, and support all
shape the experience. A capability isn't useful just because the backend supports
it. Someone has to understand it, integrate it, recover when it fails, and trust it
in production. I treat that whole journey as product work.

### Measure whether the work changed anything

I want to connect what we shipped to what someone can now do. Integration
completion, production use, recurring support problems, and commercial results
answer different questions. The useful measure depends on the decision we're
making. An activity count needs a clear connection to the outcome before it earns
a place in that conversation.

### Build the smallest thing that delivers real value

I prefer a narrow solution that works through the full user journey. Reducing scope
should make it easier to learn and change direction while preserving the soundness
of what ships. Early work can be manual and the finish can improve later. Data
integrity, understandable failure, and the ability to use the product still matter.

### Let the stakes set the process

A copy change and a payment flow deserve different levels of scrutiny. I scale
planning, review, testing, and rollout to the consequences of being wrong and how
easily we can recover. Reversible decisions should move quickly. Decisions involving
money, access, or customer data need more evidence before they reach users.

### Keep judgment with the person accountable

AI is part of how I build. I use it to carry context and execute repeatable work,
with explicit points where I review the direction, architecture, evidence, cost,
and remaining risk. Those decisions stay mine. Faster implementation makes a clear
problem statement and a credible verification process more valuable.

## Product practice

### Make the outcome clear before prescribing the solution

I write down who the work serves, the problem, the constraints, and what success
would look like. That gives product and engineering something concrete to challenge
and improve together. It also leaves room for someone closer to the implementation
to find a better approach.

### Follow the adoption journey into production

In payments, a successful sample request is an early milestone. I care about what
happens between that moment and a working integration: confusing contracts,
environment setup, edge cases, support handoffs, and the confidence to go live.
My work at Global Payments included SDKs, sample projects, sandbox experiences,
and support practices because each affects whether the platform gets used.

### Bring support and customer evidence into prioritization

A recurring integration issue can reveal a product gap, a documentation problem,
or an abstraction that asks too much of its users. I want those signals visible
alongside usage and business results. At Global Payments, I brought support,
product, and community signals into reporting that connected developer pain to
roadmap decisions.

### Stay close enough to learn

Building LeadSurface keeps the distance between a customer conversation and an
implementation decision short. I want that contact to change what I build. When
the problem is still uncertain, direct involvement is valuable; automating the
interaction too early can remove the part that teaches me what matters.

## Engineering practice

### Make contracts clear and failures useful

Working across SDKs in multiple languages made consistency a practical concern.
Names, defaults, errors, and examples should help developers form an accurate
mental model. I pay particular attention to where a payment or integration behaves
differently from the happy path, because those are the places people need the most
help understanding what happened and what to do next.

### Keep changes small enough to understand

I prefer existing patterns and platform capabilities before adding another layer.
Changes should be focused enough to review and leave the next person able to
understand the reasoning. Additional machinery needs a present problem to justify
its maintenance cost.

### Match the evidence to the claim

A passing unit test, a browser check, and a production observation each prove
something different. I want to know which behavior was exercised, what would catch
a regression, and what remains unverified. “Done” includes a result the next person
can use and an explanation they can act on.

### Treat operation as part of delivery

The work includes how we diagnose failures, support the integration, and recover
when something goes wrong. My experience with technical escalations and developer
support informs what I ask for during design: useful errors, repeatable diagnostics,
and documentation that survives the handoff.

### Automate repeatable work with explicit boundaries

My Loop & Gate workflow separates execution from the decisions that require my
judgment. Written context carries across sessions; focused verification checks the
result. The amount of process still depends on the change. A workflow earns its
keep when it helps deliver the right thing reliably.

## Working together

I default to written context and asynchronous communication. A complete message
helps people respond with the whole situation in view; a meeting should have a
clear decision to make. When we decide something together, I want the reasoning
recorded so the next conversation can build on it.

Once the goal and constraints are clear, I value autonomy over the approach. I'll
challenge scope and assumptions, and I want people working with me to do the same.
A specific concern or counterproposal gives us something we can resolve. A better
argument should change the direction, including when the original idea was mine.

Feedback works best when it's direct, timely, and specific about the impact. If
something is blocked or the assumptions changed, I'd rather hear early while we
can still adjust.

I'm still working on staying in validation longer before switching into build
mode, and on delegating work that I could finish faster myself. Being able to
solve the immediate problem is useful; helping someone else build that capability
matters too.

## See the work behind it

- [Experience and responsibilities](/resume/)
- [Selected projects](/work/)
- [Building on the Margins](/articles/strategic-insights/building-on-the-margins/)
- [What Do We Measure When AI Answers the Questions?](/articles/strategic-insights/what-do-we-measure/)
- [The 25% That AI Can't Do](/articles/leadership-and-management/the-25-percent-that-ai-cant-do/)

---

## Proposed About introduction

**How I work**

My approach connects product decisions to the engineering work and evidence behind
them. Read the principles, practices, and working habits I've developed across
payments, developer platforms, and building my own products.

Link label: **Read how I work →**. Destination: `/how-i-work/`.

## Implementation boundary after approval

| Path | Proposed change |
| --- | --- |
| `pages/how-i-work.php` | New static Sheet page with page metadata, four section anchors, sources, title block, revision fallback 1 and reviewed content date |
| `pages/about.php` | Add the short introduction and link using existing Sheet typography |
| `resources/partials/components/footer.php` | Add a secondary “how I work” link |
| `design/shane-personal-v2/DESIGN.md` | Add the new page type to the architecture mapping, citing Q3 |
| `README.md` | Document the page's purpose and the content-review location |
| `TASKS.md` | Track this work separately from the existing microsite effort |

Reuse existing layout, title block, and Tailwind classes. No new dependencies,
components, custom JavaScript, diagrams, article-index entries, or prescribed hiring
and performance-management policies. The sitemap generator discovers built pages;
verify the emitted URL instead of adding a manual route registry.

Validation after implementation: PHP lint for touched PHP; CSS and site builds;
inspect `dist/how-i-work/index.html`, canonical URL, metadata, section anchors,
About/footer links, rendered revision/date, and generated sitemap. Check desktop
and mobile layout and keyboard navigation in a browser. Build results and browser
results must be reported separately. Do not send IndexNow notices or deploy.

Commit proposal after implementation and review:
`content: add product and engineering working principles`.
Stage only the enumerated changed paths after stating their scope; present the
staged diff and message for approval before committing. No commit or push is
authorized by this draft.

## Editorial evidence and boundaries

Sources read on 2026-11-26:

| Source | Supports | Limits |
| --- | --- | --- |
| [Adam Michaelson — Product](https://adam-michaelson.com/product/) | Reference distinction between people, principles, and practices | Structural inspiration only; no adoption of his hiring pipeline, “10x” framing, role model, or calendar |
| `pages/about.php` | Developer interface as product; payments and developer-platform background | Existing self-description, not independently audited employment history |
| `pages/resume.php` | SDK work across six languages; product leadership; support diagnostics; KPI reporting; technical escalations | No new metrics added; no current-employer inference |
| `pages/work.php` | Current public project descriptions and static-site implementation | No time-sensitive customer, revenue, or project-maturity claims copied |
| `pages/articles/strategic-insights/building-on-the-margins.md` | Product/engineering judgment; proportional process; AI boundaries; evidence; LeadSurface feedback loop | Describes the author's workflow; illustrative scenarios remain illustrative |
| `pages/articles/strategic-insights/what-do-we-measure.md` | Behavior, completed integrations, and production adoption as meaningful measures | Third-party statistics and proposed metric cadences omitted |
| `pages/articles/leadership-and-management/the-25-percent-that-ai-cant-do.md` | Architecture reasoning, integration edge cases, and specification quality | No quantitative AI capability claims copied |
| Personal working-preference notes, read through Obsidian CLI | Async communication, autonomy, written decisions, direct feedback, delegation and validation growth areas | Private source titles and links stay off the public page; April 2026 preferences need Shane's wording review |
| `design/shane-personal-v2/DESIGN.md` and shared partials | Architecture, navigation, token and component constraints | Exploration mockups are not design authority |

The known risk for this task is polishing a description of operating habits beyond
what is actually practiced. The copy includes growth areas and cites existing work;
Shane's review is required before treating it as an approved personal statement.
