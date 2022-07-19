<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
	use SoftDeletes;

 	protected $table = 'coupons';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'code','type','value','status'
    ];
    
}
