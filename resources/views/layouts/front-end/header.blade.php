<header>
    <button class="btn btn-menu-display">
      <span>Menu</span>
    </button>
    <div class="col-left">
      <h1><a class="pl-0" href="/notification"><img src="/images/logo/yuushinkai-forum_logo.jpg" style="max-height: 79px" alt=""> Portal</a></h1>
    </div>
    <div class="header-menu">
      <ul>
        <li class="visible-xs">
          <a href="javascript:void();" class="search-mobile">
            <span class="close"></span>
          </a>
        </li>
      <li class="{{ request()->routeIs('blog*') ? 'active' : '' }}">
          <a href="/blogs" class="btn">
            <img src="/front-end/images/blog-icon.png" alt="Notification"> 記事
          </a>
        </li>
        <li class="{{ request()->routeIs('notification*') ? 'active' : '' }}">
          <a href="/notification" class="btn">
            <img src="/front-end/images/notification-icon.png" alt="Notification"> お知らせ
          </a>
        </li>
        <li class="user">
            <div class="dropdown">
                <a class="btn" href="#" role="button" data-toggle="dropdown">
                    <img src="/front-end/images/user-icon.png" alt="拠点ユーザー"> 拠点ユーザー
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="/my-account"  class="dropdown-item pb-2">
                        マイアカウント<img src="/images/user-profile-icon.png" alt="マイアカウント">
                    </a>
                    <a class="dropdown-item" href="#"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        ログアウト
                        <img src="/front-end/images/logout.png">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </a>
                </div>
            </div>
        </li>
      </ul>
    </div>
  </header>
