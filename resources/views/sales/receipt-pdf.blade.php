<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<style>
    body { font-family: monospace; font-size: 11px; margin: 0; padding: 8px; }
    h3, p { text-align: center; margin: 2px 0; }
    table { width: 100%; border-collapse: collapse; margin-top: 8px; }
    td { padding: 2px 0; vertical-align: top; }
    .line { border-top: 1px dashed #000; margin: 6px 0; }
    .right { text-align: right; }
</style>
</head>
<body>
     @if($setting?->logo)
        <p style="text-align:center;">
            <img src="{{ public_path('storage/'.$setting->logo) }}" style="width:60px; height:auto;">
        </p>
    @endif
    <h3>{{ $setting->store_name ?? 'Toko Bangunan' }}</h3>
    <p>{{ $setting->address }}</p>
    <p>{{ $setting->phone }}</p>
    <div class="line"></div>
    <p>No: {{ $sale->invoice_number }}</p>
    <p>{{ $sale->sale_date->format('d/m/Y H:i') }} — Kasir: {{ $sale->user->name }}</p>
    <div class="line"></div>

    <table>
        @foreach($sale->details as $d)
        <tr><td colspan="2">{{ $d->product->name }}</td></tr>
        <tr>
            <td>{{ $d->quantity }} x {{ number_format($d->price, 0, ',', '.') }}</td>
            <td class="right">{{ number_format($d->subtotal, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </table>

    <div class="line"></div>
    <table>
        <tr><td>Subtotal</td><td class="right">{{ number_format($sale->total_amount, 0, ',', '.') }}</td></tr>
        <tr><td>Diskon</td><td class="right">{{ number_format($sale->discount, 0, ',', '.') }}</td></tr>
        <tr><td>Pajak</td><td class="right">{{ number_format($sale->tax, 0, ',', '.') }}</td></tr>
        <tr><td><b>Total</b></td><td class="right"><b>{{ number_format($sale->grand_total, 0, ',', '.') }}</b></td></tr>
        <tr><td>Bayar</td><td class="right">{{ number_format($sale->paid_amount, 0, ',', '.') }}</td></tr>
        <tr><td>Kembali</td><td class="right">{{ number_format($sale->change_amount, 0, ',', '.') }}</td></tr>
    </table>
    <div class="line"></div>
    <p>{{ $setting->receipt_footer ?? 'Terima kasih' }}</p>
</body>
</html>