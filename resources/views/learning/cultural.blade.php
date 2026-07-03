@extends('layouts.app')

@section('title', 'Kuhu Kids Learning - Cultural Stories')

@section('content')
<div class="inner-container">
    <div class="inner-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 15px;">
        <h1 class="inner-title" style="margin: 0;">
            <span style="color: var(--color-orange);">📖 Moral Stories</span>
        </h1>
        
        <!-- Live Stars Pill -->
        <div class="stars-pill" style="display: flex; align-items: center; gap: 8px; background: white; padding: 8px 18px; border-radius: 24px; border: 3px solid var(--color-yellow); font-weight: 800; color: var(--color-orange); box-shadow: 0 4px 0 var(--color-yellow-shadow); font-size: 1.15rem; z-index: 10;">
            <span>⭐</span>
            <span class="stars-count">{{ $activeChild->stars }}</span>
        </div>
        
        <a href="{{ route('dashboard') }}" class="btn-3d btn-yellow" style="margin: 0;">&lt; Back to Home</a>
    </div>

    <!-- Reels Swiper Viewport -->
    <div class="reels-viewport" style="border-color: rgba(255, 145, 77, 0.25);">
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
                    // Split story content by double newlines into paragraphs
                    $paragraphs = array_filter(array_map('trim', explode("\n\n", $lesson->body_content)));
                    $totalSlides = count($paragraphs);
                @endphp
                
                <div class="reel-card" 
                     id="reel-{{ $index }}" 
                     data-index="{{ $index }}"
                     style="padding: 24px;">
                     
                     <h2 class="reel-title" style="color: var(--color-orange); font-size: 1.9rem; margin-bottom: 5px;">{{ $lesson->title }}</h2>
                     
                     <!-- 2D Horizontal Page-Flipping Container -->
                     <div class="story-horizontal-container" id="story-container-{{ $index }}" onscroll="handleStoryScroll({{ $index }})">
                         @foreach($paragraphs as $pIndex => $paragraph)
                             <div class="story-horizontal-slide">
                                 <div class="reel-content-box" style="margin: 0; width: 100%; height: 95%; border-color: #FFE0B2; background: rgba(255,255,255,0.92); display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 20px;">
                                     <div class="reel-lyrics" style="font-size: 1.4rem; line-height: 1.7; max-height: none; overflow: visible; width: 100%;">
                                         {{ $paragraph }}
                                     </div>
                                 </div>
                             </div>
                         @endforeach
                     </div>

                     <!-- Page Dot Indicators & Navigation -->
                     <div style="display: flex; flex-direction: column; align-items: center; width: 100%; margin-top: 5px;">
                         <div class="page-dots" id="dots-{{ $index }}" style="display: flex; gap: 8px; margin-bottom: 8px; z-index: 5;">
                             @foreach($paragraphs as $pIndex => $paragraph)
                                 <span class="page-dot {{ $pIndex === 0 ? 'active' : '' }}" 
                                       style="width: 10px; height: 10px; border-radius: 50%; background: {{ $pIndex === 0 ? 'var(--color-orange)' : '#E2E8F0' }}; transition: all 0.2s;"></span>
                             @endforeach
                         </div>
                         
                         <div class="reel-footer" style="margin-top: 0;">
                             <!-- Play/Stop controls -->
                             <div class="audio-controls" style="margin: 0; display: flex; gap: 8px;">
                                 <button onclick="toggleSpeak({{ $index }})" class="btn-3d btn-yellow play-btn" style="font-size: 1rem; padding: 6px 16px;">
                                     ▶️ Listen
                                 </button>
                                 <button onclick="stopSpeak()" class="btn-3d btn-pink stop-btn" style="font-size: 1rem; padding: 6px 16px; display: none;">
                                     停 Stop
                                 </button>
                             </div>
                             
                             <!-- Progress Bar -->
                             <div class="reel-progress-container" style="height: 10px; margin: 0 10px;">
                                 <div class="reel-progress-bar" id="progress-bar-{{ $index }}" style="background: var(--color-orange);"></div>
                             </div>
                             
                             <!-- Next Slide or Finish Button -->
                             <div style="display: flex; gap: 6px;">
                                 <button id="next-slide-btn-{{ $index }}" onclick="slideStoryNext({{ $index }})" class="btn-3d" style="background: var(--color-green-real); color: white; border-bottom: 4px solid var(--color-green-real-shadow); font-size: 1rem; padding: 6px 16px;">
                                     Flip Page 📖
                                 </button>
                                 <button id="finish-story-btn-{{ $index }}" onclick="finishStory({{ $index }}, '{{ addslashes($lesson->title) }}')" class="btn-3d btn-pink" style="font-size: 1rem; padding: 6px 16px; display: none;">
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
        
        <div class="swipe-tip">Swipe Up/Down for next story, swipe Left/Right for pages! 📖</div>
    </div>
</div>

