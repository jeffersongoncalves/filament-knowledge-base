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
            'actions' => [
                'view_on_site' => 'مشاهده در سایت',
            ],
            'details' => [
                'heading' => 'درباره این مقاله',
                'description' => 'وضعیت، نمایش و آمار، تصاویر و فایل‌ها، نسخه‌های قبلی، بازخورد خوانندگان و مقالات مرتبط.',
                'details_tab' => 'جزئیات',
            ],
            'tools' => [
                'heading' => 'فایل‌ها، تاریخچه و بازخورد',
                'description' => 'تصاویر و فایل‌های این مقاله، نسخه‌های قبلی، بازخورد خوانندگان و مقالات مرتبط.',
            ],
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
        'collections' => [
            'navigation_label' => 'مجموعه‌ها',
            'model_label' => 'مجموعه',
            'plural_model_label' => 'مجموعه‌ها',
            'form' => [
                'section_details' => 'جزئیات مجموعه',
                'section_settings' => 'تنظیمات',
                'name' => 'نام',
                'slug' => 'نامک',
                'description' => 'توضیحات',
                'is_active' => 'فعال',
                'sort_order' => 'ترتیب',
                'articles_section' => 'مقالات',
                'articles_helper' => 'مقالات را به ترتیبی که مشتریان باید ببینند اضافه کنید؛ برای تغییر ترتیب بکشید.',
                'article' => 'مقاله',
                'add_article' => 'افزودن مقاله',
            ],
            'table' => [
                'name' => 'نام',
                'slug' => 'نامک',
                'articles_count' => 'مقالات',
                'is_active' => 'فعال',
                'sort_order' => 'ترتیب',
            ],
            'warnings' => [
                'not_published' => 'مشتریان نمی‌توانند این مقاله را ببینند: منتشر نشده است.',
                'internal_article' => 'مشتریان نمی‌توانند این مقاله را ببینند: داخلی است.',
                'internal_category' => 'مشتریان نمی‌توانند این مقاله را ببینند: دسته‌بندی آن داخلی است.',
                'inactive_category' => 'مشتریان نمی‌توانند این مقاله را ببینند: دسته‌بندی آن غیرفعال است.',
                'deleted_category' => 'مشتریان نمی‌توانند این مقاله را ببینند: دسته‌بندی آن حذف شده است.',
                'broken_category_tree' => 'مشتریان نمی‌توانند این مقاله را ببینند: درخت دسته‌بندی آن خراب است.',
                'not_visible' => 'مشتریان نمی‌توانند این مقاله را ببینند.',
                'customers_article' => 'فقط مشتریان واردشده می‌توانند این مقاله را ببینند.',
                'customers_category' => 'فقط مشتریان واردشده می‌توانند این مقاله را ببینند: دسته‌بندی آن برای مشتریان واردشده است.',
            ],
        ],
        'assets' => [
            'insert_image' => [
                'label' => 'درج تصویر',
                'modal' => [
                    'heading' => 'درج تصویر',
                    'tab_existing' => 'در این مقاله (:count)',
                    'tab_upload' => 'بارگذاری تصویر جدید',
                    'existing' => 'تصاویر این مقاله',
                    'existing_help' => 'تصاویر مشترک و تصاویر این زبان. یکی را انتخاب کنید و سپس روی درج کلیک کنید.',
                    'submit' => 'درج',
                    'file' => 'یا یک تصویر جدید بارگذاری کنید',
                    'file_only' => 'بارگذاری تصویر',
                    'alt' => 'متن جایگزین',
                    'alt_help' => 'تصویر را به این زبان برای کسانی که نمی‌توانند آن را ببینند توصیف می‌کند.',
                ],
            ],
            'attach_file' => [
                'label' => 'پیوست فایل',
                'modal' => [
                    'heading' => 'پیوست فایل',
                    'tab_existing' => 'در این مقاله (:count)',
                    'tab_upload' => 'بارگذاری فایل جدید',
                    'existing' => 'فایل‌های این مقاله',
                    'existing_help' => 'فایل‌های مشترک و فایل‌های این زبان. یکی را انتخاب کنید و سپس روی پیوست کلیک کنید.',
                    'submit' => 'پیوست',
                    'file' => 'یا یک فایل جدید بارگذاری کنید',
                    'file_only' => 'بارگذاری فایل',
                ],
            ],
            'scope' => [
                'shared' => 'مشترک',
            ],
            'usage' => [
                'used_in' => 'استفاده‌شده در :languages',
                'unused' => 'استفاده‌نشده',
            ],
            'delete' => [
                'used' => 'این منبع هنوز در :languages استفاده می‌شود.',
                'unused' => 'این منبع در هیچ جا استفاده نمی‌شود.',
            ],
            'save_first' => [
                'heading' => 'تصاویر و فایل‌ها را پس از ذخیره اضافه کنید',
                'description' => 'برای افزودن تصاویر و فایل‌ها، ابتدا مقاله را ذخیره کنید.',
            ],
            'broken' => [
                'heading' => 'محتوا به منابع ناموجود ارجاع می‌دهد',
                'message' => 'بخشی از محتوا به تصاویر یا فایل‌هایی ارجاع می‌دهد که دیگر وجود ندارند (:details). برای رفع این هشدار، آن‌ها را حذف یا جایگزین کنید.',
                'images' => ':count تصویر حذف‌شده',
                'badge' => 'منبع ناموجود',
            ],
            'manager' => [
                'title' => 'منابع',
                'preview' => 'پیش‌نمایش',
                'name' => 'نام',
                'size' => 'اندازه',
                'scope' => 'دامنه',
                'usage' => 'استفاده',
                'upload' => 'بارگذاری',
                'file' => 'فایل',
                'kind' => 'نوع',
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
        'localization' => [
            'language' => 'زبان',
            'language_label' => ':language',
            'version_status' => 'وضعیت نسخه',
            'version_status_helper' => 'نسخه مرجع از وضعیت مقاله پیروی می‌کند؛ هر زبان دیگر جداگانه منتشر می‌شود.',
            'flag_other_locales_outdated' => 'علامت‌گذاری زبان‌های دیگر به‌عنوان قدیمی',
            'flag_other_locales_outdated_helper' => 'اگر این تغییر نیاز به ترجمه دوباره زبان‌های دیگر دارد، این گزینه را علامت بزنید.',
            'outdated_filter' => 'قدیمی در زبان',
            'mark_up_to_date' => 'علامت‌گذاری به‌عنوان به‌روز',
            'state' => [
                'missing' => 'ناموجود',
                'draft' => 'پیش‌نویس',
                'published' => 'منتشرشده',
                'outdated' => 'قدیمی',
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
