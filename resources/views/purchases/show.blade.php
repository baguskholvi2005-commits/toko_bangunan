@extends('layouts.admin')
@section('title', 'Detail Pembelian')

@section('content')
<div class="bg-white rounded-xl shadow p-6 max-w-3xl">
    <div class="flex justify-between mb-6">
        <div>
            <h2 class="text-lg font-semibold">{{ $purchase->invoice_number }}</h2>
            <p class="text-sm text-gray-500">{{ $purchase->purchase_date->format('d F Y') }} — Supplier: {{ $purchase->supplier?->name ?? '-' }}</p>
        </div>
        <a href="{{ route('purchases.index') }}" class="text-sm text-blue-600">← Kembali</a>
    </div>

    <table class="w-full text-sm mb-4">
        <thead class="bg-gray-50 text-left">
            <tr><th class="p-2">Produk</th><th class="p-2">Qty</th><th class="p-2">Harga</th><th class="p-2">Subtotal</th></tr>
        </thead>
        <tbody class="divide-y">
            @foreach($purchase->details as $detail)
            <tr>
                <td class="p-2">{{ $detail->product->name }}</td>
                <td class="p-2">{{ $detail->quantity }} {{ $detail->product->unit }}</td>
                <td class="p-2">Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                <td class="p-2">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text-right font-semibold text-lg">
        Total: Rp {{ number_format($purchase->total_amount, 0, ',', '.') }}
    </div>

    @if($purchase->notes)
        <p class="mt-4 text-sm text-gray-500">Catatan: {{ $purchase->notes }}</p>
    @endif
</div>
@endsection