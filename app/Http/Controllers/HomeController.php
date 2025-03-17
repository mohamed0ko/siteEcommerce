<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class HomeController extends Controller
{
    public function Premiun()
    {
        $role = FacadesAuth::User()->user_type;
        if ($role == 1) {
            $user = User::all();
            $category = Category::all();
            $product = Product::all();
            $order = Order::all();
            return view('backend.index', compact('user', 'category', 'product', 'order'));
        } elseif ($role == 0) {
            return view('frontend.dashboard');
        }
    }
}
