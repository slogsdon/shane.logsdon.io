# DESIGN-PLAN: Shane Logsdon (v3)

**Slug:** `shane-personal-v2` (the folder keeps the v2 slug because `publish-post/SKILL.md` hardcodes it)
**Date:** 2026-07-28
**Status:** Adopted, reconstructed retroactively

> Written after the fact. v3 was designed across three comparison rounds and promoted
> straight to `DESIGN.md` without a plan file, so the intent layer survived only as header
> comments in `iterations/`. This document records what was decided and why the alternatives
> lost. It has no authority over `DESIGN.md`. Where the two disagree, this file is the one
> that is wrong. Where it states something the rounds did not record, it says so.

## Audience

The evidence records the subject, not the reader. The system describes itself as built for
"a technical product leader at the intersection of payments and developer platforms," and the
one reader behavior any round names is browsing. E · Set exists because reading one piece and
then another is what a returning visitor does most.

Anything narrower is an assumption, so here is the one this plan makes and marks as such:
readers arrive for a specific piece of written output, or for the current state of one page.
That assumption is what the title block answers. A reference page that can go stale has to
say when it was last true.

## Visual Direction

**Primary direction:** mixed (editorial + technical), named **Drafting**.

Technical drawing convention used honestly rather than as decoration. Dimension lines with
witness marks, 45° hatch marking the region under discussion, numbered callout bubbles keyed
to points in the text. Drawings sit at the same 1px weight as the page's rules, so a figure
reads as part of the sheet instead of a pasted-in image. The editorial half is inherited whole
from v2 and is the continuity thread: display serif at publication scale, small-caps labels,
a committed warm cream page.

**Page architecture is a function of content type, not a style choice.** Five named
architectures, chosen by an ordered test that reads the content rather than the author's mood.
See `DESIGN.md` §Architectures.

## Voice & Tone

**Adjectives:** consultative, dry, specific.

Sourced from the voice profile, not from the design rounds. The rounds never discussed copy.

**In practice:**
- A CTA names the next step and what the reader gets from taking it. "Read the ten build
  gates in order" beats "Learn more" because one of them tells you what happens next.
- Not performative. No "unlock", no "game-changer", no emoji-prefixed bullets. And no invented
  specifics, which is the one copy rule the rounds do support: round 2 required every figure to
  come from real data, and the same standard governs the words. If a caption needs a number the
  source does not contain, the element gets cut rather than filled in.

## Mood References

No external brand references were recorded during the rounds, and none are invented here.
The referents are conventions, not companies:

- **Technical drawing convention** (dimension lines, witness marks, hatch, callout bubbles)
  as a working apparatus a writer can reach for mid-sentence
- **The drawing sheet's title block**, which carries sheet number, revision, date, and author,
  and which replaces the footer on reference pages
- **v2 of this system**, unchanged in type and paper. The continuity is the point

## Anti-convergence stance

The point of v3 is not looking like the median personal site of 2026. Round 1 defined all five
directions by the trend each one refuses, and that framing is the durable part. Before a new
page type ships, name what it refuses.

Two of those refusals became standing rules:

- Apparatus that looks structural but addresses nothing. Zone references and edge rulers were
  built, evaluated, and cut for exactly this reason
- Decoration standing in for evidence. A figure is content-bearing or it does not ship

The others were proposed and not carried forward, and one is worth recording because it is a
live tension rather than a closed question. Marginalia won round 1 while refusing the
persistent top navigation bar and the sticky header, and the v3 mockup ships a sticky top nav
anyway. The refusal lost to livability. If the nav is ever reopened, that is the ground it
sits on.

## Hard NOs

Brand-specific, on top of the universal anti-patterns:

- Annotation red marks only what a drawing calls out. Never a heading, never a link, never on
  a page with no figure
- No figure the page is not worse without, and no figure repeating another figure on the same
  page
- No list grouped by category or tag. Date descending, category as a filter above the list
- No nav slot or feature band for the local web-presence practice. Footer link only
- No blending two architectures on one page. A page that is half sequence and half catalog is
  a page whose content type has not been decided
- No mono outside dateline, code, folio, title-block values, and text inside drawings
- No filled buttons, no shadows, no card lifts, and no radius beyond hairline except
  `rounded.full` on avatars and the callout bubble

## The rejected directions

Round 1 varied architecture and held color fixed. Marginalia won on livability rather than on
its structural trick, which is why round 2 held its architecture constant and moved the color
instead. Round 2 narrowed five color worlds to three, and Drafting won among them. Round 3
then held Drafting constant and ran five new architectures under it, and all five survived,
each earned by a kind of content. That survival is the origin of the five-architecture rule.

Round 2's losers are recorded here because they are what keeps settled ground settled. Riso
and Plotted both made the final cut of three and still lost.

| Direction | What it was | Why it lost |
|---|---|---|
| Riso | Two spot inks on newsprint, halftone screens, deliberate misregistration | Made the cut of three and lost. Distinct on the web but not un-trendy in general, since Riso is having a moment in indie print, and the misregistration reads as a bug to anyone who does not know the reference |
| Plotted | The site charts itself from `articles-list.json`, with olive widened into a five-step ramp | Made the cut of three and lost. It needs data to stay honest, a chart of nothing being worse than no chart, and the nine-year publishing gap reads as candor exactly once before it becomes a bit that needs retiring |
| Survey | Sand stock and sepia ink, topographic contours whose elevation is subject depth | The largest color departure in the set and the highest risk. Cartography-as-metaphor gets twee fast, and sand-and-sepia sits one step from a coffee-shop menu |
| Ledger Stock | Green banded accounting paper as the material, figures that reconcile | Banded green reads "spreadsheet" to some people before it reads "ledger", and it was the closest of the five to round 1's catalog idea, so it risked feeling like ground already covered |

**Drafting won** on two things. It was the smallest color change of the five, so nothing
already built breaks. And its apparatus is a genuine writing tool for long-form posts rather
than a home-page ornament.

Its risk was named at selection time. The direction only pays off if the drawings get made,
because a drafting system with no drawings is v2 carrying a color it never uses.
`DESIGN.md` answers that risk twice. Annotation red never appears on a page with no drawing,
so the mark cannot leak into decoration, and every figure type states an entry requirement it
has to meet before it may be used. On an article, one figure is the ceiling and zero is the
common answer.

## Platform Priorities

Derived from `publish-post/SKILL.md` and the artifacts directory, not from the design rounds.

**Phase 1:** the site itself, blog hero (OG card plus in-page hero), LinkedIn post image, and
the local-business audit report one-pager.

## Token Direction Hints

**Color stance:** warm neutrals, one accent carrying interaction and type emphasis, one mark
with a single annotation job

**Type stance:** display serif across the whole display range, sans for lead and body, mono
restricted to technical use

**Density:** balanced. Dense reading column, generous section breaks

**Surface:** flat. Hierarchy from type scale, the accent, and whitespace

---

## Handoff

`design-system` has already run against this plan's conclusions. `DESIGN.md` and `tokens.css`
are current at v3 and carry corrections a regeneration pass would drop. Do not regenerate them.
`showcase.html` is the one artifact that lagged and is being brought forward separately.
