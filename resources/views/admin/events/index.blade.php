@extends('layouts.dashboard')
@section('page_title', 'Kelola Event')
@section('sidebar')
    @include('partials.sidebar-link', ['href' => route('admin.dashboard'), 'label' => 'Dashboard'])
    @include('partials.sidebar-link', ['href' => route('admin.categories.index'), 'label' => 'Kategori'])
    @include('partials.sidebar-link', ['href' => route('admin.events.index'), 'label' => 'Event', 'active' => true])
    @include('partials.sidebar-link', ['href' => route('admin.users.index'), 'label' => 'User'])
@endsection
@section('content')
<div class="mb-4 flex justify-end"><a href="{{ route('admin.events.create') }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm text-white">Tambah Event</a></div>
@include('partials.event-filters')
<div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
@foreach ($events as $event)
    <article class="rounded-xl border bg-white p-4 shadow-sm">
        <div class="mb-2 flex justify-between">
            @include('partials.status-badge', ['status' => $event->status->value])
            <span class="text-xs text-slate-500">{{ $event->ticket_types_count }} jenis tiket</span>
        </div>
        <h3 class="font-semibold">{{ $event->title }}</h3>
        <p class="text-sm text-slate-500">{{ $event->location }}</p>
        <p class="text-xs text-slate-400">{{ $event->start_datetime->format('d M Y H:i') }} · {{ $event->creator->name }}</p>
        <a href="{{ route('admin.events.show', $event) }}" class="mt-3 inline-block text-sm text-indigo-600">Detail →</a>
    </article>
@endforeach
</div>
<div class="mt-4">{{ $events->links() }}</div>
@endsection
