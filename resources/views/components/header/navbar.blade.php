<div class=" bg-nav text-light z-50" id="{{$id}}">
    <div class="max-w-[1200px] mx-auto flex relative justify-end md:justify-start items-start">      
        <nav class="md:flex md:justify-between md:bg-transparent 
         w-full items-center px-4 hidden mt-8 md:mt-0 z-40
        " id="navbar">
            <ul class="md:flex block gap-3 space-y-2 md:space-y-0  justify-center md:justify-start">
                <x-nav-link route="welcome" title="Accueil"/>
                <x-nav-link route="a_propos" title="A propos"/>
                <x-nav-link route="menu" title="Menus"/>
                <x-nav-link route="team" title="L'équipe"/>
                <x-nav-link route="horaire" title="Horaire"/>
                <x-nav-link route="contact" title="Contact"/>
            </ul>

            <x-button 
            title="RESERVER"
            class="border border-primaryDark text-primaryDark 
            hover:bg-primaryDark hover:border-dark hover:text-dark
            !text-sm
            "
            type="modal"
            />
        </nav>
        <button class="md:hidden py-6 z-50" id="toggle">
            <x-jam-menu  class="text-light w-10 h-10 hover:text-gold transition duration-100 ease"/>
        </button> 
        
        <a href="#welcome">
            <img src="{{ asset('images/test.png') }}" width="100px" height="100px" alt="Logo"
            class="bottom-0 z-50"
            >
        </a>

    </div>
</div>