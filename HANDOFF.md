# Design Critique Handoff — 2026-08-30

Critique of the v3 design system as actually shipped, from reading
`design/shane-personal-v2/DESIGN.md` + `tokens.css` and rendering the built
site (`composer build`, served at `localhost:8931`) at 1440px, 760px, and
390px. Screenshots: `/tmp/site-shots/` (index, about, articles, work, resume,
speaking, contact + mobile variants).

Pages checked against their declared architecture: Home (F · Frontispiece),
About/Work/Resume/Contact (C · Sheet), Articles/Speaking (E · Set). Every
page's architecture choice is defensible and matches its in-source comment.

## Findings, ranked

### 1. About chart overflows its own SVG — data is cut off (fix first)

`pages/about.php:81-98`. The category chart is a fixed 420×200 canvas with
rows stepping 48px from y=52: rows land at 52, 100, 148, **196**. The footer
rule is at y=184 and "N total on file" at y=197. `articles-list.json` now has
**4 categories**, so the 4th row ("leadership & management", 1 post) collides
with the footer rule and renders as overlapping strikethrough text — visible
in both desktop and mobile screenshots. The collision is the least of it: the
4th row's bar rect renders at y=204–216 and its count text at y=214, entirely
outside the 200px viewBox (`pages/about.php:81`), so the smallest category is
not merely overlapped; it is invisible. The drawing misrepresents the data it
claims to reconcile to, which is the one failure the figure system exists to
prevent.

Fix options:
- Grow the SVG with the data and derive the footer positions: `ruleY = 36 + $count * 48`, `textY = ruleY + 13`, `height = textY + 12`.
- Or cap categories rendered (but then the chart no longer reconciles to the
  file — weaker).

### 2. Resume's "At a glance" claims row doesn't foot

`pages/resume.php` — "15+ yrs / 11 yrs / 10k+ merchant installs / 6 languages"
is a footed table that doesn't foot: two of the four figures are checkable on
the same page — 11 yrs is carried by the timeline's own dimension line annotated
"11 yrs" (`pages/resume.php:344`; the comment at `:338-340` says it carries the
stat), and 15+ yrs is checkable against the timeline span. The six languages
are enumerated at `pages/resume.php:296`. The genuinely unreconciled figure is
"10k+ merchant installs" (`pages/resume.php:290`). The figures sit in the same
visual register as the genuinely sourced career timeline directly below
(Fig. 01, which reconciles to `pages/resume.php` and says so).

Fix: cut the row, or tie the "10k+" claim to something checkable (the timeline
already carries the years; the language count is enumerated on the page).

### 3. Mobile nav drops 3 of 5 destinations with no replacement

`resources/partials/components/site-menu.php` — Speaking, Work, Resume are
`hidden sm:block`. At 390px the only primary nav is About · Articles, no
disclosure control. Footer carries the links, but primary nav failing to a
silent subset is a real gap — and inconsistent with the touch-target care
elsewhere (filter tabs get `min-height: 44px`).

Fix: a minimal disclosure (wordmark-adjacent menu affordance) or accept fewer
nav items rather than hidden ones.

### 4. Inversion CTA is becoming wallpaper

`resources/partials/components/contact-cta.php` renders on Home, About,
Speaking, articles, archive — same 3/9 split, same LinkedIn arrow. On
Speaking (3 talks) the CTA block is nearly as tall as the page's entire
content. A punctuation device on every page at full size stops punctuating.
The component supports parameterization/omission; the thin pages (Speaking,
Work) never use it.

Fix: omit or shrink the CTA on pages where it rivals the content for height.
Speaking is also absent from the design system's component table
(`design/shane-personal-v2/DESIGN.md:326`, which lists Home, About, articles,
archive, and guides); the doc drifted from the markup, so fix the doc row or the
placement when addressing this finding.

### 5. Grid-paper hero texture is unjustified decoration

`pages/index.php` hero uses `.grid-paper` (the `--color-grid` "technical
grid" token) at 0.55 opacity. F · Frontispiece is the one architecture
forbidden from carrying figures — "a figure here is decoration by definition" —
yet the hero wears technical apparatus with no drawing for the grid to be the
grid *of*. Small hypocrisy against the site's own doctrine.

Fix: cut it, or reserve grid paper for pages that carry actual drawings.

## Smaller observations

- **Folio date drift**: footer and home folio use build date
  (`date('Y.m.d')`) while title blocks use git-derived dates — two
  dates-of-record that can disagree on the same page.
- **About headline wraps** "developer-first" across the olive accent at
  390px (`max-w-[22ch]` is desktop-tuned; mobile line breaks are luck, not
  design).
- **`/in/shanelogsdon` small-caps handle** beside the LinkedIn arrow in the
  CTA is mono-adjacent ornament that earns nothing.
- `pages/components.php` uses sheet number `C-01` — check whether the
  component showcase ships to `dist/` and, if so, whether a C-series sheet
  number on a non-sheet page is intentional.

## Corrections to the verbal critique

- ~~Sheet numbering is non-sequential (A-01, A-02, A-04)~~ — **wrong.** The
  resume is A-03 (`pages/resume.php:447`); the sequence A-01…A-04 is intact.
  The resume screenshot cut off above its title block and the initial grep
  missed the `sheetNo` line. No defect here.

## What's working (don't break these)

- Figure honesty: About's chart is counted live from `articles-list.json`;
  Work explicitly ships zero figures with a comment explaining why. Keep the
  "why no figure" comment convention.
- Annotation red appears only on the resume's dimension marks. Nowhere else.
- List ordering enforced in code (`uasort` in
  `resources/partials/components/post-list.php`), not by data-file hygiene.
- Filter tabs are real links to real routes (`index-strip.php`), so filtered
  and full views can't disagree, and `aria-current` carries the state.
- Title blocks derive rev/date from git with shallow-clone fallbacks
  (`resources/git.php`, `title-block.php`) — derived, never typed.

## Suggested next actions

1. Fix #1 (About chart height) — it is actively misdrawing data.
2. Decide on #2 (cut or source the resume claims row).
3. #3 and #4 are one sitting each; #5 is a one-line deletion.
