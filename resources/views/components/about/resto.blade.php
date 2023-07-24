<section class="bg-creme" id="a_propos">
    <div class="max-w-[1400px] mx-auto py-16">


        <x-section-title 
        title="Bienvenue à notre restaurant"
        subtitle="La meilleure street food du coin"
        class="py-4 md:py-8 text-primary"
        />

        <div class="grid grid-cols-4 gap-8 md:gap-3 mt-2 md:mt-8 pb-8">
            <div class="col-span-4 lg:col-span-2 text-primary px-8 md:px-16 font-poppins 
            space-y-8 text-center opacity-0" id="aboutContent">
                <p class="tracking-wide leading-6 text-sm md:text-md text-start">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptate quae maxime aut, praesentium enim eos deserunt consequatur ea rem, sed iure dolorem nulla debitis, voluptates nemo laboriosam? Cumque, ut natus.
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore perspiciatis corporis nemo sequi aperiam quam, ipsum, sapiente ullam quia porro placeat numquam necessitatibus. Quam deserunt tempore dolorem! Ipsam, in nisi?
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque, commodi ducimus obcaecati deleniti dolor, expedita quisquam nesciunt, officia corporis voluptatum eaque assumenda porro necessitatibus et rerum non quidem quis quia.
                </p>
                <p class="italic">L'equipe du restaurant</p>
                <x-button 
                    title="Réserver"
                    class="text-primary hover:bg-primary 
                     hover:text-light 
                    border border-primary font-medium
                    rounded-full
                    "
                    type="modal"
                />
            </div>
            <div class="col-span-4 md:col-span-2 lg:col-span-1
            space-y-8 
            ">

                <x-about.image 
                src="images/salade.jpg"
                backdrop="backdrop-filter bg-gold/20"
                id="aboutImage1"
                class="opacity-0"
                />

                <x-about.image 
                src="images/pate.jpg"
                backdrop="backdrop-filter bg-primary/60"
                id="aboutImage2"
                class="opacity-0"
                />

            </div>
            <div class="col-span-4 md:col-span-2 lg:col-span-1
            space-y-8 md:pt-0 lg:pt-8
            ">
                <x-about.image 
                src="images/salade.jpg"
                backdrop="backdrop-filter bg-primary/40"
                id="aboutImage3"
                class="opacity-0"
                />

                <x-about.image 
                src="images/pate.jpg"
                backdrop="backdrop-filter bg-gold/20"
                id="aboutImage4"
                class="opacity-0"
                />
            </div>
        </div>
    </div>
</section>
