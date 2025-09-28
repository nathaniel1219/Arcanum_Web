{{-- resources/views/products/product-modal.blade.php --}}
<div id="modal-{{ $index }}" class="hidden fixed inset-0 z-50 flex items-center justify-center px-4 py-6">

    <!-- Backdrop -->
    <div class="fixed inset-0 bg-gray-800 bg-opacity-75" onclick="closeModal({{ $index }})"></div>

    <!-- Modal Card -->
    <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full p-6 relative z-10 overflow-y-auto max-h-[90vh]">

        <!-- Close button -->
        <button onclick="closeModal({{ $index }})"
            class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-2xl font-bold">&times;
        </button>

        <!-- Side by Side Layout -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Product Image -->
            <div class="flex justify-center items-start">
                <img src="{{ asset('images/products/' . $product->image_url) }}" alt="{{ $product->product_name }}"
                    class="max-h-96 w-auto object-contain rounded shadow">
            </div>

            <!-- Product Details -->
            <div>
                <h2 class="text-2xl font-bold mb-3">{{ $product->product_name }}</h2>

                <p class="text-gray-700 mb-4">{{ $product->details }}</p>

                <p class="font-semibold text-yellow-500 mb-2">
                    LKR {{ number_format($product->price, 2) }}
                </p>
                <p class="text-sm text-gray-400 mb-6">{{ $product->sub_category }}</p>

                {{-- Add-to-cart Livewire component (replaces raw button + input) --}}
                <livewire:add-to-cart-button :product-id="$product->id" :index="$index" />

                {{-- Close-modal listener so Livewire can close the modal when it dispatches closeModal --}}
                <script>
                    window.addEventListener('closeModal', (e) => {
                        if (e.detail?.index === {{ $index }}) {
                            closeModal({{ $index }});
                        }
                    });
                </script>



            </div>
        </div>
    </div>
</div>
