<?php

namespace App\Http\Controllers;

use App\Http\Requests\checkoutRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cart()
    {
        $userId = Auth::id();
        $cartProduct = Cart::where('user_id', $userId)->with('product')->get();

        $total = $cartProduct->sum(function ($cart) {
            return $cart->product->discount_price * $cart->quantityCart;
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
        if ($product->quantity < $request->quantityCart) {
            return redirect()->back()->with('error', 'Not enough stock available!');
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
            return redirect()->back()->with('success', 'Product add to cart');
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

            return redirect()->back()->with('success', 'Product add to cart');
        }
    }


    public function destroy($cartid)
    {
        $cartDelete = Cart::find($cartid);
        $cartDelete->delete();

        return redirect()->back()->with('success', 'Cart delete successfully');
    }

    public function checkout()
    {
        $userId = Auth::id();
        $cartProduct = Cart::where('user_id', $userId)->with('product')->get();
        $total = $cartProduct->sum(function ($cart) {
            return $cart->product->discount_price * $cart->quantityCart;
        });
        return view('frontend.Checkout', compact('cartProduct', 'total'));
    }

    public function updateCartAll(Request $request)
    {
        if (!$request->has('quantities')) {
            return redirect()->back()->with('error', 'No quantities provided.');
        }

        $cartItems = Cart::whereIn('id', array_keys($request->quantities))->with('product')->get();

        foreach ($cartItems as $cart) {
            $product = $cart->product;

            // Check stock availability
            if ($product->quantity < $request->quantities[$cart->id]) {
                return redirect()->back()->with('error', 'Not enough stock for ' . $product->name);
            }
        }

        // Update cart quantities
        foreach ($request->quantities as $cartId => $quantity) {
            if ($quantity > 0) {
                Cart::where('id', $cartId)->update(['quantityCart' => $quantity]);
            }
        }

        return redirect()->back()->with('success', 'Cart updated successfully.');
    }


    public function checkoutStore(checkoutRequest $request)
    {
        $From = $request->validated();
        $From['user_id'] = Auth::id();
        $order = Order::create($From);

        $cartProduct = Cart::where('user_id', Auth::id())->with('product')->get();

        foreach ($cartProduct as $cart) {
            $product = Product::find($cart->product_id);

            // Check if enough stock is available
            if ($product->quantity < $cart->quantityCart) {
                return redirect()->back()->with('error', 'Not enough stock for ' . $product->name);
            }

            // Reduce product stock
            $product->quantity -= $cart->quantityCart;
            $product->save();

            // Save order details
            OrderDetails::create([
                'order_id' => $order->id,
                'product_id' => $cart->product_id,
                'name' => $cart->name,
                'size' => $cart->size,
                'quantityCart' => $cart->quantityCart,
                'price' => $cart->price,
                'color' => $cart->color,
                'imagepath' => $cart->imagepath,
                'status' => 'pending',
            ]);
        }

        // Clear cart after checkout
        Cart::where('user_id', Auth::id())->delete();

        return redirect()->back()->with('success', 'Order placed successfully!');
    }
}
