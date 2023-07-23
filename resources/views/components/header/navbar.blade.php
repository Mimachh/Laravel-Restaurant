<div class=" bg-nav text-light z-50" id="{{$id}}">
    <div class="max-w-[1200px] mx-auto flex relative justify-end md:justify-start items-start">      
        <nav class="md:flex md:justify-between md:bg-transparent 
         w-full items-center px-4 hidden mt-8 md:mt-0 z-40
        " id="navbar">
            <ul class="md:flex block gap-3 space-y-2 md:space-y-0  justify-center md:justify-start">
                <x-nav-link route="welcome" title="Accueil"/>
                <x-nav-link route="welcome" title="A propos"/>
                <x-nav-link route="welcome" title="Menus"/>
                <x-nav-link route="welcome" title="L'équipe"/>
                <x-nav-link route="welcome" title="Horaire"/>
            </ul>

            <x-button-reservation />
        </nav>
        <button class="md:hidden py-6 z-50" id="toggle">
            <x-jam-menu  class="text-light w-10 h-10 hover:text-gold transition duration-100 ease"/>
        </button> 
        
        <img src="{{ asset('images/test.png') }}" width="100px" height="100px" alt="Logo"
        class="bottom-0 z-50"
        >
    </div>
</div>