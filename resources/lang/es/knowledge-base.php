<?php

return [
    'common' => [
        'created_at' => 'Creado el',
        'updated_at' => 'Actualizado el',
        'visibility' => [
            'public' => 'Público',
            'internal' => 'Interno',
        ],
    ],
    'admin' => [
        'categories' => [
            'navigation_label' => 'Categorías',
            'model_label' => 'Categoría',
            'plural_model_label' => 'Categorías',
            'form' => [
                'section_details' => 'Detalles de la categoría',
                'section_settings' => 'Configuración',
                'name' => 'Nombre',
                'slug' => 'Slug',
                'parent' => 'Categoría padre',
                'description' => 'Descripción',
                'icon' => 'Icono',
                'visibility' => 'Visibilidad',
                'is_active' => 'Activa',
                'sort_order' => 'Orden',
            ],
            'table' => [
                'name' => 'Nombre',
                'parent' => 'Padre',
                'articles_count' => 'Artículos',
                'is_active' => 'Activa',
                'sort_order' => 'Orden',
                'visibility' => 'Visibilidad',
            ],
        ],
        'articles' => [
            'navigation_label' => 'Artículos',
            'model_label' => 'Artículo',
            'plural_model_label' => 'Artículos',
            'form' => [
                'section_content' => 'Contenido',
                'section_settings' => 'Configuración',
                'section_seo' => 'SEO',
                'title' => 'Título',
                'slug' => 'Slug',
                'category' => 'Categoría',
                'content' => 'Contenido',
                'excerpt' => 'Extracto',
                'status' => 'Estado',
                'visibility' => 'Visibilidad',
                'published_at' => 'Publicado el',
                'seo_title' => 'Título SEO',
                'seo_description' => 'Descripción SEO',
                'seo_keywords' => 'Palabras clave SEO',
            ],
            'table' => [
                'title' => 'Título',
                'category' => 'Categoría',
                'status' => 'Estado',
                'visibility' => 'Visibilidad',
                'view_count' => 'Vistas',
                'published_at' => 'Publicado el',
            ],
            'infolist' => [
                'helpful_count' => 'Útil',
                'not_helpful_count' => 'No útil',
                'current_version' => 'Versión actual',
            ],
            'relation_managers' => [
                'versions' => [
                    'title' => 'Versiones',
                    'version_number' => 'Versión',
                    'title_column' => 'Título',
                    'change_notes' => 'Notas de cambios',
                ],
                'feedback' => [
                    'title' => 'Comentarios',
                    'is_helpful' => 'Útil',
                    'comment' => 'Comentario',
                    'ip_address' => 'Dirección IP',
                ],
                'related_articles' => [
                    'title' => 'Artículos relacionados',
                ],
            ],
        ],
        'widgets' => [
            'overview' => [
                'total_articles' => 'Total de artículos',
                'published' => 'Publicados',
                'drafts' => 'Borradores',
                'categories' => 'Categorías',
                'total_views' => 'Vistas totales',
                'helpful_rate' => 'Tasa de utilidad',
            ],
        ],
    ],
    'user' => [
        'articles' => [
            'navigation_label' => 'Artículos',
            'feedback' => [
                'helpful' => 'Útil',
                'not_helpful' => 'No útil',
                'thanks' => '¡Gracias por tus comentarios!',
            ],
        ],
        'pages' => [
            'knowledge_base' => [
                'navigation_label' => 'Buscar',
                'title' => 'Base de conocimiento',
                'search_placeholder' => 'Buscar artículos...',
                'categories_heading' => 'Categorías',
                'search_results_heading' => 'Resultados de búsqueda',
                'no_results' => 'No se encontraron artículos.',
                'articles_count' => ':count artículo|:count artículos',
            ],
        ],
        'widgets' => [
            'popular_articles' => [
                'heading' => 'Artículos populares',
            ],
        ],
    ],
    'guest' => [
        'articles' => [
            'navigation_label' => 'Artículos',
        ],
        'pages' => [
            'knowledge_base' => [
                'navigation_label' => 'Buscar',
                'title' => 'Base de conocimiento',
                'search_placeholder' => 'Buscar artículos...',
                'categories_heading' => 'Categorías',
                'search_results_heading' => 'Resultados de búsqueda',
                'no_results' => 'No se encontraron artículos.',
                'articles_count' => ':count artículo|:count artículos',
            ],
        ],
        'widgets' => [
            'popular_articles' => [
                'heading' => 'Artículos populares',
            ],
        ],
    ],
];
