<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> -->
    @yield('styles')
</head>
<body>

    @yield('content')

    @vite('resources/js/public/modules/login-register.js')
    @vite('resources/js/public/index.js')
    @yield('scripts')

    @push('scripts')
        <script>
            // Votre code JavaScript ici
        </script>
    @endpush
</body>
</html>
