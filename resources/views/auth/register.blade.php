@extends('layouts.app')

@section('title', 'Parent Registration - Kuhu Kids Learning')

@section('content')
<div class="auth-card" style="max-width: 550px;">
    <h1 class="auth-title">📝 Parent Registration</h1>
    
    @if ($errors->any())
        <div style="color: #FF5757; font-weight: bold; margin-bottom: 15px; text-align: center;">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('register') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label class="form-label" for="name">Parent Full Name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Enter your name" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label class="form-label" for="email">Email Address</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="parent@example.com" value="{{ old('email') }}" required>
        </div>

        <div class="form-group">
            <label class="form-label" for="phone">Phone Number (Optional)</label>
            <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter phone number" value="{{ old('phone') }}">
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="••••••••" required>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label" for="parent_pin">Set 4-Digit Parent Zone PIN</label>
            <input type="text" name="parent_pin" id="parent_pin" class="form-control" placeholder="1234" required maxlength="4" pattern="[0-9]{4}" style="letter-spacing: 4px; text-align: center; font-size: 1.3rem;">
            <small style="color: var(--color-gray); font-size: 0.8rem; display: block; margin-top: 4px; text-align: center;">This 4-digit code will be used to access the Parent dashboard.</small>
        </div>

        <button type="submit" class="btn-3d" style="width: 100%; font-size: 1.2rem; background: var(--color-purple); color: white; border-bottom: 5px solid var(--color-purple-shadow); margin-top: 10px;">
            Register Account &gt;
        </button>
    </form>

    <div style="margin-top: 20px; text-align: center; font-size: 0.95rem;">
        <p style="color: var(--color-gray);">Already have an parent account?</p>
        <a href="{{ route('login') }}" style="color: var(--color-purple); font-weight: bold; text-decoration: none; margin-top: 5px; display: inline-block;">Log In</a>
    </div>
    
    <hr style="border: 0; border-top: 2px solid #F1F5F9; margin: 20px 0;">
    
    <div style="text-align: center;">
        <a href="{{ route('dashboard') }}" class="btn-3d btn-yellow" style="width: 100%;">🎮 Back to Kids Zone</a>
    </div>
</div>
@endsection
