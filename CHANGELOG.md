# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## 3.3.1 - 2026-10-12

### Fixed

- **Article assets work on a private disk** (#64). Asset-manager thumbnails come from the core's `ArticleAssets::url()`, which gives a signed URL for an article that isn't public, instead of a disk URL.
- **The admin view page and the Guest and User panels resolve article content before showing it.** Readers get each asset's current URL, and a deleted image is left out. Before this, a stored URL that had changed or expired showed as a broken image.
- **Editor:** file attachments use `private` visibility. The core stores the files and builds every URL.

Works with `jeffersongoncalves/laravel-knowledge-base` ^2.0. `storage:link` is only needed with core versions that link straight to the public disk.

Thanks @rcoenen for #64!

## 3.3.0 - 2026-10-11

### Breaking changes

- **Requires `jeffersongoncalves/laravel-knowledge-base` ^2.0.**
- **The configured default language is always the authoritative one.** The article form's authoritative-language select is gone, matching the core change.

### What's new

- **Article assets in the editor** (#61): Filament's paperclip is replaced by **Insert image** and **Attach file**. Each one can upload a new file or reuse one the article already has, picked from thumbnail cards. Uploads are stored through the core's `ArticleAssets` in the article's own folder. An upload in the default language's tab is shared; one in another tab belongs to that language. Images carry the asset's id, so their URL is rebuilt on every load.
- **Assets tab** on the article: thumbnail cards with name, size, scope and usage ("Used in EN, DE" / "Unused"), plus upload and delete. Deleting an asset that is still used shows a warning first.
- **Missing-asset warnings**: a banner on the edit page and a badge in the article list while content still refers to a deleted asset.
- **View on site**: new plugin option `publicUrlUsing(fn (Article $article, string $locale) => …)` adds a per-language "View on site" menu to the view and edit pages.
- **Article screens**: the view page shows the article full width, with its details in a tab; relation tabs on the edit page are set apart from the form; Save and Cancel are sticky and stay disabled until something changes; language tabs are underlined.
- pt_BR translations for the asset strings.

### Fixed

- An editor can reuse only the images and files that the current tab offers.

### Upgrading

1. Upgrade the core to ^2.0 and follow its [upgrade notes](https://github.com/jeffersongoncalves/laravel-knowledge-base/releases/tag/v2.0.0): publish its migrations and run `php artisan migrate`.
2. Run `php artisan filament:assets` to publish the plugin stylesheet.
3. With the default `public` disk, run `php artisan storage:link` once.
4. If rich text in language tabs hits a `MaxNestingDepthExceededException`, raise `payload.max_nesting_depth` in `config/livewire.php` (see the README).

Thanks @rcoenen for #61!

## 3.2.0 - 2026-10-11

### What's new

- **Requires `jeffersongoncalves/laravel-knowledge-base` ^1.1** (#51).
- **Content localization in the admin** (#46): with more than one language configured, the article and category forms get a tab per language, an authoritative-language select and a per-language version status; the article list gets a state per language (missing / draft / published / outdated), a **Mark up to date** action and an **Outdated in language** filter. Single-language installs are unchanged.
- **Collections admin** (#48): curated, ordered lists of articles (e.g. an FAQ) with a per-language name, slug and description, a drag-to-reorder article picker, and a warning (with the reason) for every article customers cannot currently see.

### Fixed

- **Guest and User panels show only publicly visible content** (#47): a public article in an internal, inactive or deleted category (or under such an ancestor) is no longer shown in the article list, on its page, in the category counts or in the popular-articles widget.

### Upgrading

Requires laravel-knowledge-base ^1.1. Re-publish the core migrations and run `add_kb_content_localization` and `add_kb_collections`; **set `knowledge-base.default_locale` to the language your existing content is written in before migrating**, since the upgrade tags all existing content with it.

Thanks @rcoenen for #46, #47 and #48.

## 3.1.1 - 2026-10-10

### What's Changed

* ci: standardize tests workflow (3.x) by @jeffersongoncalves in https://github.com/jeffersongoncalves/filament-knowledge-base/pull/28
* ci: run PHPStan on PHP 8.4 (3.x) by @jeffersongoncalves in https://github.com/jeffersongoncalves/filament-knowledge-base/pull/32
* fix: PopularArticlesWidget fatal error and PHPStan config by @jeffersongoncalves in https://github.com/jeffersongoncalves/filament-knowledge-base/pull/35
* ci: auto-merge dependabot github-actions minor/patch by @jeffersongoncalves in https://github.com/jeffersongoncalves/filament-knowledge-base/pull/38
* ci: let the Pint workflow push its fixes by @jeffersongoncalves in https://github.com/jeffersongoncalves/filament-knowledge-base/pull/41
* Fix enum state crash in article badges and related-articles sort by @rcoenen in https://github.com/jeffersongoncalves/filament-knowledge-base/pull/42
* Fix PHPStan error in related-articles pivot sort by @jeffersongoncalves in https://github.com/jeffersongoncalves/filament-knowledge-base/pull/45

### New Contributors

* @rcoenen made their first contribution in https://github.com/jeffersongoncalves/filament-knowledge-base/pull/42

**Full Changelog**: https://github.com/jeffersongoncalves/filament-knowledge-base/compare/3.1.0...3.1.1

## 3.1.0 - 2026-09-23

### What's new

- **Translations:** 17 new locales (ar, az, de, es, fa, fr, hi, it, ja, nl, pl, pt, ru, tr, uk, uz, zh_CN). (#25)

Thanks to @Elvin-Qulizade (Elvin Qulizada) for the i18n initiative behind these translations — first contributed in jeffersongoncalves/filament-scanner-guard#2 and now rolled out across the Filament plugins. He is credited as co-author.

### What's Changed

* chore(deps): bump ramsey/composer-install from 3 to 4 by @dependabot[bot] in https://github.com/jeffersongoncalves/filament-knowledge-base/pull/1
* chore(deps): bump dependabot/fetch-metadata from 2.5.0 to 3.0.0 by @dependabot[bot] in https://github.com/jeffersongoncalves/filament-knowledge-base/pull/2
* chore(deps): bump actions/checkout from 6 to 7 by @dependabot[bot] in https://github.com/jeffersongoncalves/filament-knowledge-base/pull/3
* docs: add Buy Me a Coffee sponsor link by @jeffersongoncalves in https://github.com/jeffersongoncalves/filament-knowledge-base/pull/4
* docs: standardize README section structure by @jeffersongoncalves in https://github.com/jeffersongoncalves/filament-knowledge-base/pull/7
* chore: add GitHub Sponsors to FUNDING.yml by @jeffersongoncalves in https://github.com/jeffersongoncalves/filament-knowledge-base/pull/10
* ci: standardize update-changelog workflow (3.x) by @jeffersongoncalves in https://github.com/jeffersongoncalves/filament-knowledge-base/pull/15
* ci: standardize dependabot config by @jeffersongoncalves in https://github.com/jeffersongoncalves/filament-knowledge-base/pull/16
* ci: standardize tests workflow (3.x) by @jeffersongoncalves in https://github.com/jeffersongoncalves/filament-knowledge-base/pull/22
* feat(i18n): add translations (3.x) by @jeffersongoncalves in https://github.com/jeffersongoncalves/filament-knowledge-base/pull/25

**Full Changelog**: https://github.com/jeffersongoncalves/filament-knowledge-base/compare/v3.0.2...3.1.0

## v3.0.2 - 2026-03-04

### Breaking Changes

- **Minimum Filament version bumped to `^5.3`** — required due to the new `PageConfiguration` parameter added to `Page::routes()` in [filamentphp/filament#19225](https://github.com/filamentphp/filament/pull/19225)

### What's Changed

- Update `composer.json` to require `filament/filament: ^5.3`

## v3.0.1 - 2026-02-18

### What's Changed

- Added comprehensive Pest tests for plugins, service provider, resources, and config
- Code style fixes via Pint

**Full Changelog**: https://github.com/jeffersongoncalves/filament-knowledge-base/compare/v3.0.0...v3.0.1

## v3.0.0 - 2026-02-18

Release for Filament v5

### Features

- All features from v2.0.0
- Full Filament v5 compatibility with Livewire v4
- Non-static widget heading property
- Complete Heroicon enum migration

### Breaking Changes from v2.x

- Requires Filament ^5.0
- Requires Livewire v4

### Requirements

- PHP ^8.2
- Laravel ^11.28
- Filament ^5.0

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
