<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
	use SoftDeletes;

 	protected $table = 'messages';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'message', 'email', 'phone', 'read_at', 'photo', 'subject'
    ];

}
