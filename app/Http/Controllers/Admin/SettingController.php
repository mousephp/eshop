<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\SettingRepositoryInterface;
use Illuminate\Support\Str;
use App\Http\Requests\SettingRequest;
use Log;
use Exception;
use App\Models\Setting;
use Storage;
use File;
use App\Traits\StorageImageTrait;
use DB;
 
class SettingController extends Controller
{
    use StorageImageTrait;
    
    protected $setting;

    public function __construct(SettingRepositoryInterface $setting)
    {
        $this->setting = $setting;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = $this->setting->all();
        
        return view('backend.shop.setting.index',compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.shop.setting.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SettingRequest $request)
    {
        try {
            $cate = $this->setting->create([
                'config_key'   => $request->config_key,
                'config_value' => $request->config_value,
                'type'         => $request->type
            ]);

            return redirect()->back()->withInput($request->input())->with('message','Thêm thành công');  
        } catch (Exception $exception) {
            Log::error('error(loi):'.$exception->getMessage().$exception->getLine());
        }  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $setting = $this->setting->find($id);

        return view('backend.shop.setting.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(SettingRequest $request, $id)
    {
        try {
            $setting = $this->setting->update($id,[
                'config_key'   => $request->config_key,
                'config_value' => $request->config_value,
                // 'type'         => $request->type
            ]);

            return redirect()->route('setting.index')->with('message','Sửa thành công');  
        } catch (Exception $exception) {
            Log::error('error(loi):'.$exception->getMessage().$exception->getLine());
        }  
    }

    //=======================================================
    public function editForm()
    {
        $setting = Setting::first();

        return view('backend.shop.setting.setting', compact('setting'));
    }
    
    public function updateSetting(Request $request)
    {
        $this->validate($request,[
            'short_des'   => 'required|string',
            'description' => 'required|string',
            'photo'       => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'logo'        => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'address'     => 'required|string',
            'email'       => 'required|email',
            'phone'       => 'required|string',
        ]);

        try {
            DB::beginTransaction();

            $data     = $request->all();

            $settings = Setting::first();

            $settings->fill($data)->save();

            DB::commit();

            return redirect()->route('settings.update')->with('success','Sửa thành công'); 
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('error(loi):'.$exception->getMessage().$exception->getLine());
        }  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {  
        try {
            $this->setting->delete($id);

            return redirect()->route('setting.index')->with('message','Xóa thành công');
        } catch (\Exception $e) {
            Log::error('error(loi):'.$e->getMessage().$e->getLine());
        }
    }

}
