<div class="row m-b-20">
  <div class="col-md-4 text-right">
    <h3><i class="fa fa-user"></i> Kartu Keluarga</h3>
  </div>
</div>

<div class="form-group{{ $errors->has('number') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">No. Kartu Keluarga</label>

    <div class="col-md-6">
        @yield('input_number')

        @if ($errors->has('number'))
            <span class="help-block">
                <strong>{{ $errors->first('number') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('village') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">Desa</label>

    <div class="col-md-6">
        @yield('input_village')

        @if ($errors->has('village'))
            <span class="help-block">
                <strong>{{ $errors->first('village') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('dukuh') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">Pedukuhan</label>

    <div class="col-md-6">
        @yield('input_dukuh')

        @if ($errors->has('dukuh'))
            <span class="help-block">
                <strong>{{ $errors->first('dukuh') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('rt') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">RT</label>

    <div class="col-md-6">
        @yield('input_rt')

        @if ($errors->has('rt'))
            <span class="help-block">
                <strong>{{ $errors->first('rt') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('rw') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">RW</label>

    <div class="col-md-6">
        @yield('input_rw')

        @if ($errors->has('rw'))
            <span class="help-block">
                <strong>{{ $errors->first('rw') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="row m-b-20">
  <div class="col-md-4 text-right">
    <h3><i class="fa fa-user"></i> Kepala Keluarga</h3>
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

<div class="form-group{{ $errors->has('district') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">Tempat Lahir</label>

    <div class="col-md-6">
        @yield('input_district')

        @if ($errors->has('district'))
            <span class="help-block">
                <strong>{{ $errors->first('district') }}</strong>
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

<div class="form-group{{ $errors->has('education') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">Pendidikan</label>

    <div class="col-md-6">
        @yield('input_education')

        @if ($errors->has('education'))
            <span class="help-block">
                <strong>{{ $errors->first('education') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('job') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">Pekerjaan</label>

    <div class="col-md-6">
        @yield('input_job')

        @if ($errors->has('job'))
            <span class="help-block">
                <strong>{{ $errors->first('job') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('disability') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">Disabilitas</label>

    <div class="col-md-6">
        @yield('input_disability')

        @if ($errors->has('disability'))
            <span class="help-block">
                <strong>{{ $errors->first('disability') }}</strong>
            </span>
        @endif
    </div>
</div>

@section('stylesheets')
  <link href="{{ asset('/plugins/datepicker/datepicker3.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('javascripts')
  <script src="{{ asset('/plugins/datepicker/bootstrap-datepicker.js') }}" type="text/javascript"></script>

  <script type="text/javascript">
    $(function() {
      $('input[name="date_of_birth"]').datepicker({
        autoclose: true
      });
    });
  </script>

@endsection

{!! csrf_field() !!}

@yield('optional')

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <a href="{{ URL::previous() }}" class="btn btn-default">Back</a>
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-btn fa-user"></i> @yield('submit_message')
        </button>
    </div>
</div>
