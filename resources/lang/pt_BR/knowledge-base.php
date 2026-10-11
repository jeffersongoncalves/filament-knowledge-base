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
            'actions' => [
                'view_on_site' => 'Ver no site',
            ],
            'details' => [
                'heading' => 'Sobre este artigo',
                'description' => 'Status, visibilidade e estatísticas, imagens e arquivos, versões anteriores, feedback dos leitores e artigos relacionados.',
                'details_tab' => 'Detalhes',
            ],
            'tools' => [
                'heading' => 'Arquivos, histórico e feedback',
                'description' => 'Imagens e arquivos deste artigo, versões anteriores, feedback dos leitores e artigos relacionados.',
            ],
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
        'collections' => [
            'navigation_label' => 'Coleções',
            'model_label' => 'Coleção',
            'plural_model_label' => 'Coleções',
            'form' => [
                'section_details' => 'Detalhes da Coleção',
                'section_settings' => 'Configurações',
                'name' => 'Nome',
                'slug' => 'Slug',
                'description' => 'Descrição',
                'is_active' => 'Ativa',
                'sort_order' => 'Ordem',
                'articles_section' => 'Artigos',
                'articles_helper' => 'Adicione os artigos na ordem em que os clientes devem vê-los; arraste para reordenar.',
                'article' => 'Artigo',
                'add_article' => 'Adicionar artigo',
            ],
            'table' => [
                'name' => 'Nome',
                'slug' => 'Slug',
                'articles_count' => 'Artigos',
                'is_active' => 'Ativa',
                'sort_order' => 'Ordem',
            ],
            'warnings' => [
                'not_published' => 'Os clientes não veem este artigo: ele não está publicado.',
                'internal_article' => 'Os clientes não veem este artigo: ele é interno.',
                'internal_category' => 'Os clientes não veem este artigo: a categoria é interna.',
                'inactive_category' => 'Os clientes não veem este artigo: a categoria está inativa.',
                'deleted_category' => 'Os clientes não veem este artigo: a categoria foi excluída.',
                'broken_category_tree' => 'Os clientes não veem este artigo: a árvore de categorias está quebrada.',
                'not_visible' => 'Os clientes não veem este artigo.',
            ],
        ],
        'assets' => [
            'insert_image' => [
                'label' => 'Inserir imagem',
                'modal' => [
                    'heading' => 'Inserir imagem',
                    'tab_existing' => 'Neste artigo (:count)',
                    'tab_upload' => 'Enviar nova',
                    'existing' => 'Imagens deste artigo',
                    'existing_help' => 'Imagens compartilhadas e imagens deste idioma. Escolha uma e clique em Inserir.',
                    'submit' => 'Inserir',
                    'file' => 'Ou envie uma nova imagem',
                    'file_only' => 'Enviar uma imagem',
                    'alt' => 'Texto alternativo',
                    'alt_help' => 'Descreve a imagem para quem não pode vê-la, neste idioma.',
                ],
            ],
            'attach_file' => [
                'label' => 'Anexar arquivo',
                'modal' => [
                    'heading' => 'Anexar arquivo',
                    'tab_existing' => 'Neste artigo (:count)',
                    'tab_upload' => 'Enviar novo',
                    'existing' => 'Arquivos deste artigo',
                    'existing_help' => 'Arquivos compartilhados e arquivos deste idioma. Escolha um e clique em Anexar.',
                    'submit' => 'Anexar',
                    'file' => 'Ou envie um novo arquivo',
                    'file_only' => 'Enviar um arquivo',
                ],
            ],
            'scope' => [
                'shared' => 'Compartilhado',
            ],
            'usage' => [
                'used_in' => 'Usado em :languages',
                'unused' => 'Não usado',
            ],
            'delete' => [
                'used' => 'Este arquivo ainda é usado em :languages.',
                'unused' => 'Este arquivo não é usado em nenhum lugar.',
            ],
            'save_first' => [
                'heading' => 'Adicione imagens e arquivos depois de salvar',
                'description' => 'Salve o artigo primeiro para adicionar imagens e arquivos.',
            ],
            'broken' => [
                'heading' => 'O conteúdo se refere a arquivos ausentes',
                'message' => 'Parte do conteúdo se refere a imagens ou arquivos que não existem mais (:details). Remova-os ou substitua-os para limpar este aviso.',
                'images' => '{1} 1 imagem excluída|[2,*] :count imagens excluídas',
                'badge' => 'Arquivo ausente',
            ],
            'manager' => [
                'title' => 'Arquivos',
                'preview' => 'Pré-visualização',
                'name' => 'Nome',
                'size' => 'Tamanho',
                'scope' => 'Escopo',
                'usage' => 'Uso',
                'upload' => 'Enviar',
                'file' => 'Arquivo',
                'kind' => 'Tipo',
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
        'localization' => [
            'language' => 'Idioma',
            'language_label' => ':language',
            'version_status' => 'Status da versão',
            'version_status_helper' => 'A versão de referência segue o status do artigo; cada outro idioma é publicado separadamente.',
            'flag_other_locales_outdated' => 'Marcar outros idiomas como desatualizados',
            'flag_other_locales_outdated_helper' => 'Marque quando esta alteração exigir uma nova tradução dos outros idiomas.',
            'outdated_filter' => 'Desatualizado no idioma',
            'mark_up_to_date' => 'Marcar como atualizado',
            'state' => [
                'missing' => 'Ausente',
                'draft' => 'Rascunho',
                'published' => 'Publicado',
                'outdated' => 'Desatualizado',
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
