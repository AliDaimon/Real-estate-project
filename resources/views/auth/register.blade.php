@extends('layouts.app')

@section('title', 'التسجيل')

@section('content')
<div class="container">
    <div class="auth-form">
        <h2>إنشاء حساب جديد</h2>
        
        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <div class="form-group">
                <label for="name">الاسم:</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

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

            <div class="form-group">
                <label for="password_confirmation">تأكيد كلمة المرور:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>
            <div class="form-group">
                <label for="role">نوع الحساب:</label>
                <select name="role" id="role" class="form-control" required>
                    <option value="user">مستخدم عادي</option>
                    <option value="renter">صاحب عقار</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary btn-full">تسجيل</button>
        </form>

        <p class="auth-link">
            لديك حساب بالفعل؟ <a href="{{ route('login') }}">سجل دخولك</a>
        </p>
    
    </div>
</div>
@endsection