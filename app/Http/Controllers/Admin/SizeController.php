<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\SizeRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Requests\SizeRequest;
use App\Models\Size;
use Log;
use Exception;

class SizeController extends Controller
{
    protected $size;

    public function __construct(SizeRepositoryInterface $size)
    {
        $this->size = $size;
    }

    public function index()
    {
        $sizes = $this->size->all();

        return view('backend.shop.size.index',compact('sizes'));
    }

    public function create()
    {
        return view('backend.shop.size.create');
    }

    public function store(SizeRequest $request)
    {
        try {
            $size = $this->size->create($request->all());
          
            return redirect()->back()->withInput($request->input())->with('success','Thêm thành công');  
        } catch (\Exception $e) {
            Log::error('error(loi):'.$e->getMessage().$e->getLine());
        }
    }

    public function edit($id)
    {
        $size = $this->size->find($id);

        return view('backend.shop.size.edit', compact('size'));
    }

    public function update($id, Request $request)
    {
        try { 
            $size = $this->size->update($id,$request->all());

            return redirect()->back()->withInput($request->input())->with('success','Sửa thành công');  
        } catch (\Exception $e) {
            Log::error('error(loi):'.$e->getMessage().$e->getLine());
        }
    }

    public function destroy($id)
    {
        try {
            $this->size->delete($id);

            return redirect()->back()->with('success','Xóa thành công');  
        } catch (\Exception $e) {
            Log::error('error(loi):'.$e->getMessage().$e->getLine());
        }
    }
}
