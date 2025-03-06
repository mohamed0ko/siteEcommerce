<?php

namespace App\Http\Controllers;

use App\Http\Requests\checkoutRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use Illuminate\Support\Facades\View;
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

            $newCart = new Cart();
            $newCart->user_id = $userId;
            $newCart->product_id = $product->id;
            $newCart->name = $product->name;
            $newCart->imagepath = $product->imagepath;

            $newCart->quantityCart = $request->quantityCart;
            $newCart->color = $request->color;
            $newCart->size = $request->size;

            if ($product->discount_price > 0) {
                $newCart->price = $product->discount_price;
            } else {
                $newCart->price = $product->price;
            }

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

    public function checkout()
    {
        $userId = Auth::id();
        $cartProduct = Cart::where('user_id', $userId)->with('product')->get();
        $total = $cartProduct->sum(function ($cart) {
            return $cart->product->price * $cart->quantityCart;
        });
        return view('frontend.Checkout', compact('cartProduct', 'total'));
    }

    public function checkoutStore(checkoutRequest $request)
    {
        $From = $request->validated();
        $From['user_id'] = Auth::id();
        $order = Order::create($From);

        $cartProduct = Cart::where('user_id',  Auth::id())->with('product')->get();

        foreach ($cartProduct as $cart) {
            OrderDetails::create([
                'order_id' => $order->id,
                'product_id' => $cart->product_id,
                'name' => $cart->name,
                'size' => $cart->size,
                'quantityCart' => $cart->quantityCart,
                'price' => $cart->price,
                'color' => $cart->color,
                'imagepath' => $cart->imagepath,
            ]);
        }
        Cart::where('user_id', Auth::id())->delete();

        return redirect()->back();
    }
}
