<div class="grid grid-cols-2 gap-4 mb-4">
    <div>
        <label class="block text-sm font-medium mb-1">SKU</label>
        <input type="text" name="sku" value="{{ old('sku', $product->sku ?? '') }}" class="w-full border rounded-lg px-3 py-2 text-sm">
        @error('sku') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Barcode (opsional)</label>
        <input type="text" name="barcode" value="{{ old('barcode', $product->barcode ?? '') }}" class="w-full border rounded-lg px-3 py-2 text-sm">
        @error('barcode') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
</div>

<div class="mb-4">
    <label class="block text-sm font-medium mb-1">Nama Produk</label>
    <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}" class="w-full border rounded-lg px-3 py-2 text-sm">
    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
</div>

<div class="grid grid-cols-2 gap-4 mb-4">
    <div>
        <label class="block text-sm font-medium mb-1">Kategori</label>
        <select name="category_id" class="w-full border rounded-lg px-3 py-2 text-sm">
            <option value="">- Pilih Kategori -</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id ?? '') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Supplier</label>
        <select name="supplier_id" class="w-full border rounded-lg px-3 py-2 text-sm">
            <option value="">- Pilih Supplier -</option>
            @foreach($suppliers as $sup)
                <option value="{{ $sup->id }}" {{ old('supplier_id', $product->supplier_id ?? '') == $sup->id ? 'selected' : '' }}>{{ $sup->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="grid grid-cols-3 gap-4 mb-4">
    <div>
        <label class="block text-sm font-medium mb-1">Satuan</label>
        <input type="text" name="unit" value="{{ old('unit', $product->unit ?? 'pcs') }}" placeholder="pcs, sak, batang..." class="w-full border rounded-lg px-3 py-2 text-sm">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Harga Beli</label>
        <input type="number" name="purchase_price" value="{{ old('purchase_price', $product->purchase_price ?? 0) }}" class="w-full border rounded-lg px-3 py-2 text-sm">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Harga Jual</label>
        <input type="number" name="selling_price" value="{{ old('selling_price', $product->selling_price ?? 0) }}" class="w-full border rounded-lg px-3 py-2 text-sm">
        @error('selling_price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
</div>

<div class="mb-4">
    <label class="block text-sm font-medium mb-1">Stok Minimum (ambang batas notifikasi hampir habis)</label>
    <input type="number" name="min_stock" value="{{ old('min_stock', $product->min_stock ?? 5) }}" class="w-full border rounded-lg px-3 py-2 text-sm">
</div>

<div class="mb-4">
    <label class="block text-sm font-medium mb-1">Gambar Produk</label>
    <input type="file" name="image" accept="image/*" class="w-full border rounded-lg px-3 py-2 text-sm">
    @if(isset($product) && $product->image)
        <img src="{{ Storage::url($product->image) }}" class="w-16 h-16 mt-2 rounded object-cover">
    @endif
</div>

<div class="mb-4">
    <label class="block text-sm font-medium mb-1">Deskripsi</label>
    <textarea name="description" rows="3" class="w-full border rounded-lg px-3 py-2 text-sm">{{ old('description', $product->description ?? '') }}</textarea>
</div>

<div class="mb-4">
    <label class="inline-flex items-center gap-2 text-sm">
        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }}>
        Produk Aktif (ditampilkan di transaksi)
    </label>
</div>