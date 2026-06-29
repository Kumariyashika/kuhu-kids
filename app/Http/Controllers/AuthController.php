<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ParentProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:15',
            'password' => 'required|string|min:6|confirmed',
            'parent_pin' => 'required|string|size:4|regex:/^[0-9]+$/',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => explode('@', $request->email)[0],
            'password' => Hash::make($request->password),
            'role' => 'parent',
        ]);

        ParentProfile::create([
            'user_id' => $user->id,
            'phone' => $request->phone,
            'subscription_status' => 'free',
            'parent_pin' => $request->parent_pin,
        ]);

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Parent registered successfully!');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Auto-select the first child if available
            $parentProfile = Auth::user()->parentProfile;
            if ($parentProfile && $parentProfile->children()->count() > 0) {
                $child = $parentProfile->children()->first();
                session(['active_child_id' => $child->id]);
            }

            return redirect()->route('dashboard')->with('success', 'Welcome back!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('dashboard')->with('success', 'Logged out safely.');
    }

    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);
        // For demonstration purposes, we will simply flash a success message and allow resetting directly
        return back()->with('success', 'A password reset link has been simulated and sent to your email!');
    }
}
