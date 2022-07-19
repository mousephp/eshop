<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Client;
use App\User;
use PDF;
use Notification;
use Illuminate\Support\Str;
use Auth;

class OrderItemController extends Controller
{
    public function edit($id){
        $orderItem = OrderItem::where('id', $id)->first();

        return view('user.order-item.edit', compact('orderItem'));
    }

    public function update(Request $request, $id){
        $orderItem = OrderItem::where('id', $id)->first();

        if($orderItem){
            $status = $orderItem->update([
                'price'    => $request->price,
                'quantity' => $request->quantity,
                'size'     => $request->size
            ]);

            if($status){
                return redirect()->back()->withInput($request->all())->with('success','Cập nhập sản phẩm trong đơn hàng thành công');
            }

            return redirect()->back()->with('erorr','Cập nhập sản phẩm trong đơn hàng thất bại');   
        }

        return redirect()->back()->with('erorr','Order Item Not Found');   
    }

    public function destroy($id){
        $orderItem = OrderItem::find($id);

        if($orderItem){
            $status = $orderItem->delete();

            if($status){
                return redirect()->back()->with('success','Xóa sản phẩm trong đơn hàng thành công');
            }
            return redirect()->back()->with('erorr','Xóa sản phẩm trong đơn hàng thất bại');          
        }
        
        return redirect()->back()->with('erorr','Order Not Found');
    }


}
