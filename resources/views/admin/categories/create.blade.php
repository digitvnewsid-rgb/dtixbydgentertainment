@extends('layouts.dashboard')
@section('page_title', 'Tambah Kategori')
@section('sidebar')
    @include('partials.sidebar-link', ['href' => route('admin.categories.index'), 'label' => 'Kategori', 'active' => true])
@endsection
@section('content')
<div class="max-w-lg rounded-xl border bg-white p-6">
    <form method="POST" action="{{ route('admin.categories.store') }}" class="space-y-4">@csrf
        <div><label class="text-sm font-medium">Nama</label><input name="name" required class="mt-1 w-full rounded-lg border px-3 py-2"></div>
        <div><label class="text-sm font-medium">Deskripsi</label><textarea name="description" rows="3" class="mt-1 w-full rounded-lg border px-3 py-2"></textarea></div>
        <label class="flex gap-2 text-sm"><input type="checkbox" name="is_active" value="1" checked> Aktif</label>
        <button class="rounded-lg bg-indigo-600 px-4 py-2 text-white">Simpan</button>
    </form>
</div>
@endsection
