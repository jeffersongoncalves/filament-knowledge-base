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
            'actions' => [
                'view_on_site' => 'Ver en el sitio',
            ],
            'details' => [
                'heading' => 'Acerca de este artículo',
                'description' => 'Estado, visibilidad y estadísticas, imágenes y archivos, versiones anteriores, comentarios de los lectores y artículos relacionados.',
                'details_tab' => 'Detalles',
            ],
            'tools' => [
                'heading' => 'Archivos, historial y comentarios',
                'description' => 'Imágenes y archivos de este artículo, versiones anteriores, comentarios de los lectores y artículos relacionados.',
            ],
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
        'collections' => [
            'navigation_label' => 'Colecciones',
            'model_label' => 'Colección',
            'plural_model_label' => 'Colecciones',
            'form' => [
                'section_details' => 'Detalles de la colección',
                'section_settings' => 'Configuración',
                'name' => 'Nombre',
                'slug' => 'Slug',
                'description' => 'Descripción',
                'is_active' => 'Activa',
                'sort_order' => 'Orden',
                'articles_section' => 'Artículos',
                'articles_helper' => 'Añade los artículos en el orden en que los clientes deben verlos; arrastra para reordenar.',
                'article' => 'Artículo',
                'add_article' => 'Añadir artículo',
            ],
            'table' => [
                'name' => 'Nombre',
                'slug' => 'Slug',
                'articles_count' => 'Artículos',
                'is_active' => 'Activa',
                'sort_order' => 'Orden',
            ],
            'warnings' => [
                'not_published' => 'Los clientes no pueden ver este artículo: no está publicado.',
                'internal_article' => 'Los clientes no pueden ver este artículo: es interno.',
                'internal_category' => 'Los clientes no pueden ver este artículo: su categoría es interna.',
                'inactive_category' => 'Los clientes no pueden ver este artículo: su categoría está inactiva.',
                'deleted_category' => 'Los clientes no pueden ver este artículo: su categoría fue eliminada.',
                'broken_category_tree' => 'Los clientes no pueden ver este artículo: su árbol de categorías está roto.',
                'not_visible' => 'Los clientes no pueden ver este artículo.',
            ],
        ],
        'assets' => [
            'insert_image' => [
                'label' => 'Insertar imagen',
                'modal' => [
                    'heading' => 'Insertar imagen',
                    'tab_existing' => 'En este artículo (:count)',
                    'tab_upload' => 'Subir nueva',
                    'existing' => 'Imágenes de este artículo',
                    'existing_help' => 'Imágenes compartidas e imágenes de este idioma. Elige una y haz clic en Insertar.',
                    'submit' => 'Insertar',
                    'file' => 'O sube una imagen nueva',
                    'file_only' => 'Subir una imagen',
                    'alt' => 'Texto alternativo',
                    'alt_help' => 'Describe la imagen, en este idioma, para quienes no pueden verla.',
                ],
            ],
            'attach_file' => [
                'label' => 'Adjuntar archivo',
                'modal' => [
                    'heading' => 'Adjuntar archivo',
                    'tab_existing' => 'En este artículo (:count)',
                    'tab_upload' => 'Subir nuevo',
                    'existing' => 'Archivos de este artículo',
                    'existing_help' => 'Archivos compartidos y archivos de este idioma. Elige uno y haz clic en Adjuntar.',
                    'submit' => 'Adjuntar',
                    'file' => 'O sube un archivo nuevo',
                    'file_only' => 'Subir un archivo',
                ],
            ],
            'scope' => [
                'shared' => 'Compartido',
            ],
            'usage' => [
                'used_in' => 'Usado en :languages',
                'unused' => 'Sin usar',
            ],
            'delete' => [
                'used' => 'Este recurso todavía se usa en :languages.',
                'unused' => 'Este recurso no se usa en ningún lugar.',
            ],
            'save_first' => [
                'heading' => 'Añade imágenes y archivos después de guardar',
                'description' => 'Guarda primero el artículo para añadir imágenes y archivos.',
            ],
            'broken' => [
                'heading' => 'El contenido hace referencia a recursos que faltan',
                'message' => 'Parte del contenido hace referencia a imágenes o archivos que ya no existen (:details). Elimínalos o reemplázalos para quitar este aviso.',
                'images' => '{1} 1 imagen eliminada|[2,*] :count imágenes eliminadas',
                'badge' => 'Recurso faltante',
            ],
            'manager' => [
                'title' => 'Recursos',
                'preview' => 'Vista previa',
                'name' => 'Nombre',
                'size' => 'Tamaño',
                'scope' => 'Ámbito',
                'usage' => 'Uso',
                'upload' => 'Subir',
                'file' => 'Archivo',
                'kind' => 'Tipo',
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
        'localization' => [
            'language' => 'Idioma',
            'language_label' => ':language',
            'version_status' => 'Estado de la versión',
            'version_status_helper' => 'La versión de referencia sigue el estado del artículo; cada uno de los demás idiomas se publica por separado.',
            'flag_other_locales_outdated' => 'Marcar los demás idiomas como desactualizados',
            'flag_other_locales_outdated_helper' => 'Márcalo cuando este cambio obligue a volver a traducir los demás idiomas.',
            'outdated_filter' => 'Desactualizado en el idioma',
            'mark_up_to_date' => 'Marcar como actualizado',
            'state' => [
                'missing' => 'Falta',
                'draft' => 'Borrador',
                'published' => 'Publicado',
                'outdated' => 'Desactualizado',
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
