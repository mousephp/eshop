<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\{ Product, Coupon };
use DB;
use Hash;
use Log;
use Exception;
use Auth;
use Cart;

class CartController extends Controller
{
    protected $coupon;
    protected $product;
   
    public function __construct(Product $product, Coupon $coupon)
    {
        $this->product  = $product;
        $this->coupon   = $coupon;
    }

    public function index()
    {
        $data['total'] = Cart::total();

        $data['items'] = Cart::content();

        return view('frontend.pages.cart',$data);
    }

    public function store(Request $request, $id)
    {
        try {
            DB::beginTransaction();
  
            $product = $this->product->where('id',$id)->first();

            $qty = 0;
            if($request->isMethod('get')){
                $qty = 1;
            }

            $size = '';
            if(empty($request->size)){
                $size = 'M';
            }
            
            $stock       = $qty ? $qty : $request->quant[1];

            $sizeProduct = $size ? $size : $request->size;

            if($qty == 0 && $request->quant[1] <= 0){
                request()->session()->flash('error', 'Số lượng sản phẩm không được < 0');

                return redirect()->back();     
            }
                
            if($product){
                if($request->quant[1] < $product->quantity){
                    $item = Cart::add([
                        'id' => $id, 'name' => $product->title, 'qty' => $stock, 'price' => $product->price, 'weight' => 0, 
                        'options' => [
                            'img' => $product->feature_image_path, 
                            'size' => $sizeProduct
                        ]
                    ]);

                    return redirect()->route('cart.index')->with('success','Thêm sản phẩm giở hàng thành công'); 
                }
            }

            DB::commit();

            return redirect()->back()->with('error', 'Số lượng sản phẩm không đủ');
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('error(loi):'.$exception->getMessage() .$exception->getLine());
        }  
    }
   
    public function show($id)
    {
        $item = Cart::get($rowId);

        return view('client.cart', $item);
    }

    public function find($id)
    {
        $item = Cart::get($rowId);        
    }

    public function updateSize(Request $request)
    {   
        $product = $this->product->where('id',$request->productId)->first();

        if($request->size && $product){
            $status = Cart::update($request->rowId, [
                'options'  => [
                        'size' => $request->size, 'img' => $product->feature_image_path
                    ]
                ]
            );

            if($status){
                return response()->json(true);
            }

            return response()->json(false);
        }
        
        return response()->json(false);
    }

    public function updateQuantity(Request $request)
    {  
        $productId = $this->product->where('id', $request->productId)->first();

        if ($productId) {          
            if($request->quant > $productId->quantity){               
                return response()->json(false);       
            }

            Cart::update($request->rowId, $request->quant);  

            request()->session()->flash('success','Cập nhập giở hàng thành công');
            
            return response()->json(true);
        }    

        return response()->json(false);
    }

    public function updateAll(Request $request){ //(?)
        if(empty($request->quantity)){
             return redirect()->back()->with('error','Không có bản ghi nào được chọn');
        }

        $multiple = $this->updateAllResult($request->quantity, $request->rowId);

        if($multiple){
            return redirect()->back()->with('success','Update multiple thành công');
        }
        
        return redirect()->back()->with('error','Update multiple thất bại');
    }

    public function findId($ids){ //(?)
        return $this->product->findOrFail($ids);
    }

    public function updateAllResult($qtys, $rowIds){ //(?)
        $resultQty = $this->findId($qtys);

        if (!empty($resultQty)) {
            foreach ($qtys as $key => $qty) {
                Cart::update($rowIds[$key], $qty);                 
            }

            return true;
        }

        return false;       
    }

    public function remove($id)
    {
        if ($id === 'all') {
			Cart::destroy();

            return back()->with('success', 'Xóa giở hàng thành công');
		}

        $delItem = Cart::remove($id);
        if ($delItem) {
            return back()->with('success', 'Xóa sản phẩm trong giở hàng thành công');   
        }
        
        return back()->with('error', 'Xóa sản phẩm trong giở hàng không thành công');   
    }

    public function checkCoupon(Request $request)
    {
        $this->validate($request,[
            'coupon' => 'required'
        ]);

        $coupon = $this->coupon->where('code', $request->coupon)->first();
        if(!$coupon){
            return back()->with('error', 'Invalid coupon code. Please try again.');
        }
    
        $cou[] = array(
            'code'     => $coupon->code,
            'type'     => $coupon->type,
            'value'    => $coupon->value,
        );
        Session::put('coupon',$cou);
        Session::save();

        return redirect()->back()->with('message', 'Coupon has been applied!');    
    }
  
}
