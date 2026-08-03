@extends('layouts.app')

@section('title', 'Kuhu Kids Learning - Balloon Pop Game')

@section('content')
    <!-- Include Canvas Confetti -->
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

    <!-- Outer Magical Learning World Wrapper -->
    <div class="balloon-world-container">
        <!-- Magical Sky Background Decor -->
        <div class="sky-decor-container">
            <!-- Glowing Sun -->
            <div class="sun-wrapper">
                <svg class="sun-svg" viewBox="0 0 100 100">
                    <g class="sun-rays">
                        <circle cx="50" cy="50" r="45" fill="none" stroke="#FFE082" stroke-width="4"
                            stroke-dasharray="6,8" />
                    </g>
                    <circle cx="50" cy="50" r="32" fill="#FFD54F" filter="drop-shadow(0 0 12px #FFE082)" />
                    <!-- Sun Face -->
                    <circle cx="42" cy="45" r="3" fill="#5D4037" />
                    <circle cx="58" cy="45" r="3" fill="#5D4037" />
                    <path d="M 44 54 Q 50 60 56 54" fill="none" stroke="#5D4037" stroke-width="2.5"
                        stroke-linecap="round" />
                </svg>
            </div>

            <!-- Rainbow Arch -->
            <div class="rainbow-wrapper">
                <svg viewBox="0 0 200 100" class="rainbow-svg">
                    <path d="M 10 100 A 90 90 0 0 1 190 100" fill="none" stroke="#FF5252" stroke-width="8" opacity="0.85" />
                    <path d="M 18 100 A 82 82 0 0 1 182 100" fill="none" stroke="#FF7043" stroke-width="8" opacity="0.85" />
                    <path d="M 26 100 A 74 74 0 0 1 174 100" fill="none" stroke="#FFCA28" stroke-width="8" opacity="0.85" />
                    <path d="M 34 100 A 66 66 0 0 1 166 100" fill="none" stroke="#66BB6A" stroke-width="8" opacity="0.85" />
                    <path d="M 42 100 A 58 58 0 0 1 158 100" fill="none" stroke="#42A5F5" stroke-width="8" opacity="0.85" />
                    <path d="M 50 100 A 50 50 0 0 1 150 100" fill="none" stroke="#AB47BC" stroke-width="8" opacity="0.85" />
                </svg>
            </div>

            <!-- Fluffy Floating Clouds -->
            <div class="bg-cloud cloud-1"></div>
            <div class="bg-cloud cloud-2"></div>
            <div class="bg-cloud cloud-3"></div>

            <!-- Floating Background Balloons -->
            <div class="bg-balloon bg-b1">🎈</div>
            <div class="bg-balloon bg-b2">🎈</div>
            <div class="bg-balloon bg-b3">🎈</div>
            <div class="bg-balloon bg-b4">🎈</div>

            <!-- Twinkling Sparkles & Stars -->
            <div class="sparkle sp-1">✨</div>
            <div class="sparkle sp-2">⭐</div>
            <div class="sparkle sp-3">✨</div>
            <div class="sparkle sp-4">🌟</div>
        </div>

        <!-- Main Content Container (Max width 960px centered for Desktop) -->
        <div class="balloon-game-wrapper">

            <!-- Top Header Navigation -->
            <header class="game-header">
                <!-- Left: Back Button -->
                <a href="{{ route('dashboard') }}" class="header-icon-btn btn-yellow-circle" title="Back to Home">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                </a>

                <!-- Center: Glossy 3D Bubble Title -->
                <div class="bubble-title-wrapper">
                    <h1 class="bubble-title-3d">
                        <span class="title-balloon-icon">🎈</span>
                        <span class="letter-b">B</span>
                        <span class="letter-a">a</span>
                        <span class="letter-l1">l</span>
                        <span class="letter-l2">l</span>
                        <span class="letter-o1">o</span>
                        <span class="letter-o2">o</span>
                        <span class="letter-n">n</span>
                        <span class="title-space"> </span>
                        <span class="letter-p">P</span>
                        <span class="letter-op1">o</span>
                        <span class="letter-p2">p</span>
                    </h1>
                </div>

                <!-- Right: Sound Toggle Button & Level Badge -->
                <div class="header-right-group">
                    <!-- Wooden Level Badge -->
                    <div class="wooden-star-badge" title="Current Level">
                        <span class="star-icon">⭐</span>
                        <span class="level-text">Lvl <strong id="levelDisplay">1</strong></span>
                    </div>

                    <!-- Purple Sound Button -->
                    <button onclick="toggleVoiceAudio()" id="voiceToggleBtn" class="header-icon-btn btn-purple-circle"
                        title="Toggle Sound">
                        🔊
                    </button>
                </div>
            </header>

            <!-- Category & Mode Selector Buttons -->
            <nav class="category-selector-bar">
                <button onclick="setMode('letters')" id="chip-letters" class="mode-btn mode-btn-pink active-chip">
                    <span class="mode-icon">🔤</span>
                    <span>A–Z</span>
                </button>
                <button onclick="setMode('hindi')" id="chip-hindi" class="mode-btn mode-btn-orange">
                    <span class="mode-icon">🇮🇳</span>
                    <span>Hindi (क–ज्ञ)</span>
                </button>
                <button onclick="setMode('numbers')" id="chip-numbers" class="mode-btn mode-btn-yellow">
                    <span class="mode-icon">🔢</span>
                    <span>Numbers (1–20)</span>
                </button>
                <button onclick="setMode('colors')" id="chip-colors" class="mode-btn mode-btn-teal">
                    <span class="mode-icon">🎨</span>
                    <span>Colors</span>
                </button>
            </nav>

            <!-- Main Learning Panel Card -->
            <main class="main-learning-card">

                <!-- Card Header: Target Prompt Panel -->
                <div class="card-prompt-header">
                    <div class="prompt-text-group">
                        <span id="instructionLabel" class="prompt-label">Find Balloon:</span>
                        <div id="targetBadge" class="target-alphabet-badge">A</div>
                    </div>

                    <button onclick="speakInstruction()" class="speaker-btn btn-yellow-3d" title="Hear Prompt Audio">
                        🔊
                    </button>
                </div>

                <!-- Card Body / Game Arena -->
                <div class="card-body-arena" id="gameArea">

                    <!-- Start Game Welcome Screen -->
                    <div id="startScreen" class="start-game-overlay">
                        <!-- Decor Mascot inside Start Screen -->
                        <div class="mascot-decor-group">
                            <div class="mascot-balloon-hero">🎈</div>
                            <div class="mascot-sparkles">✨ 🎉 ⭐</div>
                        </div>

                        <h2 class="start-title">Ready to Learn with Balloons?</h2>
                        <p class="start-subtitle">Touch the correct balloon to pop it, complete the level, and earn shiny
                            stars!</p>

                        <!-- Green Glossy 3D Start Button -->
                        <button onclick="startGame()" class="btn-start-game">
                            <span class="play-icon">▶</span>
                            <span>Start Game</span>
                        </button>
                    </div>

                    <!-- Interactive Balloons Option Grid -->
                    <div class="balloon-grid" id="balloonGrid" style="display: none;">
                        <!-- Option balloons rendered dynamically by JS -->
                    </div>
                </div>
            </main>

            <!-- Bottom Grass Decor with Cute Mascot Decors & Flowers -->
            <div class="bottom-decor-hill">
                <svg viewBox="0 0 1000 120" preserveAspectRatio="none" class="hill-svg">
                    <path d="M 0,60 Q 250,20 500,60 T 1000,40 L 1000,120 L 0,120 Z" fill="#81C784" opacity="0.75" />
                    <path d="M 0,80 Q 350,30 700,75 T 1000,60 L 1000,120 L 0,120 Z" fill="#4CAF50" />
                </svg>

                <div class="flower-decor fl-1">🌸</div>
                <div class="flower-decor fl-2">🌻</div>
                <div class="flower-decor fl-3">🌷</div>
                <div class="flower-decor fl-4">🌼</div>
                <div class="bee-decor">🐝</div>
                <div class="butterfly-decor">🦋</div>
                <div class="bunny-decor">🐰</div>
            </div>

    <!-- Surprise Toy Gift Unboxing Modal -->
    <div id="toyGiftModal" class="toy-gift-modal" style="display: none;">
        <div class="toy-modal-card">
            <!-- Phase 1: Unopened Gift Box -->
            <div id="giftClosedState" class="gift-state">
                <div class="gift-header-badge">🌟 LEVEL CLEARED! 🌟</div>
                <h2 class="gift-title">Surprise Gift Unlocked!</h2>
                <p class="gift-subtitle">Tap the Gift Box to unwrap your surprise Toy!</p>

                <div onclick="openToyGift()" class="gift-box-interactive" title="Tap to Open!">
                    <div class="gift-box-glow"></div>
                    <div class="gift-box-emoji">🎁</div>
                    <div class="gift-tap-hint">✨ TAP TO OPEN! ✨</div>
                </div>
            </div>

            <!-- Phase 2: Opened Toy Revealed -->
            <div id="giftOpenedState" class="gift-state" style="display: none;">
                <div class="gift-header-badge badge-green">🎉 TOY UNLOCKED! 🎉</div>
                <div id="toyEmojiBadge" class="toy-emoji-hero">🧸</div>
                <h2 id="toyNameTitle" class="toy-title">Teddy Bear!</h2>
                <div class="toy-bonus-stars">⭐ +10 Bonus Stars Earned! ⭐</div>

                <button onclick="claimToyAndContinue()" class="btn-claim-toy">
                    <span>Claim Toy & Next Level ▶</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Hidden Selectors (Maintained for JS compatibility) -->
    <div style="display: none;">
        <select id="gameModeSelect" onchange="changeMode()">
            <option value="letters">Letters</option>
            <option value="numbers">Numbers</option>
            <option value="colors">Colors</option>
        </select>
        <select id="voiceLangSelect" onchange="changeVoiceLang()">
            <option value="en">English</option>
            <option value="hi">Hindi</option>
        </select>
        <select id="balloonCountSelect" onchange="changeBalloonCount()">
            <option value="3" selected>3</option>
        </select>
    </div>

    <style>
        /* ====================================================
                   MAGICAL BALLOON POP WORLD - RESPONSIVE DESIGN SYSTEM
                   ==================================================== */

        html, body {
            padding: 0 !important;
            margin: 0 !important;
            width: 100% !important;
            height: 100% !important;
            overflow-x: hidden !important;
            background: linear-gradient(180deg, #60C5FF 0%, #A8E5FF 55%, #E0F7FF 100%) !important;
        }

        .app-container {
            max-width: 100% !important;
            width: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        .bg-scene {
            display: none !important;
        }

        .balloon-world-container {
            position: relative;
            width: 100%;
            min-height: 100vh;
            background: linear-gradient(180deg, #60C5FF 0%, #A8E5FF 55%, #E0F7FF 100%);
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            padding: 0 !important;
            margin: 0 !important;
        }

        /* Background Magical World Layer */
        .sky-decor-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: hidden;
            z-index: 1;
        }

        .sun-wrapper {
            position: absolute;
            top: 15px;
            right: 4%;
            width: 90px;
            height: 90px;
        }

        .sun-svg {
            width: 100%;
            height: 100%;
        }

        .sun-rays {
            animation: rotateSunRays 20s linear infinite;
            transform-origin: center;
        }

        @keyframes rotateSunRays {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .rainbow-wrapper {
            position: absolute;
            top: 20px;
            left: 3%;
            width: 220px;
            opacity: 0.85;
        }

        .rainbow-svg {
            width: 100%;
            height: auto;
        }

        /* Clouds */
        .bg-cloud {
            position: absolute;
            background: #FFFFFF;
            border-radius: 50px;
            opacity: 0.88;
            filter: drop-shadow(0 4px 10px rgba(0, 0, 0, 0.06));
        }

        .bg-cloud::before,
        .bg-cloud::after {
            content: '';
            position: absolute;
            background: #FFFFFF;
            border-radius: 50%;
        }

        .cloud-1 {
            top: 60px;
            left: 10%;
            width: 140px;
            height: 45px;
            animation: floatCloud 28s linear infinite alternate;
        }

        .cloud-1::before {
            width: 55px;
            height: 55px;
            top: -25px;
            left: 22px;
        }

        .cloud-1::after {
            width: 75px;
            height: 75px;
            top: -35px;
            right: 22px;
        }

        .cloud-2 {
            top: 110px;
            right: 12%;
            width: 170px;
            height: 50px;
            animation: floatCloud 36s linear infinite alternate-reverse;
        }

        .cloud-2::before {
            width: 65px;
            height: 65px;
            top: -30px;
            left: 30px;
        }

        .cloud-2::after {
            width: 85px;
            height: 85px;
            top: -40px;
            right: 30px;
        }

        .cloud-3 {
            top: 220px;
            left: 45%;
            width: 120px;
            height: 40px;
            opacity: 0.65;
            animation: floatCloud 42s linear infinite alternate;
        }

        .cloud-3::before {
            width: 45px;
            height: 45px;
            top: -20px;
            left: 18px;
        }

        .cloud-3::after {
            width: 60px;
            height: 60px;
            top: -28px;
            right: 18px;
        }

        @keyframes floatCloud {
            0% {
                transform: translateX(-20px);
            }

            100% {
                transform: translateX(40px);
            }
        }

        /* Background Floating Balloons */
        .bg-balloon {
            position: absolute;
            font-size: 2.5rem;
            opacity: 0.7;
            animation: floatUpBg 14s ease-in-out infinite alternate;
        }

        .bg-b1 {
            top: 15%;
            left: 6%;
            animation-delay: 0s;
        }

        .bg-b2 {
            top: 35%;
            right: 7%;
            animation-delay: 2s;
            font-size: 3rem;
        }

        .bg-b3 {
            top: 55%;
            left: 8%;
            animation-delay: 4s;
        }

        .bg-b4 {
            top: 70%;
            right: 9%;
            animation-delay: 1s;
            font-size: 2.8rem;
        }

        @keyframes floatUpBg {
            0% {
                transform: translateY(0) rotate(-6deg);
            }

            100% {
                transform: translateY(-35px) rotate(8deg);
            }
        }

        /* Twinkling Sparkles */
        .sparkle {
            position: absolute;
            font-size: 1.6rem;
            animation: twinkleSp 2s ease-in-out infinite alternate;
        }

        .sp-1 {
            top: 8%;
            left: 35%;
            animation-delay: 0.2s;
        }

        .sp-2 {
            top: 18%;
            right: 30%;
            animation-delay: 0.8s;
            color: #FFDE59;
        }

        .sp-3 {
            top: 40%;
            left: 15%;
            animation-delay: 1.2s;
        }

        .sp-4 {
            top: 50%;
            right: 18%;
            animation-delay: 0.5s;
            color: #FF914D;
        }

        @keyframes twinkleSp {
            0% {
                opacity: 0.3;
                transform: scale(0.8);
            }

            100% {
                opacity: 1;
                transform: scale(1.25);
            }
        }

        /* ====================================================
                   MAIN RESPONSIVE CONTAINER (Desktop Centered 960px)
                   ==================================================== */
        .balloon-game-wrapper {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 100%;
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin: 0 auto;
            padding: 4px 4px 0 4px !important;
        }

        /* Fixed/Top Header Navigation */
        .game-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            gap: 12px;
            flex-wrap: wrap;
        }

        /* Header Buttons */
        .header-icon-btn {
            width: 52px;
            height: 52px;
            min-width: 52px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            cursor: pointer;
            text-decoration: none;
            border: none;
            outline: none;
            box-shadow: 0 6px 0 rgba(0, 0, 0, 0.18), 0 10px 20px rgba(0, 0, 0, 0.12);
            transition: transform 0.2s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.2s ease;
        }

        .btn-yellow-circle {
            background: linear-gradient(145deg, #FFE873 0%, #FFDE59 60%, #E6C438 100%);
            color: #4A3B00;
            border-bottom: 5px solid #C4A51D !important;
        }

        .btn-purple-circle {
            background: linear-gradient(145deg, #A26BFF 0%, #8C52FF 60%, #6E3CD9 100%);
            color: #FFFFFF;
            border-bottom: 5px solid #5623B8 !important;
        }

        .header-icon-btn:hover {
            transform: translateY(-4px) scale(1.08);
            box-shadow: 0 10px 0 rgba(0, 0, 0, 0.2), 0 14px 25px rgba(0, 0, 0, 0.18);
        }

        .header-icon-btn:active {
            transform: translateY(2px) scale(0.95);
        }

        /* Glossy 3D Bubble Title */
        .bubble-title-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .bubble-title-3d {
            font-size: 2.2rem;
            font-weight: 900;
            font-family: 'Fredoka', sans-serif;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 3px;
            user-select: none;
        }

        .title-balloon-icon {
            font-size: 2.4rem;
            margin-right: 4px;
            filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.2));
            animation: balloonFloatIcon 2.5s ease-in-out infinite alternate;
        }

        @keyframes balloonFloatIcon {
            0% {
                transform: translateY(0) rotate(-4deg);
            }

            100% {
                transform: translateY(-8px) rotate(6deg);
            }
        }

        .bubble-title-3d span:not(.title-balloon-icon):not(.title-space) {
            display: inline-block;
            color: #FFFFFF;
            -webkit-text-stroke: 2.5px #1E293B;
            text-shadow: 0 5px 0 #1E293B, 0 8px 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s ease;
        }

        .letter-b {
            color: #FF5252 !important;
        }

        .letter-a {
            color: #FF914D !important;
        }

        .letter-l1 {
            color: #FFDE59 !important;
        }

        .letter-l2 {
            color: #7ED957 !important;
        }

        .letter-o1 {
            color: #38B6FF !important;
        }

        .letter-o2 {
            color: #8C52FF !important;
        }

        .letter-n {
            color: #FF66C4 !important;
        }

        .letter-p {
            color: #FF5252 !important;
        }

        .letter-op1 {
            color: #FFDE59 !important;
        }

        .letter-p2 {
            color: #7ED957 !important;
        }

        /* Header Right Group */
        .header-right-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .wooden-star-badge {
            background: linear-gradient(145deg, #FFFDF0 0%, #FEF3C7 100%);
            border: 3.5px solid #F59E0B;
            border-bottom: 6px solid #D97706;
            border-radius: 24px;
            padding: 6px 16px;
            font-size: 1.15rem;
            font-weight: 900;
            color: #92400E;
            display: flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.1);
        }

        .star-icon {
            font-size: 1.3rem;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
        }

        /* Category Selector Bar */
        .category-selector-bar {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            width: 100%;
            flex-wrap: wrap;
        }

        .mode-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 22px;
            min-height: 48px;
            border-radius: 24px;
            font-family: 'Fredoka', sans-serif;
            font-size: 1.15rem;
            font-weight: 900;
            cursor: pointer;
            text-decoration: none;
            border: none;
            outline: none;
            box-shadow: inset 0 3px 0 rgba(255, 255, 255, 0.45), 0 6px 0 rgba(0, 0, 0, 0.15), 0 10px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.2s ease, border-bottom-width 0.2s ease;
        }

        .mode-btn-pink {
            background: linear-gradient(145deg, #FF85D3 0%, #FF66C4 60%, #D94B9F 100%);
            color: #FFF;
            border-bottom: 6px solid #B53280;
        }

        .mode-btn-orange {
            background: linear-gradient(145deg, #FFA970 0%, #FF914D 60%, #D97336 100%);
            color: #FFF;
            border-bottom: 6px solid #B85318;
        }

        .mode-btn-yellow {
            background: linear-gradient(145deg, #FFE873 0%, #FFDE59 60%, #E6C438 100%);
            color: #4A3B00;
            border-bottom: 6px solid #C4A51D;
        }

        .mode-btn-teal {
            background: linear-gradient(145deg, #2EDBEE 0%, #00C2CB 60%, #009BA2 100%);
            color: #FFF;
            border-bottom: 6px solid #00767C;
        }

        .mode-btn:hover {
            transform: translateY(-4px) scale(1.05);
            box-shadow: inset 0 4px 0 rgba(255, 255, 255, 0.6), 0 10px 0 rgba(0, 0, 0, 0.18), 0 14px 24px rgba(0, 0, 0, 0.15);
        }

        .mode-btn:active,
        .mode-btn.active-chip {
            transform: translateY(3px) scale(0.97);
            border-bottom-width: 3px !important;
            box-shadow: inset 0 2px 0 rgba(0, 0, 0, 0.15), 0 4px 10px rgba(0, 0, 0, 0.12);
        }

        /* ====================================================
                   MAIN LEARNING CARD
                   ==================================================== */
        .main-learning-card {
            position: relative;
            background: linear-gradient(165deg, #FFFFFF 0%, #FFFDF0 60%, #F0FDF4 100%);
            border-radius: 36px;
            border: 5px solid #7ED957;
            border-bottom: 14px solid #59B233;
            box-shadow:
                inset 0 6px 0 rgba(255, 255, 255, 0.8),
                inset 0 -6px 12px rgba(0, 0, 0, 0.08),
                0 20px 40px rgba(0, 0, 0, 0.16);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        /* Glossy Top Overlay on Card */
        .main-learning-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 40%;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.45) 0%, rgba(255, 255, 255, 0) 100%);
            pointer-events: none;
            z-index: 2;
        }

        /* Card Prompt Header */
        .card-prompt-header {
            position: relative;
            z-index: 5;
            background: linear-gradient(145deg, #F8FAFC 0%, #EFF6FF 100%);
            border-bottom: 4px solid #E2E8F0;
            padding: 16px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .prompt-text-group {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .prompt-label {
            font-size: 1.5rem;
            font-weight: 900;
            color: #334155;
            font-family: 'Fredoka', sans-serif;
        }

        .target-alphabet-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 72px;
            height: 72px;
            border-radius: 22px;
            background: linear-gradient(145deg, #FFFFFF 0%, #FFFDF0 100%);
            border: 4px solid #FFDE59;
            border-bottom: 7px solid #E6C438;
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.1);
            font-size: 2.8rem;
            font-weight: 900;
            color: #8C52FF;
            padding: 4px 12px;
            font-family: 'Fredoka', sans-serif;
            transition: transform 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .speaker-btn {
            width: 54px;
            height: 54px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            cursor: pointer;
            border: none;
            outline: none;
            background: linear-gradient(145deg, #FFE873 0%, #FFDE59 60%, #E6C438 100%);
            color: #4A3B00;
            border-bottom: 5px solid #C4A51D;
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.12);
            transition: transform 0.2s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .speaker-btn:hover {
            transform: scale(1.12) rotate(6deg);
        }

        .speaker-btn:active {
            transform: scale(0.94);
        }

        /* Card Body / Arena */
        .card-body-arena {
            position: relative;
            min-height: 420px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            background: radial-gradient(circle at 50% 30%, #FFFFFF 0%, #F0FDF4 100%);
        }

        /* Start Game Overlay Screen */
        .start-game-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(8px);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 30px 20px;
            z-index: 50;
            text-align: center;
            gap: 16px;
        }

        .mascot-decor-group {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
        }

        .mascot-balloon-hero {
            font-size: 5rem;
            filter: drop-shadow(0 10px 15px rgba(0, 0, 0, 0.15));
            animation: mascotBounce 2.2s ease-in-out infinite alternate;
        }

        @keyframes mascotBounce {
            0% {
                transform: translateY(0) rotate(-6deg) scale(1);
            }

            100% {
                transform: translateY(-16px) rotate(6deg) scale(1.08);
            }
        }

        .mascot-sparkles {
            font-size: 1.5rem;
            letter-spacing: 8px;
            opacity: 0.9;
        }

        .start-title {
            font-size: 2.2rem;
            font-weight: 900;
            color: #8C52FF;
            margin: 0;
            font-family: 'Fredoka', sans-serif;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.06);
        }

        .start-subtitle {
            font-size: 1.15rem;
            color: #64748B;
            max-width: 480px;
            margin: 0;
            font-weight: 600;
            line-height: 1.5;
        }

        .btn-start-game {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            padding: 16px 44px;
            min-height: 58px;
            border-radius: 30px;
            font-family: 'Fredoka', sans-serif;
            font-size: 1.6rem;
            font-weight: 900;
            color: #FFFFFF;
            background: linear-gradient(145deg, #4ADE80 0%, #22C55E 60%, #16A34A 100%);
            border: none;
            border-bottom: 7px solid #15803D;
            box-shadow: inset 0 3px 0 rgba(255, 255, 255, 0.5), 0 12px 24px rgba(34, 197, 94, 0.4);
            cursor: pointer;
            transition: transform 0.25s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.25s ease;
            margin-top: 10px;
        }

        .btn-start-game:hover {
            transform: translateY(-6px) scale(1.06);
            box-shadow: inset 0 4px 0 rgba(255, 255, 255, 0.6), 0 18px 32px rgba(34, 197, 94, 0.5);
        }

        .btn-start-game:active {
            transform: translateY(3px) scale(0.96);
            border-bottom-width: 3px;
        }

        /* Options Balloon Grid */
        .balloon-grid {
            display: grid;
            grid-template-columns: repeat(3, auto);
            gap: 32px;
            justify-content: center;
            align-content: center;
            width: 100%;
            padding: 20px 10px;
            z-index: 10;
        }

        /* Static Smiling Balloon */
        .static-balloon {
            position: relative;
            width: 130px;
            height: 165px;
            border-radius: 50% 50% 50% 50% / 40% 40% 60% 60%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: inset -8px -12px 0 rgba(0, 0, 0, 0.16), inset 6px 8px 0 rgba(255, 255, 255, 0.4), 0 12px 24px rgba(0, 0, 0, 0.18);
            transition: transform 0.25s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.25s ease;
            animation: gentleBob 2.2s ease-in-out infinite alternate;
        }

        .static-balloon::before {
            content: '';
            position: absolute;
            top: 25%;
            left: 28%;
            width: 9px;
            height: 9px;
            background: white;
            border-radius: 50%;
            box-shadow: 40px 0 0 white;
            z-index: 2;
        }

        .static-balloon::after {
            content: '';
            position: absolute;
            top: 42%;
            left: 50%;
            width: 24px;
            height: 12px;
            border-bottom: 4px solid white;
            border-radius: 0 0 12px 12px;
            transform: translateX(-50%);
            z-index: 2;
        }

        .balloon-label {
            position: absolute;
            bottom: 12%;
            width: 100%;
            text-align: center;
            font-size: 3rem;
            font-weight: 900;
            color: white;
            text-shadow: 2px 3px 0px rgba(0, 0, 0, 0.3);
            pointer-events: none;
            z-index: 3;
            font-family: 'Fredoka', sans-serif;
        }

        .static-string {
            position: absolute;
            bottom: -24px;
            left: 50%;
            width: 3.5px;
            height: 28px;
            background-color: rgba(100, 116, 139, 0.6);
            transform: translateX(-50%);
            z-index: 1;
        }

        .static-balloon:hover {
            transform: translateY(-10px) scale(1.12);
            box-shadow: inset -8px -12px 0 rgba(0, 0, 0, 0.18), inset 6px 8px 0 rgba(255, 255, 255, 0.5), 0 20px 32px rgba(0, 0, 0, 0.24);
        }

        .static-balloon:active {
            transform: translateY(4px) scale(0.94);
        }

        .static-balloon:nth-child(even) {
            animation-duration: 2.5s;
            animation-delay: 0.3s;
        }

        @keyframes gentleBob {
            0% {
                transform: translateY(0);
            }

            100% {
                transform: translateY(-12px);
            }
        }

        @keyframes shakeWrong {

            0%,
            100% {
                transform: translateX(0);
            }

            20%,
            60% {
                transform: translateX(-10px);
            }

            40%,
            80% {
                transform: translateX(10px);
            }
        }

        .wrong-shake {
            animation: shakeWrong 0.4s ease-in-out !important;
            background-color: #CBD5E1 !important;
            color: #64748B !important;
            box-shadow: none !important;
        }

        @keyframes wiggleClue {

            0%,
            100% {
                transform: scale(1) rotate(0deg);
            }

            15% {
                transform: scale(1.18) rotate(-9deg);
            }

            30% {
                transform: scale(1.18) rotate(9deg);
            }

            45% {
                transform: scale(1.18) rotate(-7deg);
            }

            60% {
                transform: scale(1.18) rotate(7deg);
            }

            75% {
                transform: scale(1.12) rotate(-4deg);
            }

            90% {
                transform: scale(1.12) rotate(4deg);
            }
        }

        .wiggle-hint {
            animation: wiggleClue 1.2s ease-in-out infinite alternate !important;
            box-shadow: 0 0 30px rgba(255, 223, 0, 0.95), inset -6px -10px 0 rgba(0, 0, 0, 0.15) !important;
        }

        .bottom-decor-hill {
            position: relative;
            width: 100%;
            height: 90px;
            margin-top: auto;
            margin-bottom: 0;
            padding-bottom: 0;
            pointer-events: none;
            overflow: hidden;
        }

        .hill-svg {
            width: 100%;
            height: 100%;
            display: block;
            vertical-align: bottom;
        }

        .flower-decor,
        .bee-decor,
        .butterfly-decor,
        .bunny-decor {
            position: absolute;
            font-size: 2.2rem;
            filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.12));
        }

        .fl-1 {
            bottom: 15px;
            left: 6%;
        }

        .fl-2 {
            bottom: 25px;
            left: 28%;
        }

        .fl-3 {
            bottom: 20px;
            right: 28%;
        }

        .fl-4 {
            bottom: 15px;
            right: 6%;
        }

        .bee-decor {
            top: 5px;
            left: 18%;
            animation: flyBee 4s ease-in-out infinite alternate;
        }

        @keyframes flyBee {
            0% {
                transform: translate(0, 0) rotate(-6deg);
            }

            100% {
                transform: translate(15px, -12px) rotate(6deg);
            }
        }

        .butterfly-decor {
            top: 10px;
            right: 18%;
            animation: flyBf 5s ease-in-out infinite alternate;
        }

        @keyframes flyBf {
            0% {
                transform: translate(0, 0) scaleX(-1) rotate(4deg);
            }

            100% {
                transform: translate(-18px, -15px) scaleX(-1) rotate(-8deg);
            }
        }

        .bunny-decor {
            bottom: 12px;
            left: 48%;
            font-size: 2.6rem;
        }

        /* Pop Particles */
        @keyframes particleAnimation {
            0% {
                transform: translate(0, 0) scale(1);
                opacity: 1;
            }

            100% {
                transform: translate(var(--tx), var(--ty)) scale(0);
                opacity: 0;
            }
        }

        /* ====================================================
           SURPRISE TOY GIFT UNBOXING MODAL STYLES
           ==================================================== */
        .toy-gift-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(15, 23, 42, 0.78);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            animation: fadeInModal 0.3s ease;
        }

        @keyframes fadeInModal {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .toy-modal-card {
            position: relative;
            width: 100%;
            max-width: 440px;
            background: linear-gradient(165deg, #FFFFFF 0%, #FFFDF0 60%, #F0FDF4 100%);
            border-radius: 32px;
            border: 5px solid #FFDE59;
            border-bottom: 12px solid #E6C438;
            box-shadow: inset 0 5px 0 rgba(255, 255, 255, 0.8), 0 24px 48px rgba(0, 0, 0, 0.4);
            padding: 32px 24px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 16px;
        }

        .gift-state {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 14px;
            width: 100%;
        }

        .gift-header-badge {
            background: linear-gradient(145deg, #FFE873 0%, #FFDE59 100%);
            color: #4A3B00;
            border: 3px solid #FFFFFF;
            border-bottom: 5px solid #C4A51D;
            padding: 6px 20px;
            border-radius: 20px;
            font-size: 1.15rem;
            font-weight: 900;
            font-family: 'Fredoka', sans-serif;
            box-shadow: 0 6px 14px rgba(0,0,0,0.12);
        }

        .badge-green {
            background: linear-gradient(145deg, #4ADE80 0%, #22C55E 100%) !important;
            color: #FFFFFF !important;
            border-bottom: 5px solid #15803D !important;
        }

        .gift-title {
            font-size: 2rem;
            font-weight: 900;
            color: #8C52FF;
            margin: 0;
            font-family: 'Fredoka', sans-serif;
            text-shadow: 0 2px 4px rgba(0,0,0,0.06);
        }

        .gift-subtitle {
            font-size: 1.05rem;
            color: #64748B;
            margin: 0;
            font-weight: 700;
        }

        /* Interactive Bouncy Gift Box */
        .gift-box-interactive {
            position: relative;
            margin: 15px 0;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: transform 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .gift-box-emoji {
            font-size: 6.5rem;
            filter: drop-shadow(0 12px 20px rgba(0,0,0,0.22));
            animation: giftBounce 1.8s ease-in-out infinite alternate;
        }

        @keyframes giftBounce {
            0% { transform: translateY(0) rotate(-6deg) scale(1); }
            100% { transform: translateY(-18px) rotate(6deg) scale(1.12); }
        }

        .gift-box-glow {
            position: absolute;
            width: 140px;
            height: 140px;
            background: radial-gradient(circle, rgba(255,222,89,0.7) 0%, rgba(255,222,89,0) 70%);
            border-radius: 50%;
            z-index: -1;
            animation: pulseGlow 1.5s ease-in-out infinite alternate;
        }

        @keyframes pulseGlow {
            0% { transform: scale(0.85); opacity: 0.5; }
            100% { transform: scale(1.3); opacity: 0.9; }
        }

        .gift-tap-hint {
            background: linear-gradient(145deg, #FF85D3 0%, #FF66C4 100%);
            color: #FFFFFF;
            font-family: 'Fredoka', sans-serif;
            font-size: 1.1rem;
            font-weight: 900;
            padding: 8px 22px;
            border-radius: 20px;
            border: 3px solid #FFFFFF;
            border-bottom: 5px solid #B53280;
            box-shadow: 0 6px 14px rgba(0,0,0,0.15);
            margin-top: 8px;
            animation: bounceHint 1.2s ease-in-out infinite alternate;
        }

        @keyframes bounceHint {
            0% { transform: scale(0.96); }
            100% { transform: scale(1.08); }
        }

        .gift-box-interactive:hover {
            transform: scale(1.12) rotate(4deg);
        }

        /* Revealed Toy Style */
        .toy-emoji-hero {
            font-size: 7rem;
            filter: drop-shadow(0 14px 24px rgba(0,0,0,0.25));
            animation: toyPopIn 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
            margin: 10px 0;
        }

        @keyframes toyPopIn {
            0% { transform: scale(0.2) rotate(-20deg); opacity: 0; }
            100% { transform: scale(1) rotate(0deg); opacity: 1; }
        }

        .toy-title {
            font-size: 2.2rem;
            font-weight: 900;
            color: #FF914D;
            margin: 0;
            font-family: 'Fredoka', sans-serif;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .toy-bonus-stars {
            font-size: 1.2rem;
            font-weight: 900;
            color: #F59E0B;
            background: #FEF3C7;
            border: 2px solid #FBF0B2;
            padding: 6px 18px;
            border-radius: 16px;
        }

        .btn-claim-toy {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 16px 36px;
            min-height: 54px;
            border-radius: 28px;
            font-family: 'Fredoka', sans-serif;
            font-size: 1.4rem;
            font-weight: 900;
            color: #FFFFFF;
            background: linear-gradient(145deg, #4ADE80 0%, #22C55E 60%, #16A34A 100%);
            border: none;
            border-bottom: 7px solid #15803D;
            box-shadow: inset 0 3px 0 rgba(255,255,255,0.5), 0 12px 24px rgba(34, 197, 94, 0.4);
            cursor: pointer;
            transition: transform 0.2s ease;
            margin-top: 10px;
            width: 100%;
        }

        .btn-claim-toy:hover {
            transform: translateY(-4px) scale(1.03);
        }

        .btn-claim-toy:active {
            transform: translateY(2px) scale(0.96);
        }

        /* ====================================================
                   RESPONSIVE BREAKPOINTS (Mobile, Tablet, Desktop)
                   ==================================================== */

        /* Mobile (360px - 640px) */
        @media (max-width: 640px) {
            .balloon-world-container {
                padding: 0 !important;
                margin: 0 !important;
            }

            .balloon-game-wrapper {
                padding: 4px 4px 0 4px !important;
            }

            .game-header {
                justify-content: space-between;
            }

            .bubble-title-3d {
                font-size: 1.6rem;
            }

            .title-balloon-icon {
                font-size: 1.8rem;
            }

            .header-icon-btn {
                width: 44px;
                height: 44px;
                min-width: 44px;
                font-size: 1.25rem;
            }

            .wooden-star-badge {
                padding: 4px 10px;
                font-size: 0.95rem;
            }

            .category-selector-bar {
                gap: 8px;
            }

            .mode-btn {
                padding: 8px 14px;
                min-height: 44px;
                font-size: 0.95rem;
                flex: 1 1 calc(50% - 10px);
            }

            .main-learning-card {
                border-radius: 26px;
                border-width: 4px;
                border-bottom-width: 10px;
            }

            .card-prompt-header {
                padding: 12px 16px;
            }

            .prompt-label {
                font-size: 1.15rem;
            }

            .target-alphabet-badge {
                min-width: 56px;
                height: 56px;
                font-size: 2rem;
                border-radius: 16px;
            }

            .speaker-btn {
                width: 44px;
                height: 44px;
                font-size: 1.3rem;
            }

            .card-body-arena {
                min-height: 350px;
                padding: 16px 8px;
            }

            .balloon-grid {
                gap: 16px;
                padding: 10px 4px;
            }

            .static-balloon {
                width: 95px;
                height: 125px;
            }

            .balloon-label {
                font-size: 2.2rem;
            }

            .start-title {
                font-size: 1.6rem;
            }

            .start-subtitle {
                font-size: 0.95rem;
            }

            .btn-start-game {
                padding: 14px 32px;
                font-size: 1.3rem;
                min-height: 50px;
            }
        }

        /* Tablet (641px - 1024px) */
        @media (min-width: 641px) and (max-width: 1024px) {
            .balloon-game-wrapper {
                max-width: 720px;
            }

            .bubble-title-3d {
                font-size: 2rem;
            }

            .static-balloon {
                width: 115px;
                height: 148px;
            }
        }
    </style>

    <script>
        const gameArea = document.getElementById('gameArea');
        const startScreen = document.getElementById('startScreen');
        const balloonGrid = document.getElementById('balloonGrid');
        const levelDisplay = document.getElementById('levelDisplay');
        const targetBadge = document.getElementById('targetBadge');
        const instructionLabel = document.getElementById('instructionLabel');
        const gameModeSelect = document.getElementById('gameModeSelect');
        const voiceLangSelect = document.getElementById('voiceLangSelect');
        const balloonCountSelect = document.getElementById('balloonCountSelect');

        let level = 1;
        let starsEarned = 0;
        let isPlaying = false;
        let targetValue = '';
        let targetColorObj = null;
        let activeMode = 'letters';
        let voiceLang = 'en';
        let balloonCount = 3;
        let wiggleTimeout = null;

        const balloonColors = [
            '#FF5252', '#FF4081', '#E040FB', '#7C4DFF', '#536DFE', '#448AFF', '#40C4FF', '#FFB300', '#4CAF50', '#00E676', '#81C784', '#D4E157', '#FFD54F', '#FF9100', '#FF3D00'
        ];

        const colorsData = [
            { name: 'Red', hindi: 'लाल', val: '#FF5252', emoji: '🔴' },
            { name: 'Blue', hindi: 'नीला', val: '#38B6FF', emoji: '🔵' },
            { name: 'Green', hindi: 'हरा', val: '#7ED957', emoji: '🟢' },
            { name: 'Yellow', hindi: 'पीला', val: '#FFDE59', emoji: '🟡' },
            { name: 'Orange', hindi: 'नारंगी', val: '#FF914D', emoji: '🟠' },
            { name: 'Purple', hindi: 'बैंगनी', val: '#8C52FF', emoji: '🟣' },
            { name: 'Pink', hindi: 'गुलाबी', val: '#FF66C4', emoji: '🌸' }
        ];

        // Load preferences
        if (localStorage.getItem('balloon_game_mode')) {
            activeMode = localStorage.getItem('balloon_game_mode');
            if (gameModeSelect) gameModeSelect.value = activeMode;
        }
        if (localStorage.getItem('balloon_voice_lang')) {
            voiceLang = localStorage.getItem('balloon_voice_lang');
            if (voiceLangSelect) voiceLangSelect.value = voiceLang;
        }
        if (localStorage.getItem('balloon_count')) {
            balloonCount = parseInt(localStorage.getItem('balloon_count'));
            if (balloonCountSelect) balloonCountSelect.value = balloonCount;
        }

        // Initialize voice button state
        if (localStorage.getItem('voice_enabled') === 'false') {
            const btn = document.getElementById('voiceToggleBtn');
            if (btn) btn.innerHTML = '🔇';
        }

        function toggleVoiceAudio() {
            const current = localStorage.getItem('voice_enabled');
            const btn = document.getElementById('voiceToggleBtn');
            if (current === 'false') {
                localStorage.setItem('voice_enabled', 'true');
                if (btn) btn.innerHTML = '🔊';
                speakInstruction();
            } else {
                localStorage.setItem('voice_enabled', 'false');
                if (btn) btn.innerHTML = '🔇';
            }
        }

        function updateGridColumns() {
            if (balloonCount === 3) {
                balloonGrid.style.gridTemplateColumns = 'repeat(3, auto)';
            } else {
                balloonGrid.style.gridTemplateColumns = 'repeat(2, auto)';
            }
        }

        function setMode(mode) {
            activeMode = mode;
            localStorage.setItem('balloon_game_mode', mode);

            document.querySelectorAll('.mode-btn').forEach(btn => btn.classList.remove('active-chip'));
            const activeBtn = document.getElementById('chip-' + mode);
            if (activeBtn) activeBtn.classList.add('active-chip');

            if (isPlaying) {
                loadNextLevel();
            }
        }

        function changeMode() {
            setMode(gameModeSelect.value);
        }

        function changeVoiceLang() {
            voiceLang = voiceLangSelect.value;
            localStorage.setItem('balloon_voice_lang', voiceLang);
            if (isPlaying) {
                speakInstruction();
            }
        }

        function changeBalloonCount() {
            balloonCount = parseInt(balloonCountSelect.value);
            localStorage.setItem('balloon_count', balloonCount);
            updateGridColumns();
            if (isPlaying) {
                loadNextLevel();
            }
        }

        function startGame() {
            startScreen.style.display = 'none';
            balloonGrid.style.display = 'grid';
            isPlaying = true;
            level = 1;
            starsEarned = 0;

            levelDisplay.innerText = level;

            updateGridColumns();
            loadNextLevel();
        }

        function loadNextLevel() {
            if (!isPlaying) return;

            clearTimeout(wiggleTimeout);
            const activeBalloons = document.querySelectorAll('.static-balloon');
            activeBalloons.forEach(b => b.classList.remove('wiggle-hint'));

            targetBadge.style.backgroundColor = 'white';
            targetBadge.style.color = '#8C52FF';
            targetBadge.style.border = '4px solid #FFDE59';

            let options = [];

            if (activeMode === 'letters') {
                instructionLabel.innerText = "Find Balloon:";
                const alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                targetValue = alphabet[Math.floor(Math.random() * alphabet.length)];
                targetColorObj = null;

                targetBadge.innerText = targetValue;

                options = [targetValue];
                while (options.length < balloonCount) {
                    const randomLetter = alphabet[Math.floor(Math.random() * alphabet.length)];
                    if (!options.includes(randomLetter)) {
                        options.push(randomLetter);
                    }
                }
            }
            else if (activeMode === 'hindi') {
                instructionLabel.innerText = "अक्षर ढूँढो:";
                const hindiVarnamala = ['अ', 'आ', 'इ', 'ई', 'उ', 'ऊ', 'ए', 'ऐ', 'ओ', 'औ', 'क', 'ख', 'ग', 'घ', 'च', 'छ', 'ज', 'झ', 'ट', 'ठ', 'ड', 'ढ', 'त', 'थ', 'द', 'ध', 'न', 'प', 'फ', 'ब', 'भ', 'म', 'य', 'र', 'ल', 'व', 'श', 'ष', 'स', 'ह', 'क्ष', 'त्र', 'ज्ञ'];
                targetValue = hindiVarnamala[Math.floor(Math.random() * hindiVarnamala.length)];
                targetColorObj = null;

                targetBadge.innerText = targetValue;

                options = [targetValue];
                while (options.length < balloonCount) {
                    const randomChar = hindiVarnamala[Math.floor(Math.random() * hindiVarnamala.length)];
                    if (!options.includes(randomChar)) {
                        options.push(randomChar);
                    }
                }
            }
            else if (activeMode === 'numbers') {
                instructionLabel.innerText = "Find Balloon:";
                targetValue = String(Math.floor(Math.random() * 20) + 1);
                targetColorObj = null;

                targetBadge.innerText = targetValue;

                options = [targetValue];
                while (options.length < balloonCount) {
                    const randomNumber = String(Math.floor(Math.random() * 20) + 1);
                    if (!options.includes(randomNumber)) {
                        options.push(randomNumber);
                    }
                }
            }
            else if (activeMode === 'colors') {
                instructionLabel.innerText = "Find Color:";

                targetColorObj = colorsData[Math.floor(Math.random() * colorsData.length)];
                targetValue = targetColorObj.name;

                targetBadge.style.backgroundColor = targetColorObj.val;
                targetBadge.style.border = '4px solid #ffffff';
                targetBadge.style.color = '#ffffff';
                targetBadge.innerText = targetColorObj.emoji;

                options = [targetColorObj];
                while (options.length < balloonCount) {
                    const randomColor = colorsData[Math.floor(Math.random() * colorsData.length)];
                    if (!options.some(c => c.name === randomColor.name)) {
                        options.push(randomColor);
                    }
                }
            }

            options.sort(() => Math.random() - 0.5);

            balloonGrid.innerHTML = '';

            const shuffledColors = [...balloonColors].sort(() => Math.random() - 0.5);

            options.forEach((item, idx) => {
                const balloon = document.createElement('div');
                balloon.className = 'static-balloon';

                let labelText = '';
                let valToCheck = '';

                if (activeMode === 'colors') {
                    balloon.style.backgroundColor = item.val;
                    labelText = item.name;
                    valToCheck = item.name;
                } else {
                    balloon.style.backgroundColor = shuffledColors[idx];
                    labelText = item;
                    valToCheck = item;
                }

                balloon.dataset.val = valToCheck;

                const labelSpan = document.createElement('span');
                labelSpan.className = 'balloon-label';
                labelSpan.innerText = labelText;
                balloon.appendChild(labelSpan);

                const string = document.createElement('div');
                string.className = 'static-string';
                balloon.appendChild(string);

                balloon.onclick = (e) => handleChoice(balloon, valToCheck, e.clientX, e.clientY);
                balloon.ontouchstart = (e) => {
                    const touch = e.touches[0];
                    handleChoice(balloon, valToCheck, touch.clientX, touch.clientY);
                    e.preventDefault();
                };

                balloonGrid.appendChild(balloon);
            });

            speakInstruction();
            startWiggleTimer();
        }

        function startWiggleTimer() {
            clearTimeout(wiggleTimeout);
            wiggleTimeout = setTimeout(() => {
                if (!isPlaying) return;

                const balloons = document.querySelectorAll('.static-balloon');
                balloons.forEach(balloon => {
                    if (balloon.dataset.val === targetValue) {
                        balloon.classList.add('wiggle-hint');
                    }
                });

                speakInstruction(true);
            }, 4000);
        }

        function speakInstruction(isReminder = false) {
            if (localStorage.getItem('voice_enabled') === 'false') return;

            let phrase = '';
            if (activeMode === 'letters') {
                phrase = (isReminder ? "Hey! " : "") + "Where is balloon " + targetValue + "? Touch it!";
                if (typeof SoundFX !== 'undefined' && SoundFX.speak) {
                    SoundFX.speak(phrase, 'en-US');
                }
            }
            else if (activeMode === 'hindi') {
                phrase = (isReminder ? "अरे! " : "") + "गुब्बारा " + targetValue + " कहाँ है? उसे छुओ!";
                if (typeof SoundFX !== 'undefined' && SoundFX.speak) {
                    SoundFX.speak(phrase, 'hi-IN');
                }
            }
            else if (activeMode === 'numbers') {
                phrase = (isReminder ? "Come on! " : "") + "Find number " + targetValue + " balloon!";
                if (typeof SoundFX !== 'undefined' && SoundFX.speak) {
                    SoundFX.speak(phrase, 'en-US');
                }
            }
            else if (activeMode === 'colors') {
                const colorName = targetColorObj.name;
                phrase = (isReminder ? "Look! " : "") + "Touch the " + colorName + " balloon!";
                if (typeof SoundFX !== 'undefined' && SoundFX.speak) {
                    SoundFX.speak(phrase, 'en-US');
                }
            }
        }

        function createPopParticles(x, y, color) {
            const particleCount = 14;
            const emojis = ['✨', '🎉', '🥳', '🌟', '🌈', '❤️', '🧁', '🍦'];

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'pop-particle';

                const isEmoji = Math.random() > 0.4;
                if (isEmoji) {
                    particle.innerText = emojis[Math.floor(Math.random() * emojis.length)];
                    particle.style.fontSize = (Math.random() * 1.5 + 1.2) + 'rem';
                } else {
                    particle.style.backgroundColor = color || '#FF5252';
                    particle.style.width = (Math.random() * 14 + 8) + 'px';
                    particle.style.height = particle.style.width;
                    particle.style.borderRadius = '50%';
                    particle.style.boxShadow = '0 2px 6px rgba(0,0,0,0.15)';
                }

                particle.style.position = 'absolute';
                particle.style.left = x + 'px';
                particle.style.top = y + 'px';
                particle.style.pointerEvents = 'none';
                particle.style.zIndex = '999';

                const angle = Math.random() * Math.PI * 2;
                const distance = Math.random() * 160 + 80;
                const tx = Math.cos(angle) * distance;
                const ty = Math.sin(angle) * distance - 40;

                particle.style.setProperty('--tx', tx + 'px');
                particle.style.setProperty('--ty', ty + 'px');
                particle.style.animation = 'particleAnimation 0.8s cubic-bezier(0.1, 0.8, 0.3, 1) forwards';

                gameArea.appendChild(particle);

                setTimeout(() => {
                    particle.remove();
                }, 800);
            }
        }

        function handleChoice(balloonElement, valueSelected, clickX, clickY) {
            if (!isPlaying) return;
            if (balloonElement.classList.contains('wrong-shake') || balloonElement.style.opacity === '0') return;

            clearTimeout(wiggleTimeout);

            if (valueSelected === targetValue) {
                if (typeof SoundFX !== 'undefined' && SoundFX.play) {
                    SoundFX.play('pop');
                }

                const rect = balloonElement.getBoundingClientRect();
                const areaRect = gameArea.getBoundingClientRect();
                const posX = (clickX || rect.left + rect.width / 2) - areaRect.left;
                const posY = (clickY || rect.top + rect.height / 2) - areaRect.top;

                createPopParticles(posX, posY, balloonElement.style.backgroundColor);

                if (localStorage.getItem('voice_enabled') !== 'false') {
                    const successPhrasesEn = ["Awesome!", "Great job!", "Super!", "Yay! You did it!", "Fantastic!"];
                    const successPhrasesHi = ["बहुत अच्छे!", "अरे वाह!", "शाबाश!", "कमाल कर दिया!", "बिल्कुल सही!"];
                    const list = voiceLang === 'hi' ? successPhrasesHi : successPhrasesEn;
                    const phrase = list[Math.floor(Math.random() * list.length)];
                    if (typeof SoundFX !== 'undefined' && SoundFX.speak) {
                        SoundFX.speak(phrase, voiceLang === 'hi' ? 'hi-IN' : 'en-US');
                    }
                }

                balloonElement.style.transform = 'scale(1.35)';
                balloonElement.style.opacity = '0';

                level++;
                starsEarned += 5;
                levelDisplay.innerText = level;

                fetch("{{ route('api.add_stars') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        stars: 5,
                        activity_name: 'Cleared Balloon level ' + (level - 1)
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

                setTimeout(() => {
                    triggerToyGift();
                }, 600);

            } else {
                balloonElement.classList.add('wrong-shake');
                if (typeof SoundFX !== 'undefined' && SoundFX.play) {
                    SoundFX.play('click');
                }

                if (localStorage.getItem('voice_enabled') !== 'false') {
                    const wrongPhrasesEn = ["Wrong! Try again.", "Wrong balloon! Try another one.", "Oops, wrong! Try again."];
                    const wrongPhrasesHi = ["गलत! फिर से कोशिश करो।", "यह गलत है! दूसरा गुब्बारा छुओ।", "गलत गुब्बारा! फिर से कोशिश करो।"];
                    const list = voiceLang === 'hi' ? wrongPhrasesHi : wrongPhrasesEn;
                    const phrase = list[Math.floor(Math.random() * list.length)];
                    if (typeof SoundFX !== 'undefined' && SoundFX.speak) {
                        SoundFX.speak(phrase, voiceLang === 'hi' ? 'hi-IN' : 'en-US');
                    }
                }

                setTimeout(() => {
                    balloonElement.classList.remove('wrong-shake');
                    startWiggleTimer();
                }, 500);
            }
        }

        const toysList = [
            { name: "Teddy Bear!", hindiName: "प्यारा भालू!", emoji: "🧸" },
            { name: "Super Race Car!", hindiName: "रेसिंग कार!", emoji: "🏎️" },
            { name: "Space Rocket!", hindiName: "रॉकेट!", emoji: "🚀" },
            { name: "Superhero Robot!", hindiName: "सुपर रोबोट!", emoji: "🤖" },
            { name: "Magic Unicorn!", hindiName: "यूनिकॉर्न!", emoji: "🦄" },
            { name: "Express Toy Train!", hindiName: "टॉय ट्रेन!", emoji: "🚂" },
            { name: "Cute Dinosaur!", hindiName: "डायनासोर!", emoji: "🦕" },
            { name: "Color Palette!", hindiName: "कलर पैलेट!", emoji: "🎨" },
            { name: "Royal Crown!", hindiName: "शाही ताज!", emoji: "👑" },
            { name: "Yummy Ice Cream!", hindiName: "आइसक्रीम!", emoji: "🍦" },
            { name: "Flying Helicopter!", hindiName: "हेलीकॉप्टर!", emoji: "🚁" },
            { name: "Musical Drum!", hindiName: "म्यूजिकल ड्रम!", emoji: "🥁" }
        ];

        let selectedToy = null;

        function triggerToyGift() {
            const giftModal = document.getElementById('toyGiftModal');
            const giftClosed = document.getElementById('giftClosedState');
            const giftOpened = document.getElementById('giftOpenedState');

            if (!giftModal) return;

            giftClosed.style.display = 'flex';
            giftOpened.style.display = 'none';
            giftModal.style.display = 'flex';

            if (typeof SoundFX !== 'undefined' && SoundFX.play) {
                SoundFX.play('success');
            }

            if (localStorage.getItem('voice_enabled') !== 'false') {
                const phrase = voiceLang === 'hi' ? "शाबाश! आपने एक गिफ्ट जीता है! गिफ्ट पर टैप करो!" : "Awesome! You won a gift! Tap the gift box to open!";
                if (typeof SoundFX !== 'undefined' && SoundFX.speak) {
                    SoundFX.speak(phrase, voiceLang === 'hi' ? 'hi-IN' : 'en-US');
                }
            }
        }

        function openToyGift() {
            const giftClosed = document.getElementById('giftClosedState');
            const giftOpened = document.getElementById('giftOpenedState');
            const toyEmojiBadge = document.getElementById('toyEmojiBadge');
            const toyNameTitle = document.getElementById('toyNameTitle');

            selectedToy = toysList[Math.floor(Math.random() * toysList.length)];

            toyEmojiBadge.innerText = selectedToy.emoji;
            toyNameTitle.innerText = voiceLang === 'hi' ? selectedToy.hindiName : selectedToy.name;

            giftClosed.style.display = 'none';
            giftOpened.style.display = 'flex';

            if (typeof confetti === 'function') {
                confetti({
                    particleCount: 140,
                    spread: 90,
                    origin: { y: 0.55 }
                });
            }

            if (typeof SoundFX !== 'undefined' && SoundFX.play) {
                SoundFX.play('cheer');
            }

            if (localStorage.getItem('voice_enabled') !== 'false') {
                const phrase = voiceLang === 'hi'
                    ? "अरे वाह! आपको मिला " + selectedToy.hindiName + " और 10 बोनस स्टार्स!"
                    : "Yay! You got a " + selectedToy.name + " and 10 bonus stars!";
                if (typeof SoundFX !== 'undefined' && SoundFX.speak) {
                    SoundFX.speak(phrase, voiceLang === 'hi' ? 'hi-IN' : 'en-US');
                }
            }

            fetch("{{ route('api.add_stars') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    stars: 10,
                    activity_name: 'Unlocked Toy Gift: ' + selectedToy.name
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    const starsPill = document.querySelector('.stars-pill span');
                    if (starsPill) starsPill.innerText = data.new_stars;
                }
            });
        }

        function claimToyAndContinue() {
            const giftModal = document.getElementById('toyGiftModal');
            if (giftModal) giftModal.style.display = 'none';
            loadNextLevel();
        }

        window.addEventListener('beforeunload', () => {
            isPlaying = false;
            clearTimeout(wiggleTimeout);
        });
    </script>
@endsection