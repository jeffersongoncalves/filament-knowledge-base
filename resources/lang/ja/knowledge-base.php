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
            'actions' => [
                'view_on_site' => 'サイトで表示',
            ],
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
        'collections' => [
            'navigation_label' => 'コレクション',
            'model_label' => 'コレクション',
            'plural_model_label' => 'コレクション',
            'form' => [
                'section_details' => 'コレクションの詳細',
                'section_settings' => '設定',
                'name' => '名前',
                'slug' => 'スラッグ',
                'description' => '説明',
                'is_active' => '有効',
                'sort_order' => '並び順',
                'articles_section' => '記事',
                'articles_helper' => '顧客に表示する順番で記事を追加してください。ドラッグで並べ替えられます。',
                'article' => '記事',
                'add_article' => '記事を追加',
            ],
            'table' => [
                'name' => '名前',
                'slug' => 'スラッグ',
                'articles_count' => '記事',
                'is_active' => '有効',
                'sort_order' => '並び順',
            ],
            'warnings' => [
                'not_published' => 'この記事は顧客に表示されません。公開されていません。',
                'internal_article' => 'この記事は顧客に表示されません。内部向けの記事です。',
                'internal_category' => 'この記事は顧客に表示されません。カテゴリーが内部向けです。',
                'inactive_category' => 'この記事は顧客に表示されません。カテゴリーが無効です。',
                'deleted_category' => 'この記事は顧客に表示されません。カテゴリーが削除されています。',
                'broken_category_tree' => 'この記事は顧客に表示されません。カテゴリーの階層が壊れています。',
                'not_visible' => 'この記事は顧客に表示されません。',
                'customers_article' => 'この記事はログイン中の顧客にのみ表示されます。',
                'customers_category' => 'この記事はログイン中の顧客にのみ表示されます。カテゴリーがログイン中の顧客向けです。',
            ],
        ],
        'assets' => [
            'scope' => [
                'shared' => '共有',
            ],
            'usage' => [
                'used_in' => '使用中の言語: :languages',
                'unused' => '未使用',
            ],
            'delete' => [
                'used' => 'このアセットはまだ次の言語で使用されています: :languages。',
                'unused' => 'このアセットはどこでも使用されていません。',
            ],
            'save_first' => [
                'heading' => '保存後に画像とファイルを追加',
                'description' => '画像とファイルを追加するには、先に記事を保存してください。',
            ],
            'broken' => [
                'heading' => 'コンテンツが存在しないアセットを参照しています',
                'message' => 'コンテンツの一部が、すでに存在しない画像またはファイルを参照しています (:details)。この警告を消すには、それらを削除するか置き換えてください。',
                'images' => '削除された画像 :count 件',
                'badge' => 'アセットがありません',
            ],
            'manager' => [
                'title' => 'アセット',
                'preview' => 'プレビュー',
                'name' => '名前',
                'size' => 'サイズ',
                'scope' => '範囲',
                'usage' => '使用状況',
                'upload' => 'アップロード',
                'file' => 'ファイル',
                'kind' => '種類',
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
        'localization' => [
            'language' => '言語',
            'language_label' => ':language',
            'version_status' => 'バージョンのステータス',
            'version_status_helper' => '基準となるバージョンは記事のステータスに従います。その他の言語はそれぞれ個別に公開されます。',
            'flag_other_locales_outdated' => '他の言語を古いものとしてマーク',
            'flag_other_locales_outdated_helper' => 'この変更により他の言語の再翻訳が必要な場合にチェックしてください。',
            'outdated_filter' => '言語で古くなっている',
            'mark_up_to_date' => '最新としてマーク',
            'state' => [
                'missing' => '未作成',
                'draft' => '下書き',
                'published' => '公開済み',
                'outdated' => '古い',
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
