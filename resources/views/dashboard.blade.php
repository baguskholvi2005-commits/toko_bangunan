@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-xl shadow p-5">
        <p class="text-sm text-gray-500">Penjualan Hari Ini</p>
        <p class="text-2xl font-semibold mt-1">Rp {{ number_format($todaySales, 0, ',', '.') }}</p>
    </div>
    <div class="bg-white rounded-xl shadow p-5">
        <p class="text-sm text-gray-500">Penjualan Bulan Ini</p>
        <p class="text-2xl font-semibold mt-1">Rp {{ number_format($monthSales, 0, ',', '.') }}</p>
    </div>
    <div class="bg-white rounded-xl shadow p-5">
        <p class="text-sm text-gray-500">Total Produk Aktif</p>
        <p class="text-2xl font-semibold mt-1">{{ $totalProducts }}</p>
    </div>
    <div class="bg-white rounded-xl shadow p-5">
        <p class="text-sm text-gray-500">Peringatan Stok</p>
        <p class="text-2xl font-semibold mt-1 text-red-600">{{ $lowStockProducts->count() + $outOfStockProducts->count() }}</p>
    </div>
</div>

<div class="grid grid-cols-3 gap-6 mb-6">
    <div class="col-span-2 bg-white rounded-xl shadow p-6">
        <h3 class="font-semibold mb-4">Grafik Penjualan 7 Hari Terakhir</h3>
        <canvas id="salesChart" height="100"></canvas>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <h3 class="font-semibold mb-4">Produk Terlaris (30 Hari)</h3>
        <ul class="space-y-2 text-sm">
            @forelse($topProducts as $top)
                <li class="flex justify-between">
                    <span>{{ $top->product->name ?? '-' }}</span>
                    <span class="text-gray-500">{{ $top->total_qty }} terjual</span>
                </li>
            @empty
                <li class="text-gray-400">Belum ada data penjualan.</li>
            @endforelse
        </ul>
    </div>
</div>

<div class="grid grid-cols-2 gap-6">
    <div class="bg-white rounded-xl shadow p-6">
        <h3 class="font-semibold mb-4">⚠️ Notifikasi Stok</h3>
        <div class="space-y-2 text-sm max-h-64 overflow-y-auto">
            @foreach($outOfStockProducts as $product)
                <div class="flex justify-between items-center px-3 py-2 rounded-lg bg-red-50 text-red-700">
                    <span>{{ $product->name }}</span><span class="text-xs">Stok Habis</span>
                </div>
            @endforeach
            @foreach($lowStockProducts as $product)
                <div class="flex justify-between items-center px-3 py-2 rounded-lg bg-yellow-50 text-yellow-700">
                    <span>{{ $product->name }}</span><span class="text-xs">Sisa {{ $product->stock }} {{ $product->unit }}</span>
                </div>
            @endforeach
            @if($outOfStockProducts->isEmpty() && $lowStockProducts->isEmpty())
                <p class="text-gray-400">Semua stok aman.</p>
            @endif
        </div>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <h3 class="font-semibold mb-4">Transaksi Terbaru</h3>
        <table class="w-full text-sm">
            <tbody class="divide-y">
                @forelse($recentSales as $sale)
                <tr>
                    <td class="py-2">{{ $sale->invoice_number }}</td>
                    <td class="py-2 text-gray-500">{{ $sale->sale_date->format('d/m H:i') }}</td>
                    <td class="py-2 text-right">Rp {{ number_format($sale->grand_total, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr><td class="py-4 text-center text-gray-400">Belum ada transaksi.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    new Chart(document.getElementById('salesChart'), {
        type: 'line',
        data: {
            labels: @json($chartLabels),
            datasets: [{
                label: 'Penjualan (Rp)',
                data: @json($chartData),
                borderColor: '#2563eb',
                backgroundColor: 'rgba(37,99,235,0.1)',
                tension: 0.3,
                fill: true,
            }]
        },
        options: { responsive: true, plugins: { legend: { display: false } } }
    });
</script>
@endpush