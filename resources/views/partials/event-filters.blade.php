<form method="GET" class="mb-4 grid gap-2 rounded-xl border border-slate-200 bg-white p-4 sm:grid-cols-2 lg:grid-cols-6">
    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari judul/lokasi..." class="rounded-lg border border-slate-300 px-3 py-2 text-sm lg:col-span-2">
    <select name="category_id" class="rounded-lg border border-slate-300 px-3 py-2 text-sm">
        <option value="">Semua kategori</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>{{ $category->name }}</option>
        @endforeach
    </select>
    <select name="status" class="rounded-lg border border-slate-300 px-3 py-2 text-sm">
        <option value="">Semua status</option>
        @foreach ($statuses as $status)
            <option value="{{ $status->value }}" @selected(request('status') === $status->value)>{{ $status->value }}</option>
        @endforeach
    </select>
    <input type="date" name="date_from" value="{{ request('date_from') }}" class="rounded-lg border border-slate-300 px-3 py-2 text-sm">
    <div class="flex gap-2">
        <input type="date" name="date_to" value="{{ request('date_to') }}" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
        <button class="rounded-lg bg-slate-800 px-4 py-2 text-sm text-white">Filter</button>
    </div>
</form>
