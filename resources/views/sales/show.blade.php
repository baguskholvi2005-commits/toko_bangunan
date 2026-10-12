@extends('layouts.admin')
@section('title', 'Detail Transaksi')

@section('content')
<div class="bg-white rounded-xl shadow p-6 max-w-2xl">
    <div class="flex justify-between mb-6">
        <div>
            <h2 class="text-lg font-semibold">{{ $sale->invoice_number }}</h2>
            <p class="text-sm text-gray-500">{{ $sale->sale_date->format('d F Y H:i') }} — Kasir: {{ $sale->user->name }}</p>
            <p class="text-sm text-gray-500">Pelanggan: {{ $sale->customer?->name ?? 'Umum' }}</p>
        </div>
        <a href="{{ route('sales.index') }}" class="text-sm text-blue-600">← Kembali</a>
        <a href="{{ route('sales.receipt.pdf', $sale) }}" class="text-sm text-red-600">🖨️ Cetak Struk (PDF)</a>
    </div>

    <table class="w-full text-sm mb-4">
        <thead class="bg-gray-50 text-left">
            <tr><th class="p-2">Produk</th><th class="p-2">Qty</th><th class="p-2">Harga</th><th class="p-2">Subtotal</th></tr>
        </thead>
        <tbody class="divide-y">
            @foreach($sale->details as $detail)
            <tr>
                <td class="p-2">{{ $detail->product->name }}</td>
                <td class="p-2">{{ $detail->quantity }} {{ $detail->product->unit }}</td>
                <td class="p-2">Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                <td class="p-2">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="space-y-1 text-sm max-w-xs ml-auto">
        <div class="flex justify-between"><span>Subtotal</span><span>Rp {{ number_format($sale->total_amount, 0, ',', '.') }}</span></div>
        <div class="flex justify-between"><span>Diskon</span><span>Rp {{ number_format($sale->discount, 0, ',', '.') }}</span></div>
        <div class="flex justify-between"><span>Pajak</span><span>Rp {{ number_format($sale->tax, 0, ',', '.') }}</span></div>
        <div class="flex justify-between font-semibold border-t pt-1"><span>Total</span><span>Rp {{ number_format($sale->grand_total, 0, ',', '.') }}</span></div>
        <div class="flex justify-between"><span>Dibayar ({{ $sale->payment_method }})</span><span>Rp {{ number_format($sale->paid_amount, 0, ',', '.') }}</span></div>
        <div class="flex justify-between"><span>Kembalian</span><span>Rp {{ number_format($sale->change_amount, 0, ',', '.') }}</span></div>
    </div>
</div>
@endsection