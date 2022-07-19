<?php
use Illuminate\Support\Facades\Auth;
use App\Models\{ Message, Category, PostTag, PostCate, Order};
use App\Models\{ Wishlist, Shipping, Cart, Product, Setting };
// use Route;

class Helper{
    private $htmlSlelect = '';

    public static function getRoute(){
        $route = Route::current()->uri;

        return $route;
    }

    public static function getMenuMultiple(){ 
        $parentCategories = Category::where('status','active')->where('parent_id',NULL)->get();
        
        return $parentCategories;
    } 

    public static function getAllParentWithChild(){  
        return Category::with('child_cat')->where('parent_id',null)->where('status','active')->orderBy('name','ASC')->get();
    }
    
    public static function getAllCategory(){ 
        return static::getAllParentWithChild();
    } 
    
    
    public static function getSetting(){ 
        return Setting::all();
    } 
 
    public static function postTagList($option = 'all'){ 
        if($option = 'all'){
            return PostTag::orderBy('id','desc')->get();
        }

        return PostTag::has('posts')->orderBy('id','desc')->get();
    }

    public static function postCategoryList($option = "all"){ 
        if($option = 'all'){
            return PostCate::orderBy('id','DESC')->get();
        }

        return PostCate::has('posts')->orderBy('id','DESC')->get();
    }

    // Wishlist Count
    public static function wishlistCount($user_id = ''){ 
        if(Auth::guard('client')->user()->name){
            if($user_id == ""){ 
                $user_id=Auth::guard('client')->user()->id;
            }

            return Wishlist::where('user_id',$user_id)->where('cart_id',null)->sum('quantity');
        }
        
        return 0;
    }

    public static function getAllProductFromWishlist($user_id = ''){ 
        if(isset(Auth::guard('client')->user()->name)){
            if($user_id == ""){
                $user_id = Auth::guard('client')->user()->id;
            } 

            return Wishlist::with('product')->where('user_id',$user_id)->where('cart_id',null)->get();
        }
        
        return [];
    }

    public static function totalWishlistPrice($user_id = ''){ 
        if(isset(Auth::guard('client')->user()->name)){
            if($user_id == "") {
                $user_id = Auth::guard('client')->user()->id;
            };

            return Wishlist::where('user_id',$user_id)->where('cart_id',null)->sum('amount');
        }

        return 0;
    }

}

?>