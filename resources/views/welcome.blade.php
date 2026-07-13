<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuhu Kids Learning - Splash Screen</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&display=swap" rel="stylesheet">
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            font-family: 'Fredoka', sans-serif;
            background: linear-gradient(180deg, #A1E3FF 0%, #D4F3FF 50%, #E3F8FF 100%);
        }

        .splash-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            width: 100vw;
            position: relative;
            z-index: 10;
        }

        /* 3D Animated Logo */
        .splash-logo-wrapper {
            position: relative;
            z-index: 1;
            margin-bottom: 40px;
            text-align: center;
            animation: bounceLogo 2.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) infinite alternate;
        }

        .splash-logo {
            font-size: 6rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 2px;
            display: flex;
            gap: 8px;
            justify-content: center;
            filter: drop-shadow(0 12px 0 rgba(0, 0, 0, 0.15));
        }

        .logo-let {
            display: inline-block;
            padding: 0 8px;
        }

        .let-k {
            color: #FF4D4D;
        }

        .let-u {
            color: #FFC000;
        }

        .let-h {
            color: #4CAF50;
        }

        .let-u2 {
            color: #2196F3;
        }

        .splash-sub {
            background: #5271FF;
            color: white;
            padding: 6px 32px;
            font-size: 1.5rem;
            font-weight: 800;
            border-radius: 30px;
            text-transform: uppercase;
            box-shadow: 0 6px 0 #3F56CC;
            transform: translateY(-10px) rotate(-2deg);
            letter-spacing: 2px;
            display: inline-block;
        }

        /* Tap to Play Button */
        .play-btn-3d {
            background-color: #7ED957;
            color: white;
            font-size: 2rem;
            font-weight: 900;
            padding: 20px 60px;
            border: none;
            border-radius: 40px;
            border-bottom: 8px solid #63AA43;
            cursor: pointer;
            box-shadow: 0 15px 25px rgba(126, 217, 87, 0.3);
            transition: all 0.15s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            outline: none;
            animation: pulseBtn 1.8s infinite;
        }

        .play-btn-3d:hover {
            transform: scale(1.05) translateY(-3px);
            border-bottom-width: 10px;
        }

        .play-btn-3d:active {
            transform: scale(0.95) translateY(5px);
            border-bottom-width: 3px;
        }

        /* Background elements */
        .decor-hill {
            position: absolute;
            bottom: -50px;
            width: 120%;
            height: 180px;
            background: #7ED957;
            border-radius: 50% 50% 0 0 / 100% 100% 0 0;
            left: -10%;
            z-index: 2;
        }

        .decor-hill-2 {
            position: absolute;
            bottom: -30px;
            width: 120%;
            height: 150px;
            background: #63AA43;
            border-radius: 50% 50% 0 0 / 100% 100% 0 0;
            left: -10%;
            z-index: 1;
            opacity: 0.7;
        }

        /* Animations */
        @keyframes bounceLogo {
            0% {
                transform: translateY(0) scale(1);
            }

            100% {
                transform: translateY(-20px) scale(1.03);
            }
        }

        @keyframes pulseBtn {
            0% {
                box-shadow: 0 0 0 0 rgba(126, 217, 87, 0.7);
            }

            70% {
                box-shadow: 0 0 0 25px rgba(126, 217, 87, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(126, 217, 87, 0);
            }
        }
    </style>
</head>

<body>

    <!-- Standard background illustrations from layout -->
    <div class="bg-scene" style="z-index: 1;">
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

        <!-- Floating clouds -->
        <div class="cloud cloud-1"></div>
        <div class="cloud cloud-2"></div>
    </div>

    <!-- Hills decor -->
    <div class="decor-hill"></div>
    <div class="decor-hill-2"></div>

    <div class="splash-container">
        <!-- Logo -->
        <div class="splash-logo-wrapper">
            <h1 class="splash-logo">
                <span class="logo-let let-k">K</span>
                <span class="logo-let let-u">U</span>
                <span class="logo-let let-h">H</span>
                <span class="logo-let let-u2">U</span>
            </h1>
            <div class="splash-sub">Kids Learning</div>
        </div>

        <!-- Play Button -->
        <button id="playBtn" class="play-btn-3d">
            🎮 Tap to Play!
        </button>
    </div>

    <!-- Web Audio API Sound Synthesizer Script -->
    <script>
        const AudioHelper = {
            ctx: null,
            init() {
                if (!this.ctx) {
                    this.ctx = new (window.AudioContext || window.webkitAudioContext)();
                }
            },
            playChime() {
                try {
                    this.init();
                    if (!this.ctx) return;
                    const now = this.ctx.currentTime;

                    const osc = this.ctx.createOscillator();
                    const gain = this.ctx.createGain();
                    osc.connect(gain);
                    gain.connect(this.ctx.destination);

                    osc.type = 'sine';
                    osc.frequency.setValueAtTime(523.25, now); // C5
                    osc.frequency.setValueAtTime(659.25, now + 0.15); // E5
                    gain.gain.setValueAtTime(0.3, now);
                    gain.gain.linearRampToValueAtTime(0.01, now + 0.45);

                    osc.start(now);
                    osc.stop(now + 0.45);
                } catch (e) {
                    console.log(e);
                }
            },
            speakWelcome(callback) {
                if ('speechSynthesis' in window) {
                    window.speechSynthesis.cancel();
                    const utterance = new SpeechSynthesisUtterance("Welcome to Kuhu Kids Learning! Let's learn and play!");
                    utterance.lang = 'en-US';
                    utterance.rate = 0.85;
                    utterance.pitch = 1.35;

                    utterance.onend = function () {
                        if (callback) callback();
                    };
                    utterance.onerror = function () {
                        if (callback) callback();
                    };

                    // Chrome bug fix: delay speak after cancel
                    setTimeout(() => {
                        window.speechSynthesis.speak(utterance);
                    }, 100);
                } else {
                    if (callback) setTimeout(callback, 1000);
                }
            }
        };

        document.getElementById('playBtn').addEventListener('click', function () {
            AudioHelper.playChime();

            // Start welcome voice, then redirect
            let redirected = false;
            function doRedirect() {
                if (!redirected) {
                    redirected = true;
                    window.location.href = "{{ route('dashboard') }}";
                }
            }

            AudioHelper.speakWelcome(doRedirect);

            // Safety timeout redirect after 3 seconds in case Speech API hangs
            setTimeout(doRedirect, 2500);
        });
    </script>
</body>

</html>