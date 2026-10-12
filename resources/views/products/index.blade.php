@extends('layouts.admin')
@section('title', 'Produk')

@section('content')
<div class="bg-white rounded-xl shadow p-6">
    <div class="flex justify-between items-center mb-4 flex-wrap gap-2">
        <form method="GET" class="flex gap-2 flex-wrap">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama/SKU..."
                   class="border rounded-lg px-3 py-2 text-sm w-56">
            <select name="category_id" class="border rounded-lg px-3 py-2 text-sm">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
            <button class="bg-gray-800 text-white px-4 py-2 rounded-lg text-sm">Filter</button>
        </form>
        <a href="{{ route('products.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">+ Tambah Produk</a>
        <a href="{{ route('products.export') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm">📊 Export Excel</a>
    </div>

    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-left text-gray-600">
            <tr>
                <th class="p-3">Produk</th>
                <th class="p-3">SKU</th>
                <th class="p-3">Kategori</th>
                <th class="p-3">Harga Jual</th>
                <th class="p-3">Stok</th>
                <th class="p-3 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse($products as $product)
            <tr>
                <td class="p-3 flex items-center gap-2">
                    @if($product->image)
                        <img src="{{ Storage::url($product->image) }}" class="w-8 h-8 rounded object-cover">
                    @else
                        <div class="w-8 h-8 rounded bg-gray-200"></div>
                    @endif
                    {{ $product->name }}
                </td>
                <td class="p-3 text-gray-500">{{ $product->sku }}</td>
                <td class="p-3">{{ $product->category?->name ?? '-' }}</td>
                <td class="p-3">Rp {{ number_format($product->selling_price, 0, ',', '.') }}</td>
                <td class="p-3">
                    <span class="px-2 py-0.5 rounded-full text-xs
                        {{ $product->stock_status === 'habis' ? 'bg-red-100 text-red-700' :
                           ($product->stock_status === 'hampir_habis' ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700') }}">
                        {{ $product->stock }} {{ $product->unit }}
                    </span>
                </td>
                <td class="p-3 text-right space-x-2">
                    <a href="{{ route('products.edit', $product) }}" class="text-blue-600">Edit</a>
                    <form method="POST" action="{{ route('products.destroy', $product) }}" class="inline" onsubmit="return confirm('Hapus produk ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="p-6 text-center text-gray-400">Belum ada produk.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">{{ $products->links() }}</div>
</div>
@endsection