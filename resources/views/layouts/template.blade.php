<!DOCTYPE html>
<html lang="en" class="no-js h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="locale" content="{{ App::getLocale() }}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('app.name') }}</title>

    <link rel="icon" type="image/png" href="/images/logo/favicon-32x32.png">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <link href="{{ asset('css/shards-dashboards.1.3.1.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/formbuilder/js/footable/css/footable.standalone.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/formbuilder/css/styles.css') }}{{ jazmy\FormBuilder\Helper::bustCache() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    @stack('styles')
</head>
<body class="h-100">
<div class="container-fluid" id="app">
    <div class="row">
        <!-- Sidebar Menu -->
        <aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
            <div class="main-navbar">
                <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
                    <a class="navbar-brand w-100 mr-0 pt-0" href="/admin/profile" style="line-height: 25px;">
                        <div class="d-table m-auto">
                            <img src="/images/logo/yuushinkai-forum_logo.jpg" style="max-width: 303px" alt="{{ __('app.name') }}">
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
                    @canany(['manager.index', 'role.index'])
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle " data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
                                <i class="fa fa-users nav-icon blue"></i>
                                <span>{{ __('app.menu.sidebar.admin_management._main') }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-small">
                                @can('manager.index')
                                    <a href="/admin/manager" class="dropdown-item">
                                        <span>{{ __('app.menu.sidebar.admin_management._admin_list') }}</span>
                                    </a>
                                @endcan
                                @can(['role.index','role.store', 'role.update'])
                                    <a href="/admin/manager/roles" class="dropdown-item">
                                        <span>{{ __('app.menu.sidebar.admin_management._role_list') }}</span>
                                    </a>
                                @endcan
                            </div>
                        </li>
                    @endcanany

                    @canany(['user.index', 'clinic.index'])
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle " data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
                                <i class="far fa-address-book"></i>
                                <span>{{ __('app.menu.sidebar.staff_management._main') }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-small" id="notClose">

                                @can('clinic.index')
                                    <a href="/admin/clinic" class="dropdown-item ">
                                        {{ __('app.menu.sidebar.staff_management._clinic_list') }}
                                    </a>
                                @endcan

                                @can('group.index')
                                    <a href="/admin/group" class="dropdown-item ">
                                        {{ __('app.menu.sidebar.staff_management._group_list') }}
                                    </a>
                                @endcan

                                @can('user.index')
                                    <a href="/admin/user" class="dropdown-item">
                                        {{ __('app.menu.sidebar.staff_management._staff_list') }}
                                    </a>
                                @endcan
                            </div>
                        </li>
                    @endcanany

                    @canany(['notification.index'])
                        <li class="nav-item">
                            <a href="/admin/notification" class="nav-link">
                                <i class="far fa-bell"></i>
                                <span>{{ __('app.menu.sidebar.notification_management._main') }}</span>
                            </a>
                        </li>
                    @endcanany
                    @canany(['template.index'])
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle " data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
                            <i class="fas fa-clipboard-list"></i>
                            <span>{{ __('app.menu.sidebar.request_management._main') }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-small show">
                            <a href="/admin/template" class="dropdown-item active">
                                {{ __('app.menu.sidebar.request_management._request_template_list') }}
                            </a>
                            @foreach (\App\Models\TemplateCategory::getAll() as $category)
                                <a href="/admin/request/category/{{$category->id}}" class="dropdown-item">
                                    {{ __($category->name) }} ({{$category->countRequestNeedProcess($category->id)}})
                                </a>
                            @endforeach
                        </div>
                    </li>
                    @endcanany
                    @canany(['inquiry.index', 'api.inquiry.list'])
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle " data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
                                <i class="fas fa-clipboard-list"></i>
                                <span>{{ __('app.menu.sidebar.inquiry_management._main') }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-small">
                                @can('api.inquiry.list')
                                    @foreach (\App\Models\Inquiry::allCategory() as $category)
                                        <a href="/admin/inquiry/category/{{$category->id}}" class="dropdown-item">
                                            {{ __($category->name) }} ({{$category->countInquiryNotClosed($category->id)}})
                                        </a>
                                    @endforeach
                                @endcan
                            </div>
                        </li>
                    @endcanany
                        <li class="nav-item">
                            <a href="/admin/page" class="nav-link">
                                <i class="far">
                                    <svg style="margin-top: -5px;" width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M17.5 4.16667L17.5 15.8333C17.5 16.75 16.75 17.5 15.8333 17.5L4.16667 17.5C3.25 17.5 2.5 16.75 2.5 15.8333L2.5 4.16667C2.5 3.25 3.25 2.5 4.16667 2.5L15.8333 2.5C16.75 2.5 17.5 3.25 17.5 4.16667ZM4.16667 15.8333L4.16667 4.16667L15.8333 4.16667L15.8333 15.8333L4.16667 15.8333ZM5.83334 10.8333L5.83334 9.16667L14.1667 9.16667L14.1667 10.8333L5.83334 10.8333ZM5.83333 7.5L5.83333 5.83333L11.6667 5.83333L11.6667 7.5L5.83333 7.5ZM5.83333 12.5L5.83333 14.1667L9.16667 14.1667L9.16667 12.5L5.83333 12.5Z" fill="#007BFF"/>
                                    </svg>
                                </i>

                                <span>{{ __('app.menu.sidebar.page_management._main') }}</span>
                            </a>
                        </li>
                </ul>

            </div>
        </aside>
        <!-- /.sidebar-menu -->

        {{-- Content Wrapper. Contains page content --}}
        <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
            <div class="main-navbar sticky-top bg-white">
                <!-- Main Navbar -->
                <nav class="navbar align-items-stretch navbar-light flex-md-nowrap p-0">
                    <div class="main-navbar__search w-100 d-none d-md-flex d-lg-flex">
                        <div class="input-group input-group-seamless ml-3">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/admin/template"class="a-exact-active a-active">申請管理</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <span class="a-exact-active a-active"> {{$breadCrumbTitle ?? '' }}</span>
                                </li>
                            </ol>
                        </div>
                    </div>
                    <ul class="navbar-nav border-left flex-row ">
                        <li class="nav-item dropdown">
                            <a class="top-nav nav-link dropdown-toggle text-nowrap px-3" data-toggle="dropdown" href="#"
                               role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="d-none d-md-inline-block">{{ Auth::user()->name }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-small">
                                <a href="/admin/profile" class="dropdown-item">
                                    <span>{{ __('app.menu.top._profile') }}</span>
                                </a>
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
<script src="{{ asset('vendor/formbuilder/js/sweetalert2.all.min.js') }}" defer></script>
<script src="{{ asset('vendor/formbuilder/js/jquery-formbuilder/form-builder.min.js') }}" defer></script>
<script src="{{ asset('vendor/formbuilder/js/jquery-formbuilder/form-render.min.js') }}" defer></script>
<script src="{{ asset('vendor/formbuilder/js/parsleyjs/parsley.min.js') }}" defer></script>
<script src="{{ asset('vendor/formbuilder/js/clipboard/clipboard.min.js') }}?b=ck24" defer></script>
<script src="{{ asset('vendor/formbuilder/js/moment.js') }}"></script>
<script src="{{ asset('vendor/formbuilder/js/footable/js/footable.min.js') }}" defer></script>
<script src="{{ asset('vendor/formbuilder/js/script.js') }}{{ jazmy\FormBuilder\Helper::bustCache() }}" defer></script>

<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
@stack('fb-scripts')
@yield('page-js-files')
@yield('page-js-script')
</body>
</html>
