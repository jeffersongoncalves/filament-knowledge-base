<?php

return [
    'common' => [
        'created_at' => 'Criado em',
        'updated_at' => 'Atualizado em',
        'visibility' => [
            'public' => 'Público',
            'internal' => 'Interno',
        ],
    ],
    'admin' => [
        'categories' => [
            'navigation_label' => 'Categorias',
            'model_label' => 'Categoria',
            'plural_model_label' => 'Categorias',
            'form' => [
                'section_details' => 'Detalhes da categoria',
                'section_settings' => 'Definições',
                'name' => 'Nome',
                'slug' => 'Slug',
                'parent' => 'Categoria principal',
                'description' => 'Descrição',
                'icon' => 'Ícone',
                'visibility' => 'Visibilidade',
                'is_active' => 'Ativa',
                'sort_order' => 'Ordem',
            ],
            'table' => [
                'name' => 'Nome',
                'parent' => 'Principal',
                'articles_count' => 'Artigos',
                'is_active' => 'Ativa',
                'sort_order' => 'Ordem',
                'visibility' => 'Visibilidade',
            ],
        ],
        'articles' => [
            'navigation_label' => 'Artigos',
            'model_label' => 'Artigo',
            'plural_model_label' => 'Artigos',
            'form' => [
                'section_content' => 'Conteúdo',
                'section_settings' => 'Definições',
                'section_seo' => 'SEO',
                'title' => 'Título',
                'slug' => 'Slug',
                'category' => 'Categoria',
                'content' => 'Conteúdo',
                'excerpt' => 'Excerto',
                'status' => 'Estado',
                'visibility' => 'Visibilidade',
                'published_at' => 'Publicado em',
                'seo_title' => 'Título SEO',
                'seo_description' => 'Descrição SEO',
                'seo_keywords' => 'Palavras-chave SEO',
            ],
            'table' => [
                'title' => 'Título',
                'category' => 'Categoria',
                'status' => 'Estado',
                'visibility' => 'Visibilidade',
                'view_count' => 'Visualizações',
                'published_at' => 'Publicado em',
            ],
            'infolist' => [
                'helpful_count' => 'Útil',
                'not_helpful_count' => 'Não útil',
                'current_version' => 'Versão atual',
            ],
            'relation_managers' => [
                'versions' => [
                    'title' => 'Versões',
                    'version_number' => 'Versão',
                    'title_column' => 'Título',
                    'change_notes' => 'Notas de alteração',
                ],
                'feedback' => [
                    'title' => 'Feedback',
                    'is_helpful' => 'Útil',
                    'comment' => 'Comentário',
                    'ip_address' => 'Endereço IP',
                ],
                'related_articles' => [
                    'title' => 'Artigos relacionados',
                ],
            ],
        ],
        'widgets' => [
            'overview' => [
                'total_articles' => 'Total de artigos',
                'published' => 'Publicados',
                'drafts' => 'Rascunhos',
                'categories' => 'Categorias',
                'total_views' => 'Total de visualizações',
                'helpful_rate' => 'Taxa de utilidade',
            ],
        ],
    ],
    'user' => [
        'articles' => [
            'navigation_label' => 'Artigos',
            'feedback' => [
                'helpful' => 'Útil',
                'not_helpful' => 'Não útil',
                'thanks' => 'Obrigado pelo seu feedback!',
            ],
        ],
        'pages' => [
            'knowledge_base' => [
                'navigation_label' => 'Pesquisar',
                'title' => 'Base de conhecimento',
                'search_placeholder' => 'Pesquisar artigos...',
                'categories_heading' => 'Categorias',
                'search_results_heading' => 'Resultados da pesquisa',
                'no_results' => 'Nenhum artigo encontrado.',
                'articles_count' => ':count artigo|:count artigos',
            ],
        ],
        'widgets' => [
            'popular_articles' => [
                'heading' => 'Artigos populares',
            ],
        ],
    ],
    'guest' => [
        'articles' => [
            'navigation_label' => 'Artigos',
        ],
        'pages' => [
            'knowledge_base' => [
                'navigation_label' => 'Pesquisar',
                'title' => 'Base de conhecimento',
                'search_placeholder' => 'Pesquisar artigos...',
                'categories_heading' => 'Categorias',
                'search_results_heading' => 'Resultados da pesquisa',
                'no_results' => 'Nenhum artigo encontrado.',
                'articles_count' => ':count artigo|:count artigos',
            ],
        ],
        'widgets' => [
            'popular_articles' => [
                'heading' => 'Artigos populares',
            ],
        ],
    ],
];
