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
            'actions' => [
                'view_on_site' => '在网站上查看',
            ],
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
        'collections' => [
            'navigation_label' => '合集',
            'model_label' => '合集',
            'plural_model_label' => '合集',
            'form' => [
                'section_details' => '合集详情',
                'section_settings' => '设置',
                'name' => '名称',
                'slug' => '别名',
                'description' => '描述',
                'is_active' => '启用',
                'sort_order' => '排序',
                'articles_section' => '文章',
                'articles_helper' => '按客户应看到的顺序添加文章；拖动可重新排序。',
                'article' => '文章',
                'add_article' => '添加文章',
            ],
            'table' => [
                'name' => '名称',
                'slug' => '别名',
                'articles_count' => '文章',
                'is_active' => '启用',
                'sort_order' => '排序',
            ],
            'warnings' => [
                'not_published' => '客户无法看到这篇文章：它尚未发布。',
                'internal_article' => '客户无法看到这篇文章：它是内部文章。',
                'internal_category' => '客户无法看到这篇文章：它的分类是内部分类。',
                'inactive_category' => '客户无法看到这篇文章：它的分类未启用。',
                'deleted_category' => '客户无法看到这篇文章：它的分类已被删除。',
                'broken_category_tree' => '客户无法看到这篇文章：它的分类树已损坏。',
                'not_visible' => '客户无法看到这篇文章。',
            ],
        ],
        'assets' => [
            'scope' => [
                'shared' => '共享',
            ],
            'usage' => [
                'used_in' => '使用于 :languages',
                'unused' => '未使用',
            ],
            'delete' => [
                'used' => '此资源仍在 :languages 中使用。',
                'unused' => '此资源未在任何地方使用。',
            ],
            'save_first' => [
                'heading' => '保存后再添加图片和文件',
                'description' => '请先保存文章，再添加图片和文件。',
            ],
            'broken' => [
                'heading' => '内容引用了缺失的资源',
                'message' => '部分内容引用了已不存在的图片或文件 (:details)。删除或替换它们即可清除此警告。',
                'images' => ':count 张已删除的图片',
                'badge' => '资源缺失',
            ],
            'manager' => [
                'title' => '资源',
                'preview' => '预览',
                'name' => '名称',
                'size' => '大小',
                'scope' => '范围',
                'usage' => '使用情况',
                'upload' => '上传',
                'file' => '文件',
                'kind' => '类型',
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
        'localization' => [
            'language' => '语言',
            'language_label' => ':language',
            'version_status' => '版本状态',
            'version_status_helper' => '权威版本跟随文章状态；其他每种语言单独发布。',
            'flag_other_locales_outdated' => '将其他语言标记为过时',
            'flag_other_locales_outdated_helper' => '如果此更改意味着其他语言需要重新翻译，请勾选。',
            'outdated_filter' => '在该语言中已过时',
            'mark_up_to_date' => '标记为最新',
            'state' => [
                'missing' => '缺失',
                'draft' => '草稿',
                'published' => '已发布',
                'outdated' => '已过时',
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
