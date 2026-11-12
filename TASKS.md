# Project microsites execution checklist

Execution in progress: Detent is live with verified Git deployment; the separate
collection hub has a verified noindex preview. Remaining gates are tracked below.
Design, scope, sources, and publishing contract: [tasks/plan.md](tasks/plan.md).
Paths below are proposed relative to the repository named in each task unless an
existing file is explicitly identified. Inspect each repo's instructions first.
Reuse existing equivalents. Split any slice exceeding five edited files before
starting it; never combine unrelated product changes with website work.

## T01 — Confirm deployment inputs and freeze project registry

- [ ] Verify intended Cloudflare zone/account, `projects` DNS records, permissions,
  existing CLI configs, and hub repository availability without changing resources.
- [ ] Create the implementation hub repo/check-out and record eight unique slugs,
  owner repos, Worker names, canonical URLs, real revision dates, and planned state.
- [ ] Reject reserved/duplicate slugs and mismatched public prefixes.

Verify: read-only account evidence, schema checks including negative fixtures;
inspect registry artifact. No credentials in the public registry.
Depends: none. Scope: hub `projects.json`, `scripts/check-projects.ts`,
`tests/projects.test.ts`, `README.md`, `AGENTS.md` (small, split if needed).
Suggested commit: `feat: define curated project publishing registry`.

## T02 — Prove independent path deployments with disposable fixtures

- [ ] Pin `cf` and its supported static-build integration; validate typed config
  and official Build Output. Preserve any existing Wrangler project separately.
- [ ] Deploy a disposable hub Custom Domain and two project routes on an isolated
  test hostname; confirm deep links, query-preserving slash redirects, and real 404s.
- [ ] Prove one site's publish/rollback leaves the other unchanged; record asset
  versus script requests and remove only the named disposable resources afterward.

Verify: host/route matrix including `/one-other/`, `/one?x=1`, missing assets, query
strings, nested files, and a failed release; retain deployment IDs and cleanup proof.
Depends: T01. Scope: hub `package.json`, lockfile, `cloudflare.config.ts`,
`tests/routing.spec.ts`, `docs/routing-evidence.md`; fixtures are disposable.
Suggested commit: `feat: establish independent microsite routing`.

## Checkpoint A — Platform proof

- [ ] T01–T02 pass; selected CLI version and live evidence recorded.
- [ ] No production route or unrelated DNS record changed by the fixture exercise.

## T03 — Make Detent's existing generator prefix-aware

Pilot progress (2026-11-02): implemented with root/prefix browser checks in all
three engines. See Detent `docs/microsite-publication.md`. This does not complete
the earlier two-project platform/rollback gate.

- [x] Audit every URL-producing caller in the generator/template/browser code and
  add one validated public-prefix input with root behavior preserved.
- [x] Fix navigation, component modules, CSS/fonts, fetches, redirect aliases,
  example assets, and the dev server where needed; do not rely on Vite config alone.
- [x] Keep component library output/API and verification status unchanged.

Verify: root and `/detent/` builds, focused generator tests, route crawl, and browser
checks for fonts, theme, representative live example, aliases, and missing routes.
Depends: Checkpoint A. Scope: `slogsdon/detent-ui`, existing
`scripts/build-site.ts`, `site/template.html` (locate exact template), relevant
browser URL code, `vite.config.ts`, prefix regression test. Split by discovered
caller surface before editing if more than five files are required.
Suggested commit: `feat: support prefixed Detent site URLs`.

## T04 — Add Detent metadata and publication output

Pilot progress (2026-11-02): metadata, sitemap generation, noindex previews, and
assets-only packaging implemented. An isolated Worker Preview is live at
`https://microsite-detent-microsite-preview.shane-0f2.workers.dev/detent/`.
Production is now live at https://projects.logsdon.io/detent/ with 146 canonical
sitemap URLs verified over HTTPS. The source remains private; a public package
release remains open. Native Cloudflare Git deployment is now verified.

- [x] Emit public canonicals/social URLs, sitemap, status copy, and production 404s
  using the prefix contract; exclude redirect aliases and non-indexable routes.
