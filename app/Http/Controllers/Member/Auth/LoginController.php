<?php

namespace App\Http\Controllers\Member\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\User;
use Session;
use DB;
use Hash;
use Log;
use Exception;
use Mail;
use Auth;

class LoginController extends Controller
{
    public function login(){
        return view('frontend.pages.login');
    }

    public function loginSubmit(Request $request){
        $credentials = [
            'email'     => $request->email,
            'password'  => $request->password,
            'confirmed' => 1
        ];

        $verify = Client::where('email', $credentials['email'])->first();

        if (!Auth::guard('client')->attempt($credentials) && isset($verify->confirmed) == 0) {
            return redirect()->back()->withInput()->with('error', 'Tài khoản chưa được xác thực');             
        }else if (!Auth::guard('client')->attempt($credentials)) {
            return redirect()->back()->withInput()->with('error', 'Đăng nhập thất bại'); 
        }else {
            return redirect()->route('home')->with('success', 'Đăng nhập thành công');
        }   
    }
 
}
