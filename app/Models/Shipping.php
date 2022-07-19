<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shipping extends Model
{
	use SoftDeletes;

 	protected $table = 'shippings';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'type', 'price', 'status'
    ];

}
