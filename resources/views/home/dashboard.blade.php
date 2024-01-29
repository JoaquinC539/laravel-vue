@extends('layouts.app')

@section('title', 'Dashboard')


@section('content')

    <div class="card w-100">
        <h1>Bienvenido, User</h1>
        <br>
        <div class="card-body">
            <div id="app">
                <example-component></example-component>
            </div>
        </div>
    </div>

    @push('scripts')
        <script type="module">
            
        </script>
    @endpush


@endsection
