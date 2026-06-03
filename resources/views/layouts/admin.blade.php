<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') — DTIX Entertainment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="d-flex">
    <aside class="bg-dark text-white p-3" style="min-width: 240px; min-height: 100vh;">
        <h5 class="mb-4">DTIX Admin</h5>
        <nav class="nav flex-column gap-1">
            <a class="nav-link text-white {{ request()->routeIs('admin.dashboard') ? 'fw-bold' : '' }}" href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a class="nav-link text-white {{ request()->routeIs('admin.categories.*') ? 'fw-bold' : '' }}" href="{{ route('admin.categories.index') }}">Kategori Event</a>
            <a class="nav-link text-white {{ request()->routeIs('admin.venues.*') ? 'fw-bold' : '' }}" href="{{ route('admin.venues.index') }}">Lokasi Venue</a>
            <a class="nav-link text-white {{ request()->routeIs('admin.events.*') ? 'fw-bold' : '' }}" href="{{ route('admin.events.index') }}">Acara</a>
        </nav>
        <form method="POST" action="{{ route('admin.logout') }}" class="mt-4">
            @csrf
            <button type="submit" class="btn btn-outline-light btn-sm w-100">Keluar</button>
        </form>
    </aside>
    <main class="flex-grow-1 p-4">
        @include('partials.alerts')
        @yield('content')
    </main>
</div>
</body>
</html>
