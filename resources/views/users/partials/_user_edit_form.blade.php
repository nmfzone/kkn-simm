@extends('users._user_form')

@section('input_username')
  <input type="text" class="form-control" name="username" value="{{ old('username', $user->username) }}">
@endsection

@section('input_name')
  <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}">
@endsection

@section('input_position')
  <select class="form-control" name="position">
    @foreach(App\Setting::getPosition() as $position)
      <option value="{{ $position[0] }}"
        @if($position[0] === $user->position)
          selected
        @endif
      >{{ $position[0] }}</option>
    @endforeach
  </select>
@endsection

@section('submit_message')
    Edit Anggota
@endsection
