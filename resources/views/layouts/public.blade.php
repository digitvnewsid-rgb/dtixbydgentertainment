<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Home') — {{ config('app.name') }}</title>
    @include('partials.head-assets')
</head>
<body class="min-h-screen bg-slate-50 text-slate-900 antialiased">
<header class="border-b border-slate-200 bg-white">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6">
        <a href="{{ route('home') }}" class="text-xl font-bold text-indigo-600">{{ config('app.name') }}</a>
        <nav class="flex items-center gap-3 text-sm">
            <a href="{{ route('home') }}" class="hover:text-indigo-600">Event</a>
            @auth
                <a href="{{ route(auth()->user()->role->dashboardRoute()) }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-white">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="hover:text-indigo-600">Login</a>
                <a href="{{ route('register') }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-white">Daftar</a>
            @endauth
        </nav>
    </div>
</header>
<main>
    @include('partials.flash')
    @yield('content')
</main>
<footer class="mt-12 border-t border-slate-200 bg-white py-8 text-center text-sm text-slate-500">
    &copy; {{ date('Y') }} Event Ticketing Management System
</footer>
</body>
</html>
