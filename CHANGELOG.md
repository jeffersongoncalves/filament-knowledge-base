# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

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
