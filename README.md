# shane.logsdon.io

## Development

```bash
composer install
composer develop
```

## Build

```bash
composer build
```

## Professional principles and practices

`pages/how-i-work.php` serves `/how-i-work/`, a reference for hiring managers and
engineering leaders covering product judgment, engineering practice, and working
relationships. It uses C · Sheet (architecture Q3) and the shared revision/date
title block. About and the footer provide discovery links.

The [original copy and design](docs/superpowers/specs/2026-11-26-how-i-work-design.md)
records the first version's sources. Revision 2 (2026-11-27) rewrote the copy from
the public Build Field Guide, the resume, and the Working With Me note: every
principle carries an "on file" line linking the public work behind it, so add one
whenever a principle is added. Don't cite a private vault note on the page. Update the reviewed date
fallback when revising the content; full-history builds derive revision and date
from git. Validate with `npm run build:css`, `composer build`, and
`php scripts/generate-sitemap.php`; inspect the generated page and sitemap.

## License

The following directories and their contents are copyright Shane Logsdon. You may not reuse anything therein without my permission:

- `pages/writing/`
- `pages/decks/`

All other directories and files are MIT Licensed. See [LICENSE](https://github.com/slogsdon/slogsdon.github.io/blob/master/LICENSE) for more details.
