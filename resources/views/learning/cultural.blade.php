@extends('layouts.app')

@section('title', 'Kuhu Kids Learning - Cultural Stories')

@section('content')
<div class="inner-container">
    <div class="inner-header">
        <h1 class="inner-title">
            <span style="color: var(--color-orange);">📖 Cultural & Moral Stories</span>
        </h1>
        <a href="{{ route('dashboard') }}" class="btn-3d btn-yellow">&lt; Back to Home</a>
    </div>

    <div class="rhyme-layout">
        <!-- Sidebar Stories List -->
        <div class="rhymes-list">
            <h3 style="font-weight: 800; font-size: 1.2rem; margin-bottom: 10px; color: var(--color-text);">📖 Select a Story</h3>
            @foreach($course->lessons as $index => $lesson)
                <div class="rhyme-list-item {{ $index === 0 ? 'active' : '' }}" 
                     onclick="loadStory({{ $lesson->id }}, '{{ addslashes($lesson->title) }}', '{{ addslashes(str_replace("\n", '\\n', $lesson->body_content)) }}', this)">
                    {{ $lesson->title }}
                </div>
            @endforeach
        </div>

        <!-- Slide Player View -->
        <div class="story-slide-view">
            <h2 id="storyTitle" style="font-size: 2rem; color: var(--color-orange); font-weight: 900;">
                {{ $course->lessons[0]->title }}
            </h2>
            
            <!-- Slide Content -->
            <div class="story-content" id="storyTextBox">
                <!-- Populated via JS -->
            </div>

            <!-- Slide Navigation & Speech -->
            <div class="story-navigation">
                <button onclick="prevSlide()" class="btn-3d btn-yellow" id="prevBtn" style="visibility: hidden;">
                    &lt; Back
                </button>
                
                <div style="display: flex; gap: 10px;">
                    <button onclick="readSlide()" class="btn-3d btn-yellow" id="readBtn">
                        📢 Read Aloud
                    </button>
                    <button onclick="stopReading()" class="btn-3d btn-pink" id="stopBtn" style="display: none;">
                        ⏸️ Stop
                    </button>
                </div>

                <button onclick="nextSlide()" class="btn-3d" style="background: var(--color-green-real); color: white; border-bottom: 6px solid var(--color-green-real-shadow);" id="nextBtn">
                    Next &gt;
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    let activeStoryTitle = "{{ $course->lessons[0]->title }}";
    let activeStoryBody = `{!! str_replace("\n", '\\n', $course->lessons[0]->body_content) !!}`;
    let slides = [];
    let currentSlideIndex = 0;
    let isReadingText = false;

    function parseStoryToSlides(bodyText) {
        // Split text by double newlines or paragraph segments
        return bodyText.split('\\n\\n').map(p => p.trim().replace(/\\n/g, "\n")).filter(p => p.length > 0);
    }

    function loadStory(id, title, body, element) {
        stopReading();
        activeStoryTitle = title;
        activeStoryBody = body;
        slides = parseStoryToSlides(body);
        currentSlideIndex = 0;

        document.getElementById('storyTitle').innerText = title;
        
        // Handle list selection styling
        document.querySelectorAll('.rhyme-list-item').forEach(item => item.classList.remove('active'));
        if (element) {
            element.classList.add('active');
        }
        
        showSlide();
        SoundFX.play('click');
    }

    function showSlide() {
        if (slides.length === 0) return;
        
        document.getElementById('storyTextBox').innerText = slides[currentSlideIndex];
        
        // Prev button visibility
        document.getElementById('prevBtn').style.visibility = currentSlideIndex > 0 ? 'visible' : 'hidden';
        
        // Next/Finish button text
        const nextBtn = document.getElementById('nextBtn');
        if (currentSlideIndex === slides.length - 1) {
            nextBtn.innerText = "Finish! 🌟";
            nextBtn.style.background = '#FF66C4'; // Pink for completion
            nextBtn.style.borderBottomColor = '#D94B9F';
        } else {
            nextBtn.innerText = "Next >";
            nextBtn.style.background = 'var(--color-green-real)';
            nextBtn.style.borderBottomColor = 'var(--color-green-real-shadow)';
        }
    }

    function prevSlide() {
        stopReading();
        if (currentSlideIndex > 0) {
            currentSlideIndex--;
            showSlide();
            SoundFX.play('click');
        }
    }

    function nextSlide() {
        stopReading();
        if (currentSlideIndex < slides.length - 1) {
            currentSlideIndex++;
            showSlide();
            SoundFX.play('click');
        } else {
            // Finished Story!
            finishStory();
        }
    }

    function readSlide() {
        if ('speechSynthesis' in window && slides.length > 0) {
            isReadingText = true;
            document.getElementById('readBtn').style.display = 'none';
            document.getElementById('stopBtn').style.display = 'inline-flex';

            window.speechSynthesis.cancel();
            
            const utterance = new SpeechSynthesisUtterance(slides[currentSlideIndex]);
            utterance.lang = 'en-US';
            utterance.rate = 0.85;
            utterance.pitch = 1.25;

            utterance.onend = () => {
                isReadingText = false;
                document.getElementById('readBtn').style.display = 'inline-flex';
                document.getElementById('stopBtn').style.display = 'none';
            };

            window.speechSynthesis.speak(utterance);
        }
    }

    function stopReading() {
        if (isReadingText) {
            window.speechSynthesis.cancel();
            isReadingText = false;
            document.getElementById('readBtn').style.display = 'inline-flex';
            document.getElementById('stopBtn').style.display = 'none';
        }
    }

    function finishStory() {
        SoundFX.play('cheer');
        SoundFX.speak("Wonderful reading! You earned 10 stars!");

        // Award stars
        fetch("{{ route('api.add_stars') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                stars: 10,
                activity_name: 'Completed Cultural Story: ' + activeStoryTitle
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const starsPill = document.querySelector('.stars-pill span');
                if (starsPill) {
                    starsPill.innerText = data.new_stars;
                }
                
                // Reset to first slide
                currentSlideIndex = 0;
                showSlide();
            }
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        // Initial parse
        loadStory(null, activeStoryTitle, activeStoryBody, null);
    });

    window.addEventListener('beforeunload', () => {
        window.speechSynthesis.cancel();
    });
</script>
@endsection
