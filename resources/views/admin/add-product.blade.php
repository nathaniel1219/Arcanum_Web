<h1>Add Product</h1>

<form action="{{ route('admin.products.store') }}" method="POST">
    @csrf
    <input type="text" name="product_name" placeholder="Name" required>
    <input type="text" name="description" placeholder="Description">
    <input type="number" name="price" placeholder="Price" required>
    <input type="text" name="category" placeholder="Category" required>
    <input type="text" name="sub_category" placeholder="Sub-category">
    <button type="submit">Add Product</button>
</form>
