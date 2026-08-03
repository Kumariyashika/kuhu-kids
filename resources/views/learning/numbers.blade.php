@extends('layouts.app')

@section('title', 'Kuhu Kids Learning - Number Counting')

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

    /* Outer Container - Zero Card Box, Zero Borders, Zero Background */
    .numbers-page-wrapper {
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
    .numbers-top-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 14px;
        padding: 4px 6px;
    }

    .numbers-title-box {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .numbers-top-title {
        margin: 0;
        font-size: 1.8rem;
        font-family: 'Fredoka', sans-serif;
        font-weight: 900;
        color: #7ED957;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    /* Score Badge */
    .numbers-score-badge {
        background: linear-gradient(145deg, #FFFDF0 0%, #FFFFFF 100%);
        border: 3px solid #7ED957;
        border-bottom: 5px solid #59B233;
        border-radius: 20px;
        padding: 6px 16px;
        font-weight: 900;
        color: #2D3748;
        display: flex;
        align-items: center;
        gap: 12px;
        box-shadow: 0 6px 14px rgba(0,0,0,0.08);
        font-size: 1.15rem;
        font-family: 'Fredoka', sans-serif;
    }

    /* Main 3D Card Frame */
    .numbers-3d-card-frame {
        background: linear-gradient(145deg, #FFFFFF 0%, #F0FDF4 100%);
        border: 4px solid #7ED957;
        border-bottom: 10px solid #59B233;
        border-radius: 32px;
        padding: 24px;
        min-height: 480px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
        position: relative;
        box-shadow: inset 0 4px 0 rgba(255,255,255,0.8), 0 16px 36px rgba(89, 178, 51, 0.18);
        width: 100%;
        box-sizing: border-box;
        flex: 1;
    }

    /* Question Title Box */
    .question-box-counting {
        width: 100%;
        background: linear-gradient(135deg, #FFFDF0 0%, #FFFFFF 100%);
        border-radius: 24px;
        padding: 16px;
        border: 3px solid #7ED957;
        border-bottom: 6px solid #59B233;
        box-shadow: inset 0 3px 0 #FFF, 0 8px 18px rgba(0,0,0,0.05);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 18px;
        text-align: center;
    }

    .question-counting-text {
        font-size: 1.6rem;
        font-weight: 900;
        color: #1E293B;
        margin: 0;
        font-family: 'Fredoka', sans-serif;
        text-shadow: 0 1px 2px rgba(255,255,255,0.8);
    }

    /* Counting Grid Container */
    .counting-objects-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 18px 22px;
        justify-content: center;
        align-items: center;
        max-width: 580px;
        margin-bottom: 24px;
        min-height: 160px;
        padding: 12px;
        width: 100%;
        box-sizing: border-box;
    }

    .counting-svg-wrapper {
        cursor: pointer;
        transition: transform 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
        filter: drop-shadow(0 8px 12px rgba(0,0,0,0.15));
        user-select: none;
    }

    .counting-svg-wrapper:hover {
        transform: scale(1.25) rotate(6deg);
    }

    .counting-svg-wrapper:active {
        transform: scale(0.9);
    }

    /* Number Choice 3D Buttons Area */
    .num-choices-area {
        display: flex;
        gap: 20px;
        justify-content: center;
        width: 100%;
        margin-bottom: 8px;
    }

    /* 3D Tactile Number Choice Button */
    .num-choice-btn {
        width: 96px;
        height: 82px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-family: 'Baloo 2', 'Fredoka', sans-serif;
        font-size: 2.6rem;
        font-weight: 900;
        color: #4A3B00;
        background: linear-gradient(145deg, #FFE873 0%, #FFDE59 100%);
        border: 3.5px solid #E6C438;
        border-bottom: 8px solid #C4A51D;
        border-radius: 24px;
        box-shadow: inset 0 3px 0 rgba(255,255,255,0.6), 0 8px 18px rgba(0,0,0,0.1);
        cursor: pointer;
        transition: transform 0.15s cubic-bezier(0.175, 0.885, 0.32, 1.275), background 0.2s ease;
        user-select: none;
    }

    .num-choice-btn:hover {
        transform: translateY(-4px) scale(1.05);
        border-color: #E6A100;
        box-shadow: inset 0 3px 0 rgba(255,255,255,0.7), 0 12px 24px rgba(255, 222, 89, 0.4);
    }

    .num-choice-btn:active {
        transform: translateY(2px);
        border-bottom-width: 4px;
    }

    .num-btn-correct {
        background: linear-gradient(145deg, #4ADE80 0%, #22C55E 100%) !important;
        border-color: #16A34A !important;
        border-bottom: 8px solid #15803D !important;
        color: #FFFFFF !important;
        animation: pulseCorrect 0.4s ease;
    }

    .num-btn-wrong {
        background: linear-gradient(145deg, #FF6B6B 0%, #EE5252 100%) !important;
        border-color: #DC2626 !important;
        border-bottom: 8px solid #991B1B !important;
        color: #FFFFFF !important;
        animation: shakeWrong 0.4s ease;
    }

    @keyframes floatItem {
        0% { transform: translateY(0) rotate(-2deg); }
        100% { transform: translateY(-10px) rotate(3deg); }
    }

    @keyframes pulseCorrect {
        0% { transform: scale(1); }
        50% { transform: scale(1.08); }
        100% { transform: scale(1); }
    }

    @keyframes shakeWrong {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-8px); }
        75% { transform: translateX(8px); }
    }

    @media (max-width: 640px) {
        .question-counting-text {
            font-size: 1.3rem;
        }

        .num-choice-btn {
            width: 82px;
            height: 72px;
            font-size: 2.2rem;
        }

        .numbers-top-title {
            font-size: 1.4rem;
        }

        .num-choices-area {
            gap: 12px;
        }
    }
</style>

<div class="numbers-page-wrapper">
    <!-- Top Header Navigation -->
    <div class="numbers-top-header">
        <div class="numbers-title-box">
            <a href="{{ route('dashboard') }}" class="btn-3d btn-yellow" style="display: flex; align-items: center; justify-content: center; border-radius: 50%; width: 44px; height: 44px; padding: 0; text-decoration: none; margin: 0; flex-shrink: 0;" title="Back to Home">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
            </a>
            <h1 class="numbers-top-title">🔢 Number Counting</h1>
        </div>

        <!-- Score Board Badge -->
        <div class="numbers-score-badge">
            <span>🎯 Correct: <strong id="correctDisplay" style="color: #16A34A;">0</strong></span>
            <span>🌟 Stars: <strong id="starsDisplay" style="color: #FF914D;">0</strong></span>
        </div>
    </div>

    <!-- Main 3D Card Frame Arena -->
    <div class="numbers-3d-card-frame">
        <!-- Question Box -->
        <div class="question-box-counting">
            <h2 id="questionText" class="question-counting-text">How many items do you see?</h2>
        </div>

        <!-- Counting Objects Grid -->
        <div id="countingGrid" class="counting-objects-grid">
            <!-- Dynamic elements inserted here via JS -->
        </div>

        <!-- Number Choices Buttons Area -->
        <div id="choicesArea" class="num-choices-area">
            <!-- Buttons inserted here via JS -->
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
    let currentItemType = 'star'; // star, apple, balloon, car, flower

    const itemSvgs = {
        star: `<div class="counting-svg-wrapper" onclick="popObjectSound(this)">
                    <svg viewBox="0 0 100 100" width="68" height="68" style="animation: floatItem 2.6s ease-in-out infinite alternate;">
                        <polygon points="50,5 64,36 98,36 70,57 81,91 50,70 19,91 30,57 2,36 36,36" fill="#FFDE59" stroke="#E6C438" stroke-width="4.5" stroke-linejoin="round" filter="drop-shadow(0 6px 10px rgba(230,196,56,0.35))"/>
                        <circle cx="36" cy="48" r="3.5" fill="#4A3B00"/>
                        <circle cx="64" cy="48" r="3.5" fill="#4A3B00"/>
                        <path d="M 44 58 Q 50 64 56 58" fill="none" stroke="#4A3B00" stroke-width="3" stroke-linecap="round"/>
                   </svg>
               </div>`,
        apple: `<div class="counting-svg-wrapper" onclick="popObjectSound(this)">
                    <svg viewBox="0 0 100 100" width="68" height="68" style="animation: floatItem 3s ease-in-out infinite alternate;">
                        <circle cx="42" cy="55" r="28" fill="#FF5252" stroke="#C62828" stroke-width="3"/>
                        <circle cx="58" cy="55" r="28" fill="#FF5252" stroke="#C62828" stroke-width="3"/>
                        <path d="M 50 30 C 50 15, 62 10, 62 10" fill="none" stroke="#8D6E63" stroke-width="4.5" stroke-linecap="round"/>
                        <path d="M 50 22 C 45 22, 38 10, 38 10" fill="#7ED957" stroke="#63AA43" stroke-width="2.5"/>
                        <circle cx="34" cy="42" r="4" fill="#FFF"/>
                        <circle cx="66" cy="42" r="4" fill="#FFF"/>
                        <path d="M 44 64 Q 50 69 56 64" fill="none" stroke="#FFF" stroke-width="3" stroke-linecap="round"/>
                    </svg>
                </div>`,
        balloon: `<div class="counting-svg-wrapper" onclick="popObjectSound(this)">
                    <svg viewBox="0 0 100 120" width="64" height="76" style="animation: floatItem 3.2s ease-in-out infinite alternate;">
                        <ellipse cx="50" cy="50" rx="26" ry="32" fill="#38B6FF" stroke="#2B8EC7" stroke-width="3.5"/>
                        <polygon points="45,82 55,82 50,88" fill="#2B8EC7"/>
                        <line x1="50" y1="88" x2="50" y2="114" stroke="#718096" stroke-width="3" stroke-linecap="round"/>
                        <ellipse cx="38" cy="38" rx="6" ry="10" fill="#FFF" opacity="0.7"/>
                    </svg>
                  </div>`,
        flower: `<div class="counting-svg-wrapper" onclick="popObjectSound(this)">
                    <svg viewBox="0 0 100 100" width="68" height="68" style="animation: floatItem 2.8s ease-in-out infinite alternate;">
                        <circle cx="30" cy="50" r="16" fill="#FF66C4"/>
                        <circle cx="70" cy="50" r="16" fill="#FF66C4"/>
                        <circle cx="50" cy="30" r="16" fill="#FF66C4"/>
                        <circle cx="50" cy="70" r="16" fill="#FF66C4"/>
                        <circle cx="50" cy="50" r="16" fill="#FFDE59" stroke="#E6C438" stroke-width="3"/>
                    </svg>
                 </div>`
    };

    const itemNames = {
        star: { name: 'stars', emoji: '⭐', color: '#E6A100' },
        apple: { name: 'apples', emoji: '🍎', color: '#FF5252' },
        balloon: { name: 'balloons', emoji: '🎈', color: '#38B6FF' },
        flower: { name: 'flowers', emoji: '🌸', color: '#FF66C4' }
    };

    function popObjectSound(wrapper) {
        if (typeof SoundFX !== 'undefined' && SoundFX.play) {
            SoundFX.play('pop');
        }
        wrapper.style.transform = 'scale(1.35) rotate(10deg)';
        setTimeout(() => {
            wrapper.style.transform = '';
        }, 300);
    }

    function generateQuestion() {
        countingGrid.innerHTML = '';
        choicesArea.innerHTML = '';

        // Generate target number (2 to 9)
        currentNumber = Math.floor(Math.random() * 8) + 2; 
        const itemTypes = ['star', 'apple', 'balloon', 'flower'];
        currentItemType = itemTypes[Math.floor(Math.random() * itemTypes.length)];
        const itemInfo = itemNames[currentItemType];

        // Set Question Title text
        questionText.innerHTML = `How many <strong style="color: ${itemInfo.color}; font-weight: 900;">${itemInfo.name}</strong> ${itemInfo.emoji} do you see?`;

        // Speak question in cute child voice
        if (localStorage.getItem('voice_enabled') !== 'false') {
            if (typeof SoundFX !== 'undefined' && SoundFX.speak) {
                SoundFX.speak(`How many ${itemInfo.name} do you see?`, 'en-US');
            }
        }

        // Render counting items inside grid
        for (let i = 0; i < currentNumber; i++) {
            const wrap = document.createElement('div');
            wrap.innerHTML = itemSvgs[currentItemType];
            
            const itemElement = wrap.firstElementChild;
            itemElement.style.animationDelay = (Math.random() * 2) + 's';
            countingGrid.appendChild(itemElement);
        }

        // Generate options (one correct, two wrong)
        const choices = [currentNumber];
        while (choices.length < 3) {
            const wrong = Math.max(1, currentNumber + (Math.random() > 0.5 ? 1 : -1) * (Math.floor(Math.random() * 2) + 1));
            if (!choices.includes(wrong) && wrong <= 10) {
                choices.push(wrong);
            }
        }

        // Shuffle options
        choices.sort(() => Math.random() - 0.5);

        // Render 3D choice buttons
        choices.forEach(choice => {
            const btn = document.createElement('button');
            btn.className = 'num-choice-btn';
            btn.innerText = choice;
            btn.addEventListener('click', () => verifyAnswer(choice, btn));
            choicesArea.appendChild(btn);
        });
    }

    function verifyAnswer(selected, buttonElement) {
        // Disable buttons to prevent double click
        Array.from(choicesArea.children).forEach(btn => btn.disabled = true);

        if (selected === currentNumber) {
            // Correct Answer!
            if (typeof SoundFX !== 'undefined' && SoundFX.play) {
                SoundFX.play('success');
            }
            
            buttonElement.classList.add('num-btn-correct');

            if (localStorage.getItem('voice_enabled') !== 'false') {
                if (typeof SoundFX !== 'undefined' && SoundFX.speak) {
                    SoundFX.speak(`${currentNumber}! Correct! Great job!`, 'en-US');
                }
            }

            if (typeof confetti === 'function') {
                confetti({
                    particleCount: 60,
                    spread: 60,
                    origin: { y: 0.7 }
                });
            }

            // Increment stats
            correctCount++;
            starsCount += 5; 
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
                    activity_name: 'Counted ' + currentNumber + ' ' + itemNames[currentItemType].name
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
            if (typeof SoundFX !== 'undefined' && SoundFX.play) {
                SoundFX.play('click');
            }
            buttonElement.classList.add('num-btn-wrong');

            if (localStorage.getItem('voice_enabled') !== 'false') {
                if (typeof SoundFX !== 'undefined' && SoundFX.speak) {
                    SoundFX.speak(`Oops! That is ${selected}. Try again!`, 'en-US');
                }
            }

            setTimeout(() => {
                buttonElement.classList.remove('num-btn-wrong');
                Array.from(choicesArea.children).forEach(btn => btn.disabled = false);
            }, 1200);
        }
    }

    // Initialize game
    document.addEventListener('DOMContentLoaded', () => {
        generateQuestion();
    });
</script>
@endsection
