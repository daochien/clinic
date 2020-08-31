<!DOCTYPE html>
<html lang="en" class="no-js h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="locale" content="{{ App::getLocale() }}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('app.name') }}</title>

    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <link href="{{ asset('css/shards-dashboards.1.3.1.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/formbuilder/js/footable/css/footable.standalone.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/formbuilder/css/styles.css') }}{{ jazmy\FormBuilder\Helper::bustCache() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @stack('styles')
</head>
<body class="h-100">
<div class="container-fluid" id="app">
    <div class="row">
        <!-- Sidebar Menu -->
        <aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
            <div class="main-navbar">
                <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
                    <a class="navbar-brand w-100 mr-0" href="#" style="line-height: 25px;">
                        <div class="d-table m-auto">
                            <span class="d-none d-md-inline ml-1">{{ __('app.name') }}</span>
                        </div>
                    </a>
                    <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
                        <i class="material-icons"></i>
                    </a>
                </nav>
            </div>
            <form action="#" class="main-sidebar__search w-100 border-right d-sm-flex d-md-none d-lg-none">
                <div class="input-group input-group-seamless ml-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-search"></i>
                        </div>
                    </div>
                    <input class="navbar-search form-control" type="text" placeholder="Search for something..." aria-label="Search">
                </div>
            </form>
            <div class="nav-wrapper" style="overflow-y: auto;">
                <ul class="nav nav--no-borders flex-column">
                    <li class="nav-item">
                        <a href="/admin/user" class="nav-link">
                            <i class="fa fa-users nav-icon blue"></i>
                            <span>{{ __('sidebar.admin_manage') }}</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle " data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
                            <i class="far fa-address-book"></i>
                            <span>{{ __('sidebar.staff_manage') }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-small">
                            <a href="/admin/clinic" class="dropdown-item">
                                {{ __('sidebar.clinics') }}
                            </a>
                            <a href="/admin/user" class="dropdown-item">
                                {{ __('sidebar.staff') }}
                            </a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/notification" class="nav-link">
                            <i class="far fa-bell"></i>
                            <span>{{ __('sidebar.notification') }}</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle " data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
                            <i class="fas fa-clipboard-list"></i>
                            <span>{{ __('sidebar.request') }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-small show">
                            {{--<a href="/admin/template" class="dropdown-item">{{ __('sidebar.templates') }}</a>--}}
                            <a href="/admin/template" class="dropdown-item">
                                {{ __('sidebar.templates') }}
                            </a>
                            @foreach (\App\Models\TemplateCategory::getAll() as $category)
                                <a href="/admin/request/category/{{$category->id}}" class="dropdown-item">
                                    {{ __($category->name) }}
                                </a>
                            @endforeach
                        </div>
                    </li>
                </ul>

            </div>
        </aside>
        <!-- /.sidebar-menu -->

        {{-- Content Wrapper. Contains page content --}}
        <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
            <div class="main-navbar sticky-top bg-white">
                <!-- Main Navbar -->
                <div class="main-navbar__search w-100 d-none d-md-flex d-lg-flex">
                    <div class="input-group input-group-seamless ml-3">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/admin/template"class="router-link-exact-active router-link-active">申請管理</a>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="router-link-exact-active router-link-active"> {{$breadCrumbTitle ?? '' }}</span>
                            </li>
                        </ol>
                    </div>
                </div>
            </div> <!-- / .main-navbar -->

            <div class="main-content-container container-fluid px-4">
                <router-view></router-view>
                <vue-progress-bar></vue-progress-bar>
                <section class="content">
                    @yield('content')
                </section>
                {{-- /.content --}}
            </div>
        </main>
    </div>
</div>
{{-- /.content-wrapper --}}

</div>
{{-- ./wrapper --}}

<script src="{{ mix('/js/app.js') }}"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sharrre/2.0.1/jquery.sharrre.min.js"></script>
<script src="https://unpkg.com/shards-ui@latest/dist/js/shards.min.js"></script>

<script type="text/javascript">
    window.FormBuilder = {
        csrfToken: '{{ csrf_token() }}',
    }
</script>
<script src="{{ asset('vendor/formbuilder/js/jquery-ui.min.js') }}" defer></script>
<script src="{{ asset('vendor/formbuilder/js/sweetalert.min.js') }}" defer></script>
<script src="{{ asset('vendor/formbuilder/js/jquery-formbuilder/form-builder.min.js') }}" defer></script>
<script src="{{ asset('vendor/formbuilder/js/jquery-formbuilder/form-render.min.js') }}" defer></script>
<script src="{{ asset('vendor/formbuilder/js/parsleyjs/parsley.min.js') }}" defer></script>
<script src="{{ asset('vendor/formbuilder/js/clipboard/clipboard.min.js') }}?b=ck24" defer></script>
<script src="{{ asset('vendor/formbuilder/js/moment.js') }}"></script>
<script src="{{ asset('vendor/formbuilder/js/footable/js/footable.min.js') }}" defer></script>
<script src="{{ asset('vendor/formbuilder/js/script.js') }}{{ jazmy\FormBuilder\Helper::bustCache() }}" defer></script>

@stack('fb-scripts')
@yield('page-js-files')
@yield('page-js-script')
</body>
</html>
