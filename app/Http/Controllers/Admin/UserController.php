<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $users = User::query()
            ->when($request->filled('role'), fn ($q) => $q->where('role', $request->string('role')))
            ->when($request->filled('q'), function ($q) use ($request) {
                $term = '%'.$request->string('q').'%';
                $q->where(fn ($inner) => $inner
                    ->where('name', 'like', $term)
                    ->orWhere('email', 'like', $term));
            })
            ->orderByDesc('created_at')
            ->paginate(15)
            ->withQueryString();

        return view('admin.users.index', [
            'users' => $users,
            'roles' => UserRole::cases(),
        ]);
    }

    public function create(): View
    {
        return view('admin.users.create', ['roles' => UserRole::cases()]);
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        User::create([
            'name' => $request->string('name'),
            'email' => $request->string('email'),
            'phone' => $request->string('phone'),
            'password' => $request->string('password'),
            'role' => UserRole::from($request->string('role')),
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(User $user): View
    {
        return view('admin.users.edit', [
            'user' => $user,
            'roles' => UserRole::cases(),
        ]);
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $data = [
            'name' => $request->string('name'),
            'email' => $request->string('email'),
            'phone' => $request->string('phone'),
            'role' => UserRole::from($request->string('role')),
            'is_active' => $request->boolean('is_active'),
        ];

        if ($request->filled('password')) {
            $data['password'] = $request->string('password');
        }

        $user->update($data);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak dapat menghapus akun sendiri.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dihapus.');
    }

    public function toggleActive(User $user): RedirectResponse
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak dapat menonaktifkan akun sendiri.');
        }

        $user->update(['is_active' => ! $user->is_active]);

        return back()->with('success', 'Status user diperbarui.');
    }
}
