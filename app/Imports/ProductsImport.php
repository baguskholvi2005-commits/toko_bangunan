<!-- <?php

// namespace App\Imports;

// use App\Models\Category;
// use App\Models\Product;
// use App\Models\Supplier;
// use Illuminate\Support\Str;
// use Maatwebsite\Excel\Concerns\SkipsFailures;
// use Maatwebsite\Excel\Concerns\SkipsOnFailure;
// use Maatwebsite\Excel\Concerns\ToModel;
// use Maatwebsite\Excel\Concerns\WithHeadingRow;
// use Maatwebsite\Excel\Concerns\WithValidation;

// class ProductsImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
// {
//     use SkipsFailures;

//     public function model(array $row)
//     {
//         $category = null;
//         if (! empty($row['kategori'])) {
//             $category = Category::firstOrCreate(
//                 ['name' => trim($row['kategori'])],
//                 ['slug' => Str::slug($row['kategori']).'-'.uniqid()]
//             );
//         }

//         $supplier = null;
//         if (! empty($row['supplier'])) {
//             $supplier = Supplier::firstOrCreate(['name' => trim($row['supplier'])]);
//         }

//         return new Product([
//             'sku' => $row['sku'],
//             'barcode' => $row['barcode'] ?? null,
//             'name' => $row['nama_produk'],
//             'category_id' => $category?->id,
//             'supplier_id' => $supplier?->id,
//             'unit' => $row['satuan'] ?? 'pcs',
//             'purchase_price' => $row['harga_beli'] ?? 0,
//             'selling_price' => $row['harga_jual'] ?? 0,
//             'min_stock' => $row['stok_minimum'] ?? 5,
//             'stock' => 0, // stok tetap 0, harus diisi lewat Pembelian/Opname
//             'is_active' => true,
//         ]);
//     }

//     public function rules(): array
//     {
//         return [
//             'sku' => 'required|distinct|unique:products,sku',
//             'nama_produk' => 'required',
//             'harga_jual' => 'nullable|numeric',
//         ];
//     }

//     public function customValidationMessages(): array
//     {
//         return [
//             'sku.unique' => 'SKU sudah dipakai produk lain di database.',
//             'sku.distinct' => 'SKU ini duplikat di dalam file Excel yang sama.',
//             'nama_produk.required' => 'Nama produk wajib diisi.',
//         ];
//     }
// } 