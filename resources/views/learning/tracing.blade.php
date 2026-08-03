@extends('layouts.app')

@section('title', 'Kuhu Kids Learning - Alphabet Writing')

@section('content')
    <!-- Include Canvas Confetti -->
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

    <!-- ======================================================== -->
    <!--  PREMIUM KIDS TRACING PAGE — COMPLETE REDESIGN            -->
    <!-- ======================================================== -->

    <style>
        /* ============================================ */
        /*  GOOGLE FONTS                                */
        /* ============================================ */
        @import url('https://fonts.googleapis.com/css2?family=Fredoka:wght@400;500;600;700&family=Baloo+2:wght@400;500;600;700;800&family=Nunito:wght@400;600;700;800;900&display=swap');

        /* ============================================ */
        /*  CSS VARIABLES — COLOR PALETTE               */
        /* ============================================ */
        :root {
            --k-primary: #4FC3F7;
            --k-primary-dark: #0397D6;
            --k-pink: #FF5DA2;
            --k-pink-dark: #D63F82;
            --k-yellow: #FFD93D;
            --k-yellow-dark: #E6B800;
            --k-green: #6BCB77;
            --k-green-dark: #4CAF50;
            --k-purple: #9B5DE5;
            --k-purple-dark: #7B2FD4;
            --k-orange: #FF9F1C;
            --k-orange-dark: #E68500;
            --k-red: #FF5252;
            --k-bg-sky-top: #87CEEB;
            --k-bg-sky-mid: #B8E6FF;
            --k-bg-meadow: #A8E6CF;
            --k-bg-grass: #6BCB77;
            --k-glass-bg: rgba(255, 255, 255, 0.25);
            --k-glass-border: rgba(255, 255, 255, 0.45);
            --k-font-primary: 'Fredoka', 'Baloo 2', 'Nunito', sans-serif;
            --k-font-display: 'Baloo 2', 'Fredoka', sans-serif;
            --k-shadow-soft: 0 8px 32px rgba(0, 0, 0, 0.1);
            --k-shadow-3d: 0 6px 0 rgba(0, 0, 0, 0.15);
            --k-radius-xl: 28px;
            --k-radius-lg: 20px;
            --k-radius-md: 16px;
            --k-radius-sm: 12px;
        }

        /* ============================================ */
        /*  KEYFRAME ANIMATIONS (50+)                   */
        /* ============================================ */

        @keyframes k-float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-12px); }
        }

        @keyframes k-float-slow {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-8px) rotate(2deg); }
        }

        @keyframes k-bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-18px); }
        }

        @keyframes k-bounce-soft {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-10px) scale(1.03); }
        }

        @keyframes k-pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(255, 93, 162, 0.3); }
            50% { box-shadow: 0 0 40px rgba(255, 93, 162, 0.6); }
        }

        @keyframes k-shine {
            0% { left: -100%; }
            50%, 100% { left: 200%; }
        }

        @keyframes k-spin-slow {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes k-sun-bob {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-5px) scale(1.05); }
        }

        @keyframes k-sun-rays {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes k-cloud-drift {
            0% { transform: translateX(0); }
            100% { transform: translateX(80px); }
        }

        @keyframes k-cloud-drift-reverse {
            0% { transform: translateX(0); }
            100% { transform: translateX(-60px); }
        }

        @keyframes k-rainbow-shimmer {
            0%, 100% { opacity: 0.5; filter: brightness(1); }
            50% { opacity: 0.8; filter: brightness(1.15); }
        }

        @keyframes k-butterfly-fly {
            0% { transform: translate(0, 0) rotate(5deg) scale(1); }
            25% { transform: translate(30px, -20px) rotate(-8deg) scale(0.95); }
            50% { transform: translate(60px, -5px) rotate(5deg) scale(1.05); }
            75% { transform: translate(20px, -25px) rotate(-5deg) scale(0.98); }
            100% { transform: translate(0, 0) rotate(5deg) scale(1); }
        }

        @keyframes k-butterfly-wings {
            0%, 100% { transform: scaleX(1); }
            50% { transform: scaleX(0.7); }
        }

        @keyframes k-bird-fly {
            0% { transform: translateX(-120px) translateY(0); }
            25% { transform: translateX(0px) translateY(-15px); }
            50% { transform: translateX(120px) translateY(5px); }
            75% { transform: translateX(240px) translateY(-10px); }
            100% { transform: translateX(360px) translateY(0); }
        }

        @keyframes k-sparkle {
            0%, 100% { opacity: 0; transform: scale(0) rotate(0deg); }
            50% { opacity: 1; transform: scale(1) rotate(180deg); }
        }

        @keyframes k-sway {
            0%, 100% { transform: rotate(-5deg); }
            50% { transform: rotate(5deg); }
        }

        @keyframes k-sway-flower {
            0%, 100% { transform: rotate(-8deg) scale(1); }
            50% { transform: rotate(8deg) scale(1.05); }
        }

        @keyframes k-hop {
            0%, 60%, 100% { transform: translateY(0) scaleY(1); }
            30% { transform: translateY(-15px) scaleY(0.95); }
        }

        @keyframes k-wave-hand {
            0%, 100% { transform: rotate(0deg); }
            25% { transform: rotate(20deg); }
            75% { transform: rotate(-10deg); }
        }

        @keyframes k-mascot-bounce {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-8px) scale(1.02); }
        }

        @keyframes k-speech-pop {
            0% { transform: scale(0); opacity: 0; }
            60% { transform: scale(1.1); opacity: 1; }
            100% { transform: scale(1); opacity: 1; }
        }

        @keyframes k-balloon-float {
            0% { transform: translateY(100vh) rotate(0deg); }
            100% { transform: translateY(-120px) rotate(15deg); }
        }

        @keyframes k-card-entrance {
            0% { transform: translateY(40px) scale(0.8); opacity: 0; }
            100% { transform: translateY(0) scale(1); opacity: 1; }
        }

        @keyframes k-confetti-burst {
            0% { transform: scale(0) rotate(0deg); opacity: 1; }
            100% { transform: scale(1.5) rotate(720deg); opacity: 0; }
        }

        @keyframes k-btn-press {
            0% { transform: translateY(0); }
            50% { transform: translateY(4px); }
            100% { transform: translateY(0); }
        }

        @keyframes k-ripple {
            0% { transform: scale(0); opacity: 0.6; }
            100% { transform: scale(4); opacity: 0; }
        }

        @keyframes k-trophy-bounce {
            0%, 100% { transform: translateY(0) rotate(-5deg); }
            25% { transform: translateY(-25px) rotate(5deg); }
            50% { transform: translateY(-8px) rotate(-3deg); }
            75% { transform: translateY(-15px) rotate(3deg); }
        }

        @keyframes k-gift-shake {
            0%, 100% { transform: rotate(0deg); }
            15% { transform: rotate(15deg); }
            30% { transform: rotate(-15deg); }
            45% { transform: rotate(10deg); }
            60% { transform: rotate(-10deg); }
            75% { transform: rotate(5deg); }
            90% { transform: rotate(-5deg); }
        }

        @keyframes k-star-pop {
            0% { transform: scale(0) rotate(0deg); opacity: 0; }
            50% { transform: scale(1.3) rotate(180deg); opacity: 1; }
            100% { transform: scale(1) rotate(360deg); opacity: 1; }
        }

        @keyframes k-coin-spin {
            0% { transform: rotateY(0deg); }
            100% { transform: rotateY(360deg); }
        }

        @keyframes k-bee-fly {
            0%, 100% { transform: translate(-50%, -50%) translateY(0) rotate(-5deg); }
            25% { transform: translate(-50%, -50%) translateY(-6px) rotate(3deg); }
            50% { transform: translate(-50%, -50%) translateY(-2px) rotate(-3deg); }
            75% { transform: translate(-50%, -50%) translateY(-8px) rotate(5deg); }
        }

        @keyframes k-bee-wings {
            0%, 100% { transform: scaleY(1); }
            50% { transform: scaleY(0.6); }
        }

        @keyframes k-pulse-ring-bee {
            0% { transform: translate(-50%, -50%) scale(0.6); opacity: 0.4; }
            50% { transform: translate(-50%, -50%) scale(1.2); opacity: 0.8; }
            100% { transform: translate(-50%, -50%) scale(0.6); opacity: 0.4; }
        }

        @keyframes k-target-wobble {
            0%, 100% { transform: rotate(0deg) scale(1); }
            25% { transform: rotate(-3deg) scale(1.02); }
            75% { transform: rotate(3deg) scale(0.98); }
        }

        @keyframes k-explode-particle {
            0% { transform: translate(0, 0) scale(1); opacity: 1; }
            100% { opacity: 0; }
        }

        @keyframes k-disco-flash {
            0%, 100% { opacity: 0.2; transform: scale(0.7) rotate(0deg); }
            50% { opacity: 1; transform: scale(1.3) rotate(15deg); }
        }

        @keyframes k-dance-1 {
            0% { transform: translateY(0) scale(1) rotate(-10deg); }
            100% { transform: translateY(-30px) scale(1.12) rotate(10deg); }
        }

        @keyframes k-dance-2 {
            0% { transform: translateY(0) scale(1) rotate(10deg); }
            100% { transform: translateY(-22px) scale(1.08) rotate(-10deg); }
        }

        @keyframes k-path-glow {
            0%, 100% { filter: drop-shadow(0 0 8px rgba(255, 217, 61, 0.4)); }
            50% { filter: drop-shadow(0 0 20px rgba(255, 217, 61, 0.8)); }
        }

        @keyframes shakeWrong {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-8px); }
            40%, 80% { transform: translateX(8px); }
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes bounce {
            from { transform: translateY(0); }
            to { transform: translateY(-15px); }
        }

        @keyframes pulseHelper {
            0% { transform: translate(-50%, -50%) scale(0.8); opacity: 0.5; }
            50% { transform: translate(-50%, -50%) scale(1.2); opacity: 1; }
            100% { transform: translate(-50%, -50%) scale(0.8); opacity: 0.5; }
        }

        @keyframes k-ladybug-crawl {
            0% { transform: translate(0, 0) rotate(0deg); }
            25% { transform: translate(8px, -5px) rotate(10deg); }
            50% { transform: translate(15px, 0) rotate(-5deg); }
            75% { transform: translate(8px, 5px) rotate(8deg); }
            100% { transform: translate(0, 0) rotate(0deg); }
        }

        @keyframes k-mushroom-grow {
            0%, 100% { transform: scaleY(1) scaleX(1); }
            50% { transform: scaleY(1.08) scaleX(0.96); }
        }

        @keyframes k-squirrel-tail {
            0%, 100% { transform: rotate(-5deg); }
            50% { transform: rotate(10deg); }
        }

        @keyframes k-reward-float-up {
            0% { transform: translateY(0) scale(1); opacity: 1; }
            100% { transform: translateY(-80px) scale(1.5); opacity: 0; }
        }

        /* ============================================ */
        /*  GLOBAL STYLES                               */
        /* ============================================ */

        .k-tracing-page * {
            box-sizing: border-box;
        }

        .k-tracing-page {
            font-family: var(--k-font-primary);
            -webkit-tap-highlight-color: transparent;
        }

        /* ============================================ */
        /*  3D BUTTON SYSTEM                            */
        /* ============================================ */

        .k-btn-3d {
            font-family: var(--k-font-primary);
            font-weight: 700;
            border: none;
            cursor: pointer;
            border-radius: var(--k-radius-md);
            padding: 14px 28px;
            font-size: 1.15rem;
            position: relative;
            overflow: hidden;
            transition: all 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            user-select: none;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.15);
            letter-spacing: 0.5px;
        }

        .k-btn-3d::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 5px;
            height: 5px;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            transform: scale(0);
            opacity: 0;
        }

        .k-btn-3d:active::after {
            animation: k-ripple 0.6s ease-out;
        }

        .k-btn-3d:hover {
            transform: translateY(-4px) scale(1.03);
            filter: brightness(1.08);
        }

        .k-btn-3d:active {
            transform: translateY(3px) scale(0.97);
        }

        .k-btn-pink {
            background: linear-gradient(135deg, #FF7EB3, var(--k-pink));
            color: white;
            border-bottom: 5px solid var(--k-pink-dark);
            box-shadow: 0 6px 20px rgba(255, 93, 162, 0.35);
        }

        .k-btn-pink:hover {
            box-shadow: 0 10px 30px rgba(255, 93, 162, 0.5);
        }

        .k-btn-yellow {
            background: linear-gradient(135deg, #FFE66D, var(--k-yellow));
            color: #5A4600;
            border-bottom: 5px solid var(--k-yellow-dark);
            box-shadow: 0 6px 20px rgba(255, 217, 61, 0.35);
        }

        .k-btn-green {
            background: linear-gradient(135deg, #85E89D, var(--k-green));
            color: white;
            border-bottom: 5px solid var(--k-green-dark);
            box-shadow: 0 6px 20px rgba(107, 203, 119, 0.35);
        }

        .k-btn-purple {
            background: linear-gradient(135deg, #B77FF7, var(--k-purple));
            color: white;
            border-bottom: 5px solid var(--k-purple-dark);
            box-shadow: 0 6px 20px rgba(155, 93, 229, 0.35);
        }

        .k-btn-orange {
            background: linear-gradient(135deg, #FFB74D, var(--k-orange));
            color: white;
            border-bottom: 5px solid var(--k-orange-dark);
            box-shadow: 0 6px 20px rgba(255, 159, 28, 0.35);
        }

        /* ============================================ */
        /*  GLASSMORPHISM CARDS                         */
        /* ============================================ */

        .k-glass {
            background: var(--k-glass-bg);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1.5px solid var(--k-glass-border);
            border-radius: var(--k-radius-lg);
            box-shadow: var(--k-shadow-soft);
        }

        /* ============================================ */
        /*  CATEGORY SELECTION — MAGICAL WORLD          */
        /* ============================================ */

        .k-magical-world {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: linear-gradient(180deg,
                #87CEEB 0%,
                #B8E6FF 25%,
                #D4F7DE 50%,
                #A8E6CF 70%,
                #6BCB77 90%,
                #4CAF50 100%
            );
            z-index: 9998;
            overflow-y: auto;
            overflow-x: hidden;
            font-family: var(--k-font-primary);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* — Smiling Sun — */
        .k-sun {
            position: absolute;
            top: 20px;
            right: 40px;
            z-index: 3;
            animation: k-sun-bob 4s ease-in-out infinite;
        }

        .k-sun-face {
            width: 90px;
            height: 90px;
            background: radial-gradient(circle, #FFF9C4 0%, #FFD93D 50%, #FFB300 100%);
            border-radius: 50%;
            position: relative;
            box-shadow: 0 0 40px rgba(255, 217, 61, 0.6), 0 0 80px rgba(255, 183, 0, 0.3);
        }

        .k-sun-face::before {
            content: '😊';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 2.8rem;
        }

        .k-sun-rays-ring {
            position: absolute;
            top: -15px;
            left: -15px;
            width: 120px;
            height: 120px;
            border: 4px dashed rgba(255, 183, 0, 0.4);
            border-radius: 50%;
            animation: k-sun-rays 20s linear infinite;
        }

        /* — Clouds — */
        .k-cloud {
            position: absolute;
            z-index: 2;
            pointer-events: none;
        }

        .k-cloud-shape {
            background: white;
            border-radius: 50px;
            position: relative;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
        }

        .k-cloud-shape::before,
        .k-cloud-shape::after {
            content: '';
            position: absolute;
            background: white;
            border-radius: 50%;
        }

        .k-cloud-1 .k-cloud-shape {
            width: 140px;
            height: 45px;
        }

        .k-cloud-1 .k-cloud-shape::before {
            width: 55px;
            height: 55px;
            top: -28px;
            left: 22px;
        }

        .k-cloud-1 .k-cloud-shape::after {
            width: 75px;
            height: 75px;
            top: -38px;
            right: 20px;
        }

        .k-cloud-2 .k-cloud-shape {
            width: 110px;
            height: 35px;
        }

        .k-cloud-2 .k-cloud-shape::before {
            width: 45px;
            height: 45px;
            top: -22px;
            left: 15px;
        }

        .k-cloud-2 .k-cloud-shape::after {
            width: 55px;
            height: 55px;
            top: -28px;
            right: 15px;
        }

        .k-cloud-3 .k-cloud-shape {
            width: 100px;
            height: 30px;
        }

        .k-cloud-3 .k-cloud-shape::before {
            width: 40px;
            height: 40px;
            top: -20px;
            left: 12px;
        }

        .k-cloud-3 .k-cloud-shape::after {
            width: 50px;
            height: 50px;
            top: -25px;
            right: 10px;
        }

        /* — Rainbow — */
        .k-rainbow {
            position: absolute;
            top: 60px;
            left: 50%;
            transform: translateX(-50%);
            width: 500px;
            height: 250px;
            border-radius: 250px 250px 0 0;
            opacity: 0.3;
            z-index: 1;
            background:
                radial-gradient(ellipse at bottom, transparent 55%,
                    #FF0000 56%, #FF0000 58%,
                    #FF7F00 59%, #FF7F00 61%,
                    #FFFF00 62%, #FFFF00 64%,
                    #00FF00 65%, #00FF00 67%,
                    #0000FF 68%, #0000FF 70%,
                    #4B0082 71%, #4B0082 73%,
                    #9400D3 74%, #9400D3 76%,
                    transparent 77%
                );
            animation: k-rainbow-shimmer 6s ease-in-out infinite;
            pointer-events: none;
        }

        /* — Sparkles — */
        .k-sparkle {
            position: absolute;
            font-size: 1.5rem;
            pointer-events: none;
            z-index: 4;
            animation: k-sparkle 3s ease-in-out infinite;
        }

        /* — Butterflies — */
        .k-butterfly {
            position: absolute;
            font-size: 2rem;
            z-index: 4;
            pointer-events: none;
            animation: k-butterfly-fly 8s ease-in-out infinite;
        }

        /* — Birds — */
        .k-bird {
            position: absolute;
            font-size: 1.6rem;
            z-index: 4;
            pointer-events: none;
            animation: k-bird-fly 12s linear infinite;
        }

        /* — Ground Decorations — */
        .k-ground-decor {
            position: absolute;
            z-index: 5;
            pointer-events: none;
        }

        .k-flower {
            animation: k-sway-flower 3s ease-in-out infinite;
            transform-origin: bottom center;
        }

        .k-mushroom {
            animation: k-mushroom-grow 4s ease-in-out infinite;
            transform-origin: bottom center;
        }

        .k-ladybug {
            animation: k-ladybug-crawl 6s ease-in-out infinite;
        }

        .k-bee-decor {
            animation: k-bee-fly 2s ease-in-out infinite;
        }

        .k-squirrel {
            animation: k-hop 3s ease-in-out infinite;
        }

        .k-rabbit {
            animation: k-hop 2.5s ease-in-out infinite 0.5s;
        }

        /* — Signboard — */
        .k-signboard {
            position: relative;
            z-index: 10;
            margin-top: 25px;
            text-align: center;
            animation: k-float-slow 5s ease-in-out infinite;
        }

        .k-signboard-inner {
            background: linear-gradient(145deg, #A76D36, #8D501D);
            border: 6px solid #5C330E;
            border-radius: var(--k-radius-xl);
            padding: 16px 44px;
            box-shadow: 0 12px 0 #3E1E03, 0 18px 30px rgba(0, 0, 0, 0.25);
            color: #FFF;
            display: inline-block;
            transform-origin: top center;
        }

        .k-signboard-title {
            font-family: var(--k-font-display);
            font-size: 2.6rem;
            font-weight: 800;
            text-shadow: 2px 2px 0 #3E1E03, 4px 4px 0 rgba(0, 0, 0, 0.12);
            line-height: 1.2;
        }

        .k-signboard-sub {
            font-size: 1.3rem;
            font-weight: 700;
            color: #FFEB3B;
            text-shadow: 1px 1px 0 #000;
            margin-top: 4px;
        }

        /* — Back Button (Category Screen) — */
        .k-back-btn-cat {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 20;
            width: 52px;
            height: 52px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            padding: 0;
            font-size: 0;
            border-bottom: 4px solid var(--k-yellow-dark);
            background: linear-gradient(135deg, #FFE66D, var(--k-yellow));
            color: #5A4600;
            box-shadow: 0 4px 15px rgba(255, 217, 61, 0.4);
            transition: all 0.2s ease;
        }

        .k-back-btn-cat:hover {
            transform: translateY(-3px) scale(1.08);
            box-shadow: 0 8px 25px rgba(255, 217, 61, 0.5);
        }

        .k-back-btn-cat:active {
            transform: translateY(2px) scale(0.96);
        }

        /* — Adventure Path Container — */
        .k-path-container {
            position: relative;
            width: 100%;
            max-width: 520px;
            min-height: 720px;
            margin: 20px auto 0;
            z-index: 8;
            flex-shrink: 0;
            padding: 20px 0;
        }

        /* — Candy Winding Path — */
        .k-candy-path {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        /* — 3D World Cards — */
        .k-world-card {
            position: absolute;
            z-index: 10;
            width: 155px;
            height: 170px;
            border-radius: 28px;
            border: 5px solid rgba(255, 255, 255, 0.9);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 4px;
            cursor: pointer;
            font-family: var(--k-font-primary);
            transition: all 0.25s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            overflow: hidden;
            user-select: none;
            text-align: center;
            animation: k-card-entrance 0.8s ease-out backwards;
        }

        .k-world-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(135deg, transparent 40%, rgba(255, 255, 255, 0.3) 50%, transparent 60%);
            animation: k-shine 4s ease-in-out infinite;
            pointer-events: none;
        }

        .k-world-card:hover {
            transform: translateY(-10px) scale(1.08) !important;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2) !important;
        }

        .k-world-card:active {
            transform: translateY(4px) scale(0.95) !important;
        }

        .k-world-card-icon {
            font-size: 3rem;
            line-height: 1;
            filter: drop-shadow(2px 3px 4px rgba(0, 0, 0, 0.2));
        }

        .k-world-card-letters {
            font-family: var(--k-font-display);
            font-size: 1.6rem;
            font-weight: 800;
            text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.15);
            line-height: 1.2;
        }

        .k-world-card-label {
            font-size: 0.85rem;
            font-weight: 600;
            opacity: 0.9;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .k-card-abc {
            background: linear-gradient(145deg, #FF7EB3 0%, #FF5DA2 50%, #E84393 100%);
            box-shadow: 0 10px 0 #C0366F, 0 14px 30px rgba(255, 93, 162, 0.3);
            color: white;
            animation-delay: 0.1s;
        }

        .k-card-abc:hover { animation: k-pulse-glow 2s ease-in-out infinite; }

        .k-card-numbers {
            background: linear-gradient(145deg, #FFE66D 0%, #FFD93D 50%, #FFC107 100%);
            box-shadow: 0 10px 0 #CC9B00, 0 14px 30px rgba(255, 217, 61, 0.3);
            color: #5A4600;
            animation-delay: 0.3s;
        }

        .k-card-hindi {
            background: linear-gradient(145deg, #B77FF7 0%, #9B5DE5 50%, #7C3AED 100%);
            box-shadow: 0 10px 0 #5B21B6, 0 14px 30px rgba(155, 93, 229, 0.3);
            color: white;
            animation-delay: 0.5s;
        }

        /* — Mascot — */
        .k-mascot {
            position: absolute;
            bottom: 40px;
            left: 20px;
            z-index: 12;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .k-mascot-body {
            font-size: 4.5rem;
            animation: k-mascot-bounce 3s ease-in-out infinite;
            filter: drop-shadow(0 8px 16px rgba(0, 0, 0, 0.15));
            cursor: default;
        }

        .k-mascot-wave {
            display: inline-block;
            animation: k-wave-hand 1.5s ease-in-out infinite;
            transform-origin: 70% 70%;
            font-size: 2rem;
            position: absolute;
            top: -5px;
            right: -15px;
        }

        .k-speech-bubble {
            background: white;
            border-radius: 20px;
            padding: 10px 16px;
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--k-purple);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            position: relative;
            margin-bottom: 8px;
            text-align: center;
            max-width: 160px;
            animation: k-speech-pop 0.6s ease-out backwards;
            animation-delay: 1s;
            line-height: 1.3;
        }

        .k-speech-bubble::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 0;
            border-left: 10px solid transparent;
            border-right: 10px solid transparent;
            border-top: 10px solid white;
        }

        /* — Rolling Hills — */
        .k-hills {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 200px;
            overflow: hidden;
            pointer-events: none;
            z-index: 6;
        }

        /* ============================================ */
        /*  TRACING BOARD SCREEN                        */
        /* ============================================ */

        .k-tracing-screen {
            width: 100%;
            font-family: var(--k-font-primary);
        }

        /* — Top Status Bar — */
        .k-status-bar {
            display: flex;
            justify-content: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 16px;
            padding: 0 8px;
        }

        .k-status-item {
            display: flex;
            align-items: center;
            gap: 6px;
            background: var(--k-glass-bg);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1.5px solid var(--k-glass-border);
            border-radius: 50px;
            padding: 6px 14px;
            font-weight: 700;
            font-size: 0.95rem;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.06);
            white-space: nowrap;
        }

        .k-status-icon {
            font-size: 1.15rem;
        }

        /* — Inner Header — */
        .k-inner-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            margin-bottom: 16px;
            gap: 12px;
            flex-wrap: wrap;
        }

        .k-inner-title {
            font-family: var(--k-font-display);
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--k-purple);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .k-level-badge {
            background: var(--k-glass-bg);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 2.5px solid var(--k-purple);
            border-radius: 50px;
            padding: 8px 18px;
            font-weight: 700;
            color: var(--k-purple);
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 1.1rem;
            box-shadow: 0 4px 0 rgba(155, 93, 229, 0.3);
        }

        /* — Canvas Area — */
        .k-canvas-area {
            position: relative;
            background: radial-gradient(ellipse at center, #FFFEF7 0%, #F3E8FF 40%, #E8F5E9 100%);
            border-radius: var(--k-radius-xl);
            border: 4px solid var(--k-purple);
            box-shadow: 0 10px 0 rgba(155, 93, 229, 0.25), 0 15px 40px rgba(155, 93, 229, 0.15);
            overflow: hidden;
            width: 600px;
            height: 600px;
            max-width: 100%;
        }

        /* Floating stars inside canvas */
        .k-canvas-area::before {
            content: '✨ ⭐ ✨';
            position: absolute;
            top: 12px;
            right: 12px;
            font-size: 0.9rem;
            opacity: 0.3;
            animation: k-sparkle 4s ease-in-out infinite;
            pointer-events: none;
            z-index: 1;
            letter-spacing: 4px;
        }

        .k-canvas-area::after {
            content: '⭐ ✨';
            position: absolute;
            bottom: 12px;
            left: 12px;
            font-size: 0.9rem;
            opacity: 0.2;
            animation: k-sparkle 5s ease-in-out infinite 1s;
            pointer-events: none;
            z-index: 1;
            letter-spacing: 4px;
        }

        @media (max-width: 768px) {
            .k-canvas-area {
                width: 100%;
                max-width: 460px;
                height: 460px;
            }
        }

        @media (max-width: 480px) {
            .k-canvas-area {
                max-width: 98vw;
                height: 90vw;
            }
        }

        /* — Canvas Background Letter — */
        .canvas-bg-letter {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 20rem;
            font-weight: 900;
            color: rgba(155, 93, 229, 0.06);
            user-select: none;
            pointer-events: none;
        }

        /* — Virtual Cursor — */
        #virtualCursor {
            pointer-events: none;
            display: none;
            z-index: 100;
            font-size: 2.5rem;
            line-height: 1;
            filter: drop-shadow(2px 2px 2px rgba(0, 0, 0, 0.3));
        }

        /* — Bee Helper (unused by current engine, kept for markup compatibility) — */
        #tracingHelperHand {
            position: absolute;
            pointer-events: none;
            z-index: 10;
            display: none;
            transform: translate(-50%, -50%);
            transition: opacity 0.3s ease;
        }

        .k-bee-helper {
            font-size: 2.4rem;
            filter: drop-shadow(2px 4px 5px rgba(0, 0, 0, 0.3));
            position: relative;
            z-index: 2;
            animation: k-bee-fly 2s ease-in-out infinite;
        }

        .k-bee-pulse-ring {
            position: absolute;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 3px solid var(--k-yellow);
            background: rgba(255, 217, 61, 0.25);
            top: 50%;
            left: 50%;
            animation: k-pulse-ring-bee 1.2s infinite;
            z-index: 1;
        }

        /* — Path Warning (unused by current engine, kept for markup compatibility) — */
        .k-path-warning {
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: linear-gradient(135deg, #FF6B6B, #FF5252);
            color: white;
            padding: 10px 24px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.15rem;
            border: 3px solid rgba(255, 255, 255, 0.6);
            box-shadow: 0 6px 20px rgba(255, 82, 82, 0.3);
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
            z-index: 80;
            white-space: nowrap;
            font-family: var(--k-font-primary);
        }

        /* — Success Overlay — */
        .k-success-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(ellipse at center, rgba(255, 255, 255, 0.98), rgba(232, 245, 233, 0.95));
            border-radius: var(--k-radius-xl);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.5s ease;
            z-index: 50;
            text-align: center;
            padding: 20px;
        }

        .k-success-trophy {
            font-size: 5.5rem;
            animation: k-trophy-bounce 1.5s ease-in-out infinite;
            filter: drop-shadow(0 8px 12px rgba(0, 0, 0, 0.12));
        }

        .k-success-title {
            font-family: var(--k-font-display);
            font-size: 2.4rem;
            background: linear-gradient(135deg, var(--k-green), #2E7D32);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 900;
            margin: 12px 0;
            text-shadow: none;
        }

        .k-success-text {
            font-size: 1.25rem;
            font-weight: 700;
            color: #555;
            max-width: 85%;
        }

        .k-success-rewards {
            display: flex;
            gap: 10px;
            margin-top: 16px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .k-reward-tag {
            background: var(--k-glass-bg);
            backdrop-filter: blur(8px);
            border: 2px solid var(--k-glass-border);
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 5px;
            animation: k-star-pop 0.5s ease-out backwards;
        }

        /* — Fail Overlay — */
        .k-fail-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(ellipse at center, rgba(255, 245, 245, 0.98), rgba(255, 235, 238, 0.95));
            border-radius: var(--k-radius-xl);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.4s ease;
            z-index: 50;
            text-align: center;
            padding: 20px;
        }

        .k-fail-emoji {
            font-size: 4.5rem;
            animation: k-float 2s ease-in-out infinite;
        }

        .k-fail-title {
            font-family: var(--k-font-display);
            font-size: 2.2rem;
            color: var(--k-pink);
            font-weight: 900;
            margin: 12px 0;
        }

        /* — Entertainment Clip Overlay — */
        .k-stage-curtain {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(ellipse at center, #FFF0F6 0%, #FFD6E8 50%, #FFBEE0 100%);
            border-radius: var(--k-radius-xl);
            display: none;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 55;
            text-align: center;
            overflow: hidden;
            font-family: var(--k-font-primary);
        }

        .k-dance-animal-1 {
            width: 130px;
            height: auto;
            animation: k-dance-1 1.2s ease-in-out infinite alternate;
            filter: drop-shadow(0 8px 12px rgba(0, 0, 0, 0.15));
        }

        .k-dance-animal-2 {
            width: 130px;
            height: auto;
            animation: k-dance-2 1.4s ease-in-out infinite alternate;
            filter: drop-shadow(0 8px 12px rgba(0, 0, 0, 0.15));
        }

        .k-disco-star {
            position: absolute;
            font-size: 2.2rem;
            animation: k-disco-flash 1s ease-in-out infinite alternate;
            pointer-events: none;
        }

        /* — Mini Game Overlay — */
        .k-mini-game {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(ellipse at center, #E8F5E9 0%, #C8E6C9 50%, #A5D6A7 100%);
            border-radius: var(--k-radius-xl);
            display: none;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 60;
            text-align: center;
            padding: 20px;
            font-family: var(--k-font-primary);
            overflow: hidden;
        }

        .k-shooter-targets {
            display: flex;
            gap: 15px;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            width: 100%;
            max-width: 580px;
            margin-top: 15px;
            margin-bottom: 25px;
            z-index: 10;
        }

        .shooter-target {
            position: relative;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: radial-gradient(circle, #FFFEF7 0%, #FFF9C4 50%, #FFE082 100%);
            border: 4px solid var(--k-orange);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
            color: #4E342E;
            font-weight: 900;
            cursor: pointer;
            box-shadow: 0 6px 0 #CC7A00, 0 10px 25px rgba(0, 0, 0, 0.15);
            transition: all 0.2s ease;
            user-select: none;
            animation: k-target-wobble 3s ease-in-out infinite;
        }

        .shooter-target::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 52px;
            height: 52px;
            border: 2px dashed rgba(255, 159, 28, 0.3);
            border-radius: 50%;
            transform: translate(-50%, -50%);
        }

        .shooter-target:hover {
            transform: translateY(-6px) scale(1.1);
            box-shadow: 0 12px 0 #CC7A00, 0 16px 30px rgba(0, 0, 0, 0.2);
        }

        .shooter-target:active {
            transform: translateY(3px);
            box-shadow: 0 3px 0 #CC7A00, 0 5px 10px rgba(0, 0, 0, 0.15);
        }

        .shooter-target:nth-child(even) {
            animation-delay: 0.5s;
        }

        .shooter-bullet {
            position: absolute;
            width: 18px;
            height: 18px;
            background: radial-gradient(circle, #FFEE58 0%, var(--k-orange) 100%);
            border: 2px solid #FFF;
            border-radius: 50%;
            box-shadow: 0 0 12px var(--k-orange), 0 0 24px var(--k-yellow);
            display: none;
            z-index: 25;
            pointer-events: none;
        }

        .wrong-shake {
            animation: shakeWrong 0.4s ease-in-out !important;
        }

        /* — Canvas Controls — */
        .k-canvas-controls {
            margin-top: 16px;
            width: 100%;
            max-width: 600px;
        }

        .k-next-btn {
            width: 100%;
            font-size: 1.5rem;
            font-family: var(--k-font-primary);
            font-weight: 700;
            background: linear-gradient(135deg, #85E89D, var(--k-green));
            color: white;
            border: none;
            border-bottom: 6px solid var(--k-green-dark);
            border-radius: var(--k-radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 16px 24px;
            cursor: pointer;
            box-shadow: 0 6px 25px rgba(107, 203, 119, 0.35);
            transition: all 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
        }

        .k-next-btn:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 10px 30px rgba(107, 203, 119, 0.5);
        }

        .k-next-btn:active {
            transform: translateY(3px) scale(0.98);
        }

        /* — Category Tabs (hidden by default) — */
        .category-tabs {
            display: none;
        }

        .category-tab-btn {
            font-family: var(--k-font-primary);
        }

        /* — Letter Bubble Buttons — */
        .letter-bubble-btn {
            width: 75px;
            height: 75px;
            border-radius: 50%;
            border: 4px solid #FFF !important;
            font-size: 2.1rem;
            font-weight: 900;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
            user-select: none;
            box-shadow: 0 6px 0 rgba(0, 0, 0, 0.15), inset 0 -4px 0 rgba(0, 0, 0, 0.2) !important;
            text-shadow: 2px 2px 0 rgba(0, 0, 0, 0.2);
        }

        .letter-bubble-btn:hover {
            transform: translateY(-8px) scale(1.18) rotate(4deg) !important;
            box-shadow: 0 14px 0 rgba(0, 0, 0, 0.1), inset 0 -4px 0 rgba(0, 0, 0, 0.2) !important;
        }

        .letter-bubble-btn:active {
            transform: translateY(3px) scale(0.94) !important;
            box-shadow: 0 3px 0 rgba(0, 0, 0, 0.15) !important;
        }

        /* — Instruction Banner — */
        .k-instruction-banner {
            display: none;
        }

        /* ============================================ */
        /*  RESPONSIVE DESIGN                           */
        /* ============================================ */

        @media (max-width: 768px) {
            .k-signboard-title {
                font-size: 2rem;
            }

            .k-signboard-inner {
                padding: 12px 28px;
            }

            .k-world-card {
                width: 130px;
                height: 148px;
                border-radius: 22px;
            }

            .k-world-card-icon {
                font-size: 2.5rem;
            }

            .k-world-card-letters {
                font-size: 1.3rem;
            }

            .k-mascot {
                bottom: 20px;
                left: 10px;
            }

            .k-mascot-body {
                font-size: 3.5rem;
            }

            .k-sun {
                right: 15px;
                top: 15px;
            }

            .k-sun-face {
                width: 65px;
                height: 65px;
            }

            .k-sun-face::before {
                font-size: 2rem;
            }

            .k-inner-title {
                font-size: 1.4rem;
            }

            .k-status-item {
                font-size: 0.82rem;
                padding: 5px 10px;
            }

            .k-rainbow {
                width: 350px;
                height: 175px;
            }
        }

        @media (max-width: 480px) {
            .k-signboard-title {
                font-size: 1.6rem;
            }

            .k-world-card {
                width: 115px;
                height: 130px;
                border-radius: 18px;
            }

            .k-world-card-icon {
                font-size: 2rem;
            }

            .k-world-card-letters {
                font-size: 1.1rem;
            }

            .k-world-card-label {
                font-size: 0.7rem;
            }

            .k-path-container {
                min-height: 600px;
            }

            .k-mascot-body {
                font-size: 3rem;
            }

            .k-speech-bubble {
                font-size: 0.75rem;
                padding: 8px 12px;
                max-width: 130px;
            }

            .k-inner-header {
                flex-direction: column;
                gap: 8px;
            }

            .k-status-bar {
                gap: 6px;
            }

            .k-rainbow {
                width: 280px;
                height: 140px;
            }
        }

        /* — Balloon float decorations — */
        .k-deco-balloon {
            position: absolute;
            z-index: 3;
            pointer-events: none;
            animation: k-balloon-float linear infinite;
        }

        /* ============================================ */
        /*  INNER CONTAINER COMPAT (from layout)        */
        /* ============================================ */
        .inner-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            margin-bottom: 20px;
            gap: 16px;
            flex-wrap: wrap;
        }

        .canvas-area {
            position: relative;
            background: radial-gradient(ellipse at center, #FFFEF7 0%, #F3E8FF 40%, #E8F5E9 100%);
            border-radius: var(--k-radius-xl);
            border: 4px solid var(--k-purple);
            box-shadow: 0 10px 0 rgba(155, 93, 229, 0.25), 0 15px 40px rgba(155, 93, 229, 0.15);
            overflow: hidden;
            width: 600px;
            height: 600px;
            max-width: 100%;
        }

        @media (max-width: 768px) {
            .canvas-area {
                width: 100%;
                max-width: 460px;
                height: 460px;
            }
        }

        @media (max-width: 480px) {
            .canvas-area {
                max-width: 98vw;
                height: 90vw;
            }
        }

        /* Override global app.css #tracingCanvas styles that conflict */
        #tracingCanvas {
            position: absolute !important;
            top: 0 !important;
            left: 0 !important;
            width: 100% !important;
            height: 100% !important;
            display: block !important;
            z-index: 2 !important;
            touch-action: none !important;
            cursor: crosshair;
        }

        /* Floating stars inside canvas */
        .canvas-area::before {
            content: '✨ ⭐ ✨';
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 0.85rem;
            opacity: 0.25;
            animation: k-sparkle 4s ease-in-out infinite;
            pointer-events: none;
            z-index: 1;
            letter-spacing: 3px;
        }

        .canvas-area::after {
            content: '⭐ ✨';
            position: absolute;
            bottom: 10px;
            left: 10px;
            font-size: 0.85rem;
            opacity: 0.18;
            animation: k-sparkle 5s ease-in-out infinite 1s;
            pointer-events: none;
            z-index: 1;
            letter-spacing: 3px;
        }
    </style>

    <!-- ======================================================== -->
    <!--  CATEGORY SELECTION SCREEN — MAGICAL WORLD               -->
    <!-- ======================================================== -->
    <div id="categorySelectionScreen" class="k-magical-world" style="display: none;">

        <!-- Rainbow -->
        <div class="k-rainbow"></div>

        <!-- Smiling Sun -->
        <div class="k-sun">
            <div class="k-sun-rays-ring"></div>
            <div class="k-sun-face"></div>
        </div>

        <!-- Floating Clouds -->
        <div class="k-cloud k-cloud-1" style="top: 10%; left: 5%; animation: k-cloud-drift 28s linear infinite alternate;">
            <div class="k-cloud-shape"></div>
        </div>
        <div class="k-cloud k-cloud-2" style="top: 18%; right: 8%; animation: k-cloud-drift-reverse 32s linear infinite alternate;">
            <div class="k-cloud-shape"></div>
        </div>
        <div class="k-cloud k-cloud-3" style="top: 28%; left: 15%; opacity: 0.6; animation: k-cloud-drift 24s linear infinite alternate;">
            <div class="k-cloud-shape"></div>
        </div>

        <!-- Butterflies -->
        <div class="k-butterfly" style="top: 15%; left: 12%; animation-duration: 9s;">🦋</div>
        <div class="k-butterfly" style="top: 25%; right: 15%; animation-duration: 11s; animation-delay: 2s; font-size: 1.6rem;">🦋</div>
        <div class="k-butterfly" style="top: 35%; left: 60%; animation-duration: 7s; animation-delay: 4s;">🦋</div>

        <!-- Birds -->
        <div class="k-bird" style="top: 12%; left: -50px; animation-duration: 14s;">🐦</div>
        <div class="k-bird" style="top: 22%; left: -80px; animation-duration: 18s; animation-delay: 5s; font-size: 1.3rem;">🐦</div>

        <!-- Sparkles -->
        <div class="k-sparkle" style="top: 8%; left: 30%; animation-delay: 0s;">✨</div>
        <div class="k-sparkle" style="top: 20%; right: 25%; animation-delay: 1s;">✨</div>
        <div class="k-sparkle" style="top: 35%; left: 45%; animation-delay: 2s; font-size: 1.2rem;">⭐</div>
        <div class="k-sparkle" style="top: 15%; left: 70%; animation-delay: 0.5s;">✨</div>
        <div class="k-sparkle" style="top: 42%; right: 10%; animation-delay: 1.5s; font-size: 1.8rem;">🌟</div>

        <!-- Decorative Balloons -->
        <div class="k-deco-balloon" style="left: 3%; bottom: 0; font-size: 3rem; animation-duration: 20s;">🎈</div>
        <div class="k-deco-balloon" style="right: 5%; bottom: 0; font-size: 2.5rem; animation-duration: 25s; animation-delay: 3s;">🎈</div>
        <div class="k-deco-balloon" style="left: 85%; bottom: 0; font-size: 2rem; animation-duration: 18s; animation-delay: 7s;">🎈</div>

        <!-- Back to Dashboard -->
        <a href="{{ route('dashboard') }}" class="k-back-btn-cat" title="Back to Home">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
        </a>

        <!-- Wooden Signboard -->
        <div class="k-signboard">
            <div class="k-signboard-inner">
                <div class="k-signboard-title">Let's Write! ✍️</div>
                <div class="k-signboard-sub">चलो लिखना सीखें! ✏️</div>
            </div>
        </div>

        <!-- Adventure Path Container -->
        <div class="k-path-container">
            <!-- Candy Winding Road SVG -->
            <svg class="k-candy-path" viewBox="0 0 500 720" preserveAspectRatio="none">
                <!-- Ground glow -->
                <path d="M 250,660 Q 90,480 250,340 T 250,80" fill="none" stroke="rgba(255,217,61,0.15)" stroke-width="85" stroke-linecap="round"/>
                <!-- Road outer -->
                <path d="M 250,660 Q 90,480 250,340 T 250,80" fill="none" stroke="#E8B84B" stroke-width="62" stroke-linecap="round"/>
                <!-- Road inner -->
                <path d="M 250,660 Q 90,480 250,340 T 250,80" fill="none" stroke="#FFD93D" stroke-width="52" stroke-linecap="round"/>
                <!-- Road highlight -->
                <path d="M 250,660 Q 90,480 250,340 T 250,80" fill="none" stroke="#FFE88A" stroke-width="38" stroke-linecap="round" opacity="0.5"/>
                <!-- Dashed center line -->
                <path d="M 250,660 Q 90,480 250,340 T 250,80" fill="none" stroke="#FFF" stroke-width="4" stroke-dasharray="14,16" stroke-linecap="round"/>
            </svg>

            <!-- Ground Decorations: Flowers -->
            <div class="k-ground-decor k-flower" style="bottom: 22%; left: 5%; font-size: 2.4rem;">🌸</div>
            <div class="k-ground-decor k-flower" style="bottom: 55%; right: 5%; font-size: 2.2rem; animation-delay: 0.5s;">🌻</div>
            <div class="k-ground-decor k-flower" style="bottom: 10%; right: 15%; font-size: 2rem; animation-delay: 1s;">🌷</div>
            <div class="k-ground-decor k-flower" style="bottom: 75%; left: 12%; font-size: 2.3rem; animation-delay: 0.3s;">🌼</div>
            <div class="k-ground-decor k-flower" style="bottom: 38%; right: 18%; font-size: 2.1rem; animation-delay: 0.7s;">🌹</div>

            <!-- Ground Decorations: Mushrooms, Ladybugs, Bees -->
            <div class="k-ground-decor k-mushroom" style="bottom: 5%; left: 18%; font-size: 1.8rem;">🍄</div>
            <div class="k-ground-decor k-mushroom" style="bottom: 48%; left: 2%; font-size: 1.6rem; animation-delay: 1.5s;">🍄</div>
            <div class="k-ground-decor k-ladybug" style="bottom: 15%; left: 30%; font-size: 1.4rem;">🐞</div>
            <div class="k-ground-decor k-bee-decor" style="bottom: 60%; right: 22%; font-size: 1.5rem;">🐝</div>
            <div class="k-ground-decor k-squirrel" style="bottom: 70%; right: 2%; font-size: 2rem;">🐿️</div>
            <div class="k-ground-decor k-rabbit" style="bottom: 2%; right: 5%; font-size: 2rem;">🐇</div>

            <!-- Step 1: ABC LAND -->
            <button onclick="selectCategoryFromPath('english')" class="k-world-card k-card-abc" style="bottom: 6%; left: 50%; transform: translateX(-50%);">
                <div class="k-world-card-icon">🏰</div>
                <div class="k-world-card-letters">A B C</div>
                <div class="k-world-card-label">Tap To Play</div>
            </button>

            <!-- Step 2: NUMBER TRAIN -->
            <button onclick="selectCategoryFromPath('numbers')" class="k-world-card k-card-numbers" style="bottom: 38%; left: 10%;">
                <div class="k-world-card-icon">🚂</div>
                <div class="k-world-card-letters">1 2 3</div>
                <div class="k-world-card-label">Tap To Play</div>
            </button>

            <!-- Step 3: HINDI KINGDOM -->
            <button onclick="selectCategoryFromPath('hindi')" class="k-world-card k-card-hindi" style="bottom: 66%; right: 10%;">
                <div class="k-world-card-icon">🛕</div>
                <div class="k-world-card-letters">क ख ग</div>
                <div class="k-world-card-label">Tap To Play</div>
            </button>
        </div>

        <!-- Rolling Hills at Bottom -->
        <div class="k-hills">
            <svg viewBox="0 0 1000 200" preserveAspectRatio="none" style="width: 100%; height: 100%; position: absolute; bottom: 0; left: 0;">
                <path d="M 0,140 Q 250,70 500,130 T 1000,100 L 1000,200 L 0,200 Z" fill="#81C784" opacity="0.7"/>
                <path d="M 0,165 Q 350,95 700,150 T 1000,130 L 1000,200 L 0,200 Z" fill="#66BB6A"/>
            </svg>
        </div>

        <!-- Mascot: Panda -->
        <div class="k-mascot">
            <div class="k-speech-bubble">
                Hi Friend! 👋<br>Let's Learn Together!
            </div>
            <div style="position: relative; display: inline-block;">
                <div class="k-mascot-body">🐼</div>
                <div class="k-mascot-wave">👋</div>
            </div>
        </div>

        <!-- Animal Decors -->
        <img src="{{ asset('images/backgrounds/3d_giraffe.png') }}" style="position: absolute; bottom: 60px; right: 3%; width: 120px; z-index: 7; pointer-events: none; animation: k-float-slow 5s ease-in-out infinite;" alt="Giraffe Decor">
        <img src="{{ asset('images/backgrounds/3d_elephant.png') }}" style="position: absolute; bottom: 45px; right: 22%; width: 100px; z-index: 7; pointer-events: none; animation: k-float-slow 6s ease-in-out infinite 1s;" alt="Elephant Decor">
    </div>

    <!-- ======================================================== -->
    <!--  TRACING BOARD CANVAS SCREEN                              -->
    <!-- ======================================================== -->
    <div id="tracingBoardScreen" class="k-tracing-screen" style="display: none; width: 100%;">
        <div class="inner-container">

            <!-- Top Status Bar -->
            <div class="k-status-bar">
                <div class="k-status-item">
                    <span class="k-status-icon">❤️</span>
                    <span>5</span>
                </div>
                <div class="k-status-item">
                    <span class="k-status-icon">⭐</span>
                    <span id="starCount">0</span>
                </div>
                <div class="k-status-item">
                    <span class="k-status-icon">💰</span>
                    <span id="coinCount">0</span>
                </div>
                <div class="k-status-item">
                    <span class="k-status-icon">🏆</span>
                    <span>XP <span id="xpCount">0</span></span>
                </div>
                <div class="k-status-item" style="border-color: var(--k-purple); background: rgba(155, 93, 229, 0.1);">
                    <span class="k-status-icon">🎖️</span>
                    <span style="color: var(--k-purple); font-weight: 800;">Level <span id="levelDisplay">{{ $activeChild ? $activeChild->level : 1 }}</span></span>
                </div>
            </div>

            <!-- Inner Header -->
            <div class="k-inner-header inner-header">
                <!-- Left Side: Back Button & Title -->
                <div style="display: flex; align-items: center; gap: 14px;">
                    <button onclick="goBackToCategoryScreen()" class="k-btn-3d k-btn-yellow"
                        style="padding: 0; width: 46px; height: 46px; border-radius: 50%; display: flex; align-items: center; justify-content: center; min-width: 46px; font-size: 1.3rem;">
                        ⬅️
                    </button>
                    <h1 class="k-inner-title inner-title" style="margin: 0;">
                        <span>✍️ Let's Write!</span>
                    </h1>
                </div>

                <!-- Right Side: Level Indicator -->
                <div style="display: flex; align-items: center;">
                    <div class="k-level-badge">
                        🏆 Level <span id="levelDisplay2">{{ $activeChild ? $activeChild->level : 1 }}</span>
                    </div>
                </div>
            </div>

            <!-- Category Tabs (Hidden) -->
            <div class="category-tabs" style="display: none;">
                <button onclick="setCategory('english')" id="tab-english" class="btn-3d btn-pink category-tab-btn">
                    🔤 English (A-Z)
                </button>
                <button onclick="setCategory('numbers')" id="tab-numbers" class="btn-3d btn-yellow category-tab-btn">
                    🔢 Numbers (1-50)
                </button>
                <button onclick="setCategory('hindi')" id="tab-hindi" class="btn-3d btn-yellow category-tab-btn">
                    🕉️ Hindi (क-ज्ञ)
                </button>
            </div>

            <div class="tracing-board-wrapper">
                <!-- Instruction Banner -->
                <div id="instructionBanner" class="k-instruction-banner" style="display: none;"></div>

                <!-- Canvas Area -->
                <div class="canvas-area">
                    <canvas id="tracingCanvas"
                        style="display: block; width: 100%; height: 100%; z-index: 2; position: relative;"></canvas>

                    <!-- Bee Helper (not used by the fill-by-tracing engine; kept for markup compatibility) -->
                    <div id="tracingHelperHand">
                        <div class="k-bee-pulse-ring"></div>
                        <span class="k-bee-helper">🐝</span>
                    </div>

                    <!-- Virtual Cursor -->
                    <div id="virtualCursor">☝️</div>

                    <!-- Path Deviation Warning (not used by the fill-by-tracing engine; kept for markup compatibility) -->
                    <div id="pathWarning" class="k-path-warning">
                        ⚠️ Stay on the line! ✏️
                    </div>

                    <!-- ===== Success Overlay ===== -->
                    <div id="successOverlay" class="k-success-overlay">
                        <div style="font-size: 3rem; margin-bottom: 5px; animation: k-confetti-burst 1s ease-out;">🎉🎈🌈</div>
                        <div class="k-success-trophy">🏆</div>
                        <h2 class="k-success-title">LEVEL UP!</h2>
                        <p id="successText" class="k-success-text">Fantastic Writing! You reached Level 2!</p>
                        <div class="k-success-rewards">
                            <div class="k-reward-tag" style="animation-delay: 0.2s;">⭐ +20 Stars</div>
                            <div class="k-reward-tag" style="animation-delay: 0.4s;">💰 +5 Coins</div>
                            <div class="k-reward-tag" style="animation-delay: 0.6s;">🎁 Gift!</div>
                        </div>
                        <div style="margin-top: 12px; font-size: 3rem; animation: k-gift-shake 1.5s ease-in-out infinite; animation-delay: 1s;">🎁</div>
                    </div>

                    <!-- ===== Fail Overlay ===== -->
                    <div id="failOverlay" class="k-fail-overlay">
                        <div class="k-fail-emoji">😢</div>
                        <h2 class="k-fail-title">Try Again!</h2>
                        <p style="font-size: 1.15rem; font-weight: 700; color: #666; max-width: 80%;">
                            Oh, you missed some spots! Fill in a bit more to level up!
                        </p>
                        <button onclick="hideFailOverlay()" class="k-btn-3d k-btn-pink" style="margin-top: 15px; font-size: 1.1rem; padding: 10px 24px;">
                            🔄 Try Again
                        </button>
                    </div>

                    <!-- ===== Entertainment Clip Overlay ===== -->
                    <div id="entertainmentClipOverlay" class="k-stage-curtain">
                        <!-- Rainbow Background -->
                        <img src="{{ asset('images/backgrounds/3d_rainbow.png') }}"
                            style="position: absolute; top: -10%; opacity: 0.3; width: 120%; height: auto; pointer-events: none;"
                            alt="Rainbow Backstage">

                        <h2 style="font-family: var(--k-font-display); font-size: 2.3rem; background: linear-gradient(135deg, var(--k-purple), var(--k-pink)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; font-weight: 900; margin: 10px 0; z-index: 2;">
                            🎉 Dancing Party! You Did It! 🏆
                        </h2>
                        <p style="font-size: 1.2rem; font-weight: 700; color: #555; margin-bottom: 20px; z-index: 2;">
                            Fantastic tracing! Enjoy the dance! 🐘🦁
                        </p>

                        <!-- Dancing Characters -->
                        <div style="display: flex; gap: 40px; align-items: flex-end; justify-content: center; margin-bottom: 25px; height: 170px; z-index: 2; position: relative;">
                            <img src="{{ asset('images/backgrounds/3d_elephant.png') }}" class="k-dance-animal-1" alt="Dancing Elephant">
                            <img src="{{ asset('images/backgrounds/3d_lion.png') }}" class="k-dance-animal-2" alt="Dancing Lion">
                        </div>

                        <!-- Disco Stars -->
                        <span class="k-disco-star" style="top: 12%; left: 10%; animation-delay: 0s; color: var(--k-yellow);">⭐</span>
                        <span class="k-disco-star" style="top: 22%; right: 12%; animation-delay: 0.3s; color: var(--k-pink);">✨</span>
                        <span class="k-disco-star" style="bottom: 18%; left: 12%; animation-delay: 0.5s; color: var(--k-primary);">🌟</span>
                        <span class="k-disco-star" style="bottom: 25%; right: 10%; animation-delay: 0.8s; color: var(--k-green);">⭐</span>

                        <!-- Skip Button -->
                        <button onclick="skipEntertainmentClip()" class="k-btn-3d k-btn-pink"
                            style="font-size: 1.15rem; padding: 12px 30px; z-index: 2; display: inline-flex; align-items: center; gap: 8px;">
                            Skip to Game ➡️
                        </button>
                    </div>

                    <!-- ===== Mini Game Overlay ===== -->
                    <div id="miniGameOverlay" class="k-mini-game">

                        <!-- Fired Projectile Bullet -->
                        <div id="shooterBullet" class="shooter-bullet"></div>

                        <h2 id="miniGameTitle"
                            style="font-family: var(--k-font-display); font-size: 2.2rem; background: linear-gradient(135deg, var(--k-green-dark), #1B5E20); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; font-weight: 900; margin: 0 0 8px 0;">
                            🎯 Target Shooter! 🎯
                        </h2>
                        <p id="miniGameSubtitle"
                            style="font-size: 1.2rem; font-weight: 700; color: #2E7D32; margin-bottom: 16px;">
                            Shoot the target with letter <span id="miniGameTargetLetter"
                                style="font-size: 2.2rem; color: var(--k-red); font-weight: 900; background: white; padding: 2px 14px; border-radius: 12px; border: 2.5px solid var(--k-green); margin-left: 5px; display: inline-block;">A</span>
                            to unlock the next!
                        </p>

                        <!-- Targets Container -->
                        <div id="miniGameBalloonGrid" class="k-shooter-targets shooter-target-container">
                            <!-- Populated by JS -->
                        </div>

                        <!-- Shooter Boy and Blaster -->
                        <div id="shooterBoy"
                            style="position: absolute; bottom: 15px; left: 25px; font-size: 4.8rem; z-index: 15; transition: transform 0.25s ease; user-select: none; pointer-events: none;">
                            👦<span id="shooterBlaster"
                                style="position: absolute; right: -25px; bottom: 8px; font-size: 3.5rem; transform: rotate(-25deg); display: inline-block; transform-origin: 20% 70%; transition: transform 0.25s ease;">🔫</span>
                        </div>

                        <!-- Skip & Feedback -->
                        <div style="display: flex; flex-direction: column; align-items: center; gap: 10px; width: 100%; margin-left: 120px; z-index: 10;">
                            <div id="miniGameFeedback"
                                style="font-size: 1.3rem; font-weight: 800; min-height: 35px; transition: all 0.2s ease;"></div>
                            <button onclick="skipMiniGame()" class="k-btn-3d k-btn-yellow"
                                style="font-size: 1.1rem; padding: 10px 28px; display: inline-flex; align-items: center; gap: 8px;">
                                Skip Game ➡️
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Tracing Controls -->
                <div class="canvas-controls k-canvas-controls">
                    <button onclick="submitTracing()" class="k-next-btn">
                        <span>Next</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div> <!-- End of tracingBoardScreen -->

    <!-- ======================================================== -->
    <!--  JAVASCRIPT — FILL-BY-TRACING ENGINE                       -->
    <!--  (mask-based drag-to-reveal + coverage %, same logic as   -->
    <!--   the standalone tracing prototype — no strict path       -->
    <!--   deviation checks, no per-letter stroke coordinate data) -->
    <!-- ======================================================== -->
    <script>
        const categorySequences = {
            english: ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'],
            numbers: Array.from({length: 100}, (_, i) => (i + 1).toString()),
            hindi: ['क', 'ख', 'ग', 'घ', 'ङ', 'च', 'छ', 'ज', 'झ', 'ञ', 'ट', 'ठ', 'ड', 'ढ', 'ण', 'त', 'थ', 'द', 'ध', 'न', 'प', 'फ', 'ब', 'भ', 'म', 'य', 'र', 'ल', 'व', 'श', 'ष', 'स', 'ह', 'क्ष', 'त्र', 'ज्ञ']
        };

        const hindiPhonics = {
            'क': 'Ka', 'ख': 'Kha', 'ग': 'Ga', 'घ': 'Gha', 'ङ': 'Nga',
            'च': 'Cha', 'छ': 'Chha', 'ज': 'Ja', 'झ': 'Jha', 'ञ': 'Nya',
            'ट': 'Ta', 'ठ': 'Tha', 'ड': 'Da', 'ढ': 'Dha', 'ण': 'Na',
            'त': 'Ta', 'थ': 'Tha', 'द': 'Da', 'ध': 'Dha', 'न': 'Na',
            'प': 'Pa', 'फ': 'Pha', 'ब': 'Ba', 'भ': 'Bha', 'म': 'Ma',
            'य': 'Ya', 'र': 'Ra', 'ल': 'La', 'व': 'Va',
            'श': 'Sha', 'ष': 'Sha', 'स': 'Sa', 'ह': 'Ha',
            'क्ष': 'Ksha', 'त्र': 'Tra', 'ज्ञ': 'Gya'
        };

        let currentSessionLevel = {{ $activeChild ? $activeChild->level : 1 }};
        let currentCategory = 'english';
        let currentCategoryList = categorySequences[currentCategory];
        let currentLetterIdx = 0;
        let currentLetter = currentCategoryList[currentLetterIdx];

        const canvas = document.getElementById('tracingCanvas');
        const ctx = canvas.getContext('2d');

        // ---- Fill-by-tracing engine ----
        // The letter itself (rendered with the canvas font) IS the mask. Wherever
        // the child drags a finger, color reveals — but only inside the letter's
        // shape, so it always looks right no matter how they trace. No "stay on
        // the line" cancellations, no per-letter stroke coordinate data — just
        // drag generally over the letter until enough of it is filled.
        const THEME_COLORS = ["#FF5DA2", "#4FC3F7", "#FFD93D", "#9B5DE5", "#FF9F1C", "#6BCB77"];
        const COMPLETE_THRESHOLD = 98; // % of the letter that must be filled to complete it
        const BRUSH_WIDTH_RATIO = 0.16;

        let isDrawing = false;
        let lastPoint = null;
        let isCelebrated = false;
        let maskCanvas = null;   // solid letter shape — clips the trail + is sampled for coverage
        let trailCanvas = null;  // raw finger-drag paint, persists across strokes for this letter
        let revealCanvas = null; // trailCanvas clipped to maskCanvas — what's shown + measured
        let targetPoints = [];   // sampled (x, y) points inside the letter, for coverage %

        function currentThemeColor() {
            const idx = currentCategoryList.indexOf(currentLetter);
            return THEME_COLORS[(idx < 0 ? 0 : idx) % THEME_COLORS.length];
        }

        function letterFontSize() {
            let fontSize = canvas.height * 0.72;
            if (currentCategory === 'hindi') fontSize = canvas.height * 0.58;
            if (currentCategory === 'numbers' && currentLetter.length > 1) fontSize = canvas.height * 0.52;
            return fontSize;
        }

        function letterYOffset() {
            return currentCategory === 'hindi' ? 0.435 : 0.495;
        }

        function buildLetterMask(glyph) {
            const off = document.createElement('canvas');
            off.width = canvas.width;
            off.height = canvas.height;
            const octx = off.getContext('2d');
            octx.clearRect(0, 0, off.width, off.height);
            octx.fillStyle = '#000';
            octx.textAlign = 'center';
            octx.textBaseline = 'middle';
            octx.font = `900 ${letterFontSize()}px "Fredoka", "Noto Sans Devanagari", "Nirmala UI", sans-serif`;
            octx.fillText(glyph, off.width / 2, off.height * letterYOffset());
            return off;
        }

        function sampleMaskPoints(mc) {
            const mctx = mc.getContext('2d');
            const data = mctx.getImageData(0, 0, mc.width, mc.height).data;
            const points = [];
            const step = 4; // sample every 4px for performance
            for (let y = 0; y < mc.height; y += step) {
                for (let x = 0; x < mc.width; x += step) {
                    const idx = (y * mc.width + x) * 4 + 3;
                    if (data[idx] > 120) points.push(x, y);
                }
            }
            return points;
        }

        function composeReveal() {
            if (!revealCanvas) revealCanvas = document.createElement('canvas');
            revealCanvas.width = canvas.width;
            revealCanvas.height = canvas.height;
            const rctx = revealCanvas.getContext('2d');
            rctx.drawImage(trailCanvas, 0, 0);
            rctx.globalCompositeOperation = 'destination-in';
            rctx.drawImage(maskCanvas, 0, 0);
            rctx.globalCompositeOperation = 'source-over';
        }

        function paintTrailSegment(a, b) {
            if (!trailCanvas) return;
            const tctx = trailCanvas.getContext('2d');
            tctx.lineCap = 'round';
            tctx.lineJoin = 'round';
            tctx.lineWidth = Math.max(18, canvas.width * BRUSH_WIDTH_RATIO);
            tctx.strokeStyle = currentThemeColor();
            tctx.beginPath();
            tctx.moveTo(a.x, a.y);
            tctx.lineTo(b.x, b.y);
            tctx.stroke();
        }

        // IMPORTANT: coverage is sampled from revealCanvas (trail clipped to the
        // mask), never from the visible ctx — the faint background letter fill
        // on the main canvas would otherwise register as "already covered".
        function checkCoverage() {
            if (targetPoints.length === 0 || !revealCanvas) return 0;
            const imgData = revealCanvas.getContext('2d').getImageData(0, 0, canvas.width, canvas.height).data;
            let covered = 0;
            const total = targetPoints.length / 2;
            for (let i = 0; i < targetPoints.length; i += 2) {
                const x = targetPoints[i], y = targetPoints[i + 1];
                const idx = (y * canvas.width + x) * 4 + 3;
                if (imgData[idx] > 10) covered++;
            }
            return Math.min(100, Math.round((covered / total) * 100));
        }

        function redrawCanvas() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            // Faint background letter + dotted trace guide
            ctx.save();
            ctx.font = `900 ${letterFontSize()}px "Fredoka", "Noto Sans Devanagari", "Nirmala UI", sans-serif`;
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';
            const yOff = canvas.height * letterYOffset();
            ctx.fillStyle = 'rgba(155, 93, 229, 0.08)';
            ctx.fillText(currentLetter, canvas.width / 2, yOff);
            ctx.setLineDash([canvas.width * 0.02, canvas.width * 0.028]);
            ctx.lineWidth = Math.max(2, canvas.width * 0.012);
            ctx.strokeStyle = 'rgba(155, 93, 229, 0.55)';
            ctx.strokeText(currentLetter, canvas.width / 2, yOff);
            ctx.setLineDash([]);

            if (currentCategory === 'hindi' && hindiPhonics[currentLetter]) {
                ctx.font = `bold ${canvas.height * 0.085}px "Fredoka", sans-serif`;
                ctx.fillStyle = 'rgba(155, 93, 229, 0.22)';
                ctx.fillText(`(${hindiPhonics[currentLetter]})`, canvas.width / 2, canvas.height * 0.78);
            }
            ctx.restore();

            // Revealed color, clipped to the letter's own shape
            if (trailCanvas && maskCanvas) {
                composeReveal();
                ctx.drawImage(revealCanvas, 0, 0);
            }
        }

        function loadCurrentLetter() {
            maskCanvas = buildLetterMask(currentLetter);
            targetPoints = sampleMaskPoints(maskCanvas);
            trailCanvas = document.createElement('canvas');
            trailCanvas.width = canvas.width;
            trailCanvas.height = canvas.height;
            isCelebrated = false;
            redrawCanvas();
            speakCurrentLetter();
        }

        function speakCurrentLetter() {
            const label = (currentCategory === 'hindi' && hindiPhonics[currentLetter])
                ? `${currentLetter}, ${hindiPhonics[currentLetter]}`
                : currentLetter;
            if (window.SoundFX && typeof window.SoundFX.speak === 'function') {
                window.SoundFX.speak(label, currentCategory === 'hindi' ? 'hi-IN' : 'en-US');
            } else if ('speechSynthesis' in window) {
                window.speechSynthesis.cancel();
                const u = new SpeechSynthesisUtterance(label);
                u.rate = 0.85;
                u.pitch = 1.15;
                window.speechSynthesis.speak(u);
            }
        }

        function playChimeSound() {
            try {
                const audioCtx = new (window.AudioContext || window.webkitAudioContext)();
                const osc = audioCtx.createOscillator();
                const gain = audioCtx.createGain();
                osc.connect(gain);
                gain.connect(audioCtx.destination);
                osc.type = 'sine';
                osc.frequency.setValueAtTime(523.25, audioCtx.currentTime);
                osc.frequency.setValueAtTime(659.25, audioCtx.currentTime + 0.15);
                osc.frequency.setValueAtTime(783.99, audioCtx.currentTime + 0.3);
                osc.frequency.setValueAtTime(1046.50, audioCtx.currentTime + 0.45);
                gain.gain.setValueAtTime(0.15, audioCtx.currentTime);
                gain.gain.exponentialRampToValueAtTime(0.01, audioCtx.currentTime + 0.85);
                osc.start(audioCtx.currentTime);
                osc.stop(audioCtx.currentTime + 0.85);
            } catch (e) { /* audio unavailable, fail silently */ }
        }

        function getPos(evt) {
            const rect = canvas.getBoundingClientRect();
            const touch = evt.touches ? evt.touches[0] : evt;
            // Scale from CSS display-pixels to canvas internal-resolution pixels
            const scaleX = canvas.width  / rect.width;
            const scaleY = canvas.height / rect.height;
            return {
                x: (touch.clientX - rect.left) * scaleX,
                y: (touch.clientY - rect.top)  * scaleY
            };
        }

        function startStroke(evt) {
            if (isCelebrated) return;
            evt.preventDefault();
            isDrawing = true;
            const p = getPos(evt);
            lastPoint = p;
            paintTrailSegment(p, p);
            redrawCanvas();
            evaluateProgress();
        }

        function moveStroke(evt) {
            if (!isDrawing || isCelebrated) return;
            evt.preventDefault();
            const p = getPos(evt);
            paintTrailSegment(lastPoint, p);
            lastPoint = p;
            redrawCanvas();
            evaluateProgress();
        }

        function endStroke() {
            isDrawing = false;
        }

        function evaluateProgress() {
            const pct = checkCoverage();
            if (pct >= COMPLETE_THRESHOLD && !isCelebrated) {
                isCelebrated = true;
                playChimeSound();
                triggerSuccess();
            }
        }

        function showScreen(screenId) {
            const screens = ['categorySelectionScreen', 'tracingBoardScreen'];
            screens.forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    if (id === screenId) {
                        el.style.display = (id === 'categorySelectionScreen') ? 'flex' : 'block';
                    } else {
                        el.style.display = 'none';
                    }
                }
            });
        }

        function selectCategoryFromPath(cat) {
            if (window.SoundFX && typeof window.SoundFX.play === 'function') {
                window.SoundFX.play('click');
            }
            if (typeof confetti === 'function') {
                confetti({
                    particleCount: 80,
                    spread: 60,
                    origin: { y: 0.7 },
                    colors: ['#FF5DA2', '#FFD93D', '#6BCB77', '#9B5DE5', '#FF9F1C', '#4FC3F7']
                });
            }
            setCategory(cat);
            currentLetterIdx = 0;
            currentLetter = currentCategoryList[currentLetterIdx];
            selectLetter(currentLetter);
            showScreen('tracingBoardScreen');
            // Use rAF to ensure layout is computed before measuring the canvas
            requestAnimationFrame(() => { resizeCanvas(); });
        }

        function goBackToCategoryScreen() {
            if (window.SoundFX && typeof window.SoundFX.play === 'function') {
                window.SoundFX.play('click');
            }
            showScreen('categorySelectionScreen');
        }

        function updateTabStyles() {
            const tabs = {
                'english': document.getElementById('tab-english'),
                'numbers': document.getElementById('tab-numbers'),
                'hindi': document.getElementById('tab-hindi')
            };
            Object.keys(tabs).forEach(cat => {
                const btn = tabs[cat];
                if (!btn) return;
                if (cat === currentCategory) {
                    btn.className = "btn-3d btn-pink category-tab-btn";
                    btn.style.backgroundColor = "var(--color-purple)";
                    btn.style.borderBottomColor = "var(--color-purple-shadow)";
                    btn.style.color = "#FFF";
                } else {
                    btn.className = "btn-3d btn-yellow category-tab-btn";
                    btn.style.backgroundColor = "var(--color-yellow)";
                    btn.style.borderBottomColor = "var(--color-yellow-shadow)";
                    btn.style.color = "#4A3B00";
                }
            });
        }

        function setCategory(cat) {
            if (!categorySequences[cat]) return;
            currentCategory = cat;
            currentCategoryList = categorySequences[cat];
            currentLetter = currentCategoryList[0];
            updateTabStyles();
            if (canvas.width > 0) loadCurrentLetter();
            if (window.SoundFX && typeof window.SoundFX.speak === 'function') {
                if (cat === 'english') window.SoundFX.speak("Let's trace English Alphabets!", "en-US");
                else if (cat === 'numbers') window.SoundFX.speak("Let's trace Numbers!", "en-US");
                else if (cat === 'hindi') window.SoundFX.speak("चलो हिंदी अक्षर लिखना सीखें!", "hi-IN");
            }
        }

        function selectLetter(letter) {
            currentLetter = letter;
            if (canvas.width > 0) loadCurrentLetter();
        }

        function resizeCanvas() {
            // Use the CANVAS's own bounding rect — not the parent's — because
            // the parent has borders that inflate getBoundingClientRect() while
            // the canvas CSS (width:100%; height:100%) only fills the content area.
            const rect = canvas.getBoundingClientRect();
            const w = Math.round(rect.width);
            const h = Math.round(rect.height);
            if (w < 1 || h < 1) return; // hidden — don't corrupt the canvas
            if (canvas.width !== w || canvas.height !== h) {
                canvas.width = w;
                canvas.height = h;
            }
            loadCurrentLetter();
        }

        function clearCanvas() {
            if (trailCanvas) trailCanvas.getContext('2d').clearRect(0, 0, trailCanvas.width, trailCanvas.height);
            isCelebrated = false;
            redrawCanvas();
        }

        // Random celebratory texts
        const celebrationTexts = ['Amazing! 🌟', 'Fantastic! ✨', 'Super Star! ⭐', 'Excellent! 🎉', 'Wonderful! 🌈', 'Brilliant! 💫'];

        function triggerSuccess() {
            isDrawing = false;

            if (typeof confetti === 'function') {
                confetti({ particleCount: 100, spread: 70, origin: { y: 0.6 }, colors: ['#FF5DA2', '#FFD93D', '#6BCB77', '#9B5DE5', '#FF9F1C'] });
                setTimeout(() => confetti({ particleCount: 50, spread: 100, origin: { y: 0.5 }, colors: ['#4FC3F7', '#FF5DA2', '#FFD93D'] }), 300);
            }

            currentSessionLevel++;
            const overlay = document.getElementById('successOverlay');
            const levelDisp = document.getElementById('levelDisplay');
            const levelDisp2 = document.getElementById('levelDisplay2');
            if (levelDisp) levelDisp.innerText = currentSessionLevel;
            if (levelDisp2) levelDisp2.innerText = currentSessionLevel;

            const randomText = celebrationTexts[Math.floor(Math.random() * celebrationTexts.length)];
            document.getElementById('successText').innerText = `${randomText} You reached Level ${currentSessionLevel}!`;

            const starEl = document.getElementById('starCount');
            const coinEl = document.getElementById('coinCount');
            const xpEl = document.getElementById('xpCount');
            if (starEl) starEl.innerText = parseInt(starEl.innerText || 0) + 20;
            if (coinEl) coinEl.innerText = parseInt(coinEl.innerText || 0) + 5;
            if (xpEl) xpEl.innerText = parseInt(xpEl.innerText || 0) + 10;

            fetch("{{ route('api.add_stars') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    stars: 20,
                    activity_name: 'Tracing Letter ' + currentLetter,
                    increase_level: true
                })
            });

            overlay.style.opacity = '1';
            overlay.style.pointerEvents = 'auto';

            setTimeout(() => {
                overlay.style.opacity = '0';
                overlay.style.pointerEvents = 'none';
                playEntertainmentClip();
            }, 3800);
        }

        function triggerFail() {
            const overlay = document.getElementById('failOverlay');
            overlay.style.opacity = '1';
            overlay.style.pointerEvents = 'auto';
            setTimeout(() => { hideFailOverlay(); }, 2500);
        }

        function hideFailOverlay() {
            const overlay = document.getElementById('failOverlay');
            overlay.style.opacity = '0';
            overlay.style.pointerEvents = 'none';
            clearCanvas();
        }

        function submitTracing() {
            const pct = checkCoverage();
            if (pct >= COMPLETE_THRESHOLD) {
                if (!isCelebrated) {
                    isCelebrated = true;
                    triggerSuccess();
                }
            } else {
                triggerFail();
            }
        }

        // ---- Entertainment Clip & Mini Game (unchanged) ----
        let pendingNextLetter = null;
        let musicInterval = null;
        let audioCtxInstance = null;
        let clipTimeout = null;

        function playEntertainmentClip() {
            const nextIdx = currentCategoryList.indexOf(currentLetter) + 1;
            pendingNextLetter = nextIdx < currentCategoryList.length ? currentCategoryList[nextIdx] : currentCategoryList[0];

            const clipOverlay = document.getElementById('entertainmentClipOverlay');
            if (clipOverlay) clipOverlay.style.display = 'flex';

            startClipMusic();

            if (clipTimeout) clearTimeout(clipTimeout);
            clipTimeout = setTimeout(() => { transitionFromClipToGame(); }, 4500);
        }

        function startClipMusic() {
            try {
                const AudioContextClass = window.AudioContext || window.webkitAudioContext;
                if (!AudioContextClass) return;
                audioCtxInstance = new AudioContextClass();
                const notes = [261.63, 329.63, 392.00, 523.25, 392.00, 329.63];
                let noteIndex = 0;
                const playNote = () => {
                    if (!audioCtxInstance || audioCtxInstance.state === 'closed') return;
                    const osc = audioCtxInstance.createOscillator();
                    const gain = audioCtxInstance.createGain();
                    osc.connect(gain);
                    gain.connect(audioCtxInstance.destination);
                    osc.type = 'triangle';
                    osc.frequency.setValueAtTime(notes[noteIndex], audioCtxInstance.currentTime);
                    gain.gain.setValueAtTime(0.12, audioCtxInstance.currentTime);
                    gain.gain.exponentialRampToValueAtTime(0.01, audioCtxInstance.currentTime + 0.35);
                    osc.start();
                    osc.stop(audioCtxInstance.currentTime + 0.4);
                    noteIndex = (noteIndex + 1) % notes.length;
                };
                playNote();
                musicInterval = setInterval(playNote, 250);
            } catch (e) { /* audio unavailable */ }
        }

        function stopClipMusic() {
            if (musicInterval) { clearInterval(musicInterval); musicInterval = null; }
            if (audioCtxInstance) { audioCtxInstance.close(); audioCtxInstance = null; }
        }

        function skipEntertainmentClip() {
            if (clipTimeout) clearTimeout(clipTimeout);
            transitionFromClipToGame();
        }

        function transitionFromClipToGame() {
            stopClipMusic();
            const clipOverlay = document.getElementById('entertainmentClipOverlay');
            if (clipOverlay) clipOverlay.style.display = 'none';
            showMiniGame();
        }

        function showMiniGame() {
            const miniGameOverlay = document.getElementById('miniGameOverlay');
            const targetLetterSpan = document.getElementById('miniGameTargetLetter');
            const balloonGrid = document.getElementById('miniGameBalloonGrid');
            const feedback = document.getElementById('miniGameFeedback');

            feedback.innerText = '';
            targetLetterSpan.innerText = currentLetter;

            const options = [currentLetter];
            const distractorPool = currentCategoryList.filter(l => l !== currentLetter);
            while (options.length < 5 && distractorPool.length > 0) {
                const randIndex = Math.floor(Math.random() * distractorPool.length);
                const choice = distractorPool.splice(randIndex, 1)[0];
                if (!options.includes(choice)) options.push(choice);
            }
            options.sort(() => Math.random() - 0.5);

            balloonGrid.innerHTML = '';
            options.forEach((letter) => {
                const target = document.createElement('div');
                target.className = 'shooter-target';
                target.innerText = letter;

                const handleChoice = () => {
                    if (target.classList.contains('wrong-shake') || target.style.opacity === '0') return;

                    const targetRect = target.getBoundingClientRect();
                    const targetX = targetRect.left + targetRect.width / 2;
                    const targetY = targetRect.top + targetRect.height / 2;

                    const blaster = document.getElementById('shooterBlaster');
                    const blasterRect = blaster.getBoundingClientRect();
                    const gunX = blasterRect.left + blasterRect.width / 2;
                    const gunY = blasterRect.top + blasterRect.height / 2;

                    const dx = targetX - gunX;
                    const dy = targetY - gunY;
                    const angleDeg = Math.atan2(dy, dx) * (180 / Math.PI);
                    blaster.style.transform = `rotate(${angleDeg + 25}deg)`;

                    const parent = document.getElementById('miniGameOverlay');
                    const parentRect = parent.getBoundingClientRect();
                    const startX = gunX - parentRect.left;
                    const startY = gunY - parentRect.top;
                    const endX = targetX - parentRect.left;
                    const endY = targetY - parentRect.top;

                    const bullet = document.getElementById('shooterBullet');
                    bullet.style.left = `${startX}px`;
                    bullet.style.top = `${startY}px`;
                    bullet.style.display = 'block';

                    try {
                        const audioCtx = new (window.AudioContext || window.webkitAudioContext)();
                        const osc = audioCtx.createOscillator();
                        const gain = audioCtx.createGain();
                        osc.connect(gain);
                        gain.connect(audioCtx.destination);
                        osc.type = 'sawtooth';
                        osc.frequency.setValueAtTime(800, audioCtx.currentTime);
                        osc.frequency.exponentialRampToValueAtTime(150, audioCtx.currentTime + 0.25);
                        gain.gain.setValueAtTime(0.08, audioCtx.currentTime);
                        gain.gain.exponentialRampToValueAtTime(0.01, audioCtx.currentTime + 0.25);
                        osc.start();
                        osc.stop(audioCtx.currentTime + 0.25);
                    } catch (err) {}

                    const bulletAnim = bullet.animate([
                        { left: `${startX}px`, top: `${startY}px` },
                        { left: `${endX}px`, top: `${endY}px` }
                    ], { duration: 250, easing: 'ease-out' });

                    bulletAnim.onfinish = () => {
                        bullet.style.display = 'none';
                        if (letter === currentLetter) {
                            if (window.SoundFX && typeof window.SoundFX.play === 'function') window.SoundFX.play('pop');
                            target.style.transform = 'scale(0)';
                            target.style.opacity = '0';
                            feedback.innerHTML = '<span style="color: #2E7D32;">Target Destroyed! Level Up! 🎯</span>';
                            if (window.SoundFX && typeof window.SoundFX.speak === 'function') window.SoundFX.speak("Target destroyed", "en-US");
                            if (typeof confetti === 'function') confetti({ particleCount: 60, spread: 50, origin: { y: 0.8 } });
                            setTimeout(() => {
                                closeMiniGameAndProceed();
                                blaster.style.transform = 'rotate(-25deg)';
                            }, 1200);
                        } else {
                            if (window.SoundFX && typeof window.SoundFX.play === 'function') window.SoundFX.play('click');
                            target.classList.add('wrong-shake');
                            feedback.innerHTML = `<span style="color: #C62828;">Oops! Try again! Find Target ${currentLetter} 🎯</span>`;
                            if (window.SoundFX && typeof window.SoundFX.speak === 'function') window.SoundFX.speak("Try again", "en-US");
                            setTimeout(() => target.classList.remove('wrong-shake'), 500);
                        }
                    };
                };

                target.onclick = handleChoice;
                target.ontouchstart = (e) => { handleChoice(); e.preventDefault(); };
                balloonGrid.appendChild(target);
            });

            if (window.SoundFX && typeof window.SoundFX.speak === 'function') {
                if (currentCategory === 'hindi') window.SoundFX.speak("निशाना लगाओ और अक्षर " + currentLetter + " को नष्ट करो", "hi-IN");
                else window.SoundFX.speak("Shoot the target letter " + currentLetter, "en-US");
            }

            miniGameOverlay.style.display = 'flex';
        }

        function skipMiniGame() {
            if (window.SoundFX && typeof window.SoundFX.play === 'function') window.SoundFX.play('click');
            closeMiniGameAndProceed();
        }

        function closeMiniGameAndProceed() {
            const miniGameOverlay = document.getElementById('miniGameOverlay');
            if (miniGameOverlay) miniGameOverlay.style.display = 'none';
            if (pendingNextLetter !== null) selectLetter(pendingNextLetter);
            isCelebrated = false;
        }

        document.addEventListener('DOMContentLoaded', () => {
            const params = new URLSearchParams(window.location.search);
            const categoryParam = params.get('category');

            if (categoryParam && categorySequences[categoryParam]) {
                currentCategory = categoryParam;
                currentCategoryList = categorySequences[currentCategory];
                currentLetter = currentCategoryList[0];
                selectLetter(currentLetter);
                showScreen('tracingBoardScreen');
            } else {
                showScreen('categorySelectionScreen');
            }

            updateTabStyles();
            resizeCanvas();
            window.addEventListener('resize', resizeCanvas);

            canvas.addEventListener('mousedown', startStroke);
            canvas.addEventListener('mousemove', moveStroke);
            canvas.addEventListener('mouseup', endStroke);
            canvas.addEventListener('mouseout', endStroke);
            canvas.addEventListener('touchstart', startStroke, { passive: false });
            canvas.addEventListener('touchmove', moveStroke, { passive: false });
            canvas.addEventListener('touchend', endStroke);
        });
    </script>
@endsection