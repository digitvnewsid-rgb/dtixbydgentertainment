@extends('layouts.dashboard')
@section('title', 'Ticketing Dashboard')
@section('page_title', 'Dashboard Ticketing')
@section('sidebar')
    @include('partials.sidebar-link', ['href' => route('ticketing.dashboard'), 'label' => 'Dashboard', 'active' => true])
@endsection
@section('content')
<div class="grid gap-4 sm:grid-cols-3">
    @include('partials.stat-card', ['label' => 'Event Ditugaskan', 'value' => $stats['assigned_events']])
    @include('partials.stat-card', ['label' => 'Sudah Check-in', 'value' => $stats['checked_in']])
    @include('partials.stat-card', ['label' => 'Scan Hari Ini', 'value' => $stats['scans_today']])
</div>
@if ($events->isNotEmpty())
    <h2 class="mb-3 mt-8 font-semibold">Event yang ditugaskan</h2>
    <ul class="space-y-2">
        @foreach ($events as $event)
            <li class="rounded-lg border border-slate-200 bg-white px-4 py-3 text-sm">
                {{ $event->title }} — {{ $event->start_datetime->format('d M Y') }}
            </li>
        @endforeach
    </ul>
@endif
<p class="mt-6 text-sm text-slate-500">Modul scan QR akan tersedia pada Tahap 5.</p>
@endsection
