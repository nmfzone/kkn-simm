@extends('family_cards._family_card_form')

@section('input_number')
  <input type="number" class="form-control" name="number" value="{{ old('number') }}">
@endsection

@section('input_village')
  <select class="form-control search-village" name="village_id">
    @foreach(App\Village::all() as $village)
      <option value="{{ $village->id }}">{{ $village->name }}</option>
    @endforeach
  </select>
@endsection

@section('input_kadus')
  <select class="form-control" name="kadus">
    @foreach(App\Setting::getKadusByPosition(auth()->user()->position)->all() as $kadus)
      <option value="{{ $kadus }}">{{ $kadus }}</option>
    @endforeach
  </select>
@endsection

@section('input_rw')
  <select class="form-control" name="rw">
    @if(Auth::user()->isAn('Administrator'))
      @foreach(App\Setting::getRW()->all() as $rw)
        <option value="{{ $rw }}">{{ $rw }}</option>
      @endforeach
    @else
      @php($rw = explode(' ', Auth::user()->position)[2])
      <option value="{{ $rw }}">{{ $rw }}</option>
    @endif
  </select>
@endsection

@section('input_rt')
  <select class="form-control" name="rt">
    @foreach(App\Setting::getRT()->all() as $rt)
      <option value="{{ $rt }}">{{ $rt }}</option>
    @endforeach
  </select>
@endsection

@section('input_issued_on')
  <input type="text" class="form-control date_of_birth" name="issued_on" value="{{ old('issued_on', '01/01/2010') }}"  placeholder="mm/dd/yyyy">
@endsection

@section('input_patriarch')
  <select class="form-control search-resident" name="patriarch">
    @foreach(App\Resident::all() as $resident)
      <option value="{{ $resident->id }}">{{ $resident->name }}</option>
    @endforeach
  </select>
@endsection

@section('input_family_member')
  <select class="form-control has_member" name="family_member">
    @foreach (App\Setting::getSelection()->all() as $selection)
      <option value="{{ $selection['id'] }}"
        @if(old('family_member') === $selection['id'])
          selected
        @endif
      >{{ $selection['name'] }}</option>
    @endforeach
  </select>
@endsection

@section('input_family_member_id')
  <select class="form-control search-resident" name="family_member_id[]">
    @foreach(App\Resident::all() as $resident)
      <option value="{{ $resident->id }}">{{ $resident->name }}</option>
    @endforeach
  </select>
@endsection

@section('submit_message')
    Tambah Kartu Keluarga
@endsection
