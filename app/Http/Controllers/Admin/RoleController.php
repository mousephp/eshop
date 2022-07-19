<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use App\Repositories\Contracts\RoleRepositoryInterface;
use App\Repositories\Contracts\PermissionRepositoryInterface;
use Illuminate\Support\Facades\Gate;
use App\Models\{ Role, Permission };
use DB;
use Auth;

class RoleController extends Controller
{
    protected $role;
    protected $permission;
   
    public function __construct(RoleRepositoryInterface $role, PermissionRepositoryInterface $permission){
        $this->role       = $role;
        $this->permission = $permission;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->role->all();

        return view('backend.manager.role.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions       = $this->permission->all();

        $permissionsParent = Permission::where('parent_id', 0)->get();

        return view('backend.manager.role.create', compact('permissions','permissionsParent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        try {
            DB::beginTransaction();

            $role = $this->role->create([
                'name'         => $request->name,
                'display_name' => $request->display_name
            ]);

            $role->permissions()->attach($request->permission);

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
        $role = $this->role->find($id);

        return view('backend.manager.role.show',compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role                   = $this->role->find($id);
        $permissions            = $this->permission->all();

        $permissionsParent = Permission::where('parent_id', 0)->get();

        $pemissionsChecked = $role->permissions;

        return view('backend.manager.role.edit',compact('pemissionsChecked','permissionsParent','permissions','role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        try {
            DB::beginTransaction();   

            $role = $this->role->update($id,[
                'name'         => $request->name,
                'display_name' => $request->display_name
            ]);

            DB::table('permission_roles')->where('role_id',$id)->delete();

            $roleCreate = $this->role->find($id);

            $roleCreate->permissions()->sync($request->permission);           
           
            DB::commit();

            return redirect()->route('role.index')->with('message','Sửa thành công');
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
        try {
            DB::beginTransaction();

            $role = $this->role->find($id);

            $role->delete($id);

            $role->permission()->detach();
            
            DB::commit();

            return redirect()->back()->with(['message' => 'Xóa thành công']);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('error(loi):'.$exception->getMessage() .$exception->getLine());
        }       
    }

}
