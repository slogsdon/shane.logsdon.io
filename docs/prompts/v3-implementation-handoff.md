# Handoff prompt: implement design system v3

> Copy everything below the line into a fresh session started in `~/Code/shane.logsdon.io`.

---

ultracode

Implement design system v3 across shane.logsdon.io. Use dynamic workflows to parallelize the work, and hold my voice in every string you write.

## Read these first, in this order

1. `design/shane-personal-v2/DESIGN.md` is the system. It is v3; the folder slug still says v2 because `publish-post/SKILL.md` hardcodes that slug in ~15 paths.
   Note what is *not* there: no `DESIGN-PLAN.md`, and `showcase.html` is still v2. Phases 0 and 1 close those.
2. `CLAUDE.md` at the repo root, for stack, build commands, and the rules most easily drifted from.
3. My voice profile: `obsidian read file='voice'`. Read it before you write any copy at all.
4. `design/shane-personal-v2/iterations/v3-site-mockup.html`, ten pages already mocked and rendered. This is the target, not a suggestion. Open it in a browser before you plan.

The v3 work is committed on branch `feature/design-system-v3` (3 commits). Start there.

## Voice: applies to every string, not just prose

Everything you write carries my voice, including the strings that do not look like writing: nav labels, CTA text, figure captions, alt text, form labels, error states, meta descriptions, and commit messages.

The hard refusals most likely to be violated in interface copy:

- **No em-dashes. Anywhere, in any form.** Not in captions, not in alt text, not in commit bodies. Use a period, a comma, or parentheses.
- **Never "simply", "just", "obviously", "actually".** They assume the reader is behind you.
- No em-dash lists, no single-noun colon-reveals, no semicolons joining independent clauses.
- No performative confidence words: "game-changer", "unlock", "10x", "revolutionary".
- No emoji-prefixed bullet headers, no highlight-reel structure.
- **Never invent specifics, war stories, or receipts.** The voice is portable; the lived material is not. If a caption needs a number the source does not contain, do not write the caption. Ask me for the grounding detail or cut the element.

Shape to aim for: long building sentence, then a tight short landing. Specificity that earns its slot. If removing a detail would not weaken the sentence, cut the detail.

CTA copy follows the same rule the design system already states: name the actual next step and what the reader gets. Not "Learn more".

## Scope A: build v3 into the templates

The architecture for each page is already decided. `DESIGN.md` §Architectures carries an ordered five-question test and a mapping table of all 14 page types. **Do not re-derive the architecture for a page that already has a row.** For a page not in the table, run the test, name the question that decided it, and add a row.

Files in play:

- `pages/*.php` (14 pages)
- `resources/partials/layouts/` (7 layouts): `main`, `master`, `post-list`, `writing-post`, `topic-list`, `archive-list`, `loop-and-gate-guide`
- `resources/partials/components/`, 7 components that already exist and are load-bearing: `newsletter`, `contact-cta`, `author-bio`, `post-list`, `audit-form`, `footer`, `site-menu`
- `public/_/input.css` **holds a parallel copy of the color tokens and is missing `--color-mark: #c0392b`.** Sync it first or everything downstream drifts.

Three things that are normative and that I have already had to correct once each:

- **Lists are date descending, always.** `001` is newest. Category is metadata on the row and a filter above the list, never a grouping.
- **Annotation red marks only what a drawing calls out.** Never a heading, never a link, never on a page with no figure.
- **The local-business practice stays demoted.** Footer link only, never in the primary nav, one muted line on the home page. Primary nav is About, Articles, Speaking, Work, Resume. The audit funnel lives on the practice pages, not `/contact/`.

## Phasing: run the design flow first, then build

The design flow is `design-plan` then `design-system` then `design-ui-components`, and only then the site. v3 was promoted with that flow half-executed, so phases 0 through 2 are closing real gaps before any template gets touched. Do not skip ahead to phase 3 because the system "looks done." It is missing its intent layer and one of its three artifacts.

