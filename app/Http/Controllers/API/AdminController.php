<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProducts;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function newOrders()
    {
        return response()->json([
            'orders' => Order::where('new', 1)->get()
        ], 200);
    }

    public function allOrders()
    {
        return response()->json([
            'orders' => Order::latest()->get()
        ], 200);
    }

    public function show(Request $request)
    {
        return response()->json([
            'order' => Order::where('id', $request->id)->first(),
            'products' => OrderProducts::with('product')->where('order_id', $request->id)->get()
        ], 200);
    }

    public function changeStatus(Request $request)
    {
        $order = Order::where('id', $request->id)->first();
        $order->new = !$order->new;
        $order->save();

        return response()->json([
            'order' => $order
        ], 200);
    }
}
