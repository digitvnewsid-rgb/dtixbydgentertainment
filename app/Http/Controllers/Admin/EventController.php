<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\Venue;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class EventController extends Controller
{
    public function index(): View
    {
        $events = Event::query()
            ->with(['category', 'venue'])
            ->orderByDesc('start_at')
            ->paginate(10);

        return view('admin.events.index', compact('events'));
    }

    public function create(): View
    {
        return view('admin.events.create', [
            'categories' => EventCategory::query()->where('is_active', true)->orderBy('name')->get(),
            'venues' => Venue::query()->where('is_active', true)->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['slug'] = $this->uniqueSlug($data['title']);

        Event::create($data);

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Acara berhasil ditambahkan.');
    }

    public function show(Event $event): View
    {
        $event->load(['category', 'venue', 'ticketTypes']);

        return view('admin.events.show', compact('event'));
    }

    public function edit(Event $event): View
    {
        return view('admin.events.edit', [
            'event' => $event,
            'categories' => EventCategory::query()->where('is_active', true)->orderBy('name')->get(),
            'venues' => Venue::query()->where('is_active', true)->orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Event $event): RedirectResponse
    {
        $data = $this->validated($request);

        if ($event->title !== $data['title']) {
            $data['slug'] = $this->uniqueSlug($data['title'], $event->id);
        }

        $event->update($data);

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Acara berhasil diperbarui.');
    }

    public function destroy(Event $event): RedirectResponse
    {
        $event->delete();

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Acara berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'event_category_id' => ['required', 'exists:event_categories,id'],
            'venue_id' => ['required', 'exists:venues,id'],
            'title' => ['required', 'string', 'max:200'],
            'description' => ['nullable', 'string'],
            'start_at' => ['required', 'date'],
            'end_at' => ['required', 'date', 'after:start_at'],
            'status' => ['required', Rule::in(['draft', 'published', 'cancelled'])],
            'poster_url' => ['nullable', 'url', 'max:500'],
        ]);
    }

    private function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title);
        $slug = $base;
        $counter = 1;

        while (
            Event::query()
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->where('slug', $slug)
                ->exists()
        ) {
            $slug = $base.'-'.$counter;
            $counter++;
        }

        return $slug;
    }
}
