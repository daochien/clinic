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
    <meta property="og:image" content="">
    <meta property="og:description" content="">
    <meta name="keywords" content="">

    <link rel="icon" type="image/png" href="/front-end/images/logo.png">
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
