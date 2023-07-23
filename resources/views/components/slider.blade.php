<div class="swiper mySwiper relative">
        <div class="swiper-wrapper ">
            @php
                $sliders = [
                    [
                        'alt' => 'Salade',
                        'image' => 'images/salade.jpg'
                    ],
                    [
                        'alt' => 'Pate',
                        'image' => 'images/pate.jpg'
                    ],
                    [
                        'alt' => 'Sandwich',
                        'image' => 'images/sandwich.jpg'
                    ]
                ]
            @endphp
          @foreach ($sliders as $slider)
          <div class="swiper-slide ">
            <img
            class="object-cover w-full max-h-[80vh]"
                    src="{{ asset($slider['image']) }}"
                    alt="{{ $slider['alt'] }}"
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
                    <h1 class="md:text-7xl text-xl font-semibold font-poppins">
                        <span class="text-light">BIENVENUE SUR</span> 
                        <span class="text-gold ">LABOOM</span>
                    </h1>
                    <p class="text-md md:text-xl text-light">Cuisine traditionnelle</p>

                    <x-button 
                    title="Voir les recettes"
                    class="text-light hover:bg-gold 
                    hover:border-gold hover:text-primary
                    border-2 border-light
                    "
                    />

                </div>
            </div>
      </div>