<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;

class Purchase extends Model
{
    use LogsActivity;
    protected $fillable = [
        'invoice_number', 'supplier_id', 'user_id',
        'purchase_date', 'total_amount', 'status', 'notes',
    ];

    protected function casts(): array
    {
        return ['purchase_date' => 'date'];
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(PurchaseDetail::class);
    }
    public static function generateInvoiceNumber(): string
    {
        $prefix = 'PB-'.now()->format('Ymd').'-';
        $last = static::where('invoice_number', 'like', $prefix.'%')->orderByDesc('id')->first();
        $number = $last ? ((int) substr($last->invoice_number, -4)) + 1 : 1;

        return $prefix.str_pad($number, 4, '0', STR_PAD_LEFT);
    }
}