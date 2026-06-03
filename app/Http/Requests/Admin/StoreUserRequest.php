<?php

namespace App\Http\Requests\Admin;

use App\Enums\UserRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->role === UserRole::Administrator;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:30'],
            'password' => ['required', Password::defaults()],
            'role' => ['required', Rule::in([
                UserRole::Administrator->value,
                UserRole::Creator->value,
                UserRole::Customer->value,
                UserRole::Ticketing->value,
            ])],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
