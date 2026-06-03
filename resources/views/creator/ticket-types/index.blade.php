@extends('layouts.dashboard')
@section('page_title', 'Jenis Tiket')
@section('sidebar')
    @include('partials.sidebar-link', ['href' => route('creator.events.index'), 'label' => 'Event Saya', 'active' => true])
@endsection
@section('content')
<div class="mb-4 flex justify-between">
    <a href="{{ route('creator.events.show', $event) }}" class="text-sm text-indigo-600">← Event</a>
    <a href="{{ route('creator.events.ticket-types.create', $event) }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm text-white">Tambah Jenis Tiket</a>
</div>
<div class="overflow-hidden rounded-xl border bg-white">
    <table class="min-w-full text-sm">
        <thead class="bg-slate-50"><tr><th class="px-4 py-3 text-left">Nama</th><th>Harga</th><th>Sisa</th><th>Status</th><th></th></tr></thead>
        <tbody>
        @forelse ($event->ticketTypes as $type)
            <tr class="border-t">
                <td class="px-4 py-3">{{ $type->name }}</td>
                <td class="px-4 py-3">Rp {{ number_format($type->price) }}</td>
                <td class="px-4 py-3">{{ $type->remainingQuota() }} / {{ $type->quota }}</td>
                <td class="px-4 py-3">@include('partials.status-badge', ['status' => $type->status->value])</td>
                <td class="px-4 py-3 text-right">
                    <a href="{{ route('creator.events.ticket-types.edit', [$event, $type]) }}" class="text-indigo-600">Edit</a>
                </td>
            </tr>
        @empty
            <tr><td colspan="5" class="px-4 py-8 text-center text-slate-500">Belum ada jenis tiket.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