- [x] Define an allowlisted deploy artifact from `dist/site`; verify all runtime
  component dependencies are present and private source files are absent.
- [x] Document package availability accurately and keep private source links out
  of public navigation unless access is intentionally changed in a separate task.

Verify: `npm run check`, relevant existing browser suite plus prefixed crawl, output
manifest inspection; human visual/VoiceOver/motion status recorded separately.
Depends: T03. Scope: Detent generator metadata, template, sitemap test,
`README.md`, publication manifest (3–5 files; split if T03 identified broader work).
Suggested commit: `feat: prepare Detent website for public hosting`.

## T05 — Establish the independent publishing workflow

Detent now has a gated native Cloudflare Builds command and a pinned Node version.
Workers Builds is now connected to `slogsdon/detent-ui`, with `main` and all paths
watched. Corrective commit `5b719b2` triggered a successful hosted build and deployed
version `723f7767-ea98-408d-83d8-ac69f00bcf35`. All 87 unit tests and the
production smoke in three engines passed. This connection
replaces a separate Detent GitHub deployment workflow; shared hub work below is
still pending. Build settings are documented in Detent's publication guide.

- [ ] Create reusable checks/deploy behavior with immutable workflow references,
  per-Worker concurrency, source SHA/version records, and rollback instructions.
- [ ] Separate isolated noindex PR previews from production domain/routes; protect
  deployment secrets and cover the actual build inputs in path filters.
- [ ] Add generated-site checks for canonical origin, namespace escapes,
  indexability, broken local links, sitemap coverage, and private artifact leakage.

Verify: deliberately broken canonical/link, failed build, fork PR secret behavior,
and preview/production headers. Fail candidate releases without affecting other sites.
Depends: T02, T04. Scope: hub `.github/workflows/publish-site.yml`,
`scripts/check-site.ts`, `tests/site.test.ts`, `docs/publishing.md`;
Detent caller workflow is a separate small repository unit.
Suggested commit: `ci: validate and publish microsites independently`.

## T06 — Build the branded collection and default template

Hub implementation: `/Volumes/Dock/Code/projects.logsdon.io` (new local repo,
no remote/commit yet). Preview: https://hub-project-collection-preview.shane-0f2.workers.dev/ .
Four registry/publication tests, full source checks and local/deployed browser
checks in all three engines pass. Production origin transfer, Git setup, the
independent routing/rollback proof and broader default-guide reuse remain open.

- [x] Adopt the personal design tokens and F architecture for the collection root;
  add mappings in the adopted design docs. List published projects newest-first.
- [ ] Implement a reusable static default layout and D getting-started pattern,
  preserving accessibility; add root robots, sitemap index, and real 404 behavior.
- [ ] Document the template's build-time reuse and independent-brand escape path.

Verify: PHP static build artifact, mobile/keyboard checks, HTML metadata, empty
planned-project behavior, ordering, and sitemap validation. No personal-site rewrite.
Depends: T01, T05. Scope: hub page, layout, token stylesheet, design mapping,
build/sitemap adapter (medium; split layout adoption from sitemap work if needed).
Suggested commit: `feat: build personal-brand project collection`.

## T07 — Publish the hub and Detent pilot

Detent-only launch completed 2026-11-02 following production authorization:
Custom Domain/managed DNS, indexable assets, 146-URL crawl, and live browser checks
in Chromium, Firefox and WebKit. Detent temporarily owns hostname origin; `/`
and sibling namespaces return 404. The hub, registry, multi-project routing gate,
CI and rollback exercise remain open; the combined tasks below are not complete.

- [ ] Prepare exact production resource/config diff and deployment artifacts for
  review; deploy only the hub and Detent when production publication is authorized.
- [x] Prove canonical routes, redirects, assets, 404s, robots, sitemaps, and preview
  exclusion on the real hostname; exercise Detent-only rollback and republish
  (2026-11-06; IDs in Detent `docs/microsite-publication.md`).
- [x] Mark Detent published in the registry only after live checks pass.

