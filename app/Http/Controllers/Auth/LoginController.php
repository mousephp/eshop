<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }

    public function getLogin()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request,
            [
                'email' => 'required',
                'password' => 'required',
                // 'g-recaptcha-response' => 'required|captcha',
            ]
        );

        $arr = ['email' => $request->email, 'password' => $request->password];
        
        if ($request->remember == 'Remember Me') {
            $remember = true;
        }else{
            $remember = false;
        }
        
        if (Auth::attempt($arr, $remember)) {
            return redirect()->route('admin');
        }

        return back()->withInput()->with('error', 'Tài khoản hoặc mật khẩu không đúng');
    }

}
