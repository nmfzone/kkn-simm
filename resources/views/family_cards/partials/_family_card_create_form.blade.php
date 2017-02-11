@extends('family_cards._family_card_form')

@section('input_number')
    <input type="number" class="form-control" name="number" value="{{ old('number') }}">
@endsection

@section('input_village')
  <select class="form-control" name="village_id">
    @foreach(App\Village::all() as $village)
      <option value="{{ $village->id }}">{{ $village->name }}</option>
    @endforeach
  </select>
@endsection

@section('input_dukuh')
  <select class="form-control" name="dukuh">
    <option name="Sidowayah">Sidowayah</option>
    <option name="Padasan">Padasan</option>
  </select>
@endsection

@section('input_rt')
  <select class="form-control" name="rt">
    <option name="01">01</option>
    <option name="02">02</option>
    <option name="03">03</option>
    <option name="04">04</option>
    <option name="05">05</option>
    <option name="06">06</option>
  </select>
@endsection

@section('input_rw')
  <select class="form-control" name="rw">
    <option name="01">01</option>
    <option name="02">02</option>
    <option name="03">03</option>
    <option name="04">04</option>
    <option name="05">05</option>
    <option name="06">06</option>
  </select>
@endsection

@section('input_name')
    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
@endsection

@section('input_nik')
    <input type="text" class="form-control" name="nik" value="{{ old('nik') }}">
@endsection

@section('input_gender')
  <select class="form-control" name="gender">
    <option name="01">Laki-Laki</option>
    <option name="02">Perempuan</option>
  </select>
@endsection

@section('input_nik')
    <input type="text" class="form-control" name="nik" value="{{ old('nik') }}">
@endsection

@section('input_district')
  <select class="form-control" name="district_id">
    @foreach(App\District::all() as $district)
      <option value="{{ $district->id }}">{{ $district->name }}</option>
    @endforeach
  </select>
@endsection

@section('input_date_of_birth')
    <input type="text" class="form-control" name="date_of_birth" value="{{ old('date_of_birth') }}">
@endsection

@section('input_education')
  <select class="form-control" name="education_id">
    @foreach(App\Education::all() as $education)
      <option value="{{ $education->id }}">{{ $education->name }}</option>
    @endforeach
  </select>
@endsection

@section('input_job')
  <select class="form-control" name="job_id">
    @foreach(App\Job::all() as $job)
      <option value="{{ $job->id }}">{{ $job->name }}</option>
    @endforeach
  </select>
@endsection

@section('input_disability')
  <select class="form-control" name="disability_id">
    @foreach(App\Disability::all() as $disability)
      <option value="{{ $disability->id }}">{{ $disability->name }}</option>
    @endforeach
  </select>
@endsection

@section('submit_message')
    Tambah KK
@endsection
