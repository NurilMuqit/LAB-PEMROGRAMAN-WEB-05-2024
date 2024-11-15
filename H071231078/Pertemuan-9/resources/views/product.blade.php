@extends('masterLayout')


@section('title', 'Product Management')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Product Management</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-header">
            Add New Product
        </div>
        <div class="card-body">
            <form action="{{ route('createProduct') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description"></textarea>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control" id="price" name="price" required min="0">
                </div>
                <div class="mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" class="form-control" id="stock" name="stock" required min="0">
                </div>
                <div class="mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select class="form-control" id="category_id" name="category_id" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Add Product</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Product List
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @php $index = 1; @endphp
                @foreach($product as $prod)
                <tr>
                    <td>{{ $index++ }}</td>
                    <td>{{ $prod->name }}</td>
                    <td>{{ $prod->description }}</td>
                    <td>{{ $prod->price }}</td>
                    <td>{{ $prod->stock }}</td>
                    <td>{{ $prod->category->name ?? 'No Category' }}</td>
                    <td>
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $prod->id }}">Edit</button>
    
                        <form action="{{ route('deleteProduct', $prod->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this inventory log?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>

                    <div class="modal fade" id="editModal{{ $prod->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Edit Product</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('updateProduct', $prod->id) }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <div class="mb-3">
                                            <label for="name{{ $prod->id }}" class="form-label">Product Name</label>
                                            <input type="text" class="form-control" id="name{{ $prod->id }}" name="name" value="{{ $prod->name }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description{{ $prod->id }}" class="form-label">Description</label>
                                            <textarea class="form-control" id="description{{ $prod->id }}" name="description">{{ $prod->description }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="price{{ $prod->id }}" class="form-label">Price</label>
                                            <input type="number" class="form-control" id="price{{ $prod->id }}" name="price" value="{{ $prod->price }}" required min="0">
                                        </div>
                                        <div class="mb-3">
                                            <label for="stock{{ $prod->id }}" class="form-label">Stock</label>
                                            <input type="number" class="form-control" id="stock{{ $prod->id }}" name="stock" value="{{ $prod->stock }}" required min="0">
                                        </div>
                                        <div class="mb-3">
                                            <label for="category_id{{ $prod->id }}" class="form-label">Category</label>
                                            <select class="form-control" id="category_id{{ $prod->id }}" name="category_id" required>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" @if($prod->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update Product</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="mb-4">
            <form method="GET" action="{{ route('product.index') }}">
                <div class="row">
                    <div class="col-md-4">
                        <select class="form-select" name="category" onchange="this.form.submit()">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @if(request('category') == $category->id) selected @endif>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>
        </div>        
    </div>
</div>
@endsection
