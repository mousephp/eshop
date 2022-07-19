<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
	use SoftDeletes;

 	protected $table = 'settings';
   protected $dates = ['deleted_at'];

    protected $fillable = [
       'short_des', 'description', 'logo', 'photo', 'address', 'phone', 'email', 'config_key', 'config_value' ,'type', 'status'
    ];

}
