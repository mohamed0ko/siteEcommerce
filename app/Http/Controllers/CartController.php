<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Models\Cart;
use App\Models\Product;
use GuzzleHttp\Psr7\Response;
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


    public function addToCart(Request $request, $id)
    {
        $userId = Auth::id(); // Get the user ID
        $product = Product::find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }

        if ($request->quantityCart <= 0) {
            return redirect()->back()->with('error', 'Invalid quantity');
        }

        // Check if the cart has the same product with the same color & size
        $existingCart = Cart::where('user_id', $userId)
            ->where('product_id', $id)
            ->where('color', $request->color)
            ->where('size', $request->size)
            ->first();

        if ($existingCart) {
            // If the same product with the same color & size exists, update the quantity
            $existingCart->quantityCart += $request->quantityCart;
            $existingCart->save();
            return redirect()->back()->with('success', 'Cart updated successfully');
        } else {
            // If color or size is different, create a new cart entry
            $newCart = new Cart();
            $newCart->user_id = $userId;
            $newCart->product_id = $product->id;
            $newCart->name = $product->name;
            $newCart->imagepath = $product->imagepath;
            $newCart->price = $product->discount_price;
            $newCart->quantityCart = $request->quantityCart;
            $newCart->color = $request->color;
            $newCart->size = $request->size;
            $newCart->save();

            return redirect()->back()->with('success', 'Product added to cart');
        }
    }


    public function destroy($cartid)
    {
        $cartDelete = Cart::find($cartid);
        $cartDelete->delete();

        return redirect()->back()->with('success', 'cart delete successfully');
    }
}
