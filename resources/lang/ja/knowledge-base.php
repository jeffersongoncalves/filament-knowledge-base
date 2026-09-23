<?php

return [
    'common' => [
        'created_at' => '作成日時',
        'updated_at' => '更新日時',
        'visibility' => [
            'public' => '公開',
            'internal' => '内部',
        ],
    ],
    'admin' => [
        'categories' => [
            'navigation_label' => 'カテゴリ',
            'model_label' => 'カテゴリ',
            'plural_model_label' => 'カテゴリ',
            'form' => [
                'section_details' => 'カテゴリの詳細',
                'section_settings' => '設定',
                'name' => '名前',
                'slug' => 'スラッグ',
                'parent' => '親カテゴリ',
                'description' => '説明',
                'icon' => 'アイコン',
                'visibility' => '公開範囲',
                'is_active' => '有効',
                'sort_order' => '並び順',
            ],
            'table' => [
                'name' => '名前',
                'parent' => '親',
                'articles_count' => '記事',
                'is_active' => '有効',
                'sort_order' => '並び順',
                'visibility' => '公開範囲',
            ],
        ],
        'articles' => [
            'navigation_label' => '記事',
            'model_label' => '記事',
            'plural_model_label' => '記事',
            'form' => [
                'section_content' => 'コンテンツ',
                'section_settings' => '設定',
                'section_seo' => 'SEO',
                'title' => 'タイトル',
                'slug' => 'スラッグ',
                'category' => 'カテゴリ',
                'content' => '本文',
                'excerpt' => '抜粋',
                'status' => 'ステータス',
                'visibility' => '公開範囲',
                'published_at' => '公開日時',
                'seo_title' => 'SEO タイトル',
                'seo_description' => 'SEO 説明',
                'seo_keywords' => 'SEO キーワード',
            ],
            'table' => [
                'title' => 'タイトル',
                'category' => 'カテゴリ',
                'status' => 'ステータス',
                'visibility' => '公開範囲',
                'view_count' => '閲覧数',
                'published_at' => '公開日時',
            ],
            'infolist' => [
                'helpful_count' => '役に立った',
                'not_helpful_count' => '役に立たなかった',
                'current_version' => '現在のバージョン',
            ],
            'relation_managers' => [
                'versions' => [
                    'title' => 'バージョン',
                    'version_number' => 'バージョン',
                    'title_column' => 'タイトル',
                    'change_notes' => '変更メモ',
                ],
                'feedback' => [
                    'title' => 'フィードバック',
                    'is_helpful' => '役に立った',
                    'comment' => 'コメント',
                    'ip_address' => 'IP アドレス',
                ],
                'related_articles' => [
                    'title' => '関連記事',
                ],
            ],
        ],
        'widgets' => [
            'overview' => [
                'total_articles' => '記事総数',
                'published' => '公開済み',
                'drafts' => '下書き',
                'categories' => 'カテゴリ',
                'total_views' => '総閲覧数',
                'helpful_rate' => '役に立った率',
            ],
        ],
    ],
    'user' => [
        'articles' => [
            'navigation_label' => '記事',
            'feedback' => [
                'helpful' => '役に立った',
                'not_helpful' => '役に立たなかった',
                'thanks' => 'フィードバックありがとうございます！',
            ],
        ],
        'pages' => [
            'knowledge_base' => [
                'navigation_label' => '検索',
                'title' => 'ナレッジベース',
                'search_placeholder' => '記事を検索...',
                'categories_heading' => 'カテゴリ',
                'search_results_heading' => '検索結果',
                'no_results' => '記事が見つかりませんでした。',
                'articles_count' => ':count 件の記事',
            ],
        ],
        'widgets' => [
            'popular_articles' => [
                'heading' => '人気の記事',
            ],
        ],
    ],
    'guest' => [
        'articles' => [
            'navigation_label' => '記事',
        ],
        'pages' => [
            'knowledge_base' => [
                'navigation_label' => '検索',
                'title' => 'ナレッジベース',
                'search_placeholder' => '記事を検索...',
                'categories_heading' => 'カテゴリ',
                'search_results_heading' => '検索結果',
                'no_results' => '記事が見つかりませんでした。',
                'articles_count' => ':count 件の記事',
            ],
        ],
        'widgets' => [
            'popular_articles' => [
                'heading' => '人気の記事',
            ],
        ],
    ],
];
