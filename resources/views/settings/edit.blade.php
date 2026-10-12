@extends('layouts.admin')
@section('title', 'Pengaturan Toko')

@section('content')
<div class="bg-white rounded-xl shadow p-6 max-w-2xl">
    <form method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Nama Toko</label>
            <input type="text" name="store_name" value="{{ old('store_name', $setting->store_name) }}" class="w-full border rounded-lg px-3 py-2 text-sm">
            @error('store_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Logo Toko</label>
            <input type="file" name="logo" accept="image/*" class="w-full border rounded-lg px-3 py-2 text-sm">
            @if($setting->logo)
                <img src="{{ Storage::url($setting->logo) }}" class="w-16 h-16 mt-2 rounded object-cover">
            @endif
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Alamat</label>
            <textarea name="address" rows="2" class="w-full border rounded-lg px-3 py-2 text-sm">{{ old('address', $setting->address) }}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium mb-1">Telepon</label>
                <input type="text" name="phone" value="{{ old('phone', $setting->phone) }}" class="w-full border rounded-lg px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $setting->email) }}" class="w-full border rounded-lg px-3 py-2 text-sm">
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Footer Nota</label>
            <textarea name="receipt_footer" rows="2" class="w-full border rounded-lg px-3 py-2 text-sm">{{ old('receipt_footer', $setting->receipt_footer) }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Pajak Default (%)</label>
            <input type="number" step="0.01" name="default_tax_percent" value="{{ old('default_tax_percent', $setting->default_tax_percent) }}" class="w-full border rounded-lg px-3 py-2 text-sm">
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">Simpan Pengaturan</button>
    </form>
</div>
@endsection