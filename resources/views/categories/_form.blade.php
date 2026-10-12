<div class="mb-4">
    <label class="block text-sm font-medium mb-1">Nama Kategori</label>
    <input type="text" name="name" value="{{ old('name', $category->name ?? '') }}"
           class="w-full border rounded-lg px-3 py-2 text-sm">
    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label class="block text-sm font-medium mb-1">Deskripsi</label>
    <textarea name="description" rows="3"
              class="w-full border rounded-lg px-3 py-2 text-sm">{{ old('description', $category->description ?? '') }}</textarea>
    @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
</div>