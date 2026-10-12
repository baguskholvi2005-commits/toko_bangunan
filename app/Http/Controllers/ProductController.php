<?php

namespace App\Http\Controllers;
use App\Exports\ProductsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()
            ->with(['category', 'supplier'])
            ->when(request('search'), fn($q) => $q->where('name', 'like', '%'.request('search').'%')
                ->orWhere('sku', 'like', '%'.request('search').'%'))
            ->when(request('category_id'), fn($q) => $q->where('category_id', request('category_id')))
            ->orderBy(request('sort', 'name'), request('direction', 'asc'))
            ->paginate(10)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view('products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $suppliers = Supplier::where('is_active', true)->orderBy('name')->get();

        return view('products.create', compact('categories', 'suppliers'));
    }

    public function store(ProductRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data); // stock default 0, diisi lewat modul Pembelian/Opname

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        $suppliers = Supplier::where('is_active', true)->orderBy('name')->get();

        return view('products.edit', compact('product', 'categories', 'suppliers'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        if ($product->stock > 0) {
            return back()->with('error', 'Produk masih memiliki stok, tidak bisa dihapus langsung.');
        }

        if ($product->purchaseDetails()->exists() || $product->saleDetails()->exists() || $product->stockOpnameDetails()->exists()) {
            return back()->with('error', 'Produk ini sudah pernah dipakai di transaksi (Pembelian/Penjualan/Stock Opname), sehingga tidak bisa dihapus demi menjaga riwayat transaksi. Nonaktifkan saja lewat Edit → hilangkan centang "Produk Aktif".');
        }

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return back()->with('success', 'Produk berhasil dihapus.');
    }
    public function export()
    {
        return Excel::download(new ProductsExport, 'data-produk-'.now()->format('Ymd_His').'.xlsx');
    }
}