<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockOpnameRequest;
use App\Models\Product;
use App\Models\StockOpname;
use App\Services\StockService;
use Illuminate\Support\Facades\DB;

class StockOpnameController extends Controller
{
    public function index()
    {
        $opnames = StockOpname::with('user')->orderByDesc('opname_date')->paginate(10);
        return view('stock-opnames.index', compact('opnames'));
    }

    public function create()
    {
        $products = Product::where('is_active', true)->orderBy('name')->get();
        return view('stock-opnames.create', compact('products'));
    }

    public function store(StockOpnameRequest $request)
    {
        $opname = null;

        DB::transaction(function () use ($request, &$opname) {
            $opname = StockOpname::create([
                'opname_number' => StockOpname::generateNumber(),
                'user_id' => auth()->id(),
                'opname_date' => $request->opname_date,
                'status' => 'completed',
                'notes' => $request->notes,
            ]);

            foreach ($request->items as $item) {
                $product = Product::find($item['product_id']);
                $systemStock = $product->stock;
                $physicalStock = $item['physical_stock'];
                $difference = $physicalStock - $systemStock;

                $opname->details()->create([
                    'product_id' => $product->id,
                    'system_stock' => $systemStock,
                    'physical_stock' => $physicalStock,
                    'difference' => $difference,
                ]);

                // Hanya catat pergerakan stok jika memang ada selisih
                if ($difference !== 0) {
                    app(StockService::class)->adjustTo(
                        $product, $physicalStock, 'opname', $opname->id,
                        'Stock Opname '.$opname->opname_number
                    );
                }
            }
        });

        return redirect()->route('stock-opnames.show', $opname)
            ->with('success', 'Stock opname berhasil disimpan dan stok telah disesuaikan.');
    }

    public function show(StockOpname $stockOpname)
    {
        $stockOpname->load(['user', 'details.product']);
        return view('stock-opnames.show', compact('stockOpname'));
    }
}