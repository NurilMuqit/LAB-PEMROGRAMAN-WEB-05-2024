<!-- resources/views/categories/index.blade.php -->
@extends('layouts.master')

@section('title', 'Categories')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Category List</h1>
    <a href="{{ route('categories.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add New Category</a>
</div>

<table class="min-w-full bg-white border">
    <thead class="bg-gray-100">
        <tr>
            <th class="py-3 px-6 text-left">ID</th>
            <th class="py-3 px-6 text-left">Name</th>
            <th class="py-3 px-6 text-left">Description</th>
            <th class="py-3 px-6 text-left">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category)
        <tr class="border-b hover:bg-gray-100">
            <td class="py-3 px-6">{{ $category->id }}</td>
            <td class="py-3 px-6">{{ $category->name }}</td>
            <td class="py-3 px-6">{{ $category->description }}</td>
            <td class="py-3 px-6 flex space-x-2">
                <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
