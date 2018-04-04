<?php

namespace App\Http\Controllers\Api;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function addOrder(Request $request){
        $request->validate([
            'terminal_id' => 'required|numeric',
            'box_number' => 'required|numeric',
            'seal_number' => 'required|numeric',
            'service_id' => 'required|numeric',
            'payment' => 'required|numeric',
        ]);

        $new_order = new Order();
        $new_order->fill($request->all());
        $new_order->save();
        return response()->json(['status' => 'Order added'], 201);
    }

    public function getList($id = null){
        if($id != null){
            $order = Order::find($id);
            if(!empty($order)){
                return response()->json($order->toJson());
            }
            else {
                return response()->json(['error' => 'Wrong data']);
            }
        }

        $list = Order::paginate(env('PAGINATE_LIMIT'));

        return response()->json($list->toJson());
    }
}