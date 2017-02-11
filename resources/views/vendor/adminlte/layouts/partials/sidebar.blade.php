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

    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="{{ trans('adminlte_lang::message.search') }}..."/>
        <span class="input-group-btn">
          <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
        </span>
      </div>
    </form>
    <!-- /.search form -->

    <ul class="sidebar-menu">
      <li class="header">{{ trans('message.sidebar_header') }}</li>
      <li class="active"><a href="{{ url('home') }}"><i class='fa fa-home'></i> <span>{{ trans('message.home') }}</span></a></li>
      <li class="treeview">
        <a href="#"><i class='fa fa-users'></i> <span>{{ trans('message.users.manage') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
          <li><a href="{{ route('users.index') }}">{{ trans('message.users.list') }}</a></li>
          <li><a href="{{ route('users.create') }}">{{ trans('message.users.create') }}</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#"><i class='fa fa-credit-card'></i> <span>{{ trans('message.family_cards.manage') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
          <li><a href="{{ route('family_cards.index') }}">{{ trans('message.family_cards.list') }}</a></li>
          <li><a href="{{ route('family_cards.create') }}">{{ trans('message.family_cards.create') }}</a></li>
        </ul>
      </li>
    </ul><!-- /.sidebar-menu -->
  </section><!-- /.sidebar -->
</aside>
