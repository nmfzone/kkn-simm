@extends('adminlte::layouts.auth')

@section('htmlheader_title')
    {{ trans('auth.login') }}
@endsection

@section('content')
  <body class="hold-transition login-page">
      <div id="app">
          <div class="login-box">
              <div class="login-logo">
                <a href="{{ url('/home') }}">
                  <b>SIM</b><br />GunungGajah
                </a>
              </div><!-- /.login-logo -->

          @if (count($errors) > 0)
              <div class="alert alert-danger">
                  <strong>Whoops!</strong> {{ trans('adminlte_lang::message.someproblems') }}<br><br>
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif

          <div class="login-box-body">
          <p class="login-box-msg"> {{ trans('auth.sigin_session') }} </p>
          <form action="{{ url('/login') }}" method="post">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="form-group has-feedback">
                  <input type="text" class="form-control" placeholder="Username" name="username" value="{{ old('username') }}" required autofocus />
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
              </div>
              <div class="form-group has-feedback">
                  <input type="password" class="form-control" placeholder="Password" name="password" required />
                  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              </div>
              <div class="row">
                  <div class="col-xs-8">
                      <div class="checkbox icheck">
                          <label>
                              <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ trans('auth.remember') }}
                          </label>
                      </div>
                  </div><!-- /.col -->
                  <div class="col-xs-4">
                      <button type="submit" class="btn btn-primary btn-block btn-flat">{{ trans('auth.login') }}</button>
                  </div><!-- /.col -->
              </div>
          </form>

      </div><!-- /.login-box-body -->

      </div><!-- /.login-box -->
      </div>
      @include('adminlte::layouts.partials.scripts_auth')

      <script>
          $(function () {
              $('input').iCheck({
                  checkboxClass: 'icheckbox_square-blue',
                  radioClass: 'iradio_square-blue',
                  increaseArea: '20%'
              });
          });
      </script>
  </body>
@endsection
