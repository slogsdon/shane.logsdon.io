# Blog Pipeline Quality (Strictly Local) — Design (Sub-project B)

**Date:** 2026-05-30
**Status:** Draft for review
**Scope:** Sub-project B of the two-part effort. A = reliability + source-of-truth (shipped). B = writing/output quality, **strictly local** (this doc).

## Context

Sub-project A is deployed: the three Windmill flows are hardened (retries, validation
gate, alerts, secrets), git-backed, and the judge-pipeline now runs the **v4 brief-driven
redesign with fact-check live**. Generation stays **strictly local** — LLM calls route
through the LiteLLM proxy on the Mac mini; no cloud models (owner's standing constraint,
reaffirmed during A's brainstorming).

This sub-project raises the quality and factual reliability of published posts **within
local-model limits**, fixing concrete defects the audit surfaced in `otel-local-ai`
(creation engine) and `blog-publisher` (publish-side artifacts). It does **not** revisit
reliability (done in A) and does **not** introduce cloud models.

Source of truth for flow changes is `~/Code/windmill-workspace` (deploy via `wmill sync
push`). Engine code lives in `~/Code/otel-local-ai`; publish-side code in
`~/Code/blog-publisher`.

### Key constraint the design must respect
Local judge models (granite4.1:8b, lfm2:24b, deepseek-r1:14b) **cannot reliably quote a
source verbatim** — the Python evidence verifier flips ~all their citations to
`evidence-fabricated`. So "better fact-check" cannot mean "trust the model's citations";
it must mean **stronger deterministic (Python) verification** plus using the model only
for what it's good at (flagging suspect claims, not proving them).

## Goals / Non-goals

**Goals:** (1) make fact-check actually protective; (2) make the publish gate trustworthy
without relying on a weak model; (3) fix judge-loop correctness bugs; (4) enforce
brief-driven structure; (5) improve humanize/teaser output; (6) maintainability cleanup;
(7) optional lightweight eval to measure deltas.

**Non-goals:** cloud models of any kind; reliability/orchestration (done in A);
re-architecting the v4 creation flow; SEO/AEO content strategy.

## Components

### B1 — Fact-check that actually protects (strictly local)
- Promote accuracy from **advisory → gating**: a post cannot pass the gate while
  confirmed-unsupported claims remain after the one re-revise pass.
- Strengthen the **Python** evidence verifier (`verify_claim_evidence`): better claim
  extraction, normalized substring + light fuzzy match against the brief, and only
  surface **high-confidence** "unsupported" findings (suppress the noise that makes the
  axis read 0/10). Stop feeding low-confidence accuracy notes into `revise_prompt()` as
  imperatives (they cause the writer to delete valid claims).
- **Open decision (D1):** how hard accuracy gates — block on *any* confirmed-unsupported
  claim, or block only above a small tolerance. Default proposal: block on any claim the
  Python verifier is confident is unsupported; treat low-confidence as advisory.

### B2 — Trustworthy gate via a Python decision (demote the weak model)
- Replace the lfm2 gate's *gestalt verdict* as the decider with a **Python decision
  tree**: `publishable = all SCORED_AXES ≥ threshold AND no confirmed fact offenders AND
  no hard anti-pattern hits`. Keep the LLM gate output as advisory commentary only.
- Removes the current need for the "gate-vs-per-axis >2 disagreement" override (the
  override exists because the gate model is unreliable).
- **Open decision (D2):** the per-axis threshold (current target 30/40 total). Default:
  each scored axis ≥ 7/10 AND total ≥ 32/40.

### B3 — Judge-loop correctness fixes (from the engine audit)
- `extract_json`: use `JSONDecoder().raw_decode()` from the first `{` (first complete
  object), not `find/rfind` brace-span (which can grab a trailing object).
- Best-draft tie-breaker: `max(key=(total, round_n))` — prefer the later round on ties.
- Plateau: track all-time best; stop when current < best for K rounds (don't chase a peak
  already passed).
- Post-revision **length-floor validation**: if a revision drops below the floor, re-judge
  with a "substitute, don't delete" instruction instead of silently accepting.
- Accuracy display: move the advisory caveat **above** the 0/10 score; add `is_advisory`
  to `iterations.json`.

### B4 — Brief-driven prompt enforcement (fits v4's brief design)
- Parse optional `[ANGLE]` and `[SECTIONS]` blocks from the brief; inject as hard
  constraints into `cold_draft_prompt()` and the structure-judge prompt ("you chose angle
  X; cover sections …; close by reframing the angle").
- Goal: fewer iteration rounds, posts that hit the brief's intended arc.

### B5 — Publish-side artifact quality (blog-publisher)
- **Humanize:** read the teaser excerpt from the *humanized* article (not the raw body);
  consolidate the duplicated humanize rules shared by `prompts/publish/humanize.md` and
  `prompts/social/generate.md` into one included fragment; add a post-humanize check that
  the edit categories were actually applied.
- **Teasers/LinkedIn:** require a `<!-- COMPANION TEXT: … -->` block in the artifact
  (fail if absent) so initial LinkedIn posts are insight-led, not generic; have the
  hero/LinkedIn generators emit a one-line archetype rationale.
- **Model routing (D3):** assess whether the publish-side `writing` alias should differ
  from the draft/revise aliases. (Local only.)

### B6 — Maintainability cleanup
- De-duplicate the SSH key-file boilerplate across inline scripts (a single sourced helper
  on the mini, or a documented snippet) — reduces the 24-copy maintenance risk.
- Shared frontmatter parser in `blog-publisher/lib` (used by check.sh, find-due-drafts,
  validate-publish).
- Remove orphaned `process_teasers.py` / `processed_teasers.py`; clean the stale
  `otel-local-ai/.claude/worktrees/*`.
- Document the `articles-list.json` schema + article frontmatter spec (a `schema.json`
  + a short `ARTICLE_FRONTMATTER.md`).

### B7 — Measurement (optional, recommended)
- A lightweight eval over the last N posts (reuse `otel-local-ai/eval/`): score voice /
  structure / anti-patterns and fact-offender counts before vs after B's changes, so
  quality claims are measured, not asserted. **Open decision (D4):** do B7 now or after
  B1–B5.

## Open decisions to confirm (defaults proposed above)
- **D1** accuracy gate hardness · **D2** axis thresholds · **D3** judge/gate model routing
  within local options (keep current, or route judge/gate through a stronger local model
  e.g. `quality`/qwen3.6:35b-mlx, accepting slower runs) · **D4** eval now vs later.

## Testing / measurement
- Unit tests for the Python changes (extract_json, tie-break, plateau, length-floor,
  evidence verifier) in `otel-local-ai`.
- Fixture briefs to exercise `[ANGLE]`/`[SECTIONS]` enforcement.
- B7 eval (if chosen) as the end-to-end quality signal across real posts.
- Each engine change validated by a real judge-pipeline run (human-gated) before deploy.

## Rollout
B3 (judge correctness, low-risk) → B2 (Python gate) → B1 (fact-check gating) → B4
(brief prompts) → B5 (publish artifacts) → B6 (cleanup) → B7 (eval). Engine changes ship
as commits in `otel-local-ai`; any flow-shape change deploys via `wmill sync push` from
`windmill-workspace`.

## Risks
- Making accuracy gating could **block publishes** if local fact-check is noisy — mitigated
  by gating only on high-confidence Python findings (D1) and the re-revise pass.
- A stronger local judge/gate model (D3) lengthens runs — judge is manual/human-gated, so
  acceptable; measure with B7.
- Prompt/rubric changes can regress voice — B7 eval is the guardrail.

## Repos touched
`~/Code/otel-local-ai` (judge_pipeline.py, prompts, stages, eval), `~/Code/blog-publisher`
(humanize/teaser phases, prompts, lib, cleanup), `~/Code/windmill-workspace` (only if a
flow's shape changes), `~/Code/shane.logsdon.io` (schema docs).
