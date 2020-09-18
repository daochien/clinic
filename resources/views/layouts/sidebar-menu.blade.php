<aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
    <div class="main-navbar">
        <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
            <a class="navbar-brand w-100 mr-0" href="/admin/profile" style="line-height: 25px;">
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
                    <span>{{ __('app.menu.sidebar.admin_management._main') }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-small">
                    @can('manager.index')
                        <router-link to="/admin/manager" class="dropdown-item" onclick="$('.dropdown').removeClass('active');$(this).parent().parent().addClass('active');">
                            <span>{{ __('app.menu.sidebar.admin_management._admin_list') }}</span>
                        </router-link>
                    @endcan
                    @can(['role.index','role.store', 'role.update'])
                        <router-link to="/admin/manager/roles" class="dropdown-item" onclick="$('.dropdown').removeClass('active');$(this).parent().parent().addClass('active');">
                            <span>{{ __('app.menu.sidebar.admin_management._role_list') }}</span>
                        </router-link>
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
                        <router-link to="/admin/clinic" class="dropdown-item " onclick="$('.dropdown').removeClass('active');$(this).parent().parent().addClass('active');">
                            {{ __('app.menu.sidebar.staff_management._clinic_list') }}
                        </router-link>
                    @endcan

                    @can('group.index')
                        <router-link to="/admin/group" class="dropdown-item " onclick="$('.dropdown').removeClass('active');$(this).parent().parent().addClass('active');">
                            {{ __('app.menu.sidebar.staff_management._group_list') }}
                        </router-link>
                    @endcan

                    @can('user.index')
                        <router-link to="/admin/user" class="dropdown-item" onclick="$('.dropdown').removeClass('active');$(this).parent().parent().addClass('active');">
                            {{ __('app.menu.sidebar.staff_management._staff_list') }}
                        </router-link>
                    @endcan
                </div>
            </li>
            @endcanany

            @canany(['notification.index'])
            <li class="nav-item">
                <router-link to="/admin/notification" class="nav-link"  onclick="$('.dropdown').removeClass('active');$(this).addClass('active');">
                    <i class="far fa-bell"></i>
                    <span>{{ __('app.menu.sidebar.notification_management._main') }}</span>
                </router-link>
            </li>
            @endcanany
            @canany(['template.index', 'api.request.list'])
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle " data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
                    <i class="fas fa-clipboard-list"></i>
                    <span>{{ __('app.menu.sidebar.request_management._main') }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-small">
                    @can('template.index')
                    <router-link to="/admin/template" class="dropdown-item " onclick="$('.dropdown').removeClass('active');$(this).parent().parent().addClass('active');">
                        {{ __('app.menu.sidebar.request_management._request_template_list') }}
                    </router-link>
                    @endcan

                    @can('api.request.list')
                    @foreach (\App\Models\TemplateCategory::getAll() as $category)
                        <router-link to="/admin/request/category/{{$category->id}}" class="dropdown-item" onclick="$('.dropdown').removeClass('active');$(this).parent().parent().addClass('active');">
                            {{ __($category->name) }}
                        </router-link>
                    @endforeach
                    @endcan
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
                                <router-link to="/admin/inquiry/category/{{$category->id}}" class="dropdown-item" onclick="$('.dropdown').removeClass('active');$(this).parent().parent().addClass('active');">
                                    {{ __($category->name) }}
                                </router-link>
                            @endforeach
                        @endcan
                    </div>
                </li>
            @endcanany
            @can('page.index')
            <li class="nav-item">
                <router-link to="/admin/page" class="nav-link" onclick="$('.dropdown').removeClass('active');$(this).addClass('active');">
                    <i class="far">
                        <svg style="margin-top: -5px;" width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M17.5 4.16667L17.5 15.8333C17.5 16.75 16.75 17.5 15.8333 17.5L4.16667 17.5C3.25 17.5 2.5 16.75 2.5 15.8333L2.5 4.16667C2.5 3.25 3.25 2.5 4.16667 2.5L15.8333 2.5C16.75 2.5 17.5 3.25 17.5 4.16667ZM4.16667 15.8333L4.16667 4.16667L15.8333 4.16667L15.8333 15.8333L4.16667 15.8333ZM5.83334 10.8333L5.83334 9.16667L14.1667 9.16667L14.1667 10.8333L5.83334 10.8333ZM5.83333 7.5L5.83333 5.83333L11.6667 5.83333L11.6667 7.5L5.83333 7.5ZM5.83333 12.5L5.83333 14.1667L9.16667 14.1667L9.16667 12.5L5.83333 12.5Z" fill="#007BFF"/>
                        </svg>
                    </i>

                    <span>{{ __('app.menu.sidebar.page_management._main') }}</span>
                </router-link>
            </li>
            @endcan
        </ul>
    </div>
</aside>
