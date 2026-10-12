<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;

class Sale extends Model
{
    use LogsActivity;
    protected $fillable = [
        'invoice_number', 'customer_id', 'user_id', 'sale_date',
        'total_amount', 'discount', 'tax', 'grand_total',
        'paid_amount', 'change_amount', 'payment_method', 'status', 'notes',
    ];

    protected function casts(): array
    {
        return ['sale_date' => 'datetime'];
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(SaleDetail::class);
    }
    public static function generateInvoiceNumber(): string
    {
        $prefix = 'INV-'.now()->format('Ymd').'-';
        $last = static::where('invoice_number', 'like', $prefix.'%')->orderByDesc('id')->first();
        $number = $last ? ((int) substr($last->invoice_number, -4)) + 1 : 1;

        return $prefix.str_pad($number, 4, '0', STR_PAD_LEFT);
    }
}