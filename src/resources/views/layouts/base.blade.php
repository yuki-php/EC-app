<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- title -->
    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/utility.css') }}" rel="stylesheet">
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet">
    @yield('css')

    @yield('head_script')
</head>
<body>
    <div id="app">
        @include('layouts.parts.header')
        <main class="main">
            @if (session('flash_message'))
                <div class="flash_message bg-success text-center py-3 my-0 mb30">
                    {{ session('flash_message') }}
                </div>
            @endif
            <div id="content">
                @yield('headline')
                @yield('content')
            </div>
        </main>
        @include('layouts.parts.footer')
    </div>
    @yield('foot_script')
    @include('layouts.parts.loading')
</body>
</html>