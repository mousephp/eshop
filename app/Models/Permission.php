<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
	use SoftDeletes;

 	protected $table = 'permissions';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'display_name', 'parent_id', 'key_code', 'status'
    ];

    public function permissionsChildrent()
    {
        return $this->hasMany(Permission::class, 'parent_id');
    }

    
}
