@extends('layouts.app')

@section('title', 'Kuhu Kids Learning - Letter Match')

@section('content')
<div class="inner-container" style="position: relative;">
    <div class="inner-header">
        <h1 class="inner-title">
            <span style="color: var(--color-blue);">🧩 Letter Match Game</span>
        </h1>
        <a href="{{ route('dashboard') }}" class="btn-3d btn-yellow" style="display: flex; align-items: center; justify-content: center; border-radius: 50%; width: 44px; height: 44px; padding: 0; text-decoration: none; margin: 0;" title="Back to Home">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
        </a>
    </div>

    <div style="background: #FFFDF0; padding: 15px; border-radius: 20px; border: 3px solid #E2E8F0; text-align: center; margin-bottom: 24px;">
        <h2 style="color: var(--color-blue); font-size: 1.4rem; font-weight: 800; margin: 0;">Draw a line to match the letters! ✏️</h2>
    </div>

    <!-- Match Game Grid with SVG overlay -->
    <div class="matching-game-area" id="matchingArea" style="position: relative; display: flex; justify-content: space-between; gap: 80px; padding: 20px; background: white; border-radius: 24px; border: 3px solid #E2E8F0; min-height: 400px; user-select: none;">
        
        <!-- SVG overlay for drawing lines -->
        <svg id="matchingSvg" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; z-index: 5;"></svg>

        <!-- Left Column (Uppercase) -->
        <div class="match-column" id="uppercaseColumn" style="display: flex; flex-direction: column; gap: 24px; z-index: 10; width: 40%;">
            <!-- Populated dynamically -->
        </div>

        <!-- Right Column (Uppercase - Shuffled) -->
        <div class="match-column" id="lowercaseColumn" style="display: flex; flex-direction: column; gap: 24px; z-index: 10; width: 40%;">
            <!-- Populated dynamically -->
        </div>
    </div>

    <!-- Mini Game Overlay (Balloon/Bubble Pop) -->
    <div id="miniGameOverlay" style="display: none; position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(180deg, #A1E3FF 0%, #D4F3FF 100%); border-radius: 30px; z-index: 100; flex-direction: column; align-items: center; justify-content: center; padding: 24px; box-sizing: border-box; text-align: center; overflow: hidden;">
        <h2 id="miniGameTitle" style="color: #FF5252; font-size: 2.2rem; font-weight: 900; margin: 0 0 5px 0; text-shadow: 2px 2px 0px rgba(0,0,0,0.05); font-family: 'Fredoka', sans-serif;">🎈 Balloon Pop Bonus!</h2>
        <p id="miniGameSub" style="font-size: 1.3rem; font-weight: 800; color: #4A3B00; margin: 0 0 20px 0; font-family: 'Fredoka', sans-serif;">Pop 5 balloons to unlock the next level!</p>
        
        <div id="miniGameArea" style="width: 100%; flex: 1; position: relative; background: rgba(255, 255, 255, 0.4); border-radius: 24px; border: 3px dashed #FFF; overflow: hidden; cursor: crosshair;">
            <!-- Balloons or bubbles will spawn dynamically here -->
        </div>

        <button id="miniGameNextBtn" class="btn-3d" style="display: none; background: var(--color-green-real); border-bottom: 6px solid var(--color-green-real-shadow); color: white; font-size: 1.4rem; padding: 12px 36px; border-radius: 20px; margin-top: 20px; cursor: pointer; font-family: 'Fredoka', sans-serif;">
            Play Level 2 ➡️
        </button>
    </div>
</div>

<style>
    .match-item {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 68px;
        font-size: 2.3rem;
        font-weight: 800;
        border: 3.5px solid #E2E8F0;
        border-radius: 18px;
        background: white;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    }
    
    .match-item:hover {
        transform: scale(1.03);
        border-color: var(--color-blue);
    }

    .connector-dot {
        width: 14px;
        height: 14px;
        background-color: var(--color-purple);
        border: 2.5px solid white;
        border-radius: 50%;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        pointer-events: auto; /* make dots drag targets */
    }

    .left-connector {
        right: -7px;
    }

    .right-connector {
        left: -7px;
    }

    .matched-item {
        background-color: #DCFCE7 !important;
        border-color: #4ADE80 !important;
        color: #15803D !important;
        cursor: default;
    }
</style>

