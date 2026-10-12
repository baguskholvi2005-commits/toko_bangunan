@extends('layouts.admin')
@section('title', 'Penjualan')

@section('content')
<div class="bg-white rounded-xl shadow p-6">
    <div class="flex justify-between items-center mb-4">
        <form method="GET" class="flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari no. invoice..."
                   class="border rounded-lg px-3 py-2 text-sm w-64">
            <button class="bg-gray-800 text-white px-4 py-2 rounded-lg text-sm">Cari</button>
        </form>
        <a href="{{ route('sales.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm">+ Transaksi Baru (POS)</a>
    </div>

    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-left text-gray-600">
            <tr>
                <th class="p-3">No. Invoice</th>
                <th class="p-3">Tanggal</th>
                <th class="p-3">Pelanggan</th>
                <th class="p-3">Total</th>
                <th class="p-3">Kasir</th>
                <th class="p-3 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse($sales as $sale)
            <tr>
                <td class="p-3 font-medium">{{ $sale->invoice_number }}</td>
                <td class="p-3">{{ $sale->sale_date->format('d/m/Y H:i') }}</td>
                <td class="p-3">{{ $sale->customer?->name ?? 'Umum' }}</td>
                <td class="p-3">Rp {{ number_format($sale->grand_total, 0, ',', '.') }}</td>
                <td class="p-3">{{ $sale->user->name }}</td>
                <td class="p-3 text-right space-x-2">
                    <a href="{{ route('sales.show', $sale) }}" class="text-blue-600">Detail</a>
                    <form method="POST" action="{{ route('sales.destroy', $sale) }}" class="inline"
                          onsubmit="return confirm('Batalkan transaksi ini? Stok akan dikembalikan.')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600">Batalkan</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="p-6 text-center text-gray-400">Belum ada transaksi penjualan.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">{{ $sales->links() }}</div>
</div>
@endsection