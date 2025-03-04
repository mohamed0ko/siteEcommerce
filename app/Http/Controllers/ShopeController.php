<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopeController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('frontend.Shop', compact('products'));
    }
    public function show(Product $product = null)
    {
        if ($product) {
            return view('frontend.ProductDetails', compact('product'));
        } else {
            $products = Product::all();
            return view('frontend.Shop', compact('products'));
        }
    }
}
