@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Checkout</h1>

    <form action="{{ route('checkout.place') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @csrf

        <div>
            <h2 class="text-xl font-semibold mb-4">Shipping Information</h2>
            <input type="text" name="name" placeholder="Full Name" value="{{ old('name', auth()->user()->name ?? '') }}" required class="w-full border rounded px-4 py-2 mb-4">
            <input type="text" name="address" placeholder="Address" required class="w-full border rounded px-4 py-2 mb-4">
            <input type="text" name="city" placeholder="City" required class="w-full border rounded px-4 py-2 mb-4">
            <input type="text" name="phone" placeholder="Phone Number" required class="w-full border rounded px-4 py-2 mb-4">
        </div>

        <div>
            <h2 class="text-xl font-semibold mb-4">Payment & Summary</h2>
            <select name="payment_method" class="w-full border rounded px-4 py-2 mb-4" required>
                <option value="">Select Payment Method</option>
                <option value="cod">Cash on Delivery</option>
                <option value="card">Credit/Debit Card</option>
            </select>

            <div class="bg-white p-4 rounded shadow mb-4">
                <h3 class="font-bold text-lg mb-2">Order Summary</h3>

                @foreach ($cartItems as $item)
                    <p class="mb-1">
                        {{ $item->product->product_name ?? 'Product' }} × {{ $item->quantity }}
                        = LKR {{ number_format(($item->product->price ?? 0) * $item->quantity, 2) }}
                    </p>
                @endforeach

                <p class="mb-2">Shipping: Free</p>
                <p class="font-bold text-[#F4B14E]">Total: LKR {{ number_format($subtotal, 2) }}</p>
            </div>

            <input type="hidden" name="total" value="{{ $subtotal }}">
            <button type="submit" class="mt-6 w-full bg-[#F4B14E] text-white py-2 rounded hover:bg-yellow-600 transition">Place Order</button>
        </div>
    </form>
</div>
@endsection
