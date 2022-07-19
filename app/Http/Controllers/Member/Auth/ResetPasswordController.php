<?php

namespace App\Http\Controllers\Member\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use Auth;
use DB;
use Hash;

class ResetPasswordController extends Controller
{
    public function changePassword(){
        return view('user.layouts.userPasswordChange');
    }

    public function changPasswordUpdate(Request $request)
    {

    }
}
