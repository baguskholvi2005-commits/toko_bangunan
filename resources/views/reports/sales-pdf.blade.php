<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        h2 { margin-bottom: 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ccc; padding: 6px 8px; text-align: left; }
        th { background: #f3f4f6; }
        .text-right { text-align: right; }
        .summary { margin-top: 15px; font-weight: bold; }
    </style>
</head>
<body>
    <h2>Laporan Penjualan</h2>
    <p>Periode: {{ \Carbon\Carbon::parse($from)->format('d F Y') }} — {{ \Carbon\Carbon::parse($to)->format('d F Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>No. Invoice</th>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Kasir</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sales as $sale)
            <tr>
                <td>{{ $sale->invoice_number }}</td>
                <td>{{ $sale->sale_date->format('d/m/Y H:i') }}</td>
                <td>{{ $sale->customer?->name ?? 'Umum' }}</td>
                <td>{{ $sale->user->name }}</td>
                <td class="text-right">Rp {{ number_format($sale->grand_total, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr><td colspan="5" style="text-align:center;">Tidak ada transaksi.</td></tr>
            @endforelse
        </tbody>
    </table>

    <p class="summary">Total Omzet: Rp {{ number_format($totalOmzet, 0, ',', '.') }}</p>
</body>
</html>