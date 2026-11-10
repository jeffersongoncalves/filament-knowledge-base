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
            'actions' => [
                'view_on_site' => 'Открыть на сайте',
            ],
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
        'collections' => [
            'navigation_label' => 'Подборки',
            'model_label' => 'Подборка',
            'plural_model_label' => 'Подборки',
            'form' => [
                'section_details' => 'Сведения о подборке',
                'section_settings' => 'Настройки',
                'name' => 'Название',
                'slug' => 'Слаг',
                'description' => 'Описание',
                'is_active' => 'Активна',
                'sort_order' => 'Порядок сортировки',
                'articles_section' => 'Статьи',
                'articles_helper' => 'Добавляйте статьи в том порядке, в котором их должны видеть клиенты; перетаскивайте, чтобы изменить порядок.',
                'article' => 'Статья',
                'add_article' => 'Добавить статью',
            ],
            'table' => [
                'name' => 'Название',
                'slug' => 'Слаг',
                'articles_count' => 'Статьи',
                'is_active' => 'Активна',
                'sort_order' => 'Порядок сортировки',
            ],
            'warnings' => [
                'not_published' => 'Клиенты не видят эту статью: она не опубликована.',
                'internal_article' => 'Клиенты не видят эту статью: она внутренняя.',
                'internal_category' => 'Клиенты не видят эту статью: её категория внутренняя.',
                'inactive_category' => 'Клиенты не видят эту статью: её категория неактивна.',
                'deleted_category' => 'Клиенты не видят эту статью: её категория удалена.',
                'broken_category_tree' => 'Клиенты не видят эту статью: дерево её категорий повреждено.',
                'not_visible' => 'Клиенты не видят эту статью.',
            ],
        ],
        'assets' => [
            'scope' => [
                'shared' => 'Общий',
            ],
            'usage' => [
                'used_in' => 'Используется: :languages',
                'unused' => 'Не используется',
            ],
            'delete' => [
                'used' => 'Этот ресурс всё ещё используется: :languages.',
                'unused' => 'Этот ресурс нигде не используется.',
            ],
            'save_first' => [
                'heading' => 'Добавляйте изображения и файлы после сохранения',
                'description' => 'Сначала сохраните статью, чтобы добавить изображения и файлы.',
            ],
            'broken' => [
                'heading' => 'Содержимое ссылается на отсутствующие ресурсы',
                'message' => 'Часть содержимого ссылается на изображения или файлы, которых больше нет (:details). Удалите или замените их, чтобы убрать это предупреждение.',
                'images' => ':count удалённое изображение|:count удалённых изображения|:count удалённых изображений',
                'badge' => 'Ресурс отсутствует',
            ],
            'manager' => [
                'title' => 'Ресурсы',
                'preview' => 'Просмотр',
                'name' => 'Название',
                'size' => 'Размер',
                'scope' => 'Область',
                'usage' => 'Использование',
                'upload' => 'Загрузить',
                'file' => 'Файл',
                'kind' => 'Тип',
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
        'localization' => [
            'language' => 'Язык',
            'language_label' => ':language',
            'version_status' => 'Статус версии',
            'version_status_helper' => 'Основная версия следует статусу статьи; каждый другой язык публикуется отдельно.',
            'flag_other_locales_outdated' => 'Отметить другие языки как устаревшие',
            'flag_other_locales_outdated_helper' => 'Отметьте, если после этого изменения другие языки нужно перевести заново.',
            'outdated_filter' => 'Устарело на языке',
            'mark_up_to_date' => 'Отметить как актуальное',
            'state' => [
                'missing' => 'Отсутствует',
                'draft' => 'Черновик',
                'published' => 'Опубликовано',
                'outdated' => 'Устарело',
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
