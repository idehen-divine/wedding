<!-- Gallery Section -->
<section class="py-20 px-6 bg-gradient-to-br from-white/40 to-primary/10">
    <div class="max-w-6xl mx-auto">
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
                    <button
                        class="bg-primary text-white px-6 py-2 !rounded-button font-medium transition-colors whitespace-nowrap active">
                        All Photos
                    </button>
                    <button
                        class="bg-white/80 text-gray-700 px-6 py-2 !rounded-button font-medium transition-colors whitespace-nowrap hover:bg-white">
                        Ceremony
                    </button>
                    <button
                        class="bg-white/80 text-gray-700 px-6 py-2 !rounded-button font-medium transition-colors whitespace-nowrap hover:bg-white">
                        Reception
                    </button>
                    <button
                        class="bg-white/80 text-gray-700 px-6 py-2 !rounded-button font-medium transition-colors whitespace-nowrap hover:bg-white">
                        Family
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <div class="group relative cursor-pointer" onclick="openLightbox(0)">
                    <img src="{{ asset('assets/gallery/wedding-1.jpg') }}"
                        alt="Wedding Ceremony" class="w-full h-80 object-cover rounded-2xl shadow-lg" />
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity rounded-2xl flex items-center justify-center">
                        <i class="ri-zoom-in-line text-white text-3xl"></i>
                    </div>
                    <button onclick="event.stopPropagation(); downloadImage(0)" class="absolute top-3 right-3 text-white/80 hover:text-white opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer z-10">
                        <i class="ri-download-line text-2xl"></i>
                    </button>
                </div>
                <div class="group relative cursor-pointer" onclick="openLightbox(1)">
                    <img src="{{ asset('assets/gallery/wedding-2.jpg') }}"
                        alt="First Dance" class="w-full h-80 object-cover rounded-2xl shadow-lg" />
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity rounded-2xl flex items-center justify-center">
                        <i class="ri-zoom-in-line text-white text-3xl"></i>
                    </div>
                    <button onclick="event.stopPropagation(); downloadImage(1)" class="absolute top-3 right-3 text-white/80 hover:text-white opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer z-10">
                        <i class="ri-download-line text-2xl"></i>
                    </button>
                </div>
                <div class="group relative cursor-pointer" onclick="openLightbox(2)">
                    <img src="{{ asset('assets/gallery/wedding-3.jpg') }}"
                        alt="Couple Portrait" class="w-full h-80 object-cover rounded-2xl shadow-lg" />
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity rounded-2xl flex items-center justify-center">
                        <i class="ri-zoom-in-line text-white text-3xl"></i>
                    </div>
                    <button onclick="event.stopPropagation(); downloadImage(2)" class="absolute top-3 right-3 text-white/80 hover:text-white opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer z-10">
                        <i class="ri-download-line text-2xl"></i>
                    </button>
                </div>
                <div class="group relative cursor-pointer" onclick="openLightbox(3)">
                    <img src="{{ asset('assets/gallery/wedding-4.jpg') }}"
                        alt="Cake Cutting" class="w-full h-80 object-cover rounded-2xl shadow-lg" />
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity rounded-2xl flex items-center justify-center">
                        <i class="ri-zoom-in-line text-white text-3xl"></i>
                    </div>
                    <button onclick="event.stopPropagation(); downloadImage(3)" class="absolute top-3 right-3 text-white/80 hover:text-white opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer z-10">
                        <i class="ri-download-line text-2xl"></i>
                    </button>
                </div>
                <div class="group relative cursor-pointer" onclick="openLightbox(4)">
                    <img src="{{ asset('assets/gallery/wedding-5.jpg') }}"
                        alt="Reception Details" class="w-full h-80 object-cover rounded-2xl shadow-lg" />
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity rounded-2xl flex items-center justify-center">
                        <i class="ri-zoom-in-line text-white text-3xl"></i>
                    </div>
                    <button onclick="event.stopPropagation(); downloadImage(4)" class="absolute top-3 right-3 text-white/80 hover:text-white opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer z-10">
                        <i class="ri-download-line text-2xl"></i>
                    </button>
                </div>
                <div class="group relative cursor-pointer" onclick="openLightbox(5)">
                    <img src="{{ asset('assets/gallery/wedding-6.jpg') }}"
                        alt="Bridal Party" class="w-full h-80 object-cover rounded-2xl shadow-lg" />
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity rounded-2xl flex items-center justify-center">
                        <i class="ri-zoom-in-line text-white text-3xl"></i>
                    </div>
                    <button onclick="event.stopPropagation(); downloadImage(5)" class="absolute top-3 right-3 text-white/80 hover:text-white opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer z-10">
                        <i class="ri-download-line text-2xl"></i>
                    </button>
                </div>
                <div class="group relative cursor-pointer" onclick="openLightbox(6)">
                    <img src="{{ asset('assets/gallery/wedding-7.jpg') }}"
                        alt="Ceremony Exit" class="w-full h-80 object-cover rounded-2xl shadow-lg" />
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity rounded-2xl flex items-center justify-center">
                        <i class="ri-zoom-in-line text-white text-3xl"></i>
                    </div>
                    <button onclick="event.stopPropagation(); downloadImage(6)" class="absolute top-3 right-3 text-white/80 hover:text-white opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer z-10">
                        <i class="ri-download-line text-2xl"></i>
                    </button>
                </div>
                <div class="group relative cursor-pointer" onclick="openLightbox(7)">
                    <img src="{{ asset('assets/gallery/wedding-8.jpg') }}"
                        alt="Reception Dancing" class="w-full h-80 object-cover rounded-2xl shadow-lg" />
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity rounded-2xl flex items-center justify-center">
                        <i class="ri-zoom-in-line text-white text-3xl"></i>
                    </div>
                    <button onclick="event.stopPropagation(); downloadImage(7)" class="absolute top-3 right-3 text-white/80 hover:text-white opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer z-10">
                        <i class="ri-download-line text-2xl"></i>
                    </button>
                </div>
            </div>


        @else
            <div class="h-screen flex items-center justify-center">
                <div class="text-center">
                    <div class="w-24 h-24 flex items-center justify-center bg-primary/20 rounded-full mx-auto mb-6">
                        <i class="ri-camera-line text-primary text-3xl"></i>
                    </div>
                    <h3 class="font-playfair text-3xl font-light text-primary mb-4">Coming Soon</h3>
                    <p class="text-gray-600 text-lg max-w-md mx-auto">
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
        <button onclick="downloadCurrentImage()" class="absolute top-6 right-16 text-white/80 hover:text-white cursor-pointer">
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
            <img id="lightboxImage" src="" alt="Lightbox image" class="max-h-[85vh] max-w-[85vw] object-contain rounded-lg shadow-2xl" />
        </div>
    </div>
