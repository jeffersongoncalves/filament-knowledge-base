<?php

return [
    'common' => [
        'created_at' => 'Yaradılma tarixi',
        'updated_at' => 'Yenilənmə tarixi',
        'visibility' => [
            'public' => 'İctimai',
            'internal' => 'Daxili',
        ],
    ],
    'admin' => [
        'categories' => [
            'navigation_label' => 'Kateqoriyalar',
            'model_label' => 'Kateqoriya',
            'plural_model_label' => 'Kateqoriyalar',
            'form' => [
                'section_details' => 'Kateqoriya təfərrüatları',
                'section_settings' => 'Parametrlər',
                'name' => 'Ad',
                'slug' => 'Slug',
                'parent' => 'Valideyn kateqoriya',
                'description' => 'Təsvir',
                'icon' => 'İkon',
                'visibility' => 'Görünürlük',
                'is_active' => 'Aktiv',
                'sort_order' => 'Sıralama',
            ],
            'table' => [
                'name' => 'Ad',
                'parent' => 'Valideyn',
                'articles_count' => 'Məqalələr',
                'is_active' => 'Aktiv',
                'sort_order' => 'Sıralama',
                'visibility' => 'Görünürlük',
            ],
        ],
        'articles' => [
            'navigation_label' => 'Məqalələr',
            'model_label' => 'Məqalə',
            'plural_model_label' => 'Məqalələr',
            'form' => [
                'section_content' => 'Məzmun',
                'section_settings' => 'Parametrlər',
                'section_seo' => 'SEO',
                'title' => 'Başlıq',
                'slug' => 'Slug',
                'category' => 'Kateqoriya',
                'content' => 'Məzmun',
                'excerpt' => 'Xülasə',
                'status' => 'Status',
                'visibility' => 'Görünürlük',
                'published_at' => 'Dərc tarixi',
                'seo_title' => 'SEO başlığı',
                'seo_description' => 'SEO təsviri',
                'seo_keywords' => 'SEO açar sözləri',
            ],
            'table' => [
                'title' => 'Başlıq',
                'category' => 'Kateqoriya',
                'status' => 'Status',
                'visibility' => 'Görünürlük',
                'view_count' => 'Baxışlar',
                'published_at' => 'Dərc tarixi',
            ],
            'infolist' => [
                'helpful_count' => 'Faydalı',
                'not_helpful_count' => 'Faydasız',
                'current_version' => 'Cari versiya',
            ],
            'relation_managers' => [
                'versions' => [
                    'title' => 'Versiyalar',
                    'version_number' => 'Versiya',
                    'title_column' => 'Başlıq',
                    'change_notes' => 'Dəyişiklik qeydləri',
                ],
                'feedback' => [
                    'title' => 'Rəylər',
                    'is_helpful' => 'Faydalı',
                    'comment' => 'Şərh',
                    'ip_address' => 'IP ünvanı',
                ],
                'related_articles' => [
                    'title' => 'Əlaqəli məqalələr',
                ],
            ],
        ],
        'widgets' => [
            'overview' => [
                'total_articles' => 'Ümumi məqalələr',
                'published' => 'Dərc edilib',
                'drafts' => 'Qaralamalar',
                'categories' => 'Kateqoriyalar',
                'total_views' => 'Ümumi baxışlar',
                'helpful_rate' => 'Faydalılıq dərəcəsi',
            ],
        ],
    ],
    'user' => [
        'articles' => [
            'navigation_label' => 'Məqalələr',
            'feedback' => [
                'helpful' => 'Faydalı',
                'not_helpful' => 'Faydasız',
                'thanks' => 'Rəyiniz üçün təşəkkür edirik!',
            ],
        ],
        'pages' => [
            'knowledge_base' => [
                'navigation_label' => 'Axtarış',
                'title' => 'Bilik bazası',
                'search_placeholder' => 'Məqalələrdə axtar...',
                'categories_heading' => 'Kateqoriyalar',
                'search_results_heading' => 'Axtarış nəticələri',
                'no_results' => 'Məqalə tapılmadı.',
                'articles_count' => ':count məqalə',
            ],
        ],
        'widgets' => [
            'popular_articles' => [
                'heading' => 'Populyar məqalələr',
            ],
        ],
    ],
    'guest' => [
        'articles' => [
            'navigation_label' => 'Məqalələr',
        ],
        'pages' => [
            'knowledge_base' => [
                'navigation_label' => 'Axtarış',
                'title' => 'Bilik bazası',
                'search_placeholder' => 'Məqalələrdə axtar...',
                'categories_heading' => 'Kateqoriyalar',
                'search_results_heading' => 'Axtarış nəticələri',
                'no_results' => 'Məqalə tapılmadı.',
                'articles_count' => ':count məqalə',
            ],
        ],
        'widgets' => [
            'popular_articles' => [
                'heading' => 'Populyar məqalələr',
            ],
        ],
    ],
];
