<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\User;
use Auth;
use Hash;
use Log;
use Exception;

class RegisterController extends Controller
{
    public function getRegister(){
		return view('auth.register');
    }

    public function postRegister(Request $request){ 
    	$this->validate($request,
	        [
	            'name'     =>'required|alpha|min:3|max:30|unique:users,name', 
            	'email'    =>'required|email',
            	'password'              =>'required|min:5|max:50',
            	'password_confirmation' =>'required|min:5|same:password'
	        ],
	        [
	            'name.required' =>':attribute không được để trống',
	            'name.min'      =>':attribute phải >= 3 ký tự',
	            'name.max'      =>':attribute phải < 30 ký tự',   
	            'name.alpha'    =>':attribute  không đúng định dạng',   
	            'name.unique'   =>':attribute đã bị trùng',   

	            'email.required'    =>':attribute không được để trống',
	            'email.email'       =>':attribute không đúng định dạng',

	            'password.required' =>':attribute không được để trống',
	            'password.min'      =>':attribute phải >= 5 ký tự',
	            'password.max'      =>':attribute phải <= 50 ký tự',

	            'password_confirmation.same'     =>'password và xác nhận :attribute phải khớp', 
	            'password_confirmation.min'      =>':attribute phải >= 5 ký tự',
	            'password_confirmation.required' =>':attribute không được để trống'   
	        ],
	        [
	        	'name'    => 'user', 
				'email'   => 'email', 
				'password'              => 'password',
				'password_confirmation' =>'xác nhận password phải khớp'
	        ]
    	);

		try {
			User::create([
				'name'     => $request->name,
				'email'    => $request->email,
				'password' => Hash::make($request->password)			
			]);
			
			return redirect()->route('login')->with('message','Thêm tài khoản thành công');
		} catch (Exception $exception) {
			Log::error('error(loi):'.$exception->getMessage().$exception->getLine());
		}  
    }

    
}
