@extends('layouts.app')

@section('title', 'Kuhu Kids Learning - Devotional Learning')

@section('content')
<style>
    .devo-tabs {
        display: flex;
        gap: 6px;
        margin-bottom: 20px;
        background: #F1F5F9;
        padding: 5px;
        border-radius: 24px;
        border: 2px solid #E2E8F0;
    }
    .devo-tab {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 4px;
        padding: 10px 4px;
        border-radius: 18px;
        border: none;
        background: transparent;
        color: #64748B;
        font-weight: 800;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .devo-tab span {
        font-size: 1.2rem;
        transition: transform 0.2s ease;
    }
    .devo-tab:hover {
        color: var(--color-purple);
        background: rgba(140, 82, 255, 0.05);
    }
    .devo-tab:hover span {
        transform: scale(1.15);
    }
    .devo-tab.active {
        background: var(--color-purple);
        color: white;
        box-shadow: 0 4px 6px rgba(140, 82, 255, 0.2);
    }
    .devo-tab.active span {
        transform: scale(1.2);
    }
    
    .rhyme-list-item.devotional-item {
        display: flex;
        align-items: center;
        gap: 12px;
        background: #F8FAFC;
        border: 3px solid #E2E8F0;
        border-bottom-width: 6px;
        border-radius: 16px;
        padding: 16px;
        cursor: pointer;
        font-weight: 700;
        transition: all 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .rhyme-list-item.devotional-item.active {
        background: var(--color-purple);
        color: white;
        border-color: var(--color-purple-shadow);
        box-shadow: 0 6px 12px rgba(140, 82, 255, 0.15);
        transform: scale(1.02);
    }
    .rhyme-list-item.devotional-item:hover:not(.active) {
        border-color: var(--color-purple);
        background: rgba(140, 82, 255, 0.03);
        transform: translateY(-2px);
    }
    .rhyme-list-item-icon {
        font-size: 1.4rem;
        line-height: 1;
    }
    .devotional-player-view {
        border-color: var(--color-purple);
        background: radial-gradient(circle at top left, #FFFDF0 0%, #FAF7E6 100%);
    }
</style>

<div class="inner-container">
    <div class="inner-header">
        <h1 class="inner-title">
            <span style="color: var(--color-purple);">🕉️ Devotional Learning</span>
        </h1>
        <a href="{{ route('dashboard') }}" class="btn-3d btn-yellow">&lt; Back to Home</a>
    </div>

    <div class="rhyme-layout">
        <!-- Sidebar Devotional list -->
        <div class="rhymes-list">
            <h3 style="font-weight: 800; font-size: 1.2rem; margin-bottom: 10px; color: var(--color-text);">🙏 Select Learning</h3>
            
            <!-- Category Tabs -->
            <div class="devo-tabs">
                <button class="devo-tab active" onclick="filterDevotional('all', this)">
                    <span>🕉️</span>All
                </button>
                <button class="devo-tab" onclick="filterDevotional('mantra', this)">
                    <span>📿</span>Mantras
                </button>
                <button class="devo-tab" onclick="filterDevotional('aarti', this)">
                    <span>🕯️</span>Aartis
                </button>
                <button class="devo-tab" onclick="filterDevotional('story', this)">
                    <span>📖</span>Stories
                </button>
            </div>

            <div class="devotional-items-container" style="display: flex; flex-direction: column; gap: 12px; max-height: 480px; overflow-y: auto; padding-right: 4px;">
                @foreach($course->lessons as $index => $lesson)
                    @php
                        $icon = '🕉️';
                        if ($lesson->content_type === 'mantra') $icon = '📿';
                        elseif ($lesson->content_type === 'aarti') $icon = '🕯️';
                        elseif ($lesson->content_type === 'story') $icon = '📖';
                    @endphp
                    <div class="rhyme-list-item devotional-item {{ $index === 0 ? 'active' : '' }}" 
                         data-type="{{ $lesson->content_type }}"
                         onclick="loadDevotional({{ $lesson->id }}, '{{ addslashes($lesson->title) }}', '{{ addslashes(str_replace("\n", '\\n', $lesson->body_content)) }}', this)">
                        <span class="rhyme-list-item-icon">{{ $icon }}</span>
                        <span style="flex: 1;">{{ $lesson->title }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Devotional Content & Player -->
        <div class="rhyme-player-view devotional-player-view">
            <h2 id="devoTitle" style="font-size: 2rem; color: var(--color-purple); font-weight: 900; margin-bottom: 15px;">
                {{ $course->lessons[0]->title }}
            </h2>
            
            <div class="lyrics-container" id="lyricsBox" style="font-size: 1.5rem; line-height: 1.8;">
                {{ $course->lessons[0]->body_content }}
            </div>

            <!-- Controls -->
            <div class="audio-controls">
                <button onclick="playDevotional()" class="btn-3d btn-yellow" id="playBtn" style="font-size: 1.4rem; padding: 12px 32px;">
                    ▶️ Play Audio
                </button>
                <button onclick="stopDevotional()" class="btn-3d btn-pink" id="stopBtn" style="font-size: 1.4rem; padding: 12px 32px; display: none;">
                    ⏸️ Stop
                </button>
            </div>
            
            <div id="earningProgress" style="margin-top: 20px; font-weight: bold; color: var(--color-purple); display: none;">
                🙏 Meditating and listening...
            </div>
        </div>
    </div>
</div>

<script>
    let activeTitle = "{{ $course->lessons[0]->title }}";
    let activeBody = `{!! str_replace("\n", '\\n', $course->lessons[0]->body_content) !!}`;
    let isSpeaking = false;
    let activeFilter = 'all';

    function loadDevotional(id, title, body, element) {
        stopDevotional();
        activeTitle = title;
        activeBody = body;
        
        document.getElementById('devoTitle').innerText = title;
        document.getElementById('lyricsBox').innerText = body.replace(/\\n/g, "\n");
        
        // Handle list selection styling
        document.querySelectorAll('.devotional-item').forEach(item => item.classList.remove('active'));
        element.classList.add('active');
        
        // Play click sound using global SoundFX
        if (typeof SoundFX !== 'undefined') {
            SoundFX.play('click');
        }
    }

    function filterDevotional(category, button) {
        stopDevotional();
        activeFilter = category;
        
        // Update active tab button style
        document.querySelectorAll('.devo-tab').forEach(tab => tab.classList.remove('active'));
        button.classList.add('active');
        
        // Filter items
        let firstVisible = null;
        let activeVisible = false;
        
        document.querySelectorAll('.devotional-item').forEach(item => {
            const type = item.getAttribute('data-type');
            if (category === 'all' || type === category) {
                item.style.display = 'flex';
                if (!firstVisible) {
                    firstVisible = item;
                }
                if (item.classList.contains('active')) {
                    activeVisible = true;
                }
            } else {
                item.style.display = 'none';
            }
        });
        
        // If the currently active item is hidden, automatically select and click the first visible item
        if (!activeVisible && firstVisible) {
            firstVisible.click();
        } else {
            if (typeof SoundFX !== 'undefined') {
                SoundFX.play('click');
            }
        }
    }

    // Smart detector for Hindi / Devanagari text
    function containsDevanagari(text) {
        return /[\u0900-\u097F]/.test(text);
    }

    function playDevotional() {
        if ('speechSynthesis' in window) {
            isSpeaking = true;
            document.getElementById('playBtn').style.display = 'none';
            document.getElementById('stopBtn').style.display = 'inline-flex';
            document.getElementById('earningProgress').style.display = 'block';

            window.speechSynthesis.cancel();
            
            const cleanText = activeTitle + ". " + activeBody.replace(/\\n/g, ". ");
            const utterance = new SpeechSynthesisUtterance(cleanText);
            
            // Set language dynamically
            if (containsDevanagari(activeBody)) {
                utterance.lang = 'hi-IN';
                utterance.rate = 0.7; // Slower for shlokas/mantras
                utterance.pitch = 1.1;
            } else {
                utterance.lang = 'en-US';
                utterance.rate = 0.8;
                utterance.pitch = 1.2;
            }

            utterance.onend = () => {
                finishDevotional();
            };

            window.speechSynthesis.speak(utterance);
        } else {
            alert('Speech Synthesis not supported.');
        }
    }

    function stopDevotional() {
        if (isSpeaking) {
            window.speechSynthesis.cancel();
            isSpeaking = false;
            document.getElementById('playBtn').style.display = 'inline-flex';
            document.getElementById('stopBtn').style.display = 'none';
            document.getElementById('earningProgress').style.display = 'none';
        }
    }

    function finishDevotional() {
        isSpeaking = false;
        document.getElementById('playBtn').style.display = 'inline-flex';
        document.getElementById('stopBtn').style.display = 'none';
        document.getElementById('earningProgress').style.display = 'none';

        if (typeof SoundFX !== 'undefined') {
            SoundFX.play('cheer');
        }
        
        // Award stars
        fetch("{{ route('api.add_stars') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                stars: 5,
                activity_name: 'Completed Devotional Lesson: ' + activeTitle
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

    window.addEventListener('beforeunload', () => {
        window.speechSynthesis.cancel();
    });
</script>
@endsection
