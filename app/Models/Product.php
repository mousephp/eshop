<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
use App\Models\{ Brand, Tag, Size, Color, Order, Category, ProductTag, ProductReview, ProductImage };

class Product extends Model
{
	use SoftDeletes;
    const paginates = 5;

	protected $table = 'products';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title','slug','summary','quantity','price','description','discount','status','is_featured','feature_image_path','feature_image_name','condition','stock_in','stock_out','inventory','created_by','updated_by','size_id', 'color_id','brand_id','cate_id','user_id'    
    ];

    public function sizes(){
        return $this->belongsToMany(Size::class, 'product_sizes', 'prod_id', 'size_id')->withTimestamps();
    }

    public function colors(){
        return $this->belongsToMany(Color::class, 'color_products', 'prod_id', 'color_id')->withTimestamps();
    }

    public function tags() {
        return $this->belongsToMany(Tag::class, 'product_tags', 'prod_id', 'tag_id')->withTimestamps();
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_items', 'prod_id', 'order_id');
    }

    public function admin() {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function category() {
        return $this->belongsTo(Category::class, 'cate_id');
    }

    public function brand() {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function productImages() {
        return $this->hasMany(ProductImage::class, 'prod_id', 'id');
    }


    public static function productPriceMax() {
        return Product::max('price');
    }

    public function cat_info(){
        return $this->hasOne(Category::class,'id','cate_id');
    }

    public function sub_cat_info(){
        return $this->hasOne(Category::class,'id','cate_id');
    }

    public static function getAllProduct(){
        return Product::with(['cat_info','sub_cat_info'])->orderBy('id','desc')->paginate(10);
    }

    public function rel_prods(){
        return $this->hasMany(Product::class,'cate_id','cate_id')->where('status','active')->orderBy('id','DESC')->limit(8);
    }

    public function getReview(){
        return $this->hasMany(ProductReview::class,'prod_id','id')->with('user_info')->where('status','active')->orderBy('id','DESC');
    }

    public static function getProductBySlug($slug){
        return Product::with(['cat_info','rel_prods','getReview'])->where('slug',$slug)->first();
    }

    public static function countActiveProduct(){
        $data = Product::where('status','active')->count();
        if($data){
            return $data;
        }
        return 0;
    }

    public function carts(){
        return $this->hasMany(Cart::class)->whereNotNull('order_id');
    }

    public function wishlists(){
        return $this->hasMany(Wishlist::class)->whereNotNull('cart_id');
    }

}
