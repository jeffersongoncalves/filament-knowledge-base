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
            'actions' => [
                'view_on_site' => 'साइट पर देखें',
            ],
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
        'collections' => [
            'navigation_label' => 'संग्रह',
            'model_label' => 'संग्रह',
            'plural_model_label' => 'संग्रह',
            'form' => [
                'section_details' => 'संग्रह का विवरण',
                'section_settings' => 'सेटिंग्स',
                'name' => 'नाम',
                'slug' => 'स्लग',
                'description' => 'विवरण',
                'is_active' => 'सक्रिय',
                'sort_order' => 'क्रम',
                'articles_section' => 'लेख',
                'articles_helper' => 'लेखों को उसी क्रम में जोड़ें जिसमें ग्राहकों को उन्हें देखना चाहिए; क्रम बदलने के लिए खींचें।',
                'article' => 'लेख',
                'add_article' => 'लेख जोड़ें',
            ],
            'table' => [
                'name' => 'नाम',
                'slug' => 'स्लग',
                'articles_count' => 'लेख',
                'is_active' => 'सक्रिय',
                'sort_order' => 'क्रम',
            ],
            'warnings' => [
                'not_published' => 'ग्राहक यह लेख नहीं देख सकते: यह प्रकाशित नहीं है।',
                'internal_article' => 'ग्राहक यह लेख नहीं देख सकते: यह आंतरिक है।',
                'internal_category' => 'ग्राहक यह लेख नहीं देख सकते: इसकी श्रेणी आंतरिक है।',
                'inactive_category' => 'ग्राहक यह लेख नहीं देख सकते: इसकी श्रेणी निष्क्रिय है।',
                'deleted_category' => 'ग्राहक यह लेख नहीं देख सकते: इसकी श्रेणी हटा दी गई है।',
                'broken_category_tree' => 'ग्राहक यह लेख नहीं देख सकते: इसका श्रेणी वृक्ष टूटा हुआ है।',
                'not_visible' => 'ग्राहक यह लेख नहीं देख सकते।',
                'customers_article' => 'यह लेख केवल साइन-इन ग्राहक देख सकते हैं।',
                'customers_category' => 'यह लेख केवल साइन-इन ग्राहक देख सकते हैं: इसकी श्रेणी साइन-इन ग्राहकों के लिए है।',
            ],
        ],
        'assets' => [
            'scope' => [
                'shared' => 'साझा',
            ],
            'usage' => [
                'used_in' => ':languages में उपयोग किया गया',
                'unused' => 'अप्रयुक्त',
            ],
            'delete' => [
                'used' => 'यह संसाधन अभी भी :languages में उपयोग हो रहा है।',
                'unused' => 'यह संसाधन कहीं भी उपयोग नहीं हो रहा है।',
            ],
            'save_first' => [
                'heading' => 'सहेजने के बाद छवियाँ और फ़ाइलें जोड़ें',
                'description' => 'छवियाँ और फ़ाइलें जोड़ने के लिए पहले लेख सहेजें।',
            ],
            'broken' => [
                'heading' => 'सामग्री अनुपलब्ध संसाधनों का संदर्भ देती है',
                'message' => 'कुछ सामग्री ऐसी छवियों या फ़ाइलों का संदर्भ देती है जो अब मौजूद नहीं हैं (:details)। यह चेतावनी हटाने के लिए उन्हें हटाएँ या बदलें।',
                'images' => '{1} 1 हटाई गई छवि|[2,*] :count हटाई गई छवियाँ',
                'badge' => 'अनुपलब्ध संसाधन',
            ],
            'manager' => [
                'title' => 'संसाधन',
                'preview' => 'पूर्वावलोकन',
                'name' => 'नाम',
                'size' => 'आकार',
                'scope' => 'दायरा',
                'usage' => 'उपयोग',
                'upload' => 'अपलोड करें',
                'file' => 'फ़ाइल',
                'kind' => 'प्रकार',
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
        'localization' => [
            'language' => 'भाषा',
            'language_label' => ':language',
            'version_status' => 'संस्करण की स्थिति',
            'version_status_helper' => 'आधिकारिक संस्करण लेख की स्थिति का पालन करता है; हर अन्य भाषा अलग से प्रकाशित होती है।',
            'flag_other_locales_outdated' => 'अन्य भाषाओं को पुराना चिह्नित करें',
            'flag_other_locales_outdated_helper' => 'चुनें जब इस बदलाव के कारण अन्य भाषाओं का फिर से अनुवाद करना ज़रूरी हो।',
            'outdated_filter' => 'भाषा में पुराना',
            'mark_up_to_date' => 'अद्यतन चिह्नित करें',
            'state' => [
                'missing' => 'अनुपलब्ध',
                'draft' => 'मसौदा',
                'published' => 'प्रकाशित',
                'outdated' => 'पुराना',
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
