<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Product::with(['category', 'supplier'])->orderBy('name')->get();
    }

    public function headings(): array
    {
        return ['SKU', 'Barcode', 'Nama Produk', 'Kategori', 'Supplier', 'Satuan', 'Harga Beli', 'Harga Jual', 'Stok', 'Stok Minimum', 'Status'];
    }

    public function map($product): array
    {
        return [
            $product->sku,
            $product->barcode,
            $product->name,
            $product->category?->name,
            $product->supplier?->name,
            $product->unit,
            $product->purchase_price,
            $product->selling_price,
            $product->stock,
            $product->min_stock,
            $product->is_active ? 'Aktif' : 'Nonaktif',
        ];
    }
}