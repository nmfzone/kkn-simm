<aside class="main-sidebar">
  <section class="sidebar">
    @if (! Auth::guest())
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ Auth::user()->photo_url }}" class="img-circle" alt="User Image" />
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}</a>
        </div>
      </div>
    @endif

    <ul class="sidebar-menu">
      <li class="header">{{ trans('message.sidebar_header') }}</li>
      <li class="active"><a href="{{ route('dashboard.index') }}"><i class='fa fa-home'></i> <span>{{ trans('message.home') }}</span></a></li>
      @can('users.view')
        <li class="treeview">
          <a href="#"><i class='fa fa-users'></i> <span>{{ trans('message.users.manage') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li><a href="{{ route('users.index') }}">{{ trans('message.users.list') }}</a></li>
            <li><a href="{{ route('users.create') }}">{{ trans('message.users.create') }}</a></li>
          </ul>
        </li>
      @endcan
      @can('family_cards.manage')
        <li class="treeview">
          <a href="#"><i class='fa fa-credit-card'></i> <span>{{ trans('message.family_cards.manage') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li><a href="{{ route('family_cards.index') }}">{{ trans('message.family_cards.list') }}</a></li>
            <li><a href="{{ route('family_cards.create') }}">{{ trans('message.family_cards.create') }}</a></li>
          </ul>
        </li>
      @endcan
      @can('residents.manage')
        <li class="treeview">
          <a href="#"><i class='fa fa-credit-card'></i> <span>{{ trans('message.residents.manage') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li><a href="{{ route('residents.index') }}">{{ trans('message.residents.list') }}</a></li>
            <li><a href="{{ route('residents.create') }}">{{ trans('message.residents.create') }}</a></li>
          </ul>
        </li>
      @endcan
      @can('settings.manage')
        <li><a href="{{ route('settings.index') }}"><i class='fa fa-gear'></i> <span>{{ trans('message.settings.manage') }}</span></a></li>
      @endcan
    </ul><!-- /.sidebar-menu -->
  </section><!-- /.sidebar -->
</aside>
