<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title or 'DungeonSoft' }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{ HTML::style('css/semantic.min.css') }}
    {{ HTML::style('css/main.css') }}
    @yield('extra-css', '')
    @yield('inline-css', '')
</head>
<body>
    <div class="containment">
        <div class="ui page grid">
            @yield('header')
            @yield('main')
            @yield('footer')
        </div>
        {{ HTML::script('javascript/jquery.min.js') }}
        {{ HTML::script('javascript/semantic.min.js') }}
        @yield('extra-js', '')
        @yield('inline-js', '')
    </div>
</body>
</html>