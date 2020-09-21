<header>
    <button class="btn btn-menu-display">
      <span>Menu</span>
    </button>
    <div class="col-left">
      <h1><a href="#"><img src="/front-end/images/logo.png" alt=""> Portal</a></h1>
    </div>
    <div class="header-menu">
      <ul>
        <li class="visible-xs">
          <a href="javascript:void();" class="search-mobile">
            <span class="close"></span>
          </a>
        </li>
      <li class="{{ request()->routeIs('blog*') ? 'active' : '' }}">
          <a href="{{ URL::to('blogs') }}" class="btn">
            <img src="/front-end/images/blog-icon.png" alt="Notification"> 記事
          </a>
        </li>
        <li class="{{ request()->routeIs('notification*') ? 'active' : '' }}">
          <a href="{{ URL::to('notification') }}" class="btn">
            <img src="/front-end/images/notification-icon.png" alt="Notification"> お知らせ
          </a>
        </li>
        <li class="user">
          <!-- <a href="#"><img src="/front-end/images/user-icon.png" alt=""> Login</a> -->
{{--            <a href="#"><img src="/front-end/images/user-icon.png" alt="User"> 拠点ユーザー</a>--}}
            <a href="#"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <img src="/front-end/images/user-icon.png" alt="User">
                拠点ユーザー
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </a>
        </li>
      </ul>
    </div>
  </header>
