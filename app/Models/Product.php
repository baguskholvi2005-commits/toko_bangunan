<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;

class Product extends Model
{
    use LogsActivity;
    protected $fillable = [
        'sku', 'barcode', 'name', 'category_id', 'supplier_id',
        'unit', 'purchase_price', 'selling_price',
        'stock', 'min_stock', 'image', 'description', 'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'purchase_price' => 'integer',
            'selling_price' => 'integer',
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function purchaseDetails()
    {
        return $this->hasMany(PurchaseDetail::class);
    }

    public function saleDetails()
    {
        return $this->hasMany(SaleDetail::class);
    }

    public function stockOpnameDetails()
    {
        return $this->hasMany(StockOpnameDetail::class);
    }

    // Accessor: status stok untuk badge di UI (habis / hampir habis / aman)
    public function getStockStatusAttribute(): string
    {
        if ($this->stock <= 0) return 'habis';
        if ($this->stock <= $this->min_stock) return 'hampir_habis';
        return 'aman';
    }
}