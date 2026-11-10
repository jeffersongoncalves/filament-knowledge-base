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
            'actions' => [
                'view_on_site' => 'Ver no site',
            ],
            'details' => [
                'heading' => 'Sobre este artigo',
                'description' => 'Estado, visibilidade e estatísticas, imagens e ficheiros, versões anteriores, feedback dos leitores e artigos relacionados.',
                'details_tab' => 'Detalhes',
            ],
            'tools' => [
                'heading' => 'Ficheiros, histórico e feedback',
                'description' => 'Imagens e ficheiros deste artigo, versões anteriores, feedback dos leitores e artigos relacionados.',
            ],
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
        'collections' => [
            'navigation_label' => 'Coleções',
            'model_label' => 'Coleção',
            'plural_model_label' => 'Coleções',
            'form' => [
                'section_details' => 'Detalhes da coleção',
                'section_settings' => 'Definições',
                'name' => 'Nome',
                'slug' => 'Slug',
                'description' => 'Descrição',
                'is_active' => 'Ativa',
                'sort_order' => 'Ordem',
                'articles_section' => 'Artigos',
                'articles_helper' => 'Adicione os artigos pela ordem em que os clientes os devem ver; arraste para reordenar.',
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
                'not_published' => 'Os clientes não podem ver este artigo: não está publicado.',
                'internal_article' => 'Os clientes não podem ver este artigo: é interno.',
                'internal_category' => 'Os clientes não podem ver este artigo: a sua categoria é interna.',
                'inactive_category' => 'Os clientes não podem ver este artigo: a sua categoria está inativa.',
                'deleted_category' => 'Os clientes não podem ver este artigo: a sua categoria foi eliminada.',
                'broken_category_tree' => 'Os clientes não podem ver este artigo: a sua árvore de categorias está danificada.',
                'not_visible' => 'Os clientes não podem ver este artigo.',
                'customers_article' => 'Só os clientes autenticados podem ver este artigo.',
                'customers_category' => 'Só os clientes autenticados podem ver este artigo: a sua categoria é para clientes autenticados.',
            ],
        ],
        'assets' => [
            'insert_image' => [
                'label' => 'Inserir imagem',
                'modal' => [
                    'heading' => 'Inserir imagem',
                    'tab_existing' => 'Neste artigo (:count)',
                    'tab_upload' => 'Carregar nova',
                    'existing' => 'Imagens deste artigo',
                    'existing_help' => 'Imagens partilhadas e imagens deste idioma. Escolha uma e clique em Inserir.',
                    'submit' => 'Inserir',
                    'file' => 'Ou carregue uma nova imagem',
                    'file_only' => 'Carregar uma imagem',
                    'alt' => 'Texto alternativo',
                    'alt_help' => 'Descreve a imagem, neste idioma, para quem não a consegue ver.',
                ],
            ],
            'attach_file' => [
                'label' => 'Anexar ficheiro',
                'modal' => [
                    'heading' => 'Anexar ficheiro',
                    'tab_existing' => 'Neste artigo (:count)',
                    'tab_upload' => 'Carregar novo',
                    'existing' => 'Ficheiros deste artigo',
                    'existing_help' => 'Ficheiros partilhados e ficheiros deste idioma. Escolha um e clique em Anexar.',
                    'submit' => 'Anexar',
                    'file' => 'Ou carregue um novo ficheiro',
                    'file_only' => 'Carregar um ficheiro',
                ],
            ],
            'scope' => [
                'shared' => 'Partilhado',
            ],
            'usage' => [
                'used_in' => 'Usado em :languages',
                'unused' => 'Não usado',
            ],
            'delete' => [
                'used' => 'Este recurso ainda é usado em :languages.',
                'unused' => 'Este recurso não é usado em lado nenhum.',
            ],
            'save_first' => [
                'heading' => 'Adicione imagens e ficheiros depois de guardar',
                'description' => 'Guarde primeiro o artigo para adicionar imagens e ficheiros.',
            ],
            'broken' => [
                'heading' => 'O conteúdo refere recursos em falta',
                'message' => 'Parte do conteúdo refere imagens ou ficheiros que já não existem (:details). Remova-os ou substitua-os para eliminar este aviso.',
                'images' => '{1} 1 imagem eliminada|[2,*] :count imagens eliminadas',
                'badge' => 'Recurso em falta',
            ],
            'manager' => [
                'title' => 'Recursos',
                'preview' => 'Pré-visualização',
                'name' => 'Nome',
                'size' => 'Tamanho',
                'scope' => 'Âmbito',
                'usage' => 'Utilização',
                'upload' => 'Carregar',
                'file' => 'Ficheiro',
                'kind' => 'Tipo',
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
        'localization' => [
            'language' => 'Idioma',
            'language_label' => ':language',
            'version_status' => 'Estado da versão',
            'version_status_helper' => 'A versão de referência segue o estado do artigo; cada um dos outros idiomas é publicado separadamente.',
            'flag_other_locales_outdated' => 'Marcar os outros idiomas como desatualizados',
            'flag_other_locales_outdated_helper' => 'Assinale quando esta alteração obrigar a voltar a traduzir os outros idiomas.',
            'outdated_filter' => 'Desatualizado no idioma',
            'mark_up_to_date' => 'Marcar como atualizado',
            'state' => [
                'missing' => 'Em falta',
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
