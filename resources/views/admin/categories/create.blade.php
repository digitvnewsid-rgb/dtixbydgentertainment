@extends('layouts.admin')
@section('title', 'Tambah Kategori')
@section('content')
<h2 class="mb-3">Tambah Kategori Event</h2>
<div class="card shadow-sm"><div class="card-body">
<form method="POST" action="{{ route('admin.categories.store') }}">@csrf
@include('admin.categories._form')
<button class="btn btn-primary">Simpan</button>
<a href="{{ route('admin.categories.index') }}" class="btn btn-link">Batal</a>
</form></div></div>
@endsection
