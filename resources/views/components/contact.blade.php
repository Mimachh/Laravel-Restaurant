<section class="bg-creme">
    <div class="max-w-[1400px] mx-auto">

    <section class="py-20 lg:py-[120px] overflow-hidden relative z-10">
        <div class="container">
            <div class="flex flex-wrap lg:justify-between md:-mx-4">
                <div class="w-full lg:w-1/2 xl:w-6/12 px-4">
                    <div class="max-w-[570px] mb-12 lg:mb-0">
                    <h2
                        class="
                        text-primary
                        mb-6
                        uppercase
                        font-bold
                        text-[32px]
                        sm:text-[40px]
                        lg:text-[36px]
                        xl:text-[40px]
                        text-center md:text-start
                        "
                        >
                        NOUS CONTACTER
                    </h2>
                    <p class="text-base text-primary leading-relaxed mb-9">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                        eius tempor incididunt ut labore et dolore magna aliqua. Ut enim
                        adiqua minim veniam quis nostrud exercitation ullamco
                    </p>

                    </div>
                </div>
                <div class="w-full lg:w-1/2 xl:w-5/12 px-4">
                    <div class="bg-white relative rounded-lg p-8 sm:p-12 shadow-lg">
                    <form action="{{ route('contact.store') }}" method="post">
                        @csrf
                        <div class="mb-6">
                            <input
                                type="text"
                                name="nom"
                                placeholder="Votre nom*"
                                class="
                                w-full
                                rounded
                                py-3
                                px-[14px]
                                text-body-color text-base
                                
                                outline-none
                                focus-visible:shadow-none
                                focus:border-primary
                                "
                                required
                                autocomplete="name"
                                />

                            @error('nom')
                                <span class="text-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <input
                                type="email"
                                name="email"
                                placeholder="Votre mail*"
                                class="
                                w-full
                                rounded
                                py-3
                                px-[14px]
                                text-body-color text-base
                                
                                outline-none
                                focus-visible:shadow-none
                                focus:border-primary
                                "
                                required
                                autocomplete="email"
                                />

                            @error('email')
                                <span class="text-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <input
                                type="text"
                                name="phone"
                                placeholder="Votre téléphone"
                                class="
                                w-full
                                rounded
                                py-3
                                px-[14px]
                                text-body-color text-base
                                
                                outline-none
                                focus-visible:shadow-none
                                focus:border-primary
                                "
                                autocomplete="phone"
                                />

                            @error('phone')
                                <span class="text-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <textarea
                                name="message"
                                rows="6"
                                placeholder="Votre message*"
                                class="
                                w-full
                                rounded
                                py-3
                                px-[14px]
                                text-body-color text-base
                                
                                resize-none
                                outline-none
                                focus-visible:shadow-none
                                focus:border-primary
                                "
                                required
                                ></textarea>

                            @error('message')
                                <span class="text-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-6">
                            
                        <div class="flex justify-center items-center gap-3">
                            <input
                                name="rules"
                                id="rules"
                                type="checkbox"
                                class="
                                rounded
                                px-[14px]
                                resize-none
                                outline-none
                                focus-visible:shadow-none
                                focus:border-primary
                                "
                                required
                                value="1"
                            />
                            <label for="rules">J'ai pris connaissance des <a href="" class="underline">conditions d'utilisation*</a></label>
                            </div>
                            @error('rules')
                                <span class="text-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <button
                                type="submit"
                                class="
                                w-full
                                text-light
                                bg-primary
                                rounded
                                border border-primary
                                p-3
                                transition
                                hover:bg-opacity-90
                                "
                                >
                                Envoyer
                            </button>
                            <small class="w-full">* champs obligatoires</small>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>
</section>