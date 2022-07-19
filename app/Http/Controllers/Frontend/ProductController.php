<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Repositories\Contracts\{ CateRepositoryInterface, BrandRepositoryInterface, TagsRepositoryInterface };
use App\Repositories\Contracts\{ ProductRepositoryInterface, BannerRepositoryInterface };
use App\Models\{ Banner, Tag, Product, Category, Post, Cart, Brand };
use App\User;
use Session;
use DB;
use Hash;
use Log;
use Exception;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    protected $cate;
    protected $brand;
    protected $tag;
    protected $banner;
    protected $product;

    public function __construct(Category $cate, Brand $brand, Tag $tag, Banner $banner, Product $product)
    {
        $this->cate     = $cate;
        $this->brand    = $brand;
        $this->tag      = $tag;
        $this->product  = $product;
        $this->banner   = $banner;
    }

    public function productDetail($slug){
        $product_detail = $this->product->getProductBySlug($slug);

        return view('frontend.pages.product_detail')->with('product_detail', $product_detail);
    }

    public function productBrands(){
        return $this->brand->orderBy('name','ASC')->where('status','active')->get();

    }

    public function productGrids(){
        $products = $this->product->query();
        
        // if(!empty($_GET['category'])){
        //     $slug    = explode(',', $_GET['category']);
        //     $cat_ids = $this->cate->select('id')->whereIn('slug', $slug)->pluck('id')->toArray();

        //     $products->whereIn('cat_id', $cat_ids);
        // }
        // if(!empty($_GET['brand'])){
        //     $slugs     = explode(',', $_GET['brand']);
        //     $brand_ids = $this->brand->select('id')->whereIn('slug', $slugs)->pluck('id')->toArray();
        //     return $brand_ids;

        //     $products->whereIn('brand_id', $brand_ids);
        // }
        // if(!empty($_GET['sortBy'])){
        //     if($_GET['sortBy'] == 'title'){
        //         $products = $products->where('status','active')->orderBy('title','ASC');
        //     }

        //     if($_GET['sortBy'] == 'price'){
        //         $products = $products->orderBy('price','ASC');
        //     }
        // }

        // if(!empty($_GET['price'])){
        //     $price = explode('-', $_GET['price']);
        //     $products->whereBetween('price', $price);
        // }

        $recent_products = $this->product->where('status','active')->orderBy('id','DESC')->limit(3)->get();

        // Sort by number
        if(!empty($_GET['show'])){
            $products = $products->where('status', 'active')->paginate($_GET['show']);
        }else{
            $products = $products->where('status', 'active')->paginate(9);
        }

        // Sort by name , price, category
        return view('frontend.pages.product-grids')
                ->with('products', $products)
                ->with('recent_products', $recent_products)
                ->with('brands', $this->productBrands());
    }

    public function productLists(){
        // dd($_GET['category']);
        $products = $this->product->query();
        
        // if(!empty($_GET['category'])){
        //     $slug    = explode(',',$_GET['category']);
        //     $cat_ids = $this->cate->select('id')->whereIn('slug', $slug)->pluck('id')->toArray();
        //     $products->whereIn('cat_id',$cat_ids)->paginate;
        // }

        // if(!empty($_GET['brand'])){
        //     $slugs     = explode(',', $_GET['brand']);
        //     $brand_ids = $this->brand->select('id')->whereIn('slug', $slugs)->pluck('id')->toArray();
        //     return $brand_ids;
        //     $products->whereIn('brand_id',$brand_ids);
        // }

        if(!empty($_GET['sortBy'])){
            if($_GET['sortBy'] == 'title'){
                $products = $products->where('status', 'active')->orderBy('title','ASC');
            }
            
            if($_GET['sortBy'] == 'category'){
                $products = $products->with('category')->where('status', 'active')->orderBy('title','DESC');
            }
            
            if($_GET['sortBy'] == 'brand'){
                $products = $products->with('brand')->where('status', 'active')->orderBy('title','DESC');
            }

            if($_GET['sortBy']=='price'){
                $products = $products->orderBy('price', 'ASC');
            }
        }

        // if(!empty($_GET['price'])){
        //     $price = explode('-',$_GET['price']);

        //     $products->whereBetween('price',$price);
        // }

        $recent_products = $this->product->where('status', 'active')->orderBy('id', 'DESC')->limit(3)->get();

        // Sort by number
        if(!empty($_GET['show'])){
            $products = $products->where('status', 'active')->paginate($_GET['show']);
        }else{
            $products = $products->where('status', 'active')->paginate(6);
        }
        // Sort by name , price, category

        return view('frontend.pages.product-lists')
                    ->with('products',$products)
                    ->with('recent_products',$recent_products)
                    ->with('brands',$this->productBrands());
    }

    public function productFilter(Request $request){
        $data = $request->all();

        // dd($data);

        $showURL = "";
        if(!empty($data['show'])){
            $showURL .= '&show='.$data['show'];
        }

        $sortByURL = '';
        if(!empty($data['sortBy'])){
            $sortByURL .= '&sortBy='.$data['sortBy'];
        }

        $catURL = "";
        // if(!empty($data['category'])){
        //     foreach($data['category'] as $category){
        //         if(empty($catURL)){
        //             $catURL .= '&category='.$category;
        //         }else{
        //             $catURL .= ','.$category;
        //         }
        //     }
        // }

        $brandURL = "";
        // if(!empty($data['brand'])){
        //     foreach($data['brand'] as $brand){
        //         if(empty($brandURL)){
        //             $brandURL .= '&brand='.$brand;
        //         }else{
        //             $brandURL .= ','.$brand;
        //         }
        //     }
        // }

        $priceRangeURL = "";
        if(!empty($data['price_range'])){
            $priceRangeURL .= '&price='.$data['price_range'];
        }

        // if(request()->is('*/product-grids')){
        //     return redirect()->route('product-grids',$catURL.$brandURL.$priceRangeURL.$showURL.$sortByURL);
        // }
        
        return redirect()->route('product-lists',$catURL.$brandURL.$priceRangeURL.$showURL.$sortByURL);
    }

    public function productSearch(Request $request){
        $recent_products = $this->product->where('status','active')->orderBy('id','DESC')->limit(3)->get();

        $products = $this->product->orwhere('title','like','%'.$request->search.'%')
            ->orwhere('slug','like','%'.$request->search.'%')
            ->orwhere('description','like','%'.$request->search.'%')
            ->orwhere('summary','like','%'.$request->search.'%')
            ->orwhere('price','like','%'.$request->search.'%')
            ->orderBy('id','DESC')
            ->paginate('9');
            
        return view('frontend.pages.product-grids')->with('products',$products)->with('recent_products',$recent_products);
    }

    public function productBrand(Request $request){
        $products        = $this->brand->getProductByBrand($request->slug);

        $recent_products = $this->product->where('status', 'active')->orderBy('id', 'DESC')->limit(3)->get(); 

        if(request()->is('*/product-grids')){
            return view('frontend.pages.product-grids')->with('products', $products->products)->with('recent_products',$recent_products);
        }
        
        return view('frontend.pages.product-lists')
                    ->with('products', $products->products)
                    ->with('recent_products',$recent_products)
                    ->with('brands',$this->productBrands());
    }

    public function productCat(Request $request){
        $products        = $this->cate->getProductByCat($request->slug);

        $recent_products = $this->product->where('status','active')->orderBy('id','DESC')->limit(3)->get();

        // if(request()->is('*/product-grids')){
        //     return view('frontend.pages.product-grids')->with('products',$products->products)->with('recent_products',$recent_products);
        // }
        
        return view('frontend.pages.product-lists')
                ->with('products',$products->products)
                ->with('recent_products',$recent_products)
                ->with('brands',$this->productBrands());
    }

    //parent-cate/child-cate
    public function productSubCat(Request $request){
        $products        = $this->cate->getProductBySubCat($request->sub_slug);

        $recent_products = $this->product->where('status','active')->orderBy('id','DESC')->limit(3)->get();

        // if(request()->is('*/product-grids')){
        //     return view('frontend.pages.product-grids')->with('products',$products->sub_products)->with('recent_products',$recent_products);
        // }

        return view('frontend.pages.product-lists')
            ->with('products',$products->sub_products)
            ->with('recent_products',$recent_products)
            ->with('brands',$this->productBrands());
    }

}



// Phương thức is() cho phép kiểm tra xem đường dẫn request có khớp với một mẫu hay không, sử dụng ký tự * để trùng khớp tất cả.