@extends('layout.app')
@section('title', 'Welcome')
@section('content')

    <div id="app">
        <example-component title="{{ $title }}" message="{{ $message }}"></example-component>
    </div>

@endsection
