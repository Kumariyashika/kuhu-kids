@extends('layouts.app')

@section('title', 'Parent Zone - Secure Access')

@section('content')
<div class="inner-container" style="max-width: 500px; margin: 40px auto;">
    <div class="pin-lock-container">
        <!-- Shield Icon Lock Graphic -->
        <div style="margin-bottom: 20px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="#E8E5FF" stroke="var(--color-purple)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
            </svg>
        </div>

        <h1 style="font-size: 1.8rem; font-weight: 800; color: var(--color-purple); margin-bottom: 8px;">Parent Zone Access</h1>
        <p style="color: var(--color-gray); font-size: 0.95rem; margin-bottom: 24px;">Please enter your secure 4-digit Parent PIN to continue.</p>

        @if ($errors->any())
            <div style="color: #FF5757; font-weight: bold; margin-bottom: 15px; font-size: 0.95rem;">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Form target -->
        <form action="{{ route('parent.verify_pin') }}" method="POST" id="pinForm">
            @csrf
            <input type="hidden" name="pin" id="pinInput" value="">
            
            <!-- Pin Dots -->
            <div class="pin-display">
                <div class="pin-dot" id="dot1"></div>
                <div class="pin-dot" id="dot2"></div>
                <div class="pin-dot" id="dot3"></div>
                <div class="pin-dot" id="dot4"></div>
            </div>

            <!-- PIN Pad Keys -->
            <div class="pin-keyboard">
                <button type="button" onclick="pressKey('1')" class="pin-key">1</button>
                <button type="button" onclick="pressKey('2')" class="pin-key">2</button>
                <button type="button" onclick="pressKey('3')" class="pin-key">3</button>
                
                <button type="button" onclick="pressKey('4')" class="pin-key">4</button>
                <button type="button" onclick="pressKey('5')" class="pin-key">5</button>
                <button type="button" onclick="pressKey('6')" class="pin-key">6</button>
                
                <button type="button" onclick="pressKey('7')" class="pin-key">7</button>
                <button type="button" onclick="pressKey('8')" class="pin-key">8</button>
                <button type="button" onclick="pressKey('9')" class="pin-key">9</button>
                
                <button type="button" onclick="pressKey('C')" class="pin-key" style="color: var(--color-pink);">C</button>
                <button type="button" onclick="pressKey('0')" class="pin-key">0</button>
                <button type="button" onclick="submitPin()" class="pin-key" style="color: var(--color-green-real); font-size: 1.1rem;">OK</button>
            </div>
        </form>

        <a href="{{ route('dashboard') }}" class="btn-3d btn-yellow" style="width: 100%;">Cancel</a>
    </div>
</div>

<script>
    let pinVal = "";

    function pressKey(key) {
        if (key === 'C') {
            pinVal = "";
        } else {
            if (pinVal.length < 4) {
                pinVal += key;
            }
        }
        updateDots();
        
        // Auto submit when 4 digits entered
        if (pinVal.length === 4) {
            setTimeout(submitPin, 300);
        }
    }

    function updateDots() {
        for (let i = 1; i <= 4; i++) {
            const dot = document.getElementById('dot' + i);
            if (i <= pinVal.length) {
                dot.classList.add('filled');
            } else {
                dot.classList.remove('filled');
            }
        }
    }

    function submitPin() {
        if (pinVal.length === 4) {
            document.getElementById('pinInput').value = pinVal;
            document.getElementById('pinForm').submit();
        } else {
            SoundFX.speak("Please enter 4 digits!");
        }
    }
</script>
@endsection
