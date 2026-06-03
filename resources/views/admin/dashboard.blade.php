@extends('layouts.dashboard')
@section('title', 'Admin Dashboard')
@section('page_title', 'Dashboard Administrator')
@section('sidebar')
    @include('partials.sidebar-link', ['href' => route('admin.dashboard'), 'label' => 'Dashboard', 'active' => request()->routeIs('admin.dashboard')])
    @include('partials.sidebar-link', ['href' => route('admin.users.index'), 'label' => 'Kelola User'])
@endsection
@section('content')
<div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
    @include('partials.stat-card', ['label' => 'Total Event', 'value' => $stats['events']])
    @include('partials.stat-card', ['label' => 'Creator', 'value' => $stats['creators']])
    @include('partials.stat-card', ['label' => 'Customer', 'value' => $stats['customers']])
    @include('partials.stat-card', ['label' => 'Tiket Terjual', 'value' => $stats['tickets_sold']])
    @include('partials.stat-card', ['label' => 'Order Pending', 'value' => $stats['orders_pending']])
    @include('partials.stat-card', ['label' => 'Order Paid', 'value' => $stats['orders_paid']])
    @include('partials.stat-card', ['label' => 'Pendapatan (Rp)', 'value' => number_format($stats['revenue'])])
    @include('partials.stat-card', ['label' => 'Check-in', 'value' => $stats['check_ins']])
</div>
<p class="mt-6 text-sm text-slate-500">Modul event, pembayaran, dan laporan akan ditambahkan pada Tahap 2–6.</p>
@endsection
