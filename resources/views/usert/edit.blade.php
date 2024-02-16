@extends('layout.app')
@section('title', 'Welcome')
@section('content')
   <div id="app">
        @csrf
        <edit-component fields-objects='{{ json_encode($fieldsObjects) }}'
        form-url='{{ $formUrl }}' title={{$title}} model="{{json_encode($user)}}" id="{{$user->id}}"></edit-component>
   </div>

@endsection
