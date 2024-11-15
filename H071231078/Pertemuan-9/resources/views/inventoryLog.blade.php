@extends('masterLayout')

@section('title', 'Inventory Log')
    

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Inventory Log Management</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-header">
            Add New Inventory Log
        </div>
        <div class="card-body">
            <form action="{{ route('createInventoryLog') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="product_id" class="form-label">Product</label>
                    <select class="form-control" id="product_id" name="product_id" required>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="type" class="form-label">Type</label>
                    <select class="form-control" id="type" name="type" required>
                        <option value="restock">Restock</option>
                        <option value="sold">Sold</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" required min="0">
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" class="form-control" id="date" name="date" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Inventory Log</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Inventory Log List
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Product</th>
                    <th>Type</th>
                    <th>Quantity</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @php $index = 1; @endphp
                @foreach($inventoryLogs as $log)
                    <tr>
                        <td>{{ $index++ }}</td>
                        <td>{{ $log->product->name }}</td>
                        <td>{{ $log->type }}</td>
                        <td>{{ $log->quantity }}</td>
                        <td>{{ $log->date }}</td>
                        <td>

                            <form action="{{ route('deleteInventoryLog', $log->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this inventory log?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>

                    <div class="modal fade" id="editModal{{ $log->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Edit Inventory Log</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection