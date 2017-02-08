@extends('adminlte::layouts.auth')

@section('htmlheader_title')
    {{ trans('auth.register') }}
@endsection

@section('content')
  <body class="hold-transition register-page">
      <div id="app">
          <div class="register-box">
              <div class="register-logo">
                <a href="{{ url('/home') }}">
                  <b>SIM</b><br />Gunung Gajah
                </a>
              </div>

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

              <div class="register-box-body">
                  <p class="login-box-msg">Register</p>
                  <form action="{{ url('/register') }}" method="post">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <div class="form-group has-feedback">
                          <input type="text" class="form-control" placeholder="Name" name="name" value="{{ old('name') }}"/>
                          <span class="glyphicon glyphicon-user form-control-feedback"></span>
                      </div>
                      <div class="form-group has-feedback">
                          <input type="text" class="form-control" placeholder="Username" name="username" value="{{ old('username') }}"/>
                          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                      </div>
                      <div class="form-group has-feedback">
                          <input type="password" class="form-control" placeholder="Password" name="password"/>
                          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                      </div>
                      <div class="form-group has-feedback">
                          <input type="password" class="form-control" placeholder="Password Confirmation" name="password_confirmation"/>
                          <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                      </div>
                      <div class="row">
                          <div class="col-xs-4">
                              <button type="submit" class="btn btn-primary btn-block btn-flat">{{ trans('auth.register') }}</button>
                          </div><!-- /.col -->
                      </div>
                  </form>

                  <a href="{{ url('/login') }}" class="text-center m-t-30">{{ trans('auth.login') }}</a>
              </div><!-- /.form-box -->
          </div><!-- /.register-box -->
      </div>

      @include('adminlte::layouts.partials.scripts_auth')

      <script>
          $(function () {
              $('input').iCheck({
                  checkboxClass: 'icheckbox_square-blue',
                  radioClass: 'iradio_square-blue',
                  increaseArea: '20%' // optional
              });
          });
      </script>

  </body>
@endsection
