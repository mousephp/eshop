<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoleUser extends Model
{
	use SoftDeletes;

 	protected $table = 'role_users';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'role_id', 'user_id'
    ];
    
}
