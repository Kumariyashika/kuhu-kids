<?php

namespace App\Http\Controllers;

use App\Models\Child;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $activeChild = null;

        // 1. Try retrieving from session
        if (session()->has('active_child_id')) {
            $activeChild = Child::with('avatar')->find(session('active_child_id'));
        }

        // 2. Try retrieving parent's first child if logged in
        if (!$activeChild && Auth::check()) {
            $parentProfile = Auth::user()->parentProfile;
            if ($parentProfile) {
                $activeChild = $parentProfile->children()->with('avatar')->first();
                if ($activeChild) {
                    session(['active_child_id' => $activeChild->id]);
                }
            }
        }

        // 3. Fallback: Find Pihu child from seeded data so there's ALWAYS a child selected
        if (!$activeChild) {
            $activeChild = Child::with('avatar')->where('name', 'Pihu')->first();
            if ($activeChild) {
                session(['active_child_id' => $activeChild->id]);
            }
        }

        return view('dashboard', compact('activeChild'));
    }

    public function settings()
    {
        // Simple settings page or settings popup for kids configuration
        $activeChild = null;
        if (session()->has('active_child_id')) {
            $activeChild = Child::with('avatar')->find(session('active_child_id'));
        }
        return view('settings', compact('activeChild'));
    }
}
