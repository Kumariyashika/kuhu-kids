@extends('layouts.app')

@section('title', 'Kuhu Kids Learning - Shapes Learning')

@section('content')
    <style>
        html,
        body {
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

        /* Full Screen Shapes Page Layout */
        .shapes-page-container {
            background: #000000 !important;
            width: 100vw !important;
            height: 100vh !important;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 9999;
        }

        /* Top Bar Overlay */
        .shapes-top-bar {
            padding: 10px 18px;
            background: rgba(0, 0, 0, 0.85);
            backdrop-filter: blur(12px);
            z-index: 100;
            display: flex;
            align-items: center;
            gap: 16px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
            flex-shrink: 0;
        }

        /* Full Screen Video Container */
        .shapes-fullscreen-wrapper {
            flex: 1;
            width: 100%;
            height: calc(100vh - 60px);
            display: flex;
            align-items: center;
            justify-content: center;
            background: #000000;
            position: relative;
            overflow: hidden;
        }

        .shapes-fullscreen-video {
            width: 100%;
            height: 100%;
            object-fit: contain;
            transform: none;
            border: none;
            outline: none;
            cursor: pointer;
        }

        /* Top-Right Circular Sound Icon Button */
        .shapes-sound-circle-btn {
            position: absolute;
            top: 18px;
            right: 18px;
            z-index: 300;
            width: 52px;
            height: 52px;
            border-radius: 50%;
            background: linear-gradient(145deg, #38B6FF 0%, #0088CC 100%);
            color: #FFFFFF;
            border: 3px solid #FFFFFF;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5), inset 0 2px 0 rgba(255, 255, 255, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            cursor: pointer;
            transition: transform 0.2s ease, background 0.2s ease;
            user-select: none;
        }

        .shapes-sound-circle-btn.muted {
            background: linear-gradient(145deg, #FF5252 0%, #C62828 100%);
        }

        .shapes-sound-circle-btn:hover {
            transform: scale(1.12);
        }

        .shapes-sound-circle-btn:active {
            transform: scale(0.92);
        }

        /* Bottom-Right Start/Stop Action Button */
        .shapes-play-pause-btn {
            position: absolute;
            bottom: 36px;
            right: 24px;
            z-index: 200;
            padding: 12px 24px;
            border-radius: 30px;
            background: linear-gradient(145deg, #FF914D 0%, #FF6600 100%);
            color: #FFFFFF;
            border: 3px solid #FFFFFF;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.5), inset 0 2px 0 rgba(255, 255, 255, 0.4);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-family: 'Fredoka', sans-serif;
            font-size: 1.15rem;
            font-weight: 800;
            cursor: pointer;
            transition: transform 0.2s ease, background 0.2s ease;
            user-select: none;
        }

        .shapes-play-pause-btn:hover {
            transform: scale(1.08);
            background: linear-gradient(145deg, #FFA066 0%, #FF771A 100%);
        }

        .shapes-play-pause-btn:active {
            transform: scale(0.94);
        }

        @media (max-width: 640px) {
            .shapes-top-bar {
                padding: 8px 12px;
                gap: 10px;
            }

            .shapes-fullscreen-video {
                object-fit: contain !important;
                transform: none !important;
            }

            .shapes-sound-circle-btn {
                top: 12px;
                right: 12px;
                width: 44px;
                height: 44px;
                font-size: 1.2rem;
            }

            .shapes-play-pause-btn {
                bottom: 24px;
                right: 16px;
                padding: 10px 18px;
                font-size: 1.0rem;
            }
        }
    </style>

    <div class="shapes-page-container">
        <!-- Top Navigation Bar -->
        <div class="shapes-top-bar">
            <a href="{{ route('dashboard') }}" class="btn-3d btn-yellow"
                style="display: flex; align-items: center; justify-content: center; border-radius: 50%; width: 42px; height: 42px; padding: 0; text-decoration: none; margin: 0; flex-shrink: 0;"
                title="Back to Home">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                    stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
            </a>
            <h1 style="margin: 0; font-size: 1.5rem; line-height: 1.2; font-family: 'Fredoka', sans-serif;">
                <span style="color: #FF914D; text-shadow: 0 2px 4px rgba(0,0,0,0.6);">📐 Shapes / आकार</span>
            </h1>
        </div>

        <!-- Full Screen Video Player -->
        <div class="shapes-fullscreen-wrapper">
            <!-- Top Right Sound Speaker Icon Button -->
            <button id="shapesSoundBtn" class="shapes-sound-circle-btn" onclick="toggleShapesVideoSound()" title="Sound Mute / Unmute">
                <span id="shapesSoundIcon">🔊</span>
            </button>

            <video id="shapesLearningVideo" class="shapes-fullscreen-video" autoplay loop playsinline controls onclick="toggleShapesVideoPlay()">
                <source src="{{ asset('video/shapes.mp4') }}" type="video/mp4">
                Your browser does not support HTML5 video playback.
            </video>

            <!-- Bottom Right Start / Stop Floating Button -->
            <button id="shapesPlayPauseBtn" class="shapes-play-pause-btn" onclick="toggleShapesVideoPlay()" title="Play or Stop Video">
                <span id="shapesPlayPauseIcon">⏸</span>
                <span id="shapesPlayPauseText">Stop ⏸</span>
            </button>
        </div>
    </div>

    <script>
        function toggleShapesVideoSound() {
            const video = document.getElementById('shapesLearningVideo');
            const btn = document.getElementById('shapesSoundBtn');
            const icon = document.getElementById('shapesSoundIcon');

            if (video) {
                video.muted = !video.muted;
                updateSoundUI(video.muted);
            }
        }

        function updateSoundUI(isMuted) {
            const btn = document.getElementById('shapesSoundBtn');
            const icon = document.getElementById('shapesSoundIcon');
            if (isMuted) {
                if (icon) icon.innerText = '🔇';
                if (btn) btn.classList.add('muted');
            } else {
                if (icon) icon.innerText = '🔊';
                if (btn) btn.classList.remove('muted');
            }
        }

        function toggleShapesVideoPlay() {
            const video = document.getElementById('shapesLearningVideo');
            const icon = document.getElementById('shapesPlayPauseIcon');
            const text = document.getElementById('shapesPlayPauseText');

            if (video) {
                // Unmute audio when user interacts
                if (video.muted) {
                    video.muted = false;
                    updateSoundUI(false);
                }

                if (video.paused) {
                    video.play().then(() => {
                        if (icon) icon.innerText = '⏸';
                        if (text) text.innerText = 'Stop ⏸';
                    }).catch(err => {
                        console.log('Play error:', err);
                    });
                } else {
                    video.pause();
                    if (icon) icon.innerText = '▶';
                    if (text) text.innerText = 'Start ▶';
                }
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const video = document.getElementById('shapesLearningVideo');
            const icon = document.getElementById('shapesPlayPauseIcon');
            const text = document.getElementById('shapesPlayPauseText');

            if (video) {
                // Try playing unmuted first
                video.muted = false;
                updateSoundUI(false);

                video.play().catch(function(err) {
                    console.log('Unmuted autoplay prevented, playing muted fallback:', err);
                    video.muted = true;
                    updateSoundUI(true);
                    video.play().catch(e => {
                        if (icon) icon.innerText = '▶';
                        if (text) text.innerText = 'Start ▶';
                    });
                });

                video.addEventListener('play', function() {
                    if (icon) icon.innerText = '⏸';
                    if (text) text.innerText = 'Stop ⏸';
                });

                video.addEventListener('pause', function() {
                    if (icon) icon.innerText = '▶';
                    if (text) text.innerText = 'Start ▶';
                });

                // Enable sound on first touch/click
                document.body.addEventListener('click', function enableAudioOnFirstTouch() {
                    if (video && video.muted) {
                        video.muted = false;
                        updateSoundUI(false);
                    }
                }, { once: true });
            }
        });
    </script>
@endsection