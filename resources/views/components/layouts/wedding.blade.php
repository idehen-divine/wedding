<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Precious & Franklin Wedding - August 30, 2025' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-inter text-gray-800 overflow-x-hidden {{ request()->routeIs('home') ? 'h-screen overflow-hidden' : '' }}"
    style="background: linear-gradient(135deg, #FDF4F0 0%, #F9E8E1 50%, #F5DDD4 100%);">

    <!-- Navigation -->
    <livewire:navigation />

    <!-- Main Content -->
    {{ $slot }}

    <!-- Footer -->
    @php
        // Global wedding settings for layout components
        $backgroundMusic = \App\Models\WeddingSetting::get('background_music');
        
        // Footer data - loaded once for all pages
        $footerData = [
            'bride_name' => \App\Models\WeddingSetting::get('bride_name', 'Precious'),
            'groom_name' => \App\Models\WeddingSetting::get('groom_name', 'Franklin'),
            'footer_tagline' => \App\Models\WeddingSetting::get('footer_tagline', 'Celebrating love, family, and the beginning of our forever journey together.'),
            'contact_email' => \App\Models\WeddingSetting::get('contact_email', 'wedding@preciousfranklin.com'),
            'contact_phone' => \App\Models\WeddingSetting::get('contact_phone', '+1 (555) 123-4567'),
            'instagram_url' => \App\Models\WeddingSetting::get('instagram_url'),
            'facebook_url' => \App\Models\WeddingSetting::get('facebook_url'),
            'twitter_url' => \App\Models\WeddingSetting::get('twitter_url'),
        ];
    @endphp

    @include('partials.footer', ['footerData' => $footerData])

    <!-- Pass background music URL to JavaScript -->
    @if($backgroundMusic)
    <script>
        window.backgroundMusicUrl = "{{ asset($backgroundMusic) }}";
        console.log('Layout set background music URL:', window.backgroundMusicUrl);
    </script>
    @else
    <script>
        console.log('No background music set in database');
    </script>
    @endif

    @livewireScripts
</body>

</html>