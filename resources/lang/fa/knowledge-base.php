<?php

return [
    'common' => [
        'created_at' => 'تاریخ ایجاد',
        'updated_at' => 'تاریخ به‌روزرسانی',
        'visibility' => [
            'public' => 'عمومی',
            'internal' => 'داخلی',
        ],
    ],
    'admin' => [
        'categories' => [
            'navigation_label' => 'دسته‌ها',
            'model_label' => 'دسته',
            'plural_model_label' => 'دسته‌ها',
            'form' => [
                'section_details' => 'جزئیات دسته',
                'section_settings' => 'تنظیمات',
                'name' => 'نام',
                'slug' => 'نامک',
                'parent' => 'دسته والد',
                'description' => 'توضیحات',
                'icon' => 'آیکون',
                'visibility' => 'نمایش',
                'is_active' => 'فعال',
                'sort_order' => 'ترتیب',
            ],
            'table' => [
                'name' => 'نام',
                'parent' => 'والد',
                'articles_count' => 'مقالات',
                'is_active' => 'فعال',
                'sort_order' => 'ترتیب',
                'visibility' => 'نمایش',
            ],
        ],
        'articles' => [
            'navigation_label' => 'مقالات',
            'model_label' => 'مقاله',
            'plural_model_label' => 'مقالات',
            'form' => [
                'section_content' => 'محتوا',
                'section_settings' => 'تنظیمات',
                'section_seo' => 'سئو',
                'title' => 'عنوان',
                'slug' => 'نامک',
                'category' => 'دسته',
                'content' => 'محتوا',
                'excerpt' => 'خلاصه',
                'status' => 'وضعیت',
                'visibility' => 'نمایش',
                'published_at' => 'تاریخ انتشار',
                'seo_title' => 'عنوان سئو',
                'seo_description' => 'توضیحات سئو',
                'seo_keywords' => 'کلمات کلیدی سئو',
            ],
            'table' => [
                'title' => 'عنوان',
                'category' => 'دسته',
                'status' => 'وضعیت',
                'visibility' => 'نمایش',
                'view_count' => 'بازدیدها',
                'published_at' => 'تاریخ انتشار',
            ],
            'infolist' => [
                'helpful_count' => 'مفید',
                'not_helpful_count' => 'غیرمفید',
                'current_version' => 'نسخه فعلی',
            ],
            'relation_managers' => [
                'versions' => [
                    'title' => 'نسخه‌ها',
                    'version_number' => 'نسخه',
                    'title_column' => 'عنوان',
                    'change_notes' => 'یادداشت تغییرات',
                ],
                'feedback' => [
                    'title' => 'بازخورد',
                    'is_helpful' => 'مفید',
                    'comment' => 'نظر',
                    'ip_address' => 'آدرس IP',
                ],
                'related_articles' => [
                    'title' => 'مقالات مرتبط',
                ],
            ],
        ],
        'widgets' => [
            'overview' => [
                'total_articles' => 'کل مقالات',
                'published' => 'منتشرشده',
                'drafts' => 'پیش‌نویس‌ها',
                'categories' => 'دسته‌ها',
                'total_views' => 'کل بازدیدها',
                'helpful_rate' => 'نرخ مفید بودن',
            ],
        ],
    ],
    'user' => [
        'articles' => [
            'navigation_label' => 'مقالات',
            'feedback' => [
                'helpful' => 'مفید',
                'not_helpful' => 'غیرمفید',
                'thanks' => 'از بازخورد شما سپاسگزاریم!',
            ],
        ],
        'pages' => [
            'knowledge_base' => [
                'navigation_label' => 'جستجو',
                'title' => 'پایگاه دانش',
                'search_placeholder' => 'جستجوی مقالات...',
                'categories_heading' => 'دسته‌ها',
                'search_results_heading' => 'نتایج جستجو',
                'no_results' => 'مقاله‌ای یافت نشد.',
                'articles_count' => ':count مقاله|:count مقاله',
            ],
        ],
        'widgets' => [
            'popular_articles' => [
                'heading' => 'مقالات محبوب',
            ],
        ],
    ],
    'guest' => [
        'articles' => [
            'navigation_label' => 'مقالات',
        ],
        'pages' => [
            'knowledge_base' => [
                'navigation_label' => 'جستجو',
                'title' => 'پایگاه دانش',
                'search_placeholder' => 'جستجوی مقالات...',
                'categories_heading' => 'دسته‌ها',
                'search_results_heading' => 'نتایج جستجو',
                'no_results' => 'مقاله‌ای یافت نشد.',
                'articles_count' => ':count مقاله|:count مقاله',
            ],
        ],
        'widgets' => [
            'popular_articles' => [
                'heading' => 'مقالات محبوب',
            ],
        ],
    ],
];
