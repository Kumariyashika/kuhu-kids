<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Avatar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChildController extends Controller
{
    public function switchChild($id)
    {
        $child = Child::findOrFail($id);
        
        // If logged in, ensure the child belongs to this parent
        if (Auth::check()) {
            $parentProfile = Auth::user()->parentProfile;
            if ($parentProfile && $child->parent_id !== $parentProfile->id) {
                return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
            }
        }

        session(['active_child_id' => $child->id]);
        return redirect()->route('dashboard')->with('success', 'Switched profile to ' . $child->name);
    }

    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in as a parent first.');
        }

        $avatars = Avatar::all();
        return view('parent.children.create', compact('avatars'));
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in as a parent first.');
        }

        $parentProfile = Auth::user()->parentProfile;
        if (!$parentProfile) {
            return redirect()->route('dashboard')->with('error', 'Parent profile not found.');
        }

        $request->validate([
            'name' => 'required|string|max:50',
            'age' => 'required|integer|min:2|max:12',
            'avatar_id' => 'required|exists:avatars,id',
        ]);

        $child = Child::create([
            'parent_id' => $parentProfile->id,
            'name' => $request->name,
            'age' => $request->age,
            'avatar_id' => $request->avatar_id,
            'streak' => 1,
            'xp' => 0,
            'stars' => 10, // Starting bonus stars
            'coins' => 10,
            'level' => 1,
            'current_outfit' => 'default'
        ]);

        session(['active_child_id' => $child->id]);

        return redirect()->route('parent.dashboard')->with('success', 'New child profile created!');
    }

    public function edit($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in.');
        }

        $parentProfile = Auth::user()->parentProfile;
        $child = Child::findOrFail($id);

        if ($parentProfile && $child->parent_id !== $parentProfile->id) {
            abort(403);
        }

        $avatars = Avatar::all();
        return view('parent.children.edit', compact('child', 'avatars'));
    }

    public function update(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in.');
        }

        $parentProfile = Auth::user()->parentProfile;
        $child = Child::findOrFail($id);

        if ($parentProfile && $child->parent_id !== $parentProfile->id) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:50',
            'age' => 'required|integer|min:2|max:12',
            'avatar_id' => 'required|exists:avatars,id',
        ]);

        $child->update([
            'name' => $request->name,
            'age' => $request->age,
            'avatar_id' => $request->avatar_id,
        ]);

        return redirect()->route('parent.dashboard')->with('success', 'Profile updated successfully!');
    }

    public function shop()
    {
        $activeChild = null;
        if (session()->has('active_child_id')) {
            $activeChild = Child::with('avatar')->find(session('active_child_id'));
        }
        if (!$activeChild) {
            $activeChild = Child::with('avatar')->where('name', 'Pihu')->first();
        }

        // Ensure rewards exist in the database
        $rewards = \DB::table('rewards')->get();
        if ($rewards->isEmpty()) {
            \DB::table('rewards')->insert([
                [
                    'title' => 'Royal Crown',
                    'description' => 'A shiny golden crown to wear on your head!',
                    'type' => 'outfit',
                    'identifier' => 'crown',
                    'coins_cost' => 100,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'title' => 'Cool Sunglasses',
                    'description' => 'Super cool star-shaped sunglasses!',
                    'type' => 'outfit',
                    'identifier' => 'glasses',
                    'coins_cost' => 150,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'title' => 'Superhero Outfit',
                    'description' => 'Become a super learner with a magical cape!',
                    'type' => 'outfit',
                    'identifier' => 'superhero',
                    'coins_cost' => 200,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            ]);
            $rewards = \DB::table('rewards')->get();
        }

        // Get child's unlocked rewards
        $unlockedRewardIds = \DB::table('child_reward')
            ->where('child_id', $activeChild->id)
            ->pluck('reward_id')
            ->toArray();

        // Get equipped reward identifier
        $equippedReward = \DB::table('child_reward')
            ->where('child_id', $activeChild->id)
            ->where('is_active', true)
            ->first();
            
        $equippedIdentifier = $equippedReward ? \DB::table('rewards')->where('id', $equippedReward->reward_id)->value('identifier') : 'default';

        return view('child.shop', compact('activeChild', 'rewards', 'unlockedRewardIds', 'equippedIdentifier'));
    }

    public function buyReward(Request $request, $id)
    {
        $activeChild = null;
        if (session()->has('active_child_id')) {
            $activeChild = Child::find(session('active_child_id'));
        }
        if (!$activeChild) {
            $activeChild = Child::where('name', 'Pihu')->first();
        }

        $reward = \DB::table('rewards')->where('id', $id)->first();
        if (!$reward) {
            return back()->with('error', 'Reward not found.');
        }

        // Check if already bought
        $alreadyBought = \DB::table('child_reward')
            ->where('child_id', $activeChild->id)
            ->where('reward_id', $id)
            ->exists();

        if ($alreadyBought) {
            return back()->with('error', 'You already own this item!');
        }

        // Check if has enough coins (stars)
        if ($activeChild->stars < $reward->coins_cost) {
            return back()->with('error', 'Not enough stars! Play more games to earn stars.');
        }

        // Deduct coins (stars) and insert pivot
        $activeChild->decrement('stars', $reward->coins_cost);
        \DB::table('child_reward')->insert([
            'child_id' => $activeChild->id,
            'reward_id' => $id,
            'is_active' => false,
            'unlocked_at' => now()
        ]);

        return back()->with('success', 'Unlocked ' . $reward->title . '! Go ahead and equip it.');
    }

    public function equipReward(Request $request, $id)
    {
        $activeChild = null;
        if (session()->has('active_child_id')) {
            $activeChild = Child::find(session('active_child_id'));
        }
        if (!$activeChild) {
            $activeChild = Child::where('name', 'Pihu')->first();
        }

        // Verify child owns it
        $owned = \DB::table('child_reward')
            ->where('child_id', $activeChild->id)
            ->where('reward_id', $id)
            ->first();

        if (!$owned) {
            if ($id == 0) {
                // Special ID for unequipping (unequip all)
                \DB::table('child_reward')
                    ->where('child_id', $activeChild->id)
                    ->update(['is_active' => false]);
                $activeChild->update(['current_outfit' => 'default']);
                return back()->with('success', 'Outfit unequipped.');
            }
            return back()->with('error', 'You need to buy this item first!');
        }

        // Unequip all items
        \DB::table('child_reward')
            ->where('child_id', $activeChild->id)
            ->update(['is_active' => false]);

        // Equip the selected one
        \DB::table('child_reward')
            ->where('child_id', $activeChild->id)
            ->where('reward_id', $id)
            ->update(['is_active' => true]);

        // Get identifier to update child table
        $rewardIdentifier = \DB::table('rewards')->where('id', $id)->value('identifier');
        $activeChild->update(['current_outfit' => $rewardIdentifier]);

        return back()->with('success', 'Outfit equipped successfully!');
    }
}
