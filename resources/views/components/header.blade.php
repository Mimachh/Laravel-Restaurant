<section class="">
    <!-- Contact -->
    <div class=" bg-primaryDark text-light py-6 px-4">
        <div class="max-w-[1200px] mx-auto md:flex md:justify-around md:items-center">
            <div class="md:w-1/2 w-full flex gap-6 justify-center md:justify-start">
                <p>02-43-43-43-43</p>
                <p>resto@gmail.com</p>
            </div>
            <nav class="md:w-1/2 w-full">
                <ul class="flex gap-3 justify-center md:justify-end">
                    <li>facebook</li>
                    <li>insta</li>
                    <li>twitter</li>
                </ul>
            </nav>
        </div>
    </div>
    <!-- NavBar -->
    <div class=" bg-primary text-light px-4">
        <div class="max-w-[1200px] mx-auto flex relative justify-end md:justify-start items-start">      
            <nav class="md:flex md:justify-between 
            block w-full items-center py-6
            ">
                <ul class="md:flex block gap-3 space-y-2 md:space-y-0 justify-center md:justify-start">
                    <x-nav-link route="welcome" title="Accueil"/>
                    <x-nav-link route="welcome" title="A propos"/>
                    <x-nav-link route="welcome" title="Menus"/>
                    <x-nav-link route="welcome" title="L'équipe"/>
                    <x-nav-link route="welcome" title="Horaire"/>
                </ul>

                <x-button-reservation />
            </nav>
            <button class="md:hidden py-8">Toggle</button>              
        </div>
    </div>
</section>