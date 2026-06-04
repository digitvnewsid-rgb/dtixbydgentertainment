@extends('layouts.public')
@section('title', 'Home')
@section('content')

<!-- Hero Section -->
<section class="hero-gradient relative overflow-hidden">
    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4xIj48cGF0aCBkPSJNMzYgMzRjMC0yLjIxLTEuNzktNC00LTRzLTQgMS43OS00IDQgMS43OSA0IDQgNCA0LTEuNzkgNC00em0wLTEwYzAtMi4yMS0xLjc5LTQtNC00cy00IDEuNzktNCA0IDEuNzkgNCA0IDQgNC0xLjc5IDQtNHptMC0xMGMwLTIuMjEtMS43OS00LTQtNHMtNCAxLjc5LTQgNCAxLjc5IDQgNCA0IDQtMS43OSA0LTR6Ii8+PC9nPjwvZz48L3N2Zz4=')] opacity-20"></div>
    
    <div class="container-custom relative py-20 sm:py-28">
        <div class="mx-auto max-w-4xl text-center animate-fade-in">
            <h1 class="text-4xl font-bold text-white sm:text-5xl lg:text-6xl leading-tight">
                Temukan & Pesan Tiket<br>
                <span class="text-primary-200">Event Terbaik</span>
            </h1>
            <p class="mt-6 text-lg text-primary-100 sm:text-xl max-w-2xl mx-auto">
                Platform penjualan tiket event terpercaya — konser, teater, festival, olahraga, dan berbagai acara menarik lainnya.
            </p>

            <!-- Search Bar -->
            <div class="mt-10 animate-slide-up">
                <div class="mx-auto max-w-3xl">
                    <form action="{{ route('home') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                        <div class="flex-1 relative">
                            <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input 
                                type="text" 
                                name="search" 
                                placeholder="Cari event, artis, atau lokasi..." 
                                class="w-full pl-12 pr-4 py-4 rounded-xl bg-white/95 backdrop-blur-sm border-0 text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-4 focus:ring-white/30 shadow-lg text-base"
                                value="{{ request('search') }}"
                            >
                        </div>
                        <button type="submit" class="btn-accent btn-lg shadow-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Cari Event
                        </button>
                    </form>
                </div>
            </div>

            <!-- Trust Indicators -->
            <div class="mt-12 grid grid-cols-3 gap-6 max-w-2xl mx-auto">
                <div class="text-center">
                    <div class="text-3xl font-bold text-white">500+</div>
                    <div class="text-sm text-primary-200 mt-1">Event Tersedia</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-white">50K+</div>
                    <div class="text-sm text-primary-200 mt-1">Tiket Terjual</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-white">4.8★</div>
                    <div class="text-sm text-primary-200 mt-1">Rating Pengguna</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Wave Divider -->
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
            <path d="M0 120L60 105C120 90 240 60 360 45C480 30 600 30 720 37.5C840 45 960 60 1080 67.5C1200 75 1320 75 1380 75L1440 75V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="rgb(248 250 252)"/>
        </svg>
    </div>
</section>

<!-- Categories Section -->
<section class="container-custom py-12" id="kategori">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-slate-900">Jelajah Berdasarkan Kategori</h2>
    </div>
    
    <div class="flex gap-3 overflow-x-auto pb-4 scrollbar-thin">
        <a href="{{ route('home') }}" class="badge-primary whitespace-nowrap px-5 py-2.5 text-sm {{ !request('category') ? 'ring-2 ring-primary-500 ring-offset-2' : '' }}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
            </svg>
            Semua Kategori
        </a>
        <a href="{{ route('home', ['category' => 'musik']) }}" class="badge bg-white border border-slate-200 text-slate-700 hover:border-primary-300 hover:bg-primary-50 whitespace-nowrap px-5 py-2.5 text-sm">
            🎵 Musik & Konser
        </a>
        <a href="{{ route('home', ['category' => 'olahraga']) }}" class="badge bg-white border border-slate-200 text-slate-700 hover:border-primary-300 hover:bg-primary-50 whitespace-nowrap px-5 py-2.5 text-sm">
            ⚽ Olahraga
        </a>
        <a href="{{ route('home', ['category' => 'teater']) }}" class="badge bg-white border border-slate-200 text-slate-700 hover:border-primary-300 hover:bg-primary-50 whitespace-nowrap px-5 py-2.5 text-sm">
            🎭 Teater & Seni
        </a>
        <a href="{{ route('home', ['category' => 'festival']) }}" class="badge bg-white border border-slate-200 text-slate-700 hover:border-primary-300 hover:bg-primary-50 whitespace-nowrap px-5 py-2.5 text-sm">
            🎪 Festival
        </a>
        <a href="{{ route('home', ['category' => 'seminar']) }}" class="badge bg-white border border-slate-200 text-slate-700 hover:border-primary-300 hover:bg-primary-50 whitespace-nowrap px-5 py-2.5 text-sm">
            📚 Seminar & Workshop
        </a>
    </div>
