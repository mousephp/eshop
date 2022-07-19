<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\EditUserRequest;
use App\Http\Requests\SetPasswordIdRequest;
use App\Repositories\Contracts\{ UserRepositoryInterface, RoleRepositoryInterface };
use Illuminate\Support\Facades\Gate;
use App\Models\{Role, Permission, RoleUser };
use App\User;
use Auth;
use Log;
use Exception;
use DB;
use Hash;

class UserController extends Controller
{
    protected $user;
    protected $role;
    
    public function __construct(UserRepositoryInterface $user, RoleRepositoryInterface $role){
        $this->user = $user;
        $this->role = $role;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->user->all();

        return view('backend.manager.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->role->all();

        return view('backend.manager.user.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddUserRequest $request)
    {
        try {
            DB::beginTransaction();

            $user = $this->user->create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password)
            ]);

            $user->role()->attach($request->roles);

            DB::commit();

            return redirect()->back()->withInput($request->input())->with('message','Thêm thành công');
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('error(loi):'.$exception->getMessage() .$exception->getLine());
        }      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {       
        $user = $this->user->find($id);

        return view('backend.manager.user.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {     
        $user           = $this->user->find($id);

        $roles          = $this->role->all();

        $listRoleOfUser = RoleUser::where('user_id',$id)->pluck('role_id'); //or $listRoleOfUser  = $user->role;

        return view('backend.manager.user.edit',compact('roles','user','listRoleOfUser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditUserRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            //attach
            $user  = $this->user->find($id);
            
            $result = $this->user->update($id,[
                'name'  => $request->name,
                'email' => $request->email        
            ]);

            DB::table('role_users')->where('user_id',$id)->delete();

            $user->role()->attach($request->roles);//sync                   

            //change password follow id
            $data = $request->all(); 

            if(!\Hash::check($data['user_password'], $user->password)){
                return redirect()->route('user.index')->with('error','Bạn đã nhập sai mật khẩu cũ');
            }else{
                $this->user->update($id,['password'=> Hash::make($request->user_password_new)]);
            } 

            DB::commit();

            return redirect()->route('user.index')->with('message','Cập nhâp tài khoản thành công');  
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('error(loi):'.$exception->getMessage() .$exception->getLine());
        }       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {       
        $user = $this->user->find($id);

        try {             
            DB::beginTransaction();

            $user->delete($id);

            $user->role()->detach();

            DB::commit();

            return redirect()->route('user.index')->with('message','Xóa tài khoản thành công');             
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('error(loi):'.$exception->getMessage() .$exception->getLine());
        }  
    }

    public function getUpdatePasswordId()
    {
        return view('backend.manager.user.update-password');
    }

    public function postUpdatePasswordId(SetPasswordIdRequest $request)
    {
        $data = $request->all(); 
        
        $user = $this->user->find(auth()->user()->id);

        if(!\Hash::check($data['user_password'], $user->password)){
            return redirect()->back()->with('error','Bạn đã nhập sai mật khẩu cũ');
        }
                
        $this->user->updateId($user->id,[
            'password'=> bcrypt($request->user_password_new)
        ]);
        
        return redirect()->back()->with('message','Cập nhâp mật khẩu thành công'); 
    }
    
}

