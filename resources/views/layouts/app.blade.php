<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
<head>
    <title>{{ __('app.name') }} </title>
    <meta name="locale" content="{{ App::getLocale() }}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:type" content="website">
    <meta property="og:title" content="">
    <meta property="og:site_name" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="/images/logo/favicon-16x16.png">
    <meta property="og:description" content="">
    <meta name="keywords" content="">

    <link rel="apple-touch-icon" sizes="57x57" href="/images/logo/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/images/logo/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/images/logo/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/images/logo/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/images/logo/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/images/logo/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/images/logo/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/images/logo/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/images/logo/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/images/logo/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/logo/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/images/logo/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/logo/favicon-16x16.png">

    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <link rel="icon" type="image/png" href="/images/logo/favicon-32x32.png">
    <link href="{{ ('/front-end/vendor/bootstrap-4.5.2-dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@1,900&display=swap" rel="stylesheet">
    <link href="{{ ('/front-end/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">
</head>
<body>
<div id="app" class="main-wrapper">
    @yield('content')
</div>
<!-- Script -->
<script src="{{ mix('/js/app.js') }}"></script>
<script src="{{ ('/front-end/vendor/bootstrap-4.5.2-dist/js/bootstrap.min.js') }}"></script>
<script src="{{ ('/js/toastr.min.js') }}"></script>
{!! Toastr::message() !!}
</body>
</html>
