@extends('layouts.admin')
@section('title', 'Tambah Venue')
@section('content')
<h2 class="mb-3">Tambah Lokasi Venue</h2>
<div class="card shadow-sm"><div class="card-body">
<form method="POST" action="{{ route('admin.venues.store') }}">@csrf
@include('admin.venues._form')
<button class="btn btn-primary">Simpan</button>
<a href="{{ route('admin.venues.index') }}" class="btn btn-link">Batal</a>
</form></div></div>
@endsection
