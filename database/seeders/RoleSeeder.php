<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'Admin', 'slug' => 'admin', 'description' => 'Akses penuh ke seluruh sistem'],
            ['name' => 'Owner', 'slug' => 'owner', 'description' => 'Pemilik toko, akses laporan & pengaturan'],
            ['name' => 'Kasir', 'slug' => 'kasir', 'description' => 'Akses transaksi penjualan'],
            ['name' => 'Gudang', 'slug' => 'gudang', 'description' => 'Akses stok dan pembelian barang'],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(['slug' => $role['slug']], $role);
        }
    }
}