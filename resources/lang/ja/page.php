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
        '_image' => 'アイキャッチ画像'
    ],
    'list' => [
        '_og_title' => '友伸會ポータル管理画面｜管理者アカウント管理・管理者一覧',
        '_page_title' => '記事一覧',
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
            '_remove_success' => '管理者情報の削除が成功しました。',
            '_remove_failed' => '管理者情報の削除に失敗しました。',
        ],
        'others' => [
            '_btn_create' => '新規作成',
            '_no_data' => '管理者アカウントが存在しません。',
            '_no_search_result' => '該当する管理者情報が存在しません。',
        ],
    ],
    'info' => [
        '_og_title_create' => '友伸會ポータル管理画面｜管理者アカウント管理・新規アカウント登録',
        '_og_title_edit' => '友伸會ポータル管理画面｜管理者アカウント管理・管理者情報編集',
        '_page_title_create' => '記事作成',
        '_page_title_edit' => '投稿を編集',
        '_basic_info' => '基本情報',
        '_article_content' => '記事内容',
        'tabs' => [
            '_manual' => 'マニュアル設定',
            '_file' => 'ファイルアップロード'
        ],
        'form' => [
            '_title_pl' => 'タイトルを入力してください',
            '_url_pl' => '公開先を指定してください',
            '_category_pl' => 'カテゴリーを指定してください',
            '_title_upload' => 'ファイルを選択してください',
            '_content_upload' => 'ドキュメント（pdf）、画像ファイル（png, jpg）または動画（mp4）をアップロードしてくだい',
            '_btn_upload' => 'ファイルを選択',
            '_btn_remove' => '記事を削除する'
        ],
        'messages' => [
            '_create_success' => '管理者アカウントの登録が成功しました。',
            '_create_failed' => '管理者アカウントの登録に失敗しました。',
            '_edit_success' => '管理者情報の編集が成功しました。',
            '_edit_failed' => '管理者情報の編集に失敗しました。',
            '_change_status_success' => 'ステータス変更成功',
            '_change_status_failed' => 'ステータスの変更に失敗しました',            
            '_create_category_success' => 'カテゴリの作成成功',
            '_create_category_failed' => 'カテゴリの作成に失敗しました',
        ],
        'others' => [
            '_btn_create' => '登録する',
            '_btn_edit' => '編集する',
            '_btn_remove' => '削除する',
        ],
        'popup' => [
            '_create_title' => 'ディレクトリを作成する',
            '_btn_create' => '新しく作る',
            '_btn_close' => 'キャンセル',
            '_btn_show_popup_category' => '新しいカテゴリーを追加',
            'attr' => [
                '_name' => '種別名'
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
