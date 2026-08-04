<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Kuhu Kids Learning')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Meta tags for child friendliness & accessibility -->
    <meta name="theme-color" content="#A1E3FF">
    <meta name="description"
        content="Kuhu Kids Learning - Premium child-friendly interactive learning platform for A-Z letters, phonics, balloon popping, and rhymes.">
    <meta name="keywords" content="kids learning, alphabet tracing, phonics, rhymes, balloon pop, hindi poems">
</head>

<body>

<<<<<<< HEAD
    <!-- App Launch Full-Screen Welcome Video Overlay (Plays public/video/start.mp4) -->
    <div id="appWelcomeVideoModal" style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: #000; z-index: 999999; display: flex; align-items: center; justify-content: center; overflow: hidden;">
        <button onclick="finishWelcomeVideo()" style="position: absolute; top: 20px; right: 20px; z-index: 1000000; padding: 10px 22px; font-family: 'Fredoka', sans-serif; font-size: 1.1rem; font-weight: 800; color: #FFF; background: #FF5252; border: none; border-radius: 30px; cursor: pointer; box-shadow: 0 4px 12px rgba(0,0,0,0.5);">Skip ▶</button>
        <video id="kuhuWelcomeVideo" playsinline webkit-playsinline autoplay preload="auto" style="width: 100%; height: 100%; object-fit: contain; background: #000;">
=======
    <!-- App Startup Full-Screen Welcome Video Overlay (Renders First) -->
    <div id="appVideoSplashModal" class="video-splash-overlay">
        <video id="kuhuIntroVideo" class="splash-video-player" playsinline webkit-playsinline preload="auto">
