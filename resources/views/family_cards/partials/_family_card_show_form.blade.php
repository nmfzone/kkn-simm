@extends('family_cards._family_card_form')

@section('input_number')
  <div class="nude-input">
    {{ $familyCard->number }}
  </div>
@endsection

@section('input_village')
  <div class="nude-input">
    {{ $familyCard->village->name }}
  </div>
@endsection

@section('input_dukuh')
  <div class="nude-input">
    {{ $familyCard->dukuh }}
  </div>
@endsection

@section('input_rw')
  <div class="nude-input">
    {{ $familyCard->rw }}
  </div>
@endsection

@section('input_rt')
  <div class="nude-input">
    {{ $familyCard->rt }}
  </div>
@endsection

@section('input_issued_on')
  <div class="nude-input">
    {{ Date::parse($familyCard->issued_on)->format('d F Y') }}
  </div>
@endsection

@section('input_patriarch')
  <div class="nude-input">
    {{ $familyCard->patriarch->name }}
  </div>
@endsection

@section('optional')
  @if($familyCard->nonPatriarch->isEmpty())
    <div class="form-group">
      <label class="col-md-4 control-label"></label>

      <div class="col-md-6">
        <div class="nude-input">
          Tidak ada anggota keluarga.
        </div>
      </div>
    </div>
  @else
    @foreach ($familyCard->nonPatriarch as $index => $resident)
      <div class="form-group">
        <label class="col-md-4 control-label">Anggota {{ $index+1 }}</label>

        <div class="col-md-6">
          <div class="nude-input">
            {{ $resident->name }}
          </div>
        </div>
      </div>
    @endforeach
  @endif
@endsection
