<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Role;
use App\UserData;
use App\Helpers\MyHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApiUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{

    protected $field = 'users.id';
    protected $sort = 'desc';

    public function index(Request $request)
    {
        if (isset($request->field) && $request->sort) {
            $this->field = $request->field;
            $this->sort = $request->sort;
        }
        $user = Auth::user();
        $not_searching = MyHelper::doNotSearching($user);
        $users = User::getList($not_searching, $this->field, $this->sort);
        $roles = Role::roleList();
        $sort = $this->sort == 'desc' ? 'asc' : 'desc';
        $data = ['title' => 'Список пользователей',
            'users' => $users,
            'roles' => $roles,
            'sort' => $sort
        ];
        return view('admin.users.user', $data);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->login = $request->login;
        if (!empty($request->password)) {
            $user->password = $request->password;
        }
        $user->save();
        MyHelper::addRole($user, $request->role);
        $data = UserData::whereUserId($user->id)->firstOrFail();
        MyHelper::fillRequest($data, $request);
    }

    public function showStoreForm()
    {
        $roles = Role::roleList();
        $data = ['title' => 'Добавление нового пользователя',
                 'roles' => $roles];
        return view('admin.users.add', $data);
    }

    public function store(ApiUserRequest $request)
    {
        $user = new User();
        MyHelper::fillRequest($user, $request);
        MyHelper::addRole($user, $request->role);
        $data = new UserData();
        $data->user_id = $user->id;
        MyHelper::fillRequest($data, $request);
        return redirect()->route('users')->with('status', 'Пользователь добавлен!');
    }

    public function show(Request $request)
    {
        $user = User::findOrFail($request->id);
        $content = view('admin.users.show_user_info', ['user' => $user]);
        $image['id'] = $user->id;
        $image['content'] = "$content";
        return response()->json($image);
    }

    public function delete(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->delete();
    }

    public function search(Request $request)
    {
        $user = Auth::user();
        $search = '%' . $request->search . '%';
        if (isset($request->search_id) && $request->search_id == 'on') {
            $order = \App\Order::whereSealNumber($request->search)->first();
            $message = 'Ничего не найдено';
            if ($order != null) {
                $lists = MyHelper::servicesAndStatuses();
                $message = 'Клиент:' . ' ' . $order->user->data->full_name . ' (' . $order->user->data->tel . '). ' . 'Услуга:' .
                    ' ' . $lists['services'][$order->service_id] . '. Дата поступления: ' . $order->date_receipt;
            }
            return redirect()->route('users')->with('status', $message);
        } else {
            $users = User::search($user, $search);
        }
        $roles = Role::roleList();
        $data = ['title' => 'Результат поиска',
            'users' => $users,
            'roles' => $roles,
            'sort' => 'desc'
        ];
        return view('admin.users.user', $data);
    }

}