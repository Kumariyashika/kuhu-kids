@extends('layouts.app')

@section('title', 'Kuhu Kids Learning - Quiz Time')

@section('content')
    <!-- Include Canvas Confetti -->
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

    <div class="inner-container" style="max-width: 850px; margin: 0 auto; padding: 15px;">
        <!-- Header -->
        <div class="inner-header" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px;">
            <div style="display: flex; align-items: center; gap: 12px;">
                <a href="{{ route('dashboard') }}" class="btn-3d btn-yellow"
                    style="display: flex; align-items: center; justify-content: center; border-radius: 50%; width: 44px; height: 44px; padding: 0; text-decoration: none; margin: 0;"
                    title="Back to Home">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                        stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                </a>
                <h1 class="inner-title" style="margin: 0; font-size: 1.8rem;">
                    <span style="color: var(--color-purple);">❓ Kids Quiz Game</span>
                </h1>
            </div>

            <!-- Score Pill -->
            <div style="background: #FFFDF0; border: 3px solid #FFDE59; border-radius: 20px; padding: 6px 16px; font-weight: 900; color: #4A3B00; display: flex; align-items: center; gap: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.06); font-size: 1.1rem;">
                ⭐ Score: <span id="scoreDisplay" style="color: #FF914D; font-size: 1.3rem;">0</span>
            </div>
        </div>

        <!-- Quiz Outer Card -->
        <div class="quiz-card-frame"
            style="background: linear-gradient(135deg, #FFFDF0 0%, #F3E5F5 100%); border: 4px solid #D8B4FE; border-radius: 28px; padding: 22px; min-height: 440px; display: flex; flex-direction: column; align-items: center; justify-content: space-between; position: relative; box-shadow: 0 12px 30px rgba(140, 82, 255, 0.12);">

            <!-- Top Progress Header -->
            <div id="progressArea" style="width: 100%; margin-bottom: 16px; display: flex; flex-direction: column; gap: 8px;">
                <div style="display: flex; justify-content: space-between; align-items: center; font-weight: 900; color: #6B21A8; font-size: 1.1rem;">
                    <span style="display: flex; align-items: center; gap: 6px;">
                        <span>📖 Question</span>
                        <span id="currentQuestionNum" style="background: #9333EA; color: white; padding: 2px 10px; border-radius: 12px; font-size: 1rem;">1</span>
                        <span>of 5</span>
                    </span>
                </div>

                <!-- Animated Progress Bar -->
                <div style="width: 100%; height: 14px; background: #E9D5FF; border-radius: 10px; overflow: hidden; padding: 2px;">
                    <div id="progressBarFill"
                        style="width: 20%; height: 100%; background: linear-gradient(90deg, #A855F7 0%, #EC4899 100%); border-radius: 8px; transition: width 0.4s ease;">
                    </div>
                </div>
            </div>

            <!-- Active Question Content -->
            <div id="quizContent" style="width: 100%; display: flex; flex-direction: column; align-items: center; justify-content: space-between; flex: 1;">
                
                <!-- Question Box with Mascot & Big Emoji Illustration -->
                <div class="question-illustration-box" style="width: 100%; background: #FFFFFF; border-radius: 24px; padding: 18px; border: 3px solid #E9D5FF; box-shadow: 0 8px 20px rgba(0,0,0,0.05); display: flex; flex-direction: column; align-items: center; justify-content: center; margin-bottom: 18px; text-align: center;">
                    
                    <div id="questionEmoji" style="font-size: 4rem; margin-bottom: 8px; animation: floatEmoji 2.5s ease-in-out infinite alternate;">
                        🍌
                    </div>

                    <h2 id="questionText" style="font-size: 1.45rem; font-weight: 900; color: #2C3E50; margin: 0; line-height: 1.4; font-family: 'Fredoka', sans-serif;">
                        Loading question...
                    </h2>
                </div>

                <!-- 2x2 Options Grid -->
                <div id="optionsGrid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px; width: 100%; margin-bottom: 10px;">
                    <!-- Choice buttons generated via JS -->
                </div>
            </div>

            <!-- Completion & Reward Celebration Screen -->
            <div id="resultCard" style="display: none; flex-direction: column; align-items: center; justify-content: center; text-align: center; gap: 16px; padding: 15px; width: 100%; flex: 1;">
                <div style="font-size: 5rem; animation: trophyBounce 1s ease infinite alternate;">🏆</div>
                <h2 style="font-size: 2.2rem; font-weight: 900; color: var(--color-green-real); text-shadow: 2px 2px 0 #FFF; margin: 0;">
                    SUPER QUIZ CHAMPION! 🎉
                </h2>
                <p style="font-size: 1.25rem; font-weight: 800; color: #4B5563; margin: 0;">
                    You answered the questions like a genius! 🌟
                </p>

                <!-- Stars Earned Badge -->
                <div style="background: linear-gradient(135deg, #FFDE59 0%, #FF914D 100%); border: 3px solid #E6A100; padding: 14px 36px; border-radius: 22px; box-shadow: 0 8px 20px rgba(255, 145, 77, 0.3); margin: 10px 0;">
                    <span style="font-size: 1.8rem; font-weight: 900; color: #4A3B00;">⭐ +25 Golden Stars!</span>
                </div>

                <div style="display: flex; gap: 14px; margin-top: 10px;">
                    <button onclick="restartQuiz()" class="btn-3d btn-pink" style="font-size: 1.1rem; padding: 10px 24px;">
                        🔄 Play Again
                    </button>
                    <a href="{{ route('dashboard') }}" class="btn-3d btn-yellow" style="font-size: 1.1rem; padding: 10px 24px; text-decoration: none;">
                        🏠 Home
                    </a>
                </div>
            </div>

        </div>
    </div>

    <style>
        @keyframes floatEmoji {
            0% { transform: translateY(0) scale(1); }
            100% { transform: translateY(-8px) scale(1.08); }
        }

        @keyframes trophyBounce {
            0% { transform: translateY(0) scale(1); }
            100% { transform: translateY(-15px) scale(1.15) rotate(5deg); }
        }

        .quiz-option-btn {
            background: #FFFFFF;
            border: 3px solid #CBD5E1;
            border-bottom: 6px solid #94A3B8;
            border-radius: 20px;
            padding: 14px 16px;
            font-size: 1.25rem;
            font-weight: 900;
            color: #1E293B;
            cursor: pointer;
            transition: all 0.15s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.04);
            font-family: 'Fredoka', sans-serif;
        }

        .quiz-option-btn:hover {
            transform: translateY(-3px);
            border-color: #A855F7;
        }

        .quiz-option-btn:active {
            transform: translateY(2px);
            border-bottom-width: 3px;
        }

        .quiz-option-correct {
            background: #7ED957 !important;
            border-color: #63AA43 !important;
            border-bottom-color: #4D8733 !important;
            color: #FFFFFF !important;
            animation: pulseCorrect 0.4s ease;
        }

        .quiz-option-wrong {
            background: #FF5252 !important;
            border-color: #C62828 !important;
            border-bottom-color: #9A1F1F !important;
            color: #FFFFFF !important;
            animation: shakeWrong 0.4s ease;
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
    </style>

    <script>
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
        let score = 0;

        const currentQuestionNum = document.getElementById('currentQuestionNum');
        const scoreDisplay = document.getElementById('scoreDisplay');
        const progressBarFill = document.getElementById('progressBarFill');
        const questionText = document.getElementById('questionText');
        const questionEmoji = document.getElementById('questionEmoji');
        const optionsGrid = document.getElementById('optionsGrid');

        const progressArea = document.getElementById('progressArea');
        const quizContent = document.getElementById('quizContent');
        const resultCard = document.getElementById('resultCard');

        function shuffleArray(array) {
            const arr = [...array];
            for (let i = arr.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [arr[i], arr[j]] = [arr[j], arr[i]];
            }
            return arr;
        }

        function initQuiz() {
            // Pick 5 random questions from pool
            questions = shuffleArray(questionPool).slice(0, 5);
            currentQuestionIdx = 0;
            score = 0;
            scoreDisplay.innerText = score;
            progressArea.style.display = 'flex';
            quizContent.style.display = 'flex';
            resultCard.style.display = 'none';
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
                SoundFX.speak(currentQ.speech, 'en-US');
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
                SoundFX.play('success');
                buttonElement.classList.add('quiz-option-correct');
                score += 5;
                scoreDisplay.innerText = score;

                if (localStorage.getItem('voice_enabled') !== 'false') {
                    SoundFX.speak("Yay! Correct! Super Job!", 'en-US');
                }

                if (typeof confetti === 'function') {
                    confetti({
                        particleCount: 50,
                        spread: 60,
                        origin: { y: 0.7 }
                    });
                }
            } else {
                // Incorrect answer
                SoundFX.play('click');
                buttonElement.classList.add('quiz-option-wrong');

                if (localStorage.getItem('voice_enabled') !== 'false') {
                    SoundFX.speak("Oopsie! Try the next one!", 'en-US');
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
            resultCard.style.display = 'flex';

            SoundFX.play('cheer');
            if (typeof confetti === 'function') {
                confetti({
                    particleCount: 150,
                    spread: 90,
                    origin: { y: 0.6 }
                });
            }

            if (localStorage.getItem('voice_enabled') !== 'false') {
                SoundFX.speak("Woohoo! You are a Super Quiz Champion! You earned 25 stars!", 'en-US');
            }

            // Award 25 stars to DB
            fetch("{{ route('api.add_stars') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    stars: 25,
                    activity_name: 'Completed Kids Learning Quiz'
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

        function restartQuiz() {
            initQuiz();
        }

        document.addEventListener('DOMContentLoaded', () => {
            initQuiz();
        });
    </script>
@endsection