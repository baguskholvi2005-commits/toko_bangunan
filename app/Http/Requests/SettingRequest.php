<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'store_name' => 'required|string|max:150',
            'logo' => 'nullable|image|max:2048',
            'address' => 'nullable|string|max:1000',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'receipt_footer' => 'nullable|string|max:1000',
            'default_tax_percent' => 'nullable|numeric|min:0|max:100',
        ];
    }
}