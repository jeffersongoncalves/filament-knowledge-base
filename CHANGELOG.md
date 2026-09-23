# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

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
