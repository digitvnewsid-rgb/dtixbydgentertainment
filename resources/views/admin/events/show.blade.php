@extends('layouts.admin')
@section('title', $event->title)
@section('content')
<h2 class="mb-3">{{ $event->title }}</h2>
<div class="card shadow-sm mb-3"><div class="card-body">
<p class="text-muted">Slug: <code>{{ $event->slug }}</code></p>
<p>Kategori: {{ $event->category->name }}</p>
<p>Venue: {{ $event->venue->name }} ({{ $event->venue->city }})</p>
<p>Jadwal: {{ $event->start_at->format('d M Y H:i') }} — {{ $event->end_at->format('d M Y H:i') }}</p>
<p>Status: <span class="badge bg-secondary">{{ $event->status }}</span></p>
<p>{{ $event->description ?: '—' }}</p>
<a href="{{ route('admin.events.edit', $event) }}" class="btn btn-primary btn-sm">Edit</a>
</div></div>
@if ($event->ticketTypes->isNotEmpty())
<h5 class="mb-2">Tipe Tiket</h5>
<ul class="list-group mb-3">
@foreach ($event->ticketTypes as $ticket)
    <li class="list-group-item d-flex justify-content-between">
        <span>{{ $ticket->name }}</span>
        <span>Rp {{ number_format($ticket->price) }} · {{ $ticket->sold_count }}/{{ $ticket->quota }}</span>
    </li>
@endforeach
</ul>
@else
<p class="text-muted">Belum ada tipe tiket (modul berikutnya).</p>
@endif
@endsection
