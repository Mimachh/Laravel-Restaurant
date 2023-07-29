<section class="bg-ardoise md:py-32 py-16" id="menu" style="background-image: url('{{ env('APP_URL') }}/images/ardoise.webp')">
    <div class="max-w-[1400px] mx-auto relative z-10">


        <x-section-title 
        title="Nos formules"
        subtitle="La meilleure street food du coin"
        class="py-4 md:py-8
        text-gold
        "
        />
        <div class="w-full flex flex-wrap gap-3 justify-center py-4">
        @forelse($formules as $formule)
            <div class="border border-gold py-8 px-4 rounded-md text-light">
                <div class="flex justify-between items-center pb-4">
                    <h3 class="text-xl font-bold">{{ $formule->nom }}</h3>
                    <p>{{ $formule->formatPrice() }}</p>
                    
                </div>
                <ul>
                    @foreach($formule->menus as $menu)
                        @if($menu->status == 1)
                        <li class="flex flex-col">
                            <!-- <span>{{$menu->nom}}</span> -->
                            <span>{{$menu->getEntrees()}} + {{$menu->getPlats()}} + {{$menu->getDesserts()}}</span>
                        </li>

                        @endif
                    @endforeach
                </ul>

                <!-- <p>{{ $formule->description }}</p>
                <p>{{ $formule->info_supp }}</p> -->
                
            </div>
        @empty
        <p>Pas de formule pour l'instant</p>
        @endforelse
        </div>


    </div>
</section>