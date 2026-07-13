@extends('layouts.app')

@section('title', 'Kuhu Kids Learning - Number Counting')

@section('content')
<div class="inner-container">
    <div class="inner-header">
        <h1 class="inner-title">
            <span style="color: var(--color-green-real);">🔢 Number Counting Game</span>
        </h1>
        <a href="{{ route('dashboard') }}" class="btn-3d btn-yellow" style="display: flex; align-items: center; justify-content: center; border-radius: 50%; width: 44px; height: 44px; padding: 0; text-decoration: none; margin: 0;" title="Back to Home">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
        </a>
    </div>

    <!-- Score Board -->
    <div class="pop-score-board" style="border-radius: 16px; border: 3px solid var(--color-green-real); margin-bottom: 20px; display: flex; justify-content: space-between; padding: 12px 24px; font-weight: 800; font-size: 1.2rem;">
        <span>🎯 Correct: <strong id="correctDisplay" style="color: var(--color-green-real);">0</strong></span>
        <span>🌟 Stars Earned: <strong id="starsDisplay" style="color: var(--color-yellow-shadow);">0</strong></span>
    </div>

    <!-- Counting Container -->
    <div style="background: #F8FAFC; border: 4px dashed #CBD5E1; border-radius: 24px; padding: 30px; min-height: 380px; display: flex; flex-direction: column; align-items: center; justify-content: space-between; position: relative;">
        <!-- Question -->
        <h2 id="questionText" style="font-size: 1.8rem; font-weight: 800; color: var(--color-text); text-align: center; margin-bottom: 20px;">How many items do you see?</h2>

        <!-- Canvas area for drawing objects -->
        <div id="countingGrid" style="display: flex; flex-wrap: wrap; gap: 16px; justify-content: center; align-items: center; max-width: 500px; margin-bottom: 30px; min-height: 150px;">
            <!-- Dynamic elements will be inserted here -->
        </div>

        <!-- Choices bubbles -->
        <div id="choicesArea" style="display: flex; gap: 20px; justify-content: center; width: 100%;">
            <!-- Buttons will go here -->
        </div>
    </div>
</div>

