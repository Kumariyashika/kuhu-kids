@extends('layouts.app')

@section('title', 'Kuhu Kids Learning - Hindi Rhymes')

@section('content')
    <div class="inner-container">
        <div class="inner-header"
            style="display: flex; align-items: center; justify-content: flex-start; margin-bottom: 20px; gap: 15px;">
            <a href="{{ route('dashboard') }}" class="btn-3d btn-yellow"
                style="display: flex; align-items: center; justify-content: center; border-radius: 50%; width: 40px; height: 40px; padding: 0; text-decoration: none; margin: 0; flex-shrink: 0;"
                title="Back to Home">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                    stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
            </a>

            <h1 class="inner-title" style="margin: 0; font-size: 1.7rem; line-height: 1.2;">
                <span style="color: var(--color-teal);">🎵 मजेदार हिंदी कविताएँ</span>
            </h1>
        </div>

        <!-- Reels Swiper Viewport -->
        <div class="reels-viewport" style="border-color: rgba(18, 176, 197, 0.25);">
            <!-- Playlist drawer toggle -->
            <button class="drawer-toggle-btn" style="border-color: var(--color-teal);" onclick="toggleDrawer(true)"
                title="कविता सूची">☰</button>

            <!-- Playlist slide-out drawer -->
            <div class="reels-drawer" style="border-right-color: var(--color-teal);" id="reelsDrawer">
                <button class="drawer-close-btn" onclick="toggleDrawer(false)">&times;</button>
                <h3 class="reels-drawer-title" style="color: var(--color-teal);">📖 कविता सूची</h3>
                <div class="reels-drawer-list">
                    @foreach($course->lessons as $index => $lesson)
                        <div class="reels-drawer-item {{ $index === 0 ? 'active' : '' }}" id="drawer-item-{{ $index }}"
                            onclick="scrollToReel({{ $index }})">
                            {{ $index + 1 }}. {{ $lesson->title }}
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Vertical Reels snapping container -->
            <div class="reels-container" id="reelsContainer">
                @foreach($course->lessons as $index => $lesson)
                    <div class="reel-card" id="reel-{{ $index }}" data-index="{{ $index }}">

                        <!-- Decorative floaties -->
                        <span class="floating-element" style="top: 15%; left: 8%; animation-delay: 0s;">🎶</span>
                        <span class="floating-element" style="top: 12%; right: 10%; animation-delay: 1.5s;">🎈</span>
                        <span class="floating-element" style="bottom: 22%; left: 9%; animation-delay: 0.8s;">✨</span>
                        <span class="floating-element" style="bottom: 18%; right: 7%; animation-delay: 2.2s;">🎵</span>


                        @if($lesson->video_url)
                            <!-- Sleek Video Playback Container -->
                            <div class="video-container video-container-hindi" id="video-wrapper-{{ $index }}">
                                <div id="video-placeholder-{{ $index }}" data-src="{{ $lesson->video_url }}"
                                    style="width: 100%; height: 100%;"></div>
                            </div>
                        @else
                            <div style="text-align: center; padding: 40px; font-size: 1.5rem; color: var(--color-gray);">
                                📺 वीडियो उपलब्ध नहीं है।
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- Desktop vertical navigation buttons -->
            <div class="reels-navigation">
                <button class="reels-nav-btn" style="border-color: var(--color-teal);" onclick="scrollPrev()"
                    title="पिछली कविता">▲</button>
                <button class="reels-nav-btn" style="border-color: var(--color-teal);" onclick="scrollNext()"
                    title="अगली कविता">▼</button>
            </div>

            <div class="swipe-tip">ऊपर या नीचे स्वाइप/स्क्रॉल करें! 🔽</div>
        </div>
    </div>

    <script>
        let activeIndex = 0;
        let observer = null;
        let lessons = [];
        let autoplayTimeout = null;
        let starAwardTimeout = null;

        // Populate lessons array for JavaScript playback control
        @foreach($course->lessons as $index => $lesson)
            lessons.push({
                id: {{ $lesson->id }},
                title: `{!! addslashes($lesson->title) !!}`,
                video_url: `{{ $lesson->video_url }}`
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
            loadActiveVideo(0);
        });

        function setActiveReel(idx) {
            if (activeIndex === idx) return;

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

            // Predefined pastel gradient backgrounds for each reel slide (Teal/Green/Orange theme for Hindi)
            const gradients = [
                'linear-gradient(135deg, #E0F2F1 0%, #B2DFDB 100%)',
                'linear-gradient(135deg, #E8F5E9 0%, #C8E6C9 100%)',
                'linear-gradient(135deg, #FFF3E0 0%, #FFE0B2 100%)',
                'linear-gradient(135deg, #FFFDE7 0%, #FFF59D 100%)',
                'linear-gradient(135deg, #F3E5F5 0%, #E1BEE7 100%)',
                'linear-gradient(135deg, #E3F2FD 0%, #BBDEFB 100%)'
            ];

            const card = document.getElementById(`reel-${idx}`);
            if (card) {
                card.style.background = gradients[idx % gradients.length];
            }

            // Wait for scroll snapping deceleration before loading active video
            clearTimeout(autoplayTimeout);
            autoplayTimeout = setTimeout(() => {
                loadActiveVideo(idx);
            }, 800);
        }

        function loadActiveVideo(idx) {
            // Reset/unload other videos first to prevent overlaps
            lessons.forEach((lesson, i) => {
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
                    const lesson = lessons[idx];
                    starAwardTimeout = setTimeout(() => {
                        awardRhymeStars(lesson.title);
                    }, 10000);
                }
            }
        }

        function awardRhymeStars(title) {
            SoundFX.play('cheer');

            // Award stars via API
            fetch("{{ route('api.add_stars') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    stars: 5,
                    activity_name: 'Watched Hindi Rhyme: ' + title
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
    </script>
@endsection