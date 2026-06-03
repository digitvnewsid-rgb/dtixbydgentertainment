@extends('layouts.admin')
@section('title', 'Tambah Acara')
@section('content')
<h2 class="mb-3">Tambah Acara</h2>
<div class="card shadow-sm"><div class="card-body">
<form method="POST" action="{{ route('admin.events.store') }}">@csrf
@include('admin.events._form')
<button class="btn btn-primary">Simpan</button>
<a href="{{ route('admin.events.index') }}" class="btn btn-link">Batal</a>
</form></div></div>
@endsection
