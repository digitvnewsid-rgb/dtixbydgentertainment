@extends('layouts.public')
@section('title', 'Login')
@section('content')

<div class="min-h-[calc(100vh-200px)] flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-6xl grid lg:grid-cols-2 gap-8 items-center">
        
        <!-- Left Side - Illustration/Branding -->
        <div class="hidden lg:block">
            <div class="rounded-3xl bg-gradient-to-br from-primary-600 via-primary-700 to-secondary-700 p-12 text-white shadow-2xl">
                <div class="space-y-6">
                    <div class="inline-flex h-16 w-16 items-center justify-center rounded-2xl bg-white/20 backdrop-blur-sm">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-4xl font-bold mb-4">Selamat Datang Kembali!</h2>
                        <p class="text-primary-100 text-lg leading-relaxed">
                            Login untuk mengakses dashboard Anda dan kelola event dengan mudah.
                        </p>
                    </div>
                    
                    <!-- Features -->
                    <div class="space-y-4 pt-8">
                        <div class="flex items-start gap-3">
                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-white/20">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold">Akses Cepat</h3>
                                <p class="text-sm text-primary-100">Dashboard lengkap untuk mengelola event Anda</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-white/20">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold">Aman & Terpercaya</h3>
                                <p class="text-sm text-primary-100">Data Anda dilindungi dengan enkripsi</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-white/20">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold">Real-time Updates</h3>
                                <p class="text-sm text-primary-100">Notifikasi instant untuk setiap aktivitas</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="w-full max-w-md mx-auto animate-fade-in">
            <div class="card-hover p-8 md:p-10">
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-slate-900 mb-2">Login</h1>
                    <p class="text-slate-600">Masuk ke akun Anda untuk melanjutkan</p>
                </div>

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="mb-6 rounded-xl bg-red-50 border border-red-200 p-4 animate-slide-down">
                        <div class="flex gap-3">
                            <svg class="w-5 h-5 text-red-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div class="flex-1">
                                <h3 class="text-sm font-medium text-red-800">Terjadi kesalahan</h3>
                                <ul class="mt-1 text-sm text-red-700 list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf
                    
                    <!-- Email Field -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Email</label>
                        <div class="relative">
                            <div class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                </svg>
                            </div>
                            <input 
                                type="email" 
                                name="email" 
                                value="{{ old('email') }}" 
                                required 
                                autofocus
                                placeholder="nama@email.com"
                                class="input pl-11 {{ $errors->has('email') ? 'input-error' : '' }}"
                            >
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Password</label>
                        <div class="relative">
                            <div class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <input 
                                type="password" 
                                name="password" 
                                id="password"
                                required
                                placeholder="••••••••"
                                class="input pl-11 pr-11 {{ $errors->has('password') ? 'input-error' : '' }}"
                            >
                            <button 
                                type="button"
                                onclick="togglePassword()"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 transition-colors"
                            >
                                <svg id="eye-open" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                <svg id="eye-closed" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2 text-sm text-slate-600 cursor-pointer group">
                            <input type="checkbox" name="remember" class="rounded border-slate-300 text-primary-600 focus:ring-primary-500 cursor-pointer">
                            <span class="group-hover:text-slate-900 transition-colors">Ingat saya</span>
                        </label>
                        <a href="#" class="text-sm font-medium text-primary-600 hover:text-primary-700 transition-colors">
                            Lupa password?
                        </a>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn-primary w-full btn-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        Masuk
                    </button>
                </form>

                <!-- Divider -->
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-slate-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="bg-white px-4 text-slate-500">Atau lanjutkan dengan</span>
                    </div>
                </div>

                <!-- Social Login (Placeholder) -->
                <div class="grid grid-cols-2 gap-3">
                    <button type="button" class="btn-secondary flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                        </svg>
                        <span class="text-sm font-medium">Google</span>
                    </button>
                    <button type="button" class="btn-secondary flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                        <span class="text-sm font-medium">Facebook</span>
                    </button>
                </div>

                <!-- Register Link -->
                <p class="mt-6 text-center text-sm text-slate-600">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="font-medium text-primary-600 hover:text-primary-700 transition-colors">
                        Daftar sekarang
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>

<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const eyeOpen = document.getElementById('eye-open');
    const eyeClosed = document.getElementById('eye-closed');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeOpen.classList.add('hidden');
        eyeClosed.classList.remove('hidden');
    } else {
        passwordInput.type = 'password';
        eyeOpen.classList.remove('hidden');
        eyeClosed.classList.add('hidden');
    }
}
</script>

@endsection
