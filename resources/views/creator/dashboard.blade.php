@extends('layouts.dashboard')
@section('title', 'Creator Dashboard')
@section('page_title', 'Dashboard Creator')
@section('sidebar')
    @include('partials.sidebar-link', ['href' => route('creator.dashboard'), 'label' => 'Dashboard', 'active' => true])
@endsection
@section('content')
<div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
    @include('partials.stat-card', ['label' => 'Event Saya', 'value' => $stats['events']])
    @include('partials.stat-card', ['label' => 'Tiket Terjual', 'value' => $stats['tickets_sold']])
    @include('partials.stat-card', ['label' => 'Pendapatan (Rp)', 'value' => number_format($stats['revenue'])])
    @include('partials.stat-card', ['label' => 'Peserta', 'value' => $stats['attendees']])
    @include('partials.stat-card', ['label' => 'Check-in', 'value' => $stats['check_ins']])
</div>
@endsection
