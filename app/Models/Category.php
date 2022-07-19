<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\{ Category, product, };

class Category extends Model
{
	use SoftDeletes;

 	protected $table = 'categories';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'photo', 'summary', 'slug', 'status', 'parent_id', 'deleted_at'
    ];

    public function children()
	{
	    return $this->hasMany(Category::class, 'parent_id');
	}

	public function parent()
	{
	    return $this->belongsTo(Category::class, 'parent_id');
	}

	public function products(){
        return $this->hasMany(Product::class, 'cate_id', 'id')->where('status','active');
    }

	public static function getProductByCat($slug){
        return Category::with('products')->where('slug', $slug)->first();
        // return Product::where('cat_id',$id)->where('child_cat_id',null)->paginate(10);
    }
    public function sub_products(){
        return $this->hasMany(Product::class, 'cate_id', 'id')->where('status','active');
    }
    public static function getProductBySubCat($slug){
        return Category::with('sub_products')->where('slug', $slug)->first();
    }

	public function child_cat(){
        return $this->hasMany('App\Models\Category','parent_id','id')->where('status','active');
    }

    public static function countActiveCategory(){
        $data = Category::where('status', 'active')->count();

        if($data){
            return $data;
        }
        
        return 0;
    }
    
}
