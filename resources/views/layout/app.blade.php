<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    @yield('styles')
</head>
<body>
    <x-header />
    
    <main class="">
        @yield('content')
    </main>
    
        <div id="app">
            <Counter />
        </div>
    <x-footer />
    @yield('scripts')
    

    @vite('resources/js/app.js')

</body>
</html>
