@extends('layouts.app')

@section('title', 'Inventory Logs')

@section('content')
<h1 class="text-2xl font-bold mb-4">Inventory Logs</h1>

<table class="min-w-full bg-white rounded-lg shadow overflow-hidden">
    <thead>
        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
            <th class="py-3 px-6 text-left">ID</th>
            <th class="py-3 px-6 text-left">Product</th>
            <th class="py-3 px-6 text-left">Type</th>
            <th class="py-3 px-6 text-left">Quantity</th>
            <th class="py-3 px-6 text-left">Date</th>
        </tr>
    </thead>
    <tbody class="text-gray-600 text-sm font-light">
        @foreach($inventoryLogs as $log)
        <tr class="border-b border-gray-200 hover:bg-gray-100">
            <td class="py-3 px-6 text-left">{{ $log->id }}</td>
            <td class="py-3 px-6 text-left">{{ $log->product->name }}</td>
            <td class="py-3 px-6 text-left">{{ $log->type }}</td>
            <td class="py-3 px-6 text-left">{{ $log->quantity }}</td>
            <td class="py-3 px-6 text-left">{{ $log->created_at->format('Y-m-d') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
