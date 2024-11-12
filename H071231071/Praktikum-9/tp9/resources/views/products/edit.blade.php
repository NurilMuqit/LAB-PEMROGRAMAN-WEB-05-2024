@extends('layouts/master')

@section('title', 'Edit Product')

@section('header-button')
    <div class="flex justify-between items-center mt-4">
        <h2 class="text-xl font-bold">Form Edit Product</h2>
        <a href="{{ url('/products') }}" class="bg-orange-600 hover:bg-orange-500 text-white px-4 py-2 rounded">
            Kembali
        </a>
    </div>
@endsection

@section('content')
    <!-- Form untuk mengedit produk -->
    <section class="bg-white">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900">Edit Produk</h2>
            <form action="{{ url('/products/' . $product->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nama Produk</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                    </div>
                    
                    <div class="sm:col-span-2">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Deskripsi</label>
                        <textarea name="description" id="description" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500" required>{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div class="w-full">
                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900">Harga</label>
                        <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                    </div>

                    <div class="w-full">
                        <label for="stock" class="block mb-2 text-sm font-medium text-gray-900">Stok</label>
                        <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="category_name" class="block mb-2 text-sm font-medium text-gray-900">Kategori</label>
                        <select name="category_name" id="category_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" required>
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                                {{-- <option value="{{ $category->name }}" 
                                    {{ old('category_name', $product->category_name) == $category->name ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option> --}}

                                <option value="{{ $category->name }}" {{ $product->category->name == $category->name ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-orange-600 rounded-lg focus:ring-4 focus:ring-orange-200 hover:bg-orange-500">
                    Simpan Perubahan
                </button>
            </form>
        </div>
    </section>
@endsection
