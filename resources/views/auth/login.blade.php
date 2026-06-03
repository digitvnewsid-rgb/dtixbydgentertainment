@extends('layouts.public')
@section('title', 'Login')
@section('content')
<div class="mx-auto max-w-md px-4 py-16">
    <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
        <h1 class="mb-6 text-2xl font-bold">Login</h1>
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            <div>
                <label class="mb-1 block text-sm font-medium">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                       class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium">Password</label>
                <input type="password" name="password" required
                       class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
            </div>
            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="remember" class="rounded border-slate-300">
                Ingat saya
            </label>
            <button type="submit" class="w-full rounded-lg bg-indigo-600 py-2.5 font-medium text-white hover:bg-indigo-700">Masuk</button>
        </form>
        <p class="mt-4 text-center text-sm text-slate-600">
            Belum punya akun? <a href="{{ route('register') }}" class="text-indigo-600 hover:underline">Daftar sebagai Customer</a>
        </p>
    </div>
</div>
@endsection
