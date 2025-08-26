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
                        <i class="ri-building-2-line text-primary text-2xl"></i>
                    </div>
                    <h3 class="font-playfair text-2xl font-medium text-primary mb-4">Ceremony</h3>
                    <p class="text-gray-700 mb-2">{{ $ceremonyName }}</p>
                    <p class="text-gray-600 mb-2">{{ $ceremonyAddress }}</p>
                    <p class="text-primary font-medium">{{ $ceremonyTime }}</p>
                </div>

                <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-8 text-center shadow-lg hover:shadow-xl transition-shadow">
                    <div class="w-16 h-16 flex items-center justify-center bg-primary/20 rounded-full mx-auto mb-6">
                        <i class="ri-goblet-line text-primary text-2xl"></i>
                    </div>
                    <h3 class="font-playfair text-2xl font-medium text-primary mb-4">Reception</h3>
                    <p class="text-gray-700 mb-2">{{ $receptionName }}</p>
                    <p class="text-gray-600 mb-2">{{ $receptionAddress }}</p>
                    <p class="text-primary font-medium">{{ $receptionTimeFormatted }}</p>
                </div>

                <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-8 text-center shadow-lg hover:shadow-xl transition-shadow">
                    <div class="w-16 h-16 flex items-center justify-center bg-primary/20 rounded-full mx-auto mb-6">
                        <i class="ri-shirt-line text-primary text-2xl"></i>
                    </div>
                    <h3 class="font-playfair text-2xl font-medium text-primary mb-4">Dress Code</h3>
                    <p class="text-gray-700 mb-2">{{ $dressCodeTitle }}</p>
                    <p class="text-gray-600 mb-2">{{ $dressCodeDescription }}</p>
                    <p class="text-primary font-medium">{{ $dressCodeColors }}</p>
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

@include('partials.footer')
</div>
