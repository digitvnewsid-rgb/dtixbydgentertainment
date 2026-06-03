<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RegisterController extends Controller
{
    public function show(): View
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request): RedirectResponse
    {
        $user = User::create([
            'name' => $request->string('name'),
            'email' => $request->string('email'),
            'phone' => $request->string('phone'),
            'password' => $request->string('password'),
            'role' => UserRole::Customer,
            'is_active' => true,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('customer.dashboard')
            ->with('success', 'Registrasi berhasil. Selamat datang!');
    }
}
