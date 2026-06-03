<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Venue;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class VenueController extends Controller
{
    public function index(): View
    {
        $venues = Venue::query()
            ->withCount('events')
            ->orderBy('name')
            ->paginate(10);

        return view('admin.venues.index', compact('venues'));
    }

    public function create(): View
    {
        return view('admin.venues.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['slug'] = $this->uniqueSlug($data['name']);

        Venue::create($data);

        return redirect()
            ->route('admin.venues.index')
            ->with('success', 'Lokasi venue berhasil ditambahkan.');
    }

    public function show(Venue $venue): View
    {
        $venue->load(['events' => fn ($q) => $q->with('category')->latest('start_at')]);

        return view('admin.venues.show', compact('venue'));
    }

    public function edit(Venue $venue): View
    {
        return view('admin.venues.edit', compact('venue'));
    }

    public function update(Request $request, Venue $venue): RedirectResponse
    {
        $data = $this->validated($request);

        if ($venue->name !== $data['name']) {
            $data['slug'] = $this->uniqueSlug($data['name'], $venue->id);
        }

        $venue->update($data);

        return redirect()
            ->route('admin.venues.index')
            ->with('success', 'Lokasi venue berhasil diperbarui.');
    }

    public function destroy(Venue $venue): RedirectResponse
    {
        if ($venue->events()->exists()) {
            return back()->with('error', 'Venue masih digunakan oleh acara.');
        }

        $venue->delete();

        return redirect()
            ->route('admin.venues.index')
            ->with('success', 'Lokasi venue berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:100'],
            'capacity' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
            'is_active' => ['sometimes', 'boolean'],
        ]) + ['is_active' => $request->boolean('is_active')];
    }

    private function uniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $base = Str::slug($name);
        $slug = $base;
        $counter = 1;

        while (
            Venue::query()
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
