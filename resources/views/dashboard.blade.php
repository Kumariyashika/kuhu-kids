@extends('layouts.app')

@section('title', 'Kuhu Kids Learning - Home')

@section('content')
    <!-- Top Header Navigation -->
    <header class="top-header">
        <!-- Profile Card -->
        <div class="profile-pill">
            <div class="profile-avatar" style="position: relative; overflow: visible;">
                {!! $activeChild->avatar->svg_markup !!}
                @if($activeChild->current_outfit === 'crown')
                    <div class="avatar-accessory accessory-crown"
                        style="position: absolute; top: -14px; left: 50%; transform: translateX(-50%); width: 34px; height: 25px; z-index: 10; pointer-events: none;">
                        <svg viewBox="0 0 100 70" width="100%" height="100%">
                            <polygon points="10,60 20,20 40,45 50,15 60,45 80,20 90,60" fill="#FFDE59" stroke="#E6A100"
                                stroke-width="4" stroke-linejoin="round" />
                            <circle cx="20" cy="20" r="5" fill="#FF5252" />
                            <circle cx="50" cy="15" r="5" fill="#38B6FF" />
                            <circle cx="80" cy="20" r="5" fill="#FF5252" />
                            <rect x="15" y="55" width="70" height="8" rx="2" fill="#E6A100" />
                        </svg>
                    </div>
                @elseif($activeChild->current_outfit === 'glasses')
                    <div class="avatar-accessory accessory-glasses"
                        style="position: absolute; top: 12px; left: 50%; transform: translateX(-50%); width: 40px; height: 18px; z-index: 10; pointer-events: none;">
                        <svg viewBox="0 0 100 40" width="100%" height="100%">
                            <polygon points="20,5 25,18 38,18 28,26 31,38 20,30 9,38 12,26 2,18 15,18"
                                fill="rgba(255, 102, 196, 0.9)" stroke="#D94B9F" stroke-width="3" />
                            <polygon points="80,5 85,18 98,18 88,26 91,38 80,30 69,38 72,26 62,18 75,18"
                                fill="rgba(255, 102, 196, 0.9)" stroke="#D94B9F" stroke-width="3" />
                            <path d="M 38 22 Q 50 12 62 22" fill="none" stroke="#D94B9F" stroke-width="4" />
                        </svg>
                    </div>
                @elseif($activeChild->current_outfit === 'superhero')
                    <div class="avatar-accessory accessory-superhero"
                        style="position: absolute; bottom: 0px; left: 50%; transform: translateX(-50%); width: 44px; height: 16px; z-index: 10; pointer-events: none;">
                        <svg viewBox="0 0 100 30" width="100%" height="100%">
                            <path d="M 10 5 L 30 25 L 50 10 L 70 25 L 90 5" fill="none" stroke="#FF5252" stroke-width="5"
                                stroke-linecap="round" />
                            <rect x="35" y="2" width="30" height="12" rx="4" fill="#FF5252" stroke="#C62828" stroke-width="1" />
                        </svg>
                    </div>
                @endif
            </div>
            <div class="profile-info">
                <span class="profile-greet">Hello,</span>
                <span class="profile-name">{{ $activeChild->name }}</span>
            </div>
        </div>

        <!-- Center KUHU Clouds Logo -->
        <div class="logo-cloud-wrapper">
            <h1 class="logo-title-3d">
                <span class="logo-letter logo-letter-a">K</span>
                <span class="logo-letter logo-letter-b">U</span>
                <span class="logo-letter logo-letter-c">H</span>
                <span class="logo-letter logo-letter-d">U</span>
            </h1>
            <div class="logo-ribbon">Kids Learning</div>
        </div>

        <!-- Stars Counter & Settings -->
        <div class="header-actions">

            <a href="{{ route('settings') }}" class="btn-3d btn-yellow">
                <!-- Gear SVG Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="3" />
                    <path
                        d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z" />
                </svg>
                <span>Settings</span>
            </a>
        </div>
    </header>

    <!-- 8 Learning Modules Grid -->
    <main class="modules-grid">
        <!-- 1. Alphabet Tracing -->
        <a href="{{ route('learning.tracing') }}" class="module-card module-card-purple">
            <div class="card-icon-container">
                <!-- SVG Letter Tracing A with Hand Outline -->
                <svg viewBox="0 0 100 100" width="90" height="90">
                    <text x="35" y="80" font-family="'Fredoka', sans-serif" font-size="80" font-weight="900" fill="none"
                        stroke="#FFFFFF" stroke-width="4" stroke-dasharray="4,4">A</text>
                    <!-- Hand Icon Tracing -->
                    <g transform="translate(42, 45) scale(0.6)">
                        <path
                            d="M30 45 C30 40 25 35 20 35 C15 35 15 45 15 45 C15 45 12 30 5 30 C-2 30 -2 45 -2 45 C-2 45 -5 28 -12 28 C-19 28 -19 45 -19 45 L-19 55 C-19 65 -10 75 0 75 L15 75 C25 75 30 65 30 55 Z"
                            fill="#FFE0B2" stroke="#E65100" stroke-width="3" />
                        <rect x="-35" y="40" width="18" height="35" rx="3" fill="#FFE0B2" stroke="#E65100" stroke-width="3"
                            transform="rotate(-30)" />
                    </g>
                    <!-- Sparkle Stars -->
                    <polygon points="12,12 15,18 22,18 17,22 19,28 12,24 5,28 7,22 2,18 9,18" fill="#FFDE59" />
                    <polygon points="85,60 87,63 90,63 88,65 89,68 85,66 81,68 82,65 80,63 83,63" fill="#FFDE59" />
                </svg>
            </div>
            <h2 class="card-title">Write Letters ✏️</h2>
            <span class="card-subtitle">Trace A-Z with your finger!</span>
        </a>

        <!-- 2. Phonics Sounds -->
        <a href="{{ route('learning.phonics') }}" class="module-card module-card-orange">
            <div class="card-icon-container">
                <!-- Megaphone with music notes -->
                <svg viewBox="0 0 100 100" width="90" height="90">
                    <g transform="translate(10, 10)">
                        <!-- Megaphone body -->
                        <path d="M15 30 L45 15 L45 65 L15 50 Z" fill="#29B6F6" stroke="#0288D1" stroke-width="3" />
                        <path d="M45 15 C52 15, 52 65, 45 65" fill="#B3E5FC" stroke="#0288D1" stroke-width="3" />
                        <rect x="5" y="32" width="12" height="16" rx="4" fill="#B0BEC5" stroke="#37474F" stroke-width="3" />
                        <!-- Music Notes -->
                        <path
                            d="M60 25 C60 15, 75 10, 75 10 L75 25 M60 25 C55 25, 50 30, 50 35 C50 40, 55 45, 60 45 C65 45, 65 35, 65 25 M75 20 C70 20, 68 25, 68 30 C68 35, 73 40, 78 40 C83 40, 83 30, 83 20"
                            fill="none" stroke="#FF5252" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                    </g>
                </svg>
            </div>
            <h2 class="card-title">A for Apple 🔊</h2>
            <span class="card-subtitle">Hear and say letters!</span>
        </a>

        <!-- 3. Balloon Pop -->
        <a href="{{ route('learning.balloon_pop') }}" class="module-card module-card-green">
            <div class="card-icon-container">
                <!-- Group of Balloons A, B, C -->
                <svg viewBox="0 0 100 100" width="90" height="90">
                    <!-- Balloon C -->
                    <g transform="translate(62, 35)">
                        <ellipse cx="0" cy="0" rx="14" ry="18" fill="#29B6F6" />
                        <text x="-7" y="7" fill="white" font-weight="bold" font-size="16">C</text>
                    </g>
                    <!-- Balloon B -->
                    <g transform="translate(18, 38)">
                        <ellipse cx="0" cy="0" rx="14" ry="18" fill="#AB47BC" />
                        <text x="-6" y="7" fill="white" font-weight="bold" font-size="16">B</text>
                    </g>
                    <!-- Balloon A (Center) -->
                    <g transform="translate(42, 22)">
                        <ellipse cx="0" cy="0" rx="18" ry="22" fill="#FF5252" />
                        <text x="-7" y="8" fill="white" font-weight="bold" font-size="20">A</text>
                    </g>
                </svg>
            </div>
            <h2 class="card-title">Pop Balloons! 🎈</h2>
            <span class="card-subtitle">Tap and pop letters!</span>
        </a>

        <!-- 4. Letter Match -->
        <a href="{{ route('learning.letter_match') }}" class="module-card module-card-blue">
            <div class="card-icon-container">
                <!-- Two Puzzle Pieces A and B -->
                <svg viewBox="0 0 100 100" width="90" height="90">
                    <!-- Left Piece (Yellow A) -->
                    <g transform="translate(15, 20)">
                        <path d="M0 0 L25 0 Q30 -8 38 0 L50 0 L50 15 Q58 20 50 28 L50 40 L0 40 Z" fill="#FFCA28"
                            stroke="#F57F17" stroke-width="2" />
                        <text x="15" y="28" font-size="24" font-weight="bold" fill="#F57F17">A</text>
                    </g>
                    <!-- Right Piece (Pink B) -->
                    <g transform="translate(45, 28)">
                        <path d="M0 0 L25 0 L25 35 L0 35 L0 25 Q-8 20 0 15 Z" fill="#EC407A" stroke="#C2185B"
                            stroke-width="2" />
                        <text x="8" y="25" font-size="22" font-weight="bold" fill="white">B</text>
                    </g>
                </svg>
            </div>
            <h2 class="card-title">Match Same Letters 🧩</h2>
            <span class="card-subtitle">Put matching letters together!</span>
        </a>

        <!-- 5. English Rhymes -->
        <a href="{{ route('learning.english_rhymes') }}" class="module-card module-card-pink">
            <div class="card-icon-container">
                <!-- Trophy Graphic (from English Rhymes icon) -->
                <svg viewBox="0 0 100 100" width="90" height="90">
                    <g transform="translate(20, 10)">
                        <!-- Gold Cup -->
                        <path d="M10 10 L50 10 L45 45 C40 55, 20 55, 15 45 Z" fill="#FFDE59" stroke="#E6A100"
                            stroke-width="3" />
                        <rect x="25" y="52" width="10" height="15" fill="#E6A100" />
                        <ellipse cx="30" cy="68" rx="20" ry="6" fill="#FFDE59" stroke="#E6A100" stroke-width="3" />
                        <!-- Handles -->
                        <path d="M10 20 C0 20, 0 35, 12 35" fill="none" stroke="#FFDE59" stroke-width="4"
                            stroke-linecap="round" />
                        <path d="M50 20 C60 20, 60 35, 48 35" fill="none" stroke="#FFDE59" stroke-width="4"
                            stroke-linecap="round" />
                        <!-- Star on Trophy -->
                        <polygon points="30,22 33,28 39,28 34,31 36,36 30,33 24,36 26,31 21,28 27,28" fill="#FF914D" />
                    </g>
                </svg>
            </div>
            <h2 class="card-title">English Songs 🎶</h2>
            <span class="card-subtitle">Sing and dance along!</span>
        </a>

        <!-- 6. Hindi Rhymes -->
        <a href="{{ route('learning.hindi_rhymes') }}" class="module-card module-card-teal">
            <div class="card-icon-container">
                <!-- Devanagari Letters क ख ग -->
                <svg viewBox="0 0 100 100" width="90" height="90">
                    <text x="10" y="45" font-family="'Fredoka', sans-serif" font-size="34" font-weight="bold" fill="#FFE5A3"
                        stroke="#D18700" stroke-width="1.5">क</text>
                    <text x="50" y="50" font-family="'Fredoka', sans-serif" font-size="34" font-weight="bold" fill="#FFC9F3"
                        stroke="#A82885" stroke-width="1.5">ख</text>
                    <text x="30" y="85" font-family="'Fredoka', sans-serif" font-size="36" font-weight="bold" fill="#C3FFD8"
                        stroke="#12702F" stroke-width="1.5">ग</text>
                    <!-- Music Note -->
                    <circle cx="82" cy="30" r="5" fill="#FFF" />
                    <line x1="87" y1="15" x2="87" y2="30" stroke="#FFF" stroke-width="3" />
                    <polygon points="87,15 95,18 95,22 87,19" fill="#FFF" />
                </svg>
            </div>
            <h2 class="card-title">Hindi Songs 🎤</h2>
            <span class="card-subtitle">मजेदार बाल कविताएँ सुनो!</span>
        </a>


        <!-- 7. Devotional Learning -->
        <a href="{{ route('learning.devotional') }}" class="module-card module-card-dark-purple">
            <div class="card-icon-container">
                <!-- Cute Krishna silhouette/graphics -->
                <svg viewBox="0 0 100 100" width="90" height="90">
                    <g transform="translate(15, 10)">
                        <!-- Face -->
                        <circle cx="35" cy="45" r="22" fill="#A0E0FF" stroke="#0088CC" stroke-width="2" />
                        <!-- Peacock Feather -->
                        <path d="M 35 23 Q 48 10 52 2 M 35 23 Q 22 10 35 23" fill="none" stroke="#228B22"
                            stroke-width="2" />
                        <ellipse cx="44" cy="12" rx="6" ry="10" fill="#008080" transform="rotate(30, 44, 12)" />
                        <circle cx="44" cy="12" r="3" fill="#FF8C00" />
                        <!-- Flute -->
                        <rect x="15" y="48" width="50" height="6" rx="2" fill="#D2B48C" stroke="#8B4513" stroke-width="1.5"
                            transform="rotate(-15, 35, 50)" />
                        <circle cx="20" cy="46" r="1.5" fill="#FF2E2E" />
                        <circle cx="25" cy="45" r="1.5" fill="#FF2E2E" />
                        <!-- Eyes & Smile -->
                        <circle cx="28" cy="42" r="2" fill="#222" />
                        <circle cx="42" cy="42" r="2" fill="#222" />
                        <path d="M 31 52 Q 35 56 39 52" stroke="#222" stroke-width="1.5" stroke-linecap="round"
                            fill="none" />
                    </g>
                </svg>
            </div>
            <h2 class="card-title">God Stories & Prayers 🙏</h2>
            <span class="card-subtitle">Hear sweet prayers and mantras</span>
        </a>



        <!-- 9. Number Counting -->
        <a href="{{ route('learning.numbers') }}" class="module-card module-card-green">
            <div class="card-icon-container">
                <svg viewBox="0 0 100 100" width="90" height="90">
                    <text x="12" y="55" font-family="'Fredoka', sans-serif" font-size="44" font-weight="900" fill="#FFDE59"
                        stroke="#E6A100" stroke-width="2">1</text>
                    <text x="38" y="75" font-family="'Fredoka', sans-serif" font-size="48" font-weight="900" fill="#FF5252"
                        stroke="#C62828" stroke-width="2">2</text>
                    <text x="68" y="55" font-family="'Fredoka', sans-serif" font-size="44" font-weight="900" fill="#38B6FF"
                        stroke="#1B8EC7" stroke-width="2">3</text>
                </svg>
            </div>
            <h2 class="card-title">Count 1-2-3! 🔢</h2>
            <span class="card-subtitle">Learn counting numbers!</span>
        </a>

        <!-- 10. Shapes Learning -->
        <a href="{{ route('learning.shapes') }}" class="module-card module-card-orange">
            <div class="card-icon-container">
                <svg viewBox="0 0 100 100" width="90" height="90">
                    <circle cx="30" cy="40" r="16" fill="#7ED957" stroke="#63AA43" stroke-width="2" />
                    <rect x="52" y="24" width="28" height="28" rx="4" fill="#FF66C4" stroke="#D94B9F" stroke-width="2" />
                    <polygon points="50,55 25,85 75,85" fill="#FFDE59" stroke="#CCB143" stroke-width="2" />
                </svg>
            </div>
            <h2 class="card-title">Play with Shapes 🔴</h2>
            <span class="card-subtitle">Find circles, squares and stars!</span>
        </a>

        <!-- 11. Colors Pop -->
        <a href="{{ route('learning.colors') }}" class="module-card module-card-pink">
            <div class="card-icon-container">
                <svg viewBox="0 0 100 100" width="90" height="90">
                    <path
                        d="M 50 15 C 25 15 10 32 10 50 C 10 70 28 85 50 85 C 55 85 62 82 66 76 C 70 70 78 70 82 70 C 88 70 90 60 90 50 C 90 32 72 15 50 15 Z"
                        fill="#F2EBD9" stroke="#7A6F5D" stroke-width="2" />
                    <circle cx="28" cy="40" r="8" fill="#FF5252" />
                    <circle cx="42" cy="30" r="8" fill="#FFDE59" />
                    <circle cx="58" cy="30" r="8" fill="#38B6FF" />
                    <circle cx="72" cy="40" r="8" fill="#7ED957" />
                    <circle cx="70" cy="58" r="8" fill="#8C52FF" />
                    <path d="M 35 65 Q 50 72 65 65" fill="none" stroke="#7A6F5D" stroke-width="3" stroke-linecap="round" />
                </svg>
            </div>
            <h2 class="card-title">Colors Name / रंगों के नाम 🎨</h2>
            <span class="card-subtitle">Learn Red (लाल), Blue (नीला) & more!</span>
        </a>

        <!-- 12. Quiz Time -->
        <a href="{{ route('learning.quiz') }}" class="module-card module-card-purple">
            <div class="card-icon-container">
                <svg viewBox="0 0 100 100" width="90" height="90">
                    <text x="35" y="70" font-family="'Fredoka', sans-serif" font-size="64" font-weight="900" fill="#FFDE59"
                        stroke="#E6A100" stroke-width="3" transform="rotate(-5, 50, 50)">?</text>
                    <polygon points="20,20 22,25 28,25 24,28 26,34 20,30 14,34 16,28 12,25 18,25" fill="#FFF" />
                    <polygon points="80,75 82,80 88,80 84,83 86,89 80,85 74,89 76,83 72,80 78,80" fill="#FFF" />
                </svg>
            </div>
            <h2 class="card-title">Kids Quiz Game ❓</h2>
            <span class="card-subtitle">Answer questions & win stars!</span>
        </a>


    </main>


    <!-- Bottom Actions Section (Profile Switcher) -->
    <footer class="bottom-section" style="grid-template-columns: 1fr; max-width: 400px; margin: 10px auto;">
        <!-- Current Profile Switching -->
        <a href="{{ route('parent.dashboard') }}" class="bottom-pill">
            <div class="pill-left">
                <div class="parent-avatar-frame" style="border-color: #2ECC71; position: relative; overflow: visible;">
                    {!! $activeChild->avatar->svg_markup !!}
                    @if($activeChild->current_outfit === 'crown')
                        <div class="avatar-accessory accessory-crown"
                            style="position: absolute; top: -14px; left: 50%; transform: translateX(-50%); width: 34px; height: 25px; z-index: 10; pointer-events: none;">
                            <svg viewBox="0 0 100 70" width="100%" height="100%">
                                <polygon points="10,60 20,20 40,45 50,15 60,45 80,20 90,60" fill="#FFDE59" stroke="#E6A100"
                                    stroke-width="4" stroke-linejoin="round" />
                                <circle cx="20" cy="20" r="5" fill="#FF5252" />
                                <circle cx="50" cy="15" r="5" fill="#38B6FF" />
                                <circle cx="80" cy="20" r="5" fill="#FF5252" />
                                <rect x="15" y="55" width="70" height="8" rx="2" fill="#E6A100" />
                            </svg>
                        </div>
                    @elseif($activeChild->current_outfit === 'glasses')
                        <div class="avatar-accessory accessory-glasses"
                            style="position: absolute; top: 12px; left: 50%; transform: translateX(-50%); width: 40px; height: 18px; z-index: 10; pointer-events: none;">
                            <svg viewBox="0 0 100 40" width="100%" height="100%">
                                <polygon points="20,5 25,18 38,18 28,26 31,38 20,30 9,38 12,26 2,18 15,18"
                                    fill="rgba(255, 102, 196, 0.9)" stroke="#D94B9F" stroke-width="3" />
                                <polygon points="80,5 85,18 98,18 88,26 91,38 80,30 69,38 72,26 62,18 75,18"
                                    fill="rgba(255, 102, 196, 0.9)" stroke="#D94B9F" stroke-width="3" />
                                <path d="M 38 22 Q 50 12 62 22" fill="none" stroke="#D94B9F" stroke-width="4" />
                            </svg>
                        </div>
                    @elseif($activeChild->current_outfit === 'superhero')
                        <div class="avatar-accessory accessory-superhero"
                            style="position: absolute; bottom: -2px; left: 50%; transform: translateX(-50%); width: 44px; height: 16px; z-index: 10; pointer-events: none;">
                            <svg viewBox="0 0 100 30" width="100%" height="100%">
                                <path d="M 10 5 L 30 25 L 50 10 L 70 25 L 90 5" fill="none" stroke="#FF5252" stroke-width="5"
                                    stroke-linecap="round" />
                                <rect x="35" y="2" width="30" height="12" rx="4" fill="#FF5252" stroke="#C62828"
                                    stroke-width="1" />
                            </svg>
                        </div>
                    @endif
                </div>
                <div class="pill-text">
                    <span class="pill-title" style="color: #27AE60;">Current Profile</span>
                    <span class="pill-desc">Playing as <strong>{{ $activeChild->name }}</strong></span>
                </div>
            </div>
            <div class="pill-arrow" style="background: #D5F5E3; color: #27AE60;">
                &gt;
            </div>
        </a>
    </footer>

    <!-- 3D Lion Mascot -->
    <img src="{{ asset('images/backgrounds/3d_lion.png') }}" class="lion-mascot" alt="3D Lion Mascot">

    <!-- 2. Cute Bunny Rabbit on Bottom Right -->
    <div class="rabbit-mascot">
        <svg viewBox="0 0 100 120" width="130" height="156">
            <!-- Ears -->
            <ellipse cx="40" cy="25" rx="8" ry="22" fill="#FFF" stroke="#CCC" stroke-width="2" />
            <ellipse cx="60" cy="25" rx="8" ry="22" fill="#FFF" stroke="#CCC" stroke-width="2" />
            <ellipse cx="40" cy="27" rx="4" ry="15" fill="#FFB7B2" />
            <ellipse cx="60" cy="27" rx="4" ry="15" fill="#FFB7B2" />
            <!-- Body -->
            <circle cx="50" cy="90" r="28" fill="#FFF" stroke="#DDD" stroke-width="2" />
            <!-- Face -->
            <circle cx="50" cy="55" r="22" fill="#FFF" stroke="#DDD" stroke-width="2" />
            <circle cx="43" cy="50" r="2.5" fill="#222" />
            <circle cx="57" cy="50" r="2.5" fill="#222" />
            <circle cx="36" cy="56" r="3.5" fill="#FFB7B2" opacity="0.6" />
            <circle cx="64" cy="56" r="3.5" fill="#FFB7B2" opacity="0.6" />
            <path d="M 48 57 Q 50 55 52 57 Q 50 61 48 57 Z" fill="#FFB7B2" stroke="#222" stroke-width="1" />
            <path d="M 46 62 Q 50 66 54 62" stroke="#222" stroke-width="1.5" fill="none" stroke-linecap="round" />
            <!-- Feet -->
            <ellipse cx="34" cy="112" rx="10" ry="6" fill="#FFF" stroke="#DDD" stroke-width="2" />
            <ellipse cx="66" cy="112" rx="10" ry="6" fill="#FFF" stroke="#DDD" stroke-width="2" />
        </svg>
    </div>

    <!-- 3. Little Schoolhouse decoration on bottom right grass -->
    <div class="house-decor">
        <svg viewBox="0 0 100 100" width="120" height="120">
            <!-- Roof -->
            <polygon points="50,15 10,45 90,45" fill="#FF5757" stroke="#C62828" stroke-width="3" />
            <!-- Walls -->
            <rect x="20" y="45" width="60" height="45" fill="#FFF9C4" stroke="#FBC02D" stroke-width="3" />
            <!-- Door -->
            <rect x="42" y="62" width="16" height="28" fill="#8D6E63" stroke="#4E342E" stroke-width="2" rx="2" />
            <circle cx="54" cy="76" r="2" fill="#FFDE59" />
            <!-- Circular Window -->
            <circle cx="50" cy="33" r="8" fill="#E3F2FD" stroke="#1565C0" stroke-width="2" />
            <line x1="50" y1="25" x2="50" y2="41" stroke="#1565C0" stroke-width="1.5" />
            <line x1="42" y1="33" x2="58" y2="33" stroke="#1565C0" stroke-width="1.5" />
        </svg>
    </div>
@endsection