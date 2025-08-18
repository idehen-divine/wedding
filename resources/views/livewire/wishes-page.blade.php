<div x-data="{ showModal: false }">
    <!-- Guest Wishes Section -->
    <section class="pt-32 pb-20 px-6 bg-gradient-to-br from-white/40 to-primary/10">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-16">
                <h1 class="font-playfair text-4xl md:text-5xl font-light text-primary mb-4">Guest Wishes</h1>
                <p class="text-gray-600 text-lg">Share your congratulations and well wishes</p>
            </div>

            <div class="grid md:grid-cols-2 gap-6 mb-12">
                <div class="bg-gradient-to-br from-white/80 to-primary/10 backdrop-blur-sm rounded-2xl p-6 shadow-lg">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-primary/20 rounded-full flex items-center justify-center">
                            <span class="text-primary font-medium">MJ</span>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-medium text-gray-800 mb-1">Michael Johnson</h4>
                            <p class="text-gray-600 text-sm mb-2">2 days ago</p>
                            <p class="text-gray-700">"Wishing you both a lifetime of love, happiness, and endless
                                adventures together. Congratulations on your beautiful union!"</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-white/80 to-primary/10 backdrop-blur-sm rounded-2xl p-6 shadow-lg">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-primary/20 rounded-full flex items-center justify-center">
                            <span class="text-primary font-medium">SB</span>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-medium text-gray-800 mb-1">Sarah Brown</h4>
                            <p class="text-gray-600 text-sm mb-2">3 days ago</p>
                            <p class="text-gray-700">"So excited to celebrate with you both! May your marriage be filled
                                with all the right ingredients: love, laughter, and lots of wine!"</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-white/80 to-primary/10 backdrop-blur-sm rounded-2xl p-6 shadow-lg">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-primary/20 rounded-full flex items-center justify-center">
                            <span class="text-primary font-medium">DW</span>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-medium text-gray-800 mb-1">David Wilson</h4>
                            <p class="text-gray-600 text-sm mb-2">5 days ago</p>
                            <p class="text-gray-700">"Congratulations to the perfect couple! Your love story is truly
                                inspiring. Can't wait to dance at your wedding!"</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-white/80 to-primary/10 backdrop-blur-sm rounded-2xl p-6 shadow-lg">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-primary/20 rounded-full flex items-center justify-center">
                            <span class="text-primary font-medium">LM</span>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-medium text-gray-800 mb-1">Lisa Martinez</h4>
                            <p class="text-gray-600 text-sm mb-2">1 week ago</p>
                            <p class="text-gray-700">"Wishing you a wonderful journey as you build your new lives
                                together. May your love continue to grow stronger each day!"</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <button @click="showModal = true"
                    class="bg-primary hover:bg-primary/90 text-white px-8 py-3 rounded-button font-medium transition-colors whitespace-nowrap">
                    <i class="ri-heart-line mr-2"></i>Add Your Wish
                </button>
            </div>
        </div>

        <!-- Add Wish Modal -->
        <div x-show="showModal" x-cloak
            class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-6"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0">
            <div class="bg-white rounded-2xl p-8 max-w-md w-full"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-90"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-90"
                 @click.outside="showModal = false">
                <h3 class="font-playfair text-2xl font-medium text-primary mb-6">Share Your Wishes</h3>
                <form class="space-y-4">
                    <input type="text" placeholder="Your Name" required
                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-colors text-sm">
                    <textarea rows="4" placeholder="Your message for the couple..." required
                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-colors text-sm"></textarea>
                    <div class="flex space-x-4">
                        <button type="button" @click="showModal = false"
                            class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 py-3 rounded-button font-medium transition-colors whitespace-nowrap">
                            Cancel
                        </button>
                        <button type="submit"
                            class="flex-1 bg-primary hover:bg-primary/90 text-white py-3 rounded-button font-medium transition-colors whitespace-nowrap">
                            Share Wish
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <livewire:footer />
</div>
