<?php

return [
    'common' => [
        'created_at' => 'Creato il',
        'updated_at' => 'Aggiornato il',
        'visibility' => [
            'public' => 'Pubblico',
            'internal' => 'Interno',
        ],
    ],
    'admin' => [
        'categories' => [
            'navigation_label' => 'Categorie',
            'model_label' => 'Categoria',
            'plural_model_label' => 'Categorie',
            'form' => [
                'section_details' => 'Dettagli categoria',
                'section_settings' => 'Impostazioni',
                'name' => 'Nome',
                'slug' => 'Slug',
                'parent' => 'Categoria principale',
                'description' => 'Descrizione',
                'icon' => 'Icona',
                'visibility' => 'Visibilità',
                'is_active' => 'Attiva',
                'sort_order' => 'Ordinamento',
            ],
            'table' => [
                'name' => 'Nome',
                'parent' => 'Principale',
                'articles_count' => 'Articoli',
                'is_active' => 'Attiva',
                'sort_order' => 'Ordinamento',
                'visibility' => 'Visibilità',
            ],
        ],
        'articles' => [
            'navigation_label' => 'Articoli',
            'model_label' => 'Articolo',
            'plural_model_label' => 'Articoli',
            'form' => [
                'section_content' => 'Contenuto',
                'section_settings' => 'Impostazioni',
                'section_seo' => 'SEO',
                'title' => 'Titolo',
                'slug' => 'Slug',
                'category' => 'Categoria',
                'content' => 'Contenuto',
                'excerpt' => 'Estratto',
                'status' => 'Stato',
                'visibility' => 'Visibilità',
                'published_at' => 'Pubblicato il',
                'seo_title' => 'Titolo SEO',
                'seo_description' => 'Descrizione SEO',
                'seo_keywords' => 'Parole chiave SEO',
            ],
            'table' => [
                'title' => 'Titolo',
                'category' => 'Categoria',
                'status' => 'Stato',
                'visibility' => 'Visibilità',
                'view_count' => 'Visualizzazioni',
                'published_at' => 'Pubblicato il',
            ],
            'infolist' => [
                'helpful_count' => 'Utile',
                'not_helpful_count' => 'Non utile',
                'current_version' => 'Versione corrente',
            ],
            'relation_managers' => [
                'versions' => [
                    'title' => 'Versioni',
                    'version_number' => 'Versione',
                    'title_column' => 'Titolo',
                    'change_notes' => 'Note sulle modifiche',
                ],
                'feedback' => [
                    'title' => 'Feedback',
                    'is_helpful' => 'Utile',
                    'comment' => 'Commento',
                    'ip_address' => 'Indirizzo IP',
                ],
                'related_articles' => [
                    'title' => 'Articoli correlati',
                ],
            ],
        ],
        'widgets' => [
            'overview' => [
                'total_articles' => 'Articoli totali',
                'published' => 'Pubblicati',
                'drafts' => 'Bozze',
                'categories' => 'Categorie',
                'total_views' => 'Visualizzazioni totali',
                'helpful_rate' => 'Tasso di utilità',
            ],
        ],
    ],
    'user' => [
        'articles' => [
            'navigation_label' => 'Articoli',
            'feedback' => [
                'helpful' => 'Utile',
                'not_helpful' => 'Non utile',
                'thanks' => 'Grazie per il tuo feedback!',
            ],
        ],
        'pages' => [
            'knowledge_base' => [
                'navigation_label' => 'Cerca',
                'title' => 'Knowledge base',
                'search_placeholder' => 'Cerca articoli...',
                'categories_heading' => 'Categorie',
                'search_results_heading' => 'Risultati della ricerca',
                'no_results' => 'Nessun articolo trovato.',
                'articles_count' => ':count articolo|:count articoli',
            ],
        ],
        'widgets' => [
            'popular_articles' => [
                'heading' => 'Articoli popolari',
            ],
        ],
    ],
    'guest' => [
        'articles' => [
            'navigation_label' => 'Articoli',
        ],
        'pages' => [
            'knowledge_base' => [
                'navigation_label' => 'Cerca',
                'title' => 'Knowledge base',
                'search_placeholder' => 'Cerca articoli...',
                'categories_heading' => 'Categorie',
                'search_results_heading' => 'Risultati della ricerca',
                'no_results' => 'Nessun articolo trovato.',
                'articles_count' => ':count articolo|:count articoli',
            ],
        ],
        'widgets' => [
            'popular_articles' => [
                'heading' => 'Articoli popolari',
            ],
        ],
    ],
];
