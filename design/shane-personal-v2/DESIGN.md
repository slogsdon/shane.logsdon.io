---
version: v3
name: Shane Logsdon (v3)
description: Drafting system for a technical product leader at the intersection of payments and developer platforms. Fraunces display + small-caps, IBM Plex Sans body, JetBrains Mono technical-only. Cream/ink/olive from v2, plus a single annotation red with one strict role. The defining move of v3 is that page architecture is a function of content type — five named architectures chosen by an ordered test — and that figures are content-bearing apparatus with entry requirements, never decoration.
colors:
  primary: "#0e1116"
  secondary: "#62686f"
  accent: "#556b2f"
  mark: "#c0392b"
  surface: "#fbfaf9"
  surface-feature: "#ede4d2"
  surface-muted: "#f1eee8"
  inversion-bg: "{colors.ink}"
  inversion-text: "{colors.surface}"
  ink: "#0e1116"
  ink-soft: "#404550"
  ink-3: "#62686f"
  rule: "#d6d8de"
  grid: "#e0e2e6"
  accent-hover: "#3e5020"
typography:
  display-xxl:
    fontFamily: Fraunces
    fontSize: 144px
    fontWeight: 400
    lineHeight: 0.96
    letterSpacing: -0.022em
  display-xl:
    fontFamily: Fraunces
    fontSize: 96px
    fontWeight: 400
    lineHeight: 1.0
    letterSpacing: -0.02em
  display:
    fontFamily: Fraunces
    fontSize: 72px
    fontWeight: 400
    lineHeight: 1.05
    letterSpacing: -0.018em
  headline-lg:
    fontFamily: Fraunces
    fontSize: 56px
    fontWeight: 500
    lineHeight: 1.1
    letterSpacing: -0.015em
  headline-md:
    fontFamily: Fraunces
    fontSize: 36px
    fontWeight: 500
    lineHeight: 1.18
    letterSpacing: -0.012em
  headline-sm:
    fontFamily: Fraunces
    fontSize: 24px
    fontWeight: 500
    lineHeight: 1.3
  smallcaps-lg:
    fontFamily: Fraunces
    fontSize: 14px
    fontWeight: 600
    lineHeight: 1
    letterSpacing: 0.08em
    fontFeature: "smcp"
  smallcaps:
    fontFamily: Fraunces
    fontSize: 12px
    fontWeight: 600
    lineHeight: 1
    letterSpacing: 0.1em
    fontFeature: "smcp"
  lead:
    fontFamily: IBM Plex Sans
    fontSize: 19px
    fontWeight: 400
    lineHeight: 1.6
  body-lg:
    fontFamily: IBM Plex Sans
    fontSize: 17px
    fontWeight: 400
    lineHeight: 1.65
  body-md:
    fontFamily: IBM Plex Sans
    fontSize: 16px
    fontWeight: 400
    lineHeight: 1.65
  meta:
    fontFamily: IBM Plex Sans
    fontSize: 14px
    fontWeight: 400
    lineHeight: 1.5
  dateline:
    fontFamily: JetBrains Mono
    fontSize: 12px
    fontWeight: 400
    lineHeight: 1
    letterSpacing: 0.06em
  code:
    fontFamily: JetBrains Mono
    fontSize: 14px
    fontWeight: 400
    lineHeight: 1.5
spacing:
  base: 16px
  s-1: 4px
  s-2: 8px
  s-3: 12px
  s-4: 16px
  s-5: 24px
  s-6: 32px
  s-7: 48px
  s-8: 64px
  s-9: 96px
  s-10: 144px
  gutter: 24px
  measure: 64ch
  container: 1180px
rounded:
  none: 0
  hairline: 1px
  sm: 2px
  full: 999px
