<!DOCTYPE html>
<html lang="en">
<head>
  <title>{{ __('app.name') }} | Pages </title>
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
  <link href="{{ ('/front-end/vendor/bootstrap-4.5.2-dist/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@1,900&display=swap" rel="stylesheet">
  <link href="{{ ('/front-end/vendor/slick-1.8.1/slick.css') }}" rel="stylesheet">
  <link href="{{ ('/front-end/css/style.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app" class="nav-wrapper">
        @include('layouts.front-end.header')
        <router-view ></router-view>
        <vue-progress-bar></vue-progress-bar>
    </div>
  <!-- Script -->
  <script src="{{ mix('/js/app.js') }}"></script>
  <script src="{{ ('/front-end/js/jquery.min.js') }}"></script>
  <script src="{{ ('/front-end/js/popper.min.js') }}"></script>
  <script src="{{ ('/front-end/vendor/bootstrap-4.5.2-dist/js/bootstrap.min.js') }}"></script>
  <script src="{{ ('/front-end/vendor/slick-1.8.1/slick.min.js') }}"></script>
  <script src="{{ ('/front-end/js/common.js') }}"></script>
  
</body>
</html>
