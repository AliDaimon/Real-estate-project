@extends('layouts.app')

@section('title', 'تسجيل الدخول')

@section('content')
<div class="container">
    <div class="auth-form">
        <h2>تسجيل الدخول</h2>
        
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="form-group">
                <label for="email">البريد الإلكتروني:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">كلمة المرور:</label>
                <input type="password" id="password" name="password" required>
                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary btn-full">دخول</button>
        </form>

        <p class="auth-link">
            ليس لديك حساب؟ <a href="{{ route('register') }}">سجل الآن</a>
        </p>
    </div>
</div>
@endsection