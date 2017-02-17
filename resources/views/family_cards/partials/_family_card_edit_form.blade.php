@extends('family_cards._family_card_form')

@section('input_number')
  <input type="number" class="form-control" name="number" value="{{ old('number', $familyCard->number) }}">
@endsection

@section('input_village')
  <select class="form-control search-village" name="village_id">
    @foreach(App\Village::all() as $village)
      <option value="{{ $village->id }}"
        @if($village == $familyCard->village)
          selected
        @endif
      >{{ $village->name }}</option>
    @endforeach
  </select>
@endsection

@section('input_dukuh')
  <select class="form-control" name="dukuh">
    @foreach(App\Setting::getDukuh()->all() as $dukuh)
      <option value="{{ $dukuh }}"
        @if($dukuh == $familyCard->dukuh)
          selected
        @endif
      >{{ $dukuh }}</option>
    @endforeach
  </select>
@endsection

@section('input_rw')
  <select class="form-control" name="rw">
    @if(Auth::user()->isAn('Administrator'))
      @foreach(App\Setting::getRW()->all() as $rw)
        <option value="{{ $rw }}"
          @if($rw == $familyCard->rw)
            selected
          @endif
        >{{ $rw }}</option>
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
      <option value="{{ $rt }}"
        @if($rt == $familyCard->rt)
          selected
        @endif
      >{{ $rt }}</option>
    @endforeach
  </select>
@endsection

@section('input_issued_on')
  <input type="text" class="form-control date_of_birth" name="issued_on" value="{{ old('issued_on', Date::parse($familyCard->issued_on)->format('m/d/Y')) }}" placeholder="mm/dd/yyyy">
@endsection

@section('input_patriarch')
  <select class="form-control search-resident" name="patriarch">
    @foreach(App\Resident::all() as $resident)
      <option value="{{ $resident->id }}"
        @if($resident == $familyCard->patriarch)
          selected
        @endif
      >{{ $resident->name }}</option>
    @endforeach
  </select>
@endsection

@section('input_family_member')
  <select class="form-control has_member" name="family_member">
    @foreach (App\Setting::getSelection() as $selection)
      <option value="{{ $selection['id'] }}"
        @if((old('family_member') == $selection['id']) || (($familyCard->memberTotal() > 0) && ($selection['id'] == 1)) || (($familyCard->memberTotal() == 0) && ($selection['id'] == 0)))
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
  Edit Kartu Keluarga
@endsection
