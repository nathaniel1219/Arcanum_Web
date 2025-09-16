<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,product_id',
            'quantity' => 'sometimes|integer|min:1'
        ]);

        $user = $request->user();
        $qty = $request->input('quantity', 1);
        $pid = $request->input('product_id');

        $cart = Cart::firstOrCreate(['user_id' => $user->id]);

        $item = CartItem::where('cart_id', $cart->id)
                        ->where('product_id', $pid)
                        ->first();

        if ($item) {
            $item->quantity += $qty;
            $item->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $pid,
                'quantity' => $qty,
            ]);
        }

        $count = $cart->cartItems()->sum('quantity');

        return response()->json([
            'success' => true,
            'message' => 'Item added to cart',
            'cart_count' => $count,
        ]);
    }
}
