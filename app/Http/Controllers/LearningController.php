<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LearningController extends Controller
{
    private function getActiveChild()
    {
        if (session()->has('active_child_id')) {
            return Child::find(session('active_child_id'));
        }
        return Child::where('name', 'Pihu')->first();
    }

    public function tracing()
    {
        $activeChild = $this->getActiveChild();
        return view('learning.tracing', compact('activeChild'));
    }

    public function phonics()
    {
        $activeChild = $this->getActiveChild();
        return view('learning.phonics', compact('activeChild'));
    }

    public function balloonPop()
    {
        $activeChild = $this->getActiveChild();
        return view('learning.balloon_pop', compact('activeChild'));
    }

    public function letterMatch()
    {
        $activeChild = $this->getActiveChild();
        return view('learning.letter_match', compact('activeChild'));
    }

    public function englishRhymes()
    {
        $activeChild = $this->getActiveChild();
        $course = Course::with('lessons')->where('slug', 'english-rhymes')->firstOrFail();
        return view('learning.english_rhymes', compact('activeChild', 'course'));
    }

    public function hindiRhymes()
    {
        $activeChild = $this->getActiveChild();
        $course = Course::with('lessons')->where('slug', 'hindi-rhymes')->firstOrFail();
        return view('learning.hindi_rhymes', compact('activeChild', 'course'));
    }

    public function devotional()
    {
        $activeChild = $this->getActiveChild();
        $course = Course::with('lessons')->where('slug', 'devotional-learning')->firstOrFail();
        return view('learning.devotional', compact('activeChild', 'course'));
    }

    public function cultural()
    {
        $activeChild = $this->getActiveChild();
        $course = Course::with('lessons')->where('slug', 'cultural-stories')->firstOrFail();
        return view('learning.cultural', compact('activeChild', 'course'));
    }

    public function addStars(Request $request)
    {
        $request->validate([
            'stars' => 'required|integer|min:1',
            'activity_name' => 'required|string|max:100',
            'increase_level' => 'nullable|boolean',
        ]);

        $activeChild = $this->getActiveChild();
        if ($activeChild) {
            $activeChild->increment('stars', $request->stars);

            $levelIncreased = false;
            if ($request->input('increase_level')) {
                $activeChild->increment('level');
                $levelIncreased = true;
            }

            // Save log in activities table
            \DB::table('activities')->insert([
                'child_id' => $activeChild->id,
                'activity_type' => 'game',
                'activity_name' => $request->activity_name,
                'xp_earned' => $request->stars * 2,
                'stars_earned' => $request->stars,
                'details' => $levelIncreased ? 'Completed and reached level ' . $activeChild->level : 'Completed tracking',
                'created_at' => now(),
                'updated_at' => now()
            ]);

            return response()->json([
                'success' => true,
                'new_stars' => $activeChild->stars,
                'new_level' => $activeChild->level
            ]);
        }

        return response()->json(['success' => false, 'message' => 'No active child profile'], 400);
    }

    public function numbers()
    {
        $activeChild = $this->getActiveChild();
        return view('learning.numbers', compact('activeChild'));
    }

    public function shapes()
    {
        $activeChild = $this->getActiveChild();
        return view('learning.shapes', compact('activeChild'));
    }

    public function colors()
    {
        $activeChild = $this->getActiveChild();
        return view('learning.colors', compact('activeChild'));
    }

    public function quiz()
    {
        $activeChild = $this->getActiveChild();
        return view('learning.quiz', compact('activeChild'));
    }
}
