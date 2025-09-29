<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    // Show checkout page (index)
    public function index(Request $request)
    {
        $user = Auth::user();
        $selectedIds = session('checkout_items', []);

        if (empty($selectedIds)) {
            return redirect()->route('cart.index')->with('error', 'No items selected for checkout.');
        }

        // Fetch cart items and ensure they belong to this user's cart.
        $cartItems = CartItem::with('product')
            ->whereIn('id', $selectedIds)
            ->whereHas('cart', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Selected cart items not found.');
        }

        // Compute subtotal server-side (do not trust client)
        $subtotal = $cartItems->sum(fn($item) => ($item->product->price ?? 0) * $item->quantity);

        return view('checkout.index', compact('cartItems', 'subtotal'));
    }

    // Place order (POST)
    public function placeOrder(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'payment_method' => 'required|string'
        ]);

        $user = Auth::user();
        $selectedIds = session('checkout_items', []);

        if (empty($selectedIds)) {
            return redirect()->route('cart.index')->with('error', 'No items selected for checkout.');
        }

        $cartItems = CartItem::with('product')
            ->whereIn('id', $selectedIds)
            ->whereHas('cart', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Selected cart items not found.');
        }

        // Compute total server-side
        $total = $cartItems->sum(fn($item) => ($item->product->price ?? 0) * $item->quantity);

        DB::transaction(function () use ($cartItems, $user, $total) {
            $order = Order::create([
                'user_id' => $user->id,
                'total' => $total,
                'order_status' => 'pending',
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price ?? 0,
                ]);
            }

            // Remove purchased cart items
            CartItem::whereIn('id', $cartItems->pluck('id')->toArray())->delete();

            // (Optional: adjust product stock here)
        });

        // clear session checkpoint
        session()->forget('checkout_items');

        // Flash order id (optional) — load it on success page if you want to show details
        // For simplicity, we redirect to success page without id. If you want order id, you can flash it.
        return redirect()->route('checkout.success')->with('success', 'Order placed successfully!');
    }

    public function success()
    {
        // You can show last order id if you flashed it; for now just render success page
        return view('checkout.order_success');
    }
}
