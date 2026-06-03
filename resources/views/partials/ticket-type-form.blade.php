@php $ticketType = $ticketType ?? null; @endphp
<div class="grid gap-4 sm:grid-cols-2">
    <div class="sm:col-span-2">
        <label class="mb-1 block text-sm font-medium">Nama Tiket</label>
        <input type="text" name="name" value="{{ old('name', $ticketType->name ?? '') }}" required class="w-full rounded-lg border border-slate-300 px-3 py-2">
    </div>
    <div>
        <label class="mb-1 block text-sm font-medium">Harga (Rp)</label>
        <input type="number" name="price" min="0" value="{{ old('price', $ticketType->price ?? '') }}" required class="w-full rounded-lg border border-slate-300 px-3 py-2">
    </div>
    <div>
        <label class="mb-1 block text-sm font-medium">Kuota</label>
        <input type="number" name="quota" min="1" value="{{ old('quota', $ticketType->quota ?? '') }}" required class="w-full rounded-lg border border-slate-300 px-3 py-2">
        @if ($ticketType)
            <p class="mt-1 text-xs text-slate-500">Terjual: {{ $ticketType->sold }}</p>
        @endif
    </div>
    <div>
        <label class="mb-1 block text-sm font-medium">Maks. pembelian / transaksi</label>
        <input type="number" name="max_purchase" min="1" max="20" value="{{ old('max_purchase', $ticketType->max_purchase ?? 5) }}" required class="w-full rounded-lg border border-slate-300 px-3 py-2">
    </div>
    <div>
        <label class="mb-1 block text-sm font-medium">Status</label>
        <select name="status" required class="w-full rounded-lg border border-slate-300 px-3 py-2">
            @foreach ($statuses as $status)
                <option value="{{ $status->value }}" @selected(old('status', $ticketType->status->value ?? 'active') === $status->value)>{{ str_replace('_', ' ', $status->value) }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="mb-1 block text-sm font-medium">Mulai penjualan</label>
        <input type="datetime-local" name="sale_start" value="{{ old('sale_start', isset($ticketType) ? $ticketType->sale_start->format('Y-m-d\TH:i') : '') }}" required class="w-full rounded-lg border border-slate-300 px-3 py-2">
    </div>
    <div>
        <label class="mb-1 block text-sm font-medium">Akhir penjualan</label>
        <input type="datetime-local" name="sale_end" value="{{ old('sale_end', isset($ticketType) ? $ticketType->sale_end->format('Y-m-d\TH:i') : '') }}" required class="w-full rounded-lg border border-slate-300 px-3 py-2">
    </div>
    <div class="sm:col-span-2">
        <label class="mb-1 block text-sm font-medium">Benefit (opsional)</label>
        <textarea name="benefits" rows="3" class="w-full rounded-lg border border-slate-300 px-3 py-2">{{ old('benefits', $ticketType->benefits ?? '') }}</textarea>
    </div>
</div>
