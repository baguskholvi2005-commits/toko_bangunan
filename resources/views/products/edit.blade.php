@extends('layouts.admin')
@section('title', 'Edit Produk')

@section('content')
<div class="bg-white rounded-xl shadow p-6 max-w-2xl">
    <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('products._form')
        <button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">Update</button>
    </form>
</div>
@endsection