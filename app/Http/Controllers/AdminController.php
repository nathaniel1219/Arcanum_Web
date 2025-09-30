<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public function __construct()
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }
    }

    // Show users with orders
    public function showUsers()
    {
        $users = User::with('orders')->get();
        return view('admin.users', compact('users'));
    }

    // Update order status
    public function updateOrder(Request $request, $id)
    {
        $request->validate([
            'order_status' => 'required|string'
        ]);

        $order = Order::findOrFail($id);
        $order->order_status = $request->order_status;
        $order->save();

        return redirect()->back()->with('success', 'Order status updated.');
    }

    // Show form to add product
    public function addProduct()
    {
        $categories = ['TCG', 'Figures'];
        $subCategories = ['pokemon', 'Yu-Gi-Oh', 'Funko Pop'];
        $products = Product::all();
        return view('admin.add-product', compact('categories', 'subCategories', 'products'));
    }

    // Store product
    public function storeProduct(Request $request)
    {
        $request->validate([
            'product_name' => ['required', 'string', 'max:100'],
            'description'  => ['nullable', 'string'],
            'price'        => ['nullable', 'numeric'],
            'category'     => ['required', Rule::in(['TCG','Figures'])],
            'sub_category' => ['nullable', Rule::in(['pokemon','Yu-Gi-Oh','Funko Pop'])],
            'details'      => ['nullable', 'string'],
            'image'        => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        $imageFilename = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $safeName = Str::slug(substr($request->input('product_name'), 0, 40));
            $imageFilename = time() . '_' . ($safeName ?: 'product') . '_' . uniqid() . '.' . $ext;
            $destination = public_path('images/products');

            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            $file->move($destination, $imageFilename);
        }

        Product::create([
            'product_name' => $request->input('product_name'),
            'description'  => $request->input('description'),
            'price'        => $request->input('price'),
            'category'     => $request->input('category'),
            'sub_category' => $request->input('sub_category'),
            'image_url'    => $imageFilename,
            'details'      => $request->input('details'),
        ]);

        return redirect()->route('admin.users')->with('success', 'Product added successfully.');
    }

    // Delete product
    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image_url) {
            $path = public_path('images/products/' . $product->image_url);
            if (File::exists($path)) {
                File::delete($path);
            }
        }

        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Product deleted successfully.');
    }

    // Show logs placeholder (Mongo removed)
    public function showLogs()
    {
        // Since MongoDB logs are removed, this could either show nothing
        // or you could implement a MySQL-based log table in the future
        return view('admin.logs');
    }
}
