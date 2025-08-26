@php
use Illuminate\Support\Facades\Storage;
@endphp
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
                @if($storyEvents->count() > 0)
                    <!-- Timeline line -->
                    <div class="absolute left-1/2 transform -translate-x-1/2 w-1 bg-primary/30 h-full"></div>
                    <!-- Timeline items -->
                    <div class="space-y-16">
                        @foreach($storyEvents as $index => $event)
                            <div class="flex items-center">
                                @if($index % 2 === 0)
                                    {{-- Right image, left text --}}
                                    <div class="w-1/2 pr-8 text-right">
                                        <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 shadow-lg">
                                            <h3 class="font-playfair text-xl font-medium text-primary mb-2">{{ $event->title }}</h3>
                                            <p class="text-gray-600 text-sm mb-3">{{ $event->date }}</p>
                                            <p class="text-gray-700">{{ $event->description }}</p>
                                        </div>
                                    </div>
                                    <div class="w-8 h-8 bg-primary rounded-full border-4 border-white shadow-lg relative z-10"></div>
                                    <div class="w-1/2 pl-8">
                                        @if($event->image_path)
                                            <img src="{{ Storage::url($event->image_path) }}" alt="{{ $event->title }}"
                                                class="w-full h-48 object-cover rounded-2xl shadow-lg" loading="lazy">
                                        @endif
                                    </div>
                                @else
                                    {{-- Left image, right text --}}
                                    <div class="w-1/2 pr-8">
                                        @if($event->image_path)
                                            <img src="{{ Storage::url($event->image_path) }}" alt="{{ $event->title }}"
                                                class="w-full h-48 object-cover rounded-2xl shadow-lg" loading="lazy">
                                        @endif
                                    </div>
                                    <div class="w-8 h-8 bg-primary rounded-full border-4 border-white shadow-lg relative z-10"></div>
                                    <div class="w-1/2 pl-8">
                                        <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 shadow-lg">
                                            <h3 class="font-playfair text-xl font-medium text-primary mb-2">{{ $event->title }}</h3>
                                            <p class="text-gray-600 text-sm mb-3">{{ $event->date }}</p>
                                            <p class="text-gray-700">{{ $event->description }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <p class="text-gray-600 text-lg">Our love story timeline will be available soon...</p>
                    </div>
                @endif
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
                <h3 class="font-playfair text-2xl font-medium text-primary mb-4">{{ $weddingHashtag }}</h3>
                <p class="text-gray-600">Tag us in your photos and stories so we can see our special day through your
                    eyes!</p>
            </div>

            <div class="flex justify-center space-x-6">
                @if($instagramUrl && $instagramUrl !== '#')
                    <a href="{{ $instagramUrl }}"
                        class="w-12 h-12 flex items-center justify-center bg-pink-500 hover:bg-pink-600 text-white rounded-full transition-colors">
                        <i class="ri-instagram-line text-xl"></i>
                    </a>
                @endif
                
                @if($facebookUrl && $facebookUrl !== '#')
                    <a href="{{ $facebookUrl }}"
                        class="w-12 h-12 flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white rounded-full transition-colors">
                        <i class="ri-facebook-line text-xl"></i>
                    </a>
                @endif
                
                @if($twitterUrl && $twitterUrl !== '#')
                    <a href="{{ $twitterUrl }}"
                        class="w-12 h-12 flex items-center justify-center bg-blue-400 hover:bg-blue-500 text-white rounded-full transition-colors">
                        <i class="ri-twitter-line text-xl"></i>
                    </a>
                @endif
            </div>
        </div>
    </section>


@include('partials.footer')
</div>
