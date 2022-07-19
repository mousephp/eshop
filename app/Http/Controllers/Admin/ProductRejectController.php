<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ProductRejectRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRejectRequest;
use App\Models\ProductReject;
use App\User;
use Log;
use Exception;
use Storage;
use DB;
use Str;
use File;
use Auth;

class ProductRejectController extends Controller
{
    protected $reject;

    public function __construct(ProductRejectRepositoryInterface $reject)
    {
        $this->reject = $reject;
    }

    public function index()
    {
        $rejects = $this->reject->all();

        return view('backend.shop.reject.index',compact('rejects'));
    }

    public function create()
    {
        return view('backend.shop.reject.create');
    }

    public function store(ProductRejectRequest $request)
    {
        try {
            $this->reject->create($request->all());
          
            return redirect()->back()->withInput($request->input())->with('success','Thêm thành công');  
        } catch (\Exception $e) {
            Log::error('error(loi):'.$e->getMessage().$e->getLine());
        }
    }

    public function edit($id)
    {
        $reject = $this->reject->find($id);

        return view('backend.shop.reject.edit', compact('reject'));
    }

    public function update($id, Request $request)
    {
        try { 
            $reject = $this->reject->update($id,$request->all());

            return redirect()->back()->withInput($request->input())->with('success','Sửa thành công');  
        } catch (\Exception $e) {
            Log::error('error(loi):'.$e->getMessage().$e->getLine());
        }
    }

    public function destroy($id)
    {
        try {
            $this->reject->delete($id);

            return redirect()->back()->with('success','Thêm thành công');  
        } catch (\Exception $e) {
            Log::error('error(loi):'.$e->getMessage().$e->getLine());
        }
    }
}
