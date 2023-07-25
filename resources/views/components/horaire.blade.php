<section class="bg-gold text-primary" id="horaire">
    <div class="max-w-[1400px] mx-auto">
        
        <x-section-title 
            title="Les horaires"
            subtitle="Régalez-vous à l'heure de votre choix"
            class="pt-16 md:pb-16 pb-8
            text-primary
            "
        />
        @if( $fermeture["status"] != 1)
        <div class="flex flex-col md:flex-row items-center justify-center gap-8 md:gap-32 md:pb-24 pb-12">
            <div class=" bg-dark  rounded-md">

                    <svg 
                    class="w-24 h-24 mx-auto opacity-0  fill-creme mt-4 mb-4"
                    id="horaireHeader1" style="enable-background:new 0 0 32 32;" version="1.1" viewBox="0 0 32 32" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><circle cx="16" cy="16" r="9"/><path d="M17.5,4.13867V2c0-0.82813-0.67139-1.5-1.5-1.5S14.5,1.17188,14.5,2v2.13867c0,0.82813,0.67139,1.5,1.5,1.5   S17.5,4.9668,17.5,4.13867z"/><path d="M8.67383,8.67285c0.58545-0.58594,0.58545-1.53613-0.00049-2.12109L7.16113,5.04004   c-0.58594-0.58594-1.53564-0.58594-2.12158,0C4.4541,5.62598,4.4541,6.57617,5.04004,7.16113l1.51221,1.51172   C6.84521,8.96582,7.229,9.1123,7.61279,9.1123S8.38086,8.96582,8.67383,8.67285z"/><path d="M2,17.5h2.13818c0.82861,0,1.5-0.67188,1.5-1.5s-0.67139-1.5-1.5-1.5H2c-0.82861,0-1.5,0.67188-1.5,1.5   S1.17139,17.5,2,17.5z"/><path d="M5.03955,26.95996c0.29297,0.29297,0.67725,0.43945,1.06104,0.43945s0.76758-0.14648,1.06055-0.43945l1.51221-1.51172   c0.58594-0.58496,0.58594-1.53516,0.00049-2.12109c-0.58594-0.58594-1.53564-0.58594-2.12158,0l-1.51221,1.51172   C4.4541,25.42383,4.4541,26.37402,5.03955,26.95996z"/><path d="M14.5,27.86133V30c0,0.82813,0.67139,1.5,1.5,1.5s1.5-0.67188,1.5-1.5v-2.13867c0-0.82813-0.67139-1.5-1.5-1.5   S14.5,27.0332,14.5,27.86133z"/><path d="M24.83887,26.95996c0.29297,0.29297,0.67676,0.43945,1.06055,0.43945s0.76758-0.14648,1.06055-0.43945   c0.58594-0.58594,0.58594-1.53516,0-2.12109l-1.51172-1.51172c-0.58594-0.58594-1.53516-0.58594-2.12109,0   s-0.58594,1.53516,0,2.12109L24.83887,26.95996z"/><path d="M30,14.5h-2.13867c-0.82813,0-1.5,0.67188-1.5,1.5s0.67188,1.5,1.5,1.5H30c0.82813,0,1.5-0.67188,1.5-1.5   S30.82813,14.5,30,14.5z"/><path d="M26.95996,5.04004c-0.58594-0.58594-1.53516-0.58594-2.12109,0l-1.51172,1.51172   c-0.58594,0.58594-0.58594,1.53516,0,2.12109c0.29297,0.29297,0.67676,0.43945,1.06055,0.43945s0.76758-0.14648,1.06055-0.43945   l1.51172-1.51172C27.5459,6.5752,27.5459,5.62598,26.95996,5.04004z"/></g></svg>
                    
                    <div class="h-1 bg-gold w-full "></div>
                    
                    <ul class="space-y-2 px-3 py-4 bg-creme opacity-0" id="horaireFooter1">
                        @foreach($horaires as $horaire)
                        <li><span class="font-semibold text-md font-quicksand">{{ $horaire->nom }} : </span> <span>{{ $horaire->horaire_midi() }}</span></li>
                        @endforeach
                    </ul>

            </div>
            
            <div class="h-0.5 w-[60%] mx-auto rounded-full bg-dark md:hidden block"></div>
            
            <div class="bg-creme  rounded-md">
                <svg 
                class="w-16 h-24
                mx-auto  fill-dark mt-4 mb-4 opacity-0
                "
                data-name="horaireHeader2" id="horaireHeader2" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><title/><path d="M34.75,1A1,1,0,0,0,34,2.81,22.19,22.19,0,1,1,4.33,35.72,22.45,22.45,0,0,1,2.81,34,1,1,0,0,0,1,34.75,31,31,0,1,0,34.75,1Z"/></svg>
            
                <div class="h-1 bg-gold w-full "></div>

                <ul class="space-y-2 px-3 py-4 bg-dark text-light opacity-0" id="horaireFooter2">
                    @foreach($horaires as $horaire)
                    <li><span class="font-semibold text-md font-quicksand">{{ $horaire->nom }} : </span> <span>{{ $horaire->horaire_soir() }}</span></li>
                    @endforeach
                </ul>

            </div>
        </div>
        @else
            <p class="pb-16 font-bold text-center">Nous sommes fermé du {{ $fermeture["date_debut"] }} au {{ $fermeture["date_fin"] }}

                @if($fermeture["raison"])
                pour {{ $fermeture["raison"] }}
                @endif
                nous nous excusons du désagrément.
            </p>
        @endif

    </div>
</section>