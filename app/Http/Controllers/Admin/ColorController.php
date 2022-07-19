<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ColorRepositoryInterface;
use App\Http\Requests\ColorRequest;
use App\Models\Color;
use Exception;
use Log;
use DB;

class ColorController extends Controller
{
    protected $color;

    public function __construct(ColorRepositoryInterface $color)
    {
        $this->color = $color;
    }

    public function index()
    {
        $colors = $this->color->all();

        return view('backend.shop.color.index',compact('colors'));
    }

    public function create()
    {
        return view('backend.shop.color.create');
    }

    public function store(ColorRequest $request)
    {
        try {
            $color = $this->color->create($request->all());
          
            return redirect()->back()->withInput($request->input())->with('success','Thêm thành công');  
        } catch (\Exception $e) {
            Log::error('error(loi):'.$e->getMessage().$e->getLine());
        }
    }

    public function edit($id)
    {
        $color = $this->color->find($id);

        return view('backend.shop.color.edit', compact('color'));
    }

    public function update($id, ColorRequest $request)
    {
        try {
            DB::beginTransaction();
 
            $color = $this->color->update($id, $request->all());

            // $productId = $request->get('product_id', []);
            // if ($productId) {
            //     $color->products()->sync($productId);
            // }
          
            DB::commit();
            
            return redirect()->back()->withInput($request->input())->with('success','Sửa thành công');  
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('error(loi):'.$e->getMessage().$e->getLine());
        }
    }

    public function destroy($id)
    {
        try {
            $this->color->delete($id);

            return redirect()->back()->with('success','Xóa thành công');  
        } catch (\Exception $e) {
            Log::error('error(loi):'.$e->getMessage().$e->getLine());
        }
    }

}
