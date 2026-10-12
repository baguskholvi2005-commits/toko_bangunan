<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;

class StockOpname extends Model
{
    use LogsActivity;
    protected $fillable = ['opname_number', 'user_id', 'opname_date', 'status', 'notes'];

    protected function casts(): array
    {
        return ['opname_date' => 'date'];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(StockOpnameDetail::class);
    }
    public static function generateNumber(): string
    {
        $prefix = 'OPN-'.now()->format('Ymd').'-';
        $last = static::where('opname_number', 'like', $prefix.'%')->orderByDesc('id')->first();
        $number = $last ? ((int) substr($last->opname_number, -4)) + 1 : 1;

        return $prefix.str_pad($number, 4, '0', STR_PAD_LEFT);
    }
}