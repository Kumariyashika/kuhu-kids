@extends('layouts.app')

@section('title', 'Parent Zone - Dashboard')

@section('content')
<div class="inner-container">
    <div class="inner-header">
        <h1 class="inner-title">
            <span style="color: var(--color-purple);">⚙️ Parent Zone Dashboard</span>
        </h1>
        <div style="display: flex; gap: 12px;">
            <a href="{{ route('parent.lock') }}" class="btn-3d btn-pink">🔒 Lock Parent Zone</a>
            <a href="{{ route('dashboard') }}" class="btn-3d btn-yellow">&lt; Back to Game</a>
        </div>
    </div>

    <!-- Parent Dashboard Grid Layout -->
    <div class="parent-dashboard-grid" style="display: grid; grid-template-columns: 1fr 3fr; gap: 30px; align-items: start;">
        
        <!-- Sidebar Navigation -->
        <aside class="parent-sidebar" style="background: #F8FAFC; border: 3px solid #E2E8F0; padding: 20px; border-radius: 24px; display: flex; flex-direction: column; gap: 10px;">
            <div class="sidebar-nav" style="display: flex; flex-direction: column; gap: 8px;">
                <a href="#profiles" class="sidebar-link active" onclick="switchTab('profiles', this)">👶 Child Profiles</a>
                <a href="#activities" class="sidebar-link" onclick="switchTab('activities', this)">📈 Progress & Tracker</a>
                <a href="#security" class="sidebar-link" onclick="switchTab('security', this)">🔒 Security Settings</a>
                <a href="#admin" class="sidebar-link" onclick="switchTab('admin', this)">🛠️ Parent Admin Panel</a>
                <a href="{{ route('logout') }}" class="sidebar-link" style="color: #FF5757; margin-top: 20px;">🚪 Parent Log Out</a>
            </div>
        </aside>

        <!-- Main Content Cards -->
        <main class="parent-main-content">
            
            <!-- Tab 1: Profiles Manager -->
            <section id="profilesSection" class="parent-content-card">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <h2 style="font-weight: 800; color: var(--color-text);">Children Profiles</h2>
                    <a href="{{ route('child.create') }}" class="btn-3d" style="background: var(--color-green-real); color: white; border-bottom: 5px solid var(--color-green-real-shadow);">
                        ➕ Add Child
                    </a>
                </div>

                <!-- Children List -->
                <div style="display: flex; flex-direction: column; gap: 16px;">
                    @foreach($children as $child)
                        <div style="display: flex; justify-content: space-between; align-items: center; background: #F8FAFC; padding: 16px 24px; border-radius: 20px; border: 3px solid #E2E8F0;">
                            <div style="display: flex; align-items: center; gap: 16px;">
                                <!-- Relative Wrapper for Outfit Accessory Overlays -->
                                <div style="position: relative; width: 60px; height: 60px; border-radius: 50%; background: white; border: 3px solid var(--color-purple); overflow: visible;">
                                    {!! $child->avatar->svg_markup !!}
                                    
                                    @if($child->current_outfit === 'crown')
                                        <div style="position: absolute; top: -15px; left: 50%; transform: translateX(-50%); width: 40px; height: 30px; z-index: 10; pointer-events: none;">
                                            <svg viewBox="0 0 100 70" width="100%" height="100%">
                                                <polygon points="10,60 20,20 40,45 50,15 60,45 80,20 90,60" fill="#FFDE59" stroke="#E6A100" stroke-width="4" stroke-linejoin="round"/>
                                                <circle cx="20" cy="20" r="5" fill="#FF5252"/>
                                                <circle cx="50" cy="15" r="5" fill="#38B6FF"/>
                                                <circle cx="80" cy="20" r="5" fill="#FF5252"/>
                                                <rect x="15" y="55" width="70" height="8" rx="2" fill="#E6A100"/>
                                            </svg>
                                        </div>
                                    @elseif($child->current_outfit === 'glasses')
                                        <div style="position: absolute; top: 14px; left: 50%; transform: translateX(-50%); width: 48px; height: 20px; z-index: 10; pointer-events: none;">
                                            <svg viewBox="0 0 100 40" width="100%" height="100%">
                                                <polygon points="20,5 25,18 38,18 28,26 31,38 20,30 9,38 12,26 2,18 15,18" fill="rgba(255, 102, 196, 0.9)" stroke="#D94B9F" stroke-width="3"/>
                                                <polygon points="80,5 85,18 98,18 88,26 91,38 80,30 69,38 72,26 62,18 75,18" fill="rgba(255, 102, 196, 0.9)" stroke="#D94B9F" stroke-width="3"/>
                                                <path d="M 38 22 Q 50 12 62 22" fill="none" stroke="#D94B9F" stroke-width="4"/>
                                            </svg>
                                        </div>
                                    @elseif($child->current_outfit === 'superhero')
                                        <div style="position: absolute; bottom: -4px; left: 50%; transform: translateX(-50%); width: 50px; height: 18px; z-index: 10; pointer-events: none;">
                                            <svg viewBox="0 0 100 30" width="100%" height="100%">
                                                <path d="M 10 5 L 30 25 L 50 10 L 70 25 L 90 5" fill="none" stroke="#FF5252" stroke-width="5" stroke-linecap="round"/>
                                                <rect x="35" y="2" width="30" height="12" rx="4" fill="#FF5252" stroke="#C62828" stroke-width="1"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <h3 style="font-weight: 800; color: var(--color-text);">{{ $child->name }}</h3>
                                    <span style="font-size: 0.9rem; color: var(--color-gray);">Age: {{ $child->age }} Years &bull; Stars: 🌟 {{ $child->stars }} &bull; Outfit equipped: <strong style="text-transform: capitalize; color: var(--color-purple);">{{ $child->current_outfit }}</strong></span>
                                </div>
                            </div>
                            <div style="display: flex; gap: 10px;">
                                <a href="{{ route('child.switch', $child->id) }}" class="btn-3d btn-yellow" style="padding: 8px 16px; font-size: 0.9rem;">
                                    🎮 Switch Play
                                </a>
                                <a href="{{ route('child.edit', $child->id) }}" class="btn-3d btn-pink" style="padding: 8px 16px; font-size: 0.9rem;">
                                    ✏️ Edit
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <!-- Tab 2: Progress & Activity Tracker -->
            <section id="activitiesSection" class="parent-content-card" style="display: none;">
                <h2 style="font-weight: 800; color: var(--color-text); margin-bottom: 20px;">Progress Tracker & Statistics</h2>
                
                <!-- Performance Statistics Gauges -->
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 30px;">
                    <div style="background: #FFFDF0; border: 3px solid var(--color-yellow); border-radius: 20px; padding: 15px; text-align: center;">
                        <span style="font-size: 0.9rem; font-weight: bold; color: var(--color-gray);">Total Stars</span>
                        <h3 style="font-size: 2.2rem; font-weight: 900; color: var(--color-orange); margin-top: 5px;">🌟 {{ $children->sum('stars') }}</h3>
                    </div>
                    <div style="background: #E8F8F5; border: 3px solid var(--color-green-real); border-radius: 20px; padding: 15px; text-align: center;">
                        <span style="font-size: 0.9rem; font-weight: bold; color: var(--color-gray);">Total XP Points</span>
                        <h3 style="font-size: 2.2rem; font-weight: 900; color: var(--color-green-real); margin-top: 5px;">⚡ {{ $children->sum('xp') }}</h3>
                    </div>
                    <div style="background: #EBF5FB; border: 3px solid var(--color-blue); border-radius: 20px; padding: 15px; text-align: center;">
                        <span style="font-size: 0.9rem; font-weight: bold; color: var(--color-gray);">Active Streak</span>
                        <h3 style="font-size: 2.2rem; font-weight: 900; color: var(--color-blue); margin-top: 5px;">🔥 {{ $children->max('streak') }} Days</h3>
                    </div>
                </div>

                <h3 style="font-weight: 800; color: var(--color-text); margin-bottom: 12px;">Recent Play Logs</h3>
                @if($activities->isEmpty())
                    <p style="color: var(--color-gray); text-align: center; padding: 30px;">No learning activities completed yet. Start playing in tracing or games to log progress!</p>
                @else
                    <table style="width: 100%; border-collapse: collapse; text-align: left;">
                        <thead>
                            <tr style="border-bottom: 3px solid #E2E8F0; color: var(--color-gray); font-weight: 800;">
                                <th style="padding: 12px 8px;">Activity Name</th>
                                <th style="padding: 12px 8px;">Stars Earned</th>
                                <th style="padding: 12px 8px;">XP Earned</th>
                                <th style="padding: 12px 8px;">Completed At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($activities as $activity)
                                <tr style="border-bottom: 2px solid #F1F5F9; font-weight: 600;">
                                    <td style="padding: 12px 8px;">🎮 {{ $activity->activity_name }}</td>
                                    <td style="padding: 12px 8px; color: var(--color-orange);">🌟 +{{ $activity->stars_earned }}</td>
                                    <td style="padding: 12px 8px; color: var(--color-purple);">⚡ +{{ $activity->xp_earned }}</td>
                                    <td style="padding: 12px 8px; color: var(--color-gray); font-size: 0.9rem;">{{ date('d M, Y h:i A', strtotime($activity->created_at)) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </section>

            <!-- Tab 3: Security & PIN Management -->
            <section id="securitySection" class="parent-content-card" style="display: none;">
                <h2 style="font-weight: 800; color: var(--color-text); margin-bottom: 20px;">Security PIN Settings</h2>
                
                <form action="{{ route('parent.update_pin') }}" method="POST" style="max-width: 400px;">
                    @csrf
                    <div style="margin-bottom: 16px;">
                        <label style="display: block; font-weight: bold; margin-bottom: 6px;">Current PIN</label>
                        <input type="password" name="old_pin" style="width: 100%; padding: 12px; border-radius: 12px; border: 2px solid #CBD5E1; font-weight: bold;" placeholder="Enter current 4-digit PIN" required maxlength="4">
                    </div>
                    
                    <div style="margin-bottom: 16px;">
                        <label style="display: block; font-weight: bold; margin-bottom: 6px;">New 4-Digit PIN</label>
                        <input type="password" name="new_pin" style="width: 100%; padding: 12px; border-radius: 12px; border: 2px solid #CBD5E1; font-weight: bold;" placeholder="Enter new 4-digit PIN" required maxlength="4">
                    </div>
                    
                    <div style="margin-bottom: 24px;">
                        <label style="display: block; font-weight: bold; margin-bottom: 6px;">Confirm New PIN</label>
                        <input type="password" name="new_pin_confirmation" style="width: 100%; padding: 12px; border-radius: 12px; border: 2px solid #CBD5E1; font-weight: bold;" placeholder="Confirm new 4-digit PIN" required maxlength="4">
                    </div>
                    
                    <button type="submit" class="btn-3d" style="width: 100%; font-size: 1.1rem; background: var(--color-green-real); color: white; border-bottom: 5px solid var(--color-green-real-shadow);">
                        Save PIN Configuration
                    </button>
                </form>
            </section>

            <!-- Tab 4: Parent Admin Panel -->
            <section id="adminSection" class="parent-content-card" style="display: none;">
                <h2 style="font-weight: 800; color: var(--color-text); margin-bottom: 20px;">🛠️ Parent Admin Controls</h2>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
                    
                    <!-- Admin Action 1: Seed Coins / Stars -->
                    <div style="background: white; border: 3px solid #E2E8F0; border-radius: 24px; padding: 20px;">
                        <h3 style="font-weight: 800; color: var(--color-text); margin-bottom: 10px;">⭐ Seed Star Rewards</h3>
                        <p style="color: var(--color-gray); font-size: 0.9rem; margin-bottom: 15px;">Send additional stars to your child's profile to reward them or buy outfits!</p>
                        
                        <form action="{{ route('parent.seed_coins') }}" method="POST">
                            @csrf
                            <div style="margin-bottom: 12px;">
                                <label style="display: block; font-weight: bold; font-size: 0.85rem; margin-bottom: 4px;">Select Child</label>
                                <select name="child_id" style="width: 100%; padding: 10px; border-radius: 10px; border: 2px solid #CBD5E1;" required>
                                    @foreach($children as $child)
                                        <option value="{{ $child->id }}">{{ $child->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div style="margin-bottom: 15px;">
                                <label style="display: block; font-weight: bold; font-size: 0.85rem; margin-bottom: 4px;">Amount of Stars</label>
                                <input type="number" name="amount" value="100" min="10" max="1000" style="width: 100%; padding: 10px; border-radius: 10px; border: 2px solid #CBD5E1;" required>
                            </div>
                            <button type="submit" class="btn-3d btn-yellow" style="width: 100%; font-size: 0.95rem; padding: 10px;">
                                Grant Stars!
                            </button>
                        </form>
                    </div>

                    <!-- Admin Action 2: Reset Data -->
                    <div style="background: white; border: 3px solid #FFCCD5; border-radius: 24px; padding: 20px;">
                        <h3 style="font-weight: 800; color: #FF4D80; margin-bottom: 10px;">🚨 Reset Child Progress</h3>
                        <p style="color: var(--color-gray); font-size: 0.9rem; margin-bottom: 15px;">Caution: This resets stars, streak counts, outfits, and deletes all play activity logs.</p>
                        
                        <form action="{{ route('parent.reset_progress') }}" method="POST" onsubmit="return confirm('Are you absolutely sure? This cannot be undone!')">
                            @csrf
                            <div style="margin-bottom: 15px;">
                                <label style="display: block; font-weight: bold; font-size: 0.85rem; margin-bottom: 4px;">Select Child</label>
                                <select name="child_id" style="width: 100%; padding: 10px; border-radius: 10px; border: 2px solid #FFCCD5;" required>
                                    @foreach($children as $child)
                                        <option value="{{ $child->id }}">{{ $child->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn-3d btn-pink" style="width: 100%; font-size: 0.95rem; padding: 10px; background: #FF5757; color: white; border-bottom: 5px solid #CC4545;">
                                Reset All Progress
                            </button>
                        </form>
                    </div>

                </div>
            </section>

        </main>
    </div>
</div>

<script>
    function switchTab(tabId, element) {
        // Toggle Sidebar Active States
        document.querySelectorAll('.sidebar-link').forEach(link => {
            if (link !== element && !link.href.includes('logout')) {
                link.classList.remove('active');
            }
        });
        element.classList.add('active');

        // Toggle sections visibility
        document.getElementById('profilesSection').style.display = tabId === 'profiles' ? 'block' : 'none';
        document.getElementById('activitiesSection').style.display = tabId === 'activities' ? 'block' : 'none';
        document.getElementById('securitySection').style.display = tabId === 'security' ? 'block' : 'none';
        document.getElementById('adminSection').style.display = tabId === 'admin' ? 'block' : 'none';
        
        SoundFX.play('click');
    }
</script>

<style>
    /* Styling tab sheets inside parent content cards */
    .parent-content-card {
        background: white;
        border: 3px solid #E2E8F0;
        padding: 30px;
        border-radius: 28px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.02);
    }
    
    .sidebar-link {
        display: block;
        padding: 12px 20px;
        border-radius: 16px;
        font-weight: 800;
        font-size: 1.05rem;
        color: var(--color-text);
        text-decoration: none;
        transition: all 0.2s ease;
    }
    
    .sidebar-link:hover {
        background: #EDF2F7;
        color: var(--color-purple);
    }
    
    .sidebar-link.active {
        background: var(--color-purple);
        color: white;
    }
</style>
@endsection
