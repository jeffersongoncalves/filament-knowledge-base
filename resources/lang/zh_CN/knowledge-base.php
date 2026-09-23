<?php

return [
    'common' => [
        'created_at' => '创建时间',
        'updated_at' => '更新时间',
        'visibility' => [
            'public' => '公开',
            'internal' => '内部',
        ],
    ],
    'admin' => [
        'categories' => [
            'navigation_label' => '分类',
            'model_label' => '分类',
            'plural_model_label' => '分类',
            'form' => [
                'section_details' => '分类详情',
                'section_settings' => '设置',
                'name' => '名称',
                'slug' => '别名',
                'parent' => '上级分类',
                'description' => '描述',
                'icon' => '图标',
                'visibility' => '可见性',
                'is_active' => '启用',
                'sort_order' => '排序',
            ],
            'table' => [
                'name' => '名称',
                'parent' => '上级',
                'articles_count' => '文章',
                'is_active' => '启用',
                'sort_order' => '排序',
                'visibility' => '可见性',
            ],
        ],
        'articles' => [
            'navigation_label' => '文章',
            'model_label' => '文章',
            'plural_model_label' => '文章',
            'form' => [
                'section_content' => '内容',
                'section_settings' => '设置',
                'section_seo' => 'SEO',
                'title' => '标题',
                'slug' => '别名',
                'category' => '分类',
                'content' => '内容',
                'excerpt' => '摘要',
                'status' => '状态',
                'visibility' => '可见性',
                'published_at' => '发布时间',
                'seo_title' => 'SEO 标题',
                'seo_description' => 'SEO 描述',
                'seo_keywords' => 'SEO 关键词',
            ],
            'table' => [
                'title' => '标题',
                'category' => '分类',
                'status' => '状态',
                'visibility' => '可见性',
                'view_count' => '浏览量',
                'published_at' => '发布时间',
            ],
            'infolist' => [
                'helpful_count' => '有帮助',
                'not_helpful_count' => '没有帮助',
                'current_version' => '当前版本',
            ],
            'relation_managers' => [
                'versions' => [
                    'title' => '版本',
                    'version_number' => '版本',
                    'title_column' => '标题',
                    'change_notes' => '变更说明',
                ],
                'feedback' => [
                    'title' => '反馈',
                    'is_helpful' => '有帮助',
                    'comment' => '评论',
                    'ip_address' => 'IP 地址',
                ],
                'related_articles' => [
                    'title' => '相关文章',
                ],
            ],
        ],
        'widgets' => [
            'overview' => [
                'total_articles' => '文章总数',
                'published' => '已发布',
                'drafts' => '草稿',
                'categories' => '分类',
                'total_views' => '总浏览量',
                'helpful_rate' => '有帮助率',
            ],
        ],
    ],
    'user' => [
        'articles' => [
            'navigation_label' => '文章',
            'feedback' => [
                'helpful' => '有帮助',
                'not_helpful' => '没有帮助',
                'thanks' => '感谢你的反馈！',
            ],
        ],
        'pages' => [
            'knowledge_base' => [
                'navigation_label' => '搜索',
                'title' => '知识库',
                'search_placeholder' => '搜索文章...',
                'categories_heading' => '分类',
                'search_results_heading' => '搜索结果',
                'no_results' => '未找到文章。',
                'articles_count' => ':count 篇文章',
            ],
        ],
        'widgets' => [
            'popular_articles' => [
                'heading' => '热门文章',
            ],
        ],
    ],
    'guest' => [
        'articles' => [
            'navigation_label' => '文章',
        ],
        'pages' => [
            'knowledge_base' => [
                'navigation_label' => '搜索',
                'title' => '知识库',
                'search_placeholder' => '搜索文章...',
                'categories_heading' => '分类',
                'search_results_heading' => '搜索结果',
                'no_results' => '未找到文章。',
                'articles_count' => ':count 篇文章',
            ],
        ],
        'widgets' => [
            'popular_articles' => [
                'heading' => '热门文章',
            ],
        ],
    ],
];