<script>
    let activeIndex = 0;
    let speakingIndex = -1;
    let speakingPage = -1;
    let speakProgressInterval = null;
    let observer = null;
    let stories = [];
    let horizontalPageIndices = {}; // tracks active page idx per story idx
    let autoplayTimeout = null;

    // Load stories and their slides (paragraphs) into JS
    @foreach($course->lessons as $index => $lesson)
        @php
            $paragraphs = array_filter(array_map('trim', explode("\n\n", $lesson->body_content)));
        @endphp
        stories.push({
            id: {{ $lesson->id }},
            title: `{!! addslashes($lesson->title) !!}`,
            pages: [
                @foreach($paragraphs as $paragraph)
                    `{!! str_replace("\n", '\\n', addslashes($paragraph)) !!}`,
                @endforeach
            ]
        });
        horizontalPageIndices[{{ $index }}] = 0;
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
        
        updateFooterControls(idx);

        // Auto-play active slide page voice
        clearTimeout(autoplayTimeout);
        autoplayTimeout = setTimeout(() => {
            autoPlayActivePage();
        }, 800);
    }

    function autoPlayActivePage() {
        if (localStorage.getItem('voice_enabled') === 'false') return;
        
        const story = stories[activeIndex];
        const pageIdx = horizontalPageIndices[activeIndex] || 0;
        if (story && story.pages[pageIdx]) {
            speakPage(activeIndex, pageIdx, story.title, story.pages[pageIdx]);
        }
    }

    function handleStoryScroll(storyIdx) {
        const container = document.getElementById(`story-container-${storyIdx}`);
        if (!container) return;
        
        const pageIdx = Math.round(container.scrollLeft / container.clientWidth);
        
        if (horizontalPageIndices[storyIdx] !== pageIdx) {
            horizontalPageIndices[storyIdx] = pageIdx;
            
            // Update dots styling
            const dotsContainer = document.getElementById(`dots-${storyIdx}`);
            if (dotsContainer) {
                const dots = dotsContainer.querySelectorAll('.page-dot');
                dots.forEach((dot, idx) => {
                    if (idx === pageIdx) {
                        dot.style.backgroundColor = "var(--color-orange)";
                        dot.style.transform = "scale(1.2)";
                    } else {
                        dot.style.backgroundColor = "#E2E8F0";
                        dot.style.transform = "none";
                    }
                });
            }
            
            updateFooterControls(storyIdx);

            if (activeIndex === storyIdx) {
                const story = stories[storyIdx];
                speakPage(storyIdx, pageIdx, story.title, story.pages[pageIdx]);
            }
        }
    }

    function updateFooterControls(storyIdx) {
        const pageIdx = horizontalPageIndices[storyIdx] || 0;
        const story = stories[storyIdx];
        if (!story) return;
        
        const nextBtn = document.getElementById(`next-slide-btn-${storyIdx}`);
        const finishBtn = document.getElementById(`finish-story-btn-${storyIdx}`);
        
        if (nextBtn && finishBtn) {
            if (pageIdx === story.pages.length - 1) {
                nextBtn.style.display = 'none';
                finishBtn.style.display = 'inline-flex';
            } else {
                nextBtn.style.display = 'inline-flex';
                finishBtn.style.display = 'none';
            }
        }
    }

    function slideStoryNext(storyIdx) {
        const container = document.getElementById(`story-container-${storyIdx}`);
        if (container) {
            const pageIdx = horizontalPageIndices[storyIdx] || 0;
            const story = stories[storyIdx];
            if (pageIdx < story.pages.length - 1) {
                container.scrollTo({
                    left: container.clientWidth * (pageIdx + 1),
                    behavior: 'smooth'
                });
                SoundFX.play('click');
            }
        }
    }

    function speakPage(storyIdx, pageIdx, title, text) {
        stopSpeak();
        
        speakingIndex = storyIdx;
        speakingPage = pageIdx;
        
        const card = document.getElementById(`reel-${storyIdx}`);
        if (!card) return;
        
        card.querySelector('.play-btn').style.display = 'none';
        card.querySelector('.stop-btn').style.display = 'inline-flex';
        
        // If it's page 0, mention the title of the story first
        const textToSpeak = (pageIdx === 0) ? (title + ". " + text.replace(/\\n/g, ". ")) : text.replace(/\\n/g, ". ");
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
            // Finished page! If it's the last page, we wait for finish click, or just stop speak.
            if (speakingIndex === storyIdx && speakingPage === pageIdx) {
                stopSpeak();
            }
        });
    }

    function toggleSpeak(storyIdx) {
        const story = stories[storyIdx];
        const pageIdx = horizontalPageIndices[storyIdx] || 0;
        if (!story) return;
        
        if (speakingIndex === storyIdx && speakingPage === pageIdx) {
            stopSpeak();
        } else {
            speakPage(storyIdx, pageIdx, story.title, story.pages[pageIdx]);
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
            speakingPage = -1;
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
