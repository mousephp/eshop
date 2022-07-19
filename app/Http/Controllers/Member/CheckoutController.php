<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Models\{ District, Province, Ward, Product, Order, OrderItem, Feeship };
use Cart;
use Session;
use DB;
use Hash;
use Log;
use Exception;
use Mail;
use Auth;
use App\Jobs\OrderJob;

class CheckoutController extends Controller
{
    protected $province;
    protected $order;
    protected $feeship;
    protected $product;

    public function __construct(Product $product, Province $province, Feeship $feeship, Order $order)
    {
        $this->province = $province;
        $this->product  = $product;
        $this->order    = $order;
        $this->feeship  = $feeship;
    }

    public function getCheckout(){
        $data['provinces'] = $this->province->get(["name", "id"]);

        return view('frontend.pages.checkout', $data);
    }

    public function placeOrder(Request $request)
    {
        $cart = Cart::count();
        
        if(empty($cart)){
            return redirect()->back()->with('status', 'Không có sản phẩm nào trong giỏ hàng');
        }

        try {
            DB::beginTransaction();
            
            $order = $this->order->create([                
                'order_number'   => 'ORD-'.strtoupper(uniqid()),
                'client_id'      => Auth::guard('client')->user()->id,
                'full_name'      => $request->full_name,
                'address'        => $request->address,
                'phone'          => $request->phone,
                'email'          => $request->email,
                'total_amount'   => Cart::total(),
                'quantity'       => Cart::count(),
                'payment_method' => $request->payment_method,  
                // 'product_feeship' => 20000,  
                'coupon'         => $request->coupon,   
                'province_id'    => $request->province,
                'district_id'    => $request->district,
                'ward_id'        => $request->ward,     
                'shipping_address' => $request->shipping_address,     
            ]);
            
            if ($order) {
                $items = Cart::content();
                
                foreach ($items as $item){
                    $product = $this->product->where('title', $item->name)->first();
        
                    $orderItem = new OrderItem([
                        'prod_id'  => $product->id,
                        'quantity' => $item->qty,
                        'price'    => $product->price,
                        'size'     => $item->options->size
                    ]);

                    $product->update(['stock' => $product->stock - $item->qty]);
        
                    $order->orderItem()->save($orderItem);
                }
            }   

            #Queue
			// OrderJob::dispatch($request->input('email'))->delay(now()->addSeconds(2));

            //clear cart
            Cart::destroy();

            DB::commit();
            
            return redirect()->back()->withInput($request->input())->with('success', 'Order thành công');
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('error(loi):'.$exception->getMessage(). '- line ' .$exception->getLine());
        }         
    }


    public function feeship(Request $request){ //(-)
        $data = $request->all();
        
        if($data['fee_province']){
            $feeship = $this->feeship->where('code_province',$data['province'])->where('code_district', $data['district'])->where('code_ward',$data['ward'])->get();
            
            if($feeship){
                $count_feeship = $feeship->count();
                if($count_feeship > 0){
                     foreach($feeship as $key => $fee){
                        Session::put('feeship',$fee->fee_feeship);
                        Session::save();
                    }
                }else{ 
                    Session::put('feeship',25000);
                    Session::save();
                }
            }
        }
    }

    public function deleteFeeship(){ //(-)
        Session::forget('feeship');
        
        return redirect()->back();
    }


}
//https://laracasts.com/discuss/channels/general-discussion/how-to-add-delivery-charge-to-laravel-shopping-cart