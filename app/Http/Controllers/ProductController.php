<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Show all products on homepage
    public function index()
    {
        // Fetch all products from database
        $products = Product::all();

        // Pass products to view
        return view('products.index', compact('products'));
    }

    // Show single product detail
    public function show($id)
    {
        // Find product by ID
        $product = Product::findOrFail($id);

        // Pass product to view
        return view('products.show', compact('product'));
    }
}
