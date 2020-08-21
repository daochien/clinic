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
            @canany(['manager.index', 'role.index'])
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle " data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
                    <i class="fa fa-users nav-icon blue"></i>
                    <span>{{ __('sidebar.admin_manage') }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-small">
                    @can('manager.index')
                        <router-link to="/admin/manager" class="dropdown-item">
                            <span>{{ __('sidebar.admin_list_manage') }}</span>
                        </router-link>
                    @endcan
                    @can(['role.index','role.create', 'role.update'])
                        <router-link to="/admin/manager/roles" class="dropdown-item">
                            <span>{{ __('sidebar.role') }}</span>
                        </router-link>
                    @endcan
                </div>
            </li>
            @endcanany

            @canany(['user.index', 'clinic.index'])
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle " data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
                    <i class="far fa-address-book"></i>
                    <span>{{ __('sidebar.staff_manage') }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-small">
                    @can('clinic.index')
                        <router-link to="/admin/clinic" class="dropdown-item">
                            {{ __('sidebar.clinics') }}
                        </router-link>
                    @endcan
                    @can('user.index')
                        <router-link to="/admin/user" class="dropdown-item">
                            {{ __('sidebar.staff') }}
                        </router-link>
                    @endcan
                </div>
            </li>
            @endcanany

            @canany(['notification.index'])
            <li class="nav-item">
                <router-link to="/admin/notification" class="nav-link">
                    <i class="far fa-bell"></i>
                    <span>{{ __('sidebar.notification') }}</span>
                </router-link>
            </li>
            @endcanany

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle " data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
                    <i class="fas fa-clipboard-list"></i>
                    <span>{{ __('sidebar.request') }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-small">
                    {{--<router-link to="/admin/template" class="dropdown-item">
                        {{ __('sidebar.templates') }}
                    </router-link>--}}
                    <a href="/admin/template" class="dropdown-item">{{ __('sidebar.templates') }}</a>
                    {{--<router-link to="/admin/request" class="dropdown-item">
                        {{ __('sidebar.request') }}
                    </router-link>--}}
                </div>
            </li>
            {{--<li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle " data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
                    <i class="far fa-question-circle"></i>
                    <span>{{ __('sidebar.inquiry') }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-small">
                    <router-link to="/admin/inquiry" class="dropdown-item">
                        {{ __('sidebar.templates') }}
                    </router-link>
                    <router-link to="/admin/request" class="dropdown-item">
                        {{ __('sidebar.request') }}
                    </router-link>
                    <router-link to="/admin/inquiry" class="dropdown-item">
                        {{ __('sidebar.inquiry') }}
                    </router-link>
                </div>
            </li>--}}
            {{--<li class="nav-item">
                <router-link to="/admin/blog" class="nav-link">
                    <i class="fas fa-stream"></i>
                    <span>{{ __('sidebar.blog') }}</span>
                </router-link>
            </li>--}}
        {{-- <li class="nav-item">
                <router-link to="/admin/manuals" class="nav-link">
                    <i class="fa fa-users nav-icon blue"></i>
                    <span>{{ __('sidebar.manual') }}</span>
                </router-link>
            </li>--}}
        </ul>
    </div>
</aside>
