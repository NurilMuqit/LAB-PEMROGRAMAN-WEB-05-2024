@extends('layouts.app')

@section('title', isset($product) ? 'Edit Product' : 'Add Product')

@section('content')
<h1 class="text-2xl font-bold mb-4">{{ isset($product) ? 'Edit Product' : 'Add New Product' }}</h1>

<form action="{{ isset($product) ? route('products.update', $product->id) : route('products.store') }}" method="POST">
    @csrf
    @if(isset($product))
        @method('PUT')
    @endif

    <div class="mb-4">
        <label class="block text-gray-700">Name</label>
        <input type="text" name="name" class="w-full px-4 py-2 border rounded" value="{{ old('name', $product->name ?? '') }}">
    </div>

    <div class="mb-4">
        <label class="block text-gray-700">Category</label>
        <select name="category_id" class="w-full px-4 py-2 border rounded">
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ (old('category_id') == $category->id || (isset($product) && $product->category_id == $category->id)) ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700">Price</label>
        <input type="number" name="price" class="w-full px-4 py-2 border rounded" value="{{ old('price', $product->price ?? '') }}">
    </div>

    <div class="mb-4">
        <label class="block text-gray-700">Stock</label>
        <input type="number" name="stock" class="w-full px-4 py-2 border rounded" value="{{ old('stock', $product->stock ?? '') }}">
    </div>

    <div class="mb-6">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">{{ isset($product) ? 'Update Product' : 'Add Product' }}</button>
    </div>
</form>
@endsection
