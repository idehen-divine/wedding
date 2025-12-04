@php
    use Illuminate\Support\Facades\Storage;
@endphp
<div>
    <!-- Love Story Timeline -->
    <section class="pt-24 pb-16 px-4 md:px-6">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <h1 class="font-playfair text-4xl md:text-5xl font-light text-primary mb-4">Our Love Story</h1>
                <p class="text-gray-600 text-lg">The journey that brought us together</p>
            </div>

            <!-- Love Story Timeline -->
            <div class="relative">
                @if ($storyEvents->count() > 0)
                    <!-- Timeline line (hidden on small screens) -->
                    <div class="hidden md:block absolute left-1/2 transform -translate-x-1/2 w-1 bg-primary/30 h-full">
                    </div>
                    <!-- Timeline items -->
                    <div class="space-y-12">
                        @foreach ($storyEvents as $index => $event)
                            @php
                                $isEven = $index % 2 === 0;
                                // Even index: Image LEFT (order-1), Text RIGHT (order-3)
                                // Odd index: Image RIGHT (order-3), Text LEFT (order-1)
                                $imageOrder = $isEven ? '1' : '3';
                                $textOrder = $isEven ? '3' : '1';
                                $textAlign = $isEven ? 'right' : 'left';
                                $imagePadding = $isEven ? 'md:pr-6' : 'md:pl-6';
                                $textPadding = $isEven ? 'md:pl-6' : 'md:pr-6';
                            @endphp
                            <div class="flex flex-col md:flex-row items-center md:items-stretch">
                                {{-- Image --}}
                                <div
                                    class="w-full md:w-1/2 order-1 md:order-{{ $imageOrder }} {{ $imagePadding }} mt-0 md:mt-0">
                                    @if ($event->image_path)
                                        <div class="w-full aspect-[4/3] md:aspect-[4/3] lg:aspect-[5/4] overflow-hidden rounded-2xl shadow-lg">
                                            <img src="{{ url('storage/' . ltrim($event->image_path, '/')) }}"
                                                alt="{{ $event->title }}"
                                                class="w-full h-full object-cover"
                                                loading="lazy">
                                        </div>
                                    @endif
                                </div>

                                {{-- Dot (center) visible only on md+ --}}
                                <div
                                    class="hidden md:block w-8 h-8 bg-primary rounded-full border-4 border-white shadow-lg relative z-10 mx-3 md:order-2 flex-shrink-0">
                                </div>

                                {{-- Text block --}}
                                <div
                                    class="w-full md:w-1/2 order-2 md:order-{{ $textOrder }} {{ $textPadding }} mt-6 md:mt-0 text-center md:text-{{ $textAlign }}">
                                    <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 shadow-lg">
                                        <h3 class="font-playfair text-xl font-medium text-primary mb-2">
                                            {{ $event->title }}</h3>
                                        <p class="text-gray-600 text-sm mb-3">{{ $event->date }}</p>
                                        <p class="text-gray-700">{{ $event->description }}</p>
                                    </div>
                                </div>
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
    <section class="py-16 px-4 md:px-6 bg-gradient-to-br from-primary/10 to-white/40">
        <div class="max-w-6xl mx-auto text-center">
            <h2 class="font-playfair text-4xl md:text-5xl font-light text-primary mb-4">Share the Love</h2>
            <p class="text-gray-600 text-lg mb-8">Follow our journey and share your photos using our wedding hashtag</p>

            <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-8 shadow-lg mb-8">
                <div class="text-4xl mb-4">📸</div>
                <h3
                    class="font-playfair text-xl sm:text-2xl md:text-3xl lg:text-4xl font-medium text-primary mb-4 break-words whitespace-normal inline-block">
                    {{ $weddingHashtag }}</h3>
                <p class="text-gray-600">Tag us in your photos and stories so we can see our special day through your
                    eyes!</p>
            </div>

            <div class="flex justify-center space-x-6">
                @if ($instagramUrl && $instagramUrl !== '#')
                    <a href="{{ $instagramUrl }}"
                        class="w-12 h-12 flex items-center justify-center bg-pink-500 hover:bg-pink-600 text-white rounded-full transition-colors">
                        <i class="ri-instagram-line text-xl"></i>
                    </a>
                @endif

                @if ($facebookUrl && $facebookUrl !== '#')
                    <a href="{{ $facebookUrl }}"
                        class="w-12 h-12 flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white rounded-full transition-colors">
                        <i class="ri-facebook-line text-xl"></i>
                    </a>
                @endif

                @if ($twitterUrl && $twitterUrl !== '#')
                    <a href="{{ $twitterUrl }}"
                        class="w-12 h-12 flex items-center justify-center bg-blue-400 hover:bg-blue-500 text-white rounded-full transition-colors">
                        <i class="ri-twitter-line text-xl"></i>
                    </a>
                @endif
            </div>
        </div>
    </section>
</div>
