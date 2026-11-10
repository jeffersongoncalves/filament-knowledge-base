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
            'actions' => [
                'view_on_site' => 'Saytda bax',
            ],
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
        'collections' => [
            'navigation_label' => 'Kolleksiyalar',
            'model_label' => 'Kolleksiya',
            'plural_model_label' => 'Kolleksiyalar',
            'form' => [
                'section_details' => 'Kolleksiyanın təfərrüatları',
                'section_settings' => 'Parametrlər',
                'name' => 'Ad',
                'slug' => 'Slug',
                'description' => 'Təsvir',
                'is_active' => 'Aktiv',
                'sort_order' => 'Sıralama',
                'articles_section' => 'Məqalələr',
                'articles_helper' => 'Məqalələri müştərilərin görməli olduğu ardıcıllıqla əlavə edin; sıranı dəyişmək üçün sürüşdürün.',
                'article' => 'Məqalə',
                'add_article' => 'Məqalə əlavə et',
            ],
            'table' => [
                'name' => 'Ad',
                'slug' => 'Slug',
                'articles_count' => 'Məqalələr',
                'is_active' => 'Aktiv',
                'sort_order' => 'Sıralama',
            ],
            'warnings' => [
                'not_published' => 'Müştərilər bu məqaləni görə bilməz: dərc edilməyib.',
                'internal_article' => 'Müştərilər bu məqaləni görə bilməz: daxilidir.',
                'internal_category' => 'Müştərilər bu məqaləni görə bilməz: kateqoriyası daxilidir.',
                'inactive_category' => 'Müştərilər bu məqaləni görə bilməz: kateqoriyası aktiv deyil.',
                'deleted_category' => 'Müştərilər bu məqaləni görə bilməz: kateqoriyası silinib.',
                'broken_category_tree' => 'Müştərilər bu məqaləni görə bilməz: kateqoriya ağacı pozulub.',
                'not_visible' => 'Müştərilər bu məqaləni görə bilməz.',
            ],
        ],
        'assets' => [
            'scope' => [
                'shared' => 'Ortaq',
            ],
            'usage' => [
                'used_in' => 'İstifadə olunduğu dillər: :languages',
                'unused' => 'İstifadə olunmur',
            ],
            'delete' => [
                'used' => 'Bu resurs hələ də bu dillərdə istifadə olunur: :languages.',
                'unused' => 'Bu resurs heç yerdə istifadə olunmur.',
            ],
            'save_first' => [
                'heading' => 'Şəkilləri və faylları yadda saxladıqdan sonra əlavə edin',
                'description' => 'Şəkil və fayl əlavə etmək üçün əvvəlcə məqaləni yadda saxlayın.',
            ],
            'broken' => [
                'heading' => 'Məzmun çatışmayan resurslara istinad edir',
                'message' => 'Məzmunun bir hissəsi artıq mövcud olmayan şəkillərə və ya fayllara istinad edir (:details). Bu xəbərdarlığı aradan qaldırmaq üçün onları silin və ya əvəz edin.',
                'images' => ':count silinmiş şəkil',
                'badge' => 'Çatışmayan resurs',
            ],
            'manager' => [
                'title' => 'Resurslar',
                'preview' => 'Önizləmə',
                'name' => 'Ad',
                'size' => 'Ölçü',
                'scope' => 'Əhatə',
                'usage' => 'İstifadə',
                'upload' => 'Yüklə',
                'file' => 'Fayl',
                'kind' => 'Növ',
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
        'localization' => [
            'language' => 'Dil',
            'language_label' => ':language',
            'version_status' => 'Versiya statusu',
            'version_status_helper' => 'Əsas versiya məqalənin statusuna uyğun gəlir; digər hər dil ayrıca dərc edilir.',
            'flag_other_locales_outdated' => 'Digər dilləri köhnəlmiş kimi qeyd et',
            'flag_other_locales_outdated_helper' => 'Bu dəyişiklikdən sonra digər dillərin yenidən tərcümə edilməsi lazımdırsa, işarələyin.',
            'outdated_filter' => 'Bu dildə köhnəlib',
            'mark_up_to_date' => 'Aktual kimi qeyd et',
            'state' => [
                'missing' => 'Yoxdur',
                'draft' => 'Qaralama',
                'published' => 'Dərc edilib',
                'outdated' => 'Köhnəlib',
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
