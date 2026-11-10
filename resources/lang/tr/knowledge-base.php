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
            'actions' => [
                'view_on_site' => 'Sitede görüntüle',
            ],
            'details' => [
                'heading' => 'Bu makale hakkında',
                'description' => 'Durum, görünürlük ve istatistikler, görseller ve dosyalar, önceki sürümler, okuyucu geri bildirimleri ve ilgili makaleler.',
                'details_tab' => 'Ayrıntılar',
            ],
            'tools' => [
                'heading' => 'Dosyalar, geçmiş ve geri bildirim',
                'description' => 'Bu makalenin görselleri ve dosyaları, önceki sürümler, okuyucu geri bildirimleri ve ilgili makaleler.',
            ],
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
        'collections' => [
            'navigation_label' => 'Koleksiyonlar',
            'model_label' => 'Koleksiyon',
            'plural_model_label' => 'Koleksiyonlar',
            'form' => [
                'section_details' => 'Koleksiyon ayrıntıları',
                'section_settings' => 'Ayarlar',
                'name' => 'Ad',
                'slug' => 'Slug',
                'description' => 'Açıklama',
                'is_active' => 'Aktif',
                'sort_order' => 'Sıralama',
                'articles_section' => 'Makaleler',
                'articles_helper' => 'Makaleleri müşterilerin görmesi gereken sırayla ekleyin; yeniden sıralamak için sürükleyin.',
                'article' => 'Makale',
                'add_article' => 'Makale ekle',
            ],
            'table' => [
                'name' => 'Ad',
                'slug' => 'Slug',
                'articles_count' => 'Makaleler',
                'is_active' => 'Aktif',
                'sort_order' => 'Sıralama',
            ],
            'warnings' => [
                'not_published' => 'Müşteriler bu makaleyi göremez: yayınlanmamış.',
                'internal_article' => 'Müşteriler bu makaleyi göremez: dahili.',
                'internal_category' => 'Müşteriler bu makaleyi göremez: kategorisi dahili.',
                'inactive_category' => 'Müşteriler bu makaleyi göremez: kategorisi etkin değil.',
                'deleted_category' => 'Müşteriler bu makaleyi göremez: kategorisi silinmiş.',
                'broken_category_tree' => 'Müşteriler bu makaleyi göremez: kategori ağacı bozuk.',
                'not_visible' => 'Müşteriler bu makaleyi göremez.',
                'customers_article' => 'Bu makaleyi yalnızca oturum açmış müşteriler görebilir.',
                'customers_category' => 'Bu makaleyi yalnızca oturum açmış müşteriler görebilir: kategorisi oturum açmış müşteriler içindir.',
            ],
        ],
        'assets' => [
            'insert_image' => [
                'label' => 'Görsel ekle',
                'modal' => [
                    'heading' => 'Görsel ekle',
                    'tab_existing' => 'Bu makalede (:count)',
                    'tab_upload' => 'Yeni yükle',
                    'existing' => 'Bu makaledeki görseller',
                    'existing_help' => 'Paylaşılan görseller ve bu dile ait görseller. Birini seçin, ardından Ekle\'ye tıklayın.',
                    'submit' => 'Ekle',
                    'file' => 'Ya da yeni bir görsel yükleyin',
                    'file_only' => 'Görsel yükle',
                    'alt' => 'Alternatif metin',
                    'alt_help' => 'Görseli göremeyenler için onu bu dilde tanımlar.',
                ],
            ],
            'attach_file' => [
                'label' => 'Dosya iliştir',
                'modal' => [
                    'heading' => 'Dosya iliştir',
                    'tab_existing' => 'Bu makalede (:count)',
                    'tab_upload' => 'Yeni yükle',
                    'existing' => 'Bu makaledeki dosyalar',
                    'existing_help' => 'Paylaşılan dosyalar ve bu dile ait dosyalar. Birini seçin, ardından İliştir\'e tıklayın.',
                    'submit' => 'İliştir',
                    'file' => 'Ya da yeni bir dosya yükleyin',
                    'file_only' => 'Dosya yükle',
                ],
            ],
            'scope' => [
                'shared' => 'Paylaşılan',
            ],
            'usage' => [
                'used_in' => 'Kullanıldığı diller: :languages',
                'unused' => 'Kullanılmıyor',
            ],
            'delete' => [
                'used' => 'Bu varlık hâlâ şu dillerde kullanılıyor: :languages.',
                'unused' => 'Bu varlık hiçbir yerde kullanılmıyor.',
            ],
            'save_first' => [
                'heading' => 'Görselleri ve dosyaları kaydettikten sonra ekleyin',
                'description' => 'Görsel ve dosya eklemek için önce makaleyi kaydedin.',
            ],
            'broken' => [
                'heading' => 'İçerik eksik varlıklara başvuruyor',
                'message' => 'İçeriğin bir kısmı artık var olmayan görsellere veya dosyalara başvuruyor (:details). Bu uyarıyı kaldırmak için onları silin ya da değiştirin.',
                'images' => ':count silinmiş görsel',
                'badge' => 'Eksik varlık',
            ],
            'manager' => [
                'title' => 'Varlıklar',
                'preview' => 'Önizleme',
                'name' => 'Ad',
                'size' => 'Boyut',
                'scope' => 'Kapsam',
                'usage' => 'Kullanım',
                'upload' => 'Yükle',
                'file' => 'Dosya',
                'kind' => 'Tür',
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
        'localization' => [
            'language' => 'Dil',
            'language_label' => ':language',
            'version_status' => 'Sürüm durumu',
            'version_status_helper' => 'Asıl sürüm makalenin durumunu izler; diğer her dil ayrı olarak yayınlanır.',
            'flag_other_locales_outdated' => 'Diğer dilleri güncel değil olarak işaretle',
            'flag_other_locales_outdated_helper' => 'Bu değişiklik diğer dillerin yeniden çevrilmesini gerektiriyorsa işaretleyin.',
            'outdated_filter' => 'Bu dilde güncel değil',
            'mark_up_to_date' => 'Güncel olarak işaretle',
            'state' => [
                'missing' => 'Eksik',
                'draft' => 'Taslak',
                'published' => 'Yayınlandı',
                'outdated' => 'Güncel değil',
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
