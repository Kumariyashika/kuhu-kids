@extends('layouts.app')

@section('title', 'Kuhu Kids Learning - Balloon Pop!')

@section('content')
<div class="inner-container">
    <div class="inner-header">
        <h1 class="inner-title">
            <span style="color: var(--color-green-real);">🎈 Balloon Pop Game</span>
        </h1>
        <a href="{{ route('dashboard') }}" class="btn-3d btn-yellow">&lt; Back to Home</a>
    </div>

    <style>
        .balloon-grid {
            display: grid;
            grid-template-columns: repeat(2, auto);
            gap: 30px;
            justify-content: center;
            align-content: center;
            width: 100%;
            height: 100%;
            min-height: 380px;
            padding: 20px;
        }

        .static-balloon {
            position: relative;
            width: 110px;
            height: 140px;
            border-radius: 50% 50% 50% 50% / 40% 40% 60% 60%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3.2rem;
            color: white;
            font-weight: 800;
            cursor: pointer;
            box-shadow: inset -6px -10px 0 rgba(0,0,0,0.15), 0 8px 16px rgba(0,0,0,0.1);
            transition: all 0.2s ease;
            animation: gentleBob 2s ease-in-out infinite alternate;
        }

        /* Stagger the bobbing animations so they look natural */
        .static-balloon:nth-child(even) {
            animation-duration: 2.3s;
            animation-delay: 0.3s;
        }

        .static-balloon:hover {
            transform: translateY(-5px) scale(1.05);
        }

        /* Balloon string */
        .static-string {
            position: absolute;
            bottom: -22px;
            left: 50%;
            width: 3px;
            height: 25px;
            background-color: #A0AEC0;
            transform: translateX(-50%);
        }

        @keyframes gentleBob {
            0% { transform: translateY(0); }
            100% { transform: translateY(-8px); }
        }

        @keyframes shakeWrong {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-8px); }
            40%, 80% { transform: translateX(8px); }
        }

        .wrong-shake {
            animation: shakeWrong 0.4s ease-in-out !important;
            background-color: #CBD5E1 !important;
            color: #64748B !important;
            border-color: #94A3B8 !important;
            box-shadow: none !important;
        }

        .balloon-pop-game-area {
            position: relative;
            background: radial-gradient(circle, #EBF8FF 0%, #BEE3F8 100%);
            border: 3px solid var(--color-green-real);
            border-radius: 0 0 20px 20px;
            min-height: 420px;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>

    <!-- Score & Star Counter -->
    <div class="pop-score-board" style="border-radius: 16px 16px 0 0; border: 3px solid var(--color-green-real); border-bottom: none; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px; padding: 12px 24px; background: #F7FAFC;">
        <span style="font-size: 1.25rem;">🏆 Level: <strong id="levelDisplay" style="color: var(--color-pink);">1</strong></span>
        <span style="font-size: 1.4rem; background: #FFFDF0; padding: 4px 18px; border-radius: 14px; border: 2.3px solid var(--color-purple); display: inline-flex; align-items: center; gap: 8px;">🎯 Touch: <strong id="targetDisplay" style="color: var(--color-purple); font-size: 1.8rem; font-weight: 900;">A</strong></span>
        <span style="font-size: 1.25rem;">🌟 Stars: <strong id="starsDisplay" style="color: var(--color-yellow-shadow);">0</strong></span>
    </div>

    <!-- Game Arena -->
    <div class="balloon-pop-game-area" id="gameArea">
        <div id="startScreen" style="position: absolute; width: 100%; height: 100%; background: rgba(255,255,255,0.92); display: flex; flex-direction: column; justify-content: center; align-items: center; z-index: 50; gap: 20px;">
            <h2 style="font-size: 2.2rem; font-weight: 800; color: var(--color-purple); text-align: center; margin: 0 15px;">Ready to learn with balloons?</h2>
            <p style="font-size: 1.1rem; color: #718096; margin: 0 20px; text-align: center;">Touch the correct balloon to clear the level and earn stars! 🌟</p>
            <button onclick="startGame()" class="btn-3d" style="font-size: 1.6rem; padding: 16px 48px; background: var(--color-green-real); color: white; border-bottom: 6px solid var(--color-green-real-shadow);">
                ▶️ Start Game!
            </button>
        </div>
        
        <div class="balloon-grid" id="balloonGrid" style="display: none;">
            <!-- 4 option balloons will be rendered here -->
        </div>
    </div>
</div>

<script>
    const gameArea = document.getElementById('gameArea');
    const startScreen = document.getElementById('startScreen');
    const balloonGrid = document.getElementById('balloonGrid');
    const levelDisplay = document.getElementById('levelDisplay');
    const targetDisplay = document.getElementById('targetDisplay');
    const starsDisplay = document.getElementById('starsDisplay');

    let level = 1;
    let starsEarned = 0;
    let isPlaying = false;
    let targetLetter = '';

    const balloonColors = [
        '#FF5252', '#FF4081', '#E040FB', '#7C4DFF', '#536DFE', '#448AFF', '#40C4FF', '#FFB300', '#4CAF50', '#00E676', '#81C784', '#D4E157', '#FFD54F', '#FF9100', '#FF3D00'
    ];

    function startGame() {
        startScreen.style.display = 'none';
        balloonGrid.style.display = 'grid';
        isPlaying = true;
        level = 1;
        starsEarned = 0;
        
        levelDisplay.innerText = level;
        starsDisplay.innerText = starsEarned;

        loadNextLevel();
    }

    function loadNextLevel() {
        if (!isPlaying) return;

        // 1. Choose Target Letter
        const alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        targetLetter = alphabet[Math.floor(Math.random() * alphabet.length)];
        targetDisplay.innerText = targetLetter;

        // 2. Select 3 incorrect letter options
        const options = [targetLetter];
        while (options.length < 4) {
            const randomLetter = alphabet[Math.floor(Math.random() * alphabet.length)];
            if (!options.includes(randomLetter)) {
                options.push(randomLetter);
            }
        }

        // 3. Shuffle options
        options.sort(() => Math.random() - 0.5);

        // 4. Render balloons
        balloonGrid.innerHTML = '';
        
        // Select 4 random colors
        const shuffledColors = [...balloonColors].sort(() => Math.random() - 0.5);

        options.forEach((letter, idx) => {
            const color = shuffledColors[idx];
            
            const balloon = document.createElement('div');
            balloon.className = 'static-balloon';
            balloon.style.backgroundColor = color;
            balloon.innerText = letter;

            const string = document.createElement('div');
            string.className = 'static-string';
            balloon.appendChild(string);

            // Click/touch action
            balloon.onclick = () => handleChoice(balloon, letter);
            balloon.ontouchstart = (e) => {
                handleChoice(balloon, letter);
                e.preventDefault();
            };

            balloonGrid.appendChild(balloon);
        });

        // 5. Speak instruction
        if (localStorage.getItem('voice_enabled') !== 'false') {
            SoundFX.speak("Touch balloon " + targetLetter);
        }
    }

    function handleChoice(balloonElement, letter) {
        if (!isPlaying) return;
        if (balloonElement.classList.contains('wrong-shake') || balloonElement.style.opacity === '0') return;

        if (letter === targetLetter) {
            // Correct Choice!
            SoundFX.play('pop');
            if (localStorage.getItem('voice_enabled') !== 'false') {
                SoundFX.speak("Correct!");
            }

            // Shrink and fade pop effect
            balloonElement.style.transform = 'scale(1.3)';
            balloonElement.style.opacity = '0';

            // Add stars
            level++;
            starsEarned += 5; // 5 stars for clearing a level
            levelDisplay.innerText = level;
            starsDisplay.innerText = starsEarned;

            // Update user session stars
            fetch("{{ route('api.add_stars') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    stars: 5,
                    activity_name: 'Cleared Balloon level ' + (level - 1)
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

            // Load next level after pop animation
            setTimeout(() => {
                loadNextLevel();
            }, 600);

        } else {
            // Wrong Choice!
            balloonElement.classList.add('wrong-shake');
            SoundFX.play('click'); // Click or fallback buzz

            if (localStorage.getItem('voice_enabled') !== 'false') {
                SoundFX.speak("Oops! Try again. Find balloon " + targetLetter);
            }

            // Clear shake class after animation completes so they can retry
            setTimeout(() => {
                balloonElement.classList.remove('wrong-shake');
            }, 500);
        }
    }

    window.addEventListener('beforeunload', () => {
        isPlaying = false;
    });
</script>
@endsection
