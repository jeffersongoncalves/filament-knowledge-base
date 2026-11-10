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
            'actions' => [
                'view_on_site' => 'Vedi sul sito',
            ],
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
        'collections' => [
            'navigation_label' => 'Raccolte',
            'model_label' => 'Raccolta',
            'plural_model_label' => 'Raccolte',
            'form' => [
                'section_details' => 'Dettagli della raccolta',
                'section_settings' => 'Impostazioni',
                'name' => 'Nome',
                'slug' => 'Slug',
                'description' => 'Descrizione',
                'is_active' => 'Attiva',
                'sort_order' => 'Ordinamento',
                'articles_section' => 'Articoli',
                'articles_helper' => 'Aggiungi gli articoli nell\'ordine in cui i clienti devono vederli; trascina per riordinarli.',
                'article' => 'Articolo',
                'add_article' => 'Aggiungi articolo',
            ],
            'table' => [
                'name' => 'Nome',
                'slug' => 'Slug',
                'articles_count' => 'Articoli',
                'is_active' => 'Attiva',
                'sort_order' => 'Ordinamento',
            ],
            'warnings' => [
                'not_published' => 'I clienti non possono vedere questo articolo: non è pubblicato.',
                'internal_article' => 'I clienti non possono vedere questo articolo: è interno.',
                'internal_category' => 'I clienti non possono vedere questo articolo: la sua categoria è interna.',
                'inactive_category' => 'I clienti non possono vedere questo articolo: la sua categoria è inattiva.',
                'deleted_category' => 'I clienti non possono vedere questo articolo: la sua categoria è stata eliminata.',
                'broken_category_tree' => 'I clienti non possono vedere questo articolo: il suo albero delle categorie è danneggiato.',
                'not_visible' => 'I clienti non possono vedere questo articolo.',
                'customers_article' => 'Solo i clienti autenticati possono vedere questo articolo.',
                'customers_category' => 'Solo i clienti autenticati possono vedere questo articolo: la sua categoria è per i clienti autenticati.',
            ],
        ],
        'assets' => [
            'scope' => [
                'shared' => 'Condiviso',
            ],
            'usage' => [
                'used_in' => 'Usato in :languages',
                'unused' => 'Non usato',
            ],
            'delete' => [
                'used' => 'Questa risorsa è ancora usata in :languages.',
                'unused' => 'Questa risorsa non è usata da nessuna parte.',
            ],
            'save_first' => [
                'heading' => 'Aggiungi immagini e file dopo il salvataggio',
                'description' => 'Salva prima l\'articolo per aggiungere immagini e file.',
            ],
            'broken' => [
                'heading' => 'Il contenuto fa riferimento a risorse mancanti',
                'message' => 'Parte del contenuto fa riferimento a immagini o file che non esistono più (:details). Rimuovili o sostituiscili per eliminare questo avviso.',
                'images' => '{1} 1 immagine eliminata|[2,*] :count immagini eliminate',
                'badge' => 'Risorsa mancante',
            ],
            'manager' => [
                'title' => 'Risorse',
                'preview' => 'Anteprima',
                'name' => 'Nome',
                'size' => 'Dimensione',
                'scope' => 'Ambito',
                'usage' => 'Utilizzo',
                'upload' => 'Carica',
                'file' => 'File',
                'kind' => 'Tipo',
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
        'localization' => [
            'language' => 'Lingua',
            'language_label' => ':language',
            'version_status' => 'Stato della versione',
            'version_status_helper' => 'La versione di riferimento segue lo stato dell\'articolo; ciascuna delle altre lingue viene pubblicata separatamente.',
            'flag_other_locales_outdated' => 'Segna le altre lingue come obsolete',
            'flag_other_locales_outdated_helper' => 'Seleziona quando questa modifica richiede di ritradurre le altre lingue.',
            'outdated_filter' => 'Obsoleto nella lingua',
            'mark_up_to_date' => 'Segna come aggiornato',
            'state' => [
                'missing' => 'Mancante',
                'draft' => 'Bozza',
                'published' => 'Pubblicato',
                'outdated' => 'Obsoleto',
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
