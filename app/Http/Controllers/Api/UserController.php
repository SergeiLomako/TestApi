<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\User;
use App\UserData;
use Notification;
use Illuminate\Http\Request;
use App\Notifications\ConfirmNumber;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApiUserRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class UserController extends Controller
{
    use AuthenticatesUsers;

    public function register(ApiUserRequest $request)
    {
        $user = new User();
        $user->auth_token = str_random(50);
        $user->fill($request->all());
        $user->save();
        $user_data = new UserData();
        $user_data->user_id = $user->id;
        $user_data->fill($request->all());
        $user_data->save();
        return response()->json(['access_token' => $user->auth_token], 201);
    }

    public function send_code(Request $request)
    {
        $tel = preg_replace('![^0-9]+!', '', $request->tel);
        if (Auth::attempt([
            'tel' => $tel,
            'password' => $request->password,
        ])) {

            $code = rand(10000, 99999);
            $user = Auth::user();
            $user->sms_code = $code;
            $user->save();
            Notification::send($user, new ConfirmNumber($code));
            return response()->json(['show_sms_form' => 'OK',
                                     'id' => $user->id]);
        }
        else {
            return response()->json(['error' => 'Wrong number or password'], 404);
        }
    }

    public function auth(Request $request){
        $request->validate([
            'id' => 'required',
            'code' => 'required',
        ]);

        $user = User::whereId($request->id)->where('sms_code', $request->code)->first();
        if(!empty($user)){
            $user->auth_token = str_random(50);
            $user->save();
            return response()->json(['auth_token' => $user->auth_token]);
        }
        else {
            return response()->json(['error' => 'Wrong data']);
        }
    }
}