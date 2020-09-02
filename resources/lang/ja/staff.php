<?php
return [
    'attr' => [
        '_username' => 'ユーザー名',
        '_mail_address' => 'メールアドレス',
        '_position' => '職業',
        'positions' => [
            '_dr' => 'DR',
            '_dh' => 'DH',
            '_others' => 'その他',
        ],
        '_clinic' => 'クリニック',
        '_user_type' => 'ユーザータイプ',
        '_memo' => 'メモ',
    ],
    'list' => [
        '_og_title' => '友伸會ポータル管理画面｜スタッフ管理・スタッフ一覧',
        '_page_title' => 'スタッフ一覧',
        'search_box' => [
            '_position_df' => 'すべての職業',
            '_clinic_df' => 'すべてのクリニック',
            '_keyword' => 'キーワード',
            '_keyword_pl' => 'キーワードを入力してください',
        ],
        'data_table' => [
            '_registered_at' => '登録日時',
            '_last_login_at' => '最終ログイン日時',
            'actions' => [
                '_act_edit' => 'スタッフ情報を編集する',
                '_act_remove' => 'スタッフ情報を削除する',
            ],
        ],
        'messages' => [
            '_remove_success' => 'スタッフ情報の削除が成功しました。',
            '_remove_failed' => 'スタッフ情報の削除に失敗しました。',
        ],
        'others' => [
            '_btn_create' => '新規スタッフ登録',
            '_no_data' => 'スタッフが存在しません。',
            '_no_search_result' => '該当するスタッフ情報が存在しません。',
        ],
    ],
    'info' => [
        '_og_title_create' => '友伸會ポータル管理画面｜スタッフ管理・新規スタッフ情報登録',
        '_og_title_edit' => '友伸會ポータル管理画面｜スタッフ管理・スタッフ情報編集',
        '_page_title_create' => '新規スタッフ情報登録',
        '_page_title_edit' => 'スタッフ情報編集',
        'form' => [
            '_form_title' => 'スタッフ情報',
            '_username_pl' => 'ユーザー名を入力してください',
            '_mail_address_pl' => 'メールアドレスを入力してください',
            '_position_df' => '職業を選択してください',
            '_clinic_df' => 'クリニックを指定してください',
            'user_type_opt' => [
                '_staff_web' => 'ウェブユーザー',
                '_staff_mobile' => 'スマホアプリユーザー',
            ],
            '_memo_pl' => 'メモを入力してください',
        ],
        'messages' => [
            '_create_success' => '新規スタッフの登録が成功しました。',
            '_create_failed' => '新規スタッフの登録に失敗しました。',
            '_edit_success' => 'スタッフ情報の編集が成功しました。',
            '_edit_failed' => 'スタッフ情報の編集に失敗しました。',
        ],
        'others' => [
            '_btn_create' => '登録する',
            '_btn_create' => '編集する',
            '_btn_remove' => '削除する',
        ],
    ],
    'others' => [
        '_remove_modal_yes' => 'はい',
        '_remove_modal_no' => 'いいえ',
        '_remove_modal_title' => 'スタッフ情報を削除',
        '_remove_modal_description' => 'このスタッフの情報を削除してもよろしいですか？一度削除された情報は復旧することはできません。',
    ],
];
