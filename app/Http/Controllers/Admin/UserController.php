<?php
namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Role;
use App\UserData;
use App\Helpers\MyHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{

    protected $field = 'users.id';
    protected $sort = 'desc';

    public function index(Request $request)
    {
        if(isset($request->field) && $request->sort){
            $this->field = $request->field;
            $this->sort = $request->sort;
        }
        $user = Auth::user();
        $not_searching = MyHelper::do_not_searching($user);
        $users = User::get_list($not_searching, $this->field, $this->sort);
        $roles = Role::role_list();
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
        if(!empty($request->password)){
            $user->password = $request->password;
        }
        $user->save();
        MyHelper::add_role($user, $request->role);
        $data = UserData::whereUserId($user->id)->firstOrFail();
        MyHelper::fill_request($data, $request);
    }

    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'first_name' => 'required|min:2|max:15',
                'last_name' => 'required|min:2|max:15',
                'city' => 'required|min:3',
                'address' => 'required',
                'tel' => 'required',
                'login' => 'required|min:3',
                'password' => 'required|min:6',
                'email' => 'required|unique:users'
            ]);
            $user = new User();
            MyHelper::fill_request($user, $request);
            MyHelper::add_role($user, $request->role);
            $data = new UserData();
            $data->user_id = $user->id;
            MyHelper::fill_request($data, $request);
            return redirect()->route('user')->with('status', 'Пользователь добавлен!');

        }
        $roles = Role::role_list();
        $data = ['title' => 'Добавление нового пользователя',
                 'roles' => $roles];
        return view('admin.users.add', $data);
    }

    public function get_info(Request $request)
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
        $data = UserData::whereUserId($request->id)->firstOrFail();
        $data->delete();
    }

    public function search(Request $request)
    {
        $user = Auth::user();
        $search = '%' . $request->search . '%';
        if(isset($request->search_id) && $request->search_id == 'on'){
            $order = \App\Order::whereSealNumber($request->search)->first();
            $message = 'Ничего не найдено';
            if($order != null){
                $lists = MyHelper::services_statuses();
                $message = 'Клиент:' . ' '. $order->user->data->full_name . ' (' . $order->user->data->tel. '). ' . 'Услуга:' .
                            ' ' . $lists['services'][$order->service_id] . '. Дата поступления: ' . $order->date_receipt;
            }
            return redirect()->route('user')->with('status', $message);
        }
        else {
            $users = User::search($user, $search);
        }
        $roles = Role::role_list();
        $data = ['title' => 'Результат поиска',
            'users' => $users,
            'roles' => $roles,
            'sort' => 'desc'
        ];
        return view('admin.users.user', $data);
    }

}