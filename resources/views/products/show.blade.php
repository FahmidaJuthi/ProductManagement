@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Product Details</h1>

    <div class="mb-3">
        <strong>Product ID:</strong> {{ $product->product_id }}
    </div>
    <div class="mb-3">
        <strong>Name:</strong> {{ $product->name }}
    </div>
    <div class="mb-3">
        <strong>Description:</strong> {{ $product->description ?? 'No description' }}
    </div>
    <div class="mb-3">
        <strong>Price:</strong> ${{ number_format($product->price, 2) }}
    </div>
    <div class="mb-3">
        <strong>Stock:</strong> {{ $product->stock ?? 'Out of Stock' }}
    </div>
    <div class="mb-3">
        <strong>Image:</strong>
        @if ($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="max-width: 300px;">
        @else
            No Image
        @endif
    </div>

    <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to List</a>
</div>
@endsection
