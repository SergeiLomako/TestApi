<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Mail\ChangePassword;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

class ForgotPasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function sendMail(Request $request)
    {
        $search_user = \App\User::whereEmail($request->email)->firstOrFail();
        $rand_str = str_random(20);
        $search_user->password_reset_token = $rand_str;
        $search_user->save();
        Mail::to($search_user->email)->send(new ChangePassword($search_user));
        return back()->with('status', 'Проверьте почту');
    }
}
