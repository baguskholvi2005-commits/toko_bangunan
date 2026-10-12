@extends('layouts.admin')
@section('title', 'Stock Opname Baru')

@section('content')
<div x-data="{ search: '' }" class="bg-white rounded-xl shadow p-6">
    <form method="POST" action="{{ route('stock-opnames.store') }}">
        @csrf
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium mb-1">Tanggal Opname</label>
                <input type="date" name="opname_date" value="{{ date('Y-m-d') }}" class="w-full border rounded-lg px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Catatan</label>
                <input type="text" name="notes" class="w-full border rounded-lg px-3 py-2 text-sm">
            </div>
        </div>

        <input type="text" x-model="search" placeholder="Cari produk untuk mempersempit daftar..."
               class="w-full border rounded-lg px-3 py-2 text-sm mb-4">

        @error('items') <p class="text-red-500 text-xs mb-2">{{ $message }}</p> @enderror

        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-left">
                <tr><th class="p-2">Produk</th><th class="p-2 w-32">Stok Sistem</th><th class="p-2 w-32">Stok Fisik</th></tr>
            </thead>
            <tbody>
                @foreach($products as $index => $product)
                <tr x-show="search === '' || '{{ strtolower($product->name) }}'.includes(search.toLowerCase())" class="border-b">
                    <td class="p-2">{{ $product->name }} <span class="text-gray-400 text-xs">({{ $product->unit }})</span></td>
                    <td class="p-2 text-gray-500">
                        {{ $product->stock }}
                        <input type="hidden" name="items[{{ $index }}][product_id]" value="{{ $product->id }}">
                    </td>
                    <td class="p-2">
                        <input type="number" min="0" name="items[{{ $index }}][physical_stock]" value="{{ $product->stock }}"
                               class="w-24 border rounded px-2 py-1">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">Simpan Stock Opname</button>
    </form>
</div>
@endsection