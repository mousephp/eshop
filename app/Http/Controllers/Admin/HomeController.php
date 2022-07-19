<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;
use DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index(){
        $chartUser = $this->chartUser();

        return view('backend.index')->with('year',json_encode($chartUser[0],JSON_NUMERIC_CHECK))->with('user',json_encode($chartUser[1],JSON_NUMERIC_CHECK));
    }

    public function logout(){
		Auth::logout();
        
		return redirect()->route('login');
	}

    public function profile(){
        $profile = Auth::user();

        return view('backend.profile.profile')->with('profile', $profile);
    }

    public function profileUpdate(Request $request,$id){
        $user   = User::findOrFail($id);
        $data   = $request->all();
        $status = $user->fill($data)->save();

        if($status){
            return redirect()->back()->with('success','Successfully updated your profile');
        }

        return redirect()->back()->with('error','Please try again!');
    }

    public function chartUser (){
        $year = ['2015','2016','2017','2018','2019','2020'];

        $user = [];
        foreach ($year as $key => $value) {
            $user[] = User::where(\DB::raw("DATE_FORMAT(created_at, '%Y')"),$value)->count();
        }

        $arrUser = [$year, $user];

        return $arrUser;
    }
}
