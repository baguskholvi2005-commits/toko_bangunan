@extends('layouts.admin')
@section('title', 'Supplier')

@section('content')
<div class="bg-white rounded-xl shadow p-6">
    <div class="flex justify-between items-center mb-4">
        <form method="GET" class="flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari supplier..."
                   class="border rounded-lg px-3 py-2 text-sm w-64">
            <button class="bg-gray-800 text-white px-4 py-2 rounded-lg text-sm">Cari</button>
        </form>
        @if(auth()->user()->hasAnyRole(['admin', 'gudang']))
            <a href="{{ route('suppliers.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">+ Tambah Supplier</a>
        @endif
    </div>

    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-left text-gray-600">
            <tr>
                <th class="p-3">Nama</th>
                <th class="p-3">Kontak (PIC)</th>
                <th class="p-3">Telepon</th>
                <th class="p-3">Email</th>
                <th class="p-3">Status</th>
                <th class="p-3 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse($suppliers as $supplier)
            <tr>
                <td class="p-3 font-medium">{{ $supplier->name }}</td>
                <td class="p-3 text-gray-500">{{ $supplier->contact_person ?? '-' }}</td>
                <td class="p-3 text-gray-500">{{ $supplier->phone ?? '-' }}</td>
                <td class="p-3 text-gray-500">{{ $supplier->email ?? '-' }}</td>
                <td class="p-3">
                    @if($supplier->is_active)
                        <span class="px-2 py-0.5 rounded-full text-xs bg-green-100 text-green-700">Aktif</span>
                    @else
                        <span class="px-2 py-0.5 rounded-full text-xs bg-gray-100 text-gray-600">Nonaktif</span>
                    @endif
                </td>
                <td class="p-3 text-right space-x-2">
                    @if(auth()->user()->hasAnyRole(['admin', 'gudang']))
                        <a href="{{ route('suppliers.edit', $supplier) }}" class="text-blue-600">Edit</a>
                        <form method="POST" action="{{ route('suppliers.destroy', $supplier) }}" class="inline"
                              onsubmit="return confirm('Hapus supplier ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600">Hapus</button>
                        </form>
                    @else
                        <span class="text-gray-400 text-xs">Lihat saja</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="p-6 text-center text-gray-400">Belum ada supplier.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">{{ $suppliers->links() }}</div>
</div>
@endsection