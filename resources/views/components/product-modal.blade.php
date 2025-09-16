{{-- resources/views/components/product-modal.blade.php --}}
@props(['product', 'index'])

<div id="modal-{{ $index }}" class="hidden fixed inset-0 z-50 flex items-center justify-center px-4 py-6">
    <div class="fixed inset-0 bg-gray-500 opacity-75" onclick="closeModal({{ $index }})"></div>

    <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-6 relative z-10">
        <button onclick="closeModal({{ $index }})" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">&times;</button>

        <img src="{{ asset('images/products/' . $product->image_url) }}" alt="{{ $product->product_name }}" class="w-full h-48 object-cover mb-4 rounded">
        <h2 class="text-xl font-bold mb-2">{{ $product->product_name }}</h2>
        <p class="text-gray-600 mb-2">{{ $product->description }}</p>
        <p class="font-semibold text-yellow-500 mb-4">LKR {{ number_format($product->price, 2) }}</p>

        <button
            wire:click="$emitTo('cart-component', 'addToCart', {{ $product->id }})"
            class="w-full bg-yellow-500 text-white py-2 rounded hover:bg-yellow-600"
        >
            Add to Cart
        </button>
    </div>
</div>
