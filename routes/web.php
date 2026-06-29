<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChildController;
use App\Http\Controllers\LearningController;
use App\Http\Controllers\ParentZoneController;

// 1. Dashboard & Settings
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/settings', [DashboardController::class, 'settings'])->name('settings');

// 2. Parent Authentication
Route::get('/auth/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/auth/register', [AuthController::class, 'register']);
Route::get('/auth/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/auth/login', [AuthController::class, 'login']);
Route::get('/auth/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/auth/forgot-password', [AuthController::class, 'showForgotPassword'])->name('forgot_password');
Route::post('/auth/forgot-password', [AuthController::class, 'forgotPassword']);

// 3. Child Switching, Shop & Management
Route::get('/child/switch/{id}', [ChildController::class, 'switchChild'])->name('child.switch');
Route::get('/child/create', [ChildController::class, 'create'])->name('child.create');
Route::post('/child/store', [ChildController::class, 'store'])->name('child.store');
Route::get('/child/edit/{id}', [ChildController::class, 'edit'])->name('child.edit');
Route::post('/child/update/{id}', [ChildController::class, 'update'])->name('child.update');
Route::get('/shop', [ChildController::class, 'shop'])->name('child.shop');
Route::post('/shop/buy/{id}', [ChildController::class, 'buyReward'])->name('child.buy_reward');
Route::post('/shop/equip/{id}', [ChildController::class, 'equipReward'])->name('child.equip_reward');

// 4. Kids Learning Modules
Route::prefix('learning')->group(function () {
    Route::get('/tracing', [LearningController::class, 'tracing'])->name('learning.tracing');
    Route::get('/phonics', [LearningController::class, 'phonics'])->name('learning.phonics');
    Route::get('/balloon-pop', [LearningController::class, 'balloonPop'])->name('learning.balloon_pop');
    Route::get('/letter-match', [LearningController::class, 'letterMatch'])->name('learning.letter_match');
    Route::get('/english-rhymes', [LearningController::class, 'englishRhymes'])->name('learning.english_rhymes');
    Route::get('/hindi-rhymes', [LearningController::class, 'hindiRhymes'])->name('learning.hindi_rhymes');
    Route::get('/devotional', [LearningController::class, 'devotional'])->name('learning.devotional');
    Route::get('/cultural', [LearningController::class, 'cultural'])->name('learning.cultural');
    
    // NEW Routes
    Route::get('/numbers', [LearningController::class, 'numbers'])->name('learning.numbers');
    Route::get('/shapes', [LearningController::class, 'shapes'])->name('learning.shapes');
    Route::get('/colors', [LearningController::class, 'colors'])->name('learning.colors');
    Route::get('/quiz', [LearningController::class, 'quiz'])->name('learning.quiz');
});

// 5. Stars Progress API
Route::post('/api/add-stars', [LearningController::class, 'addStars'])->name('api.add_stars');

// 6. Parent Zone PIN Verification
Route::get('/parent-zone/pin', [ParentZoneController::class, 'showPinPrompt'])->name('parent.pin');
Route::post('/parent-zone/verify', [ParentZoneController::class, 'verifyPin'])->name('parent.verify_pin');
Route::get('/parent-zone/lock', [ParentZoneController::class, 'lockParentZone'])->name('parent.lock');

// 7. Parent Zone Secure Dashboard (Protected by Middleware)
Route::middleware(['parent.pin'])->prefix('parent-zone')->group(function () {
    Route::get('/dashboard', [ParentZoneController::class, 'dashboard'])->name('parent.dashboard');
    Route::post('/update-pin', [ParentZoneController::class, 'updatePin'])->name('parent.update_pin');
    Route::post('/admin/seed-coins', [ParentZoneController::class, 'seedCoins'])->name('parent.seed_coins');
    Route::post('/admin/reset-progress', [ParentZoneController::class, 'resetProgress'])->name('parent.reset_progress');
});

