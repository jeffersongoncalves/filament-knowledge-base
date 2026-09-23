<?php

return [
    'common' => [
        'created_at' => 'Aangemaakt op',
        'updated_at' => 'Bijgewerkt op',
        'visibility' => [
            'public' => 'Openbaar',
            'internal' => 'Intern',
        ],
    ],
    'admin' => [
        'categories' => [
            'navigation_label' => 'Categorieën',
            'model_label' => 'Categorie',
            'plural_model_label' => 'Categorieën',
            'form' => [
                'section_details' => 'Categoriedetails',
                'section_settings' => 'Instellingen',
                'name' => 'Naam',
                'slug' => 'Slug',
                'parent' => 'Bovenliggende categorie',
                'description' => 'Beschrijving',
                'icon' => 'Icoon',
                'visibility' => 'Zichtbaarheid',
                'is_active' => 'Actief',
                'sort_order' => 'Sorteervolgorde',
            ],
            'table' => [
                'name' => 'Naam',
                'parent' => 'Bovenliggend',
                'articles_count' => 'Artikelen',
                'is_active' => 'Actief',
                'sort_order' => 'Sorteervolgorde',
                'visibility' => 'Zichtbaarheid',
            ],
        ],
        'articles' => [
            'navigation_label' => 'Artikelen',
            'model_label' => 'Artikel',
            'plural_model_label' => 'Artikelen',
            'form' => [
                'section_content' => 'Inhoud',
                'section_settings' => 'Instellingen',
                'section_seo' => 'SEO',
                'title' => 'Titel',
                'slug' => 'Slug',
                'category' => 'Categorie',
                'content' => 'Inhoud',
                'excerpt' => 'Samenvatting',
                'status' => 'Status',
                'visibility' => 'Zichtbaarheid',
                'published_at' => 'Gepubliceerd op',
                'seo_title' => 'SEO-titel',
                'seo_description' => 'SEO-beschrijving',
                'seo_keywords' => 'SEO-trefwoorden',
            ],
            'table' => [
                'title' => 'Titel',
                'category' => 'Categorie',
                'status' => 'Status',
                'visibility' => 'Zichtbaarheid',
                'view_count' => 'Weergaven',
                'published_at' => 'Gepubliceerd op',
            ],
            'infolist' => [
                'helpful_count' => 'Nuttig',
                'not_helpful_count' => 'Niet nuttig',
                'current_version' => 'Huidige versie',
            ],
            'relation_managers' => [
                'versions' => [
                    'title' => 'Versies',
                    'version_number' => 'Versie',
                    'title_column' => 'Titel',
                    'change_notes' => 'Wijzigingsnotities',
                ],
                'feedback' => [
                    'title' => 'Feedback',
                    'is_helpful' => 'Nuttig',
                    'comment' => 'Opmerking',
                    'ip_address' => 'IP-adres',
                ],
                'related_articles' => [
                    'title' => 'Gerelateerde artikelen',
                ],
            ],
        ],
        'widgets' => [
            'overview' => [
                'total_articles' => 'Totaal artikelen',
                'published' => 'Gepubliceerd',
                'drafts' => 'Concepten',
                'categories' => 'Categorieën',
                'total_views' => 'Totaal weergaven',
                'helpful_rate' => 'Nuttigheidspercentage',
            ],
        ],
    ],
    'user' => [
        'articles' => [
            'navigation_label' => 'Artikelen',
            'feedback' => [
                'helpful' => 'Nuttig',
                'not_helpful' => 'Niet nuttig',
                'thanks' => 'Bedankt voor je feedback!',
            ],
        ],
        'pages' => [
            'knowledge_base' => [
                'navigation_label' => 'Zoeken',
                'title' => 'Kennisbank',
                'search_placeholder' => 'Artikelen zoeken...',
                'categories_heading' => 'Categorieën',
                'search_results_heading' => 'Zoekresultaten',
                'no_results' => 'Geen artikelen gevonden.',
                'articles_count' => ':count artikel|:count artikelen',
            ],
        ],
        'widgets' => [
            'popular_articles' => [
                'heading' => 'Populaire artikelen',
            ],
        ],
    ],
    'guest' => [
        'articles' => [
            'navigation_label' => 'Artikelen',
        ],
        'pages' => [
            'knowledge_base' => [
                'navigation_label' => 'Zoeken',
                'title' => 'Kennisbank',
                'search_placeholder' => 'Artikelen zoeken...',
                'categories_heading' => 'Categorieën',
                'search_results_heading' => 'Zoekresultaten',
                'no_results' => 'Geen artikelen gevonden.',
                'articles_count' => ':count artikel|:count artikelen',
            ],
        ],
        'widgets' => [
            'popular_articles' => [
                'heading' => 'Populaire artikelen',
            ],
        ],
    ],
];
