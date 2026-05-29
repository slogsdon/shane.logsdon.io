# Blog Pipeline Reliability & Source-of-Truth — Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Make the blog creation/publishing Windmill pipelines fail-safe, observable, and backed by a git source-of-truth, without changing writing quality (that is Sub-project B).

**Architecture:** Three Windmill flows on mbp.local (CE v1.707.0) SSH into the mac mini (`192.168.86.34`) to run engine scripts in `~/Code/otel-local-ai` (creation) and `~/Code/blog-publisher` (publish). This plan: (1) makes a new `~/Code/windmill-workspace` git repo the source of truth via the `wmill` CLI; (2) rotates the leaked API token into a Windmill variable; (3) adds retries, a fail-closed pre-publish validation gate, write-path hardening, idempotency, and Obsidian failure alerts; (4) deploys the already-written `e_factcheck` stage that is missing from the live judge-pipeline.

**Tech Stack:** Windmill CE + `wmill` CLI (deno/npm), bash (`set -euo pipefail`), Python 3 (stdlib only), PHP flat-file builder (read-only here), Obsidian via `obsidian-proxy.sh`, SSH.

**Spec:** `~/Code/shane.logsdon.io/docs/superpowers/specs/2026-05-28-blog-pipeline-reliability-design.md`

**Conventions (from user CLAUDE.md):** Conventional commits; small atomic commits; **never reference Claude/AI in commit messages**; 4-space indent for shell/Python where editing; functional, readable. All work happens **on the mac mini** (`mac-mini`, where this session runs); Windmill lives on mbp.local and is reached via `http://mbp.local` and SSH.

**Branches:** `feature/blog-pipeline-reliability` in each touched repo (`shane.logsdon.io` already on it; create in `blog-publisher`, `otel-local-ai`; `windmill-workspace` starts on `main`/`source`).

---

## Layer 1 — Source of truth + flow reliability (Tasks 0–4, 11–13)
## Layer 2 — Script hardening + validation gate (Tasks 5–10)
## CHECKPOINT between layers: end-to-end dry run (Task 14)

---

### Task 0: Prereqs — branches and tooling check

**Files:** none created; repo state only.

- [ ] **Step 1: Create feature branches in the engine repos**

```bash
cd ~/Code/blog-publisher && git checkout -b feature/blog-pipeline-reliability 2>/dev/null || git checkout feature/blog-pipeline-reliability
cd ~/Code/otel-local-ai && git checkout -b feature/blog-pipeline-reliability 2>/dev/null || git checkout feature/blog-pipeline-reliability
```

- [ ] **Step 2: Confirm runtimes and Windmill reachability**

Run:
```bash
deno --version; node --version
curl -s http://mbp.local/api/version
```
Expected: deno ≥ 2.x and node present; `curl` prints `CE v1.707.0` (or similar). If `curl` fails, STOP — Windmill is down; run `ssh mbp.local 'orb start'` and retry.

- [ ] **Step 3: No commit** (environment check only).

---

### Task 1: A0 — wmill git-sync source of truth + drift reconciliation

**Files:**
- Create: `~/Code/windmill-workspace/` (new git repo: `wmill.yaml`, pulled flow/variable/schedule files, `README.md`, `bin/verify-sync.sh`)

- [ ] **Step 1: Install the `wmill` CLI**

Run (deno is the official distribution):
```bash
deno install -A --global -n wmill -f https://deno.land/x/wmill/main.ts
export PATH="$HOME/.deno/bin:$PATH"
wmill --version
```
Expected: prints a version. If `deno install` flags differ on this deno version, fall back to `npm i -g windmill-cli` then `wmill --version`. Record the working install command in the repo README (Step 7).

- [ ] **Step 2: Authenticate and add the workspace**

Run:
```bash
wmill workspace add personal personal http://mbp.local
```
When prompted for a token, create one in the Windmill UI (User settings → Tokens) or reuse an admin token. Verify:
```bash
wmill workspace list
```
Expected: `personal` listed and selected.

- [ ] **Step 3: Initialize the repo and pull the live workspace**

Run:
```bash
mkdir -p ~/Code/windmill-workspace && cd ~/Code/windmill-workspace && git init
wmill sync pull --yes
ls -R . | head -80
```
Expected: flow/variable/script files appear (typically `f/blog/judge-pipeline.flow/…`, `f/blog/publish-pipeline.flow/…`, `f/blog/vault-check.flow/…`, plus `f/blog/*.variable.yaml`, `f/blog/daily-vault-check.schedule.yaml`). **Record the actual flow file paths and format** — later tasks reference "the flow file for X" by this layout.

- [ ] **Step 4: Capture the verified baseline commit**

```bash
cd ~/Code/windmill-workspace
printf 'node_modules\n.DS_Store\n' > .gitignore
git add -A && git commit -m "chore: baseline pull of live Windmill personal workspace"
```
Note: this baseline still contains the live `vault-check` with the embedded token literal (rotated in Task 2) — intentional, so the rotation is provable via later diff.

- [ ] **Step 5: Reconcile judge-pipeline drift (add the missing fact-check stage)**

The live `judge-pipeline` is missing `e_factcheck` that exists in `~/Code/otel-local-ai/windmill/flows/judge-pipeline.json` (which has modules `[a_cold_draft, b_judge_loop, c_approve, d_refine, e_factcheck, e_gate, f_vault_write]`). Make the repo's `judge-pipeline` canonical = the version **with** `e_factcheck`.

Verify the gap first:
```bash
grep -rl factcheck ~/Code/windmill-workspace/f/blog/ || echo "LIVE judge-pipeline has NO factcheck (expected)"
python3 -c "import json; d=json.load(open('$HOME/Code/otel-local-ai/windmill/flows/judge-pipeline.json')); v=d.get('value',d); print([m['id'] for m in v['modules']])"
```
Port the `e_factcheck` module (and the `d_refine`/`e_gate` wiring that references `post-refine-draft.md`/`final-draft.md`) from the otel-local-ai git copy into the workspace repo's `judge-pipeline` flow file, matching the workspace file's format. Do **not** push yet — deploy happens in Task 12 after the rest of the flow edits, so the fact-check goes live in one reviewed push.

- [ ] **Step 6: Write `bin/verify-sync.sh`**

Create `~/Code/windmill-workspace/bin/verify-sync.sh`:
```bash
#!/usr/bin/env bash
# Fail if the live Windmill workspace differs from this repo.
set -euo pipefail
cd "$(dirname "$0")/.."
export PATH="$HOME/.deno/bin:$PATH"
TMP="$(mktemp -d)"
trap 'rm -rf "$TMP"' EXIT
wmill sync pull --yes --dry-run > "$TMP/diff.txt" 2>&1 || true
if grep -qiE '(\+|\-|modified|would update|changes)' "$TMP/diff.txt" && ! grep -qi 'no.*chang' "$TMP/diff.txt"; then
  echo "DRIFT: live workspace differs from repo:"; cat "$TMP/diff.txt"; exit 1
fi
echo "IN SYNC: live workspace matches repo."
```
Run `chmod +x bin/verify-sync.sh`. (If `--dry-run` is unsupported in this CLI version, change to `wmill sync pull --yes --stdout`/diff against git; record the working form in README.)

- [ ] **Step 7: Write `README.md` documenting the loop**

