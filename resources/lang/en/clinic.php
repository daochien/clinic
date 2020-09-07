<?php
return [
    'attr' => [
        '_name' => 'クリニック名',
        '_prefecture' => '都道府県',
        '_zip_code' => '郵便番号',
        '_address' => '住所',
        '_memo' => 'メモ',
    ],
    'list' => [
        '_og_title' => '友伸會ポータル管理画面｜スタッフ管理・クリニック一覧',
        '_page_title' => 'クリニック一覧',
        'data_table' => [
            '_staff_count' => 'スタッフ数',
            'actions' => [
                '_act_add_user' => 'クリニックスタッフを更新する',
                '_act_edit' => 'クリニック情報を編集する',
                '_act_remove' => 'クリニックを削除する',
            ],
        ],
        'messages' => [
            '_remove_success' => 'クリニック削除が成功しました。',
            '_remove_failed' => 'クリニック削除に失敗しました。',
        ],
        'others' => [
            '_btn_create' => '新規クリニック登録',
            '_no_data' => 'クリニックが存在しません。',
            '_no_search_result' => '該当するクリニックが存在しません。',
        ],
    ],
    'info' => [
        '_og_title_create' => '友伸會ポータル管理画面｜スタッフ管理・新規クリニック登録',
        '_og_title_edit' => '友伸會ポータル管理画面｜スタッフ管理・クリニック情報編集',
        '_page_title_create' => '新規クリニック登録',
        '_page_title_edit' => 'クリニック情報編集',
        'form' => [
            '_form_title' => 'クリニック情報',
            '_name_pl' => 'クリニック名を入力してください',
            '_prefecture_df' => '都道府県を選択してください',
            '_zip_code_pl' => '郵便番号を入力してください',
            '_address_pl' => '住所を入力してください',
            '_memo_pl' => 'メモを入力してください',
        ],
        'messages' => [
            '_create_success' => 'クリニック情報の登録が成功しました。',
            '_create_failed' => 'クリニック情報の登録に失敗しました。',
            '_edit_success' => 'クリニック情報の編集が成功しました。',
            '_edit_failed' => 'クリニック情報の編集に失敗しました。',
        ],
        'others' => [
            '_btn_create' => '登録する',
            '_btn_edit' => '編集する',
            '_btn_remove' => '削除する',
        ],
    ],
    'clinic_users' => [
        '_og_title' => '友伸會ポータル管理画面｜スタッフ管理・クリニックスタッフ登録',
        '_page_title' => 'クリニックスタッフ登録',
        'data_table' => [
            '_cur_staff_count' => '現在のスタッフ数',
        ],
        'messages' => [
            '_update_success' => 'スタッフ情報の更新が成功しました。',
            '_update_failed' => 'スタッフ情報の更新に失敗しました。',
        ],
        'others' => [
            '_btn_update' => '更新する',
            '_no_data' => 'スタッフが存在しません。',
            '_no_search_result' => '該当するスタッフ情報が存在しません。',
        ],
    ],
    'others' => [
        '_remove_modal_yes' => 'はい',
        '_remove_modal_no' => 'いいえ',
        '_remove_modal_title' => 'クリニック情報を削除',
        '_remove_modal_description' => 'このクリニックの情報を削除してもよろしいですか？一度削除された情報は復旧することはできません。',
    ],
];
