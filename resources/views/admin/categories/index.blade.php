@extends('layouts.dashboard')
@section('title', 'Kategori')
@section('page_title', 'Kategori Event')
@section('sidebar')
    @include('partials.sidebar-link', ['href' => route('admin.dashboard'), 'label' => 'Dashboard'])
    @include('partials.sidebar-link', ['href' => route('admin.categories.index'), 'label' => 'Kategori', 'active' => true])
    @include('partials.sidebar-link', ['href' => route('admin.events.index'), 'label' => 'Event'])
    @include('partials.sidebar-link', ['href' => route('admin.users.index'), 'label' => 'User'])
@endsection
@section('content')
<div class="mb-4 flex justify-end">
    <a href="{{ route('admin.categories.create') }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm text-white">Tambah Kategori</a>
</div>
<div class="overflow-hidden rounded-xl border bg-white shadow-sm">
    <table class="min-w-full text-sm">
        <thead class="bg-slate-50 text-left"><tr><th class="px-4 py-3">Nama</th><th>Event</th><th>Status</th><th></th></tr></thead>
        <tbody>
        @foreach ($categories as $category)
            <tr class="border-t">
                <td class="px-4 py-3 font-medium">{{ $category->name }}</td>
                <td class="px-4 py-3">{{ $category->events_count }}</td>
                <td class="px-4 py-3">@include('partials.status-badge', ['status' => $category->is_active ? 'active' : 'inactive'])</td>
                <td class="px-4 py-3 text-right">
                    <a href="{{ route('admin.categories.edit', $category) }}" class="text-indigo-600">Edit</a>
                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Hapus?')">@csrf @method('DELETE')
                        <button class="text-red-600">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
{{ $categories->links() }}
@endsection
