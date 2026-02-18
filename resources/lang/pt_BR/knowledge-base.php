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
                'section_details' => 'Detalhes da Categoria',
                'section_settings' => 'Configurações',
                'name' => 'Nome',
                'slug' => 'Slug',
                'parent' => 'Categoria Pai',
                'description' => 'Descrição',
                'icon' => 'Ícone',
                'visibility' => 'Visibilidade',
                'is_active' => 'Ativo',
                'sort_order' => 'Ordem',
            ],
            'table' => [
                'name' => 'Nome',
                'parent' => 'Pai',
                'articles_count' => 'Artigos',
                'is_active' => 'Ativo',
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
                'section_settings' => 'Configurações',
                'section_seo' => 'SEO',
                'title' => 'Título',
                'slug' => 'Slug',
                'category' => 'Categoria',
                'content' => 'Conteúdo',
                'excerpt' => 'Resumo',
                'status' => 'Status',
                'visibility' => 'Visibilidade',
                'published_at' => 'Publicado em',
                'seo_title' => 'Título SEO',
                'seo_description' => 'Descrição SEO',
                'seo_keywords' => 'Palavras-chave SEO',
            ],
            'table' => [
                'title' => 'Título',
                'category' => 'Categoria',
                'status' => 'Status',
                'visibility' => 'Visibilidade',
                'view_count' => 'Visualizações',
                'published_at' => 'Publicado em',
            ],
            'infolist' => [
                'helpful_count' => 'Útil',
                'not_helpful_count' => 'Não Útil',
                'current_version' => 'Versão Atual',
            ],
            'relation_managers' => [
                'versions' => [
                    'title' => 'Versões',
                    'version_number' => 'Versão',
                    'title_column' => 'Título',
                    'change_notes' => 'Notas de Alteração',
                ],
                'feedback' => [
                    'title' => 'Feedback',
                    'is_helpful' => 'Útil',
                    'comment' => 'Comentário',
                    'ip_address' => 'Endereço IP',
                ],
                'related_articles' => [
                    'title' => 'Artigos Relacionados',
                ],
            ],
        ],
        'widgets' => [
            'overview' => [
                'total_articles' => 'Total de Artigos',
                'published' => 'Publicados',
                'drafts' => 'Rascunhos',
                'categories' => 'Categorias',
                'total_views' => 'Total de Visualizações',
                'helpful_rate' => 'Taxa de Utilidade',
            ],
        ],
    ],

    'user' => [
        'articles' => [
            'navigation_label' => 'Artigos',
            'feedback' => [
                'helpful' => 'Útil',
                'not_helpful' => 'Não Útil',
                'thanks' => 'Obrigado pelo seu feedback!',
            ],
        ],
        'pages' => [
            'knowledge_base' => [
                'navigation_label' => 'Pesquisar',
                'title' => 'Base de Conhecimento',
                'search_placeholder' => 'Pesquisar artigos...',
                'categories_heading' => 'Categorias',
                'search_results_heading' => 'Resultados da Pesquisa',
                'no_results' => 'Nenhum artigo encontrado.',
                'articles_count' => ':count artigo|:count artigos',
            ],
        ],
        'widgets' => [
            'popular_articles' => [
                'heading' => 'Artigos Populares',
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
                'title' => 'Base de Conhecimento',
                'search_placeholder' => 'Pesquisar artigos...',
                'categories_heading' => 'Categorias',
                'search_results_heading' => 'Resultados da Pesquisa',
                'no_results' => 'Nenhum artigo encontrado.',
                'articles_count' => ':count artigo|:count artigos',
            ],
        ],
        'widgets' => [
            'popular_articles' => [
                'heading' => 'Artigos Populares',
            ],
        ],
    ],

];