Land one phase, verify it, commit it. Do not attempt several in one pass.

### Phase 0: `design-plan` (missing entirely)

There is no `design/shane-personal-v2/DESIGN-PLAN.md`. The strategic intent layer behind v3 was never written down; it exists only as HTML comments in the iterations and as conversation that is now gone.

Invoke the `design-plan` skill for brand slug `shane-personal-v2` and **reconstruct** the plan from evidence rather than inventing direction. The system is already committed, so the plan must describe what was decided, not propose something new. If the plan you write disagrees with `DESIGN.md`, the plan is wrong.

Source material, in order of authority:

- `design/shane-personal-v2/iterations/v3-round3-architecture.html` and `v3-site-mockup.html`, whose header comments record what each round tested and why
- `design/shane-personal-v2/iterations/v3-round2-color-and-figure.html`, which records why Drafting won over Riso, Plotted, Survey, and Ledger Stock
- `DESIGN.md` frontmatter and the `Diff from v2` comment

The plan must capture at minimum: the anti-convergence stance (the whole point is not looking like the median personal site), the hard NOs, and the four rejected color directions with the reason each lost. The rejected directions matter more than the winner, because they are what stops the next iteration relitigating settled ground.

### Phase 1: `design-system` (two of three outputs done)

`design-system` owns three artifacts. Two are current, one is stale:

- `DESIGN.md`, current, v3
- `tokens.css`, current, v3
- `showcase.html` is **stale**. Last touched 2026-05-19, still v2, contains no `--color-mark`, no callout bubble, no title block, no drawing classes.

Regenerate `showcase.html` against the v3 tokens so the visual proof matches the system it claims to prove. It must show: the palette including annotation red, the type scale, a dimensioned figure with hatch and callouts, the title block, and one example of each of the five architectures at reduced scale.

Do not regenerate `DESIGN.md` or `tokens.css` from scratch. They carry decisions and corrections that a fresh generation pass would lose.

### Phase 2: `design-ui-components` (done, verify)

`components/components.html` already carries eight v3 sections (xix through xxvi): callout bubble, figure with drawing classes, title block and sheet, index strip, newsletter, author bio, form fields, footer link row.

Verify rather than regenerate. Load it in a browser, confirm zero console errors, and confirm the embedded token copy matches `tokens.css`. It embeds tokens verbatim rather than linking them, so it drifts silently. Add anything the phase 1 showcase surfaced as missing.

### Phase 3: token sync and shared components

`public/_/input.css` holds a parallel copy of the color tokens and is missing `--color-mark`. Sync it first, since every page depends on it. Then bring the seven existing component partials to v3.

### Phase 4: Sheet pages

About, Work, Resume, Contact. They share one architecture and the title block, so they are the cheapest way to prove the system on real templates.

### Phase 5: Set pages

Articles, Speaking, Archive. This is where the date-descending rule and the filter-not-grouping rule get enforced in `post-list.php`.

### Phase 6: Home, article layout, Assembly pages

Home (Facing Spread), the article layout (Drawing First or Facing Spread depending on the post), and the Assembly pages (practice, Loop and Gate). Leave these last: they are the most composed and they benefit from everything learned in 4 and 5.

### Phase 7: the one figure

Scope B below. Do it after the article layout exists, since the figure needs somewhere to live.

## Scope B: figures on this year's posts

**The audit is already done. Do not redo it.** Nine 2026 posts were read in full and judged against the v3 figure taxonomy by one agent each, then pruned by a skeptic pass. One figure survived.

Eight posts get **no figure**, with the test that killed each:

