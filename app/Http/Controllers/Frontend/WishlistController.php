<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\WishlistRepositoryInterface;
use App\Models\{ Wishlist, Product };
use Illuminate\Http\Request;
use Auth;

class WishlistController extends Controller
{
    protected $product = null;
    protected $wishlist = null;
    
    public function __construct(Product $product, Wishlist $wishlist){
        $this->product = $product;
        $this->wishlist = $wishlist;
    }

    public function wishlist(Request $request){
        if (empty($request->slug)) {
            return back()->with('error', 'Invalid Products');
        }        

        $product = $this->product->where('slug', $request->slug)->first();

        if (empty($product)) {
            return back()->with('error', 'Invalid Products');
        }

        $already_wishlist = $this->wishlist->where('user_id', Auth::guard('client')->user()->id)->where('cart_id', null)->where('prod_id', $product->id)->first();
        
        if($already_wishlist) {
            return back()->with('error', 'You already placed in wishlist');
        }else{
            $wishlist = new Wishlist;

            $wishlist->user_id  = Auth::guard('client')->user()->id;
            $wishlist->prod_id  = $product->id;
            $wishlist->price    = ($product->price - ($product->price * $product->discount)/100);
            $wishlist->quantity = 1;
            $wishlist->amount   = $wishlist->price * $wishlist->quantity;

            //false
            if ($wishlist->product->stock < $wishlist->quantity || $wishlist->product->stock <= 0) {
                return back()->with('error','Stock not sufficient!.');
            }

            $wishlist->save();
        }

        return back()->with('success', 'Product successfully added to wishlist');
    }  
    
    public function wishlistDelete(Request $request){
        $wishlist = $this->wishlist->findOrFail($request->id);

        if ($wishlist) {
            $wishlist->delete();     
                  
            return back()->with('success', 'Wishlist successfully removed');
        }

        return back()->with('error', 'Error please try again');
    }     

}