Verify: deployment IDs, source commits, response/browser evidence, rollback record,
and observed billing behavior; keep human component verification explicitly open.
Depends: T04–T06. Scope: hub config/registry, Detent config/caller workflow,
`docs/launch-evidence.md` (separate commits per repo).
Suggested commits: `ci: deploy Detent under its project prefix` and
`feat: publish the project collection pilot`.

## Checkpoint B — Real project proof

- [x] Detent works under its real prefix, and preview/rollback behavior is proven
  (2026-11-06: Detent rollback/republish plus an observable fixture rollback; hub unchanged).
- [x] No claim that website deployment completes Detent's library verification.

## T08 — Publish Herdbot's microsite

- [x] Build an F introduction and D first-bot guide from current documentation,
  including macOS/early-stage limits and the existing installation route.
- [x] Link the Homebrew tap as a distribution dependency, not a second microsite.
- [x] Validate preview, publish independently, then add its directory/sitemap entry.

Verify: documented install path against a disposable setup or existing authoritative
release evidence; site contract, mobile/keyboard review, live route checks.
Depends: Checkpoint B. Scope: herdbot `website/pages/index.php`, getting-started
page, website build/config, caller workflow (3–5 files plus existing template reuse).
Suggested commit: `feat: publish Herdbot project website`.
Done 2026-11-09: live and listed (evidence in projects.logsdon.io `docs/operations.md`,
"Wave 1 publication"). Quick start quoted, not executed; the page says so. No
Workers Builds caller workflow yet: content updates need a manual `cf deploy`.
Keyboard, viewport and axe checks were automated (3 engines); no human review pass.

## T09 — Publish GLiNER Browser's microsite

- [x] Explain the local-browser workflow, Python/platform/model prerequisites,
  first-download requirements, install, and an observed-element example.
- [x] Preserve early-development status and avoid a hosted browser demo/backend.
- [x] Validate preview, publish independently, then add its directory/sitemap entry.

Verify: quick start in disposable environment, site contract, representative browser
check and real route responses. Model execution is a product-doc check, not hosting.
Depends: Checkpoint B. Scope: gliner-browser `website/` intro, getting-started,
build/config, caller workflow (medium).
Suggested commit: `feat: publish GLiNER Browser project website`.
Done 2026-11-09: live and listed (evidence in projects.logsdon.io `docs/operations.md`,
"Wave 1 publication"). Quick start quoted, not executed; the page says so. No
Workers Builds caller workflow yet: content updates need a manual `cf deploy`.
Keyboard, viewport and axe checks were automated (3 engines); no human review pass.

## T10 — Publish Deferred Skill Catalog's microsite

- [x] Explain the problem and provide separate Pi/Claude Code setup instructions
  based on the selected source revision, including deferral configuration limits.
- [x] Include a concrete search/list example without invented savings claims.
- [x] Validate preview, publish independently, then add its directory/sitemap entry.

Verify: installation references, documented configuration, site contract, keyboard
review, and live responses; record unexercised product behavior explicitly.
Depends: Checkpoint B. Scope: deferred-skill-catalog `website/` intro, setup guide,
build/config, caller workflow (medium).
Suggested commit: `feat: publish Deferred Skill Catalog website`.
Done 2026-11-09: live and listed (evidence in projects.logsdon.io `docs/operations.md`,
"Wave 1 publication"). Quick start quoted, not executed; the page says so. No
Workers Builds caller workflow yet: content updates need a manual `cf deploy`.
Keyboard, viewport and axe checks were automated (3 engines); no human review pass.

## Checkpoint C — Wave 1

- [x] T08–T10 pass, each deployment and rollback remains independent.
- [x] No planned/broken entry is exposed in the public directory or sitemap.

Passed 2026-11-09. Each site is its own Worker and route; Detent and the hub were
unchanged across every deploy. Wave-1 rollback is Worker removal after reverting
the registry entry (first deployments); not re-exercised per site.

## T11 — Move Loop & Gate's product content into its family site

- [x] Inventory existing product HTML, field guides, public Markdown alternatives,
  downloads, and inbound URLs; produce a complete migration map.
- [x] Move authoritative content to the foundation repo's website, retaining the
  foundation-first path and Build/Grow/Accountability guides. Avoid README duplication.
