@extends('layouts.admin')
@section('title', 'Stock Opname')

@section('content')
<div class="bg-white rounded-xl shadow p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="font-semibold">Riwayat Stock Opname</h2>
        <a href="{{ route('stock-opnames.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">+ Opname Baru</a>
    </div>

    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-left text-gray-600">
            <tr><th class="p-3">No. Opname</th><th class="p-3">Tanggal</th><th class="p-3">Dibuat Oleh</th><th class="p-3 text-right">Aksi</th></tr>
        </thead>
        <tbody class="divide-y">
            @forelse($opnames as $opname)
            <tr>
                <td class="p-3 font-medium">{{ $opname->opname_number }}</td>
                <td class="p-3">{{ $opname->opname_date->format('d/m/Y') }}</td>
                <td class="p-3">{{ $opname->user->name }}</td>
                <td class="p-3 text-right"><a href="{{ route('stock-opnames.show', $opname) }}" class="text-blue-600">Detail</a></td>
            </tr>
            @empty
            <tr><td colspan="4" class="p-6 text-center text-gray-400">Belum ada riwayat stock opname.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">{{ $opnames->links() }}</div>
</div>
@endsection