<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\ShippingRepositoryInterface;
use App\Http\Requests\ShippingRequest;
use App\Models\Shipping;
use Log;
use Exception;
use DB;

class ShippingController extends Controller
{
    protected $shipping;

    public function __construct(ShippingRepositoryInterface $shipping)
    {
        $this->shipping = $shipping;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shippings = $this->shipping->all();

        return view('backend.shop.shipping.index',compact('shippings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.shop.shipping.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShippingRequest $request)
    {
        try {
            DB::beginTransaction();

            $shipping = $this->shipping->create([
                'type'   => $request->type,
                'price'  => $request->price,
                'status' => $request->status,
            ]);

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
     * @param  \App\Models\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function show(Shipping $shipping)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shipping = $this->shipping->find($id);

        return view('backend.shop.shipping.edit',compact('shipping'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function update(ShippingRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $shipping = $this->shipping->update($id,[
                'type'   => $request->type,
                'price'  => $request->price,
                'status' => $request->status,
            ]);
            
            DB::commit();
            
            return redirect()->route('shipping.index')->with('message','Sửa thành công');  
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('error(loi):'.$exception->getMessage().$exception->getLine());
        }  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->shipping->delete($id);
            
            return redirect()->back()->with('message','Xóa thành công');
        } catch (\Exception $e) {
            Log::error('error(loi):'.$e->getMessage().$e->getLine());
        }
    }

}
