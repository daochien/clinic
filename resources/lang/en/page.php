<?php
return [
    'attr' => [
        '_type' => 'Type',
        '_title' => 'Title',
        '_public' => 'Public',
        '_public_date' => 'Public date',
        '_status' => 'Status',
        '_url' => 'URL destination',
        '_category' => 'Category',
        '_image' => 'Image',
        '_summary' => 'Summary'
    ],
    'list' => [
        '_og_title' => '友伸會ポータル管理画面｜管理者アカウント管理・管理者一覧',
        '_page_title' => 'List of articles',
        'search_box' => [
            '_type' => 'Documents',
            '_type_pl' => 'All documents',
            '_status' => 'status',
            '_status_pl' => 'All status',
            '_date' => 'Publication date',
            '_keyword' => 'Keyword',
            '_keyword_pl' => 'Please enter a keyword',
            '_btn_clear' => 'Clear the condition',
            '_btn_search' => 'Search by this condition'
        ],
        'data_table' => [
            '_title' => '書類タイトル',
            '_type' => '種類',
            '_category' => 'カテゴリー',
            'public_date' => '公開日付',
            'status' => 'ステータス',
            '_registered_at' => '登録日時',
            '_last_login_at' => '最終ログイン日時',
            'actions' => [
                '_act_edit' => '編集する',
                '_act_remove' => '削除する',
            ],
        ],
        'messages' => [
            '_remove_success' => '管理者情報の削除が成功しました。',
            '_remove_failed' => '管理者情報の削除に失敗しました。',
        ],
        'others' => [
            '_btn_create' => 'Create New',
            '_no_data' => '管理者アカウントが存在しません。',
            '_no_search_result' => '該当する管理者情報が存在しません。',
        ],
    ],
    'info' => [
        '_og_title_create' => '友伸會ポータル管理画面｜管理者アカウント管理・新規アカウント登録',
        '_og_title_edit' => '友伸會ポータル管理画面｜管理者アカウント管理・管理者情報編集',
        '_page_title_create' => 'Create Page',
        '_page_title_edit' => 'Edit Page',
        '_basic_info' => 'Basic information',
        '_article_content' => 'Article content',
        'tabs' => [
            '_manual' => 'Manual Setting',
            '_file' => 'File Upload'
        ],
        'form' => [
            '_title_pl' => 'Please enter a title',
            '_url_pl' => 'Please specify the publication destination',
            '_category_pl' => 'Please specify a category',
            '_title_upload' => 'Please choose the file',
            '_content_upload' => 'Please upload the document (pdf), image file (png, jpg) or video (mp4).',
            '_btn_upload' => 'Upload file',
            '_btn_remove' => 'Remove Page'
        ],
        'messages' => [
            '_create_success' => '管理者アカウントの登録が成功しました。',
            '_create_failed' => '管理者アカウントの登録に失敗しました。',
            '_edit_success' => '管理者情報の編集が成功しました。',
            '_edit_failed' => '管理者情報の編集に失敗しました。',
            '_change_status_success' => 'Change status success',
            '_change_status_failed' => 'Change status failed',
            '_create_category_success' => 'Create Category Success',
            '_create_category_failed' => 'Create Category Faild',            
        ],
        'others' => [
            '_btn_create' => '登録する',
            '_btn_edit' => '編集する',
            '_btn_remove' => '削除する',
        ],
        'popup' => [
            '_create_title' => 'Create Category',
            '_btn_create' => 'Create',
            '_btn_close' => 'Close',
            '_btn_show_popup_category' => 'Add Category',
            'attr' => [
                '_name' => 'Name'
            ]
        ]
    ],
    'others' => [
        '_remove_modal_yes' => 'はい',
        '_remove_modal_no' => 'いいえ',
        '_remove_modal_title' => '管理者情報を削除',
        '_remove_modal_description' => 'この管理者の情報を削除してもよろしいですか？一度削除された情報は復旧することはできません。',
    ],
];
