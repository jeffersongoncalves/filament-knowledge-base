<div class="filament-hidden">

![Filament Knowledge Base](https://raw.githubusercontent.com/jeffersongoncalves/filament-knowledge-base/1.x/art/jeffersongoncalves-filament-knowledge-base.png)

</div>

# Filament Knowledge Base

A Filament plugin for [jeffersongoncalves/laravel-knowledge-base](https://github.com/jeffersongoncalves/laravel-knowledge-base) that provides Admin, User, and Guest panels for complete knowledge base management.

## Compatibility

| Version | Filament | PHP | Laravel | Tailwind |
|---------|----------|-----|---------|----------|
| 1.x | ^3.0 | ^8.1 | ^10.0 | 3.x |
| 2.x | ^4.0 | ^8.2 | ^11.0 | 4.x |
| 3.x | ^5.0 | ^8.2 | ^11.28 | 4.x |

## Installation

```bash
composer require jeffersongoncalves/filament-knowledge-base:"^1.0"
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

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
