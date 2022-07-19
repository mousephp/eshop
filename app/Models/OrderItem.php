<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
	use SoftDeletes;

 	protected $table = 'order_items';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'order_id', 'prod_id', 'quantity', 'price', 'size'
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'prod_id');
    }

}
