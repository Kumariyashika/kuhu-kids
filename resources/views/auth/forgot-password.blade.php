@extends('layouts.app')

@section('title', 'Forgot Password - Kuhu Kids Learning')

@section('content')
<div class="auth-card">
    <h1 class="auth-title">🔑 Reset Password</h1>
    
    @if (session('success'))
        <div style="background: #E8F5E9; border: 2px solid #81C784; padding: 12px; border-radius: 12px; font-weight: bold; margin-bottom: 20px; color: #2E7D32; text-align: center;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('forgot_password') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label class="form-label" for="email">Parent Email Address</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="parent@example.com" required>
        </div>

        <button type="submit" class="btn-3d" style="width: 100%; font-size: 1.2rem; background: var(--color-purple); color: white; border-bottom: 5px solid var(--color-purple-shadow); margin-top: 10px;">
            Send Reset Instructions &gt;
        </button>
    </form>

    <div style="margin-top: 20px; text-align: center; font-size: 0.95rem;">
        <a href="{{ route('login') }}" style="color: var(--color-purple); font-weight: bold; text-decoration: none;">&lt; Back to Log In</a>
    </div>
</div>
@endsection
