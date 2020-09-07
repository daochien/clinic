<?php
return [
    'attr' => [
        '_username' => 'アカウント名',
        '_mail_address' => 'メールアドレス',
        '_position' => 'ポジション',
        '_role' => '管理者役割',
        '_memo' => 'メモ',
    ],
    'list' => [
        '_og_title' => '友伸會ポータル管理画面｜管理者アカウント管理・管理者一覧',
        '_page_title' => '管理者一覧',
        'search_box' => [
            '_role_df' => 'すべての役割',
        ],
        'data_table' => [
            '_registered_at' => '登録日時',
            '_last_login_at' => '最終ログイン日時',
            'actions' => [
                '_act_edit' => '管理者情報を編集する',
                '_act_remove' => '管理者情報を削除する',
            ],
        ],
        'messages' => [
            '_remove_success' => '管理者情報の削除が成功しました。',
            '_remove_failed' => '管理者情報の削除に失敗しました。',
        ],
        'others' => [
            '_btn_create' => '新規アカウント登録',
            '_no_data' => '管理者アカウントが存在しません。',
            '_no_search_result' => '該当する管理者情報が存在しません。',
        ],
    ],
    'my_account' => [
        '_page_title' => 'マイアカウント',
        'basic_info' => [
            '_title' => 'アカウント情報',
            '_subtitle' => 'アカウント情報',
            '_profile_changed' => 'Update password success',
            '_profile_update_failed' => 'Password update failed',
        ],
        'change_password' => [
            '_title' => 'パスワード再設定',
            '_current_pass' => '現在のパスワード',
            '_current_pass_place_holder' => '現在のパスワードを入力してください',
            '_new_pass_place_holder' => '新しいパスワードを入力してください',
            '_verify_pass_place_holder' => '確認用パスワードを入力してください',
            '_new_pass' => '新しいパスワード',
            '_verify_pass' => '新しいパスワード',
            '_password_changed' => 'Update password success',
            '_password_update_failed' => 'Password update failed',
        ],
        '_btn_update' => '保存',
    ],
    'info' => [
        '_og_title_create' => '友伸會ポータル管理画面｜管理者アカウント管理・新規アカウント登録',
        '_og_title_edit' => '友伸會ポータル管理画面｜管理者アカウント管理・管理者情報編集',
        '_page_title_create' => '新規アカウント登録',
        '_page_title_edit' => '管理者情報編集',
        'form' => [
            '_subtitle' => '管理者情報',
            '_username_pl' => 'アカウント名を入力してください',
            '_mail_address_pl' => 'メールアドレスを入力してください',
            '_position_df' => 'ポジションを選択してください',
            'position_opt' => [
                '_bod' => '理事長',
                '_hr' => '事務局',
            ],
            '_memo_pl' => 'メモを入力してください',
        ],
        'messages' => [
            '_create_success' => '管理者アカウントの登録が成功しました。',
            '_create_failed' => '管理者アカウントの登録に失敗しました。',
            '_edit_success' => '管理者情報の編集が成功しました。',
            '_edit_failed' => '管理者情報の編集に失敗しました。',
        ],
        'others' => [
            '_btn_create' => '登録する',
            '_btn_edit' => '編集する',
            '_btn_remove' => '削除する',
        ],
    ],
    'others' => [
        '_remove_modal_yes' => 'はい',
        '_remove_modal_no' => 'いいえ',
        '_remove_modal_title' => '管理者情報を削除',
        '_remove_modal_description' => 'この管理者の情報を削除してもよろしいですか？一度削除された情報は復旧することはできません。',
    ],
];
