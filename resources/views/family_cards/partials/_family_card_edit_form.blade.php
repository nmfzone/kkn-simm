@extends('family_cards._family_card_form')

@section('input_username')
    <input type="text" class="form-control" name="username" value="{{ $familyCard->number }}">
@endsection

@section('input_name')
    <input type="text" class="form-control" name="name" value="{{ $familyCard->name }}">
@endsection

{{-- @section('input_position')
    @foreach($positions as $position)
        @if ($position['name'] == $familyCard->position)
            <option value="{{ $position['name'] }}" selected>{{ $position['name'] }}</option>
        @else
            <option value="{{ $position['name'] }}">{{ $position['name'] }}</option>
        @endif
    @endforeach
@endsection --}}

@section('submit_message')
    Edit KK
@endsection
