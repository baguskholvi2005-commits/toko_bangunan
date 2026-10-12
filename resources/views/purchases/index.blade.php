@extends('layouts.admin')
@section('title', 'Pembelian')

@section('content')
<div class="bg-white rounded-xl shadow p-6">
    <div class="flex justify-between items-center mb-4">
        <form method="GET" class="flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari no. invoice..."
                   class="border rounded-lg px-3 py-2 text-sm w-64">
            <button class="bg-gray-800 text-white px-4 py-2 rounded-lg text-sm">Cari</button>
        </form>
        <a href="{{ route('purchases.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">+ Pembelian Baru</a>
    </div>

    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-left text-gray-600">
            <tr>
                <th class="p-3">No. Invoice</th>
                <th class="p-3">Tanggal</th>
                <th class="p-3">Supplier</th>
                <th class="p-3">Total</th>
                <th class="p-3">Dibuat Oleh</th>
                <th class="p-3 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse($purchases as $purchase)
            <tr>
                <td class="p-3 font-medium">{{ $purchase->invoice_number }}</td>
                <td class="p-3">{{ $purchase->purchase_date->format('d/m/Y') }}</td>
                <td class="p-3">{{ $purchase->supplier?->name ?? '-' }}</td>
                <td class="p-3">Rp {{ number_format($purchase->total_amount, 0, ',', '.') }}</td>
                <td class="p-3">{{ $purchase->user->name }}</td>
                <td class="p-3 text-right space-x-2">
                    <a href="{{ route('purchases.show', $purchase) }}" class="text-blue-600">Detail</a>
                    <form method="POST" action="{{ route('purchases.destroy', $purchase) }}" class="inline"
                          onsubmit="return confirm('Batalkan pembelian ini? Stok akan dikurangi kembali.')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600">Batalkan</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="p-6 text-center text-gray-400">Belum ada transaksi pembelian.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">{{ $purchases->links() }}</div>
</div>
@endsection