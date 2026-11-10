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
            'actions' => [
                'view_on_site' => 'Zobacz na stronie',
            ],
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
        'collections' => [
            'navigation_label' => 'Kolekcje',
            'model_label' => 'Kolekcja',
            'plural_model_label' => 'Kolekcje',
            'form' => [
                'section_details' => 'Szczegóły kolekcji',
                'section_settings' => 'Ustawienia',
                'name' => 'Nazwa',
                'slug' => 'Slug',
                'description' => 'Opis',
                'is_active' => 'Aktywna',
                'sort_order' => 'Kolejność',
                'articles_section' => 'Artykuły',
                'articles_helper' => 'Dodaj artykuły w kolejności, w jakiej klienci mają je widzieć; przeciągnij, aby zmienić kolejność.',
                'article' => 'Artykuł',
                'add_article' => 'Dodaj artykuł',
            ],
            'table' => [
                'name' => 'Nazwa',
                'slug' => 'Slug',
                'articles_count' => 'Artykuły',
                'is_active' => 'Aktywna',
                'sort_order' => 'Kolejność',
            ],
            'warnings' => [
                'not_published' => 'Klienci nie widzą tego artykułu: nie jest opublikowany.',
                'internal_article' => 'Klienci nie widzą tego artykułu: jest wewnętrzny.',
                'internal_category' => 'Klienci nie widzą tego artykułu: jego kategoria jest wewnętrzna.',
                'inactive_category' => 'Klienci nie widzą tego artykułu: jego kategoria jest nieaktywna.',
                'deleted_category' => 'Klienci nie widzą tego artykułu: jego kategoria została usunięta.',
                'broken_category_tree' => 'Klienci nie widzą tego artykułu: jego drzewo kategorii jest uszkodzone.',
                'not_visible' => 'Klienci nie widzą tego artykułu.',
                'customers_article' => 'Tylko zalogowani klienci widzą ten artykuł.',
                'customers_category' => 'Tylko zalogowani klienci widzą ten artykuł: jego kategoria jest dla zalogowanych klientów.',
            ],
        ],
        'assets' => [
            'scope' => [
                'shared' => 'Wspólny',
            ],
            'usage' => [
                'used_in' => 'Używany w: :languages',
                'unused' => 'Nieużywany',
            ],
            'delete' => [
                'used' => 'Ten zasób jest nadal używany w: :languages.',
                'unused' => 'Ten zasób nie jest nigdzie używany.',
            ],
            'save_first' => [
                'heading' => 'Dodaj obrazy i pliki po zapisaniu',
                'description' => 'Najpierw zapisz artykuł, aby dodać obrazy i pliki.',
            ],
            'broken' => [
                'heading' => 'Treść odwołuje się do brakujących zasobów',
                'message' => 'Część treści odwołuje się do obrazów lub plików, które już nie istnieją (:details). Usuń je lub zastąp, aby usunąć to ostrzeżenie.',
                'images' => ':count usunięty obraz|:count usunięte obrazy|:count usuniętych obrazów',
                'badge' => 'Brakujący zasób',
            ],
            'manager' => [
                'title' => 'Zasoby',
                'preview' => 'Podgląd',
                'name' => 'Nazwa',
                'size' => 'Rozmiar',
                'scope' => 'Zakres',
                'usage' => 'Użycie',
                'upload' => 'Prześlij',
                'file' => 'Plik',
                'kind' => 'Rodzaj',
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
        'localization' => [
            'language' => 'Język',
            'language_label' => ':language',
            'version_status' => 'Status wersji',
            'version_status_helper' => 'Wersja wiodąca ma status artykułu; każdy inny język jest publikowany osobno.',
            'flag_other_locales_outdated' => 'Oznacz inne języki jako nieaktualne',
            'flag_other_locales_outdated_helper' => 'Zaznacz, gdy po tej zmianie inne języki trzeba przetłumaczyć ponownie.',
            'outdated_filter' => 'Nieaktualne w języku',
            'mark_up_to_date' => 'Oznacz jako aktualne',
            'state' => [
                'missing' => 'Brak',
                'draft' => 'Szkic',
                'published' => 'Opublikowane',
                'outdated' => 'Nieaktualne',
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