| Post | Killed by |
|---|---|
| `the-split-audience` | Ungrounded data. One number (193,217 tokens) with no comparison value stated. |
| `building-on-the-margins` | Restatement. A six-stage cycle would redraw a numbered list the article already prints in full, and contradicts its own "menu, not a mandate" line. |
| `framework-emergence-loop` | Entry requirement. The cycle has no named stages in the text; drawing it means inventing labels. The versions ratchet forward, they do not return. |
| `evaluating-agentic-workflows` | Restatement, plus cross-post repetition. Third of three cycle proposals and the weakest grounded. |
| `the-specification-boundary` | Entry requirement. The 75/25 split is a borrowed number the article itself calls approximate. A vibes split in measurement clothing. |
| `what-aeo-actually-means-for-a-local-business` | Restatement, plus cross-post repetition. A 68/32 bar restating one sentence of a third-party stat. |
| `llm-context-files-are-deliverables-not-config` | Restatement, plus cross-post repetition. The loop is fully resolved in three consecutive sentences. |
| `the-ax-shift` | Ungrounded data. The four deviations are counted but never named, so the rows would be fabricated. |

Reopen one of these only if you find a quantity in the post that the audit missed. "It feels like it could use a diagram" is not new evidence.

### The one figure to build

**Post:** `pages/articles/technical-deep-dives/the-spec-is-the-work.md`
**Type:** Footed table
**Placement:** between the spec quote and the alignment review passage, which sit roughly 1,500 words apart

Rows are the seven fields the `gh-monthly` design spec committed to, each marked delivered or missing:

- Delivered: `item_type`, `id`, `created_at`, `html_url`, `title`
- Missing: `node_id`, `api_url`
- Foot: **7 specified = 5 delivered + 2 missing**

Two callouts maximum, on `node_id` and `api_url`.

Why it is additive: the article's load-bearing claim is that the spec was "precise enough to be falsifiable," and it asserts that without ever showing it. The field list and the gap list are 1,500 words apart, so the reader has to hold seven field names in memory to see that the drifted fields are literally rows in the spec. The table shows the falsifiability the prose only claims.

Both source passages are verbatim in the post. Quote them, do not paraphrase, and do not add a percentage-of-schema-drifted framing.

**Caption constraint, and this one matters:** the alignment review found four deviations, and this table covers only the two that are schema drift. The other two are behavioral (JSONL buffered rather than streamed, retry-aware HTTP client absent). The caption must say so, or the table reads as the complete gap list and becomes a false claim.

### The rule going forward

One figure per article, maximum. Zero is the common and correct answer. If the post does not contain the numbers, there is no figure. Every figure carries a caption naming its source and the date it was read. `DESIGN.md` §Figures and §Density are the authority.

## Verification, before you claim anything is done

- `composer build` succeeds and `npm run build:css` succeeds.
- Screenshot every page you change at 1440px and 390px, and look at them. Headless Chrome is at `/Applications/Google Chrome.app/Contents/MacOS/Google Chrome`; puppeteer is already in `node_modules`.
- Assert computed styles, do not eyeball colors. Confirm `--color-mark` resolves and that no page without a figure uses it anywhere.
- Confirm every list renders date descending.
- Grep your own diff for em-dashes and for "simply", "just", "obviously", "actually" before committing. This has been violated in generated copy before.

## What not to do

- Do not rename the `shane-personal-v2` folder without also updating `publish-post/SKILL.md` in the plugin repo.
- Do not let `design-plan` invent new direction. It is being run retroactively against a system that is already committed and in use. Its job is to record what was decided and why the alternatives lost.
- Do not regenerate `DESIGN.md` or `tokens.css` wholesale. They carry corrections that a fresh pass would silently drop, including the IBM Plex Sans fix and the `.s-edge` hatch trap.
- Do not add figures to the eight posts the audit cleared.
- Do not put the local-business practice in the primary nav.
- Do not push. Commit on the branch and stop.
- Do not touch these untracked files, they are unrelated in-flight work: `design/shane-personal-v2/artifacts/audit-report-2026-07-16-b2pay.html`, `linkedin-banner.html`, `shane-linkedin-banner.png`.

## Report back with

What landed, what you skipped and why, and any place where the design system told you to do something that turned out wrong when built. That last one is the most useful thing you can bring me.
