@extends('users._user_form')

@section('input_username')
    <input type="text" class="form-control" name="username" value="{{ old('username') }}">
@endsection

@section('input_name')
    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
@endsection

@section('submit_message')
    Tambah Anggota
@endsection
