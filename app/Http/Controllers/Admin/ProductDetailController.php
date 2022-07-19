<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ProductDetailRepositoryInterface;
use App\Repositories\Contracts\ColorRepositoryInterface;
use App\Repositories\Contracts\SizeRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Requests\ProductDetailRequest;
use App\Models\{ ProductDetail, Color, Size, Product };
use App\User;
use Log;
use Exception;
use Storage;
use DB;
use Str;
use File;
use Auth;

class ProductDetailController extends Controller
{
    protected $detail;
    protected $color;
    protected $size;

    public function __construct(
        ProductDetailRepositoryInterface $detail,
        ColorRepositoryInterface $color,
        SizeRepositoryInterface $size)
    {
        $this->detail = $detail;
        $this->color  = $color;
        $this->size   = $size;
    }

    public function index()
    {
        $sizes = $this->detail->all();

        return view('backend.shop.detail.index',compact('sizes'));
    }

    public function create()
    {
        return view('backend.shop.detail.create');
    }

    public function store(ProductDetailRequest $request)
    {
        // dd($request->sizes);
        try {
            DB::beginTransaction();          

            $dataDetailCreate = [
                'price'     => $request->price,
                'amount'    => $request->amount,
                'prod_id'   => $request->product,
                'status'    => $request->status,
            ];
            $detail = $this->detail->create($dataDetailCreate);
    
            // Insert colors for product
            $colorIds = [];
            if (!empty($request->colors)) {
                foreach ($request->colors as $colorItem) {
                    // Insert to colors
                    $colorInstance = Color::firstOrCreate(['name' => $colorItem]);
                    $colorIds[]    = $colorInstance->id;
                }
            }
            // dd($colorIds);
            $detail->color()->attach($colorIds);

            // Insert sizes for product
            $sizeIds = [];
            if (!empty($request->sizes)) {
                foreach ($request->sizes as $sizeItem) {
                    $sizeInstance = Size::firstOrCreate(['name' => $sizeItem]);
                    $sizeIds[]    = $sizeInstance->id;
                }
            }
            // dd($sizeIds);
            $detail->size()->attach($sizeIds);

            DB::commit();
            return redirect()->back()->withInput($request->input())->with('success','Thêm thành công');  
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('error(loi):'.$e->getMessage().$e->getLine());
        }
    }

    public function edit($id)
    {
        $detail = $this->detail->find($id);

        return view('backend.shop.detail.edit', compact('detail'));
    }

    public function update($id, Request $request)
    {
        try { 
            $detail = $this->detail->update($id,$request->all());

            return redirect()->back()->withInput($request->input())->with('success','Sửa thành công');  
        } catch (\Exception $e) {
            Log::error('error(loi):'.$e->getMessage().$e->getLine());
        }
    }

    public function destroy($id)
    {
        try {
            $this->detail->delete($id);

            return redirect()->back()->with('success','Xóa thành công');  
        } catch (\Exception $e) {
            Log::error('error(loi):'.$e->getMessage().$e->getLine());
        }
    }
}
