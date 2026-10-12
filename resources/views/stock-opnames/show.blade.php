@extends('layouts.admin')
@section('title', 'Detail Stock Opname')

@section('content')
<div class="bg-white rounded-xl shadow p-6">
    <div class="flex justify-between mb-4">
        <div>
            <h2 class="text-lg font-semibold">{{ $stockOpname->opname_number }}</h2>
            <p class="text-sm text-gray-500">{{ $stockOpname->opname_date->format('d F Y') }} — Oleh: {{ $stockOpname->user->name }}</p>
        </div>
        <a href="{{ route('stock-opnames.index') }}" class="text-sm text-blue-600">← Kembali</a>
    </div>

    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-left">
            <tr><th class="p-2">Produk</th><th class="p-2">Stok Sistem</th><th class="p-2">Stok Fisik</th><th class="p-2">Selisih</th></tr>
        </thead>
        <tbody class="divide-y">
            @foreach($stockOpname->details as $detail)
            <tr class="{{ $detail->difference != 0 ? 'bg-yellow-50' : '' }}">
                <td class="p-2">{{ $detail->product->name }}</td>
                <td class="p-2">{{ $detail->system_stock }}</td>
                <td class="p-2">{{ $detail->physical_stock }}</td>
                <td class="p-2 {{ $detail->difference < 0 ? 'text-red-600' : ($detail->difference > 0 ? 'text-green-600' : '') }}">
                    {{ $detail->difference > 0 ? '+' : '' }}{{ $detail->difference }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection