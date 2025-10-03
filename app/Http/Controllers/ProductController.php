<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //  to load all products on homepage
    public function index()
    {
        $products = Product::all();

        return view('products.index', compact('products'));
    }


    // Pokemon only
    public function pokemon()
    {
        $products = Product::where('sub_category', 'pokemon')->get();
        return view('products.pokemon', compact('products'));
    }

    // Yu-Gi-Oh only
    public function ygo()
    {
        $products = Product::where('sub_category', 'Yu-Gi-Oh')->get();
        return view('products.ygo', compact('products'));
    }

    // Funko only
    public function funko()
    {
        $products = Product::where('sub_category', 'Funko Pop')->get();
        return view('products.funko', compact('products'));
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
