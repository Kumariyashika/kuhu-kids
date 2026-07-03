@extends('layouts.app')

@section('title', 'Kuhu Kids Learning - Devotional Learning')

@section('content')
<div class="inner-container">
    <div class="inner-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; flex-wrap: wrap; gap: 15px;">
        <h1 class="inner-title" style="margin: 0;">
            <span style="color: var(--color-purple);">🕉️ Devotional Learning</span>
        </h1>
        
        <!-- Live Stars Pill -->
        <div class="stars-pill" style="display: flex; align-items: center; gap: 8px; background: white; padding: 8px 18px; border-radius: 24px; border: 3px solid var(--color-yellow); font-weight: 800; color: var(--color-orange); box-shadow: 0 4px 0 var(--color-yellow-shadow); font-size: 1.15rem; z-index: 10;">
            <span>⭐</span>
            <span class="stars-count">{{ $activeChild->stars }}</span>
        </div>
        
        <a href="{{ route('dashboard') }}" class="btn-3d btn-yellow" style="margin: 0;">&lt; Back to Home</a>
    </div>

    <!-- Category Filter Tabs above Reels -->
    <div class="category-tabs" style="display: flex; gap: 10px; margin-bottom: 20px; justify-content: center; flex-wrap: wrap; width: 100%;">
        <button onclick="filterCategory('all', this)" class="btn-3d category-tab-btn active-tab-btn" style="background-color: var(--color-purple); color: white; border-bottom: 5px solid var(--color-purple-shadow); min-width: 110px; padding: 8px 16px;">
            🕉️ All
        </button>
        <button onclick="filterCategory('mantra', this)" class="btn-3d category-tab-btn" style="background-color: var(--color-yellow); color: #4A3B00; border-bottom: 5px solid var(--color-yellow-shadow); min-width: 110px; padding: 8px 16px;">
            📿 Mantras
        </button>
        <button onclick="filterCategory('aarti', this)" class="btn-3d category-tab-btn" style="background-color: var(--color-yellow); color: #4A3B00; border-bottom: 5px solid var(--color-yellow-shadow); min-width: 110px; padding: 8px 16px;">
            🕯️ Aartis
        </button>
        <button onclick="filterCategory('story', this)" class="btn-3d category-tab-btn" style="background-color: var(--color-yellow); color: #4A3B00; border-bottom: 5px solid var(--color-yellow-shadow); min-width: 110px; padding: 8px 16px;">
            📖 Stories
        </button>
    </div>

    <!-- Reels Swiper Viewport -->
    <div class="reels-viewport" style="border-color: rgba(140, 82, 255, 0.25);">
        <!-- Playlist drawer toggle -->
        <button class="drawer-toggle-btn" style="border-color: var(--color-purple);" onclick="toggleDrawer(true)" title="Select Lesson">☰</button>
        
        <!-- Playlist slide-out drawer -->
        <div class="reels-drawer" style="border-right-color: var(--color-purple);" id="reelsDrawer">
            <button class="drawer-close-btn" onclick="toggleDrawer(false)">&times;</button>
            <h3 class="reels-drawer-title" style="color: var(--color-purple);">🙏 Devotional Library</h3>
            <div class="reels-drawer-list">
                <!-- Populated dynamically via JS -->
            </div>
        </div>

        <!-- Vertical Reels snapping container -->
        <div class="reels-container" id="reelsContainer">
            <!-- Populated dynamically via JS -->
        </div>
        
        <!-- Desktop vertical navigation buttons -->
        <div class="reels-navigation">
            <button class="reels-nav-btn" style="border-color: var(--color-purple);" onclick="scrollPrev()" title="Previous">▲</button>
            <button class="reels-nav-btn" style="border-color: var(--color-purple);" onclick="scrollNext()" title="Next">▼</button>
        </div>
        
        <div class="swipe-tip">Swipe/scroll up or down for more learning! 🔽</div>
    </div>
</div>

