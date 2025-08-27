<!-- Gallery Section -->
<section
    class="bg-gradient-to-br from-white/40 to-primary/10 {{ $isPublished ? 'py-20 px-6' : 'min-h-screen flex items-center justify-center overflow-hidden' }}">
    <div class="{{ $isPublished ? 'max-w-6xl mx-auto' : 'w-full' }}">
        @if ($isPublished)
            <div class="text-center mb-16">
                <h2 class="font-playfair text-4xl md:text-5xl font-light text-primary mb-4">
                    Photo Gallery
                </h2>
                <p class="text-gray-600 text-lg">
                    Cherished moments from our special day
                </p>
            </div>

            <div class="mb-12">
                <div class="flex items-center justify-center gap-4 mb-8">
                    <button wire:click="filterByCategory('all')"
                        class="{{ $selectedCategory === 'all' ? 'bg-primary text-white' : 'bg-white/80 text-gray-700 hover:bg-white' }} px-6 py-2 !rounded-button font-medium transition-colors whitespace-nowrap">
                        All Photos
                    </button>
                    <button wire:click="filterByCategory('ceremony')"
                        class="{{ $selectedCategory === 'ceremony' ? 'bg-primary text-white' : 'bg-white/80 text-gray-700 hover:bg-white' }} px-6 py-2 !rounded-button font-medium transition-colors whitespace-nowrap">
                        Ceremony
                    </button>
                    <button wire:click="filterByCategory('reception')"
                        class="{{ $selectedCategory === 'reception' ? 'bg-primary text-white' : 'bg-white/80 text-gray-700 hover:bg-white' }} px-6 py-2 !rounded-button font-medium transition-colors whitespace-nowrap">
                        Reception
                    </button>
                    <button wire:click="filterByCategory('family')"
                        class="{{ $selectedCategory === 'family' ? 'bg-primary text-white' : 'bg-white/80 text-gray-700 hover:bg-white' }} px-6 py-2 !rounded-button font-medium transition-colors whitespace-nowrap">
                        Family
                    </button>
                    <button wire:click="filterByCategory('couple')"
                        class="{{ $selectedCategory === 'couple' ? 'bg-primary text-white' : 'bg-white/80 text-gray-700 hover:bg-white' }} px-6 py-2 !rounded-button font-medium transition-colors whitespace-nowrap">
                        Couple
                    </button>
                </div>
            </div>

            @if ($galleryImages->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($galleryImages as $index => $image)
                        <div class="group relative cursor-pointer" onclick="openLightbox({{ $index }})">
                            <img src="{{ $image->image_url }}" alt="{{ $image->category->getLabel() }} Photo"
                                class="w-full h-80 object-cover rounded-2xl shadow-lg" loading="lazy" />
                            <div
                                class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity rounded-2xl flex items-center justify-center">
                                <i class="ri-zoom-in-line text-white text-3xl"></i>
                            </div>
                            <button onclick="event.stopPropagation(); downloadImage({{ $index }})"
                                class="absolute top-3 right-3 text-white/80 hover:text-white opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer z-10">
                                <i class="ri-download-line text-2xl"></i>
                            </button>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16">
                    <div class="w-24 h-24 flex items-center justify-center bg-primary/20 rounded-full mx-auto mb-6">
                        <i class="ri-camera-line text-primary text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-medium text-gray-800 mb-2">No Photos Yet</h3>
                    <p class="text-gray-600">
                        @if ($selectedCategory === 'all')
                            Photos will appear here once they're uploaded to the gallery.
                        @else
                            No photos found in the {{ ucfirst($selectedCategory) }} category.
                        @endif
                    </p>
                </div>
            @endif
        @else
            <div class="flex items-center justify-center py-8">
                <div class="text-center max-w-md mx-auto">
                    <div class="w-24 h-24 flex items-center justify-center bg-primary/20 rounded-full mx-auto mb-6">
                        <i class="ri-camera-line text-primary text-3xl"></i>
                    </div>
                    <h3 class="font-playfair text-3xl font-light text-primary mb-4">Coming Soon</h3>
                    <p class="text-gray-600 text-lg">
                        Our wedding photos will be available here after the celebration. Check back soon!
                    </p>
                </div>
            </div>
        @endif
    </div>

    <!-- Lightbox -->
    <div id="lightbox" class="fixed inset-0 bg-black/90 z-50 hidden">
        <button onclick="closeLightbox()" class="absolute top-6 right-6 text-white/80 hover:text-white cursor-pointer">
            <i class="ri-close-line text-3xl"></i>
        </button>
        <button onclick="downloadCurrentImage()"
            class="absolute top-6 right-16 text-white/80 hover:text-white cursor-pointer">
            <i class="ri-download-line text-3xl"></i>
        </button>
        <button id="prevButton" onclick="navigateImage(-1)"
            class="absolute left-6 top-1/2 -translate-y-1/2 text-white/80 hover:text-white cursor-pointer">
            <i class="ri-arrow-left-line text-3xl"></i>
        </button>
        <button id="nextButton" onclick="navigateImage(1)"
            class="absolute right-6 top-1/2 -translate-y-1/2 text-white/80 hover:text-white cursor-pointer">
            <i class="ri-arrow-right-line text-3xl"></i>
        </button>
        <div class="flex items-center justify-center h-full p-6">
            <img id="lightboxImage" src="" alt="Lightbox image"
                class="max-h-[85vh] max-w-[85vw] object-contain rounded-lg shadow-2xl" />
        </div>
    </div>
</section>

<script id="gallery-lightbox">
    document.addEventListener("DOMContentLoaded", function() {
        const lightbox = document.getElementById("lightbox");
        const lightboxImage = document.getElementById("lightboxImage");
        let currentImageIndex = 0;

        const images = [
            @foreach ($galleryImages as $image)
                "{{ $image->image_url }}"
                {{ !$loop->last ? ',' : '' }}
            @endforeach
        ];

        window.openLightbox = function(index) {
            currentImageIndex = index;
            lightboxImage.src = images[index];
            lightbox.classList.remove("hidden");
            document.body.style.overflow = "hidden";
        };

        window.closeLightbox = function() {
            lightbox.classList.add("hidden");
            document.body.style.overflow = "";
        };

        window.navigateImage = function(direction) {
            currentImageIndex =
                (currentImageIndex + direction + images.length) % images.length;
            lightboxImage.src = images[currentImageIndex];
        };

        document.addEventListener("keydown", function(e) {
            if (lightbox.classList.contains("hidden")) return;

            if (e.key === "Escape") closeLightbox();
            if (e.key === "ArrowLeft") navigateImage(-1);
            if (e.key === "ArrowRight") navigateImage(1);
        });

        // Download functionality
        window.downloadImage = function(index) {
            const link = document.createElement('a');
            link.href = images[index];
            link.download = `wedding-photo-${index + 1}.jpg`;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        };

        window.downloadCurrentImage = function() {
            downloadImage(currentImageIndex);
        };

    });
</script>
