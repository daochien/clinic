<?php
return [
    'attr' => [
        '_title' => 'タイトル',
        '_category' => '申請項目',
        '_sender' => '申請者',
        '_approver' => '承認担当者',
        '_status' => 'ステータス',
        'status' => [
            '_open' => '承認待ち',
            '_in_progress' => '承認中',
            '_approved' => '承認済み',
            '_rejected' => '却下',
        ],
        '_all_approval' => '全員承認',
        '_approval_comment' => '承認欄',
        'approval_comment' => [
            '_yes' => 'あり',
            '_no' => 'なし',
        ],
        '_memo' => 'メモ',
    ],
    'list' => [
        '_og_title' => '友伸會ポータル管理画面｜申請管理・申請一覧',
        '_page_title' => '申請一覧',
        'search_box' => [
            '_status_df' => 'すべてのステータス',
        ],
        'data_table' => [
            '_request_at' => '申請日時',
            '_last_approved_at' => '最終承認日時',
            '_action' => '操作',
            'actions' => [
                '_act_show_details' => '詳細を確認する',
                '_act_approve' => '承認する',
                '_act_reject' => '却下する',
            ],
        ],
        'messages' => [
            '_approve_success' => '申請承認が成功しました。',
            '_approve_failed' => '申請承認に失敗しました。',
            '_reject_success' => '申請ステータスの更新が成功しました。',
            '_reject_failed' => '申請ステータスの更新に失敗しました。',
        ],
        'others' => [
            '_no_data' => '申請データが存在しません。',
            '_no_search_result' => '該当する申請データが存在しません。',
        ],
    ],
    'info' => [
        '_og_title' => '友伸會ポータル管理画面｜申請管理・申請詳細情報',
        '_page_title' => '申請詳細情報',
        'basic_info' => [
            '_subtitle' => '基本情報',
            '_approval_comment_pl' => '例）精算額など'
        ],
        'form' => [
            '_subtitle' => '申請情報',
        ],
        'reply_form' => [
            '_comment_pl' => 'コメントを入力してください'
        ],
        'messages' => [
            '_approve_success' => '申請承認が成功しました。',
            '_approve_failed' => '申請承認に失敗しました。',
            '_reject_success' => '申請ステータスの更新が成功しました。',
            '_reject_failed' => '申請ステータスの更新に失敗しました。',
            '_reply_success' => '返信が成功しました。',
            '_reply_failed' => '返信に失敗しました。',
        ],
        'others' => [
            '_btn_approve' => '承認する',
            '_btn_reject' => '却下する',
            '_btn_reply' => '返信する',
        ],
    ],
    'discussion' => [
        '_title' => 'コメント',
        'form' => [
            '_input_comment_pl' => 'メッセージを入力してください',
            '_input_select_file_pl' => 'アップロードするファイルを選択、またはファイルをドラッグ＆ドロップします',
            '_input_drop_file_pl' => 'ここにファイルをドロップします。',
        ],
        'messages' => [
            '_comment_success' => 'コメント投稿が成功しました。',
            '_comment_failed' => 'コメント投稿に失敗しました。',
        ],
        'others' => [
            '_btn_comment' => '送信する',
            '_no_data' => '表示されるコメントはまだありません。',
        ],
    ],
    'template' => [
        'list' => [
            '_og_title_' => '友伸會ポータル管理画面｜申請管理・申請テンプレート一覧',
            '_page_title' => '申請テンプレート一覧',
            'data_table' => [
                '_created_at' => '作成日時',
                'actions' => [
                    '_act_edit' => '編集する',
                    '_act_remove' => '削除する',
                ],
            ],
            'messages' => [
                '_remove_success' => '申請テンプレートの削除が成功しました。',
                '_remove_failed' => '申請テンプレートの削除に失敗しました。',
            ],
            'others' => [
                '_btn_draft_save' => '下書きとして保存する',
                '_btn_create' => '新規テンプレート作成',
                '_no_data' => '申請テンプレートが存在しません。',
            ],
        ],
        'info' => [
            '_og_title_create' => '友伸會ポータル管理画面｜申請管理・新規テンプレート作成',
            '_og_title_create' => '友伸會ポータル管理画面｜申請管理・申請テンプレート編集',
            '_page_title_create' => '新規テンプレート作成',
            '_page_title_edit' => '申請テンプレート編集',
            'basic_form' => [
                '_subtitle' => '基本情報',
                '_title_pl' => '申請テンプレートのタイトルを入力してください',
                '_approver_pl' => '承認担当者のアカウント名を指定してください',
                '_category_df' => 'カテゴリーを選択してください',
                '_memo_pl' => 'メモを入力してください',
            ],
            'question_form' => [
                '_subtitle' => '申請情報',
                '_description' => '※右側の設問テンプレートから申請項目ゾーンにドラッグ・ドロップし、設問の詳細を定義してください。',
            ],
            'messages' => [
                '_create_success' => '新規申請テンプレートの作成が成功しました。',
                '_create_failed' => '新規申請テンプレートの作成に失敗しました。',
                '_edit_success' => '新規申請テンプレートの編集が成功しました。',
                '_edit_failed' => '新規申請テンプレートの編集に失敗しました。',
                '_draft_save_success' => '申請テンプレートのの下書き保存が成功しました。',
                '_draft_save_failed' => '申請テンプレートのの下書き保存に失敗しました。',
                '_delete_success' => '申請テンプレートの削除が成功しました。',
                '_delete_failed' => '申請テンプレートの削除に失敗しました。',
            ],
            'others' => [
                '_btn_draft_save' => '下書きとして保存',
                '_btn_create' => '作成する',
                '_btn_edit' => '編集する',
                '_no_data' => '申請テンプレートが存在しません。',
            ],
        ],
    ],
    'others' => [
        '_modal_no' => 'キャンセル',
        '_modal_yes' => 'はい',
        '_reject_modal_title' => '申請をリジェクト',
        '_reject_modal_description' => 'この申請をリジェクトしてもよろしいですか？',
        '_approve_modal_title' => '申請を承認',
        '_approve_modal_description' => 'この申請を却下してもよろしいですか？',
    ],
    'common' => [
        'number_file_upload_greater_than' => 'ファイルは５つまでアップロードしてください。',
    ]
];
