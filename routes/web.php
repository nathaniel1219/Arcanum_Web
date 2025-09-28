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

    // Product listings
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::get('/pokemon', [ProductController::class, 'pokemon'])->name('products.pokemon');
    Route::get('/ygo', [ProductController::class, 'ygo'])->name('products.ygo');
    Route::get('/funko', [ProductController::class, 'funko'])->name('products.funko');

    // Product details
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

    // Cart page (blade that includes the Livewire component)
    Route::view('/cart', 'cart')->name('cart.index');
    
    // Payment (Livewire)
    Route::get('/payment', PaymentComponent::class)->name('payment');

    // Dashboard (redirect)
    Route::get('/dashboard', function () {
        return redirect()->route('products.index');
    })->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| Guest routes are provided by Jetstream/Fortify - they handle login/register
|--------------------------------------------------------------------------
*/
