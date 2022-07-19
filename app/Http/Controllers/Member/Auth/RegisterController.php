<?php

namespace App\Http\Controllers\Member\Auth;

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

class RegisterController extends Controller
{
    public function register(){
        return view('frontend.pages.register');
    }
    
    public function registerSubmit(Request $request){
        $this->validate($request,[
            'name'     => 'string|required|min:2',
            'email'    => 'string|required|unique:clients,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $data = $request->all();

        try {
            DB::beginTransaction();

            $confirmation_code = time().uniqid(true);

            Client::create([
                'name'     => $data['name'],
                'email'    => $data['email'],
                'password' => Hash::make($data['password']),
                'status'   => 'active',
                'email_verified_at' => $confirmation_code, //now(),
                'confirmed' => 0,
            ]);           

            Mail::send('frontend.emails.verify', array(
                'confirmation_code' => $confirmation_code
            ), function ($message) use ($request) {
                $message->to($request->email, $request->name)->subject('Verify your email address');
            });

            DB::commit();

            return redirect(route('login.form'))->with('error', 'Vui lòng xác nhận tài khoản email');
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('error(loi):'.$exception->getMessage().' line '.$exception->getLine());
        } 
    }

    public function verify($code)
    {
        $user = Client::where('email_verified_at', $code);

        if ($user->count() > 0) {
            $user->update([
                'confirmed' => 1,
                'email_verified_at' => $code
            ]);
            
            $notification_status = 'Bạn đã xác nhận thành công';
        } else {
            $notification_status = 'Mã xác nhận không chính xác';
        }

        return redirect(route('login.form'))->with('message', $notification_status);
    }
}
