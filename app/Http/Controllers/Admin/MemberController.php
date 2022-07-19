<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\client;
use Auth;
use Log;
use Exception;
use DB;
use Hash;

class MemberController extends Controller
{
    protected $member;

    public function __construct(Client $member)
    {
        $this->member = $member;
    }

    public function index(){
        $members = $this->member->all();

        return view('backend.manager.member.index')->with('members', $members);
    }

    public function destroy($id)
    {       
        try {  
            $member =  $this->member->findOrFail($id);

            $member->delete($id);

            return redirect()->route('admin.member.index')->with('success','Xóa tài khoản thành công');             
        } catch (Exception $e) {
            Log::error('error(loi):'.$e->getMessage() .$e->getLine());
        }  
    }

    public function accountLockMember($id){
        try {  
            $member =  $this->member->findOrFail($id);

            if ($member) {
                $member->status = 'inactive';

                $member->save();

                return redirect()->route('admin.member.index')->with('success','Khóa account member thành công');             
            }
            
            return redirect()->route('admin.member.index')->with('error','Không tìm thấy tài khoản');    
        } catch (Exception $e) {
            Log::error('error(loi):'.$e->getMessage() .$e->getLine());
        }  
    }
 
    public function openAnAccountMember($id){
        try {  
            $member =  $this->member->findOrFail($id);
            
            if ($member) {
                $member->status = 'active';
                
                $member->save();

                return redirect()->route('admin.member.index')->with('success','Mở khóa account member thành công');             
            }
            
            return redirect()->route('admin.member.index')->with('error','Không tìm thấy tài khoản');    
        } catch (Exception $e) {
            Log::error('error(loi):'.$e->getMessage() .$e->getLine());
        }  
    }
}
