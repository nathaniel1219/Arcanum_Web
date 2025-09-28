{{-- resources/views/products/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- Hero Section --}}
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold mb-2">Discover Rare Pokemon</h1>
        <p class="text-gray-600 text-lg">Explore, and buy on exclusive items from Arcanum</p>
    </div>

    {{-- Product Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ($products as $index => $product)
            <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition overflow-hidden">
                <img src="{{ asset('images/products/' . $product->image_url) }}" 
                     alt="{{ $product->product_name }}" 
                     class="w-full h-48 object-cover cursor-pointer" 
                     onclick="openModal({{ $index }})">

                <div class="p-4">
                    <h2 class="text-xl font-semibold">{{ $product->product_name }}</h2>
                    <p class="text-gray-600 text-sm mt-1">{{ Str::limit($product->description, 60) }}</p>
                    <p class="mt-2 font-semibold text-yellow-500">LKR {{ number_format($product->price, 2) }}</p>
                    <p class="text-sm text-gray-400">{{ $product->sub_category }}</p>

                    {{-- View Details button --}}
                    <button onclick="openModal({{ $index }})"
                        class="mt-4 w-full bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600 transition">
                        View Details
                    </button>
                </div>
            </div>

            {{-- Include modal component --}}
            <x-product-modal :product="$product" :index="$index" />
        @endforeach
    </div>
</div>

{{-- Optional Toast --}}
<div id="toast" class="fixed bottom-6 right-6 bg-green-500 text-white py-3 px-4 rounded shadow-lg hidden z-50 transition-opacity"></div>
@endsection

<script>
function openModal(index) {
    const modal = document.getElementById(`modal-${index}`);
    if (modal) modal.classList.remove('hidden');
}

function closeModal(index) {
    const modal = document.getElementById(`modal-${index}`);
    if (modal) modal.classList.add('hidden');
}

function showToast(message) {
    const toast = document.getElementById('toast');
    toast.textContent = message;
    toast.classList.remove('hidden');
    setTimeout(() => toast.classList.add('hidden'), 3000);
}
</script>