<script>
    const countingGrid = document.getElementById('countingGrid');
    const questionText = document.getElementById('questionText');
    const choicesArea = document.getElementById('choicesArea');
    const correctDisplay = document.getElementById('correctDisplay');
    const starsDisplay = document.getElementById('starsDisplay');

    let correctCount = 0;
    let starsCount = 0;
    let currentNumber = 0;
    let currentItemType = 'apple'; // apple, star, balloon

    const itemSvgs = {
        apple: `<svg viewBox="0 0 100 100" width="60" height="60" style="filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1)); animation: floatItem 3s ease-in-out infinite alternate;">
                    <circle cx="42" cy="55" r="28" fill="#FF4D4D"/>
                    <circle cx="58" cy="55" r="28" fill="#FF4D4D"/>
                    <path d="M 50 30 C 50 15, 62 10, 62 10" fill="none" stroke="#8D6E63" stroke-width="4" stroke-linecap="round"/>
                    <path d="M 50 22 C 45 22, 38 10, 38 10" fill="#4CAF50" stroke="#388E3C" stroke-width="2"/>
                    <circle cx="34" cy="42" r="3.5" fill="#FFF"/>
                </svg>`,
        star: `<svg viewBox="0 0 100 100" width="60" height="60" style="filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1)); animation: floatItem 2.5s ease-in-out infinite alternate-reverse;">
                    <polygon points="50,5 64,36 98,36 70,57 81,91 50,70 19,91 30,57 2,36 36,36" fill="#FFDE59" stroke="#E6A100" stroke-width="3"/>
                    <circle cx="36" cy="48" r="3" fill="#222"/>
                    <circle cx="64" cy="48" r="3" fill="#222"/>
                    <path d="M 44 58 Q 50 62 56 58" fill="none" stroke="#222" stroke-width="2" stroke-linecap="round"/>
               </svg>`,
        balloon: `<svg viewBox="0 0 100 120" width="60" height="72" style="filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1)); animation: floatItem 3.5s ease-in-out infinite alternate;">
                    <ellipse cx="50" cy="50" rx="24" ry="30" fill="#38B6FF"/>
                    <polygon points="46,80 54,80 50,85" fill="#2B8EC7"/>
                    <line x1="50" y1="85" x2="50" y2="110" stroke="#A0AEC0" stroke-width="2" stroke-linecap="round"/>
                    <ellipse cx="40" cy="38" rx="5" ry="8" fill="#FFF" opacity="0.6"/>
                  </svg>`
    };

    const itemNames = {
        apple: 'apples',
        star: 'stars',
        balloon: 'balloons'
    };

    function generateQuestion() {
        countingGrid.innerHTML = '';
        choicesArea.innerHTML = '';

        // Generate target number (1 to 10 for simplicity in counting grid)
        currentNumber = Math.floor(Math.random() * 9) + 2; // 2 to 10
        const itemTypes = ['apple', 'star', 'balloon'];
        currentItemType = itemTypes[Math.floor(Math.random() * itemTypes.length)];

        // Set Question Title text
        questionText.innerHTML = `How many <strong style="color: var(--color-purple); font-weight: 800;">${itemNames[currentItemType]}</strong> do you see?`;

        // Render counting items inside the grid
        for (let i = 0; i < currentNumber; i++) {
            const wrap = document.createElement('div');
            wrap.innerHTML = itemSvgs[currentItemType];
            
            // Random animation delay to offset bouncing
            const svg = wrap.firstElementChild;
            svg.style.animationDelay = (Math.random() * 2) + 's';
            countingGrid.appendChild(svg);
        }

        // Generate options (one correct, two wrong)
        const choices = [currentNumber];
        while (choices.length < 3) {
            const wrong = Math.max(1, currentNumber + (Math.random() > 0.5 ? 1 : -1) * (Math.floor(Math.random() * 2) + 1));
            if (!choices.includes(wrong) && wrong <= 12) {
                choices.push(wrong);
            }
        }

        // Shuffle options
        choices.sort(() => Math.random() - 0.5);

        // Render choice buttons
        choices.forEach(choice => {
            const btn = document.createElement('button');
            btn.className = 'btn-3d btn-yellow';
            btn.style.fontSize = '2.2rem';
            btn.style.padding = '12px 36px';
            btn.innerText = choice;
            btn.addEventListener('click', () => verifyAnswer(choice, btn));
            choicesArea.appendChild(btn);
        });
    }

    function verifyAnswer(selected, buttonElement) {
        if (selected === currentNumber) {
            // Correct Answer!
            SoundFX.play('success');
            
            // Vocal feedback
            if (localStorage.getItem('voice_enabled') !== 'false') {
                SoundFX.speak(`${currentNumber}! Correct! Great job!`);
            }

            // Green feedback
            buttonElement.style.backgroundColor = '#7ED957';
            buttonElement.style.borderBottomColor = '#63AA43';
            buttonElement.style.color = '#FFF';

            // Disable buttons to prevent double click
            Array.from(choicesArea.children).forEach(btn => btn.disabled = true);

            // Increment local stats
            correctCount++;
            starsCount += 5; // Get 5 stars per correct answer
            correctDisplay.innerText = correctCount;
            starsDisplay.innerText = starsCount;

            // Save to database
            fetch("{{ route('api.add_stars') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    stars: 5,
                    activity_name: 'Counted ' + currentNumber + ' ' + itemNames[currentItemType]
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

            // Transition to next question after 2 seconds
            setTimeout(generateQuestion, 2000);
        } else {
            // Wrong Answer!
            SoundFX.play('click');
            if (localStorage.getItem('voice_enabled') !== 'false') {
                SoundFX.speak(`No, that is ${selected}. Try again!`);
            }

            // Wobble animation feedback
            buttonElement.style.backgroundColor = '#FF5252';
            buttonElement.style.borderBottomColor = '#C62828';
            buttonElement.style.color = '#FFF';
            buttonElement.style.transform = 'translateX(5px)';
            
            setTimeout(() => {
                buttonElement.style.transform = 'none';
                buttonElement.style.backgroundColor = '';
                buttonElement.style.borderBottomColor = '';
                buttonElement.style.color = '';
            }, 500);
        }
    }

    // Initialize game
    window.addEventListener('DOMContentLoaded', () => {
        generateQuestion();
        
        // Custom float animation styling injected dynamically
        const style = document.createElement('style');
        style.innerHTML = `
            @keyframes floatItem {
                0% { transform: translateY(0); }
                100% { transform: translateY(-10px); }
            }
        `;
        document.head.appendChild(style);
    });
</script>
@endsection
