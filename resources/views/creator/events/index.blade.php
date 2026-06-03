@extends('layouts.dashboard')
@section('page_title', 'Event Saya')
@section('sidebar')
    @include('partials.sidebar-link', ['href' => route('creator.dashboard'), 'label' => 'Dashboard'])
    @include('partials.sidebar-link', ['href' => route('creator.events.index'), 'label' => 'Event Saya', 'active' => true])
@endsection
@section('content')
<div class="mb-4 flex justify-end"><a href="{{ route('creator.events.create') }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm text-white">Buat Event</a></div>
@include('partials.event-filters')
<div class="grid gap-4 sm:grid-cols-2">
@foreach ($events as $event)
    <article class="rounded-xl border bg-white p-4 shadow-sm">
        @include('partials.status-badge', ['status' => $event->status->value])
        <h3 class="mt-2 font-semibold">{{ $event->title }}</h3>
        <p class="text-sm text-slate-500">{{ $event->location }} · {{ $event->ticket_types_count }} tiket</p>
        <a href="{{ route('creator.events.show', $event) }}" class="mt-2 inline-block text-sm text-indigo-600">Kelola →</a>
    </article>
@endforeach
</div>
{{ $events->links() }}
@endsection
