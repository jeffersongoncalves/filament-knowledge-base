<?php

return [
    'common' => [
        'created_at' => 'बनाया गया',
        'updated_at' => 'अपडेट किया गया',
        'visibility' => [
            'public' => 'सार्वजनिक',
            'internal' => 'आंतरिक',
        ],
    ],
    'admin' => [
        'categories' => [
            'navigation_label' => 'श्रेणियाँ',
            'model_label' => 'श्रेणी',
            'plural_model_label' => 'श्रेणियाँ',
            'form' => [
                'section_details' => 'श्रेणी विवरण',
                'section_settings' => 'सेटिंग्स',
                'name' => 'नाम',
                'slug' => 'स्लग',
                'parent' => 'मूल श्रेणी',
                'description' => 'विवरण',
                'icon' => 'आइकन',
                'visibility' => 'दृश्यता',
                'is_active' => 'सक्रिय',
                'sort_order' => 'क्रम',
            ],
            'table' => [
                'name' => 'नाम',
                'parent' => 'मूल',
                'articles_count' => 'लेख',
                'is_active' => 'सक्रिय',
                'sort_order' => 'क्रम',
                'visibility' => 'दृश्यता',
            ],
        ],
        'articles' => [
            'navigation_label' => 'लेख',
            'model_label' => 'लेख',
            'plural_model_label' => 'लेख',
            'form' => [
                'section_content' => 'सामग्री',
                'section_settings' => 'सेटिंग्स',
                'section_seo' => 'SEO',
                'title' => 'शीर्षक',
                'slug' => 'स्लग',
                'category' => 'श्रेणी',
                'content' => 'सामग्री',
                'excerpt' => 'सारांश',
                'status' => 'स्थिति',
                'visibility' => 'दृश्यता',
                'published_at' => 'प्रकाशित',
                'seo_title' => 'SEO शीर्षक',
                'seo_description' => 'SEO विवरण',
                'seo_keywords' => 'SEO कीवर्ड',
            ],
            'table' => [
                'title' => 'शीर्षक',
                'category' => 'श्रेणी',
                'status' => 'स्थिति',
                'visibility' => 'दृश्यता',
                'view_count' => 'व्यू',
                'published_at' => 'प्रकाशित',
            ],
            'infolist' => [
                'helpful_count' => 'उपयोगी',
                'not_helpful_count' => 'उपयोगी नहीं',
                'current_version' => 'वर्तमान संस्करण',
            ],
            'relation_managers' => [
                'versions' => [
                    'title' => 'संस्करण',
                    'version_number' => 'संस्करण',
                    'title_column' => 'शीर्षक',
                    'change_notes' => 'परिवर्तन नोट्स',
                ],
                'feedback' => [
                    'title' => 'प्रतिक्रिया',
                    'is_helpful' => 'उपयोगी',
                    'comment' => 'टिप्पणी',
                    'ip_address' => 'IP पता',
                ],
                'related_articles' => [
                    'title' => 'संबंधित लेख',
                ],
            ],
        ],
        'widgets' => [
            'overview' => [
                'total_articles' => 'कुल लेख',
                'published' => 'प्रकाशित',
                'drafts' => 'ड्राफ़्ट',
                'categories' => 'श्रेणियाँ',
                'total_views' => 'कुल व्यू',
                'helpful_rate' => 'उपयोगिता दर',
            ],
        ],
    ],
    'user' => [
        'articles' => [
            'navigation_label' => 'लेख',
            'feedback' => [
                'helpful' => 'उपयोगी',
                'not_helpful' => 'उपयोगी नहीं',
                'thanks' => 'आपकी प्रतिक्रिया के लिए धन्यवाद!',
            ],
        ],
        'pages' => [
            'knowledge_base' => [
                'navigation_label' => 'खोजें',
                'title' => 'ज्ञानकोष',
                'search_placeholder' => 'लेख खोजें...',
                'categories_heading' => 'श्रेणियाँ',
                'search_results_heading' => 'खोज परिणाम',
                'no_results' => 'कोई लेख नहीं मिला।',
                'articles_count' => ':count लेख|:count लेख',
            ],
        ],
        'widgets' => [
            'popular_articles' => [
                'heading' => 'लोकप्रिय लेख',
            ],
        ],
    ],
    'guest' => [
        'articles' => [
            'navigation_label' => 'लेख',
        ],
        'pages' => [
            'knowledge_base' => [
                'navigation_label' => 'खोजें',
                'title' => 'ज्ञानकोष',
                'search_placeholder' => 'लेख खोजें...',
                'categories_heading' => 'श्रेणियाँ',
                'search_results_heading' => 'खोज परिणाम',
                'no_results' => 'कोई लेख नहीं मिला।',
                'articles_count' => ':count लेख|:count लेख',
            ],
        ],
        'widgets' => [
            'popular_articles' => [
                'heading' => 'लोकप्रिय लेख',
            ],
        ],
    ],
];