<script>
    let matchedPairsCount = 0;
    const colors = ['#FF5757', '#FF914D', '#7ED957', '#38B6FF'];
    
    // Drag-to-draw variables
    let isDrawing = false;
    let dragStartCard = null;
    let dragStartX = 0;
    let dragStartY = 0;
    let activeTempLine = null;

    // Click-to-connect fallback variables
    let selectedLeftCard = null;

    function generateNewSet() {
        const uppercaseCol = document.getElementById('uppercaseColumn');
        const rightCol = document.getElementById('lowercaseColumn');
        const svg = document.getElementById('matchingSvg');
        
        // Reset states
        uppercaseCol.innerHTML = '';
        rightCol.innerHTML = '';
        svg.innerHTML = '';
        matchedPairsCount = 0;
        selectedLeftCard = null;
        isDrawing = false;

        // Choose 4 random unique letters
        const alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.split('');
        const chosenLetters = [];
        while (chosenLetters.length < 4) {
            const letter = alphabet[Math.floor(Math.random() * alphabet.length)];
            if (!chosenLetters.includes(letter)) {
                chosenLetters.push(letter);
            }
        }

        // 1. Generate Left Column Cards (Uppercase)
        chosenLetters.forEach((letter, index) => {
            const card = document.createElement('div');
            card.className = 'match-item';
            card.innerText = letter;
            card.style.borderColor = colors[index % colors.length];
            card.dataset.letter = letter;
            card.dataset.side = 'left';

            const dot = document.createElement('div');
            dot.className = 'connector-dot left-connector';
            card.appendChild(dot);

            // Bind events for drag and tap
            bindDragEvents(card);
            card.onclick = () => handleLeftCardClick(card);

            uppercaseCol.appendChild(card);
        });

        // 2. Generate Right Column Cards (Uppercase - Shuffled)
        const shuffledLetters = [...chosenLetters].sort(() => Math.random() - 0.5);
        shuffledLetters.forEach((letter, index) => {
            const card = document.createElement('div');
            card.className = 'match-item';
            card.innerText = letter;
            card.style.borderColor = '#E2E8F0';
            card.dataset.letter = letter;
            card.dataset.side = 'right';

            const dot = document.createElement('div');
            dot.className = 'connector-dot right-connector';
            card.appendChild(dot);

            card.onclick = () => handleRightCardClick(card);

            rightCol.appendChild(card);
        });
    }

    // --- Drag and Draw Mechanics ---

    function getConnectorCoordinates(element) {
        const dot = element.querySelector('.connector-dot');
        const dotRect = dot.getBoundingClientRect();
        const areaRect = document.getElementById('matchingArea').getBoundingClientRect();
        return {
            x: dotRect.left - areaRect.left + (dotRect.width / 2),
            y: dotRect.top - areaRect.top + (dotRect.height / 2)
        };
    }

    function bindDragEvents(card) {
        // We start drawing when clicking/touching the card or the dot
        const startDraw = (e) => {
            if (card.classList.contains('matched-item')) return;
            
            // Highlight card
            selectLeftCardState(card);

            isDrawing = true;
            dragStartCard = card;

            const coords = getConnectorCoordinates(card);
            dragStartX = coords.x;
            dragStartY = coords.y;

            // Create temp line in SVG
            const svg = document.getElementById('matchingSvg');
            if (activeTempLine) activeTempLine.remove();

            activeTempLine = document.createElementNS('http://www.w3.org/2000/svg', 'line');
            activeTempLine.setAttribute('x1', dragStartX);
            activeTempLine.setAttribute('y1', dragStartY);
            activeTempLine.setAttribute('x2', dragStartX);
            activeTempLine.setAttribute('y2', dragStartY);
            activeTempLine.setAttribute('stroke', '#8C52FF');
            activeTempLine.setAttribute('stroke-width', '5');
            activeTempLine.setAttribute('stroke-linecap', 'round');
            activeTempLine.setAttribute('stroke-dasharray', '8,5');
            svg.appendChild(activeTempLine);

            SoundFX.play('click');
        };

        card.addEventListener('mousedown', startDraw);
        card.addEventListener('touchstart', (e) => {
            startDraw(e);
            e.preventDefault();
        }, { passive: false });
    }

    // Global drag moves
    const moveDraw = (e) => {
        if (!isDrawing || !activeTempLine) return;

        const area = document.getElementById('matchingArea');
        const areaRect = area.getBoundingClientRect();

        let clientX, clientY;
        if (e.touches) {
            clientX = e.touches[0].clientX;
            clientY = e.touches[0].clientY;
        } else {
            clientX = e.clientX;
            clientY = e.clientY;
        }

        const currentX = clientX - areaRect.left;
        const currentY = clientY - areaRect.top;

        activeTempLine.setAttribute('x2', currentX);
        activeTempLine.setAttribute('y2', currentY);
    };

    const endDraw = (e) => {
        if (!isDrawing) return;
        isDrawing = false;

        if (activeTempLine) {
            activeTempLine.remove();
            activeTempLine = null;
        }

        let clientX, clientY;
        if (e.changedTouches) {
            clientX = e.changedTouches[0].clientX;
            clientY = e.changedTouches[0].clientY;
        } else {
            clientX = e.clientX;
            clientY = e.clientY;
        }

        // Find element under touch/pointer
        const targetElement = document.elementFromPoint(clientX, clientY);
        if (!targetElement) return;

        // Find matching item card
        const rightCard = targetElement.closest('.match-item');
        if (rightCard && rightCard.dataset.side === 'right' && !rightCard.classList.contains('matched-item')) {
            checkAndMatch(dragStartCard, rightCard);
        }
    };

    document.addEventListener('mousemove', moveDraw);
    document.addEventListener('touchmove', moveDraw, { passive: true });
    document.addEventListener('mouseup', endDraw);
    document.addEventListener('touchend', endDraw);

    // --- Click / Tap Mechanics ---

    function handleLeftCardClick(card) {
        if (card.classList.contains('matched-item')) return;
        selectLeftCardState(card);
        SoundFX.play('click');
    }

    function selectLeftCardState(card) {
        // Deselect previous
        document.querySelectorAll('#uppercaseColumn .match-item').forEach(c => {
            if (!c.classList.contains('matched-item')) {
                c.style.backgroundColor = 'white';
            }
        });

        selectedLeftCard = card;
        card.style.backgroundColor = '#E0F2FE'; // light blue highlight
        if (localStorage.getItem('voice_enabled') !== 'false') {
            SoundFX.speak(card.dataset.letter);
        }
    }

    function handleRightCardClick(card) {
        if (card.classList.contains('matched-item')) return;

        if (!selectedLeftCard) {
            if (localStorage.getItem('voice_enabled') !== 'false') {
                SoundFX.speak("Tap a letter on the left first!");
            }
            return;
        }

        checkAndMatch(selectedLeftCard, card);
    }

    // --- Core Match Engine ---

    function checkAndMatch(leftCard, rightCard) {
        const letter = leftCard.dataset.letter;

        if (rightCard.dataset.letter === letter) {
            // MATCH SUCCESS!
            SoundFX.play('success');

            leftCard.classList.add('matched-item');
            rightCard.classList.add('matched-item');

            leftCard.style.backgroundColor = '#DCFCE7';
            rightCard.style.backgroundColor = '#DCFCE7';

            // Draw permanent line connecting them
            const svg = document.getElementById('matchingSvg');
            const coordsLeft = getConnectorCoordinates(leftCard);
            const coordsRight = getConnectorCoordinates(rightCard);

            const permLine = document.createElementNS('http://www.w3.org/2000/svg', 'line');
            permLine.setAttribute('x1', coordsLeft.x);
            permLine.setAttribute('y1', coordsLeft.y);
            permLine.setAttribute('x2', coordsRight.x);
            permLine.setAttribute('y2', coordsRight.y);
            permLine.setAttribute('stroke', leftCard.style.borderColor || '#38B6FF');
            permLine.setAttribute('stroke-width', '6');
            permLine.setAttribute('stroke-linecap', 'round');
            
            // Add subtle draw animation
            permLine.style.strokeDasharray = '1000';
            permLine.style.strokeDashoffset = '1000';
            permLine.style.animation = 'drawMatchLine 0.4s ease-out forwards';
            
            svg.appendChild(permLine);

            if (localStorage.getItem('voice_enabled') !== 'false') {
                SoundFX.speak("Match correct!");
            }

            // Reset selection state
            selectedLeftCard = null;
            matchedPairsCount++;

            if (matchedPairsCount === 4) {
                setTimeout(victoryCheer, 800);
            }
        } else {
            // MATCH FAILED
            SoundFX.play('click');
            rightCard.style.backgroundColor = '#FEE2E2'; // flash red
            setTimeout(() => {
                if (!rightCard.classList.contains('matched-item')) {
                    rightCard.style.backgroundColor = 'white';
                }
            }, 500);

            if (localStorage.getItem('voice_enabled') !== 'false') {
                SoundFX.speak("Oops! Try again.");
            }
        }
    }

    let currentLevel = 1;
    let balloonsPopped = 0;
    
    const levelDisplay = document.getElementById('levelDisplay');
    const starsDisplay = document.getElementById('starsDisplay');
    const coinsDisplay = document.getElementById('coinsDisplay');
    const miniGameOverlay = document.getElementById('miniGameOverlay');
    const miniGameTitle = document.getElementById('miniGameTitle');
    const miniGameSub = document.getElementById('miniGameSub');
    const miniGameArea = document.getElementById('miniGameArea');
    const miniGameNextBtn = document.getElementById('miniGameNextBtn');
    let balloonInterval = null;

    function victoryCheer() {
        SoundFX.play('cheer');
        
        let starsToAward = 15;
        let coinsToAward = 0;
        const isLevel20 = (currentLevel === 20);
        
        if (isLevel20) {
            coinsToAward = 100; // award 100 coins on completing level 20!
        }
        
        if (localStorage.getItem('voice_enabled') !== 'false') {
            if (isLevel20) {
                SoundFX.speak("Outstanding! You completed level 20 and earned 100 bonus coins!");
            } else {
                SoundFX.speak(`Excellent matching! Level ${currentLevel} complete!`);
            }
        }

        // Award stars/coins to DB
        fetch("{{ route('api.add_stars') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                stars: starsToAward,
                coins: coinsToAward,
                activity_name: 'Letter Match Level ' + currentLevel
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                if (starsDisplay) starsDisplay.innerText = data.new_stars;
                if (coinsDisplay && data.new_coins !== undefined) coinsDisplay.innerText = data.new_coins;
            }
        });

        // Trigger mini game overlay after every level complete!
        setTimeout(startMiniGame, 1800);
    }

    // --- Balloon / Bubble Pop Mini Game Logic ---

    function startMiniGame() {
        miniGameOverlay.style.display = 'flex';
        miniGameArea.style.display = 'block';
        balloonsPopped = 0;
        miniGameArea.innerHTML = '';
        miniGameNextBtn.style.display = 'none';

        const isBubbleMode = (currentLevel % 2 === 0);
        if (currentLevel === 20) {
            miniGameTitle.innerText = "🏆 GRAND CHAMPION! 🏆";
            miniGameSub.innerText = "You completed all 20 levels! Pop 5 bubbles to claim your 100 bonus coins! 🪙";
        } else {
            const icon = isBubbleMode ? '🫧' : '🎈';
            const typeText = isBubbleMode ? 'bubbles' : 'balloons';
            miniGameTitle.innerText = `${icon} Level ${currentLevel} Complete! ${icon}`;
            miniGameSub.innerText = `Pop 5 ${typeText} to unlock Level ${currentLevel + 1}!`;
        }

        spawnBalloon();
        balloonInterval = setInterval(spawnBalloon, 800);
    }

    function spawnBalloon() {
        if (balloonsPopped >= 5) {
            clearInterval(balloonInterval);
            return;
        }

        const areaRect = miniGameArea.getBoundingClientRect();
        const balloon = document.createElement('div');
        const isBubbleMode = (currentLevel % 2 === 0);
        
        balloon.style.position = 'absolute';
        balloon.style.bottom = '-100px';
        
        const size = Math.floor(Math.random() * 25) + 55; // 55 to 80px
        balloon.style.width = size + 'px';
        balloon.style.height = (isBubbleMode ? size : size * 1.25) + 'px';
        
        const randomX = Math.random() * (areaRect.width - size - 20) + 10;
        balloon.style.left = randomX + 'px';
        
        if (isBubbleMode) {
            // Bubble Style
            balloon.style.background = 'radial-gradient(circle at 30% 30%, rgba(255, 255, 255, 0.9) 0%, rgba(56, 182, 255, 0.45) 50%, rgba(140, 82, 255, 0.6) 100%)';
            balloon.style.borderRadius = '50%';
            balloon.style.border = '2.5px solid rgba(255, 255, 255, 0.6)';
            balloon.style.boxShadow = 'inset -5px -5px 15px rgba(0,0,0,0.08), 0 5px 10px rgba(0,0,0,0.05)';
        } else {
            // Balloon Style
            const colorsList = ['#FF66C4', '#38B6FF', '#FFDE59', '#7ED957', '#8C52FF', '#FF914D'];
            const color = colorsList[Math.floor(Math.random() * colorsList.length)];
            balloon.style.backgroundColor = color;
            balloon.style.borderRadius = '50% 50% 50% 50% / 40% 40% 60% 60%';
            balloon.style.boxShadow = 'inset -8px -8px 0 rgba(0,0,0,0.15)';
            
            const string = document.createElement('div');
            string.style.position = 'absolute';
            string.style.bottom = '-14px';
            string.style.left = '50%';
            string.style.width = '2px';
            string.style.height = '14px';
            string.style.backgroundColor = '#8D6E63';
            balloon.appendChild(string);
        }
        
        balloon.style.cursor = 'pointer';
        balloon.style.transition = 'transform 0.1s ease';
        
        const popHandler = (e) => {
            e.stopPropagation();
            if (balloon.dataset.popped === 'true') return;
            balloon.dataset.popped = 'true';
            
            SoundFX.play('pop');
            
            balloon.style.transform = 'scale(1.4)';
            balloon.style.opacity = '0';
            
            if (typeof confetti === 'function') {
                const rect = balloon.getBoundingClientRect();
                confetti({
                    particleCount: 15,
                    spread: 45,
                    origin: { 
                        x: (rect.left + rect.width/2) / window.innerWidth, 
                        y: (rect.top + rect.height/2) / window.innerHeight 
                    },
                    colors: ['#FFD700', '#FF69B4', '#00FFFF', '#32CD32']
                });
            }

            setTimeout(() => balloon.remove(), 100);

            balloonsPopped++;
            if (isBubbleMode) {
                miniGameSub.innerText = `Popped: ${balloonsPopped} / 5 🫧`;
            } else {
                miniGameSub.innerText = `Popped: ${balloonsPopped} / 5 🎈`;
            }

            if (balloonsPopped === 5) {
                handleMiniGameVictory();
            }
        };

        balloon.addEventListener('mousedown', popHandler);
        balloon.addEventListener('touchstart', popHandler);

        miniGameArea.appendChild(balloon);

        // Animate float
        let posY = -100;
        const speed = Math.random() * 1.5 + 2.5; 
        
        function floatUp() {
            if (balloon.dataset.popped === 'true') return;
            posY += speed;
            balloon.style.bottom = posY + 'px';
            
            const wobble = Math.sin(posY / 30) * 8;
            balloon.style.transform = `translateX(${wobble}px)`;

            if (posY < areaRect.height + 120) {
                requestAnimationFrame(floatUp);
            } else {
                balloon.remove();
            }
        }
        
        requestAnimationFrame(floatUp);
    }

    function handleMiniGameVictory() {
        clearInterval(balloonInterval);
        SoundFX.play('cheer');
        
        if (currentLevel === 20) {
            miniGameTitle.innerText = "👑 CONGRATULATIONS! 👑";
            miniGameSub.innerText = "You earned 100 bonus coins! All 20 levels completed successfully!";
            miniGameNextBtn.innerText = "Play Again 🔄";
            miniGameNextBtn.onclick = () => {
                miniGameOverlay.style.display = 'none';
                currentLevel = 1;
                if (levelDisplay) levelDisplay.innerText = currentLevel;
                generateNewSet();
            };
        } else {
            miniGameTitle.innerText = "🌟 BONUS COMPLETED! 🌟";
            miniGameSub.innerText = `Awesome! Level ${currentLevel + 1} is now unlocked!`;
            miniGameNextBtn.innerText = `Play Level ${currentLevel + 1} ➡️`;
            miniGameNextBtn.onclick = () => {
                miniGameOverlay.style.display = 'none';
                currentLevel++;
                if (levelDisplay) levelDisplay.innerText = currentLevel;
                generateNewSet();
            };
        }
        miniGameNextBtn.style.display = 'inline-block';
    }

    document.addEventListener('DOMContentLoaded', () => {
        generateNewSet();
    });
</script>

<style>
    @keyframes drawMatchLine {
        to {
            stroke-dashoffset: 0;
        }
    }
</style>
@endsection
