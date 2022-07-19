<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
	use SoftDeletes;

 	protected $table = 'notifications';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'data', 'type', 'notifiable', 'read_at'
    ];
    
}
