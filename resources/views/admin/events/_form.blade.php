<div class="mb-3">
    <label class="form-label">Kategori</label>
    <select name="event_category_id" class="form-select" required>
        <option value="">Pilih kategori</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" @selected(old('event_category_id', $event->event_category_id ?? '') == $category->id)>{{ $category->name }}</option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label class="form-label">Venue</label>
    <select name="venue_id" class="form-select" required>
        <option value="">Pilih venue</option>
        @foreach ($venues as $venue)
            <option value="{{ $venue->id }}" @selected(old('venue_id', $event->venue_id ?? '') == $venue->id)>{{ $venue->name }} — {{ $venue->city }}</option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label class="form-label">Judul Acara</label>
    <input type="text" name="title" class="form-control" value="{{ old('title', $event->title ?? '') }}" required>
</div>
<div class="mb-3">
    <label class="form-label">Deskripsi</label>
    <textarea name="description" class="form-control" rows="4">{{ old('description', $event->description ?? '') }}</textarea>
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Mulai</label>
        <input type="datetime-local" name="start_at" class="form-control" value="{{ old('start_at', isset($event) ? $event->start_at->format('Y-m-d\TH:i') : '') }}" required>
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Selesai</label>
        <input type="datetime-local" name="end_at" class="form-control" value="{{ old('end_at', isset($event) ? $event->end_at->format('Y-m-d\TH:i') : '') }}" required>
    </div>
</div>
<div class="mb-3">
    <label class="form-label">Status</label>
    <select name="status" class="form-select" required>
        @foreach (['draft' => 'Draft', 'published' => 'Published', 'cancelled' => 'Cancelled'] as $value => $label)
            <option value="{{ $value }}" @selected(old('status', $event->status ?? 'draft') === $value)>{{ $label }}</option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label class="form-label">URL Poster (opsional)</label>
    <input type="url" name="poster_url" class="form-control" value="{{ old('poster_url', $event->poster_url ?? '') }}">
</div>
