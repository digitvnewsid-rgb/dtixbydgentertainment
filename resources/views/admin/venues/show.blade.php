@extends('layouts.admin')
@section('title', $venue->name)
@section('content')
<h2 class="mb-3">{{ $venue->name }}</h2>
<div class="card shadow-sm mb-3"><div class="card-body">
<p class="text-muted">Slug: <code>{{ $venue->slug }}</code></p>
<p>{{ $venue->address }}, {{ $venue->city }}</p>
<p>Kapasitas: {{ number_format($venue->capacity) }}</p>
<p>{{ $venue->description ?: '—' }}</p>
<p>Status: <span class="badge bg-{{ $venue->is_active ? 'success' : 'secondary' }}">{{ $venue->is_active ? 'Aktif' : 'Nonaktif' }}</span></p>
<a href="{{ route('admin.venues.edit', $venue) }}" class="btn btn-primary btn-sm">Edit</a>
</div></div>
@if ($venue->events->isNotEmpty())
<h5 class="mb-2">Acara di venue ini</h5>
<ul class="list-group">
@foreach ($venue->events as $event)
    <li class="list-group-item d-flex justify-content-between">
        <span>{{ $event->title }} <small class="text-muted">({{ $event->category->name }})</small></span>
        <a href="{{ route('admin.events.show', $event) }}">Detail</a>
    </li>
@endforeach
</ul>
@endif
@endsection