<script>
    let allLessons = [];
    let filteredLessons = [];
    let activeIndex = 0;
    let speakingIndex = -1;
    let speakProgressInterval = null;
    let observer = null;
    let autoplayTimeout = null;

    // Populate all devotional lessons in JS array
    @foreach($course->lessons as $lesson)
        allLessons.push({
            id: {{ $lesson->id }},
            title: `{!! addslashes($lesson->title) !!}`,
            contentType: '{{ $lesson->content_type }}',
            body: `{!! str_replace("\n", '\\n', addslashes($lesson->body_content)) !!}`
        });
    @endforeach

    filteredLessons = [...allLessons];

    document.addEventListener('DOMContentLoaded', () => {
        renderReels();
    });

    function filterCategory(category, button) {
        SoundFX.play('click');
        
        // Update active tab styles
        document.querySelectorAll('.category-tab-btn').forEach(btn => {
            btn.style.backgroundColor = "var(--color-yellow)";
            btn.style.borderBottomColor = "var(--color-yellow-shadow)";
            btn.style.color = "#4A3B00";
            btn.classList.remove('active-tab-btn');
        });
        
        button.style.backgroundColor = "var(--color-purple)";
        button.style.borderBottomColor = "var(--color-purple-shadow)";
        button.style.color = "#FFF";
        button.classList.add('active-tab-btn');
        
        // Filter lessons
        if (category === 'all') {
            filteredLessons = [...allLessons];
        } else {
            filteredLessons = allLessons.filter(l => l.contentType === category);
        }
        
        renderReels();
    }

    function renderReels() {
        stopSpeak();
        const container = document.getElementById('reelsContainer');
        const drawerList = document.querySelector('.reels-drawer-list');
        
        container.innerHTML = '';
        drawerList.innerHTML = '';
        
        if (filteredLessons.length === 0) {
            container.innerHTML = `
                <div class="reel-card" style="justify-content: center; background: #FAF9F5; height: 100%;">
                    <h2 class="reel-title" style="color: var(--color-purple);">No lessons found 🕉️</h2>
                    <p style="font-size: 1.3rem; text-align: center; color: var(--color-gray);">Please try another category!</p>
                </div>
            `;
            return;
        }
        
        const gradients = [
            'linear-gradient(135deg, #F3E5F5 0%, #D1C4E9 100%)',
            'linear-gradient(135deg, #EDE7F6 0%, #C5CAE9 100%)',
            'linear-gradient(135deg, #E8EAF6 0%, #C5CAE9 100%)',
            'linear-gradient(135deg, #F3E5F5 0%, #E1BEE7 100%)'
        ];
        
        filteredLessons.forEach((lesson, index) => {
            let icon = '🕉️';
            if (lesson.contentType === 'mantra') icon = '📿';
            else if (lesson.contentType === 'aarti') icon = '🕯️';
            else if (lesson.contentType === 'story') icon = '📖';
            
            // Build card html
            const card = document.createElement('div');
            card.className = 'reel-card';
            card.id = `reel-${index}`;
            card.setAttribute('data-index', index);
            card.style.background = gradients[index % gradients.length];
            
            card.innerHTML = `
                <span class="floating-element" style="top: 15%; left: 8%; animation-delay: 0s;">${icon}</span>
                <span class="floating-element" style="top: 12%; right: 10%; animation-delay: 1.5s;">⭐</span>
                <span class="floating-element" style="bottom: 22%; left: 9%; animation-delay: 0.8s;">✨</span>
                <span class="floating-element" style="bottom: 18%; right: 7%; animation-delay: 2.2s;">🙏</span>
                
                <h2 class="reel-title" style="color: var(--color-purple); font-size: 2rem;">${lesson.title}</h2>
                
                <div class="reel-content-box" style="border-color: #EDE7F6; background: rgba(255,255,255,0.92);">
                    <div class="reel-lyrics" style="font-size: 1.45rem; line-height: 1.75;" id="lyrics-${index}"></div>
                </div>
                
                <div class="reel-footer">
                    <div class="audio-controls" style="margin: 0;">
                        <button onclick="toggleSpeak(${index})" class="btn-3d btn-yellow play-btn" style="font-size: 1.1rem; padding: 8px 20px;">
                            ▶️ Play
                        </button>
                        <button onclick="stopSpeak()" class="btn-3d btn-pink stop-btn" style="font-size: 1.1rem; padding: 8px 20px; display: none;">
                            ⏸️ Stop
                        </button>
                    </div>
                    
                    <div class="reel-progress-container">
                        <div class="reel-progress-bar" id="progress-bar-${index}" style="background: var(--color-purple);"></div>
                    </div>
                    
                    <div style="font-weight: 900; color: var(--color-orange); font-size: 1.15rem; display: flex; align-items: center; gap: 4px; background: white; padding: 6px 12px; border-radius: 16px; border: 2px solid #EDE7F6;">
                        <span>⭐</span><span>+5</span>
                    </div>
                </div>
            `;
            container.appendChild(card);
            
            // Set text content safely
            document.getElementById(`lyrics-${index}`).innerText = lesson.body.replace(/\\n/g, "\n");
            
            // Build drawer playlist items
            const drawerItem = document.createElement('div');
            drawerItem.className = `reels-drawer-item ${index === 0 ? 'active' : ''}`;
            drawerItem.id = `drawer-item-${index}`;
            drawerItem.onclick = () => scrollToReel(index);
            drawerItem.innerHTML = `${index + 1}. ${icon} ${lesson.title}`;
            drawerList.appendChild(drawerItem);
        });
        
        setupObserver();
        scrollToReel(0);
    }

    function setupObserver() {
        if (observer) {
            observer.disconnect();
        }
        
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
    }

    function setActiveReel(idx) {
        if (activeIndex === idx && speakingIndex === idx) return;
        
        if (activeIndex !== idx) {
            stopSpeak();
        }
        
        activeIndex = idx;
        
        // Highlight playlist drawer item
        document.querySelectorAll('.reels-drawer-item').forEach((item, index) => {
            if (index === idx) {
                item.classList.add('active');
                item.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            } else {
                item.classList.remove('active');
            }
        });
        
        clearTimeout(autoplayTimeout);
        autoplayTimeout = setTimeout(() => {
            autoPlayActiveReel();
        }, 800);
    }

    function autoPlayActiveReel() {
        if (localStorage.getItem('voice_enabled') === 'false') return;
        
        const lesson = filteredLessons[activeIndex];
        if (lesson) {
            speakDevotional(activeIndex, lesson.title, lesson.body);
        }
    }

    function containsDevanagari(text) {
        return /[\u0900-\u097F]/.test(text);
    }

    function speakDevotional(idx, title, body) {
        stopSpeak();
        
        speakingIndex = idx;
        const card = document.getElementById(`reel-${idx}`);
        if (!card) return;
        
        card.querySelector('.play-btn').style.display = 'none';
        card.querySelector('.stop-btn').style.display = 'inline-flex';
        
        const cleanText = title + ". " + body.replace(/\\n/g, ". ");
        const wordCount = cleanText.split(/\s+/).length;
        const isHindi = containsDevanagari(body);
        const durationSec = Math.max(6, wordCount / (isHindi ? 1.4 : 1.8)); // Sanskrit/Hindi is spoken slower
        
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
        
        const lang = isHindi ? 'hi-IN' : 'en-US';
        SoundFX.speak(cleanText, lang, () => {
            finishDevotional(idx, title);
        });
    }

    function toggleSpeak(idx) {
        const lesson = filteredLessons[idx];
        if (!lesson) return;
        
        if (speakingIndex === idx) {
            stopSpeak();
        } else {
            speakDevotional(idx, lesson.title, lesson.body);
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

    function finishDevotional(idx, title) {
        if (speakingIndex !== idx) return; // User scrolled away
        
        stopSpeak();
        SoundFX.play('cheer');
        
        // Stars particles
        triggerStarCompletion(idx);
        
        // Award stars
        fetch("{{ route('api.add_stars') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                stars: 5,
                activity_name: 'Completed Devotional Lesson: ' + title
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
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
            const y = Math.sin(angle) * distance - 120;
            
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
        if (activeIndex < filteredLessons.length - 1) {
            scrollToReel(activeIndex + 1);
        }
    }

    // Stop speaking when unloading the page
    window.addEventListener('beforeunload', () => {
        window.speechSynthesis.cancel();
    });

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
</script>
@endsection
