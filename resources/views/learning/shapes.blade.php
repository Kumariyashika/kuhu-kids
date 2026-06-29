@extends('layouts.app')

@section('title', 'Kuhu Kids Learning - Shapes Learning')

@section('content')
<div class="inner-container">
    <div class="inner-header">
        <h1 class="inner-title">
            <span style="color: var(--color-orange);">📐 Shapes Learning Game</span>
        </h1>
        <a href="{{ route('dashboard') }}" class="btn-3d btn-yellow">&lt; Back to Home</a>
    </div>

    <!-- Instructions banner -->
    <div style="background: #FFFDF0; border: 3px solid var(--color-yellow); border-radius: 20px; padding: 15px 24px; text-align: center; margin-bottom: 25px;">
        <p style="font-size: 1.2rem; font-weight: 800; color: #6A5000;">👇 Tap on any shape to hear its name and learn its form!</p>
    </div>

    <!-- Shapes Grid -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; z-index: 10;">
        
        <!-- Shape 1: Circle -->
        <div class="shape-card card-green" onclick="learnShape('Circle', 'An orange circle has no corners!', this)">
            <svg viewBox="0 0 100 100" width="100" height="100">
                <circle cx="50" cy="50" r="36" fill="#FF914D" stroke="#D97336" stroke-width="4"/>
                <circle cx="40" cy="45" r="3" fill="#FFF"/>
                <circle cx="60" cy="45" r="3" fill="#FFF"/>
                <path d="M 43 55 Q 50 60 57 55" stroke="#FFF" stroke-width="3" fill="none" stroke-linecap="round"/>
            </svg>
            <h2 class="shape-title">Circle</h2>
            <span class="shape-desc">Gola (गोला)</span>
        </div>

        <!-- Shape 2: Square -->
        <div class="shape-card card-purple" onclick="learnShape('Square', 'A blue square has four equal sides!', this)">
            <svg viewBox="0 0 100 100" width="100" height="100">
                <rect x="15" y="15" width="70" height="70" rx="6" fill="#38B6FF" stroke="#2B8EC7" stroke-width="4"/>
                <circle cx="40" cy="45" r="3" fill="#FFF"/>
                <circle cx="60" cy="45" r="3" fill="#FFF"/>
                <path d="M 43 55 Q 50 60 57 55" stroke="#FFF" stroke-width="3" fill="none" stroke-linecap="round"/>
            </svg>
            <h2 class="shape-title">Square</h2>
            <span class="shape-desc">Varg (वर्ग)</span>
        </div>

        <!-- Shape 3: Triangle -->
        <div class="shape-card card-pink" onclick="learnShape('Triangle', 'A yellow triangle has three corners!', this)">
            <svg viewBox="0 0 100 100" width="100" height="100">
                <polygon points="50,15 15,80 85,80" fill="#FFDE59" stroke="#CCB143" stroke-width="4" stroke-linejoin="round"/>
                <circle cx="44" cy="52" r="3" fill="#4A3B00"/>
                <circle cx="56" cy="52" r="3" fill="#4A3B00"/>
                <path d="M 44 62 Q 50 66 56 62" stroke="#4A3B00" stroke-width="2.5" fill="none" stroke-linecap="round"/>
            </svg>
            <h2 class="shape-title">Triangle</h2>
            <span class="shape-desc">Trikon (त्रिकोण)</span>
        </div>

        <!-- Shape 4: Star -->
        <div class="shape-card card-yellow" onclick="learnShape('Star', 'A shiny star has five points!', this)">
            <svg viewBox="0 0 100 100" width="100" height="100">
                <polygon points="50,10 63,38 95,38 69,58 79,90 50,70 21,90 31,58 5,38 37,38" fill="#FF66C4" stroke="#D94B9F" stroke-width="4" stroke-linejoin="round"/>
                <circle cx="42" cy="48" r="3" fill="#FFF"/>
                <circle cx="58" cy="48" r="3" fill="#FFF"/>
                <path d="M 45 56 Q 50 60 55 56" stroke="#FFF" stroke-width="2.5" fill="none" stroke-linecap="round"/>
            </svg>
            <h2 class="shape-title">Star</h2>
            <span class="shape-desc">Tara (तारा)</span>
        </div>

        <!-- Shape 5: Heart -->
        <div class="shape-card card-green" onclick="learnShape('Heart', 'A red heart represents love!', this)">
            <svg viewBox="0 0 100 100" width="100" height="100">
                <path d="M 12,38 C 12,20, 38,15, 50,34 C 62,15, 88,20, 88,38 C 88,60, 50,85, 50,85 C 50,85, 12,60, 12,38 Z" fill="#FF5252" stroke="#C62828" stroke-width="4" stroke-linejoin="round"/>
                <circle cx="38" cy="38" r="3" fill="#FFF"/>
                <circle cx="62" cy="38" r="3" fill="#FFF"/>
                <path d="M 44 48 Q 50 52 56 48" stroke="#FFF" stroke-width="2.5" fill="none" stroke-linecap="round"/>
            </svg>
            <h2 class="shape-title">Heart</h2>
            <span class="shape-desc">Dil (दिल)</span>
        </div>

        <!-- Shape 6: Oval -->
        <div class="shape-card card-teal" onclick="learnShape('Oval', 'An egg-shaped green oval!', this)">
            <svg viewBox="0 0 100 100" width="100" height="100">
                <ellipse cx="50" cy="50" rx="26" ry="38" fill="#7ED957" stroke="#63AA43" stroke-width="4"/>
                <circle cx="42" cy="45" r="3" fill="#FFF"/>
                <circle cx="58" cy="45" r="3" fill="#FFF"/>
                <path d="M 44 54 Q 50 58 56 54" stroke="#FFF" stroke-width="2.5" fill="none" stroke-linecap="round"/>
            </svg>
            <h2 class="shape-title">Oval</h2>
            <span class="shape-desc">Andakar (अण्डाकार)</span>
        </div>

    </div>
