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
        '_og_title' => '友伸會ポータル管理画面｜問合せ管理・問合せ一覧',
        '_page_title' => '問合せ一覧',
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
            '_close_success' => '問合せをクローズしました。',
            '_close_failed' => '問合せのステータス変更に失敗しました。',
        ],
        'others' => [
            '_no_data' => '問合せが存在しません。',
            '_no_search_result' => '該当する問合せが存在しません。',
        ],
        'search' => [
            '_status' => 'ステータス',
            '_status_place_holder' => '全てのステータス',
            '_time_range' => '問合せ日付',
            '_keyword' => 'キーワード',
        ]
    ],
    'info' => [
        '_og_title' => '友伸會ポータル管理画面｜問合せ管理・問合せ詳細情報',
        '_page_title' => '問合せ詳細情報',
        'basic_info' => [
            '_subtitle' => '基本情報',
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
        '_title' => 'コメント',
        'form' => [
            '_input_comment_pl' => 'メッセージを入力してください'
            '_input_select_file_pl' => 'アップロードするファイルを選択、またはファイルをドラッグ＆ドロップします',
            '_input_drop_file_pl' => 'ここにファイルをドロップします。',
        ].
        'messages' => [
            '_comment_success' => 'コメント投稿が成功しました。'
            '_comment_failed' => 'コメント投稿に失敗しました。'
        ],
        'others' => [
            '_btn_comment' => '送信する',
            '_no_data' => '表示されるコメントはまだありません。',
        ].
    ],
    'others' => [
        '_close_modal_yes' => 'はい',
        '_close_modal_no' => 'いいえ',
        '_close_modal_title' => '問合せをクローズ',
        '_close_modal_description' => 'この問合せをクローズしてもよろしいですか？',
    ],
];
