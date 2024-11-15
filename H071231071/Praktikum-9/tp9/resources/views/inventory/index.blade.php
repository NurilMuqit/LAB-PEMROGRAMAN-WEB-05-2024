@extends('layouts/master')

@section('title', 'Inventory Logs')

@section('desc', 'Manage all your existing logs')
    
@section('header-button')
    <div class="flex justify-between items-center mt-4">
        <h2 class="text-xl font-bold"></h2>
        <a href="{{url('inventoryLogs/create')}}" class="bg-[#ea501f] hover:bg-orange-500 text-white px-4 py-2 rounded">
            Add Inventory Logs
        </a>
    </div>
@endsection

@section('content')
<div class="ml-5 mr-5 relative overflow-x-auto shadow-md sm:rounded-lg mt-6">
    <table class="w-full text-sm text-left rtl:text-right text-slate-100">
        <thead class="text-xs text-black uppercase bg-gray-300">
            <tr>
                <th scope="col" class="px-6 py-3">
                    No.
                </th>
                <th scope="col" class="px-6 py-3">
                    Product Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Type
                </th>
                <th scope="col" class="px-6 py-3">
                    Quantity
                </th>
                <th scope="col" class="px-6 py-3">
                    Date
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp

        @foreach ($inventoryLogs as $inventoryLog)
        <tr class="bg-gray-100 text-black">
            <th scope="row" class="px-6 py-4 font-medium text-black whitespace-nowrap">
                {{ $loop->iteration }}
            </th>
            <td class="px-6 py-4">
                {{-- Menampilkan nama produk --}}
                {{ $inventoryLog->product->name ?? 'Product Not Found' }}
            </td>
            <td class="px-6 py-4">
                {{ $inventoryLog->type }}
            </td>
            <td class="px-6 py-4">
                {{ $inventoryLog->quantity }}
            </td>
            <td class="px-6 py-4">
                {{ $inventoryLog->updated_at }}
            </td>
            <td class="px-6 py-4">
                <form method="POST" action="{{ url("/inventoryLogs/{$inventoryLog->id}") }}"
                    onsubmit="return confirm('Are you sure you want to delete this data?')" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="font-medium text-red-600 hover:underline">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
        @endforeach


        </tbody>
    </table>
</div>
@endsection
