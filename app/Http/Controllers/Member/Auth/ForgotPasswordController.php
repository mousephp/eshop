<?php

namespace App\Http\Controllers\Member\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use Carbon\Carbon;
use Mail;
use App\Models\Client;

class ForgotPasswordController extends Controller
{
    public function getEmailForm()
    {
        return view('user.auth.forgot-password');
    }

    public function postEmail(Request $request)
    {

    }
}
