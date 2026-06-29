@extends('layouts.app')

@section('title', 'Kuhu Kids Learning - Quiz Time')

@section('content')
<div class="inner-container">
    <div class="inner-header">
        <h1 class="inner-title">
            <span style="color: var(--color-purple);">❓ Quiz Time Game</span>
        </h1>
        <a href="{{ route('dashboard') }}" class="btn-3d btn-yellow">&lt; Back to Home</a>
    </div>

    <!-- Quiz Wrapper -->
    <div style="background: #F8FAFC; border: 4px dashed var(--color-purple); border-radius: 28px; padding: 30px; min-height: 400px; display: flex; flex-direction: column; align-items: center; justify-content: center; position: relative;">
        
        <!-- Progress Bar -->
        <div id="progressArea" style="width: 100%; margin-bottom: 24px; display: flex; flex-direction: column; gap: 8px;">
            <div style="display: flex; justify-content: space-between; font-weight: 800; color: var(--color-purple); font-size: 1.1rem;">
                <span>Question <strong id="currentQuestionNum">1</strong> of 5</span>
                <span>⭐ Score: <strong id="scoreDisplay">0</strong></span>
            </div>
            <div style="width: 100%; height: 16px; background: #E2E8F0; border-radius: 10px; overflow: hidden;">
                <div id="progressBarFill" style="width: 20%; height: 100%; background: var(--color-purple); transition: width 0.3s ease;"></div>
            </div>
        </div>

        <!-- Question Section -->
        <div id="quizContent" style="width: 100%; display: flex; flex-direction: column; align-items: center; justify-content: space-between; flex: 1;">
            <h2 id="questionText" style="font-size: 2rem; font-weight: 800; color: var(--color-text); text-align: center; margin-bottom: 30px;">Loading question...</h2>

            <!-- Options Grid -->
            <div id="optionsGrid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; width: 100%; max-width: 600px; margin-bottom: 20px;">
                <!-- Dynamically loaded buttons -->
            </div>
        </div>

        <!-- Completion Card -->
        <div id="resultCard" style="display: none; flex-direction: column; align-items: center; justify-content: center; text-align: center; gap: 20px; padding: 20px;">
            <h2 style="font-size: 2.5rem; font-weight: 900; color: var(--color-green-real); filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));">🎉 Super Learner! 🎉</h2>
            <p style="font-size: 1.3rem; font-weight: 700; color: var(--color-text);">You completed the Quiz successfully!</p>
            
            <div style="background: #FFFDF0; border: 3px solid var(--color-yellow); padding: 20px 40px; border-radius: 20px; box-shadow: 0 10px 0 rgba(0,0,0,0.05); margin: 15px 0;">
                <span style="font-size: 1.8rem; font-weight: 900; color: var(--color-orange);">🌟 Stars Earned: +25</span>
            </div>

            <div style="display: flex; gap: 15px;">
                <button onclick="restartQuiz()" class="btn-3d btn-pink" style="font-size: 1.2rem;">🔄 Play Again</button>
                <a href="{{ route('dashboard') }}" class="btn-3d btn-yellow" style="font-size: 1.2rem;">🎮 Back to Game</a>
            </div>
        </div>

    </div>
</div>

