<?php

return [
    'common' => [
        'created_at' => 'تاريخ الإنشاء',
        'updated_at' => 'تاريخ التحديث',
        'visibility' => [
            'public' => 'عام',
            'internal' => 'داخلي',
        ],
    ],
    'admin' => [
        'categories' => [
            'navigation_label' => 'الفئات',
            'model_label' => 'فئة',
            'plural_model_label' => 'الفئات',
            'form' => [
                'section_details' => 'تفاصيل الفئة',
                'section_settings' => 'الإعدادات',
                'name' => 'الاسم',
                'slug' => 'المعرّف (Slug)',
                'parent' => 'الفئة الأم',
                'description' => 'الوصف',
                'icon' => 'الأيقونة',
                'visibility' => 'الظهور',
                'is_active' => 'نشطة',
                'sort_order' => 'ترتيب الفرز',
            ],
            'table' => [
                'name' => 'الاسم',
                'parent' => 'الأم',
                'articles_count' => 'المقالات',
                'is_active' => 'نشطة',
                'sort_order' => 'ترتيب الفرز',
                'visibility' => 'الظهور',
            ],
        ],
        'articles' => [
            'navigation_label' => 'المقالات',
            'model_label' => 'مقالة',
            'plural_model_label' => 'المقالات',
            'form' => [
                'section_content' => 'المحتوى',
                'section_settings' => 'الإعدادات',
                'section_seo' => 'تحسين محركات البحث',
                'title' => 'العنوان',
                'slug' => 'المعرّف (Slug)',
                'category' => 'الفئة',
                'content' => 'المحتوى',
                'excerpt' => 'المقتطف',
                'status' => 'الحالة',
                'visibility' => 'الظهور',
                'published_at' => 'تاريخ النشر',
                'seo_title' => 'عنوان SEO',
                'seo_description' => 'وصف SEO',
                'seo_keywords' => 'كلمات SEO المفتاحية',
            ],
            'table' => [
                'title' => 'العنوان',
                'category' => 'الفئة',
                'status' => 'الحالة',
                'visibility' => 'الظهور',
                'view_count' => 'المشاهدات',
                'published_at' => 'تاريخ النشر',
            ],
            'infolist' => [
                'helpful_count' => 'مفيدة',
                'not_helpful_count' => 'غير مفيدة',
                'current_version' => 'الإصدار الحالي',
            ],
            'relation_managers' => [
                'versions' => [
                    'title' => 'الإصدارات',
                    'version_number' => 'الإصدار',
                    'title_column' => 'العنوان',
                    'change_notes' => 'ملاحظات التغيير',
                ],
                'feedback' => [
                    'title' => 'الملاحظات',
                    'is_helpful' => 'مفيدة',
                    'comment' => 'التعليق',
                    'ip_address' => 'عنوان IP',
                ],
                'related_articles' => [
                    'title' => 'مقالات ذات صلة',
                ],
            ],
        ],
        'widgets' => [
            'overview' => [
                'total_articles' => 'إجمالي المقالات',
                'published' => 'منشورة',
                'drafts' => 'مسودات',
                'categories' => 'الفئات',
                'total_views' => 'إجمالي المشاهدات',
                'helpful_rate' => 'نسبة الإفادة',
            ],
        ],
    ],
    'user' => [
        'articles' => [
            'navigation_label' => 'المقالات',
            'feedback' => [
                'helpful' => 'مفيدة',
                'not_helpful' => 'غير مفيدة',
                'thanks' => 'شكرًا لملاحظاتك!',
            ],
        ],
        'pages' => [
            'knowledge_base' => [
                'navigation_label' => 'بحث',
                'title' => 'قاعدة المعرفة',
                'search_placeholder' => 'ابحث في المقالات...',
                'categories_heading' => 'الفئات',
                'search_results_heading' => 'نتائج البحث',
                'no_results' => 'لم يتم العثور على مقالات.',
                'articles_count' => 'عدد المقالات: :count',
            ],
        ],
        'widgets' => [
            'popular_articles' => [
                'heading' => 'المقالات الشائعة',
            ],
        ],
    ],
    'guest' => [
        'articles' => [
            'navigation_label' => 'المقالات',
        ],
        'pages' => [
            'knowledge_base' => [
                'navigation_label' => 'بحث',
                'title' => 'قاعدة المعرفة',
                'search_placeholder' => 'ابحث في المقالات...',
                'categories_heading' => 'الفئات',
                'search_results_heading' => 'نتائج البحث',
                'no_results' => 'لم يتم العثور على مقالات.',
                'articles_count' => 'عدد المقالات: :count',
            ],
        ],
        'widgets' => [
            'popular_articles' => [
                'heading' => 'المقالات الشائعة',
            ],
        ],
    ],
];
