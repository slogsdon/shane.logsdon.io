# Blog Pipeline Reliability & Source-of-Truth — Design (Sub-project A)

**Date:** 2026-05-28
**Status:** Draft for review
**Scope:** Sub-project A of a two-part effort. A = reliability + source-of-truth (this doc). B = quality, strictly local (separate spec, later).

## Context

The blog creation + publishing pipelines are three Windmill flows in the `personal`
workspace on **mbp.local** (Windmill CE v1.707.0). They are thin SSH wrappers: every
step SSHes from a Windmill worker into the **Mac mini** (`192.168.86.34`, hostname
`mac-mini`) and runs the real logic, which lives in two repos on the mini:

- `~/Code/otel-local-ai` — the LLM **creation** engine (cold-draft → judge loop → fact-check → gate → vault write). Owns `judge-pipeline`.
- `~/Code/blog-publisher` — the 18-phase **publish** engine (stage → register → humanize → imagery → build → commit/push → social). Owns `publish-pipeline` and `vault-check`.

The published site is `~/Code/shane.logsdon.io`, a PHP "flat-file" static builder
deployed via Netlify. LLM calls route through a local LiteLLM proxy
(`http://localhost:4000`); generation stays **strictly local** (project constraint).

```
mbp.local                              mac-mini (192.168.86.34)
┌─────────────────────┐   ssh        ┌──────────────────────────────────────┐
│ Windmill (CE)       │ ───────────► │ otel-local-ai  (judge-pipeline logic)  │
│  judge-pipeline     │              │ blog-publisher (publish/vault logic)   │
│  publish-pipeline   │              │ shane.logsdon.io (site repo → Netlify) │
│  vault-check (9am)  │              │ Ollama + LiteLLM (:4000)               │
│ Langfuse            │              │ Obsidian vault                         │
└─────────────────────┘              └──────────────────────────────────────┘
```

### Verified problems this sub-project fixes

