<?php

namespace App\Http\Controllers;

use App\Exports\SalesReportExport;
use App\Models\Sale;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $from = $request->input('from', now()->startOfMonth()->toDateString());
        $to = $request->input('to', now()->toDateString());

        $sales = $this->getSales($from, $to);

        return view('reports.index', [
            'sales' => $sales,
            'from' => $from,
            'to' => $to,
            'totalOmzet' => $sales->sum('grand_total'),
            'totalTransaksi' => $sales->count(),
        ]);
    }

    public function exportPdf(Request $request)
    {
        $from = $request->input('from', now()->startOfMonth()->toDateString());
        $to = $request->input('to', now()->toDateString());

        $sales = $this->getSales($from, $to);

        $pdf = Pdf::loadView('reports.sales-pdf', [
            'sales' => $sales,
            'from' => $from,
            'to' => $to,
            'totalOmzet' => $sales->sum('grand_total'),
        ])->setPaper('a4', 'portrait');

        return $pdf->download('laporan-penjualan-'.$from.'-sd-'.$to.'.pdf');
    }

    public function exportExcel(Request $request)
    {
        $from = $request->input('from', now()->startOfMonth()->toDateString());
        $to = $request->input('to', now()->toDateString());

        return Excel::download(new SalesReportExport($from, $to), 'laporan-penjualan-'.$from.'-sd-'.$to.'.xlsx');
    }

    private function getSales(string $from, string $to)
    {
        return Sale::with(['customer', 'user'])
            ->whereDate('sale_date', '>=', $from)
            ->whereDate('sale_date', '<=', $to)
            ->orderBy('sale_date')
            ->get();
    }
}