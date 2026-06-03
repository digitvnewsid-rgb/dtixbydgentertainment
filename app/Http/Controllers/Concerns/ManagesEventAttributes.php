<?php

namespace App\Http\Controllers\Concerns;

use App\Http\Requests\EventRequest;
use App\Models\Event;
use App\Support\SlugService;
use Illuminate\Http\UploadedFile;

trait ManagesEventAttributes
{
    protected function eventPayload(EventRequest $request, ?Event $event = null): array
    {
        $data = $request->validated();
        unset($data['banner'], $data['creator_id']);

        if (! $event || $event->title !== $data['title']) {
            $data['slug'] = SlugService::unique($data['title'], new Event, $event?->id);
        }

        if ($request->hasFile('banner')) {
            $data['banner'] = $this->storeBanner($request->file('banner'), $event?->banner);
        }

        return $data;
    }

    protected function storeBanner(UploadedFile $file, ?string $oldPath = null): string
    {
        if ($oldPath) {
            \Storage::disk('public')->delete($oldPath);
        }

        return $file->store('events/banners', 'public');
    }

    protected function applyEventFilters($query, \Illuminate\Http\Request $request): void
    {
        $query->when($request->filled('q'), function ($q) use ($request) {
            $term = '%'.$request->string('q').'%';
            $q->where(fn ($inner) => $inner
                ->where('title', 'like', $term)
                ->orWhere('location', 'like', $term));
        })
            ->when($request->filled('category_id'), fn ($q) => $q->where('category_id', $request->integer('category_id')))
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->string('status')))
            ->when($request->filled('date_from'), fn ($q) => $q->whereDate('start_datetime', '>=', $request->string('date_from')))
            ->when($request->filled('date_to'), fn ($q) => $q->whereDate('start_datetime', '<=', $request->string('date_to')));
    }
}
