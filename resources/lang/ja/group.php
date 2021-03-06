<?php
return [
    'attr' => [
        '_name' => 'グループ名',
        '_memo' => 'メモ',
    ],
    'list' => [
        '_og_title' => '友伸會ポータル管理画面｜スタッフ管理・グループ一覧',
        '_page_title' => 'グループ一覧',
        'data_table' => [
            '_staff_count' => 'ユーザー数',
            'actions' => [
                '_act_add_user' => 'グループユーザーを更新する',
                '_act_edit' => 'グループ情報を編集する',
                '_act_remove' => 'グループを削除する',
            ],
        ],
        'messages' => [
            '_remove_success' => 'グループ削除が成功しました。',
            '_remove_failed' => 'グループ削除に失敗しました。',
        ],
        'others' => [
            '_btn_create' => '新規グループ登録',
            '_no_data' => 'グループが存在しません。',
        ],
    ],
    'info' => [
        '_og_title_create' => '友伸會ポータル管理画面｜スタッフ管理・新規グループ登録',
        '_og_title_edit' => '友伸會ポータル管理画面｜スタッフ管理・グループ情報編集',
        '_page_title_create' => '新規グループ登録',
        '_page_title_edit' => 'グループ情報編集',
        'form' => [
            '_subtitle' => 'グループ情報',
            '_name_pl' => 'グループ名を入力してください',
            '_memo_pl' => 'メモを入力してください',
        ],
        'messages' => [
            '_create_success' => 'グループ情報の登録が成功しました。',
            '_create_failed' => 'グループ情報の登録に失敗しました。',
            '_edit_success' => 'グループ情報の編集が成功しました。',
            '_edit_failed' => 'グループ情報の編集に失敗しました。',
        ],
        'others' => [
            '_btn_create' => '登録する',
            '_btn_edit' => '編集する',
            '_btn_remove' => '削除する',
        ],
    ],
    'group_users' => [
        '_og_title' => '友伸會ポータル管理画面｜スタッフ管理・グループユーザー登録',
        '_page_title' => 'グループユーザー登録',
        '_not_found_user'=>'ユーザーが見つかりません',
        'data_table' => [
            '_cur_staff_count' => '現在のスタッフ数',
        ],
        'messages' => [
            '_update_success' => 'グループユーザーの更新が成功しました。',
            '_update_failed' => 'グループユーザーの更新に失敗しました。',
        ],
        'others' => [
            '_data_result' => 'データ結果',
            '_btn_update' => '更新する',
            '_no_data' => 'ユーザーが存在しません。',
            '_no_search_result' => '該当するユーザー情報が存在しません。',
        ],
    ],
    'form' =>[
        '_name' => '名前',
        '_unique' => '指定の名前は既に使用されています',
    ],
    'popup' =>[
        '_cannot_do_this_action' => 'このアクションは実行できません',
    ],
    'others' => [
        '_remove_modal_yes' => 'はい',
        '_remove_modal_no' => 'いいえ',
        '_remove_modal_title' => 'グループを削除',
        '_remove_modal_description' => 'このグループを削除してもよろしいですか？一度削除された情報は復旧することはできません。',
    ],
];
