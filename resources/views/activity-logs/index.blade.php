@extends('layouts.admin')
@section('title', 'Log Aktivitas')

@section('content')
<div class="bg-white rounded-xl shadow p-6 mb-4">
    <form method="GET" class="flex gap-2">
        <select name="user_id"
                class="border rounded-lg pl-3 pr-9 py-2 text-sm appearance-none bg-no-repeat"
                style="background-image: url('data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2216%22 height=%2216%22 viewBox=%220 0 24 24%22 fill=%22none%22 stroke=%22%236b7280%22 stroke-width=%222%22><polyline points=%226 9 12 15 18 9%22/></svg>'); background-position: right 10px center; background-size: 16px;">
            <option value="">Semua Pengguna</option>
            @foreach($users as $u)
                <option value="{{ $u->id }}" {{ request('user_id') == $u->id ? 'selected' : '' }}>{{ $u->name }}</option>
            @endforeach
        </select>
        <select name="action"
                class="border rounded-lg pl-3 pr-9 py-2 text-sm appearance-none bg-no-repeat"
                style="background-image: url('data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2216%22 height=%2216%22 viewBox=%220 0 24 24%22 fill=%22none%22 stroke=%22%236b7280%22 stroke-width=%222%22><polyline points=%226 9 12 15 18 9%22/></svg>'); background-position: right 10px center; background-size: 16px;">
            <option value="">Semua Aksi</option>
            <option value="created" {{ request('action') == 'created' ? 'selected' : '' }}>Dibuat</option>
            <option value="updated" {{ request('action') == 'updated' ? 'selected' : '' }}>Diperbarui</option>
            <option value="deleted" {{ request('action') == 'deleted' ? 'selected' : '' }}>Dihapus</option>
        </select>
        <button class="bg-gray-800 text-white px-4 py-2 rounded-lg text-sm">Filter</button>
    </form>
</div>

<div class="bg-white rounded-xl shadow p-6">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-left">
            <tr><th class="p-2">Waktu</th><th class="p-2">Pengguna</th><th class="p-2">Aksi</th><th class="p-2">Keterangan</th></tr>
        </thead>
        <tbody class="divide-y">
            @forelse($logs as $log)
            <tr>
                <td class="p-2 text-gray-500">{{ $log->created_at->format('d/m/Y H:i') }}</td>
                <td class="p-2">{{ $log->user->name ?? 'Sistem' }}</td>
                <td class="p-2">
                    <span class="px-2 py-0.5 rounded-full text-xs
                        {{ $log->action === 'created' ? 'bg-green-100 text-green-700' :
                           ($log->action === 'deleted' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                        {{ ucfirst($log->action) }}
                    </span>
                </td>
                <td class="p-2">{{ $log->description }}</td>
            </tr>
            @empty
            <tr><td colspan="4" class="p-6 text-center text-gray-400">Belum ada aktivitas tercatat.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-4">{{ $logs->links() }}</div>
</div>
@endsection