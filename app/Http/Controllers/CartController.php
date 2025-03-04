<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cart()
    {
        $userId = Auth::id();
        $cartProduct = Cart::where('user_id', $userId)->with('product')->get();
        $total = $cartProduct->sum(function ($cart) {
            return $cart->product->price * $cart->quantityCart;
        });
        return view('frontend.AddCart', compact('cartProduct', 'total'));
    }

    public function addToCart($productid)
    {
        $userId = Auth::id();
        $existingCart = Cart::where('user_id', $userId)->where('product_id', $productid)->first();

        if ($existingCart) {
            $existingCart->quantityCart += 1;
            $existingCart->save();
        } else {
            $newCart = new Cart();
            $newCart->product_id = $productid;
            $newCart->user_id = $userId;
            $newCart->quantityCart = 1;
            $newCart->save();
        }

        return redirect('/cart')->with('success', 'Product added to cart!');
    }
    public function destroy($cartid)
    {
        $cartDelete = Cart::find($cartid);
        $cartDelete->delete();

        return redirect()->back()->with('success', 'cart delete successfully');
    }
}
