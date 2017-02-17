<!DOCTYPE html>
<html lang="en">

@section('htmlheader')
  @include('adminlte::layouts.partials.htmlheader')
@show

<body class="skin-purple sidebar-mini">
  <div id="app">
    <div class="wrapper">
      @include('adminlte::layouts.partials.mainheader')

      @include('adminlte::layouts.partials.sidebar')

      <div class="content-wrapper">
        @if(! Route::is('dashboard.index'))
          @include('adminlte::layouts.partials.contentheader')
        @endif

        <section class="content">
          @yield('main-content')
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      @include('adminlte::layouts.partials.footer')
    </div><!-- ./wrapper -->
  </div>

  @section('scripts')
    @include('adminlte::layouts.partials.scripts')
  @show

</body>
</html>
