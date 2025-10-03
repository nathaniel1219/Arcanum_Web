<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductApiController extends Controller
{
    // Get all products
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    // Get only Pokemon products
    public function pokemon()
    {
        $products = Product::where('sub_category', 'pokemon')->get();
        return response()->json($products);
    }

    // Get only Yu-Gi-Oh products
    public function ygo()
    {
        $products = Product::where('sub_category', 'Yu-Gi-Oh')->get();
        return response()->json($products);
    }

    // Get only Funko Pops
    public function funko()
    {
        $products = Product::where('sub_category', 'Funko Pop')->get();
        return response()->json($products);
    }

    // Get single product detail
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }
}
