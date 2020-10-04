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
            'messages' => [
                '_acc_update_success' => '管理者情報の編集が成功しました。',
                '_acc_update_failed' => '管理者情報の編集に失敗しました。',
            ],
            'others' => [
              '_btn_update' => '更新する',
            ],
        ],
        'change_pwd' => [
            '_title' => 'パスワード再設定',
            'form' => [
                '_cur_password' => '現在のパスワード',
                '_cur_password_pl' => '現在のパスワードを入力してください',
                '_new_password' => '新しいパスワード',
                '_new_password_pl' => '新しいパスワードを入力してください',
                '_confirm_password' => '新しいパスワード（確認用）',
                '_confirm_password_pl' => '確認用パスワードを入力してください',
            ],
            'messages' => [
                '_current_pwd_not_match' => '現在のパスワードは古いパスワードと一致しません。',
                '_pwd_update_success' => 'パスワード再設定が成功しました。',
                '_pwd_update_failed' => 'パスワード再設定に失敗しました。',
            ],
            'others' => [
              '_btn_update_pwd' => '再設定する',
            ],
        ],
    ],
    'info' => [
        '_og_title_create' => '友伸會ポータル管理画面｜管理者アカウント管理・新規アカウント登録',
        '_og_title_edit' => '友伸會ポータル管理画面｜管理者アカウント管理・管理者情報編集',
        '_page_title_create' => '新規アカウント登録',
        '_page_title_edit' => '管理者情報編集',
        'form' => [
            '_form_title' => '管理者情報',
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
            '_btn_edit' => '更新する',
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
