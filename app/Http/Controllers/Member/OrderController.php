<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{ Cart, Order, OrderItem, Client };
use App\User;
use PDF;
use Notification;
use Helper;
use Illuminate\Support\Str;
use Auth;

class OrderController extends Controller
{
    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function index()
    {
        $orders = $this->order->orderBy('id','DESC')->where('client_id', Auth::guard('client')->user()->id)->paginate(10);
        
        return view('user.order.index')->with('orders',$orders);
    }

    public function orderShow($id)
    {
        $order = $this->order->findOrFail($id);

        // $orderItems = OrderItem::where('order_id', $id)->get();

        if($order){
            return view('user.order.show', compact('order'));
        }
        
        return abort(404);
    }

    public function orderDelete($id)
    {
        $order = $this->order->findOrFail($id);

        if($order){
            $status = $order->delete();
            
            if($status){
                return redirect()->back()->with('success','Xóa đơn hàng thành công');
            }
            
            return redirect()->back()->with('erorr','Xóa đơn hàng thất bại');          
        }
        
        return redirect()->back()->with('erorr','Order Not Found');
    }

    
    public function orderTrack(){
        return view('frontend.pages.order-track');
    }

    //nhập ID đơn hàng Để theo dõi đơn hàng
    public function productTrackOrder(Request $request){
        $order = $this->order->where('client_id', Auth::guard('client')->user()->id)->where('order_number',$request->order_number)->first();

        if($order){
            if($order->order_status == "new"){
                return redirect()->route('home')->with('success','Your order has been placed. please wait.');
            }elseif($order->order_status == "process"){
                return redirect()->route('home')->with('success','Your order is under processing please wait.');
            }elseif($order->order_status == "delivered"){
                return redirect()->route('home')->with('success','Your order is successfully delivered.');  
            }else{
                return redirect()->route('home')->with('error','Your order canceled. please try again');
            }
        }

        return back()->with('error','Invalid order numer please try again');
    }

    public function exportPdf($id){
        $order = $this->order->where('id', $id)->first();

        $pdf = PDF::loadView('user.order.pdf', compact('order'));

        return $pdf->download('pdf_file.pdf');
    }

    public function exportExcel(){

    }

}