| # | Severity | Problem (verified) |
|---|----------|--------------------|
| 1 | 🔴 critical | Hardcoded Windmill API token in `vault-check` (`wmill_55c1…`), in the live DB **and** committed to git. |
| 2 | 🔴 critical | **Zero retries** on all 26 SSH steps across the 3 flows — one transient SSH/network/Ollama blip kills a multi-hour run. |
| 3 | 🔴 high | **No pre-publish validation** — a malformed `articles-list.json`, missing article file, bad frontmatter, or missing image can break the Netlify build or push a broken article. `commit-push.sh` swallows missing images with `\|\| true`; build has no positive "did this article render?" check. |
| 4 | 🔴 high | **Live judge-pipeline has drifted from git and is missing the `e_factcheck` stage** — fact-check code exists and is committed but is **not running**. No `wmill` CLI, no git-sync; flows live only in Postgres (no backup / no deploy path). |
| 5 | 🟠 high | Arg-quoting bug in `publish-pipeline` steps `c_register`/`d_humanize`/`e_hero_html`/`h_linkedin_html`/`i_screenshot_linkedin`/`j_obsidian`: inner quotes around `$title`/`$description_text` are **not** escaped (unlike `a_stage`) → titles with spaces/quotes/colons mis-parse. |
| 6 | 🟠 high | `register-article.sh` interpolates shell vars into a Python heredoc (`"${TITLE}"`) → a title containing `"`, `\`, `${}`, or a newline corrupts JSON or crashes. |
| 7 | 🟠 high | Silent failures — both `failure_module`s only `echo`; a failed 9am cron run is invisible. |
| 8 | 🟡 med | Non-idempotent steps (Buffer schedule, git commit) → restart-from-step can duplicate posts/commits. |
| 9 | 🟡 med | `find_due_drafts` greps `^publishDate:` across the whole file, not the frontmatter block (comment claims otherwise) → body matches can false-trigger. |
| 10 | 🟡 med | `StrictHostKeyChecking=no` on all SSH calls. |

## Goals / Non-goals

**Goals (A):** Make publishing fail-safe and observable; establish the git repo as the
single source of truth with a real deploy path; eliminate the secret exposure; deploy
the already-written fact-check stage.

**Non-goals (deferred to B):** Writing/output quality (judge rubric, model routing,
prompts, humanize/teaser quality), the weak-gate-model problem, JSON-extraction
robustness in the judge, maintainability cleanup (SSH-boilerplate dedup, schema docs,
orphaned files, stale worktrees). Sub-project A may *touch* these files but only for
reliability; quality changes wait for B's spec.

## Approach decisions (approved)

- **Git-sync layout:** one canonical `~/Code/windmill-workspace` repo synced with the
  `wmill` CLI. Repo = source of truth; `wmill sync push` = deploy. The per-app
  `windmill/flows/*.json` copies in `otel-local-ai`/`blog-publisher` become historical;
  the workspace repo supersedes them (kept or removed in A0, see below).
- **Failure alert transport (local-only):** write a failure note to the Obsidian vault
  via the existing `obsidian-proxy.sh`, plus a structured JSONL line on mbp.local.

## Component design

### A0 — Source of truth via `wmill` git-sync (do first)

1. Install the `wmill` CLI on the mini (`deno install` or `npm i -g windmill-cli`;
   runtimes confirmed present). Authenticate to `http://mbp.local`, workspace `personal`.
2. `git init ~/Code/windmill-workspace`; `wmill workspace add` + `wmill sync pull` to
   materialize the **live** workspace (flows, variables metadata, schedules, resources)
   into the repo. Commit as the **verified baseline** (this captures live truth exactly,
   including the not-yet-rotated token, so the rotation in A1 is provable via diff).
3. **Reconcile drift:** diff the pulled live `judge-pipeline` against
   `otel-local-ai/windmill/flows/judge-pipeline.json` (which has `e_factcheck`).
   Canonicalize the reviewed-correct version (with fact-check) in the workspace repo.
4. From here: edit flows in the workspace repo → `wmill sync push` to deploy. Add a
   `README.md` documenting the pull/push/diff loop and a `bin/verify-sync.sh` that fails
   if live and repo diverge (run after any change).
5. Decommission the per-app flow copies: replace each `*/windmill/flows/*.json` with a
   stub pointer to the workspace repo (avoids re-introducing drift), or remove them.

**Interface:** `wmill sync pull` (DB→repo), `wmill sync push` (repo→DB),
`bin/verify-sync.sh` (assert equal). **Depends on:** Windmill API at `http://mbp.local`,
network mini↔mbp.

### A1 — Secret remediation

1. Create Windmill variable `u/admin/windmill_api_token` (secret).
2. **Rotate:** mint a new Windmill API token, set it as the variable value, verify
   `vault-check` works, then revoke the old token in Windmill.
3. Rewrite `vault-check` step `b_trigger_pipelines` to pass the token via
   `input_transforms` (`variable('u/admin/windmill_api_token')`) instead of the inline
   literal. Confirm no token literal remains in repo or DB (grep).
4. Stop committing the token: the workspace repo stores variables as references, not
   secret values (wmill default). Leave history scrub as an optional follow-up (note it).

### A2 — Retries on transient steps

Add Windmill `retry` to every SSH-based step in all three flows:

```json
"retry": { "exponential": { "attempts": 3, "multiplier": 3, "seconds": 5 } }
```

(≈5s / 15s / 45s.) Applies to all generation/IO SSH steps. **Exceptions** (no retry, or
`attempts: 1`): the new validation gate (A3) and any step whose failure is deterministic
(bad data shouldn't be retried — it should fail fast and alert). Approval/suspend steps
are unaffected. Also raise SSH `ConnectTimeout` 15 → 30s to avoid spurious timeouts on a
loaded mini.

### A3 — Pre-publish validation gate (fail-closed)

New phase script `blog-publisher/bin/phases/validate-publish.sh <slug> <category>`, run
**before** `k_build` and again (post-build) before `m_commit_push`. Two modes:

- `validate-publish.sh pre <slug> <category>`:
  - `articles-list.json` is valid JSON (`python3 -m json.tool` / jq).
  - Article file exists at `pages/articles/<category>/<slug>.md`.
  - `category` ∈ `{industry-analysis, leadership-and-management, strategic-insights, technical-deep-dives}` (from `categories.json`).
  - Frontmatter parses and required fields present and typed: `title` (non-empty),
    `date` (`YYYY-MM-DD`), `slug` (`^[a-z0-9-]+$`, matches path), `description`
    (non-empty), `draft` (bool). Image fields, if present, point to existing files.
  - Referenced images (`<slug>-og.png`, `-hero.png`, `-linkedin.png`) exist in
    `public/images/` and are > 1 KB.
- `validate-publish.sh post <slug> <category>`: after `composer build`, assert the
  rendered article exists and is non-empty in `dist/` (path per builder convention,
  determined during implementation by inspecting a known-good build).

Any failure → exit non-zero with a specific code/message → flow stops **before** push.
Wired into `publish-pipeline` as new steps (e.g., `k0_validate_pre` before `k_build`,
`k2_validate_post` after build, before `m_commit_push`).

### A4 — Harden the write path

- **`register-article.sh`:** pass `slug/title/description/date/category` to Python via
  `sys.argv` (or env) and build the entry with `json.dumps` — no heredoc interpolation.
  Validate category and that the article file exists. Write atomically: write to
  `articles-list.json.tmp`, `json.load`-verify, `os.replace`, under `flock`.
- **Flow arg-quoting:** fix `c_register` et al. Prefer eliminating the SSH-boundary
  quoting problem entirely by passing structured args via a temp file / stdin (the
  pattern `judge-pipeline` already uses for `feedback.txt`), rather than escaping inline.
  Where inline args remain, escape inner quotes consistently like `a_stage`.
- **`commit-push.sh`:** drop `\|\| true` on the article's own images — fail (or loudly
  warn with non-zero) if expected images are absent; add push retry w/ backoff; verify a
  commit was actually created (`git rev-parse HEAD` changed) before reporting success.
- **`find_due_drafts`:** anchor `publishDate` match to the frontmatter block (awk to the
  second `---`); dedupe results by derived slug.

### A5 — Idempotency on re-run

- Buffer scheduling (`schedule-buffer.sh`): before POSTing, check the per-slug state file
  and/or the Buffer pending queue for an existing post with the same text+platform; skip
  if present. Write state atomically (tmp + replace) immediately after each successful
  POST.
- Git steps: treat "nothing to commit" as success, not failure.
- `register-article.sh` already no-ops on existing slug (kept).

Net effect: restarting `publish-pipeline` from a failed step cannot create duplicate
posts/commits/registrations.

### A6 — Failure visibility

Add/replace the `failure_module` on **all three** flows with a small script that, on
failure:
1. Appends a structured line to `/tmp/windmill-failures.jsonl` on mbp
   (`{ts, flow, job_id, step, error}`).
2. SSHes to the mini and calls `obsidian-proxy.sh create` to write a "⚠️ Pipeline
   failure" note (flow, step, error, job link) into the vault, then `commit`s the vault.

`judge-pipeline` and `publish-pipeline` already have echo-only `failure_module`s to
upgrade. **`vault-check` has none** — and it is the scheduled 9am flow, the exact case
that currently fails silently — so it gets a `failure_module` added. A failed run then
surfaces in the vault you already read daily. (SSH key + `obsidian-proxy` already
available to flows.)

### A7 — Deploy the fact-check stage

Via A0's `wmill sync push`, deploy the canonical `judge-pipeline` (with `e_factcheck`) to
live so creation actually runs the fact-check stage. (Behavior change: judge runs are
slightly longer; the stage already exists and is tested in code.) Verify `e_factcheck`
present in live via `wmill sync pull` diff afterward.

### A8 — SSH host-key hardening

On mbp.local: `ssh-keyscan -H 192.168.86.34 >> ~/.ssh/known_hosts` (the Windmill worker's
user). Change `StrictHostKeyChecking=no` → `accept-new` in all flow SSH invocations.

## Data flow (after A)

`vault-check (9am)` → find due drafts (frontmatter-anchored) → trigger `publish-pipeline`
per slug (token from variable). `publish-pipeline`: stage → **validate-pre** → register
(hardened) → humanize → imagery → build → **validate-post** → commit/push (verified) →
social (idempotent). Any failure on any step: retried if transient, else stops the flow
and writes an Obsidian failure note. All flow definitions live in `windmill-workspace`;
deploy is `wmill sync push`.

## Error handling strategy

- **Transient** (SSH/network/Ollama): Windmill retry (A2) absorbs.
- **Deterministic / data** (validation, bad frontmatter, missing image): fail fast, no
  retry, stop before push, alert (A6). Fail-closed: never publish a broken site.
- **Secret/auth:** token in a variable; rotation revokes the leaked one.

## Testing / verification

- **A0:** `wmill sync pull` then `wmill sync push` round-trips with no diff;
  `bin/verify-sync.sh` green.
- **A1:** `grep -r wmill_55c1` returns nothing in repo + DB export; `vault-check`
  dry-run triggers publish using the variable; old token rejected by API.
- **A2:** induce a transient failure (briefly block SSH) and confirm a step retries and
  recovers instead of failing the flow.
- **A3:** unit-test `validate-publish.sh` against fixtures — valid article passes; bad
  category, missing file, unclosed frontmatter, missing image each fail with the right
  message and a non-zero exit; post-build assert catches a deliberately broken build.
- **A4:** `register-article.sh` with a title containing `"`, `:`, `'`, and a `$VAR`
  produces valid JSON; concurrent invocations don't corrupt the list (flock).
- **A5:** re-run `publish-pipeline` from a mid step on an already-published slug → no
  duplicate Buffer posts, no duplicate commits.
- **A6:** force a step failure → Obsidian note created + JSONL line written.
- **A7:** live `judge-pipeline` contains `e_factcheck` after deploy; a judge run produces
  `factcheck-result.json`.
- **A8:** SSH from mbp still works with `accept-new` and a populated `known_hosts`.

End-to-end: one full `judge-pipeline` run (manual seed) and one full `publish-pipeline`
run on a throwaway draft, observed green, before declaring A complete.

## Rollout order

A0 (sync baseline) → A1 (token) → A8 (host keys) → A2 (retries) → A4 (write path) → A3
(validation gate) → A5 (idempotency) → A6 (alerts) → A7 (deploy fact-check). Each lands
as an atomic commit in the relevant repo; flow changes deploy via `wmill sync push` and
are verified with `verify-sync.sh`.

## Risks

- **Token rotation** could briefly break `vault-check` if mis-sequenced → rotate +
  verify before revoking old.
- **`wmill sync push`** could overwrite a live hand-edit made after the baseline pull →
  pull + diff immediately before any push; `verify-sync.sh` guards.
- **Deploying fact-check** lengthens judge runs and may surface fact-check failures that
  were previously skipped — expected and desirable; watch the first run.
- **Validation gate** could reject articles that previously (wrongly) published →
  intended; messages must be actionable.

## Repos touched

`~/Code/windmill-workspace` (new), `~/Code/blog-publisher` (phases, lib, flows),
`~/Code/otel-local-ai` (judge-pipeline flow only). Site repo `shane.logsdon.io` is read
by the validation gate but not modified by A.
