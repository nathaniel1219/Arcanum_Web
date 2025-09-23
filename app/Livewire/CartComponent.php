<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;


class CartComponent extends Component
{
    public Collection $items;
    public array $selected = [];          // array of product_ids selected
    public array $quantities = [];
    public float $subtotal = 0.0;

    protected $listeners = [
        'cartUpdated' => 'refreshCart',    // fired when item added from modal
        'toggleSelectAll' => 'toggleSelectAll',
        'addToCart' => 'addToCart'
    ];

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        $user = Auth::user();
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);
        $this->items = $cart->cartItems()->with('product')->get();
        $this->quantities = [];
        $this->selected = [];
        $this->subtotal = 0;

        foreach ($this->items as $it) {
            $this->quantities[$it->product_id] = $it->quantity;
            $this->subtotal += ($it->product->price ?? 0) * $it->quantity;
        }
    }

    // Re-fetch items
    public function refreshCart()
    {
        $this->loadCart();
    }

    // Toggle select all (called from browser event)
    public function toggleSelectAll($checked)
    {
        if ($checked) {
            $this->selected = $this->items->pluck('product_id')->map(fn($v) => (string)$v)->toArray();
        } else {
            $this->selected = [];
        }
    }

    // Update quantities from $quantities array
    public function updateQuantities()
    {
        $user = Auth::user();
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);

        foreach ($this->quantities as $id => $qty) {
            $qty = max(1, (int)$qty);
            CartItem::where('cart_id', $cart->id)
            ->where('product_id', $id)
            ->update(['quantity' => $qty]);
        }

        $this->loadCart();
        $this->dispatchBrowserEvent('toast', ['message' => 'Cart updated']);
    }


    // Delete selected items
    public function deleteSelected()
    {
        if (empty($this->selected)) {
            $this->dispatchBrowserEvent('toast', ['message' => 'No items selected']);
            return;
        }

        $user = Auth::user();
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);

        CartItem::where('cart_id', $cart->id)
        ->whereIn('product_id', $this->selected)
        ->delete();

        $this->selected = [];
        $this->loadCart();
        $this->dispatchBrowserEvent('toast', ['message' => 'Selected items deleted']);
    }

    public function addToCart($productId)
    {
        $user = Auth::user();
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);

        // Use updateOrCreate with raw increment to avoid race conditions
        $cartItem = CartItem::updateOrCreate(
            [
                'cart_id' => $cart->id,
                'product_id' => $productId,
            ],
            [
                'quantity' => \DB::raw('quantity + 1'),
            ]
        );

        $this->dispatchBrowserEvent('toast', ['message' => 'Added to cart!']);
        $this->loadCart(); // refresh cart for cart page listeners
    }



    public function render()
    {
        return view('livewire.cart-component');
    }
}
