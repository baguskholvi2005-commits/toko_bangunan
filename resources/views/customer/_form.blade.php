<div class="mb-4">
    <label class="block text-sm font-medium mb-1">Nama Supplier</label>
    <input type="text" name="name" value="{{ old('name', $supplier->name ?? '') }}" class="w-full border rounded-lg px-3 py-2 text-sm">
    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
</div>

<div class="grid grid-cols-2 gap-4 mb-4">
    <div>
        <label class="block text-sm font-medium mb-1">Telepon</label>
        <input type="text" name="phone" value="{{ old('phone', $supplier->phone ?? '') }}" class="w-full border rounded-lg px-3 py-2 text-sm">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Email</label>
        <input type="email" name="email" value="{{ old('email', $supplier->email ?? '') }}" class="w-full border rounded-lg px-3 py-2 text-sm">
        @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
</div>
<div class="mb-4">
    <label class="block text-sm font-medium mb-1">Alamat</label>
    <textarea name="address" rows="3" class="w-full border rounded-lg px-3 py-2 text-sm">{{ old('address', $supplier->address ?? '') }}</textarea>
</div>