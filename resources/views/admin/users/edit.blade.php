@extends('layouts.dashboard')
@section('title', 'Edit User')
@section('page_title', 'Edit User')
@section('sidebar')
    @include('partials.sidebar-link', ['href' => route('admin.dashboard'), 'label' => 'Dashboard'])
    @include('partials.sidebar-link', ['href' => route('admin.users.index'), 'label' => 'Kelola User', 'active' => true])
@endsection
@section('content')
<div class="max-w-2xl rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
    <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-4">@csrf @method('PUT')
        @include('admin.users._form', ['user' => $user, 'roles' => $roles])
        <button class="rounded-lg bg-indigo-600 px-4 py-2 text-white">Perbarui</button>
    </form>
</div>
@endsection
