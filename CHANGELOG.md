# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## 1.3.0 - 2026-10-11

### Breaking changes

- **Requires `jeffersongoncalves/laravel-knowledge-base` ^2.0, and so PHP ^8.2.**
- **The configured default language is always the authoritative one.** The article form's authoritative-language select is gone, matching the core change.

### What's new

- **Editor uploads become article assets** (#63): files dropped into the editor (the paperclip) are stored through the core's `ArticleAssets` in the article's own folder. An upload in the default language's tab is shared; one in another tab belongs to that language. On save, images get the asset's id, so the core resolves their current URL, knows where they are used and notices when they are deleted.
- **Assets tab** on the article: thumbnail cards with name, size, scope and usage ("Used in EN, DE" / "Unused"), plus upload and delete. Deleting an asset that is still used shows a warning first.
- **Missing-asset warnings**: a banner on the article form and a badge in the article list while content still refers to a deleted asset.
- On the create page the paperclip is left out, with a hint to save the article first.
- **View on site**: new plugin option `publicUrlUsing(fn (Article $article, string $locale) => …)` adds a per-language "View on site" action to the view and edit pages.

The Insert image / Attach file pickers that reuse existing assets are not available here, because Filament 3's editor (Trix) keeps only an attachment's URL.

### Upgrading

1. Upgrade the core to ^2.0 and follow its [upgrade notes](https://github.com/jeffersongoncalves/laravel-knowledge-base/releases/tag/v2.0.0): publish its migrations and run `php artisan migrate`.
2. With the default `public` disk, run `php artisan storage:link` once.

Backport of #61 by @rcoenen to Filament 3. Thanks!

## 1.2.0 - 2026-10-11

### What's new

- **Requires `jeffersongoncalves/laravel-knowledge-base` ^1.1** (#49).
- **Content localization in the admin** (#53): with more than one language configured, the article and category forms get a tab per language, an authoritative-language select and a per-language version status; the article list gets a state per language (missing / draft / published / outdated), a **Mark up to date** action and an **Outdated in language** filter. Single-language installs are unchanged.
- **Collections admin** (#60): curated, ordered lists of articles (e.g. an FAQ) with a per-language name, slug and description, a drag-to-reorder article picker, and a warning (with the reason) for every article customers cannot currently see.

### Fixed

- **Guest and User panels show only publicly visible content** (#58): a public article in an internal, inactive or deleted category (or under such an ancestor) is no longer shown in the article list, on its page, in the category counts or in the popular-articles widget.

### Upgrading

Requires laravel-knowledge-base ^1.1. Re-publish the core migrations and run `add_kb_content_localization` and `add_kb_collections`; **set `knowledge-base.default_locale` to the language your existing content is written in before migrating**, since the upgrade tags all existing content with it.

Backports of #46, #47 and #48 by @rcoenen to Filament 3 — thanks!

## 1.1.1 - 2026-10-10

### What's Changed

* ci: standardize tests workflow (1.x) by @jeffersongoncalves in https://github.com/jeffersongoncalves/filament-knowledge-base/pull/26
* fix: make ArticleResource::hasSeo() public (1.x) by @jeffersongoncalves in https://github.com/jeffersongoncalves/filament-knowledge-base/pull/29
* ci: run PHPStan on PHP 8.4 (1.x) by @jeffersongoncalves in https://github.com/jeffersongoncalves/filament-knowledge-base/pull/30
* fix: repair PHPStan config and the type errors it was hiding by @jeffersongoncalves in https://github.com/jeffersongoncalves/filament-knowledge-base/pull/33
* ci: auto-merge dependabot github-actions minor/patch by @jeffersongoncalves in https://github.com/jeffersongoncalves/filament-knowledge-base/pull/36
* ci: let the Pint workflow push its fixes by @jeffersongoncalves in https://github.com/jeffersongoncalves/filament-knowledge-base/pull/39
* Fix enum state crash in article badges and related-articles sort (1.x) by @jeffersongoncalves in https://github.com/jeffersongoncalves/filament-knowledge-base/pull/44

**Full Changelog**: https://github.com/jeffersongoncalves/filament-knowledge-base/compare/1.1.0...1.1.1

## 1.1.0 - 2026-09-23

### What's new

- **Translations:** 17 new locales (ar, az, de, es, fa, fr, hi, it, ja, nl, pl, pt, ru, tr, uk, uz, zh_CN). (#23)

Thanks to @Elvin-Qulizade (Elvin Qulizada) for the i18n initiative behind these translations — first contributed in jeffersongoncalves/filament-scanner-guard#2 and now rolled out across the Filament plugins. He is credited as co-author.

### What's Changed

* docs: add Buy Me a Coffee sponsor link by @jeffersongoncalves in https://github.com/jeffersongoncalves/filament-knowledge-base/pull/5
* docs: standardize README section structure by @jeffersongoncalves in https://github.com/jeffersongoncalves/filament-knowledge-base/pull/8
* chore: add Buy Me a Coffee to FUNDING.yml by @jeffersongoncalves in https://github.com/jeffersongoncalves/filament-knowledge-base/pull/11
* ci: standardize update-changelog workflow (1.x) by @jeffersongoncalves in https://github.com/jeffersongoncalves/filament-knowledge-base/pull/13
* ci: standardize tests workflow (1.x) by @jeffersongoncalves in https://github.com/jeffersongoncalves/filament-knowledge-base/pull/20
* chore(deps-dev): update larastan/larastan requirement from ^2.0 to ^3.12 in the composer-deps group by @dependabot[bot] in https://github.com/jeffersongoncalves/filament-knowledge-base/pull/19
* chore(deps): bump the actions-deps group across 1 directory with 2 updates by @dependabot[bot] in https://github.com/jeffersongoncalves/filament-knowledge-base/pull/17
* feat(i18n): add translations (1.x) by @jeffersongoncalves in https://github.com/jeffersongoncalves/filament-knowledge-base/pull/23

**Full Changelog**: https://github.com/jeffersongoncalves/filament-knowledge-base/compare/v1.0.1...1.1.0

## v1.0.1 - 2026-02-18

### What's Changed

- Added comprehensive Pest tests for plugins, service provider, resources, and config
- Improved test assertions and consistency

**Full Changelog**: https://github.com/jeffersongoncalves/filament-knowledge-base/compare/v1.0.0...v1.0.1

## v1.0.0 - 2026-02-18

Initial release for Filament v3

### Features

- **KnowledgeBasePlugin** (Admin) - Full CRUD for categories and articles with versioning, feedback, related articles, and SEO
- **KnowledgeBaseUserPlugin** (User) - Read-only access to published articles with feedback capability
- **KnowledgeBaseGuestPlugin** (Guest) - Public read-only access without authentication
- Feature toggles via fluent API and config
- Knowledge Base Overview widget with stats
- Popular Articles widget
- Search and browse page
- Translations: English and Brazilian Portuguese

### Requirements

- PHP ^8.1
- Laravel ^10.0
- Filament ^3.0

## [Unreleased]

## [1.0.0] - YYYY-MM-DD

### Added

- KnowledgeBasePlugin (Admin) - Full CRUD for categories and articles
- KnowledgeBaseUserPlugin (User) - Read-only view with feedback for authenticated users
- KnowledgeBaseGuestPlugin (Guest) - Public read-only view without authentication
- Article versioning support with relation manager
- Article feedback management
- Related articles relation manager
- SEO fields support (configurable)
- Knowledge Base overview widget with stats
- Popular articles widget for User and Guest panels
- Knowledge Base search page
- Feature toggles: versioning, feedback, related_articles, seo
- Translations: English and Brazilian Portuguese
