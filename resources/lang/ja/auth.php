<?php
return [
    'attr' => [
        '_mail_address' => 'メールアドレス',
        '_password' => 'パスワード',
        '_new_password' => '新しいパスワード',
        '_confirm_password' => '新しいパスワード（確認用）',
    ],
    'login' => [
        '_og_title' => '友伸會ポータル管理画面',
        '_page_title' => '友伸會ポータル管理画面',
        'form' => [
            '_form_title' => 'ログイン',
        ],
        'messages' => [
            '_login_failed' => 'ログインに失敗しました。',
            '_login_banned' => 'ログインの試行回数が多すぎます。:seconds 秒後にお試しください。',
        ],
        'others' => [
            '_btn_login' => 'ログインする',
            '_link_forgot_password' => 'パスワードを忘れた方はこちら',
        ],
    ],
    'forgot_pwd' => [
        '_og_title' => '友伸會ポータル管理画面｜パスワード再設定',
        '_page_title' => '友伸會ポータル管理画面',
        'form' => [
            '_form_title' => 'パスワード再設定メール送信',
        ],
        'messages' => [
            '_send_mail_success' => 'パスワード再設定のメールを送信しました。',
            '_send_mail_failed' => 'パスワード再設定のメール送信に失敗しました。',
        ],
        'others' => [
            '_btn_send' => 'メールを送信する',
            '_link_back_to_login' => 'ログイン画面へ戻す',
        ],
    ],
    'reset_pwd' => [
        '_og_title' => '友伸會ポータル管理画面｜パスワード再設定',
        '_page_title' => '友伸會ポータル管理画面',
        'form' => [
            '_form_title' => 'パスワード再設定',
        ],
        'messages' => [
            '_send_mail_success' => 'パスワード再設定のメールを送信しました。',
            '_send_mail_failed' => 'パスワード再設定のメール送信に失敗しました。',
        ],
        'others' => [
            '_btn_reset' => 'パスワードを再設定する',
            '_link_back_to_login' => 'ログイン画面へ戻す',
        ],
    ],
];
