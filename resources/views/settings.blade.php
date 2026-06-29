@extends('layouts.app')

@section('title', 'Kuhu Kids Learning - Settings')

@section('content')
<div class="inner-container">
    <div class="inner-header">
        <h1 class="inner-title">
            <!-- Gear SVG -->
            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="3"/>
                <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/>
            </svg>
            Game Settings
        </h1>
        <a href="{{ route('dashboard') }}" class="btn-3d btn-yellow">&lt; Back to Home</a>
    </div>

    <div style="max-width: 600px; margin: 0 auto; display: flex; flex-direction: column; gap: 24px; padding: 20px 0;">
        <div style="display: flex; justify-content: space-between; align-items: center; background: #F8FAFC; padding: 20px; border-radius: 20px; border: 3px solid #E2E8F0;">
            <span style="font-size: 1.3rem; font-weight: bold;">🔊 Sound Effects</span>
            <input type="checkbox" checked id="sfxToggle" style="transform: scale(2); cursor: pointer;">
        </div>

        <div style="display: flex; justify-content: space-between; align-items: center; background: #F8FAFC; padding: 20px; border-radius: 20px; border: 3px solid #E2E8F0;">
            <span style="font-size: 1.3rem; font-weight: bold;">🗣️ Auto Pronunciation Voice</span>
            <input type="checkbox" checked id="voiceToggle" style="transform: scale(2); cursor: pointer;">
        </div>

        <div style="display: flex; justify-content: space-between; align-items: center; background: #F8FAFC; padding: 20px; border-radius: 20px; border: 3px solid #E2E8F0;">
            <span style="font-size: 1.3rem; font-weight: bold;">👶 Current Profile: <strong>{{ $activeChild->name }}</strong></span>
            <span style="font-size: 1.1rem; color: var(--color-gray);">Age: {{ $activeChild->age }} Years</span>
        </div>

        <div style="text-align: center; margin-top: 20px;">
            <a href="{{ route('parent.dashboard') }}" class="btn-3d btn-pink" style="font-size: 1.3rem; padding: 16px 36px;">🔒 Parent Zone Dashboard</a>
        </div>
    </div>
</div>

<script>
    // Load and save settings in localStorage
    document.addEventListener('DOMContentLoaded', () => {
        const sfxToggle = document.getElementById('sfxToggle');
        const voiceToggle = document.getElementById('voiceToggle');

        sfxToggle.checked = localStorage.getItem('sfx_enabled') !== 'false';
        voiceToggle.checked = localStorage.getItem('voice_enabled') !== 'false';

        sfxToggle.addEventListener('change', () => {
            localStorage.setItem('sfx_enabled', sfxToggle.checked);
        });

        voiceToggle.addEventListener('change', () => {
            localStorage.setItem('voice_enabled', voiceToggle.checked);
        });
    });
</script>
@endsection
