@section('stylesheets')
  <link href="{{ asset('/plugins/datepicker/datepicker3.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

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

<div class="form-group{{ $errors->has('nik') ? ' has-error' : '' }}">
  <label class="col-md-4 control-label">NIK</label>

  <div class="col-md-6">
    @yield('input_nik')

    @if ($errors->has('nik'))
      <span class="help-block">
        <strong>{{ $errors->first('nik') }}</strong>
      </span>
    @endif
  </div>
</div>

<div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
  <label class="col-md-4 control-label">Jenis Kelamin</label>

  <div class="col-md-6">
    @yield('input_gender')

    @if ($errors->has('gender'))
      <span class="help-block">
        <strong>{{ $errors->first('gender') }}</strong>
      </span>
    @endif
  </div>
</div>

<div class="form-group{{ $errors->has('marital_status') ? ' has-error' : '' }}">
  <label class="col-md-4 control-label">Status Perkawinan</label>

  <div class="col-md-6">
    @yield('input_marital_status')

    @if ($errors->has('marital_status'))
      <span class="help-block">
        <strong>{{ $errors->first('marital_status') }}</strong>
      </span>
    @endif
  </div>
</div>

<div class="form-group{{ $errors->has('hometown_id') ? ' has-error' : '' }}">
  <label class="col-md-4 control-label">Tempat Lahir</label>

  <div class="col-md-6">
    @yield('input_hometown')

    @if ($errors->has('hometown_id'))
      <span class="help-block">
        <strong>{{ $errors->first('hometown_id') }}</strong>
      </span>
    @endif
  </div>
</div>

<div class="form-group{{ $errors->has('date_of_birth') ? ' has-error' : '' }}">
  <label class="col-md-4 control-label">Tanggal Lahir</label>

  <div class="col-md-6">
    @yield('input_date_of_birth')

    @if ($errors->has('date_of_birth'))
      <span class="help-block">
        <strong>{{ $errors->first('date_of_birth') }}</strong>
      </span>
    @endif
  </div>
</div>

<div class="form-group{{ $errors->has('education_id') ? ' has-error' : '' }}">
  <label class="col-md-4 control-label">Pendidikan</label>

  <div class="col-md-6">
    @yield('input_education')

    @if ($errors->has('education_id'))
      <span class="help-block">
        <strong>{{ $errors->first('education_id') }}</strong>
      </span>
    @endif
  </div>
</div>

<div class="form-group{{ $errors->has('job_id') ? ' has-error' : '' }}">
  <label class="col-md-4 control-label">Pekerjaan</label>

  <div class="col-md-6">
    @yield('input_job')

    @if ($errors->has('job_id'))
      <span class="help-block">
        <strong>{{ $errors->first('job_id') }}</strong>
      </span>
    @endif
  </div>
</div>

<div class="form-group{{ $errors->has('disability_id') ? ' has-error' : '' }}">
  <label class="col-md-4 control-label">Disabilitas</label>

  <div class="col-md-6">
    @yield('input_disability')

    @if ($errors->has('disability_id'))
      <span class="help-block">
        <strong>{{ $errors->first('disability_id') }}</strong>
      </span>
    @endif
  </div>
</div>

@section('javascripts')
  <script src="{{ asset('/plugins/datepicker/bootstrap-datepicker.js') }}" type="text/javascript"></script>
  <script src="{{ asset('plugins/select2/select2.min.js') }}" type="text/javascript"></script>

  <script type="text/javascript">
    $(function() {
      $('input[name="date_of_birth"]').datepicker({
        autoclose: true
      });
      $('.search-district').select2();
      $('.search-disability').select2();
      $('.search-job').select2();
      $('.search-education').select2();
    });
  </script>

@endsection

{!! csrf_field() !!}

@yield('optional')

@if(! Route::is('residents.show'))
  <div class="form-group">
    <div class="col-md-6 col-md-offset-4">
      <a href="{{ URL::previous() }}" class="btn btn-default">{{ trans('message.back') }}</a>
      <button type="submit" class="btn btn-primary">
        <i class="fa fa-btn fa-user"></i> @yield('submit_message')
      </button>
    </div>
  </div>
@endif
