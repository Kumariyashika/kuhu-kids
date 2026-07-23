@extends('layouts.app')

@section('title', 'Kuhu Kids Learning - Phonics Sounds')

@section('content')
    <!-- Include Canvas Confetti -->
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

    <style>
        /* Dragonfly Mascot CSS animations */
        .dragonfly-mascot {
            animation: floatDragonfly 3s ease-in-out infinite alternate;
            z-index: 10;
            position: relative;
            margin-bottom: 5px;
            filter: drop-shadow(0 8px 12px rgba(0, 0, 0, 0.12));
        }

        @keyframes floatDragonfly {
            0% {
                transform: translateY(0) rotate(-2deg);
            }

            100% {
                transform: translateY(-16px) rotate(2deg);
            }
        }

        .wing {
            animation: flapWingLeft 0.1s linear infinite alternate;
        }

        .wing-left-top,
        .wing-left-bottom {
            animation-name: flapWingLeft;
        }

        .wing-right-top,
        .wing-right-bottom {
            animation-name: flapWingRight;
        }

        @keyframes flapWingLeft {
            0% {
                transform: scaleY(0.5) rotate(-8deg);
            }

            100% {
                transform: scaleY(1.1) rotate(8deg);
            }
        }

        @keyframes flapWingRight {
            0% {
                transform: scaleY(0.5) rotate(8deg);
            }

            100% {
                transform: scaleY(1.1) rotate(-8deg);
            }
        }

        /* Speech Bubble */
        .dragonfly-bubble {
            position: relative;
            background: #FFFDF0;
            border: 4px solid #00C2CB;
            border-radius: 24px;
            padding: 14px 28px;
            text-align: center;
            max-width: 480px;
            box-shadow: 0 8px 0 rgba(0, 194, 203, 0.2);
            animation: pulseBubble 3s ease-in-out infinite alternate;
            margin-bottom: 25px;
        }

        @keyframes pulseBubble {
            0% {
                transform: scale(0.98);
            }

            100% {
                transform: scale(1.02);
            }
        }

        .dragonfly-bubble::after {
            content: '';
            position: absolute;
            top: -24px;
            left: 50%;
            transform: translateX(-50%);
            border-width: 12px;
            border-style: solid;
            border-color: transparent transparent #FFFDF0 transparent;
            z-index: 2;
        }

        .dragonfly-bubble::before {
            content: '';
            position: absolute;
            top: -30px;
            left: 50%;
            transform: translateX(-50%);
            border-width: 13px;
            border-style: solid;
            border-color: transparent transparent #00C2CB transparent;
            z-index: 1;
        }

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
    </style>

    <!-- Phonics Welcome Screen: Dragonfly Dashboard -->
    <div id="phonicsMenuScreen" style="width: 100%; max-width: 900px; margin: 0 auto; font-family: 'Fredoka', sans-serif;">
        <!-- Header -->
        <div class="inner-header">
            <h1 class="inner-title">
                <span style="color: var(--color-orange);">📢 Phonics Sounds</span>
            </h1>
            <a href="{{ route('dashboard') }}" class="btn-3d btn-yellow"
                style="display: flex; align-items: center; justify-content: center; border-radius: 50%; width: 44px; height: 44px; padding: 0; text-decoration: none; margin: 0;"
                title="Back to Home">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                    stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
            </a>
        </div>

        <!-- Dragonfly Welcome Mascot -->
        <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
            <div class="dragonfly-mascot">
                <svg viewBox="0 0 100 100" width="130" height="130">
                    <ellipse cx="32" cy="38" rx="25" ry="8" fill="rgba(179, 229, 252, 0.85)" stroke="#0288D1"
                        stroke-width="2.5" class="wing wing-left-top" style="transform-origin: 50px 45px;" />
                    <ellipse cx="35" cy="48" rx="20" ry="7" fill="rgba(179, 229, 252, 0.65)" stroke="#0288D1"
                        stroke-width="2" class="wing wing-left-bottom" style="transform-origin: 50px 45px;" />
                    <ellipse cx="68" cy="38" rx="25" ry="8" fill="rgba(179, 229, 252, 0.85)" stroke="#0288D1"
                        stroke-width="2.5" class="wing wing-right-top" style="transform-origin: 50px 45px;" />
                    <ellipse cx="65" cy="48" rx="20" ry="7" fill="rgba(179, 229, 252, 0.65)" stroke="#0288D1"
                        stroke-width="2" class="wing wing-right-bottom" style="transform-origin: 50px 45px;" />
                    <ellipse cx="50" cy="45" rx="8" ry="14" fill="#00C2CB" stroke="#0097A7" stroke-width="3" />
                    <path d="M 50 59 C 50 75, 47 88, 48 94" stroke="#00C2CB" stroke-width="7" stroke-linecap="round"
                        fill="none" />
                    <circle cx="44" cy="36" r="5" fill="#FFF" />
                    <circle cx="44" cy="36" r="2.2" fill="#000" />
                    <circle cx="56" cy="36" r="5" fill="#FFF" />
                    <circle cx="56" cy="36" r="2.2" fill="#000" />
                    <path d="M 46 45 Q 50 49 54 45" stroke="#000" stroke-width="2" fill="none" stroke-linecap="round" />
                </svg>
            </div>
            <!-- Speech Bubble -->
            <div class="dragonfly-bubble">
                <span style="font-size: 1.3rem; font-weight: bold; color: #4A3B00;">Hi! Chalo card decks padhna shuru
                    karein! 🐉✨</span>
            </div>
        </div>

        <!-- Deck Selector Grid -->
        <div
            style="background: radial-gradient(circle, #FFFDF0 0%, #FFF5D1 100%); padding: 30px; border-radius: 36px; border: 6px solid var(--color-orange); box-shadow: 0 15px 0 var(--color-orange-shadow); margin-bottom: 24px; text-align: center;">
            <h2
                style="color: var(--color-orange); font-size: 1.6rem; font-weight: 900; margin: 0 0 25px 0; text-shadow: 1px 1px 0 #FFF;">
                Select a Deck to Play! 👇</h2>

            <div class="menu-decks-grid"
                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px;">
                <!-- English Letters -->
                <button onclick="startReader('english_letters')" class="btn-3d btn-pink"
                    style="padding: 24px 16px; border-radius: 24px; font-size: 1.25rem; font-weight: 800; display: flex; flex-direction: column; align-items: center; gap: 10px; cursor: pointer;">
                    <span style="font-size: 3rem;">🔤</span>
                    <span>English Letters (A-Z)</span>
                </button>
                <!-- English Words -->
                <button onclick="startReader('english_words')" class="btn-3d btn-pink"
                    style="padding: 24px 16px; border-radius: 24px; font-size: 1.25rem; font-weight: 800; display: flex; flex-direction: column; align-items: center; gap: 10px; cursor: pointer; background: #FF914D; border-bottom-color: #D97336;">
                    <span style="font-size: 3rem;">🍎</span>
                    <span>English Words (A-Z)</span>
                </button>
                <!-- Numbers 1 to 50 -->
                <button onclick="startReader('numbers')" class="btn-3d"
                    style="padding: 24px 16px; border-radius: 24px; font-size: 1.25rem; font-weight: 800; display: flex; flex-direction: column; align-items: center; gap: 10px; cursor: pointer; background: #FFDE59; border-bottom: 8px solid #CCB143; color: #4A3B00;">
                    <span style="font-size: 3rem;">🔢</span>
                    <span>Numbers (1 to 50)</span>
                </button>
                <!-- Number Words -->
                <button onclick="startReader('number_words')" class="btn-3d"
                    style="padding: 24px 16px; border-radius: 24px; font-size: 1.25rem; font-weight: 800; display: flex; flex-direction: column; align-items: center; gap: 10px; cursor: pointer; background: #7ED957; border-bottom: 8px solid #63AA43; color: #FFF;">
                    <span style="font-size: 3rem;">🪙</span>
                    <span>Number Words (1-20)</span>
                </button>
                <!-- Hindi Letters -->
                <button onclick="startReader('hindi_letters')" class="btn-3d"
                    style="padding: 24px 16px; border-radius: 24px; font-size: 1.25rem; font-weight: 800; display: flex; flex-direction: column; align-items: center; gap: 10px; cursor: pointer; background: #8C52FF; border-bottom: 8px solid #6E3CD9; color: #FFF;">
                    <span style="font-size: 3rem;">🕉️</span>
                    <span>Hindi Letters (क-ज्ञ)</span>
                </button>
                <!-- Hindi Words -->
                <button onclick="startReader('hindi_words')" class="btn-3d"
                    style="padding: 24px 16px; border-radius: 24px; font-size: 1.25rem; font-weight: 800; display: flex; flex-direction: column; align-items: center; gap: 10px; cursor: pointer; background: #00C2CB; border-bottom: 8px solid #0097A7; color: #FFF;">
                    <span style="font-size: 3rem;">🕊️</span>
                    <span>Hindi Words (क-ज्ञ)</span>
                </button>
            </div>
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
            <span id="deckInstruction" style="color: #4A3B00; font-size: 1.25rem; font-weight: bold;">Press any card to hear
                the sounds!</span>
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

        <!-- Progress Tracking Bar -->
        <div style="text-align: center; margin-bottom: 25px;">
            <div
                style="width: 100%; max-width: 400px; height: 16px; background: #E5E7EB; border-radius: 8px; overflow: hidden; margin: 10px auto; border: 2px solid #E2E8F0;">
                <div id="readerProgressBar"
                    style="width: 0%; height: 100%; background: linear-gradient(to right, #4CAF50, #81C784); transition: width 0.3s ease;">
                </div>
            </div>
            <div id="readerProgressText" style="font-weight: 900; color: #4A3B00; font-size: 1.25rem;">1 of 26</div>
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

        function showScreen(screenId) {
            const screens = ['phonicsMenuScreen', 'phonicsReaderScreen'];
            screens.forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    el.style.display = (id === screenId) ? 'block' : 'none';
                }
            });
            if (screenId !== 'phonicsReaderScreen') {
                stopAutoplay();
            }
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
            if (instrEl) instrEl.innerText = instrText;

            showScreen('phonicsReaderScreen');
            renderCard();

            // Auto speak first card
            setTimeout(() => {
                speakCurrentCard();
            }, 500);
        }

        function renderCard() {
            const container = document.getElementById('giantPhonicsCardContainer');
            if (!container || currentDataList.length === 0) return;

            const item = currentDataList[readerIndex];
            const color = colors[readerIndex % colors.length];

            const card = document.createElement('div');
            card.className = 'giant-phonic-card';
            card.style.setProperty('--card-color', color);
            card.onclick = (e) => {
                triggerConfettiOnCard(e);
                speakCurrentCard();
            };

            if (currentCategory === 'english_letters' || currentCategory === 'hindi_letters' || currentCategory === 'numbers') {
                const tapLabel = currentCategory === 'english_letters' ? 'Tap Me! 🔊' : (currentCategory === 'hindi_letters' ? 'सुनें! 🔊' : 'Count! 🔢');
                card.innerHTML = `
                            <span class="giant-big-letter" style="color: ${color};">${item.display}</span>
                            <span class="giant-tap-label">${tapLabel}</span>
                        `;
            } else {
                // Extract emoji
                let wordText = item.word;
                let emoji = '🍎';
                const emojiRegex = /[\p{Emoji_Presentation}\p{Emoji}\u200d]+/gu;
                const match = item.word.match(emojiRegex);
                if (match) {
                    emoji = match[0];
                    wordText = item.word.replace(emojiRegex, '').trim();
                }

                const subLabel = currentCategory === 'english_words' ? `${item.letter} for` : (currentCategory === 'hindi_words' ? `${item.letter} से` : `value of`);

                card.innerHTML = `
                            <div style="display: flex; justify-content: space-between; width: 100%; align-items: center; margin-bottom: 5px;">
                                <span class="giant-letter-bubble" style="background: ${color};">${item.letter}</span>
                                <span style="font-size: 1.15rem; color: #888; font-weight: bold; font-family: 'Fredoka', sans-serif;">${subLabel}</span>
                            </div>
                            <span class="giant-emoji-graphic">${emoji}</span>
                            <span class="giant-word-label">${wordText}</span>
                        `;
            }

            container.innerHTML = '';
            container.appendChild(card);

            // Update Progress Tracking
            const progressPct = ((readerIndex + 1) / currentDataList.length) * 100;
            const bar = document.getElementById('readerProgressBar');
            if (bar) bar.style.width = progressPct + '%';

            const progressText = document.getElementById('readerProgressText');
            if (progressText) {
                progressText.innerText = `${readerIndex + 1} of ${currentDataList.length}`;
            }
        }

        function speakCurrentCard() {
            if (currentDataList.length === 0) return;
            const item = currentDataList[readerIndex];

            if (window.SoundFX && typeof window.SoundFX.play === 'function') {
                window.SoundFX.play('click');
            }

            if (localStorage.getItem('voice_enabled') !== 'false' && window.SoundFX && typeof window.SoundFX.speak === 'function') {
                let textToSpeak = item.phrase;
                if (currentCategory === 'english_letters') {
                    textToSpeak = `${item.letter} says ${item.sound}`;
                }
                window.SoundFX.speak(textToSpeak, item.lang || 'en-US');
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
            }, 3500);
        }

        document.addEventListener('DOMContentLoaded', () => {
            showScreen('phonicsMenuScreen');
        });
    </script>
    @endsectiont>
@endsection