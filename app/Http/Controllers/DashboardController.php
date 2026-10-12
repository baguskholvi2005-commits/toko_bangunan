<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;

class DashboardController extends Controller
{
    public function index()
    {
        $today = now()->toDateString();

        $todaySales = Sale::whereDate('sale_date', $today)->sum('grand_total');
        $monthSales = Sale::whereMonth('sale_date', now()->month)->whereYear('sale_date', now()->year)->sum('grand_total');
        $totalProducts = Product::where('is_active', true)->count();

        $lowStockProducts = Product::whereColumn('stock', '<=', 'min_stock')
            ->where('stock', '>', 0)->where('is_active', true)->get();
        $outOfStockProducts = Product::where('stock', '<=', 0)->where('is_active', true)->get();

        $salesPerDay = Sale::selectRaw('DATE(sale_date) as date, SUM(grand_total) as total')
            ->where('sale_date', '>=', now()->subDays(6)->startOfDay())
            ->groupBy('date')->get();

        $chartLabels = [];
        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $chartLabels[] = now()->subDays($i)->format('d/m');
            $found = $salesPerDay->firstWhere('date', $date);
            $chartData[] = $found ? (float) $found->total : 0;
        }

        $topProducts = SaleDetail::selectRaw('product_id, SUM(quantity) as total_qty')
            ->whereHas('sale', fn($q) => $q->where('sale_date', '>=', now()->subDays(30)))
            ->groupBy('product_id')
            ->orderByDesc('total_qty')
            ->take(5)
            ->with('product')
            ->get();

        $recentSales = Sale::with('user')->latest('sale_date')->take(5)->get();

        return view('dashboard', compact(
            'todaySales', 'monthSales', 'totalProducts', 'lowStockProducts', 'outOfStockProducts',
            'chartLabels', 'chartData', 'topProducts', 'recentSales'
        ));
    }
}