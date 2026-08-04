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
        <a href="{{ route('learning.tracing') }}" class="module-card" >
                <img src="{{ asset('img/card_img/trace.png') }}" alt="Write Letters" style="width: 100%; height: 100%;  border-radius: 20px;">
        </a>

        <!-- 2. Phonics Sounds -->
        <a href="{{ route('learning.phonics') }}" class="module-card">
            
                <img src="{{ asset('img/card_img/phonic.png') }}" alt="Phonics Sounds" style="width: 100%; height: 100%;  border-radius: 20px;">
            
        </a>

        <!-- 3. Balloon Pop -->
        <a href="{{ route('learning.balloon_pop') }}" class="module-card">
                <img src="{{ asset('img/card_img/pop.png') }}" alt="Balloon Pop" style="width: 100%; height: 100%;  border-radius: 20px;">
        </a>

        <!-- 4. Letter Match -->
        <a href="{{ route('learning.letter_match') }}" class="module-card">
                <img src="{{ asset('img/card_img/match.png') }}" alt="Letter Match" style="width: 100%; height: 100%;  border-radius: 20px;">
        </a>

        <!-- 5. English Rhymes -->
        <a href="{{ route('learning.english_rhymes') }}" class="module-card">
                <img src="{{ asset('img/card_img/english_song.png') }}" alt="English Songs" style="width: 100%; height: 100%;  border-radius: 20px;">
        </a>

        <!-- 6. Hindi Rhymes -->
        <a href="{{ route('learning.hindi_rhymes') }}" class="module-card">
                <img src="{{ asset('img/card_img/hindi_song.png') }}" alt="Hindi Songs" style="width: 100%; height: 100%;  border-radius: 20px;">
        </a>


        <!-- 7. Devotional Learning -->
        <a href="{{ route('learning.devotional') }}" class="module-card">
                <img src="{{ asset('img/card_img/devotee.png') }}" alt="God Stories" style="width: 100%; height: 100%;  border-radius: 20px;">
        </a>



        <!-- 9. Number Counting -->
        <a href="{{ route('learning.numbers') }}" class="module-card">
                <img src="{{ asset('img/card_img/count.png') }}" alt="Count 1-2-3" style="width: 100%; height: 100%;  border-radius: 20px;">
        </a>

        <!-- 10. Shapes Learning -->
        <a href="{{ route('learning.shapes') }}" class="module-card">
                <img src="{{ asset('img/card_img/shape.png') }}" alt="Play with Shapes" style="width: 100%; height: 100%;  border-radius: 20px;">
        </a>

        <!-- 11. Colors Pop -->
<<<<<<< HEAD
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
=======
        <a href="{{ route('learning.colors') }}" class="module-card">
                <img src="{{ asset('img/card_img/color.png') }}" alt="Color Fun" style="width: 100%; height: 100%;  border-radius: 20px;">
>>>>>>> a5b7b629521f9349d88b677d4f0fc9e3435260eb
        </a>

        <!-- 12. Quiz Time -->
        <a href="{{ route('learning.quiz') }}" class="module-card">
                <img src="{{ asset('img/card_img/quiz.png') }}" alt="Kids Quiz Game" style="width: 100%; height: 100%;  border-radius: 20px;">
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