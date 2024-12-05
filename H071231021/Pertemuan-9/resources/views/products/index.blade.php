@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Product List</h1>
    <a href="{{ route('products.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add New Product</a>
</div>

<table class="min-w-full bg-white rounded-lg shadow overflow-hidden">
    <thead>
        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
            <th class="py-3 px-6 text-left">ID</th>
            <th class="py-3 px-6 text-left">Name</th>
            <th class="py-3 px-6 text-left">Category</th>
            <th class="py-3 px-6 text-left">Price</th>
            <th class="py-3 px-6 text-left">Stock</th>
            <th class="py-3 px-6 text-center">Actions</th>
        </tr>
    </thead>
    <tbody class="text-gray-600 text-sm font-light">
        @foreach($products as $product)
        <tr class="border-b border-gray-200 hover:bg-gray-100">
            <td class="py-3 px-6 text-left">{{ $product->id }}</td>
            <td class="py-3 px-6 text-left">{{ $product->name }}</td>
            <td class="py-3 px-6 text-left">{{ $product->category->name }}</td>
            <td class="py-3 px-6 text-left">{{ $product->price }}</td>
            <td class="py-3 px-6 text-left">{{ $product->stock }}</td>
            <td class="py-3 px-6 text-center">
                <a href="{{ route('products.edit', $product->id) }}" class="text-blue-500">Edit</a>
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
