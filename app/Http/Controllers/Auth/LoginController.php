<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function login(Request $request) {
            if (Auth::attempt([
                    'email' => $request->email,
                    'password' => $request->password,
                ])) {

                if(Auth::user()->hasRole(['super_admin|admin|moderator'])){
                    return redirect()->route('admin_main');
                }
                else {
                    return back()->with('status', 'Нет доступа');
                }
            }
            else {
                return back()->with('status', 'Неверный логин или пароль!');
            }
    }

    public function logout(Request $request) {
        if(empty($request->_token)){
            return redirect()->route('admin_login');
        }
        $request->session()->invalidate();
        return redirect()->route('admin_login');
    }

}
