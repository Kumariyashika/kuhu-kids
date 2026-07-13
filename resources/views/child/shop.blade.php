@extends('layouts.app')

@section('title', 'Kuhu Kids Learning - Outfit Shop')

@section('content')
<div class="inner-container">
    <div class="inner-header">
        <h1 class="inner-title">
            <span style="color: var(--color-purple);">🛍️ Toy & Outfit Shop</span>
        </h1>
        <a href="{{ route('dashboard') }}" class="btn-3d btn-yellow" style="display: flex; align-items: center; justify-content: center; border-radius: 50%; width: 44px; height: 44px; padding: 0; text-decoration: none; margin: 0;" title="Back to Home">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
        </a>
    </div>

    <!-- Outfit Shop Grid -->
    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 30px; z-index: 10;">
        
        <!-- Left Side: Avatar Preview -->
        <div style="background: #FFFDF0; border: 4px dashed var(--color-orange); border-radius: 36px; padding: 24px; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; gap: 16px;">
            <h2 style="font-weight: 800; color: var(--color-text);">Your Avatar</h2>
            
            <!-- Real-time Avatar Preview with Overlay Accessories -->
            <div style="position: relative; width: 150px; height: 150px; border-radius: 50%; background: white; border: 6px solid var(--color-purple); overflow: visible; box-shadow: 0 10px 20px rgba(0,0,0,0.06);">
                {!! $activeChild->avatar->svg_markup !!}
                
                @if($equippedIdentifier === 'crown')
                    <div style="position: absolute; top: -38px; left: 50%; transform: translateX(-50%); width: 100px; height: 75px; z-index: 10; pointer-events: none; filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1));">
                        <svg viewBox="0 0 100 70" width="100%" height="100%">
                            <polygon points="10,60 20,20 40,45 50,15 60,45 80,20 90,60" fill="#FFDE59" stroke="#E6A100" stroke-width="4" stroke-linejoin="round"/>
                            <circle cx="20" cy="20" r="5" fill="#FF5252"/>
                            <circle cx="50" cy="15" r="5" fill="#38B6FF"/>
                            <circle cx="80" cy="20" r="5" fill="#FF5252"/>
                            <rect x="15" y="55" width="70" height="8" rx="2" fill="#E6A100"/>
                        </svg>
                    </div>
                @elseif($equippedIdentifier === 'glasses')
                    <div style="position: absolute; top: 40px; left: 50%; transform: translateX(-50%); width: 110px; height: 50px; z-index: 10; pointer-events: none; filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1));">
                        <svg viewBox="0 0 100 40" width="100%" height="100%">
                            <polygon points="20,5 25,18 38,18 28,26 31,38 20,30 9,38 12,26 2,18 15,18" fill="rgba(255, 102, 196, 0.9)" stroke="#D94B9F" stroke-width="3"/>
                            <polygon points="80,5 85,18 98,18 88,26 91,38 80,30 69,38 72,26 62,18 75,18" fill="rgba(255, 102, 196, 0.9)" stroke="#D94B9F" stroke-width="3"/>
                            <path d="M 38 22 Q 50 12 62 22" fill="none" stroke="#D94B9F" stroke-width="4"/>
                        </svg>
                    </div>
                @elseif($equippedIdentifier === 'superhero')
                    <div style="position: absolute; bottom: -8px; left: 50%; transform: translateX(-50%); width: 120px; height: 40px; z-index: 10; pointer-events: none; filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1));">
                        <svg viewBox="0 0 100 30" width="100%" height="100%">
                            <path d="M 10 5 L 30 25 L 50 10 L 70 25 L 90 5" fill="none" stroke="#FF5252" stroke-width="5" stroke-linecap="round"/>
                            <rect x="35" y="2" width="30" height="12" rx="4" fill="#FF5252" stroke="#C62828" stroke-width="1"/>
                        </svg>
                    </div>
                @endif
            </div>

            <div style="margin-top: 10px;">
                <span style="font-size: 1.4rem; font-weight: 900; color: var(--color-text);">{{ $activeChild->name }}</span>
                <div style="display: flex; align-items: center; justify-content: center; gap: 6px; margin-top: 5px; font-weight: 800; color: var(--color-orange);">
                    <span>⭐ Stars: {{ $activeChild->stars }}</span>
                </div>
            </div>

            @if($equippedIdentifier !== 'default')
                <form action="{{ route('child.equip_reward', 0) }}" method="POST" style="width: 100%;">
                    @csrf
                    <button type="submit" class="btn-3d btn-pink" style="width: 100%; font-size: 0.95rem; padding: 10px;">
                        ❌ Clear Outfits
                    </button>
                </form>
            @endif
        </div>

        <!-- Right Side: Items Catalog -->
        <div style="display: flex; flex-direction: column; gap: 20px;">
            @foreach($rewards as $item)
                <div style="background: white; border: 3px solid #E2E8F0; border-radius: 24px; padding: 20px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 8px 16px rgba(0,0,0,0.02); transition: transform 0.2s ease;">
                    
                    <div style="display: flex; align-items: center; gap: 20px;">
                        <!-- Custom Item Icon -->
                        <div style="width: 80px; height: 80px; background: #F8FAFC; border-radius: 18px; border: 2px solid #E2E8F0; display: flex; align-items: center; justify-content: center;">
                            @if($item->identifier === 'crown')
                                <svg viewBox="0 0 100 70" width="60" height="42">
                                    <polygon points="10,60 20,20 40,45 50,15 60,45 80,20 90,60" fill="#FFDE59" stroke="#E6A100" stroke-width="3" stroke-linejoin="round"/>
                                    <circle cx="20" cy="20" r="4" fill="#FF5252"/>
                                    <circle cx="50" cy="15" r="4" fill="#38B6FF"/>
                                    <circle cx="80" cy="20" r="4" fill="#FF5252"/>
                                    <rect x="15" y="55" width="70" height="6" rx="1" fill="#E6A100"/>
                                </svg>
                            @elseif($item->identifier === 'glasses')
                                <svg viewBox="0 0 100 40" width="60" height="24">
                                    <polygon points="20,5 25,18 38,18 28,26 31,38 20,30 9,38 12,26 2,18 15,18" fill="rgba(255, 102, 196, 0.9)" stroke="#D94B9F" stroke-width="2.5"/>
                                    <polygon points="80,5 85,18 98,18 88,26 91,38 80,30 69,38 72,26 62,18 75,18" fill="rgba(255, 102, 196, 0.9)" stroke="#D94B9F" stroke-width="2.5"/>
                                    <path d="M 38 22 Q 50 12 62 22" fill="none" stroke="#D94B9F" stroke-width="3"/>
                                </svg>
                            @elseif($item->identifier === 'superhero')
                                <svg viewBox="0 0 100 30" width="65" height="20">
                                    <path d="M 10 5 L 30 25 L 50 10 L 70 25 L 90 5" fill="none" stroke="#FF5252" stroke-width="4" stroke-linecap="round"/>
                                    <rect x="35" y="2" width="30" height="10" rx="3" fill="#FF5252" stroke="#C62828" stroke-width="1"/>
                                </svg>
                            @endif
                        </div>
                        <div>
                            <h3 style="font-weight: 800; color: var(--color-text); font-size: 1.3rem;">{{ $item->title }}</h3>
                            <p style="color: var(--color-gray); font-size: 0.95rem;">{{ $item->description }}</p>
                        </div>
                    </div>

                    <!-- Buy / Equip Actions -->
                    <div>
                        @if(in_array($item->id, $unlockedRewardIds))
                            <!-- Owned! -->
                            @if($equippedIdentifier === $item->identifier)
                                <button class="btn-3d" style="background: #E2E8F0; border-bottom: 5px solid #CBD5E1; color: var(--color-gray); font-size: 0.95rem; cursor: default;" disabled>
                                    ✨ Equipped
                                </button>
                            @else
                                <form action="{{ route('child.equip_reward', $item->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-3d btn-green" style="background: var(--color-green-real); color: white; border-bottom: 5px solid var(--color-green-real-shadow); font-size: 0.95rem; padding: 10px 24px;">
                                        👉 Equip Item
                                    </button>
                                </form>
                            @endif
                        @else
                            <!-- Not Owned - Buy! -->
                            <form action="{{ route('child.buy_reward', $item->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-3d btn-yellow" style="font-size: 0.95rem; padding: 10px 20px; display: flex; align-items: center; gap: 6px;" {{ $activeChild->stars < $item->coins_cost ? 'disabled' : '' }}>
                                    🪙 Buy (⭐{{ $item->coins_cost }})
                                </button>
                            </form>
                        @endif
                    </div>

                </div>
            @endforeach
        </div>

    </div>
</div>
@endsection
