@extends('layouts.app')

@section('title', 'Kuhu Kids Learning - Alphabet Writing')

@section('content')
    <!-- Include Canvas Confetti -->
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

    <!-- Category Selection Overlay Modal -->
    <div id="categorySelectionOverlay" style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(140, 82, 255, 0.45); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); z-index: 9999; display: flex; align-items: center; justify-content: center; transition: opacity 0.3s ease;">
        <div style="background: radial-gradient(circle, #FFFDF0 0%, #FFF5D1 100%); border: 6px solid var(--color-purple); border-radius: 36px; padding: 40px; box-shadow: 0 16px 0 var(--color-purple-shadow); max-width: 800px; width: 90%; text-align: center; transform: scale(1); transition: transform 0.3s ease; position: relative; font-family: 'Fredoka', sans-serif;">
            <h2 style="font-size: 2.8rem; color: var(--color-purple); font-weight: 900; margin: 0 0 10px 0; text-shadow: 2px 2px 0px #FFF, 4px 4px 0px var(--color-purple-shadow);">
                Choose What to Trace! ✏️
            </h2>
            <p style="font-size: 1.4rem; color: #4A3B00; font-weight: bold; margin-bottom: 35px;">
                क्या लिखना सीखना है? सिलेक्ट करें!
            </p>
            
            <div style="display: flex; gap: 24px; flex-wrap: wrap; justify-content: center;">
                <!-- Option 1: English -->
                <button onclick="selectCategoryFromOverlay('english')" class="btn-3d" style="flex: 1; min-width: 200px; padding: 24px 16px; font-size: 1.5rem; font-weight: 800; display: flex; flex-direction: column; align-items: center; gap: 12px; background: #FF66B2; border-bottom: 8px solid #D94B9F; color: white; border-radius: 24px; cursor: pointer;">
                    <span style="font-size: 4rem;">🔤</span>
                    <span>A to Z</span>
                </button>
                <!-- Option 2: Numbers -->
                <button onclick="selectCategoryFromOverlay('numbers')" class="btn-3d" style="flex: 1; min-width: 200px; padding: 24px 16px; font-size: 1.5rem; font-weight: 800; display: flex; flex-direction: column; align-items: center; gap: 12px; background: #FFDE59; border-bottom: 8px solid #CCB143; color: #4A3B00; border-radius: 24px; cursor: pointer;">
                    <span style="font-size: 4rem;">🔢</span>
                    <span>1 to 50</span>
                </button>
                <!-- Option 3: Hindi -->
                <button onclick="selectCategoryFromOverlay('hindi')" class="btn-3d" style="flex: 1; min-width: 200px; padding: 24px 16px; font-size: 1.5rem; font-weight: 800; display: flex; flex-direction: column; align-items: center; gap: 12px; background: #8C52FF; border-bottom: 8px solid #6E3CD9; color: white; border-radius: 24px; cursor: pointer;">
                    <span style="font-size: 4rem;">🕉️</span>
                    <span>क से ज्ञ</span>
                </button>
            </div>
        </div>
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
            background: #FFF;
            border-radius: 24px;
            border: 4px solid var(--color-purple);
            box-shadow: 0 10px 0 var(--color-purple-shadow);
            overflow: hidden;
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
    </style>

    <div class="inner-container">
        <!-- Header with dynamic Level and Stars counters -->
        <div class="inner-header">
            <h1 class="inner-title" style="margin: 0; display: flex; align-items: center; gap: 10px;">
                <span style="color: var(--color-purple);">✍️ Let's Write!</span>
            </h1>

            <div style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                <!-- Child Status Indicators -->
                <div
                    style="background: #FFFDF0; border: 3px solid var(--color-purple); border-radius: 20px; padding: 8px 16px; font-weight: bold; color: var(--color-purple); display: flex; align-items: center; gap: 8px; box-shadow: 0 4px 0 var(--color-purple-shadow); font-size: 1.1rem;">
                    🏆 Level <span id="levelDisplay">{{ $activeChild->level }}</span>
                </div>

                <div
                    style="background: #FFFDF0; border: 3px solid var(--color-yellow); border-radius: 20px; padding: 8px 16px; font-weight: bold; color: #4A3B00; display: flex; align-items: center; gap: 8px; box-shadow: 0 4px 0 var(--color-yellow-shadow); font-size: 1.1rem;">
                    ⭐ <span id="starsDisplay">{{ $activeChild->stars }}</span> Stars
                </div>

                <a href="{{ route('dashboard') }}" class="btn-3d btn-yellow" style="padding: 10px 20px; font-size: 1rem;">&lt; Back to Home</a>
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
            </div>

            <!-- Tracing Controls -->
            <div class="canvas-controls">
                <button onclick="submitTracing()" class="btn-3d"
                    style="width: 100%; font-size: 1.5rem; background: var(--color-green-real); color: white; border-bottom: 6px solid var(--color-green-real-shadow); display: flex; align-items: center; justify-content: center; gap: 10px; padding: 16px 24px;">
                    <span>Next</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <script>
        const categorySequences = {
            english: ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'],
            numbers: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35', '36', '37', '38', '39', '40', '41', '42', '43', '44', '45', '46', '47', '48', '49', '50'],
            hindi: ['क', 'ख', 'ग', 'घ', 'ङ', 'च', 'छ', 'ज', 'झ', 'ञ', 'ट', 'ठ', 'ड', 'ढ', 'ण', 'त', 'थ', 'द', 'ध', 'न', 'प', 'फ', 'ब', 'भ', 'म', 'य', 'र', 'ल', 'व', 'श', 'ष', 'स', 'ह', 'क्ष', 'त्र', 'ज्ञ']
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

        const initialLevel = {{ $activeChild->level ?? 1 }};
        let currentUnlockedLevel = initialLevel;

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

        function selectCategoryFromOverlay(cat) {
            const overlay = document.getElementById('categorySelectionOverlay');
            if (overlay) {
                overlay.style.opacity = '0';
                overlay.style.pointerEvents = 'none';
                setTimeout(() => {
                    overlay.style.display = 'none';
                }, 300);
            }
            
            setCategory(cat);

            setTimeout(() => {
                startHelperAnimation();
            }, 1500);
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
                { points: [
                    { x: 0.50, y: 0.22 }, { x: 0.38, y: 0.28 }, { x: 0.38, y: 0.44 }, { x: 0.50, y: 0.50 }, { x: 0.62, y: 0.56 }, { x: 0.64, y: 0.72 }, 
                    { x: 0.50, y: 0.78 }, { x: 0.36, y: 0.72 }, { x: 0.38, y: 0.56 }, { x: 0.50, y: 0.50 }, { x: 0.62, y: 0.44 }, { x: 0.62, y: 0.28 }, 
                    { x: 0.50, y: 0.22 }
                ], num: 1 }
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
                { points: [
                    { x: 0.65, y: 0.52 }, { x: 0.50, y: 0.50 }, { x: 0.42, y: 0.42 }, { x: 0.42, y: 0.34 }, { x: 0.50, y: 0.34 }, { x: 0.50, y: 0.46 }, 
                    { x: 0.36, y: 0.50 }, { x: 0.32, y: 0.60 }, { x: 0.42, y: 0.64 }, { x: 0.48, y: 0.56 }, { x: 0.42, y: 0.72 }, { x: 0.34, y: 0.76 }
                ], num: 2 },
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

            const overlay = document.getElementById('successOverlay');
            const levelDisp = document.getElementById('levelDisplay');
            const starsDisp = document.getElementById('starsDisplay');

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
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        if (levelDisp) levelDisp.innerText = data.new_level;
                        if (starsDisp) starsDisp.innerText = data.new_stars;

                        const starsPill = document.querySelector('.stars-pill span');
                        if (starsPill) {
                            starsPill.innerText = data.new_stars;
                        }

                        document.getElementById('successText').innerText = `Fantastic! You reached Level ${data.new_level}!`;

                        // Update local unlocked level
                        currentUnlockedLevel = data.new_level;
                    }
                });

            overlay.style.opacity = '1';
            overlay.style.pointerEvents = 'auto';

            setTimeout(() => {
                overlay.style.opacity = '0';
                overlay.style.pointerEvents = 'none';

                const nextIdx = currentCategoryList.indexOf(currentLetter) + 1;
                if (nextIdx < currentCategoryList.length) {
                    const nextLetter = currentCategoryList[nextIdx];
                    selectLetter(nextLetter);
                } else {
                    selectLetter(currentCategoryList[0]);
                }
                isCelebrated = false;
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


    </script>
@endsection