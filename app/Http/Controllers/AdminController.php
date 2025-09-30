<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

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
        $users = User::with('orders')->get(); // User model needs orders() relationship
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
        return view('admin.add-product');
    }

    // Store product
    public function storeProduct(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category' => 'required|string',
            'sub_category' => 'nullable|string',
        ]);

        Product::create($request->all());

        return redirect()->back()->with('success', 'Product added.');
    }
}
