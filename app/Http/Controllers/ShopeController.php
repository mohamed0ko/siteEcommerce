<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use Illuminate\Http\Request;


class ShopeController extends Controller
{
    public function index(Request $request, $caregory = null)
    {


        $productQuery = Product::query()->with('category');
        if ($caregory) {
            $productQuery = Product::query()->with('category')->where('category_id', $caregory);
        }



        $categories = Category::with('Product')->has('Product')->get();
        $colors = Color::with('products')->has('products')->get();
        $sizes = Product::has('products')->pluck('size', 'id');




        $Search = ($request->input('Search'));
        $color = ($request->input('color'));
        $min = ($request->input('min', 0));
        $max = ($request->input('max'));




        if (!empty($Search)) {

            $productQuery->where('name', 'like', "%{$Search}%");
        }


        $productQuery->where(function ($query) use ($min) {
            $query->where('price', '>=', $min)
                ->orWhere('discount_price', '>=', $min);
        });

        if (!empty($max)) {
            $productQuery->where(function ($query) use ($max) {
                $query->where('price', '<=', $max)
                    ->orWhere('discount_price', '<=', $max);
            });
        }


        if (!empty($color)) {
            $productQuery->whereHas('colors', function ($query) use ($color) {
                $query->whereIn('colors.id', $color);
            });
        }

        $sql = $productQuery->toSql();
        $bindings = $productQuery->getBindings();
        $results = $productQuery->get();
        $products = $productQuery->paginate(5);



        $prices = $products->pluck('price')->merge($products->pluck('discount_price'))->filter()->all();

        $priceOptions = new \stdClass();
        $priceOptions->minPrice = !empty($prices) ? min($prices) : 0;
        $priceOptions->maxPrice = !empty($prices) ? max($prices) : 0;



        return view('frontend.Shop', compact('products', 'categories', 'colors', 'priceOptions'));
    }

    public function show(Product $product)
    {
        $product->load(['category', 'colors', 'user']);
        return view('frontend.ProductDetails', compact('product'));
    }
}
