@php
    $event = $event ?? null;
    $showCreator = $showCreator ?? false;
@endphp
<div class="grid gap-4 sm:grid-cols-2">
    @if ($showCreator)
        <div class="sm:col-span-2">
            <label class="mb-1 block text-sm font-medium">Creator</label>
            <select name="creator_id" required class="w-full rounded-lg border border-slate-300 px-3 py-2">
                @foreach ($creators as $creator)
                    <option value="{{ $creator->id }}" @selected(old('creator_id', $event->creator_id ?? '') == $creator->id)>{{ $creator->name }}</option>
                @endforeach
            </select>
        </div>
    @endif
    <div class="sm:col-span-2">
        <label class="mb-1 block text-sm font-medium">Kategori</label>
        <select name="category_id" required class="w-full rounded-lg border border-slate-300 px-3 py-2">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $event->category_id ?? '') == $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="sm:col-span-2">
        <label class="mb-1 block text-sm font-medium">Judul Event</label>
        <input type="text" name="title" value="{{ old('title', $event->title ?? '') }}" required class="w-full rounded-lg border border-slate-300 px-3 py-2">
    </div>
    <div class="sm:col-span-2">
        <label class="mb-1 block text-sm font-medium">Deskripsi</label>
        <textarea name="description" rows="5" class="w-full rounded-lg border border-slate-300 px-3 py-2">{{ old('description', $event->description ?? '') }}</textarea>
    </div>
    <div class="sm:col-span-2">
        <label class="mb-1 block text-sm font-medium">Banner</label>
        @if (!empty($event?->banner))
            <img src="{{ Storage::url($event->banner) }}" alt="" class="mb-2 h-32 rounded-lg object-cover">
        @endif
        <input type="file" name="banner" accept="image/*" class="w-full text-sm">
    </div>
    <div class="sm:col-span-2">
        <label class="mb-1 block text-sm font-medium">Lokasi</label>
        <input type="text" name="location" value="{{ old('location', $event->location ?? '') }}" required class="w-full rounded-lg border border-slate-300 px-3 py-2">
    </div>
    <div class="sm:col-span-2">
        <label class="mb-1 block text-sm font-medium">URL Peta (opsional)</label>
        <input type="url" name="map_url" value="{{ old('map_url', $event->map_url ?? '') }}" class="w-full rounded-lg border border-slate-300 px-3 py-2">
    </div>
    <div>
        <label class="mb-1 block text-sm font-medium">Mulai</label>
        <input type="datetime-local" name="start_datetime" value="{{ old('start_datetime', isset($event) ? $event->start_datetime->format('Y-m-d\TH:i') : '') }}" required class="w-full rounded-lg border border-slate-300 px-3 py-2">
    </div>
    <div>
        <label class="mb-1 block text-sm font-medium">Selesai</label>
        <input type="datetime-local" name="end_datetime" value="{{ old('end_datetime', isset($event) ? $event->end_datetime->format('Y-m-d\TH:i') : '') }}" required class="w-full rounded-lg border border-slate-300 px-3 py-2">
    </div>
    <div class="sm:col-span-2">
        <label class="mb-1 block text-sm font-medium">Status</label>
        <select name="status" required class="w-full rounded-lg border border-slate-300 px-3 py-2">
            @foreach ($statuses as $status)
                <option value="{{ $status->value }}" @selected(old('status', $event->status->value ?? 'draft') === $status->value)>{{ ucfirst($status->value) }}</option>
            @endforeach
        </select>
    </div>
</div>
