---
name: filament-knowledge-base-development
description: Build and work with Filament Knowledge Base features, including Admin/User/Guest panels, categories, articles, versioning, feedback, related articles, and SEO.
---

# Filament Knowledge Base Development

## When to use this skill

Use this skill when:
- Setting up a knowledge base in a Filament application
- Configuring Admin, User, or Guest panels for knowledge base management
- Working with article categories, versions, feedback, or related articles
- Customizing navigation, feature toggles, or translations for the knowledge base
- Troubleshooting knowledge base plugin registration or configuration issues

## Architecture

The plugin provides three separate Filament plugins, each designed for a different user role:

- `KnowledgeBasePlugin` - Full admin CRUD for categories and articles
- `KnowledgeBaseUserPlugin` - Read-only access for authenticated users with feedback
- `KnowledgeBaseGuestPlugin` - Public read-only access without authentication

All three plugins share the `HasKnowledgeBasePluginConfig` trait for common configuration.

### Namespace

```
JeffersonGoncalves\FilamentKnowledgeBase
```

### Key Classes

| Class | Namespace | Purpose |
|-------|-----------|---------|
| `KnowledgeBasePlugin` | `JeffersonGoncalves\FilamentKnowledgeBase` | Admin panel plugin |
| `KnowledgeBaseUserPlugin` | `JeffersonGoncalves\FilamentKnowledgeBase` | User panel plugin |
| `KnowledgeBaseGuestPlugin` | `JeffersonGoncalves\FilamentKnowledgeBase` | Guest panel plugin |
| `ArticleResource` (Admin) | `JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources` | Admin article CRUD |
| `CategoryResource` | `JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources` | Admin category CRUD |
| `ArticleResource` (User) | `JeffersonGoncalves\FilamentKnowledgeBase\User\Resources` | User article read-only |
| `ArticleResource` (Guest) | `JeffersonGoncalves\FilamentKnowledgeBase\Guest\Resources` | Guest article read-only |
| `KnowledgeBaseOverviewWidget` | `JeffersonGoncalves\FilamentKnowledgeBase\Admin\Widgets` | Admin dashboard stats |
| `PopularArticlesWidget` | `JeffersonGoncalves\FilamentKnowledgeBase\User\Widgets` | User popular articles |
| `PopularArticlesWidget` | `JeffersonGoncalves\FilamentKnowledgeBase\Guest\Widgets` | Guest popular articles |
| `KnowledgeBasePage` (User) | `JeffersonGoncalves\FilamentKnowledgeBase\User\Pages` | User browse/search page |
| `KnowledgeBasePage` (Guest) | `JeffersonGoncalves\FilamentKnowledgeBase\Guest\Pages` | Guest browse/search page |

### Relation Managers (Admin)

| Class | Purpose |
|-------|---------|
| `VersionsRelationManager` | Read-only article version history |
| `FeedbackRelationManager` | Helpful/not helpful feedback management |
| `RelatedArticlesRelationManager` | Attach/detach related articles with sort order |

## Installation

```bash
composer require jeffersongoncalves/filament-knowledge-base:"^1.0"
```

### Version Compatibility

| Version | Filament | PHP | Laravel | Tailwind |
|---------|----------|-----|---------|----------|
| 1.x | ^3.0 | ^8.1 | ^10.0 | 3.x |
| 2.x | ^4.0 | ^8.2 | ^11.0 | 4.x |
| 3.x | ^5.0 | ^8.2 | ^11.28 | 4.x |

## Configuration

### Admin Plugin (Full CRUD)

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
                ->navigationGroup('Knowledge Base')
                ->navigationSort(10)
                ->navigationIcon('heroicon-o-book-open'),
        ]);
}
```

### User Plugin (Authenticated Read-Only)

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

### Guest Plugin (Public Read-Only)

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

### Feature Toggles

All plugins support fluent feature toggles via the `HasKnowledgeBasePluginConfig` trait:

```php
// Disable specific features
KnowledgeBasePlugin::make()
    ->versioning(false)      // Disable version history
    ->feedback(false)        // Disable feedback
    ->relatedArticles(false) // Disable related articles
    ->seo(false);            // Disable SEO fields
```

Features can also be toggled globally in `config/filament-knowledge-base.php`:

```php
return [
    'features' => [
        'versioning' => true,
        'feedback' => true,
        'related_articles' => true,
        'seo' => true,
    ],
];
```

The `has*()` methods check both the plugin-level and config-level settings:

```php
$plugin->hasVersioning();      // true only if both plugin and config enable it
$plugin->hasFeedback();        // true only if both plugin and config enable it
$plugin->hasRelatedArticles(); // true only if both plugin and config enable it
$plugin->hasSeo();             // true only if both plugin and config enable it
```

## Localization

Translations are provided for English (`en`) and Brazilian Portuguese (`pt_BR`).

```bash
php artisan vendor:publish --tag="filament-knowledge-base-translations"
```

## Troubleshooting

### Plugin not appearing in panel
**Cause**: The plugin is not registered in the PanelProvider.
**Solution**: Ensure you call `->plugins([KnowledgeBasePlugin::make()])` in your panel configuration.

### Features not toggling correctly
**Cause**: Config-level settings override plugin-level settings. The `has*()` methods require both to be `true`.
**Solution**: Check both the plugin fluent call and the `config/filament-knowledge-base.php` file. Both must enable the feature.

### Guest panel requires authentication
**Cause**: The panel itself may have authentication middleware configured.
**Solution**: The `KnowledgeBaseGuestPlugin` does not add authentication, but the panel it is registered in must be configured without auth middleware for public access.

### Missing migrations
**Cause**: The base package `jeffersongoncalves/laravel-knowledge-base` provides the migrations.
**Solution**: Run `php artisan migrate` after installing the package. The migrations are auto-discovered.
