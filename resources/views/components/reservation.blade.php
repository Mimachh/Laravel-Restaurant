<section class="bg-ardoise text-primaryDark"  id="contact" style="background-image: url('{{ env('APP_URL') }}/images/ardoise.webp')">
    <div class="max-w-[1400px] mx-auto relative z-20 py-24 md:py-32">


    <x-section-title 
            title="Délectez-vous"
            subtitle="Réservez, commander, emportez, faites-vous livrer, c'est à vous de voir !"
            class="pt-16 md:pb-16 pb-8
            text-primaryDark
            "
        />

        <div class="flex md:flex-row md:gap-0 gap-12 flex-col items-center justify-around py-12 px-8 md:space-x-8">

            <x-button 
            title="A emporter"
            class="border border-light text-light w-full 
            hover:border-dark hover:text-dark hover:bg-light
            "
            type="modalEmporter"
            />

            <x-button 
            title="Réserver"
            class="border border-primaryDark text-primaryDark w-full 
            hover:bg-primaryDark hover:border-dark hover:text-dark
            "
            type="modal"
            />

            <x-button 
            title="Se faire livrer"
            class="border border-creme text-creme w-full 
            hover:bg-primary hover:text-light hover:border-primary
            "
            type="link"
            targetId="https://google.com"
            />
        </div>

    </div>
</section>