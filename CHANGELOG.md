# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

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
