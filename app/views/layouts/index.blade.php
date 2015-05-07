@extends('layouts.master')

@section('header')
    <header>
        @include('includes.globals.header')
    </header>
@stop

@section('main')
    <div class="ui stackable grid">
        <div class="sixteen wide column">
            @include('includes.globals.navigation.nav')
        </div>
        <div class="sixteen wide column">
            <div class="ui stackable grid segment">
                @yield('content')
            </div>
        </div>
    </div>
@stop

@section('footer')

@stop