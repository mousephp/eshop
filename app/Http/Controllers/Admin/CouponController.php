<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\CouponRepositoryInterface;
use App\Http\Requests\CouponRequest;
use Illuminate\Support\Str;
use App\Models\{ Coupon, couponTag };
use DB;
use Log;
use Exception;
use Storage;

class CouponController extends Controller
{
    protected $coupon;

    public function __construct(CouponRepositoryInterface $coupon)
    {
        $this->coupon = $coupon;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = $this->coupon->all();
        
        return view('backend.shop.coupon.index',compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.shop.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CouponRequest $request)
    {
        try {
            DB::beginTransaction();

            $this->coupon->create([
                'code'   => $request->code,
                'type'   => $request->type,
                'value'  => $request->value,
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
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon = $this->coupon->find($id);

        return view('backend.shop.coupon.edit',compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(CouponRequest $request, $id)
    {
        try {
            DB::beginTransaction();   

            $this->coupon->update($id,[
                'code'   => $request->code,
                'type'   => $request->type,
                'value'  => $request->value,
                'status' => $request->status,
            ]);

            DB::commit();

            return redirect()->route('coupon.index')->with('message','Thêm thành công');  
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('error(loi):'.$exception->getMessage().$exception->getLine());
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->coupon->delete($id);

            return redirect()->back()->with('message','Xóa thành công');
        } catch (\Exception $e) {
            Log::error('error(loi):'.$e->getMessage().$e->getLine());
        }
    }
}