<script>
    const questions = [
        {
            q: "Which color is a ripe banana?",
            options: ["Red 🍎", "Green 🍏", "Yellow 🍌", "Blue 💧"],
            correct: 2,
            speech: "Which color is a ripe banana?"
        },
        {
            q: "How many legs does a dog have?",
            options: ["2 Legs", "4 Legs", "6 Legs", "8 Legs"],
            correct: 1,
            speech: "How many legs does a dog have?"
        },
        {
            q: "Which shape is round like a wheel?",
            options: ["Triangle 🔺", "Square ⬜", "Star ⭐", "Circle ⚪"],
            correct: 3,
            speech: "Which shape is round like a wheel?"
        },
        {
            q: "Which animal is the King of the Jungle?",
            options: ["Elephant 🐘", "Lion 🦁", "Giraffe 🦒", "Monkey 🐒"],
            correct: 1,
            speech: "Which animal is the King of the Jungle?"
        },
        {
            q: "What fruit is red and starts with the letter A?",
            options: ["Mango 🥭", "Banana 🍌", "Apple 🍎", "Orange 🍊"],
            correct: 2,
            speech: "What fruit is red and starts with the letter A?"
        }
    ];

    let currentQuestionIdx = 0;
    let score = 0;

    const currentQuestionNum = document.getElementById('currentQuestionNum');
    const scoreDisplay = document.getElementById('scoreDisplay');
    const progressBarFill = document.getElementById('progressBarFill');
    const questionText = document.getElementById('questionText');
    const optionsGrid = document.getElementById('optionsGrid');
    
    const progressArea = document.getElementById('progressArea');
    const quizContent = document.getElementById('quizContent');
    const resultCard = document.getElementById('resultCard');

    function loadQuestion() {
        if (currentQuestionIdx >= questions.length) {
            showResults();
            return;
        }

        // Update progress counters
        currentQuestionNum.innerText = currentQuestionIdx + 1;
        progressBarFill.style.width = ((currentQuestionIdx + 1) / questions.length) * 100 + "%";

        const currentQ = questions[currentQuestionIdx];
        questionText.innerText = currentQ.q;
        optionsGrid.innerHTML = '';

        // Speak the question
        if (localStorage.getItem('voice_enabled') !== 'false') {
            SoundFX.speak(currentQ.speech);
        }

        // Load choice buttons
        currentQ.options.forEach((opt, idx) => {
            const btn = document.createElement('button');
            btn.className = 'btn-3d btn-yellow';
            btn.style.fontSize = '1.3rem';
            btn.style.padding = '16px';
            btn.innerText = opt;
            btn.addEventListener('click', () => selectOption(idx, btn));
            optionsGrid.appendChild(btn);
        });
    }

    function selectOption(selectedIdx, buttonElement) {
        const currentQ = questions[currentQuestionIdx];
        
        // Disable other options immediately
        Array.from(optionsGrid.children).forEach(btn => btn.disabled = true);

        if (selectedIdx === currentQ.correct) {
            // Correct!
            SoundFX.play('success');
            if (localStorage.getItem('voice_enabled') !== 'false') {
                SoundFX.speak("Correct! You got it!");
            }

            buttonElement.style.backgroundColor = '#7ED957';
            buttonElement.style.borderBottomColor = '#63AA43';
            buttonElement.style.color = '#FFF';
            score++;
            scoreDisplay.innerText = score;
        } else {
            // Wrong!
            SoundFX.play('click');
            if (localStorage.getItem('voice_enabled') !== 'false') {
                SoundFX.speak("Oh no, that's not correct.");
            }

            buttonElement.style.backgroundColor = '#FF5252';
            buttonElement.style.borderBottomColor = '#C62828';
            buttonElement.style.color = '#FFF';

            // Show correct answer in green
            const correctBtn = optionsGrid.children[currentQ.correct];
            if (correctBtn) {
                correctBtn.style.backgroundColor = '#7ED957';
                correctBtn.style.borderBottomColor = '#63AA43';
                correctBtn.style.color = '#FFF';
            }
        }

        // Wait 2.2 seconds then move to next question
        setTimeout(() => {
            currentQuestionIdx++;
            loadQuestion();
        }, 2200);
    }

    function showResults() {
        progressArea.style.display = 'none';
        quizContent.style.display = 'none';
        resultCard.style.display = 'flex';

        // Play cheering success sound
        SoundFX.play('cheer');
        if (localStorage.getItem('voice_enabled') !== 'false') {
            SoundFX.speak("Congratulations! You completed the quiz. You earned 25 stars!");
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
        currentQuestionIdx = 0;
        score = 0;
        scoreDisplay.innerText = score;
        progressArea.style.display = 'flex';
        quizContent.style.display = 'flex';
        resultCard.style.display = 'none';
        loadQuestion();
    }

    window.addEventListener('DOMContentLoaded', () => {
        loadQuestion();
    });
</script>
@endsection