>>>>>>> a5b7b629521f9349d88b677d4f0fc9e3435260eb
            <source src="{{ asset('video/start.mp4') }}" type="video/mp4">
            Your browser does not support video playback.
        </video>
    </div>
    <script>
        (function () {
            var modal = document.getElementById('appWelcomeVideoModal');
            var video = document.getElementById('kuhuWelcomeVideo');
            var hasPlayed = sessionStorage.getItem('kuhu_welcome_video_played');

            window.finishWelcomeVideo = function() {
                sessionStorage.setItem('kuhu_welcome_video_played', 'true');
                if (video) {
                    try { video.pause(); } catch(e){}
                }
                if (modal) {
                    modal.style.opacity = '0';
                    modal.style.transition = 'opacity 0.3s ease';
                    setTimeout(function() {
                        modal.style.display = 'none';
                    }, 300);
                }
                document.documentElement.style.overflow = '';
                document.body.style.overflow = '';
            };

            if (hasPlayed) {
<<<<<<< HEAD
                if (modal) modal.style.display = 'none';
=======
                if (modal) {
                    modal.style.display = 'none';
                    modal.classList.add('hidden');
                }
                if (video) {
                    video.pause();
                }
>>>>>>> a5b7b629521f9349d88b677d4f0fc9e3435260eb
            } else {
                if (modal && video) {
                    document.documentElement.style.overflow = 'hidden';
                    document.body.style.overflow = 'hidden';
                    video.muted = false;
                    
                    video.onended = finishWelcomeVideo;
                    video.onerror = finishWelcomeVideo;

                    // Unmute on first screen touch/tap if browser blocked initial audio autoplay
                    var handleUserTouch = function() {
                        if (video && video.muted) {
                            video.muted = false;
                            video.play().catch(function(){});
                        }
                        window.removeEventListener('click', handleUserTouch);
                        window.removeEventListener('touchstart', handleUserTouch);
                    };
                    window.addEventListener('click', handleUserTouch, { capture: true, passive: true });
                    window.addEventListener('touchstart', handleUserTouch, { capture: true, passive: true });

                    var p = video.play();
                    if (p && p.catch) {
                        p.catch(function () {
                            video.muted = true;
                            video.play().catch(function () {
                                finishWelcomeVideo();
                            });
                        });
                    }
                }
            }
        })();
    </script>

    <!-- Background Elements (Cloud and Stars Backdrop) -->
    <div class="bg-scene">
        <!-- 3D Animal Background Illustrations -->
        <img src="{{ asset('images/backgrounds/3d_elephant.png') }}" class="animal-bg elephant-bg"
            alt="3D Elephant Background Decor">
        <img src="{{ asset('images/backgrounds/3d_giraffe.png') }}" class="animal-bg giraffe-bg"
            alt="3D Giraffe Background Decor">
        <img src="{{ asset('images/backgrounds/3d_rainbow.png') }}" class="rainbow-3d"
            alt="3D Rainbow Background Decor">
        <!-- Rising Background Butterflies -->
        <img src="{{ asset('images/backgrounds/3d_butterfly.png') }}" class="rising-butterfly"
            style="left: 8%; width: 140px; animation-duration: 22s; animation-delay: 0s;" alt="3D Butterfly">
        <img src="{{ asset('images/backgrounds/3d_butterfly.png') }}" class="rising-butterfly"
            style="left: 25%; width: 90px; animation-duration: 18s; animation-delay: 4s;" alt="3D Butterfly">
        <img src="{{ asset('images/backgrounds/3d_butterfly.png') }}" class="rising-butterfly"
            style="left: 45%; width: 110px; animation-duration: 25s; animation-delay: 8s;" alt="3D Butterfly">
        <img src="{{ asset('images/backgrounds/3d_butterfly.png') }}" class="rising-butterfly"
            style="left: 62%; width: 100px; animation-duration: 20s; animation-delay: 2s;" alt="3D Butterfly">
        <img src="{{ asset('images/backgrounds/3d_butterfly.png') }}" class="rising-butterfly"
            style="left: 78%; width: 130px; animation-duration: 28s; animation-delay: 6s;" alt="3D Butterfly">
        <img src="{{ asset('images/backgrounds/3d_butterfly.png') }}" class="rising-butterfly"
            style="left: 92%; width: 100px; animation-duration: 24s; animation-delay: 11s;" alt="3D Butterfly">

        <!-- Rising Background Balloons -->
        <div class="rising-balloon"
            style="--balloon-bg: #FF66C4; --balloon-shadow: #D94B9F; left: 5%; width: 50px; height: 62px; animation-duration: 18s; animation-delay: 0s;">
            <div class="balloon-string"></div>
        </div>
        <div class="rising-balloon"
            style="--balloon-bg: #38B6FF; --balloon-shadow: #2B8EC7; left: 15%; width: 70px; height: 87px; animation-duration: 22s; animation-delay: 3s;">
            <div class="balloon-string"></div>
        </div>
        <div class="rising-balloon"
            style="--balloon-bg: #FFDE59; --balloon-shadow: #CCB143; left: 30%; width: 55px; height: 68px; animation-duration: 16s; animation-delay: 7s;">
            <div class="balloon-string"></div>
        </div>
        <div class="rising-balloon"
            style="--balloon-bg: #7ED957; --balloon-shadow: #63AA43; left: 45%; width: 65px; height: 81px; animation-duration: 20s; animation-delay: 2s;">
            <div class="balloon-string"></div>
        </div>
        <div class="rising-balloon"
            style="--balloon-bg: #8C52FF; --balloon-shadow: #6E3CD9; left: 60%; width: 50px; height: 62px; animation-duration: 17s; animation-delay: 5s;">
            <div class="balloon-string"></div>
        </div>
        <div class="rising-balloon"
            style="--balloon-bg: #FF914D; --balloon-shadow: #D97336; left: 75%; width: 75px; height: 93px; animation-duration: 24s; animation-delay: 1s;">
            <div class="balloon-string"></div>
        </div>
        <div class="rising-balloon"
            style="--balloon-bg: #FF66C4; --balloon-shadow: #D94B9F; left: 88%; width: 55px; height: 68px; animation-duration: 19s; animation-delay: 6s;">
            <div class="balloon-string"></div>
        </div>
        <div class="rising-balloon"
            style="--balloon-bg: #38B6FF; --balloon-shadow: #2B8EC7; left: 23%; width: 60px; height: 75px; animation-duration: 21s; animation-delay: 9s;">
            <div class="balloon-string"></div>
        </div>
        <div class="rising-balloon"
            style="--balloon-bg: #7ED957; --balloon-shadow: #63AA43; left: 68%; width: 52px; height: 65px; animation-duration: 15s; animation-delay: 11s;">
            <div class="balloon-string"></div>
        </div>


        <div class="cloud cloud-1"></div>
        <div class="cloud cloud-2"></div>

        <!-- Smiling Sun SVG -->
        <div class="sun-sprite">
            <svg viewBox="0 0 100 100" width="80" height="80">
                <circle cx="50" cy="50" r="24" fill="#FFDE59" stroke="#FF914D" stroke-width="4" />
                <!-- Rays -->
                <path
                    d="M 50 10 L 50 2 M 50 90 L 50 98 M 10 50 L 2 50 M 90 50 L 98 50 M 22 22 L 16 16 M 78 78 L 84 84 M 22 78 L 16 84 M 78 22 L 84 16"
                    stroke="#FF914D" stroke-width="6" stroke-linecap="round" />
                <!-- Smiling face -->
                <circle cx="43" cy="45" r="2.5" fill="#4A3B00" />
                <circle cx="57" cy="45" r="2.5" fill="#4A3B00" />
                <path d="M 43 55 Q 50 60 57 55" stroke="#4A3B00" stroke-width="2" fill="none" stroke-linecap="round" />
            </svg>
        </div>

        <!-- Hot Air Balloon SVG -->
        <div class="hot-air-balloon">
            <svg viewBox="0 0 60 80" width="60" height="80">
                <path d="M 30 10 C 10 10, 5 35, 30 55 C 55 35, 50 10, 30 10 Z" fill="#FF66C4" stroke="#D94B9F"
                    stroke-width="2" />
                <path d="M 17 25 C 23 20, 37 20, 43 25" fill="none" stroke="#FFF" stroke-width="3" />
                <rect x="25" y="62" width="10" height="8" fill="#FF914D" stroke="#D97336" stroke-width="2" rx="2" />
                <line x1="18" y1="50" x2="25" y2="62" stroke="#7F8C8D" stroke-width="1.5" />
                <line x1="42" y1="50" x2="35" y2="62" stroke="#7F8C8D" stroke-width="1.5" />
            </svg>
        </div>
    </div>

    <!-- Main Container -->
    <div class="app-container">
        <!-- Message Flashes -->
        @if(session('success'))
            <div
                style="background: #E8F5E9; border: 3px solid #81C784; padding: 12px 24px; border-radius: 16px; font-weight: bold; margin-bottom: 20px; z-index: 99; color: #2E7D32; display: flex; justify-content: space-between; align-items: center;">
                <span>{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()"
                    style="border: none; background: none; font-size: 1.2rem; cursor: pointer; color: #2E7D32;">&times;</button>
            </div>
        @endif
        @if(session('error'))
            <div
                style="background: #FFEBEE; border: 3px solid #E57373; padding: 12px 24px; border-radius: 16px; font-weight: bold; margin-bottom: 20px; z-index: 99; color: #C62828; display: flex; justify-content: space-between; align-items: center;">
                <span>{{ session('error') }}</span>
                <button onclick="this.parentElement.remove()"
                    style="border: none; background: none; font-size: 1.2rem; cursor: pointer; color: #C62828;">&times;</button>
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Web Audio API Sound Synthesizer Script -->
    <script>
        const SoundFX = {
            ctx: null,

            init() {
                if (!this.ctx) {
                    this.ctx = new (window.AudioContext || window.webkitAudioContext)();
                }
                if (this.ctx && this.ctx.state === 'suspended') {
                    this.ctx.resume();
                }
            },

            play(type) {
                if (localStorage.getItem('sfx_enabled') === 'false') return;
                try {
                    this.init();
                    if (!this.ctx) return;

                    const osc = this.ctx.createOscillator();
                    const gain = this.ctx.createGain();
                    osc.connect(gain);
                    gain.connect(this.ctx.destination);

                    const now = this.ctx.currentTime;

                    if (type === 'click') {
                        // Pop / Click sound
                        osc.type = 'sine';
                        osc.frequency.setValueAtTime(400, now);
                        osc.frequency.exponentialRampToValueAtTime(100, now + 0.1);
                        gain.gain.setValueAtTime(0.3, now);
                        gain.gain.linearRampToValueAtTime(0.01, now + 0.1);
                        osc.start(now);
                        osc.stop(now + 0.1);
                    } else if (type === 'pop') {
                        // Balloon Pop bubble burst sound
                        osc.type = 'triangle';
                        osc.frequency.setValueAtTime(600, now);
                        osc.frequency.exponentialRampToValueAtTime(80, now + 0.15);
                        gain.gain.setValueAtTime(0.5, now);
                        gain.gain.linearRampToValueAtTime(0.01, now + 0.15);
                        osc.start(now);
                        osc.stop(now + 0.15);
                    } else if (type === 'success') {
                        // Triumphant double chime
                        osc.type = 'sine';
                        osc.frequency.setValueAtTime(523.25, now); // C5
                        osc.frequency.setValueAtTime(659.25, now + 0.1); // E5
                        gain.gain.setValueAtTime(0.3, now);
                        gain.gain.linearRampToValueAtTime(0.01, now + 0.3);
                        osc.start(now);
                        osc.stop(now + 0.3);
                    } else if (type === 'cheer') {
                        // Cheerful sliding sound
                        osc.type = 'triangle';
                        osc.frequency.setValueAtTime(300, now);
                        osc.frequency.linearRampToValueAtTime(800, now + 0.4);
                        gain.gain.setValueAtTime(0.2, now);
                        gain.gain.linearRampToValueAtTime(0.01, now + 0.4);
                        osc.start(now);
                        osc.stop(now + 0.4);
                    }
                } catch (e) {
                    console.log('Audio error:', e);
                }
            },

            speak(text, lang = 'en-US', onend = null) {
                if (localStorage.getItem('voice_enabled') === 'false') {
                    if (onend) setTimeout(onend, 500);
                    return;
                }
                if ('speechSynthesis' in window) {
                    try {
                        window.speechSynthesis.cancel();
                        if (window.speechSynthesis.paused) {
                            window.speechSynthesis.resume();
                        }
                    } catch (e) { }

                    const utterance = new SpeechSynthesisUtterance(text);
                    this.currentUtterance = utterance; // Prevent garbage collection
                    utterance.lang = lang;
                    utterance.rate = 0.94; // Cheerful kids speech rate
                    utterance.pitch = 1.48; // Cute high-pitch child voice simulation

                    try {
                        const voices = window.speechSynthesis.getVoices();
                        if (voices && voices.length > 0) {
                            const langPrefix = lang.split('-')[0].toLowerCase();

                            // Priority 1: Match language AND preferred natural/child/female voice names
                            let voice = voices.find(v => {
                                const lMatch = v.lang.toLowerCase().startsWith(langPrefix);
                                const name = v.name.toLowerCase();
                                return lMatch && (name.includes('natural') || name.includes('child') || name.includes('kid') || name.includes('female') || name.includes('google') || name.includes('zira') || name.includes('samantha') || name.includes('aria') || name.includes('swara') || name.includes('kalpana') || name.includes('neural'));
                            });

                            // Priority 2: Match language exact or prefix
                            if (!voice) {
                                voice = voices.find(v => v.lang.toLowerCase() === lang.toLowerCase() || v.lang.toLowerCase().replace('_', '-') === lang.toLowerCase());
                            }
                            if (!voice) {
                                voice = voices.find(v => v.lang.toLowerCase().startsWith(langPrefix));
                            }
                            if (voice) {
                                utterance.voice = voice;
                            }
                        }
                    } catch (e) {
                        console.log("Voice matching error:", e);
                    }

                    if (onend) {
                        utterance.onend = onend;
                        utterance.onerror = onend;
                    }

                    // Speak directly with child voice profile
                    window.speechSynthesis.speak(utterance);
                } else if (onend) {
                    setTimeout(onend, 500);
                }
            }
        };
        window.SoundFX = SoundFX;

        // Preload speech synthesis voices
        if ('speechSynthesis' in window) {
            window.speechSynthesis.onvoiceschanged = () => {
                try { window.speechSynthesis.getVoices(); } catch (e) { }
            };
        }

        // ============================================
        // Background Music (BGM) Synthesizer Engine
        // ============================================
        const BGM = {
            ctx: null,
            isPlaying: false,
            timer: null,
            step: 0,
            volume: 0.08,

            // Upbeat kid melody scale (C Major cheerful melody)
            notes: [
                523.25, 659.25, 783.99, 880.00, 1046.50, 783.99, 659.25, 783.99,
                698.46, 880.00, 1046.50, 698.46, 659.25, 783.99, 1046.50, 987.77,
                523.25, 659.25, 783.99, 1046.50, 1174.66, 1046.50, 880.00, 783.99,
                698.46, 880.00, 1046.50, 880.00, 783.99, 659.25, 587.33, 523.25
            ],

            chords: [
                261.63, 261.63, 349.23, 392.00,
                261.63, 261.63, 349.23, 392.00
            ],

            init() {
                if (!this.ctx) {
                    this.ctx = new (window.AudioContext || window.webkitAudioContext)();
                }
                if (this.ctx && this.ctx.state === 'suspended') {
                    this.ctx.resume();
                }
            },

            toggle() {
                if (this.isPlaying) {
                    this.stop();
                    localStorage.setItem('bgm_enabled', 'false');
                } else {
                    this.start();
                    localStorage.setItem('bgm_enabled', 'true');
                }
                this.updateUI();
            },

            start() {
                if (this.isPlaying) return;
                this.init();
                if (!this.ctx) return;
                this.isPlaying = true;
                this.step = 0;
                this.playBeat();
                this.timer = setInterval(() => this.playBeat(), 350);
                this.updateUI();
            },

            stop() {
                this.isPlaying = false;
                if (this.timer) {
                    clearInterval(this.timer);
                    this.timer = null;
                }
                this.updateUI();
            },

            playBeat() {
                if (!this.isPlaying || !this.ctx) return;
                try {
                    const now = this.ctx.currentTime;

                    if (this.step % 4 === 0) {
                        const chordIdx = Math.floor((this.step / 4) % this.chords.length);
                        const rootFreq = this.chords[chordIdx];

                        const bassOsc = this.ctx.createOscillator();
                        const bassGain = this.ctx.createGain();
                        bassOsc.type = 'triangle';
                        bassOsc.frequency.setValueAtTime(rootFreq / 2, now);

                        bassGain.gain.setValueAtTime(this.volume * 0.4, now);
                        bassGain.gain.exponentialRampToValueAtTime(0.001, now + 1.1);

                        bassOsc.connect(bassGain);
                        bassGain.connect(this.ctx.destination);
                        bassOsc.start(now);
                        bassOsc.stop(now + 1.1);
                    }

                    const freq = this.notes[this.step % this.notes.length];
                    const osc = this.ctx.createOscillator();
                    const gain = this.ctx.createGain();

                    osc.type = 'sine';
                    osc.frequency.setValueAtTime(freq, now);

                    gain.gain.setValueAtTime(this.volume * 0.6, now);
                    gain.gain.exponentialRampToValueAtTime(0.001, now + 0.32);

                    osc.connect(gain);
                    gain.connect(this.ctx.destination);

                    osc.start(now);
                    osc.stop(now + 0.32);

                    this.step++;
                } catch (e) {
                    console.log('BGM error:', e);
                }
            },

            updateUI() {
                document.querySelectorAll('.bgm-toggle-btn').forEach(btn => {
                    if (this.isPlaying) {
                        btn.classList.add('playing');
                        btn.setAttribute('title', 'Background Music: ON (Click to Mute)');
                        btn.innerHTML = '🎵';
                    } else {
                        btn.classList.remove('playing');
                        btn.setAttribute('title', 'Background Music: OFF (Click to Play)');
                        btn.innerHTML = '🔇';
                    }
                });
            }
        };

        // ====================================================
        // Interactive Single Card Highlight & Hover Engine
        // ====================================================
        const CardHighlightManager = {
            cards: [],
            activeIndex: 0,
            autoTimer: null,

            init() { },
            setActive(index) { },
            startAutoTimer() { }
        };

        // Full-Screen App Startup Video Splash Controller
        function finishSplashVideo() {}
        function initSplashVideo() {}

        // Attach global click event sounds, card highlight & BGM
        document.addEventListener('DOMContentLoaded', () => {
            // Initialize Full-Screen Video Splash
            initSplashVideo();

            // Initialize Single Card Highlight & Hover Engine
            CardHighlightManager.init();

            // Auto-start BGM on user interaction if enabled
            const bgmPref = localStorage.getItem('bgm_enabled');
            if (bgmPref !== 'false') {
                BGM.updateUI();
                const startBgmOnce = () => {
                    if (localStorage.getItem('bgm_enabled') !== 'false') {
                        BGM.start();
                    }
                    document.removeEventListener('click', startBgmOnce);
                    document.removeEventListener('touchstart', startBgmOnce);
                };
                document.addEventListener('click', startBgmOnce);
                document.addEventListener('touchstart', startBgmOnce);
            } else {
                BGM.updateUI();
            }

            document.querySelectorAll('.module-card').forEach(el => {
                el.addEventListener('click', function(e) {
                    e.preventDefault();
                    SoundFX.play('click');
                    let targetUrl = this.closest('a').href;
                    window.location.href = targetUrl;
                });
            });

            document.querySelectorAll('.btn-3d, .bottom-pill, .sidebar-link, .pin-key').forEach(el => {
                el.addEventListener('click', () => {
                    SoundFX.play('click');
                });
            });
        });
    </script>


    <!-- Global Floating Background Music (BGM) Controller Icon -->
    <div class="floating-bgm-container">
        <button id="globalBgmBtn" class="btn-bgm bgm-toggle-btn" onclick="BGM.toggle()" title="Toggle Background Music"
            aria-label="Toggle Background Music">
            🎵
        </button>
    </div>
</body>

</html>