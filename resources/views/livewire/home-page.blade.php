<!-- Hero Section -->
<section class="h-screen flex items-center justify-center relative overflow-hidden pt-20 pb-10"
    style="background-image: url('/assets/images/hero-bg.jpg'); background-size: cover; background-position: center;">
    <div class="absolute inset-0 bg-gradient-to-br from-white/60 via-transparent to-primary/20"></div>

    <!-- Floating Floral Elements -->
    <div class="absolute top-32 left-20 w-32 h-32 opacity-30">
        <img src="/assets/images/floral-1.png" alt="Floral decoration" class="w-full h-full object-contain" loading="lazy">
    </div>
    <div class="absolute bottom-32 right-20 w-40 h-40 opacity-25">
        <img src="/assets/images/floral-2.png" alt="Floral decoration" class="w-full h-full object-contain"
            loading="lazy">
    </div>

    <div class="relative z-10 text-center max-w-4xl mx-auto px-6">
        <h1 class="font-playfair text-7xl 2xl:text-8xl font-light text-primary mb-4 italic">
            {{ $brideName }}<br>
            <span class="text-5xl lg:text-6xl xl:text-7xl">&</span><br>
            {{ $groomName }}
        </h1>
        <p class="text-primary font-inter text-xl md:text-2xl tracking-wider uppercase mb-8">{{ $formattedDate }}</p>

        <!-- Countdown Timer -->
        <div class="flex justify-center space-x-4 md:space-x-6 mb-2">
            <div class="bg-primary/80 backdrop-blur-sm rounded-lg p-3 md:p-4 min-w-[60px] md:min-w-[70px]">
                <div id="days" class="text-white text-xl md:text-2xl font-bold">120</div>
                <div class="text-white/90 text-xs md:text-sm uppercase tracking-wide">Days</div>
            </div>
            <div class="bg-primary/80 backdrop-blur-sm rounded-lg p-3 md:p-4 min-w-[60px] md:min-w-[70px]">
                <div id="hours" class="text-white text-xl md:text-2xl font-bold">07</div>
                <div class="text-white/90 text-xs md:text-sm uppercase tracking-wide">Hrs</div>
            </div>
            <div class="bg-primary/80 backdrop-blur-sm rounded-lg p-3 md:p-4 min-w-[60px] md:min-w-[70px]">
                <div id="minutes" class="text-white text-xl md:text-2xl font-bold">33</div>
                <div class="text-white/90 text-xs md:text-sm uppercase tracking-wide">Mins</div>
            </div>
            <div class="bg-primary/80 backdrop-blur-sm rounded-lg p-3 md:p-4 min-w-[60px] md:min-w-[70px]">
                <div id="seconds" class="text-white text-xl md:text-2xl font-bold">03</div>
                <div class="text-white/90 text-xs md:text-sm uppercase tracking-wide">Secs</div>
            </div>
        </div>

        <p
            class="text-primary text-lg md:text-xl mb-2 font-medium bg-white/80 px-4 py-2 rounded-lg inline-block my-4 sm:my-2 2xl:my-10">
            You are cordially invited to celebrate our wedding
        </p>

        <div class="flex flex-row gap-3 md:gap-4 justify-center my-4 sm:my-0">
            <a href="{{ route('rsvp') }}"
                class="bg-primary hover:bg-primary/90 text-white px-6 md:px-8 py-2.5 md:py-3 rounded-[8px] font-medium transition-all whitespace-nowrap inline-block text-center text-sm md:text-base">
                RSVP
            </a>
            <a href="{{ route('details') }}"
                class="bg-white/80 hover:bg-white text-primary border border-primary px-6 md:px-8 py-2.5 md:py-3 rounded-[8px] font-medium transition-all whitespace-nowrap inline-block text-center text-sm md:text-base">
                Event Details
            </a>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Countdown Timer
    const weddingDateTime = '{{ $weddingDateTime }}';
    
    // Debug: Show what we're trying to parse
    console.log('Debug weddingDateTime received:', weddingDateTime);
    
    // Validate the datetime string before creating Date object
    if (!weddingDateTime || weddingDateTime === '') {
        console.error('Wedding datetime not available');
        return;
    }
    
    const weddingDate = new Date(weddingDateTime).getTime();
    
    // Check if the date is valid
    if (isNaN(weddingDate)) {
        console.error('Invalid wedding date:', weddingDateTime);
        return;
    }

    function updateCountdown() {
        const now = new Date().getTime();
        const distance = weddingDate - now;

        const daysEl = document.getElementById('days');
        const hoursEl = document.getElementById('hours');
        const minutesEl = document.getElementById('minutes');
        const secondsEl = document.getElementById('seconds');

        // Check if elements exist
        if (!daysEl || !hoursEl || !minutesEl || !secondsEl) {
            return;
        }

        if (distance < 0) {
            daysEl.innerHTML = '00';
            hoursEl.innerHTML = '00';
            minutesEl.innerHTML = '00';
            secondsEl.innerHTML = '00';
            return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        daysEl.innerHTML = days.toString().padStart(2, '0');
        hoursEl.innerHTML = hours.toString().padStart(2, '0');
        minutesEl.innerHTML = minutes.toString().padStart(2, '0');
        secondsEl.innerHTML = seconds.toString().padStart(2, '0');
    }

    // Update countdown immediately and then every second
    updateCountdown();
    setInterval(updateCountdown, 1000);
});
</script>
