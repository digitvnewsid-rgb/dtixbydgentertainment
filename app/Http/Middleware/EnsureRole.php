<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRole
{
    /**
     * @param  string  ...$roles  Nilai role: administrator, creator, customer, ticketing
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (! $user || ! $user->isActive()) {
            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')
                ->with('error', 'Akun tidak aktif atau sesi berakhir.');
        }

        $allowed = collect($roles)->map(
            fn (string $role) => UserRole::tryFrom($role)
        )->filter();

        if ($allowed->isEmpty() || ! $allowed->contains($user->role)) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
