<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') — {{ config('app.name') }}</title>
    @include('partials.head-assets')
</head>
<body class="min-h-screen bg-slate-100 text-slate-900 antialiased">
<div class="flex min-h-screen">
    <aside class="hidden w-64 shrink-0 flex-col border-r border-slate-200 bg-slate-900 text-slate-100 md:flex">
        <div class="border-b border-slate-700 px-5 py-5">
            <div class="text-lg font-bold">{{ config('app.name') }}</div>
            <div class="text-xs text-slate-400">{{ auth()->user()->role->label() }}</div>
        </div>
        <nav class="flex-1 space-y-1 p-3">
            @yield('sidebar')
        </nav>
        <form method="POST" action="{{ route('logout') }}" class="border-t border-slate-700 p-3">
            @csrf
            <button type="submit" class="w-full rounded-lg bg-slate-800 px-3 py-2 text-sm hover:bg-slate-700">Keluar</button>
        </form>
    </aside>
    <div class="flex min-w-0 flex-1 flex-col">
        <header class="border-b border-slate-200 bg-white px-4 py-4 sm:px-6">
            <div class="flex items-center justify-between">
                <h1 class="text-lg font-semibold">@yield('page_title', 'Dashboard')</h1>
                <div class="text-sm text-slate-500">{{ auth()->user()->name }}</div>
            </div>
        </header>
        <main class="flex-1 p-4 sm:p-6">
            @include('partials.flash')
            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
