<?php

namespace App\Services;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Support\Facades\Auth;

class StockService
{
    /**
     * Menambah stok produk (misal: dari pembelian atau opname positif)
     */
    public function increase(Product $product, int $quantity, string $referenceType, ?int $referenceId = null, ?string $notes = null): StockMovement
    {
        $stockBefore = $product->stock;
        $stockAfter = $stockBefore + $quantity;

        $product->update(['stock' => $stockAfter]);

        return StockMovement::create([
            'product_id' => $product->id,
            'type' => 'in',
            'reference_type' => $referenceType,
            'reference_id' => $referenceId,
            'quantity' => $quantity,
            'stock_before' => $stockBefore,
            'stock_after' => $stockAfter,
            'user_id' => Auth::id(),
            'notes' => $notes,
        ]);
    }

    /**
     * Mengurangi stok produk (misal: dari penjualan atau opname negatif)
     */
    public function decrease(Product $product, int $quantity, string $referenceType, ?int $referenceId = null, ?string $notes = null): StockMovement
    {
        $stockBefore = $product->stock;
        $stockAfter = $stockBefore - $quantity;

        $product->update(['stock' => $stockAfter]);

        return StockMovement::create([
            'product_id' => $product->id,
            'type' => 'out',
            'reference_type' => $referenceType,
            'reference_id' => $referenceId,
            'quantity' => $quantity,
            'stock_before' => $stockBefore,
            'stock_after' => $stockAfter,
            'user_id' => Auth::id(),
            'notes' => $notes,
        ]);
    }

    /**
     * Penyesuaian langsung ke nilai tertentu (dipakai saat Stock Opname)
     */
    public function adjustTo(Product $product, int $newStock, string $referenceType, ?int $referenceId = null, ?string $notes = null): StockMovement
    {
        $stockBefore = $product->stock;
        $difference = $newStock - $stockBefore;

        $product->update(['stock' => $newStock]);

        return StockMovement::create([
            'product_id' => $product->id,
            'type' => 'adjustment',
            'reference_type' => $referenceType,
            'reference_id' => $referenceId,
            'quantity' => abs($difference),
            'stock_before' => $stockBefore,
            'stock_after' => $newStock,
            'user_id' => Auth::id(),
            'notes' => $notes,
        ]);
    }
}