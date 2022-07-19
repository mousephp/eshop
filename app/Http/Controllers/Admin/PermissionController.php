<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PermissionRequest;
use App\Repositories\Contracts\PermissionRepositoryInterface;
use Illuminate\Support\Str;
use App\User;
use App\Models\Permission;
use Log;
use Exception;
use DB;
use App\Components\Recusive;

class PermissionController extends Controller
{
    protected $permission;
    
    public function __construct(PermissionRepositoryInterface $permission)
    {
        $this->permission = $permission;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = $this->permission->all();

        return view('backend.manager.permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $htmlOption = $this->getPermission($parentId = '');

        return view('backend.manager.permission.create',compact('htmlOption'));
    }

    public function createTemplate()
    {
        $configTableModule     = config('permissions.table_module');
        $configModuleChildrent = config('permissions.module_childrent');
        
        return view('backend.manager.permission.createTemPlate',compact('configTableModule','configModuleChildrent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        try {
            DB::beginTransaction();

            $permission = $this->permission->create([
                'name'         => $request->name,
                'display_name' => $request->display_name,
                'parent_id'    => $request->parent_id,
                'key_code'     => $request->key_code,
            ]);
            
            DB::commit();

            return redirect()->back()->withInput($request->input())->with('message','Thêm thành công');
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('error(loi):'.$exception->getMessage() .$exception->getLine());
        }         
    }

    public function getPermission($parentId)
    {
        $data       = $this->permission->all();

        $recusive   = new Recusive($data);

        $htmlOption = $recusive->permissionRecusive($parentId);

        return $htmlOption;
    }

    public function createTemplateDataPermission(Request $request)
    {
        try {
            $pemission = Permission::create([
                'name'         => $request->module_parent,
                'display_name' => $request->module_parent,
                'parent_id'    => 0
            ]);
    
            foreach ($request->module_chilrent as $value) {
                Permission::create([
                    'name'         => $value,
                    'display_name' => $value,
                    'parent_id'    => $pemission->id,
                    'key_code'     => $request->module_parent . '_' . $value
                ]);
            }

            return redirect()->back()->withInput($request->input())->with('message','Thêm dữ liệu mẫu thành công');
        } catch (Exception $exception) {
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
        $permission = $this->permission->find($id);
        return view('backend.manager.permission.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = $this->permission->find($id);

        $htmlOption = $this->getPermission($permission->parent_id);

        return view('backend.manager.permission.edit',compact('permission','htmlOption'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $permission = $this->permission->update($id,[
                'name'         => $request->name,
                'display_name' => $request->display_name,
                'parent_id'    => $request->parent_id
            ]);

            $permissions = $this->permission->all();
            
            foreach ($permissions as $key => $value) {
               if ($value->id == $request->parent_id) {
                    $this->permission->update($id,[
                        'key_code' => $value->name.'_'.$request->name,
                    ]);
                    break;
               } 
            }
            
            DB::commit();

            return redirect()->route('permission.index')->with('message','Sửa thành công');
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
            $this->permission->delete($id);
        
            return redirect()->back()->with(['message' => 'Xóa thành công']);
        } catch (\Exception $e) {
            Log::error('error(loi):'.$e->getMessage().$e->getLine());
        }
    }
}
