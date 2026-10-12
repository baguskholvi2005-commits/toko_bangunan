@extends('layouts.admin')
@section('title', 'Kategori')

@section('content')
<div class="bg-white rounded-xl shadow p-6">
    <div class="flex justify-between items-center mb-4">
        <form method="GET" class="flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kategori..."
                   class="border rounded-lg px-3 py-2 text-sm w-64">
            <button class="bg-gray-800 text-white px-4 py-2 rounded-lg text-sm">Cari</button>
        </form>
        @if(auth()->user()->hasRole('admin'))
        <a href="{{ route('categories.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">+ Tambah Kategori</a>
        @endif
    </div>

    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-left text-gray-600">
            <tr>
                <th class="p-3">Nama</th>
                <th class="p-3">Deskripsi</th>
                <th class="p-3">Jumlah Produk</th>
                <th class="p-3 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse($categories as $category)
            <tr>
                <td class="p-3 font-medium">{{ $category->name }}</td>
                <td class="p-3 text-gray-500">{{ $category->description ?? '-' }}</td>
                <td class="p-3">{{ $category->products_count }}</td>
                <td class="p-3 text-right space-x-2">
                    @if(auth()->user()->hasRole('admin'))
                        <a href="{{ route('categories.edit', $category) }}" class="text-blue-600">Edit</a>
                        <form method="POST" action="{{ route('categories.destroy', $category) }}" class="inline"
                              onsubmit="return confirm('Hapus kategori ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600">Hapus</button>
                        </form>
                    @else
                        <span class="text-gray-400 text-xs">Lihat saja</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="p-6 text-center text-gray-400">Belum ada kategori.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">{{ $categories->links() }}</div>
</div>
@endsection