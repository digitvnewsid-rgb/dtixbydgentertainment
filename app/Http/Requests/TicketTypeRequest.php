<?php

namespace App\Http\Requests;

use App\Enums\TicketTypeStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TicketTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'price' => ['required', 'integer', 'min:0'],
            'quota' => ['required', 'integer', 'min:1'],
            'max_purchase' => ['required', 'integer', 'min:1', 'max:20'],
            'sale_start' => ['required', 'date'],
            'sale_end' => ['required', 'date', 'after:sale_start'],
            'benefits' => ['nullable', 'string'],
            'status' => ['required', Rule::enum(TicketTypeStatus::class)],
        ];
    }
}