- [x] Publish and verify all new destinations; keep old source untouched until T15.

Verify: guide link crawl, image/download references, sitemap, unique canonicals,
and destination checks against every old-to-new mapping. Content import and
publication config are separate small commits if more than five files are needed.
Depends: Checkpoint C. Scope: foundation `website/`, migration map and publish caller;
related kit README updates wait until destinations are live.
Suggested commit: `feat: publish Loop and Gate family website`.
Done 2026-11-09: live and listed (evidence in projects.logsdon.io `docs/operations.md`,
"Wave 2 publication"). Migration map is
`website/MIGRATION.md`; the five old URLs and five new destinations return 200, and
the three field guides stay on this site. Old and new Loop & Gate pages are both
live with their own canonicals until T15 (owner accepted the gap). Install
commands quoted, not executed. No
Workers Builds caller workflow yet: content updates need a manual `cf deploy`.
Keyboard, viewport and axe checks were automated (3 engines); no human review pass.

## T12 — Publish Writing Skills (proposed replacement)

- [x] Confirm Writing Skills as the eighth site (confirmed 2026-11-05); document
  the six skills, marketplace installation, and voice/profile requirements.
- [ ] Create an F introduction, D installation guide, and worked editing example;
  distinguish reusable skills from Shane-specific interviewing behavior and keep
  personal vault profiles private. Do not expand into the whole skills catalog.
- [x] Validate preview, publish independently, then add its directory/sitemap entry.

Verify: marketplace references, a reproducible example, site metadata/link checks,
and live prefix responses. Do not fabricate a before/after example from user data.
Depends: Checkpoint C and shortlist review. Scope: skills-writing `website/` intro,
guide/example, build/config, caller workflow (medium; split content if needed).
Suggested commit: `feat: publish Writing Skills project website`.
Published 2026-11-09 with one open item (evidence in projects.logsdon.io `docs/operations.md`,
"Wave 2 publication"). The introduction
and installation guide are done; install commands are quoted from the Grow Kit's
`reference/tools.md`, and the installed plugin matches source commit `d4e7ce7`.
Open: no worked before-and-after editing example. The guide has a repeatable
linter run on the project README instead, and none was invented. No
Workers Builds caller workflow yet: content updates need a manual `cf deploy`.
Keyboard, viewport and axe checks were automated (3 engines); no human review pass.

## T13 — Publish the Flat-file family site

- [x] Create one family introduction with a working static-build quick start and
  template/layout example; link the starter without copying obsolete deploy advice.
- [x] Prove the documented example with current selected PHP/Composer versions,
  or keep the site unpublished and record the specific compatibility blocker.
- [x] Publish independently and register its directory/sitemap entry.

Verify: disposable example build and artifact inspection, site checks, real paths.
Depends: Checkpoint C. Scope: php-flat-file website intro/guide/example,
build/config, caller workflow (medium; split example verification if needed).
Suggested commit: `feat: publish Flat-file family website`.
Done 2026-11-09: live and listed (evidence in projects.logsdon.io `docs/operations.md`,
"Wave 2 publication"). Quick start run in a
scratch project on PHP 8.5.11 and Composer 2.10.3: `dev-code-highlight` resolved to
`3ba5285` and `composer build` produced both example pages. Tagged `^1.0` is refused
(`require php ~7.1`), as the page states. Name is lowercase `flat-file` in site
and registry. No
Workers Builds caller workflow yet: content updates need a manual `cf deploy`.
Keyboard, viewport and axe checks were automated (3 engines); no human review pass.

## T14 — Publish Web Component Tools as one family

- [x] Build one family root plus distinct SSR, hydration, and JSX pages; preserve
  WIP/historical qualifications and link source/packages accurately.
- [x] Reproduce one end-to-end example; distinguish existing SSR implementation
  from modern declarative shadow DOM claims until demonstrated in code.
- [x] Publish independently and register its directory/sitemap entry.

