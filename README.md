<div class="filament-hidden">

![Filament Knowledge Base](https://raw.githubusercontent.com/jeffersongoncalves/filament-knowledge-base/2.x/art/jeffersongoncalves-filament-knowledge-base.png)

</div>

# Filament Knowledge Base

[![Buy Me A Coffee](https://img.shields.io/badge/Buy%20Me%20A%20Coffee-support-FFDD00?style=flat-square&logo=buy-me-a-coffee&logoColor=black)](https://buymeacoffee.com/jeffersongoncalves)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/jeffersongoncalves/filament-knowledge-base.svg?style=flat-square)](https://packagist.org/packages/jeffersongoncalves/filament-knowledge-base)[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/jeffersongoncalves/filament-knowledge-base/tests.yml?branch=2.x&label=tests&style=flat-square)](https://github.com/jeffersongoncalves/filament-knowledge-base/actions?query=workflow%3Atests+branch%3A2.x)[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/jeffersongoncalves/filament-knowledge-base/fix-php-code-style-issues.yml?branch=2.x&label=code%20style&style=flat-square)](https://github.com/jeffersongoncalves/filament-knowledge-base/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3A2.x)[![Total Downloads](https://img.shields.io/packagist/dt/jeffersongoncalves/filament-knowledge-base.svg?style=flat-square)](https://packagist.org/packages/jeffersongoncalves/filament-knowledge-base)[![License](https://img.shields.io/packagist/l/jeffersongoncalves/filament-knowledge-base.svg?style=flat-square)](LICENSE.md)

A Filament plugin for [jeffersongoncalves/laravel-knowledge-base](https://github.com/jeffersongoncalves/laravel-knowledge-base) that provides Admin, User, and Guest panels for complete knowledge base management.

## Compatibility

| Version | Filament | PHP | Laravel | Tailwind |
|---------|----------|-----|---------|----------|
| 1.x | ^3.0 | ^8.1 | ^10.0 | 3.x |
| 2.x | ^4.0 | ^8.2 | ^11.0 | 4.x |
| 3.x | ^5.0 | ^8.2 | ^11.28 | 4.x |

## Installation

You can install the package via composer:

```bash
composer require jeffersongoncalves/filament-knowledge-base:"^2.0"
```

Publish the configuration (optional):

```bash
php artisan vendor:publish --tag="filament-knowledge-base-config"
```

## Usage

### Admin Panel

Full management capabilities: categories, articles, versions, feedback, related articles, and SEO.

```php
use JeffersonGoncalves\FilamentKnowledgeBase\KnowledgeBasePlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            KnowledgeBasePlugin::make()
                ->versioning(true)
                ->feedback(true)
                ->relatedArticles(true)
                ->seo(true)
                ->navigationGroup('Knowledge Base'),
        ]);
}
```

**Resources:** Category (hierarchical, sortable), Article (with status, visibility, SEO fields).

**Relation Managers:** Versions (read-only history), Feedback (helpful/not helpful), Related Articles (attach/detach with sort order).

**Widgets:** Knowledge Base Overview (total articles, published, drafts, categories, views, helpful rate).

#### Languages

When the core package is configured with more than one language
(`knowledge-base.locales`), the article and category forms grow a tab per
language and the article list grows a state per language.

- **Article form:** one tab per language with that language's title, slug,
  excerpt, content and SEO fields, an **authoritative language** select and a
  per-language version status. The authoritative version follows the article's
  own status; every other language is published on its own. A **“Mark other
  languages outdated”** toggle (off by default) flags the other languages when
  you save the authoritative version.
- **Article list:** a state per language (`missing`, `draft`, `published`,
  `outdated`), a **Mark up to date** action for outdated versions and an
  **Outdated in language** filter. Both the columns and the filter adapt to the
  configured languages.
- **Category form:** one tab per language with that language's name, slug and
  description; the default language is required, the others are optional.

With a single configured language the forms, the list and the actions are
exactly as above without a `Languages` section: nothing changes for
single-language installs.

### User Panel

Read-only access to published articles for authenticated users, with feedback capability.

```php
use JeffersonGoncalves\FilamentKnowledgeBase\KnowledgeBaseUserPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            KnowledgeBaseUserPlugin::make()
                ->feedback(true)
                ->navigationGroup('Knowledge Base'),
        ]);
}
```

**Resources:** Article (published/public only, view with feedback buttons).

**Pages:** Knowledge Base (search and browse by category).

**Widgets:** Popular Articles (top 5 by view count).

### Guest Panel

Public read-only access without authentication. No feedback capability.

```php
use JeffersonGoncalves\FilamentKnowledgeBase\KnowledgeBaseGuestPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            KnowledgeBaseGuestPlugin::make()
                ->navigationGroup('Knowledge Base'),
        ]);
}
```

**Resources:** Article (published/public only, view with view count increment).

**Pages:** Knowledge Base (search and browse by category).

**Widgets:** Popular Articles (top 5 by view count).

## Feature Toggles

Each plugin supports fluent feature toggles:

| Method | Default | Description |
|--------|---------|-------------|
| `versioning(bool)` | `true` | Article version history |
| `feedback(bool)` | `true` | Helpful/not helpful feedback |
| `relatedArticles(bool)` | `true` | Related articles management |
| `seo(bool)` | `true` | SEO fields (title, description, keywords) |

Features can also be toggled globally in `config/filament-knowledge-base.php`.

### Plugin Comparison

| Feature | Admin | User | Guest |
|---------|-------|------|-------|
| CRUD Categories | Yes | No | No |
| CRUD Articles | Yes | No | No |
| View Published Articles | All | Public only | Public only |
| Feedback | Manage | Submit | No |
| Versions | Manage | No | No |
| Related Articles | Manage | View | View |
| Search | Yes | Yes | Yes |
| Requires Auth | Yes | Yes | No |

## Images in articles

Files added in the article editor (images) are stored where the core's `knowledge-base.attachments` setting says: `knowledge-base/attachments` on the `public` disk by default. Run `php artisan storage:link` once so readers can see them, or point `KB_ATTACHMENTS_DISK` at a cloud disk such as `s3`. See the [laravel-knowledge-base README](https://github.com/jeffersongoncalves/laravel-knowledge-base#attachments).

## Localization

Translations are provided for:
- English (`en`)
- Brazilian Portuguese (`pt_BR`)

Publish translations to customize:

```bash
php artisan vendor:publish --tag="filament-knowledge-base-translations"
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please see [SECURITY](.github/SECURITY.md) for details.

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
