@extends('layouts.dashboard')
@section('title', 'Users')
@section('page_title', 'Kelola User')
@section('sidebar')
    @include('partials.sidebar-link', ['href' => route('admin.dashboard'), 'label' => 'Dashboard'])
    @include('partials.sidebar-link', ['href' => route('admin.users.index'), 'label' => 'Kelola User', 'active' => true])
@endsection
@section('content')
<div class="mb-4 flex flex-wrap items-center justify-between gap-3">
    <form method="GET" class="flex flex-wrap gap-2">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama/email..." class="rounded-lg border border-slate-300 px-3 py-2 text-sm">
        <select name="role" class="rounded-lg border border-slate-300 px-3 py-2 text-sm">
            <option value="">Semua role</option>
            @foreach ($roles as $role)
                <option value="{{ $role->value }}" @selected(request('role') === $role->value)>{{ $role->label() }}</option>
            @endforeach
        </select>
        <button class="rounded-lg bg-slate-800 px-4 py-2 text-sm text-white">Filter</button>
    </form>
    <a href="{{ route('admin.users.create') }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm text-white">Tambah User</a>
</div>
<div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
    <table class="min-w-full text-sm">
        <thead class="bg-slate-50 text-left text-slate-600">
            <tr>
                <th class="px-4 py-3">Nama</th>
                <th class="px-4 py-3">Email</th>
                <th class="px-4 py-3">Role</th>
                <th class="px-4 py-3">Status</th>
                <th class="px-4 py-3 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($users as $user)
            <tr class="border-t border-slate-100">
                <td class="px-4 py-3 font-medium">{{ $user->name }}</td>
                <td class="px-4 py-3">{{ $user->email }}</td>
                <td class="px-4 py-3"><span class="rounded-full bg-slate-100 px-2 py-1 text-xs">{{ $user->role->label() }}</span></td>
                <td class="px-4 py-3">
                    <span class="rounded-full px-2 py-1 text-xs {{ $user->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </td>
                <td class="px-4 py-3 text-right space-x-2">
                    <a href="{{ route('admin.users.edit', $user) }}" class="text-indigo-600 hover:underline">Edit</a>
                    <form action="{{ route('admin.users.toggle-active', $user) }}" method="POST" class="inline">@csrf @method('PATCH')
                        <button class="text-amber-600 hover:underline">{{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}</button>
                    </form>
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Hapus user?')">@csrf @method('DELETE')
                        <button class="text-red-600 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="5" class="px-4 py-8 text-center text-slate-500">Belum ada user.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $users->links() }}</div>
@endsection
