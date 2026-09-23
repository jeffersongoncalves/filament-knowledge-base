<?php

return [
    'common' => [
        'created_at' => 'Yaratilgan',
        'updated_at' => 'Yangilangan',
        'visibility' => [
            'public' => 'Ommaviy',
            'internal' => 'Ichki',
        ],
    ],
    'admin' => [
        'categories' => [
            'navigation_label' => 'Toifalar',
            'model_label' => 'Toifa',
            'plural_model_label' => 'Toifalar',
            'form' => [
                'section_details' => 'Toifa tafsilotlari',
                'section_settings' => 'Sozlamalar',
                'name' => 'Nomi',
                'slug' => 'Slug',
                'parent' => 'Ota toifa',
                'description' => 'Tavsif',
                'icon' => 'Belgi',
                'visibility' => 'Koʻrinish',
                'is_active' => 'Faol',
                'sort_order' => 'Saralash tartibi',
            ],
            'table' => [
                'name' => 'Nomi',
                'parent' => 'Ota',
                'articles_count' => 'Maqolalar',
                'is_active' => 'Faol',
                'sort_order' => 'Saralash tartibi',
                'visibility' => 'Koʻrinish',
            ],
        ],
        'articles' => [
            'navigation_label' => 'Maqolalar',
            'model_label' => 'Maqola',
            'plural_model_label' => 'Maqolalar',
            'form' => [
                'section_content' => 'Kontent',
                'section_settings' => 'Sozlamalar',
                'section_seo' => 'SEO',
                'title' => 'Sarlavha',
                'slug' => 'Slug',
                'category' => 'Toifa',
                'content' => 'Kontent',
                'excerpt' => 'Qisqacha',
                'status' => 'Holat',
                'visibility' => 'Koʻrinish',
                'published_at' => 'Nashr qilingan',
                'seo_title' => 'SEO sarlavhasi',
                'seo_description' => 'SEO tavsifi',
                'seo_keywords' => 'SEO kalit soʻzlari',
            ],
            'table' => [
                'title' => 'Sarlavha',
                'category' => 'Toifa',
                'status' => 'Holat',
                'visibility' => 'Koʻrinish',
                'view_count' => 'Koʻrishlar',
                'published_at' => 'Nashr qilingan',
            ],
            'infolist' => [
                'helpful_count' => 'Foydali',
                'not_helpful_count' => 'Foydasiz',
                'current_version' => 'Joriy versiya',
            ],
            'relation_managers' => [
                'versions' => [
                    'title' => 'Versiyalar',
                    'version_number' => 'Versiya',
                    'title_column' => 'Sarlavha',
                    'change_notes' => 'Oʻzgarishlar izohi',
                ],
                'feedback' => [
                    'title' => 'Fikr-mulohazalar',
                    'is_helpful' => 'Foydali',
                    'comment' => 'Izoh',
                    'ip_address' => 'IP manzil',
                ],
                'related_articles' => [
                    'title' => 'Tegishli maqolalar',
                ],
            ],
        ],
        'widgets' => [
            'overview' => [
                'total_articles' => 'Jami maqolalar',
                'published' => 'Nashr qilingan',
                'drafts' => 'Qoralamalar',
                'categories' => 'Toifalar',
                'total_views' => 'Jami koʻrishlar',
                'helpful_rate' => 'Foydalilik darajasi',
            ],
        ],
    ],
    'user' => [
        'articles' => [
            'navigation_label' => 'Maqolalar',
            'feedback' => [
                'helpful' => 'Foydali',
                'not_helpful' => 'Foydasiz',
                'thanks' => 'Fikr-mulohazangiz uchun rahmat!',
            ],
        ],
        'pages' => [
            'knowledge_base' => [
                'navigation_label' => 'Qidiruv',
                'title' => 'Bilimlar bazasi',
                'search_placeholder' => 'Maqolalarni qidirish...',
                'categories_heading' => 'Toifalar',
                'search_results_heading' => 'Qidiruv natijalari',
                'no_results' => 'Maqolalar topilmadi.',
                'articles_count' => ':count ta maqola',
            ],
        ],
        'widgets' => [
            'popular_articles' => [
                'heading' => 'Mashhur maqolalar',
            ],
        ],
    ],
    'guest' => [
        'articles' => [
            'navigation_label' => 'Maqolalar',
        ],
        'pages' => [
            'knowledge_base' => [
                'navigation_label' => 'Qidiruv',
                'title' => 'Bilimlar bazasi',
                'search_placeholder' => 'Maqolalarni qidirish...',
                'categories_heading' => 'Toifalar',
                'search_results_heading' => 'Qidiruv natijalari',
                'no_results' => 'Maqolalar topilmadi.',
                'articles_count' => ':count ta maqola',
            ],
        ],
        'widgets' => [
            'popular_articles' => [
                'heading' => 'Mashhur maqolalar',
            ],
        ],
    ],
];
