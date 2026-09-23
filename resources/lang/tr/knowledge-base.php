<?php

return [
    'common' => [
        'created_at' => 'Oluşturulma tarihi',
        'updated_at' => 'Güncellenme tarihi',
        'visibility' => [
            'public' => 'Herkese açık',
            'internal' => 'Dahili',
        ],
    ],
    'admin' => [
        'categories' => [
            'navigation_label' => 'Kategoriler',
            'model_label' => 'Kategori',
            'plural_model_label' => 'Kategoriler',
            'form' => [
                'section_details' => 'Kategori ayrıntıları',
                'section_settings' => 'Ayarlar',
                'name' => 'Ad',
                'slug' => 'Slug',
                'parent' => 'Üst kategori',
                'description' => 'Açıklama',
                'icon' => 'Simge',
                'visibility' => 'Görünürlük',
                'is_active' => 'Aktif',
                'sort_order' => 'Sıralama',
            ],
            'table' => [
                'name' => 'Ad',
                'parent' => 'Üst',
                'articles_count' => 'Makaleler',
                'is_active' => 'Aktif',
                'sort_order' => 'Sıralama',
                'visibility' => 'Görünürlük',
            ],
        ],
        'articles' => [
            'navigation_label' => 'Makaleler',
            'model_label' => 'Makale',
            'plural_model_label' => 'Makaleler',
            'form' => [
                'section_content' => 'İçerik',
                'section_settings' => 'Ayarlar',
                'section_seo' => 'SEO',
                'title' => 'Başlık',
                'slug' => 'Slug',
                'category' => 'Kategori',
                'content' => 'İçerik',
                'excerpt' => 'Özet',
                'status' => 'Durum',
                'visibility' => 'Görünürlük',
                'published_at' => 'Yayınlanma tarihi',
                'seo_title' => 'SEO başlığı',
                'seo_description' => 'SEO açıklaması',
                'seo_keywords' => 'SEO anahtar kelimeleri',
            ],
            'table' => [
                'title' => 'Başlık',
                'category' => 'Kategori',
                'status' => 'Durum',
                'visibility' => 'Görünürlük',
                'view_count' => 'Görüntülenme',
                'published_at' => 'Yayınlanma tarihi',
            ],
            'infolist' => [
                'helpful_count' => 'Faydalı',
                'not_helpful_count' => 'Faydalı değil',
                'current_version' => 'Güncel sürüm',
            ],
            'relation_managers' => [
                'versions' => [
                    'title' => 'Sürümler',
                    'version_number' => 'Sürüm',
                    'title_column' => 'Başlık',
                    'change_notes' => 'Değişiklik notları',
                ],
                'feedback' => [
                    'title' => 'Geri bildirim',
                    'is_helpful' => 'Faydalı',
                    'comment' => 'Yorum',
                    'ip_address' => 'IP adresi',
                ],
                'related_articles' => [
                    'title' => 'İlgili makaleler',
                ],
            ],
        ],
        'widgets' => [
            'overview' => [
                'total_articles' => 'Toplam makale',
                'published' => 'Yayınlanan',
                'drafts' => 'Taslaklar',
                'categories' => 'Kategoriler',
                'total_views' => 'Toplam görüntülenme',
                'helpful_rate' => 'Faydalılık oranı',
            ],
        ],
    ],
    'user' => [
        'articles' => [
            'navigation_label' => 'Makaleler',
            'feedback' => [
                'helpful' => 'Faydalı',
                'not_helpful' => 'Faydalı değil',
                'thanks' => 'Geri bildiriminiz için teşekkürler!',
            ],
        ],
        'pages' => [
            'knowledge_base' => [
                'navigation_label' => 'Ara',
                'title' => 'Bilgi bankası',
                'search_placeholder' => 'Makalelerde ara...',
                'categories_heading' => 'Kategoriler',
                'search_results_heading' => 'Arama sonuçları',
                'no_results' => 'Makale bulunamadı.',
                'articles_count' => ':count makale',
            ],
        ],
        'widgets' => [
            'popular_articles' => [
                'heading' => 'Popüler makaleler',
            ],
        ],
    ],
    'guest' => [
        'articles' => [
            'navigation_label' => 'Makaleler',
        ],
        'pages' => [
            'knowledge_base' => [
                'navigation_label' => 'Ara',
                'title' => 'Bilgi bankası',
                'search_placeholder' => 'Makalelerde ara...',
                'categories_heading' => 'Kategoriler',
                'search_results_heading' => 'Arama sonuçları',
                'no_results' => 'Makale bulunamadı.',
                'articles_count' => ':count makale',
            ],
        ],
        'widgets' => [
            'popular_articles' => [
                'heading' => 'Popüler makaleler',
            ],
        ],
    ],
];
