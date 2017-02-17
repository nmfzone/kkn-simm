@extends('residents._resident_form')

@section('input_name')
  <input type="text" class="form-control" name="name" value="{{ old('name') }}">
@endsection

@section('input_nik')
  <input type="text" class="form-control" name="nik" value="{{ old('nik') }}">
@endsection

@section('input_gender')
  <select class="form-control" name="gender">
    @foreach(App\Setting::getGender() as $gender)
      <option value="{{ $gender['alias'] }}">{{ $gender['name'] }}</option>
    @endforeach
  </select>
@endsection

@section('input_marital_status')
  <select class="form-control" name="marital_status_id">
    @foreach(App\MaritalStatus::all() as $maritalStatus)
      <option value="{{ $maritalStatus->id }}">{{ $maritalStatus->name }}</option>
    @endforeach
  </select>
@endsection

@section('input_hometown')
  <select class="form-control search-district" name="hometown_id">
    @foreach(App\District::all() as $hometown)
      <option value="{{ $hometown->id }}">{{ $hometown->name }}</option>
    @endforeach
  </select>
@endsection

@section('input_date_of_birth')
    <input type="text" class="form-control" name="date_of_birth" value="{{ old('date_of_birth') }}" placeholder="mm/dd/yyyy">
@endsection

@section('input_education')
  <select class="form-control search-education" name="education_id">
    @foreach(App\Education::all() as $education)
      <option value="{{ $education->id }}">{{ $education->name }}</option>
    @endforeach
  </select>
@endsection

@section('input_job')
  <select class="form-control search-job" name="job_id">
    @foreach(App\Job::all() as $job)
      <option value="{{ $job->id }}">{{ $job->name }}</option>
    @endforeach
  </select>
@endsection

@section('input_disability')
  @foreach(App\Disability::all() as $disability)
    <div class="checkbox">
      <label><input type="checkbox" name="disability[]" value="{{ $disability->id }}">{{ $disability->name }}</label>
    </div>
  @endforeach
@endsection

@section('submit_message')
  Tambah Penduduk
@endsection
