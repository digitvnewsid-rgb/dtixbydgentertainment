<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Home') — {{ config('app.name') }}</title>
    @include('partials.head-assets')
</head>
<body class="min-h-screen bg-slate-50 text-slate-900 antialiased">
    
    <!-- Modern Navbar -->
    <header class="navbar" id="navbar">
        <div class="container-custom">
            <div class="flex items-center justify-between py-4">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-primary-600 to-secondary-600 text-white font-bold text-lg shadow-md group-hover:shadow-lg transition-all">
                        ET
                    </div>
                    <span class="text-xl font-bold gradient-text hidden sm:block">{{ config('app.name') }}</span>
                </a>

                <!-- Desktop Navigation -->
                <nav class="hidden md:flex items-center gap-6 text-sm font-medium">
                    <a href="{{ route('home') }}" class="text-slate-700 hover:text-primary-600 transition-colors {{ request()->routeIs('home') ? 'text-primary-600' : '' }}">
                        Jelajah Event
                    </a>
                    <a href="{{ route('home') }}#kategori" class="text-slate-700 hover:text-primary-600 transition-colors">
                        Kategori
                    </a>
                    @auth
                        <a href="{{ route(auth()->user()->role->dashboardRoute()) }}" class="text-slate-700 hover:text-primary-600 transition-colors">
                            Dashboard
                        </a>
                    @endauth
                </nav>

                <!-- Auth Buttons -->
                <div class="flex items-center gap-3">
                    @auth
                        <div class="hidden md:flex items-center gap-3">
                            <span class="text-sm text-slate-600">Halo, <span class="font-medium">{{ auth()->user()->name }}</span></span>
                            <a href="{{ route(auth()->user()->role->dashboardRoute()) }}" class="btn-primary btn-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                                </svg>
                                Dashboard
                            </a>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn-ghost btn-sm hidden md:inline-flex">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="btn-primary btn-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                            </svg>
                            Daftar
                        </a>
                    @endauth

                    <!-- Mobile Menu Button -->
                    <button id="mobile-menu-button" class="md:hidden btn-ghost btn-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden md:hidden pb-4 animate-slide-down">
                <nav class="flex flex-col gap-2">
                    <a href="{{ route('home') }}" class="px-4 py-2 text-sm rounded-lg text-slate-700 hover:bg-slate-100 {{ request()->routeIs('home') ? 'bg-primary-50 text-primary-700' : '' }}">
                        Jelajah Event
                    </a>
                    <a href="{{ route('home') }}#kategori" class="px-4 py-2 text-sm rounded-lg text-slate-700 hover:bg-slate-100">
                        Kategori
                    </a>
                    @auth
                        <a href="{{ route(auth()->user()->role->dashboardRoute()) }}" class="px-4 py-2 text-sm rounded-lg text-slate-700 hover:bg-slate-100">
                            Dashboard
                        </a>
                        <div class="px-4 py-2 text-xs text-slate-500 border-t mt-2 pt-2">
                            {{ auth()->user()->name }} ({{ auth()->user()->email }})
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 text-sm rounded-lg text-slate-700 hover:bg-slate-100">
                            Login
                        </a>
                    @endauth
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @include('partials.flash')
        @yield('content')
    </main>

    <!-- Modern Footer -->
    <footer class="mt-20 border-t border-slate-200 bg-white">
        <div class="container-custom py-12">
            <div class="grid gap-8 md:grid-cols-4">
                <!-- Brand -->
                <div class="md:col-span-1">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-primary-600 to-secondary-600 text-white font-bold text-lg shadow-md">
                            ET
                        </div>
                        <span class="text-lg font-bold gradient-text">{{ config('app.name') }}</span>
                    </div>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Platform penjualan tiket event terpercaya untuk berbagai acara menarik di Indonesia.
                    </p>
                    <div class="flex gap-3 mt-4">
                        <a href="#" class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100 text-slate-600 hover:bg-primary-100 hover:text-primary-600 transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a href="#" class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100 text-slate-600 hover:bg-primary-100 hover:text-primary-600 transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                        </a>
                        <a href="#" class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100 text-slate-600 hover:bg-primary-100 hover:text-primary-600 transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Event -->
                <div>
                    <h3 class="font-semibold text-slate-900 mb-4">Event</h3>
                    <ul class="space-y-2 text-sm text-slate-600">
                        <li><a href="{{ route('home') }}" class="hover:text-primary-600 transition-colors">Jelajah Event</a></li>
                        <li><a href="{{ route('home') }}#kategori" class="hover:text-primary-600 transition-colors">Semua Kategori</a></li>
                        <li><a href="#" class="hover:text-primary-600 transition-colors">Event Mendatang</a></li>
                        <li><a href="#" class="hover:text-primary-600 transition-colors">Event Populer</a></li>
                    </ul>
                </div>

                <!-- Bantuan -->
                <div>
                    <h3 class="font-semibold text-slate-900 mb-4">Bantuan</h3>
                    <ul class="space-y-2 text-sm text-slate-600">
                        <li><a href="#" class="hover:text-primary-600 transition-colors">Pusat Bantuan</a></li>
                        <li><a href="#" class="hover:text-primary-600 transition-colors">Cara Pemesanan</a></li>
                        <li><a href="#" class="hover:text-primary-600 transition-colors">Syarat & Ketentuan</a></li>
                        <li><a href="#" class="hover:text-primary-600 transition-colors">Kebijakan Privasi</a></li>
                    </ul>
                </div>

                <!-- Tentang -->
                <div>
                    <h3 class="font-semibold text-slate-900 mb-4">Tentang Kami</h3>
                    <ul class="space-y-2 text-sm text-slate-600">
                        <li><a href="#" class="hover:text-primary-600 transition-colors">Tentang Platform</a></li>
                        <li><a href="#" class="hover:text-primary-600 transition-colors">Hubungi Kami</a></li>
                        <li><a href="#" class="hover:text-primary-600 transition-colors">Karir</a></li>
                        <li><a href="#" class="hover:text-primary-600 transition-colors">Blog</a></li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Footer -->
            <div class="mt-12 pt-8 border-t border-slate-200 flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-sm text-slate-500">
                    &copy; {{ date('Y') }} Event Ticketing Management System. All rights reserved.
                </p>
                <div class="flex items-center gap-6 text-sm text-slate-500">
                    <a href="#" class="hover:text-primary-600 transition-colors">Syarat Layanan</a>
                    <a href="#" class="hover:text-primary-600 transition-colors">Privasi</a>
                    <a href="#" class="hover:text-primary-600 transition-colors">Cookies</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu Toggle Script -->
    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Add shadow to navbar on scroll
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 10) {
                navbar.classList.add('navbar-shadow');
            } else {
                navbar.classList.remove('navbar-shadow');
            }
        });
    </script>
</body>
</html>
