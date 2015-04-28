@extends('layouts.master')

@section('head')
    <header>
        @include('includes.globals.header')
    </header>
@stop

@section('main')
    <div class="ui stackable one column centered grid">
        <div class="sixteen wide column">
            @yield('content')
        </div>
    </div>
@stop

@section('footer')

@stop