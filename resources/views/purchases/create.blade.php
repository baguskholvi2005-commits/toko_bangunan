@extends('layouts.admin')
@section('title', 'Pembelian Baru')

@section('content')
<div x-data="purchaseCart()" class="grid grid-cols-3 gap-6">
    <div class="col-span-2 bg-white rounded-xl shadow p-6">
        <div class="mb-4">
            <input type="text" x-model="search" placeholder="Cari produk untuk ditambahkan..."
                   class="w-full border rounded-lg px-3 py-2 text-sm">
            <div class="border rounded-lg mt-1 max-h-48 overflow-y-auto bg-white shadow" x-show="search.length > 0">
                <template x-for="product in filteredProducts()" :key="product.id">
                    <div @click="addToCart(product); search=''" class="px-3 py-2 text-sm hover:bg-gray-50 cursor-pointer flex justify-between">
                        <span x-text="product.name"></span>
                        <span class="text-gray-400" x-text="'Stok saat ini: ' + product.stock"></span>
                    </div>
                </template>
            </div>
        </div>

        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-left">
                <tr>
                    <th class="p-2">Produk</th>
                    <th class="p-2 w-24">Qty</th>
                    <th class="p-2 w-32">Harga Beli</th>
                    <th class="p-2 w-32">Subtotal</th>
                    <th class="p-2 w-10"></th>
                </tr>
            </thead>
            <tbody>
                <template x-for="(item, index) in cart" :key="item.product_id">
                    <tr class="border-b">
                        <td class="p-2" x-text="item.name"></td>
                        <td class="p-2"><input type="number" min="1" x-model.number="item.quantity" class="w-16 border rounded px-2 py-1"></td>
                        <td class="p-2"><input type="number" min="0" x-model.number="item.price" class="w-28 border rounded px-2 py-1"></td>
                        <td class="p-2" x-text="formatRupiah(item.price * item.quantity)"></td>
                        <td class="p-2"><button type="button" @click="cart.splice(index,1)" class="text-red-600">✕</button></td>
                    </tr>
                </template>
                <tr x-show="cart.length === 0"><td colspan="5" class="p-6 text-center text-gray-400">Belum ada item.</td></tr>
            </tbody>
        </table>
    </div>

    <form method="POST" action="{{ route('purchases.store') }}" class="bg-white rounded-xl shadow p-6 h-fit">
        @csrf
        <h3 class="font-semibold mb-4">Detail Pembelian</h3>

        <div class="mb-3">
            <label class="block text-sm font-medium mb-1">Supplier</label>
            <select name="supplier_id" class="w-full border rounded-lg px-3 py-2 text-sm">
                <option value="">- Pilih Supplier -</option>
                @foreach($suppliers as $sup)
                    <option value="{{ $sup->id }}">{{ $sup->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="block text-sm font-medium mb-1">Tanggal Pembelian</label>
            <input type="date" name="purchase_date" value="{{ date('Y-m-d') }}" class="w-full border rounded-lg px-3 py-2 text-sm">
        </div>

        <div class="mb-3">
            <label class="block text-sm font-medium mb-1">Catatan</label>
            <textarea name="notes" rows="2" class="w-full border rounded-lg px-3 py-2 text-sm"></textarea>
        </div>

        @error('items') <p class="text-red-500 text-xs mb-2">{{ $message }}</p> @enderror

        <div class="flex justify-between font-semibold text-base border-t pt-2 mb-4">
            <span>Total</span><span x-text="formatRupiah(total())"></span>
        </div>

        <template x-for="(item, index) in cart" :key="'hidden-'+item.product_id">
            <div>
                <input type="hidden" :name="'items['+index+'][product_id]'" :value="item.product_id">
                <input type="hidden" :name="'items['+index+'][quantity]'" :value="item.quantity">
                <input type="hidden" :name="'items['+index+'][price]'" :value="item.price">
            </div>
        </template>

        <button type="submit" :disabled="cart.length === 0" class="w-full bg-blue-600 text-white py-2 rounded-lg text-sm disabled:opacity-50">
            Simpan Pembelian
        </button>
    </form>
</div>

<script>
function purchaseCart() {
    return {
        products: @json($products),
        cart: [],
        search: '',

        filteredProducts() {
            if (this.search.length === 0) return [];
            return this.products.filter(p => p.name.toLowerCase().includes(this.search.toLowerCase())).slice(0, 8);
        },

        addToCart(product) {
            const existing = this.cart.find(i => i.product_id === product.id);
            if (existing) { existing.quantity++; return; }
            this.cart.push({ product_id: product.id, name: product.name, price: product.purchase_price, quantity: 1 });
        },

        total() {
            return this.cart.reduce((sum, i) => sum + (i.price * i.quantity), 0);
        },

        formatRupiah(value) {
            return 'Rp ' + (value || 0).toLocaleString('id-ID');
        }
    }
}
</script>
@endsection