</section>

<!-- Events Section -->
<section class="container-custom pb-16">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-slate-900">
            @if(request('search'))
                Hasil Pencarian "{{ request('search') }}"
            @else
                Event Terbaru & Populer
            @endif
        </h2>
        <div class="hidden sm:flex items-center gap-2 text-sm text-slate-600">
            <span>Urutkan:</span>
            <select class="input py-2 px-3 text-sm w-auto">
                <option>Terbaru</option>
                <option>Populer</option>
                <option>Harga Terendah</option>
                <option>Harga Tertinggi</option>
            </select>
        </div>
    </div>

    @if ($events->isEmpty())
        <div class="rounded-2xl border-2 border-dashed border-slate-300 bg-white p-16 text-center">
            <div class="mx-auto w-24 h-24 rounded-full bg-slate-100 flex items-center justify-center mb-4">
                <svg class="w-12 h-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-slate-900 mb-2">Belum Ada Event</h3>
            <p class="text-slate-600 max-w-md mx-auto">
                Belum ada event yang dipublish saat ini. Creator dapat membuat dan mempublish event melalui dashboard.
            </p>
            @auth
                @if(auth()->user()->role->value === 'creator' || auth()->user()->role->value === 'administrator')
                    <a href="{{ route(auth()->user()->role->dashboardRoute()) }}" class="btn-primary mt-6 inline-flex">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Buat Event Baru
                    </a>
                @endif
            @endauth
        </div>
    @else
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ($events as $event)
                <article class="event-card group">
                    <!-- Event Image -->
                    <div class="relative overflow-hidden">
                        <div class="event-card-image group-hover:scale-110 transition-transform duration-500"></div>
                        
                        <!-- Category Badge -->
                        <div class="absolute top-3 left-3">
                            <span class="badge-primary shadow-lg backdrop-blur-sm bg-white/90">
                                {{ $event->category->name }}
                            </span>
                        </div>

                        <!-- Status Badge -->
                        @if($event->status->value === 'published')
                            <div class="absolute top-3 right-3">
                                <span class="badge-success shadow-lg backdrop-blur-sm bg-white/90">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    Available
                                </span>
                            </div>
                        @endif
                    </div>

                    <!-- Event Details -->
                    <div class="p-5">
                        <h3 class="font-semibold text-slate-900 text-lg group-hover:text-primary-600 transition-colors line-clamp-2 mb-2">
                            {{ $event->title }}
                        </h3>
                        
                        <!-- Date & Time -->
                        <div class="flex items-center gap-2 text-sm text-slate-600 mb-2">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>{{ $event->start_datetime->format('d M Y') }}</span>
                        </div>

                        <!-- Location -->
                        <div class="flex items-center gap-2 text-sm text-slate-600 mb-4">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="line-clamp-1">{{ $event->location }}</span>
                        </div>

                        <!-- Price & CTA -->
                        <div class="flex items-center justify-between pt-4 border-t border-slate-100">
                            @if ($event->ticketTypes->isNotEmpty())
                                <div>
                                    <div class="text-xs text-slate-500 mb-0.5">Mulai dari</div>
                                    <div class="text-lg font-bold text-primary-600">
                                        Rp {{ number_format($event->ticketTypes->min('price'), 0, ',', '.') }}
                                    </div>
                                </div>
                            @else
                                <div class="text-sm text-slate-500">Harga segera hadir</div>
                            @endif
                            
                            <button class="btn-primary btn-sm group-hover:shadow-lg">
                                Beli
                                <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($events->hasPages())
            <div class="mt-12">
                {{ $events->links() }}
            </div>
        @endif
    @endif
</section>

<!-- Call to Action Section -->
<section class="bg-gradient-to-br from-slate-900 to-slate-800 text-white py-20">
    <div class="container-custom text-center">
        <h2 class="text-3xl font-bold mb-4">Punya Event yang Ingin Dipromosikan?</h2>
        <p class="text-slate-300 mb-8 max-w-2xl mx-auto">
            Bergabunglah sebagai event creator dan jual tiket event Anda dengan mudah melalui platform kami.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            @guest
                <a href="{{ route('register') }}" class="btn bg-white text-slate-900 hover:bg-slate-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                    Daftar Sekarang
                </a>
            @else
                <a href="{{ route(auth()->user()->role->dashboardRoute()) }}" class="btn bg-white text-slate-900 hover:bg-slate-100">
                    Buat Event
                </a>
            @endguest
            <a href="#" class="btn-ghost border border-white/30 text-white hover:bg-white/10">
                Pelajari Lebih Lanjut
            </a>
        </div>
    </div>
</section>

@endsection
