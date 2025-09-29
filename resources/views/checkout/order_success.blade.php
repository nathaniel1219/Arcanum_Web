@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 text-center">
    <h1 class="text-3xl font-bold mb-4">Order Placed</h1>
    <p class="mb-4">Thank you! Your order was received successfully.</p>

    <a href="{{ route('products.index') }}" class="inline-block mt-4 bg-[#F4B14E] text-white px-4 py-2 rounded">Continue shopping</a>
</div>
@endsection
