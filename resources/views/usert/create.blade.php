@extends('layout.app')
@section('title', 'Welcome')
@section('content')

    <div id="app">
        <create-component fields-objects='{{ json_encode($fieldsObjects) }}'
            form-url='{{ $formUrl }}' title={{$title}} ></create-component>

    </div>

@endsection
