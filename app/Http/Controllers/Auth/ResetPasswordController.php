<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/admin/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function changePasswordForm($token){
          $user = User::getToResetToken($token);
          if(!empty($user)){
              return view('change_password', ['token' => $token]);
          }

          abort(404);
    }

    public function savePassword(Request $request){
        $this->validate($request, [
            'password' => 'required|min:6|max:25',
            'password_confirmation' => 'required|min:6|max:25|same:password',
        ]);
        $user = User::getToResetToken($request->token);
        if(!empty($user)){
            $user->password = bcrypt($request->password);
            $user->password_reset_token = null;
            $user->save();
            return redirect()->route('admin_login')->with('status', 'Пароль успешно изменен');
        }

        abort(404);
    }


}
