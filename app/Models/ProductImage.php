<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductImage extends Model
{
	use SoftDeletes;

 	protected $table = 'product_images';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'image_path', 'image_name', 'prod_id'
    ];

}
