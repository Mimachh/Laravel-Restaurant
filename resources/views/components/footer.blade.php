<section class="bg-nav text-primaryDark">
    <div class="max-w-[1400px] mx-auto">
<!-- Logo -->
    <a href="#welcome">
        <img src="{{ asset('images/test.png') }}" width="100px" height="100px" alt="Logo"
            class="mx-auto pt-4 pb-8"
        >
    </a>
<!-- Nom du resto -->
        <h2 class="text-center
        font-bold text-xl font-quicksand pb-4
        ">La Boom</h2>

        <p class="
        text-light text-center text-md font-quicksand
        ">12, rue des Minimes <br> 72000 <br> Le Mans</p>

        <div class="text-light py-12 flex justify-around items-center">
            <div>
                <p>Copyright &copy; {{ date('Y') }} <a href="" class="underline pb-1">Mimach</a>. All rights reserved.</p>
            </div>

            <div>
                
                <ul class="flex justify-center items-center
                gap-4
                ">
                <h5>Suivre le restaurant sur :</h5>
                    <li>
                        <a href=""
                        >
                            <x-jam-facebook class="social-icon text-light hover:text-primaryDark transition-colors duration-100 ease"/>
                        </a>
                    </li>
                    <li class="
                    ">
                        <a href="">
                            <x-jam-instagram  class="social-icon text-light hover:text-primaryDark transition-colors duration-100 ease"/>
                        </a>
                    </li>
                    <li class="
                    ">
                        <a href="">
                            <x-jam-twitter class="social-icon text-light hover:text-primaryDark transition-colors duration-100 ease"/>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>