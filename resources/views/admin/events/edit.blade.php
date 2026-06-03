@extends('layouts.admin')
@section('title', 'Edit Acara')
@section('content')
<h2 class="mb-3">Edit Acara</h2>
<div class="card shadow-sm"><div class="card-body">
<form method="POST" action="{{ route('admin.events.update', $event) }}">@csrf @method('PUT')
@include('admin.events._form', ['event' => $event])
<button class="btn btn-primary">Perbarui</button>
<a href="{{ route('admin.events.index') }}" class="btn btn-link">Batal</a>
</form></div></div>
@endsection
