@extends('layouts.dashboard')
@section('page_title', 'Tambah Jenis Tiket')
@section('content')
<div class="max-w-2xl rounded-xl border bg-white p-6">
    <form method="POST" action="{{ route('creator.events.ticket-types.store', $event) }}" class="space-y-4">@csrf
        @include('partials.ticket-type-form')
        <button class="rounded-lg bg-indigo-600 px-4 py-2 text-white">Simpan</button>
    </form>
</div>
@endsection
