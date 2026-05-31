# Blog Pipeline Quality (Strictly Local) — Implementation Plan (Sub-project B)

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Raise published-post quality + factual reliability within strictly-local model limits, measured against a baseline — without touching reliability (done in Sub-project A) or introducing cloud models.

**Architecture:** The creation engine is `~/Code/otel-local-ai/scripts/judge_pipeline.py` (~2028 lines: cold-draft → per-axis judge/revise loop → fact-check → gate), driven by the live Windmill `judge-pipeline` v4 (brief-driven). Publish-side artifacts are `~/Code/blog-publisher` phases + prompts. We build a **quality eval first** (baseline), then make targeted Python + prompt changes, re-running the eval after each. LLM calls route through the LiteLLM proxy on the Mac mini (`http://localhost:4000` / container `http://host.docker.internal:11434`); evaluation moves to the stronger local `quality` alias (`qwen3.6:35b-mlx`).

**Tech Stack:** Python 3 (stdlib + `pytest`), LiteLLM/Ollama (local), bash, Langfuse (existing eval infra), the `wmill` CLI (only if a flow's shape changes).

**Spec:** `~/Code/shane.logsdon.io/docs/superpowers/specs/2026-05-30-blog-pipeline-quality-design.md` (decisions D1–D4 resolved).

**Decisions baked in:** D1 = gate on **high-confidence** unsupported claims only · D2 = **each scored axis ≥ 8/10 AND total ≥ 34/40** · D3 = judge **and** gate route through the `quality` alias (LLM gate advisory, Python decides) · D4 = **eval first**.

**Conventions:** Conventional commits; **never reference Claude/AI in messages**; 4-space indent for Python. Work on branch `feature/blog-pipeline-quality` in `otel-local-ai` and `blog-publisher`. All work runs on the Mac mini (where this executes). Each engine change is validated by a real, human-gated judge-pipeline run before any deploy; flow-shape changes (none expected except possibly raising `MAX_ROUNDS`) deploy via `wmill sync push` from `~/Code/windmill-workspace`.

---

## File Structure

| File | Responsibility | Phase |
|---|---|---|
| `otel-local-ai/eval/quality_eval.py` (new) | Score the last N published posts on voice/structure/anti-patterns + fact-offender counts; emit a JSON report | B7 |
| `otel-local-ai/eval/baselines/` (new dir) | Committed baseline + post-change eval reports | B7 |
| `otel-local-ai/tests/test_judge_pipeline.py` (new) | pytest for the Python engine changes | B3/B2/B1/B4 |
| `otel-local-ai/scripts/judge_pipeline.py` (modify) | extract_json, tie-break, plateau, length-floor, accuracy display (B3); Python gate + thresholds + gate alias (B2); evidence verifier + gating (B1); brief `[ANGLE]`/`[SECTIONS]` parse + inject (B4) | B1–B4 |
| `blog-publisher/bin/phases/run-generate-teasers.sh`, `run-humanize.sh`, prompts | excerpt-from-humanized, companion-text required, shared humanize rules | B5 |
| `blog-publisher/lib/frontmatter.sh` (new) + callers | shared frontmatter parser | B6 |
| `shane.logsdon.io/resources/data/schema.json` + `docs/ARTICLE_FRONTMATTER.md` (new) | documented schemas | B6 |

**Rollout order = task order:** B7 (eval+baseline) → B3 (judge fixes) → B2 (Python gate) → B1 (fact-check) → B4 (brief prompts) → B5 (publish artifacts) → B6 (cleanup) → re-eval.

---

### Task 0: Prereqs

**Files:** none (env setup).

- [ ] **Step 1: Branches + tooling**

```bash
cd ~/Code/otel-local-ai && git checkout -b feature/blog-pipeline-quality 2>/dev/null || git checkout feature/blog-pipeline-quality
cd ~/Code/blog-publisher && git checkout -b feature/blog-pipeline-quality 2>/dev/null || git checkout feature/blog-pipeline-quality
python3 -m pytest --version || pip3 install --quiet pytest
```
Expected: branches active; pytest available.

- [ ] **Step 2: Confirm the `quality` alias responds (D3 target)**

Run:
```bash
curl -s http://localhost:4000/v1/chat/completions -H 'Content-Type: application/json' \
  -d '{"model":"quality","messages":[{"role":"user","content":"reply with the single word: ok"}],"max_tokens":10}' \
  | python3 -c "import json,sys; print(json.load(sys.stdin)['choices'][0]['message']['content'][:40])"
```
Expected: a short reply (proves `quality`/qwen3.6:35b-mlx is routable). If it errors, STOP — D3 can't proceed; report so the alias can be fixed first.

- [ ] **Step 3: No commit** (setup only).

---

### Task 1: B7 — quality-eval scorer (reuses judge prompts)

**Files:**
- Create: `~/Code/otel-local-ai/eval/quality_eval.py`
- Test: `~/Code/otel-local-ai/tests/test_quality_eval.py`

This script scores a set of published article markdown files using the SAME per-axis judge prompts the pipeline uses (`run_judge` / `voice_judge_prompt` etc. from `judge_pipeline.py`), plus the fact-check, and writes a JSON report `{post: {axes, total, fact_offenders}}`. It is the measurement backbone for D4.

- [ ] **Step 1: Read the reusable judge entry points**

Run: `grep -nE '^def run_judge|^def stage_factcheck|^def voice_judge_prompt|^def _load_brief|^def call\(' ~/Code/otel-local-ai/scripts/judge_pipeline.py`
Record the signatures (e.g. `run_judge(draft, round_n) -> (judgment, scores, latency, alias)`). Use them in Step 3; if a name differs, adapt the import.

- [ ] **Step 2: Write the failing test**

Create `~/Code/otel-local-ai/tests/test_quality_eval.py`:
```python
import json, os, sys, pathlib
sys.path.insert(0, str(pathlib.Path(__file__).resolve().parents[1] / "eval"))
sys.path.insert(0, str(pathlib.Path(__file__).resolve().parents[1] / "scripts"))

def test_strip_frontmatter_returns_body():
    from quality_eval import strip_frontmatter
    md = "---\ntitle: X\n---\nHello body.\n"
    assert strip_frontmatter(md).strip() == "Hello body."

def test_report_row_shape():
    from quality_eval import empty_row
    r = empty_row("my-post")
    assert r["post"] == "my-post"
    assert set(r["axes"]) >= {"voice", "structure", "anti_patterns", "length"}
    assert r["total"] is None and r["fact_offenders"] is None
```

- [ ] **Step 3: Run to verify it fails**

Run: `cd ~/Code/otel-local-ai && python3 -m pytest tests/test_quality_eval.py -q`
Expected: FAIL (module `quality_eval` not found).

- [ ] **Step 4: Implement `eval/quality_eval.py`**

Create the file with: `strip_frontmatter(md)` (drop the first `---`…`---` block), `empty_row(post)` (`{"post":post,"axes":{a:None for a in SCORED_AXES},"total":None,"fact_offenders":None}`), and a `score_post(path)` that loads the article body, calls `run_judge(body, 0)` for the axis scores+total, and `stage_factcheck`/`verify_claim_evidence` for the fact-offender count, returning a filled row. A `main()` takes a glob of article paths (default: the 10 most recent in `~/Code/shane.logsdon.io/pages/articles/**/*.md` excluding `_drafts`) and writes `eval/baselines/<timestamp-arg>.json` (timestamp passed via `--stamp`, since `datetime.now()` is fine here but keep it a CLI arg for reproducibility). Import `SCORED_AXES, run_judge` from `judge_pipeline`. Judge model is controlled by the existing `*_JUDGE_ALIAS` env vars (so the same script measures current vs `quality` routing by swapping `AXIS_JUDGE_ALIAS`/`VOICE_JUDGE_ALIAS`).

- [ ] **Step 5: Run to verify the unit tests pass**

Run: `cd ~/Code/otel-local-ai && python3 -m pytest tests/test_quality_eval.py -q`
Expected: PASS (2 passed). (Full scoring is exercised in Task 2 against the live proxy.)

- [ ] **Step 6: Commit**

```bash
cd ~/Code/otel-local-ai
git add eval/quality_eval.py tests/test_quality_eval.py
git commit -m "feat: add local quality-eval scorer (voice/structure/anti-patterns + fact offenders)"
```

---

### Task 2: B7 — capture the baseline (current routing)

**Files:** Create `~/Code/otel-local-ai/eval/baselines/2026-05-31-baseline.json` (committed).

- [ ] **Step 1: Run the eval against the live proxy with CURRENT routing**

```bash
cd ~/Code/otel-local-ai
python3 eval/quality_eval.py --stamp 2026-05-31-baseline
```
Expected: writes `eval/baselines/2026-05-31-baseline.json` with a row per recent post. (This calls local models; takes a few minutes.) If a post errors, the row keeps `null` fields — that's fine; note it in the commit.

- [ ] **Step 2: Sanity-check the report**

Run: `python3 -c "import json; d=json.load(open('eval/baselines/2026-05-31-baseline.json')); print(len(d), 'posts;'); print('avg total:', round(sum(r['total'] for r in d if r['total'] is not None)/max(1,sum(1 for r in d if r['total'] is not None)),1))"`
Expected: prints post count + an average total in 0–40.

- [ ] **Step 3: Capture the D3 comparison point (stronger local judge)**

```bash
AXIS_JUDGE_ALIAS=quality VOICE_JUDGE_ALIAS=quality python3 eval/quality_eval.py --stamp 2026-05-31-quality-judge
```
Expected: a second report scored by `qwen3.6:35b-mlx`. Compare averages/variance vs baseline — this is the empirical input to D3.

- [ ] **Step 4: Commit**

```bash
git add eval/baselines/2026-05-31-baseline.json eval/baselines/2026-05-31-quality-judge.json
git commit -m "chore: capture quality-eval baseline (current vs quality-alias judge)"
```

---

### Task 3: B3 — `extract_json` returns the FIRST complete object

**Files:** Modify `~/Code/otel-local-ai/scripts/judge_pipeline.py` (`extract_json`, ~line 330). Test: `tests/test_judge_pipeline.py`.

- [ ] **Step 1: Write the failing test**

Create `~/Code/otel-local-ai/tests/test_judge_pipeline.py`:
```python
import sys, pathlib
sys.path.insert(0, str(pathlib.Path(__file__).resolve().parents[1] / "scripts"))
from judge_pipeline import extract_json

def test_extract_json_first_object_not_last():
    # A reasoning preamble emits an example object before the real one.
    text = 'Example: {"score": 1} then the answer:\n{"voice": 8, "total": 34}'
    assert extract_json(text) == {"voice": 8, "total": 34} or extract_json(text).get("voice") == 8

def test_extract_json_fenced():
    text = "```json\n{\"a\": 1}\n```"
    assert extract_json(text) == {"a": 1}

def test_extract_json_trailing_object_ignored():
    text = '{"real": 1, "nested": {"x": 2}} trailing {"junk": 9}'
    assert extract_json(text) == {"real": 1, "nested": {"x": 2}}
```

- [ ] **Step 2: Run to verify failure**

Run: `cd ~/Code/otel-local-ai && python3 -m pytest tests/test_judge_pipeline.py -q -k extract_json`
Expected: FAIL on `test_extract_json_trailing_object_ignored` (current `find/rfind` brace-span grabs through the trailing object).

- [ ] **Step 3: Replace the fallback in `extract_json`**

Read `extract_json` (around line 330). Keep the fenced-code-block path. Replace the `text.find("{")` / `text.rfind("}")` brace-span fallback with a first-complete-object scan:
```python
    # Fallback: first COMPLETE JSON object via raw_decode from each '{'.
    dec = json.JSONDecoder()
    i = text.find("{")
    while i != -1:
        try:
            obj, _ = dec.raw_decode(text, i)
            if isinstance(obj, dict):
                return obj
        except json.JSONDecodeError:
            pass
        i = text.find("{", i + 1)
```
(Leave the `extract_partial_claims` truncation-recovery path unchanged.)

- [ ] **Step 4: Run to verify pass**

Run: `cd ~/Code/otel-local-ai && python3 -m pytest tests/test_judge_pipeline.py -q -k extract_json`
Expected: PASS (3 passed).

- [ ] **Step 5: Commit**

```bash
git add scripts/judge_pipeline.py tests/test_judge_pipeline.py
git commit -m "fix: extract_json returns first complete object, not last brace span"
```

---

### Task 4: B3 — best-draft tie-break prefers the later round

**Files:** Modify `judge_pipeline.py` (`best = max(...)`, ~line 1237). Same test file.

- [ ] **Step 1: Write the failing test**

Append to `tests/test_judge_pipeline.py`:
```python
def test_best_round_tiebreak_prefers_later():
    from judge_pipeline import pick_best
    rounds = [
        {"n": 2, "judgment": {"total": 34}},
        {"n": 4, "judgment": {"total": 34}},
        {"n": 5, "judgment": {"total": 30}},
    ]
    assert pick_best(rounds)["n"] == 4
```

- [ ] **Step 2: Run to verify failure**

Run: `python3 -m pytest tests/test_judge_pipeline.py -q -k tiebreak`
Expected: FAIL (`pick_best` not defined).

- [ ] **Step 3: Extract `pick_best` and use a tuple key**

Add near the iterate loop:
```python
def pick_best(rounds: list[dict]) -> dict:
    """Highest total; ties broken toward the later round (more accumulated revision)."""
    return max(rounds, key=lambda r: (r["judgment"].get("total", 0), r.get("n", 0)))
```
Replace line ~1237 `best = max(rounds, key=lambda r: r["judgment"].get("total", 0))` with `best = pick_best(rounds)`.

- [ ] **Step 4: Run to verify pass**

Run: `python3 -m pytest tests/test_judge_pipeline.py -q -k tiebreak`
Expected: PASS.

- [ ] **Step 5: Commit**

```bash
git add scripts/judge_pipeline.py tests/test_judge_pipeline.py
git commit -m "fix: judge best-draft tie-break prefers the later round"
```

---

### Task 5: B3 — plateau stops when below all-time best

**Files:** Modify `judge_pipeline.py` (loop ~1204–1216). Same test file.

- [ ] **Step 1: Write the failing test**

Append:
```python
def test_should_stop_below_best():
    from judge_pipeline import should_stop_for_plateau
    # best was 34 at round 2; rounds 3,4 are below it -> stop.
    totals = [30, 34, 28, 28]
    assert should_stop_for_plateau(totals, patience=2) is True

def test_should_not_stop_still_improving():
    from judge_pipeline import should_stop_for_plateau
    assert should_stop_for_plateau([30, 31, 33], patience=2) is False
```

- [ ] **Step 2: Run to verify failure**

Run: `python3 -m pytest tests/test_judge_pipeline.py -q -k plateau`
Expected: FAIL (`should_stop_for_plateau` not defined).

- [ ] **Step 3: Implement and wire it**

Add:
```python
def should_stop_for_plateau(totals: list[int], patience: int = 2) -> bool:
    """Stop if we've gone `patience` rounds without beating the all-time best."""
    if len(totals) <= patience:
        return False
    best = max(totals)
    return all(t < best for t in totals[-patience:])
```
In the iterate loop (~1204–1216), replace the existing 3-in-a-row `t3 <= t2 <= t1` plateau check with `if should_stop_for_plateau([r["judgment"]["total"] for r in rounds]): break` (keep the `>= TARGET_TOTAL` early-exit on line ~1206 as-is).

- [ ] **Step 4: Run to verify pass**

Run: `python3 -m pytest tests/test_judge_pipeline.py -q -k plateau`
Expected: PASS (2 passed).

- [ ] **Step 5: Commit**

```bash
git add scripts/judge_pipeline.py tests/test_judge_pipeline.py
git commit -m "fix: plateau detection stops when below all-time best score"
```

---

### Task 6: B3 — post-revision length-floor validation + accuracy display

**Files:** Modify `judge_pipeline.py` (`revise_prompt` ~625, the iterate loop revise call, and the vault-note accuracy row).

- [ ] **Step 1: Read the revise call + min_wc logic**

Run: `sed -n '620,665p;1216,1240p' ~/Code/otel-local-ai/scripts/judge_pipeline.py` and the accuracy-display line `grep -n 'advisory' scripts/judge_pipeline.py`.
Identify where `revised = call(REVISE_ALIAS, revise_prompt(...))` happens and where the floor `min_wc` is computed.

- [ ] **Step 2: Add a length-floor guard (no test — integration; guarded by the eval)**

After the revise call, add: compute `wc = word_count(revised)`; if `wc < min_wc`, log a warning and re-call once with an appended instruction string `"\n\nYour previous attempt was {wc} words, below the {min_wc} floor. Revise by SUBSTITUTING weaker passages, never by deleting content."`; use the longer of the two results. Keep it to a single retry.

- [ ] **Step 3: Fix the accuracy advisory display**

In the judgment vault-note builder (the `Accuracy: … _(advisory)_` row), move the `**Advisory — local models cannot cite verbatim; verify manually.**` caveat to **above** the per-axis table, and add `"is_advisory": True` to the accuracy entry written into `iterations.json`.

- [ ] **Step 4: Smoke-check the module imports cleanly**

Run: `cd ~/Code/otel-local-ai && python3 -c "import sys; sys.path.insert(0,'scripts'); import judge_pipeline; print('import ok')"`
Expected: `import ok`.

- [ ] **Step 5: Commit**

```bash
git add scripts/judge_pipeline.py
git commit -m "fix: re-revise on length-floor violation; surface accuracy advisory above scores"
```

---

### Task 7: B2 — Python decision gate + stricter bar + stronger gate model

**Files:** Modify `judge_pipeline.py` (config lines 78/104; gate predicate ~1294–1351). Test: same file.

- [ ] **Step 1: Write the failing test for the gate predicate**

Append to `tests/test_judge_pipeline.py`:
```python
def test_gate_decision_blocks_weak_axis():
    from judge_pipeline import decide_publishable
    scores = {"voice": 9, "structure": 7, "anti_patterns": 9, "length": 9}  # structure < 8
    assert decide_publishable(scores, total=34, fact_offenders=0, hard_anti_patterns=0) is False

def test_gate_decision_blocks_low_total():
    from judge_pipeline import decide_publishable
    scores = {"voice": 8, "structure": 8, "anti_patterns": 8, "length": 8}  # total 32 < 34
    assert decide_publishable(scores, total=32, fact_offenders=0, hard_anti_patterns=0) is False

def test_gate_decision_blocks_fact_offender():
    from judge_pipeline import decide_publishable
    scores = {"voice": 9, "structure": 9, "anti_patterns": 9, "length": 9}
    assert decide_publishable(scores, total=36, fact_offenders=1, hard_anti_patterns=0) is False

def test_gate_decision_passes_clean():
    from judge_pipeline import decide_publishable
    scores = {"voice": 8, "structure": 9, "anti_patterns": 9, "length": 8}
    assert decide_publishable(scores, total=34, fact_offenders=0, hard_anti_patterns=0) is True
```

- [ ] **Step 2: Run to verify failure**

Run: `python3 -m pytest tests/test_judge_pipeline.py -q -k gate_decision`
Expected: FAIL (`decide_publishable` not defined).

- [ ] **Step 3: Implement the predicate + raise the bar + route gate to `quality`**

Add:
```python
AXIS_FLOOR = 8       # D2: each scored axis must be >= 8/10
TARGET_TOTAL = 34    # D2: was 30; out of 40

def decide_publishable(scores: dict, total: int, fact_offenders: int, hard_anti_patterns: int) -> bool:
    """Python-side decision (D2). The LLM gate is advisory only."""
    if any(scores.get(a, 0) < AXIS_FLOOR for a in SCORED_AXES):
        return False
    if total < TARGET_TOTAL:
        return False
    if fact_offenders > 0:          # D1: only HIGH-CONFIDENCE offenders are counted (see Task 8)
        return False
    if hard_anti_patterns > 0:
        return False
    return True
```
Change the existing `TARGET_TOTAL = 30` (line ~104) to import/use `34` (remove the old literal to avoid two definitions). Change `GATE_ALIAS` default (line ~78) from `"pipeline"` to `"quality"` (D3). In `stage_gate` (~1294–1351), keep calling the LLM gate for advisory commentary, but compute the **final** `publishable_as_is` from `decide_publishable(best_scores, best_total, fact_offender_count, hard_anti_pattern_count)` and drop the old "gate-vs-per-axis >2 disagreement" override (it existed to compensate for the weak gate model).

- [ ] **Step 4: Run to verify pass**

Run: `python3 -m pytest tests/test_judge_pipeline.py -q -k gate_decision`
Expected: PASS (4 passed).

- [ ] **Step 5: Commit**

```bash
git add scripts/judge_pipeline.py tests/test_judge_pipeline.py
git commit -m "feat: python decision gate (axis>=8, total>=34, no fact offenders); gate via quality alias"
```

---

### Task 8: B1 — fact-check verifier: confidence + gate on high-confidence only

**Files:** Modify `judge_pipeline.py` (`verify_claim_evidence` ~1002, `_post_verify_accuracy_axis` ~1023, the factcheck→revision-notes path). Test: same file.

- [ ] **Step 1: Read the verifier + offender plumbing**

Run: `sed -n '1000,1075p' ~/Code/otel-local-ai/scripts/judge_pipeline.py` and `grep -n 'factcheck_to_revision_notes\|fact_offender\|ungrounded\|evidence-fabricated' scripts/judge_pipeline.py`.

- [ ] **Step 2: Write the failing test**

Append:
```python
def test_confident_unsupported_is_offender():
    from judge_pipeline import classify_claim
    brief = "The mini runs eleven local models behind a LiteLLM proxy."
    # claim contradicts/absent from brief, model gave no real quote -> high-confidence unsupported
    c = classify_claim({"claim": "The mini runs zero local models", "brief_evidence": ""}, brief)
    assert c["status"] == "unsupported" and c["confidence"] == "high"

def test_paraphrase_present_is_supported_low_conf():
    from judge_pipeline import classify_claim
    brief = "The mini runs eleven local models behind a LiteLLM proxy."
    c = classify_claim({"claim": "Eleven local models run on the mini", "brief_evidence": ""}, brief)
    assert c["status"] != "unsupported" or c["confidence"] == "low"
```

- [ ] **Step 3: Run to verify failure**

Run: `python3 -m pytest tests/test_judge_pipeline.py -q -k claim`
Expected: FAIL (`classify_claim` not defined).

- [ ] **Step 4: Implement confidence classification + count only high-confidence offenders**

Add `classify_claim(claim, brief_text)` returning `{"status": "supported"|"unsupported", "confidence": "high"|"low"}`: normalize (lowercase, strip punctuation), check token-overlap of the claim's content words against the brief; if a strong overlap exists → `supported`; if the claim's key noun/number content is **absent** from the brief → `unsupported` with `confidence="high"` only when the claim also has no plausible paraphrase match (overlap below a low threshold), else `confidence="low"`. Update `_post_verify_accuracy_axis` to use it; expose `fact_offender_count = number of high-confidence unsupported claims` for the gate (Task 7). In `factcheck_to_revision_notes`, only emit **imperative** "remove/rewrite" notes for high-confidence offenders; low-confidence become advisory notes suffixed `(advisory — verify manually)`.

- [ ] **Step 5: Run to verify pass**

Run: `python3 -m pytest tests/test_judge_pipeline.py -q -k claim`
Expected: PASS.

- [ ] **Step 6: Commit**

```bash
git add scripts/judge_pipeline.py tests/test_judge_pipeline.py
git commit -m "feat: fact-check confidence classification; gate only on high-confidence unsupported claims"
```

---

### Task 9: B4 — brief `[ANGLE]` / `[SECTIONS]` parse + prompt injection

**Files:** Modify `judge_pipeline.py` (`_load_brief` ~137, `cold_draft_prompt` ~394, `structure_judge_prompt`). Test: same file.

- [ ] **Step 1: Write the failing test for the parser**

Append:
```python
def test_parse_brief_blocks():
    from judge_pipeline import parse_brief_meta
    brief = "intro\n[ANGLE] chokepoint discipline\n[SECTIONS]\n- one\n- two\nbody"
    m = parse_brief_meta(brief)
    assert m["angle"] == "chokepoint discipline"
    assert m["sections"] == ["one", "two"]

def test_parse_brief_absent():
    from judge_pipeline import parse_brief_meta
    m = parse_brief_meta("no blocks here")
    assert m["angle"] is None and m["sections"] == []
```

- [ ] **Step 2: Run to verify failure**

Run: `python3 -m pytest tests/test_judge_pipeline.py -q -k brief`
Expected: FAIL (`parse_brief_meta` not defined).

- [ ] **Step 3: Implement parser + inject into prompts**

Add `parse_brief_meta(brief_text)` returning `{"angle": str|None, "sections": [str,...]}` (regex for `^\[ANGLE\]\s*(.+)$` and an `^\[SECTIONS\]$` block of `- ` bullets until a blank line). In `cold_draft_prompt()`, when `angle`/`sections` are present, append a hard constraint: `"Use angle: {angle}. Cover these sections in order: {sections}. Close by reframing the angle (no 'conclusion' header)."`. In `structure_judge_prompt()`, when present, add a check: "Does the draft use the stated angle and cover all required sections?" Both are additive — absent blocks change nothing.

- [ ] **Step 4: Run to verify pass + import check**

Run: `python3 -m pytest tests/test_judge_pipeline.py -q -k brief && python3 -c "import sys;sys.path.insert(0,'scripts');import judge_pipeline;print('ok')"`
Expected: PASS + `ok`.

- [ ] **Step 5: Commit**

```bash
git add scripts/judge_pipeline.py tests/test_judge_pipeline.py
git commit -m "feat: enforce brief [ANGLE]/[SECTIONS] in cold-draft and structure judge"
```

---

### Task 10: B5 — publish artifact quality (blog-publisher)

**Files (read each first, then apply):** `~/Code/blog-publisher/bin/phases/run-generate-teasers.sh`, `run-humanize.sh`, `prompts/publish/humanize.md`, `prompts/social/generate.md`, `prompts/publish/{hero-html,linkedin-html}.md`.

- [ ] **Step 1: Excerpt from the humanized article**

In `run-generate-teasers.sh`, the excerpt is taken from the article body. Confirm humanize (`run-humanize.sh`) writes the humanized text back to the same article file *before* teasers run in the flow order (publish-pipeline: `d_humanize` precedes `o_teasers_initial`). Add a guard at the top of `run-generate-teasers.sh`: if the article lacks the humanize marker, log a warning. (No behavior change if order already holds; this makes the dependency explicit.)

- [ ] **Step 2: Consolidate humanize rules**

Create `~/Code/blog-publisher/prompts/_humanize-rules.md` with the shared em-dash/semicolon/fragment/vocabulary rules currently duplicated in `prompts/publish/humanize.md` and `prompts/social/generate.md`. Replace the duplicated blocks in both with a one-line reference comment `<!-- shared rules: prompts/_humanize-rules.md -->` and have the wrapper scripts `cat` the shared file into the prompt they pass to `pi`. Verify both still produce a complete prompt: `bash -n run-humanize.sh run-generate-teasers.sh`.

- [ ] **Step 3: Require a companion-text block + archetype rationale**

In `prompts/publish/linkedin-html.md` (and `hero-html.md`), require the artifact to include `<!-- COMPANION TEXT: …150–250 words… -->` and `<!-- ARCHETYPE: <name> — <1-line why> -->`. In `screenshot-linkedin.sh`/`run-generate-teasers.sh`, after generation, fail (non-zero) if the COMPANION TEXT block is missing, so initial LinkedIn posts are always insight-led.

- [ ] **Step 4: Commit**

```bash
cd ~/Code/blog-publisher
git add prompts/_humanize-rules.md prompts/publish/humanize.md prompts/publish/linkedin-html.md prompts/publish/hero-html.md prompts/social/generate.md bin/phases/run-generate-teasers.sh bin/phases/run-humanize.sh
git commit -m "feat: humanized-source teasers, shared humanize rules, required companion text + archetype rationale"
```

---

### Task 11: B6 — maintainability cleanup

**Files:** `~/Code/blog-publisher/lib/frontmatter.sh` (new) + callers; remove orphans; schema docs.

- [ ] **Step 1: Shared frontmatter parser**

Create `lib/frontmatter.sh` exposing `frontmatter_block <file>` (awk to the 2nd `---`) and `frontmatter_value <file> <key>`. Replace the ad-hoc awk in `lib/common.sh` (`find_due_drafts` already isolated), `bin/phases/find-due-drafts.sh`, and `validate-publish.sh` with calls to it. Run the existing suite: `for t in tests/test_*.sh; do bash "$t" >/dev/null 2>&1 && echo "ok $t" || echo "FAIL $t"; done` — expected all ok.

- [ ] **Step 2: Remove orphans + stale worktrees**

```bash
cd ~/Code/blog-publisher && git rm -q process_teasers.py processed_teasers.py 2>/dev/null; rm -f teasers_raw.txt state_update_local.json 2>/dev/null
cd ~/Code/otel-local-ai && git worktree list | awk '/condescending-pare|gifted-feynman|heuristic-mestorf|peaceful-hodgkin|pensive-curie/ {print $1}' | xargs -r -n1 git worktree remove --force
```
Expected: orphans gone; stale worktrees removed (verify `git -C ~/Code/otel-local-ai worktree list` shows only the main checkout).

- [ ] **Step 3: Document the schemas**

Create `~/Code/shane.logsdon.io/resources/data/schema.json` (JSON Schema for an `articles-list.json` entry: `title`,`description`,`date YYYY-MM-DD`,`category` enum,`archived` bool,`tags[]`) and `~/Code/shane.logsdon.io/docs/ARTICLE_FRONTMATTER.md` (the required article frontmatter fields + an example). Validate the current list against it: `python3 -c "import json; [print('bad',k) for k,v in json.load(open('$HOME/Code/shane.logsdon.io/resources/data/articles-list.json')).items() if not all(f in v for f in ('title','description','date','category'))] or print('all entries valid')"`.

- [ ] **Step 4: Commit (per repo)**

```bash
cd ~/Code/blog-publisher && git add -A && git commit -m "refactor: shared frontmatter parser; remove orphaned scratch files"
cd ~/Code/otel-local-ai && git add -A && git commit -m "chore: remove stale agent worktrees" || echo "(nothing staged)"
cd ~/Code/shane.logsdon.io && git add resources/data/schema.json docs/ARTICLE_FRONTMATTER.md && git commit -m "docs: document articles-list + frontmatter schema"
```

---

### Task 12: Re-run the eval + compare to baseline

**Files:** `~/Code/otel-local-ai/eval/baselines/2026-05-31-after-B.json` (new).

- [ ] **Step 1: Re-run the quality eval (with the new gate routing)**

```bash
cd ~/Code/otel-local-ai
AXIS_JUDGE_ALIAS=quality VOICE_JUDGE_ALIAS=quality python3 eval/quality_eval.py --stamp 2026-05-31-after-B
```

- [ ] **Step 2: Compare to baseline**

```bash
python3 -c "
import json
b=json.load(open('eval/baselines/2026-05-31-baseline.json')); a=json.load(open('eval/baselines/2026-05-31-after-B.json'))
def avg(d): xs=[r['total'] for r in d if r['total'] is not None]; return round(sum(xs)/max(1,len(xs)),1)
def off(d): return sum(r['fact_offenders'] or 0 for r in d)
print('avg total: baseline', avg(b), '-> after', avg(a))
print('fact offenders: baseline', off(b), '-> after', off(a))
"
```
Expected: a printed before/after. Record the deltas in the commit message. (Quality is a trend signal from local judges, not absolute truth.)

- [ ] **Step 3: Commit**

```bash
git add eval/baselines/2026-05-31-after-B.json
git commit -m "chore: post-B quality eval vs baseline"
```

- [ ] **Step 4: Validate end-to-end (human-gated)**

Run one real `judge-pipeline` from the Windmill UI with a brief that includes `[ANGLE]`/`[SECTIONS]`. Confirm: fact-check runs, the Python gate decides (axis≥8/total≥34), the gate uses the `quality` alias, and the run completes through the approval gate. (No deploy needed unless `MAX_ROUNDS` was raised — if so, edit `windmill-workspace` judge-pipeline and `wmill sync push`.)

---

## Self-Review

**Spec coverage:** B7→Tasks 1–2,12; B3→Tasks 3–6; B2→Task 7; B1→Task 8; B4→Task 9; B5→Task 10; B6→Task 11. D1→Task 8 (high-confidence only). D2→Task 7 (AXIS_FLOOR=8, TARGET_TOTAL=34). D3→Task 7 (GATE_ALIAS=quality) + Task 2 Step 3 (eval comparison). D4→Tasks 1–2 first. All spec sections mapped.

**Placeholder scan:** Where exact current code must be confirmed in the 2028-line `judge_pipeline.py`, each task has an explicit read step (Task 6 Step 1, Task 8 Step 1, Task 9 Step 1) before applying a concrete, named transformation — not hand-waved. New functions (`pick_best`, `should_stop_for_plateau`, `decide_publishable`, `classify_claim`, `parse_brief_meta`, `strip_frontmatter`, `empty_row`) are fully specified and tested.

**Type/name consistency:** `decide_publishable(scores, total, fact_offenders, hard_anti_patterns)` (Task 7) consumes `fact_offender_count` = high-confidence offenders from `classify_claim` (Task 8). `AXIS_FLOOR=8`/`TARGET_TOTAL=34` (Task 7) match D2. `GATE_ALIAS="quality"` (Task 7) matches D3 and the litellm `quality` alias. `pick_best`/`should_stop_for_plateau` names match their tests. `SCORED_AXES` reused from `judge_pipeline` in the eval (Task 1).
