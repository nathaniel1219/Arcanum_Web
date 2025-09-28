<div class="mt-2">
    <div class="flex items-center gap-3 mb-4">
        <label class="font-semibold">Quantity:</label>
        <input
            type="number"
            min="1"
            wire:model.defer="quantity"
            class="w-20 border rounded px-2 py-1 text-center"
            aria-label="Quantity"
        >
    </div>

    <div>
        <button
            wire:click="addToCart"
            wire:loading.attr="disabled"
            class="mt-4 w-full bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition"
        >
            Add to Cart
        </button>
    </div>
</div>
