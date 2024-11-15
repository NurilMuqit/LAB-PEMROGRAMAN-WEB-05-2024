@extends('layouts/master')

@section('title', 'List of Products')

@section('header-button')
<div class="flex flex-wrap justify-center gap-4">
    <!-- Card pertama untuk total kategori -->
    <a href="{{ url('/categories') }}" class="block max-w-md p-5 bg-white border border-white rounded-lg shadow hover:bg-gray-100">
      <h5 class="mb-2 text-2xl font-bold tracking-tight text-orange-600">Total Categories</h5>
      <p class="font-normal text-gray-700 dark:text-gray-600">Total number of categories: {{ $totalCategories }}</p>
    </a>
    
    <!-- Card kedua untuk total produk -->
    <a href="#" class="block max-w-md p-6 bg-white border border-white rounded-lg shadow hover:bg-gray-100">
      <h5 class="mb-2 text-2xl font-bold tracking-tight text-orange-600">Total Products</h5>
      <p class="font-normal text-gray-700 dark:text-gray-600">Total number of products: {{ $totalProducts }}</p>
    </a>
</div>

<div class="flex justify-between items-center mt-4">
    <!-- Dropdown Kategori dengan automatic filter -->
    <form method="GET" action="{{ url('products') }}" class="flex items-center">
        <select name="category" id="category" class="px-4 py-2 rounded mr-4 border-2 border-orange-500" onchange="this.form.submit()">
            <option value="">All Category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </form>

    <!-- Tombol Add Product -->
    <a href="{{ url('products/create') }}" class="bg-orange-600 hover:bg-orange-500 text-white px-4 py-2 rounded">
        Add Product
    </a>
</div>
@endsection

@section('content')
    <table class="w-full table-auto border-collapse border border-gray-300 mt-4">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-4 py-2 text-start">No</th>
                <th class="border px-4 py-2 text-start">Product's Name</th>
                <th class="border px-4 py-2 text-start">Description</th>
                <th class="border px-4 py-2 text-start">Price</th>
                <th class="border px-4 py-2 text-start">Stock</th>
                <th class="border px-4 py-2 text-start">Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp

            @foreach ($products as $product)
                <tr class="odd:bg-white even:bg-gray-100">
                    <td class="border px-4 py-2">{{ $i++ }}</td>
                    <td class="border px-4 py-2">{{ $product->name }}</td>
                    <td class="border px-4 py-2">{{ $product->description }}</td>
                    <td class="border px-4 py-2">{{ $product->price }}</td>
                    <td class="border px-4 py-2">{{ $product->stock }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ url("products/$product->id/edit") }}" class="text-gray-900 bg-gray-250 hover:bg-gray-200 border border-gray-500 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">
                            Edit
                        </a>
                        <form method="POST" action="{{ url("products/$product->id") }}" onsubmit="return confirm('Apakah kamu yakin ingin menghapus data?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
