@extends('layouts.admin')
@section('title', 'Backup & Restore Database')

@section('content')
<div class="bg-white rounded-xl shadow p-6 mb-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="font-semibold">Backup Database</h2>
        <form method="POST" action="{{ route('backups.create') }}">
            @csrf
            <button class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">+ Buat Backup Baru</button>
        </form>
    </div>

    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-left">
            <tr><th class="p-2">Nama File</th><th class="p-2">Ukuran</th><th class="p-2">Tanggal</th><th class="p-2 text-right">Aksi</th></tr>
        </thead>
        <tbody class="divide-y">
            @forelse($files as $file)
            <tr>
                <td class="p-2">{{ $file['name'] }}</td>
                <td class="p-2">{{ $file['size'] }}</td>
                <td class="p-2">{{ $file['date'] }}</td>
                <!-- INI BAGIAN YANG DIGANTI -->
                <td class="p-2 text-right space-x-2">
                    <a href="{{ route('backups.download', $file['name']) }}" class="text-blue-600">Download</a>
                    <form method="POST" action="{{ route('backups.destroy', $file['name']) }}" class="inline"
                          onsubmit="return confirm('Hapus file backup ini? Tindakan ini tidak bisa dibatalkan.')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600">Hapus</button>
                    </form>
                </td>
                <!-- SAMPAI SINI -->
            </tr>
            @empty
            <tr><td colspan="4" class="p-6 text-center text-gray-400">Belum ada backup.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="bg-white rounded-xl shadow p-6">
    <h2 class="font-semibold mb-4">Restore Database</h2>
    <p class="text-sm text-red-600 mb-4">⚠️ Perhatian: Restore akan MENIMPA seluruh data yang ada saat ini dengan isi file backup yang diupload. Pastikan Anda yakin sebelum melanjutkan.</p>

    <form method="POST" action="{{ route('backups.restore') }}" enctype="multipart/form-data"
          onsubmit="return confirm('Yakin ingin restore? Semua data saat ini akan tertimpa dan tidak bisa dibatalkan.')">
        @csrf
        <input type="file" name="backup_file" accept=".sql" class="border rounded-lg px-3 py-2 text-sm mb-4">
        <button class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm">Restore dari File</button>
        @error('backup_file') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
    </form>
</div>
@endsection