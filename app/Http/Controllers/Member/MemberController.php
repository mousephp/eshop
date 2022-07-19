<?php

namespace App\Http\Controllers\Member;

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
use App\Rules\MatchOldPassword;

class MemberController extends Controller
{
    public function profile(){
        $profile = Auth::guard('client')->user();

        return view('user.users.profile')->with('profile',$profile);
    }

    public function profileUpdate(Request $request,$id){              
        $this->validate($request,[
	            'name' => 'required|alpha|min:3|max:30|unique:clients,name,',$id 
	        ],
        );

        $user   = Client::findOrFail($id);

        $data   = $request->all();
        
        $status = $user->fill($data)->save();

        if($status){
            return redirect()->back()->with('success', 'Successfully updated your profile');
        }
        
        return redirect()->back()->with('error', 'Please try again!');
    }

    public function logout(){
        Auth::guard('client')->logout();

		return redirect()->route('login.form')->with('message', 'Đăng xuất thành công');
    }

    public function changePassword(){
        return view('user.layouts.userPasswordChange');
    }

    public function changPasswordStore(Request $request)
    {
        $request->validate([
            'current_password'     => ['required', new MatchOldPassword],
            'new_password'         => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
   
        Client::find(Auth::guard('client')->user()->id)->update(['password'=> Hash::make($request->new_password)]);
   
        return redirect()->route('member.dashboard')->with('success', 'Password successfully changed');
    }
    
}
