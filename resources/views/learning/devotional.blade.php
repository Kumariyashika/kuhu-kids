@extends('layouts.app')

@section('title', 'Kuhu Kids Learning - Devotional Learning')

@section('content')
    <style>
        html, body {
            padding: 0 !important;
            margin: 0 !important;
            width: 100% !important;
            height: 100% !important;
            overflow: hidden !important;
            background: #000000 !important;
        }

        .app-container {
            max-width: 100% !important;
            width: 100% !important;
            height: 100vh !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        .bg-scene {
            display: none !important;
        }

        .rhymes-top-bar {
            padding: 10px 16px;
            background: rgba(0, 0, 0, 0.85);
            backdrop-filter: blur(10px);
            z-index: 90;
            display: flex;
            align-items: center;
            gap: 14px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
            flex-shrink: 0;
        }
    </style>

    <div class="inner-container reels-mode" style="background: #000 !important; border: none !important; box-shadow: none !important; padding: 0 !important; margin: 0 !important; height: 100vh !important; display: flex; flex-direction: column;">
        <div class="rhymes-top-bar">
            <a href="{{ route('dashboard') }}" class="btn-3d btn-yellow"
                style="display: flex; align-items: center; justify-content: center; border-radius: 50%; width: 40px; height: 40px; padding: 0; text-decoration: none; margin: 0; flex-shrink: 0;"
                title="Back to Home">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                    stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
            </a>

            <h1 class="inner-title" style="margin: 0; font-size: 1.5rem; line-height: 1.2;">
                <span style="color: #A26BFF; font-family: 'Fredoka', sans-serif; text-shadow: 0 2px 4px rgba(0,0,0,0.5);">🕉️ Devotional Learning</span>
            </h1>
        </div>


        <!-- Reels Swiper Viewport -->
        <div class="reels-viewport">
            <!-- Playlist drawer toggle -->
            <button class="drawer-toggle-btn" style="border-color: var(--color-purple);" onclick="toggleDrawer(true)"
                title="Select Lesson">☰</button>

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
                <button class="reels-nav-btn" style="border-color: var(--color-purple);" onclick="scrollPrev()"
                    title="Previous">▲</button>
                <button class="reels-nav-btn" style="border-color: var(--color-purple);" onclick="scrollNext()"
                    title="Next">▼</button>
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

        filteredLessons =[...allLessons];

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
                let badgeText = '';
                let badgeBg = '';
                let badgeColor = '';
                if (lesson.contentType === 'mantra') {
                    badgeText = 'Mantra';
                    badgeBg = 'rgba(140, 82, 255, 0.15)';
                    badgeColor = 'var(--color-purple)';
                } else if (lesson.contentType === 'aarti') {
                    badgeText = 'Aarti';
                    badgeBg = 'rgba(255, 145, 77, 0.15)';
                    badgeColor = '#E65100';
                } else if (lesson.contentType === 'story') {
                    badgeText = 'Story';
                    badgeBg = 'rgba(126, 217, 87, 0.15)';
                    badgeColor = '#1B5E20';
                }

                const drawerItem = document.createElement('div');
                drawerItem.className = `reels-drawer-item ${index === 0 ? 'active' : ''}`;
                drawerItem.id = `drawer-item-${index}`;
                drawerItem.onclick = () => scrollToReel(index);
                drawerItem.style.display = 'flex';
                drawerItem.style.justifyContent = 'space-between';
                drawerItem.style.alignItems = 'center';
                drawerItem.style.gap = '8px';
                drawerItem.innerHTML = `
                            <span style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">${index + 1}. ${icon} ${lesson.title}</span>
                            <span style="font-size: 0.7rem; font-weight: 800; padding: 2px 8px; border-radius: 8px; background: ${badgeBg}; color: ${badgeColor}; text-transform: uppercase; flex-shrink: 0;">${badgeText}</span>
                        `;
                drawerList.appendChild(drawerItem);
            });

            setupObserver();

            // Initial load
            activeIndex = -1;
            setActiveReel(0);
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
            // Highlight playlist drawer item
            document.querySelectorAll('.reels-drawer-item').forEach((item, index) => {
                if (index === idx) {
                    item.classList.add('active');
                    item.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                } else {
                    item.classList.remove('active');
                }
            });

            if (activeIndex === idx) return;

            activeIndex = idx;

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