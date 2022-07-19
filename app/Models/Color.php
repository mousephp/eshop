<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\product;

class Color extends Model
{
	use SoftDeletes;

 	protected $table = 'colors';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'status'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'color_products', 'color_id', 'product_id');
    }

    public function productDetails()
    {
        return $this->hasMany(ProductDetail::class, 'color_id', 'id');
    }
    
}
