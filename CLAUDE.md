# shane.logsdon.io

Personal site. Static build from PHP templates.

## Stack & commands

- **Generator:** `slogsdon/flat-file` — `pages/*.php` render through layouts/partials in `resources/partials/` into `dist/`.
- **CSS:** Tailwind. Source `public/_/input.css` → built `public/_/site.css`.
- **Data:** `resources/data/*.json` (`articles-list.json`, `speaking-list.json`, `categories.json`, `tags.json`).
- **Deploy:** Netlify.

```bash
composer build       # build the site into dist/
composer start       # local server
npm run build:css    # tailwind build (minified)
npm run dev:css      # tailwind watch
```

## Design system — read before touching any page

**`design/shane-personal-v2/DESIGN.md` is the authority.** Read it before adding or restructuring a page. It is v3; the folder slug still says `v2` because `publish-post/SKILL.md` hardcodes that slug in ~15 paths — rename only alongside an edit to that skill.

The rule that matters most: **page architecture is a function of content type, not a style choice.** There are six architectures (Drawing First · Facing Spread · Sheet · Assembly Order · Set · Frontispiece) and an **ordered test** in §Architectures that derives one from the content. Frontispiece is the exception: it is decided by position, the single entry point to the set, so §Architectures asks that question before the five. Run the test, name the architecture and the question that decided it, then write markup. A page type not already in the mapping table gets a new row citing its question — never an improvised layout, and never a blend of two.

**`design/shane-personal-v2/iterations/` is exploration, not authority.** `v3-site-mockup.html` is where v3 was worked out and it is kept for that record, but it disagrees with DESIGN.md in three known places: it puts annotation red on the active nav underline and the selected filter tab (forbidden), its WORK section is invented placeholder content, and it uses a `.c-sheet` / `.c-tb` class vocabulary that `tokens.css` does not. Where they disagree, DESIGN.md and `tokens.css` win.

Also normative, and each already violated once during design:

- **Lists are date descending, always.** `001` = newest. Category is metadata on the row and a *filter* above the list, never a grouping.
- **Figures are additive.** Six types, each with an entry requirement (§Figures). Every figure carries a caption naming its source and the date it was read. A Sourced chart may plot only values the prose actually states, never an interpolated trend. If the page is no worse without the figure, cut it.
- **Annotation red (`--color-mark`, `#c0392b`) marks only what a drawing calls out.** Never a heading, never a link, never on a page with no figure.
- **The local-business practice stays demoted** — footer link only, never in the primary nav, one muted line on the home page. The primary nav is About · Articles · Speaking · Work · Resume. The audit funnel lives on the practice pages, not `/contact/`.

Components: `design/shane-personal-v2/components/components.html` (browsable library) and `tokens.css` (source of truth for values). Site-wide partials live in `resources/partials/components/` — `newsletter`, `contact-cta`, `author-bio`, `post-list`, `audit-form`, `footer`, `site-menu`.

> `public/_/input.css` contains a generated token region sourced from `design/shane-personal-v2/tokens.css`. Run `npm run build:tokens`; do not edit between the `GENERATED:TOKENS` sentinels.

## Conventions

- Follow existing partial structure; prefer a partial over inlining a repeated block.
- Never reference Claude in commit messages. Conventional commits (`feat:`, `fix:`, `content:`, `design:`, `refactor:`).
- Content edits to articles run through the writing skills (`humanize` → `ms-style-pass`) before publish.
