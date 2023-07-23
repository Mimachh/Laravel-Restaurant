<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

    </head>
    <body class="">
        <div class="font-poppins">
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
        </div>
 
        <x-header />

        <section class="w-full ">
            <div class="text-center">
                <p class="">Section 1 Slider avec Titre</p>
            </div>
           
        </section>

        <section class="bg-creme">
            <div class="max-w-[1400px] mx-auto">
                <p class="">Section 2 description du resto</p>
            </div>
        </section>

        <section class="bg-dark text-primaryDark">
            <div class="max-w-[1400px] mx-auto">
                <p class="">Section 3 menus</p>
            </div>
        </section>

        <section class="bg-light text-primary">
            <div class="max-w-[1400px] mx-auto">
                <p class="">Section 4 team</p>
            </div>
        </section>

        <section class="bg-gold text-primary">
            <div class="max-w-[1400px] mx-auto">
                <p class="">Horaire</p>
            </div>
        </section>

        <section class="bg-dark text-primaryDark">
            <div class="max-w-[1400px] mx-auto">
                <p class="">Reservation ou autre</p>
            </div>
        </section>

        <section class="bg-primary text-primaryDark">
            <div class="max-w-[1400px] mx-auto">
                <p class="">Footer</p>
            </div>
        </section>
        @vite('resources/js/app.js')
        @vite('resources/js/public/index.js')
    </body>
</html>
