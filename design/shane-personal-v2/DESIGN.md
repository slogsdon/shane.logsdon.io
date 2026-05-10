---
version: alpha
name: Shane Logsdon (v2)
description: Editorial system for a technical product leader at the intersection of payments and developer platforms. Fraunces display + small-caps + Inter sans + JetBrains Mono (technical-only). Single olive green accent used as both status signal AND deliberate type accent. Real publication conventions — folios, running heads, varied dividers — replace AI-default editorial cosplay.
colors:
  primary: "#0e1116"
  secondary: "#62686f"
  accent: "#556b2f"
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
    fontFamily: Inter
    fontSize: 19px
    fontWeight: 400
    lineHeight: 1.6
  body-lg:
    fontFamily: Inter
    fontSize: 17px
    fontWeight: 400
    lineHeight: 1.65
  body-md:
    fontFamily: Inter
    fontSize: 16px
    fontWeight: 400
    lineHeight: 1.65
  meta:
    fontFamily: Inter
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
---

<!--
Variation choices (v2):
  surface:        warm cream (#fbfaf9) — page is COMMITTED to cream; the canonical "feature" treatment is a dark-inversion block (--color-ink bg + cream text), not a tonal warm-on-warm shift
  accent:         single-color olive green, used in TWO roles — semantic status AND deliberate type accent (one word per surface)
  type-pairing:   serif-display + serif-smallcaps + sans-body + mono-technical (Fraunces does double duty for display AND editorial labels; mono restricted to genuinely technical contexts)
  radius:         hairline (1–2px on rare occasions; otherwise zero — more architectural)
  spacing:        8px-base, with display-scale jumps (96px / 144px) for editorial cover treatments

Diff from v1 (key changes):
  + display-xxl (144px) and display-xl (96px) added for true editorial cover scale
  + Fraunces small-caps tokens replace JetBrains Mono as default editorial label
  + JetBrains Mono restricted to "dateline" + "code" tokens only — actually-technical use
  + paper-feature (#ede4d2) added as a deliberate tonal register for hero treatments
  + ink darkened (#0e1116 from #181b21) for more architectural register
  + body sizes shifted up (17/19px) to match real publication body settings
  + measure tightened (64ch from 68ch) for denser editorial column
  - signal palette (--ok/--warn/--info) removed — they don't belong to this brand
  - § sigil dropped from default eyebrow chrome (kept only on long-form article index)
  - folio + running-head + wordmark added as named component primitives
-->

# Shane Logsdon — Design System (v2)

## Overview

A design language for a technical product leader at the intersection of payments and developer platforms. Editorial register — the typographic moves come from publication tradition (display set at cover scale, Fraunces small caps for labels, folios in corners, running heads at top edges) rather than UI tradition. Type does the work; the single olive accent serves two roles — interaction signal AND deliberate type accent on the subject word of a page. The system has fewer components than v1 but each is more idiosyncratic; the page's typographic personality replaces inventory completeness.

## Colors

Paper, ink, one accent — held strictly. **Surface (#fbfaf9)** is the primary warm cream — the page is committed to it. The canonical "feature" treatment is a **dark inversion block** (background `--color-ink`, text `--color-surface`) used as a punctuation device — a register flip within the committed cream system. The earlier `--color-surface-feature` (aged-clay) is reserved as a token but no longer used as a background; warm-on-warm read as a temperature mismatch, and the dark inversion does the feature job more decisively. **Ink (#0e1116)** is darker than v1 (#181b21 was too gentle); this is near-true-black with a slight blue cast, set against cream for an architectural register. When ink becomes the surface (inversion blocks), the page-level cream becomes the text. **Accent (#556B2F)** does double duty — its semantic role (active states, hover, status) AND a deliberate type-accent role (one word per surface, set in olive Fraunces, used to mark the subject of the page). The signal palette (ok-green, warn-amber, info-blue) is removed; this brand doesn't have a use for it.

## Typography

Two families do the typographic work; mono is reserved for technical contexts. **Fraunces** carries the entire display range (24 → 144px) AND replaces mono as the editorial label face — small-caps cuts at 12 / 14px set with 0.08–0.1em tracking. The small-caps treatment is the signature swap from v1: it replaces the AI-default "mono caps for techy editorial labels" pattern with the publication-tradition Fraunces small caps that magazines have used for centuries. **Inter** carries body, lead, and meta with feature settings `ss01` and `cv11` on. **JetBrains Mono** is restricted to TWO tokens: `dateline` (timestamps in folio strips) and `code` (actual code samples). Anywhere else mono appears is a misuse.

## Layout

Container 1180px; gutter 24px; measure 64ch (tightened from v1's 68ch — denser column rhythm). 12-column grid for editorial layouts. Spacing scale stays the same (4 / 8 / 12 / 16 / 24 / 32 / 48 / 64 / 96 / 144px) but the upper end (144px) is now used as section breaks in long-form layouts — bigger jumps create real visual rhythm. NEW: column rules. A 1px vertical line in `--rule` between text columns and between margin/body in marginalia treatments.

## Elevation & Depth

Strictly flat (unchanged from v1). Hierarchy comes from: type weight + scale, the single olive accent, and **whitespace as the primary divider**. Rules are **1px max, always** — heavier rules read as visible lines rather than surface divisions, which is the wrong register for editorial work. Where a stronger division is needed, increase the spatial gap (96–144px) rather than the rule weight. Column rules (vertical 1px in gutters) are the one place hairlines are doing structural work. No shadows, no card lifts, no z-axis treatment.

## Shapes

Zero radius across the board. The 2px brand-default of v1 is dropped — sharper corners read more architectural and remove the "considered slight softness" tell. The only exception is `rounded.full` for circular avatars, which still appear sparingly. Pills and status indicators that used `rounded.full` in v1 are replaced with rectangular shapes at zero radius.

## Components

Five named primitives replace v1's full inventory:

1. **Wordmark** (`Shane Logsdon` set in Fraunces 600 at 22px) — replaces v1's `SL · | · Shane Logsdon` three-element brand mark. The wordmark IS the mark, no decoration.
2. **Folio** (mono dateline + page-position in lower corners — e.g. `2026.05.02 / 003`) — a publication convention that replaces the v1 footer-row pattern.
3. **Running head** (Fraunces small caps, 12px, 0.1em tracking) — appears at the TOP edge of artifacts and spreads, holding the article/section title. Replaces the AI-default "eyebrow above headline" pattern.
4. **Editorial label** (Fraunces small caps, 14px, 0.08em tracking) — replaces v1's mono eyebrow. Used inline (e.g. `LEAD —`, `SECTION —`) NOT as a chrome strip.
5. **Article row** (kept from v1, but with column rules and a tightened measure)

Buttons: only `.btn-arrow` (text link with trailing arrow); the filled `.btn` is removed entirely from the system. Filled buttons read as SaaS chrome regardless of how they're styled — a senior editorial AD wouldn't have one.

## Do's and Don'ts

- **Do** push display headlines to publication scale (96–144px for hero contexts)
- **Do** use Fraunces small caps as the default editorial label; reserve JetBrains Mono for dateline + code only
- **Do** use the olive accent as a deliberate TYPE accent — one word per surface, set in olive Fraunces, marking the subject of the page
- **Do** keep all rules at 1px max. Major divisions communicated through whitespace (96–144px gaps) — never thicker rules.
- **Do** drop a rule entirely when whitespace alone can carry the division. A gap is usually stronger than a heavy rule anyway.
- **Do** add folios (dateline + position) in lower corners as the default footer pattern
- **Do** use running heads (Fraunces small caps at top edge) to identify long-form pieces
- **Do** maintain WCAG AA contrast (`#0e1116` on `#fbfaf9` passes at 17:1; the inverted pair `#fbfaf9` on `#0e1116` passes the same)

- **Don't** add eyebrows above every headline. The eyebrow is reserved for: numbered article indexes, dateline-anchored field notes. Other artifacts use a running head OR no chrome at all.
- **Don't** use the § sigil except on the actual numbered article index page
- **Don't** use mono caps as editorial labels (use Fraunces small caps instead)
- **Don't** use italics for emphasis more than once per artifact (replace with: oversized opening word, scale shift mid-sentence, or a true typographic event)
- **Don't** use the 3-column footer pattern (`mark · spacer · url`). Replace with folio in lower corner OR wordmark embedded in running head.
- **Don't** use any radius beyond `rounded.hairline` (1px) and `rounded.full` (avatars only)
- **Don't** wrap content in a cream-on-cream box when the page is already committed cream. Either drop the box (use whitespace + a single hairline above), apply the `.inversion` class (dark ink with cream text — the canonical feature treatment), or use `--color-surface-muted` (a half-step deeper cream) only for genuine card affordance.
- **Don't** use `--color-surface-feature` (aged-clay) as a background. It's a reserved token but warm-on-warm reads as a temperature mismatch on the committed cream page. Use the dark inversion instead.
- **Don't** include filled buttons (`.btn`); only `.btn-arrow` exists in this system

See `../../plugins/shane-config/skills/design-anti-patterns.md` for universal rules. Brand-specific rules above are additive and supersede where they conflict.
