# Article Frontmatter Reference

Every article under `pages/articles/` requires a YAML frontmatter block delimited by `---`.

## Required Fields

| Field | Type | Description |
|---|---|---|
| `title` | string | Human-readable article title. |
| `date` | `YYYY-MM-DD` | Publication date. Must match the date in `articles-list.json`. |
| `slug` | string (`[a-z0-9-]+`) | URL slug. Must match the file name and the key in `articles-list.json`. |
| `description` | string | One-to-two sentence summary. Shown in listings and used as the meta description. |

## Optional Fields

| Field | Type | Description |
|---|---|---|
| `layout` | string | Lume layout path (default: `partials::layouts/writing-post`). |
| `image` | string | OG image filename (looked up under `public/images/`). |
| `heroImage` | string | Hero image filename (looked up under `public/images/`). |
| `draft` | boolean | When `true`, excluded from production builds. Defaults to `false`. |
| `faqs` | array of `{q, a}` | Optional FAQ pairs rendered as FAQ schema markup. |

## Category Values

The `category` field in `articles-list.json` must be one of:

- `industry-analysis`
- `leadership-and-management`
- `strategic-insights`
- `technical-deep-dives`

The article file lives at `pages/articles/<category>/<slug>.md`.

## Example

```yaml
---
title: "Your Article Title"
date: 2026-06-01
layout: 'partials::layouts/writing-post'
slug: your-article-title
image: your-article-title-og.png
heroImage: your-article-title-hero.png
draft: false
description: "A concise, one-to-two sentence description of the article."
---
```

## articles-list.json Entry

Each published article also requires an entry in `resources/data/articles-list.json`. See `resources/data/schema.json` for the full JSON Schema. Minimum required fields:

```json
{
  "your-article-title": {
    "title": "Your Article Title",
    "description": "A concise, one-to-two sentence description of the article.",
    "date": "2026-06-01",
    "category": "strategic-insights",
    "archived": false,
    "tags": ["tag-one", "tag-two"]
  }
}
```
