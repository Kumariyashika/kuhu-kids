@extends('layouts.app')

@section('title', 'Kuhu Kids Learning - Phonics Sounds')

@section('content')
    <div class="inner-container">
        <div class="inner-header">
            <h1 class="inner-title">
                <span style="color: var(--color-orange);">📢 Phonics Sounds</span>
            </h1>
            <a href="{{ route('dashboard') }}" class="btn-3d btn-yellow">&lt; Back to Home</a>
        </div>

        <div
            style="background: #FFFDF0; padding: 20px; border-radius: 20px; border: 3px solid #E2E8F0; text-align: center; margin-bottom: 24px; display: flex; flex-direction: column; align-items: center; gap: 12px;">
            <h2 id="instructionHeader" style="color: var(--color-orange); font-size: 1.5rem; font-weight: 800; margin: 0;">
                Press any letter card to hear how it sounds! 🔊</h2>
            <button onclick="toggleAutoplay()" id="autoplayBtn" class="btn-3d"
                style="background-color: var(--color-green-real); color: white; border-bottom: 5px solid var(--color-green-real-shadow); font-size: 1.1rem; padding: 8px 24px; transition: all 0.15s ease;">
                ▶️ Autoplay
            </button>
        </div>

        <!-- Category Tabs for Phonics -->
        <div class="category-tabs"
            style="display: flex; gap: 12px; margin-bottom: 24px; justify-content: center; flex-wrap: wrap;">
            <button onclick="changeCategory('english_letters')" id="tab-english_letters"
                class="btn-3d btn-pink category-tab-btn" style="min-width: 140px; padding: 10px 16px; font-size: 0.95rem;">
                🔤 Letters (A-Z)
            </button>
            <button onclick="changeCategory('hindi_letters')" id="tab-hindi_letters"
                class="btn-3d btn-yellow category-tab-btn"
                style="min-width: 140px; padding: 10px 16px; font-size: 0.95rem;">
                🕉️ Hindi (क-ज्ञ)
            </button>
            <button onclick="changeCategory('numbers')" id="tab-numbers" class="btn-3d btn-yellow category-tab-btn"
                style="min-width: 140px; padding: 10px 16px; font-size: 0.95rem;">
                🔢 Numbers (1-50)
            </button>
            <button onclick="changeCategory('english_words')" id="tab-english_words"
                class="btn-3d btn-yellow category-tab-btn"
                style="min-width: 140px; padding: 10px 16px; font-size: 0.95rem;">
                🍎 Words (A-Z)
            </button>
            <button onclick="changeCategory('number_words')" id="tab-number_words"
                class="btn-3d btn-yellow category-tab-btn"
                style="min-width: 140px; padding: 10px 16px; font-size: 0.95rem;">
                🔢 Number Words (1-20)
            </button>
            <button onclick="changeCategory('hindi_words')" id="tab-hindi_words" class="btn-3d btn-yellow category-tab-btn"
                style="min-width: 140px; padding: 10px 16px; font-size: 0.95rem;">
                🕊️ Hindi Words (क-ज्ञ)
            </button>
        </div>

        <!-- Phonics Letter Cards Grid -->
        <div class="phonics-grid" id="phonicsGrid">
            <!-- Dynamically populated in JavaScript for premium performance -->
        </div>
    </div>

    <script>
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
            { letter: 'ल', display: 'ल', phrase: 'ल', lang: 'hi-IN' },
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
            { letter: 'द', word: 'दवात ✒️', phrase: 'द से दवात', lang: 'hi-IN' },
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
            { letter: 'ज्ञ', word: 'ज्ञानी 👨–🏫', phrase: 'ज्ञ से ज्ञानी', lang: 'hi-IN' }
        ];

        const colors = [
            '#FF5757', '#FF914D', '#7ED957', '#38B6FF', '#FF66C4', '#00C2CB', '#8C52FF'
        ];

        let currentCategory = 'english_letters';
        let autoplayActive = false;
        let autoplayIndex = 0;

        function changeCategory(cat) {
            if (autoplayActive) {
                stopAutoplay();
            }
            currentCategory = cat;

            // Update instruction header
            const instr = document.getElementById('instructionHeader');
            if (instr) {
                if (cat === 'english_letters' || cat === 'hindi_letters') {
                    instr.innerText = "Press any letter card to hear how it sounds! 🔊";
                } else if (cat === 'numbers' || cat === 'number_words') {
                    instr.innerText = "Press any card to hear the number! 🔊";
                } else {
                    instr.innerText = "Press any card to learn the word! 🔊";
                }
            }

            // Update tab styles
            const tabs = ['english_letters', 'hindi_letters', 'numbers', 'english_words', 'number_words', 'hindi_words'];
            tabs.forEach(t => {
                const btn = document.getElementById('tab-' + t);
                if (!btn) return;
                if (t === cat) {
                    btn.className = "btn-3d btn-pink category-tab-btn";
                    btn.style.backgroundColor = "var(--color-purple)";
                    btn.style.borderBottomColor = "var(--color-purple-shadow)";
                    btn.style.color = "#FFF";
                } else {
                    btn.className = "btn-3d btn-yellow category-tab-btn";
                    btn.style.backgroundColor = "var(--color-yellow)";
                    btn.style.borderBottomColor = "var(--color-yellow-shadow)";
                    btn.style.color = "#4A3B00";
                }
            });

            // Load correct data
            let activeData = [];
            if (cat === 'english_letters') activeData = englishLetters;
            else if (cat === 'hindi_letters') activeData = hindiLetters;
            else if (cat === 'numbers') activeData = numbersData;
            else if (cat === 'english_words') activeData = englishWords;
            else if (cat === 'number_words') activeData = numberWords;
            else if (cat === 'hindi_words') activeData = hindiWords;

            // Populate grid
            const grid = document.getElementById('phonicsGrid');
            grid.innerHTML = '';

            activeData.forEach((item, index) => {
                const color = colors[index % colors.length];
                const card = document.createElement('div');
                card.className = 'phonic-card';
                card.style.borderColor = color;
                card.onclick = () => playPhonic(item, card);

                if (cat === 'english_letters') {
                    card.innerHTML = `
                        <span class="phonic-letter" style="color: ${color}; font-size: 3.8rem; line-height: 1;">${item.display}</span>
                    `;
                } else if (cat === 'hindi_letters') {
                    card.innerHTML = `
                        <span class="phonic-letter" style="color: ${color}; font-size: 3.8rem; line-height: 1;">${item.display}</span>
                    `;
                } else if (cat === 'numbers') {
                    card.innerHTML = `
                        <span class="phonic-letter" style="color: ${color}; font-size: 3.8rem; line-height: 1;">${item.display}</span>
                    `;
                } else if (cat === 'english_words') {
                    card.innerHTML = `
                        <span class="phonic-letter" style="color: ${color}; font-size: 2.2rem; margin-bottom: 8px;">${item.letter}</span>
                        <span class="phonic-word" style="font-size: 1.25rem;">${item.word}</span>
                    `;
                } else if (cat === 'number_words') {
                    card.innerHTML = `
                        <span class="phonic-letter" style="color: ${color}; font-size: 2.4rem; margin-bottom: 8px;">${item.letter}</span>
                        <span class="phonic-word" style="font-size: 1.3rem;">${item.word}</span>
                    `;
                } else if (cat === 'hindi_words') {
                    card.innerHTML = `
                        <span class="phonic-letter" style="color: ${color}; font-size: 2.4rem; margin-bottom: 6px; line-height: 1.1;">${item.letter}</span>
                        <span class="phonic-word" style="font-size: 1.2rem;">${item.word}</span>
                    `;
                }
                grid.appendChild(card);
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            changeCategory('english_letters');
        });

        function playPhonic(item, element) {
            // Add subtle scale animation when playing
            element.style.transform = 'scale(0.95)';
            setTimeout(() => {
                element.style.transform = 'none';
            }, 150);

            SoundFX.play('click');

            if (localStorage.getItem('voice_enabled') !== 'false') {
                SoundFX.speak(item.phrase, item.lang || 'en-US');
            }

            // Award stars for learning
            fetch("{{ route('api.add_stars') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    stars: 1,
                    activity_name: 'Phonics ' + currentCategory + ' ' + (item.letter || item.display)
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

        // --- Autoplay Features ---

        function toggleAutoplay() {
            if (autoplayActive) {
                stopAutoplay();
            } else {
                startAutoplay();
            }
        }

        function startAutoplay() {
            autoplayActive = true;
            autoplayIndex = 0;

            const btn = document.getElementById('autoplayBtn');
            if (btn) {
                btn.innerHTML = "⏹️ Stop Autoplay";
                btn.style.backgroundColor = "var(--color-pink)";
                btn.style.borderBottomColor = "var(--color-pink-shadow)";
            }

            playNextAutoplayCard();
        }

        function stopAutoplay() {
            autoplayActive = false;
            window.speechSynthesis.cancel();

            // Clear all highlight transformations
            document.querySelectorAll('.phonic-card').forEach(card => {
                card.style.transform = 'none';
                card.style.boxShadow = 'none';
            });

            const btn = document.getElementById('autoplayBtn');
            if (btn) {
                btn.innerHTML = "▶️ Autoplay";
                btn.style.backgroundColor = "var(--color-green-real)";
                btn.style.borderBottomColor = "var(--color-green-real-shadow)";
                btn.style.color = "#FFF";
            }
        }

        function playNextAutoplayCard() {
            if (!autoplayActive) return;

            const cards = document.querySelectorAll('.phonic-card');
            if (cards.length === 0) {
                stopAutoplay();
                return;
            }

            if (autoplayIndex >= cards.length) {
                stopAutoplay();
                return;
            }

            // Highlight active card, reset others
            cards.forEach((card, idx) => {
                if (idx === autoplayIndex) {
                    card.style.transform = 'scale(1.08)';
                    card.style.boxShadow = '0 0 20px rgba(140, 82, 255, 0.4)';
                    card.scrollIntoView({ behavior: 'smooth', block: 'center' });
                } else {
                    card.style.transform = 'none';
                    card.style.boxShadow = 'none';
                }
            });

            // Load correct data
            let activeData = [];
            if (currentCategory === 'english_letters') activeData = englishLetters;
            else if (currentCategory === 'hindi_letters') activeData = hindiLetters;
            else if (currentCategory === 'numbers') activeData = numbersData;
            else if (currentCategory === 'english_words') activeData = englishWords;
            else if (currentCategory === 'number_words') activeData = numberWords;
            else if (currentCategory === 'hindi_words') activeData = hindiWords;

            const item = activeData[autoplayIndex];
            if (!item) {
                stopAutoplay();
                return;
            }

            SoundFX.play('click');

            if (localStorage.getItem('voice_enabled') !== 'false') {
                speakAutoplay(item.phrase, item.lang || 'en-US', () => {
                    setTimeout(() => {
                        if (autoplayActive) {
                            autoplayIndex++;
                            playNextAutoplayCard();
                        }
                    }, 1200);
                });
            } else {
                setTimeout(() => {
                    if (autoplayActive) {
                        autoplayIndex++;
                        playNextAutoplayCard();
                    }
                }, 2500);
            }
        }

        function speakAutoplay(text, lang, callback) {
            if ('speechSynthesis' in window) {
                window.speechSynthesis.cancel();
                const utterance = new SpeechSynthesisUtterance(text);
                utterance.lang = lang;
                utterance.rate = 0.85;
                utterance.pitch = 1.3;
                utterance.onend = () => {
                    if (callback) callback();
                };
                utterance.onerror = () => {
                    if (callback) callback();
                };
                window.speechSynthesis.speak(utterance);
            } else {
                setTimeout(callback, 2000);
            }
        }
    </script>
@endsection