</div>

<script>
    const learnedShapes = new Set();

    function learnShape(shapeName, description, element) {
        SoundFX.play('pop');

        // Speak details
        if (localStorage.getItem('voice_enabled') !== 'false') {
            SoundFX.speak(shapeName + ". " + description);
        }

        // Wobble card animation
        element.style.transform = 'scale(0.95)';
        setTimeout(() => {
            element.style.transform = '';
        }, 150);

        // Earn stars if learning this shape for the first time
        if (!learnedShapes.has(shapeName)) {
            learnedShapes.add(shapeName);
            
            // Trigger 2 stars award
            fetch("{{ route('api.add_stars') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    stars: 2,
                    activity_name: 'Learned Shape ' + shapeName
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
    /* 3D Shape Card Grid styles */
    .shape-card {
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
    
    .card-green { background: var(--color-green-real); border-bottom: 8px solid var(--color-green-real-shadow); }
    .card-purple { background: var(--color-purple); border-bottom: 8px solid var(--color-purple-shadow); }
    .card-pink { background: var(--color-pink); border-bottom: 8px solid var(--color-pink-shadow); }
    .card-yellow { background: var(--color-yellow); border-bottom: 8px solid var(--color-yellow-shadow); color: #4A3B00; }
    .card-teal { background: var(--color-teal); border-bottom: 8px solid var(--color-teal-shadow); }
    .card-orange { background: var(--color-orange); border-bottom: 8px solid var(--color-orange-shadow); }

    .shape-card:hover {
        transform: translateY(-6px);
        border-bottom-width: 12px;
    }
    
    .shape-card:active {
        transform: translateY(4px);
        border-bottom-width: 4px;
    }

    .shape-card svg {
        margin-bottom: 12px;
        filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1));
        transition: transform 0.3s ease;
    }

    .shape-card:hover svg {
        transform: scale(1.1) rotate(5deg);
    }

    .shape-title {
        font-size: 1.6rem;
        font-weight: 900;
        margin-bottom: 4px;
    }

    .shape-desc {
        font-size: 0.95rem;
        opacity: 0.9;
        font-weight: 600;
    }
</style>
@endsection
