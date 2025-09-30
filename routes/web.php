<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminController;

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

    //checkout page routes
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'placeOrder'])->name('checkout.place');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');

    // Profile page
    Route::get('/profile', function () {
        return view('profile.show');
    })->name('profile.show');

    // Dashboard (redirect)
    Route::get('/dashboard', function () {
        return redirect()->route('products.index');
    })->name('dashboard');
});

/* for admins */
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/users', [AdminController::class, 'showUsers'])->name('admin.users');
    Route::post('/orders/{id}/update', [AdminController::class, 'updateOrder'])->name('admin.orders.update');
    Route::get('/products', [AdminController::class, 'addProduct'])->name('admin.products');
    Route::post('/products/store', [AdminController::class, 'storeProduct'])->name('admin.products.store');
});


/*
|--------------------------------------------------------------------------
| Guest routes are provided by Jetstream/Fortify - they handle login/register
|--------------------------------------------------------------------------
*/
