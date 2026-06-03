@extends('layouts.admin')
@section('title', $category->name)
@section('content')
<h2 class="mb-3">{{ $category->name }}</h2>
<div class="card shadow-sm mb-3"><div class="card-body">
<p class="text-muted mb-1">Slug: <code>{{ $category->slug }}</code></p>
<p>{{ $category->description ?: '—' }}</p>
<p>Status: <span class="badge bg-{{ $category->is_active ? 'success' : 'secondary' }}">{{ $category->is_active ? 'Aktif' : 'Nonaktif' }}</span></p>
<p>Total acara: {{ $category->events_count }}</p>
<a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-primary btn-sm">Edit</a>
</div></div>
@endsection
