@section('stylesheets')
  <link href="{{ asset('/plugins/datepicker/datepicker3.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

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

<div class="form-group{{ $errors->has('village_id') ? ' has-error' : '' }}">
  <label class="col-md-4 control-label">Desa</label>

  <div class="col-md-6">
    @yield('input_village')

    @if ($errors->has('village_id'))
      <span class="help-block">
        <strong>{{ $errors->first('village_id') }}</strong>
      </span>
    @endif
  </div>
</div>

<div class="form-group{{ $errors->has('kadus') ? ' has-error' : '' }}">
  <label class="col-md-4 control-label">Kadus</label>

  <div class="col-md-6">
    @yield('input_kadus')

    @if ($errors->has('kadus'))
      <span class="help-block">
        <strong>{{ $errors->first('kadus') }}</strong>
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

<div class="form-group{{ $errors->has('issued_on') ? ' has-error' : '' }}">
  <label class="col-md-4 control-label">Dikeluarkan pada</label>

  <div class="col-md-6">
    @yield('input_issued_on')

    @if ($errors->has('issued_on'))
      <span class="help-block">
        <strong>{{ $errors->first('issued_on') }}</strong>
      </span>
    @endif
  </div>
</div>

<div class="row m-b-20">
  <div class="col-md-4 text-right">
    <h3><i class="fa fa-user"></i> Kepala Keluarga</h3>
  </div>
</div>

<div class="form-group{{ $errors->has('patriarch') ? ' has-error' : '' }}">
  <label class="col-md-4 control-label">Nama</label>

  <div class="col-md-6">
    @yield('input_patriarch')

    @if ($errors->has('patriarch'))
      <span class="help-block">
        <strong>{{ $errors->first('patriarch') }}</strong>
      </span>
    @endif
  </div>
</div>

<div class="row m-b-20">
  <div class="col-md-4 text-right">
    <h3{!! $errors->has('family_member_id.*') ? ' style="color:red"' : '' !!}><i class="fa fa-user"></i> Anggota Keluarga</h3>
  </div>
</div>

@if(! Route::is('family_cards.show'))
  <div class="form-group">
    <label class="col-md-4 control-label">Terdapat Anggota Keluarga ?</label>

    <div class="col-md-6">
      @yield('input_family_member')
    </div>

    @if ($errors->has('family_member_id.*'))
      <div class="error-message has-error">
        <div class="form-group">
          <label class="col-md-4 control-label"></label>

          <div class="col-md-6">
            <span class="help-block">
              <strong>{{ $errors->first('family_member_id.*') }}</strong>
            </span>
          </div>
        </div>
      </div>
    @endif
  </div>

  <div class="member-box">
    <div class="family-member">
      <div class="member-list">
        <div class="form-group">
          <label class="col-md-4 control-label">Anggota 1</label>

          <div class="col-md-6">
            @yield('input_family_member_id')
          </div>
        </div>
      </div>
    </div>

    <div class="add-member">
      <div class="form-group">
        <label class="col-md-4 control-label"></label>

        <div class="col-md-6">
          <i class="fa fa-plus add-btn"></i>
        </div>
      </div>
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
        $('.date_of_birth').datepicker({
          autoclose: true
        });

        $('.search-village').select2();
        $('.search-resident').select2();

        $('.has_member').change(function(event) {
          var val = $(this).val();
          var target = $('.member-box');

          if (val === "0") {
            target.hide();
          } else {
            target.show();
          }
        });
        $('.has_member').change();

        function cloneAndSetSearchResident(val) {
          var el = $('.family-member > .member-list').last();
          el.find('.search-resident').select2('destroy');
          var el_target = el.clone();
          var target = $('.family-member');

          var label = el_target.find('.control-label');
          label.text('Anggota ' + (parseInt(label.text().split(" ")[1])+1));
          el.find('.search-resident').select2();
          target.append(el_target);
          el_target.find('.search-resident').select2();

          if (typeof val !== 'undefined') {
            el_target.find('.search-resident').val(parseInt(val)).trigger('change.select2');
          }
        }

        $('.add-btn').click(function(event) {
          cloneAndSetSearchResident();
        });

        $('.family-member').ready(function() {
          @php($familyMembers = old('family_member_id', isset($familyCard) ? $familyCard->nonPatriarch->pluck('id')->all() : null))
          var members = {!! (! is_null($familyMembers)
            ? json_encode($familyMembers)
            : '[]') !!};
          var el = $('.family-member > .member-list');
          var has_member = $('.has_member').val();

          if (members.length > 0 && has_member == 1) {
            if (members.length == 1) {
              el.eq(0).find('.search-resident').val(members[0]).trigger('change.select2');
            } else {
              $.each(members, function(key, val) {
                val = parseInt(val);
                if (key == 0) {
                  el.eq(key).find('.search-resident').val(val).trigger('change.select2');
                } else {
                  cloneAndSetSearchResident(val);
                }
              });
            }
          }
        });
      });
    </script>
  @endsection

  {!! csrf_field() !!}
@endif

@yield('optional')

<div class="form-group">
  <div class="col-md-6 col-md-offset-4">
    <a href="{{ URL::previous() }}" class="btn btn-default">{{ trans('message.back') }}</a>
    @if(! Route::is('family_cards.show'))
      <button type="submit" class="btn btn-primary">
        <i class="fa fa-btn fa-user"></i> @yield('submit_message')
      </button>
    @endif
  </div>
</div>
