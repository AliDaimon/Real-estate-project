
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title',  'سكني ')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <div class="nav-brand">
                <a href="{{ route('home') }}">سكني  </a>
            </div>
            <div class="nav-links">
                <a href="{{ route('home') }}">الرئيسية</a>
                <a href="{{ route('properties.index') }}">العقارات</a>

                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('properties.create') }}">إضافة عقار</a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="logout-btn">تسجيل الخروج</button>
                    </form>
                @else
                    <a href="{{ route('login') }}">تسجيل الدخول</a>
                    <a href="{{ route('register') }}">التسجيل</a>
                @endauth
            </div>
        </div>
    </nav>

    <main>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 سكني للعقارات. جميع الحقوق محفوظة.</p>
        </div>
    </footer>
</body>
</html>
