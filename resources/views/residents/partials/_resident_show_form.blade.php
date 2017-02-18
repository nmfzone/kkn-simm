@extends('residents._resident_form')

@section('input_name')
  <div class="nude-input">
    {{ $resident->name }}
  </div>
@endsection

@section('input_nik')
  <div class="nude-input">
    {{ $resident->nik }}
  </div>
@endsection

@section('input_gender')
  <div class="nude-input">
    {{ $resident->gender === 'L' ? 'Laki-Laki' : 'Perempuan' }}
  </div>
@endsection

@section('input_marital_status')
  <div class="nude-input">
    {{ $resident->maritalStatus->name }}
  </div>
@endsection

@section('input_hometown')
  <div class="nude-input">
    {{ $resident->hometown->name }}
  </div>
@endsection

@section('input_date_of_birth')
  <div class="nude-input">
    {{ Date::parse($resident->date_of_birth)->format('d F Y') }}
  </div>
@endsection

@section('input_education')
  <div class="nude-input">
    {{ $resident->education->name }}
  </div>
@endsection

@section('input_job')
  <div class="nude-input">
    {{ $resident->job->name }}
  </div>
@endsection

@section('input_disability')
  <div class="nude-input">
    @if($resident->disabilities->isEmpty())
      {{ trans('message.disabilities.none') }}
    @else
      @foreach($resident->disabilities as $disability)
        <div class="checkbox">
          <label><input type="checkbox" checked disabled value="{{ $disability->id }}">{{ $disability->name }}</label>
        </div>
      @endforeach
    @endif
  </div>
@endsection

@section('optional')
  <div class="form-group">
    <div class="col-md-6 col-md-offset-4">
      <a href="{{ URL::previous() }}" class="btn btn-default">{{ trans('message.back') }}</a>
    </div>
  </div>
@endsection
