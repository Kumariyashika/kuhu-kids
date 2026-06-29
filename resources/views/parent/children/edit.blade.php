@extends('layouts.app')

@section('title', 'Parent Zone - Edit Child')

@section('content')
<div class="inner-container" style="max-width: 600px; margin: 20px auto;">
    <div class="inner-header">
        <h1 class="inner-title" style="color: var(--color-purple);">✏️ Edit Child Profile</h1>
        <a href="{{ route('parent.dashboard') }}" class="btn-3d btn-yellow">&lt; Back</a>
    </div>

    @if ($errors->any())
        <div style="color: #FF5757; font-weight: bold; margin-bottom: 15px; font-size: 0.95rem;">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('child.update', $child->id) }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label class="form-label" for="name">Child Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $child->name }}" required>
        </div>

        <div class="form-group">
            <label class="form-label" for="age">Child Age</label>
            <input type="number" name="age" id="age" class="form-control" value="{{ $child->age }}" min="2" max="12" required>
        </div>

        <div class="form-group">
            <label class="form-label">Select Avatar</label>
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-top: 10px;" id="avatarGrid">
                @foreach($avatars as $avatar)
                    @php
                        $isSelected = $child->avatar_id === $avatar->id;
                    @endphp
                    <label style="cursor: pointer; display: flex; flex-direction: column; align-items: center; gap: 8px; border: 3px solid {{ $isSelected ? 'var(--color-purple)' : '#E2E8F0' }}; padding: 12px; border-radius: 16px; background: {{ $isSelected ? '#F5F3FF' : 'transparent' }}; transition: all 0.2s ease;" class="avatar-label">
                        <input type="radio" name="avatar_id" value="{{ $avatar->id }}" style="display: none;" {{ $isSelected ? 'checked' : '' }} required>
                        <div style="width: 70px; height: 70px; border-radius: 50%; overflow: hidden; background: white;">
                            {!! $avatar->svg_markup !!}
                        </div>
                        <span style="font-weight: bold; color: var(--color-text);">{{ $avatar->name }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn-3d" style="width: 100%; font-size: 1.2rem; background: var(--color-green-real); color: white; border-bottom: 5px solid var(--color-green-real-shadow); margin-top: 20px;">
            Save Profile Changes
        </button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const labels = document.querySelectorAll('.avatar-label');
        labels.forEach(label => {
            label.addEventListener('click', () => {
                labels.forEach(l => {
                    l.style.borderColor = '#E2E8F0';
                    l.style.background = 'transparent';
                });
                label.style.borderColor = 'var(--color-purple)';
                label.style.background = '#F5F3FF';
                SoundFX.play('click');
            });
        });
    });
</script>
@endsection
