<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::updateOrCreate(['id' => 1], [
            'store_name' => 'Toko Bangunan Jaya',
            'address' => 'Jl. Contoh No. 123, Kota Anda',
            'phone' => '0812xxxxxxxx',
            'email' => 'info@tokobangunanjaya.test',
            'receipt_footer' => 'Terima kasih telah berbelanja. Barang yang sudah dibeli tidak dapat dikembalikan.',
            'default_tax_percent' => 0,
        ]);
    }
}