<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @yield('styles')
</head>
<body>

    @yield('content')


    @yield('scripts')

    @vite('resources/js/public/index.js')
    @vite('resources/js/app.js')
</body>
</html>
