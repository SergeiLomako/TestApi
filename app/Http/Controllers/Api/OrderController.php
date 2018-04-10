<?php

namespace App\Http\Controllers\Api;

use App\Order;
use App\Helpers\MyHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApiOrderRequest;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::paginate(env('PAGINATE_LIMIT'));
        return response()->json($orders->toJson());
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        return response()->json($order->toJson());
    }

    public function store(ApiOrderRequest $request)
    {
        $new_order = new Order();
        MyHelper::fillRequest($new_order, $request);
        return response()->json(['status' => 'Order created'], 201);
    }
}