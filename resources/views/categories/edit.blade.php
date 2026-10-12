@extends('layouts.admin')
@section('title', 'Edit Kategori')

@section('content')
<div class="bg-white rounded-xl shadow p-6 max-w-lg">
    <form method="POST" action="{{ route('categories.update', $category) }}">
        @csrf @method('PUT')
        @include('categories._form')
        <button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">Update</button>
    </form>
</div>
@endsection