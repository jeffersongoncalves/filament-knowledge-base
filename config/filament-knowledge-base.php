<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Navigation Configuration
    |--------------------------------------------------------------------------
    |
    | Configure navigation group, sort order, and icon for each panel type.
    |
    */

    'navigation' => [
        'admin' => [
            'group' => 'Knowledge Base',
            'sort' => null,
            'icon' => 'heroicon-o-book-open',
        ],
        'user' => [
            'group' => 'Knowledge Base',
            'sort' => null,
            'icon' => 'heroicon-o-book-open',
        ],
        'guest' => [
            'group' => 'Knowledge Base',
            'sort' => null,
            'icon' => 'heroicon-o-book-open',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Slug Prefix
    |--------------------------------------------------------------------------
    |
    | Prefix for the URLs and route names of this plugin's resources, e.g.
    | 'knowledge-base' gives /admin/knowledge-base/categories. Set it when
    | another plugin in the same panel also has a resource called
    | categories or articles. Null keeps Filament's default slugs.
    |
    */

    'slug_prefix' => null,

    /*
    |--------------------------------------------------------------------------
    | Feature Toggles
    |--------------------------------------------------------------------------
    |
    | Enable or disable features globally. These can be overridden per-plugin
    | using the fluent API (e.g., ->versioning(false)).
    |
    */

    'features' => [
        'versioning' => true,
        'feedback' => true,
        'related_articles' => true,
        'seo' => true,
    ],

];
