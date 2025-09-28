<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;

class CartComponent extends Component
{
    // Livewire listeners — when AddToCartButton emits 'cartUpdated' we reload items
    protected $listeners = [
        'cartUpdated' => 'loadItems',
    ];

    public $cart;
    public $items;
    public $selected = [];
    public $selectAll = false;

    public function mount()
    {
        if (! Auth::check()) {
            abort(403);
        }

        $this->cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        $this->loadItems();
    }

    public function loadItems()
    {
        $this->items = $this->cart->items()->with('product')->get();

        if (! empty($this->selected)) {
            $available = $this->items->pluck('id')->map(fn($v) => (string) $v)->toArray();
            $this->selected = array_values(array_intersect($this->selected, $available));
            if (empty($this->selected)) {
                $this->selectAll = false;
            }
        }
    }

    public function render()
    {
        return view('livewire.cart-component', [
            'items' => $this->items,
            'subtotal' => $this->getSubtotal(),
            'selectedTotal' => $this->getSelectedTotal(),
        ]);
    }

    public function increment($itemId)
    {
        $item = $this->cart->items()->where('id', $itemId)->first();
        if (! $item) return;

        $item->increment('quantity');
        $this->loadItems();
        $this->dispatch('toast', message: 'Quantity increased');
    }

    public function decrement($itemId)
    {
        $item = $this->cart->items()->where('id', $itemId)->first();
        if (! $item) return;

        if ($item->quantity <= 1) {
            $this->dispatch('toast', message: 'Quantity cannot be less than 1');
            return;
        }

        $item->decrement('quantity');
        $this->loadItems();
        $this->dispatch('toast', message: 'Quantity decreased');
    }

    public function updateQuantity($itemId, $quantity)
    {
        $qty = (int) $quantity;
        if ($qty < 1) $qty = 1;

        $item = $this->cart->items()->where('id', $itemId)->first();
        if (! $item) return;

        $item->quantity = $qty;
        $item->save();

        $this->loadItems();
        $this->dispatch('toast', message: 'Quantity updated');
    }

    public function removeItem($itemId)
    {
        $item = $this->cart->items()->where('id', $itemId)->first();
        if (! $item) return;

        $item->delete();
        $this->loadItems();
        $this->dispatch('toast', message: 'Item removed');
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selected = $this->items->pluck('id')->map(fn($id) => (string) $id)->toArray();
        } else {
            $this->selected = [];
        }
    }

    public function removeSelected()
    {
        if (empty($this->selected)) {
            $this->dispatch('toast', message: 'No items selected');
            return;
        }

        DB::transaction(function () {
            $this->cart->items()->whereIn('id', $this->selected)->delete();
        });

        $this->selected = [];
        $this->selectAll = false;
        $this->loadItems();
        $this->dispatch('toast', message: 'Selected items removed');
    }

    public function getSubtotal()
    {
        if ($this->items->isEmpty()) return 0;

        return $this->items->sum(function ($item) {
            $price = optional($item->product)->price ?? 0;
            return $price * $item->quantity;
        });
    }

    public function getSelectedTotal()
    {
        if (empty($this->selected) || $this->items->isEmpty()) return 0;

        return $this->items->whereIn('id', $this->selected)
                    ->sum(fn($item) => (optional($item->product)->price ?? 0) * $item->quantity);
    }

    public function proceedToCheckout()
    {
        if (empty($this->selected)) {
            $this->dispatch('toast', message: 'Please select at least one item');
            return;
        }

        $this->dispatch('toast', message: 'Checkout not implemented yet');
    }
}
