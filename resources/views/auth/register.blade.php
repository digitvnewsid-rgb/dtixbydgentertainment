@extends('layouts.public')
@section('title', 'Register')
@section('content')
<div class="mx-auto max-w-md px-4 py-16">
    <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
        <h1 class="mb-2 text-2xl font-bold">Daftar Customer</h1>
        <p class="mb-6 text-sm text-slate-500">Buat akun untuk membeli tiket event.</p>
        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf
            <div>
                <label class="mb-1 block text-sm font-medium">Nama</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full rounded-lg border border-slate-300 px-3 py-2">
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="w-full rounded-lg border border-slate-300 px-3 py-2">
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium">Telepon (opsional)</label>
                <input type="text" name="phone" value="{{ old('phone') }}" class="w-full rounded-lg border border-slate-300 px-3 py-2">
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium">Password</label>
                <input type="password" name="password" required class="w-full rounded-lg border border-slate-300 px-3 py-2">
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required class="w-full rounded-lg border border-slate-300 px-3 py-2">
            </div>
            <button type="submit" class="w-full rounded-lg bg-indigo-600 py-2.5 font-medium text-white hover:bg-indigo-700">Daftar</button>
        </form>
        <p class="mt-4 text-center text-sm text-slate-600">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">Login</a>
        </p>
    </div>
</div>
@endsection
