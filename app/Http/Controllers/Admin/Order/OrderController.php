<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderController extends ApiController
{

    public function index()
    {
        $orders = Order::with(['user:id,name', 'items', 'status:id,orderStatusName'])->get();
        foreach($orders as $order ){
            $order->name = $order->user->name;
            $order->orderStatusName = $order->status->orderStatusName;
            $order->itemNumber = $order->items->count();
            $totalPrice = 0;
            foreach($order->items as $item) {
                $totalPrice = $totalPrice + $item->orderItemPrice;
            }
            $order->totalPrice = $totalPrice;
            unset($order['items'],$order['user'], $order['status']);
        }

        //dd($orders->toArray());
        return $this->showAll($orders);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
        $order = Order::where('id', $id)
            ->with(['user:id,name', 'items', 'status:id,orderStatusName', 'invoices.payment.payment_method'])
            ->first();
        $order->customerName = $order->user->name;
        $order->orderStatusName = $order->status->orderStatusName;
        unset($order['user'], $order['status']);
        return response()->json($order);
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
