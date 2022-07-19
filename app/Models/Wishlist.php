<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Product;

class Wishlist extends Model
{
	use SoftDeletes;

 	protected $table = 'wishlists';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'user_id', 'prod_id', 'price', 'amount', 'quantity'
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'prod_id');
    }

}
