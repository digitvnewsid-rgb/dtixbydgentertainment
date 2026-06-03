@extends('layouts.dashboard')
@section('page_title', $event->title)
@section('sidebar')
    @include('partials.sidebar-link', ['href' => route('creator.events.index'), 'label' => 'Event Saya', 'active' => true])
@endsection
@section('content')
<div class="mb-4 flex flex-wrap gap-2">
    <a href="{{ route('creator.events.edit', $event) }}" class="rounded-lg border px-3 py-1 text-sm">Edit</a>
    <a href="{{ route('creator.events.ticket-types.index', $event) }}" class="rounded-lg bg-indigo-600 px-3 py-1 text-sm text-white">Jenis Tiket</a>
    @if ($event->status->value !== 'published')
        <form method="POST" action="{{ route('creator.events.publish', $event) }}">@csrf<button class="rounded-lg bg-green-600 px-3 py-1 text-sm text-white">Publish</button></form>
    @endif
    @if ($event->status->value === 'published')
        <form method="POST" action="{{ route('creator.events.close', $event) }}">@csrf<button class="rounded-lg bg-amber-600 px-3 py-1 text-sm text-white">Close</button></form>
    @endif
</div>
<div class="rounded-xl border bg-white p-6">
    @if ($event->banner)<img src="{{ Storage::url($event->banner) }}" class="mb-4 h-48 w-full rounded-lg object-cover">@endif
    @include('partials.status-badge', ['status' => $event->status->value])
    <h2 class="mt-2 text-xl font-bold">{{ $event->title }}</h2>
    <p class="mt-2">{{ $event->location }}</p>
    <p class="text-sm text-slate-500">{{ $event->start_datetime->format('d M Y H:i') }}</p>
</div>
@endsection
