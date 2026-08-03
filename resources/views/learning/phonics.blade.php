@extends('layouts.app')

@section('title', 'Kuhu Kids Learning - Phonics Sounds')

@section('content')
    <!-- Include Canvas Confetti -->
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

    <style>

        /* Giant Phonics Flashcard Styling */
        .giant-phonic-card {
            background: radial-gradient(circle at 10% 20%, #FFFFFF 0%, #FFFCE5 100%);
            border: 8px solid var(--card-color) !important;
            border-bottom-width: 18px !important;
            border-radius: 40px !important;
            padding: 30px !important;
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
            justify-content: space-between !important;
            min-height: 380px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08), inset 0 -6px 0 rgba(0, 0, 0, 0.06);
            transition: transform 0.25s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-sizing: border-box;
            position: relative;
            cursor: pointer;
        }

        .giant-phonic-card:hover {
            transform: scale(1.03) rotate(1deg);
        }

        .giant-phonic-card:active {
            transform: translateY(6px);
            border-bottom-width: 8px !important;
        }

        .giant-letter-bubble {
            font-size: 2.2rem;
            font-weight: 900;
            color: #FFF;
            padding: 6px 20px;
            border-radius: 18px;
            box-shadow: 0 4px 0 rgba(0, 0, 0, 0.15);
            font-family: 'Fredoka', sans-serif;
            text-shadow: 2px 2px 0px rgba(0, 0, 0, 0.15);
        }

        .giant-emoji-graphic {
            font-size: 7.5rem;
            margin: 20px 0;
            display: inline-block;
            filter: drop-shadow(0 10px 15px rgba(0, 0, 0, 0.18));
            animation: bounceGiantEmoji 2.5s ease-in-out infinite alternate;
        }

        @keyframes bounceGiantEmoji {
            0% {
                transform: translateY(0) scale(1) rotate(-4deg);
            }

            100% {
                transform: translateY(-15px) scale(1.08) rotate(4deg);
            }
        }

        .giant-word-label {
            font-size: 2.2rem;
            font-weight: 900;
            color: #4A3B00;
            font-family: 'Fredoka', sans-serif;
            text-transform: capitalize;
            text-shadow: 2px 2px 0 #FFF;
        }

        .giant-big-letter {
            font-size: 8rem;
            font-weight: 900;
            line-height: 1;
            font-family: 'Fredoka', sans-serif;
            text-shadow: 4px 4px 0px #FFF, 8px 8px 0px rgba(0, 0, 0, 0.06);
            margin: 30px 0;
        }

        .giant-tap-label {
            font-size: 1.15rem;
            font-weight: bold;
            color: #888;
            background: #F5F5F5;
            padding: 4px 14px;
            border-radius: 20px;
            border: 2px solid #EEE;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .giant-phonic-card:hover .giant-emoji-graphic {
            animation: superBounce 0.5s ease infinite alternate;
        }

        @keyframes superBounce {
            0% {
                transform: translateY(0) scale(1.05);
            }

            100% {
                transform: translateY(-15px) scale(1.15);
            }
        }

        /* --- NEW PHONICS MENU UI --- */
        @import url('https://fonts.googleapis.com/css2?family=Baloo+2:wght@700;800&family=Nunito:wght@700;800;900&family=Poppins:wght@700;800;900&display=swap');

        /* Override App Background */
        body {
            background-image: url('{{ asset("img/phonics/bg_phonics.png") }}') !important;
            background-size: cover !important;
            background-position: center top !important;
            background-attachment: fixed !important;
            background-repeat: no-repeat !important;
            font-family: 'Poppins', sans-serif;
        }
        
        .main-container {
            background: transparent !important;
            box-shadow: none !important;
            padding: 0 !important;
            max-width: 450px !important;
            margin: 0 auto;
            position: relative;
        }

        /* Header */
        .phonics-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 15px;
            position: relative;
            z-index: 10;
        }

        .btn-back-circle {
            background: #FFB800;
            border: 4px solid #FFF;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 6px 0 #D97336, 0 8px 15px rgba(0,0,0,0.2);
            color: #8C3A00;
            text-decoration: none;
            transition: transform 0.2s;
        }
        
        .btn-back-circle:active {
            transform: translateY(4px);
            box-shadow: 0 2px 0 #D97336, 0 4px 10px rgba(0,0,0,0.2);
        }

        .btn-sound-circle {
            background: #A36BFF;
            border: 4px solid #FFF;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 6px 0 #7A42D1, 0 8px 15px rgba(0,0,0,0.2);
            color: #FFF;
            border: none;
            cursor: pointer;
            transition: transform 0.2s;
            outline: none;
        }
        .btn-sound-circle:active {
            transform: translateY(4px);
            box-shadow: 0 2px 0 #7A42D1, 0 4px 10px rgba(0,0,0,0.2);
        }

        .header-title-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-top: -10px;
        }

        .megaphone-icon {
            font-size: 2rem;
            filter: drop-shadow(0 4px 4px rgba(0,0,0,0.2));
            margin-bottom: -15px;
            z-index: 2;
            transform: rotate(-10deg);
        }

        .phonics-title {
            font-family: 'Poppins', sans-serif;
            font-size: 2.8rem;
            font-weight: 900;
            line-height: 0.9;
            text-align: center;
            letter-spacing: -1px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .phonics-title-top {
            text-shadow: 
                -3px -3px 0 #FFF, 3px -3px 0 #FFF, -3px 3px 0 #FFF, 3px 3px 0 #FFF, 
                -4px -4px 0 #FFF, 4px -4px 0 #FFF, -4px 4px 0 #FFF, 4px 4px 0 #FFF,
                0 6px 0 rgba(0,0,0,0.15);
        }
        
        .phonics-title-bottom {
            font-size: 2.2rem;
            margin-top: -2px;
            text-shadow: 
                -3px -3px 0 #FFF, 3px -3px 0 #FFF, -3px 3px 0 #FFF, 3px 3px 0 #FFF, 
                -4px -4px 0 #FFF, 4px -4px 0 #FFF, -4px 4px 0 #FFF, 4px 4px 0 #FFF,
                0 6px 0 rgba(0,0,0,0.15);
        }

        /* Wooden Signboard */
        .signboard-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 5px;
            margin-bottom: 25px;
            position: relative;
            z-index: 10;
        }

        .wooden-board {
            background-image: url('{{ asset("img/phonics/wooden_board.png") }}');
            background-size: contain;
            background-position: center;
            background-repeat: no-repeat;
            width: 300px;
            height: 90px;
            display: flex;
            align-items: center;
            justify-content: center;
            filter: drop-shadow(0 10px 15px rgba(0,0,0,0.25));
        }

        .board-text {
            font-family: 'Nunito', sans-serif;
            font-size: 1.25rem;
            font-weight: 900;
            color: #6B3E00;
            text-shadow: 1px 1px 0 rgba(255,255,255,0.4);
            margin-top: -8px;
        }

        .pointing-hand {
            font-size: 3.5rem;
            margin-top: -25px;
            filter: drop-shadow(0 5px 5px rgba(0,0,0,0.2));
            animation: pointUp 0.8s infinite alternate ease-in-out;
            z-index: 2;
        }

        @keyframes pointUp {
            0% { transform: translateY(0); }
            100% { transform: translateY(-12px); }
        }

        /* Deck Grid */
        .deck-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
            padding: 0 16px 40px 16px;
            position: relative;
            z-index: 10;
        }

        /* Card Styles */
        .deck-card {
            border-radius: 20px;
            padding-top: 15px;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            cursor: pointer;
            text-decoration: none;
            transition: transform 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15), inset 0 6px 0 rgba(255,255,255,0.3);
            overflow: hidden;
            aspect-ratio: 0.85; 
        }
        
        .deck-card:hover {
            transform: scale(1.03) translateY(-5px);
        }
        
        .deck-card:active {
            transform: scale(0.96);
        }

        .card-illustration {
            width: 80%;
            height: 55%;
            object-fit: contain;
            margin-bottom: 5px;
            z-index: 2;
            filter: drop-shadow(0 8px 10px rgba(0,0,0,0.15));
        }

        /* The white curve section at bottom */
        .card-bottom-curve {
            position: absolute;
            bottom: -20%;
            left: -10%;
            width: 120%;
            height: 55%;
            background: #FFF;
            border-radius: 50%;
            z-index: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding-top: 18px;
            box-shadow: 0 -4px 10px rgba(0,0,0,0.05);
        }

        .card-label {
            font-family: 'Nunito', sans-serif;
            font-size: 0.85rem;
            font-weight: 900;
            color: #A3A3A3;
            margin-bottom: 4px;
            z-index: 3;
            position: relative;
        }

        .card-play-btn {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #FFF;
            font-size: 1.3rem;
            z-index: 3;
            position: relative;
            padding-left: 4px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2), inset 0 2px 0 rgba(255,255,255,0.4);
            transition: transform 0.15s;
        }
        
        .deck-card:hover .card-play-btn {
            transform: scale(1.1);
        }

        /* Card Specific Colors */
        .bg-pink { background: linear-gradient(180deg, #FF72A1 0%, #FF4D8B 100%); }
        .play-pink { background: #FF4D8B; border: 3px solid #FFF; }
        
        .bg-orange { background: linear-gradient(180deg, #FFB233 0%, #FF8F00 100%); }
        .play-orange { background: #FF8F00; border: 3px solid #FFF; }
        
        .bg-yellow { background: linear-gradient(180deg, #FFDE59 0%, #FFC107 100%); }
        .play-yellow { background: #FFC107; border: 3px solid #FFF; }
        
        .bg-green { background: linear-gradient(180deg, #8DE34B 0%, #68CC18 100%); }
        .play-green { background: #68CC18; border: 3px solid #FFF; }
        
        .bg-purple { background: linear-gradient(180deg, #AA66FF 0%, #8833FF 100%); }
        .play-purple { background: #8833FF; border: 3px solid #FFF; }
        
        .bg-teal { background: linear-gradient(180deg, #26D0CE 0%, #0093E9 100%); }
        .play-teal { background: #0093E9; border: 3px solid #FFF; }

        .sparkle {
            position: absolute;
            font-size: 0.9rem;
            color: rgba(255,255,255,0.9);
            animation: twinkle 1.5s infinite alternate;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
            z-index: 2;
        }

        /* --- NEW AUDIO & ANIMATION CLASSES --- */
        
        /* Fade and Scale Screen Transition */
        .screen-enter {
            animation: screenFadeIn 0.4s ease-out forwards;
        }
        @keyframes screenFadeIn {
            0% { opacity: 0; transform: scale(0.95); }
            100% { opacity: 1; transform: scale(1); }
        }

        /* Slide Transition for Cards */
        .slide-in-right { animation: slideInRight 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards; }
        .slide-in-left { animation: slideInLeft 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards; }
        
        @keyframes slideInRight {
            0% { transform: translateX(100%); opacity: 0; }
            100% { transform: translateX(0); opacity: 1; }
        }
        @keyframes slideInLeft {
            0% { transform: translateX(-100%); opacity: 0; }
            100% { transform: translateX(0); opacity: 1; }
        }

        /* Haptic Bounce Click */
        .bounce-click {
            animation: bounceClick 0.2s ease-in-out;
        }
        @keyframes bounceClick {
            0% { transform: scale(1); }
            50% { transform: scale(0.9); }
            100% { transform: scale(1.05); }
        }

        /* Sound Wave Pulsing Ring */
        .sound-wave-ring {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.4);
            z-index: 0;
            pointer-events: none;
            opacity: 0;
        }
        .sound-wave-active {
            animation: pulseWave 1s infinite;
        }
        @keyframes pulseWave {
            0% { transform: translate(-50%, -50%) scale(0.8); opacity: 0.8; }
            100% { transform: translate(-50%, -50%) scale(2.5); opacity: 0; }
        }

        /* Staggered Element Animations */
        .anim-stagger-1 { opacity: 0; animation: scaleBounceIn 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards; animation-delay: 0.1s; }
        .anim-stagger-2 { opacity: 0; animation: popIn 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards; animation-delay: 0.4s; }
        .anim-stagger-3 { opacity: 0; animation: popIn 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards; animation-delay: 0.5s; }

        @keyframes scaleBounceIn {
            0% { transform: scale(0); opacity: 0; }
            80% { transform: scale(1.1); opacity: 1; }
            100% { transform: scale(1); opacity: 1; }
        }

        @keyframes popIn {
            0% { transform: translateY(20px) scale(0.8); opacity: 0; }
            100% { transform: translateY(0) scale(1); opacity: 1; }
        }

        /* Clip Path Sweep (Draw-on simulation) */
        .clip-reveal {
            clip-path: polygon(0 0, 0 100%, 0 100%, 0 0);
            animation: sweepReveal 0.6s ease-out forwards;
            animation-delay: 0.1s;
        }
        @keyframes sweepReveal {
            to { clip-path: polygon(0 0, 0 100%, 100% 100%, 100% 0); }
        }

        /* Idle Floating */
        .float-idle {
            animation: floatUpDn 3s ease-in-out infinite alternate;
        }
        @keyframes floatUpDn {
            0% { transform: translateY(0); }
            100% { transform: translateY(-10px); }
        }

        /* Circular Dot Stepper Progress */
        .dot-stepper {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            margin: 15px auto;
            flex-wrap: wrap;
            max-width: 90%;
        }
        .step-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #E2E8F0;
            transition: all 0.3s ease;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);
        }
        .step-dot.active {
            width: 18px;
            height: 18px;
            background: #FF914D;
            box-shadow: 0 4px 8px rgba(255, 145, 77, 0.4);
            transform: scale(1.1);
        }
        .step-dot.completed {
            background: #4CAF50;
        }

        /* Visual Mascot Instruction */
        .mascot-icon {
            font-size: 2rem;
            animation: bounceClick 2s infinite;
        }
    </style>

    <!-- Phonics Welcome Screen: 2026 Redesign -->
    <main id="phonicsMenuScreen" class="main-container">
        <!-- Header -->
        <header class="phonics-header">
            <!-- Back Button -->
            <a href="{{ route('dashboard') }}" class="btn-back-circle" aria-label="Back to Home">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
            </a>

            <!-- Center Title -->
            <div class="header-title-container">
                <div class="megaphone-icon">📣</div>
                <div class="phonics-title">
                    <div class="phonics-title-top">
                        <span style="color:#FF4B4B">P</span><span style="color:#33CCFF">h</span><span style="color:#FFD13B">o</span><span style="color:#8833FF">n</span><span style="color:#68CC18">i</span><span style="color:#FF8F00">c</span><span style="color:#FF4D8B">s</span>
                    </div>
                    <div class="phonics-title-bottom">
                        <span style="color:#FF4D8B">S</span><span style="color:#8833FF">o</span><span style="color:#FFB800">u</span><span style="color:#FF4B4B">n</span><span style="color:#33CCFF">d</span><span style="color:#68CC18">s</span>
                    </div>
                </div>
            </div>

            <!-- Sound Toggle -->
            <button class="btn-sound-circle" onclick="BGM.toggle()" aria-label="Toggle Sound">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"></polygon>
                    <line x1="23" y1="9" x2="17" y2="15"></line>
                    <line x1="17" y1="9" x2="23" y2="15"></line>
                </svg>
            </button>
        </header>

        <!-- Title Banner -->
        <div class="signboard-container">
            <div class="wooden-board">
                <span class="board-text">Pick a deck to play!</span>
            </div>
            <div class="pointing-hand">👇</div>
        </div>

        <!-- Deck Selector Grid -->
        <nav class="deck-grid" aria-label="Phonics Card Decks">
            <!-- English Letters (Now Video) -->
            <a href="javascript:void(0)" onclick="playAbcVideo()" class="deck-card bg-pink" role="button" aria-label="Play English Letters Video">
                <span class="sparkle" style="top: 10%; left: 20%;" aria-hidden="true">✨</span>
                <span class="sparkle" style="top: 30%; right: 15%; font-size: 0.7rem;" aria-hidden="true">✨</span>
                <img src="{{ asset('img/phonics/card_letters.png') }}" class="card-illustration" alt="English Letters" loading="lazy" decoding="async">
                <div class="card-bottom-curve">
                    <span class="card-label">Letters</span>
                    <div class="card-play-btn play-pink">▶</div>
                </div>
            </a>

            <!-- English Words -->
            <a href="javascript:void(0)" onclick="startReader('english_words')" class="deck-card bg-orange" role="button" aria-label="Play English Words Deck">
                <span class="sparkle" style="top: 15%; right: 20%;" aria-hidden="true">✨</span>
                <img src="{{ asset('img/phonics/card_words.png') }}" class="card-illustration" alt="English Words" loading="lazy" decoding="async">
                <div class="card-bottom-curve">
                    <span class="card-label">Words</span>
                    <div class="card-play-btn play-orange">▶</div>
                </div>
            </a>

            <!-- Numbers 1 to 50 -->
            <a href="javascript:void(0)" onclick="startReader('numbers')" class="deck-card bg-yellow" role="button" aria-label="Play Numbers Deck">
                <span class="sparkle" style="top: 10%; left: 10%;" aria-hidden="true">✨</span>
                <span class="sparkle" style="bottom: 40%; right: 10%;" aria-hidden="true">✨</span>
                <img src="{{ asset('img/phonics/card_numbers.png') }}" class="card-illustration" alt="Numbers" loading="lazy" decoding="async">
                <div class="card-bottom-curve">
                    <span class="card-label">Numbers</span>
                    <div class="card-play-btn play-yellow">▶</div>
                </div>
            </a>

            <!-- Number Words -->
            <a href="javascript:void(0)" onclick="startReader('number_words')" class="deck-card bg-green" role="button" aria-label="Play Number Words Deck">
                <span class="sparkle" style="top: 20%; right: 15%;" aria-hidden="true">✨</span>
                <img src="{{ asset('img/phonics/card_number_words.png') }}" class="card-illustration" alt="Number Words" loading="lazy" decoding="async">
                <div class="card-bottom-curve">
                    <span class="card-label">Number Words</span>
                    <div class="card-play-btn play-green">▶</div>
                </div>
            </a>

            <!-- Hindi Letters -->
            <a href="javascript:void(0)" onclick="startReader('hindi_letters')" class="deck-card bg-purple" role="button" aria-label="Play Hindi Letters Deck">
                <span class="sparkle" style="top: 15%; right: 15%;" aria-hidden="true">✨</span>
                <span class="sparkle" style="bottom: 30%; left: 15%;" aria-hidden="true">✨</span>
                <img src="{{ asset('img/phonics/card_hindi.png') }}" class="card-illustration" alt="Hindi Letters" loading="lazy" decoding="async">
                <div class="card-bottom-curve">
                    <span class="card-label">Hindi</span>
                    <div class="card-play-btn play-purple">▶</div>
                </div>
            </a>

            <!-- Hindi Words -->
            <a href="javascript:void(0)" onclick="startReader('hindi_words')" class="deck-card bg-teal" role="button" aria-label="Play Hindi Words Deck">
                <span class="sparkle" style="top: 10%; left: 20%;" aria-hidden="true">✨</span>
                <img src="{{ asset('img/phonics/card_hindi_words.png') }}" class="card-illustration" alt="Hindi Words" loading="lazy" decoding="async">
                <div class="card-bottom-curve">
                    <span class="card-label">Hindi Words</span>
                    <div class="card-play-btn play-teal">▶</div>
                </div>
            </a>
        </nav>
    </main>

    <!-- ABC Video Screen -->
    <div id="abcVideoScreen" style="display: none; width: 100%; max-width: 700px; margin: 0 auto; font-family: 'Fredoka', sans-serif;">
        <div class="inner-header" style="margin-bottom: 20px;">
            <button onclick="goBackToMenuFromVideo()" class="btn-3d btn-yellow"
                style="display: flex; align-items: center; justify-content: center; border-radius: 50%; width: 44px; height: 44px; padding: 0; font-size: 1.4rem; border: none; cursor: pointer; outline: none; margin: 0;">⬅️</button>
            <h1 class="inner-title" style="margin: 0; display: flex; align-items: center; gap: 8px;">
                <span style="color: var(--color-orange);">ABC Video</span>
            </h1>
        </div>
        <div style="display: flex; justify-content: center; align-items: center; width: 100%; margin-bottom: 30px;">
            <video id="abcVideoPlayer" controls loop style="width: 100%; max-width: 600px; border-radius: 20px; border: 4px solid var(--color-orange); background-color: #000;">
                <source src="{{ asset('video/abc.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </div>

    <!-- Phonics Slideshow Reader Screen -->
    <div id="phonicsReaderScreen"
        style="display: none; width: 100%; max-width: 700px; margin: 0 auto; font-family: 'Fredoka', sans-serif;">
        <!-- Header -->
        <div class="inner-header" style="margin-bottom: 20px;">
            <button onclick="goBackToMenu()" class="btn-3d btn-yellow"
                style="display: flex; align-items: center; justify-content: center; border-radius: 50%; width: 44px; height: 44px; padding: 0; font-size: 1.4rem; border: none; cursor: pointer; outline: none; margin: 0;">⬅️</button>
            <h1 class="inner-title" style="margin: 0; display: flex; align-items: center; gap: 8px;">
                <span id="deckTitle" style="color: var(--color-orange);">English Words Deck</span>
            </h1>
        </div>

        <!-- Deck Instruction & Start/Stop Controls -->
        <div
            style="background: #FFFDF0; padding: 15px 25px; border-radius: 24px; border: 3px solid #E2E8F0; text-align: center; margin-bottom: 24px; display: flex; justify-content: space-between; align-items: center; gap: 16px; flex-wrap: wrap;">
            <div id="deckInstruction" class="mascot-icon" style="font-size: 2.2rem; filter: drop-shadow(0 4px 6px rgba(0,0,0,0.15));" aria-hidden="true">
                🦜
            </div>
            <button onclick="toggleAutoplay()" id="autoplayBtn" class="btn-3d"
                style="background-color: var(--color-green-real); color: white; border-bottom: 5px solid var(--color-green-real-shadow); font-size: 1.1rem; padding: 8px 24px; transition: all 0.15s ease; margin: 0;">
                ▶️ Start
            </button>
        </div>

        <!-- Single Giant Card Display -->
        <div style="display: flex; justify-content: center; align-items: center; width: 100%; margin-bottom: 30px;">
            <div id="giantPhonicsCardContainer" style="width: 100%; max-width: 440px;">
                <!-- Filled dynamically via Javascript -->
            </div>
        </div>

        <!-- Progress Tracking Dots -->
        <div style="text-align: center; margin-bottom: 25px;">
            <div id="readerProgressDots" class="dot-stepper" aria-label="Progress tracker">
                <!-- Dots filled dynamically via Javascript -->
            </div>
        </div>

        <!-- Reader Navigation Controls -->
        <div style="display: flex; gap: 20px; justify-content: center; width: 100%; margin-bottom: 40px;">
            <button onclick="prevCard()" class="btn-3d"
                style="background: #FF914D; border-bottom: 6px solid #D97336; color: white; font-size: 1.6rem; width: 64px; height: 64px; border-radius: 50%; padding: 0; cursor: pointer; display: flex; align-items: center; justify-content: center;"
                title="Previous">
                ⬅️
            </button>
            <button onclick="speakCurrentCard()" class="btn-3d btn-yellow"
                style="font-size: 1.6rem; width: 64px; height: 64px; border-radius: 50%; padding: 0; cursor: pointer; display: flex; align-items: center; justify-content: center;"
                title="Listen">
                🔊
            </button>
            <button onclick="nextCard()" class="btn-3d"
                style="background: var(--color-green-real); border-bottom: 6px solid var(--color-green-real-shadow); color: white; font-size: 1.6rem; width: 64px; height: 64px; border-radius: 50%; padding: 0; cursor: pointer; display: flex; align-items: center; justify-content: center;"
                title="Next">
                ➡️
            </button>
        </div>
    </div>

    <script>
        'use strict';

        // Confetti generators
        function triggerConfettiOnCard(event) {
            if (typeof confetti !== 'function') return;
            const x = event.clientX / window.innerWidth;
            const y = event.clientY / window.innerHeight;
            confetti({
                particleCount: 40,
                spread: 60,
                origin: { x: x, y: y },
                colors: colors,
                scalar: 0.75
            });
        }

        function triggerConfettiOnElement(el) {
            if (typeof confetti !== 'function') return;
            const rect = el.getBoundingClientRect();
            const x = (rect.left + rect.width / 2) / window.innerWidth;
            const y = (rect.top + rect.height / 2) / window.innerHeight;
            confetti({
                particleCount: 25,
                spread: 45,
                origin: { x: x, y: y },
                colors: colors,
                scalar: 0.7
            });
        }

        const englishLetters = [
            { letter: 'A', display: 'Aa', sound: 'ah', phrase: 'A', lang: 'en-US' },
            { letter: 'B', display: 'Bb', sound: 'buh', phrase: 'B', lang: 'en-US' },
            { letter: 'C', display: 'Cc', sound: 'kuh', phrase: 'C', lang: 'en-US' },
            { letter: 'D', display: 'Dd', sound: 'duh', phrase: 'D', lang: 'en-US' },
            { letter: 'E', display: 'Ee', sound: 'eh', phrase: 'E', lang: 'en-US' },
            { letter: 'F', display: 'Ff', sound: 'fuh', phrase: 'F', lang: 'en-US' },
            { letter: 'G', display: 'Gg', sound: 'guh', phrase: 'G', lang: 'en-US' },
            { letter: 'H', display: 'Hh', sound: 'huh', phrase: 'H', lang: 'en-US' },
            { letter: 'I', display: 'Ii', sound: 'ih', phrase: 'I', lang: 'en-US' },
            { letter: 'J', display: 'Jj', sound: 'juh', phrase: 'J', lang: 'en-US' },
            { letter: 'K', display: 'Kk', sound: 'kuh', phrase: 'K', lang: 'en-US' },
            { letter: 'L', display: 'Ll', sound: 'luh', phrase: 'L', lang: 'en-US' },
            { letter: 'M', display: 'Mm', sound: 'muh', phrase: 'M', lang: 'en-US' },
            { letter: 'N', display: 'Nn', sound: 'nuh', phrase: 'N', lang: 'en-US' },
            { letter: 'O', display: 'Oo', sound: 'ah', phrase: 'O', lang: 'en-US' },
            { letter: 'P', display: 'Pp', sound: 'puh', phrase: 'P', lang: 'en-US' },
            { letter: 'Q', display: 'Qq', sound: 'kwuh', phrase: 'Q', lang: 'en-US' },
            { letter: 'R', display: 'Rr', sound: 'ruh', phrase: 'R', lang: 'en-US' },
            { letter: 'S', display: 'Ss', sound: 'suh', phrase: 'S', lang: 'en-US' },
            { letter: 'T', display: 'Tt', sound: 'tuh', phrase: 'T', lang: 'en-US' },
            { letter: 'U', display: 'Uu', sound: 'uh', phrase: 'U', lang: 'en-US' },
            { letter: 'V', display: 'Vv', sound: 'vuh', phrase: 'V', lang: 'en-US' },
            { letter: 'W', display: 'Ww', sound: 'wah', phrase: 'W', lang: 'en-US' },
            { letter: 'X', display: 'Xx', sound: 'zuh', phrase: 'X', lang: 'en-US' },
            { letter: 'Y', display: 'Yy', sound: 'yah', phrase: 'Y', lang: 'en-US' },
            { letter: 'Z', display: 'Zz', sound: 'zuh', phrase: 'Z', lang: 'en-US' }
        ];

        const hindiLetters = [
            { letter: 'क', display: 'क', phrase: 'क', lang: 'hi-IN' },
            { letter: 'ख', display: 'ख', phrase: 'ख', lang: 'hi-IN' },
            { letter: 'ग', display: 'ग', phrase: 'ग', lang: 'hi-IN' },
            { letter: 'घ', display: 'घ', phrase: 'घ', lang: 'hi-IN' },
            { letter: 'ङ', display: 'ङ', phrase: 'ङ', lang: 'hi-IN' },
            { letter: 'च', display: 'च', phrase: 'च', lang: 'hi-IN' },
            { letter: 'छ', display: 'छ', phrase: 'छ', lang: 'hi-IN' },
            { letter: 'ज', display: 'ज', phrase: 'ज', lang: 'hi-IN' },
            { letter: 'झ', display: 'झ', phrase: 'झ', lang: 'hi-IN' },
            { letter: 'ञ', display: 'ञ', phrase: 'ञ', lang: 'hi-IN' },
            { letter: 'ट', display: 'ट', phrase: 'ट', lang: 'hi-IN' },
            { letter: 'ठ', display: 'ठ', phrase: 'ठ', lang: 'hi-IN' },
            { letter: 'ड', display: 'ड', phrase: 'ड', lang: 'hi-IN' },
            { letter: 'ढ', display: 'ढ', phrase: 'ढ', lang: 'hi-IN' },
            { letter: 'ण', display: 'ण', phrase: 'ण', lang: 'hi-IN' },
            { letter: 'त', display: 'त', phrase: 'त', lang: 'hi-IN' },
            { letter: 'थ', display: 'थ', phrase: 'थ', lang: 'hi-IN' },
            { letter: 'द', display: 'द', phrase: 'द', lang: 'hi-IN' },
            { letter: 'ध', display: 'ध', phrase: 'ध', lang: 'hi-IN' },
            { letter: 'न', display: 'न', phrase: 'न', lang: 'hi-IN' },
            { letter: 'प', display: 'प', phrase: 'प', lang: 'hi-IN' },
            { letter: 'फ', display: 'फ', phrase: 'फ', lang: 'hi-IN' },
            { letter: 'ब', display: 'ब', phrase: 'ब', lang: 'hi-IN' },
            { letter: 'भ', display: 'भ', phrase: 'भ', lang: 'hi-IN' },
            { letter: 'म', display: 'म', phrase: 'म', lang: 'hi-IN' },
            { letter: 'य', display: 'य', phrase: 'य', lang: 'hi-IN' },
            { letter: 'र', display: 'र', phrase: 'र', lang: 'hi-IN' },
            { letter: 'ल', display: 'ल', stroke: 'ल', lang: 'hi-IN' },
            { letter: 'व', display: 'व', phrase: 'व', lang: 'hi-IN' },
            { letter: 'श', display: 'श', phrase: 'श', lang: 'hi-IN' },
            { letter: 'ष', display: 'ष', phrase: 'ष', lang: 'hi-IN' },
            { letter: 'स', display: 'स', phrase: 'स', lang: 'hi-IN' },
            { letter: 'ह', display: 'ह', phrase: 'ह', lang: 'hi-IN' },
            { letter: 'क्ष', display: 'क्ष', phrase: 'क्ष', lang: 'hi-IN' },
            { letter: 'त्र', display: 'त्र', phrase: 'त्र', lang: 'hi-IN' },
            { letter: 'ज्ञ', display: 'ज्ञ', phrase: 'ज्ञ', lang: 'hi-IN' }
        ];

        const numbersData = [];
        for (let i = 1; i <= 50; i++) {
            numbersData.push({ letter: i.toString(), display: i.toString(), phrase: i.toString(), lang: 'en-US' });
        }

        const englishWords = [
            { letter: 'A', word: 'Apple 🍎', phrase: 'A for Apple', lang: 'en-US' },
            { letter: 'B', word: 'Ball ⚽', phrase: 'B for Ball', lang: 'en-US' },
            { letter: 'C', word: 'Cat 🐱', phrase: 'C for Cat', lang: 'en-US' },
            { letter: 'D', word: 'Dog 🐶', phrase: 'D for Dog', lang: 'en-US' },
            { letter: 'E', word: 'Elephant 🐘', phrase: 'E for Elephant', lang: 'en-US' },
            { letter: 'F', word: 'Fish 🐟', phrase: 'F for Fish', lang: 'en-US' },
            { letter: 'G', word: 'Grapes 🍇', phrase: 'G for Grapes', lang: 'en-US' },
            { letter: 'H', word: 'Horse 🐴', phrase: 'H for Horse', lang: 'en-US' },
            { letter: 'I', word: 'Igloo ❄️', phrase: 'I for Igloo', lang: 'en-US' },
            { letter: 'J', word: 'Joker 🤡', phrase: 'J for Joker', lang: 'en-US' },
            { letter: 'K', word: 'Kangaroo 🦘', phrase: 'K for Kangaroo', lang: 'en-US' },
            { letter: 'L', word: 'Lion 🦁', phrase: 'L for Lion', lang: 'en-US' },
            { letter: 'M', word: 'Monkey 🐒', phrase: 'M for Monkey', lang: 'en-US' },
            { letter: 'N', word: 'Nest 🪹', phrase: 'N for Nest', lang: 'en-US' },
            { letter: 'O', word: 'Orange 🍊', phrase: 'O for Orange', lang: 'en-US' },
            { letter: 'P', word: 'Parrot 🦜', phrase: 'P for Parrot', lang: 'en-US' },
            { letter: 'Q', word: 'Queen 👑', phrase: 'Q for Queen', lang: 'en-US' },
            { letter: 'R', word: 'Rabbit 🐰', phrase: 'R for Rabbit', lang: 'en-US' },
            { letter: 'S', word: 'Sun ☀️', phrase: 'S for Sun', lang: 'en-US' },
            { letter: 'T', word: 'Tiger 🐯', phrase: 'T for Tiger', lang: 'en-US' },
            { letter: 'U', word: 'Umbrella ☂️', phrase: 'U for Umbrella', lang: 'en-US' },
            { letter: 'V', word: 'Violin 🎻', phrase: 'V for Violin', lang: 'en-US' },
            { letter: 'W', word: 'Watch ⌚', phrase: 'W for Watch', lang: 'en-US' },
            { letter: 'X', word: 'Xylophone 🎹', phrase: 'X for Xylophone', lang: 'en-US' },
            { letter: 'Y', word: 'Yak 🐂', phrase: 'Y for Yak', lang: 'en-US' },
            { letter: 'Z', word: 'Zebra 🦓', phrase: 'Z for Zebra', lang: 'en-US' }
        ];

        const numberWords = [
            { letter: '1', word: 'One (एक)', phrase: 'One, मतलब एक', lang: 'hi-IN' },
            { letter: '2', word: 'Two (दो)', phrase: 'Two, मतलब दो', lang: 'hi-IN' },
            { letter: '3', word: 'Three (तीन)', phrase: 'Three, मतलब तीन', lang: 'hi-IN' },
            { letter: '4', word: 'Four (चार)', phrase: 'Four, मतलब चार', lang: 'hi-IN' },
            { letter: '5', word: 'Five (पांच)', phrase: 'Five, मतलब पांच', lang: 'hi-IN' },
            { letter: '6', word: 'Six (छह)', phrase: 'Six, मतलब छह', lang: 'hi-IN' },
            { letter: '7', word: 'Seven (सात)', phrase: 'Seven, मतलब सात', lang: 'hi-IN' },
            { letter: '8', word: 'Eight (आठ)', phrase: 'Eight, मतलब आठ', lang: 'hi-IN' },
            { letter: '9', word: 'Nine (नौ)', phrase: 'Nine, मतलब नौ', lang: 'hi-IN' },
            { letter: '10', word: 'Ten (दस)', phrase: 'Ten, मतलब दस', lang: 'hi-IN' },
            { letter: '11', word: 'Eleven (ग्यारह)', phrase: 'Eleven, मतलब ग्यारह', lang: 'hi-IN' },
            { letter: '12', word: 'Twelve (बारह)', phrase: 'Twelve, मतलब बारह', lang: 'hi-IN' },
            { letter: '13', word: 'Thirteen (तेरह)', phrase: 'Thirteen, मतलब तेरह', lang: 'hi-IN' },
            { letter: '14', word: 'Fourteen (चौदह)', phrase: 'Fourteen, मतलब चौदह', lang: 'hi-IN' },
            { letter: '15', word: 'Fifteen (पंद्रह)', phrase: 'Fifteen, मतलब पंद्रह', lang: 'hi-IN' },
            { letter: '16', word: 'Sixteen (सोलह)', phrase: 'Sixteen, मतलब सोलह', lang: 'hi-IN' },
            { letter: '17', word: 'Seventeen (सत्रह)', phrase: 'Seventeen, मतलब सत्रह', lang: 'hi-IN' },
            { letter: '18', word: 'Eighteen (अठारह)', phrase: 'Eighteen, मतलब अठारह', lang: 'hi-IN' },
            { letter: '19', word: 'Nineteen (उन्नीस)', phrase: 'Nineteen, मतलब उन्नीस', lang: 'hi-IN' },
            { letter: '20', word: 'Twenty (बीस)', phrase: 'Twenty, मतलब बीस', lang: 'hi-IN' }
        ];

        const hindiWords = [
            { letter: 'क', word: 'कबूतर 🕊️', phrase: 'क से कबूतर', lang: 'hi-IN' },
            { letter: 'ख', word: 'खरगोश 🐰', phrase: 'ख से खरगोश', lang: 'hi-IN' },
            { letter: 'ग', word: 'गमला 🏺', phrase: 'ग से गमला', lang: 'hi-IN' },
            { letter: 'घ', word: 'घर 🏠', phrase: 'घ से घर', lang: 'hi-IN' },
            { letter: 'ङ', word: 'खाली 🫙', phrase: 'ङ खाली', lang: 'hi-IN' },
            { letter: 'च', word: 'चम्मच 🥄', phrase: 'च से चम्मच', lang: 'hi-IN' },
            { letter: 'छ', word: 'छतरी ☂️', phrase: 'छ से छतरी', lang: 'hi-IN' },
            { letter: 'ज', word: 'जहाज 🚢', phrase: 'ज से जहाज', lang: 'hi-IN' },
            { letter: 'झ', word: 'झंडा 🇮🇳', phrase: 'झ से झंडा', lang: 'hi-IN' },
            { letter: 'ञ', word: 'खाली 🫙', phrase: 'ञ खाली', lang: 'hi-IN' },
            { letter: 'ट', word: 'टमाटर 🍅', phrase: 'ट से टमाटर', lang: 'hi-IN' },
            { letter: 'ठ', word: 'ठठेरा 🔨', phrase: 'ठ से ठठेरा', lang: 'hi-IN' },
            { letter: 'ड', word: 'डमरू 🪘', phrase: 'ड से डमरू', lang: 'hi-IN' },
            { letter: 'ढ', word: 'ढक्कन 🪛', phrase: 'ढ से ढक्कन', lang: 'hi-IN' },
            { letter: 'ण', word: 'खाली 🫙', phrase: 'ण खाली', lang: 'hi-IN' },
            { letter: 'त', word: 'तरबूज 🍉', phrase: 'त से तरबूज', lang: 'hi-IN' },
            { letter: 'थ', word: 'थरमस 🍼', phrase: 'थ से थरमस', lang: 'hi-IN' },
            { letter: 'द', word: 'दवात ✒️', phrase: 'द से दवाद', lang: 'hi-IN' },
            { letter: 'ध', word: 'धनुष 🏹', phrase: 'ध से धनुष', lang: 'hi-IN' },
            { letter: 'न', word: 'नल 🚰', phrase: 'न से नल', lang: 'hi-IN' },
            { letter: 'प', word: 'पतंग 🪁', phrase: 'प से पतंग', lang: 'hi-IN' },
            { letter: 'फ', word: 'फल 🍎', phrase: 'फ से फल', lang: 'hi-IN' },
            { letter: 'ब', word: 'बत्तख 🦆', phrase: 'ब से बत्तख', lang: 'hi-IN' },
            { letter: 'भ', word: 'भालू 🐻', phrase: 'भ से भालू', lang: 'hi-IN' },
            { letter: 'म', word: 'मछली 🐟', phrase: 'म से मछली', lang: 'hi-IN' },
            { letter: 'य', word: 'यज्ञ 🔥', phrase: 'य से यज्ञ', lang: 'hi-IN' },
            { letter: 'र', word: 'रथ 🛒', phrase: 'र से रथ', lang: 'hi-IN' },
            { letter: 'ल', word: 'लट्टू 🪀', phrase: 'ल से लट्टू', lang: 'hi-IN' },
            { letter: 'व', word: 'वन 🌳', phrase: 'व से वन', lang: 'hi-IN' },
            { letter: 'श', word: 'शलगम 🍠', phrase: 'श से शलगम', lang: 'hi-IN' },
            { letter: 'ष', word: 'षट्कोण ⬡', phrase: 'ष से षट्कोण', lang: 'hi-IN' },
            { letter: 'स', word: 'सपेरा 🐍', phrase: 'स से सपेरा', lang: 'hi-IN' },
            { letter: 'ह', word: 'हवाई जहाज ✈️', phrase: 'ह से हवाई जहाज', lang: 'hi-IN' },
            { letter: 'क्ष', word: 'क्षत्रिय ⚔️', phrase: 'क्ष से क्षत्रिय', lang: 'hi-IN' },
            { letter: 'त्र', word: 'त्रिशूल 🔱', phrase: 'त्र से त्रिशूल', lang: 'hi-IN' },
            { letter: 'ज्ञ', word: 'ज्ञानी 👨‍🏫', phrase: 'ज्ञ से ज्ञानी', lang: 'hi-IN' }
        ];

        const colors = [
            '#FF5757', '#FF914D', '#7ED957', '#38B6FF', '#FF66C4', '#00C2CB', '#8C52FF'
        ];

        let currentCategory = 'english_letters';
        let currentDataList = [];
        let readerIndex = 0;
        let autoplayActive = false;
        let autoplayTimer = null;
        let swipeDirection = 'right';

        function showScreen(screenId) {
            const screens = ['phonicsMenuScreen', 'phonicsReaderScreen', 'abcVideoScreen'];
            screens.forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    if (id === screenId) {
                        el.style.display = 'block';
                        el.classList.remove('screen-enter');
                        void el.offsetWidth; // trigger reflow
                        el.classList.add('screen-enter');
                    } else {
                        el.style.display = 'none';
                        el.classList.remove('screen-enter');
                    }
                }
            });
            if (screenId !== 'phonicsReaderScreen') {
                stopAutoplay();
            }
            if (screenId !== 'abcVideoScreen') {
                const vid = document.getElementById('abcVideoPlayer');
                if (vid) {
                    vid.pause();
                    vid.currentTime = 0;
                }
            }
        }

        function playAbcVideo() {
            showScreen('abcVideoScreen');
            const vid = document.getElementById('abcVideoPlayer');
            if (vid) vid.play();
        }

        function goBackToMenuFromVideo() {
            showScreen('phonicsMenuScreen');
        }

        function startReader(cat) {
            currentCategory = cat;
            autoplayActive = false;

            // Load data
            if (cat === 'english_letters') currentDataList = englishLetters;
            else if (cat === 'hindi_letters') currentDataList = hindiLetters;
            else if (cat === 'numbers') currentDataList = numbersData;
            else if (cat === 'english_words') currentDataList = englishWords;
            else if (cat === 'number_words') currentDataList = numberWords;
            else if (cat === 'hindi_words') currentDataList = hindiWords;

            readerIndex = 0;

            // Update titles
            const titleEl = document.getElementById('deckTitle');
            const instrEl = document.getElementById('deckInstruction');

            let titleText = "";
            let instrText = "";
            if (cat === 'english_letters') {
                titleText = "🔤 English Letters Deck";
                instrText = "Press Listen or Next to start! 🔊";
            } else if (cat === 'english_words') {
                titleText = "🍎 English Words Deck";
                instrText = "A for Apple, B for Ball... Let's read! 📖";
            } else if (cat === 'numbers') {
                titleText = "🔢 Numbers Deck";
                instrText = "Numbers 1 to 50 counting deck! 🔢";
            } else if (cat === 'number_words') {
                titleText = "🪙 Number Words Deck";
                instrText = "Learn word values! 🪙";
            } else if (cat === 'hindi_letters') {
                titleText = "🕉️ Hindi Letters Deck";
                instrText = "हिंदी वर्णमाला सीखें! 🕉️";
            } else if (cat === 'hindi_words') {
                titleText = "🕊️ Hindi Words Deck";
                instrText = "क से कबूतर, ख से खरगोश... सीखें! 📖";
            }

            if (titleEl) titleEl.innerText = titleText;

            showScreen('phonicsReaderScreen');
            
            // Build Dot Stepper
            const dotContainer = document.getElementById('readerProgressDots');
            if (dotContainer) {
                dotContainer.innerHTML = '';
                // If more than 30 items, just show a few dots for performance, or max 26 for alphabet
                const maxDots = Math.min(currentDataList.length, 26); 
                for(let i = 0; i < maxDots; i++) {
                    const dot = document.createElement('div');
                    dot.className = 'step-dot';
                    dot.id = 'dot-' + i;
                    dotContainer.appendChild(dot);
                }
            }

            renderCard();

            // Narrator intro
            if (window.SoundFX && typeof window.SoundFX.speak === 'function') {
                window.SoundFX.speak("Let's learn " + (cat.replace('_', ' ')) + "!", "en-US", () => {
                    setTimeout(() => {
                        speakCurrentCard();
                    }, 200);
                });
            } else {
                setTimeout(() => {
                    speakCurrentCard();
                }, 500);
            }
        }

        function renderCard() {
            const container = document.getElementById('giantPhonicsCardContainer');
            if (!container || currentDataList.length === 0) return;

            // Optional card transition
            container.classList.remove('slide-in-right', 'slide-in-left');
            void container.offsetWidth; // reflow
            container.classList.add(swipeDirection === 'left' ? 'slide-in-left' : 'slide-in-right');
            swipeDirection = 'right'; // reset default

            const item = currentDataList[readerIndex];
            const color = colors[readerIndex % colors.length];

            const card = document.createElement('div');
            card.className = 'giant-phonic-card';
            card.style.setProperty('--card-color', color);
            card.onclick = (e) => {
                card.classList.remove('bounce-click');
                void card.offsetWidth;
                card.classList.add('bounce-click');
                if (window.SoundFX) window.SoundFX.play('pop');
                triggerConfettiOnCard(e);
                setTimeout(() => speakCurrentCard(), 150);
            };

            // Sound Wave Ring
            const soundRing = `<div class="sound-wave-ring" id="activeSoundRing"></div>`;

            if (currentCategory === 'english_letters' || currentCategory === 'hindi_letters') {
                card.innerHTML = `
                    ${soundRing}
                    <span class="giant-big-letter clip-reveal" style="color: ${color};">${item.display}</span>
                `;
            } else if (currentCategory === 'numbers') {
                card.innerHTML = `
                    ${soundRing}
                    <span class="giant-big-letter anim-stagger-1" id="slotMachineNumber" style="color: ${color};">0</span>
                `;
                // Slot machine effect
                let currentNum = 0;
                const targetNum = parseInt(item.display) || 1;
                const slotInt = setInterval(() => {
                    currentNum++;
                    const slotEl = document.getElementById('slotMachineNumber');
                    if (slotEl) slotEl.innerText = currentNum;
                    if (currentNum >= targetNum) clearInterval(slotInt);
                }, Math.max(10, 400 / targetNum));
            } else {
                let wordText = item.word;
                let emoji = '🍎';
                const emojiRegex = /[\p{Emoji_Presentation}\p{Emoji}\u200d]+/gu;
                const match = item.word ? item.word.match(emojiRegex) : null;
                if (match) {
                    emoji = match[0];
                    wordText = item.word.replace(emojiRegex, '').trim();
                }

                card.innerHTML = `
                    ${soundRing}
                    <div style="display: flex; justify-content: center; width: 100%; margin-bottom: 5px;">
                        <span class="giant-letter-bubble anim-stagger-1 clip-reveal" style="background: ${color}; transform-origin: center;">${item.letter}</span>
                    </div>
                    <span class="giant-emoji-graphic float-idle anim-stagger-2">${emoji}</span>
                    <span class="giant-word-label anim-stagger-3">${wordText}</span>
                `;
            }

            container.innerHTML = '';
            container.appendChild(card);

            // Update Dot Stepper
            const maxDots = Math.min(currentDataList.length, 26);
            let activeDotIndex = readerIndex;
            if (currentDataList.length > 26) {
                activeDotIndex = Math.floor((readerIndex / currentDataList.length) * 26);
            }
            
            for(let i = 0; i < maxDots; i++) {
                const dot = document.getElementById('dot-' + i);
                if (dot) {
                    dot.className = 'step-dot';
                    if (i < activeDotIndex) dot.classList.add('completed');
                    else if (i === activeDotIndex) dot.classList.add('active');
                }
            }
        }

        let currentSpeechId = 0;

        function speakCurrentCard() {
            if (currentDataList.length === 0) return;
            const item = currentDataList[readerIndex];
            
            const speechId = ++currentSpeechId;

            if (window.SoundFX && typeof window.SoundFX.play === 'function') {
                window.SoundFX.play('click');
            }

            if (window.SoundFX && typeof window.SoundFX.speak === 'function') {
                // Activate sound ring
                const ring = document.getElementById('activeSoundRing');
                if (ring) {
                    ring.classList.add('sound-wave-active');
                }

                let lang = item.lang || 'en-US';
                let part1 = item.letter || item.display;
                let part2 = null;

                if (currentCategory === 'english_letters') {
                    const wordItem = typeof englishWords !== 'undefined' ? englishWords.find(w => w.letter === item.letter) : null;
                    const wordClean = wordItem ? wordItem.word.replace(/[\p{Emoji_Presentation}\p{Emoji}\u200d]+/gu, '').trim() : '';
                    part1 = item.letter;
                    part2 = `${item.letter} for ${wordClean || 'Apple'}!`;
                } else if (currentCategory === 'hindi_letters') {
                    const hindiWordItem = typeof hindiWords !== 'undefined' ? hindiWords.find(w => w.letter === item.letter) : null;
                    part1 = item.letter;
                    part2 = hindiWordItem ? hindiWordItem.phrase : null;
                    lang = 'hi-IN';
                } else if (currentCategory === 'numbers') {
                    part1 = `Number ${item.letter}`;
                    part2 = null;
                    lang = 'en-US';
                } else if (currentCategory === 'english_words') {
                    part1 = item.letter;
                    part2 = item.phrase;
                    lang = 'en-US';
                } else if (currentCategory === 'hindi_words') {
                    part1 = item.letter;
                    part2 = item.phrase;
                    lang = 'hi-IN';
                }

                window.SoundFX.speak(part1, lang, () => {
                    if (part2 && speechId === currentSpeechId) {
                        setTimeout(() => {
                            if (speechId === currentSpeechId) {
                                window.SoundFX.speak(part2, lang, () => {
                                    if (ring && speechId === currentSpeechId) ring.classList.remove('sound-wave-active');
                                });
                            }
                        }, 200); // Small pause before speaking the object/word
                    } else {
                        if (ring && speechId === currentSpeechId) ring.classList.remove('sound-wave-active');
                    }
                });
            }

            // Award stars
            fetch("{{ route('api.add_stars') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    stars: 1,
                    activity_name: 'Phonics Card ' + currentCategory + ' ' + (item.letter || item.display)
                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const starsPill = document.querySelector('.stars-pill span');
                        if (starsPill) {
                            starsPill.innerText = data.new_stars;
                        }
                    }
                });
        }

        function nextCard() {
            if (readerIndex < currentDataList.length - 1) {
                readerIndex++;
                renderCard();

                // Confetti trigger at card center
                const cardEl = document.querySelector('.giant-phonic-card');
                if (cardEl) {
                    triggerConfettiOnElement(cardEl);
                }

                speakCurrentCard();
            } else {
                // Completed!
                if (typeof confetti === 'function') {
                    confetti({ particleCount: 150, spread: 80 });
                }
                if (window.SoundFX && typeof window.SoundFX.speak === 'function') {
                    window.SoundFX.speak("Wow! Deck completed! You are super!", "en-US");
                }
                setTimeout(() => {
                    goBackToMenu();
                }, 1800);
            }
        }

        function prevCard() {
            if (readerIndex > 0) {
                readerIndex--;
                renderCard();
                speakCurrentCard();
            }
        }

        function goBackToMenu() {
            stopAutoplay();
            showScreen('phonicsMenuScreen');
        }

        // Autoplay Logic
        function toggleAutoplay() {
            if (autoplayActive) {
                stopAutoplay();
            } else {
                startAutoplay();
            }
        }

        function startAutoplay() {
            autoplayActive = true;
            const btn = document.getElementById('autoplayBtn');
            if (btn) {
                btn.innerHTML = "🛑 Stop";
                btn.style.backgroundColor = "var(--color-pink)";
                btn.style.borderBottomColor = "var(--color-pink-shadow)";
            }
            playNextAutoplayCard();
        }

        function stopAutoplay() {
            autoplayActive = false;
            if (autoplayTimer) clearTimeout(autoplayTimer);
            window.speechSynthesis.cancel();

            const btn = document.getElementById('autoplayBtn');
            if (btn) {
                btn.innerHTML = "▶️ Start";
                btn.style.backgroundColor = "var(--color-green-real)";
                btn.style.borderBottomColor = "var(--color-green-real-shadow)";
                btn.style.color = "#FFF";
            }
        }

        function playNextAutoplayCard() {
            if (!autoplayActive) return;

            speakCurrentCard();

            if (autoplayTimer) clearTimeout(autoplayTimer);
            autoplayTimer = setTimeout(() => {
                if (!autoplayActive) return;

                if (readerIndex < currentDataList.length - 1) {
                    swipeDirection = 'left';
                    readerIndex++;
                    renderCard();

                    const cardEl = document.querySelector('.giant-phonic-card');
                    if (cardEl) {
                        triggerConfettiOnElement(cardEl);
                    }

                    playNextAutoplayCard();
                } else {
                    // Celebration complete
                    if (typeof confetti === 'function') {
                        confetti({ particleCount: 120, spread: 80 });
                    }
                    if (window.SoundFX && typeof window.SoundFX.speak === 'function') {
                        window.SoundFX.speak("Outstanding! Reading finished!", "en-US");
                    }
                    stopAutoplay();
                }
            }, 4500);
        }

        // Swipe Navigation Logic
        let touchStartX = 0;
        let touchEndX = 0;

        const readerScreen = document.getElementById('phonicsReaderScreen');
        if (readerScreen) {
            readerScreen.addEventListener('touchstart', e => {
                touchStartX = e.changedTouches[0].screenX;
            }, {passive: true});

            readerScreen.addEventListener('touchend', e => {
                touchEndX = e.changedTouches[0].screenX;
                handleSwipe();
            }, {passive: true});
        }

        function handleSwipe() {
            if (touchEndX < touchStartX - 50) {
                swipeDirection = 'left';
                nextCard();
            }
            if (touchEndX > touchStartX + 50) {
                swipeDirection = 'right';
                prevCard();
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            showScreen('phonicsMenuScreen');
        });
    </script>
@endsection