Create `~/Code/windmill-workspace/README.md` with: the exact working install command (Step 1), `wmill sync pull --yes` (DB→repo), edit flow files here, `wmill sync push --yes` (repo→DB = deploy), `bin/verify-sync.sh` (assert equal). State: **repo is source of truth; always `pull` + `git status` clean before editing; `push` + `verify-sync` after.**

- [ ] **Step 8: Commit**

```bash
cd ~/Code/windmill-workspace
git add -A && git commit -m "feat: add sync tooling, README, and fact-check-restored judge-pipeline"
```

---

### Task 2: A1 — rotate the API token into a Windmill variable

**Files:** Modify the `vault-check` flow file in `~/Code/windmill-workspace` (step `b_trigger_pipelines`).

- [ ] **Step 1: Confirm clean sync state**

```bash
cd ~/Code/windmill-workspace && export PATH="$HOME/.deno/bin:$PATH" && wmill sync pull --yes && git status --porcelain
```
Expected: no unexpected changes.

- [ ] **Step 2: Create the secret variable**

```bash
wmill variable create u/admin/windmill_api_token "$(printf %s 'PLACEHOLDER_WILL_REPLACE')" --secret || \
  echo "If 'variable create' syntax differs, create u/admin/windmill_api_token (secret) in the Windmill UI."
```
(Value is replaced in Step 4 with the freshly minted token.)

- [ ] **Step 3: Edit `vault-check` step `b_trigger_pipelines` to read the variable**

