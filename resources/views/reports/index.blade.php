@extends('layouts.admin')
@section('title', 'Laporan Penjualan')

@section('content')
<div class="bg-white rounded-xl shadow p-6 mb-6">
    <form method="GET" class="flex flex-wrap items-end gap-3">
        <div>
            <label class="block text-sm font-medium mb-1">Dari Tanggal</label>
            <input type="date" name="from" value="{{ $from }}" class="border rounded-lg px-3 py-2 text-sm">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Sampai Tanggal</label>
            <input type="date" name="to" value="{{ $to }}" class="border rounded-lg px-3 py-2 text-sm">
        </div>
        <button class="bg-gray-800 text-white px-4 py-2 rounded-lg text-sm">Tampilkan</button>

        <div class="ml-auto flex gap-2">
            <a href="{{ route('reports.sales.pdf', ['from' => $from, 'to' => $to]) }}" class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm">📄 Export PDF</a>
            <a href="{{ route('reports.sales.excel', ['from' => $from, 'to' => $to]) }}" class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm">📊 Export Excel</a>
        </div>
    </form>
</div>

<div class="grid grid-cols-2 gap-4 mb-6">
    <div class="bg-white rounded-xl shadow p-5">
        <p class="text-sm text-gray-500">Total Omzet ({{ \Carbon\Carbon::parse($from)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($to)->format('d/m/Y') }})</p>
        <p class="text-2xl font-semibold mt-1">Rp {{ number_format($totalOmzet, 0, ',', '.') }}</p>
    </div>
    <div class="bg-white rounded-xl shadow p-5">
        <p class="text-sm text-gray-500">Jumlah Transaksi</p>
        <p class="text-2xl font-semibold mt-1">{{ $totalTransaksi }}</p>
    </div>
</div>

<div class="bg-white rounded-xl shadow p-6">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-left">
            <tr><th class="p-2">No. Invoice</th><th class="p-2">Tanggal</th><th class="p-2">Pelanggan</th><th class="p-2">Kasir</th><th class="p-2">Total</th></tr>
        </thead>
        <tbody class="divide-y">
            @forelse($sales as $sale)
            <tr>
                <td class="p-2">{{ $sale->invoice_number }}</td>
                <td class="p-2">{{ $sale->sale_date->format('d/m/Y H:i') }}</td>
                <td class="p-2">{{ $sale->customer?->name ?? 'Umum' }}</td>
                <td class="p-2">{{ $sale->user->name }}</td>
                <td class="p-2">Rp {{ number_format($sale->grand_total, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr><td colspan="5" class="p-6 text-center text-gray-400">Tidak ada transaksi pada rentang tanggal ini.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection