@extends('layouts.app')

@section('title', 'Kuhu Kids Learning - Cultural Stories')

@section('content')
<div class="inner-container reels-mode" style="background: transparent !important; border: none !important; box-shadow: none !important; padding: 0 !important; margin: 0 !important;">
    <div class="inner-header" style="display: flex; align-items: center; justify-content: flex-start; margin-bottom: 20px; gap: 15px; width: 100%;">
        <a href="{{ route('dashboard') }}" class="btn-3d btn-yellow" style="display: flex; align-items: center; justify-content: center; border-radius: 50%; width: 40px; height: 40px; padding: 0; text-decoration: none; margin: 0; flex-shrink: 0;" title="Back to Home">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
        </a>

        <h1 class="inner-title" style="margin: 0; font-size: 1.7rem; line-height: 1.2;">
            <span style="color: var(--color-orange);">📖 Kids Stories</span>
        </h1>
    </div>

    <!-- Reels Swiper Viewport -->
    <div class="reels-viewport">
        <!-- Playlist drawer toggle -->
        <button class="drawer-toggle-btn" style="border-color: var(--color-orange);" onclick="toggleDrawer(true)" title="Select Story">☰</button>
        
        <!-- Playlist slide-out drawer -->
        <div class="reels-drawer" style="border-right-color: var(--color-orange);" id="reelsDrawer">
            <button class="drawer-close-btn" onclick="toggleDrawer(false)">&times;</button>
            <h3 class="reels-drawer-title" style="color: var(--color-orange);">📖 Story List</h3>
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
                @php
                    // Emoji themes & morals per story
                    $storyEmoji = '📖';
                    $storyMoral = 'Learn & Win 10 Stars!';
                    $titleLower = strtolower($lesson->title);
                    if (str_contains($titleLower, 'crow') || str_contains($titleLower, 'thirsty')) {
                        $storyEmoji = '🐦 🪨 💧';
                        $storyMoral = 'Where there is a will, there is a way!';
                    } elseif (str_contains($titleLower, 'tortoise') || str_contains($titleLower, 'hare') || str_contains($titleLower, 'rabbit')) {
                        $storyEmoji = '🐢 🐇 🏁';
                        $storyMoral = 'Slow and steady wins the race!';
                    } elseif (str_contains($titleLower, 'lion') || str_contains($titleLower, 'mouse')) {
                        $storyEmoji = '🦁 🐭 ✨';
                        $storyMoral = 'Little friends can be great friends!';
                    } elseif (str_contains($titleLower, 'fox') || str_contains($titleLower, 'grapes')) {
                        $storyEmoji = '🦊 🍇 🌳';
                        $storyMoral = 'Never dislike what you cannot get!';
                    } elseif (str_contains($titleLower, 'ant') || str_contains($titleLower, 'grasshopper')) {
                        $storyEmoji = '🐜 🦗 🌾';
                        $storyMoral = 'Work hard today to enjoy tomorrow!';
                    } elseif (str_contains($titleLower, 'woodcutter') || str_contains($titleLower, 'honest')) {
                        $storyEmoji = '🪓 🌊 🪙';
                        $storyMoral = 'Honesty is the best policy!';
                    }
                @endphp
                
                <div class="reel-card" 
                     id="reel-{{ $index }}" 
                     data-index="{{ $index }}"
                     style="padding: 10px; background: #000000 !important;">
                     
                     <div class="story-card-wrapper" style="width: 100%; height: 100%; display: flex; flex-direction: column; justify-content: space-between; align-items: center; padding: 14px; box-sizing: border-box; background: linear-gradient(135deg, #FFFDF0 0%, #FFE8D6 100%); border-radius: 24px; position: relative; border: none !important; box-shadow: none !important;">
                         
                         <!-- Story Header -->
                         <div style="display: flex; align-items: center; justify-content: center; width: 100%; padding: 4px 8px; z-index: 10;">
                             <div style="display: flex; align-items: center; gap: 8px;">
                                 <span style="font-size: 1.8rem;">📖</span>
                                 <h2 style="font-size: 1.35rem; font-weight: 900; color: #D97336; margin: 0; text-shadow: 1px 1px 0 #FFF;">{{ $lesson->title }}</h2>
                             </div>
                         </div>
                         
                         <!-- Single Page Story Card Box -->
                         <div class="reel-content-box" style="margin: 6px 0; width: 100%; flex: 1; border: none !important; background: #FFFFFF; border-radius: 20px; box-shadow: 0 10px 25px rgba(0,0,0,0.06); display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 18px; position: relative; overflow-y: auto;">
                             
                             <!-- Story Graphics Header -->
                             <div style="font-size: 2.5rem; margin-bottom: 10px;">
                                 {{ $storyEmoji }}
                             </div>

                             <!-- Full Story Text -->
                             <div class="reel-lyrics" style="font-size: 1.3rem; line-height: 1.7; max-height: none; overflow: visible; width: 100%; color: #2C3E50; font-weight: 600; text-align: center;">
                                 {{ $lesson->body_content }}
                             </div>


                         </div>

                         <!-- Footer Controls -->
                         <div class="reel-footer" style="margin-top: 4px; width: 100%; display: flex; align-items: center; justify-content: space-between; gap: 8px;">
                             <!-- Speaker Icon Play/Stop button -->
                             <div class="audio-controls" style="margin: 0; display: flex; gap: 6px;">
                                 <button onclick="toggleSpeak({{ $index }})" class="btn-3d btn-yellow play-btn" style="font-size: 1.3rem; width: 44px; height: 44px; border-radius: 50%; padding: 0; display: flex; align-items: center; justify-content: center; border-bottom-width: 4px;" title="Listen Audio">
                                     🔊
                                 </button>
                                 <button onclick="stopSpeak()" class="btn-3d btn-pink stop-btn" style="font-size: 1.3rem; width: 44px; height: 44px; border-radius: 50%; padding: 0; display: none; align-items: center; justify-content: center; border-bottom-width: 4px;" title="Stop Audio">
                                     ⏹️
                                 </button>
                             </div>
                             
                             <!-- Progress Bar -->
                             <div class="reel-progress-container" style="height: 10px; flex: 1; margin: 0 6px; background: #E2E8F0; border-radius: 10px; overflow: hidden;">
                                 <div class="reel-progress-bar" id="progress-bar-{{ $index }}" style="height: 100%; width: 0%; background: var(--color-orange); transition: width 0.1s linear;"></div>
                             </div>
                             
                             <!-- Finish Story Button -->
                             <div style="display: flex; gap: 6px;">
                                 <button id="finish-story-btn-{{ $index }}" onclick="finishStory({{ $index }}, '{{ addslashes($lesson->title) }}')" class="btn-3d btn-pink" style="font-size: 0.95rem; padding: 8px 18px;">
                                     Finish! 🌟
                                 </button>
                             </div>
                         </div>

                     </div>
                </div>
            @endforeach
        </div>
        
        <!-- Desktop vertical navigation buttons -->
        <div class="reels-navigation">
            <button class="reels-nav-btn" style="border-color: var(--color-orange);" onclick="scrollPrev()" title="Previous Story">▲</button>
            <button class="reels-nav-btn" style="border-color: var(--color-orange);" onclick="scrollNext()" title="Next Story">▼</button>
        </div>
        
        <div class="swipe-tip">Swipe Up/Down for next story! 📖</div>
    </div>
