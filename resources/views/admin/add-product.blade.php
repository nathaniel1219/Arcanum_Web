{{-- resources/views/admin/add-product.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="bg-gray-100 min-h-screen p-6 flex flex-col">
        <h1 class="text-3xl font-bold mb-6">Admin Dashboard - Create Product</h1>

        <a href="{{ route('dashboard') }}" class="text-[#F4B14E] hover:underline mb-6 inline-block">← Back to Shop</a>

        @php
            $selectedProduct = $products->firstWhere('id', request('selected'));
        @endphp

        <div class="mb-4 flex gap-2">
            <button
                @if(!$selectedProduct) disabled @endif
                onclick="if(confirm('Delete this product?')) { document.getElementById('delete-form').submit(); }"
                class="px-4 py-2 rounded text-white font-semibold {{ $selectedProduct ? 'bg-red-500 hover:bg-red-600' : 'bg-red-200 cursor-not-allowed' }}">
                Delete Product
            </button>

            <form id="delete-form" action="{{ $selectedProduct ? route('admin.products.delete', $selectedProduct->id) : '#' }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        </div>

        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded max-w-7xl">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex gap-8 max-w-7xl flex-1">
            {{-- Sidebar with products --}}
            <aside class="w-64 bg-white p-4 rounded shadow h-[600px] overflow-y-auto">
                <h2 class="font-semibold text-lg mb-4 border-b pb-2">Products</h2>
                <ul>
                    @foreach ($products as $product)
                        <li class="mb-2">
                            <a href="{{ route('admin.products.create', ['selected' => $product->id]) }}"
                                class="block px-2 py-1 rounded hover:bg-yellow-100 {{ request('selected') == $product->id ? 'bg-yellow-200 font-semibold' : '' }}">
                                {{ $product->product_name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </aside>

            {{-- Create product form --}}
            <main class="flex-1 bg-white p-6 rounded shadow max-h-[600px] overflow-y-auto">
                <h2 class="text-xl font-semibold mb-4 border-b pb-2">Add New Product</h2>

                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-4">
                    @csrf
                    <div>
                        <label class="block font-medium">Product Name</label>
                        <input type="text" name="product_name" class="w-full border rounded px-3 py-2" required>
                    </div>
                    <div>
                        <label class="block font-medium">Description</label>
                        <textarea name="description" class="w-full border rounded px-3 py-2"></textarea>
                    </div>
                    <div>
                        <label class="block font-medium">Price</label>
                        <input type="number" step="0.01" name="price" class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="block font-medium">Category</label>
                        <select name="category" class="w-full border rounded px-3 py-2" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category }}">{{ $category }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block font-medium">Sub Category</label>
                        <select name="sub_category" class="w-full border rounded px-3 py-2">
                            @foreach ($subCategories as $sub)
                                <option value="{{ $sub }}">{{ $sub }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block font-medium">Image</label>
                        <input type="file" name="image" class="w-full">
                    </div>
                    <div>
                        <label class="block font-medium">Details</label>
                        <textarea name="details" class="w-full border rounded px-3 py-2"></textarea>
                    </div>
                    <div>
                        <button type="submit" class="bg-[#F4B14E] text-white px-4 py-2 rounded hover:bg-yellow-600">
                            Create Product
                        </button>
                    </div>
                </form>
            </main>
        </div>
    </div>
@endsection
