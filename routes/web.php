<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Creator\DashboardController as CreatorDashboardController;
use App\Http\Controllers\Customer\DashboardController as CustomerDashboardController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Ticketing\DashboardController as TicketingDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
    Route::get('/register', [RegisterController::class, 'show'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
});

Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:administrator'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::patch('users/{user}/toggle-active', [UserController::class, 'toggleActive'])->name('users.toggle-active');
    Route::resource('users', UserController::class);
});

Route::prefix('creator')->name('creator.')->middleware(['auth', 'role:creator'])->group(function () {
    Route::get('/dashboard', [CreatorDashboardController::class, 'index'])->name('dashboard');
});

Route::prefix('customer')->name('customer.')->middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/dashboard', [CustomerDashboardController::class, 'index'])->name('dashboard');
});

Route::prefix('ticketing')->name('ticketing.')->middleware(['auth', 'role:ticketing'])->group(function () {
    Route::get('/dashboard', [TicketingDashboardController::class, 'index'])->name('dashboard');
});
