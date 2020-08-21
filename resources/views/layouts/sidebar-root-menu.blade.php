<ul class="nav nav--no-borders flex-column">

    {{-- @canany(['manager.index', 'role.index']) --}}
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle " data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
            <i class="fa fa-users nav-icon blue"></i>
            <span>{{ __('sidebar.admin_manage') }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-small">
            {{-- @can('manager.index') --}}
                <router-link to="/admin/manager" class="dropdown-item">
                    <span>{{ __('sidebar.admin_list_manage') }}</span>
                </router-link>
            {{-- @endcan --}}
            {{-- @can(['role.index','role.create', 'role.update']) --}}
                <router-link to="/admin/role" class="dropdown-item">
                    <span>{{ __('sidebar.role') }}</span>
                </router-link>
            {{-- @endcan --}}
        </div>
    </li>
    {{-- @endcanany --}}

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle " data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
            <i class="far fa-address-book"></i>
            <span>{{ __('sidebar.staff_manage') }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-small">
            <router-link to="/admin/clinic" class="dropdown-item">
                {{ __('sidebar.clinics') }}
            </router-link>
            <router-link to="/admin/user" class="dropdown-item">
                {{ __('sidebar.staff') }}
            </router-link>
        </div>
    </li>
    <li class="nav-item">
        <router-link to="/admin/notification" class="nav-link">
            <i class="far fa-bell"></i>
            <span>{{ __('sidebar.notification') }}</span>
        </router-link>
    </li>
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
    </li>
    <li class="nav-item">
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
