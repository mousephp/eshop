<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\BannerRepositoryInterface;
use App\Http\Requests\BannerRequest;
use Illuminate\Support\Str;
use App\Models\{ Banner, bannerTag };
use DB;
use Log;
use Exception;
use Storage;
use File;
use App\Traits\StorageImageTrait;

class BannerController extends Controller
{
    use StorageImageTrait;

    protected $banner;

    public function __construct(BannerRepositoryInterface $banner)
    {
        $this->banner = $banner;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = $this->banner->all();

        return view('backend.shop.banner.index',compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.shop.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BannerRequest $request)
    {
        try {
            DB::beginTransaction();

            $slug = Str::slug($request->title, '-');     

            $dataBannerCreate = [
                'title'       => $request->title,
                'slug'        => $slug,
                'description' => $request->description,
                'status'      => $request->status,
            ];

            $dataUploadFeatureImage = $this->storageTraitUpload($request, 'photo', 'slide');

            if (!empty($dataUploadFeatureImage)) {
                $dataBannerCreate['photo'] = $dataUploadFeatureImage['file_path'];
            }

            $this->banner->create($dataBannerCreate);

            DB::commit();

            return redirect()->back()->withInput($request->input())->with('message','Thêm thành công');  
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('error(loi):'.$exception->getMessage().$exception->getLine());
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banner = $this->banner->find($id);

        return view('backend.shop.banner.edit',compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(BannerRequest $request, $id)
    {
        try {
            DB::beginTransaction();     

            $slug = Str::slug($request->title, '-');

            $dataBannerUpdate = [
                'title'       => $request->title,
                'slug'        => $slug,
                'description' => $request->description,
                'status'      => $request->status,
            ];

            $dataUploadFeatureImage = $this->storageTraitUpload($request, 'photo', 'slide');

            if (!empty($dataUploadFeatureImage)) {
                //remove image
                $imagePath = public_path($this->banner->find($id)->photo);
                if(File::exists($imagePath)){
                    unlink($imagePath);
                }
                $dataBannerUpdate['photo'] = $dataUploadFeatureImage['file_path'];
            }

            $this->banner->find($id)->update($dataBannerUpdate);
            
            DB::commit();
            
            return redirect()->route('banner.index')->with('message','Sửa thành công');  
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('error(loi):'.$exception->getMessage().$exception->getLine());
        }  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        try {
            $this->banner->delete($id);
        
            return redirect()->back()->with('message','Xóa thành công');
        } catch (\Exception $e) {
            Log::error('error(loi):'.$e->getMessage().$e->getLine());
        }
    }
}
