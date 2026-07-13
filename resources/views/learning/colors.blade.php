@extends('layouts.app')

@section('title', 'Kuhu Kids Learning - Colors Learning')

@section('content')
<div class="inner-container">
    <div class="inner-header">
        <h1 class="inner-title">
            <span style="color: var(--color-pink);">🎨 Colors Learning Game</span>
        </h1>
        <a href="{{ route('dashboard') }}" class="btn-3d btn-yellow" style="display: flex; align-items: center; justify-content: center; border-radius: 50%; width: 44px; height: 44px; padding: 0; text-decoration: none; margin: 0;" title="Back to Home">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
        </a>
    </div>

    <!-- Instructions banner -->
    <div style="background: #FFFDF0; border: 3px solid var(--color-yellow); border-radius: 20px; padding: 15px 24px; text-align: center; margin-bottom: 25px;">
        <p style="font-size: 1.2rem; font-weight: 800; color: #6A5000;">🎨 Tap on any color jar to hear its name and splash some paint!</p>
    </div>

    <!-- Colors Grid -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 20px; z-index: 10;">
        
        <!-- Color 1: Red -->
        <div class="color-card" style="background: #FF5252; border-bottom: 8px solid #C62828;" onclick="learnColor('Red', 'Lal', this)">
            <svg viewBox="0 0 100 100" width="80" height="80">
                <path d="M 30,30 L 70,30 L 75,80 L 25,80 Z" fill="#FFF" stroke="#E2E8F0" stroke-width="2"/>
                <path d="M 25,50 C 35,50, 45,55, 50,60 C 55,55, 65,50, 75,50 L 75,80 L 25,80 Z" fill="#FF5252"/>
                <ellipse cx="50" cy="28" rx="20" ry="6" fill="#FF5252" stroke="#C62828" stroke-width="2"/>
                <circle cx="43" cy="62" r="2.5" fill="#FFF"/>
                <circle cx="57" cy="62" r="2.5" fill="#FFF"/>
                <path d="M 46 68 Q 50 71 54 68" stroke="#FFF" stroke-width="2" fill="none" stroke-linecap="round"/>
            </svg>
            <h2 class="color-title">Red</h2>
            <span class="color-hindi">Lal (लाल)</span>
        </div>

        <!-- Color 2: Blue -->
        <div class="color-card" style="background: #38B6FF; border-bottom: 8px solid #2B8EC7;" onclick="learnColor('Blue', 'Neela', this)">
            <svg viewBox="0 0 100 100" width="80" height="80">
                <path d="M 30,30 L 70,30 L 75,80 L 25,80 Z" fill="#FFF" stroke="#E2E8F0" stroke-width="2"/>
                <path d="M 25,50 C 35,50, 45,55, 50,60 C 55,55, 65,50, 75,50 L 75,80 L 25,80 Z" fill="#38B6FF"/>
                <ellipse cx="50" cy="28" rx="20" ry="6" fill="#38B6FF" stroke="#2B8EC7" stroke-width="2"/>
                <circle cx="43" cy="62" r="2.5" fill="#FFF"/>
                <circle cx="57" cy="62" r="2.5" fill="#FFF"/>
                <path d="M 46 68 Q 50 71 54 68" stroke="#FFF" stroke-width="2" fill="none" stroke-linecap="round"/>
            </svg>
            <h2 class="color-title">Blue</h2>
            <span class="color-hindi">Neela (नीला)</span>
        </div>

        <!-- Color 3: Green -->
        <div class="color-card" style="background: #7ED957; border-bottom: 8px solid #63AA43;" onclick="learnColor('Green', 'Hara', this)">
            <svg viewBox="0 0 100 100" width="80" height="80">
                <path d="M 30,30 L 70,30 L 75,80 L 25,80 Z" fill="#FFF" stroke="#E2E8F0" stroke-width="2"/>
                <path d="M 25,50 C 35,50, 45,55, 50,60 C 55,55, 65,50, 75,50 L 75,80 L 25,80 Z" fill="#7ED957"/>
                <ellipse cx="50" cy="28" rx="20" ry="6" fill="#7ED957" stroke="#63AA43" stroke-width="2"/>
                <circle cx="43" cy="62" r="2.5" fill="#FFF"/>
                <circle cx="57" cy="62" r="2.5" fill="#FFF"/>
                <path d="M 46 68 Q 50 71 54 68" stroke="#FFF" stroke-width="2" fill="none" stroke-linecap="round"/>
            </svg>
            <h2 class="color-title">Green</h2>
            <span class="color-hindi">Hara (हरा)</span>
        </div>

        <!-- Color 4: Yellow -->
        <div class="color-card" style="background: #FFDE59; border-bottom: 8px solid #CCB143; color: #4A3B00;" onclick="learnColor('Yellow', 'Peela', this)">
            <svg viewBox="0 0 100 100" width="80" height="80">
                <path d="M 30,30 L 70,30 L 75,80 L 25,80 Z" fill="#FFF" stroke="#E2E8F0" stroke-width="2"/>
                <path d="M 25,50 C 35,50, 45,55, 50,60 C 55,55, 65,50, 75,50 L 75,80 L 25,80 Z" fill="#FFDE59"/>
                <ellipse cx="50" cy="28" rx="20" ry="6" fill="#FFDE59" stroke="#CCB143" stroke-width="2"/>
                <circle cx="43" cy="62" r="2.5" fill="#4A3B00"/>
                <circle cx="57" cy="62" r="2.5" fill="#4A3B00"/>
                <path d="M 46 68 Q 50 71 54 68" stroke="#4A3B00" stroke-width="2" fill="none" stroke-linecap="round"/>
            </svg>
            <h2 class="color-title">Yellow</h2>
            <span class="color-hindi">Peela (पीला)</span>
        </div>

        <!-- Color 5: Orange -->
        <div class="color-card" style="background: #FF914D; border-bottom: 8px solid #D97336;" onclick="learnColor('Orange', 'Narangee', this)">
            <svg viewBox="0 0 100 100" width="80" height="80">
                <path d="M 30,30 L 70,30 L 75,80 L 25,80 Z" fill="#FFF" stroke="#E2E8F0" stroke-width="2"/>
                <path d="M 25,50 C 35,50, 45,55, 50,60 C 55,55, 65,50, 75,50 L 75,80 L 25,80 Z" fill="#FF914D"/>
                <ellipse cx="50" cy="28" rx="20" ry="6" fill="#FF914D" stroke="#D97336" stroke-width="2"/>
                <circle cx="43" cy="62" r="2.5" fill="#FFF"/>
                <circle cx="57" cy="62" r="2.5" fill="#FFF"/>
                <path d="M 46 68 Q 50 71 54 68" stroke="#FFF" stroke-width="2" fill="none" stroke-linecap="round"/>
            </svg>
            <h2 class="color-title">Orange</h2>
            <span class="color-hindi">Narangee (नारंगी)</span>
        </div>

        <!-- Color 6: Purple -->
        <div class="color-card" style="background: #8C52FF; border-bottom: 8px solid #6E3CD9;" onclick="learnColor('Purple', 'Bainganee', this)">
            <svg viewBox="0 0 100 100" width="80" height="80">
                <path d="M 30,30 L 70,30 L 75,80 L 25,80 Z" fill="#FFF" stroke="#E2E8F0" stroke-width="2"/>
                <path d="M 25,50 C 35,50, 45,55, 50,60 C 55,55, 65,50, 75,50 L 75,80 L 25,80 Z" fill="#8C52FF"/>
                <ellipse cx="50" cy="28" rx="20" ry="6" fill="#8C52FF" stroke="#6E3CD9" stroke-width="2"/>
                <circle cx="43" cy="62" r="2.5" fill="#FFF"/>
                <circle cx="57" cy="62" r="2.5" fill="#FFF"/>
                <path d="M 46 68 Q 50 71 54 68" stroke="#FFF" stroke-width="2" fill="none" stroke-linecap="round"/>
            </svg>
            <h2 class="color-title">Purple</h2>
            <span class="color-hindi">Bainganee (बैंगनी)</span>
        </div>

        <!-- Color 7: Pink -->
        <div class="color-card" style="background: #FF66C4; border-bottom: 8px solid #D94B9F;" onclick="learnColor('Pink', 'Gulabi', this)">
            <svg viewBox="0 0 100 100" width="80" height="80">
                <path d="M 30,30 L 70,30 L 75,80 L 25,80 Z" fill="#FFF" stroke="#E2E8F0" stroke-width="2"/>
                <path d="M 25,50 C 35,50, 45,55, 50,60 C 55,55, 65,50, 75,50 L 75,80 L 25,80 Z" fill="#FF66C4"/>
                <ellipse cx="50" cy="28" rx="20" ry="6" fill="#FF66C4" stroke="#D94B9F" stroke-width="2"/>
                <circle cx="43" cy="62" r="2.5" fill="#FFF"/>
                <circle cx="57" cy="62" r="2.5" fill="#FFF"/>
                <path d="M 46 68 Q 50 71 54 68" stroke="#FFF" stroke-width="2" fill="none" stroke-linecap="round"/>
            </svg>
            <h2 class="color-title">Pink</h2>
            <span class="color-hindi">Gulabi (गुलाबी)</span>
        </div>

    </div>
