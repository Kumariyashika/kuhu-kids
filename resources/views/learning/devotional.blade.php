@extends('layouts.app')

@section('title', 'Kuhu Kids Learning - Devotional Learning')

@section('content')
<div class="inner-container">
    <div class="inner-header" style="display: flex; align-items: center; justify-content: flex-start; margin-bottom: 15px; gap: 15px; width: 100%;">
        <a href="{{ route('dashboard') }}" class="btn-3d btn-yellow" style="display: flex; align-items: center; justify-content: center; border-radius: 50%; width: 40px; height: 40px; padding: 0; text-decoration: none; margin: 0; flex-shrink: 0;" title="Back to Home">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
        </a>

        <h1 class="inner-title" style="margin: 0; font-size: 1.7rem; line-height: 1.2;">
            <span style="color: var(--color-purple);">🕉️ Devotional Learning</span>
        </h1>
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
    let observer = null;
    let autoplayTimeout = null;
    let starAwardTimeout = null;

    // Populate all devotional lessons in JS array
    @foreach($course->lessons as $lesson)
        allLessons.push({
            id: {{ $lesson->id }},
            title: `{!! addslashes($lesson->title) !!}`,
            contentType: '{{ $lesson->content_type }}',
            video_url: `{{ $lesson->video_url }}`
        });
    @endforeach

    filteredLessons = [...allLessons];

    document.addEventListener('DOMContentLoaded', () => {
        renderReels();
    });

    // Toggle categories
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
        // Stop currently loaded videos
        clearTimeout(autoplayTimeout);
        clearTimeout(starAwardTimeout);
        
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
                
                <h2 class="reel-title" style="color: var(--color-purple); font-size: 2rem; margin-bottom: 20px;">${lesson.title}</h2>
                
                ${lesson.video_url ? `
                <!-- Sleek Video Playback Container -->
                <div class="video-container video-container-devotional" id="video-wrapper-${index}">
                    <div id="video-placeholder-${index}" data-src="${lesson.video_url}" style="width: 100%; height: 100%;"></div>
                </div>
                ` : `
                <div style="text-align: center; padding: 40px; font-size: 1.5rem; color: var(--color-gray);">
                    📺 Video not available.
                </div>
                `}
            `;
            container.appendChild(card);
            
            // Build drawer playlist items
            const drawerItem = document.createElement('div');
            drawerItem.className = `reels-drawer-item ${index === 0 ? 'active' : ''}`;
            drawerItem.id = `drawer-item-${index}`;
            drawerItem.onclick = () => scrollToReel(index);
            drawerItem.innerHTML = `${index + 1}. ${icon} ${lesson.title}`;
            drawerList.appendChild(drawerItem);
        });
        
        setupObserver();
        
        // Initial load
        activeIndex = 0;
        loadActiveVideo(0);
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
        if (activeIndex === idx) return;
        
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
            loadActiveVideo(idx);
        }, 800);
    }

    function loadActiveVideo(idx) {
        // Reset/unload other videos first to prevent overlaps
        filteredLessons.forEach((lesson, i) => {
            const placeholder = document.getElementById('video-placeholder-' + i);
            if (placeholder) {
                placeholder.innerHTML = '';
            }
        });
        
        // Clear any pending star awards
        clearTimeout(starAwardTimeout);
        
        // Load active video
        const activePlaceholder = document.getElementById('video-placeholder-' + idx);
        if (activePlaceholder) {
            const videoUrl = activePlaceholder.getAttribute('data-src');
            if (videoUrl) {
                const iframe = document.createElement('iframe');
                // Auto play video when it snapped to view
                iframe.setAttribute('src', videoUrl + "?autoplay=1&rel=0");
                iframe.setAttribute('frameborder', '0');
                iframe.setAttribute('allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share');
                iframe.setAttribute('allowfullscreen', 'true');
                activePlaceholder.appendChild(iframe);
                
                // Award stars after 10 seconds of watching
                const lesson = filteredLessons[idx];
                starAwardTimeout = setTimeout(() => {
                    awardDevotionalStars(lesson.title);
                }, 10000);
            }
        }
    }

    function awardDevotionalStars(title) {
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

    function scrollNext() {
        if (activeIndex < filteredLessons.length - 1) {
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
</script>
@endsection
