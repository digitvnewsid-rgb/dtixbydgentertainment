@extends('layouts.admin')
@section('title', 'Lokasi Venue')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Lokasi Venue</h2>
    <a href="{{ route('admin.venues.create') }}" class="btn btn-primary">Tambah Venue</a>
</div>
<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead><tr><th>Nama</th><th>Kota</th><th>Kapasitas</th><th>Acara</th><th>Status</th><th></th></tr></thead>
            <tbody>
            @forelse ($venues as $venue)
                <tr>
                    <td>{{ $venue->name }}</td>
                    <td>{{ $venue->city }}</td>
                    <td>{{ number_format($venue->capacity) }}</td>
                    <td>{{ $venue->events_count }}</td>
                    <td><span class="badge bg-{{ $venue->is_active ? 'success' : 'secondary' }}">{{ $venue->is_active ? 'Aktif' : 'Nonaktif' }}</span></td>
                    <td class="text-end">
                        <a href="{{ route('admin.venues.show', $venue) }}" class="btn btn-sm btn-outline-secondary">Detail</a>
                        <a href="{{ route('admin.venues.edit', $venue) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                        <form action="{{ route('admin.venues.destroy', $venue) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus venue ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center text-muted py-4">Belum ada venue.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
{{ $venues->links() }}
@endsection
