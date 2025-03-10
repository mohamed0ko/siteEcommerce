<?php

namespace App\Http\Controllers;

use App\Models\Order;

class adminOrderController extends Controller
{

    public function index()
    {
        $orders = Order::with('orderDetails')->get();

        return view('backend.Order.index', compact('orders'));
    }

    public function show(Order $order)
    {


        $order->load('orderDetails.color');

        $total = $order->orderDetails->sum(function ($s) {
            return $s->product->price * $s->quantityCart;
        });
        return view('backend.Order.show', compact('order', 'total'));
    }
}
