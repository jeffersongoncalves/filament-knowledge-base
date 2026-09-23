<?php

return [
    'common' => [
        'created_at' => 'Створено',
        'updated_at' => 'Оновлено',
        'visibility' => [
            'public' => 'Публічна',
            'internal' => 'Внутрішня',
        ],
    ],
    'admin' => [
        'categories' => [
            'navigation_label' => 'Категорії',
            'model_label' => 'Категорія',
            'plural_model_label' => 'Категорії',
            'form' => [
                'section_details' => 'Відомості про категорію',
                'section_settings' => 'Налаштування',
                'name' => 'Назва',
                'slug' => 'Слаг',
                'parent' => 'Батьківська категорія',
                'description' => 'Опис',
                'icon' => 'Іконка',
                'visibility' => 'Видимість',
                'is_active' => 'Активна',
                'sort_order' => 'Порядок сортування',
            ],
            'table' => [
                'name' => 'Назва',
                'parent' => 'Батьківська',
                'articles_count' => 'Статті',
                'is_active' => 'Активна',
                'sort_order' => 'Порядок сортування',
                'visibility' => 'Видимість',
            ],
        ],
        'articles' => [
            'navigation_label' => 'Статті',
            'model_label' => 'Стаття',
            'plural_model_label' => 'Статті',
            'form' => [
                'section_content' => 'Вміст',
                'section_settings' => 'Налаштування',
                'section_seo' => 'SEO',
                'title' => 'Заголовок',
                'slug' => 'Слаг',
                'category' => 'Категорія',
                'content' => 'Вміст',
                'excerpt' => 'Анонс',
                'status' => 'Статус',
                'visibility' => 'Видимість',
                'published_at' => 'Опубліковано',
                'seo_title' => 'SEO-заголовок',
                'seo_description' => 'SEO-опис',
                'seo_keywords' => 'Ключові слова SEO',
            ],
            'table' => [
                'title' => 'Заголовок',
                'category' => 'Категорія',
                'status' => 'Статус',
                'visibility' => 'Видимість',
                'view_count' => 'Перегляди',
                'published_at' => 'Опубліковано',
            ],
            'infolist' => [
                'helpful_count' => 'Корисно',
                'not_helpful_count' => 'Некорисно',
                'current_version' => 'Поточна версія',
            ],
            'relation_managers' => [
                'versions' => [
                    'title' => 'Версії',
                    'version_number' => 'Версія',
                    'title_column' => 'Заголовок',
                    'change_notes' => 'Опис змін',
                ],
                'feedback' => [
                    'title' => 'Відгуки',
                    'is_helpful' => 'Корисно',
                    'comment' => 'Коментар',
                    'ip_address' => 'IP-адреса',
                ],
                'related_articles' => [
                    'title' => 'Пов\'язані статті',
                ],
            ],
        ],
        'widgets' => [
            'overview' => [
                'total_articles' => 'Усього статей',
                'published' => 'Опубліковано',
                'drafts' => 'Чернетки',
                'categories' => 'Категорії',
                'total_views' => 'Усього переглядів',
                'helpful_rate' => 'Частка корисних',
            ],
        ],
    ],
    'user' => [
        'articles' => [
            'navigation_label' => 'Статті',
            'feedback' => [
                'helpful' => 'Корисно',
                'not_helpful' => 'Некорисно',
                'thanks' => 'Дякуємо за відгук!',
            ],
        ],
        'pages' => [
            'knowledge_base' => [
                'navigation_label' => 'Пошук',
                'title' => 'База знань',
                'search_placeholder' => 'Пошук статей...',
                'categories_heading' => 'Категорії',
                'search_results_heading' => 'Результати пошуку',
                'no_results' => 'Статей не знайдено.',
                'articles_count' => ':count стаття|:count статті|:count статей',
            ],
        ],
        'widgets' => [
            'popular_articles' => [
                'heading' => 'Популярні статті',
            ],
        ],
    ],
    'guest' => [
        'articles' => [
            'navigation_label' => 'Статті',
        ],
        'pages' => [
            'knowledge_base' => [
                'navigation_label' => 'Пошук',
                'title' => 'База знань',
                'search_placeholder' => 'Пошук статей...',
                'categories_heading' => 'Категорії',
                'search_results_heading' => 'Результати пошуку',
                'no_results' => 'Статей не знайдено.',
                'articles_count' => ':count стаття|:count статті|:count статей',
            ],
        ],
        'widgets' => [
            'popular_articles' => [
                'heading' => 'Популярні статті',
            ],
        ],
    ],
];
