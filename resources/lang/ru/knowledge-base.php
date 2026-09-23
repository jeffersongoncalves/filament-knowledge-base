<?php

return [
    'common' => [
        'created_at' => 'Создано',
        'updated_at' => 'Обновлено',
        'visibility' => [
            'public' => 'Публичная',
            'internal' => 'Внутренняя',
        ],
    ],
    'admin' => [
        'categories' => [
            'navigation_label' => 'Категории',
            'model_label' => 'Категория',
            'plural_model_label' => 'Категории',
            'form' => [
                'section_details' => 'Сведения о категории',
                'section_settings' => 'Настройки',
                'name' => 'Название',
                'slug' => 'Слаг',
                'parent' => 'Родительская категория',
                'description' => 'Описание',
                'icon' => 'Иконка',
                'visibility' => 'Видимость',
                'is_active' => 'Активна',
                'sort_order' => 'Порядок сортировки',
            ],
            'table' => [
                'name' => 'Название',
                'parent' => 'Родитель',
                'articles_count' => 'Статьи',
                'is_active' => 'Активна',
                'sort_order' => 'Порядок сортировки',
                'visibility' => 'Видимость',
            ],
        ],
        'articles' => [
            'navigation_label' => 'Статьи',
            'model_label' => 'Статья',
            'plural_model_label' => 'Статьи',
            'form' => [
                'section_content' => 'Содержимое',
                'section_settings' => 'Настройки',
                'section_seo' => 'SEO',
                'title' => 'Заголовок',
                'slug' => 'Слаг',
                'category' => 'Категория',
                'content' => 'Содержимое',
                'excerpt' => 'Анонс',
                'status' => 'Статус',
                'visibility' => 'Видимость',
                'published_at' => 'Опубликовано',
                'seo_title' => 'SEO-заголовок',
                'seo_description' => 'SEO-описание',
                'seo_keywords' => 'Ключевые слова SEO',
            ],
            'table' => [
                'title' => 'Заголовок',
                'category' => 'Категория',
                'status' => 'Статус',
                'visibility' => 'Видимость',
                'view_count' => 'Просмотры',
                'published_at' => 'Опубликовано',
            ],
            'infolist' => [
                'helpful_count' => 'Полезно',
                'not_helpful_count' => 'Бесполезно',
                'current_version' => 'Текущая версия',
            ],
            'relation_managers' => [
                'versions' => [
                    'title' => 'Версии',
                    'version_number' => 'Версия',
                    'title_column' => 'Заголовок',
                    'change_notes' => 'Описание изменений',
                ],
                'feedback' => [
                    'title' => 'Отзывы',
                    'is_helpful' => 'Полезно',
                    'comment' => 'Комментарий',
                    'ip_address' => 'IP-адрес',
                ],
                'related_articles' => [
                    'title' => 'Связанные статьи',
                ],
            ],
        ],
        'widgets' => [
            'overview' => [
                'total_articles' => 'Всего статей',
                'published' => 'Опубликовано',
                'drafts' => 'Черновики',
                'categories' => 'Категории',
                'total_views' => 'Всего просмотров',
                'helpful_rate' => 'Доля полезных',
            ],
        ],
    ],
    'user' => [
        'articles' => [
            'navigation_label' => 'Статьи',
            'feedback' => [
                'helpful' => 'Полезно',
                'not_helpful' => 'Бесполезно',
                'thanks' => 'Спасибо за отзыв!',
            ],
        ],
        'pages' => [
            'knowledge_base' => [
                'navigation_label' => 'Поиск',
                'title' => 'База знаний',
                'search_placeholder' => 'Поиск статей...',
                'categories_heading' => 'Категории',
                'search_results_heading' => 'Результаты поиска',
                'no_results' => 'Статьи не найдены.',
                'articles_count' => ':count статья|:count статьи|:count статей',
            ],
        ],
        'widgets' => [
            'popular_articles' => [
                'heading' => 'Популярные статьи',
            ],
        ],
    ],
    'guest' => [
        'articles' => [
            'navigation_label' => 'Статьи',
        ],
        'pages' => [
            'knowledge_base' => [
                'navigation_label' => 'Поиск',
                'title' => 'База знаний',
                'search_placeholder' => 'Поиск статей...',
                'categories_heading' => 'Категории',
                'search_results_heading' => 'Результаты поиска',
                'no_results' => 'Статьи не найдены.',
                'articles_count' => ':count статья|:count статьи|:count статей',
            ],
        ],
        'widgets' => [
            'popular_articles' => [
                'heading' => 'Популярные статьи',
            ],
        ],
    ],
];
