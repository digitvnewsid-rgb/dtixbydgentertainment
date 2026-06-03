@extends('layouts.dashboard')
@section('title', 'Customer Dashboard')
@section('page_title', 'Dashboard Customer')
@section('sidebar')
    @include('partials.sidebar-link', ['href' => route('customer.dashboard'), 'label' => 'Dashboard', 'active' => true])
@endsection
@section('content')
<div class="grid gap-4 sm:grid-cols-3">
    @include('partials.stat-card', ['label' => 'Total Order', 'value' => $stats['orders']])
    @include('partials.stat-card', ['label' => 'Tiket Saya', 'value' => $stats['tickets']])
    @include('partials.stat-card', ['label' => 'Menunggu Bayar', 'value' => $stats['pending_payment']])
</div>
@endsection