</div>

<script>
    let activeIndex = 0;
    let speakingIndex = -1;
    let speakProgressInterval = null;
    let observer = null;
    let stories = [];
    let autoplayTimeout = null;

    // Load stories into JS
    @foreach($course->lessons as $index => $lesson)
        stories.push({
            id: {{ $lesson->id }},
            title: `{!! addslashes($lesson->title) !!}`,
            text: `{!! str_replace("\n", '\\n', addslashes($lesson->body_content)) !!}`
        });
    @endforeach

    document.addEventListener('DOMContentLoaded', () => {
        const container = document.getElementById('reelsContainer');
        const cards = document.querySelectorAll('.reel-card');
        
        const observerOptions = {
            root: container,
            threshold: 0.6
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
        
        setActiveReel(0);
    });

    function setActiveReel(idx) {
        if (activeIndex === idx && speakingIndex === idx) return;
        
        if (activeIndex !== idx) {
            stopSpeak();
        }
        
        activeIndex = idx;
        
        // Highlight active story drawer playlist item
        document.querySelectorAll('.reels-drawer-item').forEach((item, index) => {
            if (index === idx) {
                item.classList.add('active');
                item.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            } else {
                item.classList.remove('active');
            }
        });
        
        // Custom background gradients for moral stories (Warm sunset tones)
        const gradients = [
            'linear-gradient(135deg, #FFF3E0 0%, #FFE0B2 100%)',
            'linear-gradient(135deg, #FFF9C4 0%, #FFF59D 100%)',
            'linear-gradient(135deg, #F1F8E9 0%, #DCEDC8 100%)',
            'linear-gradient(135deg, #E0F2F1 0%, #B2DFDB 100%)',
            'linear-gradient(135deg, #E0F7FA 0%, #B2EBF2 100%)'
        ];
        
        const card = document.getElementById(`reel-${idx}`);
        if (card) {
            card.style.background = gradients[idx % gradients.length];
        }

        // Auto-play active story voice
        clearTimeout(autoplayTimeout);
        autoplayTimeout = setTimeout(() => {
            autoPlayActiveStory();
        }, 800);
    }

    function autoPlayActiveStory() {
        if (localStorage.getItem('voice_enabled') === 'false') return;
        
        const story = stories[activeIndex];
        if (story) {
            speakPage(activeIndex, story.title, story.text);
        }
    }

    function speakPage(storyIdx, title, text) {
        stopSpeak();
        
        speakingIndex = storyIdx;
        
        const card = document.getElementById(`reel-${storyIdx}`);
        if (!card) return;
        
        card.querySelector('.play-btn').style.display = 'none';
        card.querySelector('.stop-btn').style.display = 'inline-flex';
        
        const textToSpeak = (title ? title + ". " : "") + text.replace(/\\n/g, ". ");
        const wordCount = textToSpeak.split(/\s+/).length;
        const durationSec = Math.max(6, wordCount / 1.7); // 1.7 words per second
        
        let elapsed = 0;
        const progressBar = document.getElementById(`progress-bar-${storyIdx}`);
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
        
        SoundFX.speak(textToSpeak, 'en-US', () => {
            if (speakingIndex === storyIdx) {
                stopSpeak();
            }
        });
    }

    function toggleSpeak(storyIdx) {
        const story = stories[storyIdx];
        if (!story) return;
        
        if (speakingIndex === storyIdx) {
            stopSpeak();
        } else {
            speakPage(storyIdx, story.title, story.text);
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

    function finishStory(storyIdx, title) {
        stopSpeak();
        SoundFX.play('cheer');
        
        triggerStarCompletion(storyIdx);
        
        // Award stars via API (Stories award 10 stars!)
        fetch("{{ route('api.add_stars') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                stars: 10,
                activity_name: 'Completed Moral Story: ' + title
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update live count in header
                const starsCountText = document.querySelector('.stars-count');
                if (starsCountText) {
                    starsCountText.innerText = data.new_stars;
                }
                
                // Automatically scroll back to page 0 after 2 seconds
                setTimeout(() => {
                    const container = document.getElementById(`story-container-${storyIdx}`);
                    if (container) {
                        container.scrollTo({ left: 0, behavior: 'smooth' });
                    }
                }, 2000);
            }
        });
    }

    function triggerStarCompletion(idx) {
        const card = document.getElementById(`reel-${idx}`);
        if (!card) return;
        
        for (let i = 0; i < 15; i++) {
            const star = document.createElement('div');
            star.innerText = '⭐';
            star.style.position = 'absolute';
            star.style.left = '50%';
            star.style.top = '50%';
            star.style.fontSize = '2.5rem';
            star.style.zIndex = '99';
            star.style.pointerEvents = 'none';
            star.style.transition = 'all 1.4s cubic-bezier(0.1, 0.8, 0.3, 1)';
            
            card.appendChild(star);
            
            const angle = Math.random() * Math.PI * 2;
            const distance = 100 + Math.random() * 180;
            const x = Math.cos(angle) * distance;
            const y = Math.sin(angle) * distance - 140;
            
            setTimeout(() => {
                star.style.transform = `translate(${x}px, ${y}px) scale(0) rotate(${Math.random() * 360}deg)`;
                star.style.opacity = '0';
            }, 50);
            
            setTimeout(() => {
                star.remove();
            }, 1450);
        }
    }

    function scrollNext() {
        if (activeIndex < stories.length - 1) {
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

    window.addEventListener('beforeunload', () => {
        window.speechSynthesis.cancel();
    });
</script>
@endsection
