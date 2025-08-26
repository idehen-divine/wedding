import './bootstrap';

// Wedding Website JavaScript - Minimal for Livewire
// Only essential JS that can't be handled by Livewire

// ========================================
// COUNTDOWN TIMER - Removed duplicate, now handled in home-page.blade.php
// ========================================

// ========================================
// GLOBAL MUSIC PLAYER - Persistent across navigation and page reloads
// ========================================
window.musicPlayer = {
    audio: null,
    isPlaying: false,
    hasUserInteracted: false,
    shouldAutoPlay: false,
    autoPlayTriggered: false,
    storageKey: 'wedding-music-state',
    
    init(audioSrc = null) {
        if (!this.audio) {
            // Always use the dynamic audio source from Laravel/database
            const musicSrc = audioSrc || window.backgroundMusicUrl;
            
            if (!musicSrc) {
                console.log('No background music configured, skipping music player initialization');
                return;
            }
            
            console.log('Initializing music player with:', musicSrc);
            this.audio = new Audio(musicSrc);
            this.audio.loop = true;
            this.audio.preload = "auto";
            
            // Save current time periodically when playing
            this.audio.addEventListener('timeupdate', () => {
                if (this.isPlaying) {
                    this.saveState();
                }
            });
            
            // Restore music state from localStorage
            this.restoreState();
            
            // Listen for user interaction to enable auto-play
            this.setupUserInteractionListener();
        }
    },
    
    saveState() {
        try {
            const state = {
                isPlaying: this.isPlaying,
                hasUserInteracted: this.hasUserInteracted,
                currentTime: this.audio ? this.audio.currentTime : 0,
                timestamp: Date.now(),
                userPaused: !this.isPlaying && this.hasUserInteracted
            };
            localStorage.setItem(this.storageKey, JSON.stringify(state));
        } catch (e) {
            console.log('Failed to save music state:', e);
        }
    },
    
    restoreState() {
        try {
            const saved = localStorage.getItem(this.storageKey);
            if (saved) {
                const state = JSON.parse(saved);
                
                // Check if state is expired (24 hours = 86400000 ms)
                const now = Date.now();
                const stateAge = now - (state.timestamp || 0);
                const dayInMs = 24 * 60 * 60 * 1000;
                
                if (stateAge > dayInMs) {
                    console.log('🕒 Music state expired, clearing localStorage');
                    localStorage.removeItem(this.storageKey);
                    return;
                }
                
                this.hasUserInteracted = state.hasUserInteracted || false;
                
                // If user explicitly paused the music, don't auto-play
                if (state.userPaused) {
                    console.log('🚫 User previously paused music, not auto-playing');
                    this.shouldAutoPlay = false;
                    return;
                }
                
                // If music was playing and user had interacted before, prepare to resume
                if (state.isPlaying && this.hasUserInteracted) {
                    this.shouldAutoPlay = true;
                    // Restore audio position
                    if (this.audio && state.currentTime) {
                        this.audio.currentTime = state.currentTime;
                    }
                }
            }
        } catch (e) {
            console.log('Failed to restore music state:', e);
        }
    },
    
    setupUserInteractionListener() {
        // Enhanced events for mobile compatibility
        const trustedEvents = ['click', 'touchstart', 'touchend', 'mousedown', 'pointerdown'];
        
        const enableAutoPlay = (event) => {
            this.hasUserInteracted = true;
            console.log('✅ User interaction detected:', event.type, 'Target:', event.target.tagName);
            
            // Save user interaction state
            this.saveState();
            
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
        if (!this.audio) {
            console.log('⚠️ Audio not initialized, attempting to initialize with window.backgroundMusicUrl');
            this.init(window.backgroundMusicUrl);
        }
        
        if (!this.hasUserInteracted) {
            this.shouldAutoPlay = true;
            this.saveState();
            return false;
        }
        
        this.audio.play().catch(e => {
            console.log("Audio play failed:", e);
            return false;
        });
        this.isPlaying = true;
        
        // Save state to localStorage
        this.saveState();
        
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
            
            // Save state to localStorage
            this.saveState();
            
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
            
            // Save state to localStorage
            this.saveState();
            
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
        // Only enable auto-play if user hasn't explicitly paused it
        const saved = localStorage.getItem(this.storageKey);
        if (saved) {
            try {
                const state = JSON.parse(saved);
                if (state.userPaused) {
                    console.log('🚫 Not enabling auto-play - user previously paused');
                    return;
                }
            } catch (e) {
                console.log('Failed to check saved state:', e);
            }
        }
        
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
let appInitialized = false;

function initializeApp() {
    // Prevent multiple initializations
    if (appInitialized) {
        console.log('App already initialized, skipping...');
        return;
    }
    
    console.log('Initializing app...');
    appInitialized = true;
    
    // Music player initialization is handled by navigation component
    // Just enable autoplay interaction if music player exists
    if (window.musicPlayer) {
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
