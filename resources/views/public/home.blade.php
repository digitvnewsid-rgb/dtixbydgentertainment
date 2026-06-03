@extends('layouts.public')
@section('title', 'Home')
@section('content')
<section class="bg-gradient-to-br from-indigo-600 to-violet-700 px-4 py-16 text-white sm:px-6">
    <div class="mx-auto max-w-7xl">
        <h1 class="text-3xl font-bold sm:text-4xl">Temukan Event Terbaik</h1>
        <p class="mt-3 max-w-2xl text-indigo-100">Platform penjualan tiket event — konser, teater, festival, dan lainnya.</p>
    </div>
</section>
<section class="mx-auto max-w-7xl px-4 py-12 sm:px-6">
    <h2 class="mb-6 text-xl font-semibold">Event Terbaru</h2>
    @if ($events->isEmpty())
        <p class="rounded-xl border border-dashed border-slate-300 bg-white p-8 text-center text-slate-500">
            Belum ada event published. (Tahap 2: Creator dapat publish event)
        </p>
    @else
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($events as $event)
                <article class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
                    <div class="h-40 bg-gradient-to-br from-indigo-100 to-violet-100"></div>
                    <div class="p-5">
                        <span class="text-xs font-medium text-indigo-600">{{ $event->category->name }}</span>
                        <h3 class="mt-1 font-semibold">{{ $event->title }}</h3>
                        <p class="mt-2 text-sm text-slate-500">{{ $event->location }}</p>
                        <p class="text-sm text-slate-500">{{ $event->start_datetime->format('d M Y H:i') }}</p>
                        @if ($event->ticketTypes->isNotEmpty())
                            <p class="mt-2 text-sm font-medium text-indigo-600">Mulai Rp {{ number_format($event->ticketTypes->min('price')) }}</p>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>
    @endif
</section>
@endsection
