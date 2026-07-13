@extends('layouts.app')

@section('title', 'Parent Zone - Dashboard')

@section('content')
<div class="parent-dashboard-container">
    
    <!-- Header Banner -->
    <header class="parent-header">
        <div class="parent-header-left">
            <span class="parent-badge-pill">⚙️ Parent Zone Control</span>
            <h1 class="parent-title">Parent Dashboard</h1>
            <p class="parent-subtitle">Manage child profiles, review progress, and configure dashboard security.</p>
        </div>
        <div class="parent-header-right">
            <a href="{{ route('dashboard') }}" class="btn-3d btn-yellow">🎮 Back to Game</a>
            <a href="{{ route('parent.lock') }}" class="btn-3d btn-pink">🔒 Lock Parent Zone</a>
        </div>
    </header>

    <!-- Main Dashboard Grid -->
    <div class="parent-grid">
        
        <!-- Sidebar Navigation -->
        <aside class="parent-sidebar">
            <div class="sidebar-user-pill">
                <div class="sidebar-avatar-ring">🔑</div>
                <div class="sidebar-user-info">
                    <span class="sidebar-user-role">Welcome, Parent</span>
                    <span class="sidebar-user-name">{{ Auth::user()->name }}</span>
                </div>
            </div>
            
            <nav class="sidebar-nav">
                <a href="#profiles" class="sidebar-link active" onclick="switchTab('profiles', this)">
                    <span class="sidebar-icon">👶</span> Child Profiles
                </a>
                <a href="#activities" class="sidebar-link" onclick="switchTab('activities', this)">
                    <span class="sidebar-icon">📈</span> Progress & Tracker
                </a>
                <a href="#security" class="sidebar-link" onclick="switchTab('security', this)">
                    <span class="sidebar-icon">🔒</span> Security Settings
                </a>
                <a href="#admin" class="sidebar-link" onclick="switchTab('admin', this)">
                    <span class="sidebar-icon">🛠️</span> Parent Admin Panel
                </a>
            </nav>
            
            <a href="{{ route('logout') }}" class="sidebar-logout-btn">
                <span>🚪</span> Parent Log Out
            </a>
        </aside>

        <!-- Main Content Area -->
        <main class="parent-main-content">
            
            <!-- Tab 1: Profiles Manager -->
            <section id="profilesSection" class="parent-content-card">
                <div class="section-header">
                    <div>
                        <h2 class="section-title">Children Profiles</h2>
                        <p class="section-subtitle">Add new profiles or manage existing active learning sessions.</p>
                    </div>
                    <a href="{{ route('child.create') }}" class="btn-3d btn-green-new">
                        ➕ Add Child Profile
                    </a>
                </div>

                <!-- Children Grid Layout -->
                <div class="children-grid">
                    @forelse($children as $child)
                        <div class="child-card">
                            <div class="child-card-body">
                                <!-- Relative Wrapper for Outfit Accessory Overlays -->
                                <div class="child-avatar-container">
                                    <div class="child-avatar-circle">
                                        {!! $child->avatar->svg_markup !!}
                                    </div>
                                    
                                    @if($child->current_outfit === 'crown')
                                        <div style="position: absolute; top: -14px; left: 50%; transform: translateX(-50%); width: 48px; height: 35px; z-index: 10; pointer-events: none;">
                                            <svg viewBox="0 0 100 70" width="100%" height="100%">
                                                <polygon points="10,60 20,20 40,45 50,15 60,45 80,20 90,60" fill="#FFDE59" stroke="#E6A100" stroke-width="4" stroke-linejoin="round"/>
                                                <circle cx="20" cy="20" r="5" fill="#FF5252"/>
                                                <circle cx="50" cy="15" r="5" fill="#38B6FF"/>
                                                <circle cx="80" cy="20" r="5" fill="#FF5252"/>
                                                <rect x="15" y="55" width="70" height="8" rx="2" fill="#E6A100"/>
                                            </svg>
                                        </div>
                                    @elseif($child->current_outfit === 'glasses')
                                        <div style="position: absolute; top: 18px; left: 50%; transform: translateX(-50%); width: 56px; height: 23px; z-index: 10; pointer-events: none;">
                                            <svg viewBox="0 0 100 40" width="100%" height="100%">
                                                <polygon points="20,5 25,18 38,18 28,26 31,38 20,30 9,38 12,26 2,18 15,18" fill="rgba(255, 102, 196, 0.9)" stroke="#D94B9F" stroke-width="3"/>
                                                <polygon points="80,5 85,18 98,18 88,26 91,38 80,30 69,38 72,26 62,18 75,18" fill="rgba(255, 102, 196, 0.9)" stroke="#D94B9F" stroke-width="3"/>
                                                <path d="M 38 22 Q 50 12 62 22" fill="none" stroke="#D94B9F" stroke-width="4"/>
                                            </svg>
                                        </div>
                                    @elseif($child->current_outfit === 'superhero')
                                        <div style="position: absolute; bottom: -5px; left: 50%; transform: translateX(-50%); width: 62px; height: 22px; z-index: 10; pointer-events: none;">
                                            <svg viewBox="0 0 100 30" width="100%" height="100%">
                                                <path d="M 10 5 L 30 25 L 50 10 L 70 25 L 90 5" fill="none" stroke="#FF5252" stroke-width="5" stroke-linecap="round"/>
                                                <rect x="35" y="2" width="30" height="12" rx="4" fill="#FF5252" stroke="#C62828" stroke-width="1"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="child-details">
                                    <h3 class="child-name">{{ $child->name }}</h3>
                                    <div class="child-badges">
                                        <span class="child-badge-item badge-age">🎂 {{ $child->age }} Years</span>
                                        <span class="child-badge-item badge-level">⭐ Level {{ $child->level }}</span>
                                        <span class="child-badge-item badge-stars">🌟 {{ $child->stars }} Stars</span>
                                    </div>
                                    <p class="child-outfit-text">Equipped: <span class="outfit-tag">{{ $child->current_outfit }}</span></p>
                                </div>
                            </div>
                            
                            <div class="child-card-actions">
                                <a href="{{ route('child.switch', $child->id) }}" class="btn-3d btn-yellow btn-small">
                                    🎮 Switch Play
                                </a>
                                <a href="{{ route('child.edit', $child->id) }}" class="btn-3d btn-pink btn-small">
                                    ✏️ Edit Profile
                                </a>
                            </div>
                        </div>
                    @empty
                        <div style="grid-column: 1 / -1; text-align: center; padding: 40px; background: #F8FAFC; border: 3px dashed #CBD5E1; border-radius: 24px;">
                            <span style="font-size: 3rem;">👶</span>
                            <h3 style="font-weight: 800; margin-top: 15px; color: var(--color-text);">No Child Profiles Created Yet</h3>
                            <p style="color: var(--color-gray); margin-bottom: 20px;">Add a profile to start tracking and learning!</p>
                            <a href="{{ route('child.create') }}" class="btn-3d btn-green-new">Create First Profile</a>
                        </div>
                    @endforelse
                </div>
            </section>

            <!-- Tab 2: Progress & Activity Tracker -->
            <section id="activitiesSection" class="parent-content-card" style="display: none;">
                <h2 class="section-title" style="margin-bottom: 20px;">Progress Tracker & Statistics</h2>
                
                <!-- Performance Statistics Gauges -->
                <div class="stats-container">
                    <div class="stat-widget stat-widget-yellow">
                        <span class="stat-label">Total Stars Saved</span>
                        <h3 class="stat-value stat-val-orange">🌟 {{ $children->sum('stars') }}</h3>
                    </div>
                    <div class="stat-widget stat-widget-green">
                        <span class="stat-label">Total XP Points</span>
                        <h3 class="stat-value stat-val-green">⚡ {{ $children->sum('xp') }}</h3>
                    </div>
                    <div class="stat-widget stat-widget-blue">
                        <span class="stat-label">Highest Active Streak</span>
                        <h3 class="stat-value stat-val-blue">🔥 {{ $children->max('streak') ?? 0 }} Days</h3>
                    </div>
                </div>

                <h3 class="section-title" style="font-size: 1.35rem; margin-bottom: 16px;">Recent Play Logs</h3>
                @if($activities->isEmpty())
                    <div style="text-align: center; padding: 40px; background: #F8FAFC; border: 3px dashed #CBD5E1; border-radius: 20px; color: var(--color-gray);">
                        <p style="font-size: 1.1rem; font-weight: bold; margin-bottom: 5px;">No play logs recorded yet</p>
                        <p style="font-size: 0.95rem;">Learning activities completed in games/rhymes will show up here.</p>
                    </div>
                @else
                    <div class="logs-table-container">
                        <table class="logs-table">
                            <thead>
                                <tr>
                                    <th>Activity / Detail</th>
                                    <th>Stars Earned</th>
                                    <th>XP Earned</th>
                                    <th>Completed At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($activities as $activity)
                                    <tr>
                                        <td>
                                            <span class="activity-badge badge-act-{{ in_array($activity->activity_type, ['game', 'quiz', 'lesson', 'reward']) ? $activity->activity_type : 'default' }}">
                                                @if($activity->activity_type === 'game')
                                                    🎮 Game
                                                @elseif($activity->activity_type === 'quiz')
                                                    📝 Quiz
                                                @elseif($activity->activity_type === 'lesson')
                                                    📚 Lesson
                                                @elseif($activity->activity_type === 'reward')
                                                    🎁 Reward
                                                @else
                                                    ⚡ Activity
                                                @endif
                                            </span>
                                            <span style="margin-left: 8px; font-weight: 800;">{{ $activity->activity_name }}</span>
                                        </td>
                                        <td style="color: var(--color-orange); font-weight: 800;">🌟 +{{ $activity->stars_earned }}</td>
                                        <td style="color: var(--color-green-real); font-weight: 800;">⚡ +{{ $activity->xp_earned }}</td>
                                        <td style="color: var(--color-gray); font-size: 0.9rem;">{{ date('d M, Y h:i A', strtotime($activity->created_at)) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </section>

            <!-- Tab 3: Security & PIN Management -->
            <section id="securitySection" class="parent-content-card" style="display: none;">
                <h2 class="section-title" style="margin-bottom: 6px;">Security PIN Settings</h2>
                <p class="section-subtitle" style="margin-bottom: 24px;">Ensure children cannot exit the child zone or access settings without a PIN.</p>
                
                <div class="parent-form-info-box">
                    <span style="font-size: 1.3rem;">💡</span>
                    <span>The Parent PIN acts as a safety gate. Keep this code secret from your children to prevent them from bypassing parental locks or accessing database tools.</span>
                </div>

                <form action="{{ route('parent.update_pin') }}" method="POST" class="form-card">
                    @csrf
                    <div class="form-group-custom">
                        <label class="form-label-custom">Current 4-Digit PIN</label>
                        <input type="password" name="old_pin" class="form-input-custom" placeholder="Enter current 4-digit PIN" required maxlength="4" pattern="[0-9]*" inputmode="numeric">
                    </div>
                    
                    <div class="form-group-custom">
                        <label class="form-label-custom">New 4-Digit PIN</label>
                        <input type="password" name="new_pin" class="form-input-custom" placeholder="Enter new 4-digit PIN" required maxlength="4" pattern="[0-9]*" inputmode="numeric">
                    </div>
                    
                    <div class="form-group-custom">
                        <label class="form-label-custom">Confirm New PIN</label>
                        <input type="password" name="new_pin_confirmation" class="form-input-custom" placeholder="Confirm new 4-digit PIN" required maxlength="4" pattern="[0-9]*" inputmode="numeric">
                    </div>
                    
                    <button type="submit" class="btn-3d btn-green-new" style="width: 100%; font-size: 1.15rem; margin-top: 10px;">
                        Save PIN Configuration
                    </button>
                </form>
            </section>

            <!-- Tab 4: Parent Admin Panel -->
            <section id="adminSection" class="parent-content-card" style="display: none;">
                <h2 class="section-title" style="margin-bottom: 6px;">🛠️ Parent Admin Controls</h2>
                <p class="section-subtitle" style="margin-bottom: 28px;">Admin utility panel to quickly manage, reward, or reset profiles.</p>
                
                <div class="admin-grid">
                    
                    <!-- Admin Action 1: Seed Coins / Stars -->
                    <div class="admin-card">
                        <div>
                            <h3 class="admin-card-title">⭐ Seed Star Rewards</h3>
                            <p class="admin-card-desc">Instantly grant additional stars to your child's profile to reward them, celebrate milestone achievements, or purchase outfits.</p>
                        </div>
                        
                        <form action="{{ route('parent.seed_coins') }}" method="POST">
                            @csrf
                            <div class="form-group-custom" style="margin-bottom: 12px;">
                                <label class="form-label-custom" style="font-size: 0.9rem;">Select Child</label>
                                <select name="child_id" class="form-select-custom" required>
                                    @foreach($children as $child)
                                        <option value="{{ $child->id }}">{{ $child->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group-custom" style="margin-bottom: 20px;">
                                <label class="form-label-custom" style="font-size: 0.9rem;">Amount of Stars</label>
                                <input type="number" name="amount" value="100" min="10" max="1000" class="form-input-custom" style="padding: 10px 14px; border-radius: 14px;" required>
                            </div>
                            <button type="submit" class="btn-3d btn-yellow" style="width: 100%; font-size: 1rem; padding: 10px 20px;">
                                Grant Stars!
                            </button>
                        </form>
                    </div>

                    <!-- Admin Action 2: Reset Data -->
                    <div class="admin-card admin-card-danger">
                        <div>
                            <h3 class="admin-card-title">🚨 Reset Child Progress</h3>
                            <p class="admin-card-desc">Completely clear learning progress. This deletes all star accumulations, streak counts, equipped accessories, and wipes activities log.</p>
                        </div>
                        
                        <form action="{{ route('parent.reset_progress') }}" method="POST" onsubmit="return confirm('Are you absolutely sure? This cannot be undone!')">
                            @csrf
                            <div class="form-group-custom" style="margin-bottom: 20px;">
                                <label class="form-label-custom" style="font-size: 0.9rem;">Select Child</label>
                                <select name="child_id" class="form-select-custom" required>
                                    @foreach($children as $child)
                                        <option value="{{ $child->id }}">{{ $child->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn-3d btn-danger-new" style="width: 100%; font-size: 1rem; padding: 10px 20px;">
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
    // Tab switching and persistence
    window.addEventListener('DOMContentLoaded', () => {
        // Read hash or local storage
        let activeTab = 'profiles';
        let hash = window.location.hash.replace('#', '');
        
        if (hash && ['profiles', 'activities', 'security', 'admin'].includes(hash)) {
            activeTab = hash;
        } else {
            let savedTab = localStorage.getItem('parent_active_tab');
            if (savedTab && ['profiles', 'activities', 'security', 'admin'].includes(savedTab)) {
                activeTab = savedTab;
            }
        }
        
        const activeLink = document.querySelector(`.sidebar-link[href="#${activeTab}"]`);
        if (activeLink) {
            switchTab(activeTab, activeLink, false);
        }
    });

    function switchTab(tabId, element, playSound = true) {
        // Toggle Sidebar Active States
        document.querySelectorAll('.sidebar-link').forEach(link => {
            if (!link.href.includes('logout')) {
                link.classList.remove('active');
            }
        });
        element.classList.add('active');

        // Toggle sections visibility
        document.getElementById('profilesSection').style.display = tabId === 'profiles' ? 'block' : 'none';
        document.getElementById('activitiesSection').style.display = tabId === 'activities' ? 'block' : 'none';
        document.getElementById('securitySection').style.display = tabId === 'security' ? 'block' : 'none';
        document.getElementById('adminSection').style.display = tabId === 'admin' ? 'block' : 'none';
        
        // Save to LocalStorage and update hash URL
        localStorage.setItem('parent_active_tab', tabId);
        window.location.hash = tabId;
        
        if (playSound && typeof SoundFX !== 'undefined') {
            SoundFX.play('click');
        }
    }
</script>

<style>
    /* Premium Glassmorphic Container */
    .parent-dashboard-container {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 4px solid rgba(255, 255, 255, 0.5);
        border-radius: 36px;
        padding: 32px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05), inset 0 0 0 2px rgba(255, 255, 255, 0.4);
        margin-top: 20px;
        margin-bottom: 20px;
        position: relative;
        z-index: 10;
    }
    
    /* Header layout */
    .parent-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 4px dashed rgba(140, 82, 255, 0.2);
        padding-bottom: 24px;
        margin-bottom: 30px;
        gap: 20px;
    }
    
    .parent-header-left {
        display: flex;
        flex-direction: column;
    }
    
    .parent-badge-pill {
        align-self: flex-start;
        background: linear-gradient(135deg, var(--color-purple) 0%, #a87dfd 100%);
        color: white;
        font-size: 0.8rem;
        font-weight: 800;
        padding: 6px 16px;
        border-radius: 20px;
        box-shadow: 0 4px 0 var(--color-purple-shadow);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 10px;
    }
    
    .parent-title {
        font-size: 2.2rem;
        font-weight: 900;
        color: var(--color-text);
        text-shadow: 0 2px 0 rgba(0, 0, 0, 0.05);
    }
    
    .parent-subtitle {
        color: var(--color-gray);
        font-size: 1.05rem;
        margin-top: 4px;
    }
    
    .parent-header-right {
        display: flex;
        gap: 16px;
    }
    
    /* Layout Grid */
    .parent-grid {
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 32px;
        align-items: start;
    }
    
    @media (max-width: 992px) {
        .parent-grid {
            grid-template-columns: 1fr;
        }
        .parent-header {
            flex-direction: column;
            align-items: stretch;
            text-align: center;
        }
        .parent-badge-pill {
            align-self: center;
        }
        .parent-header-right {
            justify-content: center;
        }
    }
    
    /* Sidebar Navigation styling */
    .parent-sidebar {
        background: #FFFFFF;
        border: 4px solid #E2E8F0;
        padding: 24px;
        border-radius: 28px;
        box-shadow: 0 10px 24px rgba(0, 0, 0, 0.02);
        display: flex;
        flex-direction: column;
        gap: 24px;
    }
    
    .sidebar-user-pill {
        display: flex;
        align-items: center;
        gap: 14px;
        background: #F8FAFC;
        padding: 12px 16px;
        border-radius: 20px;
        border: 2px solid #E2E8F0;
    }
    
    .sidebar-avatar-ring {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: var(--color-purple);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        color: white;
        box-shadow: 0 4px 0 var(--color-purple-shadow);
    }
    
    .sidebar-user-info {
        display: flex;
        flex-direction: column;
    }
    
    .sidebar-user-role {
        font-size: 0.75rem;
        font-weight: 700;
        color: var(--color-gray);
        text-transform: uppercase;
    }
    
    .sidebar-user-name {
        font-size: 1.1rem;
        font-weight: 800;
        color: var(--color-text);
    }
    
    .sidebar-nav {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    
    .sidebar-link {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 14px 20px;
        border-radius: 20px;
        font-weight: 800;
        font-size: 1.05rem;
        color: var(--color-text);
        text-decoration: none;
        transition: all 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.1);
        border: 3px solid transparent;
    }
    
    .sidebar-link:hover {
        background: #F8FAFC;
        color: var(--color-purple);
        border-color: #E2E8F0;
        transform: translateX(4px);
    }
    
    .sidebar-link.active {
        background: var(--color-purple);
        color: white;
        border-color: var(--color-purple-shadow);
        box-shadow: 0 6px 0 var(--color-purple-shadow);
    }
    
    .sidebar-link.active:hover {
        color: white;
    }
    
    .sidebar-icon {
        font-size: 1.25rem;
    }
    
    .sidebar-logout-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin-top: 10px;
        padding: 12px 20px;
        border-radius: 20px;
        font-weight: 800;
        font-size: 1.05rem;
        color: #FF5757;
        text-decoration: none;
        border: 3px solid #FFEBEB;
        background: #FFF5F5;
        transition: all 0.2s ease;
    }
    
    .sidebar-logout-btn:hover {
        background: #FF5757;
        color: white;
        border-color: #CC4545;
        transform: translateY(-2px);
        box-shadow: 0 4px 0 #CC4545;
    }
    
    /* Content Cards styling */
    .parent-content-card {
        background: #FFFFFF;
        border: 4px solid #E2E8F0;
        padding: 32px;
        border-radius: 32px;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.02);
    }
    
    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 28px;
        gap: 20px;
        flex-wrap: wrap;
    }
    
    .section-title {
        font-size: 1.7rem;
        font-weight: 900;
        color: var(--color-text);
    }
    
    .section-subtitle {
        font-size: 0.95rem;
        color: var(--color-gray);
        margin-top: 2px;
    }
    
    .btn-green-new {
        background-color: var(--color-green-real);
        color: white;
        border-bottom: 5px solid var(--color-green-real-shadow);
    }
    
    .btn-green-new:hover {
        transform: translateY(-2px);
        border-bottom-width: 7px;
    }
    
    .btn-green-new:active {
        transform: translateY(3px);
        border-bottom-width: 2px;
    }
    
    /* Children Grid */
    .children-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 24px;
    }
    
    .child-card {
        background: #FFFFFF;
        border: 4px solid #E2E8F0;
        border-radius: 28px;
        padding: 24px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        gap: 20px;
        transition: all 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.15);
        position: relative;
        overflow: hidden;
    }
    
    .child-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 8px;
        background: linear-gradient(90deg, var(--color-purple) 0%, var(--color-pink) 100%);
    }
    
    .child-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.05);
        border-color: rgba(140, 82, 255, 0.3);
    }
    
    .child-card-body {
        display: flex;
        gap: 20px;
        align-items: center;
    }
    
    .child-avatar-container {
        position: relative;
        width: 80px;
        height: 80px;
        flex-shrink: 0;
    }
    
    .child-avatar-circle {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background: #F8FAFC;
        border: 3px solid var(--color-purple);
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 8px rgba(0,0,0,0.05);
    }
    
    .child-avatar-circle svg {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
    
    .child-details {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }
    
    .child-name {
        font-size: 1.4rem;
        font-weight: 900;
        color: var(--color-text);
    }
    
    .child-badges {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
    }
    
    .child-badge-item {
        font-size: 0.8rem;
        font-weight: 800;
        padding: 4px 10px;
        border-radius: 12px;
    }
    
    .badge-age {
        background: #EBF5FB;
        color: var(--color-blue);
    }
    
    .badge-level {
        background: #FFFDF0;
        color: var(--color-orange);
        border: 1px solid var(--color-yellow);
    }
    
    .badge-stars {
        background: #FFF0F5;
        color: var(--color-pink);
    }
    
    .child-outfit-text {
        font-size: 0.85rem;
        color: var(--color-gray);
        font-weight: 600;
        margin-top: 2px;
    }
    
    .outfit-tag {
        text-transform: capitalize;
        color: var(--color-purple);
        font-weight: 800;
    }
    
    .child-card-actions {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        border-top: 2px dashed #E2E8F0;
        padding-top: 16px;
    }
    
    .btn-small {
        padding: 8px 12px;
        font-size: 0.9rem;
        border-radius: 16px;
    }
    
    /* Stats Containers */
    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 32px;
    }
    
    .stat-widget {
        border-radius: 24px;
        padding: 24px 20px;
        text-align: center;
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 16px rgba(0,0,0,0.02);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        transition: transform 0.2s ease;
    }
    
    .stat-widget:hover {
        transform: translateY(-4px);
    }
    
    .stat-widget-yellow {
        background: linear-gradient(135deg, #FFFDF0 0%, #FFF9D6 100%);
        border: 3px solid var(--color-yellow);
    }
    
    .stat-widget-green {
        background: linear-gradient(135deg, #E8F8F5 0%, #D1F2EB 100%);
        border: 3px solid var(--color-green-real);
    }
    
    .stat-widget-blue {
        background: linear-gradient(135deg, #EBF5FB 0%, #D4E6F1 100%);
        border: 3px solid var(--color-blue);
    }
    
    .stat-label {
        font-size: 0.95rem;
        font-weight: bold;
        color: var(--color-gray);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .stat-value {
        font-size: 2.2rem;
        font-weight: 900;
        margin-top: 8px;
        line-height: 1;
    }
    
    .stat-val-orange { color: var(--color-orange); text-shadow: 0 2px 0 rgba(217, 115, 54, 0.1); }
    .stat-val-green { color: var(--color-green-real); text-shadow: 0 2px 0 rgba(99, 170, 67, 0.1); }
    .stat-val-blue { color: var(--color-blue); text-shadow: 0 2px 0 rgba(63, 86, 204, 0.1); }
    
    /* Play log tables styling */
    .logs-table-container {
        overflow-x: auto;
        border-radius: 20px;
        border: 3px solid #E2E8F0;
        background: #FFFFFF;
    }
    
    .logs-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
    }
    
    .logs-table th {
        background: #F8FAFC;
        padding: 16px;
        font-weight: 800;
        color: var(--color-text);
        border-bottom: 3px solid #E2E8F0;
        font-size: 0.95rem;
    }
    
    .logs-table td {
        padding: 16px;
        border-bottom: 2px solid #F1F5F9;
        font-weight: 600;
        color: var(--color-text);
        font-size: 0.95rem;
    }
    
    .logs-table tr:last-child td {
        border-bottom: none;
    }
    
    .logs-table tr:hover td {
        background: #F8FAFC;
    }
    
    .activity-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 0.8rem;
        font-weight: 800;
        text-transform: uppercase;
    }
    
    .badge-act-game { background: #E3F2FD; color: #1E88E5; }
    .badge-act-quiz { background: #F3E5F5; color: #8E24AA; }
    .badge-act-lesson { background: #E0F2F1; color: #00897B; }
    .badge-act-reward { background: #FCE4EC; color: #D81B60; }
    .badge-act-default { background: #ECEFF1; color: #546E7A; }
    
    /* Form styles */
    .parent-form-info-box {
        background: #F5F3FF;
        border: 2px dashed rgba(140, 82, 255, 0.3);
        border-radius: 20px;
        padding: 16px 20px;
        margin-bottom: 24px;
        display: flex;
        align-items: flex-start;
        gap: 12px;
        color: var(--color-purple);
        font-weight: 600;
        font-size: 0.95rem;
        line-height: 1.4;
    }
    
    .form-card {
        max-width: 500px;
    }
    
    .form-group-custom {
        margin-bottom: 20px;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    
    .form-label-custom {
        font-weight: 800;
        font-size: 1rem;
        color: var(--color-text);
    }
    
    .form-input-custom {
        width: 100%;
        padding: 14px 18px;
        border-radius: 18px;
        border: 3px solid #CBD5E1;
        font-size: 1.05rem;
        font-weight: 700;
        outline: none;
        font-family: inherit;
        transition: all 0.2s ease;
        color: var(--color-text);
    }
    
    .form-input-custom:focus {
        border-color: var(--color-purple);
        box-shadow: 0 0 0 4px rgba(140, 82, 255, 0.15);
    }
    
    .form-input-custom::placeholder {
        color: #94A3B8;
        font-weight: 500;
    }
    
    /* Admin Section styling */
    .admin-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 32px;
    }
    
    .admin-card {
        background: white;
        border: 4px solid #E2E8F0;
        border-radius: 28px;
        padding: 28px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.01);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: all 0.2s ease;
    }
    
    .admin-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.03);
    }
    
    .admin-card-danger {
        border-color: #FFCCD5;
        background: #FFFBFB;
    }
    
    .admin-card-danger:hover {
        border-color: #FFA3B1;
    }
    
    .admin-card-title {
        font-size: 1.35rem;
        font-weight: 900;
        color: var(--color-text);
        margin-bottom: 8px;
    }
    
    .admin-card-danger .admin-card-title {
        color: #FF4D80;
    }
    
    .admin-card-desc {
        font-size: 0.9rem;
        color: var(--color-gray);
        line-height: 1.4;
        margin-bottom: 20px;
        font-weight: 500;
    }
    
    .form-select-custom {
        width: 100%;
        padding: 12px 16px;
        border-radius: 16px;
        border: 3px solid #CBD5E1;
        font-size: 1rem;
        font-weight: 700;
        color: var(--color-text);
        outline: none;
        background: white;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .form-select-custom:focus {
        border-color: var(--color-purple);
    }
    
    .admin-card-danger .form-select-custom {
        border-color: #FFCCD5;
    }
    
    .admin-card-danger .form-select-custom:focus {
        border-color: #FF4D80;
    }
    
    .btn-danger-new {
        background: #FF5757;
        color: white;
        border-bottom: 5px solid #CC4545;
    }
    
    .btn-danger-new:hover {
        transform: translateY(-2px);
        border-bottom-width: 7px;
    }
    
    .btn-danger-new:active {
        transform: translateY(3px);
        border-bottom-width: 2px;
    }
</style>
@endsection
