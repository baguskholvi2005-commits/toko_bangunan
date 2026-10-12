<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleRequest;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Services\StockService;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with(['customer', 'user'])
            ->when(request('search'), fn($q) => $q->where('invoice_number', 'like', '%'.request('search').'%'))
            ->orderByDesc('sale_date')
            ->paginate(10)
            ->withQueryString();

        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $products = Product::where('is_active', true)->where('stock', '>', 0)->orderBy('name')
            ->get(['id', 'name', 'sku', 'barcode', 'selling_price', 'stock', 'unit']);
        $customers = Customer::orderBy('name')->get();

        return view('sales.create', compact('products', 'customers'));
    }

    public function store(SaleRequest $request)
    {
        // Validasi stok tersedia SEBELUM transaksi database dimulai
        foreach ($request->items as $item) {
            $product = Product::find($item['product_id']);
            if ($item['quantity'] > $product->stock) {
                return back()->withErrors([
                    'items' => "Stok \"{$product->name}\" tidak cukup (tersisa {$product->stock} {$product->unit}).",
                ])->withInput();
            }
        }

        $sale = null;

        DB::transaction(function () use ($request, &$sale) {
            $subtotal = collect($request->items)->sum(fn($i) => $i['quantity'] * $i['price']);
            $discount = $request->discount ?? 0;
            $tax = $request->tax ?? 0;
            $grandTotal = $subtotal - $discount + $tax;

            $sale = Sale::create([
                'invoice_number' => Sale::generateInvoiceNumber(),
                'customer_id' => $request->customer_id,
                'user_id' => auth()->id(),
                'sale_date' => now(),
                'total_amount' => $subtotal,
                'discount' => $discount,
                'tax' => $tax,
                'grand_total' => $grandTotal,
                'paid_amount' => $request->paid_amount,
                'change_amount' => max(0, $request->paid_amount - $grandTotal),
                'payment_method' => $request->payment_method,
                'status' => 'completed',
                'notes' => $request->notes,
            ]);

            foreach ($request->items as $item) {
                $product = Product::find($item['product_id']);
                $subtotalItem = $item['quantity'] * $item['price'];

                $sale->details()->create([
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'subtotal' => $subtotalItem,
                ]);

                app(StockService::class)->decrease(
                    $product, $item['quantity'], 'sale', $sale->id,
                    'Penjualan '.$sale->invoice_number
                );
            }
        });

        return redirect()->route('sales.show', $sale)->with('success', 'Transaksi penjualan berhasil disimpan.');
    }

    public function show(Sale $sale)
    {
        $sale->load(['customer', 'user', 'details.product']);
        return view('sales.show', compact('sale'));
    }

    public function destroy(Sale $sale)
    {
        DB::transaction(function () use ($sale) {
            foreach ($sale->details as $detail) {
                app(StockService::class)->increase(
                    $detail->product, $detail->quantity, 'sale', $sale->id,
                    'Pembatalan Penjualan '.$sale->invoice_number
                );
            }
            $sale->delete();
        });

        return redirect()->route('sales.index')->with('success', 'Transaksi dibatalkan, stok otomatis dikembalikan.');
    }
    public function receiptPdf(Sale $sale)
    {
        $sale->load(['customer', 'user', 'details.product']);
        $setting = \App\Models\Setting::first();

        $pdf = Pdf::loadView('sales.receipt-pdf', compact('sale', 'setting'))
            ->setPaper([0, 0, 226.77, 700]); // lebar ~80mm ala struk kasir

        return $pdf->download('struk-'.$sale->invoice_number.'.pdf');
    }
}