<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetails;

class adminOrderController extends Controller
{

    public function index()
    {
        $orders = Order::with('orderDetails')->orderBy('created_at', 'desc')->get();;

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

    public function orderDelivery($id)
    {
        $order = OrderDetails::find($id);
        $order->status = 'delivered';
        $order->save();


        return redirect()->back()->with('success', 'Order marked as Delivered.');
    }

    public function orderPending($id)
    {
        $order = OrderDetails::find($id);
        $order->status = 'pending';
        $order->save();

        return redirect()->back()->with('success', 'Order marked as Pending.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->back()->with('success', 'Order delete successfully.');
    }
}
