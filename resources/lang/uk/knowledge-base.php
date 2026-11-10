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
            'actions' => [
                'view_on_site' => 'Відкрити на сайті',
            ],
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
        'collections' => [
            'navigation_label' => 'Добірки',
            'model_label' => 'Добірка',
            'plural_model_label' => 'Добірки',
            'form' => [
                'section_details' => 'Відомості про добірку',
                'section_settings' => 'Налаштування',
                'name' => 'Назва',
                'slug' => 'Слаг',
                'description' => 'Опис',
                'is_active' => 'Активна',
                'sort_order' => 'Порядок сортування',
                'articles_section' => 'Статті',
                'articles_helper' => 'Додавайте статті в тому порядку, у якому їх мають бачити клієнти; перетягуйте, щоб змінити порядок.',
                'article' => 'Стаття',
                'add_article' => 'Додати статтю',
            ],
            'table' => [
                'name' => 'Назва',
                'slug' => 'Слаг',
                'articles_count' => 'Статті',
                'is_active' => 'Активна',
                'sort_order' => 'Порядок сортування',
            ],
            'warnings' => [
                'not_published' => 'Клієнти не бачать цю статтю: вона не опублікована.',
                'internal_article' => 'Клієнти не бачать цю статтю: вона внутрішня.',
                'internal_category' => 'Клієнти не бачать цю статтю: її категорія внутрішня.',
                'inactive_category' => 'Клієнти не бачать цю статтю: її категорія неактивна.',
                'deleted_category' => 'Клієнти не бачать цю статтю: її категорію видалено.',
                'broken_category_tree' => 'Клієнти не бачать цю статтю: дерево її категорій пошкоджене.',
                'not_visible' => 'Клієнти не бачать цю статтю.',
                'customers_article' => 'Цю статтю бачать лише авторизовані клієнти.',
                'customers_category' => 'Цю статтю бачать лише авторизовані клієнти: її категорія призначена для авторизованих клієнтів.',
            ],
        ],
        'assets' => [
            'scope' => [
                'shared' => 'Спільний',
            ],
            'usage' => [
                'used_in' => 'Використовується: :languages',
                'unused' => 'Не використовується',
            ],
            'delete' => [
                'used' => 'Цей ресурс досі використовується: :languages.',
                'unused' => 'Цей ресурс ніде не використовується.',
            ],
            'save_first' => [
                'heading' => 'Додавайте зображення й файли після збереження',
                'description' => 'Спочатку збережіть статтю, щоб додати зображення й файли.',
            ],
            'broken' => [
                'heading' => 'Вміст посилається на відсутні ресурси',
                'message' => 'Частина вмісту посилається на зображення або файли, яких більше немає (:details). Видаліть або замініть їх, щоб прибрати це попередження.',
                'images' => ':count видалене зображення|:count видалені зображення|:count видалених зображень',
                'badge' => 'Ресурс відсутній',
            ],
            'manager' => [
                'title' => 'Ресурси',
                'preview' => 'Перегляд',
                'name' => 'Назва',
                'size' => 'Розмір',
                'scope' => 'Область',
                'usage' => 'Використання',
                'upload' => 'Завантажити',
                'file' => 'Файл',
                'kind' => 'Тип',
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
        'localization' => [
            'language' => 'Мова',
            'language_label' => ':language',
            'version_status' => 'Статус версії',
            'version_status_helper' => 'Основна версія має статус статті; кожна інша мова публікується окремо.',
            'flag_other_locales_outdated' => 'Позначити інші мови як застарілі',
            'flag_other_locales_outdated_helper' => 'Позначте, якщо після цієї зміни інші мови треба перекласти заново.',
            'outdated_filter' => 'Застаріло мовою',
            'mark_up_to_date' => 'Позначити як актуальне',
            'state' => [
                'missing' => 'Відсутня',
                'draft' => 'Чернетка',
                'published' => 'Опубліковано',
                'outdated' => 'Застаріло',
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
