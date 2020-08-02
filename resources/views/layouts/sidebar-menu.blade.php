<aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
    <div class="main-navbar">
        <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
            <a class="navbar-brand w-100 mr-0" href="#" style="line-height: 25px;">
                <div class="d-table m-auto">
                   <span class="d-none d-md-inline ml-1">{{ config('app.name', 'Clinic Portal') }}</span>
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
        @can('isAdmin')
        <ul class="nav nav--no-borders flex-column">
            <li class="nav-item">
                <router-link to="/admin/users" class="nav-link">
                    <i class="fa fa-users nav-icon blue"></i>
                    <span>Users</span>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link to="/admin/products" class="nav-link">
                    <i class="nav-icon fas fa-list orange"></i>
                    <span>
                        Product
                    </span>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link to="/admin/product/category" class="nav-link">
                    <i class="fa fa-users nav-icon blue"></i>
                    <span>Category</span>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link to="/admin/product/tag" class="nav-link">
                    <i class="fa fa-users nav-icon blue"></i>
                    <span>Tags</span>
                </router-link>
            </li>
        </ul>
        @endcan

    </div>
</aside>
