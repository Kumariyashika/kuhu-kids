@extends('layouts.app')

@section('title', 'Parent Login - Kuhu Kids Learning')

@section('content')
<div class="auth-card">
    <h1 class="auth-title">🔒 Parent Login</h1>
    
    @if ($errors->any())
        <div style="color: #FF5757; font-weight: bold; margin-bottom: 15px; text-align: center;">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label class="form-label" for="email">Parent Email Address</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="parent@example.com" value="{{ old('email') }}" required>
        </div>

        <div class="form-group">
            <label class="form-label" for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>
        </div>

        <button type="submit" class="btn-3d" style="width: 100%; font-size: 1.2rem; background: var(--color-purple); color: white; border-bottom: 5px solid var(--color-purple-shadow); margin-top: 10px;">
            Log In &gt;
        </button>
    </form>

    <div style="margin-top: 20px; text-align: center; font-size: 0.95rem;">
        <p style="color: var(--color-gray);">Don't have an account?</p>
        <a href="{{ route('register') }}" style="color: var(--color-purple); font-weight: bold; text-decoration: none; margin-top: 5px; display: inline-block;">Register as a Parent</a>
    </div>

    <div style="margin-top: 10px; text-align: center; font-size: 0.85rem;">
        <a href="{{ route('forgot_password') }}" style="color: var(--color-gray); text-decoration: none;">Forgot your password?</a>
    </div>
    
    <hr style="border: 0; border-top: 2px solid #F1F5F9; margin: 20px 0;">
    
    <div style="text-align: center;">
        <a href="{{ route('dashboard') }}" class="btn-3d btn-yellow" style="width: 100%;">🎮 Back to Kids Zone</a>
    </div>
</div>
@endsection
