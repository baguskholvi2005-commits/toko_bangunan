<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;

class Setting extends Model
{
    use LogsActivity;
    protected $fillable = [
        'store_name', 'logo', 'address', 'phone', 'email',
        'receipt_footer', 'default_tax_percent',
    ];
}