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
            'actions' => [
                'view_on_site' => 'عرض على الموقع',
            ],
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
        'collections' => [
            'navigation_label' => 'المجموعات',
            'model_label' => 'مجموعة',
            'plural_model_label' => 'المجموعات',
            'form' => [
                'section_details' => 'تفاصيل المجموعة',
                'section_settings' => 'الإعدادات',
                'name' => 'الاسم',
                'slug' => 'المعرّف (Slug)',
                'description' => 'الوصف',
                'is_active' => 'نشطة',
                'sort_order' => 'ترتيب الفرز',
                'articles_section' => 'المقالات',
                'articles_helper' => 'أضف المقالات بالترتيب الذي يجب أن يراها به العملاء؛ اسحب لإعادة الترتيب.',
                'article' => 'مقالة',
                'add_article' => 'إضافة مقالة',
            ],
            'table' => [
                'name' => 'الاسم',
                'slug' => 'المعرّف (Slug)',
                'articles_count' => 'المقالات',
                'is_active' => 'نشطة',
                'sort_order' => 'ترتيب الفرز',
            ],
            'warnings' => [
                'not_published' => 'لا يمكن للعملاء رؤية هذه المقالة: إنها غير منشورة.',
                'internal_article' => 'لا يمكن للعملاء رؤية هذه المقالة: إنها داخلية.',
                'internal_category' => 'لا يمكن للعملاء رؤية هذه المقالة: تصنيفها داخلي.',
                'inactive_category' => 'لا يمكن للعملاء رؤية هذه المقالة: تصنيفها غير نشط.',
                'deleted_category' => 'لا يمكن للعملاء رؤية هذه المقالة: تصنيفها محذوف.',
                'broken_category_tree' => 'لا يمكن للعملاء رؤية هذه المقالة: شجرة تصنيفاتها تالفة.',
                'not_visible' => 'لا يمكن للعملاء رؤية هذه المقالة.',
                'customers_article' => 'لا يمكن رؤية هذه المقالة إلا للعملاء المسجلين.',
                'customers_category' => 'لا يمكن رؤية هذه المقالة إلا للعملاء المسجلين: تصنيفها مخصص للعملاء المسجلين.',
            ],
        ],
        'assets' => [
            'scope' => [
                'shared' => 'مشترك',
            ],
            'usage' => [
                'used_in' => 'مستخدم في :languages',
                'unused' => 'غير مستخدم',
            ],
            'delete' => [
                'used' => 'لا يزال هذا المورد مستخدمًا في :languages.',
                'unused' => 'هذا المورد غير مستخدم في أي مكان.',
            ],
            'save_first' => [
                'heading' => 'أضف الصور والملفات بعد الحفظ',
                'description' => 'احفظ المقالة أولًا لإضافة الصور والملفات.',
            ],
            'broken' => [
                'heading' => 'يشير المحتوى إلى موارد مفقودة',
                'message' => 'يشير جزء من المحتوى إلى صور أو ملفات لم تعد موجودة (:details). احذفها أو استبدلها لإزالة هذا التحذير.',
                'images' => 'عدد الصور المحذوفة: :count',
                'badge' => 'مورد مفقود',
            ],
            'manager' => [
                'title' => 'الموارد',
                'preview' => 'معاينة',
                'name' => 'الاسم',
                'size' => 'الحجم',
                'scope' => 'النطاق',
                'usage' => 'الاستخدام',
                'upload' => 'رفع',
                'file' => 'الملف',
                'kind' => 'النوع',
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
        'localization' => [
            'language' => 'اللغة',
            'language_label' => ':language',
            'version_status' => 'حالة الإصدار',
            'version_status_helper' => 'يتبع الإصدار المرجعي حالة المقالة؛ وتُنشر كل لغة أخرى على حدة.',
            'flag_other_locales_outdated' => 'وضع علامة "قديمة" على اللغات الأخرى',
            'flag_other_locales_outdated_helper' => 'حدّد هذا الخيار إذا كان هذا التغيير يتطلب إعادة ترجمة اللغات الأخرى.',
            'outdated_filter' => 'قديمة في اللغة',
            'mark_up_to_date' => 'وضع علامة "محدّثة"',
            'state' => [
                'missing' => 'مفقودة',
                'draft' => 'مسودة',
                'published' => 'منشورة',
                'outdated' => 'قديمة',
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
