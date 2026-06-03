@extends('layouts.admin')
@section('title', 'Kategori Event')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Kategori Event</h2>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Tambah Kategori</a>
</div>
<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead><tr><th>Nama</th><th>Slug</th><th>Acara</th><th>Status</th><th></th></tr></thead>
            <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td><code>{{ $category->slug }}</code></td>
                    <td>{{ $category->events_count }}</td>
                    <td><span class="badge bg-{{ $category->is_active ? 'success' : 'secondary' }}">{{ $category->is_active ? 'Aktif' : 'Nonaktif' }}</span></td>
                    <td class="text-end">
                        <a href="{{ route('admin.categories.show', $category) }}" class="btn btn-sm btn-outline-secondary">Detail</a>
                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus kategori ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center text-muted py-4">Belum ada kategori.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
{{ $categories->links() }}
@endsection
