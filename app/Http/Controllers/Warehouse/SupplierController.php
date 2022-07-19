<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Http\Requests\SupplierRequest;

class SupplierController extends Controller
{
    protected $supplier;

    public function __construct(Supplier $supplier)
    {
        $this->supplier = $supplier;
    }

    public function index()
    {
        $suppliers = $this->supplier->all();
        
        return view('backend.warehouse.supplier.index', compact('suppliers'));
    }

    public function create()
    {
        return view('backend.warehouse.supplier.create');
    }

    public function store(SupplierRequest $request)
    {
        try {
            $this->supplier->create($request->all());

            return redirect()->back()->withInput($request->input())->with('success', 'Thêm thành công');
        } catch (Exception $exception) {
            Log::error('error(loi):' . $exception->getMessage() . $exception->getLine());
        }
    }

    public function edit($id)
    {
        $supplier = $this->supplier->find($id);

        return view('backend.warehouse.supplier.edit', compact('supplier'));
    }

    public function update(SupplierRequest $request, $id)
    {
        try {
            $this->supplier->where('id',$id)->update($request->except(['_token', '_method']));

            return redirect()->route('supplier.index')->with('success', 'Sửa thành công');
        } catch (Exception $exception) {
            Log::error('error(loi):' . $exception->getMessage() . $exception->getLine());
        }
    }

    public function destroy($id)
    {
        try {
            $this->supplier->destroy($id);

            return redirect()->route('supplier.index')->with('success', 'Xóa thành công');
        } catch (\Exception $e) {
            Log::error('error(loi):'.$e->getMessage().$e->getLine());
        }
    }
}
