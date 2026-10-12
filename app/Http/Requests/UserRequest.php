<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $userId = $this->route('user')?->id;

        return [
            'name' => 'required|string|max:150',
            'email' => 'required|email|max:150|unique:users,email,'.$userId,
            'password' => $this->isMethod('POST') ? ['required', Password::min(8)] : ['nullable', Password::min(8)],
            'role_id' => 'required|exists:roles,id',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:1000',
            'is_active' => 'nullable|boolean',
        ];
    }
}