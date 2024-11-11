@extends('masterLayout')

@section('title', 'Category Management')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Category Management</h2>

    <!-- Tampilkan alert jika ada session 'success' -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-header">
            Add New Category
        </div>
        <div class="card-body">
            <form action="{{ route('createCategory') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Category Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Add Category</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Category List
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @php $index = 1; @endphp
                @foreach($category as $cat)
                    <tr>
                        <td>{{ $index++ }}</td>
                        <td>{{ $cat->name }}</td>
                        <td>{{ $cat->description }}</td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $cat->id }}">Edit</button>
                            <form action="{{ route('deleteCategory', $cat->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{ $cat->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Edit Category</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('updateCategory', $cat->id) }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="name{{ $cat->id }}" class="form-label">Category Name</label>
                                            <input type="text" class="form-control" id="name{{ $cat->id }}" name="name" value="{{ $cat->name }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description{{ $cat->id }}" class="form-label">Description</label>
                                            <textarea class="form-control" id="description{{ $cat->id }}" name="description">{{ $cat->description }}</textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update Category</button>
                                    </form>
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
