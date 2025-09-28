<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\CartItem;

class AddToCartButton extends Component
{
    public int $productId;
    public int $quantity = 1;
    public $index = null; // optional modal index so we can close the right modal

    public function mount($productId, $index = null)
    {
        $this->productId = (int) $productId;
        if ($index !== null) {
            $this->index = $index;
        }
    }

    public function addToCart()
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $userId = Auth::id();
        $qty = max(1, (int) $this->quantity);

        DB::transaction(function () use ($userId, $qty) {
            $cart = Cart::firstOrCreate(['user_id' => $userId]);

            $item = $cart->items()
                ->where('product_id', $this->productId)
                ->lockForUpdate()
                ->first();

            if ($item) {
                $item->quantity += $qty;
                $item->save();
            } else {
                $cart->items()->create([
                    'product_id' => $this->productId,
                    'quantity'   => $qty,
                ]);
            }
        });

        $this->dispatch('toast', message: 'Added to cart');
        $this->dispatch('cartUpdated'); // 👈 changed from emit to dispatch

        if ($this->index !== null) {
            $this->dispatch('closeModal', index: $this->index);
        }
    }


    public function render()
    {
        return view('livewire.add-to-cart-button');
    }
}
