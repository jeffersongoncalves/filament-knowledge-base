<?php

return [
    'common' => [
        'created_at' => 'Créé le',
        'updated_at' => 'Mis à jour le',
        'visibility' => [
            'public' => 'Public',
            'internal' => 'Interne',
        ],
    ],
    'admin' => [
        'categories' => [
            'navigation_label' => 'Catégories',
            'model_label' => 'Catégorie',
            'plural_model_label' => 'Catégories',
            'form' => [
                'section_details' => 'Détails de la catégorie',
                'section_settings' => 'Paramètres',
                'name' => 'Nom',
                'slug' => 'Slug',
                'parent' => 'Catégorie parente',
                'description' => 'Description',
                'icon' => 'Icône',
                'visibility' => 'Visibilité',
                'is_active' => 'Active',
                'sort_order' => 'Ordre de tri',
            ],
            'table' => [
                'name' => 'Nom',
                'parent' => 'Parente',
                'articles_count' => 'Articles',
                'is_active' => 'Active',
                'sort_order' => 'Ordre de tri',
                'visibility' => 'Visibilité',
            ],
        ],
        'articles' => [
            'navigation_label' => 'Articles',
            'model_label' => 'Article',
            'plural_model_label' => 'Articles',
            'form' => [
                'section_content' => 'Contenu',
                'section_settings' => 'Paramètres',
                'section_seo' => 'SEO',
                'title' => 'Titre',
                'slug' => 'Slug',
                'category' => 'Catégorie',
                'content' => 'Contenu',
                'excerpt' => 'Extrait',
                'status' => 'Statut',
                'visibility' => 'Visibilité',
                'published_at' => 'Publié le',
                'seo_title' => 'Titre SEO',
                'seo_description' => 'Description SEO',
                'seo_keywords' => 'Mots-clés SEO',
            ],
            'table' => [
                'title' => 'Titre',
                'category' => 'Catégorie',
                'status' => 'Statut',
                'visibility' => 'Visibilité',
                'view_count' => 'Vues',
                'published_at' => 'Publié le',
            ],
            'infolist' => [
                'helpful_count' => 'Utile',
                'not_helpful_count' => 'Pas utile',
                'current_version' => 'Version actuelle',
            ],
            'relation_managers' => [
                'versions' => [
                    'title' => 'Versions',
                    'version_number' => 'Version',
                    'title_column' => 'Titre',
                    'change_notes' => 'Notes de modification',
                ],
                'feedback' => [
                    'title' => 'Avis',
                    'is_helpful' => 'Utile',
                    'comment' => 'Commentaire',
                    'ip_address' => 'Adresse IP',
                ],
                'related_articles' => [
                    'title' => 'Articles liés',
                ],
            ],
        ],
        'widgets' => [
            'overview' => [
                'total_articles' => 'Total des articles',
                'published' => 'Publiés',
                'drafts' => 'Brouillons',
                'categories' => 'Catégories',
                'total_views' => 'Vues totales',
                'helpful_rate' => 'Taux d\'utilité',
            ],
        ],
    ],
    'user' => [
        'articles' => [
            'navigation_label' => 'Articles',
            'feedback' => [
                'helpful' => 'Utile',
                'not_helpful' => 'Pas utile',
                'thanks' => 'Merci pour votre avis !',
            ],
        ],
        'pages' => [
            'knowledge_base' => [
                'navigation_label' => 'Recherche',
                'title' => 'Base de connaissances',
                'search_placeholder' => 'Rechercher des articles...',
                'categories_heading' => 'Catégories',
                'search_results_heading' => 'Résultats de recherche',
                'no_results' => 'Aucun article trouvé.',
                'articles_count' => ':count article|:count articles',
            ],
        ],
        'widgets' => [
            'popular_articles' => [
                'heading' => 'Articles populaires',
            ],
        ],
    ],
    'guest' => [
        'articles' => [
            'navigation_label' => 'Articles',
        ],
        'pages' => [
            'knowledge_base' => [
                'navigation_label' => 'Recherche',
                'title' => 'Base de connaissances',
                'search_placeholder' => 'Rechercher des articles...',
                'categories_heading' => 'Catégories',
                'search_results_heading' => 'Résultats de recherche',
                'no_results' => 'Aucun article trouvé.',
                'articles_count' => ':count article|:count articles',
            ],
        ],
        'widgets' => [
            'popular_articles' => [
                'heading' => 'Articles populaires',
            ],
        ],
    ],
];
