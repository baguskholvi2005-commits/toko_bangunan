<aside class="w-64 bg-gray-900 text-gray-200 min-h-screen flex flex-col">
    @php $setting = \App\Models\Setting::first(); @endphp
    <div class="px-6 py-5 flex items-center gap-2 text-white border-b border-gray-800">
        @if($setting?->logo)
            <img src="{{ Storage::url($setting->logo) }}" class="w-8 h-8 rounded object-cover">
        @else
            <span>🏗️</span>
        @endif
        <span class="font-bold">{{ $setting?->store_name ?? config('app.name') }}</span>
    </div>

    <nav class="flex-1 px-3 py-4 space-y-1 text-sm">
        <a href="{{ route('dashboard') }}"
           class="block px-3 py-2 rounded-lg hover:bg-gray-800 {{ request()->routeIs('dashboard') ? 'bg-gray-800 text-white' : '' }}">
            Dashboard
        </a>

        <p class="px-3 pt-4 pb-1 text-xs uppercase text-gray-500">Master Data</p>
        <a href="{{ route('categories.index') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-800 {{ request()->routeIs('categories.*') ? 'bg-gray-800 text-white' : '' }}">📁 Kategori</a>
        <a href="{{ route('suppliers.index') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-800 {{ request()->routeIs('suppliers.*') ? 'bg-gray-800 text-white' : '' }}">🚚 Supplier</a>
        <a href="{{ route('customers.index') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-800 {{ request()->routeIs('customers.*') ? 'bg-gray-800 text-white' : '' }}">🧑‍🤝‍🧑 Pelanggan</a>
        <a href="{{ route('products.index') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-800 {{ request()->routeIs('products.*') ? 'bg-gray-800 text-white' : '' }}">📦 Produk</a>

        <p class="px-3 pt-4 pb-1 text-xs uppercase text-gray-500">Transaksi</p>
        <a href="{{ route('purchases.index') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-800 {{ request()->routeIs('purchases.*') ? 'bg-gray-800 text-white' : '' }}">🛒 Pembelian</a>
        <a href="{{ route('sales.index') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-800 {{ request()->routeIs('sales.*') ? 'bg-gray-800 text-white' : '' }}">💰 Penjualan</a>
        <a href="{{ route('stock-opnames.index') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-800 {{ request()->routeIs('stock-opnames.*') ? 'bg-gray-800 text-white' : '' }}">📋 Stock Opname</a>
        <a href="{{ route('reports.index') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-800 {{ request()->routeIs('reports.*') ? 'bg-gray-800 text-white' : '' }}">📈 Laporan</a>

       @if(auth()->user()?->hasRole('admin'))
        <p class="px-3 pt-4 pb-1 text-xs uppercase text-gray-500">Administrasi</p>
        <a href="{{ route('users.index') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-800 {{ request()->routeIs('users.*') ? 'bg-gray-800 text-white' : '' }}">👤 Pengguna</a>
        <a href="{{ route('settings.edit') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-800 {{ request()->routeIs('settings.*') ? 'bg-gray-800 text-white' : '' }}">⚙️ Pengaturan</a>
        <a href="{{ route('activity-logs.index') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-800 {{ request()->routeIs('activity-logs.*') ? 'bg-gray-800 text-white' : '' }}">📝 Log Aktivitas</a>
        <a href="{{ route('backups.index') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-800 {{ request()->routeIs('backups.*') ? 'bg-gray-800 text-white' : '' }}">💾 Backup & Restore</a>
    @endif
    </nav>

    <form method="POST" action="{{ route('logout') }}" class="p-3 border-t border-gray-800">
        @csrf
        <button type="submit" class="w-full text-left px-3 py-2 rounded-lg hover:bg-gray-800 text-red-400">
            🚪 Keluar
        </button>
    </form>
</aside>