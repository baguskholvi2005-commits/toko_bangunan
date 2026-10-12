<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'customer_id' => 'nullable|exists:customers,id',
            'payment_method' => 'required|in:cash,transfer,qris,debit',
            'discount' => 'nullable|integer|min:0',
            'tax' => 'nullable|integer|min:0',
            'paid_amount' => 'required|integer|min:0',
            'notes' => 'nullable|string|max:1000',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'items.required' => 'Keranjang belanja masih kosong.',
        ];
    }
}