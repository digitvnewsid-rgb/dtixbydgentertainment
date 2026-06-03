<?php

namespace App\Http\Controllers\Creator;

use App\Enums\EventStatus;
use App\Http\Controllers\Concerns\ManagesEventAttributes;
use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Models\Category;
use App\Models\Event;
use App\Services\EventStatusService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EventController extends Controller
{
    use ManagesEventAttributes;

    public function __construct(private EventStatusService $statusService) {}

    public function index(Request $request): View
    {
        $this->authorize('viewAny', Event::class);

        $query = Event::query()
            ->where('creator_id', auth()->id())
            ->with(['category'])
            ->withCount('ticketTypes');

        $this->applyEventFilters($query, $request);

        $events = $query->orderByDesc('start_datetime')->paginate(12)->withQueryString();

        return view('creator.events.index', [
            'events' => $events,
            'categories' => Category::where('is_active', true)->orderBy('name')->get(),
            'statuses' => EventStatus::cases(),
        ]);
    }

    public function create(): View
    {
        $this->authorize('create', Event::class);

        return view('creator.events.create', [
            'categories' => Category::where('is_active', true)->orderBy('name')->get(),
            'statuses' => EventStatus::cases(),
        ]);
    }

    public function store(EventRequest $request): RedirectResponse
    {
        $this->authorize('create', Event::class);

        $data = $this->eventPayload($request);
        $data['creator_id'] = auth()->id();
        if ($data['status'] === EventStatus::Published) {
            // Creator can save as draft first; allow published if they choose
        }

        $event = Event::create($data);

        return redirect()->route('creator.events.show', $event)
            ->with('success', 'Event berhasil dibuat.');
    }

    public function show(Event $event): View
    {
        $this->authorize('view', $event);

        $event->load(['category', 'ticketTypes']);

        return view('creator.events.show', compact('event'));
    }

    public function edit(Event $event): View
    {
        $this->authorize('update', $event);

        return view('creator.events.edit', [
            'event' => $event,
            'categories' => Category::where('is_active', true)->orderBy('name')->get(),
            'statuses' => EventStatus::cases(),
        ]);
    }

    public function update(EventRequest $request, Event $event): RedirectResponse
    {
        $this->authorize('update', $event);

        $event->update($this->eventPayload($request, $event));

        return redirect()->route('creator.events.show', $event)
            ->with('success', 'Event berhasil diperbarui.');
    }

    public function destroy(Event $event): RedirectResponse
    {
        $this->authorize('delete', $event);

        $event->delete();

        return redirect()->route('creator.events.index')
            ->with('success', 'Event berhasil dihapus.');
    }

    public function publish(Event $event): RedirectResponse
    {
        $this->authorize('manageStatus', $event);
        $this->statusService->publish($event);

        return back()->with('success', 'Event dipublish.');
    }

    public function close(Event $event): RedirectResponse
    {
        $this->authorize('manageStatus', $event);
        $this->statusService->close($event);

        return back()->with('success', 'Event ditutup.');
    }
}
