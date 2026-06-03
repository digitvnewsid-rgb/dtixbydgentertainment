<?php

namespace App\Http\Controllers\Admin;

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

        return view('admin.ticket-types.index', compact('event'));
    }

    public function create(Event $event): View
    {
        $this->authorize('create', [TicketType::class, $event]);

        return view('admin.ticket-types.create', [
            'event' => $event,
            'statuses' => TicketTypeStatus::cases(),
        ]);
    }

    public function store(TicketTypeRequest $request, Event $event): RedirectResponse
    {
        $this->authorize('create', [TicketType::class, $event]);

        $ticketType = $event->ticketTypes()->create($this->payload($request));
        $this->syncSoldOutStatus($ticketType);

        return redirect()->route('admin.events.ticket-types.index', $event)
            ->with('success', 'Jenis tiket ditambahkan.');
    }

    public function edit(Event $event, TicketType $ticketType): View
    {
        $this->authorize('update', $ticketType);
        $this->assertBelongsToEvent($event, $ticketType);

        return view('admin.ticket-types.edit', [
            'event' => $event,
            'ticketType' => $ticketType,
            'statuses' => TicketTypeStatus::cases(),
        ]);
    }

    public function update(TicketTypeRequest $request, Event $event, TicketType $ticketType): RedirectResponse
    {
        $this->authorize('update', $ticketType);
        $this->assertBelongsToEvent($event, $ticketType);

        $ticketType->update($this->payload($request));
        $this->syncSoldOutStatus($ticketType);

        return redirect()->route('admin.events.ticket-types.index', $event)
            ->with('success', 'Jenis tiket diperbarui.');
    }

    public function destroy(Event $event, TicketType $ticketType): RedirectResponse
    {
        $this->authorize('delete', $ticketType);
        $this->assertBelongsToEvent($event, $ticketType);

        $ticketType->delete();

        return redirect()->route('admin.events.ticket-types.index', $event)
            ->with('success', 'Jenis tiket dihapus.');
    }

    private function payload(TicketTypeRequest $request): array
    {
        $data = $request->validated();
        if ($data['quota'] <= ($request->route('ticket_type')?->sold ?? 0)) {
            $data['status'] = TicketTypeStatus::SoldOut;
        }

        return $data;
    }

    private function syncSoldOutStatus(TicketType $ticketType): void
    {
        if ($ticketType->sold >= $ticketType->quota) {
            $ticketType->update(['status' => TicketTypeStatus::SoldOut]);
        }
    }

    private function assertBelongsToEvent(Event $event, TicketType $ticketType): void
    {
        abort_unless($ticketType->event_id === $event->id, 404);
    }
}
