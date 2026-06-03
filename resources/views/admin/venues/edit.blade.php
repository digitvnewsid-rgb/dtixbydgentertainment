@extends('layouts.admin')
@section('title', 'Edit Venue')
@section('content')
<h2 class="mb-3">Edit Lokasi Venue</h2>
<div class="card shadow-sm"><div class="card-body">
<form method="POST" action="{{ route('admin.venues.update', $venue) }}">@csrf @method('PUT')
@include('admin.venues._form', ['venue' => $venue])
<button class="btn btn-primary">Perbarui</button>
<a href="{{ route('admin.venues.index') }}" class="btn btn-link">Batal</a>
</form></div></div>
@endsection
