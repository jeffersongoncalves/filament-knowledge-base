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
            'actions' => [
                'view_on_site' => 'Voir sur le site',
            ],
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
        'collections' => [
            'navigation_label' => 'Collections',
            'model_label' => 'Collection',
            'plural_model_label' => 'Collections',
            'form' => [
                'section_details' => 'Détails de la collection',
                'section_settings' => 'Paramètres',
                'name' => 'Nom',
                'slug' => 'Slug',
                'description' => 'Description',
                'is_active' => 'Active',
                'sort_order' => 'Ordre de tri',
                'articles_section' => 'Articles',
                'articles_helper' => 'Ajoutez les articles dans l\'ordre où les clients doivent les voir ; faites glisser pour les réordonner.',
                'article' => 'Article',
                'add_article' => 'Ajouter un article',
            ],
            'table' => [
                'name' => 'Nom',
                'slug' => 'Slug',
                'articles_count' => 'Articles',
                'is_active' => 'Active',
                'sort_order' => 'Ordre de tri',
            ],
            'warnings' => [
                'not_published' => 'Les clients ne peuvent pas voir cet article : il n\'est pas publié.',
                'internal_article' => 'Les clients ne peuvent pas voir cet article : il est interne.',
                'internal_category' => 'Les clients ne peuvent pas voir cet article : sa catégorie est interne.',
                'inactive_category' => 'Les clients ne peuvent pas voir cet article : sa catégorie est inactive.',
                'deleted_category' => 'Les clients ne peuvent pas voir cet article : sa catégorie a été supprimée.',
                'broken_category_tree' => 'Les clients ne peuvent pas voir cet article : son arborescence de catégories est rompue.',
                'not_visible' => 'Les clients ne peuvent pas voir cet article.',
            ],
        ],
        'assets' => [
            'scope' => [
                'shared' => 'Partagé',
            ],
            'usage' => [
                'used_in' => 'Utilisé en :languages',
                'unused' => 'Inutilisé',
            ],
            'delete' => [
                'used' => 'Cette ressource est encore utilisée en :languages.',
                'unused' => 'Cette ressource n\'est utilisée nulle part.',
            ],
            'save_first' => [
                'heading' => 'Ajoutez des images et des fichiers après l\'enregistrement',
                'description' => 'Enregistrez d\'abord l\'article pour ajouter des images et des fichiers.',
            ],
            'broken' => [
                'heading' => 'Le contenu fait référence à des ressources manquantes',
                'message' => 'Une partie du contenu fait référence à des images ou des fichiers qui n\'existent plus (:details). Supprimez-les ou remplacez-les pour faire disparaître cet avertissement.',
                'images' => '{1} 1 image supprimée|[2,*] :count images supprimées',
                'badge' => 'Ressource manquante',
            ],
            'manager' => [
                'title' => 'Ressources',
                'preview' => 'Aperçu',
                'name' => 'Nom',
                'size' => 'Taille',
                'scope' => 'Portée',
                'usage' => 'Utilisation',
                'upload' => 'Téléverser',
                'file' => 'Fichier',
                'kind' => 'Type',
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
        'localization' => [
            'language' => 'Langue',
            'language_label' => ':language',
            'version_status' => 'Statut de la version',
            'version_status_helper' => 'La version de référence suit le statut de l\'article ; chacune des autres langues est publiée séparément.',
            'flag_other_locales_outdated' => 'Marquer les autres langues comme obsolètes',
            'flag_other_locales_outdated_helper' => 'Cochez si cette modification oblige à retraduire les autres langues.',
            'outdated_filter' => 'Obsolète dans la langue',
            'mark_up_to_date' => 'Marquer comme à jour',
            'state' => [
                'missing' => 'Manquante',
                'draft' => 'Brouillon',
                'published' => 'Publiée',
                'outdated' => 'Obsolète',
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
