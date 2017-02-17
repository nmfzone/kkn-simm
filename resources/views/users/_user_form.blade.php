<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">Username</label>

    <div class="col-md-6">
        @yield('input_username')

        @if ($errors->has('username'))
            <span class="help-block">
                <strong>{{ $errors->first('username') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">Nama</label>

    <div class="col-md-6">
        @yield('input_name')

        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
</div>

@if (Route::is('users.edit'))
  <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
      <label class="col-md-4 control-label">Password Sekarang</label>

      <div class="col-md-6">
          <input type="password" class="form-control" name="current_password">

          @if ($errors->has('current_password'))
              <span class="help-block">
                  <strong>{{ $errors->first('current_password') }}</strong>
              </span>
          @endif
      </div>
  </div>
@endif

<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">
      @if (Route::is('users.edit'))
        Password Baru
      @else
        Password
      @endif
    </label>

    <div class="col-md-6">
        <input type="password" class="form-control" name="password">

        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">Konfirmasi Password</label>

    <div class="col-md-6">
        <input type="password" class="form-control" name="password_confirmation">

        @if ($errors->has('password_confirmation'))
            <span class="help-block">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('photo') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">Foto Profil</label>

    <div class="col-md-6">
        <image-upload input-name="photo"></image-upload>

        @if ($errors->has('photo'))
            <span class="help-block">
                <strong>{{ $errors->first('photo') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('position') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">Posisi</label>

    <div class="col-md-6">
        @yield('input_position')

        @if ($errors->has('position'))
            <span class="help-block">
                <strong>{{ $errors->first('position') }}</strong>
            </span>
        @endif
    </div>
</div>

{!! csrf_field() !!}

@yield('optional')

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <a href="{{ URL::previous() }}" class="btn btn-default">{{ trans('message.back') }}</a>
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-btn fa-user"></i> @yield('submit_message')
        </button>
    </div>
</div>
