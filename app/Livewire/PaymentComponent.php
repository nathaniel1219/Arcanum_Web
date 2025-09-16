<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Collection;

class PaymentComponent extends Component
{
    public Collection $cartItems;
    public $total = 0;
    public $paymentStatus = '';

    public function mount()
    {
        $user = Auth::user();

        if ($user && $user->cart) {
            $this->cartItems = $user->cart->cartItems()->with('product')->get();
            $this->total = $this->cartItems->sum(fn($item) => $item->product->price * $item->quantity);
        } else {
            $this->cartItems = collect(); // empty 
        }
    }

    public function simulatePayment()
    {
        $user = Auth::user();

        if (!$user || !$user->cart) {
            $this->paymentStatus = 'No cart found!';
            return;
        }

        if ($this->cartItems->isEmpty()) {
            $this->paymentStatus = 'Your cart is empty!';
            return;
        }

        // Create an order
        $order = Order::create([
            'user_id' => $user->id,
            'total' => $this->total,
            'order_status' => 'paid',
        ]);

        // Move cart items to order items and delete them
        $this->cartItems->each(function ($item) use ($order) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product->id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);

            $item->delete();
        });

        // Reset cart
        $this->cartItems = collect();
        $this->total = 0;
        $this->paymentStatus = 'Payment successful! Order ID: ' . $order->id;
    }

    public function render()
    {
        return view('livewire.payment-component');
    }
}