components:
  wordmark:
    fontFamily: Fraunces
    fontSize: 22px
    fontWeight: 600
  folio:
    fontFamily: JetBrains Mono
    fontSize: 12px
    letterSpacing: 0.06em
  running-head:
    fontFamily: Fraunces
    fontSize: 12px
    fontWeight: 600
    letterSpacing: 0.1em
    fontFeature: "smcp"
  title-block:
    fontFamily: JetBrains Mono
    fontSize: 12px
    labelSize: 9px
    labelLetterSpacing: 0.12em
  callout:
    size: 17px
    borderColor: "{colors.mark}"
    rounded: "{rounded.full}"
---

<!--
Directory note: the folder slug stays `shane-personal-v2` even though the system
inside it is v3. The `publish-post` workflow hardcodes that slug in ~15 places;
renaming the folder would strand the publish pipeline on a stale system. Rename
only alongside an update to `skills-workflows/skills/publish-post/SKILL.md`.

Diff from v2 (key changes):
  + --color-mark (#c0392b) added — annotation red, one strict role (see Colors)
  + FIVE NAMED ARCHITECTURES + an ORDERED TEST that derives one from the
    content — the defining change of v3. The mapping table is worked examples.
  + Figure taxonomy — six figure types, each with a stated entry requirement
    (Sourced chart added after auditing the DevRel series, which is research-
    backed where the 2026 posts were prose-argument; nothing covered a
    verified third-party statistic)
  + Title block promoted to a named primitive; replaces the footer on Sheet pages
  + Drawing classes (.s-ink / .s-edge / .s-mark / .s-rule / .f-* / .hatch) so
    inline SVG inherits the palette instead of hard-coding hex
  + Site-wide components documented: newsletter, contact CTA, author bio,
    post-list row, index strip, audit form, footer
  + List ordering is normative: date descending, 001 = newest, category is a
    FILTER not a grouping
  ! FIXED: v2 documented Inter as the body family in both frontmatter and prose.
    The site has always shipped IBM Plex Sans (tailwind.config.js). Inter is on
    the anti-pattern list; the docs were wrong, not the site.
  - Zone references / rulers removed from the Sheet architecture. They looked
    like a system but addressed nothing — no content ever cited a zone.
-->

# Shane Logsdon — Design System (v3)

## Overview

A drafting language for a technical product leader at the intersection of payments and developer platforms. v2 established the editorial register — Fraunces at publication scale, small-caps labels, hairline rules, a committed cream page. v3 keeps all of it and adds the thing v2 lacked: **a rule for choosing a page's shape.**

The defining idea is that **architecture is a function of content type.** There are five named architectures and an ordered test that derives one from the content. A reader who lands on a sequence gets a sequence; a reader who lands on a reference page gets a title block telling them when it was last true. The second idea is that **figures are apparatus, not ornament** — dimensioned drawings, hatched regions, and numbered callouts that carry information the prose would otherwise have to carry badly, each with a stated requirement it must meet before it may be used.

## Colors

Paper, ink, one accent, one mark. **Surface (#fbfaf9)** is the committed warm cream, unchanged. **Ink (#0e1116)** is the near-black with a slight blue cast. **Accent (#556B2F)** — olive — keeps both of its v2 roles: interaction states, and a deliberate type accent on the subject word of a page.

**Mark (#c0392b)** is the one addition in v3: annotation red. It has exactly one job — marking what a drawing calls out. Dimension lines and their witness marks, callout bubbles, hatch fill, a correction, the one value that turned red. It never styles a heading, never marks a link, and never appears on a page that has no drawing on it. If you can't point at what it is annotating, it doesn't belong.

The dark **inversion block** remains the canonical feature treatment (background `--color-ink`, text `--color-surface`) and is what the contact CTA is built from. `--color-surface-feature` (aged clay) stays a reserved token and is still not used as a background.

Contrast note: olive on ink measures 3.2:1 — large-text only. Do not put `--color-accent` on `--color-ink` at label sizes. Inside an inversion block, links use the cream text color, not olive.

## Typography

Two families do the work; mono is technical-only. **Fraunces** carries the whole display range (24 → 144px) and the small-caps editorial labels at 12/14px with 0.08–0.1em tracking. **IBM Plex Sans** carries lead, body, and meta. **JetBrains Mono** is restricted to `dateline`, `code`, folios, title-block values, and text set inside drawings — anywhere else is a misuse.

IBM Plex Sans is the body family, matching `tailwind.config.js`. v2's docs said Inter; that was a documentation error and Inter remains forbidden by the anti-pattern list.

## Layout

Container 1180px; gutter 24px; measure 64ch. Spacing scale unchanged (4 → 144px), with the upper end used for section breaks. Every architecture sets its own internal grid — see below — but all of them sit inside the same container and share the same rule weight.

## Elevation & Depth

Strictly flat. Hierarchy comes from type weight and scale, the accent, and whitespace. **Rules are 1px, always** — and drawings are drawn at 1px too, so a diagram and the page share a single line weight. That shared weight is what makes the figures read as part of the page rather than as pasted-in images. Major divisions are communicated by spatial gap (96–144px), never by a heavier rule. No shadows, no card lifts.

## Shapes

Zero radius across the board. The two exceptions are `rounded.full` for avatars and for the **callout bubble** — a 17px circle in annotation red carrying a figure reference number. Filled buttons remain absent from the system; `.btn-arrow` is the only button.

## Architectures

Five. Each is earned by a kind of content. **The ordered test below is what's normative**; the mapping table after it is worked examples, not the extent of the system. A page type that isn't in the table is answered by running the test, then added as a row citing the question that decided it.

1. **A · Drawing First** — the figure opens the page at full width and the prose beneath it is the *key*, numbered to the callouts. The headline is demoted below the drawing. Requires a piece that genuinely reduces to one drawing; has no honest fallback without one.
2. **B · Facing Spread** — two equal columns divided by a hairline gutter, argument left and apparatus right, locked to horizontal registration lines that cross both so a figure always sits level with the paragraph citing it. The right column is content, not chrome.
3. **C · Sheet** — a bordered field with a **title block** in the lower right carrying sheet number, revision, date, and author. The title block replaces the footer. No zone references or edge rulers: they looked systematic but addressed nothing.
4. **D · Assembly Order** — a numbered sequence down a central axis, text and detail drawing alternating sides. Steps are addressable, so a reader can enter at step 4. The strongest architecture on mobile: the axis slides left and everything stacks.
5. **E · Set** — a permanent list column beside the open item. Navigation never leaves the page and the size of the body of work stays legible.

### Choosing an architecture

Ask these five questions **in this order** and stop at the first yes. The order is the rule — several will often be true at once, and the earlier question wins because it describes the reader's job rather than the author's intent.

1. **Does the page's job stop at browsing a body of work?** → **E · Set**
   The reader came to scan and pick, not to read this page. If the page would still work with every item replaced, it's a Set.
2. **Is the content genuinely sequential — does step 3 depend on step 2?** → **D · Assembly Order**
   Test it by reordering: if shuffling the items breaks the meaning, it's an assembly. If it doesn't, you have a list and the numbering would be a lie.
3. **Will the page be *revised over time*, so that which version you're reading matters?** → **C · Sheet**
   Revision, not citation — an article gets cited constantly but is never revised, so it is not a Sheet. The test is whether the page has a *current state* that can go stale: About, Work, Resume, Contact all do. If a reader could act on an out-of-date version, it needs a title block.
4. **Does it make several claims that each need their own evidence?** → **B · Facing Spread**
   Count the claims. Two or more, each with a figure or a number behind it, wants registration bands.
5. **Does the whole thing reduce to one drawing?** → **A · Drawing First**
   The strictest test in the system: if you can't draw it, you can't use this architecture — and if you can, the prose is demoted to the drawing's key.

**None fit** → the answer is a new architecture with a stated reason, added as a row below. Never blend two: a page that is half Assembly and half Set is a page whose content type hasn't been decided yet.

**One page, one architecture.** Architectures don't nest. If a section of a page genuinely wants a different architecture, that section is a different page.

### The mapping

The rows below are **worked examples of the questions above**, not the extent of the system. Each cites the question that decided it.

| Page / content type | Architecture | Why (Q) | Figure it carries |
|---|---|---|---|
| Home | B · Facing Spread | Q4 — several claims, each needing evidence | Boundary drawing + record chart |
| Articles index | E · Set | Q1 — the job stops at browsing | None — the list is the object |
| Article — one central idea | A · Drawing First | Q5 — reduces to one drawing | Dimensioned diagram, required |
| Article — multi-claim argument | B · Facing Spread | Q4 — each claim faces its evidence | One figure per band |
| Field guide / process | D · Assembly Order | Q2 — reordering the gates breaks them | One detail per step |
| Practice / services | D · Assembly Order | Q2 — build → AEO → management is ordered | Footed price blocks |
| About | C · Sheet | Q3 — changes, so it must say when it last did | Category share chart |
| Work | C · Sheet | Q3 — each project carries its own revision | Project schematic |
| Resume | C · Sheet | Q3 — staleness is the whole risk | Career timeline |
| Speaking | E · Set | Q1 — a catalog browses like a catalog | Talk structure timeline |
| Archive | E · Set | Q1 — same browsing job, different subset | None |
| Loop & Gate (product) | D · Assembly Order | Q2 — Foundation then kits is an install order | Detail per kit |
| Local businesses (landing) | A · Drawing First | Q5 — one claim, one chart | Timeline drawing, required |
| Contact | C · Sheet | Q3 — metadata-led; title block is most of the page | None |

## Figures

Six types. A figure is additive or it doesn't ship. Each states what it requires before it may be used.

| Figure | Use it for | Requires |
|---|---|---|
| Dimensioned diagram | A claim about proportion, or where a line sits | Two regions and a measured split you can defend |
| Cycle | A process with a genuine return edge | Three or more stages and a real loop back |
| Record chart | A claim about your own history or data | A file it reconciles to, named in the caption |
| Sourced chart | A claim about data you did not produce but verified | A citable source named in the caption, **and every plotted value stated in the text** |
| Detail | Clarifying one step of an assembly | A step that is actually unclear without it |
| Footed table | Anything with numbers, including pricing | Figures that add up, shown adding up |

**Record chart and Sourced chart stay separate on purpose.** The distinction is provenance, and provenance is exactly what a reader should be able to check. A Record chart reconciles to a file in this repo. A Sourced chart cites someone else's published figures, and its caption names them so the claim stays clickable.

The Sourced chart's second requirement does the real work: **no interpolation.** Every point drawn must be a value the prose states. If an argument turns on an inflection the source never quantified, that inflection cannot be drawn, and the figure is either redrawn around what is stated or dropped. A trend line through values you inferred is invention wearing a citation.

### Density

The ceiling is **one figure per structural unit**, and the architecture defines the unit — so the page-level limit falls out of the architecture instead of being a separate number to remember.

| Architecture | Unit | Figures |
|---|---|---|
| A · Drawing First | the page | Exactly one. A second figure means it didn't reduce to one drawing, so it was the wrong architecture. |
| B · Facing Spread | the registration band | At most one per band. A band with two figures is two bands. |
| C · Sheet | the field | At most one. The title block is not a figure. |
| D · Assembly Order | the step, plus the intro | At most one detail per step; steps may have none. The intro may carry **one** summary figure — a footed total, a cycle — standing for the assembly as a whole. |
| E · Set | the open pane | At most one. The list is not a figure. |

Three further limits:

- **Three callouts per figure, maximum.** A drawing needing a fourth is two drawings, and splitting it is always the better fix than shrinking the numbers.
- **No figure repeats another figure on the same page.** Restating the same data twice is the clearest sign one of them is decoration.
- **A page may have zero figures.** Nothing in the system requires one — Articles index, Archive, and Contact all ship without. Reaching for a figure to fill space is the failure this taxonomy exists to prevent.

Drawings are authored as inline SVG using the drawing classes in `tokens.css` (`.s-ink`, `.s-edge`, `.s-mark`, `.s-rule`, `.f-*`, `.hatch`) so they inherit the palette. Never hard-code hex inside a figure.

**Trap worth knowing:** a rect that carries `fill="url(#hatch)"` must use `.s-edge`, not `.s-ink`. `.s-ink` declares `fill: none`, and CSS beats the presentation attribute, which silently erases the hatch.

## Components

Named primitives, plus the site-wide components that must survive under all five architectures.

**Primitives:** Wordmark · Folio (mono dateline + position) · Running head (Fraunces small caps at the top edge) · Editorial label (Fraunces small caps, inline) · **Title block** (new in v3) · **Callout bubble** (new in v3) · Article row.

| Site-wide component | Where it appears | Shape |
|---|---|---|
| Newsletter | Above the footer, every page | 4/8 split, underline input + `.btn-arrow`. Renders nothing until `KIT_FORM_ID` is set, so no broken form ever ships |
| Contact CTA | Home, About, articles, archive, guides | The inversion block. 3/9 split, parameterized eyebrow/title/body, exactly one action |
| Author bio | Article and field-guide layouts | 72×96 headshot + bio, after the body, before the CTA |
| Post-list row | Articles, Speaking, Archive | Folio (number + date) · title + description · category + read time |
| Index strip | Above every list | Count folio (`009 entries`) + category filter tabs, or `archive` on Speaking |
| Audit form | Practice pages only | Underline fields, small-caps labels, one arrow submit. Deliberately not on `/contact/` |
| Footer | Site-wide | Folio date + small-caps link row |

### Lists

Normative: **ordered by date descending, always.** Numbering runs `001` = newest. Category is metadata on the row and a **filter** above the list — never a grouping, because grouping breaks the only ordering a reader can predict.

### Weighting

The local web-presence practice is **deliberately downplayed**: footer link only, never in the primary nav, and one muted line on the home page with no heading and no figure. The primary nav is About · Articles · Speaking · Work · Resume. The audit funnel lives on the practice pages, not on `/contact/`, which stays general-purpose.

## Do's and Don'ts

- **Do** choose the architecture from the mapping table before writing any markup, and state which one and why.
- **Do** keep drawings at 1px so the figure and the page share one line weight.
- **Do** caption every figure with its source and the date it was read.
- **Do** cut a figure if the page is no worse without it. Additive means additive.
- **Do** put revision and date on any page carrying a title block. A stale sheet that admits it beats a fresh-looking one that doesn't.
- **Do** keep all rules at 1px; communicate major divisions with whitespace.
- **Do** maintain WCAG AA (`#0e1116` on `#fbfaf9` passes at 17:1; the inverted pair passes the same).

- **Don't** use annotation red for anything a drawing isn't calling out. No red headings, no red links, no red on a page with no figure.
- **Don't** put `--color-accent` on `--color-ink` at label sizes — 3.2:1 is large-text only.
- **Don't** group a list by category or tag. Date descending, with category as a filter.
- **Don't** give the local-business practice a nav slot or a feature band.
- **Don't** add zone references, edge rulers, or any other apparatus that looks structural but addresses nothing.
- **Don't** hard-code hex inside a figure; use the drawing classes.
- **Don't** use `.s-ink` on a hatched rect — it declares `fill: none` and will erase the fill.
- **Don't** use Inter, Roboto, or a system stack as the body family. The body family is IBM Plex Sans.
- **Don't** use mono caps as editorial labels (Fraunces small caps instead), or mono anywhere outside dateline, code, folio, title-block values, and text inside drawings.
- **Don't** use italics for emphasis more than once per artifact.
- **Don't** include filled buttons; only `.btn-arrow` exists.
- **Don't** use any radius beyond `rounded.hairline`, `rounded.full` (avatars and callout bubbles only).

See `../../plugins/shane-config/skills/design-anti-patterns.md` for universal rules. Brand-specific rules above are additive and supersede where they conflict.
