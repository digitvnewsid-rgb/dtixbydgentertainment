@extends('layouts.dashboard')
@section('page_title', 'Jenis Tiket — '.$event->title)
@section('sidebar')
    @include('partials.sidebar-link', ['href' => route('admin.events.index'), 'label' => 'Event', 'active' => true])
@endsection
@section('content')
<div class="mb-4 flex justify-between">
    <a href="{{ route('admin.events.show', $event) }}" class="text-sm text-indigo-600">← Kembali ke event</a>
    <a href="{{ route('admin.events.ticket-types.create', $event) }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm text-white">Tambah Jenis Tiket</a>
</div>
<div class="overflow-hidden rounded-xl border bg-white">
    <table class="min-w-full text-sm">
        <thead class="bg-slate-50"><tr><th class="px-4 py-3 text-left">Nama</th><th>Harga</th><th>Kuota</th><th>Terjual</th><th>Periode</th><th>Status</th><th></th></tr></thead>
        <tbody>
        @forelse ($event->ticketTypes as $type)
            <tr class="border-t">
                <td class="px-4 py-3 font-medium">{{ $type->name }}</td>
                <td class="px-4 py-3">Rp {{ number_format($type->price) }}</td>
                <td class="px-4 py-3">{{ $type->quota }}</td>
                <td class="px-4 py-3">{{ $type->sold }}</td>
                <td class="px-4 py-3 text-xs">{{ $type->sale_start->format('d/m') }}–{{ $type->sale_end->format('d/m') }}</td>
                <td class="px-4 py-3">@include('partials.status-badge', ['status' => $type->status->value])</td>
                <td class="px-4 py-3 text-right">
                    <a href="{{ route('admin.events.ticket-types.edit', [$event, $type]) }}" class="text-indigo-600">Edit</a>
                    <form action="{{ route('admin.events.ticket-types.destroy', [$event, $type]) }}" method="POST" class="inline" onsubmit="return confirm('Hapus?')">@csrf @method('DELETE')<button class="text-red-600">Hapus</button></form>
                </td>
            </tr>
        @empty
            <tr><td colspan="7" class="px-4 py-8 text-center text-slate-500">Belum ada jenis tiket.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
