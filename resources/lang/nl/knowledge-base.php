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
            'actions' => [
                'view_on_site' => 'Bekijken op de site',
            ],
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
        'collections' => [
            'navigation_label' => 'Collecties',
            'model_label' => 'Collectie',
            'plural_model_label' => 'Collecties',
            'form' => [
                'section_details' => 'Details van de collectie',
                'section_settings' => 'Instellingen',
                'name' => 'Naam',
                'slug' => 'Slug',
                'description' => 'Beschrijving',
                'is_active' => 'Actief',
                'sort_order' => 'Sorteervolgorde',
                'articles_section' => 'Artikelen',
                'articles_helper' => 'Voeg artikelen toe in de volgorde waarin klanten ze moeten zien; sleep om de volgorde te wijzigen.',
                'article' => 'Artikel',
                'add_article' => 'Artikel toevoegen',
            ],
            'table' => [
                'name' => 'Naam',
                'slug' => 'Slug',
                'articles_count' => 'Artikelen',
                'is_active' => 'Actief',
                'sort_order' => 'Sorteervolgorde',
            ],
            'warnings' => [
                'not_published' => 'Klanten kunnen dit artikel niet zien: het is niet gepubliceerd.',
                'internal_article' => 'Klanten kunnen dit artikel niet zien: het is intern.',
                'internal_category' => 'Klanten kunnen dit artikel niet zien: de categorie is intern.',
                'inactive_category' => 'Klanten kunnen dit artikel niet zien: de categorie is inactief.',
                'deleted_category' => 'Klanten kunnen dit artikel niet zien: de categorie is verwijderd.',
                'broken_category_tree' => 'Klanten kunnen dit artikel niet zien: de categorieboom is beschadigd.',
                'not_visible' => 'Klanten kunnen dit artikel niet zien.',
                'customers_article' => 'Alleen ingelogde klanten kunnen dit artikel zien.',
                'customers_category' => 'Alleen ingelogde klanten kunnen dit artikel zien: de categorie is voor ingelogde klanten.',
            ],
        ],
        'assets' => [
            'scope' => [
                'shared' => 'Gedeeld',
            ],
            'usage' => [
                'used_in' => 'Gebruikt in :languages',
                'unused' => 'Ongebruikt',
            ],
            'delete' => [
                'used' => 'Dit bestand wordt nog gebruikt in :languages.',
                'unused' => 'Dit bestand wordt nergens gebruikt.',
            ],
            'save_first' => [
                'heading' => 'Voeg afbeeldingen en bestanden toe na het opslaan',
                'description' => 'Sla het artikel eerst op om afbeeldingen en bestanden toe te voegen.',
            ],
            'broken' => [
                'heading' => 'De inhoud verwijst naar ontbrekende bestanden',
                'message' => 'Een deel van de inhoud verwijst naar afbeeldingen of bestanden die niet meer bestaan (:details). Verwijder of vervang ze om deze waarschuwing te laten verdwijnen.',
                'images' => '{1} 1 verwijderde afbeelding|[2,*] :count verwijderde afbeeldingen',
                'badge' => 'Ontbrekend bestand',
            ],
            'manager' => [
                'title' => 'Bestanden',
                'preview' => 'Voorbeeld',
                'name' => 'Naam',
                'size' => 'Grootte',
                'scope' => 'Bereik',
                'usage' => 'Gebruik',
                'upload' => 'Uploaden',
                'file' => 'Bestand',
                'kind' => 'Soort',
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
        'localization' => [
            'language' => 'Taal',
            'language_label' => ':language',
            'version_status' => 'Status van de versie',
            'version_status_helper' => 'De gezaghebbende versie volgt de status van het artikel; elke andere taal wordt afzonderlijk gepubliceerd.',
            'flag_other_locales_outdated' => 'Andere talen als verouderd markeren',
            'flag_other_locales_outdated_helper' => 'Vink aan als de andere talen door deze wijziging opnieuw vertaald moeten worden.',
            'outdated_filter' => 'Verouderd in taal',
            'mark_up_to_date' => 'Als bijgewerkt markeren',
            'state' => [
                'missing' => 'Ontbreekt',
                'draft' => 'Concept',
                'published' => 'Gepubliceerd',
                'outdated' => 'Verouderd',
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
