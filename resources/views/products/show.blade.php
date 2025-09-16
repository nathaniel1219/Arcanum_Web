@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto">
    <img src="{{ asset('images/' . $product->image_url) }}" alt="{{ $product->product_name }}">
    <h1>{{ $product->product_name }}</h1>
    <p>{{ $product->description }}</p>
    <p>Price: {{ $product->price }} LKR</p>
    <form action="{{ route('cart.add', $product->id) }}" method="POST">
        @csrf
        <input type="number" name="quantity" value="1" min="1" class="border p-1 w-16">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add to Cart</button>
    </form>
</div>
@endsection
