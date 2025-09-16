<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Livewire\PaymentComponent;


/*
|--------------------------------------------------------------------------
| Authenticated routes (everything requires login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // Home (product listing)
    Route::get('/', [ProductController::class, 'index'])->name('products.index');

    // Product details
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

    // Cart page (blade that includes the Livewire component)
    Route::view('/cart', 'cart')->name('cart.index');
    
    // Add to cart (AJAX)
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');

    // Payment (Livewire)
    Route::get('/payment', PaymentComponent::class)->name('payment');

    // Dashboard redirect back to products.index (optional)
    Route::get('/dashboard', function () {
        return redirect()->route('products.index');
    })->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| Guest routes
| (Jetstream/Fortify usually provides the login/register routes for you;
|  if you've published views, those will be used. No need to manually
|  expose product pages here because everything above is auth-protected.)
|--------------------------------------------------------------------------
*/
