@extends('layouts.admin')
@section('title', 'Edit Supplier')

@section('content')
<div class="bg-white rounded-xl shadow p-6 max-w-lg">
    <form method="POST" action="{{ route('suppliers.update', $supplier) }}">
        @csrf @method('PUT')
        @include('suppliers._form')

        <div class="flex gap-3 mt-6">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-5 py-2.5 rounded-lg text-sm shadow-sm transition">
                Update
            </button>
            <a href="{{ route('suppliers.index') }}"
               class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium px-5 py-2.5 rounded-lg text-sm transition">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection