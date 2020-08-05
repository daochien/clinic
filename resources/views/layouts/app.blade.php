<!DOCTYPE html>
<html lang="en" class="no-js h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('app.name') }}</title>

    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <link href="{{ asset('css/shards-dashboards.1.3.1.css') }}" rel="stylesheet">
</head>
<body class="h-100">
<div id="app" class="container-fluid icon-sidebar-nav h-100">
    <div class="row">
        @yield('content')
    </div>
</div>
<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}
</body>
</html>
