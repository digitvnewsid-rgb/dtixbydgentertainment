<?php

namespace App\Http\Controllers\Creator;

use App\Enums\TicketTypeStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\TicketTypeRequest;
use App\Models\Event;
use App\Models\TicketType;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TicketTypeController extends Controller
{
    public function index(Event $event): View
    {
        $this->authorize('view', $event);

        $event->load('ticketTypes');

        return view('creator.ticket-types.index', compact('event'));
    }

    public function create(Event $event): View
    {
        $this->authorize('create', [TicketType::class, $event]);

        return view('creator.ticket-types.create', [
            'event' => $event,
            'statuses' => TicketTypeStatus::cases(),
        ]);
    }

    public function store(TicketTypeRequest $request, Event $event): RedirectResponse
    {
        $this->authorize('create', [TicketType::class, $event]);

        $ticketType = $event->ticketTypes()->create($request->validated());
        $this->syncSoldOutStatus($ticketType);

        return redirect()->route('creator.events.ticket-types.index', $event)
            ->with('success', 'Jenis tiket ditambahkan.');
    }

    public function edit(Event $event, TicketType $ticketType): View
    {
        $this->authorize('update', $ticketType);
        abort_unless($ticketType->event_id === $event->id, 404);

        return view('creator.ticket-types.edit', [
            'event' => $event,
            'ticketType' => $ticketType,
            'statuses' => TicketTypeStatus::cases(),
        ]);
    }

    public function update(TicketTypeRequest $request, Event $event, TicketType $ticketType): RedirectResponse
    {
        $this->authorize('update', $ticketType);
        abort_unless($ticketType->event_id === $event->id, 404);

        $data = $request->validated();
        if ($data['quota'] < $ticketType->sold) {
            return back()->with('error', 'Kuota tidak boleh lebih kecil dari jumlah terjual.');
        }

        $ticketType->update($data);
        $this->syncSoldOutStatus($ticketType);

        return redirect()->route('creator.events.ticket-types.index', $event)
            ->with('success', 'Jenis tiket diperbarui.');
    }

    public function destroy(Event $event, TicketType $ticketType): RedirectResponse
    {
        $this->authorize('delete', $ticketType);
        abort_unless($ticketType->event_id === $event->id, 404);

        $ticketType->delete();

        return redirect()->route('creator.events.ticket-types.index', $event)
            ->with('success', 'Jenis tiket dihapus.');
    }

    private function syncSoldOutStatus(TicketType $ticketType): void
    {
        $ticketType->refresh();
        if ($ticketType->sold >= $ticketType->quota) {
            $ticketType->update(['status' => TicketTypeStatus::SoldOut]);
        }
    }
}
