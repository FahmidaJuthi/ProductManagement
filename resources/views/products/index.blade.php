@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Product Management</h1>

    <!-- Search Form -->
    <div class="mb-3">
        <form action="{{ route('products.index') }}" method="GET">
            <input type="text" name="search" placeholder="Search by ID, Name, or Price" value="{{ request('search') }}" class="form-control">
        </form>
    </div>

    <!-- Add Product Button -->
    <div class="mb-3">
        <a href="{{ route('products.create') }}" class="btn btn-success">Add New Product</a>
    </div>

    <!-- Product Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>
                    <a href="{{ route('products.index', ['sort' => 'name', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">Name</a>
                </th>
                <th>Description</th>
                <th>
                    <a href="{{ route('products.index', ['sort' => 'price', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">Price</a>
                </th>
                <th>Stock</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description ?? 'No description' }}</td>
                    <td>{{ number_format($product->price) }}/- tk</td>
                    <td>{{ $product->stock ?? 'Out of Stock' }}</td>
                    <td>
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width: 50px; height: auto;">
                        @else
                            No Image
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary btn-sm">View</a>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No products found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div>
        {{ $products->links() }}
    </div>
</div>
@endsection
