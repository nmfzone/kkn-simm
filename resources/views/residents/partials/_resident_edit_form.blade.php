@extends('residents._resident_form')

@section('input_name')
  <input type="text" class="form-control" name="name" value="{{ old('name', $resident->name) }}">
@endsection

@section('input_nik')
  <input type="text" class="form-control" name="nik" value="{{ old('nik', $resident->nik) }}">
@endsection

@section('input_gender')
  <select class="form-control" name="gender">
    @foreach(App\Setting::getGender() as $gender)
      <option value="{{ $gender['alias'] }}"
        @if($gender['alias'] == $resident->gender)
          selected
        @endif
      >{{ $gender['name'] }}</option>
    @endforeach
  </select>
@endsection

@section('input_marital_status')
  <select class="form-control search-district" name="marital_status_id">
    @foreach(App\MaritalStatus::all() as $maritalStatus)
      <option value="{{ $maritalStatus->id }}"
        @if($maritalStatus->id == $resident->marital_status_id)
          selected
        @endif
      >{{ $maritalStatus->name }}</option>
    @endforeach
  </select>
@endsection

@section('input_hometown')
  <select class="form-control search-district" name="hometown_id">
    @foreach(App\District::all() as $hometown)
      <option value="{{ $hometown->id }}"
        @if($hometown->id == $resident->hometown_id)
          selected
        @endif
      >{{ $hometown->name }}</option>
    @endforeach
  </select>
@endsection

@section('input_date_of_birth')
    <input type="text" class="form-control" name="date_of_birth" value="{{ old('date_of_birth', $resident->date_of_birth->format('m/d/Y')) }}" placeholder="mm/dd/yyyy">
@endsection

@section('input_education')
  <select class="form-control search-education" name="education_id">
    @foreach(App\Education::all() as $education)
      <option value="{{ $education->id }}"
        @if($education->id == $resident->education_id)
          selected
        @endif
      >{{ $education->name }}</option>
    @endforeach
  </select>
@endsection

@section('input_job')
  <select class="form-control search-job" name="job_id">
    @foreach(App\Job::all() as $job)
      <option value="{{ $job->id }}"
        @if($job->id == $resident->job_id)
          selected
        @endif
      >{{ $job->name }}</option>
    @endforeach
  </select>
@endsection

@section('input_disability')
  @foreach(App\Disability::all() as $disability)
    <div class="checkbox">
      <label><input type="checkbox" name="disability[]" value="{{ $disability->id }}"
        @if(in_array($disability->id, $resident->disabilities->pluck('id')->toArray()))
          checked
        @endif
      >{{ $disability->name }}</label>
    </div>
  @endforeach
@endsection

@section('submit_message')
  Simpan
@endsection
