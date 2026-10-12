@extends('layouts.admin')
@section('title', 'Pengguna')

@section('content')
<div class="bg-white rounded-xl shadow p-6">
    <div class="flex justify-between items-center mb-4">
        <form method="GET" class="flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pengguna..."
                   class="border rounded-lg px-3 py-2 text-sm w-64">
            <button class="bg-gray-800 text-white px-4 py-2 rounded-lg text-sm">Cari</button>
        </form>
        <a href="{{ route('users.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">+ Tambah Pengguna</a>
    </div>

    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-left text-gray-600">
            <tr>
                <th class="p-3">Nama</th>
                <th class="p-3">Email</th>
                <th class="p-3">Role</th>
                <th class="p-3">Telepon</th>
                <th class="p-3">Status</th>
                <th class="p-3 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse($users as $user)
            <tr>
                <td class="p-3 font-medium">{{ $user->name }}</td>
                <td class="p-3 text-gray-500">{{ $user->email }}</td>
                <td class="p-3">
                    <span class="px-2 py-0.5 rounded-full text-xs bg-blue-100 text-blue-700">
                        {{ $user->role?->name ?? '-' }}
                    </span>
                </td>
                <td class="p-3 text-gray-500">{{ $user->phone ?? '-' }}</td>
                <td class="p-3">
                    @if($user->is_active)
                        <span class="px-2 py-0.5 rounded-full text-xs bg-green-100 text-green-700">Aktif</span>
                    @else
                        <span class="px-2 py-0.5 rounded-full text-xs bg-gray-100 text-gray-600">Nonaktif</span>
                    @endif
                </td>
                <td class="p-3 text-right space-x-2">
                    <a href="{{ route('users.edit', $user) }}" class="text-blue-600">Edit</a>
                    @if($user->id !== auth()->id())
                    <form method="POST" action="{{ route('users.destroy', $user) }}" class="inline"
                          onsubmit="return confirm('Hapus pengguna ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600">Hapus</button>
                    </form>
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="p-6 text-center text-gray-400">Belum ada pengguna.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">{{ $users->links() }}</div>
</div>
@endsection