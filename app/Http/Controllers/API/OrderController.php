<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProducts;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $order = Order::create([
                'name' => $request->form['name'],
                'fio' => $request->form['fio'],
                'phone' => $request->form['phone'],
                'address' => $request->form['address']
            ]);

            foreach ($request->cart as $orderProduct) {
                OrderProducts::create([
                    'order_id' => $order->id,
                    'product_id' => $orderProduct['id'],
                    'count' => $orderProduct['amount'],
                    'price' => $orderProduct['price']
                ]);
            }
        } catch (\Exception $exception){
            return $exception;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
