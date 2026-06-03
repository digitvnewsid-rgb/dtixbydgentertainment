<?php

namespace App\Http\Requests;

use App\Enums\EventStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:200'],
            'description' => ['nullable', 'string'],
            'banner' => ['nullable', 'image', 'max:2048'],
            'location' => ['required', 'string', 'max:255'],
            'map_url' => ['nullable', 'url', 'max:500'],
            'start_datetime' => ['required', 'date'],
            'end_datetime' => ['required', 'date', 'after:start_datetime'],
            'status' => ['required', Rule::enum(EventStatus::class)],
        ];

        if ($this->is('admin/*')) {
            $rules['creator_id'] = ['required', 'exists:users,id'];
        }

        return $rules;
    }
}
