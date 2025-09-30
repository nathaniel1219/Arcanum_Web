@extends('layouts.app')

@section('content')
<div class="bg-gray-100 min-h-screen p-6">
  <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Add Product</h1>

    @if ($errors->any())
      <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
        <ul class="list-disc pl-5">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="mb-4">
        <label class="block font-semibold mb-1">Product Name</label>
        <input type="text" name="product_name" value="{{ old('product_name') }}" required class="w-full border rounded px-3 py-2">
      </div>

      <div class="mb-4">
        <label class="block font-semibold mb-1">Description</label>
        <textarea name="description" class="w-full border rounded px-3 py-2" rows="3">{{ old('description') }}</textarea>
      </div>

      <div class="mb-4">
        <label class="block font-semibold mb-1">Price</label>
        <input type="number" step="0.01" name="price" value="{{ old('price') }}" class="w-full border rounded px-3 py-2">
      </div>

      <div class="mb-4 grid grid-cols-2 gap-4">
        <div>
          <label class="block font-semibold mb-1">Category</label>
          <select name="category" required class="w-full border rounded px-3 py-2">
            <option value="">Select</option>
            @foreach($categories as $c)
              <option value="{{ $c }}" {{ old('category') == $c ? 'selected' : '' }}>{{ $c }}</option>
            @endforeach
          </select>
        </div>

        <div>
          <label class="block font-semibold mb-1">Sub Category</label>
          <select name="sub_category" class="w-full border rounded px-3 py-2">
            <option value="">Select</option>
            @foreach($subCategories as $s)
              <option value="{{ $s }}" {{ old('sub_category') == $s ? 'selected' : '' }}>{{ $s }}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="mb-4">
        <label class="block font-semibold mb-1">Image (png, jpg, jpeg)</label>
        <input type="file" name="image" accept=".png,.jpg,.jpeg" class="w-full">
        <p class="text-sm text-gray-500 mt-1">Optional. Max 2MB.</p>
      </div>

      <div class="mb-4">
        <label class="block font-semibold mb-1">Details</label>
        <textarea name="details" class="w-full border rounded px-3 py-2" rows="4">{{ old('details') }}</textarea>
      </div>

      <div class="flex gap-3">
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Create Product</button>
        <a href="{{ route('admin.users') }}" class="px-4 py-2 rounded border">Cancel</a>
      </div>
    </form>
  </div>
</div>
@endsection
