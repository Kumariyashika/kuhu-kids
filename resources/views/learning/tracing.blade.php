@extends('layouts.app')

@section('title', 'Kuhu Kids Learning - Alphabet Writing')

@section('content')
    <!-- Include Canvas Confetti -->
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

    <!-- Category Choice Screen: Winding Garden Path -->
    <div id="categorySelectionScreen" class="garden-path-screen" style="display: none;">
        <!-- Clouds -->
        <div class="garden-cloud" style="top: 12%; left: 8%; animation-duration: 25s;"></div>
        <div class="garden-cloud" style="top: 22%; right: 10%; animation-duration: 35s; transform: scale(0.85); opacity: 0.8;"></div>
        
        <!-- Wooden Signboard -->
        <div class="garden-wooden-sign">
            <div style="font-size: 2.5rem; font-weight: 900; text-shadow: 2px 2px 0px #3E1E03, 4px 4px 0px rgba(0,0,0,0.15); display: flex; align-items: center; justify-content: center; gap: 8px;">
                <span>Let's Write!</span> ✍️
            </div>
            <div style="font-size: 1.4rem; font-weight: bold; color: #FFEB3B; margin-top: 4px; text-shadow: 1px 1px 0px #000;">
                चलो लिखना सीखें! ✏️
            </div>
        </div>

        <!-- Back to Dashboard / Home Button -->
        <a href="{{ route('dashboard') }}" class="btn-3d btn-yellow" style="position: absolute; top: 20px; left: 20px; z-index: 10; display: flex; align-items: center; justify-content: center; border-radius: 50%; width: 48px; height: 48px; padding: 0; text-decoration: none; margin: 0;" title="Back to Home">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
        </a>

        <!-- Path Container -->
        <div class="path-container">
            <!-- Winding Road SVG -->
            <svg viewBox="0 0 500 800" preserveAspectRatio="none" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; z-index: 1;">
                <!-- Broad ground base -->
                <path d="M 250,720 Q 80,520 250,380 T 250,120" fill="none" stroke="#E8F5E9" stroke-width="76" stroke-linecap="round" style="opacity: 0.25;"/>
                <!-- Dirt Road -->
                <path d="M 250,720 Q 80,520 250,380 T 250,120" fill="none" stroke="#8D6E63" stroke-width="56" stroke-linecap="round"/>
                <path d="M 250,720 Q 80,520 250,380 T 250,120" fill="none" stroke="#A1887F" stroke-width="48" stroke-linecap="round"/>
                <!-- Dashed Center Line -->
                <path d="M 250,720 Q 80,520 250,380 T 250,120" fill="none" stroke="#FFF" stroke-width="4" stroke-dasharray="12,14" stroke-linecap="round"/>
            </svg>

            <!-- Swaying Flowers along the path -->
            <div class="garden-decor-flower" style="bottom: 22%; left: 8%; font-size: 2.2rem; position: absolute;">🌸</div>
            <div class="garden-decor-flower" style="bottom: 58%; right: 8%; font-size: 2.2rem; position: absolute;">🌻</div>
            <div class="garden-decor-flower" style="bottom: 12%; right: 18%; font-size: 2.2rem; position: absolute;">🌷</div>
            <div class="garden-decor-flower" style="bottom: 78%; left: 16%; font-size: 2.2rem; position: absolute;">🌼</div>
            <div class="garden-decor-flower" style="bottom: 40%; right: 20%; font-size: 2.2rem; position: absolute;">🌹</div>

            <!-- Path Buttons (Zig Zag) -->
            <!-- Step 1: English A to Z -->
            <button onclick="selectCategoryFromPath('english')" class="garden-path-btn garden-path-btn-pink" style="bottom: 8%; left: 50%; transform: translateX(-50%);">
                <span style="font-size: 2.2rem; font-weight: 900; margin-bottom: 2px;">A B C</span>
                <span style="font-size: 1.2rem; font-weight: 800;">A to Z</span>
            </button>

            <!-- Step 2: Numbers 1 to 50 -->
            <button onclick="selectCategoryFromPath('numbers')" class="garden-path-btn garden-path-btn-yellow" style="bottom: 40%; left: 14%;">
                <span style="font-size: 2.2rem; font-weight: 900; margin-bottom: 2px;">1 2 3</span>
                <span style="font-size: 1.2rem; font-weight: 800;">1 to 50</span>
            </button>

            <!-- Step 3: Hindi क से ज्ञ -->
            <button onclick="selectCategoryFromPath('hindi')" class="garden-path-btn garden-path-btn-purple" style="bottom: 68%; right: 14%;">
                <span style="font-size: 2.1rem; font-weight: 900; margin-bottom: 2px;">क ख ग</span>
                <span style="font-size: 1.2rem; font-weight: 800;">क से ज्ञ</span>
            </button>
        </div>

        <!-- Layered Rolling Hills at the Bottom -->
        <div style="position: absolute; bottom: 0; left: 0; width: 100%; height: 260px; overflow: hidden; pointer-events: none; z-index: 2;">
            <svg viewBox="0 0 1000 200" preserveAspectRatio="none" style="width: 100%; height: 100%; position: absolute; bottom: 0; left: 0;">
                <path d="M 0,140 Q 250,80 500,140 T 1000,110 L 1000,200 L 0,200 Z" fill="#81C784" opacity="0.8"/>
                <path d="M 0,165 Q 350,100 700,155 T 1000,135 L 1000,200 L 0,200 Z" fill="#66BB6A"/>
            </svg>
        </div>

        <!-- Mascot Decors inside Category Choice screen -->
        <img src="{{ asset('images/backgrounds/3d_giraffe.png') }}" style="position: absolute; bottom: 80px; left: 3%; width: 120px; z-index: 3; transform: scaleX(-1); pointer-events: none;" alt="Giraffe Decor">
        <img src="{{ asset('images/backgrounds/3d_elephant.png') }}" style="position: absolute; bottom: 65px; right: 3%; width: 140px; z-index: 3; pointer-events: none;" alt="Elephant Decor">
    </div>



    <style>
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes bounce {
            from {
                transform: translateY(0);
            }

            to {
                transform: translateY(-15px);
            }
        }

        .inner-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            margin-bottom: 20px;
            gap: 16px;
            flex-wrap: wrap;
        }

        .canvas-area {
            position: relative;
            background: radial-gradient(circle, #FAFFFA 0%, #E8F5E9 100%);
            border-radius: 24px;
            border: 4px solid #2E7D32;
            box-shadow: 0 10px 0 rgba(46, 125, 50, 0.35);
            overflow: hidden;
            width: 600px;
            height: 600px;
            max-width: 100%;
        }

        @media (max-width: 768px) {
            .canvas-area {
                width: 100%;
                max-width: 460px;
                height: 460px;
            }
        }

        .canvas-bg-letter {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 20rem;
            font-weight: 900;
            color: rgba(140, 82, 255, 0.08);
            user-select: none;
            pointer-events: none;
        }

        #virtualCursor {
            pointer-events: none;
            display: none;
            z-index: 100;
            font-size: 2.5rem;
            line-height: 1;
            filter: drop-shadow(2px 2px 2px rgba(0, 0, 0, 0.3));
        }

        #tracingHelperHand {
            position: absolute;
            pointer-events: none;
            z-index: 10;
            display: none;
            transform: translate(-50%, -50%);
            transition: opacity 0.3s ease;
        }

        .pulse-ring {
            position: absolute;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 3px solid var(--color-yellow);
            background: rgba(255, 222, 89, 0.35);
            animation: pulseHelper 1.2s infinite;
            transform: translate(-7px, -7px);
        }

        @keyframes pulseHelper {
            0% {
                transform: scale(0.8);
                opacity: 0.5;
            }

            50% {
                transform: scale(1.2);
                opacity: 1;
            }

            100% {
                transform: scale(0.8);
                opacity: 0.5;
            }
        }

        /* Shooter Game Styles */
        .shooter-target-container {
            display: flex;
            gap: 15px;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            width: 100%;
            max-width: 580px;
            margin-top: 15px;
            margin-bottom: 25px;
            z-index: 10;
        }

        .shooter-target {
            position: relative;
            width: 75px;
            height: 75px;
            border-radius: 50%;
            background: radial-gradient(circle, #FFFDF0 0%, #ECEFF1 40%, #FFFDF0 70%, #ECEFF1 100%);
            border: 4px solid #8B5A2B;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
            color: #4E342E;
            font-weight: 900;
            cursor: pointer;
            box-shadow: 0 6px 0 #5C3A1A, 0 10px 20px rgba(0, 0, 0, 0.15);
            transition: all 0.2s ease;
            user-select: none;
        }

        .shooter-target::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 50px;
            height: 50px;
            border: 2px dashed rgba(139, 90, 43, 0.35);
            border-radius: 50%;
            transform: translate(-50%, -50%);
        }

        .shooter-target:hover {
            transform: translateY(-4px) scale(1.05);
            box-shadow: 0 10px 0 #5C3A1A, 0 12px 25px rgba(0, 0, 0, 0.2);
        }

        .shooter-target:active {
            transform: translateY(2px);
            box-shadow: 0 4px 0 #5C3A1A, 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .shooter-bullet {
            position: absolute;
            width: 18px;
            height: 18px;
            background: radial-gradient(circle, #FFEE58 0%, #F57F17 100%);
            border: 2px solid #FFF;
            border-radius: 50%;
            box-shadow: 0 0 10px #F57F17, 0 0 20px #FFEB3B;
            display: none;
            z-index: 25;
            pointer-events: none;
        }

        @keyframes shakeWrong {

            0%,
            100% {
                transform: translateX(0);
            }

            20%,
            60% {
                transform: translateX(-8px);
            }

            40%,
            80% {
                transform: translateX(8px);
            }
        }

        .wrong-shake {
            animation: shakeWrong 0.4s ease-in-out !important;
        }

        /* Entertainment Clip Styles */
        .stage-curtain {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, #FFEBF0 0%, #FFD6E0 100%);
            border-radius: 20px;
            display: none;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 55;
            text-align: center;
            overflow: hidden;
            font-family: 'Fredoka', sans-serif;
        }

        .dancing-animal-1 {
            width: 130px;
            height: auto;
            animation: animalDance1 1.2s ease-in-out infinite alternate;
            filter: drop-shadow(0 8px 12px rgba(0, 0, 0, 0.15));
        }

        .dancing-animal-2 {
            width: 130px;
            height: auto;
            animation: animalDance2 1.4s ease-in-out infinite alternate;
            filter: drop-shadow(0 8px 12px rgba(0, 0, 0, 0.15));
        }

        @keyframes animalDance1 {
            0% {
                transform: translateY(0) scale(1) rotate(-8deg);
            }

            100% {
                transform: translateY(-25px) scale(1.1) rotate(8deg);
            }
        }

        @keyframes animalDance2 {
            0% {
                transform: translateY(0) scale(1) rotate(8deg);
            }

            100% {
                transform: translateY(-20px) scale(1.08) rotate(-8deg);
            }
        }

        .disco-star {
            position: absolute;
            font-size: 2.2rem;
            animation: flashStar 1s ease-in-out infinite alternate;
            pointer-events: none;
        }

        @keyframes flashStar {
            0% {
                opacity: 0.2;
                transform: scale(0.8);
            }

            100% {
                opacity: 1;
                transform: scale(1.2);
            }
        }

        /* Garden Theme Fullscreen Path Screen */
        .garden-path-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: linear-gradient(to bottom, #A1E3FF 0%, #D4F4FA 40%, #A2E8B9 70%, #66BB6A 100%);
            z-index: 9998;
            overflow-y: auto;
            font-family: 'Fredoka', sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        .path-container {
            position: relative;
            width: 100%;
            max-width: 500px;
            height: 780px;
            margin: 30px auto;
            z-index: 4;
            flex-shrink: 0;
        }

        /* Wooden Signboard styling */
        .garden-wooden-sign {
            background: linear-gradient(135deg, #A76D36 0%, #8D501D 100%);
            border: 6px solid #5C330E;
            border-radius: 20px;
            padding: 15px 40px;
            box-shadow: 0 10px 0 #3E1E03, 0 15px 25px rgba(0, 0, 0, 0.25);
            color: #FFF;
            text-align: center;
            z-index: 5;
            margin-top: 10px;
            position: relative;
            animation: swingSign 4s ease-in-out infinite alternate;
            transform-origin: top center;
        }

        @keyframes swingSign {
            0% { transform: rotate(-2deg); }
            100% { transform: rotate(2deg); }
        }

        /* Winding Path Step Buttons */
        .garden-path-btn {
            position: absolute;
            width: 135px;
            height: 135px;
            border-radius: 50%;
            border: 8px solid #FFF;
            font-family: 'Fredoka', sans-serif;
            font-size: 1.3rem;
            font-weight: 900;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 4px;
            box-shadow: 0 12px 0 rgba(0,0,0,0.15), 0 15px 22px rgba(0,0,0,0.2), inset 0 -6px 0 rgba(0,0,0,0.2);
            transition: all 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            z-index: 5;
        }

        .garden-path-btn:hover {
            transform: translateY(-8px) scale(1.08);
            box-shadow: 0 20px 0 rgba(0,0,0,0.1), 0 22px 30px rgba(0,0,0,0.25), inset 0 -6px 0 rgba(0,0,0,0.2);
        }

        .garden-path-btn:active {
            transform: translateY(4px) scale(0.96);
            box-shadow: 0 4px 0 rgba(0,0,0,0.15), inset 0 -6px 0 rgba(0,0,0,0.2);
        }

        .garden-path-btn-pink {
            background: linear-gradient(135deg, #FF66B2 0%, #FF3399 100%);
            border-color: #FFF;
        }

        .garden-path-btn-yellow {
            background: linear-gradient(135deg, #FFDE59 0%, #FFBD59 100%);
            border-color: #FFF;
            color: #4A3B00;
        }

        .garden-path-btn-purple {
            background: linear-gradient(135deg, #8C52FF 0%, #5E17EB 100%);
            border-color: #FFF;
            color: #FFF;
        }

        /* Letter Bubble Selection buttons */
        .letter-bubble-btn {
            width: 75px;
            height: 75px;
            border-radius: 50%;
            border: 4px solid #FFF !important;
            font-size: 2.1rem;
            font-weight: 900;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
            user-select: none;
            box-shadow: 0 6px 0 rgba(0,0,0,0.15), inset 0 -4px 0 rgba(0,0,0,0.2) !important;
            text-shadow: 2px 2px 0px rgba(0,0,0,0.2);
        }

        .letter-bubble-btn:hover {
            transform: translateY(-8px) scale(1.18) rotate(4deg) !important;
            box-shadow: 0 14px 0 rgba(0,0,0,0.1), inset 0 -4px 0 rgba(0,0,0,0.2) !important;
        }

        .letter-bubble-btn:active {
            transform: translateY(3px) scale(0.94) !important;
            box-shadow: 0 3px 0 rgba(0,0,0,0.15) !important;
        }

        .garden-decor-flower {
            animation: sway 2.5s ease-in-out infinite alternate;
            transform-origin: bottom center;
            pointer-events: none;
            z-index: 3;
        }

        @keyframes sway {
            0% { transform: rotate(-5deg); }
            100% { transform: rotate(5deg); }
        }

        .garden-cloud {
            position: absolute;
            width: 120px;
            height: 40px;
            background: white;
            border-radius: 20px;
            opacity: 0.85;
            z-index: 1;
            animation: floatCloud 25s linear infinite alternate;
        }

        .garden-cloud::before, .garden-cloud::after {
            content: '';
            position: absolute;
            background: white;
            border-radius: 50%;
        }

        .garden-cloud::before {
            width: 50px;
            height: 50px;
            top: -25px;
            left: 20px;
        }

        .garden-cloud::after {
            width: 70px;
            height: 70px;
            top: -35px;
            right: 20px;
        }

        @keyframes floatCloud {
            0% { transform: translateX(0); }
            100% { transform: translateX(50px); }
        }
    </style>

    <!-- Tracing Board Canvas Screen -->
    <div id="tracingBoardScreen" style="display: none; width: 100%;">
        <div class="inner-container">
            <div class="inner-header">
                <!-- Left Side: Back Button & Title -->
                <div style="display: flex; align-items: center; gap: 16px;">
                    <button onclick="goBackToCategoryScreen()" class="btn-3d btn-yellow"
                        style="padding: 8px 10px; font-size: 1.3rem; display: flex; align-items: center; justify-content: center; border-radius: 50%; width: 42px; height: 42px; border: none; cursor: pointer; margin: 0; min-width: 42px; outline: none;">⬅️</button>
                    <h1 class="inner-title" style="margin: 0; display: flex; align-items: center; gap: 10px;">
                        <span style="color: var(--color-purple);">✍️ Let's Write!</span>
                    </h1>
                </div>

                <!-- Right Side: Level Indicator -->
                <div style="display: flex; align-items: center;">
                    <div
                        style="background: #FFFDF0; border: 3px solid var(--color-purple); border-radius: 20px; padding: 8px 16px; font-weight: bold; color: var(--color-purple); display: flex; align-items: center; gap: 8px; box-shadow: 0 4px 0 var(--color-purple-shadow); font-size: 1.1rem; margin: 0;">
                        🏆 Level <span id="levelDisplay">{{ $activeChild ? $activeChild->level : 1 }}</span>
                    </div>
                </div>
        </div>

        <!-- Category Tabs -->
        <div class="category-tabs" style="display: none;">
            <button onclick="setCategory('english')" id="tab-english" class="btn-3d btn-pink category-tab-btn">
                🔤 English (A-Z)
            </button>
            <button onclick="setCategory('numbers')" id="tab-numbers" class="btn-3d btn-yellow category-tab-btn">
                🔢 Numbers (1-50)
            </button>
            <button onclick="setCategory('hindi')" id="tab-hindi" class="btn-3d btn-yellow category-tab-btn">
                🕉️ Hindi (क-ज्ञ)
            </button>
        </div>

        <div class="tracing-board-wrapper">
            <!-- Instruction Banner (Hidden) -->
            <div id="instructionBanner" style="display: none;"></div>

            <!-- Canvas Area -->
            <div class="canvas-area">
                <canvas id="tracingCanvas"
                    style="display: block; width: 100%; height: 100%; z-index: 2; position: relative;"></canvas>

                <!-- Tracing Helper Hand (Guiding Indicator) -->
                <div id="tracingHelperHand">
                    <div class="pulse-ring"></div>
                    <span
                        style="font-size: 2.8rem; filter: drop-shadow(2px 2px 3px rgba(0,0,0,0.35)); position: relative; top: -5px; left: -5px;">☝️</span>
                </div>

                <!-- Target dot pointer cursor (renders when hand tracking is active) -->
                <div id="virtualCursor">
                    ☝️
                </div>

                <!-- Path Deviation Warning Message -->
                <div id="pathWarning"
                    style="position: absolute; top: 20px; left: 50%; transform: translateX(-50%); background: rgba(255, 82, 82, 0.95); color: white; padding: 10px 24px; border-radius: 20px; font-weight: bold; font-size: 1.25rem; border: 3px solid #FFF; box-shadow: 0 6px 12px rgba(0,0,0,0.15); opacity: 0; pointer-events: none; transition: opacity 0.3s ease; z-index: 80; white-space: nowrap; font-family: 'Fredoka', sans-serif;">
                    ⚠️ Stay on the line! ✏️
                </div>

                <!-- Celebration Screen Overlay -->
                <div id="successOverlay"
                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255, 255, 255, 0.9); border-radius: 20px; display: flex; flex-direction: column; align-items: center; justify-content: center; opacity: 0; pointer-events: none; transition: opacity 0.5s ease; z-index: 50; text-align: center; padding: 20px;">
                    <div style="font-size: 5rem; animation: bounce 0.8s infinite alternate;">🏆</div>
                    <h2
                        style="font-size: 2.2rem; color: var(--color-green-real); text-shadow: 2px 2px 0px #FFF, 4px 4px 0px var(--color-green-real-shadow); font-weight: 900; margin: 15px 0;">
                        LEVEL UP!</h2>
                    <p id="successText" style="font-size: 1.3rem; font-weight: bold; color: var(--color-text);">Fantastic
                        Writing! You reached Level 2!</p>
                    <div style="margin-top: 20px; display: flex; gap: 10px;">
                        <div
                            style="background: var(--color-yellow); border: 3px solid var(--color-yellow-shadow); padding: 8px 16px; border-radius: 16px; font-weight: bold; font-size: 1.1rem; color: #4A3B00;">
                            ⭐ +20 Stars
                        </div>
                    </div>
                </div>

                <!-- Fail Screen Overlay -->
                <div id="failOverlay"
                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255, 235, 235, 0.95); border-radius: 20px; display: flex; flex-direction: column; align-items: center; justify-content: center; opacity: 0; pointer-events: none; transition: opacity 0.4s ease; z-index: 50; text-align: center; padding: 20px;">
                    <div style="font-size: 4.5rem; transform: rotate(-10deg);">😢</div>
                    <h2
                        style="font-size: 2rem; color: var(--color-pink); text-shadow: 2px 2px 0px #FFF, 4px 4px 0px var(--color-pink-shadow); font-weight: 900; margin: 15px 0;">
                        Try Again!</h2>
                    <p style="font-size: 1.2rem; font-weight: bold; color: var(--color-text); max-width: 80%;">Oh, you
                        missed some dots! Connect all of them to level up!</p>
                    <button onclick="hideFailOverlay()" class="btn-3d btn-pink"
                        style="margin-top: 15px; font-size: 1.1rem; padding: 8px 20px;">
                        🔄 Try Again
                    </button>
                </div>

                <!-- Entertainment Clip Screen Overlay -->
                <div id="entertainmentClipOverlay" class="stage-curtain">
                    <!-- Smiling rotating sun in background -->
                    <img src="{{ asset('images/backgrounds/3d_rainbow.png') }}"
                        style="position: absolute; top: -10%; opacity: 0.35; width: 120%; height: auto; pointer-events: none;"
                        alt="Rainbow Backstage">

                    <h2
                        style="font-size: 2.3rem; color: var(--color-purple); text-shadow: 2px 2px 0px #FFF, 4px 4px 0px var(--color-purple-shadow); font-weight: 900; margin: 10px 0; z-index: 2;">
                        🎉 Dancing Party! You Did It! 🏆
                    </h2>
                    <p style="font-size: 1.25rem; font-weight: bold; color: #4A3B00; margin-bottom: 25px; z-index: 2;">
                        Fantastic tracing! Enjoy the animal dance! 🐘🦁
                    </p>

                    <!-- Dancing Characters -->
                    <div
                        style="display: flex; gap: 40px; align-items: flex-end; justify-content: center; margin-bottom: 30px; height: 180px; z-index: 2; position: relative;">
                        <!-- Elephant -->
                        <img src="{{ asset('images/backgrounds/3d_elephant.png') }}" class="dancing-animal-1"
                            alt="Dancing Elephant">
                        <!-- Lion -->
                        <img src="{{ asset('images/backgrounds/3d_lion.png') }}" class="dancing-animal-2"
                            alt="Dancing Lion">
                    </div>

                    <!-- Disco Flashing Stars -->
                    <span class="disco-star" style="top: 15%; left: 12%; animation-delay: 0s; color: #FFDE59;">⭐</span>
                    <span class="disco-star" style="top: 25%; right: 15%; animation-delay: 0.3s; color: #FF66C4;">✨</span>
                    <span class="disco-star"
                        style="bottom: 20%; left: 15%; animation-delay: 0.5s; color: #38B6FF;">🌟</span>
                    <span class="disco-star"
                        style="bottom: 28%; right: 12%; animation-delay: 0.8s; color: #7ED957;">⭐</span>

                    <!-- Skip Clip Button -->
                    <button onclick="skipEntertainmentClip()" class="btn-3d btn-pink"
                        style="font-size: 1.15rem; padding: 10px 28px; z-index: 2; display: inline-flex; align-items: center; gap: 6px;">
                        Skip to Game ➡️
                    </button>
                </div>

                <!-- Target Shooter Mini Game Overlay -->
                <div id="miniGameOverlay"
                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: radial-gradient(circle, #E8F5E9 0%, #C8E6C9 100%); border-radius: 20px; display: none; flex-direction: column; align-items: center; justify-content: center; z-index: 60; text-align: center; padding: 20px; font-family: 'Fredoka', sans-serif; overflow: hidden;">

                    <!-- Fired Projectile Bullet -->
                    <div id="shooterBullet" class="shooter-bullet"></div>

                    <h2 id="miniGameTitle"
                        style="font-size: 2.2rem; color: #2E7D32; text-shadow: 2px 2px 0px #FFF, 4px 4px 0px rgba(46,125,50,0.35); font-weight: 900; margin: 0 0 10px 0;">
                        🎯 Target Shooter Challenge! 🎯</h2>
                    <p id="miniGameSubtitle"
                        style="font-size: 1.3rem; font-weight: bold; color: #1B5E20; margin-bottom: 20px;">
                        Shoot the target board with letter <span id="miniGameTargetLetter"
                            style="font-size: 2.2rem; color: #C62828; font-weight: 900; background: #FFF; padding: 2px 14px; border-radius: 12px; border: 2.5px solid #2E7D32; margin-left: 5px;">A</span>
                        to unlock the next letter!
                    </p>

                    <!-- Hanging Targets Container -->
                    <div id="miniGameBalloonGrid" class="shooter-target-container">
                        <!-- Target Boards populated by JS -->
                    </div>

                    <!-- Shooter Boy and Blaster Gun Mascot -->
                    <div id="shooterBoy"
                        style="position: absolute; bottom: 15px; left: 25px; font-size: 4.8rem; z-index: 15; transition: transform 0.25s ease; user-select: none; pointer-events: none;">
                        👦<span id="shooterBlaster"
                            style="position: absolute; right: -25px; bottom: 8px; font-size: 3.5rem; transform: rotate(-25deg); display: inline-block; transform-origin: 20% 70%; transition: transform 0.25s ease;">🔫</span>
                    </div>

                    <!-- Skip Button & Feedback Message -->
                    <div
                        style="display: flex; flex-direction: column; align-items: center; gap: 10px; width: 100%; margin-left: 120px; z-index: 10;">
                        <div id="miniGameFeedback"
                            style="font-size: 1.3rem; font-weight: 800; min-height: 35px; transition: all 0.2s ease;"></div>
                        <button onclick="skipMiniGame()" class="btn-3d btn-yellow"
                            style="font-size: 1.15rem; padding: 10px 30px; display: inline-flex; align-items: center; gap: 8px;">
                            <span>Skip Game ➡️</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Tracing Controls -->
            <div class="canvas-controls">
                <button onclick="submitTracing()" class="btn-3d"
                    style="width: 100%; font-size: 1.5rem; background: var(--color-green-real); color: white; border-bottom: 6px solid var(--color-green-real-shadow); display: flex; align-items: center; justify-content: center; gap: 10px; padding: 16px 24px;">
                    <span>Next</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </button>
            </div>
        </div>
    </div>
    </div> <!-- End of tracingBoardScreen -->

    <script>
                    const categorySequences = {
                        english: ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'],
                        numbers: Array.from({length                : 100}, (_,         i) => (i + 1).toString()),
                        hindi: ['क'        , 'ख', 'ग', 'घ', 'ङ', 'च', 'छ', 'ज', 'झ', 'ञ', 'ट', 'ठ', 'ड', 'ढ', 'ण', 'त', 'थ', 'द', 'ध', 'न', 'प', 'फ', 'ब', 'भ', 'म', 'य', 'र', 'ल', 'व', 'श', 'ष', 'स', 'ह', 'क्ष', 'त्र', 'ज्ञ']
                    };

                    const hindiPhonics = {
                        'क': 'Ka', 'ख': 'Kha', 'ग': 'Ga', 'घ': 'Gha', 'ङ': 'Nga',
                        'च': 'Cha', 'छ': 'Chha', 'ज': 'Ja', 'झ': 'Jha', 'ञ': 'Nya',
                        'ट': 'Ta', 'ठ': 'Tha', 'ड': 'Da', 'ढ': 'Dha', 'ण': 'Na',
                        'त': 'Ta', 'थ': 'Tha', 'द': 'Da', 'ध': 'Dha', 'न': 'Na',
                        'प': 'Pa', 'फ': 'Pha', 'ब': 'Ba', 'भ': 'Bha', 'म': 'Ma',
                        'य': 'Ya', 'र': 'Ra', 'ल': 'La', 'व': 'Va',
                        'श': 'Sha', 'ष': 'Sha', 'स': 'Sa', 'ह': 'Ha',
                        'क्ष': 'Ksha', 'त्र': 'Tra', 'ज्ञ': 'Gya'
                    };

                    let currentSessionLevel = {{ $activeChild ? $activeChild->level : 1 }};

                    // Category state management (always start with English)
                    let currentCategory = 'english';
                    let currentCategoryList = categorySequences[currentCategory];

                    // Always start from index 0 on page load
                    let currentLetterIdx = 0;
                    let currentLetter = currentCategoryList[currentLetterIdx];

                    const canvas = document.getElementById('tracingCanvas');
                    const ctx = canvas.getContext('2d');

                    let isDrawing = false;
                    let lastX = 0;
                    let lastY = 0;

                    // Interactive Dots Database
                    let targetDots = [];
                    let nextDotIndex = 0;
                    let drawingStrokes = [];
                    let currentStroke = null;
                    let isCelebrated = false;

                    let currentStrokeIndex = 0; // The active stroke of the letter
                    let completedStrokes = []; // Strokes that have been successfully traced

                    // Animated Tracing Helper variables
                    let helperTimeline = [];
                    let helperTimelineIndex = 0;
                    let helperAnimFrame = null;
                    let helperPauseTimer = 0;
                    let isHelperRunning = false;
                    let idleTimer = null;

                    // Strict Tracing & Deviation Enforcer Variables and Helpers
                    let strokeStartDotIndex = 0;
                    let warningTimeout = null;
                    let maxProgressReached = 0; // Monotonic progress along stroke to block wiggles and backtracking

                    function showPathWarning(msg) {
                        const warningEl = document.getElementById('pathWarning');
                        if (!warningEl) return;
                        warningEl.innerText = msg;
                        warningEl.style.opacity = '1';

                        if (warningTimeout) clearTimeout(warningTimeout);
                        warningTimeout = setTimeout(() => {
                            warningEl.style.opacity = '0';
                        }, 1800);
                    }

                    function playWarningSound() {
                        try {
                            const audioCtx = new (window.AudioContext || window.webkitAudioContext)();
                            const osc = audioCtx.createOscillator();
                            const gain = audioCtx.createGain();
                            osc.connect(gain);
                            gain.connect(audioCtx.destination);

                            osc.type = 'sawtooth';
                            osc.frequency.setValueAtTime(150, audioCtx.currentTime); // Low buzz sound
                            osc.frequency.linearRampToValueAtTime(100, audioCtx.currentTime + 0.25);

                            gain.gain.setValueAtTime(0.12, audioCtx.currentTime);
                            gain.gain.linearRampToValueAtTime(0.01, audioCtx.currentTime + 0.25);

                            osc.start(audioCtx.currentTime);
                            osc.stop(audioCtx.currentTime + 0.25);
                        } catch (e) {
                            console.log("Audio not supported");
                        }
                    }

                    function getSegmentProjection(x, y, x1, y1, x2, y2) {
                        const A = x - x1;
                        const B = y - y1;
                        const C = x2 - x1;
                        const D = y2 - y1;

                        const dot = A * C + B * D;
                        const lenSq = C * C + D * D;
                        let t = -1;
                        if (lenSq !== 0) {
                            t = dot / lenSq;
                        }

                        let xx, yy;
                        if (t < 0) {
                            t = 0;
                            xx = x1;
                            yy = y1;
                        } else if (t > 1) {
                            t = 1;
                            xx = x2;
                            yy = y2;
                        } else {
                            xx = x1 + t * C;
                            yy = y1 + t * D;
                        }

                        const dx = x - xx;
                        const dy = y - yy;
                        return {
                            distance: Math.sqrt(dx * dx + dy * dy),
                            t: t
                        };
                    }

                    function getActiveStrokeProjection(x, y) {
                        const guides = getActiveGuides(currentLetter);
                        if (!guides || !guides[currentStrokeIndex]) return { distance: Infinity, progress: 0 };

                        const points = guides[currentStrokeIndex].points;
                        let minDistance = Infinity;
                        let bestSegment = 0;
                        let bestT = 0;

                        for (let i = 0; i < points.length - 1; i++) {
                            const p1 = { x: points[i].x * canvas.width, y: points[i].y * canvas.height };
                            const p2 = { x: points[i + 1].x * canvas.width, y: points[i + 1].y * canvas.height };

                            const result = getSegmentProjection(x, y, p1.x, p1.y, p2.x, p2.y);
                            if (result.distance < minDistance) {
                                minDistance = result.distance;
                                bestSegment = i;
                                bestT = result.t;
                            }
                        }

                        // Calculate progress in pixels along the stroke guide line
                        let progressPixels = 0;
                        for (let i = 0; i < bestSegment; i++) {
                            const p1 = { x: points[i].x * canvas.width, y: points[i].y * canvas.height };
                            const p2 = { x: points[i + 1].x * canvas.width, y: points[i + 1].y * canvas.height };
                            const dx = p2.x - p1.x;
                            const dy = p2.y - p1.y;
                            progressPixels += Math.sqrt(dx * dx + dy * dy);
                        }

                        if (bestSegment < points.length - 1) {
                            const p1 = { x: points[bestSegment].x * canvas.width, y: points[bestSegment].y * canvas.height };
                            const p2 = { x: points[bestSegment + 1].x * canvas.width, y: points[bestSegment + 1].y * canvas.height };
                            const dx = p2.x - p1.x;
                            const dy = p2.y - p1.y;
                            const segmentLength = Math.sqrt(dx * dx + dy * dy);
                            progressPixels += bestT * segmentLength;
                        }

                        return {
                            distance: minDistance,
                            progress: progressPixels
                        };
                    }

                    function cancelCurrentStroke(msgEn, msgHi) {
                        isDrawing = false;
                        currentStroke = null;
                        if (drawingStrokes.length > 0) {
                            drawingStrokes.pop(); // Remove the failed stroke
                        }

                        // Reset connections made in this stroke
                        nextDotIndex = strokeStartDotIndex;
                        targetDots.forEach((d, idx) => {
                            if (idx >= strokeStartDotIndex) {
                                d.connected = false;
                            }
                        });

                        const msg = currentCategory === 'hindi' ? msgHi : msgEn;
                        showPathWarning(msg);
                        playWarningSound();
                        redrawCanvas();
                    }

                    function showScreen(screenId) {
                        const screens = ['categorySelectionScreen', 'tracingBoardScreen'];
                        screens.forEach(id => {
                            const el = document.getElementById(id);
                            if (el) {
                                if (id === screenId) {
                                    el.style.display = (id === 'categorySelectionScreen') ? 'flex' : 'block';
                                } else {
                                    el.style.display = 'none';
                                }
                            }
                        });
                        
                        if (screenId !== 'tracingBoardScreen') {
                            stopHelperAnimation();
                        }
                    }

                    function selectCategoryFromPath(cat) {
                        if (window.SoundFX && typeof window.SoundFX.play === 'function') {
                            window.SoundFX.play('click');
                        }
                        setCategory(cat);
                        
                        // Start writing from the first character of the selected category
                        currentLetterIdx = 0;
                        currentLetter = currentCategoryList[currentLetterIdx];
                        selectLetter(currentLetter);
                        
                        showScreen('tracingBoardScreen');
                        
                        // Trigger canvas resize and guide animation
                        setTimeout(() => {
                            resizeCanvas();
                            startHelperAnimation();
                        }, 250);
                    }

                    function goBackToCategoryScreen() {
                        if (window.SoundFX && typeof window.SoundFX.play === 'function') {
                            window.SoundFX.play('click');
                        }
                        showScreen('categorySelectionScreen');
                    }



                    // Stroke paths database for letters A-Z (coordinates relative to canvas 0.0 to 1.0)
                    const letterGuides = {
                        // --- UPPERCASE LETTERS ---
                        'A': [
                            { points: [{ x: 0.5, y: 0.22 }, { x: 0.25, y: 0.78 }], num: 1 },
                            { points: [{ x: 0.5, y: 0.22 }, { x: 0.75, y: 0.78 }], num: 2 },
                            { points: [{ x: 0.35, y: 0.55 }, { x: 0.65, y: 0.55 }], num: 3 }
                        ],
                        'B': [
                            { points: [{ x: 0.32, y: 0.22 }, { x: 0.32, y: 0.78 }], num: 1 },
                            { points: [{ x: 0.32, y: 0.22 }, { x: 0.46, y: 0.22 }, { x: 0.56, y: 0.26 }, { x: 0.60, y: 0.35 }, { x: 0.56, y: 0.44 }, { x: 0.46, y: 0.48 }, { x: 0.32, y: 0.48 }], num: 2 },
                            { points: [{ x: 0.32, y: 0.48 }, { x: 0.48, y: 0.48 }, { x: 0.60, y: 0.52 }, { x: 0.64, y: 0.63 }, { x: 0.60, y: 0.74 }, { x: 0.48, y: 0.78 }, { x: 0.32, y: 0.78 }], num: 3 }
                        ],
                        'C': [
                            { points: [{ x: 0.68, y: 0.28 }, { x: 0.54, y: 0.22 }, { x: 0.40, y: 0.28 }, { x: 0.32, y: 0.40 }, { x: 0.32, y: 0.60 }, { x: 0.40, y: 0.72 }, { x: 0.54, y: 0.78 }, { x: 0.68, y: 0.72 }], num: 1 }
                        ],
                        'D': [
                            { points: [{ x: 0.32, y: 0.22 }, { x: 0.32, y: 0.78 }], num: 1 },
                            { points: [{ x: 0.32, y: 0.22 }, { x: 0.50, y: 0.22 }, { x: 0.64, y: 0.28 }, { x: 0.70, y: 0.42 }, { x: 0.70, y: 0.58 }, { x: 0.64, y: 0.72 }, { x: 0.50, y: 0.78 }, { x: 0.32, y: 0.78 }], num: 2 }
                        ],
                        'E': [
                            { points: [{ x: 0.32, y: 0.22 }, { x: 0.32, y: 0.78 }], num: 1 },
                            { points: [{ x: 0.32, y: 0.22 }, { x: 0.68, y: 0.22 }], num: 2 },
                            { points: [{ x: 0.32, y: 0.5 }, { x: 0.58, y: 0.5 }], num: 3 },
                            { points: [{ x: 0.32, y: 0.78 }, { x: 0.68, y: 0.78 }], num: 4 }
                        ],
                        'F': [
                            { points: [{ x: 0.32, y: 0.22 }, { x: 0.32, y: 0.78 }], num: 1 },
                            { points: [{ x: 0.32, y: 0.22 }, { x: 0.68, y: 0.22 }], num: 2 },
                            { points: [{ x: 0.32, y: 0.5 }, { x: 0.58, y: 0.5 }], num: 3 }
                        ],
                        'G': [
                            { points: [{ x: 0.65, y: 0.32 }, { x: 0.52, y: 0.22 }, { x: 0.38, y: 0.26 }, { x: 0.30, y: 0.40 }, { x: 0.30, y: 0.60 }, { x: 0.38, y: 0.74 }, { x: 0.52, y: 0.78 }, { x: 0.65, y: 0.72 }, { x: 0.65, y: 0.52 }, { x: 0.52, y: 0.52 }], num: 1 }
                        ],
                        'H': [
                            { points: [{ x: 0.3, y: 0.22 }, { x: 0.3, y: 0.78 }], num: 1 },
                            { points: [{ x: 0.7, y: 0.22 }, { x: 0.7, y: 0.78 }], num: 2 },
                            { points: [{ x: 0.3, y: 0.5 }, { x: 0.7, y: 0.5 }], num: 3 }
                        ],
                        'I': [
                            { points: [{ x: 0.5, y: 0.22 }, { x: 0.5, y: 0.78 }], num: 1 },
                            { points: [{ x: 0.35, y: 0.22 }, { x: 0.65, y: 0.22 }], num: 2 },
                            { points: [{ x: 0.35, y: 0.78 }, { x: 0.65, y: 0.78 }], num: 3 }
                        ],
                        'J': [
                            { points: [{ x: 0.35, y: 0.22 }, { x: 0.75, y: 0.22 }], num: 1 },
                            { points: [{ x: 0.55, y: 0.22 }, { x: 0.55, y: 0.65 }, { x: 0.52, y: 0.75 }, { x: 0.45, y: 0.78 }, { x: 0.35, y: 0.75 }, { x: 0.32, y: 0.68 }], num: 2 }
                        ],
                        'K': [
                            { points: [{ x: 0.3, y: 0.22 }, { x: 0.3, y: 0.78 }], num: 1 },
                            { points: [{ x: 0.65, y: 0.22 }, { x: 0.3, y: 0.5 }], num: 2 },
                            { points: [{ x: 0.3, y: 0.5 }, { x: 0.68, y: 0.78 }], num: 3 }
                        ],
                        'L': [
                            { points: [{ x: 0.35, y: 0.22 }, { x: 0.35, y: 0.78 }], num: 1 },
                            { points: [{ x: 0.35, y: 0.78 }, { x: 0.65, y: 0.78 }], num: 2 }
                        ],
                        'M': [
                            { points: [{ x: 0.25, y: 0.78 }, { x: 0.25, y: 0.22 }, { x: 0.5, y: 0.55 }, { x: 0.75, y: 0.22 }, { x: 0.75, y: 0.78 }], num: 1 }
                        ],
                        'N': [
                            { points: [{ x: 0.28, y: 0.78 }, { x: 0.28, y: 0.22 }, { x: 0.72, y: 0.78 }, { x: 0.72, y: 0.22 }], num: 1 }
                        ],
                        'O': [
                            { points: [{ x: 0.50, y: 0.22 }, { x: 0.36, y: 0.25 }, { x: 0.28, y: 0.38 }, { x: 0.28, y: 0.62 }, { x: 0.36, y: 0.75 }, { x: 0.50, y: 0.78 }, { x: 0.64, y: 0.75 }, { x: 0.72, y: 0.62 }, { x: 0.72, y: 0.38 }, { x: 0.64, y: 0.25 }, { x: 0.50, y: 0.22 }], num: 1 }
                        ],
                        'P': [
                            { points: [{ x: 0.32, y: 0.22 }, { x: 0.32, y: 0.78 }], num: 1 },
                            { points: [{ x: 0.32, y: 0.22 }, { x: 0.48, y: 0.22 }, { x: 0.59, y: 0.26 }, { x: 0.63, y: 0.35 }, { x: 0.59, y: 0.44 }, { x: 0.48, y: 0.48 }, { x: 0.32, y: 0.48 }], num: 2 }
                        ],
                        'Q': [
                            { points: [{ x: 0.50, y: 0.22 }, { x: 0.36, y: 0.25 }, { x: 0.28, y: 0.38 }, { x: 0.28, y: 0.62 }, { x: 0.36, y: 0.75 }, { x: 0.50, y: 0.78 }, { x: 0.64, y: 0.75 }, { x: 0.72, y: 0.62 }, { x: 0.72, y: 0.38 }, { x: 0.64, y: 0.25 }, { x: 0.50, y: 0.22 }], num: 1 },
                            { points: [{ x: 0.56, y: 0.56 }, { x: 0.72, y: 0.78 }], num: 2 }
                        ],
                        'R': [
                            { points: [{ x: 0.32, y: 0.22 }, { x: 0.32, y: 0.78 }], num: 1 },
                            { points: [{ x: 0.32, y: 0.22 }, { x: 0.48, y: 0.22 }, { x: 0.59, y: 0.26 }, { x: 0.63, y: 0.35 }, { x: 0.59, y: 0.44 }, { x: 0.48, y: 0.48 }, { x: 0.32, y: 0.48 }], num: 2 },
                            { points: [{ x: 0.32, y: 0.48 }, { x: 0.68, y: 0.78 }], num: 3 }
                        ],
                        'S': [
                            { points: [{ x: 0.65, y: 0.32 }, { x: 0.56, y: 0.24 }, { x: 0.42, y: 0.24 }, { x: 0.34, y: 0.34 }, { x: 0.38, y: 0.46 }, { x: 0.50, y: 0.50 }, { x: 0.62, y: 0.54 }, { x: 0.66, y: 0.66 }, { x: 0.58, y: 0.76 }, { x: 0.44, y: 0.78 }, { x: 0.35, y: 0.70 }], num: 1 }
                        ],
                        'T': [
                            { points: [{ x: 0.5, y: 0.22 }, { x: 0.5, y: 0.78 }], num: 1 },
                            { points: [{ x: 0.3, y: 0.22 }, { x: 0.7, y: 0.22 }], num: 2 }
                        ],
                        'U': [
                            { points: [{ x: 0.30, y: 0.22 }, { x: 0.30, y: 0.65 }, { x: 0.35, y: 0.75 }, { x: 0.50, y: 0.78 }, { x: 0.65, y: 0.75 }, { x: 0.70, y: 0.65 }, { x: 0.70, y: 0.22 }], num: 1 }
                        ],
                        'V': [
                            { points: [{ x: 0.25, y: 0.22 }, { x: 0.5, y: 0.78 }, { x: 0.75, y: 0.22 }], num: 1 }
                        ],
                        'W': [
                            { points: [{ x: 0.2, y: 0.22 }, { x: 0.35, y: 0.78 }, { x: 0.5, y: 0.45 }, { x: 0.65, y: 0.78 }, { x: 0.8, y: 0.22 }], num: 1 }
                        ],
                        'X': [
                            { points: [{ x: 0.3, y: 0.22 }, { x: 0.7, y: 0.78 }], num: 1 },
                            { points: [{ x: 0.7, y: 0.22 }, { x: 0.3, y: 0.78 }], num: 2 }
                        ],
                        'Y': [
                            { points: [{ x: 0.28, y: 0.22 }, { x: 0.5, y: 0.5 }], num: 1 },
                            { points: [{ x: 0.72, y: 0.22 }, { x: 0.5, y: 0.5 }], num: 2 },
                            { points: [{ x: 0.5, y: 0.5 }, { x: 0.5, y: 0.78 }], num: 3 }
                        ],
                        'Z': [
                            { points: [{ x: 0.3, y: 0.22 }, { x: 0.7, y: 0.22 }, { x: 0.3, y: 0.78 }, { x: 0.7, y: 0.78 }], num: 1 }
                        ],
                        // Single-digit numbers coordinates
                        '0': [
                            { points: [{ x: 0.50, y: 0.22 }, { x: 0.34, y: 0.28 }, { x: 0.30, y: 0.50 }, { x: 0.34, y: 0.72 }, { x: 0.50, y: 0.78 }, { x: 0.66, y: 0.72 }, { x: 0.70, y: 0.50 }, { x: 0.66, y: 0.28 }, { x: 0.50, y: 0.22 }], num: 1 }
                        ],
                        '1': [
                            { points: [{ x: 0.40, y: 0.30 }, { x: 0.50, y: 0.22 }, { x: 0.50, y: 0.78 }], num: 1 },
                            { points: [{ x: 0.38, y: 0.78 }, { x: 0.62, y: 0.78 }], num: 2 }
                        ],
                        '2': [
                            { points: [{ x: 0.32, y: 0.32 }, { x: 0.38, y: 0.22 }, { x: 0.62, y: 0.22 }, { x: 0.68, y: 0.32 }, { x: 0.32, y: 0.78 }, { x: 0.68, y: 0.78 }], num: 1 }
                        ],
                        '3': [
                            { points: [{ x: 0.32, y: 0.24 }, { x: 0.64, y: 0.24 }, { x: 0.48, y: 0.48 }, { x: 0.66, y: 0.52 }, { x: 0.66, y: 0.72 }, { x: 0.48, y: 0.78 }, { x: 0.32, y: 0.70 }], num: 1 }
                        ],
                        '4': [
                            { points: [{ x: 0.58, y: 0.22 }, { x: 0.28, y: 0.60 }, { x: 0.72, y: 0.60 }], num: 1 },
                            { points: [{ x: 0.58, y: 0.22 }, { x: 0.58, y: 0.78 }], num: 2 }
                        ],
                        '5': [
                            { points: [{ x: 0.66, y: 0.22 }, { x: 0.36, y: 0.22 }, { x: 0.36, y: 0.48 }, { x: 0.64, y: 0.52 }, { x: 0.64, y: 0.72 }, { x: 0.50, y: 0.78 }, { x: 0.32, y: 0.72 }], num: 1 }
                        ],
                        '6': [
                            { points: [{ x: 0.62, y: 0.22 }, { x: 0.38, y: 0.32 }, { x: 0.32, y: 0.52 }, { x: 0.38, y: 0.78 }, { x: 0.62, y: 0.78 }, { x: 0.68, y: 0.58 }, { x: 0.32, y: 0.52 }], num: 1 }
                        ],
                        '7': [
                            { points: [{ x: 0.32, y: 0.22 }, { x: 0.68, y: 0.22 }, { x: 0.44, y: 0.78 }], num: 1 }
                        ],
                        '8': [
                            {
                                points: [
                                    { x: 0.50, y: 0.22 }, { x: 0.38, y: 0.28 }, { x: 0.38, y: 0.44 }, { x: 0.50, y: 0.50 }, { x: 0.62, y: 0.56 }, { x: 0.64, y: 0.72 },
                                    { x: 0.50, y: 0.78 }, { x: 0.36, y: 0.72 }, { x: 0.38, y: 0.56 }, { x: 0.50, y: 0.50 }, { x: 0.62, y: 0.44 }, { x: 0.62, y: 0.28 },
                                    { x: 0.50, y: 0.22 }
                                ], num: 1
                            }
                        ],
                        '9': [
                            { points: [{ x: 0.68, y: 0.48 }, { x: 0.32, y: 0.48 }, { x: 0.32, y: 0.26 }, { x: 0.62, y: 0.22 }, { x: 0.68, y: 0.48 }, { x: 0.68, y: 0.78 }], num: 1 }
                        ],
                        // Hindi Devanagari क-ज्ञ coordinates
                        'क': [
                            { points: [{ x: 0.5, y: 0.26 }, { x: 0.5, y: 0.74 }], num: 1 },
                            { points: [{ x: 0.5, y: 0.5 }, { x: 0.4, y: 0.42 }, { x: 0.34, y: 0.50 }, { x: 0.4, y: 0.58 }, { x: 0.5, y: 0.5 }], num: 2 },
                            { points: [{ x: 0.5, y: 0.5 }, { x: 0.6, y: 0.42 }, { x: 0.66, y: 0.50 }, { x: 0.66, y: 0.62 }], num: 3 },
                            { points: [{ x: 0.24, y: 0.26 }, { x: 0.76, y: 0.26 }], num: 4 }
                        ],
                        'ख': [
                            { points: [{ x: 0.38, y: 0.32 }, { x: 0.28, y: 0.32 }, { x: 0.28, y: 0.44 }, { x: 0.38, y: 0.56 }, { x: 0.56, y: 0.68 }], num: 1 },
                            { points: [{ x: 0.58, y: 0.32 }, { x: 0.58, y: 0.74 }], num: 2 },
                            { points: [{ x: 0.58, y: 0.54 }, { x: 0.46, y: 0.54 }, { x: 0.46, y: 0.64 }, { x: 0.58, y: 0.64 }], num: 3 },
                            { points: [{ x: 0.22, y: 0.26 }, { x: 0.72, y: 0.26 }], num: 4 }
                        ],
                        'ग': [
                            { points: [{ x: 0.38, y: 0.32 }, { x: 0.38, y: 0.62 }, { x: 0.30, y: 0.62 }, { x: 0.30, y: 0.54 }, { x: 0.38, y: 0.54 }], num: 1 },
                            { points: [{ x: 0.58, y: 0.32 }, { x: 0.58, y: 0.74 }], num: 2 },
                            { points: [{ x: 0.24, y: 0.26 }, { x: 0.70, y: 0.26 }], num: 3 }
                        ],
                        'घ': [
                            { points: [{ x: 0.32, y: 0.32 }, { x: 0.46, y: 0.32 }, { x: 0.32, y: 0.50 }, { x: 0.48, y: 0.50 }, { x: 0.34, y: 0.68 }, { x: 0.58, y: 0.68 }], num: 1 },
                            { points: [{ x: 0.58, y: 0.32 }, { x: 0.58, y: 0.74 }], num: 2 },
                            { points: [{ x: 0.24, y: 0.26 }, { x: 0.70, y: 0.26 }], num: 3 }
                        ],
                        'ङ': [
                            { points: [{ x: 0.5, y: 0.26 }, { x: 0.5, y: 0.34 }], num: 1 },
                            { points: [{ x: 0.5, y: 0.34 }, { x: 0.38, y: 0.42 }, { x: 0.5, y: 0.52 }, { x: 0.62, y: 0.62 }, { x: 0.5, y: 0.70 }, { x: 0.38, y: 0.62 }], num: 2 },
                            { points: [{ x: 0.68, y: 0.52 }, { x: 0.68, y: 0.54 }], num: 3 },
                            { points: [{ x: 0.32, y: 0.26 }, { x: 0.68, y: 0.26 }], num: 4 }
                        ],
                        'च': [
                            { points: [{ x: 0.28, y: 0.50 }, { x: 0.46, y: 0.50 }], num: 1 },
                            { points: [{ x: 0.46, y: 0.50 }, { x: 0.36, y: 0.66 }, { x: 0.48, y: 0.70 }, { x: 0.58, y: 0.58 }], num: 2 },
                            { points: [{ x: 0.58, y: 0.32 }, { x: 0.58, y: 0.74 }], num: 3 },
                            { points: [{ x: 0.24, y: 0.26 }, { x: 0.72, y: 0.26 }], num: 4 }
                        ],
                        'छ': [
                            { points: [{ x: 0.32, y: 0.32 }, { x: 0.48, y: 0.32 }, { x: 0.32, y: 0.48 }, { x: 0.52, y: 0.54 }, { x: 0.48, y: 0.68 }, { x: 0.62, y: 0.64 }, { x: 0.62, y: 0.52 }, { x: 0.52, y: 0.54 }], num: 1 },
                            { points: [{ x: 0.62, y: 0.52 }, { x: 0.62, y: 0.32 }], num: 2 },
                            { points: [{ x: 0.32, y: 0.26 }, { x: 0.76, y: 0.26 }], num: 3 }
                        ],
                        'ज': [
                            { points: [{ x: 0.30, y: 0.42 }, { x: 0.26, y: 0.62 }, { x: 0.42, y: 0.62 }, { x: 0.44, y: 0.50 }], num: 1 },
                            { points: [{ x: 0.44, y: 0.50 }, { x: 0.58, y: 0.50 }], num: 2 },
                            { points: [{ x: 0.58, y: 0.32 }, { x: 0.58, y: 0.74 }], num: 3 },
                            { points: [{ x: 0.22, y: 0.26 }, { x: 0.70, y: 0.26 }], num: 4 }
                        ],
                        'झ': [
                            { points: [{ x: 0.36, y: 0.32 }, { x: 0.36, y: 0.38 }, { x: 0.28, y: 0.42 }, { x: 0.38, y: 0.48 }, { x: 0.26, y: 0.54 }, { x: 0.20, y: 0.60 }, { x: 0.28, y: 0.68 }, { x: 0.34, y: 0.60 }, { x: 0.34, y: 0.74 }], num: 1 },
                            { points: [{ x: 0.34, y: 0.50 }, { x: 0.58, y: 0.50 }], num: 2 },
                            { points: [{ x: 0.58, y: 0.32 }, { x: 0.58, y: 0.74 }], num: 3 },
                            { points: [{ x: 0.22, y: 0.26 }, { x: 0.70, y: 0.26 }], num: 4 }
                        ],
                        'ञ': [
                            { points: [{ x: 0.38, y: 0.36 }, { x: 0.28, y: 0.48 }, { x: 0.38, y: 0.60 }], num: 1 },
                            { points: [{ x: 0.32, y: 0.48 }, { x: 0.58, y: 0.48 }], num: 2 },
                            { points: [{ x: 0.58, y: 0.32 }, { x: 0.58, y: 0.74 }], num: 3 },
                            { points: [{ x: 0.22, y: 0.26 }, { x: 0.70, y: 0.26 }], num: 4 }
                        ],
                        'ट': [
                            { points: [{ x: 0.5, y: 0.26 }, { x: 0.5, y: 0.36 }], num: 1 },
                            { points: [{ x: 0.5, y: 0.36 }, { x: 0.34, y: 0.42 }, { x: 0.34, y: 0.66 }, { x: 0.50, y: 0.74 }, { x: 0.66, y: 0.66 }], num: 2 },
                            { points: [{ x: 0.28, y: 0.26 }, { x: 0.72, y: 0.26 }], num: 3 }
                        ],
                        'ठ': [
                            { points: [{ x: 0.5, y: 0.26 }, { x: 0.5, y: 0.36 }], num: 1 },
                            { points: [{ x: 0.5, y: 0.36 }, { x: 0.34, y: 0.44 }, { x: 0.34, y: 0.66 }, { x: 0.50, y: 0.74 }, { x: 0.66, y: 0.66 }, { x: 0.66, y: 0.44 }, { x: 0.5, y: 0.36 }], num: 2 },
                            { points: [{ x: 0.28, y: 0.26 }, { x: 0.72, y: 0.26 }], num: 3 }
                        ],
                        'ड': [
                            { points: [{ x: 0.5, y: 0.26 }, { x: 0.5, y: 0.34 }], num: 1 },
                            { points: [{ x: 0.5, y: 0.34 }, { x: 0.38, y: 0.42 }, { x: 0.5, y: 0.52 }, { x: 0.62, y: 0.62 }, { x: 0.5, y: 0.72 }, { x: 0.38, y: 0.64 }], num: 2 },
                            { points: [{ x: 0.30, y: 0.26 }, { x: 0.70, y: 0.26 }], num: 3 }
                        ],
                        'ढ': [
                            { points: [{ x: 0.5, y: 0.26 }, { x: 0.5, y: 0.36 }], num: 1 },
                            { points: [{ x: 0.5, y: 0.36 }, { x: 0.34, y: 0.42 }, { x: 0.34, y: 0.66 }, { x: 0.50, y: 0.74 }, { x: 0.64, y: 0.66 }, { x: 0.64, y: 0.56 }, { x: 0.52, y: 0.58 }], num: 2 },
                            { points: [{ x: 0.28, y: 0.26 }, { x: 0.72, y: 0.26 }], num: 3 }
                        ],
                        'ण': [
                            { points: [{ x: 0.32, y: 0.32 }, { x: 0.32, y: 0.64 }, { x: 0.48, y: 0.64 }, { x: 0.48, y: 0.32 }], num: 1 },
                            { points: [{ x: 0.58, y: 0.32 }, { x: 0.58, y: 0.74 }], num: 2 },
                            { points: [{ x: 0.24, y: 0.26 }, { x: 0.68, y: 0.26 }], num: 3 }
                        ],
                        'त': [
                            { points: [{ x: 0.58, y: 0.32 }, { x: 0.58, y: 0.74 }], num: 1 },
                            { points: [{ x: 0.58, y: 0.50 }, { x: 0.36, y: 0.50 }, { x: 0.36, y: 0.74 }], num: 2 },
                            { points: [{ x: 0.26, y: 0.26 }, { x: 0.70, y: 0.26 }], num: 3 }
                        ],
                        'थ': [
                            { points: [{ x: 0.34, y: 0.40 }, { x: 0.28, y: 0.36 }, { x: 0.34, y: 0.32 }, { x: 0.44, y: 0.38 }, { x: 0.34, y: 0.56 }, { x: 0.44, y: 0.68 }, { x: 0.58, y: 0.68 }], num: 1 },
                            { points: [{ x: 0.58, y: 0.32 }, { x: 0.58, y: 0.74 }], num: 2 },
                            { points: [{ x: 0.42, y: 0.26 }, { x: 0.70, y: 0.26 }], num: 3 }
                        ],
                        'द': [
                            { points: [{ x: 0.5, y: 0.26 }, { x: 0.5, y: 0.36 }], num: 1 },
                            { points: [{ x: 0.5, y: 0.36 }, { x: 0.34, y: 0.42 }, { x: 0.34, y: 0.62 }, { x: 0.50, y: 0.70 }, { x: 0.58, y: 0.60 }, { x: 0.44, y: 0.78 }], num: 2 },
                            { points: [{ x: 0.28, y: 0.26 }, { x: 0.72, y: 0.26 }], num: 3 }
                        ],
                        'ध': [
                            { points: [{ x: 0.34, y: 0.36 }, { x: 0.28, y: 0.32 }, { x: 0.34, y: 0.28 }, { x: 0.46, y: 0.32 }, { x: 0.34, y: 0.48 }, { x: 0.48, y: 0.48 }, { x: 0.34, y: 0.66 }, { x: 0.58, y: 0.66 }], num: 1 },
                            { points: [{ x: 0.58, y: 0.32 }, { x: 0.58, y: 0.74 }], num: 2 },
                            { points: [{ x: 0.42, y: 0.26 }, { x: 0.70, y: 0.26 }], num: 3 }
                        ],
                        'न': [
                            { points: [{ x: 0.28, y: 0.54 }, { x: 0.28, y: 0.62 }, { x: 0.34, y: 0.54 }, { x: 0.58, y: 0.54 }], num: 1 },
                            { points: [{ x: 0.58, y: 0.32 }, { x: 0.58, y: 0.74 }], num: 2 },
                            { points: [{ x: 0.22, y: 0.26 }, { x: 0.70, y: 0.26 }], num: 3 }
                        ],
                        'प': [
                            { points: [{ x: 0.34, y: 0.32 }, { x: 0.34, y: 0.56 }, { x: 0.58, y: 0.56 }], num: 1 },
                            { points: [{ x: 0.58, y: 0.32 }, { x: 0.58, y: 0.74 }], num: 2 },
                            { points: [{ x: 0.24, y: 0.26 }, { x: 0.70, y: 0.26 }], num: 3 }
                        ],
                        'फ': [
                            { points: [{ x: 0.34, y: 0.32 }, { x: 0.34, y: 0.56 }, { x: 0.58, y: 0.56 }], num: 1 },
                            { points: [{ x: 0.58, y: 0.32 }, { x: 0.58, y: 0.74 }], num: 2 },
                            { points: [{ x: 0.58, y: 0.44 }, { x: 0.68, y: 0.44 }, { x: 0.72, y: 0.62 }], num: 3 },
                            { points: [{ x: 0.24, y: 0.26 }, { x: 0.76, y: 0.26 }], num: 4 }
                        ],
                        'ब': [
                            { points: [{ x: 0.58, y: 0.32 }, { x: 0.58, y: 0.74 }], num: 1 },
                            { points: [{ x: 0.58, y: 0.53 }, { x: 0.42, y: 0.53 }, { x: 0.42, y: 0.67 }, { x: 0.58, y: 0.67 }], num: 2 },
                            { points: [{ x: 0.44, y: 0.55 }, { x: 0.56, y: 0.65 }], num: 3 },
                            { points: [{ x: 0.26, y: 0.26 }, { x: 0.70, y: 0.26 }], num: 4 }
                        ],
                        'भ': [
                            { points: [{ x: 0.34, y: 0.36 }, { x: 0.28, y: 0.32 }, { x: 0.34, y: 0.28 }, { x: 0.34, y: 0.56 }, { x: 0.28, y: 0.62 }, { x: 0.34, y: 0.56 }, { x: 0.58, y: 0.56 }], num: 1 },
                            { points: [{ x: 0.58, y: 0.32 }, { x: 0.58, y: 0.74 }], num: 2 },
                            { points: [{ x: 0.42, y: 0.26 }, { x: 0.70, y: 0.26 }], num: 3 }
                        ],
                        'म': [
                            { points: [{ x: 0.34, y: 0.32 }, { x: 0.34, y: 0.56 }, { x: 0.28, y: 0.62 }, { x: 0.34, y: 0.56 }, { x: 0.58, y: 0.56 }], num: 1 },
                            { points: [{ x: 0.58, y: 0.32 }, { x: 0.58, y: 0.74 }], num: 2 },
                            { points: [{ x: 0.22, y: 0.26 }, { x: 0.70, y: 0.26 }], num: 3 }
                        ],
                        'य': [
                            { points: [{ x: 0.32, y: 0.32 }, { x: 0.44, y: 0.32 }, { x: 0.32, y: 0.48 }, { x: 0.44, y: 0.68 }, { x: 0.58, y: 0.68 }], num: 1 },
                            { points: [{ x: 0.58, y: 0.32 }, { x: 0.58, y: 0.74 }], num: 2 },
                            { points: [{ x: 0.24, y: 0.26 }, { x: 0.70, y: 0.26 }], num: 3 }
                        ],
                        'र': [
                            { points: [{ x: 0.34, y: 0.32 }, { x: 0.54, y: 0.32 }, { x: 0.44, y: 0.48 }, { x: 0.36, y: 0.54 }, { x: 0.54, y: 0.74 }], num: 1 },
                            { points: [{ x: 0.24, y: 0.26 }, { x: 0.64, y: 0.26 }], num: 2 }
                        ],
                        'ल': [
                            { points: [{ x: 0.62, y: 0.32 }, { x: 0.62, y: 0.74 }], num: 1 },
                            { points: [{ x: 0.28, y: 0.54 }, { x: 0.36, y: 0.44 }, { x: 0.46, y: 0.54 }, { x: 0.62, y: 0.54 }], num: 2 },
                            { points: [{ x: 0.22, y: 0.26 }, { x: 0.72, y: 0.26 }], num: 3 }
                        ],
                        'व': [
                            { points: [{ x: 0.58, y: 0.32 }, { x: 0.58, y: 0.74 }], num: 1 },
                            { points: [{ x: 0.58, y: 0.53 }, { x: 0.42, y: 0.53 }, { x: 0.42, y: 0.67 }, { x: 0.58, y: 0.67 }], num: 2 },
                            { points: [{ x: 0.26, y: 0.26 }, { x: 0.70, y: 0.26 }], num: 3 }
                        ],
                        'श': [
                            { points: [{ x: 0.34, y: 0.36 }, { x: 0.28, y: 0.32 }, { x: 0.34, y: 0.28 }, { x: 0.44, y: 0.36 }, { x: 0.34, y: 0.56 }, { x: 0.28, y: 0.62 }, { x: 0.44, y: 0.74 }], num: 1 },
                            { points: [{ x: 0.58, y: 0.32 }, { x: 0.58, y: 0.74 }], num: 2 },
                            { points: [{ x: 0.46, y: 0.26 }, { x: 0.70, y: 0.26 }], num: 3 }
                        ],
                        'ष': [
                            { points: [{ x: 0.34, y: 0.32 }, { x: 0.34, y: 0.56 }, { x: 0.58, y: 0.56 }], num: 1 },
                            { points: [{ x: 0.58, y: 0.32 }, { x: 0.58, y: 0.74 }], num: 2 },
                            { points: [{ x: 0.34, y: 0.32 }, { x: 0.58, y: 0.56 }], num: 3 },
                            { points: [{ x: 0.24, y: 0.26 }, { x: 0.70, y: 0.26 }], num: 4 }
                        ],
                        'स': [
                            { points: [{ x: 0.32, y: 0.32 }, { x: 0.46, y: 0.32 }, { x: 0.38, y: 0.46 }, { x: 0.32, y: 0.52 }, { x: 0.48, y: 0.72 }], num: 1 },
                            { points: [{ x: 0.38, y: 0.50 }, { x: 0.58, y: 0.50 }], num: 2 },
                            { points: [{ x: 0.58, y: 0.32 }, { x: 0.58, y: 0.74 }], num: 3 },
                            { points: [{ x: 0.22, y: 0.26 }, { x: 0.70, y: 0.26 }], num: 4 }
                        ],
                        'ह': [
                            { points: [{ x: 0.5, y: 0.26 }, { x: 0.5, y: 0.32 }], num: 1 },
                            { points: [{ x: 0.5, y: 0.32 }, { x: 0.38, y: 0.38 }, { x: 0.5, y: 0.46 }, { x: 0.58, y: 0.52 }, { x: 0.46, y: 0.58 }], num: 2 },
                            { points: [{ x: 0.46, y: 0.46 }, { x: 0.58, y: 0.52 }, { x: 0.54, y: 0.68 }, { x: 0.38, y: 0.72 }], num: 3 },
                            { points: [{ x: 0.32, y: 0.26 }, { x: 0.68, y: 0.26 }], num: 4 }
                        ],
                        'क्ष': [
                            { points: [{ x: 0.65, y: 0.30 }, { x: 0.65, y: 0.78 }], num: 1 },
                            {
                                points: [
                                    { x: 0.65, y: 0.52 }, { x: 0.50, y: 0.50 }, { x: 0.42, y: 0.42 }, { x: 0.42, y: 0.34 }, { x: 0.50, y: 0.34 }, { x: 0.50, y: 0.46 },
                                    { x: 0.36, y: 0.50 }, { x: 0.32, y: 0.60 }, { x: 0.42, y: 0.64 }, { x: 0.48, y: 0.56 }, { x: 0.42, y: 0.72 }, { x: 0.34, y: 0.76 }
                                ], num: 2
                            },
                            { points: [{ x: 0.48, y: 0.30 }, { x: 0.74, y: 0.30 }], num: 3 }
                        ],
                        'त्र': [
                            { points: [{ x: 0.58, y: 0.30 }, { x: 0.58, y: 0.78 }], num: 1 },
                            { points: [{ x: 0.58, y: 0.50 }, { x: 0.42, y: 0.40 }, { x: 0.32, y: 0.38 }], num: 2 },
                            { points: [{ x: 0.58, y: 0.50 }, { x: 0.34, y: 0.68 }], num: 3 },
                            { points: [{ x: 0.24, y: 0.30 }, { x: 0.68, y: 0.30 }], num: 4 }
                        ],
                        'ज्ञ': [
                            { points: [{ x: 0.62, y: 0.30 }, { x: 0.62, y: 0.78 }], num: 1 },
                            { points: [{ x: 0.62, y: 0.50 }, { x: 0.38, y: 0.50 }], num: 2 },
                            { points: [{ x: 0.38, y: 0.50 }, { x: 0.26, y: 0.50 }, { x: 0.24, y: 0.60 }, { x: 0.36, y: 0.64 }, { x: 0.36, y: 0.70 }, { x: 0.22, y: 0.76 }], num: 3 },
                            { points: [{ x: 0.20, y: 0.30 }, { x: 0.72, y: 0.30 }], num: 4 }
                        ]
                    };

                    // Helper to get digit coordinates dynamically
                    function getNumberGuides(numStr) {
                        if (numStr.length === 1) {
                            return letterGuides[numStr];
                        }
                        if (numStr.length === 3) {
                            // Triple digits e.g. "100"
                            const d1 = numStr[0];
                            const d2 = numStr[1];
                            const d3 = numStr[2];
                            const guides1 = letterGuides[d1];
                            const guides2 = letterGuides[d2];
                            const guides3 = letterGuides[d3];
                            if (!guides1 || !guides2 || !guides3) return [];

                            const combined = [];
                            let strokeNum = 1;

                            // Left digit shift & scale
                            guides1.forEach(guide => {
                                const shiftedPoints = guide.points.map(pt => ({
                                    x: 0.5 + (pt.x - 0.5) * 0.38 - 0.25,
                                    y: 0.5 + (pt.y - 0.5) * 0.75
                                }));
                                combined.push({ points: shiftedPoints, num: strokeNum++ });
                            });

                            // Middle digit shift & scale
                            guides2.forEach(guide => {
                                const shiftedPoints = guide.points.map(pt => ({
                                    x: 0.5 + (pt.x - 0.5) * 0.38,
                                    y: 0.5 + (pt.y - 0.5) * 0.75
                                }));
                                combined.push({ points: shiftedPoints, num: strokeNum++ });
                            });

                            // Right digit shift & scale
                            guides3.forEach(guide => {
                                const shiftedPoints = guide.points.map(pt => ({
                                    x: 0.5 + (pt.x - 0.5) * 0.38 + 0.25,
                                    y: 0.5 + (pt.y - 0.5) * 0.75
                                }));
                                combined.push({ points: shiftedPoints, num: strokeNum++ });
                            });

                            return combined;
                        }
                        // Double digits e.g. "12"
                        const d1 = numStr[0];
                        const d2 = numStr[1];
                        const guides1 = letterGuides[d1];
                        const guides2 = letterGuides[d2];
                        if (!guides1 || !guides2) return [];

                        const combined = [];
                        let strokeNum = 1;

                        // Left digit shift & scale
                        guides1.forEach(guide => {
                            const shiftedPoints = guide.points.map(pt => ({
                                x: 0.5 + (pt.x - 0.5) * 0.55 - 0.18,
                                y: 0.5 + (pt.y - 0.5) * 0.75
                            }));
                            combined.push({ points: shiftedPoints, num: strokeNum++ });
                        });

                        // Right digit shift & scale
                        guides2.forEach(guide => {
                            const shiftedPoints = guide.points.map(pt => ({
                                x: 0.5 + (pt.x - 0.5) * 0.55 + 0.18,
                                y: 0.5 + (pt.y - 0.5) * 0.75
                            }));
                            combined.push({ points: shiftedPoints, num: strokeNum++ });
                        });

                        return combined;
                    }

                    function getActiveGuides(char) {
                        if (currentCategory === 'numbers') {
                            return getNumberGuides(char);
                        }
                        return letterGuides[char];
                    }

                    function updateTabStyles() {
                        const tabs = {
                            'english': document.getElementById('tab-english'),
                            'numbers': document.getElementById('tab-numbers'),
                            'hindi': document.getElementById('tab-hindi')
                        };

                        Object.keys(tabs).forEach(cat => {
                            const btn = tabs[cat];
                            if (!btn) return;

                            if (cat === currentCategory) {
                                // Active style: solid pink/purple
                                btn.className = "btn-3d btn-pink category-tab-btn";
                                btn.style.backgroundColor = "var(--color-purple)";
                                btn.style.borderBottomColor = "var(--color-purple-shadow)";
                                btn.style.color = "#FFF";
                            } else {
                                // Inactive style: solid yellow
                                btn.className = "btn-3d btn-yellow category-tab-btn";
                                btn.style.backgroundColor = "var(--color-yellow)";
                                btn.style.borderBottomColor = "var(--color-yellow-shadow)";
                                btn.style.color = "#4A3B00";
                            }
                        });
                    }

                    function setCategory(cat) {
                        if (!categorySequences[cat]) return;
                        currentCategory = cat;
                        currentCategoryList = categorySequences[cat];

                        // Always reset active character index to 0 when category is changed
                        currentLetter = currentCategoryList[0];

                        // Update UI tabs
                        updateTabStyles();

                        // Refresh canvas
                        if (canvas.width > 0) {
                            generateTargetDots();
                            clearCanvas();
                        }

                        // Speak category using the global child's voice engine
                        if (window.SoundFX && typeof window.SoundFX.speak === 'function') {
                            if (cat === 'english') {
                                window.SoundFX.speak("Let's trace English Alphabets!", "en-US");
                            } else if (cat === 'numbers') {
                                window.SoundFX.speak("Let's trace Numbers!", "en-US");
                            } else if (cat === 'hindi') {
                                window.SoundFX.speak("चलो हिंदी अक्षर लिखना सीखें!", "hi-IN");
                            }
                        }
                    }

                    // Interpolates points along strokes to form connectable target dots
                    function generateTargetDots() {
                        targetDots = [];
                        nextDotIndex = 0;
                        const guides = getActiveGuides(currentLetter);
                        if (!guides || !guides[currentStrokeIndex]) return;

                        const guide = guides[currentStrokeIndex];
                        for (let i = 0; i < guide.points.length - 1; i++) {
                            const pt1 = guide.points[i];
                            const pt2 = guide.points[i + 1];

                            const x1 = pt1.x * canvas.width;
                            const y1 = pt1.y * canvas.height;
                            const x2 = pt2.x * canvas.width;
                            const y2 = pt2.y * canvas.height;

                            const dx = x2 - x1;
                            const dy = y2 - y1;
                            const dist = Math.sqrt(dx * dx + dy * dy);

                            // Space dots further apart so numbers don't overlap
                            const spacing = 55;
                            const steps = Math.max(1, Math.floor(dist / spacing));

                            for (let j = 0; j <= steps; j++) {
                                const ratio = j / steps;
                                const dotX = x1 + dx * ratio;
                                const dotY = y1 + dy * ratio;

                                // Avoid duplicate dots near intersections
                                const isDuplicate = targetDots.some(d => {
                                    const distSq = (d.x - dotX) * (d.x - dotX) + (d.y - dotY) * (d.y - dotY);
                                    return distSq < 18 * 18;
                                });

                                if (!isDuplicate) {
                                    targetDots.push({
                                        x: dotX,
                                        y: dotY,
                                        connected: false,
                                        strokeIndex: currentStrokeIndex
                                    });
                                }
                            }
                        }

                        updateInstructionBanner();
                    }

                    // Animated trace helper methods
                    function buildHelperTimeline() {
                        helperTimeline = [];
                        const guides = getActiveGuides(currentLetter);
                        if (!guides || !guides[currentStrokeIndex]) return;

                        const guide = guides[currentStrokeIndex];
                        const points = [];
                        for (let i = 0; i < guide.points.length - 1; i++) {
                            const pt1 = guide.points[i];
                            const pt2 = guide.points[i + 1];

                            const x1 = pt1.x * canvas.width;
                            const y1 = pt1.y * canvas.height;
                            const x2 = pt2.x * canvas.width;
                            const y2 = pt2.y * canvas.height;

                            const dx = x2 - x1;
                            const dy = y2 - y1;
                            const dist = Math.sqrt(dx * dx + dy * dy);
                            const steps = Math.max(1, Math.floor(dist / 4)); // smooth 4px steps

                            for (let s = 0; s <= steps; s++) {
                                const ratio = s / steps;
                                points.push({
                                    x: x1 + dx * ratio,
                                    y: y1 + dy * ratio,
                                    action: 'move'
                                });
                            }
                        }

                        if (points.length > 0) {
                            points[0].action = 'start';
                            helperTimeline = helperTimeline.concat(points);
                            helperTimeline.push({
                                x: points[points.length - 1].x,
                                y: points[points.length - 1].y,
                                action: 'pause'
                            });
                        }
                    }

                    function startHelperAnimation() {
                        if (isHelperRunning) return;
                        buildHelperTimeline();
                        if (helperTimeline.length === 0) return;

                        isHelperRunning = true;
                        helperTimelineIndex = 0;
                        helperPauseTimer = 0;

                        const helperEl = document.getElementById('tracingHelperHand');
                        if (helperEl) {
                            helperEl.style.display = 'block';
                            helperEl.style.opacity = '0';
                        }

                        runHelperLoop();
                    }

                    function runHelperLoop() {
                        if (!isHelperRunning) return;

                        const helperEl = document.getElementById('tracingHelperHand');
                        if (!helperEl) return;

                        if (helperPauseTimer > 0) {
                            helperPauseTimer--;
                            helperAnimFrame = requestAnimationFrame(runHelperLoop);
                            return;
                        }

                        if (helperTimelineIndex >= helperTimeline.length) {
                            helperTimelineIndex = 0;
                            helperEl.style.opacity = '0';
                            helperPauseTimer = 90; // Pause for 1.5s before looping
                            helperAnimFrame = requestAnimationFrame(runHelperLoop);
                            return;
                        }

                        const currentFrame = helperTimeline[helperTimelineIndex];
                        helperEl.style.left = currentFrame.x + 'px';
                        helperEl.style.top = currentFrame.y + 'px';

                        if (currentFrame.action === 'start') {
                            helperEl.style.opacity = '1';
                            helperPauseTimer = 35; // Pause 0.6s at stroke start
                        } else if (currentFrame.action === 'pause') {
                            helperEl.style.opacity = '0';
                            helperPauseTimer = 50; // Pause 0.8s at stroke end
                        }

                        helperTimelineIndex++;
                        helperAnimFrame = requestAnimationFrame(runHelperLoop);
                    }

                    // Stop helper animation loop
                    function stopHelperAnimation() {
                        isHelperRunning = false;
                        if (helperAnimFrame) {
                            cancelAnimationFrame(helperAnimFrame);
                            helperAnimFrame = null;
                        }
                        const helperEl = document.getElementById('tracingHelperHand');
                        if (helperEl) {
                            helperEl.style.display = 'none';
                            helperEl.style.opacity = '0';
                        }
                    }

                    function resetIdleTimer() {
                        stopHelperAnimation();

                        if (idleTimer) clearTimeout(idleTimer);

                        idleTimer = setTimeout(() => {
                            if (!isCelebrated) {
                                startHelperAnimation();
                            }
                        }, 4000); // 4 seconds of inactivity restarts helper hand
                    }

                    function drawArrowhead(ctx, fromX, fromY, toX, toY, radius = 9) {
                        const angle = Math.atan2(toY - fromY, toX - fromX);
                        ctx.beginPath();
                        ctx.moveTo(toX, toY);
                        ctx.lineTo(toX - radius * Math.cos(angle - Math.PI / 6), toY - radius * Math.sin(angle - Math.PI / 6));
                        ctx.lineTo(toX - radius * Math.cos(angle + Math.PI / 6), toY - radius * Math.sin(angle + Math.PI / 6));
                        ctx.closePath();
                        ctx.fillStyle = '#FF914D'; // Bright orange arrowhead
                        ctx.fill();
                    }

                    function drawNumberedDot(ctx, x, y, number) {
                        ctx.beginPath();
                        ctx.arc(x, y, 14, 0, 2 * Math.PI);
                        ctx.fillStyle = '#38B6FF'; // Bright blue circle start marker
                        ctx.fill();
                        ctx.lineWidth = 2.5;
                        ctx.strokeStyle = '#FFFFFF';
                        ctx.stroke();

                        ctx.fillStyle = '#FFFFFF';
                        ctx.font = 'bold 14px "Fredoka", sans-serif';
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'middle';
                        ctx.fillText(number, x, y);
                    }

                    function drawGuides() {
                        const guides = getActiveGuides(currentLetter);
                        if (!guides) return;

                        ctx.save();

                        guides.forEach((guide, idx) => {
                            // If it is completed, it is drawn in redrawCanvas() as solid
                            if (completedStrokes.includes(idx)) return;

                            const scaledPoints = guide.points.map(pt => ({
                                x: pt.x * canvas.width,
                                y: pt.y * canvas.height
                            }));

                            ctx.beginPath();
                            ctx.moveTo(scaledPoints[0].x, scaledPoints[0].y);
                            for (let i = 1; i < scaledPoints.length; i++) {
                                ctx.lineTo(scaledPoints[i].x, scaledPoints[i].y);
                            }

                            if (idx === currentStrokeIndex) {
                                // Active stroke
                                ctx.strokeStyle = 'rgba(255, 145, 77, 0.6)';
                                ctx.lineWidth = 8;
                                ctx.lineCap = 'round';
                                ctx.lineJoin = 'round';
                                ctx.setLineDash([5, 10]);
                            } else {
                                // Inactive future stroke
                                ctx.strokeStyle = 'rgba(200, 200, 200, 0.25)';
                                ctx.lineWidth = 5;
                                ctx.lineCap = 'round';
                                ctx.lineJoin = 'round';
                                ctx.setLineDash([8, 8]);
                            }
                            ctx.stroke();

                            // Only draw arrowheads for the active stroke
                            if (idx === currentStrokeIndex) {
                                let distanceSinceLastArrow = 0;
                                const targetSpacing = 90;
                                for (let i = 1; i < scaledPoints.length; i++) {
                                    const pt1 = scaledPoints[i - 1];
                                    const pt2 = scaledPoints[i];
                                    const dx = pt2.x - pt1.x;
                                    const dy = pt2.y - pt1.y;
                                    const dist = Math.sqrt(dx * dx + dy * dy);

                                    distanceSinceLastArrow += dist;
                                    if (distanceSinceLastArrow >= targetSpacing && i < scaledPoints.length - 1) {
                                        ctx.setLineDash([]);
                                        drawArrowhead(ctx, pt1.x, pt1.y, pt2.x, pt2.y, 6.5);
                                        ctx.setLineDash([5, 10]);
                                        distanceSinceLastArrow = 0;
                                    }
                                }

                                if (scaledPoints.length >= 2) {
                                    const startPt = scaledPoints[scaledPoints.length - 2];
                                    const endPt = scaledPoints[scaledPoints.length - 1];
                                    ctx.setLineDash([]);
                                    drawArrowhead(ctx, startPt.x, startPt.y, endPt.x, endPt.y);
                                }
                            }
                        });

                        ctx.restore();
                    }

                    function drawTargetDots() {
                        targetDots.forEach((dot, index) => {
                            ctx.save();
                            ctx.beginPath();

                            const isStart = index === 0;
                            const isEnd = index === targetDots.length - 1;

                            let radius = 12;
                            if (isStart || isEnd) {
                                radius = 16;
                            }

                            ctx.arc(dot.x, dot.y, radius, 0, 2 * Math.PI);

                            if (dot.connected) {
                                ctx.fillStyle = '#7ED957';
                                ctx.strokeStyle = '#63AA43';
                            } else if (index === nextDotIndex) {
                                if (isStart) {
                                    ctx.fillStyle = '#2EC4B6'; // Teal/Green for start Go
                                    ctx.strokeStyle = '#009688';
                                } else {
                                    ctx.fillStyle = '#FFDE59';
                                    ctx.strokeStyle = '#E6A100';
                                }
                                ctx.shadowColor = ctx.fillStyle;
                                ctx.shadowBlur = 12;
                            } else {
                                if (isEnd) {
                                    ctx.fillStyle = '#FF5252'; // Red/Pink for finish End
                                    ctx.strokeStyle = '#C62828';
                                } else {
                                    ctx.fillStyle = '#F1F3F5';
                                    ctx.strokeStyle = '#CED4DA';
                                }
                            }

                            ctx.lineWidth = 3;
                            ctx.fill();
                            ctx.stroke();

                            ctx.beginPath();
                            if (dot.connected) {
                                ctx.fillStyle = '#FFFFFF';
                                ctx.font = 'bold 12px "Fredoka", sans-serif';
                                ctx.textAlign = 'center';
                                ctx.textBaseline = 'middle';
                                ctx.fillText('✓', dot.x, dot.y);
                            } else {
                                if (isStart) {
                                    ctx.fillStyle = '#FFFFFF';
                                    ctx.font = 'bold 11px "Fredoka", sans-serif';
                                    ctx.textAlign = 'center';
                                    ctx.textBaseline = 'middle';
                                    ctx.fillText('Go', dot.x, dot.y);
                                } else if (isEnd) {
                                    ctx.fillStyle = '#FFFFFF';
                                    ctx.font = 'bold 11px "Fredoka", sans-serif';
                                    ctx.textAlign = 'center';
                                    ctx.textBaseline = 'middle';
                                    ctx.fillText('End', dot.x, dot.y);
                                } else {
                                    ctx.fillStyle = index === nextDotIndex ? '#4A3B00' : '#6C757D';
                                    ctx.font = 'bold 12px "Fredoka", sans-serif';
                                    ctx.textAlign = 'center';
                                    ctx.textBaseline = 'middle';
                                    ctx.fillText(index + 1, dot.x, dot.y);
                                }
                            }

                            ctx.restore();
                        });
                    }

                    function checkCollision(x, y) {
                        if (nextDotIndex >= targetDots.length) return;

                        const targetDot = targetDots[nextDotIndex];
                        const distSq = (targetDot.x - x) * (targetDot.x - x) + (targetDot.y - y) * (targetDot.y - y);

                        if (distSq < 28 * 28) { // 28px collision radius
                            targetDot.connected = true;
                            nextDotIndex++;
                            redrawCanvas();
                            updateInstructionBanner();
                            checkSuccess();
                        }
                    }

                    function playChimeSound(isFinal = false) {
                        try {
                            const audioCtx = new (window.AudioContext || window.webkitAudioContext)();
                            if (isFinal) {
                                // Two-tone happy chime for letter completion
                                const osc = audioCtx.createOscillator();
                                const gain = audioCtx.createGain();
                                osc.connect(gain);
                                gain.connect(audioCtx.destination);

                                osc.type = 'sine';
                                osc.frequency.setValueAtTime(523.25, audioCtx.currentTime); // C5
                                osc.frequency.setValueAtTime(659.25, audioCtx.currentTime + 0.15); // E5
                                osc.frequency.setValueAtTime(783.99, audioCtx.currentTime + 0.3); // G5
                                osc.frequency.setValueAtTime(1046.50, audioCtx.currentTime + 0.45); // C6

                                gain.gain.setValueAtTime(0.15, audioCtx.currentTime);
                                gain.gain.exponentialRampToValueAtTime(0.01, audioCtx.currentTime + 0.85);

                                osc.start(audioCtx.currentTime);
                                osc.stop(audioCtx.currentTime + 0.85);
                            } else {
                                // Soft high beep for single stroke completion
                                const osc = audioCtx.createOscillator();
                                const gain = audioCtx.createGain();
                                osc.connect(gain);
                                gain.connect(audioCtx.destination);

                                osc.type = 'sine';
                                osc.frequency.setValueAtTime(600, audioCtx.currentTime);
                                osc.frequency.exponentialRampToValueAtTime(900, audioCtx.currentTime + 0.15);

                                gain.gain.setValueAtTime(0.1, audioCtx.currentTime);
                                gain.gain.exponentialRampToValueAtTime(0.01, audioCtx.currentTime + 0.2);

                                osc.start(audioCtx.currentTime);
                                osc.stop(audioCtx.currentTime + 0.2);
                            }
                        } catch (e) {
                            console.log("Audio not supported or blocked by browser policy");
                        }
                    }

                    function handleStrokeCompleted() {
                        playChimeSound(false);

                        completedStrokes.push(currentStrokeIndex);
                        drawingStrokes = [];
                        currentStroke = null;

                        const guides = getActiveGuides(currentLetter);
                        if (completedStrokes.length >= guides.length) {
                            playChimeSound(true);
                            triggerSuccess();
                        } else {
                            currentStrokeIndex++;
                            generateTargetDots();
                            redrawCanvas();
                            resetIdleTimer();
                        }
                    }

                    function checkSuccess() {
                        const allConnected = targetDots.every(d => d.connected);
                        if (allConnected && !isCelebrated) {
                            handleStrokeCompleted();
                        }
                    }

                    function triggerSuccess() {
                        isCelebrated = true;
                        isDrawing = false;
                        stopHelperAnimation();

                        if (typeof confetti === 'function') {
                            confetti({
                                particleCount: 150,
                                spread: 85,
                                origin: { y: 0.6 }
                            });
                        }

                        currentSessionLevel++;
                        const overlay = document.getElementById('successOverlay');
                        const levelDisp = document.getElementById('levelDisplay');
                        if (levelDisp) levelDisp.innerText = currentSessionLevel;
                        document.getElementById('successText').innerText = `Fantastic Writing! You reached Level ${currentSessionLevel}!`;

                        fetch("{{ route('api.add_stars') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                stars: 20,
                                activity_name: 'Tracing Letter ' + currentLetter,
                                increase_level: true
                            })
                        });

                        overlay.style.opacity = '1';
                        overlay.style.pointerEvents = 'auto';

                        setTimeout(() => {
                            overlay.style.opacity = '0';
                            overlay.style.pointerEvents = 'none';

                            // Show the entertainment clip instead of auto-selecting the next letter
                            playEntertainmentClip();
                        }, 3800);
                    }

                    function triggerFail() {
                        const overlay = document.getElementById('failOverlay');
                        overlay.style.opacity = '1';
                        overlay.style.pointerEvents = 'auto';

                        setTimeout(() => {
                            hideFailOverlay();
                        }, 2500);
                    }

                    function hideFailOverlay() {
                        const overlay = document.getElementById('failOverlay');
                        overlay.style.opacity = '0';
                        overlay.style.pointerEvents = 'none';
                        clearCanvas();
                    }

                    function redrawCanvas() {
                        ctx.clearRect(0, 0, canvas.width, canvas.height);

                        // Draw centered background letter matching the guides
                        ctx.save();
                        let fontSize = canvas.height * 0.72;
                        if (currentCategory === 'hindi') fontSize = canvas.height * 0.58;
                        if (currentCategory === 'numbers' && currentLetter.length > 1) fontSize = canvas.height * 0.52;

                        ctx.font = `900 ${fontSize}px "Fredoka", sans-serif`;
                        ctx.fillStyle = 'rgba(140, 82, 255, 0.08)'; // Light purple background fill
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'middle';

                        const yOffset = (currentCategory === 'hindi') ? 0.435 : 0.495;
                        ctx.fillText(currentLetter, canvas.width / 2, canvas.height * yOffset);

                        if (currentCategory === 'hindi' && hindiPhonics[currentLetter]) {
                            ctx.save();
                            ctx.font = `bold ${canvas.height * 0.085}px "Fredoka", sans-serif`;
                            ctx.fillStyle = 'rgba(140, 82, 255, 0.28)';
                            ctx.fillText(`(${hindiPhonics[currentLetter]})`, canvas.width / 2, canvas.height * 0.78);
                            ctx.restore();
                        }
                        ctx.restore();

                        // 1. Draw completed strokes snapped perfectly to guide points
                        const guides = getActiveGuides(currentLetter);
                        if (guides) {
                            completedStrokes.forEach(strokeIdx => {
                                const guide = guides[strokeIdx];
                                if (!guide) return;

                                ctx.save();
                                ctx.beginPath();
                                ctx.moveTo(guide.points[0].x * canvas.width, guide.points[0].y * canvas.height);
                                for (let i = 1; i < guide.points.length; i++) {
                                    ctx.lineTo(guide.points[i].x * canvas.width, guide.points[i].y * canvas.height);
                                }
                                ctx.strokeStyle = '#8C52FF';
                                ctx.lineWidth = 18;
                                ctx.lineCap = 'round';
                                ctx.lineJoin = 'round';
                                ctx.stroke();
                                ctx.restore();
                            });
                        }

                        // 2. Draw guides (which handles active stroke dotted outline & future strokes faint outline)
                        drawGuides();

                        // 3. Draw target dots (active stroke dots)
                        drawTargetDots();

                        // 4. Draw user strokes (sketches in progress for the active stroke)
                        drawingStrokes.forEach(stroke => {
                            if (stroke.length < 2) return;
                            ctx.beginPath();
                            ctx.moveTo(stroke[0].x, stroke[0].y);
                            for (let i = 1; i < stroke.length; i++) {
                                ctx.lineTo(stroke[i].x, stroke[i].y);
                            }
                            ctx.strokeStyle = '#8C52FF';
                            ctx.lineWidth = 14;
                            ctx.lineCap = 'round';
                            ctx.lineJoin = 'round';
                            ctx.stroke();
                        });
                    }

                    document.addEventListener('DOMContentLoaded', () => {
                        // Read query parameter 'category'
                        const params = new URLSearchParams(window.location.search);
                        const categoryParam = params.get('category');
                        
                        if (categoryParam && categorySequences[categoryParam]) {
                            // If a valid category is passed, set it and show the tracing canvas directly
                            currentCategory = categoryParam;
                            currentCategoryList = categorySequences[currentCategory];
                            currentLetter = currentCategoryList[0];
                            
                            selectLetter(currentLetter);
                            showScreen('tracingBoardScreen');
                        } else {
                            showScreen('categorySelectionScreen');
                        }

                        updateTabStyles();
                        resizeCanvas();
                        window.addEventListener('resize', resizeCanvas);

                        canvas.addEventListener('mousedown', startDrawing);
                        canvas.addEventListener('mousemove', draw);
                        canvas.addEventListener('mouseup', stopDrawing);
                        canvas.addEventListener('mouseout', stopDrawing);

                        canvas.addEventListener('touchstart', startDrawingTouch);
                        canvas.addEventListener('touchmove', drawTouch);
                        canvas.addEventListener('touchend', stopDrawing);
                    });

                    function resizeCanvas() {
                        const rect = canvas.parentElement.getBoundingClientRect();
                        canvas.width = rect.width;
                        canvas.height = rect.height;

                        generateTargetDots();
                        drawingStrokes = [];
                        currentStroke = null;
                        redrawCanvas();
                        resetIdleTimer();
                    }

                    function selectLetter(letter) {
                        currentLetter = letter;
                        currentStrokeIndex = 0;
                        completedStrokes = [];
                        drawingStrokes = [];
                        currentStroke = null;

                        generateTargetDots();
                        clearCanvas();

                        // Restart helper animation
                        resetIdleTimer();
                    }

                    function startDrawing(e) {
                        if (isCelebrated) return;
                        resetIdleTimer();

                        const rect = canvas.getBoundingClientRect();
                        const x = e.clientX - rect.left;
                        const y = e.clientY - rect.top;

                        // Strict checking: must start near the active target dot
                        const activeDot = targetDots[nextDotIndex];
                        if (activeDot) {
                            const distSq = (activeDot.x - x) * (activeDot.x - x) + (activeDot.y - y) * (activeDot.y - y);
                            if (distSq > 55 * 55) { // 55px threshold for starting dot
                                const msg = currentCategory === 'hindi' ? "चमकते बिंदु से शुरू करें! 🌟" : "Start from the glowing dot! 🌟";
                                showPathWarning(msg);
                                playWarningSound();
                                return;
                            }
                        }

                        isDrawing = true;
                        strokeStartDotIndex = nextDotIndex; // Save where we started this stroke

                        // Get initial progress along the active guide stroke
                        const proj = getActiveStrokeProjection(x, y);
                        maxProgressReached = proj.progress;

                        currentStroke = [{ x, y }];
                        drawingStrokes.push(currentStroke);

                        checkCollision(x, y);
                    }

                    function draw(e) {
                        if (!isDrawing || !currentStroke) return;
                        resetIdleTimer();

                        const rect = canvas.getBoundingClientRect();
                        const x = e.clientX - rect.left;
                        const y = e.clientY - rect.top;

                        // Strict checking: must stay near the active stroke path and move forward
                        const proj = getActiveStrokeProjection(x, y);

                        // 1. Path deviation check (stricter 25px threshold)
                        if (proj.distance > 25) {
                            cancelCurrentStroke("Stay on the line! ✏️", "रेखा के ऊपर ही चलें! ✏️");
                            return;
                        }

                        // 2. Monotonic progress check (stricter 15px backtracking tolerance)
                        if (proj.progress < maxProgressReached - 15) {
                            cancelCurrentStroke("Draw in one direction! ✏️", "एक ही दिशा में लिखें! ✏️");
                            return;
                        }

                        // Update max progress if valid
                        if (proj.progress > maxProgressReached) {
                            maxProgressReached = proj.progress;
                        }

                        currentStroke.push({ x, y });
                        checkCollision(x, y);
                        redrawCanvas();
                    }

                    function startDrawingTouch(e) {
                        if (isCelebrated) return;
                        resetIdleTimer();

                        const rect = canvas.getBoundingClientRect();
                        const touch = e.touches[0];
                        const x = touch.clientX - rect.left;
                        const y = touch.clientY - rect.top;

                        // Strict checking: must start near the active target dot
                        const activeDot = targetDots[nextDotIndex];
                        if (activeDot) {
                            const distSq = (activeDot.x - x) * (activeDot.x - x) + (activeDot.y - y) * (activeDot.y - y);
                            if (distSq > 55 * 55) { // 55px threshold for starting dot
                                const msg = currentCategory === 'hindi' ? "चमकते बिंदु से शुरू करें! 🌟" : "Start from the glowing dot! 🌟";
                                showPathWarning(msg);
                                playWarningSound();
                                e.preventDefault();
                                return;
                            }
                        }

                        isDrawing = true;
                        strokeStartDotIndex = nextDotIndex; // Save where we started this stroke

                        // Get initial progress along the active guide stroke
                        const proj = getActiveStrokeProjection(x, y);
                        maxProgressReached = proj.progress;

                        currentStroke = [{ x, y }];
                        drawingStrokes.push(currentStroke);

                        e.preventDefault();
                        checkCollision(x, y);
                    }

                    function drawTouch(e) {
                        if (!isDrawing || !currentStroke) return;
                        resetIdleTimer();
                        const rect = canvas.getBoundingClientRect();
                        const touch = e.touches[0];
                        const x = touch.clientX - rect.left;
                        const y = touch.clientY - touch.target.getBoundingClientRect().top; // fix potential offset issues or clientY - rect.top
                        const yCorrected = touch.clientY - rect.top;

                        // Strict checking: must stay near the active stroke path and move forward
                        const proj = getActiveStrokeProjection(x, yCorrected);

                        // 1. Path deviation check (stricter 25px threshold)
                        if (proj.distance > 25) {
                            cancelCurrentStroke("Stay on the line! ✏️", "रेखा के ऊपर ही चलें! ✏️");
                            e.preventDefault();
                            return;
                        }

                        // 2. Monotonic progress check (stricter 15px backtracking tolerance)
                        if (proj.progress < maxProgressReached - 15) {
                            cancelCurrentStroke("Draw in one direction! ✏️", "एक ही दिशा में लिखें! ✏️");
                            e.preventDefault();
                            return;
                        }

                        // Update max progress if valid
                        if (proj.progress > maxProgressReached) {
                            maxProgressReached = proj.progress;
                        }

                        currentStroke.push({ x, y: yCorrected });
                        checkCollision(x, yCorrected);
                        redrawCanvas();
                        e.preventDefault();
                    }

                    function stopDrawing() {
                        isDrawing = false;
                        currentStroke = null;
                    }

                    function clearCanvas() {
                        drawingStrokes = [];
                        currentStroke = null;
                        currentStrokeIndex = 0;
                        completedStrokes = [];
                        nextDotIndex = 0;
                        generateTargetDots();
                        redrawCanvas();
                        resetIdleTimer();
                        updateInstructionBanner();
                    }

                    function updateInstructionBanner() {
                        const banner = document.getElementById('instructionBanner');
                        if (!banner) return;

                        let charLabel = currentLetter;
                        if (currentCategory === 'hindi' && hindiPhonics[currentLetter]) {
                            charLabel = `${currentLetter} (${hindiPhonics[currentLetter]})`;
                        }

                        const guides = getActiveGuides(currentLetter);
                        const totalStrokes = guides ? guides.length : 1;
                        const currentStrokeNum = currentStrokeIndex + 1;

                        if (completedStrokes.length === totalStrokes) {
                            banner.innerHTML = `Awesome! ${charLabel} completed! 🌟`;
                            banner.style.borderColor = "var(--color-green-real)";
                            banner.style.color = "var(--color-green-real)";
                            banner.style.boxShadow = "0 4px 0 var(--color-green-real-shadow)";
                        } else {
                            banner.innerHTML = `<strong style="color: var(--color-purple); font-weight: 900;">${charLabel}</strong>: Draw line <span style="color: #FF914D; font-size: 1.35rem; font-weight: 900;">${currentStrokeNum}</span> of <span style="color: var(--color-purple); font-size: 1.35rem; font-weight: 900;">${totalStrokes}</span>! Connect the dots. ✏️`;
                            banner.style.borderColor = "var(--color-purple)";
                            banner.style.color = "var(--color-purple)";
                            banner.style.boxShadow = "0 4px 0 var(--color-purple-shadow)";
                        }
                    }

                    function speakLetter() {
                        // Disabled
                    }

                    function submitTracing() {
                        const guides = getActiveGuides(currentLetter);
                        const letterCompleted = completedStrokes.length === guides.length;
                        if (letterCompleted) {
                            if (!isCelebrated) {
                                triggerSuccess();
                            }
                        } else {
                            triggerFail();
                        }
                    }

                    // Entertainment Clip & Mini Game States & Functions
                    let pendingNextLetter = null;
                    let musicInterval = null;
                    let audioCtxInstance = null;
                    let clipTimeout = null;

                    function playEntertainmentClip() {
                        // Determine next letter
                        const nextIdx = currentCategoryList.indexOf(currentLetter) + 1;
                        if (nextIdx < currentCategoryList.length) {
                            pendingNextLetter = currentCategoryList[nextIdx];
                        } else {
                            pendingNextLetter = currentCategoryList[0];
                        }

                        const clipOverlay = document.getElementById('entertainmentClipOverlay');
                        if (clipOverlay) {
                            clipOverlay.style.display = 'flex';
                        }

                        // Start synthesized music loop
                        startClipMusic();

                        // Auto-advance to the balloon pop game after 4.5 seconds (4500ms)
                        if (clipTimeout) clearTimeout(clipTimeout);
                        clipTimeout = setTimeout(() => {
                            transitionFromClipToGame();
                        }, 4500);
                    }

                    function startClipMusic() {
                        try {
                            const AudioContextClass = window.AudioContext || window.webkitAudioContext;
                            if (!AudioContextClass) return;

                            audioCtxInstance = new AudioContextClass();
                            const notes = [261.63, 329.63, 392.00, 523.25, 392.00, 329.63]; // C4, E4, G4, C5, G4, E4
                            let noteIndex = 0;

                            const playNote = () => {
                                if (!audioCtxInstance || audioCtxInstance.state === 'closed') return;

                                const osc = audioCtxInstance.createOscillator();
                                const gain = audioCtxInstance.createGain();
                                osc.connect(gain);
                                gain.connect(audioCtxInstance.destination);

                                osc.type = 'triangle'; // Sweet chime-like sound
                                osc.frequency.setValueAtTime(notes[noteIndex], audioCtxInstance.currentTime);

                                gain.gain.setValueAtTime(0.12, audioCtxInstance.currentTime);
                                gain.gain.exponentialRampToValueAtTime(0.01, audioCtxInstance.currentTime + 0.35);

                                osc.start();
                                osc.stop(audioCtxInstance.currentTime + 0.4);

                                noteIndex = (noteIndex + 1) % notes.length;
                            };

                            playNote();
                            musicInterval = setInterval(playNote, 250);
                        } catch (e) {
                            console.log("Web Audio not supported");
                        }
                    }

                    function stopClipMusic() {
                        if (musicInterval) {
                            clearInterval(musicInterval);
                            musicInterval = null;
                        }
                        if (audioCtxInstance) {
                            audioCtxInstance.close();
                            audioCtxInstance = null;
                        }
                    }

                    function skipEntertainmentClip() {
                        if (clipTimeout) clearTimeout(clipTimeout);
                        transitionFromClipToGame();
                    }

                    function transitionFromClipToGame() {
                        stopClipMusic();
                        const clipOverlay = document.getElementById('entertainmentClipOverlay');
                        if (clipOverlay) {
                            clipOverlay.style.display = 'none';
                        }
                        showMiniGame();
                    }

                    function showMiniGame() {
                        const miniGameOverlay = document.getElementById('miniGameOverlay');
                        const targetLetterSpan = document.getElementById('miniGameTargetLetter');
                        const balloonGrid = document.getElementById('miniGameBalloonGrid');
                        const feedback = document.getElementById('miniGameFeedback');

                        feedback.innerText = '';
                        targetLetterSpan.innerText = currentLetter;

                        // Build choices: 1 correct target, 4 distractors (5 targets total)
                        const options = [currentLetter];

                        // Generate distractors from current sequence
                        const distractorPool = currentCategoryList.filter(l => l !== currentLetter);
                        while (options.length < 5 && distractorPool.length > 0) {
                            const randIndex = Math.floor(Math.random() * distractorPool.length);
                            const choice = distractorPool.splice(randIndex, 1)[0];
                            if (!options.includes(choice)) {
                                options.push(choice);
                            }
                        }

                        // Shuffle the options
                        options.sort(() => Math.random() - 0.5);

                        // Populate target boards grid
                        balloonGrid.innerHTML = '';

                        options.forEach((letter, idx) => {
                            const target = document.createElement('div');
                            target.className = 'shooter-target';
                            target.innerText = letter;

                            // Set click and touch actions
                            const handleChoice = (e) => {
                                if (target.classList.contains('wrong-shake') || target.style.opacity === '0') return;

                                // Target dimensions
                                const targetRect = target.getBoundingClientRect();
                                const targetX = targetRect.left + targetRect.width / 2;
                                const targetY = targetRect.top + targetRect.height / 2;

                                // Blaster dimensions
                                const blaster = document.getElementById('shooterBlaster');
                                const blasterRect = blaster.getBoundingClientRect();
                                const gunX = blasterRect.left + blasterRect.width / 2;
                                const gunY = blasterRect.top + blasterRect.height / 2;

                                // Calculate rotation angle
                                const dx = targetX - gunX;
                                const dy = targetY - gunY;
                                const angleDeg = Math.atan2(dy, dx) * (180 / Math.PI);

                                // Rotate the blaster (with a 25deg correction offset)
                                blaster.style.transform = `rotate(${angleDeg + 25}deg)`;

                                // Calculate starting/ending relative coordinates inside parent container
                                const parent = document.getElementById('miniGameOverlay');
                                const parentRect = parent.getBoundingClientRect();
                                const startX = gunX - parentRect.left;
                                const startY = gunY - parentRect.top;
                                const endX = targetX - parentRect.left;
                                const endY = targetY - parentRect.top;

                                // Reset & Animate Bullet
                                const bullet = document.getElementById('shooterBullet');
                                bullet.style.left = `${startX}px`;
                                bullet.style.top = `${startY}px`;
                                bullet.style.display = 'block';

                                // Play custom synth laser zap sound
                                try {
                                    const audioCtx = new (window.AudioContext || window.webkitAudioContext)();
                                    const osc = audioCtx.createOscillator();
                                    const gain = audioCtx.createGain();
                                    osc.connect(gain);
                                    gain.connect(audioCtx.destination);
                                    osc.type = 'sawtooth';
                                    osc.frequency.setValueAtTime(800, audioCtx.currentTime);
                                    osc.frequency.exponentialRampToValueAtTime(150, audioCtx.currentTime + 0.25);
                                    gain.gain.setValueAtTime(0.08, audioCtx.currentTime);
                                    gain.gain.exponentialRampToValueAtTime(0.01, audioCtx.currentTime + 0.25);
                                    osc.start();
                                    osc.stop(audioCtx.currentTime + 0.25);
                                } catch (err) {}

                                const bulletAnim = bullet.animate([
                                    { left: `${startX}px`, top: `${startY}px` },
                                    { left: `${endX}px`, top: `${endY}px` }
                                ], {
                                    duration: 250,
                                    easing: 'ease-out'
                                });

                                bulletAnim.onfinish = () => {
                                    bullet.style.display = 'none';

                                    if (letter === currentLetter) {
                                        // Correct target hit
                                        if (window.SoundFX && typeof window.SoundFX.play === 'function') {
                                            window.SoundFX.play('pop');
                                        }

                                        target.style.transform = 'scale(0)';
                                        target.style.opacity = '0';
                                        feedback.innerHTML = '<span style="color: #2E7D32;">Target Destroyed! Level Up! 🎯</span>';

                                        if (window.SoundFX && typeof window.SoundFX.speak === 'function') {
                                            window.SoundFX.speak("Target destroyed", "en-US");
                                        }

                                        if (typeof confetti === 'function') {
                                            confetti({
                                                particleCount: 60,
                                                spread: 50,
                                                origin: { y: 0.8 }
                                            });
                                        }

                                        setTimeout(() => {
                                            closeMiniGameAndProceed();
                                            // Reset blaster rotation
                                            blaster.style.transform = 'rotate(-25deg)';
                                        }, 1200);
                                    } else {
                                        // Incorrect target hit
                                        if (window.SoundFX && typeof window.SoundFX.play === 'function') {
                                            window.SoundFX.play('click');
                                        }
                                        target.classList.add('wrong-shake');
                                        feedback.innerHTML = `<span style="color: #C62828;">Oops! Try again! Find Target ${currentLetter} 🎯</span>`;

                                        if (window.SoundFX && typeof window.SoundFX.speak === 'function') {
                                            window.SoundFX.speak("Try again", "en-US");
                                        }

                                        setTimeout(() => {
                                            target.classList.remove('wrong-shake');
                                        }, 500);
                                    }
                                };
                            };

                            target.onclick = (e) => {
                                handleChoice(e);
                            };
                            target.ontouchstart = (e) => {
                                handleChoice(e);
                                e.preventDefault();
                            };

                            balloonGrid.appendChild(target);
                        });

                        // Voice instructions
                        if (window.SoundFX && typeof window.SoundFX.speak === 'function') {
                            if (currentCategory === 'hindi') {
                                window.SoundFX.speak("निशाना लगाओ और अक्षर " + currentLetter + " को नष्ट करो", "hi-IN");
                            } else {
                                window.SoundFX.speak("Shoot the target letter " + currentLetter, "en-US");
                            }
                        }

                        miniGameOverlay.style.display = 'flex';
                    }

                    function skipMiniGame() {
                        if (window.SoundFX && typeof window.SoundFX.play === 'function') {
                            window.SoundFX.play('click');
                        }
                        closeMiniGameAndProceed();
                    }

                    function closeMiniGameAndProceed() {
                        const miniGameOverlay = document.getElementById('miniGameOverlay');
                        if (miniGameOverlay) {
                            miniGameOverlay.style.display = 'none';
                        }

                        // Advance to next letter
                        if (pendingNextLetter !== null) {
                            selectLetter(pendingNextLetter);
                        }

                        isCelebrated = false;
                    }

                </script>
@endsection