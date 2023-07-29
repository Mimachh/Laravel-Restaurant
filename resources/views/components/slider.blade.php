<section class="swiper mySwiper relative" id="welcome">
        <div class="swiper-wrapper ">
            @php
                $sliders = [
                    [
                        'id' => '1',
                        'alt' => 'Salade',
                        'image' => 'images/salade.webp'
                    ],
                    [
                        'id' => '2',
                        'alt' => 'Pate',
                        'image' => 'images/pate.webp'
                    ],
                    [
                        'id' => '3',
                        'alt' => 'Sandwich',
                        'image' => 'images/sandwich.webp'
                    ]
                ]
            @endphp
          @foreach ($sliders as $slider)
          <div class="swiper-slide ">
            <img
            class="object-cover w-full max-h-[80vh]"
                    src="{{ asset($slider['image']) }}"
                    alt="{{ $slider['alt'] }}"
                    width="640" height="360"
                    @if($slider['id'] === 1) fetchpriority="high" @else loading="lazy" @endif
            />

          </div>
          @endforeach
   
        </div>
        <div class="swiper-button-next z-20"></div>
        <div class="swiper-button-prev z-20"></div>
        <div class="swiper-pagination z-20"></div>
        
        <!-- Backgrop -->
        <div class="absolute inset-0 z-10 flex justify-center items-center
            backdrop-filter bg-primary/70 
            ">
                <div class="text-center space-y-6">
                    <h1 class="md:text-7xl text-xl font-semibold font-quicksand opacity-0" id="main-title">
                        <span class="text-light">BIENVENUE SUR</span> 
                        <span class="text-primaryDark">{{ env('APP_NAME') }}</span>
                    </h1>
                    <p class="text-md md:text-xl text-light opacity-0" id="subtitle">Cuisine traditionnelle</p>

                    <x-button 
                    title="Voir la carte"
                    class="text-light hover:bg-gold 
                    hover:border-gold hover:text-primary
                    border-2 border-light
                    "
                    targetId="menu"
                    type="scroll"
                    />

                </div>
            </div>
</section>

