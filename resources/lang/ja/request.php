<?php 
return [
    'attr' => [
        '_title' => 'タイトル',
        '_category' => '申請項目',
        '_sender' => '申請者',
        '_approver' => '承認担当者',
        '_status' => 'ステータス',
        'statuses' => [
            '_open' => '承認待ち',
            '_in_progress' => '承認中',
            '_approved' => '承認済み',
            '_rejected' => '却下',
        ],
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
    'template' => [
        '_og_title' => '友伸會ポータル管理画面｜申請管理・申請テンプレート一覧',
        '_page_title' => '申請テンプレート一覧',
        'data_table' => [
            '_created_at' => '作成日時',
            'actions' => [
                '_act_edit' => '編集する',
                '_act_remvoe' => '削除する',
            ],
        ],
        'messages' => [
            '_remove_success' => '申請テンプレートの削除が成功しました。',
            '_remove_failed' => '申請テンプレートの削除に失敗しました。',
        ],
        'others' => [
            '_btn_create' => '新規テンプレート作成',
            '_no_data' => '申請テンプレートが存在しません。',
        ],
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
