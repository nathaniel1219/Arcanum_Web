<div class="max-w-7xl mx-auto p-6 grid grid-cols-1 lg:grid-cols-3 gap-8">

    {{-- Left: items list --}}
    <div class="lg:col-span-2">
        <h2 class="text-2xl font-bold mb-4">Your Shopping Cart</h2>

        <div class="flex items-center mb-4">
            <input type="checkbox" id="select-all" wire:model="selectAll" class="mr-2">
            <label for="select-all" class="text-sm text-gray-700">Select All</label>
        </div>

        @if ($items->isEmpty())
            <div class="bg-white p-6 rounded shadow">
                <p class="text-gray-600">Your cart is empty.</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach ($items as $item)
                    <div class="flex justify-between items-center border p-4 rounded shadow-sm bg-white">
                        <div class="flex items-center gap-4">
                            <input type="checkbox" value="{{ $item->id }}" wire:model="selected" class="checkbox-item">
                            <img src="{{ asset('images/products/' . ($item->product->image_url ?? 'placeholder.png')) }}"
                                 alt="{{ $item->product->product_name ?? 'Product' }}"
                                 class="w-20 h-20 object-cover rounded">
                            <div>
                                <p class="font-semibold">{{ $item->product->product_name ?? 'Unknown product' }}</p>
                                <p class="text-sm text-gray-600">LKR {{ number_format(optional($item->product)->price ?? 0, 2) }}</p>
                                <p class="text-xs text-gray-400 mt-1">{{ $item->product->sub_category ?? '' }}</p>
                            </div>
                        </div>

                        <div class="flex flex-col items-end">
                            <div class="flex items-center gap-2">
                                <button type="button" wire:click="decrement({{ $item->id }})"
                                        class="px-3 py-1 bg-gray-100 rounded hover:bg-gray-200">-</button>

                                <input type="number" min="1"
                                       value="{{ $item->quantity }}"
                                       wire:change="updateQuantity({{ $item->id }}, $event.target.value)"
                                       class="w-20 border rounded px-2 py-1 text-center">

                                <button type="button" wire:click="increment({{ $item->id }})"
                                        class="px-3 py-1 bg-gray-100 rounded hover:bg-gray-200">+</button>
                            </div>

                            <p class="text-gray-700 font-semibold mt-2">
                                LKR {{ number_format((optional($item->product)->price ?? 0) * $item->quantity, 2) }}
                            </p>

                            <div class="mt-2">
                                <button type="button" wire:click="removeItem({{ $item->id }})"
                                        class="text-red-500 text-sm hover:underline">Remove</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6 flex justify-between">
                <button type="button" wire:click="removeSelected"
                        class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                    Delete Selected
                </button>

                <button type="button" wire:click="$refresh"
                        class="bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300">
                    Refresh
                </button>
            </div>
        @endif
    </div>

    {{-- Right: order summary --}}
    <aside class="bg-white p-6 rounded shadow h-fit">
        <h3 class="text-xl font-bold mb-4">Order Summary</h3>

        <div class="flex justify-between mb-2">
            <span>Selected total</span>
            <span class="font-semibold">LKR {{ number_format($selectedTotal, 2) }}</span>
        </div>

        <div class="flex justify-between mb-4">
            <span>Cart subtotal</span>
            <span class="text-gray-700 font-semibold">LKR {{ number_format($subtotal, 2) }}</span>
        </div>

        <div class="border-t pt-4 flex justify-between text-lg font-bold">
            <span>Total (selected)</span>
            <span class="text-[#F4B14E]">LKR {{ number_format($selectedTotal, 2) }}</span>
        </div>

        <button type="button"
                wire:click="proceedToCheckout"
                @if($selectedTotal <= 0) disabled @endif
                class="w-full mt-6 bg-[#F4B14E] text-white py-2 rounded hover:bg-yellow-600 disabled:opacity-50">
            Proceed to Checkout
        </button>
    </aside>
</div>
