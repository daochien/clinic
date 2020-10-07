<?php
return [
    'attr' => [
        '_title' => 'タイトル',
        '_target_users' => '送信対象者',
        '_confirm_required' => '承認必須',
        '_content' => '本文',
        '_public_at' => '公開日時',
        '_status' => 'ステータス',
        'status' => [
            '_draft' => '下書き',
            '_private' => '非公開',
            '_public' => '公開',
        ],
    ],
    'list' => [
        '_og_title' => '友伸會ポータル管理画面｜お知らせ管理・お知らせ一覧',
        '_page_title' => 'お知らせ一覧',
        'search_box' => [
            '_target_users_df' => 'すべてのスタッフ',
            '_public_date' => '公開日付',
            '_status' => '公開ステータス',
            '_status_df' => 'すべてのステータス',
        ],
        'data_table' => [
            '_sent_count' => '配送総数',
            '_read_count' => '既読数',
            '_confirmed_count' => '確認済人数',
            'actions' => [
                '_act_public' => 'お知らせを公開する',
                '_act_edit' => '編集する',
                '_act_remove' => '削除する',
                '_act_show_details' => '詳細を確認んする',
                '_act_show_list_user' => '送信対象者一覧を確認する',
            ],
        ],
        'messages' => [
            '_remove_success' => 'お知らせ削除が成功しました。',
            '_remove_failed' => 'お知らせ削除に失敗しました。',
            '_stt_update_success' => 'お知らせステータスの更新が成功しました。',
            '_stt_update_failed' => 'お知らせステータスの更新に失敗しました。',
        ],
        'others' => [
            '_btn_create' => '新規作成',
            '_no_data' => 'お知らせデータが存在しません。',
            '_no_search_result' => '該当するお知らせデータが存在しません。',
        ],
    ],
    'info' => [
        '_og_title' => '友伸會ポータル管理画面｜お知らせ管理・お知らせ作成',
        '_page_title' => 'お知らせ作成',
        '_page_title_edit' => 'お知らせ編集',
        'form' => [
            '_subtitle' => 'お知らせ情報',
            '_title_pl' => 'タイトルを入力してください',
            '_target_users_des' => '※拠点名、職業、及びユーザー名で入力することは可能です。',
            'target_user_opt' => [
                '_dr' => 'DR',
                '_dh' => 'DH',
                '_all' => '全クリニック',
                '_manual' => '対象者を指定する',
                '_manual_pl' => '送信対象者のユーザー名を入力してください',
            ],
        ],
        'messages' => [
            '_create_success' => 'お知らせ作成が成功しました。',
            '_create_failed' => 'お知らせ作成に失敗しました。',
            '_draft_save_success' => 'お知らせの下書き保存が成功しました。',
            '_draft_save_failed' => 'お知らせの下書き保存に失敗しました。',
        ],
        'others' => [
            '_btn_draft_save' => '下書きとして保存',
            '_btn_create' => '公開する',
            '_btn_remove' => '削除する',
        ],
    ],
    'noti_users' => [
        '_og_title' => '友伸會ポータル管理画面｜お知らせ管理・送信対象者一覧',
        '_page_title' => '送信対象者一覧',
        'attr' => [
            '_status' => 'ステータス',
            'status' => [
                '_unread' => '未読',
                '_read' => '既読',
                '_unconfirmed' => 'Unconfirmed',
                '_confirmed' => 'Confirmed',
            ],
        ],
        'search_box' => [
            '_status_df' => 'すべてのステータス',
        ],
        'data_table' => [
            '_confirmed_at' => '確認日時',
        ],
        'others' => [
            '_unconfirm' => '---',
            '_no_data' => '送信対象者が存在しません。',
            '_no_search_result' => '該当するユーザー情報が存在しません。',
        ],
    ],
    'others' => [
        '_remove_modal_yes' => 'はい',
        '_remove_modal_no' => 'いいえ',
        '_remove_modal_title' => 'お知らせを削除',
        '_remove_modal_description' => 'このお知らせを削除してもよろしいですか？一度削除されたお知らせは復旧することはできません。',
        'require_title' => 'Title is required',
        'require_group' => 'Group is required',
        'require_content' => 'Content is required',
        'schedule_date_lte_now' => 'Schedule date must be greater than now',
    ],
];
