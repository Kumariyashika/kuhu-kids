@extends('layouts.app')

@section('title', 'Kuhu Kids Learning - English Rhymes')

@section('content')
<div class="inner-container">
    <div class="inner-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 15px;">
        <h1 class="inner-title" style="margin: 0;">
            <span style="color: var(--color-pink);">🏆 English Rhymes</span>
        </h1>
        
        <!-- Live Stars Pill -->
        <div class="stars-pill" style="display: flex; align-items: center; gap: 8px; background: white; padding: 8px 18px; border-radius: 24px; border: 3px solid var(--color-yellow); font-weight: 800; color: var(--color-orange); box-shadow: 0 4px 0 var(--color-yellow-shadow); font-size: 1.15rem; z-index: 10;">
            <span>⭐</span>
            <span class="stars-count">{{ $activeChild->stars }}</span>
        </div>
        
        <a href="{{ route('dashboard') }}" class="btn-3d btn-yellow" style="margin: 0;">&lt; Back to Home</a>
    </div>

    <!-- Reels Swiper Viewport -->
    <div class="reels-viewport">
        <!-- Playlist drawer toggle -->
        <button class="drawer-toggle-btn" onclick="toggleDrawer(true)" title="Show Playlist">☰</button>
        
        <!-- Playlist slide-out drawer -->
        <div class="reels-drawer" id="reelsDrawer">
            <button class="drawer-close-btn" onclick="toggleDrawer(false)">&times;</button>
            <h3 class="reels-drawer-title">🎶 English Rhymes</h3>
            <div class="reels-drawer-list">
                @foreach($course->lessons as $index => $lesson)
                    <div class="reels-drawer-item {{ $index === 0 ? 'active' : '' }}" 
                         id="drawer-item-{{ $index }}"
                         onclick="scrollToReel({{ $index }})">
                        {{ $index + 1 }}. {{ $lesson->title }}
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Vertical Reels snapping container -->
        <div class="reels-container" id="reelsContainer">
            @foreach($course->lessons as $index => $lesson)
                <div class="reel-card" 
                     id="reel-{{ $index }}" 
                     data-index="{{ $index }}">
                     
                     <!-- Decorative floaties -->
                     <span class="floating-element" style="top: 15%; left: 8%; animation-delay: 0s;">🎵</span>
                     <span class="floating-element" style="top: 12%; right: 10%; animation-delay: 1.5s;">⭐</span>
                     <span class="floating-element" style="bottom: 22%; left: 9%; animation-delay: 0.8s;">✨</span>
                     <span class="floating-element" style="bottom: 18%; right: 7%; animation-delay: 2.2s;">🎶</span>
                     
                     <h2 class="reel-title" style="color: var(--color-pink);">{{ $lesson->title }}</h2>
                     
                     <div class="reel-content-box">
                         <div class="reel-lyrics" id="lyrics-{{ $index }}">{{ $lesson->body_content }}</div>
                     </div>
                     
                     <div class="reel-footer">
                         <!-- Play/Stop controls -->
                         <div class="audio-controls" style="margin: 0;">
                             <button onclick="toggleSpeak({{ $index }})" class="btn-3d btn-yellow play-btn" style="font-size: 1.15rem; padding: 10px 24px;">
                                 ▶️ Play
                             </button>
                             <button onclick="stopSpeak()" class="btn-3d btn-pink stop-btn" style="font-size: 1.15rem; padding: 10px 24px; display: none;">
                                 ⏸️ Stop
                             </button>
                         </div>
                         
                         <!-- Speaking progress track -->
                         <div class="reel-progress-container">
                             <div class="reel-progress-bar" id="progress-bar-{{ $index }}"></div>
                         </div>
                         
                         <!-- Stars reward display -->
                         <div style="font-weight: 900; color: var(--color-orange); font-size: 1.2rem; display: flex; align-items: center; gap: 4px; background: white; padding: 6px 12px; border-radius: 16px; border: 2px solid #FFEBEF;">
                             <span>⭐</span><span>+5</span>
                         </div>
                     </div>
                </div>
            @endforeach
        </div>
        
        <!-- Desktop vertical navigation buttons -->
        <div class="reels-navigation">
            <button class="reels-nav-btn" onclick="scrollPrev()" title="Previous Rhyme">▲</button>
            <button class="reels-nav-btn" onclick="scrollNext()" title="Next Rhyme">▼</button>
        </div>
        
        <div class="swipe-tip">Swipe/scroll up or down for more rhymes! 🔽</div>
    </div>
