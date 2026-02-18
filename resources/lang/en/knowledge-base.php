<?php

return [

    'common' => [
        'created_at' => 'Created At',
        'updated_at' => 'Updated At',
        'visibility' => [
            'public' => 'Public',
            'internal' => 'Internal',
        ],
    ],

    'admin' => [
        'categories' => [
            'navigation_label' => 'Categories',
            'model_label' => 'Category',
            'plural_model_label' => 'Categories',
            'form' => [
                'section_details' => 'Category Details',
                'section_settings' => 'Settings',
                'name' => 'Name',
                'slug' => 'Slug',
                'parent' => 'Parent Category',
                'description' => 'Description',
                'icon' => 'Icon',
                'visibility' => 'Visibility',
                'is_active' => 'Active',
                'sort_order' => 'Sort Order',
            ],
            'table' => [
                'name' => 'Name',
                'parent' => 'Parent',
                'articles_count' => 'Articles',
                'is_active' => 'Active',
                'sort_order' => 'Sort Order',
                'visibility' => 'Visibility',
            ],
        ],
        'articles' => [
            'navigation_label' => 'Articles',
            'model_label' => 'Article',
            'plural_model_label' => 'Articles',
            'form' => [
                'section_content' => 'Content',
                'section_settings' => 'Settings',
                'section_seo' => 'SEO',
                'title' => 'Title',
                'slug' => 'Slug',
                'category' => 'Category',
                'content' => 'Content',
                'excerpt' => 'Excerpt',
                'status' => 'Status',
                'visibility' => 'Visibility',
                'published_at' => 'Published At',
                'seo_title' => 'SEO Title',
                'seo_description' => 'SEO Description',
                'seo_keywords' => 'SEO Keywords',
            ],
            'table' => [
                'title' => 'Title',
                'category' => 'Category',
                'status' => 'Status',
                'visibility' => 'Visibility',
                'view_count' => 'Views',
                'published_at' => 'Published At',
            ],
            'infolist' => [
                'helpful_count' => 'Helpful',
                'not_helpful_count' => 'Not Helpful',
                'current_version' => 'Current Version',
            ],
            'relation_managers' => [
                'versions' => [
                    'title' => 'Versions',
                    'version_number' => 'Version',
                    'title_column' => 'Title',
                    'change_notes' => 'Change Notes',
                ],
                'feedback' => [
                    'title' => 'Feedback',
                    'is_helpful' => 'Helpful',
                    'comment' => 'Comment',
                    'ip_address' => 'IP Address',
                ],
                'related_articles' => [
                    'title' => 'Related Articles',
                ],
            ],
        ],
        'widgets' => [
            'overview' => [
                'total_articles' => 'Total Articles',
                'published' => 'Published',
                'drafts' => 'Drafts',
                'categories' => 'Categories',
                'total_views' => 'Total Views',
                'helpful_rate' => 'Helpful Rate',
            ],
        ],
    ],

    'user' => [
        'articles' => [
            'navigation_label' => 'Articles',
            'feedback' => [
                'helpful' => 'Helpful',
                'not_helpful' => 'Not Helpful',
                'thanks' => 'Thank you for your feedback!',
            ],
        ],
        'pages' => [
            'knowledge_base' => [
                'navigation_label' => 'Search',
                'title' => 'Knowledge Base',
                'search_placeholder' => 'Search articles...',
                'categories_heading' => 'Categories',
                'search_results_heading' => 'Search Results',
                'no_results' => 'No articles found.',
                'articles_count' => ':count article|:count articles',
            ],
        ],
        'widgets' => [
            'popular_articles' => [
                'heading' => 'Popular Articles',
            ],
        ],
    ],

    'guest' => [
        'articles' => [
            'navigation_label' => 'Articles',
        ],
        'pages' => [
            'knowledge_base' => [
                'navigation_label' => 'Search',
                'title' => 'Knowledge Base',
                'search_placeholder' => 'Search articles...',
                'categories_heading' => 'Categories',
                'search_results_heading' => 'Search Results',
                'no_results' => 'No articles found.',
                'articles_count' => ':count article|:count articles',
            ],
        ],
        'widgets' => [
            'popular_articles' => [
                'heading' => 'Popular Articles',
            ],
        ],
    ],

];