In the workspace `vault-check` flow file, change the inline Python so the token comes from an input transform, not a literal. Replace the literal line:
```python
token = 'wmill_55c1fcb442f1a55f32e106503843c5d168e60ef0'
```
with:
```python
import os
token = os.environ['WINDMILL_API_TOKEN']
```
and add to that step's `input_transforms` (and pass through the bash arg into the python env):
```yaml
windmill_api_token:
  expr: "variable('u/admin/windmill_api_token')"
  type: javascript
```
Wire the bash wrapper to export it before the python heredoc, e.g. `export WINDMILL_API_TOKEN="$windmill_api_token"`. (Match the step's existing positional-arg style: it already takes `drafts`/`mac_mini_key`; add `windmill_api_token` as a new positional and export it.)

- [ ] **Step 4: Mint a new token, set the variable, deploy, verify, revoke old**

```bash
# 1. Create a NEW token in Windmill UI (or: wmill user create-token). Copy it.
wmill variable update u/admin/windmill_api_token "<NEW_TOKEN>" --secret  # or update via UI
wmill sync push --yes
bin/verify-sync.sh
# 2. Trigger vault-check with a past date that has 0 due drafts (safe no-op) to prove auth works:
curl -s -X POST -H "Authorization: Bearer <NEW_TOKEN>" -H 'Content-Type: application/json' \
  -d '{"target_date":"2000-01-01"}' http://mbp.local/api/w/personal/jobs/run/f/blog/vault-check
# Expect a job id back (200). Inspect run in Windmill UI: reaches b_trigger_pipelines, prints NO_DRAFTS_DUE.
# 3. Revoke the OLD token wmill_55c1... in Windmill UI (Tokens → delete).
```

- [ ] **Step 5: Prove the literal is gone**

```bash
grep -rn 'wmill_55c1fcb442f1a55f32e106503843c5d168e60ef0' ~/Code/windmill-workspace ~/Code/blog-publisher || echo "CLEAN: no token literal in repos"
```
Expected: `CLEAN`. (The Task-1 baseline commit still contains it in history — acceptable; note a future `git filter-repo` scrub in README as optional.)

- [ ] **Step 6: Commit**

```bash
cd ~/Code/windmill-workspace && git add -A && git commit -m "fix: read windmill api token from variable, drop hardcoded literal"
```

---

### Task 3: A8 — SSH host-key hardening

**Files:** flow files in `~/Code/windmill-workspace` (all SSH steps); `known_hosts` on mbp.local.

- [ ] **Step 1: Seed known_hosts on the Windmill host (mbp.local)**

```bash
ssh mbp.local 'ssh-keyscan -H 192.168.86.34 >> ~/.ssh/known_hosts && echo SEEDED'
```
Expected: `SEEDED`. (Windmill workers run as user `shane` on mbp and use `~/.ssh/known_hosts`.)

- [ ] **Step 2: Replace the host-key flag in every SSH step**

In `~/Code/windmill-workspace`, replace all occurrences in flow step content:
```
-o StrictHostKeyChecking=no
```
with
```
-o StrictHostKeyChecking=accept-new
```
Run to confirm count and zero remaining:
```bash
cd ~/Code/windmill-workspace
grep -rl 'StrictHostKeyChecking=no' f/ ; echo "--- after edit, expect none ---"
```

- [ ] **Step 3: Do NOT push yet** (batched with retries in Task 4 to minimize pushes). Commit the edit:

```bash
git add -A && git commit -m "fix: ssh host key checking accept-new instead of disabled"
```

---

### Task 4: A2 — retries + connect-timeout on transient SSH steps

**Files:** Create `~/Code/windmill-workspace/bin/add_retries.py`; modify all flow files.

- [ ] **Step 1: Write the retry-injector script**

Create `~/Code/windmill-workspace/bin/add_retries.py`. It loads each flow definition file, and for every module whose script content contains an SSH call (`ssh -i`) — i.e. NOT approval/suspend/echo-only modules — sets a `retry` block; it leaves the validation-gate steps (`k0_validate_pre`, `k2_validate_post`, added in Task 9) at no-retry. Also bumps `ConnectTimeout=15` → `30` in content.

```python
#!/usr/bin/env python3
"""Add Windmill retry config to transient SSH steps across flow files.
Idempotent: re-running yields no change. Run from repo root."""
import sys, pathlib, re

try:
    from ruamel.yaml import YAML  # preserves formatting
    yaml = YAML(); yaml.preserve_quotes = True
    def load(p): return yaml.load(p.read_text())
    def dump(o, p):
        import io; buf = io.StringIO(); yaml.dump(o, buf); p.write_text(buf.getvalue())
    IS_YAML = True
except ImportError:
    import json
    def load(p): return json.loads(p.read_text())
    def dump(o, p): p.write_text(json.dumps(o, indent=2))
    IS_YAML = False

RETRY = {"exponential": {"attempts": 3, "multiplier": 3, "seconds": 5}}
NO_RETRY_IDS = {"k0_validate_pre", "k2_validate_post"}  # deterministic gate; fail fast

def module_value(m):
    return m.get("value", m)

def walk(modules):
    changed = 0
    for m in modules:
        v = module_value(m)
        content = v.get("content", "") if isinstance(v, dict) else ""
        # bump connect timeout regardless
        if isinstance(content, str) and "ConnectTimeout=15" in content:
            v["content"] = content.replace("ConnectTimeout=15", "ConnectTimeout=30"); changed += 1
            content = v["content"]
        is_ssh = isinstance(content, str) and "ssh -i" in content
        mid = m.get("id", "")
        if is_ssh and mid not in NO_RETRY_IDS:
            if m.get("retry") != RETRY:
                m["retry"] = RETRY; changed += 1
        # recurse into branches/loops if present
        for key in ("modules",):
            sub = v.get(key) if isinstance(v, dict) else None
            if isinstance(sub, list):
                changed += walk(sub)
    return changed

def main(paths):
    total = 0
    for p in paths:
        p = pathlib.Path(p)
        doc = load(p)
        root = doc.get("value", doc)
        modules = root.get("modules") if isinstance(root, dict) else None
        if not modules:
            continue
        c = walk(modules)
        if c:
            dump(doc, p); total += c; print(f"patched {p}: {c} changes")
    print(f"TOTAL changes: {total}")

if __name__ == "__main__":
    main(sys.argv[1:])
```

Note: if `wmill` externalizes inline scripts to separate files (so the YAML `content` is empty/a reference), the `ConnectTimeout` replacement won't find content — handle that by also running a plain text replace over the extracted script files:
```bash
grep -rl 'ConnectTimeout=15' f/ | xargs -r sed -i '' 's/ConnectTimeout=15/ConnectTimeout=30/g'
```
The `retry` field is always flow-graph-level (in the YAML/JSON), so `add_retries.py` handles it regardless.

- [ ] **Step 2: Run the injector on all flow files**

```bash
cd ~/Code/windmill-workspace && chmod +x bin/add_retries.py
pip3 install ruamel.yaml --quiet 2>/dev/null || true   # optional; falls back to json
# pass the actual flow files recorded in Task 1, e.g.:
python3 bin/add_retries.py $(find f/blog -name '*.flow.yaml' -o -name '*.json' | grep -Ei 'judge-pipeline|publish-pipeline|vault-check')
```
Expected: prints `patched …` lines; `TOTAL changes` > 0 (≈ 26 retry adds + connect-timeout bumps).

- [ ] **Step 3: Verify idempotency**

Re-run the same command. Expected: `TOTAL changes: 0`.

- [ ] **Step 4: Deploy and verify (first push of the batch)**

```bash
export PATH="$HOME/.deno/bin:$PATH"
wmill sync push --yes
bin/verify-sync.sh
```
Expected: push succeeds; `IN SYNC`. Open one flow in the Windmill UI and confirm a step shows "Retries: 3, exponential".

- [ ] **Step 5: Commit**

```bash
git add -A && git commit -m "feat: add retry + raise connect timeout on transient ssh steps"
```

---

> **End of Layer 1 first half.** Tasks 5–10 (Layer 2, blog-publisher script hardening) can proceed in parallel with nothing above except Task 0. They are committed in `~/Code/blog-publisher`.

---

### Task 5: A4a — harden `register-article.sh` (no heredoc interpolation, atomic, validated)

**Files:**
- Modify: `~/Code/blog-publisher/bin/phases/register-article.sh`
- Test: `~/Code/blog-publisher/tests/test_register_article.sh` (new; follows existing `tests/test_grep.sh` plain-bash style)

- [ ] **Step 1: Write the failing test**

Create `~/Code/blog-publisher/tests/test_register_article.sh`:
```bash
#!/usr/bin/env bash
# Test register-article.sh handles special chars and validates inputs.
set -uo pipefail
HERE="$(cd "$(dirname "$0")/.." && pwd)"
PASS=0; FAIL=0
ok(){ echo "ok - $1"; PASS=$((PASS+1)); }
no(){ echo "NOT OK - $1"; FAIL=$((FAIL+1)); }

TMP="$(mktemp -d)"; trap 'rm -rf "$TMP"' EXIT
mkdir -p "$TMP/site/resources/data" "$TMP/site/pages/articles/technical-deep-dives"
echo '{}' > "$TMP/site/resources/data/articles-list.json"
printf '{"technical-deep-dives":"Technical Deep Dives","strategic-insights":"Strategic Insights"}' \
  > "$TMP/site/resources/data/categories.json"
echo '---' > "$TMP/site/pages/articles/technical-deep-dives/my-post.md"

export SITE_REPO="$TMP/site"
RUN(){ SITE_REPO="$TMP/site" bash "$HERE/bin/phases/register-article.sh" "$@"; }

# 1. Title with quotes/colon/apostrophe produces VALID json with the exact title.
RUN my-post 'Test: It'\''s "great"' 'A "quoted" desc' 2026-05-28 technical-deep-dives >/dev/null
python3 - "$TMP/site/resources/data/articles-list.json" <<'PY' && ok "special-char title yields valid json" || no "special-char title yields valid json"
import json,sys
d=json.load(open(sys.argv[1]))
e=d["my-post"]; assert e["title"]=='Test: It\'s "great"', e["title"]
assert e["description"]=='A "quoted" desc'
PY

# 2. Invalid category is rejected (non-zero exit).
if RUN other-post 'T' 'D' 2026-05-28 not-a-category >/dev/null 2>&1; then no "rejects bad category"; else ok "rejects bad category"; fi

# 3. Missing article file is rejected (non-zero exit).
if RUN ghost-post 'T' 'D' 2026-05-28 technical-deep-dives >/dev/null 2>&1; then no "rejects missing file"; else ok "rejects missing file"; fi

echo "PASS=$PASS FAIL=$FAIL"; [ "$FAIL" -eq 0 ]
```
Make executable: `chmod +x ~/Code/blog-publisher/tests/test_register_article.sh`.

- [ ] **Step 2: Run the test to verify it fails**

Run: `bash ~/Code/blog-publisher/tests/test_register_article.sh`
Expected: FAIL — current script interpolates into a heredoc (special-char test corrupts JSON) and does no category/file validation.

- [ ] **Step 3: Rewrite `register-article.sh`**

Replace `~/Code/blog-publisher/bin/phases/register-article.sh` with:
```bash
#!/usr/bin/env bash
# Register article in articles-list.json (atomic, validated, injection-safe).
# Usage: register-article.sh <slug> <title> <description> <date YYYY-MM-DD> <category>
set -euo pipefail
BLOG_HOME="$(cd "$(dirname "$0")/../.." && pwd)"
source "${BLOG_HOME}/lib/common.sh"

SLUG="$1"; TITLE="$2"; DESCRIPTION="$3"; DATE="$4"; CATEGORY="$5"
LIST="${SITE_REPO}/resources/data/articles-list.json"
CATS="${SITE_REPO}/resources/data/categories.json"
ARTICLE="${SITE_REPO}/pages/articles/${CATEGORY}/${SLUG}.md"

# Values are passed to Python via argv (never interpolated into source).
SLUG="$SLUG" TITLE="$TITLE" DESCRIPTION="$DESCRIPTION" DATE="$DATE" CATEGORY="$CATEGORY" \
LIST="$LIST" CATS="$CATS" ARTICLE="$ARTICLE" python3 - <<'PYEOF'
import json, os, re, sys, tempfile

slug = os.environ["SLUG"]; title = os.environ["TITLE"]
desc = os.environ["DESCRIPTION"]; date = os.environ["DATE"]; cat = os.environ["CATEGORY"]
list_path = os.environ["LIST"]; cats_path = os.environ["CATS"]; article = os.environ["ARTICLE"]

def die(msg): sys.stderr.write("ERROR: %s\n" % msg); sys.exit(1)

if not re.fullmatch(r"[a-z0-9-]+", slug): die("bad slug: %r" % slug)
if not re.fullmatch(r"\d{4}-\d{2}-\d{2}", date): die("bad date (YYYY-MM-DD): %r" % date)
with open(cats_path) as f: cats = json.load(f)
if cat not in cats: die("unknown category %r (valid: %s)" % (cat, ", ".join(cats)))
if not os.path.isfile(article): die("article file not found: %s" % article)
if not title.strip(): die("empty title")

with open(list_path) as f: data = json.load(f)
if slug in data:
    print("ALREADY_PRESENT: %s" % slug); sys.exit(0)

entry = {"title": title, "description": desc, "date": date,
         "category": cat, "archived": False, "tags": []}
data = {slug: entry, **data}

d = os.path.dirname(list_path)
fd, tmp = tempfile.mkstemp(dir=d, suffix=".tmp")
try:
    with os.fdopen(fd, "w") as f: json.dump(data, f, indent=2)
    json.load(open(tmp))  # verify integrity before swap
    os.replace(tmp, list_path)
finally:
    if os.path.exists(tmp): os.remove(tmp)
print("REGISTERED: %s" % slug)
PYEOF
```
(Note: `flock` for concurrency is not added here because the daily run is single-threaded per the launchd/Windmill schedule; atomic `os.replace` covers crash-safety. If concurrent runs are ever introduced, wrap the python block in `flock "$LIST.lock"`.)

- [ ] **Step 4: Run the test to verify it passes**

Run: `bash ~/Code/blog-publisher/tests/test_register_article.sh`
Expected: `PASS=3 FAIL=0`.

- [ ] **Step 5: Commit**

```bash
cd ~/Code/blog-publisher
git add bin/phases/register-article.sh tests/test_register_article.sh
git commit -m "fix: harden register-article (argv json, validation, atomic write)"
```

---

### Task 6: A4b — fix flow arg-quoting in publish-pipeline

**Files:** `~/Code/windmill-workspace` publish-pipeline flow file (steps `c_register`, `d_humanize`, `e_hero_html`, `h_linkedin_html`, `i_screenshot_linkedin`, `j_obsidian`, and check `o_teasers_initial`, `r_teasers_followup`).

- [ ] **Step 1: Confirm clean sync**

```bash
cd ~/Code/windmill-workspace && export PATH="$HOME/.deno/bin:$PATH" && wmill sync pull --yes && git status --porcelain
```

- [ ] **Step 2: Escape inner quotes in the affected remote commands**

For each listed step, the remote SSH command currently embeds args like:
```
"bash /Users/shane/Code/blog-publisher/bin/phases/register-article.sh "$slug" "$title" "$description_text" "$pub_date" "$category""
```
where the inner `"` are NOT escaped. Change them to escaped quotes so the args survive the SSH boundary as single tokens (matching the correct `a_stage` pattern):
```
"bash /Users/shane/Code/blog-publisher/bin/phases/register-article.sh \"$slug\" \"$title\" \"$description_text\" \"$pub_date\" \"$category\""
```
Apply the same `\"` escaping to every argument in `c_register`, `d_humanize`, `e_hero_html`, `h_linkedin_html`, `i_screenshot_linkedin`, `j_obsidian`. For `o_teasers_initial`/`r_teasers_followup`, verify each `$title`/`$article_url`/`$description_text` is `\"`-escaped.

- [ ] **Step 3: Static check — no bare unescaped arg quotes remain**

```bash
cd ~/Code/windmill-workspace
# every register-article/run-stage/etc. invocation should use \" not bare "
grep -RnE 'phases/(register-article|run-humanize|run-hero-html|run-linkedin-html|screenshot-linkedin|save-obsidian)\.sh ' f/blog/ | grep -v '\\"' \
  && echo "FOUND UNESCAPED — fix" || echo "OK: all escaped"
```
Expected: `OK: all escaped`.

- [ ] **Step 4: Deploy + verify**

```bash
wmill sync push --yes && bin/verify-sync.sh
```

- [ ] **Step 5: Commit**

```bash
git add -A && git commit -m "fix: escape ssh-boundary arg quotes in publish-pipeline steps"
```

---

### Task 7: A4c — harden `commit-push.sh`

**Files:**
- Modify: `~/Code/blog-publisher/bin/phases/commit-push.sh`
- Test: `~/Code/blog-publisher/tests/test_commit_push.sh` (new)

- [ ] **Step 1: Write the failing test**

Create `~/Code/blog-publisher/tests/test_commit_push.sh`:
```bash
#!/usr/bin/env bash
set -uo pipefail
HERE="$(cd "$(dirname "$0")/.." && pwd)"
PASS=0; FAIL=0; ok(){ echo "ok - $1"; PASS=$((PASS+1)); }; no(){ echo "NOT OK - $1"; FAIL=$((FAIL+1)); }
TMP="$(mktemp -d)"; trap 'rm -rf "$TMP"' EXIT

git init -q "$TMP/site"; cd "$TMP/site"; git config user.email t@t; git config user.name t
git remote add origin "$TMP/remote.git"; git init -q --bare "$TMP/remote.git"
mkdir -p pages/articles/technical-deep-dives public/images resources/data design/shane-personal-v2/{artifacts,screenshots}
echo '# post' > pages/articles/technical-deep-dives/my-post.md
echo '{}' > resources/data/articles-list.json
echo 'self.x=1' > public/sw.js
git add -A; git commit -qm init; git push -q origin HEAD:source

export SITE_REPO="$TMP/site"
RUN(){ SITE_REPO="$TMP/site" bash "$HERE/bin/phases/commit-push.sh" "$@"; }

# 1. Missing required hero/og images -> non-zero (must NOT push article without its images).
if RUN my-post >/dev/null 2>&1; then no "fails when required images missing"; else ok "fails when required images missing"; fi

# 2. With images present -> success and a new commit exists on source.
: > public/images/my-post-og.png; : > public/images/my-post-hero.png; : > public/images/my-post-linkedin.png
printf 'x%.0s' {1..2048} > public/images/my-post-og.png
cp public/images/my-post-og.png public/images/my-post-hero.png
cp public/images/my-post-og.png public/images/my-post-linkedin.png
BEFORE=$(git -C "$TMP/site" rev-parse HEAD)
RUN my-post >/dev/null 2>&1 && [ "$(git -C "$TMP/site" rev-parse HEAD)" != "$BEFORE" ] && ok "commits when images present" || no "commits when images present"

echo "PASS=$PASS FAIL=$FAIL"; [ "$FAIL" -eq 0 ]
```
`chmod +x` it.

- [ ] **Step 2: Run to verify it fails**

Run: `bash ~/Code/blog-publisher/tests/test_commit_push.sh`
Expected: FAIL — current script `git add … 2>/dev/null || true` swallows missing images and would push without them.

- [ ] **Step 3: Rewrite `commit-push.sh`**

```bash
#!/usr/bin/env bash
# Stage required files and push to origin/source. Fails closed on missing assets.
# Usage: commit-push.sh <slug>
set -euo pipefail
BLOG_HOME="$(cd "$(dirname "$0")/../.." && pwd)"
source "${BLOG_HOME}/lib/common.sh"

SLUG="$1"
cd "$SITE_REPO"

ARTICLE_PATH="$(find ./pages/articles -name "${SLUG}.md" | head -1 | sed 's|./||')"
[[ -z "$ARTICLE_PATH" ]] && die "article not found for ${SLUG}"

# Required assets — fail if absent (never publish an article missing its images).
for img in "public/images/${SLUG}-og.png" "public/images/${SLUG}-hero.png" "public/images/${SLUG}-linkedin.png"; do
  [[ -s "$img" ]] || die "required image missing or empty: $img"
  git add "$img"
done

git add "$ARTICLE_PATH" public/sw.js
git add "resources/data/articles-list.json"
# Optional design artifacts — warn if absent, don't fail.
git add "design/shane-personal-v2/artifacts/blog-hero-"*"-${SLUG}.html" 2>/dev/null || log "no hero artifact for ${SLUG}"
git add "design/shane-personal-v2/artifacts/linkedin-"*"-${SLUG}.html" 2>/dev/null || log "no linkedin artifact for ${SLUG}"
git add "design/shane-personal-v2/screenshots/linkedin-${SLUG}.png" 2>/dev/null || log "no linkedin screenshot for ${SLUG}"

if git diff --cached --quiet; then
  log "nothing staged for ${SLUG}; skipping commit"; echo "NOOP: ${SLUG}"; exit 0
fi

BEFORE="$(git rev-parse HEAD)"
git commit -m "feat: publish ${SLUG}"
[[ "$(git rev-parse HEAD)" != "$BEFORE" ]] || die "commit did not advance HEAD"

# push with retry/backoff
for attempt in 1 2 3; do
  if git push origin source; then echo "PUSHED: ${SLUG} → origin/source"; exit 0; fi
  log "push attempt ${attempt} failed; retrying in $((attempt*5))s"; sleep $((attempt*5))
done
die "git push failed after 3 attempts for ${SLUG}"
```

- [ ] **Step 4: Run to verify it passes**

Run: `bash ~/Code/blog-publisher/tests/test_commit_push.sh`
Expected: `PASS=2 FAIL=0`.

- [ ] **Step 5: Commit**

```bash
cd ~/Code/blog-publisher
git add bin/phases/commit-push.sh tests/test_commit_push.sh
git commit -m "fix: commit-push fails on missing images, verifies commit, retries push"
```

---

### Task 8: A4d — anchor `find_due_drafts` to frontmatter + dedupe

**Files:**
- Modify: `~/Code/blog-publisher/lib/common.sh` (`find_due_drafts`)
- Test: `~/Code/blog-publisher/tests/test_find_due_drafts.sh` (new)

- [ ] **Step 1: Write the failing test**

Create `~/Code/blog-publisher/tests/test_find_due_drafts.sh`:
```bash
#!/usr/bin/env bash
set -uo pipefail
HERE="$(cd "$(dirname "$0")/.." && pwd)"
PASS=0; FAIL=0; ok(){ echo "ok - $1"; PASS=$((PASS+1)); }; no(){ echo "NOT OK - $1"; FAIL=$((FAIL+1)); }
TMP="$(mktemp -d)"; trap 'rm -rf "$TMP"' EXIT
mkdir -p "$TMP/drafts"

# A: due in frontmatter
printf -- '---\npublishDate: 2026-05-28\nslug: a\n---\nbody\n' > "$TMP/drafts/a.md"
# B: publishDate only in BODY (must NOT match)
printf -- '---\nslug: b\n---\nExample: publishDate: 2026-05-28 in a code block\n' > "$TMP/drafts/b.md"
# C: different date (must NOT match)
printf -- '---\npublishDate: 2026-01-01\n---\nx\n' > "$TMP/drafts/c.md"

export VAULT_DRAFTS_DIR="$TMP/drafts"
source "$HERE/lib/common.sh"
OUT="$(find_due_drafts 2026-05-28)"

echo "$OUT" | grep -q '/a.md' && ok "matches frontmatter date" || no "matches frontmatter date"
echo "$OUT" | grep -q '/b.md' && no "ignores body match" || ok "ignores body match"
echo "$OUT" | grep -q '/c.md' && no "ignores other dates" || ok "ignores other dates"
echo "PASS=$PASS FAIL=$FAIL"; [ "$FAIL" -eq 0 ]
```
`chmod +x` it. (Sourcing `common.sh` triggers its `mkdir -p` of STATE_DIR/LOG_DIR under `$HOME` — acceptable in test.)

- [ ] **Step 2: Run to verify it fails**

Run: `bash ~/Code/blog-publisher/tests/test_find_due_drafts.sh`
Expected: FAIL on "ignores body match" — current `grep -rl '^publishDate: …'` scans whole file.

- [ ] **Step 3: Rewrite `find_due_drafts` in `lib/common.sh`**

Replace the function body (lines ~30-35) with a frontmatter-only scan:
```bash
# find_due_drafts [date]
# Prints vault .md file paths whose YAML FRONTMATTER (between the first two ---)
# has: publishDate: <date>. Dedupes by file. date defaults to today.
find_due_drafts() {
  local target_date="${1:-$(date +%Y-%m-%d)}"
  local search_dir="${VAULT_DRAFTS_DIR}"
  local f
  while IFS= read -r f; do
    awk -v want="publishDate: ${target_date}" '
      /^---[[:space:]]*$/ { c++; if (c==2) exit; next }
      c==1 && index($0, want)==1 { found=1; exit }
      END { exit (found?0:1) }
    ' "$f" && printf '%s\n' "$f"
  done < <(grep -rl --include="*.md" "publishDate: ${target_date}" "${search_dir}" 2>/dev/null | grep -v '/\.' | sort -u)
}
```
(The outer `grep -rl` is a fast pre-filter; the `awk` confirms the match is inside the frontmatter block. `index(...)==1` anchors to line start.)

- [ ] **Step 4: Run to verify it passes**

Run: `bash ~/Code/blog-publisher/tests/test_find_due_drafts.sh`
Expected: `PASS=3 FAIL=0`.

- [ ] **Step 5: Commit**

```bash
cd ~/Code/blog-publisher
git add lib/common.sh tests/test_find_due_drafts.sh
git commit -m "fix: anchor find_due_drafts to frontmatter block and dedupe"
```

---

### Task 9: A3 — fail-closed pre/post-build validation gate

**Files:**
- Create: `~/Code/blog-publisher/bin/phases/validate-publish.sh`
- Test: `~/Code/blog-publisher/tests/test_validate_publish.sh` (new)
- Modify (Task 12 wiring): publish-pipeline flow in `~/Code/windmill-workspace`

- [ ] **Step 1: Determine the built-article path convention**

Run a known-good build and record where an article lands in `dist/`:
```bash
cd ~/Code/shane.logsdon.io && composer build >/dev/null 2>&1
find dist/articles -name 'index.html' | head; ls dist/articles/strategic-insights/ 2>/dev/null | head
```
Record the pattern (expected: `dist/articles/<category>/<slug>/index.html` given netlify `prettyURLs`/`trailingSlash`). Use the **observed** pattern in Step 3's `post` check.

- [ ] **Step 2: Write the failing test**

Create `~/Code/blog-publisher/tests/test_validate_publish.sh`:
```bash
#!/usr/bin/env bash
set -uo pipefail
HERE="$(cd "$(dirname "$0")/.." && pwd)"
PASS=0; FAIL=0; ok(){ echo "ok - $1"; PASS=$((PASS+1)); }; no(){ echo "NOT OK - $1"; FAIL=$((FAIL+1)); }
TMP="$(mktemp -d)"; trap 'rm -rf "$TMP"' EXIT
S="$TMP/site"
mkdir -p "$S/resources/data" "$S/pages/articles/strategic-insights" "$S/public/images" \
         "$S/dist/articles/strategic-insights/good-post"
printf '{"strategic-insights":"Strategic Insights"}' > "$S/resources/data/categories.json"
cat > "$S/pages/articles/strategic-insights/good-post.md" <<'MD'
---
title: Good Post
date: 2026-05-28
slug: good-post
description: A fine description.
draft: false
image: /images/good-post-og.png
---
Body.
MD
printf '%s' '{"good-post":{"title":"Good Post","description":"d","date":"2026-05-28","category":"strategic-insights","archived":false,"tags":[]}}' \
  > "$S/resources/data/articles-list.json"
for i in og hero linkedin; do printf 'x%.0s' {1..2048} > "$S/public/images/good-post-$i.png"; done
echo '<html>article</html>' > "$S/dist/articles/strategic-insights/good-post/index.html"

export SITE_REPO="$S"
V(){ SITE_REPO="$S" bash "$HERE/bin/phases/validate-publish.sh" "$@"; }

V pre good-post strategic-insights >/dev/null 2>&1 && ok "valid article passes PRE" || no "valid article passes PRE"
V post good-post strategic-insights >/dev/null 2>&1 && ok "valid article passes POST" || no "valid article passes POST"

# break category
V pre good-post not-a-cat >/dev/null 2>&1 && no "rejects bad category" || ok "rejects bad category"
# break json
echo 'NOT JSON' > "$S/resources/data/articles-list.json"
V pre good-post strategic-insights >/dev/null 2>&1 && no "rejects invalid list json" || ok "rejects invalid list json"
# restore json, remove an image
printf '%s' '{"good-post":{"title":"Good Post","description":"d","date":"2026-05-28","category":"strategic-insights","archived":false,"tags":[]}}' > "$S/resources/data/articles-list.json"
rm "$S/public/images/good-post-hero.png"
V pre good-post strategic-insights >/dev/null 2>&1 && no "rejects missing image" || ok "rejects missing image"
# missing built html
rm -rf "$S/dist/articles/strategic-insights/good-post"
V post good-post strategic-insights >/dev/null 2>&1 && no "rejects unrendered article" || ok "rejects unrendered article"

echo "PASS=$PASS FAIL=$FAIL"; [ "$FAIL" -eq 0 ]
```
`chmod +x` it.

- [ ] **Step 3: Run to verify it fails**

Run: `bash ~/Code/blog-publisher/tests/test_validate_publish.sh`
Expected: FAIL — script doesn't exist.

- [ ] **Step 4: Write `validate-publish.sh`**

Create `~/Code/blog-publisher/bin/phases/validate-publish.sh` (use the `dist/` pattern observed in Step 1; the default below assumes `dist/articles/<category>/<slug>/index.html`):
```bash
#!/usr/bin/env bash
# Fail-closed publish validation. Usage: validate-publish.sh <pre|post> <slug> <category>
set -euo pipefail
BLOG_HOME="$(cd "$(dirname "$0")/../.." && pwd)"
source "${BLOG_HOME}/lib/common.sh"

MODE="$1"; SLUG="$2"; CATEGORY="$3"
LIST="${SITE_REPO}/resources/data/articles-list.json"
CATS="${SITE_REPO}/resources/data/categories.json"
ARTICLE="${SITE_REPO}/pages/articles/${CATEGORY}/${SLUG}.md"
DIST_HTML="${SITE_REPO}/dist/articles/${CATEGORY}/${SLUG}/index.html"

case "$MODE" in
  pre)
    SLUG="$SLUG" CATEGORY="$CATEGORY" LIST="$LIST" CATS="$CATS" ARTICLE="$ARTICLE" \
    SITE_REPO="$SITE_REPO" python3 - <<'PYEOF'
import json, os, re, sys
def die(m): sys.stderr.write("VALIDATION_FAILED(pre): %s\n" % m); sys.exit(1)
slug=os.environ["SLUG"]; cat=os.environ["CATEGORY"]
list_p=os.environ["LIST"]; cats_p=os.environ["CATS"]; art=os.environ["ARTICLE"]; site=os.environ["SITE_REPO"]
# 1. articles-list.json valid
try: json.load(open(list_p))
except Exception as e: die("articles-list.json invalid: %s" % e)
# 2. category valid
cats=json.load(open(cats_p))
if cat not in cats: die("unknown category %r" % cat)
# 3. article file exists
if not os.path.isfile(art): die("article missing: %s" % art)
# 4. frontmatter parse + required fields
text=open(art, encoding="utf-8").read()
m=re.match(r"^---\n(.*?)\n---\n", text, re.S)
if not m: die("no/closed frontmatter block")
fm={}
for line in m.group(1).splitlines():
    if ":" in line:
        k,_,v=line.partition(":"); fm[k.strip()]=v.strip().strip('"').strip("'")
for req in ("title","date","slug","description"):
    if not fm.get(req): die("missing frontmatter field: %s" % req)
if not re.fullmatch(r"\d{4}-\d{2}-\d{2}", fm["date"]): die("bad date: %r" % fm["date"])
if not re.fullmatch(r"[a-z0-9-]+", fm["slug"]): die("bad slug: %r" % fm["slug"])
if fm["slug"]!=slug: die("frontmatter slug %r != %r" % (fm["slug"], slug))
# 5. required images present and non-trivial
for kind in ("og","hero","linkedin"):
    p=os.path.join(site,"public","images","%s-%s.png"%(slug,kind))
    if not (os.path.isfile(p) and os.path.getsize(p)>1024): die("missing/small image: %s" % p)
print("VALIDATE_PRE_OK: %s" % slug)
PYEOF
    ;;
  post)
    [[ -s "$DIST_HTML" ]] || die "VALIDATION_FAILED(post): article not rendered: ${DIST_HTML}"
    echo "VALIDATE_POST_OK: ${SLUG}"
    ;;
  *) die "usage: validate-publish.sh <pre|post> <slug> <category>" ;;
esac
```

- [ ] **Step 5: Run to verify it passes**

Run: `bash ~/Code/blog-publisher/tests/test_validate_publish.sh`
Expected: `PASS=6 FAIL=0`.

- [ ] **Step 6: Commit (script only; flow wiring is Task 12)**

```bash
cd ~/Code/blog-publisher
git add bin/phases/validate-publish.sh tests/test_validate_publish.sh
git commit -m "feat: add fail-closed pre/post-build publish validation gate"
```

---

### Task 10: A5 — Buffer scheduling idempotency + atomic state

**Files:**
- Modify: `~/Code/blog-publisher/bin/phases/schedule-buffer.sh`, `~/Code/blog-publisher/bin/phases/update-state.sh`
- Test: `~/Code/blog-publisher/tests/test_state_atomic.sh` (new)

- [ ] **Step 1: Read both scripts to confirm current state model**

Run: `sed -n '1,80p' ~/Code/blog-publisher/bin/phases/schedule-buffer.sh ~/Code/blog-publisher/bin/phases/update-state.sh`
Identify where the per-slug state file is written and where `schedule_post()` POSTs to Buffer.

- [ ] **Step 2: Write the failing test for atomic state write**

Create `~/Code/blog-publisher/tests/test_state_atomic.sh`:
```bash
#!/usr/bin/env bash
set -uo pipefail
HERE="$(cd "$(dirname "$0")/.." && pwd)"
PASS=0; FAIL=0; ok(){ echo "ok - $1"; PASS=$((PASS+1)); }; no(){ echo "NOT OK - $1"; FAIL=$((FAIL+1)); }
TMP="$(mktemp -d)"; trap 'rm -rf "$TMP"' EXIT
export STATE_DIR_OVERRIDE="$TMP/state"; mkdir -p "$STATE_DIR_OVERRIDE"
# update-state.sh must write valid JSON atomically and be re-runnable without corruption.
export HOME="$TMP"  # STATE_DIR derives from HOME in common.sh
SLUG=demo-post
SITE_REPO="$TMP" bash "$HERE/bin/phases/update-state.sh" "$SLUG" initial >/dev/null 2>&1 || true
SF="$TMP/.blog-publisher/state/${SLUG}.json"
[ -f "$SF" ] && python3 -c "import json,sys; json.load(open('$SF'))" && ok "state file is valid json" || no "state file is valid json"
# second run must not corrupt
SITE_REPO="$TMP" bash "$HERE/bin/phases/update-state.sh" "$SLUG" different_angle >/dev/null 2>&1 || true
python3 -c "import json; json.load(open('$SF'))" && ok "rerun keeps valid json" || no "rerun keeps valid json"
echo "PASS=$PASS FAIL=$FAIL"; [ "$FAIL" -eq 0 ]
```
`chmod +x` it.

- [ ] **Step 3: Run to verify current behavior**

Run: `bash ~/Code/blog-publisher/tests/test_state_atomic.sh`
Expected: likely PASS for "valid json" (json.dump usually succeeds) — the real fix is crash-atomicity + Buffer idempotency, which this test pins as a regression guard. If it passes already, proceed to harden anyway (Steps 4-5) and keep the test green.

- [ ] **Step 4: Make state writes atomic in `update-state.sh`**

Wherever the script does `open(STATE_FILE,"w")`/`json.dump(...)`, change to write a temp file then `os.replace`:
```python
import os, tempfile, json
d=os.path.dirname(state_file); fd,tmp=tempfile.mkstemp(dir=d,suffix=".tmp")
with os.fdopen(fd,"w") as f: json.dump(state, f, indent=2)
json.load(open(tmp))            # verify
os.replace(tmp, state_file)     # atomic swap
```
(Match the script's existing variable names for `state`/`state_file`.)

- [ ] **Step 5: Add idempotency guard in `schedule-buffer.sh`**

Before `schedule_post()` POSTs, skip if a pending Buffer update with the same text already exists:
```bash
already_scheduled() { # $1=channel_id $2=text
  curl -s -H "Authorization: Bearer ${BUFFER_ACCESS_TOKEN}" \
    "https://api.bufferapp.com/1/profiles/$1/updates/pending.json" \
    | python3 -c "import json,sys,os; d=json.load(sys.stdin); t=os.environ['T']; sys.exit(0 if any(u.get('text','').strip()==t.strip() for u in d.get('updates',[])) else 1)" 2>/dev/null
}
# usage in schedule_post(), before the POST:
if T="$POST_TEXT" already_scheduled "$CHANNEL_ID" "$POST_TEXT"; then
  log "duplicate Buffer post for ${SLUG} (${PLATFORM}); skipping"; return 0
fi
```
(Adapt `$CHANNEL_ID`/`$POST_TEXT`/`$PLATFORM` to the script's actual variable names found in Step 1.)

- [ ] **Step 6: Run the test (still green) and commit**

```bash
bash ~/Code/blog-publisher/tests/test_state_atomic.sh   # PASS
cd ~/Code/blog-publisher
git add bin/phases/schedule-buffer.sh bin/phases/update-state.sh tests/test_state_atomic.sh
git commit -m "fix: atomic social state writes and Buffer duplicate guard"
```

---

### Task 11: A6 — Obsidian failure alerts on all three flows

**Files:**
- Create: `~/Code/blog-publisher/bin/failure-notify.sh` (runs on the mini, called by each flow's failure_module via SSH)
- Modify: all three flow files in `~/Code/windmill-workspace` (`failure_module`)

- [ ] **Step 1: Write the notifier (runs on the mini)**

Create `~/Code/blog-publisher/bin/failure-notify.sh`:
```bash
#!/usr/bin/env bash
# Write a pipeline-failure note into Obsidian + commit the vault.
# Usage: failure-notify.sh <flow> <job_id> <step> <error...>
set -euo pipefail
BLOG_HOME="$(cd "$(dirname "$0")/.." && pwd)"
FLOW="$1"; JOB="$2"; STEP="$3"; shift 3; ERR="$*"
TS="$(date '+%Y-%m-%d %H:%M:%S')"
NOTE="pipeline-failure-${FLOW}-${JOB}"
BODY="$(mktemp)"; trap 'rm -f "$BODY"' EXIT
cat > "$BODY" <<EOF
# ⚠️ Pipeline failure: ${FLOW}

- **When:** ${TS}
- **Flow:** ${FLOW}
- **Job:** [${JOB}](http://mbp.local/run/${JOB})
- **Failed step:** \`${STEP}\`

\`\`\`
${ERR}
\`\`\`
EOF
bash "${BLOG_HOME}/../otel-local-ai/bin/obsidian-proxy.sh" create "$NOTE" "$BODY"
bash "${BLOG_HOME}/../otel-local-ai/bin/obsidian-proxy.sh" commit "docs: pipeline failure ${FLOW} ${JOB}"
echo "FAILURE_NOTED: ${NOTE}"
```
(Path to `obsidian-proxy.sh` is `~/Code/otel-local-ai/bin/obsidian-proxy.sh` — confirm the `create <name> <file>` and `commit <msg>` subcommands match its interface; adjust if it expects content on stdin.)
`chmod +x` it. Commit in blog-publisher:
```bash
cd ~/Code/blog-publisher && git add bin/failure-notify.sh && git commit -m "feat: add pipeline failure-notify (obsidian note)"
```

- [ ] **Step 2: Update each flow's `failure_module` to call it**

In `~/Code/windmill-workspace`, set the `failure_module` content of `judge-pipeline`, `publish-pipeline`, and **add one to `vault-check`** (it has none). Body (bash) — writes JSONL on mbp and SSHes to the mini to notify:
```bash
mac_mini_key="$1"
KEY_FILE="/tmp/wm_key_$$"; echo "$mac_mini_key" > "$KEY_FILE"; chmod 600 "$KEY_FILE"; trap "rm -f $KEY_FILE" EXIT
printf '{"ts":"%s","flow":"%s","job":"%s","step":"%s","error":"%s"}\n' \
  "$(date -u +%FT%TZ)" "$WM_FLOW_PATH" "$WM_FLOW_JOB_ID" "$WM_FLOW_STEP_ID" "${WM_FLOW_STEP_ERROR//\"/\\\"}" \
  >> /tmp/windmill-failures.jsonl
ssh -i "$KEY_FILE" -o StrictHostKeyChecking=accept-new -o BatchMode=yes -o ConnectTimeout=30 \
  shane@192.168.86.34 \
  "bash /Users/shane/Code/blog-publisher/bin/failure-notify.sh \"$WM_FLOW_PATH\" \"$WM_FLOW_JOB_ID\" \"$WM_FLOW_STEP_ID\" \"${WM_FLOW_STEP_ERROR//\"/\\\"}\""
echo "PIPELINE_FAILED at step $WM_FLOW_STEP_ID: $WM_FLOW_STEP_ERROR"
```
Add `mac_mini_key` to the failure_module's `input_transforms` (`variable('u/admin/mac_mini_ssh_key')`). (`WM_FLOW_PATH` may be unset in some versions; fall back to a literal flow name per flow if needed.)

- [ ] **Step 3: Do NOT push yet** (batched with Task 12). Commit:

```bash
cd ~/Code/windmill-workspace && git add -A && git commit -m "feat: failure_module writes obsidian note + jsonl on all three flows"
```

---

### Task 12: A7 + wiring — deploy fact-check, wire validation gate, single reviewed push

**Files:** `~/Code/windmill-workspace` publish-pipeline (insert validation steps); deploy everything batched since Task 4.

- [ ] **Step 1: Insert validation steps into publish-pipeline**

Add two SSH steps to the publish-pipeline flow file, matching the existing step pattern (key-file boilerplate + `ssh … "bash …/validate-publish.sh …"`):
- `k0_validate_pre` — placed **immediately before** `k_build`; runs `validate-publish.sh pre "$slug" "$category"`; inputs `slug`,`category`,`mac_mini_key`; `retry` ABSENT (deterministic — fail fast).
- `k2_validate_post` — placed **after** `k_build`, **before** `m_commit_push`; runs `validate-publish.sh post "$slug" "$category"`; same inputs; no retry.

Use `\"`-escaped args (Task 6 rule). Confirm `add_retries.py`'s `NO_RETRY_IDS` already lists these two so a future run won't add retries to them.

- [ ] **Step 2: Confirm judge-pipeline has e_factcheck (from Task 1, Step 5)**

```bash
cd ~/Code/windmill-workspace
grep -rl factcheck f/blog/ && echo "OK: factcheck present in repo judge-pipeline"
```
Expected: prints the judge-pipeline file + `OK`.

- [ ] **Step 3: Pull-diff guard, then deploy the full batch**

```bash
export PATH="$HOME/.deno/bin:$PATH"
wmill sync pull --yes        # capture any live hand-edits first
git status --porcelain       # if non-empty, reconcile before pushing
wmill sync push --yes
bin/verify-sync.sh
```
Expected: `IN SYNC`.

- [ ] **Step 4: Verify live state in Windmill**

```bash
# judge-pipeline now has factcheck:
ssh mbp.local "docker exec windmill-db-1 psql -U postgres -d windmill -t -A -c \"select value::text from flow where workspace_id='personal' and path='f/blog/judge-pipeline';\"" | grep -c factcheck
# publish-pipeline now has the two validate steps:
ssh mbp.local "docker exec windmill-db-1 psql -U postgres -d windmill -t -A -c \"select value::text from flow where workspace_id='personal' and path='f/blog/publish-pipeline';\"" | grep -c validate-publish
```
Expected: both counts ≥ 1.

- [ ] **Step 5: Commit**

```bash
git add -A && git commit -m "feat: wire validation gate into publish-pipeline; deploy fact-check stage"
```

---

### Task 13: Run the blog-publisher test suite

**Files:** none.

- [ ] **Step 1: Run all tests**

```bash
cd ~/Code/blog-publisher
for t in tests/test_*.sh; do echo "== $t =="; bash "$t" || { echo "FAILED: $t"; exit 1; }; done
echo "ALL TESTS PASS"
```
Expected: `ALL TESTS PASS`.

- [ ] **Step 2: Commit (if any test files adjusted)** — otherwise skip.

---

### Task 14: CHECKPOINT — end-to-end dry run on a throwaway draft

**Files:** none (operational verification).

- [ ] **Step 1: Verify Windmill + sync health**

```bash
ssh mbp.local 'docker ps --format "{{.Names}} {{.Status}}" | grep windmill_server'
cd ~/Code/windmill-workspace && export PATH="$HOME/.deno/bin:$PATH" && bin/verify-sync.sh
```
Expected: server `Up`; `IN SYNC`.

- [ ] **Step 2: Run one judge-pipeline with a tiny seed draft**

Trigger `f/blog/judge-pipeline` from the Windmill UI (or `curl … /jobs/run/f/blog/judge-pipeline` with a short `seed_draft`). Watch that: steps retry rather than hard-fail on any transient blip; `e_factcheck` executes; the approval gate suspends. Approve with `approved=false` to stop before vault write (no real publish). Confirm no failure note was created.

- [ ] **Step 3: Run one publish-pipeline on a throwaway slug**

Stage a disposable draft, trigger `f/blog/publish-pipeline`. Confirm: `k0_validate_pre` passes for a good article and **fails closed** if you remove an image; `k2_validate_post` passes only after a real build; `m_commit_push` refuses to push when images are missing. Use a scratch branch/slug; reset afterward (`git -C ~/Code/shane.logsdon.io checkout -- .` and delete the scratch article) so nothing reaches `origin/source`.

- [ ] **Step 4: Force a failure and confirm the alert**

Temporarily point one step at a bad host or kill SSH, let a step exhaust retries, and confirm: (a) a line in `/tmp/windmill-failures.jsonl` on mbp; (b) a "⚠️ Pipeline failure" note committed in the Obsidian vault. Restore the step.

- [ ] **Step 5: Final report**

Summarize: token rotated + old revoked; retries live; validation gate fail-closed; fact-check deployed; alerts firing; repo in sync. Sub-project A complete. Open PRs (or merge per finishing-a-development-branch) for `blog-publisher`, `otel-local-ai` (judge flow copy, if retained), and push `windmill-workspace` to a remote for off-box backup.

---

## Self-Review

**Spec coverage:** A0→Task 1; A1→Task 2; A2→Task 4; A3→Task 9 (+wire Task 12); A4→Tasks 5,6,7,8; A5→Task 10; A6→Task 11; A7→Task 1 Step 5 + Task 12; A8→Task 3. Testing strategy → Tasks 13–14. All spec sections mapped.

**Placeholder scan:** Environment-determined items (wmill file layout, exact `dist/` path, `obsidian-proxy.sh`/`schedule-buffer.sh` internal variable names) are resolved by an explicit discovery step (Task 1 Step 3; Task 9 Step 1; Task 10 Step 1; Task 11 Step 1) before being used — not hand-waved. All net-new scripts have complete code + tests.

**Type/name consistency:** `validate-publish.sh <pre|post> <slug> <category>` used consistently (Tasks 9, 12). `NO_RETRY_IDS = {k0_validate_pre, k2_validate_post}` (Task 4) matches the step IDs added in Task 12. `failure-notify.sh <flow> <job> <step> <error>` matches the failure_module call (Task 11). `register-article.sh` argv order matches its callers and the quoting fix (Tasks 5, 6).

**Risks honored:** token rotate-then-revoke (Task 2 Step 4); pull-diff-before-push guard (Tasks 2,6,12); fact-check deploy verified (Task 12 Step 4); validation messages are specific and actionable.
