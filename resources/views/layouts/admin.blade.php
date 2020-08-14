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
    <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/formbuilder/js/footable/css/footable.standalone.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/formbuilder/css/styles.css') }}{{ jazmy\FormBuilder\Helper::bustCache() }}">
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
                    <form action="#" class="main-navbar__search w-100 d-none d-md-flex d-lg-flex">
                        <div class="input-group input-group-seamless ml-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-search"></i>
                                </div>
                            </div>
                            <input class="navbar-search form-control" type="text" placeholder="Search for something..."
                                   aria-label="Search">
                        </div>
                    </form>
                    <ul class="navbar-nav border-left flex-row ">
                        {{--<li class="nav-item border-right dropdown notifications">
                            <a class="nav-link nav-link-icon text-center" href="#" role="button" id="dropdownMenuLink"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="nav-link-icon__wrapper">
                                    <i class="material-icons">&#xE7F4;</i>
                                    <span class="badge badge-pill badge-danger">2</span>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-small" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="#">
                                    <div class="notification__icon-wrapper">
                                        <div class="notification__icon">
                                            <i class="material-icons">&#xE6E1;</i>
                                        </div>
                                    </div>
                                    <div class="notification__content">
                                        <span class="notification__category">Analytics</span>
                                        <p>Your website’s active users count increased by <span
                                                class="text-success text-semibold">28%</span> in the last week. Great
                                            job!</p>
                                    </div>
                                </a>
                                <a class="dropdown-item" href="#">
                                    <div class="notification__icon-wrapper">
                                        <div class="notification__icon">
                                            <i class="material-icons">&#xE8D1;</i>
                                        </div>
                                    </div>
                                    <div class="notification__content">
                                        <span class="notification__category">Sales</span>
                                        <p>Last week your store’s sales count decreased by <span
                                                class="text-danger text-semibold">5.52%</span>. It could have been
                                            worse!</p>
                                    </div>
                                </a>
                                <a class="dropdown-item notification__all text-center" href="#"> View all
                                    Notifications </a>
                            </div>
                        </li>--}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-nowrap px-3" data-toggle="dropdown" href="#"
                               role="button" aria-haspopup="true" aria-expanded="false">
{{--                                <img class="user-avatar rounded-circle mr-2" src="{{ auth()->user()->photo }}" alt="User Avatar"> --}}
                                <span class="d-none d-md-inline-block">{{ Auth::user()->name }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-small">
                                <router-link to="/profile" class="dropdown-item">
                                    <i class="material-icons">&#xE7FD;</i>
                                    Profile
                                </router-link>
                                <a class="dropdown-item text-danger" href="#"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="material-icons text-danger">&#xE879;</i>
                                    {{ __('Logout') }}
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
                <router-view></router-view>
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
            window.user = @json(\App\Models\User::where('id', auth()->user()->id)->with(['typeUsers.type', 'roleUsers.role'])->first())
    </script>
@endauth
<script src="{{ mix('/js/app.js') }}"></script>
<script src="{{ ('/js/toastr.min.js') }}"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sharrre/2.0.1/jquery.sharrre.min.js"></script>
<script src="https://unpkg.com/shards-ui@latest/dist/js/shards.min.js"></script>
{!! Toastr::message() !!}
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
</body>
</html>
