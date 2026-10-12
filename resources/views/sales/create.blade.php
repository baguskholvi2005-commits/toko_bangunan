@extends('layouts.admin')
@section('title', 'Transaksi Penjualan (POS)')

@section('content')
@error('items') <div class="mb-4 rounded-lg bg-red-100 text-red-800 px-4 py-3 text-sm">{{ $message }}</div> @enderror

<div x-data="posCart()" class="grid grid-cols-3 gap-6">
    <div class="col-span-2 bg-white rounded-xl shadow p-6">
        <div class="mb-4">
            <input type="text" x-model="barcodeInput" @keydown.enter.prevent="scanBarcode()"
                   placeholder="Scan barcode / ketik SKU lalu tekan Enter..." autofocus
                   class="w-full border rounded-lg px-3 py-2 text-sm">
        </div>

        <div class="mb-4 relative">
            <input type="text" x-model="search" placeholder="Atau cari nama produk..."
                   class="w-full border rounded-lg px-3 py-2 text-sm">
            <div class="border rounded-lg mt-1 max-h-48 overflow-y-auto bg-white shadow absolute w-full z-10" x-show="search.length > 0">
                <template x-for="product in filteredProducts()" :key="product.id">
                    <div @click="addToCart(product); search=''" class="px-3 py-2 text-sm hover:bg-gray-50 cursor-pointer flex justify-between">
                        <span x-text="product.name"></span>
                        <span class="text-gray-400" x-text="'Stok: ' + product.stock"></span>
                    </div>
                </template>
            </div>
        </div>

        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-left">
                <tr>
                    <th class="p-2">Produk</th>
                    <th class="p-2 w-20">Qty</th>
                    <th class="p-2 w-28">Harga</th>
                    <th class="p-2 w-28">Subtotal</th>
                    <th class="p-2 w-10"></th>
                </tr>
            </thead>
            <tbody>
                <template x-for="(item, index) in cart" :key="item.product_id">
                    <tr class="border-b">
                        <td class="p-2" x-text="item.name"></td>
                        <td class="p-2">
                            <input type="number" min="1" :max="item.stock" x-model.number="item.quantity"
                                   @input="clampQuantity(index)" class="w-16 border rounded px-2 py-1">
                        </td>
                        <td class="p-2" x-text="formatRupiah(item.price)"></td>
                        <td class="p-2" x-text="formatRupiah(item.price * item.quantity)"></td>
                        <td class="p-2"><button type="button" @click="cart.splice(index,1)" class="text-red-600">✕</button></td>
                    </tr>
                </template>
                <tr x-show="cart.length === 0"><td colspan="5" class="p-6 text-center text-gray-400">Keranjang masih kosong.</td></tr>
            </tbody>
        </table>
    </div>

    <form method="POST" action="{{ route('sales.store') }}" class="bg-white rounded-xl shadow p-6 h-fit" @submit="beforeSubmit">
        @csrf
        <h3 class="font-semibold mb-4">Ringkasan Pembayaran</h3>

        <div class="mb-3">
            <label class="block text-sm font-medium mb-1">Pelanggan (opsional)</label>
            <select name="customer_id" class="w-full border rounded-lg px-3 py-2 text-sm">
                <option value="">Pelanggan Umum</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="block text-sm font-medium mb-1">Metode Pembayaran</label>
            <select name="payment_method" class="w-full border rounded-lg px-3 py-2 text-sm">
                <option value="cash">Tunai</option>
                <option value="transfer">Transfer</option>
                <option value="qris">QRIS</option>
                <option value="debit">Debit</option>
            </select>
        </div>

        <div class="flex justify-between text-sm mb-1"><span>Subtotal</span><span x-text="formatRupiah(subtotal())"></span></div>
        <div class="flex justify-between text-sm mb-1 items-center">
            <span>Diskon</span>
            <input type="number" name="discount" x-model.number="discount" min="0" class="w-24 border rounded px-2 py-1 text-right text-sm">
        </div>
        <div class="flex justify-between text-sm mb-1 items-center">
            <span>Pajak</span>
            <input type="number" name="tax" x-model.number="tax" min="0" class="w-24 border rounded px-2 py-1 text-right text-sm">
        </div>
        <div class="flex justify-between font-semibold text-base border-t pt-2 mt-2 mb-3">
            <span>Total</span><span x-text="formatRupiah(grandTotal())"></span>
        </div>

        <div class="mb-3">
            <label class="block text-sm font-medium mb-1">Uang Dibayar</label>
            <input type="number" name="paid_amount" x-model.number="paid" min="0" class="w-full border rounded-lg px-3 py-2 text-sm">
        </div>
        <div class="flex justify-between text-sm mb-4"><span>Kembalian</span><span x-text="formatRupiah(change())"></span></div>

        <template x-for="(item, index) in cart" :key="'hidden-'+item.product_id">
            <div>
                <input type="hidden" :name="'items['+index+'][product_id]'" :value="item.product_id">
                <input type="hidden" :name="'items['+index+'][quantity]'" :value="item.quantity">
                <input type="hidden" :name="'items['+index+'][price]'" :value="item.price">
            </div>
        </template>

        <button type="submit" :disabled="cart.length === 0" class="w-full bg-blue-600 text-white py-2 rounded-lg text-sm disabled:opacity-50">
            Simpan &amp; Cetak Struk
        </button>
    </form>
</div>

<script>
function posCart() {
    return {
        products: @json($products),
        cart: [],
        search: '',
        barcodeInput: '',
        discount: 0,
        tax: 0,
        paid: 0,

        filteredProducts() {
            if (this.search.length === 0) return [];
            return this.products.filter(p => p.name.toLowerCase().includes(this.search.toLowerCase())).slice(0, 8);
        },

        scanBarcode() {
            const code = this.barcodeInput.trim();
            const product = this.products.find(p => p.barcode === code || p.sku === code);
            if (product) {
                this.addToCart(product);
            } else if (code.length > 0) {
                alert('Produk dengan kode "' + code + '" tidak ditemukan.');
            }
            this.barcodeInput = '';
        },

        addToCart(product) {
            const existing = this.cart.find(i => i.product_id === product.id);
            if (existing) {
                if (existing.quantity < product.stock) existing.quantity++;
                else alert('Stok tidak cukup.');
            } else {
                if (product.stock < 1) { alert('Stok produk ini habis.'); return; }
                this.cart.push({ product_id: product.id, name: product.name, price: product.selling_price, quantity: 1, stock: product.stock });
            }
        },

        clampQuantity(index) {
            const item = this.cart[index];
            if (item.quantity > item.stock) item.quantity = item.stock;
            if (item.quantity < 1) item.quantity = 1;
        },

        subtotal() {
            return this.cart.reduce((sum, i) => sum + (i.price * i.quantity), 0);
        },

        grandTotal() {
            return this.subtotal() - (this.discount || 0) + (this.tax || 0);
        },

        change() {
            return Math.max(0, (this.paid || 0) - this.grandTotal());
        },

        formatRupiah(value) {
            return 'Rp ' + (value || 0).toLocaleString('id-ID');
        },

        beforeSubmit(e) {
            if (this.cart.length === 0) {
                e.preventDefault();
                alert('Keranjang masih kosong.');
            }
        }
    }
}
</script>
@endsection