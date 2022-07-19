<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\BrandRepositoryInterface;
use Illuminate\Support\Str;
use App\Http\Requests\BrandRequest;
use Log;
use Exception;
use App\Models\Brand;

class BrandController extends Controller
{
    protected $brand;

    public function __construct(BrandRepositoryInterface $brand)
    {
        $this->brand = $brand;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = $this->brand->all();

        return view('backend.shop.brand.index',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.shop.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request)
    {
        try {
            $brand_slug = Str::slug($request->name, '-');

            $brand = $this->brand->create([
                'name'   => $request->name,
                'slug'   => $brand_slug,
                'status' => $request->status,
            ]);

            return redirect()->back()->withInput($request->input())->with('message','Thêm thành công');  
        } catch (Exception $exception) {
            Log::error('error(loi):'.$exception->getMessage().$exception->getLine());
        }     
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = $this->brand->find($id);

        return view('backend.shop.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(BrandRequest $request, $id)
    {
        try {
            $brand_slug = Str::slug($request->name, '-');

            $cate = $this->brand->update($id,[
                'name'   => $request->name,
                'slug'   => $brand_slug,
                'status' => $request->status,
            ]);

            return redirect()->route('brand.index')->with('message','Sửa thành công');  
        } catch (Exception $exception) {
            Log::error('error(loi):'.$exception->getMessage().$exception->getLine());
        }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
        try {
            $this->brand->delete($id);
        
            return redirect()->route('brand.index')->with('message','Xóa thành công');
        } catch (\Exception $e) {
            Log::error('error(loi):'.$e->getMessage().$e->getLine());
        }
    }

}
