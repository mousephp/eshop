<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
	use SoftDeletes;

 	protected $table = 'banners';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title', 'slug', 'description', 'photo', 'status'
    ];
    
}
