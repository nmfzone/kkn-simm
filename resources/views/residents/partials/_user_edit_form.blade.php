@extends('users._user_form')

@section('input_username')
    <input type="text" class="form-control" name="username" value="{{ $user->username }}">
@endsection

@section('input_name')
    <input type="text" class="form-control" name="name" value="{{ $user->name }}">
@endsection

{{-- @section('input_position')
    @foreach($positions as $position)
        @if ($position['name'] == $user->position)
            <option value="{{ $position['name'] }}" selected>{{ $position['name'] }}</option>
        @else
            <option value="{{ $position['name'] }}">{{ $position['name'] }}</option>
        @endif
    @endforeach
@endsection --}}

@section('submit_message')
    Edit Penduduk
@endsection
