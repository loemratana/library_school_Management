<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Premium Library Management System for modern reading experiences.">
    <title>@yield('title', 'Library - Premium Book Management')</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    
    <!-- Icons (LineIcons or similar if needed, here just basic setup) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <nav class="navbar" id="navbar">
        <a href="{{ route('home') }}" class="logo">
            <i class="fa-solid fa-book-open-reader"></i> Libra
        </a>
        <ul class="nav-links">
            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
            <li><a href="{{ route('catalog') }}" class="{{ request()->routeIs('catalog') ? 'active' : '' }}">Catalog</a></li>
            @auth
                <li><a href="{{ route('member.dashboard') }}" class="{{ request()->routeIs('member.dashboard') ? 'active' : '' }}">Dashboard</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-secondary" style="padding: 0.4rem 1rem; font-size: 0.9rem;">Log Out</button>
                    </form>
                </li>
            @else
                <li><a href="{{ route('login') }}" class="btn btn-secondary">Sign In</a></li>
                <li><a href="{{ route('register') }}" class="btn btn-primary">Register</a></li>
            @endauth
        </ul>
    </nav>

    <main>
        @if(session('success'))
            <div style="background: rgba(16, 185, 129, 0.2); border: 1px solid #34d399; color: #34d399; padding: 1rem 5%; text-align: center;">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div style="background: rgba(239, 68, 68, 0.2); border: 1px solid #f87171; color: #f87171; padding: 1rem 5%; text-align: center;">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <footer style="text-align: center; padding: 3rem 5%; color: var(--text-muted); border-top: 1px solid var(--border); margin-top: 4rem;">
        <p>&copy; {{ date('Y') }} Libra Management System. All rights reserved.</p>
    </footer>

</body>
</html>
