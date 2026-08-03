@extends('layouts.app')

@section('title', 'Kuhu Kids Learning - Quiz Time')

@section('content')
    <!-- Include Canvas Confetti -->
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

    <style>
        html, body {
            padding: 0 !important;
            margin: 0 !important;
            width: 100% !important;
            min-height: 100vh !important;
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

        /* Outer Quiz Container */
        .quiz-page-wrapper {
            width: 100% !important;
            max-width: 880px !important;
            margin: 0 auto !important;
            padding: 10px 10px 30px 10px !important;
            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
            border-radius: 0 !important;
            min-height: 100vh;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
        }

        /* Top Header Navigation */
        .quiz-top-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 14px;
            padding: 4px 6px;
        }

        .quiz-title-box {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .quiz-top-title {
            margin: 0;
            font-size: 1.8rem;
            font-family: 'Fredoka', sans-serif;
            font-weight: 900;
            color: #8C52FF;
            text-shadow: 0 2px 4px rgba(255,255,255,0.9);
        }

        /* Score Badge */
        .quiz-score-badge {
            background: linear-gradient(145deg, #FFE873 0%, #FFDE59 100%);
            border: 3px solid #E6C438;
            border-bottom: 5px solid #C4A51D;
            border-radius: 20px;
            padding: 6px 16px;
            font-weight: 900;
            color: #4A3B00;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 6px 14px rgba(0,0,0,0.1);
            font-size: 1.15rem;
            font-family: 'Fredoka', sans-serif;
        }

        /* Main 3D Premium Quiz Frame Card */
        .quiz-3d-card-frame {
            background: linear-gradient(145deg, #FFFFFF 0%, #F5F3FF 100%);
            border: 4px solid #A855F7;
            border-bottom: 10px solid #7E22CE;
            border-radius: 32px;
            padding: 24px;
            min-height: 480px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            position: relative;
            box-shadow: inset 0 4px 0 rgba(255,255,255,0.8), 0 16px 36px rgba(126, 34, 206, 0.18);
            width: 100%;
            box-sizing: border-box;
            flex: 1;
        }

        /* Progress Area */
        .quiz-progress-box {
            width: 100%;
            margin-bottom: 16px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .quiz-progress-text {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 900;
            color: #6B21A8;
            font-size: 1.15rem;
            font-family: 'Fredoka', sans-serif;
        }

        .quiz-progress-badge {
            background: #9333EA;
            color: white;
            padding: 3px 12px;
            border-radius: 14px;
            font-size: 1rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .quiz-progress-track {
            width: 100%;
            height: 16px;
            background: #E9D5FF;
            border-radius: 12px;
            overflow: hidden;
            padding: 2px;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.08);
            box-sizing: border-box;
        }

        .quiz-progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #A855F7 0%, #EC4899 100%);
            border-radius: 10px;
            transition: width 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        /* Question Box */
        .question-illustration-box {
            width: 100%;
            background: linear-gradient(135deg, #FFFDF0 0%, #FFFFFF 100%);
            border-radius: 28px;
            padding: 22px 18px;
            border: 3.5px solid #FFDE59;
            border-bottom: 8px solid #E6C438;
            box-shadow: inset 0 3px 0 #FFF, 0 10px 22px rgba(0,0,0,0.06);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            text-align: center;
            box-sizing: border-box;
        }

        .question-emoji-icon {
            font-size: 4.5rem;
            margin-bottom: 10px;
            animation: floatEmoji 2.5s ease-in-out infinite alternate;
            filter: drop-shadow(0 8px 14px rgba(0,0,0,0.15));
        }

        .question-main-text {
            font-size: 1.55rem;
            font-weight: 900;
            color: #1E293B;
            margin: 0;
            line-height: 1.35;
            font-family: 'Fredoka', sans-serif;
            text-shadow: 0 1px 2px rgba(255,255,255,0.8);
        }

        /* 2x2 Options Grid */
        .quiz-options-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            width: 100%;
            margin-bottom: 8px;
        }

        /* 3D Tactile Option Button */
        .quiz-option-btn {
            background: linear-gradient(145deg, #FFFFFF 0%, #F8FAFC 100%);
            border: 3.5px solid #CBD5E1;
            border-bottom: 8px solid #94A3B8;
            border-radius: 22px;
            padding: 16px 18px;
            font-size: 1.35rem;
            font-weight: 900;
            color: #1E293B;
            cursor: pointer;
            transition: all 0.15s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: inset 0 3px 0 #FFF, 0 6px 14px rgba(0,0,0,0.06);
            font-family: 'Fredoka', sans-serif;
            user-select: none;
        }

        .quiz-option-btn:hover {
            transform: translateY(-4px) scale(1.02);
            border-color: #A855F7;
            box-shadow: inset 0 3px 0 #FFF, 0 10px 20px rgba(168, 85, 247, 0.2);
        }

        .quiz-option-btn:active {
            transform: translateY(2px);
            border-bottom-width: 4px;
        }

        .quiz-option-correct {
            background: linear-gradient(145deg, #4ADE80 0%, #22C55E 100%) !important;
            border-color: #16A34A !important;
            border-bottom: 8px solid #15803D !important;
            color: #FFFFFF !important;
            animation: pulseCorrect 0.4s ease;
        }

        .quiz-option-wrong {
            background: linear-gradient(145deg, #FF6B6B 0%, #EE5252 100%) !important;
            border-color: #DC2626 !important;
            border-bottom: 8px solid #991B1B !important;
            color: #FFFFFF !important;
            animation: shakeWrong 0.4s ease;
        }

        /* Interactive Gift Unboxing Modal Elements */
        .gift-box-bounce {
            font-size: 6rem;
            cursor: pointer;
            animation: giftBounce 1.2s ease-in-out infinite alternate;
            user-select: none;
            filter: drop-shadow(0 12px 20px rgba(255, 184, 0, 0.5));
            transition: transform 0.2s ease;

        }

        .gift-box-bounce:hover {
            transform: scale(1.25) rotate(8deg);
        }

        .toy-emoji-hero {
            font-size: 6rem;
            animation: toyRevealPop 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
            filter: drop-shadow(0 12px 24px rgba(0,0,0,0.25));
        }

        @keyframes giftBounce {
            0% { transform: translateY(0) scale(1) rotate(-3deg); }
            100% { transform: translateY(-20px) scale(1.15) rotate(4deg); }
        }

        @keyframes toyRevealPop {
            0% { transform: scale(0.2) rotate(-20deg); opacity: 0; }
            70% { transform: scale(1.28) rotate(10deg); opacity: 1; }
            100% { transform: scale(1) rotate(0deg); opacity: 1; }
        }

        @keyframes floatEmoji {
            0% { transform: translateY(0) scale(1); }
            100% { transform: translateY(-10px) scale(1.08); }
        }

        @keyframes pulseCorrect {
            0% { transform: scale(1); }
            50% { transform: scale(1.06); }
            100% { transform: scale(1); }
        }

        @keyframes shakeWrong {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-8px); }
            75% { transform: translateX(8px); }
        }

        @media (max-width: 640px) {
            .quiz-options-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .question-main-text {
                font-size: 1.3rem;
            }

            .question-emoji-icon {
                font-size: 3.6rem;
            }

            .quiz-option-btn {
                font-size: 1.2rem;
                padding: 14px;
            }

            .quiz-top-title {
                font-size: 1.4rem;
            }
        }
    </style>

    <div class="quiz-page-wrapper">
        <!-- Top Header Navigation -->
        <div class="quiz-top-header">
            <div class="quiz-title-box">
                <a href="{{ route('dashboard') }}" class="btn-3d btn-yellow"
                    style="display: flex; align-items: center; justify-content: center; border-radius: 50%; width: 44px; height: 44px; padding: 0; text-decoration: none; margin: 0; flex-shrink: 0;"
                    title="Back to Home">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                        stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                </a>
                <h1 class="quiz-top-title">❓ Kids Quiz Game</h1>
            </div>

            <!-- Score Badge -->
            <div class="quiz-score-badge">
                🎯 Correct: <span id="scoreDisplay" style="color: #FF914D; font-size: 1.3rem;">0 / 5</span>
            </div>
        </div>

        <!-- Main 3D Quiz Card Arena -->
        <div class="quiz-3d-card-frame">

            <!-- Top Progress Header -->
            <div id="progressArea" class="quiz-progress-box">
                <div class="quiz-progress-text">
                    <span style="display: flex; align-items: center; gap: 8px;">
                        <span>📖 Question</span>
                        <span id="currentQuestionNum" class="quiz-progress-badge">1</span>
                        <span>of 5</span>
                    </span>
                </div>

                <!-- Animated Progress Bar -->
                <div class="quiz-progress-track">
                    <div id="progressBarFill" class="quiz-progress-fill" style="width: 20%;"></div>
                </div>
            </div>

            <!-- Active Question Content -->
            <div id="quizContent" style="width: 100%; display: flex; flex-direction: column; align-items: center; justify-content: space-between; flex: 1;">

                <!-- Question Box with Mascot & Big Emoji Illustration -->
                <div class="question-illustration-box">
                    <div id="questionEmoji" class="question-emoji-icon">🍌</div>
                    <h2 id="questionText" class="question-main-text">Loading question...</h2>
                </div>

                <!-- 2x2 Options Grid -->
                <div id="optionsGrid" class="quiz-options-grid">
                    <!-- Choice buttons generated via JS -->
                </div>
            </div>

            <!-- Result Screen A: Surprise Gift Unboxing (Score >= 3) -->
            <div id="giftResultCard" style="display: none; flex-direction: column; align-items: center; justify-content: center; text-align: center; gap: 16px; padding: 15px; width: 100%; flex: 1;">
                
                <!-- Closed Gift Box State -->
                <div id="giftClosedBoxState" style="display: flex; flex-direction: column; align-items: center; gap: 14px;">
                    <div class="gift-box-bounce" onclick="openSurpriseGift()" title="Tap to Open Gift!">🎁</div>
                    <h2 style="font-size: 2.0rem; font-weight: 900; color: #16A34A; margin: 0; font-family: 'Fredoka', sans-serif;">
                        🎉 YOU WON A SURPRISE GIFT! 🎉
                    </h2>
                    <p id="giftBoxSubtitle" style="font-size: 1.25rem; font-weight: 800; color: #4B5563; margin: 0; font-family: 'Fredoka', sans-serif;">
                        Awesome! Tap the gift box to open your toy reward! 🎁
                    </p>
                </div>

                <!-- Opened Gift Revealed State -->
                <div id="giftOpenedBoxState" style="display: none; flex-direction: column; align-items: center; gap: 14px;">
                    <div id="quizToyEmoji" class="toy-emoji-hero">🧸</div>
                    <h2 id="quizToyTitle" style="font-size: 2.2rem; font-weight: 900; color: #9333EA; margin: 0; font-family: 'Fredoka', sans-serif;">
                        Teddy Bear!
                    </h2>
                    <p id="quizToyScoreText" style="font-size: 1.2rem; font-weight: 800; color: #16A34A; margin: 0; font-family: 'Fredoka', sans-serif;">
                        Great Job! You scored 4 out of 5! 🌟
                    </p>

                    <div style="display: flex; gap: 14px; margin-top: 12px;">
                        <button onclick="restartQuiz()" class="btn-3d btn-green" style="font-size: 1.15rem; padding: 12px 28px;">
                            🔄 Play Again
                        </button>
                        <a href="{{ route('dashboard') }}" class="btn-3d btn-yellow" style="font-size: 1.15rem; padding: 12px 28px; text-decoration: none;">
                            🏠 Home
                        </a>
                    </div>
                </div>

            </div>

            <!-- Result Screen B: Try Again (Score < 3) -->
            <div id="tryAgainResultCard" style="display: none; flex-direction: column; align-items: center; justify-content: center; text-align: center; gap: 16px; padding: 15px; width: 100%; flex: 1;">
                <div style="font-size: 5rem; animation: floatEmoji 2s ease-in-out infinite alternate;">💪</div>
                <h2 style="font-size: 2.0rem; font-weight: 900; color: #FF914D; margin: 0; font-family: 'Fredoka', sans-serif;">
                    KEEP TRYING! / फिर से कोशिश करो! 💪
                </h2>
                <p id="tryAgainText" style="font-size: 1.2rem; font-weight: 800; color: #4B5563; margin: 0; font-family: 'Fredoka', sans-serif;">
                    You scored 2 of 5. Get at least 3 correct answers to unlock a surprise gift! 🎁
                </p>

                <div style="display: flex; gap: 14px; margin-top: 14px;">
                    <button onclick="restartQuiz()" class="btn-3d btn-yellow" style="font-size: 1.2rem; padding: 14px 32px;">
                        🔄 Try Again / फिर से खेलो
                    </button>
                </div>
            </div>

        </div>
    </div>

    <script>
        const toyList = [
            { name: "Teddy Bear", emoji: "🧸" },
            { name: "Race Car", emoji: "🏎️" },
            { name: "Space Rocket", emoji: "🚀" },
            { name: "Robot", emoji: "🤖" },
            { name: "Unicorn", emoji: "🦄" },
            { name: "Toy Train", emoji: "🚂" },
            { name: "Dinosaur", emoji: "🦕" },
            { name: "Color Palette", emoji: "🎨" },
            { name: "Royal Crown", emoji: "👑" },
            { name: "Ice Cream", emoji: "🍦" }
        ];

        const questionPool = [
            {
                q: "Which color is a delicious ripe banana?",
                emoji: "🍌",
                options: ["Red 🍎", "Green 🍏", "Yellow 🍌", "Blue 💧"],
                correct: 2,
                speech: "Which color is a ripe banana?"
            },
            {
                q: "How many legs does a cute doggie have?",
                emoji: "🐶",
                options: ["2 Legs 🦵", "4 Legs 🐾", "6 Legs 🐜", "8 Legs 🕷️"],
                correct: 1,
                speech: "How many legs does a dog have?"
            },
            {
                q: "Which shape is perfectly round like a ball?",
                emoji: "⚽",
                options: ["Triangle 🔺", "Square ⬜", "Star ⭐", "Circle ⚪"],
                correct: 3,
                speech: "Which shape is round like a ball?"
            },
            {
                q: "Which animal is known as the King of the Jungle?",
                emoji: "🦁",
                options: ["Elephant 🐘", "Lion 🦁", "Giraffe 🦒", "Monkey 🐒"],
                correct: 1,
                speech: "Which animal is the King of the Jungle?"
            },
            {
                q: "What yummy fruit is red and starts with the letter A?",
                emoji: "🍎",
                options: ["Mango 🥭", "Banana 🍌", "Apple 🍎", "Orange 🍊"],
                correct: 2,
                speech: "What fruit is red and starts with letter A?"
            },
            {
                q: "What color is the bright shining Sun in the sky?",
                emoji: "☀️",
                options: ["Yellow ☀️", "Purple 🍆", "Pink 🌸", "Black 🌑"],
                correct: 0,
                speech: "What color is the sun in the sky?"
            },
            {
                q: "Which friendly animal gives us fresh healthy milk?",
                emoji: "🥛",
                options: ["Cat 🐱", "Cow 🐮", "Lion 🦁", "Bird 🐦"],
                correct: 1,
                speech: "Which animal gives us milk?"
            },
            {
                q: "How many fingers do you have on one hand?",
                emoji: "🖐️",
                options: ["3 Fingers", "4 Fingers", "5 Fingers 🖐️", "10 Fingers"],
                correct: 2,
                speech: "How many fingers do you have on one hand?"
            }
        ];

        let questions = [];
        let currentQuestionIdx = 0;
        let correctCount = 0;
        let selectedToy = null;

        const currentQuestionNum = document.getElementById('currentQuestionNum');
        const scoreDisplay = document.getElementById('scoreDisplay');
        const progressBarFill = document.getElementById('progressBarFill');
        const questionText = document.getElementById('questionText');
        const questionEmoji = document.getElementById('questionEmoji');
        const optionsGrid = document.getElementById('optionsGrid');

        const progressArea = document.getElementById('progressArea');
        const quizContent = document.getElementById('quizContent');
        const giftResultCard = document.getElementById('giftResultCard');
        const tryAgainResultCard = document.getElementById('tryAgainResultCard');
        const giftClosedBoxState = document.getElementById('giftClosedBoxState');
        const giftOpenedBoxState = document.getElementById('giftOpenedBoxState');

        function shuffleArray(array) {
            const arr = [...array];
            for (let i = arr.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [arr[i], arr[j]] = [arr[j], arr[i]];
            }
            return arr;
        }

        function initQuiz() {
            questions = shuffleArray(questionPool).slice(0, 5);
            currentQuestionIdx = 0;
            correctCount = 0;
            scoreDisplay.innerText = `${correctCount} / 5`;
            progressArea.style.display = 'flex';
            quizContent.style.display = 'flex';
            giftResultCard.style.display = 'none';
            tryAgainResultCard.style.display = 'none';
            giftClosedBoxState.style.display = 'flex';
            giftOpenedBoxState.style.display = 'none';
            loadQuestion();
        }

        function loadQuestion() {
            if (currentQuestionIdx >= questions.length) {
                showResults();
                return;
            }

            currentQuestionNum.innerText = currentQuestionIdx + 1;
            progressBarFill.style.width = ((currentQuestionIdx + 1) / questions.length) * 100 + "%";

            const currentQ = questions[currentQuestionIdx];
            questionText.innerText = currentQ.q;
            questionEmoji.innerText = currentQ.emoji;
            optionsGrid.innerHTML = '';

            // Speak question in cute child voice
            if (localStorage.getItem('voice_enabled') !== 'false') {
                if (typeof SoundFX !== 'undefined' && SoundFX.speak) {
                    SoundFX.speak(currentQ.speech, 'en-US');
                }
            }

            currentQ.options.forEach((opt, idx) => {
                const btn = document.createElement('button');
                btn.className = 'quiz-option-btn';
                btn.innerText = opt;
                btn.onclick = () => selectOption(idx, btn);
                optionsGrid.appendChild(btn);
            });
        }

        function selectOption(selectedIdx, buttonElement) {
            const currentQ = questions[currentQuestionIdx];

            // Disable buttons
            Array.from(optionsGrid.children).forEach(btn => btn.disabled = true);

            if (selectedIdx === currentQ.correct) {
                // Correct answer!
                if (typeof SoundFX !== 'undefined' && SoundFX.play) {
                    SoundFX.play('success');
                }
                buttonElement.classList.add('quiz-option-correct');
                correctCount++;
                scoreDisplay.innerText = `${correctCount} / 5`;

                if (localStorage.getItem('voice_enabled') !== 'false') {
                    if (typeof SoundFX !== 'undefined' && SoundFX.speak) {
                        SoundFX.speak("Yay! Correct!", 'en-US');
                    }
                }

                if (typeof confetti === 'function') {
                    confetti({
                        particleCount: 60,
                        spread: 60,
                        origin: { y: 0.7 }
                    });
                }
            } else {
                // Incorrect answer
                if (typeof SoundFX !== 'undefined' && SoundFX.play) {
                    SoundFX.play('click');
                }
                buttonElement.classList.add('quiz-option-wrong');

                if (localStorage.getItem('voice_enabled') !== 'false') {
                    if (typeof SoundFX !== 'undefined' && SoundFX.speak) {
                        SoundFX.speak("Oops! Try next one!", 'en-US');
                    }
                }

                // Highlight correct button
                const correctBtn = optionsGrid.children[currentQ.correct];
                if (correctBtn) {
                    correctBtn.classList.add('quiz-option-correct');
                }
            }

            // Move to next question after 1.8 seconds
            setTimeout(() => {
                currentQuestionIdx++;
                loadQuestion();
            }, 1850);
        }

        function showResults() {
            progressArea.style.display = 'none';
            quizContent.style.display = 'none';

            if (correctCount >= 3) {
                // 3, 4, or 5 out of 5 -> WON SURPRISE GIFT!
                giftResultCard.style.display = 'flex';
                tryAgainResultCard.style.display = 'none';

                selectedToy = toyList[Math.floor(Math.random() * toyList.length)];
                document.getElementById('giftBoxSubtitle').innerText = `Awesome! You scored ${correctCount} out of 5! Tap the gift box to open your surprise toy! 🎁`;

                if (localStorage.getItem('voice_enabled') !== 'false') {
                    if (typeof SoundFX !== 'undefined' && SoundFX.speak) {
                        SoundFX.speak(`Awesome! You scored ${correctCount} out of 5! Tap the gift box to open your gift!`, 'en-US');
                    }
                }
            } else {
                // Less than 3 out of 5 -> TRY AGAIN (NO GIFT)
                giftResultCard.style.display = 'none';
                tryAgainResultCard.style.display = 'flex';

                document.getElementById('tryAgainText').innerText = `You scored ${correctCount} out of 5. Get at least 3 correct answers to unlock a surprise gift! 🎁`;

                if (typeof SoundFX !== 'undefined' && SoundFX.play) {
                    SoundFX.play('click');
                }

                if (localStorage.getItem('voice_enabled') !== 'false') {
                    if (typeof SoundFX !== 'undefined' && SoundFX.speak) {
                        SoundFX.speak(`You scored ${correctCount} out of 5. Get 3 or more correct answers to win a gift! Try again!`, 'en-US');
                    }
                }
            }
        }

        function openSurpriseGift() {
            if (!selectedToy) return;

            giftClosedBoxState.style.display = 'none';
            giftOpenedBoxState.style.display = 'flex';

            document.getElementById('quizToyEmoji').innerText = selectedToy.emoji;
            document.getElementById('quizToyTitle').innerText = selectedToy.name + "!";
            document.getElementById('quizToyScoreText').innerText = `Great Job! You scored ${correctCount} out of 5! 🌟`;

            if (typeof SoundFX !== 'undefined' && SoundFX.play) {
                SoundFX.play('cheer');
            }

            if (typeof confetti === 'function') {
                confetti({
                    particleCount: 140,
                    spread: 90,
                    origin: { y: 0.6 }
                });
            }

            if (localStorage.getItem('voice_enabled') !== 'false') {
                if (typeof SoundFX !== 'undefined' && SoundFX.speak) {
                    SoundFX.speak(`Yay! You won a ${selectedToy.name}!`, 'en-US');
                }
            }
        }

        function restartQuiz() {
            initQuiz();
        }

        document.addEventListener('DOMContentLoaded', () => {
            initQuiz();
        });
    </script>
@endsection