<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\{ FrontendRepositoryInterface, UserRepositoryInterface, PostRepositoryInterface };
use App\Repositories\Contracts\{ CateRepositoryInterface, ProductRepositoryInterface, BannerRepositoryInterface };
use App\Models\{ Banner, Category, Post, Product, Customer, Client };
use App\User;
use Session;
use Illuminate\Support\Str;
use DB;
use Hash;
use Log;
use Exception;
use App\Components\Recusive;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{    
    protected $client;
    protected $user;
    protected $cate;
    protected $post;
    protected $banner;
    protected $product;

    public function __construct(Post $post, User $user, Category $cate, Banner $banner, Product $product)
    {
        $this->user     = $user;
        $this->cate     = $cate;
        $this->product  = $product;
        $this->banner   = $banner;
        $this->post     = $post;
    }


    public function index(Request $request){
        return redirect()->route($request->user()->role);
    }

    public function home(){
        $featured = $this->product->where('status', 'active')->where('is_featured',1)->orderBy('price', 'DESC')->limit(2)->get();

        $posts    = $this->post->where('status', 'active')->orderBy('id', 'DESC')->limit(3)->get();

        $banners  = Banner::where('status', 'active')->limit(3)->orderBy('id', 'DESC')->get();

        $products = $this->product->where('status', 'active')->orderBy('id', 'DESC')->limit(8)->get();

        $category = $this->cate->where('status', 'active')->where('parent_id', null)->orderBy('name','ASC')->get();
        
        $hotItems = $this->product->where('condition', 'hot')->orderBy('id', 'DESC')->limit(8)->get();
       
        return view('frontend.index')
                ->with('featured',$featured)
                ->with('posts',$posts)
                ->with('banners',$banners)
                ->with('product_lists',$products)
                ->with('hot_items',$hotItems)
                ->with('category_lists',$category);
    }   

    public function aboutUs(){
        return view('frontend.pages.about-us');
    }
    
}
