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

**Relation Managers:** Assets (the article's images and files), Versions (read-only history), Feedback (helpful/not helpful), Related Articles (attach/detach with sort order).

**Widgets:** Knowledge Base Overview (total articles, published, drafts, categories, views, helpful rate).

#### Languages

When the core package is configured with more than one language
(`knowledge-base.locales`), the article and category forms grow a tab per
language and the article list grows a state per language.

- **Article form:** one tab per language with that language's title, slug,
  excerpt, content and SEO fields and a per-language version status. The
  configured default language is always the authoritative one — there is no
  per-article choice. The authoritative version follows the article's own
  status; every other language is published on its own. A **“Mark other
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

## Images and files in articles

The article editor's paperclip is replaced by two tools that store every upload as an asset of the article (through the core's `ArticleAssets`), so files land in the article's own folder instead of the root of Filament's default disk:

- **Insert image** uploads a new image or reuses one the article already has (a thumbnail picker), asks for alt text and inserts it where the cursor is.
- **Attach file** uploads a new file or reuses one and inserts a download link showing the file name and size.

The scope follows the tab you are in: an upload in the default language's tab (or the single-language form) is a **shared** asset, an upload in another language's tab belongs to that language. Images carry the asset's id, so the editor and the public pages always build the current URL — moving the site to another domain or port never breaks them. Allowed types and sizes come from the core's `knowledge-base.attachments` setting.

The **Assets** relation manager on the edit page shows the article's assets as a grid of thumbnails (a file icon for files) with their name, size, scope (Shared / language) and where they are used ("Used in EN, DE" or "Unused"). It can upload and delete; deleting an asset that is still used is allowed but the confirmation names the languages. While any language still refers to a deleted asset, the article form shows a warning and the article list marks the article, until the reference is fixed.

On the **create** page there is no article yet to belong to, so the tools are left out with the hint "Save the article first to add images and files."

Run `php artisan storage:link` once so readers can see the files, or point `KB_ATTACHMENTS_DISK` at a cloud disk such as `s3`. See the [laravel-knowledge-base README](https://github.com/jeffersongoncalves/laravel-knowledge-base#article-assets) for the storage layout, allowed types and the `kb:prune-assets` command.

### Livewire nesting depth

Rich text is synchronised with Livewire as nested data, and Livewire limits nested property paths to 10 levels by default. An ordinary bullet list already goes deeper (in Filament's own rich editor too, and the language tabs add two more levels), which shows as a `MaxNestingDepthExceededException`. Raise `payload.max_nesting_depth` in your app's `config/livewire.php` as [Filament's rich editor documentation](https://filamentphp.com/docs/5.x/forms/rich-editor#configuring-livewires-maximum-nesting-depth) describes; 32 leaves room for nested lists and tables.

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
