<?php

namespace App\Http\Controllers;

use App\Models\Child;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParentZoneController extends Controller
{
    public function showPinPrompt()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please register or login as a parent first.');
        }
        return view('parent.pin');
    }

    public function verifyPin(Request $request)
    {
        $request->validate([
            'pin' => 'required|string|size:4|regex:/^[0-9]+$/',
        ]);

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        $parentProfile = Auth::user()->parentProfile;
        if ($parentProfile && $parentProfile->parent_pin === $request->pin) {
            session(['parent_verified' => true]);
            return redirect()->route('parent.dashboard');
        }

        return back()->withErrors(['pin' => 'Invalid PIN. Please try again.']);
    }

    public function dashboard()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        if (!session('parent_verified')) {
            return redirect()->route('parent.pin');
        }

        $parentProfile = Auth::user()->parentProfile;
        $children = $parentProfile ? $parentProfile->children()->with('avatar')->get() : collect();
        
        // Fetch recent activities for these children
        $childrenIds = $children->pluck('id')->toArray();
        $activities = \DB::table('activities')
            ->whereIn('child_id', $childrenIds)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('parent.dashboard', compact('children', 'activities', 'parentProfile'));
    }

    public function updatePin(Request $request)
    {
        $request->validate([
            'old_pin' => 'required|string|size:4',
            'new_pin' => 'required|string|size:4|confirmed|regex:/^[0-9]+$/',
        ]);

        $parentProfile = Auth::user()->parentProfile;
        if ($parentProfile && $parentProfile->parent_pin === $request->old_pin) {
            $parentProfile->update(['parent_pin' => $request->new_pin]);
            return back()->with('success', 'Parent PIN updated successfully!');
        }

        return back()->withErrors(['old_pin' => 'Incorrect old PIN.']);
    }

    public function lockParentZone()
    {
        session()->forget('parent_verified');
        return redirect()->route('dashboard')->with('success', 'Parent Zone locked.');
    }

    public function seedCoins(Request $request)
    {
        $request->validate([
            'child_id' => 'required|exists:children,id',
            'amount' => 'required|integer|min:10|max:1000'
        ]);

        $child = Child::findOrFail($request->child_id);
        $parentProfile = Auth::user()->parentProfile;
        if ($parentProfile && $child->parent_id !== $parentProfile->id) {
            abort(403);
        }

        $child->increment('stars', $request->amount);

        // Insert into activities log
        \DB::table('activities')->insert([
            'child_id' => $child->id,
            'activity_type' => 'reward',
            'activity_name' => 'Seeded ' . $request->amount . ' stars by Parent Admin',
            'xp_earned' => 0,
            'stars_earned' => $request->amount,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with('success', 'Successfully seeded ' . $request->amount . ' stars to ' . $child->name . '!');
    }

    public function resetProgress(Request $request)
    {
        $request->validate([
            'child_id' => 'required|exists:children,id',
        ]);

        $child = Child::findOrFail($request->child_id);
        $parentProfile = Auth::user()->parentProfile;
        if ($parentProfile && $child->parent_id !== $parentProfile->id) {
            abort(403);
        }

        // Reset progress stars/coins/level
        $child->update([
            'stars' => 0,
            'xp' => 0,
            'streak' => 0,
            'coins' => 0,
            'level' => 1,
            'current_outfit' => 'default'
        ]);

        // Delete activities and unlocked outfits
        \DB::table('activities')->where('child_id', $child->id)->delete();
        \DB::table('child_reward')->where('child_id', $child->id)->delete();

        return back()->with('success', 'Successfully reset all learning progress for ' . $child->name . '!');
    }
}