</section>

<script id="gallery-lightbox">
    document.addEventListener("DOMContentLoaded", function () {
        const lightbox = document.getElementById("lightbox");
        const lightboxImage = document.getElementById("lightboxImage");
        let currentImageIndex = 0;

        const images = [
            "{{ asset('assets/gallery/wedding-1.jpg') }}",
            "{{ asset('assets/gallery/wedding-2.jpg') }}",
            "{{ asset('assets/gallery/wedding-3.jpg') }}",
            "{{ asset('assets/gallery/wedding-4.jpg') }}",
            "{{ asset('assets/gallery/wedding-5.jpg') }}",
            "{{ asset('assets/gallery/wedding-6.jpg') }}",
            "{{ asset('assets/gallery/wedding-7.jpg') }}",
            "{{ asset('assets/gallery/wedding-8.jpg') }}",
        ];

        window.openLightbox = function (index) {
            currentImageIndex = index;
            lightboxImage.src = images[index];
            lightbox.classList.remove("hidden");
            document.body.style.overflow = "hidden";
        };

        window.closeLightbox = function () {
            lightbox.classList.add("hidden");
            document.body.style.overflow = "";
        };

        window.navigateImage = function (direction) {
            currentImageIndex =
                (currentImageIndex + direction + images.length) % images.length;
            lightboxImage.src = images[currentImageIndex];
        };

        document.addEventListener("keydown", function (e) {
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