</div>

<script>
    let activeIndex = 0;
    let speakingIndex = -1;
    let speakProgressInterval = null;
    let observer = null;
    let lessons = [];
    let autoplayTimeout = null;

    // Populate lessons array for JavaScript playback control
    @foreach($course->lessons as $index => $lesson)
        lessons.push({
            id: {{ $lesson->id }},
            title: `{!! addslashes($lesson->title) !!}`,
            body: `{!! str_replace("\n", '\\n', addslashes($lesson->body_content)) !!}`
        });
    @endforeach

    document.addEventListener('DOMContentLoaded', () => {
        const container = document.getElementById('reelsContainer');
        const cards = document.querySelectorAll('.reel-card');
        
        // IntersectionObserver configuration
        const observerOptions = {
            root: container,
            threshold: 0.6 // Snaps when 60% of card height is visible
        };
        
        observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const idx = parseInt(entry.target.getAttribute('data-index'));
                    setActiveReel(idx);
                }
            });
        }, observerOptions);
        
        cards.forEach(card => observer.observe(card));
        
        // Initial setup
        setActiveReel(0);
    });

    function setActiveReel(idx) {
        if (activeIndex === idx && speakingIndex === idx) return;
        
        // If active index changes, stop current speaking
        if (activeIndex !== idx) {
            stopSpeak();
        }
        
        activeIndex = idx;
        
        // Update playlist drawer highlight
        document.querySelectorAll('.reels-drawer-item').forEach((item, index) => {
            if (index === idx) {
                item.classList.add('active');
                item.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            } else {
                item.classList.remove('active');
            }
        });
        
        // Predefined pastel gradient backgrounds for each reel slide
        const gradients = [
            'linear-gradient(135deg, #FFE5EC 0%, #FFD6E0 100%)',
            'linear-gradient(135deg, #E8F0FE 0%, #D2E3FC 100%)',
            'linear-gradient(135deg, #FCF0E3 0%, #FCE0C5 100%)',
            'linear-gradient(135deg, #FFF0F5 0%, #FAE0F0 100%)',
            'linear-gradient(135deg, #E2F0D9 0%, #C9E2B9 100%)',
            'linear-gradient(135deg, #FFF9E6 0%, #FFF2CC 100%)'
        ];
        
        const card = document.getElementById(`reel-${idx}`);
        if (card) {
            card.style.background = gradients[idx % gradients.length];
        }
        
        // Wait for scroll snapping deceleration before starting auto-play speech
        clearTimeout(autoplayTimeout);
        autoplayTimeout = setTimeout(() => {
            autoPlayActiveReel();
        }, 800);
    }

    function autoPlayActiveReel() {
        if (localStorage.getItem('voice_enabled') === 'false') return;
        
        const lesson = lessons[activeIndex];
        if (lesson) {
            speakRhyme(activeIndex, lesson.title, lesson.body);
        }
    }

    function speakRhyme(idx, title, body) {
        stopSpeak();
        
        speakingIndex = idx;
        const card = document.getElementById(`reel-${idx}`);
        if (!card) return;
        
        // Toggle play controls
        card.querySelector('.play-btn').style.display = 'none';
        card.querySelector('.stop-btn').style.display = 'inline-flex';
        
        // Estimate speech duration to animate the progress bar smoothly
        const textToSpeak = title + ". " + body.replace(/\\n/g, ". ");
        const wordCount = textToSpeak.split(/\s+/).length;
        const durationSec = Math.max(6, wordCount / 1.8); // 1.8 words per second for clarity
        
        let elapsed = 0;
        const progressBar = document.getElementById(`progress-bar-${idx}`);
        if (progressBar) {
            progressBar.style.width = '0%';
        }
        
        clearInterval(speakProgressInterval);
        speakProgressInterval = setInterval(() => {
            elapsed += 0.1;
            const percentage = Math.min(100, (elapsed / durationSec) * 100);
            if (progressBar) {
                progressBar.style.width = percentage + '%';
            }
            if (percentage >= 100) {
                clearInterval(speakProgressInterval);
            }
        }, 100);
        
        // Play the speech synthesis with global cancel workaround
        SoundFX.speak(textToSpeak, 'en-US', () => {
            finishRhyme(idx, title);
        });
    }

    function toggleSpeak(idx) {
        const lesson = lessons[idx];
        if (!lesson) return;
        
        if (speakingIndex === idx) {
            stopSpeak();
        } else {
            speakRhyme(idx, lesson.title, lesson.body);
        }
    }

    function stopSpeak() {
        if (speakingIndex !== -1) {
            const card = document.getElementById(`reel-${speakingIndex}`);
            if (card) {
                card.querySelector('.play-btn').style.display = 'inline-flex';
                card.querySelector('.stop-btn').style.display = 'none';
                
                const progressBar = document.getElementById(`progress-bar-${speakingIndex}`);
                if (progressBar) {
                    progressBar.style.width = '0%';
                }
            }
            speakingIndex = -1;
        }
        clearInterval(speakProgressInterval);
        window.speechSynthesis.cancel();
    }

    function finishRhyme(idx, title) {
        if (speakingIndex !== idx) return; // User scrolled away
        
        stopSpeak();
        SoundFX.play('cheer');
        
        // Star particle effect
        triggerStarCompletion(idx);
        
        // Award stars via API
        fetch("{{ route('api.add_stars') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                stars: 5,
                activity_name: 'Listened to English Rhyme: ' + title
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update header stars display
                const starsCountText = document.querySelector('.stars-count');
                if (starsCountText) {
                    starsCountText.innerText = data.new_stars;
                }
            }
        });
    }

    function triggerStarCompletion(idx) {
        const card = document.getElementById(`reel-${idx}`);
        if (!card) return;
        
        // Generate exploding stars
        for (let i = 0; i < 10; i++) {
            const star = document.createElement('div');
            star.innerText = '⭐';
            star.style.position = 'absolute';
            star.style.left = '50%';
            star.style.top = '50%';
            star.style.fontSize = '2.5rem';
            star.style.zIndex = '99';
            star.style.pointerEvents = 'none';
            star.style.transition = 'all 1.2s cubic-bezier(0.1, 0.8, 0.3, 1)';
            
            card.appendChild(star);
            
            const angle = Math.random() * Math.PI * 2;
            const distance = 90 + Math.random() * 150;
            const x = Math.cos(angle) * distance;
            const y = Math.sin(angle) * distance - 120; // float upwards
            
            setTimeout(() => {
                star.style.transform = `translate(${x}px, ${y}px) scale(0) rotate(${Math.random() * 360}deg)`;
                star.style.opacity = '0';
            }, 50);
            
            setTimeout(() => {
                star.remove();
            }, 1250);
        }
    }

    function scrollNext() {
        if (activeIndex < lessons.length - 1) {
            scrollToReel(activeIndex + 1);
        }
    }

    function scrollPrev() {
        if (activeIndex > 0) {
            scrollToReel(activeIndex - 1);
        }
    }

    function scrollToReel(idx) {
        const container = document.getElementById('reelsContainer');
        const card = document.getElementById(`reel-${idx}`);
        if (container && card) {
            container.scrollTo({
                top: card.offsetTop,
                behavior: 'smooth'
            });
            toggleDrawer(false);
        }
    }

    function toggleDrawer(open) {
        const drawer = document.getElementById('reelsDrawer');
        if (drawer) {
            if (open) {
                drawer.classList.add('open');
                SoundFX.play('click');
            } else {
                drawer.classList.remove('open');
            }
        }
    }

    // Stop synthesis when unloading the page
    window.addEventListener('beforeunload', () => {
        window.speechSynthesis.cancel();
    });
</script>
@endsection
