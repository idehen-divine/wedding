<div>
    <!-- Love Story Timeline -->
    <section class="pt-32 pb-20 px-6">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-16">
                <h1 class="font-playfair text-4xl md:text-5xl font-light text-primary mb-4">Our Love Story</h1>
                <p class="text-gray-600 text-lg">The journey that brought us together</p>
            </div>

            <!-- Love Story Timeline -->
            <div class="relative">
                <!-- Timeline line -->
                <div class="absolute left-1/2 transform -translate-x-1/2 w-1 bg-primary/30 h-full"></div>
                <!-- Timeline items -->
                <div class="space-y-16">
                    <div class="flex items-center">
                        <div class="w-1/2 pr-8 text-right">
                            <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 shadow-lg">
                                <h3 class="font-playfair text-xl font-medium text-primary mb-2">First Meeting</h3>
                                <p class="text-gray-600 text-sm mb-3">September 2019</p>
                                <p class="text-gray-700">We met at a coffee shop in downtown. Precious was reading her
                                    favorite book, and Franklin couldn't help but ask about it. The conversation lasted
                                    for
                                    hours.</p>
                            </div>
                        </div>
                        <div class="w-8 h-8 bg-primary rounded-full border-4 border-white shadow-lg relative z-10">
                        </div>
                        <div class="w-1/2 pl-8">
                            <img src="{{ asset('assets/images/story-1.jpg') }}" alt="First meeting"
                                class="w-full h-48 object-cover rounded-2xl shadow-lg" loading="lazy">
                        </div>
                    </div>

                    <div class="flex items-center">
                        <div class="w-1/2 pr-8">
                            <img src="{{ asset('assets/images/story-2.jpg') }}" alt="First date"
                                class="w-full h-48 object-cover rounded-2xl shadow-lg" loading="lazy">
                        </div>
                        <div class="w-8 h-8 bg-primary rounded-full border-4 border-white shadow-lg relative z-10">
                        </div>
                        <div class="w-1/2 pl-8">
                            <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 shadow-lg">
                                <h3 class="font-playfair text-xl font-medium text-primary mb-2">First Date</h3>
                                <p class="text-gray-600 text-sm mb-3">October 2019</p>
                                <p class="text-gray-700">Our first official date was at a charming Italian restaurant.
                                    Franklin was nervous, but Precious's laughter made everything perfect. We knew there
                                    was
                                    something special.</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <div class="w-1/2 pr-8 text-right">
                            <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 shadow-lg">
                                <h3 class="font-playfair text-xl font-medium text-primary mb-2">Moving In Together</h3>
                                <p class="text-gray-600 text-sm mb-3">June 2021</p>
                                <p class="text-gray-700">After two years of dating, we decided to take the next step.
                                    Moving in together was an adventure filled with furniture shopping and learning each
                                    other's habits.</p>
                            </div>
                        </div>
                        <div class="w-8 h-8 bg-primary rounded-full border-4 border-white shadow-lg relative z-10">
                        </div>
                        <div class="w-1/2 pl-8">
                            <img src="{{ asset('assets/images/story-3.jpg') }}" alt="Moving in"
                                class="w-full h-48 object-cover rounded-2xl shadow-lg" loading="lazy">
                        </div>
                    </div>

                    <div class="flex items-center">
                        <div class="w-1/2 pr-8">
                            <img src="{{ asset('assets/images/story-4.jpg') }}" alt="Proposal"
                                class="w-full h-48 object-cover rounded-2xl shadow-lg" loading="lazy">
                        </div>
                        <div class="w-8 h-8 bg-primary rounded-full border-4 border-white shadow-lg relative z-10">
                        </div>
                        <div class="w-1/2 pl-8">
                            <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 shadow-lg">
                                <h3 class="font-playfair text-xl font-medium text-primary mb-2">The Proposal</h3>
                                <p class="text-gray-600 text-sm mb-3">December 2023</p>
                                <p class="text-gray-700">Franklin proposed during a sunset walk on the beach where we
                                    had
                                    our first vacation together. Precious said yes before he could even finish asking
                                    the
                                    question!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Social Media & Hashtag Section -->
    <section class="py-20 px-6 bg-gradient-to-br from-primary/10 to-white/40">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="font-playfair text-4xl md:text-5xl font-light text-primary mb-4">Share the Love</h2>
            <p class="text-gray-600 text-lg mb-8">Follow our journey and share your photos using our wedding hashtag</p>

            <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-8 shadow-lg mb-8">
                <div class="text-4xl mb-4">📸</div>
                <h3 class="font-playfair text-2xl font-medium text-primary mb-4">#PreciousAndFranklinForever</h3>
                <p class="text-gray-600">Tag us in your photos and stories so we can see our special day through your
                    eyes!</p>
            </div>

            <div class="flex justify-center space-x-6">
                <a href="#"
                    class="w-12 h-12 flex items-center justify-center bg-pink-500 hover:bg-pink-600 text-white rounded-full transition-colors">
                    <i class="ri-instagram-line text-xl"></i>
                </a>
                <a href="#"
                    class="w-12 h-12 flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white rounded-full transition-colors">
                    <i class="ri-facebook-line text-xl"></i>
                </a>
                <a href="#"
                    class="w-12 h-12 flex items-center justify-center bg-blue-400 hover:bg-blue-500 text-white rounded-full transition-colors">
                    <i class="ri-twitter-line text-xl"></i>
                </a>
            </div>
        </div>
    </section>


    <livewire:footer />
</div>
