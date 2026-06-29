@extends('layouts.app')

@section('title', 'Kuhu Kids Learning - English Rhymes')

@section('content')
<div class="inner-container">
    <div class="inner-header">
        <h1 class="inner-title">
            <span style="color: var(--color-pink);">🏆 English Rhymes</span>
        </h1>
        <a href="{{ route('dashboard') }}" class="btn-3d btn-yellow">&lt; Back to Home</a>
    </div>

    <div class="rhyme-layout">
        <!-- Sidebar Rhymes list -->
        <div class="rhymes-list">
            <h3 style="font-weight: 800; font-size: 1.2rem; margin-bottom: 10px; color: var(--color-text);">🎶 Select a Rhyme</h3>
            @foreach($course->lessons as $index => $lesson)
                <div class="rhyme-list-item {{ $index === 0 ? 'active' : '' }}" 
                     onclick="loadRhyme({{ $lesson->id }}, '{{ addslashes($lesson->title) }}', '{{ addslashes(str_replace("\n", '\\n', $lesson->body_content)) }}', this)">
                    {{ $lesson->title }}
                </div>
            @endforeach
        </div>

        <!-- Rhyme Lyrics & Player -->
        <div class="rhyme-player-view">
            <h2 id="rhymeTitle" style="font-size: 2rem; color: var(--color-pink); font-weight: 900; margin-bottom: 15px;">
                {{ $course->lessons[0]->title }}
            </h2>
            
            <div class="lyrics-container" id="lyricsBox">
                {{ $course->lessons[0]->body_content }}
            </div>

            <!-- Custom Playback Controls -->
            <div class="audio-controls">
                <button onclick="playRhyme()" class="btn-3d btn-yellow" id="playBtn" style="font-size: 1.4rem; padding: 12px 32px;">
                    ▶️ Play Rhyme
                </button>
                <button onclick="stopRhyme()" class="btn-3d btn-pink" id="stopBtn" style="font-size: 1.4rem; padding: 12px 32px; display: none;">
                    ⏸️ Stop
                </button>
            </div>
            
            <div id="earningProgress" style="margin-top: 20px; font-weight: bold; color: var(--color-orange); display: none;">
                🎉 Listening to nursery rhyme...
            </div>
        </div>
    </div>
</div>

<script>
    let activeRhymeTitle = "{{ $course->lessons[0]->title }}";
    let activeRhymeBody = `{!! str_replace("\n", '\\n', $course->lessons[0]->body_content) !!}`;
    let isSpeaking = false;
    let awardTimer = null;

    function loadRhyme(id, title, body, element) {
        stopRhyme();
        activeRhymeTitle = title;
        activeRhymeBody = body;
        
        document.getElementById('rhymeTitle').innerText = title;
        document.getElementById('lyricsBox').innerText = body.replace(/\\n/g, "\n");
        
        // Handle list selection styling
        document.querySelectorAll('.rhyme-list-item').forEach(item => item.classList.remove('active'));
        element.classList.add('active');
        SoundFX.play('click');
    }

    function playRhyme() {
        if ('speechSynthesis' in window) {
            isSpeaking = true;
            document.getElementById('playBtn').style.display = 'none';
            document.getElementById('stopBtn').style.display = 'inline-flex';
            document.getElementById('earningProgress').style.display = 'block';

            window.speechSynthesis.cancel();
            
            // Speak the whole rhyme text
            const textToSpeak = activeRhymeTitle + ". " + activeRhymeBody.replace(/\\n/g, ". ");
            const utterance = new SpeechSynthesisUtterance(textToSpeak);
            utterance.lang = 'en-US';
            utterance.rate = 0.8;
            utterance.pitch = 1.2;

            utterance.onend = () => {
                finishRhyme();
            };

            window.speechSynthesis.speak(utterance);
        } else {
            alert('Your browser does not support audio synthesis. Try a modern browser!');
        }
    }

    function stopRhyme() {
        if (isSpeaking) {
            window.speechSynthesis.cancel();
            isSpeaking = false;
            document.getElementById('playBtn').style.display = 'inline-flex';
            document.getElementById('stopBtn').style.display = 'none';
            document.getElementById('earningProgress').style.display = 'none';
        }
    }

    function finishRhyme() {
        isSpeaking = false;
        document.getElementById('playBtn').style.display = 'inline-flex';
        document.getElementById('stopBtn').style.display = 'none';
        document.getElementById('earningProgress').style.display = 'none';

        SoundFX.play('cheer');
        
        // Award stars
        fetch("{{ route('api.add_stars') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                stars: 5,
                activity_name: 'Listened to English Rhyme: ' + activeRhymeTitle
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

    // Stop speaking when leaving the page
    window.addEventListener('beforeunload', () => {
        window.speechSynthesis.cancel();
    });
</script>
@endsection
