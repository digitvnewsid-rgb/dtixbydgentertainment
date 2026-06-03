@extends('layouts.dashboard')
@section('page_title', 'Edit Jenis Tiket')
@section('content')
<div class="max-w-2xl rounded-xl border bg-white p-6">
    <form method="POST" action="{{ route('admin.events.ticket-types.update', [$event, $ticketType]) }}" class="space-y-4">@csrf @method('PUT')
        @include('partials.ticket-type-form', ['ticketType' => $ticketType])
        <button class="rounded-lg bg-indigo-600 px-4 py-2 text-white">Perbarui</button>
    </form>
</div>
@endsection
