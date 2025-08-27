import './bootstrap';
window.musicPlayer = {
    audio: null,
    isPlaying: false,
    hasUserInteracted: false,
    shouldAutoPlay: false,
    autoPlayTriggered: false,
    storageKey: 'wedding-music-state',
    
    init(audioSrc = null) {
        if (!this.audio) {
            const musicSrc = audioSrc || window.backgroundMusicUrl;
            
            if (!musicSrc) {
                console.log('No background music configured, skipping music player initialization');
                return;
            }
            
            console.log('Initializing music player with:', musicSrc);
            this.audio = new Audio(musicSrc);
            this.audio.loop = true;
            this.audio.preload = "auto";
            
            this.audio.addEventListener('timeupdate', () => {
                if (this.isPlaying) {
                    this.saveState();
                }
            });
            
            this.restoreState();
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
                
                const now = Date.now();
                const stateAge = now - (state.timestamp || 0);
                const dayInMs = 24 * 60 * 60 * 1000;
                
                if (stateAge > dayInMs) {
                    console.log('🕒 Music state expired, clearing localStorage');
                    localStorage.removeItem(this.storageKey);
                    return;
                }
                
                this.hasUserInteracted = state.hasUserInteracted || false;
                
                if (state.userPaused) {
                    console.log('🚫 User previously paused music, not auto-playing');
                    this.shouldAutoPlay = false;
                    return;
                }
                
                if (state.isPlaying && this.hasUserInteracted) {
                    this.shouldAutoPlay = true;
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
    
    enableAutoPlayOnInteraction() {
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
        this.autoPlayTriggered = false;
        if (this.hasUserInteracted) {
            this.play();
        }
    },

    resetMusicState() {
        console.log('🔄 Resetting music state');
        localStorage.removeItem(this.storageKey);
        this.hasUserInteracted = false;
        this.shouldAutoPlay = false;
        this.autoPlayTriggered = false;
        this.isPlaying = false;
    }
};

let appInitialized = false;

function initializeApp() {
    if (appInitialized) {
        console.log('App already initialized, skipping...');
        return;
    }
    
    console.log('Initializing app...');
    appInitialized = true;
    
    if (window.musicPlayer) {
        window.musicPlayer.resetMusicState();
        window.musicPlayer.enableAutoPlayOnInteraction();
    }
}

document.addEventListener('DOMContentLoaded', initializeApp);

document.addEventListener('livewire:navigated', initializeApp);

if (document.readyState !== 'loading') {
    initializeApp();
}
