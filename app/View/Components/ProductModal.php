<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductModal extends Component
{
    /**
     * Create a new component instance.
     */
    public $product;
    public $index;

    public function __construct($product, $index)
    {
        $this->product = $product;
        $this->index = $index;
    }

    public function render()
    {
        return view('components.product-modal', [
            'product' => $this->product,
            'index' => $this->index,
        ]);
    }
}
