@extends('layouts.dashboard')
@section('page_title', 'Edit Event')
@section('sidebar')
    @include('partials.sidebar-link', ['href' => route('admin.events.index'), 'label' => 'Event', 'active' => true])
@endsection
@section('content')
<div class="max-w-3xl rounded-xl border bg-white p-6">
    <form method="POST" action="{{ route('admin.events.update', $event) }}" enctype="multipart/form-data" class="space-y-4">@csrf @method('PUT')
        @include('partials.event-form', ['event' => $event, 'showCreator' => true])
        <button class="rounded-lg bg-indigo-600 px-4 py-2 text-white">Perbarui</button>
    </form>
</div>
@endsection
