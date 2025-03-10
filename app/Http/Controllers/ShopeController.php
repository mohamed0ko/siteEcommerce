<?php

namespace App\Http\Controllers;

use App\Models\Product;


class ShopeController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('frontend.Shop', compact('products'));
    }
    public function show(Product $product)
    {
        $product->load(['category', 'colors', 'user']);
        return view('frontend.ProductDetails', compact('product'));
    }
}
