@extends('nav')
@section('content')
    <div id="app">
        @auth
            <postform></postform>
        @endauth
        <allpost ref="allPost"></allpost>
    </div>
@endsection