</div>

<script>
    const learnedColors = new Set();

    function learnColor(colorName, hindiName, element) {
        SoundFX.play('pop');

        // Speak the colors out loud
        if (localStorage.getItem('voice_enabled') !== 'false') {
            SoundFX.speak(colorName + ". In Hindi, we call it " + hindiName);
        }

        // Wobble card animation
        element.style.transform = 'scale(0.95)';
        setTimeout(() => {
            element.style.transform = '';
        }, 150);

        // Earn stars if learning this color for the first time
        if (!learnedColors.has(colorName)) {
            learnedColors.add(colorName);
            
            // Trigger 2 stars award
            fetch("{{ route('api.add_stars') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    stars: 2,
                    activity_name: 'Learned Color ' + colorName
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
    }
</script>

<style>
    /* Color card grid styles */
    .color-card {
        border-radius: 28px;
        padding: 24px;
        text-align: center;
        color: white;
        cursor: pointer;
        transition: all 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        display: flex;
        flex-direction: column;
        align-items: center;
        box-shadow: 0 8px 0 rgba(0,0,0,0.05);
    }

    .color-card:hover {
        transform: translateY(-6px);
        border-bottom-width: 12px;
    }
    
    .color-card:active {
        transform: translateY(4px);
        border-bottom-width: 4px;
    }

    .color-card svg {
        margin-bottom: 12px;
        filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1));
        transition: transform 0.3s ease;
    }

    .color-card:hover svg {
        transform: scale(1.15) rotate(5deg);
    }

    .color-title {
        font-size: 1.6rem;
        font-weight: 900;
        margin-bottom: 4px;
        text-shadow: 0 2px 4px rgba(0,0,0,0.15);
    }

    .color-hindi {
        font-size: 0.95rem;
        opacity: 0.9;
        font-weight: 600;
        text-shadow: 0 2px 4px rgba(0,0,0,0.15);
    }
</style>
@endsection
