@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <h2 class="mb-4">Dashboard</h2>
    <div class="row g-3">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="text-muted">Kategori Event</div>
                    <div class="fs-2 fw-bold">{{ $stats['categories'] }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="text-muted">Lokasi Venue</div>
                    <div class="fs-2 fw-bold">{{ $stats['venues'] }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="text-muted">Acara</div>
                    <div class="fs-2 fw-bold">{{ $stats['events'] }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
