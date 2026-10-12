<header class="bg-white border-b px-6 py-4 flex justify-between items-center">
    <h1 class="text-lg font-semibold text-gray-800">@yield('title', 'Dashboard')</h1>

    @php
        $alertCount = \App\Models\Product::where('is_active', true)
            ->whereColumn('stock', '<=', 'min_stock')->count();
    @endphp

    <div class="flex items-center gap-4">
        <a href="{{ route('dashboard') }}" class="relative" title="Notifikasi stok">
            🔔
            @if($alertCount > 0)
                <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs rounded-full w-4 h-4 flex items-center justify-center">
                    {{ $alertCount }}
                </span>
            @endif
        </a>

        <div class="text-sm text-gray-600">
            {{ auth()->user()->name }}
            <span class="ml-1 px-2 py-0.5 text-xs rounded-full bg-blue-100 text-blue-700">
                {{ auth()->user()->role?->name ?? '-' }}
            </span>
        </div>
    </div>
</header>