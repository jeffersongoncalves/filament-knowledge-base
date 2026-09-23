# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

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
