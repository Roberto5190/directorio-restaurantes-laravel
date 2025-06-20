<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'MiCiudadGourmet')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">MiCiudadGourmet</a>
        <ul class="navbar-nav ms-auto">
            @auth
                <li class="nav-item"><span class="nav-link">{{ auth()->user()->name }}</span></li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST">@csrf
                        <button class="btn btn-link nav-link">Logout</button>
                    </form>
                </li>
            @else
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
            @endauth
        </ul>
    </div>
</nav>

<div class="container">
    @include('partials.flash-messages')
    @yield('content')
</div>
</body>
</html>

