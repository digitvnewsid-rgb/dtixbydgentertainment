<div class="mb-3">
    <label class="form-label">Nama Venue</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $venue->name ?? '') }}" required>
</div>
<div class="mb-3">
    <label class="form-label">Alamat</label>
    <input type="text" name="address" class="form-control" value="{{ old('address', $venue->address ?? '') }}" required>
</div>
<div class="mb-3">
    <label class="form-label">Kota</label>
    <input type="text" name="city" class="form-control" value="{{ old('city', $venue->city ?? '') }}" required>
</div>
<div class="mb-3">
    <label class="form-label">Kapasitas</label>
    <input type="number" name="capacity" min="0" class="form-control" value="{{ old('capacity', $venue->capacity ?? 0) }}" required>
</div>
<div class="mb-3">
    <label class="form-label">Deskripsi</label>
    <textarea name="description" class="form-control" rows="3">{{ old('description', $venue->description ?? '') }}</textarea>
</div>
<div class="form-check mb-3">
    <input class="form-check-input" type="checkbox" name="is_active" value="1" id="venue_is_active" @checked(old('is_active', $venue->is_active ?? true))>
    <label class="form-check-label" for="venue_is_active">Aktif</label>
</div>
