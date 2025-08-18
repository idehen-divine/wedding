<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Precious & Franklin Wedding - August 30, 2025' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-inter text-gray-800 overflow-x-hidden {{ request()->routeIs('home') ? 'h-screen overflow-hidden' : '' }}"
    style="background: linear-gradient(135deg, #FDF4F0 0%, #F9E8E1 50%, #F5DDD4 100%);">

    <!-- Navigation -->
    <livewire:navigation />

    <!-- Main Content -->
    {{ $slot }}

    @livewireScripts
</body>

</html>