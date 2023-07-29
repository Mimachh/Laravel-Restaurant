<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="Content-Security-Policy" content="connect-src 'self'; object-src 'self';
        script-src 'self' https://unpkg.com/swiper/swiper-bundle.min.css https://cdn.jsdelivr.net/npm/axios@latest/dist/axios.min.js;
        ">
        <title>{{ env('APP_NAME')}}</title>
        <meta name="description" content="Votre restaurant en ligne.">
        <link
        rel="stylesheet"
        href="https://unpkg.com/swiper/swiper-bundle.min.css"
        />
        @vite('resources/css/welcome-page.scss')
    </head>
    <body>
        <!-- <div class="font-poppins">
            @if (Route::has('login'))
                <div class="">
                    @auth
                        <a href="{{ url('/home') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div> -->
 
        <main class="relative">
        @if (session('success'))
            <div id="success-alert" class="z-50 fixed top-[50%] translate-y-[-50%] left-0 right-0 bg-[#B2D8B2] text-[#22543D] p-4 mb-4 rounded text-center">
                <p>{{ session('success') }}</p>
            </div>
        @endif
            <x-header />

            <x-slider />       
            
            <x-about.resto />

            <x-carte.formules />

            <x-carte.carte />



            <x-team.liste />

            <x-horaire />

            <x-reservation />

            <x-contact />

            <x-footer />

            <x-to-top />
            <div id="app">
                <Counter />
            </div>
        </main>

        @vite('resources/js/app.js')
        @vite('resources/js/public/index.js')
        <script>
             window.APP_URL = "{{ env('APP_URL') }}";
        </script>
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>


    </body>
</html>
