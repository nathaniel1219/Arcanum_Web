<div>
    <h2 class="text-2xl font-bold mb-4">Your Cart</h2>

    <form wire:submit.prevent="updateQuantities">
        @if($items->isEmpty())
            <p class="text-gray-600">Your cart is empty.</p>
        @else
            <div class="space-y-4">
                @foreach($items as $item)
                    <div class="flex justify-between items-center border p-4 rounded shadow-sm bg-white">
                        <div class="flex items-center gap-4">
                            <input type="checkbox" wire:model="selected" value="{{ $item->id }}">
                            <img src="{{ asset('images/products/' . $item->product->image_url) }}" class="w-16 h-16 object-cover rounded">
                            <div>
                                <p class="font-semibold">{{ $item->product->product_name }}</p>
                                <p class="text-sm text-gray-600">LKR {{ number_format($item->product->price, 2) }}</p>
                            </div>
                        </div>
                        <div class="flex flex-col items-end">
                            <input type="number" wire:model="quantities.{{ $item->id }}" min="1"
                                class="w-20 border rounded px-2 py-1 text-center mb-2">
                            <p class="text-gray-700 font-semibold">LKR {{ number_format(($item->product->price ?? 0) * $item->quantity, 2) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6 flex justify-between">
                <button type="button" wire:click="deleteSelected" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Delete Selected</button>
                <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Update Quantities</button>
            </div>
        @endif
    </form>

    @if(!$items->isEmpty())
        <aside class="bg-white p-6 rounded shadow h-fit mt-6 lg:mt-0">
            <h3 class="text-xl font-bold mb-4">Order Summary</h3>
            @php
                $subtotal = $items->sum(fn($i) => ($i->product->price ?? 0) * $i->quantity);
            @endphp
            <div class="flex justify-between mb-2">
                <span>Subtotal</span>
                <span class="font-semibold">LKR {{ number_format($subtotal, 2) }}</span>
            </div>
            <div class="flex justify-between mb-4">
                <span>Shipping</span>
                <span class="text-gray-500">Free</span>
            </div>
            <div class="border-t pt-4 flex justify-between text-lg font-bold">
                <span>Total</span>
                <span class="text-yellow-500">LKR {{ number_format($subtotal, 2) }}</span>
            </div>
            <a href="{{ route('payment') }}" class="block mt-6 bg-yellow-500 text-white text-center py-2 rounded hover:bg-yellow-600">Proceed to Checkout</a>
        </aside>
    @endif
</div>
