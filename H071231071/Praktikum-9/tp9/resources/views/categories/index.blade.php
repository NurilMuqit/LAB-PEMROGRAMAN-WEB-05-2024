@extends('layouts/master')

@section('title', 'List of Categories')

@section('header-button')
    <div class="flex justify-between items-center mt-4">
        <h2 class="text-xl font-bold"></h2>
        <a href="{{url('categories/create')}}" class="bg-[#ea501f] hover:bg-orange-500 text-white px-4 py-2 rounded">
            Add Category
        </a>
    </div>
@endsection

@section('content')
    <table class="w-full table-auto border-collapse border border-gray-300 mt-4">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-4 py-2 text-start">Num</th>
                <th class="border px-4 py-2 text-start">Name</th>
                <th class="border px-4 py-2 text-start">Description</th>
                <th class="border px-4 py-2 text-start">Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp

            @foreach ($categories as $category)
                <tr class="odd:bg-white even:bg-gray-100">
                    <td class="border px-4 py-2"><?= $i++ ?></td>

                    <td class="border px-4 py-2"><?= $category->name ?></td>
                    <td class="border px-4 py-2"><?= $category->description ?></td>
                    <td class="border px-4 py-2">
                        <a href="{{url("categories/$category->id/edit")}}" class="text-gray-900 bg-gray-250 hover:bg-gray-200 border border-gray-500 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">
                            Edit
                        </a>
                        <form method="POST" action="{{url("categories/$category->id")}}"
                            onsubmit="return confirm('Apakah kamu yakin ingin menghapus data?')" class="inline">
                            {{-- @... --}}
                            @csrf
                            @method('DELETE')
                            {{-- @... --}}
                            <button type="submit" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
                                Delete</button>
                           
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection