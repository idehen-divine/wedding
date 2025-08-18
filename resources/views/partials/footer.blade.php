<!-- Footer -->
<footer class="bg-primary/20 pt-8 px-6 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10"
        style="background-image: url('{{ asset('assets/images/footer-bg.jpg') }}'); background-size: cover; background-position: center;">
    </div>

    <div class="max-w-6xl mx-auto relative z-10">
        <div class="grid md:grid-cols-4 gap-8 mb-4">
            <div class="text-center md:text-left">
                <a href="{{ route('home') }}" class="font-playfair text-2xl font-medium text-primary mb-4">Precious & Franklin</a>
                <p class="text-gray-600">Celebrating love, family, and the beginning of our forever journey
                    together.</p>
            </div>

            <div class="text-center md:text-left">
                <h4 class="font-medium text-gray-800 mb-4">Contact</h4>
                <p class="text-gray-600 mb-2">wedding@preciousfranklin.com</p>
                <p class="text-gray-600">+1 (555) 123-4567</p>
            </div>

            <div class="text-center md:text-left">
                <h4 class="font-medium text-gray-800 mb-4">Quick Links</h4>
                <div class="space-y-2">
                    <a href="{{ route('details') }}" class="block text-gray-600 hover:text-primary transition-colors">Event
                        Details</a>
                    <a href="{{ route('rsvp') }}" class="block text-gray-600 hover:text-primary transition-colors">RSVP</a>
                    <a href="{{ route('gallery') }}" class="block text-gray-600 hover:text-primary transition-colors">Gallery</a>
                    <a href="{{ route('story') }}" class="block text-gray-600 hover:text-primary transition-colors">Our
                        Story</a>
                </div>
            </div>

            <div class="text-center md:text-left">
                <h4 class="font-medium text-gray-800 mb-4">Follow Us</h4>
                <div class="flex justify-center md:justify-start space-x-4">
                    <a href="#"
                        class="w-8 h-8 flex items-center justify-center bg-primary/20 hover:bg-primary/30 text-primary rounded-full transition-colors">
                        <i class="ri-instagram-line"></i>
                    </a>
                    <a href="#"
                        class="w-8 h-8 flex items-center justify-center bg-primary/20 hover:bg-primary/30 text-primary rounded-full transition-colors">
                        <i class="ri-facebook-line"></i>
                    </a>
                    <a href="#"
                        class="w-8 h-8 flex items-center justify-center bg-primary/20 hover:bg-primary/30 text-primary rounded-full transition-colors">
                        <i class="ri-twitter-line"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="border-t border-primary/20 py-4 text-center">
            <p class="text-gray-600">&copy; 2025 Precious & Franklin Wedding. Made with love for our special day.
            </p>
        </div>
    </div>
</footer>