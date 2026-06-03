@extends('layouts.dashboard')
@section('page_title', 'Tambah Event')
@section('sidebar')
    @include('partials.sidebar-link', ['href' => route('admin.events.index'), 'label' => 'Event', 'active' => true])
@endsection
@section('content')
<div class="max-w-3xl rounded-xl border bg-white p-6">
    <form method="POST" action="{{ route('admin.events.store') }}" enctype="multipart/form-data" class="space-y-4">@csrf
        @include('partials.event-form', ['showCreator' => true])
        <button class="rounded-lg bg-indigo-600 px-4 py-2 text-white">Simpan</button>
    </form>
</div>
@endsection
