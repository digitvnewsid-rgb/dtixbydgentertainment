@extends('layouts.admin')
@section('title', 'Acara')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Daftar Acara</h2>
    <a href="{{ route('admin.events.create') }}" class="btn btn-primary">Tambah Acara</a>
</div>
<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead><tr><th>Judul</th><th>Kategori</th><th>Venue</th><th>Jadwal</th><th>Status</th><th></th></tr></thead>
            <tbody>
            @forelse ($events as $event)
                <tr>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->category->name }}</td>
                    <td>{{ $event->venue->name }}</td>
                    <td>{{ $event->start_at->format('d M Y H:i') }}</td>
                    <td><span class="badge bg-secondary">{{ $event->status }}</span></td>
                    <td class="text-end">
                        <a href="{{ route('admin.events.show', $event) }}" class="btn btn-sm btn-outline-secondary">Detail</a>
                        <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                        <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus acara ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center text-muted py-4">Belum ada acara.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
{{ $events->links() }}
@endsection
