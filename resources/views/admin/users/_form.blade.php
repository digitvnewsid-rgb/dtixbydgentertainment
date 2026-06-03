<div class="grid gap-4 sm:grid-cols-2">
    <div>
        <label class="mb-1 block text-sm font-medium">Nama</label>
        <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}" required class="w-full rounded-lg border border-slate-300 px-3 py-2">
    </div>
    <div>
        <label class="mb-1 block text-sm font-medium">Email</label>
        <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}" required class="w-full rounded-lg border border-slate-300 px-3 py-2">
    </div>
    <div>
        <label class="mb-1 block text-sm font-medium">Telepon</label>
        <input type="text" name="phone" value="{{ old('phone', $user->phone ?? '') }}" class="w-full rounded-lg border border-slate-300 px-3 py-2">
    </div>
    <div>
        <label class="mb-1 block text-sm font-medium">Role</label>
        <select name="role" required class="w-full rounded-lg border border-slate-300 px-3 py-2">
            @foreach ($roles as $role)
                <option value="{{ $role->value }}" @selected(old('role', isset($user) ? $user->role->value : '') === $role->value)>{{ $role->label() }}</option>
            @endforeach
        </select>
    </div>
    <div class="sm:col-span-2">
        <label class="mb-1 block text-sm font-medium">Password {{ isset($user) ? '(kosongkan jika tidak diubah)' : '' }}</label>
        <input type="password" name="password" {{ isset($user) ? '' : 'required' }} class="w-full rounded-lg border border-slate-300 px-3 py-2">
    </div>
    <div class="flex items-center gap-2 sm:col-span-2">
        <input type="hidden" name="is_active" value="0">
        <input type="checkbox" name="is_active" value="1" id="is_active" @checked(old('is_active', $user->is_active ?? true)) class="rounded border-slate-300">
        <label for="is_active" class="text-sm">Akun aktif</label>
    </div>
</div>
