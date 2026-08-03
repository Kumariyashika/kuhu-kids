<!DOCTYPE html>
<html lang="hi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hindi Varnamala Interactive Tracing - Kuhu Kids Learning</title>
    <!-- Google Fonts for Child-Friendly Devanagari & Rounded English Typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600;700&family=Rozha+One&family=Tiro+Devanagari+Hindi&family=Nunito:wght@700;800;900&display=swap"
        rel="stylesheet">

    <!-- Canvas Confetti -->
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

    <style>
        :root {
            --bg-gradient: linear-gradient(135deg, #E0F2FE 0%, #FFF5F5 50%, #F0FDF4 100%);
            --card-bg: #FFFFFF;
            --text-dark: #1E293B;
            --text-muted: #64748B;
            --brand-orange: #FF6B00;
            --brand-orange-light: #FF8A00;
            --brand-green: #22C55E;
            --brand-red: #EF4444;
            --brand-purple: #8B5CF6;
            --brand-blue: #3B82F6;
            --letter-grey: #CBD5E1;
            --shirorekha-color: #64748B;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Fredoka', 'Nunito', sans-serif;
            user-select: none;
            -webkit-user-select: none;
        }

        body {
            background: var(--bg-gradient);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 16px 12px;
            overflow-x: hidden;
        }

        /* ----------------------------------------------------
           TOP APP BAR & NAVIGATION
        ---------------------------------------------------- */
        .app-bar {
            width: 100%;
            max-width: 520px;
            /* 1080x1920 mobile portrait aspect ratio */
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
            z-index: 20;
        }

        .btn-round {
            background: #FFFFFF;
            border: 3px solid #E2E8F0;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            text-decoration: none;
            color: #334155;
            transition: all 0.2s ease;
        }

        .btn-round:hover {
            transform: scale(1.08);
            border-color: #3B82F6;
            color: #3B82F6;
        }

        .title-badge {
            background: #FFFFFF;
            border: 3px solid #FDBA74;
            padding: 8px 18px;
            border-radius: 24px;
            font-size: 1.25rem;
            font-weight: 900;
            color: #EA580C;
            box-shadow: 0 4px 12px rgba(234, 88, 12, 0.15);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* ----------------------------------------------------
           VARGA CATEGORY TABS (क-वर्ग, च-वर्ग, etc.)
        ---------------------------------------------------- */
        .varga-tabs {
            width: 100%;
            max-width: 520px;
            display: flex;
            gap: 8px;
            overflow-x: auto;
            padding: 6px 4px;
            margin-bottom: 12px;
            scrollbar-width: none;
        }

        .varga-tabs::-webkit-scrollbar {
            display: none;
        }

        .tab-btn {
            background: #FFFFFF;
            border: 2px solid #E2E8F0;
            padding: 8px 14px;
            border-radius: 16px;
            font-size: 0.9rem;
            font-weight: 800;
            color: #64748B;
            cursor: pointer;
            white-space: nowrap;
            transition: all 0.2s ease;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
        }

        .tab-btn.active {
            background: #FF6B00;
            color: #FFFFFF;
            border-color: #EA580C;
            box-shadow: 0 4px 12px rgba(255, 107, 0, 0.3);
        }

        /* ----------------------------------------------------
           LETTER SELECTION SCROLLBAR
        ---------------------------------------------------- */
        .letters-bar {
            width: 100%;
            max-width: 520px;
            display: flex;
            gap: 8px;
            overflow-x: auto;
            padding: 4px 4px 10px 4px;
            margin-bottom: 14px;
            scrollbar-width: thin;
        }

        .letter-chip {
            min-width: 52px;
            height: 52px;
            border-radius: 16px;
            background: #FFFFFF;
            border: 3px solid #E2E8F0;
            font-family: 'Tiro Devanagari Hindi', serif;
            font-size: 1.6rem;
            font-weight: bold;
            color: #334155;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.06);
            flex-shrink: 0;
        }

        .letter-chip.active {
            background: linear-gradient(135deg, #FF8A00 0%, #FF6B00 100%);
            color: #FFFFFF;
            border-color: #C2410C;
            transform: scale(1.1);
            box-shadow: 0 6px 16px rgba(255, 107, 0, 0.4);
        }

        /* ----------------------------------------------------
           MAIN INTERACTIVE TRACING CARD CONTAINER (1080x1920 style)
        ---------------------------------------------------- */
        .card-container {
            width: 100%;
            max-width: 480px;
            aspect-ratio: 9 / 14;
            background: var(--card-bg);
            border-radius: 36px;
            border: 6px solid #FFFFFF;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12), 0 0 0 1px rgba(0, 0, 0, 0.04);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            padding: 24px 20px;
            position: relative;
            overflow: hidden;
        }

        /* Top Progress Bar & Stars */
        .card-header {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 10;
        }

        .phonetic-pill {
            background: #F1F5F9;
            border: 2px solid #CBD5E1;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 1.1rem;
            font-weight: 900;
            color: #3B82F6;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .stars-container {
            display: flex;
            gap: 4px;
            font-size: 1.3rem;
        }

        /* ----------------------------------------------------
           DEVANAGARI SVG CANVAS INTERACTIVE AREA
        ---------------------------------------------------- */
        .svg-stage {
            width: 100%;
            height: 62%;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #tracingSvg {
            width: 100%;
            height: 100%;
            overflow: visible;
            touch-action: none;
        }

        /* Base Grey Letter Stroke Style */
        .bg-letter-path {
            fill: none;
            stroke: var(--letter-grey);
            stroke-width: 24;
            stroke-linecap: round;
            stroke-linejoin: round;
            opacity: 0.55;
        }

        /* Shirorekha Top Headline Style */
        .shirorekha-path {
            fill: none;
            stroke: #94A3B8;
            stroke-width: 20;
            stroke-linecap: round;
        }

        /* Active Orange Dotted Tracing Line */
        .dotted-trace-path {
            fill: none;
            stroke: var(--brand-orange);
            stroke-width: 22;
            stroke-dasharray: 4, 16;
            stroke-linecap: round;
            stroke-linejoin: round;
            animation: dashFlow 1.5s linear infinite;
        }

        @keyframes dashFlow {
            to {
                stroke-dashoffset: -40;
            }
        }

        /* Child Completed User Traced Line */
        .user-drawn-path {
            fill: none;
            stroke: #22C55E;
            stroke-width: 24;
            stroke-linecap: round;
            stroke-linejoin: round;
            filter: drop-shadow(0 2px 8px rgba(34, 197, 94, 0.4));
        }

        /* Checkpoint Circles & Markers */
        .checkpoint-circle {
            fill: #FFFFFF;
            stroke: #FF6B00;
            stroke-width: 4;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .checkpoint-circle.active {
            fill: #FF6B00;
            stroke: #FFFFFF;
            stroke-width: 5;
            filter: drop-shadow(0 0 10px rgba(255, 107, 0, 0.8));
            animation: pulseGlow 1.2s infinite alternate;
        }

        .checkpoint-circle.completed {
            fill: #22C55E;
            stroke: #FFFFFF;
        }

        @keyframes pulseGlow {
            from {
                transform: scale(1);
            }

            to {
                transform: scale(1.3);
            }
        }

        .checkpoint-text {
            fill: #FFFFFF;
            font-size: 13px;
            font-weight: 900;
            text-anchor: middle;
            dominant-baseline: central;
            pointer-events: none;
        }

        /* Glowing Start 🟢 and End 🔴 Badges */
        .badge-start {
            fill: #22C55E;
            stroke: #FFFFFF;
            stroke-width: 4;
            filter: drop-shadow(0 0 8px rgba(34, 197, 94, 0.8));
        }

        .badge-end {
            fill: #EF4444;
            stroke: #FFFFFF;
            stroke-width: 4;
            filter: drop-shadow(0 0 8px rgba(239, 68, 68, 0.8));
        }

        .badge-label {
            fill: #FFFFFF;
            font-size: 10px;
            font-weight: 900;
            text-anchor: middle;
            dominant-baseline: central;
        }

        /* Directional Flow Arrowhead Marker */
        .arrow-path {
            fill: #FF6B00;
        }

        /* ----------------------------------------------------
           CARD FOOTER: PRONUNCIATION & AUDIO CONTROLS
        ---------------------------------------------------- */
        .card-footer {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            z-index: 10;
        }

        .pronunciation-box {
            display: flex;
            align-items: center;
            gap: 12px;
            background: #F8FAFC;
            border: 2px solid #E2E8F0;
            padding: 10px 20px;
            border-radius: 24px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.03);
        }

        .speaker-btn {
            background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
            color: #FFFFFF;
            border: none;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.35);
            transition: transform 0.15s ease;
        }

        .speaker-btn:hover {
            transform: scale(1.1);
        }

        .pronun-text {
            font-size: 1.4rem;
            font-weight: 900;
            color: #1E293B;
        }

        .word-example {
            font-size: 0.95rem;
            font-weight: 700;
            color: #64748B;
        }

        /* Bottom Controls (Next/Prev Letter) */
        .bottom-nav {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
        }

        .nav-btn {
            flex: 1;
            background: #F1F5F9;
            color: #334155;
            border: 2px solid #CBD5E1;
            padding: 10px 16px;
            border-radius: 18px;
            font-weight: 800;
            font-size: 1rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            transition: all 0.2s ease;
            box-shadow: 0 3px 0 #CBD5E1;
        }

        .nav-btn:hover {
            background: #E2E8F0;
            transform: translateY(-2px);
        }

        .nav-btn-primary {
            background: linear-gradient(135deg, #22C55E 0%, #16A34A 100%);
            color: #FFFFFF;
            border-color: #15803D;
            box-shadow: 0 3px 0 #15803D;
        }

        /* Error Helper Cue Pulsing Circle */
        .guidance-line {
            stroke: #EF4444;
            stroke-width: 4;
            stroke-dasharray: 6, 6;
            animation: pulseDash 0.8s infinite linear;
        }

        @keyframes pulseDash {
            to {
                stroke-dashoffset: -12;
            }
        }
    </style>
</head>

<body>

    <!-- 1. TOP APP BAR -->
    <div class="app-bar">
        <a href="{{ route('learning.tracing') }}" class="btn-round" title="Back to Modules">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
        </a>

        <div class="title-badge">
            <span>क ख ग</span>
            <span>Varnamala</span>
        </div>

        <button onclick="speakCurrentLetter()" class="btn-round" title="Speak Letter">
            🔊
        </button>
    </div>

    <!-- 2. VARGA CATEGORY TABS -->
    <div class="varga-tabs" id="vargaTabsContainer">
        <!-- Varga categories will be rendered dynamically -->
    </div>

    <!-- 3. LETTER SELECTION CHIPS -->
    <div class="letters-bar" id="lettersBarContainer">
        <!-- Letter chips will be rendered dynamically -->
    </div>

    <!-- 4. INTERACTIVE DEVANAGARI TRACING CARD -->
    <div class="card-container">
        <!-- Card Top Status Bar -->
        <div class="card-header">
            <div class="phonetic-pill" id="phoneticPill">
                <span id="charTitle">क</span>
                <span style="color: #64748B;">•</span>
                <span id="phoneticText">Ka</span>
            </div>

            <div class="stars-container" id="starsRating">
                ⭐ ⭐ ⭐
            </div>
        </div>

        <!-- SVG Tracing Stage Canvas -->
        <div class="svg-stage">
            <svg viewBox="0 0 300 340" id="tracingSvg">
                <!-- Layers will be rendered by JS stroke engine:
                     1. Background Grey Devanagari paths
                     2. Orange Dotted Tracing Path
                     3. User Drawn Completed Paths
                     4. Checkpoint Circles & Number Badges
                     5. Green START 🟢 and Red END 🔴 Badges
                -->
            </svg>
        </div>

        <!-- Card Bottom Pronunciation & Navigation -->
        <div class="card-footer">
            <div class="pronunciation-box">
                <button onclick="speakCurrentLetter()" class="speaker-btn" title="Listen Pronunciation">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                        stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"></polygon>
                        <path d="M19.07 4.93a10 10 0 0 1 0 14.14M15.54 8.46a5 5 0 0 1 0 7.07"></path>
                    </svg>
                </button>
                <div>
                    <div class="pronun-text" id="pronunTitle">Ka (क)</div>
                    <div class="word-example" id="wordExampleText">क से कमल (Kamal - Lotus)</div>
                </div>
            </div>

            <div class="bottom-nav">
                <button onclick="prevLetter()" class="nav-btn">
                    <span>⬅️ Previous</span>
                </button>
                <button onclick="nextLetter()" class="nav-btn nav-btn-primary">
                    <span>Next Letter ➡️</span>
                </button>
            </div>
        </div>
    </div>

    <!-- 5. JAVASCRIPT: AUTHENTIC DEVANAGARI STROKE DATA & TRACING ENGINE -->
    <script>
        // Full dataset for all 36 Devanagari Consonants (क to ज्ञ) with authentic stroke order
        const varnamalaData = [
            // 1. क-वर्ग
            {
                char: 'क', phonetic: 'Ka', group: 'क-वर्ग', example: 'कमल (Lotus)',
                strokes: [
                    // Stroke 1: Main vertical danda down
                    { path: 'M 150,50 L 150,270', checkpoints: [{ x: 150, y: 50 }, { x: 150, y: 160 }, { x: 150, y: 270 }] },
                    // Stroke 2: Left loop counter-clockwise
                    { path: 'M 150,110 C 80,110 80,210 150,210', checkpoints: [{ x: 150, y: 110 }, { x: 95, y: 160 }, { x: 150, y: 210 }] },
                    // Stroke 3: Right tail curve down
                    { path: 'M 150,160 C 220,160 220,240 200,260', checkpoints: [{ x: 150, y: 160 }, { x: 215, y: 190 }, { x: 200, y: 260 }] },
                    // Stroke 4: Shirorekha top headline
                    { path: 'M 50,50 L 250,50', checkpoints: [{ x: 50, y: 50 }, { x: 150, y: 50 }, { x: 250, y: 50 }] }
                ]
            },
            {
                char: 'ख', phonetic: 'Kha', group: 'क-वर्ग', example: 'खरगोश (Rabbit)',
                strokes: [
                    // Stroke 1: Reverse hook curve
                    { path: 'M 100,70 C 50,70 50,150 110,190 C 140,210 170,220 200,220', checkpoints: [{ x: 100, y: 70 }, { x: 60, y: 120 }, { x: 110, y: 190 }, { x: 200, y: 220 }] },
                    // Stroke 2: Center loop
                    { path: 'M 150,150 C 110,150 110,210 150,210 C 190,210 190,150 150,150', checkpoints: [{ x: 150, y: 150 }, { x: 120, y: 180 }, { x: 150, y: 210 }] },
                    // Stroke 3: Main vertical danda
                    { path: 'M 200,50 L 200,270', checkpoints: [{ x: 200, y: 50 }, { x: 200, y: 160 }, { x: 200, y: 270 }] },
                    // Stroke 4: Shirorekha
                    { path: 'M 40,50 L 250,50', checkpoints: [{ x: 40, y: 50 }, { x: 150, y: 50 }, { x: 250, y: 50 }] }
                ]
            },
            {
                char: 'ग', phonetic: 'Ga', group: 'क-वर्ग', example: 'गमला (Flowerpot)',
                strokes: [
                    // Stroke 1: Left danda turning left into a loop
                    { path: 'M 110,50 L 110,220 C 110,260 60,250 60,220 C 60,200 110,200 110,220', checkpoints: [{ x: 110, y: 50 }, { x: 110, y: 170 }, { x: 110, y: 230 }, { x: 75, y: 230 }] },
                    // Stroke 2: Right full vertical danda
                    { path: 'M 200,50 L 200,270', checkpoints: [{ x: 200, y: 50 }, { x: 200, y: 160 }, { x: 200, y: 270 }] },
                    // Stroke 3: Shirorekha
                    { path: 'M 50,50 L 250,50', checkpoints: [{ x: 50, y: 50 }, { x: 150, y: 50 }, { x: 250, y: 50 }] }
                ]
            },
            {
                char: 'घ', phonetic: 'Gha', group: 'क-वर्ग', example: 'घर (House)',
                strokes: [
                    // Stroke 1: Upper left C-curve
                    { path: 'M 80,70 C 150,70 150,140 80,140', checkpoints: [{ x: 80, y: 70 }, { x: 140, y: 100 }, { x: 80, y: 140 }] },
                    // Stroke 2: Lower left curve connecting to vertical danda
                    { path: 'M 80,140 C 160,140 160,240 200,210', checkpoints: [{ x: 80, y: 140 }, { x: 150, y: 180 }, { x: 200, y: 210 }] },
                    // Stroke 3: Main vertical danda
                    { path: 'M 200,50 L 200,270', checkpoints: [{ x: 200, y: 50 }, { x: 200, y: 160 }, { x: 200, y: 270 }] },
                    // Stroke 4: Shirorekha
                    { path: 'M 50,50 L 250,50', checkpoints: [{ x: 50, y: 50 }, { x: 150, y: 50 }, { x: 250, y: 50 }] }
                ]
            },
            {
                char: 'ङ', phonetic: 'Nga', group: 'क-वर्ग', example: 'ङ (Khali)',
                strokes: [
                    { path: 'M 140,50 L 140,90', checkpoints: [{ x: 140, y: 50 }, { x: 140, y: 90 }] },
                    { path: 'M 140,90 C 80,90 80,170 140,170 C 200,170 200,250 130,250', checkpoints: [{ x: 140, y: 90 }, { x: 90, y: 130 }, { x: 140, y: 170 }, { x: 180, y: 210 }, { x: 130, y: 250 }] },
                    { path: 'M 210,190 L 210,190', checkpoints: [{ x: 210, y: 190 }] }, // Dot
                    { path: 'M 50,50 L 240,50', checkpoints: [{ x: 50, y: 50 }, { x: 140, y: 50 }, { x: 240, y: 50 }] }
                ]
            },

            // 2. च-वर्ग
            {
                char: 'च', phonetic: 'Cha', group: 'च-वर्ग', example: 'चम्मच (Spoon)',
                strokes: [
                    { path: 'M 80,150 L 140,150 C 140,230 60,210 120,200', checkpoints: [{ x: 80, y: 150 }, { x: 140, y: 150 }, { x: 100, y: 210 }, { x: 160, y: 200 }] },
                    { path: 'M 200,50 L 200,270', checkpoints: [{ x: 200, y: 50 }, { x: 200, y: 160 }, { x: 200, y: 270 }] },
                    { path: 'M 50,50 L 250,50', checkpoints: [{ x: 50, y: 50 }, { x: 150, y: 50 }, { x: 250, y: 50 }] }
                ]
            },
            {
                char: 'छ', phonetic: 'Chha', group: 'च-वर्ग', example: 'छतरी (Umbrella)',
                strokes: [
                    { path: 'M 80,70 C 150,70 150,130 80,130 C 160,130 160,250 80,210 C 80,180 140,180 120,210', checkpoints: [{ x: 80, y: 70 }, { x: 140, y: 100 }, { x: 80, y: 130 }, { x: 150, y: 180 }, { x: 100, y: 220 }, { x: 120, y: 190 }] },
                    { path: 'M 120,50 L 120,70', checkpoints: [{ x: 120, y: 50 }, { x: 120, y: 70 }] },
                    { path: 'M 50,50 L 220,50', checkpoints: [{ x: 50, y: 50 }, { x: 130, y: 50 }, { x: 220, y: 50 }] }
                ]
            },
            {
                char: 'ज', phonetic: 'Ja', group: 'च-वर्ग', example: 'जहाज (Ship)',
                strokes: [
                    { path: 'M 80,130 C 80,230 150,220 150,150 L 200,150', checkpoints: [{ x: 80, y: 130 }, { x: 100, y: 220 }, { x: 150, y: 150 }, { x: 200, y: 150 }] },
                    { path: 'M 200,50 L 200,270', checkpoints: [{ x: 200, y: 50 }, { x: 200, y: 160 }, { x: 200, y: 270 }] },
                    { path: 'M 50,50 L 250,50', checkpoints: [{ x: 50, y: 50 }, { x: 150, y: 50 }, { x: 250, y: 50 }] }
                ]
            },
            {
                char: 'झ', phonetic: 'Jha', group: 'च-वर्ग', example: 'झंडा (Flag)',
                strokes: [
                    { path: 'M 100,50 L 100,90 C 40,90 40,160 100,160 C 160,160 160,240 90,240 L 60,270', checkpoints: [{ x: 100, y: 50 }, { x: 100, y: 90 }, { x: 50, y: 125 }, { x: 100, y: 160 }, { x: 140, y: 200 }, { x: 90, y: 240 }, { x: 60, y: 270 }] },
                    { path: 'M 100,160 L 190,160', checkpoints: [{ x: 100, y: 160 }, { x: 190, y: 160 }] },
                    { path: 'M 190,50 L 190,270', checkpoints: [{ x: 190, y: 50 }, { x: 190, y: 160 }, { x: 190, y: 270 }] },
                    { path: 'M 40,50 L 240,50', checkpoints: [{ x: 40, y: 50 }, { x: 140, y: 50 }, { x: 240, y: 50 }] }
                ]
            },
            {
                char: 'ञ', phonetic: 'Nya', group: 'च-वर्ग', example: 'ञ (Khali)',
                strokes: [
                    { path: 'M 80,100 C 50,150 50,210 130,160', checkpoints: [{ x: 80, y: 100 }, { x: 60, y: 160 }, { x: 130, y: 160 }] },
                    { path: 'M 130,160 L 190,160', checkpoints: [{ x: 130, y: 160 }, { x: 190, y: 160 }] },
                    { path: 'M 190,50 L 190,270', checkpoints: [{ x: 190, y: 50 }, { x: 190, y: 160 }, { x: 190, y: 270 }] },
                    { path: 'M 40,50 L 240,50', checkpoints: [{ x: 40, y: 50 }, { x: 140, y: 50 }, { x: 240, y: 50 }] }
                ]
            },

            // 3. ट-वर्ग
            {
                char: 'ट', phonetic: 'Ta', group: 'ट-वर्ग', example: 'टमाटर (Tomato)',
                strokes: [
                    { path: 'M 140,50 L 140,100', checkpoints: [{ x: 140, y: 50 }, { x: 140, y: 100 }] },
                    { path: 'M 140,100 C 60,100 60,250 170,230', checkpoints: [{ x: 140, y: 100 }, { x: 80, y: 175 }, { x: 170, y: 230 }] },
                    { path: 'M 50,50 L 230,50', checkpoints: [{ x: 50, y: 50 }, { x: 140, y: 50 }, { x: 230, y: 50 }] }
                ]
            },
            {
                char: 'ठ', phonetic: 'Tha', group: 'ट-वर्ग', example: 'ठठेरा (Thathera)',
                strokes: [
                    { path: 'M 140,50 L 140,110', checkpoints: [{ x: 140, y: 50 }, { x: 140, y: 110 }] },
                    { path: 'M 140,110 C 60,110 60,250 140,250 C 220,250 220,110 140,110', checkpoints: [{ x: 140, y: 110 }, { x: 70, y: 180 }, { x: 140, y: 250 }, { x: 210, y: 180 }, { x: 140, y: 110 }] },
                    { path: 'M 50,50 L 230,50', checkpoints: [{ x: 50, y: 50 }, { x: 140, y: 50 }, { x: 230, y: 50 }] }
                ]
            },
            {
                char: 'ड', phonetic: 'Da', group: 'ट-वर्ग', example: 'डमरू (Drum)',
                strokes: [
                    { path: 'M 140,50 L 140,90', checkpoints: [{ x: 140, y: 50 }, { x: 140, y: 90 }] },
                    { path: 'M 140,90 C 80,90 80,170 140,170 C 200,170 200,250 130,250', checkpoints: [{ x: 140, y: 90 }, { x: 90, y: 130 }, { x: 140, y: 170 }, { x: 180, y: 210 }, { x: 130, y: 250 }] },
                    { path: 'M 50,50 L 230,50', checkpoints: [{ x: 50, y: 50 }, { x: 140, y: 50 }, { x: 230, y: 50 }] }
                ]
            },
            {
                char: 'ढ', phonetic: 'Dha', group: 'ट-वर्ग', example: 'ढोलक (Dholak)',
                strokes: [
                    { path: 'M 140,50 L 140,100', checkpoints: [{ x: 140, y: 50 }, { x: 140, y: 100 }] },
                    { path: 'M 140,100 C 60,100 60,250 150,230 C 170,210 130,180 140,230', checkpoints: [{ x: 140, y: 100 }, { x: 75, y: 175 }, { x: 150, y: 230 }, { x: 140, y: 200 }] },
                    { path: 'M 50,50 L 230,50', checkpoints: [{ x: 50, y: 50 }, { x: 140, y: 50 }, { x: 230, y: 50 }] }
                ]
            },
            {
                char: 'ण', phonetic: 'Ana', group: 'ट-वर्ग', example: 'बाण (Arrow)',
                strokes: [
                    { path: 'M 80,50 L 80,190 C 80,240 150,240 150,190 L 150,50', checkpoints: [{ x: 80, y: 50 }, { x: 80, y: 190 }, { x: 115, y: 235 }, { x: 150, y: 190 }, { x: 150, y: 50 }] },
                    { path: 'M 200,50 L 200,270', checkpoints: [{ x: 200, y: 50 }, { x: 200, y: 160 }, { x: 200, y: 270 }] },
                    { path: 'M 50,50 L 250,50', checkpoints: [{ x: 50, y: 50 }, { x: 150, y: 50 }, { x: 250, y: 50 }] }
                ]
            },

            // 4. त-वर्ग
            {
                char: 'त', phonetic: 'Ta', group: 'त-वर्ग', example: 'तरबूज (Watermelon)',
                strokes: [
                    { path: 'M 100,170 C 140,170 140,170 140,170', checkpoints: [{ x: 100, y: 230 }, { x: 100, y: 170 }, { x: 190, y: 170 }] },
                    { path: 'M 190,50 L 190,270', checkpoints: [{ x: 190, y: 50 }, { x: 190, y: 160 }, { x: 190, y: 270 }] },
                    { path: 'M 50,50 L 240,50', checkpoints: [{ x: 50, y: 50 }, { x: 140, y: 50 }, { x: 240, y: 50 }] }
                ]
            },
            {
                char: 'थ', phonetic: 'Tha', group: 'त-वर्ग', example: 'थर्मस (Thermos)',
                strokes: [
                    { path: 'M 70,80 C 50,80 50,110 80,110 C 140,110 140,210 190,210', checkpoints: [{ x: 70, y: 80 }, { x: 55, y: 95 }, { x: 80, y: 110 }, { x: 140, y: 160 }, { x: 190, y: 210 }] },
                    { path: 'M 190,50 L 190,270', checkpoints: [{ x: 190, y: 50 }, { x: 190, y: 160 }, { x: 190, y: 270 }] },
                    { path: 'M 110,50 L 240,50', checkpoints: [{ x: 110, y: 50 }, { x: 180, y: 50 }, { x: 240, y: 50 }] }
                ]
            },
            {
                char: 'द', phonetic: 'Da', group: 'त-वर्ग', example: 'दवात (Inkpot)',
                strokes: [
                    { path: 'M 140,50 L 140,100', checkpoints: [{ x: 140, y: 50 }, { x: 140, y: 100 }] },
                    { path: 'M 140,100 C 60,100 60,220 140,210 L 100,270', checkpoints: [{ x: 140, y: 100 }, { x: 75, y: 160 }, { x: 140, y: 210 }, { x: 100, y: 270 }] },
                    { path: 'M 50,50 L 230,50', checkpoints: [{ x: 50, y: 50 }, { x: 140, y: 50 }, { x: 230, y: 50 }] }
                ]
            },
            {
                char: 'ध', phonetic: 'Dha', group: 'त-वर्ग', example: 'धनुष (Bow)',
                strokes: [
                    { path: 'M 70,80 C 50,80 50,110 80,110 C 140,110 140,160 80,160 C 150,160 150,240 190,220', checkpoints: [{ x: 70, y: 80 }, { x: 55, y: 95 }, { x: 80, y: 110 }, { x: 120, y: 135 }, { x: 80, y: 160 }, { x: 140, y: 200 }, { x: 190, y: 220 }] },
                    { path: 'M 190,50 L 190,270', checkpoints: [{ x: 190, y: 50 }, { x: 190, y: 160 }, { x: 190, y: 270 }] },
                    { path: 'M 110,50 L 240,50', checkpoints: [{ x: 110, y: 50 }, { x: 180, y: 50 }, { x: 240, y: 50 }] }
                ]
            },
            {
                char: 'न', phonetic: 'Na', group: 'त-वर्ग', example: 'नल (Tap)',
                strokes: [
                    { path: 'M 70,220 C 70,170 120,170 190,170', checkpoints: [{ x: 70, y: 220 }, { x: 70, y: 170 }, { x: 130, y: 170 }, { x: 190, y: 170 }] },
                    { path: 'M 190,50 L 190,270', checkpoints: [{ x: 190, y: 50 }, { x: 190, y: 160 }, { x: 190, y: 270 }] },
                    { path: 'M 40,50 L 240,50', checkpoints: [{ x: 40, y: 50 }, { x: 140, y: 50 }, { x: 240, y: 50 }] }
                ]
            },

            // 5. प-वर्ग
            {
                char: 'प', phonetic: 'Pa', group: 'प-वर्ग', example: 'पतंग (Kite)',
                strokes: [
                    { path: 'M 90,50 L 90,170 C 90,220 190,220 190,170', checkpoints: [{ x: 90, y: 50 }, { x: 90, y: 170 }, { x: 140, y: 220 }, { x: 190, y: 170 }] },
                    { path: 'M 190,50 L 190,270', checkpoints: [{ x: 190, y: 50 }, { x: 190, y: 160 }, { x: 190, y: 270 }] },
                    { path: 'M 50,50 L 240,50', checkpoints: [{ x: 50, y: 50 }, { x: 140, y: 50 }, { x: 240, y: 50 }] }
                ]
            },
            {
                char: 'फ', phonetic: 'Pha', group: 'प-वर्ग', example: 'फल (Fruit)',
                strokes: [
                    { path: 'M 80,50 L 80,160 C 80,210 140,210 140,160', checkpoints: [{ x: 80, y: 50 }, { x: 80, y: 160 }, { x: 110, y: 210 }, { x: 140, y: 160 }] },
                    { path: 'M 140,50 L 140,270', checkpoints: [{ x: 140, y: 50 }, { x: 140, y: 160 }, { x: 140, y: 270 }] },
                    { path: 'M 140,160 C 220,160 220,250 200,260', checkpoints: [{ x: 140, y: 160 }, { x: 210, y: 190 }, { x: 200, y: 260 }] },
                    { path: 'M 40,50 L 240,50', checkpoints: [{ x: 40, y: 50 }, { x: 140, y: 50 }, { x: 240, y: 50 }] }
                ]
            },
            {
                char: 'ब', phonetic: 'Ba', group: 'प-वर्ग', example: 'बतख (Duck)',
                strokes: [
                    { path: 'M 190,50 L 190,270', checkpoints: [{ x: 190, y: 50 }, { x: 190, y: 160 }, { x: 190, y: 270 }] },
                    { path: 'M 190,110 C 110,110 110,210 190,210', checkpoints: [{ x: 190, y: 110 }, { x: 130, y: 160 }, { x: 190, y: 210 }] },
                    { path: 'M 140,130 L 180,190', checkpoints: [{ x: 140, y: 130 }, { x: 180, y: 190 }] }, // Slant cross line
                    { path: 'M 50,50 L 240,50', checkpoints: [{ x: 50, y: 50 }, { x: 140, y: 50 }, { x: 240, y: 50 }] }
                ]
            },
            {
                char: 'भ', phonetic: 'Bha', group: 'प-वर्ग', example: 'भालू (Bear)',
                strokes: [
                    { path: 'M 70,80 C 50,80 50,110 80,110 L 80,210 C 80,240 40,220 80,180 L 190,180', checkpoints: [{ x: 70, y: 80 }, { x: 55, y: 95 }, { x: 80, y: 110 }, { x: 80, y: 210 }, { x: 60, y: 230 }, { x: 130, y: 180 }, { x: 190, y: 180 }] },
                    { path: 'M 190,50 L 190,270', checkpoints: [{ x: 190, y: 50 }, { x: 190, y: 160 }, { x: 190, y: 270 }] },
                    { path: 'M 110,50 L 240,50', checkpoints: [{ x: 110, y: 50 }, { x: 180, y: 50 }, { x: 240, y: 50 }] }
                ]
            },
            {
                char: 'म', phonetic: 'Ma', group: 'प-वर्ग', example: 'मछली (Fish)',
                strokes: [
                    { path: 'M 80,50 L 80,210 C 80,240 40,220 80,180 L 190,180', checkpoints: [{ x: 80, y: 50 }, { x: 80, y: 210 }, { x: 60, y: 230 }, { x: 130, y: 180 }, { x: 190, y: 180 }] },
                    { path: 'M 190,50 L 190,270', checkpoints: [{ x: 190, y: 50 }, { x: 190, y: 160 }, { x: 190, y: 270 }] },
                    { path: 'M 40,50 L 240,50', checkpoints: [{ x: 40, y: 50 }, { x: 140, y: 50 }, { x: 240, y: 50 }] }
                ]
            },

            // 6. अन्तःस्थ
            {
                char: 'य', phonetic: 'Ya', group: 'अन्तःस्थ', example: 'यज्ञ (Yagya)',
                strokes: [
                    { path: 'M 80,70 C 140,70 140,150 80,150 C 150,150 150,240 190,210', checkpoints: [{ x: 80, y: 70 }, { x: 130, y: 100 }, { x: 80, y: 150 }, { x: 140, y: 190 }, { x: 190, y: 210 }] },
                    { path: 'M 190,50 L 190,270', checkpoints: [{ x: 190, y: 50 }, { x: 190, y: 160 }, { x: 190, y: 270 }] },
                    { path: 'M 40,50 L 240,50', checkpoints: [{ x: 40, y: 50 }, { x: 140, y: 50 }, { x: 240, y: 50 }] }
                ]
            },
            {
                char: 'र', phonetic: 'Ra', group: 'अन्तःस्थ', example: 'रथ (Chariot)',
                strokes: [
                    { path: 'M 90,70 C 170,70 170,160 90,160 L 170,270', checkpoints: [{ x: 90, y: 70 }, { x: 150, y: 110 }, { x: 90, y: 160 }, { x: 170, y: 270 }] },
                    { path: 'M 50,50 L 210,50', checkpoints: [{ x: 50, y: 50 }, { x: 130, y: 50 }, { x: 210, y: 50 }] }
                ]
            },
            {
                char: 'ल', phonetic: 'La', group: 'अन्तःस्थ', example: 'लट्टू (Top)',
                strokes: [
                    { path: 'M 190,50 L 190,270', checkpoints: [{ x: 190, y: 50 }, { x: 190, y: 160 }, { x: 190, y: 270 }] },
                    { path: 'M 190,170 C 140,110 90,160 130,220', checkpoints: [{ x: 190, y: 170 }, { x: 140, y: 120 }, { x: 90, y: 170 }, { x: 130, y: 220 }] },
                    { path: 'M 40,50 L 240,50', checkpoints: [{ x: 40, y: 50 }, { x: 140, y: 50 }, { x: 240, y: 50 }] }
                ]
            },
            {
                char: 'व', phonetic: 'Va', group: 'अन्तःस्थ', example: 'वक (Heron)',
                strokes: [
                    { path: 'M 190,50 L 190,270', checkpoints: [{ x: 190, y: 50 }, { x: 190, y: 160 }, { x: 190, y: 270 }] },
                    { path: 'M 190,110 C 110,110 110,210 190,210', checkpoints: [{ x: 190, y: 110 }, { x: 130, y: 160 }, { x: 190, y: 210 }] },
                    { path: 'M 50,50 L 240,50', checkpoints: [{ x: 50, y: 50 }, { x: 140, y: 50 }, { x: 240, y: 50 }] }
                ]
            },

            // 7. ऊष्म
            {
                char: 'श', phonetic: 'Sha', group: 'ऊष्म', example: 'शलजम (Turnip)',
                strokes: [
                    { path: 'M 90,80 C 60,80 60,120 90,120 C 160,120 160,200 90,200 L 150,270', checkpoints: [{ x: 90, y: 80 }, { x: 65, y: 100 }, { x: 90, y: 120 }, { x: 150, y: 160 }, { x: 90, y: 200 }, { x: 150, y: 270 }] },
                    { path: 'M 190,50 L 190,270', checkpoints: [{ x: 190, y: 50 }, { x: 190, y: 160 }, { x: 190, y: 270 }] },
                    { path: 'M 110,50 L 240,50', checkpoints: [{ x: 110, y: 50 }, { x: 180, y: 50 }, { x: 240, y: 50 }] }
                ]
            },
            {
                char: 'ष', phonetic: 'Ssha', group: 'ऊष्म', example: 'षटकोण (Hexagon)',
                strokes: [
                    { path: 'M 90,50 L 90,170 C 90,220 190,220 190,170', checkpoints: [{ x: 90, y: 50 }, { x: 90, y: 170 }, { x: 140, y: 220 }, { x: 190, y: 170 }] },
                    { path: 'M 90,70 L 190,200', checkpoints: [{ x: 90, y: 70 }, { x: 190, y: 200 }] }, // Slant cross line
                    { path: 'M 190,50 L 190,270', checkpoints: [{ x: 190, y: 50 }, { x: 190, y: 160 }, { x: 190, y: 270 }] },
                    { path: 'M 50,50 L 240,50', checkpoints: [{ x: 50, y: 50 }, { x: 140, y: 50 }, { x: 240, y: 50 }] }
                ]
            },
            {
                char: 'स', phonetic: 'Sa', group: 'ऊष्म', example: 'सपेरा (Snake Charmer)',
                strokes: [
                    { path: 'M 80,70 C 150,70 150,150 80,150 L 140,240', checkpoints: [{ x: 80, y: 70 }, { x: 140, y: 100 }, { x: 80, y: 150 }, { x: 140, y: 240 }] },
                    { path: 'M 100,170 L 190,170', checkpoints: [{ x: 100, y: 170 }, { x: 190, y: 170 }] },
                    { path: 'M 190,50 L 190,270', checkpoints: [{ x: 190, y: 50 }, { x: 190, y: 160 }, { x: 190, y: 270 }] },
                    { path: 'M 40,50 L 240,50', checkpoints: [{ x: 40, y: 50 }, { x: 140, y: 50 }, { x: 240, y: 50 }] }
                ]
            },
            {
                char: 'ह', phonetic: 'Ha', group: 'ऊष्म', example: 'हाथी (Elephant)',
                strokes: [
                    { path: 'M 140,50 L 140,90 C 80,90 80,160 140,160 C 80,180 80,250 160,250', checkpoints: [{ x: 140, y: 50 }, { x: 140, y: 90 }, { x: 90, y: 125 }, { x: 140, y: 160 }, { x: 90, y: 205 }, { x: 160, y: 250 }] },
                    { path: 'M 50,50 L 230,50', checkpoints: [{ x: 50, y: 50 }, { x: 140, y: 50 }, { x: 230, y: 50 }] }
                ]
            },

            // 8. संयुक्त
            {
                char: 'क्ष', phonetic: 'Ksha', group: 'संयुक्त', example: 'क्षत्रिय (Warrior)',
                strokes: [
                    { path: 'M 190,160 L 140,160 C 100,160 80,100 110,80 C 140,60 140,120 70,190 C 130,190 150,260 120,270', checkpoints: [{ x: 190, y: 160 }, { x: 140, y: 160 }, { x: 90, y: 110 }, { x: 110, y: 80 }, { x: 70, y: 190 }, { x: 140, y: 220 }, { x: 120, y: 270 }] },
                    { path: 'M 190,50 L 190,270', checkpoints: [{ x: 190, y: 50 }, { x: 190, y: 160 }, { x: 190, y: 270 }] },
                    { path: 'M 100,50 L 240,50', checkpoints: [{ x: 100, y: 50 }, { x: 170, y: 50 }, { x: 240, y: 50 }] }
                ]
            },
            {
                char: 'त्र', phonetic: 'Tra', group: 'संयुक्त', example: 'त्रिशूल (Trident)',
                strokes: [
                    { path: 'M 100,100 C 150,100 150,150 190,150', checkpoints: [{ x: 100, y: 100 }, { x: 145, y: 125 }, { x: 190, y: 150 }] },
                    { path: 'M 100,230 L 190,150', checkpoints: [{ x: 100, y: 230 }, { x: 190, y: 150 }] },
                    { path: 'M 190,50 L 190,270', checkpoints: [{ x: 190, y: 50 }, { x: 190, y: 160 }, { x: 190, y: 270 }] },
                    { path: 'M 40,50 L 240,50', checkpoints: [{ x: 40, y: 50 }, { x: 140, y: 50 }, { x: 240, y: 50 }] }
                ]
            },
            {
                char: 'ज्ञ', phonetic: 'Gyana', group: 'संयुक्त', example: 'ज्ञानी (Scholar)',
                strokes: [
                    { path: 'M 100,100 C 140,100 140,160 80,160 C 140,160 140,240 100,260', checkpoints: [{ x: 100, y: 100 }, { x: 130, y: 130 }, { x: 80, y: 160 }, { x: 140, y: 200 }, { x: 100, y: 260 }] },
                    { path: 'M 80,160 L 190,160', checkpoints: [{ x: 80, y: 160 }, { x: 190, y: 160 }] },
                    { path: 'M 190,50 L 190,270', checkpoints: [{ x: 190, y: 50 }, { x: 190, y: 160 }, { x: 190, y: 270 }] },
                    { path: 'M 40,50 L 240,50', checkpoints: [{ x: 40, y: 50 }, { x: 140, y: 50 }, { x: 240, y: 50 }] }
                ]
            }
        ];

        // State Management
        let selectedChar = "{{ $selectedLetter }}";
        let currentIndex = 0;
        let activeStrokeIdx = 0;
        let activeCheckpointIdx = 0;

        // Flattened list of all checkpoints for active letter
        let allCheckpoints = [];
        let completedUserPaths = [];
        let isTracing = false;

        function getLetterObj(char) {
            let found = varnamalaData.find(item => item.char === char);
            return found ? found : varnamalaData[0];
        }

        // --------------------------------------------------------
        // RENDER VARGA CATEGORY TABS & LETTER CHIPS
        // --------------------------------------------------------
        function initTabsAndChips() {
            const vargas = ['क-वर्ग', 'च-वर्ग', 'ट-वर्ग', 'त-वर्ग', 'प-वर्ग', 'अन्तःस्थ', 'ऊष्म', 'संयुक्त'];
            const tabsContainer = document.getElementById('vargaTabsContainer');
            const activeObj = getLetterObj(selectedChar);

            let tabsHtml = '';
            vargas.forEach(v => {
                const isActive = (v === activeObj.group);
                tabsHtml += `<button class="tab-btn ${isActive ? 'active' : ''}" onclick="selectGroup('${v}')">${v}</button>`;
            });
            tabsContainer.innerHTML = tabsHtml;

            renderChipsForGroup(activeObj.group);
        }

        function renderChipsForGroup(groupName) {
            const chipsContainer = document.getElementById('lettersBarContainer');
            const items = varnamalaData.filter(i => i.group === groupName);

            let chipsHtml = '';
            items.forEach(item => {
                const isActive = (item.char === selectedChar);
                chipsHtml += `<div class="letter-chip ${isActive ? 'active' : ''}" onclick="selectLetter('${item.char}')">${item.char}</div>`;
            });
            chipsContainer.innerHTML = chipsHtml;
        }

        function selectGroup(groupName) {
            const firstInGroup = varnamalaData.find(i => i.group === groupName);
            if (firstInGroup) {
                selectLetter(firstInGroup.char);
            }
        }

        function selectLetter(char) {
            selectedChar = char;
            currentIndex = varnamalaData.findIndex(i => i.char === char);
            initTabsAndChips();
            loadLetterCard();
        }

        function nextLetter() {
            if (currentIndex < varnamalaData.length - 1) {
                selectLetter(varnamalaData[currentIndex + 1].char);
            } else {
                selectLetter(varnamalaData[0].char);
            }
        }

        function prevLetter() {
            if (currentIndex > 0) {
                selectLetter(varnamalaData[currentIndex - 1].char);
            } else {
                selectLetter(varnamalaData[varnamalaData.length - 1].char);
            }
        }

        // --------------------------------------------------------
        // LOAD & RENDER TRACING CARD & STROKE ENGINE
        // --------------------------------------------------------
        function loadLetterCard() {
            const letterObj = getLetterObj(selectedChar);

            // Update Titles & Phonics
            document.getElementById('charTitle').innerText = letterObj.char;
            document.getElementById('phoneticText').innerText = letterObj.phonetic;
            document.getElementById('pronunTitle').innerText = `${letterObj.phonetic} (${letterObj.char})`;
            document.getElementById('wordExampleText').innerText = `${letterObj.char} से ${letterObj.example}`;

            // Flatten checkpoints for tracking
            allCheckpoints = [];
            let globalPtIdx = 0;

            letterObj.strokes.forEach((stroke, sIdx) => {
                stroke.checkpoints.forEach((pt, pIdx) => {
                    allCheckpoints.push({
                        strokeIdx: sIdx,
                        pointIdx: pIdx,
                        globalIdx: globalPtIdx++,
                        x: pt.x,
                        y: pt.y,
                        isStart: (pIdx === 0),
                        isEnd: (pIdx === stroke.checkpoints.length - 1)
                    });
                });
            });

            activeCheckpointIdx = 0;
            completedUserPaths = [];

            renderSvgStage();
            speakCurrentLetter();
        }

        // Render SVG Layers
        function renderSvgStage() {
            const svg = document.getElementById('tracingSvg');
            const letterObj = getLetterObj(selectedChar);

            let html = '';

            // 1. Background Light Grey Letter Outlines
            letterObj.strokes.forEach((s, idx) => {
                const isHeadline = (idx === letterObj.strokes.length - 1);
                html += `<path d="${s.path}" class="${isHeadline ? 'shirorekha-path' : 'bg-letter-path'}" />`;
            });

            // 2. Bright Orange Dotted Tracing Path over Letter
            letterObj.strokes.forEach(s => {
                html += `<path d="${s.path}" class="dotted-trace-path" />`;
            });

            // 3. User Traced Lines Completed So Far
            completedUserPaths.forEach(p => {
                html += `<path d="${p}" class="user-drawn-path" />`;
            });

            // 4. Directional Arrows along strokes
            letterObj.strokes.forEach(s => {
                if (s.checkpoints.length >= 2) {
                    const p1 = s.checkpoints[0];
                    const p2 = s.checkpoints[1];
                    const midX = (p1.x + p2.x) / 2;
                    const midY = (p1.y + p2.y) / 2;
                    html += `
                        <circle cx="${midX}" cy="${midY}" r="4" class="arrow-path" />
                    `;
                }
            });

            // 5. Checkpoints, Numbers, START (Green) & END (Red) Badges
            allCheckpoints.forEach((cp, idx) => {
                const isActive = (idx === activeCheckpointIdx);
                const isDone = (idx < activeCheckpointIdx);

                if (cp.isStart) {
                    // Glowing Green START Badge 🟢
                    html += `
                        <g transform="translate(${cp.x}, ${cp.y})">
                            <circle r="14" class="badge-start" />
                            <text class="badge-label">GO</text>
                            <circle r="10" class="checkpoint-circle ${isActive ? 'active' : ''} ${isDone ? 'completed' : ''}" onclick="touchCheckpoint(${idx})" />
                            <text class="checkpoint-text">${idx + 1}</text>
                        </g>
                    `;
                } else if (cp.isEnd && cp.strokeIdx === letterObj.strokes.length - 1) {
                    // Red END Badge 🔴
                    html += `
                        <g transform="translate(${cp.x}, ${cp.y})">
                            <circle r="14" class="badge-end" />
                            <text class="badge-label">END</text>
                            <circle r="10" class="checkpoint-circle ${isActive ? 'active' : ''} ${isDone ? 'completed' : ''}" onclick="touchCheckpoint(${idx})" />
                            <text class="checkpoint-text">${idx + 1}</text>
                        </g>
                    `;
                } else {
                    // Standard Numbered Checkpoint (1, 2, 3...)
                    html += `
                        <g transform="translate(${cp.x}, ${cp.y})">
                            <circle r="12" class="checkpoint-circle ${isActive ? 'active' : ''} ${isDone ? 'completed' : ''}" onclick="touchCheckpoint(${idx})" />
                            <text class="checkpoint-text">${idx + 1}</text>
                        </g>
                    `;
                }
            });

            svg.innerHTML = html;
        }

        // Touch / Mouse Click Checkpoint Handler
        function touchCheckpoint(idx) {
            if (idx === activeCheckpointIdx) {
                advanceCheckpoint();
            } else if (idx < activeCheckpointIdx) {
                // Already completed point
            } else {
                // Out of order - gentle guidance
                playSoftChime('pop');
            }
        }

        function advanceCheckpoint() {
            activeCheckpointIdx++;
            playSoftChime('click');

            if (activeCheckpointIdx >= allCheckpoints.length) {
                // Letter Tracing Completed!
                onLetterCompleted();
            } else {
                renderSvgStage();
            }
        }

        function onLetterCompleted() {
            renderSvgStage();
            playSoftChime('success');

            // Launch Confetti Celebration 🎉
            confetti({
                particleCount: 80,
                spread: 70,
                origin: { y: 0.6 }
            });

            // Speak success
            const letterObj = getLetterObj(selectedChar);
            speakText(`Shabash! ${letterObj.char} se ${letterObj.example.split(' ')[0]}!`);

            // Auto advance to next letter after 2.5 seconds
            setTimeout(() => {
                if (currentIndex < varnamalaData.length - 1) {
                    nextLetter();
                }
            }, 2500);
        }

        // Interactive Touch Dragging Engine over SVG Canvas
        const svgElement = document.getElementById('tracingSvg');

        function getSvgCoords(e) {
            const rect = svgElement.getBoundingClientRect();
            let clientX = e.clientX;
            let clientY = e.clientY;

            if (e.touches && e.touches.length > 0) {
                clientX = e.touches[0].clientX;
                clientY = e.touches[0].clientY;
            }

            const viewBox = svgElement.viewBox.baseVal;
            const x = ((clientX - rect.left) / rect.width) * viewBox.width;
            const y = ((clientY - rect.top) / rect.height) * viewBox.height;

            return { x, y };
        }

        svgElement.addEventListener('touchstart', (e) => {
            isTracing = true;
            checkProximity(getSvgCoords(e));
        }, { passive: true });

        svgElement.addEventListener('touchmove', (e) => {
            if (isTracing) {
                checkProximity(getSvgCoords(e));
            }
        }, { passive: true });

        svgElement.addEventListener('touchend', () => { isTracing = false; });
        svgElement.addEventListener('mousedown', (e) => { isTracing = true; checkProximity(getSvgCoords(e)); });
        svgElement.addEventListener('mousemove', (e) => { if (isTracing) checkProximity(getSvgCoords(e)); });
        svgElement.addEventListener('mouseup', () => { isTracing = false; });

        function checkProximity(pos) {
            if (activeCheckpointIdx >= allCheckpoints.length) return;

            const target = allCheckpoints[activeCheckpointIdx];
            const dist = Math.hypot(pos.x - target.x, pos.y - target.y);

            if (dist < 28) {
                advanceCheckpoint();
            }
        }

        // --------------------------------------------------------
        // AUDIO SPEECH & SOUND SYNTHESIS
        // --------------------------------------------------------
        function speakCurrentLetter() {
            const letterObj = getLetterObj(selectedChar);
            speakText(`${letterObj.char}. ${letterObj.phonetic}. ${letterObj.char} se ${letterObj.example.split(' ')[0]}`);
        }

        function speakText(text) {
            if ('speechSynthesis' in window) {
                window.speechSynthesis.cancel();
                const utterance = new SpeechSynthesisUtterance(text);
                utterance.lang = 'hi-IN';
                utterance.rate = 0.82;
                utterance.pitch = 1.35; // Cute kid friendly tone
                window.speechSynthesis.speak(utterance);
            }
        }

        function playSoftChime(type) {
            try {
                const ctx = new (window.AudioContext || window.webkitAudioContext)();
                const osc = ctx.createOscillator();
                const gain = ctx.createGain();
                osc.connect(gain);
                gain.connect(ctx.destination);

                const now = ctx.currentTime;
                if (type === 'click') {
                    osc.frequency.setValueAtTime(520, now);
                    osc.frequency.exponentialRampToValueAtTime(780, now + 0.08);
                    gain.gain.setValueAtTime(0.3, now);
                    gain.gain.linearRampToValueAtTime(0.01, now + 0.08);
                } else if (type === 'success') {
                    osc.frequency.setValueAtTime(523.25, now);
                    osc.frequency.setValueAtTime(659.25, now + 0.12);
                    osc.frequency.setValueAtTime(783.99, now + 0.24);
                    gain.gain.setValueAtTime(0.3, now);
                    gain.gain.linearRampToValueAtTime(0.01, now + 0.4);
                }
                osc.start(now);
                osc.stop(now + 0.4);
            } catch (e) { }
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
                } catch (e) { }
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

        // Card Blinking Engine (Disabled)
        const CardBlinker = { init() {}, stop() {} };

        // Initialize Module on Load
        window.addEventListener('DOMContentLoaded', () => {
            initTabsAndChips();
            loadLetterCard();

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
        });
    </script>

    <!-- Global Floating Background Music (BGM) Controller Icon -->
    <div class="floating-bgm-container">
        <button class="btn-bgm bgm-toggle-btn" onclick="BGM.toggle()" title="Toggle Background Music"
            aria-label="Toggle Background Music">
            🎵
        </button>
    </div>
</body>

</html>