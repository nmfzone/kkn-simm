@extends('users._user_form')

@section('input_username')
  <input type="text" class="form-control" name="username" value="{{ old('username') }}">
@endsection

@section('input_name')
  <input type="text" class="form-control" name="name" value="{{ old('name') }}">
@endsection

@section('input_position')
  <select class="form-control" name="position">
    @foreach(App\Setting::getPosition() as $position)
      <option value="{{ $position[0] }}">{{ $position[0] }}</option>
    @endforeach
  </select>
@endsection

@section('submit_message')
    Tambah Anggota
@endsection
