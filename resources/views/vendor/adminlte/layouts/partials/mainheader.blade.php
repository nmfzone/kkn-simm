<header class="main-header">
  <a href="{{ route('dashboard.index') }}" class="logo">
    <span class="logo-mini"><b>G</b></span>
    <span class="logo-lg"><b>GunungGajah</b></span>
  </a>

  <nav class="navbar navbar-static-top" role="navigation">
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">{{ trans('adminlte_lang::message.togglenav') }}</span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        @if (Auth::guest())
          <li><a href="{{ url('/register') }}">{{ trans('auth.register') }}</a></li>
          <li><a href="{{ url('/login') }}">{{ trans('auth.login') }}</a></li>
        @else
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ Auth::user()->photo_url }}" class="user-image" alt="{{ Auth::user()->name }}"/>
              <span class="hidden-xs">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="{{ Auth::user()->photo_url }}" class="img-circle" alt="{{ Auth::user()->name }}"/>
                <p>
                  {{ Auth::user()->name }}
                  <small>{{ trans('auth.last_login') }} : {{ Auth::user()->last_login }}</small>
                </p>
              </li>

              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{ route('users.edit', Auth::user()->id) }}" class="btn btn-default btn-flat">{{ trans('adminlte_lang::message.profile') }}</a>
                </div>
                <div class="pull-right">
                  <a href="{{ url('/logout') }}" class="btn btn-default btn-flat"
                     onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                    {{ trans('adminlte_lang::message.signout') }}
                  </a>

                  <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                    <input type="submit" value="logout" style="display: none;">
                  </form>
                </div>
              </li>
            </ul>
          </li>
        @endif
      </ul>
    </div>
  </nav>
</header>
