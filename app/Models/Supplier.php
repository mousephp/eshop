<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\product;

class Supplier extends Model
{
    use SoftDeletes;

 	protected $table = 'suppliers';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'address', 'phone', 'email', 'shop_name', 'status'
    ];
}
