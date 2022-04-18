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
                $totalPrice = $totalPrice + $item->orderItemPrice * $item->orderItemQuantity;
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
        foreach($order->invoices as $invoice){
            $invoice->payment->paymentMethodName = $invoice->payment->payment_method->paymentMethodName;
            unset($invoice->payment->payment_method);
        }
        return response()->json($order);
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request,Order $order)
    {
        //
        $request->validate([
            'order_status_id' => 'integer|exists:order_statuses,id',
        ]);

        if($request->has('order_status_id')) {
            $order->order_status_id = $request->order_status_id;
        }
        if(!$order->isDirty()) {
            return response()->json('You need to specify which feild you want to update', 422);
        }
        $order->save();
        return response()->json($order);
    }


    public function destroy($id)
    {
        //
    }
}
