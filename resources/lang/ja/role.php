<?php
return [
    'attr' => [
        '_name' => '役割',
        '_permission' => '権限',
    ],
    'list' => [
        '_og_title' => '友伸會ポータル管理画面｜管理者アカウント管理・管理者役割一覧',
        '_page_title' => '管理者役割一覧',
        'data_table' => [
            'actions' => [
                '_act_edit' => '編集する',
                '_act_remove' => '削除する',
            ],
        ],
        'messages' => [
            '_remove_success' => '管理者役割の削除が成功しました。',
            '_remove_failed' => '管理者役割の削除に失敗しました。',
        ],
        'others' => [
            '_btn_create' => '新規役割登録',
            '_no_data' => '管理者役割が存在しません。',
        ],
    ],
    'info' => [
        '_og_title_create' => '友伸會ポータル管理画面｜管理者アカウント管理・新規役割登録',
        '_og_title_edit' => '友伸會ポータル管理画面｜管理者アカウント管理・管理者役割編集',
        '_page_title_create' => '新規役割登録',
        '_page_title_edit' => '管理者役割編集',
        'form' => [
            '_form_title' => '管理者役割情報',
            '_name_pl' => '管理者役割の名前を入力してください',
            'permission_data' => [
                '_feature_list' => '機能一覧',
                '_all_permission' => 'すべての権限',
                '_read' => '読み取り',
                '_create' => '作成',
                '_update' => '更新',
                '_remove' => '削除',
                'features' => [
                    '_admin_management' => '管理者アカウント管理',
                    '_role_management' => '管理者役割管理',
                    '_clinic_management' => 'クリニック管理',
                    '_group_management' => 'グループ管理',
                    '_staff_management' => 'スタッフ管理',
                    '_notification_management' => 'お知らせ管理',
                    '_request_management' => '申請管理',
                    '_request_template_management' => '申請テンプレート管理',
                    '_inquiry_management' => '問合せ管理',
                    '_page_management' => 'ページ管理',
                ],
            ],
        ],
        'messages' => [
            '_create_success' => '管理者役割の登録が成功しました。',
            '_create_failed' => '管理者役割の登録に失敗しました。',
            '_edit_success' => '管理者役割の編集が成功しました。',
            '_edit_failed' => '管理者役割の編集に失敗しました。',
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
        '_remove_modal_title' => '管理者役割を削除',
        '_remove_modal_description' => 'この管理者役割を削除してもよろしいですか？一度削除された情報は復旧することはできません。',
    ],

        "title_page"=> "役割管理",
        "button_create"=> "役割を編集",
        "button_edit"=> "役割を編集",
        "input_name"=> "名前の役割",
        "table"=> [
            "name"=> "名前グループの権限",
            "select_all"=> "権限ビューリスト",
            "permission_view_list"=> "リストを見る",
            "permission_create"=> '権限作成',
            "permission_update"=> '権限の更新',
            'permission_delete'=> '権限削除'
        ],
        "manage"=> [
            'name'=> '名前の役割',
            'created_at'=> 'で作成',
            'action'=> 'アクション'
        ],
        'staff_web' => 'Web',
        'staff_mobile' => 'Mobile',
        'web' => 'Web',
        'mobile' => 'Mobile'
    ];
?>
