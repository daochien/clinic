<?php 
return
[
    "title_page_list"=> "管理者アカウント管理",
    "title_page_create"=> "管理者アカウント発行",
    "title_page_edit"=> "管理者アカウント発行",
    "button_create"=> "新規登録",
    "form_filter"=> [
        "placeholder_input_keyword"=> "キーワードを入力してください",
        "select_all_roles"=> "全ての役割",
        "select_roles"=> "担当者の役割",
        "input_text_search"=> "キーワード",
        "button_clear"=> "条件をクリアする",
        "button_search"=> "この条件で検索"
    ],
    "table"=> [
        "name"=> "アカウント名",
        "email"=> "メールアドレス",
        "role"=> "役割",
        "note"=> "メモ",
        "last_login"=> "最終ログイン日時",
        "action"=> "操作",
        "action_edit"=> "編集する",
        "action_delete"=> "削除する"
    ],
    "form_create"=> [
        "title"=> "アカウント情報",
        "input_name"=> "アカウント名",
        "input_email"=> "メールアドレス",
        "role"=> "役割",
        "note"=> "メモ",
        "button_create"=> "登録",
        "button_edit"=> "保存",
        "button_remove"=> "アカウントを削除",
        "alert_create_success" => '新しい管理者を作成しました',
        "alert_edit_success" => '管理者の更新が成功しました',
        "alert_error" => 'エラーが発生しました！もう一度お試しください'
    ],
    "confirm_remove"=> [
        "title_remove"=> "管理者アカウントを削除しますか？",
        "content"=> "のアカウントを削除すると、メールアドレスとか申請データなどすべての情報が削除されます。",
        "button_cancel"=> "キャンセル",
        "button_success"=> "アカウントを削除"
    ],
    "validator"  => [
        "name_required" => '名前は必須です',
        'email_required' => 'メールが必要です',
        'email_valid' => '不正なメール形式',        
        "name_maxLength" => '名前は50文字以下にする必要があります',       
        'email_maxLength' => 'メールは255文字を超えることはできません',
        'note_maxLength' => '500文字を超えることはできません'
    ]
];
?>