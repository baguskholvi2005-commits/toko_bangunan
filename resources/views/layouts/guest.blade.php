<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ \App\Models\Setting::first()?->store_name ?? config('app.name', 'Toko Bangunan') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    @php $setting = \App\Models\Setting::first(); @endphp

    <div class="min-h-screen flex">

        {{-- Panel Kiri: Branding --}}
        <div class="hidden lg:flex lg:w-1/2 bg-gray-900 text-white flex-col justify-between p-12 relative overflow-hidden">
            <div class="absolute -right-20 -top-20 w-80 h-80 rounded-full bg-amber-500/10"></div>
            <div class="absolute -left-10 bottom-0 w-60 h-60 rounded-full bg-amber-500/10"></div>

            <div class="relative z-10 flex items-center gap-3">
                @if($setting?->logo)
                    <img src="{{ Storage::url($setting->logo) }}" class="w-11 h-11 rounded-xl object-cover border-2 border-amber-500">
                @else
                    <div class="w-11 h-11 rounded-xl bg-amber-500 flex items-center justify-center text-xl">🏗️</div>
                @endif
                <span class="text-xl font-bold tracking-tight">{{ $setting?->store_name ?? config('app.name') }}</span>
            </div>

            <div class="relative z-10 max-w-md">
                <div class="w-10 h-1 bg-amber-500 rounded-full mb-4"></div>
                <h1 class="text-3xl font-bold leading-snug mb-4">Kelola stok & transaksi toko bangunan Anda dalam satu sistem.</h1>
                <p class="text-gray-400 text-sm">Pantau pembelian, penjualan, dan stok secara real-time — dari mana saja, kapan saja.</p>
            </div>

            <div class="relative z-10 text-xs text-gray-500">
                &copy; {{ date('Y') }} {{ $setting?->store_name ?? config('app.name') }}. Semua hak dilindungi.
            </div>
        </div>

        {{-- Panel Kanan: Form --}}
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-10 bg-gray-50">
            <div class="w-full max-w-sm">

                <div class="flex lg:hidden items-center justify-center gap-2 mb-8">
                    @if($setting?->logo)
                        <img src="{{ Storage::url($setting->logo) }}" class="w-10 h-10 rounded-xl object-cover border-2 border-amber-500">
                    @else
                        <div class="w-10 h-10 rounded-xl bg-gray-900 flex items-center justify-center text-lg">🏗️</div>
                    @endif
                    <span class="text-lg font-bold text-gray-800">{{ $setting?->store_name ?? config('app.name') }}</span>
                </div>

                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                    <div class="h-1.5 bg-amber-500"></div>
                    <div class="p-8">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>