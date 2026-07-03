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

    <!-- Background Elements (Cloud and Stars Backdrop) -->
    <div class="bg-scene">
        <!-- 3D Animal Background Illustrations -->
        <img src="{{ asset('images/backgrounds/3d_elephant.png') }}" class="animal-bg elephant-bg"
            alt="3D Elephant Background Decor">
        <img src="{{ asset('images/backgrounds/3d_giraffe.png') }}" class="animal-bg giraffe-bg"
            alt="3D Giraffe Background Decor">
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
        <img src="{{ asset('images/backgrounds/3d_rainbow.png') }}" class="rainbow-3d"
            alt="3D Rainbow Background Decor">

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
                    if (onend) setTimeout(onend, 1000);
                    return;
                }
                if ('speechSynthesis' in window) {
                    window.speechSynthesis.cancel();

                    const utterance = new SpeechSynthesisUtterance(text);
                    utterance.lang = lang;
                    utterance.rate = 0.85; // Speak a bit slower for children
                    utterance.pitch = 1.3; // Higher, cute voice tone

                    if (onend) {
                        utterance.onend = onend;
                        utterance.onerror = onend;
                    }

                    // Chrome bug fix: wait 100ms after cancel() to start speaking
                    setTimeout(() => {
                        window.speechSynthesis.speak(utterance);
                    }, 100);
                } else if (onend) {
                    setTimeout(onend, 1000);
                }
            }
        };

        // Attach global click event sounds to interactive buttons and cards
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.module-card, .btn-3d, .bottom-pill, .sidebar-link, .pin-key').forEach(el => {
                el.addEventListener('click', () => {
                    SoundFX.play('click');
                });
            });
        });
    </script>
</body>

</html>