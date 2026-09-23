<?php

return [
    'common' => [
        'created_at' => 'Utworzono',
        'updated_at' => 'Zaktualizowano',
        'visibility' => [
            'public' => 'Publiczny',
            'internal' => 'Wewnętrzny',
        ],
    ],
    'admin' => [
        'categories' => [
            'navigation_label' => 'Kategorie',
            'model_label' => 'Kategoria',
            'plural_model_label' => 'Kategorie',
            'form' => [
                'section_details' => 'Szczegóły kategorii',
                'section_settings' => 'Ustawienia',
                'name' => 'Nazwa',
                'slug' => 'Slug',
                'parent' => 'Kategoria nadrzędna',
                'description' => 'Opis',
                'icon' => 'Ikona',
                'visibility' => 'Widoczność',
                'is_active' => 'Aktywna',
                'sort_order' => 'Kolejność',
            ],
            'table' => [
                'name' => 'Nazwa',
                'parent' => 'Nadrzędna',
                'articles_count' => 'Artykuły',
                'is_active' => 'Aktywna',
                'sort_order' => 'Kolejność',
                'visibility' => 'Widoczność',
            ],
        ],
        'articles' => [
            'navigation_label' => 'Artykuły',
            'model_label' => 'Artykuł',
            'plural_model_label' => 'Artykuły',
            'form' => [
                'section_content' => 'Treść',
                'section_settings' => 'Ustawienia',
                'section_seo' => 'SEO',
                'title' => 'Tytuł',
                'slug' => 'Slug',
                'category' => 'Kategoria',
                'content' => 'Treść',
                'excerpt' => 'Zajawka',
                'status' => 'Status',
                'visibility' => 'Widoczność',
                'published_at' => 'Opublikowano',
                'seo_title' => 'Tytuł SEO',
                'seo_description' => 'Opis SEO',
                'seo_keywords' => 'Słowa kluczowe SEO',
            ],
            'table' => [
                'title' => 'Tytuł',
                'category' => 'Kategoria',
                'status' => 'Status',
                'visibility' => 'Widoczność',
                'view_count' => 'Wyświetlenia',
                'published_at' => 'Opublikowano',
            ],
            'infolist' => [
                'helpful_count' => 'Pomocne',
                'not_helpful_count' => 'Niepomocne',
                'current_version' => 'Bieżąca wersja',
            ],
            'relation_managers' => [
                'versions' => [
                    'title' => 'Wersje',
                    'version_number' => 'Wersja',
                    'title_column' => 'Tytuł',
                    'change_notes' => 'Opis zmian',
                ],
                'feedback' => [
                    'title' => 'Opinie',
                    'is_helpful' => 'Pomocne',
                    'comment' => 'Komentarz',
                    'ip_address' => 'Adres IP',
                ],
                'related_articles' => [
                    'title' => 'Powiązane artykuły',
                ],
            ],
        ],
        'widgets' => [
            'overview' => [
                'total_articles' => 'Łącznie artykułów',
                'published' => 'Opublikowane',
                'drafts' => 'Szkice',
                'categories' => 'Kategorie',
                'total_views' => 'Łącznie wyświetleń',
                'helpful_rate' => 'Wskaźnik przydatności',
            ],
        ],
    ],
    'user' => [
        'articles' => [
            'navigation_label' => 'Artykuły',
            'feedback' => [
                'helpful' => 'Pomocne',
                'not_helpful' => 'Niepomocne',
                'thanks' => 'Dziękujemy za opinię!',
            ],
        ],
        'pages' => [
            'knowledge_base' => [
                'navigation_label' => 'Szukaj',
                'title' => 'Baza wiedzy',
                'search_placeholder' => 'Szukaj artykułów...',
                'categories_heading' => 'Kategorie',
                'search_results_heading' => 'Wyniki wyszukiwania',
                'no_results' => 'Nie znaleziono artykułów.',
                'articles_count' => ':count artykuł|:count artykuły|:count artykułów',
            ],
        ],
        'widgets' => [
            'popular_articles' => [
                'heading' => 'Popularne artykuły',
            ],
        ],
    ],
    'guest' => [
        'articles' => [
            'navigation_label' => 'Artykuły',
        ],
        'pages' => [
            'knowledge_base' => [
                'navigation_label' => 'Szukaj',
                'title' => 'Baza wiedzy',
                'search_placeholder' => 'Szukaj artykułów...',
                'categories_heading' => 'Kategorie',
                'search_results_heading' => 'Wyniki wyszukiwania',
                'no_results' => 'Nie znaleziono artykułów.',
                'articles_count' => ':count artykuł|:count artykuły|:count artykułów',
            ],
        ],
        'widgets' => [
            'popular_articles' => [
                'heading' => 'Popularne artykuły',
            ],
        ],
    ],
];
