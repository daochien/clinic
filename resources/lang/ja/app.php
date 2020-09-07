<?php
return [
    'name' => '友伸會ポータル管理画面',
    'menu' => [
        'top' => [
            '_logout' => 'ログアウト',
        ],
        'sidebar' => [
            'admin_management' => [
                '_main' => '管理者アカウント管理',
                '_admin_list' => '管理者一覧',
                '_role_list' => '管理者役割一覧',
            ],
            'staff_management' => [
                '_main' => 'スタッフ管理',
                '_clinic_list' => 'クリニック一覧',
                '_staff_list' => 'スタッフ一覧',
                '_group_list' => 'グループ一覧',
            ],
            'notification_management' => [
                '_main' => 'お知らせ管理',
            ],
            'request_management' => [
                '_main' => '申請管理',
                '_request_template_list' => '申請テンプレート一覧',
            ],
            'inquiry_management' => [
                '_main' => '問合せ管理',
            ],
            'page_management' => [
                '_main' => 'ページ管理',
            ],
        ]
    ],
];
