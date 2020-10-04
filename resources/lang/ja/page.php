<?php
return [
    'attr' => [
        '_type' => '書類',
        '_title' => 'タイトル',
        '_public' => '公開',
        '_public_date' => '公開日時',
        '_status' => '全員公開',
        '_url' => '公開先',
        '_category' => 'カテゴリ',
        '_image' => 'アイキャッチ画像',
        '_summary' => '概要'
    ],
    'list' => [
        '_og_title' => '友伸會ポータル管理画面｜ページ管理・ページ一覧',
        '_page_title' => 'ページ一覧',
        'search_box' => [
            '_type' => '書類',
            '_type_pl' => 'すべての書類',
            '_status' => 'ステータス',
            '_status_pl' => 'すべてのステータス',
            '_date' => '公開日付',
            '_keyword' => 'キーワード',
            '_keyword_pl' => 'キーワードを入力してください',
            '_btn_clear' => '条件をクリアする',
            '_btn_search' => 'この条件で検索'
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
            '_remove_success' => 'ページの削除が成功しました。',
            '_remove_failed' => 'ページの削除に失敗しました。',
        ],
        'others' => [
            '_btn_create' => '新規ページ作成',
            '_no_data' => 'ページデータが存在しません。',
            '_no_search_result' => '該当するページが存在しません。',
        ],
    ],
    'info' => [
        '_og_title_create' => '友伸會ポータル管理画面｜ページ管理・新規ページ作成',
        '_og_title_edit' => '友伸會ポータル管理画面｜ページ管理・ページ編集',
        '_page_title_create' => '新規ページ作成',
        '_page_title_edit' => 'ページ編集',
        '_basic_info' => '基本情報',
        '_article_content' => 'ページ内容',
        'tabs' => [
            '_manual' => 'マニュアル設定',
            '_file' => 'ファイルアップロード'
        ],
        'form' => [
            '_title_pl' => 'タイトルを入力してください',
            '_url_pl' => '公開先URLを指定してください',
            '_category_pl' => 'カテゴリーを指定してください',
            '_title_upload' => 'ファイルを選択してください',
            '_content_upload' => 'ドキュメント（pdf）、画像ファイル（png, jpg）または動画（mp4）をアップロードしてくだい',
            '_btn_upload' => 'ファイルを選択',
            '_btn_remove' => '削除する'
        ],
        'messages' => [
            '_create_success' => 'ページ作成が成功しました。',
            '_create_failed' => 'ページ作成に失敗しました。',
            '_edit_success' => 'ページ内容の編集が成功しました。',
            '_edit_failed' => 'ページ内容の編集に失敗しました。',
            '_change_status_success' => 'ページのステータス変更が成功しました。',
            '_change_status_failed' => 'ページのステータス変更に失敗しました。',            
            '_create_category_success' => 'カテゴリの作成が成功しました。',
            '_create_category_failed' => 'カテゴリの作成に失敗しました。',
        ],
        'others' => [
            '_btn_create' => '登録する',
            '_btn_edit' => '編集する',
            '_btn_remove' => '削除する',
        ],
        'popup' => [
            '_create_title' => 'ページカテゴリー登録',
            '_btn_create' => '登録する',
            '_btn_close' => 'キャンセル',
            '_btn_show_popup_category' => '新しいカテゴリーを追加',
            'attr' => [
                '_name' => 'カテゴリー名'
            ]
        ]
    ],
    'web' => [
        'sidemenu' => [
            '_blog_category' => '記事カテゴリー',
            '_faq' => 'よくある質問',
            '_manual' => 'マニュアル',
            'others' => [
                '_show_more' => 'もっと見る...',
            ],
        ],
        'blog' => [
            '_og_title' => '友伸會ポータル管理画面｜記事',
            '_page_title' => '記事',
            'list' => [
                '_latest_blogs' => '最新ニュース',
                '_show_more' => 'もっと見る...',
            ],
        ],
        'manual' => [
            '_og_title' => '友伸會ポータル管理画面｜マニュアル一覧',
            '_page_title' => 'マニュアル一覧',
        ],
    ],
    'others' => [
        '_remove_modal_yes' => 'はい',
        '_remove_modal_no' => 'いいえ',
        '_remove_modal_title' => '管理者情報を削除',
        '_remove_modal_description' => 'この管理者の情報を削除してもよろしいですか？一度削除された情報は復旧することはできません。',
    ],
];
