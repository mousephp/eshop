<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PermissionRole extends Model
{
	use SoftDeletes;

 	protected $table = 'permission_roles';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'role_id', 'permission_id'
    ];

}
