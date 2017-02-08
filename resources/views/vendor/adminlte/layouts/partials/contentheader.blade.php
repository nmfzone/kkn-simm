<section class="content-header">
  <div class="col-md-12">
    <h1>
      @yield('contentheader_title', 'Page Header')
      <small>@yield('contentheader_description')</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> {{ trans('adminlte_lang::message.level') }}</a></li>
      <li class="active">{{ trans('adminlte_lang::message.here') }}</li>
    </ol>
  </div>
</section>
