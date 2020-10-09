<!DOCTYPE html>
<html lang="en" class="no-js h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="locale" content="{{ App::getLocale() }}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('app.name') }}</title>

    <link rel="icon" type="image/png" href="/front-end/images/logo.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/shards-dashboards.1.3.1.css') }}" rel="stylesheet">
    <style>
        .custorm-item{
            border-left:4px solid #FFFFFF;
        }

        .dropdown-item.active, .dropdown-item:active{
            color:#3D5170 !important;
            background:#FFFFFF !important;
            border-left:4px solid #FFFFFF !important;
        }

        .collapse .active{
            border-left:4px solid #FFFFFF !important; 
        }

        .dropdown-item{
            border-bottom: 1px solid #f0f2f5;
        }

        .nav .active{
            border-left:4px solid #007BFF; 
        }

        .custorm-item a{
            font-weight: 400;
            color: #3D5170;
            padding: 0.9375rem 1.5625rem;
        }

        .custorm-item i{
            min-width: 1.25rem;
            font-size: 90%;
            text-align: center;
            vertical-align: middle;
            will-change: color;
            color: #CACEDB;
            transition: color 200ms ease;
            margin-right: 0.375rem;
        }

        .custorm-item:hover{
            background:#FBFBFB;
            border-left:4px solid #007BFF;
        }
    </style>
</head>
<body class="h-100">
<div class="container-fluid" id="app">
    <div class="row">
        <!-- Sidebar Menu -->
        @include('layouts.sidebar-menu')
        <!-- /.sidebar-menu -->

        {{-- Content Wrapper. Contains page content --}}
        <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
            <div class="main-navbar sticky-top bg-white">
                <!-- Main Navbar -->
                <nav class="navbar align-items-stretch navbar-light flex-md-nowrap p-0">
                    <div class="main-navbar__search w-100 d-none d-md-flex d-lg-flex">
                        <div class="input-group input-group-seamless ml-3">
                            <Breadcrumbs/>
                        </div>
                    </div>
                    <ul class="navbar-nav border-left flex-row ">
                        <li class="nav-item dropdown">
                            <a class="top-nav nav-link dropdown-toggle text-nowrap px-3" data-toggle="dropdown" href="#"
                               role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="d-none d-md-inline-block">{{ Auth::user()->name }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-small top-menu">
                                <router-link to="/admin/profile" class="dropdown-item">
                                    <span>{{ __('app.menu.top._profile') }}</span>
                                </router-link>
                                <a class="dropdown-item text-danger" href="#"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="material-icons text-danger">&#xE879;</i>
                                    {{ __('app.menu.top._logout') }}
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </a>

                            </div>
                        </li>
                    </ul>
                    <nav class="nav">
                        <a href="#"
                           class="nav-link nav-link-icon toggle-sidebar d-sm-inline d-md-none text-center border-left"
                           data-toggle="collapse" data-target=".header-navbar" aria-expanded="false"
                           aria-controls="header-navbar">
                            <i class="material-icons">&#xE5D2;</i>
                        </a>
                    </nav>
                </nav>
            </div> <!-- / .main-navbar -->

            <div class="main-content-container container-fluid px-4">
                <router-view :key="$route.fullPath"></router-view>
                <vue-progress-bar></vue-progress-bar>
                {{-- /.content --}}
            </div>
        </main>
    </div>
</div>
{{-- /.content-wrapper --}}

</div>
{{-- ./wrapper --}}

@auth
    <script>
        {{--window.user = @json(auth()->user())--}}
            window.user = @json(\App\Models\User::where('id', auth()->user()->id)->with(['typeUsers.type', 'roleUsers.role'])->first());
            window.user.is_root = '{!! auth()->user()->isRoot() !!}';
            window.user.roles = @json(auth()->user()->roles);
            window.user.permissions = @json(auth()->user()->getAllPermissions());
            window.user.posittion = @json(\App\Models\User::POSITTION);
            window.base_url = "{{config('app.url')}}"
    </script>
@endauth
<script src="{{ mix('/js/app.js') }}"></script>
<script src="{{ ('/js/toastr.min.js') }}"></script>
<script src='https://cdn.polyfill.io/v2/polyfill.min.js'></script>
<script>
$(function() {
  $('.link-active').parent().addClass('active');
});
</script>
{{--<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sharrre/2.0.1/jquery.sharrre.min.js"></script>
<script src="https://unpkg.com/shards-ui@latest/dist/js/shards.min.js"></script>--}}
{!! Toastr::message() !!}
</body>
</html>
