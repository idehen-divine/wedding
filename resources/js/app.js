import './bootstrap';

// Wedding Website JavaScript - Minimal for Livewire
// Only essential JS that can't be handled by Livewire

// ========================================
// COUNTDOWN TIMER - Client-side for real-time updates
// ========================================
function initializeCountdown() {
    const weddingDate = new Date("2025-08-30T14:00:00");

    function updateCountdown() {
        const now = new Date();
        const timeDiff = weddingDate - now;

        if (timeDiff > 0) {
            const days = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
            const hours = Math.floor((timeDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeDiff % (1000 * 60)) / 1000);

            const daysEl = document.getElementById("days");
            const hoursEl = document.getElementById("hours");
            const minutesEl = document.getElementById("minutes");
            const secondsEl = document.getElementById("seconds");

            if (daysEl) daysEl.textContent = days.toString().padStart(2, "0");
            if (hoursEl) hoursEl.textContent = hours.toString().padStart(2, "0");
            if (minutesEl) minutesEl.textContent = minutes.toString().padStart(2, "0");
            if (secondsEl) secondsEl.textContent = seconds.toString().padStart(2, "0");
        }
    }

    updateCountdown();
    
    // Clear any existing intervals to prevent duplicates
    if (window.countdownInterval) {
        clearInterval(window.countdownInterval);
    }
    window.countdownInterval = setInterval(updateCountdown, 1000);
}

// ========================================
// GLOBAL MUSIC PLAYER - Persistent across navigation
// ========================================
window.musicPlayer = {
    audio: null,
    isPlaying: false,
    hasUserInteracted: false,
    shouldAutoPlay: false,
    autoPlayTriggered: false,
    
    init() {
        if (!this.audio) {
            this.audio = new Audio("/assets/audio/harmony.mp3");
            this.audio.loop = true;
            this.audio.preload = "auto";
            
            // Listen for user interaction to enable auto-play
            this.setupUserInteractionListener();
        }
    },
    
    setupUserInteractionListener() {
        // Enhanced events for mobile compatibility
        const trustedEvents = ['click', 'touchstart', 'touchend', 'mousedown', 'pointerdown'];
        
        const enableAutoPlay = (event) => {
            this.hasUserInteracted = true;
            console.log('✅ User interaction detected:', event.type, 'Target:', event.target.tagName);
            
            // Prevent multiple triggers
            if (this.autoPlayTriggered) {
                console.log('🚫 AutoPlay already triggered, ignoring');
                return;
            }
            this.autoPlayTriggered = true;
            
            // Immediately try to play if autoplay was requested
            if (this.shouldAutoPlay) {
                console.log('🎵 Attempting to start music from user interaction');
                this.playFromUserGesture().then((success) => {
                    if (success) {
                        console.log('🎉 Music started successfully!');
                    } else {
                        console.log('❌ Music failed to start');
                    }
                });
            }
            
            // Remove all listeners after first interaction
            trustedEvents.forEach(eventType => {
                document.removeEventListener(eventType, enableAutoPlay);
                window.removeEventListener(eventType, enableAutoPlay);
            });
        };
        
        // Set up listeners when DOM is ready
        const setupListeners = () => {
            console.log('🔧 Setting up user interaction listeners for music');
            console.log('📱 User agent:', navigator.userAgent.includes('Mobile') ? 'Mobile' : 'Desktop');
            
            trustedEvents.forEach(eventType => {
                console.log(`📝 Adding ${eventType} listener`);
                document.addEventListener(eventType, enableAutoPlay, { 
                    once: true, 
                    passive: false,
                    capture: true 
                });
            });
        };
        
        // If DOM is already ready, set up immediately, otherwise wait
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', setupListeners);
        } else {
            setupListeners();
        }
    },
    
    play() {
        if (!this.audio) this.init();
        
        if (!this.hasUserInteracted) {
            this.shouldAutoPlay = true;
            return false;
        }
        
        this.audio.play().catch(e => {
            console.log("Audio play failed:", e);
            return false;
        });
        this.isPlaying = true;
        
        // Dispatch event for UI updates
        window.dispatchEvent(new CustomEvent('music-state-changed', { 
            detail: { isPlaying: this.isPlaying } 
        }));
        
        return true;
    },
    
    playFromUserGesture() {
        console.log('🎵 playFromUserGesture called');
        
        if (!this.audio) {
            console.log('🔧 Initializing audio');
            this.init();
        }
        
        // Log audio readiness
        console.log('🔊 Audio ready state:', this.audio.readyState);
        console.log('🔊 Audio src:', this.audio.src);
        
        // This should be called directly from a user event handler
        // so it should have the proper user activation
        return this.audio.play().then(() => {
            this.isPlaying = true;
            console.log("🎉 Music started successfully from user gesture");
            
            // Dispatch event for UI updates
            window.dispatchEvent(new CustomEvent('music-state-changed', { 
                detail: { isPlaying: this.isPlaying } 
            }));
            
            return true;
        }).catch(e => {
            console.log("❌ Audio play failed even from user gesture:", e.name, e.message);
            console.log("🔍 Error details:", e);
            return false;
        });
    },
    
    pause() {
        if (this.audio) {
            this.audio.pause();
            this.isPlaying = false;
            
            // Dispatch event for UI updates
            window.dispatchEvent(new CustomEvent('music-state-changed', { 
                detail: { isPlaying: this.isPlaying } 
            }));
        }
    },
    
    toggle() {
        if (!this.audio) this.init();
        
        if (this.isPlaying) {
            this.pause();
        } else {
            this.play();
        }
        
        return this.isPlaying;
    },
    
    // Method to start music automatically on first user interaction
    enableAutoPlayOnInteraction() {
        this.shouldAutoPlay = true;
        // Reset autoPlayTriggered to allow music to start if user interacts again
        this.autoPlayTriggered = false;
        if (this.hasUserInteracted) {
            this.play();
        }
    }
};

// ========================================
// INITIALIZATION - Handle both initial load and SPA navigation
// ========================================
function initializeApp() {
    console.log('Initializing app...');
    
    // Initialize countdown timer
    initializeCountdown();
    
    // Initialize music player
    if (window.musicPlayer) {
        window.musicPlayer.init();
        // Enable autoplay on first user interaction
        window.musicPlayer.enableAutoPlayOnInteraction();
    }
}

// Handle initial page load
document.addEventListener('DOMContentLoaded', initializeApp);

// Handle Livewire SPA navigation
document.addEventListener('livewire:navigated', initializeApp);

// Also initialize immediately if DOM is already loaded
if (document.readyState !== 'loading') {
    initializeApp();
}
