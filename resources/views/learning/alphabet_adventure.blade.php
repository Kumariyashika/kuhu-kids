@extends('layouts.app')

@section('title', 'Kuhu Kids Learning - Alphabet Adventure')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

    <style>
        /* Modern Premium Style for Alphabet Adventure SPA */
        .adventure-wrapper {
            width: 100%;
            max-width: 440px;
            margin: 0 auto;
            font-family: 'Fredoka', sans-serif;
            position: relative;
            background: linear-gradient(180deg, #A1E3FF 0%, #E3F8FF 100%);
            border-radius: 40px;
            overflow: hidden;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.2),
                        inset 0 -12px 0 rgba(0,0,0,0.1);
            border: 8px solid #2C3E50;
            aspect-ratio: 9/16;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
        }

        /* Glassmorphic elements */
        .glass-header {
            position: absolute;
            top: 20px;
            left: 20px;
            right: 20px;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-radius: 24px;
            padding: 12px 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 50;
            border: 3px solid rgba(255,255,255,0.7);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
        }

        .stat-pill {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 1.15rem;
            font-weight: 900;
            background: #FFF;
            padding: 4px 12px;
            border-radius: 16px;
            box-shadow: inset 0 -3px 0 rgba(0,0,0,0.1);
            border: 2px solid #E2E8F0;
        }

        /* App Screens states */
        .app-screen {
            width: 100%;
            height: 100%;
            position: relative;
            display: none;
            flex-direction: column;
            overflow: hidden;
            box-sizing: border-box;
        }

        .active-screen {
            display: flex;
        }

        /* Bouncy buttons */
        .btn-bounce {
            cursor: pointer;
            transition: transform 0.15s cubic-bezier(0.175, 0.885, 0.32, 1.275), box-shadow 0.15s;
            outline: none;
            border: none;
        }

        .btn-bounce:hover {
            transform: scale(1.05);
        }

        .btn-bounce:active {
            transform: scale(0.92) translateY(4px);
        }

        /* Home Screen Styling */
        .home-sky {
            height: 55%;
            position: relative;
            background: linear-gradient(180deg, #5CC8FF 0%, #A3E3FF 100%);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .home-rainbow {
            position: absolute;
            width: 140%;
            height: 140%;
            border-radius: 50%;
            border: 20px solid rgba(255,255,255,0.25);
            bottom: -70%;
            pointer-events: none;
        }

        .mascot-panda {
            z-index: 10;
            width: 150px;
            height: 150px;
            animation: pandaFloat 3s ease-in-out infinite alternate;
            cursor: pointer;
        }

        @keyframes pandaFloat {
            0% { transform: translateY(0) rotate(-3deg); }
            100% { transform: translateY(-12px) rotate(3deg); }
        }

        .home-ground {
            height: 45%;
            background: linear-gradient(180deg, #A7F08E 0%, #68D391 100%);
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border-top: 8px solid #55C37A;
        }

        /* Adventure winding road on map screen */
        .map-scroll-container {
            width: 100%;
            height: 100%;
            overflow-y: scroll;
            scroll-behavior: smooth;
            padding: 100px 20px 40px 20px;
            box-sizing: border-box;
            background: radial-gradient(circle at 50% 20%, #E3F8FF 0%, #C3F0FF 100%);
        }

        .map-scroll-container::-webkit-scrollbar {
            display: none; /* Hide scrollbar for clean app design */
        }

        .map-path-wrapper {
            position: relative;
            width: 100%;
            height: 1500px; /* Long winding map road */
        }

        .stone-node {
            position: absolute;
            width: 68px;
            height: 68px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: 900;
            color: white;
            box-shadow: 0 10px 0 var(--shadow-color),
                        inset 0 -4px 0 rgba(0,0,0,0.15),
                        0 12px 20px rgba(0,0,0,0.15);
            border: 4px solid #FFF;
            transform-origin: center;
            cursor: pointer;
            z-index: 20;
        }

        .stone-locked {
            background: #BDC3C7 !important;
            --shadow-color: #7F8C8D !important;
            cursor: not-allowed;
        }

        .stone-checked::after {
            content: '✓';
            position: absolute;
            bottom: -6px;
            right: -6px;
            background: #2ECC71;
            color: white;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            font-size: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid white;
            box-shadow: 0 3px 6px rgba(0,0,0,0.1);
        }

        /* 10s video screen layout */
        .video-container {
            width: 100%;
            height: 100%;
            background: #000;
            position: relative;
        }

        /* Tracing screen */
        .tracing-container {
            width: 100%;
            height: 100%;
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: radial-gradient(circle, #FAFFFA 0%, #E8F5E9 100%);
            padding-top: 80px;
            box-sizing: border-box;
        }

        .tracing-canvas-wrapper {
            position: relative;
            width: 320px;
            height: 420px;
            background: #FFF;
            border-radius: 28px;
            border: 6px solid #53B53C;
            box-shadow: 0 12px 0 rgba(83, 181, 60, 0.25);
            overflow: hidden;
        }

        #tracingCanvas {
            width: 100%;
            height: 100%;
            display: block;
        }

        .bee-helper {
            position: absolute;
            width: 44px;
            height: 44px;
            pointer-events: none;
            z-index: 10;
            transition: top 0.1s, left 0.1s;
        }

        /* Balloon Pop Game */
        .balloon-pop-wrapper {
            width: 100%;
            height: 100%;
            position: relative;
            background: linear-gradient(180deg, #E0F7FA 0%, #80DEEA 100%);
            padding-top: 80px;
            box-sizing: border-box;
        }

        .floating-balloon {
            position: absolute;
            width: 70px;
            height: 85px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
            font-weight: 900;
            color: white;
            box-shadow: inset -6px -6px 0 rgba(0,0,0,0.15),
                        0 10px 15px rgba(0,0,0,0.1);
            cursor: pointer;
            z-index: 15;
        }

        .floating-balloon::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            border-width: 6px;
            border-style: solid;
            border-color: inherit transparent transparent transparent;
        }

        .balloon-string {
            position: absolute;
            bottom: -35px;
            left: 50%;
            width: 2px;
            height: 30px;
            background: rgba(0,0,0,0.15);
        }

        /* Catch Game Basket */
        .catch-game-wrapper {
            width: 100%;
            height: 100%;
            position: relative;
            background: linear-gradient(180deg, #FFF9C4 0%, #FFF59D 100%);
            padding-top: 80px;
            box-sizing: border-box;
        }

        .falling-item {
            position: absolute;
            font-size: 2.5rem;
            z-index: 15;
        }

        .basket-sprite {
            position: absolute;
            bottom: 40px;
            width: 90px;
            height: 50px;
            background: #8D6E63;
            border-radius: 0 0 25px 25px;
            border: 4px solid #5D4037;
            box-shadow: inset 0 8px 0 rgba(255,255,255,0.2), 0 5px 10px rgba(0,0,0,0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            z-index: 20;
        }

        /* Memory game */
        .memory-game-wrapper {
            width: 100%;
            height: 100%;
            position: relative;
            background: linear-gradient(180deg, #F3E5F5 0%, #E1BEE7 100%);
            padding: 90px 20px 20px 20px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        .card-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            width: 100%;
            max-width: 280px;
            margin-top: 10px;
        }

        .memory-card {
            aspect-ratio: 1;
            background: #FFF;
            border-radius: 20px;
            border: 4px solid #8E24AA;
            box-shadow: 0 6px 0 rgba(142, 36, 170, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            font-weight: 900;
            cursor: pointer;
            position: relative;
            transform-style: preserve-3d;
            transition: transform 0.3s;
        }

        .memory-card-flipped {
            transform: rotateY(180deg);
        }

        .card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            background: #AB47BC;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            color: white;
            backface-visibility: hidden;
            z-index: 2;
        }

        .card-front {
            position: absolute;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            backface-visibility: hidden;
            transform: rotateY(180deg);
            background: #FFF;
            border-radius: 16px;
        }

        /* Reward Panel */
        .reward-overlay {
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, #FFFDF0 0%, #FFF5D1 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 30px;
            box-sizing: border-box;
        }

        .chest-box {
            width: 130px;
            height: 130px;
            animation: chestWobble 2.5s infinite alternate;
            cursor: pointer;
            margin-bottom: 20px;
        }

        @keyframes chestWobble {
            0% { transform: scale(1) rotate(-3deg); }
            50% { transform: scale(1.08) rotate(3deg); }
            100% { transform: scale(1) rotate(-3deg); }
        }

        /* Sticker Book Overlay view */
        .sticker-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            padding: 20px;
            overflow-y: scroll;
            height: 70%;
        }

        .sticker-grid::-webkit-scrollbar {
            display: none;
        }

        .sticker-item {
            aspect-ratio: 1;
            background: rgba(255,255,255,0.7);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            border: 2px dashed #BDC3C7;
            filter: grayscale(100%);
            opacity: 0.4;
        }

        .sticker-unlocked {
            background: #FFF;
            border: 3px solid #FFD54F;
            filter: grayscale(0%);
            opacity: 1;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            animation: popIn 0.3s ease;
        }

        @keyframes popIn {
            0% { transform: scale(0); }
            100% { transform: scale(1); }
        }
    </style>

    <div class="video-page-container">
        <!-- SPA Adventure View Frame wrapper -->
        <div class="adventure-wrapper">

            <!-- Shared Floating Glass Header (Star counter and Map toggle) -->
            <div class="glass-header" id="sharedHeader" style="display: none;">
                <button onclick="exitToScreen('map')" class="btn-bounce" style="background:none; border:none; font-size:1.8rem; padding:0; margin:0;">🗺️</button>
                <div style="display:flex; gap:10px;">
                    <div class="stat-pill">
                        <span style="color:#FBC02D;">⭐</span>
                        <span id="starCounter">0</span>
                    </div>
                    <div class="stat-pill">
                        <span style="color:#FFA726;">🪙</span>
                        <span id="coinCounter">0</span>
                    </div>
                </div>
                <button onclick="showStickersScreen()" class="btn-bounce" style="background:none; border:none; font-size:1.8rem; padding:0; margin:0;">🎁</button>
            </div>

            <!-- --- SCREEN 1: ADVENTURE HOME --- -->
            <div id="screenHome" class="app-screen active-screen">
                <div class="home-sky">
                    <div class="home-rainbow"></div>
                    <!-- Parallax moving clouds -->
                    <div class="cloud cloud-1" style="top: 30px; animation-duration: 25s;"></div>
                    <div class="cloud cloud-2" style="top: 80px; animation-duration: 35s; transform:scale(0.8);"></div>
                    
                    <!-- Talking Panda Mascot SVG -->
                    <div class="mascot-panda" onclick="speakPandaWelcome()">
                        <svg viewBox="0 0 100 100" width="100%" height="100%">
                            <!-- Ears -->
                            <circle cx="28" cy="28" r="14" fill="#2C3E50" />
                            <circle cx="28" cy="28" r="6" fill="#1A252F" />
                            <circle cx="72" cy="28" r="14" fill="#2C3E50" />
                            <circle cx="72" cy="28" r="6" fill="#1A252F" />
                            <!-- Face -->
                            <circle cx="50" cy="55" r="32" fill="#FFFFFF" stroke="#BDC3C7" stroke-width="2" />
                            <!-- Eye Patches -->
                            <ellipse cx="38" cy="48" rx="8" ry="11" fill="#2C3E50" transform="rotate(-15, 38, 48)" />
                            <ellipse cx="62" cy="48" rx="8" ry="11" fill="#2C3E50" transform="rotate(15, 62, 48)" />
                            <!-- White eyes and pupils -->
                            <circle cx="39" cy="47" r="3.5" fill="#FFF" />
                            <circle cx="39" cy="47" r="1.5" fill="#000" />
                            <circle cx="61" cy="47" r="3.5" fill="#FFF" />
                            <circle cx="61" cy="47" r="1.5" fill="#000" />
                            <!-- Cheeks -->
                            <circle cx="26" cy="62" r="5" fill="rgba(255, 102, 196, 0.5)" />
                            <circle cx="74" cy="62" r="5" fill="rgba(255, 102, 196, 0.5)" />
                            <!-- Nose and mouth -->
                            <ellipse cx="50" cy="59" rx="5" ry="3" fill="#1A252F" />
                            <path d="M 46 62 Q 50 66 54 62" stroke="#1A252F" stroke-width="2" fill="none" stroke-linecap="round" />
                        </svg>
                    </div>
                </div>

                <div class="home-ground">
                    <h1 class="logo-title-3d" style="font-size: 2.2rem; margin-top: -30px; margin-bottom: 20px;">
                        <span class="logo-letter logo-letter-a">K</span>
                        <span class="logo-letter logo-letter-b">U</span>
                        <span class="logo-letter logo-letter-c">H</span>
                        <span class="logo-letter logo-letter-d">U</span>
                    </h1>
                    <div style="font-size: 1.5rem; font-weight: 900; color: #FFF; margin-bottom: 30px; text-shadow: 2px 2px 0px rgba(0,0,0,0.15);">Alphabet Adventure</div>

                    <button onclick="enterMapScreen()" class="btn-bounce btn-large" style="background:#FF66C4; border-bottom:8px solid #CC4E9C; color:white; width: 80%; padding:14px 0; font-size:1.6rem;">
                        Let's Play! 🎬🎮
                    </button>
                </div>
            </div>

            <!-- --- SCREEN 2: PROGRESS MAP --- -->
            <div id="screenMap" class="app-screen">
                <div class="map-scroll-container" id="mapScrollArea">
                    <div class="map-path-wrapper">
                        <!-- Winding dirt trail road -->
                        <svg viewBox="0 0 400 1500" preserveAspectRatio="none" style="position: absolute; top:0; left:0; width:100%; height:100%; z-index:1; pointer-events:none;">
                            <path d="M 200 1420 Q 50 1200 200 1000 T 200 600 T 200 180" fill="none" stroke="#8D6E63" stroke-width="48" stroke-linecap="round" />
                            <path d="M 200 1420 Q 50 1200 200 1000 T 200 600 T 200 180" fill="none" stroke="#FFF" stroke-width="4" stroke-dasharray="10,12" stroke-linecap="round" />
                        </svg>

                        <!-- Adventure Stones A to Z (Positions mapped along the trail path) -->
                        <div id="stoneNodesContainer"></div>
                    </div>
                </div>
            </div>

            <!-- --- SCREEN 3: CINEMATIC 10s VIDEO PLAYER --- -->
            <div id="screenVideo" class="app-screen">
                <div class="video-container">
                    <canvas id="animationCanvas" width="1080" height="1920" style="width:100%; height:100%; object-fit:cover;"></canvas>
                </div>
            </div>

            <!-- --- SCREEN 4: DOTTED LETTER TRACING --- -->
            <div id="screenTracing" class="app-screen">
                <div class="tracing-container">
                    <div style="font-size:1.5rem; font-weight:900; color:#2E7D32; margin-bottom:15px; text-shadow:1px 1px 0 #FFF;">Trace Letter <span id="tracingLetterLabel" style="font-size:2rem; color:#8C52FF;">A</span>! ✏️</div>
                    <div class="tracing-canvas-wrapper">
                        <canvas id="tracingCanvas" width="320" height="420"></canvas>
                        <!-- Bee Helper sprite -->
                        <div class="bee-helper" id="beeHelper">
                            <svg viewBox="0 0 100 100" width="100%" height="100%">
                                <circle cx="50" cy="50" r="18" fill="#FFDE59" stroke="#E6A100" stroke-width="2" />
                                <circle cx="44" cy="46" r="3" fill="#000" />
                                <circle cx="56" cy="46" r="3" fill="#000" />
                                <path d="M 48 56 Q 50 58 52 56" stroke="#000" stroke-width="2" fill="none" />
                                <!-- Wings -->
                                <ellipse cx="38" cy="30" rx="8" ry="12" fill="rgba(173,216,230,0.8)" transform="rotate(-30, 38, 30)" />
                                <ellipse cx="62" cy="30" rx="8" ry="12" fill="rgba(173,216,230,0.8)" transform="rotate(30, 62, 30)" />
                                <!-- Stripes -->
                                <path d="M 42 62 Q 50 64 58 62" stroke="#000" stroke-width="4" fill="none" />
                            </svg>
                        </div>
                    </div>
                    <div style="display:flex; gap:20px; margin-top:20px; width:80%;">
                        <button onclick="clearTracingCanvas()" class="btn-bounce btn-large" style="background:#FFA726; border-bottom:6px solid #FB8C00; color:white; font-size:1.1rem; padding:8px 0; flex:1;">Reset</button>
                        <button onclick="completeTracing()" class="btn-bounce btn-large" style="background:#7ED957; border-bottom:6px solid #63AA43; color:white; font-size:1.1rem; padding:8px 0; flex:1;">Done ✓</button>
                    </div>
                </div>
            </div>

            <!-- --- SCREEN 5: MINI GAMES --- -->
            <div id="screenGame" class="app-screen">
                <!-- Dynamic Game Content injected based on type -->
                
                <!-- Game A: Balloon Pop -->
                <div id="gamePop" class="balloon-pop-wrapper" style="display: none;">
                    <div style="text-align:center; font-size:1.4rem; font-weight:900; color:#006064; margin-bottom:10px;">Pop the Letter <span class="target-letter-game" style="color:#E040FB; font-size:2rem;">B</span>! 🎈</div>
                    <div id="balloonPopContainer" style="width:100%; height:80%; position:relative;"></div>
                </div>

                <!-- Game B: Catch Falling objects -->
                <div id="gameCatch" class="catch-game-wrapper" style="display: none;">
                    <div style="text-align:center; font-size:1.4rem; font-weight:900; color:#5D4037; margin-bottom:10px;">Catch <span class="target-word-game" style="color:#FF5252;">Apples</span>! 🍎</div>
                    <div id="catchGameContainer" style="width:100%; height:80%; position:relative;">
                        <div class="basket-sprite" id="basketSprite">🧺</div>
                    </div>
                </div>

                <!-- Game C: Memory Card Match -->
                <div id="gameMatch" class="memory-game-wrapper" style="display: none;">
                    <div style="text-align:center; font-size:1.4rem; font-weight:900; color:#4A148C;">Match the Pairs! 🧩</div>
                    <div class="card-grid" id="memoryCardGrid"></div>
                </div>
            </div>

            <!-- --- SCREEN 6: REWARD PANEL --- -->
            <div id="screenReward" class="app-screen">
                <div class="reward-overlay">
                    <h2 style="font-size: 2.2rem; font-weight:900; color:#FF914D; margin:0 0 10px 0; text-shadow:2px 2px 0 #FFF;">Good Job! 🎉</h2>
                    <p style="font-size: 1.15rem; color:#555; margin:0 0 20px 0;">Tap the chest to open your reward!</p>

                    <!-- Chest animation -->
                    <div class="chest-box" id="chestBox" onclick="openRewardChest()">
                        <svg viewBox="0 0 100 100" width="100%" height="100%">
                            <!-- Closed Chest -->
                            <rect x="15" y="45" width="70" height="40" fill="#8D6E63" stroke="#5D4037" stroke-width="4" rx="8" />
                            <path d="M 15 48 L 85 48" stroke="#5D4037" stroke-width="4" />
                            <!-- Metal bands -->
                            <rect x="25" y="45" width="8" height="40" fill="#FFD54F" />
                            <rect x="67" y="45" width="8" height="40" fill="#FFD54F" />
                            <!-- Chest Lid -->
                            <path d="M 15 45 C 15 25, 85 25, 85 45 Z" fill="#A1887F" stroke="#5D4037" stroke-width="4" />
                            <path d="M 25 28 C 28 32, 72 32, 75 28" stroke="#FFD54F" stroke-width="4" fill="none" />
                            <!-- Lock -->
                            <rect x="44" y="40" width="12" height="15" fill="#FFD54F" rx="3" stroke="#D28F00" stroke-width="2" />
                            <circle cx="50" cy="46" r="2.5" fill="#000" />
                        </svg>
                    </div>

                    <!-- Revealed Rewards -->
                    <div id="rewardDetails" style="display:none; flex-direction:column; align-items:center; gap:15px; animation:popIn 0.4s ease;">
                        <!-- Earned Sticker bubble -->
                        <div id="stickerRewardBubble" style="font-size: 4.5rem; background:white; border-radius:50%; width:110px; height:110px; display:flex; align-items:center; justify-content:center; border:5px solid #FFD54F; box-shadow:0 10px 20px rgba(0,0,0,0.12);">🍎</div>
                        
                        <div style="font-size:1.3rem; font-weight:800; color:#2E7D32;">Earned +10 Stars & +5 Coins!</div>
                        
                        <button onclick="claimRewardsAndNext()" class="btn-bounce btn-large" style="background:#7ED957; border-bottom:8px solid #63AA43; color:white; width: 180px; padding:10px 0; font-size:1.25rem;">
                            Next Letter! ➡️
                        </button>
                    </div>
                </div>
            </div>

            <!-- --- STICKERS SCREEN --- -->
            <div id="screenStickers" class="app-screen">
                <div style="padding:90px 20px 10px 20px; box-sizing:border-box; text-align:center; height:100%;">
                    <h2 style="font-size: 1.8rem; font-weight:900; color:#8C52FF; margin:0 0 15px 0;">My Sticker Book 📖</h2>
                    <div class="sticker-grid" id="stickerBookGrid"></div>
                    <button onclick="exitToScreen('map')" class="btn-bounce btn-large" style="background:#FF914D; border-bottom:6px solid #D97336; color:white; padding:10px 0; font-size:1.15rem; width:150px; margin: 15px auto 0 auto;">Back to Map</button>
                </div>
            </div>

        </div>
    </div>

    <!-- Interactive Game and Script Logic -->
    <script>
        // State catalog for the 26 letters
        const alphabetData = {
            'A': { word: 'Apple', emoji: '🍎', color: '#FF5757', shadow: '#C62828', gameType: 'catch' },
            'B': { word: 'Ball', emoji: '⚽', color: '#38B6FF', shadow: '#1B8EC7', gameType: 'pop' },
            'C': { word: 'Cat', emoji: '🐱', color: '#FF914D', shadow: '#D97336', gameType: 'match' },
            'D': { word: 'Dog', emoji: '🐶', color: '#7ED957', shadow: '#63AA43', gameType: 'pop' },
            'E': { word: 'Elephant', emoji: '🐘', color: '#8C52FF', shadow: '#6E3CD9', gameType: 'catch' },
            'F': { word: 'Fish', emoji: '🐟', color: '#00C2CB', shadow: '#0097A7', gameType: 'pop' },
            'G': { word: 'Grapes', emoji: '🍇', color: '#8C52FF', shadow: '#6E3CD9', gameType: 'catch' },
            'H': { word: 'Hen', emoji: '🐔', color: '#FF66C4', shadow: '#D94B9F', gameType: 'match' },
            'I': { word: 'Ice Cream', emoji: '🍦', color: '#FFD1A9', shadow: '#D9A173', gameType: 'catch' },
            'J': { word: 'Juice', emoji: '🧃', color: '#7ED957', shadow: '#63AA43', gameType: 'pop' },
            'K': { word: 'Kite', emoji: '🪁', color: '#38B6FF', shadow: '#1B8EC7', gameType: 'pop' },
            'L': { word: 'Lion', emoji: '🦁', color: '#FF914D', shadow: '#D97336', gameType: 'match' },
            'M': { word: 'Mango', emoji: '🥭', color: '#FFDE59', shadow: '#CCB143', gameType: 'catch' },
            'N': { word: 'Nest', emoji: '🪺', color: '#8D6E63', shadow: '#5D4037', gameType: 'match' },
            'O': { word: 'Orange', emoji: '🍊', color: '#FF914D', shadow: '#D97336', gameType: 'catch' },
            'P': { word: 'Parrot', emoji: '🦜', color: '#7ED957', shadow: '#63AA43', gameType: 'pop' },
            'Q': { word: 'Queen', emoji: '👑', color: '#8C52FF', shadow: '#6E3CD9', gameType: 'match' },
            'R': { word: 'Rabbit', emoji: '🐰', color: '#ECEFF1', shadow: '#B0BEC5', gameType: 'pop' },
            'S': { word: 'Sun', emoji: '☀️', color: '#FFDE59', shadow: '#CCB143', gameType: 'pop' },
            'T': { word: 'Tiger', emoji: '🐯', color: '#FF914D', shadow: '#D97336', gameType: 'match' },
            'U': { word: 'Umbrella', emoji: '☂️', color: '#38B6FF', shadow: '#1B8EC7', gameType: 'pop' },
            'V': { word: 'Van', emoji: '🚐', color: '#7ED957', shadow: '#63AA43', gameType: 'pop' },
            'W': { word: 'Watermelon', emoji: '🍉', color: '#FF5757', shadow: '#C62828', gameType: 'catch' },
            'X': { word: 'Xylophone', emoji: '🎵', color: '#FF66C4', shadow: '#D94B9F', gameType: 'match' },
            'Y': { word: 'Yak', emoji: '🦬', color: '#8D6E63', shadow: '#5D4037', gameType: 'pop' },
            'Z': { word: 'Zebra', emoji: '🦓', color: '#ECEFF1', shadow: '#B0BEC5', gameType: 'match' }
        };

        const alphabetList = Object.keys(alphabetData);

        // State Store variables
        let currentUnlockedIndex = 0;
        let selectedLetter = 'A';
        let starsCollected = 0;
        let coinsCollected = 0;
        let collectedStickers = [];

        // Tracing canvas details
        let tracingCanvas, tracingCtx;
        let isTracingDrawing = false;
        let tracingPathPoints = [];
        let tracingLetterCheckpoints = [];
        let beeHelperIndex = 0;

        // Bouncing details
        let animationFrameId = null;
        let canvas, ctx;
        let playInterval = null;
        let currentFrame = 0;
        const totalFrames = 300; // 10 seconds @ 30 FPS

        // Load data from LocalStorage
        function loadSaveData() {
            if (localStorage.getItem('adventure_unlocked_index')) {
                currentUnlockedIndex = parseInt(localStorage.getItem('adventure_unlocked_index'));
            }
            if (localStorage.getItem('adventure_stars')) {
                starsCollected = parseInt(localStorage.getItem('adventure_stars'));
            }
            if (localStorage.getItem('adventure_coins')) {
                coinsCollected = parseInt(localStorage.getItem('adventure_coins'));
            }
            if (localStorage.getItem('adventure_stickers')) {
                collectedStickers = JSON.parse(localStorage.getItem('adventure_stickers'));
            }
            
            // Sync UI HUD counters
            document.getElementById('starCounter').innerText = starsCollected;
            document.getElementById('coinCounter').innerText = coinsCollected;
        }

        // Save data to LocalStorage
        function saveGameData() {
            localStorage.setItem('adventure_unlocked_index', currentUnlockedIndex);
            localStorage.setItem('adventure_stars', starsCollected);
            localStorage.setItem('adventure_coins', coinsCollected);
            localStorage.setItem('adventure_stickers', JSON.stringify(collectedStickers));
        }

        // Speak Welcome Mascot Panda
        function speakPandaWelcome() {
            if (window.SoundFX && typeof window.SoundFX.speak === 'function') {
                window.SoundFX.speak("Hello! I am Koko! Let's go on an alphabet adventure! Click the play button to start!", 'en-US');
            }
        }

        // Swap screens helper
        function showScreen(screenId) {
            // Hide all
            document.querySelectorAll('.app-screen').forEach(el => el.classList.remove('active-screen'));
            // Show target
            document.getElementById(screenId).classList.add('active-screen');

            // Header display logic
            const header = document.getElementById('sharedHeader');
            if (screenId === 'screenHome' || screenId === 'screenVideo') {
                header.style.display = 'none';
            } else {
                header.style.display = 'flex';
            }

            // Stop animations if we exit video
            if (screenId !== 'screenVideo' && playInterval) {
                clearInterval(playInterval);
                playInterval = null;
            }
        }

        function enterMapScreen() {
            showScreen('screenMap');
            renderMapStones();
        }

        function exitToScreen(screenId) {
            showScreen(screenId === 'map' ? 'screenMap' : 'screenHome');
        }

        // Render A-Z stepping stone road
        function renderMapStones() {
            const container = document.getElementById('stoneNodesContainer');
            container.innerHTML = '';

            // Mapping nodes zig-zag coordinates
            let stonePositions = [];
            for (let i = 0; i < 26; i++) {
                // Alternates left and right
                let x = 160 + Math.sin(i * 0.95) * 110;
                let y = 1400 - (i * 52); // Starts from bottom to top
                stonePositions.push({ x: x, y: y });
            }

            alphabetList.forEach((letter, i) => {
                const stone = document.createElement('button');
                stone.className = 'stone-node btn-bounce';
                stone.style.left = stonePositions[i].x + 'px';
                stone.style.top = stonePositions[i].y + 'px';
                stone.innerText = letter;

                const colData = alphabetData[letter];
                stone.style.background = colData.color;
                stone.style.setProperty('--shadow-color', colData.shadow);

                // Check lock status
                if (i > currentUnlockedIndex) {
                    stone.classList.add('stone-locked');
                    stone.innerHTML = letter + ' 🔒';
                    stone.onclick = () => {
                        if (window.SoundFX) window.SoundFX.play('click');
                        speakTeacher("This letter is locked. Complete the previous letters first!");
                    };
                } else {
                    if (i < currentUnlockedIndex) {
                        stone.classList.add('stone-checked');
                    }
                    stone.onclick = () => startLetterAdventure(letter);
                }

                container.appendChild(stone);
            });

            // Auto-scroll to unlocked letter stone node
            setTimeout(() => {
                const scrollArea = document.getElementById('mapScrollArea');
                let targetY = stonePositions[currentUnlockedIndex].y - 250;
                scrollArea.scrollTop = targetY;
            }, 100);
        }

        // Speak teacher feedback helper
        function speakTeacher(text) {
            if (window.SoundFX && typeof window.SoundFX.speak === 'function') {
                window.SoundFX.speak(text, 'en-US');
            }
        }

        // Start adventure journey for a specific letter
        function startLetterAdventure(letter) {
            selectedLetter = letter;
            showScreen('screenVideo');
            initVideoCanvas();
        }

        // --- 10s ANIMATED VIDEO COMPONENT ---
        function initVideoCanvas() {
            canvas = document.getElementById('animationCanvas');
            ctx = canvas.getContext('2d');
            currentFrame = 0;

            const letterDetails = alphabetData[selectedLetter];

            // Local truck animation variables
            let vTruck = { x: -450, y: 1150, wheelRot: 0, doorOpen: 0 };
            let vLetter = { x: 0, y: 0, scale: 0, visible: false, waveAngle: 0 };
            let vObject = { x: 0, y: 0, scale: 0, visible: false, bounceY: 0 };
            let vSparkles = [];

            if (playInterval) clearInterval(playInterval);
            
            // Web Audio music triggers
            if (window.SoundFX) {
                window.SoundFX.init();
            }

            // Speak voice line guide
            setTimeout(() => {
                speakTeacher(selectedLetter + " for " + letterDetails.word + ".");
            }, 3000);

            // Synthesize children giggle and hello voiceover
            setTimeout(() => {
                if (window.SoundFX) window.SoundFX.play('cheer');
                speakTeacher(letterDetails.word + " says Hello!");
            }, 6800);

            playInterval = setInterval(() => {
                currentFrame++;
                if (currentFrame > totalFrames) {
                    clearInterval(playInterval);
                    playInterval = null;
                    // Transition to Tracing screen
                    initTracingCanvas();
                    return;
                }

                // DRAW BACKGROUND
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                let skyGrad = ctx.createLinearGradient(0,0,0,1920);
                skyGrad.addColorStop(0, '#A1E3FF');
                skyGrad.addColorStop(0.55, '#D4F3FF');
                skyGrad.addColorStop(0.75, '#FFF6E0');
                skyGrad.addColorStop(1, '#FFF5D6');
                ctx.fillStyle = skyGrad;
                ctx.fillRect(0,0,canvas.width,canvas.height);

                // Smiling Rainbow
                ctx.save();
                ctx.globalAlpha = 0.5;
                let rbCenterX = 540, rbCenterY = 900;
                let colors = ['#FF4D4D', '#FFA64D', '#FFFF4D', '#4DFF4D', '#4D94FF'];
                colors.reverse().forEach((color, i) => {
                    ctx.beginPath();
                    ctx.arc(rbCenterX, rbCenterY, 520 + (i * 24), Math.PI, 0, false);
                    ctx.strokeStyle = color;
                    ctx.lineWidth = 20;
                    ctx.stroke();
                });
                ctx.restore();

                // Rolling green hills
                ctx.save();
                ctx.beginPath();
                ctx.moveTo(-100, 1400);
                ctx.bezierCurveTo(300, 1200, 700, 1150, 1200, 1400);
                ctx.lineTo(1200, 1920);
                ctx.lineTo(-100, 1920);
                ctx.closePath();
                ctx.fillStyle = '#7ED957';
                ctx.fill();
                ctx.restore();

                // Perspective Road
                ctx.save();
                ctx.beginPath();
                ctx.moveTo(-100, 1950);
                ctx.lineTo(1200, 1950);
                ctx.lineTo(850, 1420);
                ctx.lineTo(230, 1420);
                ctx.closePath();
                ctx.fillStyle = '#B39DDB';
                ctx.fill();
                ctx.restore();

                // --- SCENE 1: Truck Enters (0-2s) ---
                if (currentFrame < 60) {
                    let t = currentFrame / 60;
                    let ease = 1 - Math.pow(1-t, 3);
                    vTruck.x = -450 + ease * 770; // stops at center
                    vTruck.wheelRot += 0.2;
                }
                // --- SCENE 2: Door Opens & Sparkles (2-3s) ---
                else if (currentFrame >= 60 && currentFrame < 90) {
                    let t = (currentFrame - 60) / 30;
                    vTruck.doorOpen = t * Math.PI * 0.6; // door swings open
                    
                    // Sparkles emitter
                    if (currentFrame === 70) {
                        for (let i = 0; i < 30; i++) {
                            vSparkles.push({
                                x: vTruck.x + 80,
                                y: vTruck.y + 150,
                                vx: (Math.random() - 0.2) * 10 + 2,
                                vy: -(Math.random() * 12 + 4),
                                size: Math.random() * 12 + 6,
                                alpha: 1
                            });
                        }
                    }
                }
                // --- SCENE 3: Letter jumps out & waves (3-5s) ---
                else if (currentFrame >= 90 && currentFrame < 150) {
                    vLetter.visible = true;
                    let t = (currentFrame - 90) / 40;
                    if (t <= 1) {
                        vLetter.x = (vTruck.x + 80) + t * 180;
                        vLetter.y = 1300 - (180 * Math.sin(t * Math.PI));
                        vLetter.scale = t;
                    } else {
                        vLetter.x = 420;
                        vLetter.y = 1380;
                        vLetter.scale = 1;
                        vLetter.waveAngle = Math.sin(currentFrame * 0.4) * 0.3;
                    }
                }
                // --- SCENE 4 & 5: Object appears & bounces (5-8.5s) ---
                else if (currentFrame >= 150 && currentFrame < 255) {
                    vLetter.x = 400;
                    vLetter.y = 1380;
                    vLetter.scale = 1;

                    vObject.visible = true;
                    let t = (currentFrame - 150) / 35;
                    if (t <= 1) {
                        vObject.x = 680;
                        vObject.y = 2000 - t * 620; // rises up
                        vObject.scale = t;
                    } else {
                        vObject.x = 680;
                        vObject.scale = 1;
                        let bounce = Math.abs(Math.sin((currentFrame - 185) * 0.3)) * 40;
                        vObject.y = 1380 - bounce;
                        vLetter.y = 1380 - bounce;
                    }
                }
                // --- SCENE 6: Letter jumps back & truck exit (8.5-10s) ---
                else if (currentFrame >= 255) {
                    let t = (currentFrame - 255) / 20;
                    if (t <= 1) {
                        // Letter jumps back
                        vLetter.x = 400 - t * 280;
                        vLetter.y = 1380 - (200 * Math.sin(t * Math.PI));
                        vTruck.doorOpen = (1 - t) * Math.PI * 0.6; // door closes
                        if (t > 0.9) vLetter.visible = false;
                    } else {
                        vTruck.doorOpen = 0;
                        // Truck drives away to right
                        let t2 = (currentFrame - 275) / 25;
                        vTruck.x = 320 + Math.pow(t2, 2) * 800;
                        vTruck.wheelRot += 0.35;
                    }
                }

                // Render Sparkles
                vSparkles.forEach((s, index) => {
                    s.vy += 0.3; // gravity
                    s.x += s.vx;
                    s.y += s.vy;
                    s.alpha -= 0.03;
                    if (s.alpha <= 0) {
                        vSparkles.splice(index, 1);
                        return;
                    }
                    ctx.save();
                    ctx.globalAlpha = s.alpha;
                    ctx.beginPath();
                    ctx.arc(s.x, s.y, s.size, 0, Math.PI*2);
                    ctx.fillStyle = '#FFDE59';
                    ctx.fill();
                    ctx.restore();
                });

                // DRAW THE TRUCK
                ctx.save();
                ctx.translate(vTruck.x, vTruck.y);
                // Chassis red box
                ctx.fillStyle = '#FF5252';
                ctx.beginPath();
                ctx.roundRect(40, 10, 240, 220, 15);
                ctx.fill();
                // Cab yellow box
                ctx.fillStyle = '#FFDE59';
                ctx.beginPath();
                ctx.roundRect(280, 70, 120, 160, 20);
                ctx.fill();
                // Windshield
                ctx.fillStyle = '#B3E5FC';
                ctx.beginPath();
                ctx.roundRect(310, 85, 80, 60, 8);
                ctx.fill();
                // Eyes blinking on windshield
                let blink = Math.sin(currentFrame * 0.1) > 0.9 ? 1 : 0;
                drawCartoonEye(ctx, 335, 115, 8, blink, 0, 0);
                drawCartoonEye(ctx, 365, 115, 8, blink, 0, 0);
                // Bumper smile
                ctx.beginPath();
                ctx.arc(380, 185, 12, 0, Math.PI, false);
                ctx.strokeStyle = '#4A3B00';
                ctx.lineWidth = 4;
                ctx.stroke();

                // Door swing
                if (vTruck.doorOpen > 0) {
                    ctx.save();
                    ctx.translate(40, 120);
                    ctx.rotate(-vTruck.doorOpen);
                    ctx.fillStyle = '#D32F2F';
                    ctx.fillRect(-90, -100, 90, 200);
                    ctx.restore();
                }

                // Wheels
                let drawSimpleWheel = (wx, wy) => {
                    ctx.save();
                    ctx.translate(wx, wy);
                    ctx.rotate(vTruck.wheelRot);
                    ctx.beginPath();
                    ctx.arc(0, 0, 42, 0, Math.PI*2);
                    ctx.fillStyle = '#37474F';
                    ctx.fill();
                    ctx.beginPath();
                    ctx.arc(0, 0, 18, 0, Math.PI*2);
                    ctx.fillStyle = '#FFD54F';
                    ctx.fill();
                    ctx.restore();
                };
                drawSimpleWheel(100, 230);
                drawSimpleWheel(320, 230);
                ctx.restore();

                // DRAW THE SHINY LETTER A-Z
                if (vLetter.visible) {
                    ctx.save();
                    ctx.translate(vLetter.x, vLetter.y);
                    ctx.scale(vLetter.scale, vLetter.scale);
                    // Letter Body shadow
                    ctx.font = '900 180px "Fredoka", sans-serif';
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle';
                    ctx.fillStyle = letterDetails.color;
                    ctx.strokeStyle = '#FFF';
                    ctx.lineWidth = 12;
                    ctx.strokeText(selectedLetter, 0, -100);
                    ctx.fillText(selectedLetter, 0, -100);

                    // Cute eyes on Letter
                    drawCartoonEye(ctx, -20, -120, 10, 0, 0.2, 0);
                    drawCartoonEye(ctx, 20, -120, 10, 0, 0.2, 0);
                    // smile
                    ctx.beginPath();
                    ctx.arc(0, -95, 8, 0, Math.PI, false);
                    ctx.strokeStyle = '#000';
                    ctx.lineWidth = 3;
                    ctx.stroke();

                    // Wave hand
                    ctx.save();
                    ctx.translate(40, -90);
                    ctx.rotate(vLetter.waveAngle + 0.6);
                    ctx.strokeStyle = '#FFF';
                    ctx.lineWidth = 8;
                    ctx.lineCap = 'round';
                    ctx.beginPath();
                    ctx.moveTo(0,0);
                    ctx.lineTo(25, -20);
                    ctx.stroke();
                    ctx.restore();
                    ctx.restore();
                }

                // DRAW THE OBJECT
                if (vObject.visible) {
                    ctx.save();
                    ctx.translate(vObject.x, vObject.y);
                    ctx.scale(vObject.scale, vObject.scale);
                    
                    // Render simple circular shadow
                    ctx.beginPath();
                    ctx.ellipse(0, 10, 60, 12, 0, 0, Math.PI*2);
                    ctx.fillStyle = 'rgba(0,0,0,0.12)';
                    ctx.fill();

                    // Draw target emoji object or simplified drawing. Using emojis inside canvas text works wonderfully and looks extremely bright!
                    ctx.font = '130px "Fredoka", sans-serif';
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle';
                    ctx.fillText(letterDetails.emoji, 0, -65);
                    ctx.restore();
                }

                // TOP LETTER BANNER (no overlays except the letter A itself)
                if (currentFrame >= 90 && currentFrame <= 255) {
                    ctx.save();
                    ctx.font = '900 160px "Fredoka", sans-serif';
                    ctx.textAlign = 'center';
                    ctx.fillStyle = '#FFF';
                    ctx.strokeStyle = letterDetails.color;
                    ctx.lineWidth = 14;
                    ctx.strokeText(selectedLetter, 540, 300);
                    ctx.fillText(selectedLetter, 540, 300);
                    ctx.restore();
                }

            }, 33);
        }

        // --- SCREEN 4: DOTTED LETTER TRACING ENGINE ---
        // Basic checkpoints for tracing coordinates per letter
        const letterCheckpoints = {
            'A': [{x:160, y:80}, {x:80, y:340}, {x:240, y:340}, {x:160, y:230}],
            'B': [{x:80, y:80}, {x:80, y:340}, {x:200, y:140}, {x:200, y:280}],
            'C': [{x:240, y:120}, {x:120, y:80}, {x:120, y:340}, {x:240, y:300}],
            'D': [{x:80, y:80}, {x:80, y:340}, {x:220, y:210}],
            'E': [{x:220, y:80}, {x:80, y:80}, {x:80, y:210}, {x:80, y:340}],
            'F': [{x:220, y:80}, {x:80, y:80}, {x:80, y:210}, {x:80, y:340}],
            'G': [{x:240, y:120}, {x:120, y:80}, {x:120, y:340}, {x:200, y:210}],
            'H': [{x:80, y:80}, {x:80, y:340}, {x:240, y:80}, {x:240, y:340}],
            'I': [{x:160, y:80}, {x:160, y:340}],
            'J': [{x:220, y:80}, {x:160, y:340}, {x:100, y:300}],
            'K': [{x:80, y:80}, {x:80, y:340}, {x:220, y:80}, {x:220, y:340}],
            'L': [{x:80, y:80}, {x:80, y:340}, {x:220, y:340}],
            'M': [{x:80, y:340}, {x:80, y:80}, {x:160, y:210}, {x:240, y:80}, {x:240, y:340}],
            'N': [{x:80, y:340}, {x:80, y:80}, {x:240, y:340}, {x:240, y:80}],
            'O': [{x:160, y:80}, {x:80, y:210}, {x:160, y:340}, {x:240, y:210}],
            'P': [{x:80, y:340}, {x:80, y:80}, {x:200, y:140}],
            'Q': [{x:160, y:80}, {x:80, y:210}, {x:160, y:340}, {x:220, y:300}],
            'R': [{x:80, y:340}, {x:80, y:80}, {x:200, y:140}, {x:220, y:340}],
            'S': [{x:220, y:120}, {x:160, y:80}, {x:160, y:210}, {x:160, y:340}],
            'T': [{x:80, y:80}, {x:240, y:80}, {x:160, y:80}, {x:160, y:340}],
            'U': [{x:80, y:80}, {x:80, y:280}, {x:160, y:340}, {x:240, y:280}, {x:240, y:80}],
            'V': [{x:80, y:80}, {x:160, y:340}, {x:240, y:80}],
            'W': [{x:80, y:80}, {x:120, y:340}, {x:160, y:210}, {x:200, y:340}, {x:240, y:80}],
            'X': [{x:80, y:80}, {x:240, y:340}, {x:240, y:80}, {x:80, y:340}],
            'Y': [{x:80, y:80}, {x:160, y:210}, {x:240, y:80}, {x:160, y:340}],
            'Z': [{x:80, y:80}, {x:240, y:80}, {x:80, y:340}, {x:240, y:340}]
        };

        function initTracingCanvas() {
            showScreen('screenTracing');
            document.getElementById('tracingLetterLabel').innerText = selectedLetter;

            tracingCanvas = document.getElementById('tracingCanvas');
            tracingCtx = tracingCanvas.getContext('tracingCtx');
            if (!tracingCtx) tracingCtx = tracingCanvas.getContext('2d');

            tracingPathPoints = [];
            beeHelperIndex = 0;

            // Load checkpoints of target letter
            tracingLetterCheckpoints = letterCheckpoints[selectedLetter] || [{x:160,y:210}];
            // Mark checkpoints as not-yet-touched
            tracingLetterCheckpoints.forEach(cp => cp.touched = false);

            drawTracingBase();
            positionBeeHelper();

            // Set Speech Guide voice
            speakTeacher("Trace the letter " + selectedLetter + " with your finger! Start from the bee!");

            // Event Listeners for tracing
            tracingCanvas.onmousedown = startTraceDrag;
            tracingCanvas.onmousemove = continueTraceDrag;
            tracingCanvas.onmouseup = stopTraceDrag;

            tracingCanvas.ontouchstart = (e) => {
                e.preventDefault();
                let touch = e.touches[0];
                startTraceDrag(getTouchPos(touch));
            };
            tracingCanvas.ontouchmove = (e) => {
                e.preventDefault();
                let touch = e.touches[0];
                continueTraceDrag(getTouchPos(touch));
            };
            tracingCanvas.ontouchend = stopTraceDrag;
        }

        function getTouchPos(touch) {
            let rect = tracingCanvas.getBoundingClientRect();
            return {
                clientX: touch.clientX,
                clientY: touch.clientY
            };
        }

        function positionBeeHelper() {
            const bee = document.getElementById('beeHelper');
            let nextIndex = tracingLetterCheckpoints.findIndex(cp => !cp.touched);
            if (nextIndex === -1) nextIndex = 0;
            let targetPoint = tracingLetterCheckpoints[nextIndex];
            
            bee.style.left = (targetPoint.x - 22) + 'px';
            bee.style.top = (targetPoint.y - 22) + 'px';
        }

        // Draw static dotted outlines in gray
        function drawTracingBase() {
            tracingCtx.clearRect(0, 0, tracingCanvas.width, tracingCanvas.height);

            // Draw letter guidelines
            tracingCtx.save();
            tracingCtx.font = '900 320px "Fredoka", sans-serif';
            tracingCtx.textAlign = 'center';
            tracingCtx.textBaseline = 'middle';
            
            // Outer dashed letter contour outline
            tracingCtx.strokeStyle = '#BDC3C7';
            tracingCtx.lineWidth = 12;
            tracingCtx.setLineDash([10, 12]);
            tracingCtx.strokeText(selectedLetter, 160, 210);

            // Light gray filled baseline guide
            tracingCtx.fillStyle = 'rgba(236, 240, 241, 0.5)';
            tracingCtx.fillText(selectedLetter, 160, 210);
            tracingCtx.restore();

            // Draw guidelines arrows/dots for checkpoints
            tracingLetterCheckpoints.forEach((cp, i) => {
                tracingCtx.beginPath();
                tracingCtx.arc(cp.x, cp.y, 14, 0, Math.PI*2);
                tracingCtx.fillStyle = cp.touched ? '#2ECC71' : 'rgba(142, 68, 173, 0.15)';
                tracingCtx.fill();
            });
        }

        function startTraceDrag(e) {
            isTracingDrawing = true;
            addTracePoint(e);
        }

        function continueTraceDrag(e) {
            if (!isTracingDrawing) return;
            addTracePoint(e);
        }

        function stopTraceDrag() {
            isTracingDrawing = false;
        }

        function addTracePoint(e) {
            let rect = tracingCanvas.getBoundingClientRect();
            let x = (e.clientX - rect.left) * (tracingCanvas.width / rect.width);
            let y = (e.clientY - rect.top) * (tracingCanvas.height / rect.height);

            tracingPathPoints.push({ x: x, y: y });

            // Check if user touches any checkpoint
            tracingLetterCheckpoints.forEach(cp => {
                let dist = Math.hypot(x - cp.x, y - cp.y);
                if (dist < 40) { // 40px radius threshold
                    if (!cp.touched) {
                        cp.touched = true;
                        if (window.SoundFX) window.SoundFX.play('click');
                        positionBeeHelper();
                    }
                }
            });

            // Re-draw canvas with rainbow path
            drawTracingBase();

            if (tracingPathPoints.length > 1) {
                tracingCtx.save();
                tracingCtx.lineCap = 'round';
                tracingCtx.lineJoin = 'round';
                
                // Tracing line drawing: Rainbow gradient path
                let brushGrad = tracingCtx.createLinearGradient(0,0,320,420);
                brushGrad.addColorStop(0, '#FF4D4D');
                brushGrad.addColorStop(0.3, '#FFA64D');
                brushGrad.addColorStop(0.5, '#FFFF4D');
                brushGrad.addColorStop(0.7, '#4DFF4D');
                brushGrad.addColorStop(1, '#8C52FF');
                
                tracingCtx.strokeStyle = brushGrad;
                tracingCtx.lineWidth = 26;

                tracingCtx.beginPath();
                tracingCtx.moveTo(tracingPathPoints[0].x, tracingPathPoints[0].y);
                for (let i = 1; i < tracingPathPoints.length; i++) {
                    tracingCtx.lineTo(tracingPathPoints[i].x, tracingPathPoints[i].y);
                }
                tracingCtx.stroke();
                tracingCtx.restore();
            }

            // Auto-complete if all checkpoints are touched
            let allTouched = tracingLetterCheckpoints.every(cp => cp.touched);
            if (allTouched) {
                isTracingDrawing = false;
                setTimeout(() => {
                    completeTracing();
                }, 400);
            }
        }

        function clearTracingCanvas() {
            tracingPathPoints = [];
            tracingLetterCheckpoints.forEach(cp => cp.touched = false);
            drawTracingBase();
            positionBeeHelper();
        }

        function completeTracing() {
            // Trigger Confetti
            if (typeof confetti === 'function') {
                confetti({ particleCount: 80, spread: 60, origin: { y: 0.7 } });
            }
            if (window.SoundFX) window.SoundFX.play('success');
            speakTeacher("Fantastic writing!");

            setTimeout(() => {
                // Launch mini game Screen
                startMiniGame();
            }, 1000);
        }

        // --- SCREEN 5: ALPHABET MINI GAME ENGINE ---
        let gameTimerId = null;
        let gameScore = 0;
        let catchBasketX = 160;

        function startMiniGame() {
            showScreen('screenGame');

            // Hide all sub-games
            document.getElementById('gamePop').style.display = 'none';
            document.getElementById('gameCatch').style.display = 'none';
            document.getElementById('gameMatch').style.display = 'none';

            if (gameTimerId) {
                clearInterval(gameTimerId);
                gameTimerId = null;
            }

            const letterDetails = alphabetData[selectedLetter];
            
            // Choose game type based on index / data
            let gameType = letterDetails.gameType;
            if (gameType === 'pop') {
                launchPopGame();
            } else if (gameType === 'catch') {
                launchCatchGame();
            } else {
                launchMatchGame();
            }
        }

        // Game 1: Balloon Pop
        function launchPopGame() {
            document.getElementById('gamePop').style.display = 'block';
            document.querySelectorAll('.target-letter-game').forEach(el => el.innerText = selectedLetter);

            const container = document.getElementById('balloonPopContainer');
            container.innerHTML = '';
            gameScore = 0;

            let letters = ['X', 'Y', 'Z', 'M', 'P', 'R', selectedLetter];
            
            gameTimerId = setInterval(() => {
                const balloon = document.createElement('div');
                balloon.className = 'floating-balloon btn-bounce';
                
                let randomLetter = letters[Math.floor(Math.random() * letters.length)];
                balloon.innerText = randomLetter;

                // Random pastel background color
                let colors = ['#FF66C4', '#38B6FF', '#FFDE59', '#7ED957', '#8C52FF'];
                let color = colors[Math.floor(Math.random() * colors.length)];
                balloon.style.background = color;
                balloon.style.borderColor = color;

                balloon.style.left = (Math.random() * 260 + 20) + 'px';
                balloon.style.top = '500px';

                // Add pop string line
                const str = document.createElement('div');
                str.className = 'balloon-string';
                balloon.appendChild(str);

                balloon.onclick = () => {
                    if (balloon.innerText === selectedLetter) {
                        // Correct!
                        if (window.SoundFX) window.SoundFX.play('pop');
                        balloon.remove();
                        gameScore++;
                        if (gameScore >= 3) {
                            // Completed!
                            clearInterval(gameTimerId);
                            winGame();
                        }
                    } else {
                        // Wrong letter
                        if (window.SoundFX) window.SoundFX.play('click');
                        balloon.style.transform = 'translateX(5px)';
                        setTimeout(() => { balloon.style.transform = 'none'; }, 100);
                    }
                };

                container.appendChild(balloon);

                // Animate balloon rising
                let topPos = 500;
                let moveInterval = setInterval(() => {
                    topPos -= 3;
                    balloon.style.top = topPos + 'px';
                    if (topPos < -100) {
                        clearInterval(moveInterval);
                        balloon.remove();
                    }
                }, 33);

            }, 1200);
        }

        // Game 2: Catch Falling Fruit/Items in basket
        function launchCatchGame() {
            document.getElementById('gameCatch').style.display = 'block';
            document.querySelector('.target-word-game').innerText = alphabetData[selectedLetter].word + 's';

            const container = document.getElementById('catchGameContainer');
            // Remove previous items
            container.querySelectorAll('.falling-item').forEach(el => el.remove());

            gameScore = 0;
            catchBasketX = 160;
            const basket = document.getElementById('basketSprite');
            basket.style.left = catchBasketX + 'px';
            basket.innerText = '🧺';

            // Drag event to slide basket
            container.onmousemove = (e) => {
                let rect = container.getBoundingClientRect();
                let x = e.clientX - rect.left - 45;
                if (x < 10) x = 10;
                if (x > 310) x = 310;
                catchBasketX = x;
                basket.style.left = catchBasketX + 'px';
            };

            container.ontouchmove = (e) => {
                e.preventDefault();
                let touch = e.touches[0];
                let rect = container.getBoundingClientRect();
                let x = touch.clientX - rect.left - 45;
                if (x < 10) x = 10;
                if (x > 310) x = 310;
                catchBasketX = x;
                basket.style.left = catchBasketX + 'px';
            };

            const itemEmoji = alphabetData[selectedLetter].emoji;

            gameTimerId = setInterval(() => {
                const item = document.createElement('div');
                item.className = 'falling-item';
                
                // 80% chance of target item, 20% rock bomb
                let isBomb = Math.random() < 0.25;
                item.innerText = isBomb ? '💣' : itemEmoji;

                item.style.left = (Math.random() * 260 + 20) + 'px';
                item.style.top = '0px';
                container.appendChild(item);

                let topY = 0;
                let fall = setInterval(() => {
                    topY += 4;
                    item.style.top = topY + 'px';

                    // Collision detection with basket (basket Y around 320px)
                    if (topY >= 310 && topY <= 340) {
                        let itemX = parseInt(item.style.left);
                        if (itemX >= catchBasketX - 25 && itemX <= catchBasketX + 85) {
                            // Caught!
                            clearInterval(fall);
                            item.remove();
                            if (isBomb) {
                                if (window.SoundFX) window.SoundFX.play('click');
                                speakTeacher("Oops! Avoid the bomb!");
                            } else {
                                if (window.SoundFX) window.SoundFX.play('click');
                                gameScore++;
                                if (gameScore >= 3) {
                                    clearInterval(gameTimerId);
                                    winGame();
                                }
                            }
                        }
                    }

                    if (topY > 400) {
                        clearInterval(fall);
                        item.remove();
                    }
                }, 33);

            }, 1500);
        }

        // Game 3: Memory Match Pairs
        function launchMatchGame() {
            document.getElementById('gameMatch').style.display = 'flex';
            const grid = document.getElementById('memoryCardGrid');
            grid.innerHTML = '';

            const letterDetails = alphabetData[selectedLetter];
            let cardsData = [
                { id: 1, type: 'letter', content: selectedLetter },
                { id: 1, type: 'emoji', content: letterDetails.emoji },
                { id: 2, type: 'letter2', content: '🌟' },
                { id: 2, type: 'emoji2', content: '✨' }
            ];

            // Shuffle cards
            cardsData.sort(() => Math.random() - 0.5);

            let flippedCards = [];
            let matchesFound = 0;

            cardsData.forEach((data, index) => {
                const card = document.createElement('div');
                card.className = 'memory-card btn-bounce';
                card.setAttribute('data-id', data.id);

                card.innerHTML = `
                    <div class="card-back">❓</div>
                    <div class="card-front">${data.content}</div>
                `;

                card.onclick = () => {
                    if (card.classList.contains('memory-card-flipped') || flippedCards.length >= 2) return;

                    if (window.SoundFX) window.SoundFX.play('click');
                    card.classList.add('memory-card-flipped');
                    flippedCards.push(card);

                    if (flippedCards.length === 2) {
                        let id1 = flippedCards[0].getAttribute('data-id');
                        let id2 = flippedCards[1].getAttribute('data-id');

                        if (id1 === id2) {
                            // Match!
                            matchesFound++;
                            flippedCards = [];
                            if (matchesFound >= 2) {
                                setTimeout(() => { winGame(); }, 800);
                            }
                        } else {
                            // Not a match, flip back
                            setTimeout(() => {
                                flippedCards.forEach(c => c.classList.remove('memory-card-flipped'));
                                flippedCards = [];
                            }, 1000);
                        }
                    }
                };

                grid.appendChild(card);
            });
        }

        function winGame() {
            if (window.SoundFX) window.SoundFX.play('success');
            speakTeacher("You won! Open your chest!");
            
            showScreen('screenReward');
            
            // Reset chest state
            const chest = document.getElementById('chestBox');
            chest.style.display = 'block';
            document.getElementById('rewardDetails').style.display = 'none';

            // Configure reward sticker
            const stickerBubble = document.getElementById('stickerRewardBubble');
            stickerBubble.innerText = alphabetData[selectedLetter].emoji;
        }

        // --- SCREEN 6: REWARD CHEST ---
        function openRewardChest() {
            const chest = document.getElementById('chestBox');
            chest.style.display = 'none'; // hide chest

            // Play sparkles and award sound
            if (window.SoundFX) window.SoundFX.play('cheer');
            if (typeof confetti === 'function') {
                confetti({ particleCount: 120, spread: 80 });
            }

            document.getElementById('rewardDetails').style.display = 'flex';

            // Add stars & coins
            starsCollected += 10;
            coinsCollected += 5;
            document.getElementById('starCounter').innerText = starsCollected;
            document.getElementById('coinCounter').innerText = coinsCollected;

            // Add sticker to collected book list
            let stickerEmoji = alphabetData[selectedLetter].emoji;
            if (!collectedStickers.includes(stickerEmoji)) {
                collectedStickers.push(stickerEmoji);
            }

            // Sync with backend API
            fetch("{{ route('api.add_stars') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    stars: 10,
                    coins: 5,
                    activity_name: 'Alphabet Adventure Letter ' + selectedLetter
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    console.log("Stars synchronized successfully.");
                }
            })
            .catch(err => console.log("Stars sync failed", err));

            // Unlock next letter index on path
            let currentLetterIdx = alphabetList.indexOf(selectedLetter);
            if (currentLetterIdx === currentUnlockedIndex && currentUnlockedIndex < 25) {
                currentUnlockedIndex++;
            }

            saveGameData();
        }

        function claimRewardsAndNext() {
            // Unlocks next letter and goes back to map
            enterMapScreen();
        }

        // --- STICKERS BOOK OVERLAY DISPLAY ---
        function showStickersScreen() {
            showScreen('screenStickers');
            const grid = document.getElementById('stickerBookGrid');
            grid.innerHTML = '';

            alphabetList.forEach(letter => {
                const item = document.createElement('div');
                item.className = 'sticker-item';
                
                let stickerEmoji = alphabetData[letter].emoji;
                if (collectedStickers.includes(stickerEmoji)) {
                    item.classList.add('sticker-unlocked');
                    item.innerText = stickerEmoji;
                } else {
                    item.innerText = letter; // silhouette letter guide
                }
                grid.appendChild(item);
            });
        }

        // Draw cartoon eye contour helper for canvas video
        function drawCartoonEye(ctx, cx, cy, r, blinkFactor = 0, lookX = 0, lookY = 0) {
            ctx.save();
            if (blinkFactor >= 0.9) {
                ctx.beginPath();
                ctx.arc(cx, cy, r, Math.PI, 0, false);
                ctx.strokeStyle = '#4A3B00';
                ctx.lineWidth = 4;
                ctx.stroke();
                ctx.restore();
                return;
            }
            ctx.beginPath();
            ctx.arc(cx, cy, r, 0, Math.PI*2);
            ctx.fillStyle = '#FFF';
            ctx.fill();
            ctx.strokeStyle = '#4A3B00';
            ctx.lineWidth = 3;
            ctx.stroke();

            // Pupil
            ctx.beginPath();
            ctx.arc(cx + lookX*4, cy + lookY*4, r*0.5, 0, Math.PI*2);
            ctx.fillStyle = '#2C3E50';
            ctx.fill();
            ctx.restore();
        }

        // Initial setup on DOM ready
        loadSaveData();
    </script>
@endsection
