<?php
return [
    'attr' => [
        '_title' => '申請項目',
        '_category' => '申請項目',
        '_sender' => '申請者',
        '_status' => 'ステータス',
        'status' => [
            '_open' => '承認待ち',
            '_closed' => 'クローズする',
        ],
        '_all_approval' => '全員承認',
        '_approval_comment' => '承認欄',
        'approval_comment' => [
            '_yes' => 'あり',
            '_no' => 'なし',
        ],
    ],
    'list' => [
        '_og_title' => '友伸會ポータル管理画面｜申請管理・申請一覧',
        '_page_title' => '申請一覧',
        'search_box' => [
            '_status_df' => 'すべてのステータス',
        ],
        'data_table' => [
            '_requested_at' => '問合せ日',
            '_closed_at' => '最終回答日',
            '_status' => 'ステータス',
            '_username' => 'ユーザー名',
            '_title' => '題名',
            '_action' => '操作',
            'actions' => [
                '_act_show_details' => '詳細を見る',
                '_act_close' => 'クローズする',
            ],
        ],
        'messages' => [
            '_close_success' => '近い成功。',
            '_close_failed' => 'クローズに失敗しました。',
        ],
        'others' => [
            '_no_data' => '申請データが存在しません。',
            '_no_search_result' => '該当する申請データが存在しません。',
        ],
        'search' => [
            '_status' => 'ステータス',
            '_status_place_holder' => '全てのステータス',
            '_time_range' => '問合せ日付',
            '_keyword' => 'キーワード',
        ]
    ],
    'info' => [
        '_og_title' => '友伸會ポータル管理画面｜申請管理・申請詳細情報',
        '_page_title' => '問合せ詳細情報',
        'basic_info' => [
            '_subtitle' => '基本情報',
            '_approval_comment_pl' => '例）精算額など'
        ],
        'form' => [
            '_subtitle' => '問合せ内容',
            '_title' => '題名',
            '_content' => '内容',
        ],
        'reply_form' => [
            '_comment_pl' => 'コメントを入力してください'
        ],
        'others' => [
            '_btn_close' => 'クローズする',
        ],
    ],
    'discussion' => [
        '_title' => 'Discussion',
        '_comment_here' => 'ここにメッセージ',
        '_send' => '送信する',
        '_upload_placeholder' => 'Choose a file or drop it here...',
        '_upload_drop_placeholder' => 'Drop file here...',
        '_comment_success' => 'Comment success'
    ],
    'others' => [
        '_modal_no' => 'キャンセル',
        '_reject_modal_yes' => '承認する',
        '_reject_modal_title' => '申請を承認',
        '_reject_modal_description' => 'この申請を承認してもよろしいですか？',
        '_approve_modal_yes' => '却下する',
        '_approve_modal_title' => '申請を却下',
        '_approve_modal_description' => 'この申請を却下してもよろしいですか？',
        '_remove_modal_yes' => 'はい',
        '_remove_modal_no' => 'いいえ',
        '_remove_modal_title' => '申請テンプレートを削除',
        '_remove_modal_description' => 'このテンプレートを削除してもよろしいですか？一度削除された情報は復旧することはできません。',
    ],
];
