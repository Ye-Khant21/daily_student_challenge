<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Today’s challenge') · Daily Student Challenge</title>
    <link rel="stylesheet" href="{{ asset('challenge.css') }}">
</head>
<body>
    <a class="skip-link" href="#main">Skip to content</a>
    <header class="site-header">
        <div class="shell header-inner">
            <a class="brand" href="{{ route('home') }}"><span class="brand-mark" aria-hidden="true">D</span> <span>Daily Student Challenge</span></a>
            <nav aria-label="Main navigation">
                <a href="{{ route('home') }}" @if (request()->routeIs('home')) aria-current="page" @endif>Today</a>
                <a href="{{ route('challenges.history') }}" @if (request()->routeIs('challenges.history')) aria-current="page" @endif>Past challenges</a>
                @auth
                    <a href="{{ route('student.dashboard') }}" @if (request()->routeIs('student.dashboard')) aria-current="page" @endif>My submissions</a>
                    @can('access-admin')
                        <a href="{{ route('admin.submissions.index') }}" @if (request()->routeIs('admin.*')) aria-current="true" @endif>Admin</a>
                    @endcan
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="secondary" type="submit">Log out</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" @if (request()->routeIs('login')) aria-current="page" @endif>Log in</a>
                    <a href="{{ route('register') }}" @if (request()->routeIs('register')) aria-current="page" @endif>Register</a>
                @endauth
            </nav>
        </div>
    </header>
    <main id="main" class="shell @yield('page-class')">
        @if (session('success'))
            <p class="notice success" role="status">{{ session('success') }}</p>
        @endif
        @if ($errors->any())
            <ul class="notice error" role="alert">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        @yield('content')
    </main>
</body>
</html>
