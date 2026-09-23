<?php

return [
    'common' => [
        'created_at' => 'Erstellt am',
        'updated_at' => 'Aktualisiert am',
        'visibility' => [
            'public' => 'Öffentlich',
            'internal' => 'Intern',
        ],
    ],
    'admin' => [
        'categories' => [
            'navigation_label' => 'Kategorien',
            'model_label' => 'Kategorie',
            'plural_model_label' => 'Kategorien',
            'form' => [
                'section_details' => 'Kategoriedetails',
                'section_settings' => 'Einstellungen',
                'name' => 'Name',
                'slug' => 'Slug',
                'parent' => 'Übergeordnete Kategorie',
                'description' => 'Beschreibung',
                'icon' => 'Symbol',
                'visibility' => 'Sichtbarkeit',
                'is_active' => 'Aktiv',
                'sort_order' => 'Sortierung',
            ],
            'table' => [
                'name' => 'Name',
                'parent' => 'Übergeordnet',
                'articles_count' => 'Artikel',
                'is_active' => 'Aktiv',
                'sort_order' => 'Sortierung',
                'visibility' => 'Sichtbarkeit',
            ],
        ],
        'articles' => [
            'navigation_label' => 'Artikel',
            'model_label' => 'Artikel',
            'plural_model_label' => 'Artikel',
            'form' => [
                'section_content' => 'Inhalt',
                'section_settings' => 'Einstellungen',
                'section_seo' => 'SEO',
                'title' => 'Titel',
                'slug' => 'Slug',
                'category' => 'Kategorie',
                'content' => 'Inhalt',
                'excerpt' => 'Auszug',
                'status' => 'Status',
                'visibility' => 'Sichtbarkeit',
                'published_at' => 'Veröffentlicht am',
                'seo_title' => 'SEO-Titel',
                'seo_description' => 'SEO-Beschreibung',
                'seo_keywords' => 'SEO-Schlüsselwörter',
            ],
            'table' => [
                'title' => 'Titel',
                'category' => 'Kategorie',
                'status' => 'Status',
                'visibility' => 'Sichtbarkeit',
                'view_count' => 'Aufrufe',
                'published_at' => 'Veröffentlicht am',
            ],
            'infolist' => [
                'helpful_count' => 'Hilfreich',
                'not_helpful_count' => 'Nicht hilfreich',
                'current_version' => 'Aktuelle Version',
            ],
            'relation_managers' => [
                'versions' => [
                    'title' => 'Versionen',
                    'version_number' => 'Version',
                    'title_column' => 'Titel',
                    'change_notes' => 'Änderungshinweise',
                ],
                'feedback' => [
                    'title' => 'Feedback',
                    'is_helpful' => 'Hilfreich',
                    'comment' => 'Kommentar',
                    'ip_address' => 'IP-Adresse',
                ],
                'related_articles' => [
                    'title' => 'Verwandte Artikel',
                ],
            ],
        ],
        'widgets' => [
            'overview' => [
                'total_articles' => 'Artikel gesamt',
                'published' => 'Veröffentlicht',
                'drafts' => 'Entwürfe',
                'categories' => 'Kategorien',
                'total_views' => 'Aufrufe gesamt',
                'helpful_rate' => 'Hilfreich-Quote',
            ],
        ],
    ],
    'user' => [
        'articles' => [
            'navigation_label' => 'Artikel',
            'feedback' => [
                'helpful' => 'Hilfreich',
                'not_helpful' => 'Nicht hilfreich',
                'thanks' => 'Danke für Ihr Feedback!',
            ],
        ],
        'pages' => [
            'knowledge_base' => [
                'navigation_label' => 'Suche',
                'title' => 'Wissensdatenbank',
                'search_placeholder' => 'Artikel durchsuchen...',
                'categories_heading' => 'Kategorien',
                'search_results_heading' => 'Suchergebnisse',
                'no_results' => 'Keine Artikel gefunden.',
                'articles_count' => ':count Artikel|:count Artikel',
            ],
        ],
        'widgets' => [
            'popular_articles' => [
                'heading' => 'Beliebte Artikel',
            ],
        ],
    ],
    'guest' => [
        'articles' => [
            'navigation_label' => 'Artikel',
        ],
        'pages' => [
            'knowledge_base' => [
                'navigation_label' => 'Suche',
                'title' => 'Wissensdatenbank',
                'search_placeholder' => 'Artikel durchsuchen...',
                'categories_heading' => 'Kategorien',
                'search_results_heading' => 'Suchergebnisse',
                'no_results' => 'Keine Artikel gefunden.',
                'articles_count' => ':count Artikel|:count Artikel',
            ],
        ],
        'widgets' => [
            'popular_articles' => [
                'heading' => 'Beliebte Artikel',
            ],
        ],
    ],
];
