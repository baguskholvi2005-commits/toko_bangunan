<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $productId = $this->route('product')?->id;

        return [
            'sku' => 'required|string|max:50|unique:products,sku,'.$productId,
            'barcode' => 'nullable|string|max:100|unique:products,barcode,'.$productId,
            'name' => 'required|string|max:200',
            'category_id' => 'nullable|exists:categories,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'unit' => 'required|string|max:20',
            'purchase_price' => 'required|integer|min:0',
            'selling_price' => 'required|integer|min:0',
            'min_stock' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string|max:2000',
            'is_active' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'sku.unique' => 'SKU ini sudah dipakai produk lain.',
            'barcode.unique' => 'Barcode ini sudah dipakai produk lain.',
            'selling_price.min' => 'Harga jual tidak boleh negatif.',
        ];
    }
}