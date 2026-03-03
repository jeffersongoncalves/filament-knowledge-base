## Filament Knowledge Base

A Filament plugin for complete knowledge base management with Admin, User, and Guest panels. Provides categories, articles, versioning, feedback, related articles, and SEO features.

### Installation

@verbatim
<code-snippet name="Install the plugin" lang="bash">
composer require jeffersongoncalves/filament-knowledge-base:"^1.0"
</code-snippet>
@endverbatim

### Publish Configuration (optional)

@verbatim
<code-snippet name="Publish config" lang="bash">
php artisan vendor:publish --tag="filament-knowledge-base-config"
</code-snippet>
@endverbatim

### Register Admin Plugin

@verbatim
<code-snippet name="Register Admin Plugin in PanelProvider" lang="php">
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
</code-snippet>
@endverbatim

### Register User Plugin

@verbatim
<code-snippet name="Register User Plugin in PanelProvider" lang="php">
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
</code-snippet>
@endverbatim

### Register Guest Plugin

@verbatim
<code-snippet name="Register Guest Plugin in PanelProvider" lang="php">
use JeffersonGoncalves\FilamentKnowledgeBase\KnowledgeBaseGuestPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            KnowledgeBaseGuestPlugin::make()
                ->navigationGroup('Knowledge Base'),
        ]);
}
</code-snippet>
@endverbatim

### Feature Toggles

All plugins support fluent feature toggles:
- `versioning(bool)` - Article version history (default: true)
- `feedback(bool)` - Helpful/not helpful feedback (default: true)
- `relatedArticles(bool)` - Related articles management (default: true)
- `seo(bool)` - SEO fields: title, description, keywords (default: true)
- `navigationGroup(string)` - Set navigation group label
- `navigationSort(?int)` - Set navigation sort order
- `navigationIcon(string)` - Set navigation icon

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

### Best Practices
- Use the Admin plugin for full CRUD management of categories and articles
- Use the User plugin for authenticated read-only access with feedback capability
- Use the Guest plugin for public-facing knowledge base without authentication
- Feature toggles can be set both per-plugin and globally in the config file
- Publish translations to customize labels for English and Brazilian Portuguese
