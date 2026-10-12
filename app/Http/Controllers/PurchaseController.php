<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseRequest;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Services\StockService;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with(['supplier', 'user'])
            ->when(request('search'), fn($q) => $q->where('invoice_number', 'like', '%'.request('search').'%'))
            ->orderByDesc('purchase_date')
            ->paginate(10)
            ->withQueryString();

        return view('purchases.index', compact('purchases'));
    }

    public function create()
    {
        $products = Product::where('is_active', true)->orderBy('name')
            ->get(['id', 'name', 'sku', 'purchase_price', 'stock', 'unit']);
        $suppliers = Supplier::where('is_active', true)->orderBy('name')->get();

        return view('purchases.create', compact('products', 'suppliers'));
    }

    public function store(PurchaseRequest $request)
    {
        $purchase = null;

        DB::transaction(function () use ($request, &$purchase) {
            $purchase = Purchase::create([
                'invoice_number' => Purchase::generateInvoiceNumber(),
                'supplier_id' => $request->supplier_id,
                'user_id' => auth()->id(),
                'purchase_date' => $request->purchase_date,
                'total_amount' => 0,
                'status' => 'completed',
                'notes' => $request->notes,
            ]);

            $total = 0;

            foreach ($request->items as $item) {
                $subtotal = $item['quantity'] * $item['price'];
                $total += $subtotal;

                $purchase->details()->create([
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'subtotal' => $subtotal,
                ]);

                $product = Product::find($item['product_id']);

                app(StockService::class)->increase(
                    $product, $item['quantity'], 'purchase', $purchase->id,
                    'Pembelian '.$purchase->invoice_number
                );

                // Harga beli master produk ikut ter-update ke harga terbaru
                $product->update(['purchase_price' => $item['price']]);
            }

            $purchase->update(['total_amount' => $total]);
        });

        return redirect()->route('purchases.show', $purchase)
            ->with('success', 'Pembelian berhasil disimpan, stok produk otomatis bertambah.');
    }

    public function show(Purchase $purchase)
    {
        $purchase->load(['supplier', 'user', 'details.product']);
        return view('purchases.show', compact('purchase'));
    }

    public function destroy(Purchase $purchase)
    {
        DB::transaction(function () use ($purchase) {
            foreach ($purchase->details as $detail) {
                app(StockService::class)->decrease(
                    $detail->product, $detail->quantity, 'purchase', $purchase->id,
                    'Pembatalan Pembelian '.$purchase->invoice_number
                );
            }
            $purchase->delete();
        });

        return redirect()->route('purchases.index')
            ->with('success', 'Pembelian dibatalkan, stok otomatis dikurangi kembali seperti semula.');
    }
}