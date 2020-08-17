@component('mail::message')
# 【{{ config('app.name')}}】パスワード再発⾏のお知らせ
--------------------------------------
※本メールは【{{ config('app.name')}}】よりパスワード再発⾏⼿続きを希望された⽅にお送りしています。
--------------------------------------
パスワードが再発⾏されましたので、ご連絡いたします。

@component('mail::button', ['url' => $resetLink ])
ResetPassword
@endcomponent
{{ Lang::get('This password reset link will expire in :count minutes.',
['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')])}}

このパスワードは{サービス名}システムが⾃動的に発⾏したものですので、お早めにご変更ください。
ログインはこちら
{{ config('app.url')}}
【このメールにお当たりのない⽅へ】
もしお⼼当たりが無い場合は、その旨「{inquiry_mail_address}」までご連絡いただければ幸いです。

@endcomponent
