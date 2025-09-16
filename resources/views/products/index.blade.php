{{-- resources/views/products/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- Hero Section --}}
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold mb-2">Discover Rare Collectibles</h1>
        <p class="text-gray-600 text-lg">Explore, buy, and bid on exclusive items from Arcanum Vault</p>
    </div>

    {{-- Product Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ($products as $index => $product)
            <div class="bg-white rounded-xl shadow hover:shadow-lg transition">
                <img src="{{ asset('images/products/' . $product->image_url) }}"
                     alt="{{ $product->product_name }}"
                     class="w-full h-48 object-cover cursor-pointer"
                     onclick="openModal({{ $index }})">

                <div class="p-4">
                    <h2 class="text-xl font-semibold">{{ $product->product_name }}</h2>
                    <p class="text-gray-600 text-sm mt-1">{{ Str::limit($product->description, 60) }}</p>
                    <p class="mt-2 font-semibold text-yellow-500">LKR {{ number_format($product->price, 2) }}</p>
                    <p class="text-sm text-gray-400">{{ $product->sub_category }}</p>

                    <button onclick="openModal({{ $index }})"
                        class="mt-4 w-full text-center bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600 transition">
                        View Details
                    </button>
                </div>
            </div>

            {{-- Modal for this product --}}
            <x-product-modal :product="$product" :index="$index" />
        @endforeach
    </div>
</div>

{{-- Toast for Livewire messages --}}
<div
    x-data="{ show: false, message: '' }"
    x-on:toast.window="message = $event.detail.message; show = true; setTimeout(() => show = false, 3000)"
    x-show="show"
    class="fixed top-5 right-5 bg-yellow-500 text-white px-4 py-2 rounded shadow-lg transition"
    style="display: none;"
>
    <span x-text="message"></span>
</div>
@endsection

@section('scripts')
<script>
    function openModal(index) {
        document.getElementById(`modal-${index}`).classList.remove('hidden');
    }
    function closeModal(index) {
        document.getElementById(`modal-${index}`).classList.add('hidden');
    }
</script>
@endsection
