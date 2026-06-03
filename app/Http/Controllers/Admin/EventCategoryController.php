<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class EventCategoryController extends Controller
{
    public function index(): View
    {
        $categories = EventCategory::query()
            ->withCount('events')
            ->orderBy('name')
            ->paginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['slug'] = $this->uniqueSlug($data['name']);

        EventCategory::create($data);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori event berhasil ditambahkan.');
    }

    public function show(EventCategory $category): View
    {
        $category->loadCount('events');

        return view('admin.categories.show', compact('category'));
    }

    public function edit(EventCategory $category): View
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, EventCategory $category): RedirectResponse
    {
        $data = $this->validated($request);

        if ($category->name !== $data['name']) {
            $data['slug'] = $this->uniqueSlug($data['name'], $category->id);
        }

        $category->update($data);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori event berhasil diperbarui.');
    }

    public function destroy(EventCategory $category): RedirectResponse
    {
        if ($category->events()->exists()) {
            return back()->with('error', 'Kategori masih digunakan oleh acara.');
        }

        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori event berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:120'],
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
            EventCategory::query()
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
