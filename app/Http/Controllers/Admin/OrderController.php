<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Order;
use App\Helpers\MyHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApiOrderRequest;
use App\Http\Requests\UpdateOrderRequest;

class OrderController extends Controller
{
    protected $field = 'orders.id';
    protected $sort = 'desc';

    public function index(Request $request)
    {
        if (isset($request->field) && $request->sort) {
            $this->field = $request->field;
            $this->sort = $request->sort;
        }
        $lists = MyHelper::servicesAndStatuses();
        $orders = Order::getList($this->field, $this->sort);
//        dd($orders);
        $sort = $this->sort == 'desc' ? 'asc' : 'desc';
        $data = ['title' => 'Список заказов',
            'orders' => $orders,
            'services' => $lists['services'],
            'statuses' => $lists['statuses'],
            'payments' => $lists['payments'],
            'payment_statuses' => $lists['payment_statuses'],
            'sort' => $sort
        ];
        return view('admin.orders.order', $data);
    }

    public function update(UpdateOrderRequest $request, $id)
    {
        $order = Order::findOrFail($id);
        MyHelper::fillRequest($order, $request);
        $order->save();

    }

    public function showStoreForm()
    {
        $users = User::withoutSuperAdmin();
        $user_list = [];
        foreach ($users as $user) {
            $user_list[$user->id] = $user->data->full_name;
        }
        $lists = MyHelper::servicesAndStatuses();
        $data = [
            'title' => 'Добавление нового заказа',
            'users' => $user_list,
            'services' => $lists['services'],
            'statuses' => $lists['statuses'],
            'payments' => $lists['payments'],
            'payment_statuses' => $lists['payment_statuses']
        ];
        return view('admin.orders.add', $data);
    }

    public function store(ApiOrderRequest $request)
    {
        $order = new Order();
        MyHelper::fillRequest($order, $request);
        return redirect()->route('order')->with('status', 'Заказ добавлен!');
    }


    public function show(Request $request)
    {
        $order = Order::findOrFail($request->id);
        $lists = MyHelper::servicesAndStatuses();
        $content = view('admin.orders.show_order_info', ['order' => $order, 'lists' => $lists]);
        $image['id'] = $order->id;
        $image['content'] = "$content";
        return response()->json($image);
    }

    public function delete(Request $request)
    {
        $order = Order::findOrFail($request->id);
        $order->delete();
    }

    public function search(Request $request)
    {
        $search = '%' . $request->search . '%';
        $orders = [];
        if (isset($request->search_id) && $request->search_id == 'on') {
            $order_id = $request->search;
            $user = \App\User::whereHas('orders', function ($query) use ($order_id) {
                $query->whereId($order_id);
            })->first();
            $message = 'Ничего не найдено';
            if ($user != null) {
                $message = 'Клиент:' . ' ' . $user->data->full_name . ' (' . $user->data->tel . '). ' . 'Email:' .
                    ' ' . $user->email . '. Город: ' . $user->data->city;
            }
            return redirect()->route('orders')->with('status', $message);
        } else {
            $orders = Order::search($search);
        }
        $lists = MyHelper::servicesAndStatuses();
        $data = ['title' => 'Результат поиска',
            'orders' => $orders,
            'services' => $lists['services'],
            'statuses' => $lists['statuses'],
            'payments' => $lists['payments'],
            'payment_statuses' => $lists['payment_statuses'],
            'sort' => 'desc'
        ];
        return view('admin.orders.order', $data);
    }
}