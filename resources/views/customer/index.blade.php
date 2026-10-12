@extends('layouts.admin')
@section('title', 'Pelanggan')

@section('content')
<div class="bg-white rounded-xl shadow p-6">
    <div class="flex justify-between items-center mb-4">
        <form method="GET" class="flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pelanggan..."
                   class="border rounded-lg px-3 py-2 text-sm w-64">
            <button class="bg-gray-800 text-white px-4 py-2 rounded-lg text-sm">Cari</button>
        </form>
        @if(auth()->user()->hasAnyRole(['admin', 'kasir']))
            <a href="{{ route('customers.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">+ Tambah Pelanggan</a>
        @endif
    </div>

    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-left text-gray-600">
            <tr>
                <th class="p-3">Nama</th>
                <th class="p-3">Telepon</th>
                <th class="p-3">Email</th>
                <th class="p-3">Alamat</th>
                <th class="p-3 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse($customers as $customer)
            <tr>
                <td class="p-3 font-medium">{{ $customer->name }}</td>
                <td class="p-3 text-gray-500">{{ $customer->phone ?? '-' }}</td>
                <td class="p-3 text-gray-500">{{ $customer->email ?? '-' }}</td>
                <td class="p-3 text-gray-500">{{ $customer->address ?? '-' }}</td>
                <td class="p-3 text-right space-x-2">
                    @if(auth()->user()->hasAnyRole(['admin', 'kasir']))
                        <a href="{{ route('customers.edit', $customer) }}" class="text-blue-600">Edit</a>
                        <form method="POST" action="{{ route('customers.destroy', $customer) }}" class="inline"
                              onsubmit="return confirm('Hapus pelanggan ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600">Hapus</button>
                        </form>
                    @else
                        <span class="text-gray-400 text-xs">Lihat saja</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="p-6 text-center text-gray-400">Belum ada pelanggan.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">{{ $customers->links() }}</div>
</div>
@endsection