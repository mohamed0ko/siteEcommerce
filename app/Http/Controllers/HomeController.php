<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class HomeController extends Controller
{
    public function Adminpage()
    {

        $user = User::all();
        $category = Category::all();
        $product = Product::all();
        $order = Order::all();
        return view('backend.index', compact('user', 'category', 'product', 'order'));
    }

    public function Homepage()
    {
        $sliders = Slider::all();
        $product = Product::with('category')->get();
        $categories = Category::with('Product')->has('Product')->get();
        $Newproduct = Product::orderBy('created_at', 'desc')->get();

        $hotTrends = Product::where('is_trending', true)
            ->limit(8)
            ->get();

        $bestSellingProductIds = OrderDetails::select('product_id')
            ->selectRaw('SUM(quantityCart) as total_sold')
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->limit(8)
            ->pluck('product_id')
            ->toArray();

        // Step 2: Fetch full product info (in the same order)
        $BestSeller = Product::whereIn('id', $bestSellingProductIds)
            ->orderByRaw("FIELD(id, " . implode(',', $bestSellingProductIds) . ")")
            ->get();


        return view('frontend.dashboard', compact('Newproduct', 'product', 'categories', 'sliders', 'hotTrends', 'BestSeller'));
    }
}
