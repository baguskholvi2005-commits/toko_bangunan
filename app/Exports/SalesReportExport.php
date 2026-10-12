<?php

namespace App\Exports;

use App\Models\Sale;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SalesReportExport implements FromCollection, WithHeadings, WithMapping
{
    public function __construct(protected string $from, protected string $to) {}

    public function collection()
    {
        return Sale::with(['customer', 'user'])
            ->whereDate('sale_date', '>=', $this->from)
            ->whereDate('sale_date', '<=', $this->to)
            ->orderBy('sale_date')
            ->get();
    }

    public function headings(): array
    {
        return ['No. Invoice', 'Tanggal', 'Pelanggan', 'Kasir', 'Subtotal', 'Diskon', 'Pajak', 'Total', 'Metode Bayar'];
    }

    public function map($sale): array
    {
        return [
            $sale->invoice_number,
            $sale->sale_date->format('d/m/Y H:i'),
            $sale->customer?->name ?? 'Umum',
            $sale->user->name,
            $sale->total_amount,
            $sale->discount,
            $sale->tax,
            $sale->grand_total,
            $sale->payment_method,
        ];
    }
}