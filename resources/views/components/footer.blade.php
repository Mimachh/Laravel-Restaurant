<section class="bg-nav text-primaryDark">
    <div class="max-w-[1400px] mx-auto">
<!-- Logo -->
    <a href="@if(request()->routeIs('welcome')) #welcome @else {{ route('welcome') }} @endif">
        <img src="{{ asset('images/test.png') }}" width="100px" height="100px" alt="Logo"
            class="mx-auto pt-4 pb-8"
        >
    </a>
<!-- Nom du resto -->
        <h2 class="text-center
        font-bold text-xl font-quicksand pb-4
        ">{{ env('APP_NAME')}}</h2>

        <p class="
        text-light text-center text-md font-quicksand
        ">12, rue des Minimes <br> 72000 <br> Le Mans</p>

        <div class="text-light py-12 flex justify-around items-center">
            <div>
                <p>Copyright &copy; {{ date('Y') }} <a href="mailto:karl.mullr@gmail.com" class="underline pb-1" aria-label="mail du développeur">Mimach</a>. All rights reserved.</p>
            </div>

            <div>
            <div>Suivre le restaurant sur :</div>
                <ul class="flex justify-center items-center
                gap-4
                ">
                
                    <li>
                        <a href="https://google.com" target="_blank"  aria-label="Lien vers un RS"
                        >
                            <x-jam-facebook class="social-icon text-light hover:text-primaryDark transition-colors duration-100 ease"/>
                        </a>
                    </li>
                    <li class="
                    ">
                        <a href="https://google.com" target="_blank" aria-label="Lien vers un RS">
                            <x-jam-instagram  class="social-icon text-light hover:text-primaryDark transition-colors duration-100 ease"/>
                        </a>
                    </li>
                    <li class="
                    ">
                        <a href="https://google.com" target="_blank" aria-label="Lien vers un RS">
                            <x-jam-twitter class="social-icon text-light hover:text-primaryDark transition-colors duration-100 ease"/>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>