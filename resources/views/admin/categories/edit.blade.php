@extends('layouts.admin')
@section('title', 'Edit Kategori')
@section('content')
<h2 class="mb-3">Edit Kategori Event</h2>
<div class="card shadow-sm"><div class="card-body">
<form method="POST" action="{{ route('admin.categories.update', $category) }}">@csrf @method('PUT')
@include('admin.categories._form', ['category' => $category])
<button class="btn btn-primary">Perbarui</button>
<a href="{{ route('admin.categories.index') }}" class="btn btn-link">Batal</a>
</form></div></div>
@endsection