Verify: example output and browser behavior, site contract, nested canonical URLs,
and cross-links. If example repair exceeds docs scope, record a blocker separately.
Depends: Checkpoint C. Scope: php-web-component-ssr website family root and three
tool pages (small content commit), then config/caller workflow as a separate unit.
Suggested commits: `docs: explain the web component tool family` and
`ci: publish Web Component Tools website`.
Done 2026-11-09: live and listed (evidence in projects.logsdon.io `docs/operations.md`,
"Wave 2 publication"). The PHP demo at
`00be84d`, with web-component-hydration 1.0.5 (lockfile checksum), ran in Chromium,
Firefox and WebKit: no placeholders left, shadow roots present, no errors. No
declarative shadow DOM claims. The JSX example was not run. No
Workers Builds caller workflow yet: content updates need a manual `cf deploy`.
Keyboard, viewport and axe checks were automated (3 engines); no human review pass.

## Checkpoint D — Remaining content

- [x] T11–T14 destinations pass; unresolved compatibility/content blockers are explicit.
- [x] All eight sites remain required; blocked members do not disappear from scope.

Passed 2026-11-09. All eight sites are live and listed. Every other Worker kept its
deployment and byte-identical responses across each wave-2 deploy. Open content
item: T12's worked editing example. No site is blocked.

## T15 — Cut over legacy URLs and connect the personal site

- [x] After destination proof, add one-hop permanent redirects for old product
  URLs/Markdown/assets as mapped; remove duplicate product output from the old sitemap.
- [x] Update `/work/`, relevant internal references, and selected GitHub website /
  README links to canonical destinations; retain personal editorial articles.
- [x] Document rollback for old redirects and retain source content history.

Verify: complete migration response matrix; personal `composer build`, CSS build if
changed, sitemap generation and artifact inspection; old/new canonical agreement.
Do not invoke IndexNow as a local test. Enumerate source pages before removing any.
Depends: T11 and live qualification of each linked project. Hermes Dispatch is
excluded; its existing content and URLs are outside this migration.
Scope: personal repo `netlify.toml`, `pages/work.php`, selected product pages and
known references, sitemap output logic only if needed. Split each product migration
and every other repo's README/website-field update into its own reviewed unit.
Suggested commit: `feat: connect the personal site to project microsites`.
Done 2026-11-11. `7b19b5f` 301s `/loop-and-gate/` and `/loop-and-gate/your-first-gate/`
(with or without the slash, query kept) to the collection's root and getting-started
pages, deletes the two source pages and drops them from the sitemap (86 → 84 URLs).
The three field guides stay, with unchanged canonicals, and every internal link
points straight at the new site. `d096638` adds the collection and seven project
rows to `/work/`; the grow field guide links Writing Skills. Rollback is the comment
above the redirects in `netlify.toml`: delete the two blocks and restore the two
pages from git history. GitHub: the four Loop & Gate READMEs link the new site, and
all ten project repo homepages point at their collection pages (detent-ui included).
No other personal-site article mentions a collection project. The four orphaned
images (`loop-and-gate-og/linkedin`, `your-first-gate-hero/og`) are kept for rollback.

## T16 — Verify the collection and establish search measurement

- [ ] Complete all eight site's launch evidence, preview exclusion, namespaces,
  status/compatibility disclosures, independent rollback, and host-level 404 checks.
- [ ] Verify Search Console access/property, submit the sitemap index when
  authorized, and record indexing/Google-selected canonicals separately from hosting.
- [ ] Document 30/90-day review dates, impressions/clicks and outbound events, and
  operating instructions for adding/removing a project without breaking URLs.

Verify: link/canonical/sitemap crawl, deployed browser checks, Search Console
evidence, Worker usage review; do not call indexing or ranking verified prematurely.
Depends: T07–T15. Scope: hub `docs/launch-evidence.md`, `docs/operations.md`,
`projects.json`, measurement config if adopted (small).
Suggested commit: `docs: record microsite launch and operations evidence`.

## Completion

- [ ] All tasks complete, or overall status explicitly incomplete with named blockers.
- [ ] Exact touched repos/paths, checks, deployment versions, URLs, manual gates,
  and rollback procedures reported. Commit approval remains per reviewed unit.
