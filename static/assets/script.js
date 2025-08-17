// Emma & James Wedding Website JavaScript
// All functionality for the wedding website

// ========================================
// COUNTDOWN TIMER
// ========================================
document.addEventListener("DOMContentLoaded", function () {
    const weddingDate = new Date("2025-12-30T14:00:00");

    function updateCountdown() {
        const now = new Date();
        const timeDiff = weddingDate - now;

        if (timeDiff > 0) {
            const days = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
            const hours = Math.floor(
                (timeDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
            );
            const minutes = Math.floor(
                (timeDiff % (1000 * 60 * 60)) / (1000 * 60)
            );
            const seconds = Math.floor((timeDiff % (1000 * 60)) / 1000);

            document.getElementById("days").textContent = days
                .toString()
                .padStart(2, "0");
            document.getElementById("hours").textContent = hours
                .toString()
                .padStart(2, "0");
            document.getElementById("minutes").textContent = minutes
                .toString()
                .padStart(2, "0");
            document.getElementById("seconds").textContent = seconds
                .toString()
                .padStart(2, "0");
        }
    }

    updateCountdown();
    setInterval(updateCountdown, 1000);
});

// ========================================
// NAVIGATION SCROLL (No longer needed for multi-page site)
// ========================================
// This functionality has been removed since we're now using separate pages instead of anchor links

// ========================================
// RSVP FORM
// ========================================
document.addEventListener("DOMContentLoaded", function () {
    const rsvpForm = document.getElementById("rsvpForm");
    const rsvpSuccess = document.getElementById("rsvpSuccess");

    // Only add event listeners if elements exist
    if (rsvpForm && rsvpSuccess) {
        // Handle form submission
        rsvpForm.addEventListener("submit", function (e) {
            e.preventDefault();
            rsvpForm.style.display = "none";
            rsvpSuccess.classList.remove("hidden");
        });

        // Handle attendance radio button selection
        document.querySelectorAll('input[name="attendance"]').forEach((radio) => {
            radio.addEventListener("change", function () {
                document
                    .querySelectorAll('input[name="attendance"]')
                    .forEach((r) => {
                        const indicator =
                            r.parentElement.querySelector("div > div");
                        if (indicator) {
                            indicator.style.opacity = r.checked ? "1" : "0";
                        }
                    });
            });
        });
    }
});

// ========================================
// WISH MODAL
// ========================================
document.addEventListener("DOMContentLoaded", function () {
    const addWishBtn = document.getElementById("addWishBtn");
    const floatingWishBtn = document.getElementById("floatingWishBtn");
    const wishModal = document.getElementById("wishModal");
    const cancelWish = document.getElementById("cancelWish");
    const wishForm = document.getElementById("wishForm");

    // Only add event listeners if elements exist
    if (wishModal && wishForm) {
        function openModal() {
            wishModal.classList.remove("hidden");
            wishModal.classList.add("flex");
        }

        function closeModal() {
            wishModal.classList.add("hidden");
            wishModal.classList.remove("flex");
            wishForm.reset();
        }

        // Event listeners for opening modal (with null checks)
        if (addWishBtn) {
            addWishBtn.addEventListener("click", openModal);
        }
        if (floatingWishBtn) {
            floatingWishBtn.addEventListener("click", openModal);
        }

        // Event listeners for closing modal
        if (cancelWish) {
            cancelWish.addEventListener("click", closeModal);
        }

        // Close modal when clicking outside
        wishModal.addEventListener("click", function (e) {
            if (e.target === wishModal) {
                closeModal();
            }
        });

        // Handle wish form submission
        wishForm.addEventListener("submit", function (e) {
            e.preventDefault();
            closeModal();
            alert("Thank you for your wishes! Your message has been shared.");
        });
    }
});

// ========================================
// MUSIC TOGGLE
// ========================================
document.addEventListener("DOMContentLoaded", function () {
    const musicToggle = document.getElementById("musicToggle");

    // Only proceed if music toggle exists
    if (!musicToggle) return;

    const audio = new Audio("assets/harmony.mp3");
    audio.loop = true;
    audio.preload = "auto"; // Preload the audio for instant playback
    let isPlaying = false;
    let hasStarted = false;

    // Ensure initial state shows play icon
    const icon = musicToggle.querySelector("i");
    if (icon) {
        icon.className = "ri-music-line text-primary";
        musicToggle.classList.remove("bg-primary/30");
    }

    // Function to start music
    const startMusic = () => {
        if (!hasStarted) {
            audio.play().then(() => {
                isPlaying = true;
                hasStarted = true;
                const icon = musicToggle.querySelector("i");
                icon.className = "ri-pause-line text-primary";
                musicToggle.classList.add("bg-primary/30");
                console.log("Music started on user interaction");
            }).catch(e => {
                console.log("Audio play failed:", e);
                // Ensure toggle shows "play" icon if autoplay fails
                const icon = musicToggle.querySelector("i");
                icon.className = "ri-music-line text-primary";
                musicToggle.classList.remove("bg-primary/30");
                isPlaying = false;
            });
        }
    };

    // Start music on ANY user gesture
    const userGestureEvents = [
        'click', 'touchstart', 'keydown', 'mousedown', 'scroll', 'wheel',
        'pointerdown', 'focus',
    ];

    userGestureEvents.forEach(eventType => {
        document.addEventListener(eventType, startMusic, { once: true, passive: true });
        window.addEventListener(eventType, startMusic, { once: true, passive: true });
    });

    // Music toggle button functionality
    musicToggle.addEventListener("click", function (e) {
        // Don't let this click trigger the autostart
        e.stopPropagation();

        isPlaying = !isPlaying;
        const icon = musicToggle.querySelector("i");

        if (isPlaying) {
            audio.play().catch(e => console.log("Audio play failed:", e));
            icon.className = "ri-pause-line text-primary";
            musicToggle.classList.add("bg-primary/30");
            hasStarted = true;
        } else {
            audio.pause();
            icon.className = "ri-music-line text-primary";
            musicToggle.classList.remove("bg-primary/30");
        }
    });
});

// ========================================
// MOBILE MENU
// ========================================
document.addEventListener("DOMContentLoaded", function () {
    const mobileMenu = document.getElementById("mobileMenu");

    // Only add event listener if element exists
    if (mobileMenu) {
        mobileMenu.addEventListener("click", function () {
            alert("Mobile menu functionality would be implemented here");
        });
    }
});
