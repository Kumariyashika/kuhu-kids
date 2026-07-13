@extends('layouts.app')

@section('title', 'Kuhu Kids Learning - Balloon Pop!')

@section('content')
<div class="inner-container">
    <div class="inner-header">
        <h1 class="inner-title">
            <span style="color: var(--color-green-real);">🎈 Balloon Pop Game</span>
        </h1>
        <a href="{{ route('dashboard') }}" class="btn-3d btn-yellow" style="display: flex; align-items: center; justify-content: center; border-radius: 50%; width: 44px; height: 44px; padding: 0; text-decoration: none; margin: 0;" title="Back to Home">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
        </a>
    </div>

    <style>
        .balloon-grid {
            display: grid;
            grid-template-columns: repeat(3, auto);
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
            width: 120px;
            height: 155px;
            border-radius: 50% 50% 50% 50% / 40% 40% 60% 60%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: inset -6px -10px 0 rgba(0,0,0,0.15), 0 8px 16px rgba(0,0,0,0.15);
            transition: all 0.2s ease;
            animation: gentleBob 2s ease-in-out infinite alternate;
        }

        /* Cute Smiley faces on Balloons */
        .static-balloon::before {
            content: '';
            position: absolute;
            top: 25%;
            left: 28%;
            width: 8px;
            height: 8px;
            background: white;
            border-radius: 50%;
            box-shadow: 38px 0 0 white; /* second eye */
            z-index: 2;
        }

        .static-balloon::after {
            content: '';
            position: absolute;
            top: 42%;
            left: 50%;
            width: 22px;
            height: 11px;
            border-bottom: 4px solid white;
            border-radius: 0 0 11px 11px;
            transform: translateX(-50%);
            z-index: 2;
        }

        .balloon-label {
            position: absolute;
            bottom: 12%;
            width: 100%;
            text-align: center;
            font-size: 2.8rem;
            font-weight: 900;
            color: white;
            text-shadow: 2px 2px 0px rgba(0, 0, 0, 0.25);
            pointer-events: none;
            z-index: 3;
        }

        /* Stagger the bobbing animations */
        .static-balloon:nth-child(even) {
            animation-duration: 2.3s;
            animation-delay: 0.3s;
        }

        .static-balloon:hover {
            transform: translateY(-8px) scale(1.06);
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
            z-index: 1;
        }

        @keyframes gentleBob {
            0% { transform: translateY(0); }
            100% { transform: translateY(-10px); }
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

        @keyframes wiggleClue {
            0%, 100% { transform: scale(1) rotate(0deg); }
            15% { transform: scale(1.15) rotate(-8deg); }
            30% { transform: scale(1.15) rotate(8deg); }
            45% { transform: scale(1.15) rotate(-6deg); }
            60% { transform: scale(1.15) rotate(6deg); }
            75% { transform: scale(1.1) rotate(-3deg); }
            90% { transform: scale(1.1) rotate(3deg); }
        }

        .wiggle-hint {
            animation: wiggleClue 1.2s ease-in-out infinite alternate !important;
            box-shadow: 0 0 25px rgba(255, 223, 0, 0.85), inset -6px -10px 0 rgba(0,0,0,0.15) !important;
        }

        .balloon-pop-game-area {
            position: relative;
            background: radial-gradient(circle, #EBF8FF 0%, #BEE3F8 100%);
            border: 3px solid var(--color-green-real);
            border-radius: 0 0 20px 20px;
            min-height: 440px;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        @keyframes particleAnimation {
            0% {
                transform: translate(0, 0) scale(1);
                opacity: 1;
            }
            100% {
                transform: translate(var(--tx), var(--ty)) scale(0);
                opacity: 0;
            }
        }
    </style>

    <!-- Score & Mode Switcher Board -->
    <div class="pop-score-board" style="border-radius: 16px 16px 0 0; border: 3px solid var(--color-green-real); border-bottom: none; background: #F7FAFC; padding: 15px 24px; display: flex; flex-direction: column; gap: 15px;">
        <!-- Top Row: Selectors and Stats -->
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px; border-bottom: 2px dashed #E2E8F0; padding-bottom: 12px; width: 100%;">
            <div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
                <div>
                    <span style="font-size: 1.1rem; font-weight: bold; color: #4A5568; margin-right: 6px;">🎮 Mode:</span>
                    <select id="gameModeSelect" onchange="changeMode()" style="font-size: 1rem; padding: 6px 12px; border-radius: 10px; border: 2.3px solid var(--color-green-real); font-weight: bold; cursor: pointer; outline: none; background: white;">
                        <option value="letters">Letters 🎈</option>
                        <option value="numbers">Numbers 🔢</option>
                        <option value="colors">Colors 🎨</option>
                    </select>
                </div>
                <div>
                    <span style="font-size: 1.1rem; font-weight: bold; color: #4A5568; margin-right: 6px;">🔊 Voice:</span>
                    <select id="voiceLangSelect" onchange="changeVoiceLang()" style="font-size: 1rem; padding: 6px 12px; border-radius: 10px; border: 2.3px solid var(--color-purple); font-weight: bold; cursor: pointer; outline: none; background: white;">
                        <option value="en">English 🇬🇧</option>
                        <option value="hi">Hindi 🇮🇳</option>
                    </select>
                </div>
                <div>
                    <span style="font-size: 1.1rem; font-weight: bold; color: #4A5568; margin-right: 6px;">🎈 Balloons:</span>
                    <select id="balloonCountSelect" onchange="changeBalloonCount()" style="font-size: 1rem; padding: 6px 12px; border-radius: 10px; border: 2.3px solid var(--color-pink); font-weight: bold; cursor: pointer; outline: none; background: white;">
                        <option value="3" selected>3 (Easy)</option>
                        <option value="4">4 (Normal)</option>
                    </select>
                </div>
            </div>
            
            <div style="display: flex; gap: 15px; font-weight: bold; font-size: 1.15rem;">
                <span>🏆 Level: <strong id="levelDisplay" style="color: var(--color-pink);">1</strong></span>
            </div>
        </div>

        <!-- Target Prompt Row -->
        <div style="display: flex; justify-content: center; align-items: center; gap: 20px; padding: 5px 0; width: 100%;">
            <div style="text-align: center; display: flex; align-items: center; gap: 12px;">
                <span id="instructionLabel" style="font-size: 1.4rem; font-weight: 800; color: #4A5568;">Find balloon:</span>
                <div id="targetBadge" style="display: inline-flex; align-items: center; justify-content: center; min-width: 75px; height: 75px; border-radius: 18px; background: white; border: 4px solid var(--color-yellow); box-shadow: 0 6px 12px rgba(0,0,0,0.06); font-size: 2.8rem; font-weight: 900; color: var(--color-purple); padding: 5px; transition: all 0.2s ease;">
                    A
                </div>
            </div>
            
            <button onclick="speakInstruction()" class="btn-3d btn-yellow" style="padding: 8px 16px; font-size: 1rem; display: flex; align-items: center; gap: 6px; border-radius: 14px; margin: 0;">
                📢 Hear Voice
            </button>
        </div>
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
            <!-- Option balloons will be rendered here -->
        </div>
    </div>
</div>

<script>
    const gameArea = document.getElementById('gameArea');
    const startScreen = document.getElementById('startScreen');
    const balloonGrid = document.getElementById('balloonGrid');
    const levelDisplay = document.getElementById('levelDisplay');
    const targetBadge = document.getElementById('targetBadge');
    const instructionLabel = document.getElementById('instructionLabel');
    const gameModeSelect = document.getElementById('gameModeSelect');
    const voiceLangSelect = document.getElementById('voiceLangSelect');
    const balloonCountSelect = document.getElementById('balloonCountSelect');

    let level = 1;
    let starsEarned = 0;
    let isPlaying = false;
    let targetValue = ''; 
    let targetColorObj = null; 
    let activeMode = 'letters'; 
    let voiceLang = 'en'; 
    let balloonCount = 3; 
    let wiggleTimeout = null;

    const balloonColors = [
        '#FF5252', '#FF4081', '#E040FB', '#7C4DFF', '#536DFE', '#448AFF', '#40C4FF', '#FFB300', '#4CAF50', '#00E676', '#81C784', '#D4E157', '#FFD54F', '#FF9100', '#FF3D00'
    ];

    const colorsData = [
        { name: 'Red', hindi: 'लाल', val: '#FF5252', emoji: '🔴' },
        { name: 'Blue', hindi: 'नीला', val: '#38B6FF', emoji: '🔵' },
        { name: 'Green', hindi: 'हरा', val: '#7ED957', emoji: '🟢' },
        { name: 'Yellow', hindi: 'पीला', val: '#FFDE59', emoji: '🟡' },
        { name: 'Orange', hindi: 'नारंगी', val: '#FF914D', emoji: '🟠' },
        { name: 'Purple', hindi: 'बैंगनी', val: '#8C52FF', emoji: '🟣' },
        { name: 'Pink', hindi: 'गुलाबी', val: '#FF66C4', emoji: '🌸' }
    ];

    // Load preferences
    if (localStorage.getItem('balloon_game_mode')) {
        activeMode = localStorage.getItem('balloon_game_mode');
        gameModeSelect.value = activeMode;
    }
    if (localStorage.getItem('balloon_voice_lang')) {
        voiceLang = localStorage.getItem('balloon_voice_lang');
        voiceLangSelect.value = voiceLang;
    }
    if (localStorage.getItem('balloon_count')) {
        balloonCount = parseInt(localStorage.getItem('balloon_count'));
        balloonCountSelect.value = balloonCount;
    }

    function updateGridColumns() {
        if (balloonCount === 3) {
            balloonGrid.style.gridTemplateColumns = 'repeat(3, auto)';
        } else {
            balloonGrid.style.gridTemplateColumns = 'repeat(2, auto)';
        }
    }

    function changeMode() {
        activeMode = gameModeSelect.value;
        localStorage.setItem('balloon_game_mode', activeMode);
        if (isPlaying) {
            loadNextLevel();
        }
    }

    function changeVoiceLang() {
        voiceLang = voiceLangSelect.value;
        localStorage.setItem('balloon_voice_lang', voiceLang);
        if (isPlaying) {
            speakInstruction();
        }
    }

    function changeBalloonCount() {
        balloonCount = parseInt(balloonCountSelect.value);
        localStorage.setItem('balloon_count', balloonCount);
        updateGridColumns();
        if (isPlaying) {
            loadNextLevel();
        }
    }

    function startGame() {
        startScreen.style.display = 'none';
        balloonGrid.style.display = 'grid';
        isPlaying = true;
        level = 1;
        starsEarned = 0;
        
        levelDisplay.innerText = level;
        
        updateGridColumns();
        loadNextLevel();
    }

    function loadNextLevel() {
        if (!isPlaying) return;

        clearTimeout(wiggleTimeout);
        const activeBalloons = document.querySelectorAll('.static-balloon');
        activeBalloons.forEach(b => b.classList.remove('wiggle-hint'));

        targetBadge.style.backgroundColor = 'white';
        targetBadge.style.color = 'var(--color-purple)';
        targetBadge.style.border = '4px solid var(--color-yellow)';
        targetBadge.style.outline = 'none';

        let options = [];

        if (activeMode === 'letters') {
            instructionLabel.innerText = voiceLang === 'hi' ? "गुब्बारा ढूँढो:" : "Find balloon:";
            const alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            targetValue = alphabet[Math.floor(Math.random() * alphabet.length)];
            targetColorObj = null;

            targetBadge.innerText = targetValue;

            options = [targetValue];
            while (options.length < balloonCount) {
                const randomLetter = alphabet[Math.floor(Math.random() * alphabet.length)];
                if (!options.includes(randomLetter)) {
                    options.push(randomLetter);
                }
            }
        } 
        else if (activeMode === 'numbers') {
            instructionLabel.innerText = voiceLang === 'hi' ? "गुब्बारा ढूँढो:" : "Find balloon:";
            targetValue = String(Math.floor(Math.random() * 10) + 1); 
            targetColorObj = null;

            targetBadge.innerText = targetValue;

            options = [targetValue];
            while (options.length < balloonCount) {
                const randomNumber = String(Math.floor(Math.random() * 10) + 1);
                if (!options.includes(randomNumber)) {
                    options.push(randomNumber);
                }
            }
        } 
        else if (activeMode === 'colors') {
            instructionLabel.innerText = voiceLang === 'hi' ? "रंग ढूँढो:" : "Find color:";
            
            targetColorObj = colorsData[Math.floor(Math.random() * colorsData.length)];
            targetValue = targetColorObj.name;

            targetBadge.style.backgroundColor = targetColorObj.val;
            targetBadge.style.border = '4px solid #ffffff';
            targetBadge.style.outline = '3px solid var(--color-purple)';
            targetBadge.style.color = '#ffffff';
            targetBadge.innerText = targetColorObj.emoji;

            options = [targetColorObj];
            while (options.length < balloonCount) {
                const randomColor = colorsData[Math.floor(Math.random() * colorsData.length)];
                if (!options.some(c => c.name === randomColor.name)) {
                    options.push(randomColor);
                }
            }
        }

        options.sort(() => Math.random() - 0.5);

        balloonGrid.innerHTML = '';
        
        const shuffledColors = [...balloonColors].sort(() => Math.random() - 0.5);

        options.forEach((item, idx) => {
            const balloon = document.createElement('div');
            balloon.className = 'static-balloon';
            
            let labelText = '';
            let valToCheck = '';

            if (activeMode === 'colors') {
                balloon.style.backgroundColor = item.val;
                labelText = voiceLang === 'hi' ? item.hindi : item.name;
                valToCheck = item.name;
            } else {
                balloon.style.backgroundColor = shuffledColors[idx];
                labelText = item;
                valToCheck = item;
            }

            balloon.dataset.val = valToCheck;

            const labelSpan = document.createElement('span');
            labelSpan.className = 'balloon-label';
            labelSpan.innerText = labelText;
            balloon.appendChild(labelSpan);

            const string = document.createElement('div');
            string.className = 'static-string';
            balloon.appendChild(string);

            balloon.onclick = (e) => handleChoice(balloon, valToCheck, e.clientX, e.clientY);
            balloon.ontouchstart = (e) => {
                const touch = e.touches[0];
                handleChoice(balloon, valToCheck, touch.clientX, touch.clientY);
                e.preventDefault();
            };

            balloonGrid.appendChild(balloon);
        });

        speakInstruction();
        startWiggleTimer();
    }

    function startWiggleTimer() {
        clearTimeout(wiggleTimeout);
        wiggleTimeout = setTimeout(() => {
            if (!isPlaying) return;
            
            const balloons = document.querySelectorAll('.static-balloon');
            balloons.forEach(balloon => {
                if (balloon.dataset.val === targetValue) {
                    balloon.classList.add('wiggle-hint');
                }
            });

            speakInstruction(true);
        }, 4000);
    }

    function speakInstruction(isReminder = false) {
        if (localStorage.getItem('voice_enabled') === 'false') return;

        let phrase = '';
        if (activeMode === 'letters') {
            if (voiceLang === 'hi') {
                phrase = (isReminder ? "अरे! " : "") + "गुब्बारा " + targetValue + " कहाँ है? उसे छुओ!";
            } else {
                phrase = (isReminder ? "Hey! " : "") + "Where is balloon " + targetValue + "? Touch it!";
            }
        } 
        else if (activeMode === 'numbers') {
            if (voiceLang === 'hi') {
                phrase = (isReminder ? "जल्दी से! " : "") + "नंबर " + targetValue + " वाला गुब्बारा ढूँढो!";
            } else {
                phrase = (isReminder ? "Come on! " : "") + "Find number " + targetValue + " balloon!";
            }
        } 
        else if (activeMode === 'colors') {
            const colorName = voiceLang === 'hi' ? targetColorObj.hindi : targetColorObj.name;
            if (voiceLang === 'hi') {
                phrase = (isReminder ? "देखो! " : "") + colorName + " गुब्बारा छुओ!";
            } else {
                phrase = (isReminder ? "Look! " : "") + "Touch the " + colorName + " balloon!";
            }
        }

        SoundFX.speak(phrase, voiceLang === 'hi' ? 'hi-IN' : 'en-US');
    }

    function createPopParticles(x, y, color) {
        const particleCount = 12;
        const emojis = ['✨', '🎉', '🥳', '🌟', '🌈', '❤️', '🧁', '🍦'];
        
        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.className = 'pop-particle';
            
            const isEmoji = Math.random() > 0.45;
            if (isEmoji) {
                particle.innerText = emojis[Math.floor(Math.random() * emojis.length)];
                particle.style.fontSize = (Math.random() * 1.4 + 1.2) + 'rem';
            } else {
                particle.style.backgroundColor = color || '#FF5252';
                particle.style.width = (Math.random() * 14 + 8) + 'px';
                particle.style.height = particle.style.width;
                particle.style.borderRadius = '50%';
                particle.style.boxShadow = '0 2px 6px rgba(0,0,0,0.15)';
            }
            
            particle.style.position = 'absolute';
            particle.style.left = x + 'px';
            particle.style.top = y + 'px';
            particle.style.pointerEvents = 'none';
            particle.style.zIndex = '999';
            
            const angle = Math.random() * Math.PI * 2;
            const distance = Math.random() * 160 + 80;
            const tx = Math.cos(angle) * distance;
            const ty = Math.sin(angle) * distance - 40; 
            
            particle.style.setProperty('--tx', tx + 'px');
            particle.style.setProperty('--ty', ty + 'px');
            particle.style.animation = 'particleAnimation 0.8s cubic-bezier(0.1, 0.8, 0.3, 1) forwards';
            
            gameArea.appendChild(particle);
            
            setTimeout(() => {
                particle.remove();
            }, 800);
        }
    }

    function handleChoice(balloonElement, valueSelected, clickX, clickY) {
        if (!isPlaying) return;
        if (balloonElement.classList.contains('wrong-shake') || balloonElement.style.opacity === '0') return;

        clearTimeout(wiggleTimeout);

        if (valueSelected === targetValue) {
            SoundFX.play('pop');
            
            const rect = balloonElement.getBoundingClientRect();
            const areaRect = gameArea.getBoundingClientRect();
            const posX = (clickX || rect.left + rect.width / 2) - areaRect.left;
            const posY = (clickY || rect.top + rect.height / 2) - areaRect.top;
            
            createPopParticles(posX, posY, balloonElement.style.backgroundColor);

            if (localStorage.getItem('voice_enabled') !== 'false') {
                const successPhrasesEn = ["Awesome!", "Great job!", "Super!", "Yay! You did it!", "Fantastic!"];
                const successPhrasesHi = ["बहुत अच्छे!", "अरे वाह!", "शाबाश!", "कमाल कर दिया!", "बिल्कुल सही!"];
                const list = voiceLang === 'hi' ? successPhrasesHi : successPhrasesEn;
                const phrase = list[Math.floor(Math.random() * list.length)];
                SoundFX.speak(phrase, voiceLang === 'hi' ? 'hi-IN' : 'en-US');
            }

            balloonElement.style.transform = 'scale(1.35)';
            balloonElement.style.opacity = '0';

            level++;
            starsEarned += 5; 
            levelDisplay.innerText = level;

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

            setTimeout(() => {
                loadNextLevel();
            }, 750);

        } else {
            balloonElement.classList.add('wrong-shake');
            SoundFX.play('click');

            if (localStorage.getItem('voice_enabled') !== 'false') {
                const tryAgainPhrase = voiceLang === 'hi' ? "ओह! फिर से कोशिश करो।" : "Oops! Try again.";
                SoundFX.speak(tryAgainPhrase, voiceLang === 'hi' ? 'hi-IN' : 'en-US');
            }

            setTimeout(() => {
                balloonElement.classList.remove('wrong-shake');
                startWiggleTimer();
            }, 500);
        }
    }

    window.addEventListener('beforeunload', () => {
        isPlaying = false;
        clearTimeout(wiggleTimeout);
    });
</script>
@endsection