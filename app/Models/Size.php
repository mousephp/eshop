<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\product;

class Size extends Model
{
	use SoftDeletes;

 	protected $table = 'sizes';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'status'
    ];
    
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_sizes', 'size_id', 'product_id');
    }

    public function productDetails()
    {
        return $this->hasMany(ProductDetail::class, 'size_id', 'id');
    }

}
