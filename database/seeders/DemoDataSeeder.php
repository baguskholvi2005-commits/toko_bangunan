<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        // ===== KATEGORI =====
        $categories = [
            'Semen & Bahan Bangunan',
            'Besi & Baja',
            'Cat & Pelapis',
            'Pipa & Sanitair',
            'Listrik & Lampu',
            'Kayu & Triplek',
            'Keramik & Lantai',
            'Perkakas & Alat Tukang',
            'Paku, Baut & Mur',
            'Atap & Rangka',
        ];

        foreach ($categories as $name) {
            Category::updateOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name, 'slug' => Str::slug($name).'-'.uniqid(), 'description' => null]
            );
        }

        // ===== SUPPLIER =====
        $suppliers = [
            ['name' => 'PT Semen Indonusa', 'contact_person' => 'Budi Santoso', 'phone' => '021-5551234', 'email' => 'sales@semenindonusa.co.id', 'address' => 'Jl. Industri Raya No. 45, Jakarta'],
            ['name' => 'CV Baja Makmur Jaya', 'contact_person' => 'Siti Aminah', 'phone' => '021-5559876', 'email' => 'cs@bajamakmur.co.id', 'address' => 'Jl. Rawa Bali No. 12, Bekasi'],
            ['name' => 'Toko Cat Warna Ceria', 'contact_person' => 'Hendra Wijaya', 'phone' => '0812-3344-5566', 'email' => 'hendra@catwarnaceria.com', 'address' => 'Jl. Kelapa Gading No. 8, Jakarta'],
            ['name' => 'UD Pipa Sejahtera', 'contact_person' => 'Andi Prasetyo', 'phone' => '0813-2211-9988', 'email' => 'andi@pipasejahtera.id', 'address' => 'Jl. Pahlawan No. 21, Tangerang'],
            ['name' => 'PT Listrik Terang Abadi', 'contact_person' => 'Rina Kartika', 'phone' => '021-5552211', 'email' => 'rina@listrikterang.co.id', 'address' => 'Jl. Ahmad Yani No. 100, Bogor'],
        ];

        foreach ($suppliers as $s) {
            Supplier::updateOrCreate(['name' => $s['name']], [...$s, 'is_active' => true]);
        }

        // ===== PELANGGAN =====
        $customers = [
            ['name' => 'Bapak Joko (Kontraktor)', 'phone' => '0812-1111-2222', 'email' => 'joko.kontraktor@gmail.com', 'address' => 'Perumahan Griya Asri Blok C2'],
            ['name' => 'CV Bangun Sentosa', 'phone' => '021-7778899', 'email' => 'admin@bangunsentosa.co.id', 'address' => 'Jl. Raya Bogor KM 25'],
            ['name' => 'Ibu Wati', 'phone' => '0813-4444-5555', 'email' => null, 'address' => 'Jl. Melati No. 7'],
            ['name' => 'Bapak Dedi', 'phone' => '0857-6666-7777', 'email' => null, 'address' => 'Komplek Puri Indah No. 15'],
        ];

        foreach ($customers as $c) {
            Customer::updateOrCreate(['name' => $c['name']], $c);
        }

        // ===== PRODUK =====
        $semen = Category::where('name', 'Semen & Bahan Bangunan')->first();
        $besi = Category::where('name', 'Besi & Baja')->first();
        $cat = Category::where('name', 'Cat & Pelapis')->first();
        $pipa = Category::where('name', 'Pipa & Sanitair')->first();
        $listrik = Category::where('name', 'Listrik & Lampu')->first();
        $kayu = Category::where('name', 'Kayu & Triplek')->first();
        $keramik = Category::where('name', 'Keramik & Lantai')->first();
        $perkakas = Category::where('name', 'Perkakas & Alat Tukang')->first();
        $paku = Category::where('name', 'Paku, Baut & Mur')->first();
        $atap = Category::where('name', 'Atap & Rangka')->first();

        $supSemen = Supplier::where('name', 'PT Semen Indonusa')->first();
        $supBaja = Supplier::where('name', 'CV Baja Makmur Jaya')->first();
        $supCat = Supplier::where('name', 'Toko Cat Warna Ceria')->first();
        $supPipa = Supplier::where('name', 'UD Pipa Sejahtera')->first();
        $supListrik = Supplier::where('name', 'PT Listrik Terang Abadi')->first();

        $products = [
            ['sku' => 'SMN-001', 'barcode' => '8991002300011', 'name' => 'Semen Portland 50kg', 'category_id' => $semen->id, 'supplier_id' => $supSemen->id, 'unit' => 'sak', 'purchase_price' => 62000, 'selling_price' => 68000, 'min_stock' => 20],
            ['sku' => 'SMN-002', 'barcode' => '8991002300028', 'name' => 'Semen Putih 40kg', 'category_id' => $semen->id, 'supplier_id' => $supSemen->id, 'unit' => 'sak', 'purchase_price' => 75000, 'selling_price' => 82000, 'min_stock' => 10],
            ['sku' => 'SMN-003', 'barcode' => null, 'name' => 'Pasir Cor per m3', 'category_id' => $semen->id, 'supplier_id' => null, 'unit' => 'm3', 'purchase_price' => 250000, 'selling_price' => 300000, 'min_stock' => 5],
            ['sku' => 'BSI-001', 'barcode' => '8991002400015', 'name' => 'Besi Beton Ulir 10mm', 'category_id' => $besi->id, 'supplier_id' => $supBaja->id, 'unit' => 'batang', 'purchase_price' => 68000, 'selling_price' => 75000, 'min_stock' => 30],
            ['sku' => 'BSI-002', 'barcode' => '8991002400022', 'name' => 'Besi Beton Polos 8mm', 'category_id' => $besi->id, 'supplier_id' => $supBaja->id, 'unit' => 'batang', 'purchase_price' => 45000, 'selling_price' => 52000, 'min_stock' => 30],
            ['sku' => 'BSI-003', 'barcode' => null, 'name' => 'Kawat Bendrat 1kg', 'category_id' => $besi->id, 'supplier_id' => $supBaja->id, 'unit' => 'kg', 'purchase_price' => 18000, 'selling_price' => 22000, 'min_stock' => 15],
            ['sku' => 'CAT-001', 'barcode' => '8991002500012', 'name' => 'Cat Tembok Putih 25kg', 'category_id' => $cat->id, 'supplier_id' => $supCat->id, 'unit' => 'pail', 'purchase_price' => 195000, 'selling_price' => 225000, 'min_stock' => 10],
            ['sku' => 'CAT-002', 'barcode' => '8991002500029', 'name' => 'Cat Kayu & Besi 1kg', 'category_id' => $cat->id, 'supplier_id' => $supCat->id, 'unit' => 'kaleng', 'purchase_price' => 45000, 'selling_price' => 55000, 'min_stock' => 15],
            ['sku' => 'CAT-003', 'barcode' => null, 'name' => 'Kuas Cat 3 Inci', 'category_id' => $cat->id, 'supplier_id' => $supCat->id, 'unit' => 'pcs', 'purchase_price' => 8000, 'selling_price' => 12000, 'min_stock' => 20],
            ['sku' => 'PIP-001', 'barcode' => '8991002600019', 'name' => 'Pipa PVC 3 Inci AW', 'category_id' => $pipa->id, 'supplier_id' => $supPipa->id, 'unit' => 'batang', 'purchase_price' => 62000, 'selling_price' => 72000, 'min_stock' => 15],
            ['sku' => 'PIP-002', 'barcode' => '8991002600026', 'name' => 'Kran Air Stainless', 'category_id' => $pipa->id, 'supplier_id' => $supPipa->id, 'unit' => 'pcs', 'purchase_price' => 25000, 'selling_price' => 35000, 'min_stock' => 20],
            ['sku' => 'PIP-003', 'barcode' => null, 'name' => 'Lem Pipa PVC 100gr', 'category_id' => $pipa->id, 'supplier_id' => $supPipa->id, 'unit' => 'pcs', 'purchase_price' => 12000, 'selling_price' => 17000, 'min_stock' => 25],
            ['sku' => 'LIS-001', 'barcode' => '8991002700016', 'name' => 'Kabel Listrik NYM 2x1.5mm', 'category_id' => $listrik->id, 'supplier_id' => $supListrik->id, 'unit' => 'meter', 'purchase_price' => 6500, 'selling_price' => 8500, 'min_stock' => 100],
            ['sku' => 'LIS-002', 'barcode' => '8991002700023', 'name' => 'Lampu LED Bulb 12W', 'category_id' => $listrik->id, 'supplier_id' => $supListrik->id, 'unit' => 'pcs', 'purchase_price' => 18000, 'selling_price' => 25000, 'min_stock' => 30],
            ['sku' => 'LIS-003', 'barcode' => null, 'name' => 'Saklar Tunggal', 'category_id' => $listrik->id, 'supplier_id' => $supListrik->id, 'unit' => 'pcs', 'purchase_price' => 9000, 'selling_price' => 14000, 'min_stock' => 20],
            ['sku' => 'KYU-001', 'barcode' => null, 'name' => 'Triplek 9mm 122x244', 'category_id' => $kayu->id, 'supplier_id' => null, 'unit' => 'lembar', 'purchase_price' => 95000, 'selling_price' => 115000, 'min_stock' => 10],
            ['sku' => 'KYU-002', 'barcode' => null, 'name' => 'Kaso Kayu 5x7', 'category_id' => $kayu->id, 'supplier_id' => null, 'unit' => 'batang', 'purchase_price' => 35000, 'selling_price' => 42000, 'min_stock' => 20],
            ['sku' => 'KRM-001', 'barcode' => '8991002800013', 'name' => 'Keramik Lantai 40x40', 'category_id' => $keramik->id, 'supplier_id' => null, 'unit' => 'dus', 'purchase_price' => 65000, 'selling_price' => 78000, 'min_stock' => 15],
            ['sku' => 'PRK-001', 'barcode' => null, 'name' => 'Palu Konde 500gr', 'category_id' => $perkakas->id, 'supplier_id' => null, 'unit' => 'pcs', 'purchase_price' => 35000, 'selling_price' => 48000, 'min_stock' => 10],
            ['sku' => 'PRK-002', 'barcode' => null, 'name' => 'Gergaji Kayu 24 Inci', 'category_id' => $perkakas->id, 'supplier_id' => null, 'unit' => 'pcs', 'purchase_price' => 45000, 'selling_price' => 62000, 'min_stock' => 8],
            ['sku' => 'PKU-001', 'barcode' => null, 'name' => 'Paku Beton 5cm 1kg', 'category_id' => $paku->id, 'supplier_id' => null, 'unit' => 'kg', 'purchase_price' => 22000, 'selling_price' => 28000, 'min_stock' => 20],
            ['sku' => 'ATP-001', 'barcode' => null, 'name' => 'Genteng Metal Pasir', 'category_id' => $atap->id, 'supplier_id' => null, 'unit' => 'lembar', 'purchase_price' => 32000, 'selling_price' => 40000, 'min_stock' => 30],
        ];

        foreach ($products as $p) {
            Product::updateOrCreate(['sku' => $p['sku']], [...$p, 'stock' => 0, 'is_active' => true]);
        }
    }
}