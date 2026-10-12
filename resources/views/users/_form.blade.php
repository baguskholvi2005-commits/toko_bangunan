<div class="mb-4">
    <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
    <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}" class="w-full border rounded-lg px-3 py-2 text-sm">
    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label class="block text-sm font-medium mb-1">Email</label>
    <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}" class="w-full border rounded-lg px-3 py-2 text-sm">
    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label class="block text-sm font-medium mb-1">Password {{ isset($user) ? '(kosongkan jika tidak diubah)' : '' }}</label>
    <input type="password" name="password" class="w-full border rounded-lg px-3 py-2 text-sm">
    @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label class="block text-sm font-medium mb-1">Role</label>
    <select name="role_id" class="w-full border rounded-lg px-3 py-2 text-sm">
        <option value="">- Pilih Role -</option>
        @foreach($roles as $role)
            <option value="{{ $role->id }}" {{ old('role_id', $user->role_id ?? '') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
        @endforeach
    </select>
    @error('role_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
</div>

<div class="grid grid-cols-2 gap-4 mb-4">
    <div>
        <label class="block text-sm font-medium mb-1">Telepon</label>
        <input type="text" name="phone" value="{{ old('phone', $user->phone ?? '') }}" class="w-full border rounded-lg px-3 py-2 text-sm">
    </div>
    <div class="flex items-end">
        <label class="inline-flex items-center gap-2 text-sm">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $user->is_active ?? true) ? 'checked' : '' }}>
            Aktif
        </label>
    </div>
</div>

<div class="mb-4">
    <label class="block text-sm font-medium mb-1">Alamat</label>
    <textarea name="address" rows="2" class="w-full border rounded-lg px-3 py-2 text-sm">{{ old('address', $user->address ?? '') }}</textarea>
</div>