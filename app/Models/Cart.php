<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use SoftDeletes;

    protected $table = 'carts';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'user_id', 'product_id', 'order_id', 'quantity', 'amount', 'price', 'status',
    ];

}
