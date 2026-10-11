# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## 2.2.0 - 2026-10-11

### What's new

- **Requires `jeffersongoncalves/laravel-knowledge-base` ^1.1** (#50).
- **Content localization in the admin** (#52): with more than one language configured, the article and category forms get a tab per language, an authoritative-language select and a per-language version status; the article list gets a state per language (missing / draft / published / outdated), a **Mark up to date** action and an **Outdated in language** filter. Single-language installs are unchanged.
- **Collections admin** (#59): curated, ordered lists of articles (e.g. an FAQ) with a per-language name, slug and description, a drag-to-reorder article picker, and a warning (with the reason) for every article customers cannot currently see.

### Fixed

- **Guest and User panels show only publicly visible content** (#57): a public article in an internal, inactive or deleted category (or under such an ancestor) is no longer shown in the article list, on its page, in the category counts or in the popular-articles widget.

### Upgrading

Requires laravel-knowledge-base ^1.1. Re-publish the core migrations and run `add_kb_content_localization` and `add_kb_collections`; **set `knowledge-base.default_locale` to the language your existing content is written in before migrating**, since the upgrade tags all existing content with it.

Backports of #46, #47 and #48 by @rcoenen — thanks!

## 2.1.1 - 2026-10-10

### What's Changed

* ci: standardize tests workflow (2.x) by @jeffersongoncalves in https://github.com/jeffersongoncalves/filament-knowledge-base/pull/27
* ci: run PHPStan on PHP 8.4 (2.x) by @jeffersongoncalves in https://github.com/jeffersongoncalves/filament-knowledge-base/pull/31
* fix: KnowledgeBasePage fatal error and PHPStan config by @jeffersongoncalves in https://github.com/jeffersongoncalves/filament-knowledge-base/pull/34
* ci: auto-merge dependabot github-actions minor/patch by @jeffersongoncalves in https://github.com/jeffersongoncalves/filament-knowledge-base/pull/37
* ci: let the Pint workflow push its fixes by @jeffersongoncalves in https://github.com/jeffersongoncalves/filament-knowledge-base/pull/40
* Fix enum state crash in article badges and related-articles sort (2.x) by @jeffersongoncalves in https://github.com/jeffersongoncalves/filament-knowledge-base/pull/43

**Full Changelog**: https://github.com/jeffersongoncalves/filament-knowledge-base/compare/2.1.0...2.1.1

## 2.1.0 - 2026-09-23

### What's new

- **Translations:** 17 new locales (ar, az, de, es, fa, fr, hi, it, ja, nl, pl, pt, ru, tr, uk, uz, zh_CN). (#24)

Thanks to @Elvin-Qulizade (Elvin Qulizada) for the i18n initiative behind these translations — first contributed in jeffersongoncalves/filament-scanner-guard#2 and now rolled out across the Filament plugins. He is credited as co-author.

### What's Changed

* docs: add Buy Me a Coffee sponsor link by @jeffersongoncalves in https://github.com/jeffersongoncalves/filament-knowledge-base/pull/6
* docs: standardize README section structure by @jeffersongoncalves in https://github.com/jeffersongoncalves/filament-knowledge-base/pull/9
* chore: add Buy Me a Coffee to FUNDING.yml by @jeffersongoncalves in https://github.com/jeffersongoncalves/filament-knowledge-base/pull/12
* ci: standardize update-changelog workflow (2.x) by @jeffersongoncalves in https://github.com/jeffersongoncalves/filament-knowledge-base/pull/14
* ci: standardize tests workflow (2.x) by @jeffersongoncalves in https://github.com/jeffersongoncalves/filament-knowledge-base/pull/21
* chore(deps): bump the actions-deps group across 1 directory with 2 updates by @dependabot[bot] in https://github.com/jeffersongoncalves/filament-knowledge-base/pull/18
* feat(i18n): add translations (2.x) by @jeffersongoncalves in https://github.com/jeffersongoncalves/filament-knowledge-base/pull/24

**Full Changelog**: https://github.com/jeffersongoncalves/filament-knowledge-base/compare/v2.0.2...2.1.0

## v2.0.2 - 2026-03-04

### Breaking Changes

- **Minimum Filament version bumped to `^4.8`** — required due to the new `PageConfiguration` parameter added to `Page::routes()` in [filamentphp/filament#19225](https://github.com/filamentphp/filament/pull/19225)

### What's Changed

- Update `composer.json` to require `filament/filament: ^4.8`

## v2.0.1 - 2026-02-18

### What's Changed

- Added comprehensive Pest tests for plugins, service provider, resources, and config
- Code style fixes via Pint

**Full Changelog**: https://github.com/jeffersongoncalves/filament-knowledge-base/compare/v2.0.0...v2.0.1

## v2.0.0 - 2026-02-18

Release for Filament v4

### Features

- All features from v1.0.0
- Migrated to Filament v4 Schema-based architecture
- Heroicon enum constants for type-safe icon usage
- Centralized Actions namespace (Filament\Actions)
- Modular resource structure (Schemas/, Tables/ subdirectories)
- recordActions() and toolbarActions() API

### Breaking Changes from v1.x

- Requires Filament ^4.0
- Requires PHP ^8.2
- Resource structure changed to hierarchical pattern

### Requirements

- PHP ^8.2
- Laravel ^11.0
- Filament ^4.0

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
