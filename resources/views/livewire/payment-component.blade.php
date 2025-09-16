<div class="max-w-3xl mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Payment</h1>

    @if ($cartItems->isEmpty())
        <p class="text-gray-600">Your cart is empty.</p>
    @else
        <table class="w-full border border-gray-300 mb-4">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2 text-left">Product</th>
                    <th class="p-2 text-right">Price</th>
                    <th class="p-2 text-right">Quantity</th>
                    <th class="p-2 text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $item)
                    <tr class="border-t border-gray-200">
                        <td class="p-2">{{ $item->product->product_name }}</td>
                        <td class="p-2 text-right">${{ number_format($item->product->price, 2) }}</td>
                        <td class="p-2 text-right">{{ $item->quantity }}</td>
                        <td class="p-2 text-right">${{ number_format($item->product->price * $item->quantity, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="flex justify-between mb-4">
            <span class="font-bold text-lg">Total:</span>
            <span class="font-bold text-lg">${{ number_format($total, 2) }}</span>
        </div>

        <button wire:click="simulatePayment"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Simulate Payment
        </button>

        @if ($paymentStatus)
            <p class="mt-4 text-green-600 font-semibold">{{ $paymentStatus }}</p>
        @endif
    @endif
</div>
