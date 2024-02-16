@extends('layout.app')
@section('title', 'Welcome')
@section('content')

    <div id="app">
        @csrf
        <index-component data="{{ $users->toJson() }}" title="{{ $title }}" query="{{ json_encode($query) }}"
            cols-names="{{ json_encode($colsNames) }}" filter-fields="{{json_encode($filterFields)}}" actions="{{json_encode($actions)}}"></index-component>

    </div>

@endsection
