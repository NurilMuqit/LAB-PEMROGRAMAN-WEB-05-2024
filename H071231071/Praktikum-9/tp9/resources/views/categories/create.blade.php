@extends('layouts/master')

@section('title', 'Add Category')

@section('header-button')
    <div class="flex justify-between items-center mt-4">
        <h2 class="text-xl font-bold"></h2>
        <a href="{{ url('/categories') }}" class="bg-orange-600 hover:bg-orange-500 text-white px-4 py-2 rounded">
            Kembali
        </a>
    </div>
@endsection

@section('content')
<form action="{{ url('/categories') }}" method="POST" class="max-w-md mx-auto space-y-6">
    @csrf

    <div class="relative z-0 w-full mb-5 group">
        <input type="text" id="name" name="name" value="{{ old('name') }}"
               class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
               placeholder=" " required />
        <label for="name" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] left-0 peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
            Nama Kategori
        </label>
    </div>

    <div class="relative z-0 w-full mb-5 group">
        <input type="text" id="description" name="description" value="{{ old('description') }}"
               class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
               placeholder=" " required />
        <label for="description" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] left-0 peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
            Deskripsi
        </label>
    </div>

    <button type="submit"
            class="text-white bg-orange-600 hover:bg-orange-500 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center">
        Simpan
    </button>
</form>
@endsection
