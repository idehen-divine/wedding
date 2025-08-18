<nav class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-md border-b border-primary/20"
     x-data="{
        mobileMenuOpen: false,
        musicPlaying: false,
        init() {
            // Preload audio for better user experience across all pages
            const audioLink = document.createElement('link');
            audioLink.rel = 'prefetch';
            audioLink.href = '/assets/audio/harmony.mp3';
            document.head.appendChild(audioLink);

            // Sync with global music state
            this.musicPlaying = window.musicPlayer?.isPlaying || false;

            // Listen for global music state changes
            window.addEventListener('music-state-changed', (e) => {
                this.musicPlaying = e.detail.isPlaying;
            });
        }
     }">
    <div class="max-w-7xl mx-auto px-6 py-4">
        <div class="flex items-center justify-between">
            <a href="{{ route('home') }}" wire:navigate.hover class="font-playfair text-2xl font-semibold text-primary">P & F</a >

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" wire:navigate.hover
                   class="{{ request()->routeIs('home') ? 'text-primary font-medium' : 'text-gray-700 hover:text-primary transition-colors' }}">
                    Home
                </a>
                <a href="{{ route('details') }}" wire:navigate.hover
                   class="{{ request()->routeIs('details') ? 'text-primary font-medium' : 'text-gray-700 hover:text-primary transition-colors' }}">
                    Event Details
                </a>
                <a href="{{ route('rsvp') }}" wire:navigate.hover
                   class="{{ request()->routeIs('rsvp') ? 'text-primary font-medium' : 'text-gray-700 hover:text-primary transition-colors' }}">
                    RSVP
                </a>
                <a href="{{ route('gallery') }}" wire:navigate.hover
                   class="{{ request()->routeIs('gallery') ? 'text-primary font-medium' : 'text-gray-700 hover:text-primary transition-colors' }}">
                    Gallery
                </a>
                <a href="{{ route('wishes') }}" wire:navigate.hover
                   class="{{ request()->routeIs('wishes') ? 'text-primary font-medium' : 'text-gray-700 hover:text-primary transition-colors' }}">
                    Wishes
                </a>
                <a href="{{ route('story') }}" wire:navigate.hover
                   class="{{ request()->routeIs('story') ? 'text-primary font-medium' : 'text-gray-700 hover:text-primary transition-colors' }}">
                    Our Story
                </a>
            </div>

            <!-- Right Side Controls -->
            <div class="flex items-center space-x-4">
                <!-- Music Toggle -->
                <button
                    @click="window.musicPlayer.toggle()"
                    class="w-10 h-10 flex items-center justify-center rounded-full transition-colors"
                    :class="musicPlaying ? 'bg-primary/30' : 'bg-primary/20 hover:bg-primary/30'">
                    <i :class="musicPlaying ? 'ri-pause-line text-primary' : 'ri-music-line text-primary'"></i>
                </button>

                <!-- Mobile Menu Toggle -->
                <button
                    @click="mobileMenuOpen = !mobileMenuOpen"
                    class="md:hidden w-10 h-10 flex items-center justify-center">
                    <i class="ri-menu-line text-gray-700"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div class="md:hidden mt-4 pb-4 border-t border-primary/20"
             x-show="mobileMenuOpen"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-1"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-1">
            <div class="flex flex-col space-y-4 pt-4">
                <a href="{{ route('home') }}" wire:navigate.hover
                   class="{{ request()->routeIs('home') ? 'text-primary font-medium' : 'text-gray-700' }}">
                    Home
                </a>
                <a href="{{ route('details') }}" wire:navigate.hover
                   class="{{ request()->routeIs('details') ? 'text-primary font-medium' : 'text-gray-700' }}">
                    Event Details
                </a>
                <a href="{{ route('rsvp') }}" wire:navigate.hover
                   class="{{ request()->routeIs('rsvp') ? 'text-primary font-medium' : 'text-gray-700' }}">
                    RSVP
                </a>
                <a href="{{ route('gallery') }}" wire:navigate.hover
                   class="{{ request()->routeIs('gallery') ? 'text-primary font-medium' : 'text-gray-700' }}">
                    Gallery
                </a>
                <a href="{{ route('wishes') }}" wire:navigate.hover
                   class="{{ request()->routeIs('wishes') ? 'text-primary font-medium' : 'text-gray-700' }}">
                    Wishes
                </a>
                <a href="{{ route('story') }}" wire:navigate.hover
                   class="{{ request()->routeIs('story') ? 'text-primary font-medium' : 'text-gray-700' }}">
                    Our Story
                </a>
            </div>
        </div>
    </div>
</nav>
