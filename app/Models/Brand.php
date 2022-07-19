<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\product;

class Brand extends Model
{
	use SoftDeletes;

 	protected $table = 'brands';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'slug', 'status'
    ];

    public function products(){
        return $this->hasMany(Product::class, 'brand_id', 'id')->where('status','active');
    }

    public static function getProductByBrand($slug){
        return Brand::with('products')->where('slug', $slug)->first();
    }

}
