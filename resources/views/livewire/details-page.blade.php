<div>
    <!-- Event Details Section -->
    <section class="pt-32 pb-20 px-6">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h1 class="font-playfair text-4xl md:text-5xl font-light text-primary mb-4">Event Details</h1>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">Join us as we celebrate the beginning of our forever</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 mb-16">
                <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-8 text-center shadow-lg hover:shadow-xl transition-shadow">
                    <div class="w-16 h-16 flex items-center justify-center bg-primary/20 rounded-full mx-auto mb-6">
                        <i class="ri-church-line text-primary text-2xl"></i>
                    </div>
                    <h3 class="font-playfair text-2xl font-medium text-primary mb-4">Ceremony</h3>
                    <p class="text-gray-700 mb-2">St. Mary's Cathedral</p>
                    <p class="text-gray-600 mb-2">123 Wedding Lane, Love City</p>
                    <p class="text-primary font-medium">4:00 PM</p>
                </div>

                <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-8 text-center shadow-lg hover:shadow-xl transition-shadow">
                    <div class="w-16 h-16 flex items-center justify-center bg-primary/20 rounded-full mx-auto mb-6">
                        <i class="ri-goblet-line text-primary text-2xl"></i>
                    </div>
                    <h3 class="font-playfair text-2xl font-medium text-primary mb-4">Reception</h3>
                    <p class="text-gray-700 mb-2">Grand Ballroom</p>
                    <p class="text-gray-600 mb-2">456 Celebration Ave, Love City</p>
                    <p class="text-primary font-medium">6:00 PM - 11:00 PM</p>
                </div>

                <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-8 text-center shadow-lg hover:shadow-xl transition-shadow">
                    <div class="w-16 h-16 flex items-center justify-center bg-primary/20 rounded-full mx-auto mb-6">
                        <i class="ri-shirt-line text-primary text-2xl"></i>
                    </div>
                    <h3 class="font-playfair text-2xl font-medium text-primary mb-4">Dress Code</h3>
                    <p class="text-gray-700 mb-2">Formal Attire</p>
                    <p class="text-gray-600 mb-2">Cocktail dresses & suits</p>
                    <p class="text-primary font-medium">Blush & Gold Welcome</p>
                </div>
            </div>

            <!-- Map -->
            <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-8 shadow-lg mb-8">
                <h3 class="font-playfair text-2xl font-medium text-primary mb-6 text-center">Venue Location</h3>
                <div class="w-full h-96 rounded-xl overflow-hidden"
                    style="background-image: url('{{ asset('assets/images/map-placeholder.png') }}'); background-size: cover; background-position: center;">
                </div>
            </div>
        </div>
    </section>

    <livewire:footer />
</div>
