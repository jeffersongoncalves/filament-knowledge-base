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
            'actions' => [
                'view_on_site' => 'Saytda koʻrish',
            ],
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
        'collections' => [
            'navigation_label' => 'Toʻplamlar',
            'model_label' => 'Toʻplam',
            'plural_model_label' => 'Toʻplamlar',
            'form' => [
                'section_details' => 'Toʻplam tafsilotlari',
                'section_settings' => 'Sozlamalar',
                'name' => 'Nomi',
                'slug' => 'Slug',
                'description' => 'Tavsif',
                'is_active' => 'Faol',
                'sort_order' => 'Saralash tartibi',
                'articles_section' => 'Maqolalar',
                'articles_helper' => 'Maqolalarni mijozlar koʻrishi kerak boʻlgan tartibda qoʻshing; tartibni oʻzgartirish uchun sudrang.',
                'article' => 'Maqola',
                'add_article' => 'Maqola qoʻshish',
            ],
            'table' => [
                'name' => 'Nomi',
                'slug' => 'Slug',
                'articles_count' => 'Maqolalar',
                'is_active' => 'Faol',
                'sort_order' => 'Saralash tartibi',
            ],
            'warnings' => [
                'not_published' => 'Mijozlar bu maqolani koʻra olmaydi: u nashr qilinmagan.',
                'internal_article' => 'Mijozlar bu maqolani koʻra olmaydi: u ichki.',
                'internal_category' => 'Mijozlar bu maqolani koʻra olmaydi: uning toifasi ichki.',
                'inactive_category' => 'Mijozlar bu maqolani koʻra olmaydi: uning toifasi faol emas.',
                'deleted_category' => 'Mijozlar bu maqolani koʻra olmaydi: uning toifasi oʻchirilgan.',
                'broken_category_tree' => 'Mijozlar bu maqolani koʻra olmaydi: uning toifalar daraxti buzilgan.',
                'not_visible' => 'Mijozlar bu maqolani koʻra olmaydi.',
            ],
        ],
        'assets' => [
            'scope' => [
                'shared' => 'Umumiy',
            ],
            'usage' => [
                'used_in' => 'Ishlatilgan tillar: :languages',
                'unused' => 'Ishlatilmagan',
            ],
            'delete' => [
                'used' => 'Bu resurs hali ham ushbu tillarda ishlatilmoqda: :languages.',
                'unused' => 'Bu resurs hech qayerda ishlatilmaydi.',
            ],
            'save_first' => [
                'heading' => 'Rasm va fayllarni saqlagandan keyin qoʻshing',
                'description' => 'Rasm va fayl qoʻshish uchun avval maqolani saqlang.',
            ],
            'broken' => [
                'heading' => 'Kontent mavjud boʻlmagan resurslarga havola qiladi',
                'message' => 'Kontentning bir qismi endi mavjud boʻlmagan rasm yoki fayllarga havola qiladi (:details). Bu ogohlantirishni olib tashlash uchun ularni oʻchiring yoki almashtiring.',
                'images' => ':count ta oʻchirilgan rasm',
                'badge' => 'Yetishmayotgan resurs',
            ],
            'manager' => [
                'title' => 'Resurslar',
                'preview' => 'Oldindan koʻrish',
                'name' => 'Nomi',
                'size' => 'Hajmi',
                'scope' => 'Qamrov',
                'usage' => 'Ishlatilishi',
                'upload' => 'Yuklash',
                'file' => 'Fayl',
                'kind' => 'Turi',
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
        'localization' => [
            'language' => 'Til',
            'language_label' => ':language',
            'version_status' => 'Versiya holati',
            'version_status_helper' => 'Asosiy versiya maqola holatiga mos keladi; boshqa har bir til alohida nashr qilinadi.',
            'flag_other_locales_outdated' => 'Boshqa tillarni eskirgan deb belgilash',
            'flag_other_locales_outdated_helper' => 'Bu oʻzgarishdan keyin boshqa tillarni qayta tarjima qilish kerak boʻlsa, belgilang.',
            'outdated_filter' => 'Ushbu tilda eskirgan',
            'mark_up_to_date' => 'Dolzarb deb belgilash',
            'state' => [
                'missing' => 'Mavjud emas',
                'draft' => 'Qoralama',
                'published' => 'Nashr qilingan',
                'outdated' => 'Eskirgan',
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
