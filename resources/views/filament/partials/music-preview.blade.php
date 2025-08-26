<div class='border rounded-lg p-3 bg-gray-50 dark:bg-gray-800'>
    <div class='flex items-center justify-between mb-2'>
        <div class='text-sm font-medium text-gray-900 dark:text-gray-100'>{{ $fileName }}</div>
        <div class='ml-2 flex-1 pl-4'>
            <div id='loading-{{ $audioId }}' class='hidden' style='display: none;'>
                <div class='flex items-center gap-2 text-sm text-blue-600 dark:text-blue-400'>
                    <svg class='animate-spin h-4 w-4' xmlns='http://www.w3.org/2000/svg' fill='none'
                        viewBox='0 0 24 24'>
                        <circle class='opacity-25' cx='12' cy='12' r='10' stroke='currentColor'
                            stroke-width='4'></circle>
                        <path class='opacity-75' fill='currentColor'
                            d='M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z'>
                        </path>
                    </svg>
                    Loading...
                </div>
            </div>
        </div>
    </div>
    <div id='audio-container-{{ $audioId }}'>
        <audio id='{{ $audioId }}' controls class='w-full' preload='metadata'>
            <source src='{{ $audioUrl }}' type='audio/mpeg'>
            Your browser does not support the audio element.
        </audio>
    </div>
    <div id='skeleton-{{ $audioId }}' class='hidden' style='display: none;'>
        <div class='animate-pulse bg-gray-200 dark:bg-gray-700 rounded h-10 w-full'></div>
    </div>
</div>

<script>
    // Ensure a client-side pubsub exists
    (function() {
        if (!window.weddingAudio) {
            window.weddingAudio = (function() {
                var subs = [];
                var state = {
                    selected: null,
                    loading: null
                };
                return {
                    setLoading: function(sel) {
                        state.loading = sel;
                        state.selected = sel;
                        subs.forEach(function(s) {
                            try {
                                s({
                                    type: 'loading',
                                    selected: sel
                                });
                            } catch (e) {}
                        });
                    },
                    setSelected: function(sel) {
                        state.loading = null;
                        state.selected = sel;
                        subs.forEach(function(s) {
                            try {
                                s({
                                    type: 'selected',
                                    selected: sel
                                });
                            } catch (e) {}
                        });
                    },
                    subscribe: function(cb) {
                        subs.push(cb);
                        return function() {
                            subs = subs.filter(function(x) {
                                return x !== cb;
                            });
                        };
                    },
                    getState: function() {
                        return {
                            selected: state.selected,
                            loading: state.loading
                        };
                    }
                };
            })();
        }
    })();
</script>

<script>
    (function() {
        function playMatchingAudio(selected) {
            try {
                var audios = Array.from(document.querySelectorAll('audio'));
                var match = audios.find(function(a) {
                    try {
                        return a.currentSrc && a.currentSrc.indexOf(selected) !== -1;
                    } catch (e) {
                        return false;
                    }
                });
                if (match) {
                    audios.forEach(function(a) {
                        if (a !== match) {
                            a.pause();
                            a.currentTime = 0;
                        }
                    });
                    try {
                        var ld = document.getElementById('loading-' + match.id);
                        if (ld) {
                            ld.classList.add('hidden');
                            ld.style.display = 'none';
                        }
                    } catch (e) {}
                    try {
                        var sk = document.getElementById('skeleton-' + match.id);
                        if (sk) {
                            sk.classList.add('hidden');
                            sk.style.display = 'none';
                        }
                    } catch (e) {}
                    try {
                        match.disabled = false;
                        match.style.opacity = '1';
                        match.style.pointerEvents = 'auto';
                    } catch (e) {}
                    match.play().catch(function() {});
                }
            } catch (e) {}
        }

        // Initialize immediately and on DOM ready
        function initAudio() {
            const currentAudio = document.getElementById('{{ $audioId }}');
            if (currentAudio) {
                try {
                    var ld = document.getElementById('loading-' + currentAudio.id);
                    if (ld) {
                        ld.classList.add('hidden');
                        ld.style.display = 'none';
                    }
                } catch (e) {}
                try {
                    var sk = document.getElementById('skeleton-' + currentAudio.id);
                    if (sk) {
                        sk.classList.add('hidden');
                        sk.style.display = 'none';
                    }
                } catch (e) {}
                try {
                    currentAudio.disabled = false;
                    currentAudio.style.opacity = '1';
                    currentAudio.style.pointerEvents = 'auto';
                } catch (e) {}

                currentAudio.addEventListener('play', function() {
                    document.querySelectorAll('audio').forEach(function(audio) {
                        if (audio !== currentAudio) {
                            audio.pause();
                            audio.currentTime = 0;
                        }
                    });
                    try {
                        var ld = document.getElementById('loading-' + currentAudio.id);
                        if (ld) {
                            ld.classList.add('hidden');
                            ld.style.display = 'none';
                        }
                    } catch (e) {}
                    try {
                        var sk = document.getElementById('skeleton-' + currentAudio.id);
                        if (sk) {
                            sk.classList.add('hidden');
                            sk.style.display = 'none';
                        }
                    } catch (e) {}
                    try {
                        currentAudio.disabled = false;
                        currentAudio.style.opacity = '1';
                        currentAudio.style.pointerEvents = 'auto';
                    } catch (e) {}
                });
                currentAudio.addEventListener('canplay', function() {
                    try {
                        var ld = document.getElementById('loading-' + currentAudio.id);
                        if (ld) {
                            ld.classList.add('hidden');
                            ld.style.display = 'none';
                        }
                    } catch (e) {}
                    try {
                        var sk = document.getElementById('skeleton-' + currentAudio.id);
                        if (sk) {
                            sk.classList.add('hidden');
                            sk.style.display = 'none';
                        }
                    } catch (e) {}
                    try {
                        currentAudio.disabled = false;
                        currentAudio.style.opacity = '1';
                        currentAudio.style.pointerEvents = 'auto';
                    } catch (e) {}
                });
            }
        }
        
        // Call immediately
        initAudio();
        
        // Also call on DOM ready as fallback
        document.addEventListener('DOMContentLoaded', initAudio);

        try {
            if (window.weddingAudio && window.weddingAudio.subscribe) {
                window.weddingAudio.subscribe(function(msg) {
                    try {
                        if (msg && msg.type === 'loading') {
                            var selected = msg.selected;
                            setTimeout(function() {
                                var audios = Array.from(document.querySelectorAll('audio'));
                                var match = audios.find(function(a) {
                                    try {
                                        return a.currentSrc && a.currentSrc.indexOf(
                                            selected) !== -1;
                                    } catch (e) {
                                        return false;
                                    }
                                });
                                if (match) {
                                    try {
                                        var ld = document.getElementById('loading-' + match.id);
                                        if (ld) {
                                            ld.classList.remove('hidden');
                                            ld.style.display = 'block';
                                        }
                                    } catch (e) {}
                                    try {
                                        var sk = document.getElementById('skeleton-' + match.id);
                                        if (sk) {
                                            sk.classList.remove('hidden');
                                            sk.style.display = 'block';
                                        }
                                    } catch (e) {}
                                    try {
                                        match.disabled = true;
                                        match.style.opacity = '0.5';
                                        match.style.pointerEvents = 'none';
                                        match.pause();
                                        match.currentTime = 0;
                                    } catch (e) {}
                                }
                            }, 50);
                        } else if (msg && msg.type === 'selected') {
                            setTimeout(function() {
                                playMatchingAudio(msg.selected);
                            }, 300);
                        }
                    } catch (e) {}
                });
            }
        } catch (e) {}
    })();
</script>
