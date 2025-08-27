<!-- Gallery Section -->
<section class="h-screen flex items-center justify-center">
    <div class="max-w-6xl mx-auto text-center">
        @if ($isPublished)
            <!-- Published Gallery Content -->
            <div>
                <div class="w-24 h-24 flex items-center justify-center bg-primary/20 rounded-full mx-auto mb-6">
                    <i class="ri-image-line text-primary text-3xl"></i>
                </div>
                <h3 class="font-playfair text-3xl font-light text-primary mb-4">Wedding Gallery</h3>
                <p class="text-gray-600 text-lg max-w-md mx-auto mb-8">
                    Relive the beautiful moments from our special day through these cherished memories.
                </p>
                
                <!-- Sample gallery grid - replace with actual gallery implementation -->
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 max-w-4xl mx-auto">
                    @for ($i = 1; $i <= 8; $i++)
                        <div class="aspect-square bg-gray-200 rounded-lg flex items-center justify-center">
                            <i class="ri-image-line text-gray-400 text-2xl"></i>
                        </div>
                    @endfor
                </div>
                
                <p class="text-sm text-gray-500 mt-6">
                    Click on any photo to view in full size
                </p>
            </div>
        @else
            <!-- Coming Soon Content -->
            <div>
                <div class="w-24 h-24 flex items-center justify-center bg-primary/20 rounded-full mx-auto mb-6">
                    <i class="ri-camera-line text-primary text-3xl"></i>
                </div>
                <h3 class="font-playfair text-3xl font-light text-primary mb-4">Coming Soon</h3>
                <p class="text-gray-600 text-lg max-w-md mx-auto">
                    Our wedding photos will be available here after the celebration. Check back soon!
                </p>
            </div>
        @endif
    </div>
</section>
